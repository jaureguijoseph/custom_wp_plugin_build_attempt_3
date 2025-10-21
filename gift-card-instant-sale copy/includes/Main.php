<?php
/**
 * Main plugin class
 *
 * @package GICS
 * 
 * @method bool register_activation_hook(string $file, callable $callback)
 * @method bool register_deactivation_hook(string $file, callable $callback)
 * @method bool add_action(string $hook_name, callable $callback, int $priority = 10, int $accepted_args = 1)
 * @method void dbDelta(string $sql)
 * @method int|bool wp_next_scheduled(string $hook, array $args = array())
 * @method bool wp_schedule_event(int $timestamp, string $recurrence, string $hook, array $args = array())
 * @method bool wp_clear_scheduled_hook(string $hook)
 * @method bool load_plugin_textdomain(string $domain, bool $deprecated = false, string $plugin_rel_path = '')
 * @method string plugin_dir_path(string $file)
 * @method string plugin_dir_url(string $file)
 * @method string plugin_basename(string $file)
 */

namespace GICS;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Main plugin class
 *
 * @since 1.0.0
 */
class Main {

    /**
     * Initialize the plugin
     *
     * @since 1.0.0
     * @return void
     */
    public function init() {
        // These constants will use real WordPress functions in production
        // and mocked functions during testing
        if ( ! defined( 'GICS_VERSION' ) ) {
            define( 'GICS_VERSION', '1.0.0' );
        }
        if ( ! defined( 'GICS_PLUGIN_DIR' ) ) {
            define( 'GICS_PLUGIN_DIR', \plugin_dir_path( dirname( __FILE__ ) ) );
        }
        if ( ! defined( 'GICS_PLUGIN_URL' ) ) {
            define( 'GICS_PLUGIN_URL', \plugin_dir_url( dirname( __FILE__ ) ) );
        }
        if ( ! defined( 'GICS_PLUGIN_BASENAME' ) ) {
            define( 'GICS_PLUGIN_BASENAME', \plugin_basename( dirname( dirname( __FILE__ ) ) . '/gift-card-instant-sale.php' ) );
        }

        $this->register_hooks();
    }

    /**
     * Register plugin hooks
     *
     * @since 1.0.0
     * @return void
     */
    private function register_hooks() {
        // These hooks will use real WordPress functions in production
        // and mocked functions during testing
        \register_activation_hook( GICS_PLUGIN_DIR . 'gift-card-instant-sale.php', array( $this, 'activate' ) );
        \register_deactivation_hook( GICS_PLUGIN_DIR . 'gift-card-instant-sale.php', array( $this, 'deactivate' ) );
        \add_action( 'plugins_loaded', array( $this, 'load_plugin' ) );
    }

    /**
     * Plugin activation callback
     *
     * @since 1.0.0
     * @return void
     */
    public function activate() {
        global $wpdb;

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';

        // Create transactions table
        $sql = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}giftcard_transactions (
            id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
            user_id bigint(20) unsigned NOT NULL,
            amount decimal(10,2) NOT NULL,
            status varchar(50) NOT NULL,
            created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            KEY user_id (user_id)
        ) {$wpdb->get_charset_collate()};";
        \dbDelta( $sql );

        // Create tokens table
        $sql = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}giftcard_tokens (
            id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
            user_id bigint(20) unsigned NOT NULL,
            token text NOT NULL,
            type varchar(50) NOT NULL,
            expires_at datetime NOT NULL,
            created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            KEY user_id (user_id)
        ) {$wpdb->get_charset_collate()};";
        \dbDelta( $sql );

        // Create user limits table
        $sql = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}giftcard_user_limits (
            id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
            user_id bigint(20) unsigned NOT NULL,
            daily_total decimal(10,2) NOT NULL DEFAULT 0,
            weekly_total decimal(10,2) NOT NULL DEFAULT 0,
            monthly_total decimal(10,2) NOT NULL DEFAULT 0,
            yearly_total decimal(10,2) NOT NULL DEFAULT 0,
            last_transaction datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            UNIQUE KEY user_id (user_id)
        ) {$wpdb->get_charset_collate()};";
        \dbDelta( $sql );

        // Create error logs table
        $sql = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}giftcard_error_logs (
            id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
            error_code varchar(50) NOT NULL,
            error_message text NOT NULL,
            user_id bigint(20) unsigned DEFAULT NULL,
            created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            KEY user_id (user_id)
        ) {$wpdb->get_charset_collate()};";
        \dbDelta( $sql );

        // Schedule cleanup events
        if ( ! \wp_next_scheduled( 'gics_cleanup_expired_tokens' ) ) {
            \wp_schedule_event( time(), 'daily', 'gics_cleanup_expired_tokens' );
        }
        if ( ! \wp_next_scheduled( 'gics_cleanup_error_logs' ) ) {
            \wp_schedule_event( time(), 'daily', 'gics_cleanup_error_logs' );
        }
    }

    /**
     * Plugin deactivation callback
     *
     * @since 1.0.0
     * @return void
     */
    public function deactivate() {
        // Clear scheduled events
        \wp_clear_scheduled_hook( 'gics_cleanup_expired_tokens' );
        \wp_clear_scheduled_hook( 'gics_cleanup_error_logs' );
        \wp_clear_scheduled_hook( 'gics_process_payouts' );
    }

    /**
     * Load plugin functionality
     *
     * @since 1.0.0
     * @return void
     */
    public function load_plugin() {
        // Load translations
        \load_plugin_textdomain( 'gift-card-instant-sale', false, dirname( \plugin_basename( __FILE__ ) ) . '/languages' );
    }
}
