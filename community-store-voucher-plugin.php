<?php
/*
Plugin Name: Community Store Voucher Plugin
Plugin URI: https://yourwebsite.com/community-store-voucher-plugin
Description: A plugin for managing community-store voucher system.
Version: 1.0.0
Author: Pixelabs
Author URI: https://yourwebsite.com
License: GPL-2.0+
License URI: http://www.gnu.org/licenses/gpl-2.0.txt
Text Domain: community-store-voucher-plugin
*/

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('CSVP_PLUGIN_VERSION', '1.0.0');
define('CSVP_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('CSVP_PLUGIN_URL', plugin_dir_url(__FILE__));

// Include necessary files
require_once CSVP_PLUGIN_PATH . 'includes/class-community-store-voucher.php';
require_once CSVP_PLUGIN_PATH . 'admin/admin-page.php';
require_once CSVP_PLUGIN_PATH . 'public/shortcode.php';
require_once CSVP_PLUGIN_PATH . 'csvp-routing.php';
require_once CSVP_PLUGIN_PATH . 'assets/csvp-assets-loader.php';

// Initialize the plugin
function csvp_init_plugin() {
    // Initialize database structure
    csvp_initialize_database();
    $router = new CSVP_Router();
    $router->register_routes();
    // Register activation and deactivation hooks
    register_activation_hook(__FILE__, 'csvp_activate');
    register_deactivation_hook(__FILE__, 'csvp_deactivate');
}
add_action('plugins_loaded', 'csvp_init_plugin');

// Activate the plugin
function csvp_activate() {
    // Initialize database structure
    csvp_initialize_database();
    // Flush rewrite rules on activation
    flush_rewrite_rules();
}

// Deactivate the plugin
function csvp_deactivate() {
    // Flush rewrite rules on deactivation
    flush_rewrite_rules();
}

// Add custom rewrite rules
function csvp_add_rewrite_rules() {
    // Add custom rewrite rules here
}
add_action('init', 'csvp_add_rewrite_rules');

// Add query vars
function csvp_add_query_vars($vars) {
    // Add custom query vars here
    return $vars;
}
add_filter('query_vars', 'csvp_add_query_vars');

// Handle custom actions
function csvp_custom_actions() {
    // Handle custom actions here
}
add_action('parse_request', 'csvp_custom_actions');
