<?php
/**
 * PHPUnit bootstrap file for Gift Card Instant Sale Plugin
 *
 * @package GICS
 */

// First, we need to load Patchwork to handle function redefinition
require_once dirname(__DIR__) . '/vendor/antecedent/patchwork/Patchwork.php';

// Then load the composer autoloader
require_once dirname(__DIR__) . '/vendor/autoload.php';

// Initialize Brain Monkey
require_once dirname(__DIR__) . '/vendor/brain/monkey/inc/api.php';

/**
 * PHPUnit's setUpBeforeClass event
 */
\Brain\Monkey\setUp();

// After each test, we need to clean up the Brain Monkey setup
register_shutdown_function(function() {
    \Brain\Monkey\tearDown();
});

// Define WordPress constants that might be used
define('ABSPATH', dirname(__DIR__));
define('WP_PLUGIN_DIR', dirname(__DIR__));
define('WPINC', 'wp-includes');

// Mock WordPress functions AFTER Patchwork is loaded
global $wpdb;
$wpdb = new class {
    public $prefix = 'wp_';
    public function get_charset_collate() {
        return 'DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci';
    }
};

// Mock WordPress functions
function plugin_dir_path($file) {
    return dirname($file) . '/';
}

function plugin_dir_url($file) {
    return 'http://example.com/wp-content/plugins/' . basename(dirname($file)) . '/';
}

function plugin_basename($file) {
    return basename(dirname($file)) . '/' . basename($file);
}

function __($text, $domain = 'default') {
    return $text;
}

function _e($text, $domain = 'default') {
    echo $text;
}

function esc_html__($text, $domain = 'default') {
    return $text;
}

function esc_html($text) {
    return $text;
}

function esc_attr__($text, $domain = 'default') {
    return $text;
}

function esc_attr($text) {
    return $text;
}

// Additional WordPress function mocks can be added here as needed
