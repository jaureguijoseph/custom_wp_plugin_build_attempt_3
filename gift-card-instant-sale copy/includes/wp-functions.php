<?php
/**
 * WordPress functions stubs file
 * This file is only for IDE type hinting and won't be used in production
 * @package GICS
 */

if (!function_exists('register_activation_hook')) {
    function register_activation_hook(string $file, callable $callback) {}
}

if (!function_exists('register_deactivation_hook')) {
    function register_deactivation_hook(string $file, callable $callback) {}
}

if (!function_exists('add_action')) {
    function add_action(string $hook_name, callable $callback, int $priority = 10, int $accepted_args = 1) {}
}

if (!function_exists('dbDelta')) {
    function dbDelta(string $sql) {}
}

if (!function_exists('wp_next_scheduled')) {
    function wp_next_scheduled(string $hook, array $args = array()) {}
}

if (!function_exists('wp_schedule_event')) {
    function wp_schedule_event(int $timestamp, string $recurrence, string $hook, array $args = array()) {}
}

if (!function_exists('wp_clear_scheduled_hook')) {
    function wp_clear_scheduled_hook(string $hook) {}
}

if (!function_exists('load_plugin_textdomain')) {
    function load_plugin_textdomain(string $domain, bool $deprecated = false, string $plugin_rel_path = '') {}
}

if (!function_exists('plugin_dir_path')) {
    function plugin_dir_path(string $file) {}
}

if (!function_exists('plugin_dir_url')) {
    function plugin_dir_url(string $file) {}
}

if (!function_exists('plugin_basename')) {
    function plugin_basename(string $file) {}
}
