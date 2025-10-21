<?php
/**
 * Plugin Name: Gift Card Instant Sale
 * Plugin URI: https://cashformygiftcards.com/gift-card-instant-sale
 * Description: Convert Visa gift cards to cash with seamless integration with WS Form, Plaid, and Authorize.Net.
 * Version: 1.0.0
 * Requires at least: 5.8
 * Requires PHP: 7.4
 * Author: Joseph Jauregui
 * Author URI: https://cashformygiftcards.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: gift-card-instant-sale
 * Domain Path: /languages
 *
 * @package GICS
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Require Composer autoloader if it exists.
if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
    require_once __DIR__ . '/vendor/autoload.php';
}

// Initialize the plugin.
function gics_init() {
    // Create main plugin instance.
    $plugin = new GICS\Main();
    
    // Initialize the plugin.
    $plugin->init();
}

// Hook into WordPress.
add_action( 'plugins_loaded', 'gics_init' );
