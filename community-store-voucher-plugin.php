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

error_reporting(E_ALL); 
ini_set('display_errors', 1);

// Define plugin constants
define('CSVP_PLUGIN_VERSION', '1.0.0');
define('CSVP_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('CSVP_PLUGIN_URL', plugin_dir_url(__FILE__));
define('CSVP_VIEWS', CSVP_PLUGIN_PATH."views");

// Include necessary files
require_once CSVP_PLUGIN_PATH . 'includes/class-database.php';
require_once CSVP_PLUGIN_PATH . 'includes/class-request-handler.php';
require_once CSVP_PLUGIN_PATH . 'includes/class-user-roles.php';
require_once CSVP_PLUGIN_PATH . 'includes/class-view-manager.php';

require_once CSVP_PLUGIN_PATH . 'includes/class-community.php';
require_once CSVP_PLUGIN_PATH . 'includes/class-store.php';
require_once CSVP_PLUGIN_PATH . 'includes/class-commision.php';
require_once CSVP_PLUGIN_PATH . 'includes/class-joining-request.php';
require_once CSVP_PLUGIN_PATH . 'includes/class-transaction.php';
require_once CSVP_PLUGIN_PATH . 'includes/class-order.php';
require_once CSVP_PLUGIN_PATH . 'includes/class-voucher.php';

require_once CSVP_PLUGIN_PATH . 'includes/class-routing.php';
require_once CSVP_PLUGIN_PATH . 'admin/admin-page.php';
require_once CSVP_PLUGIN_PATH . 'public/shortcode.php';
require_once CSVP_PLUGIN_PATH . 'assets/csvp-assets-loader.php';

//init tests
// require_once CSVP_PLUGIN_PATH . 'tests/class-community-test.php';
// require_once CSVP_PLUGIN_PATH . 'tests/class-store-test.php';
// require_once CSVP_PLUGIN_PATH . 'tests/class-commision-test.php';
// require_once CSVP_PLUGIN_PATH . 'tests/class-joining-request-test.php';
// require_once CSVP_PLUGIN_PATH . 'tests/class-order-test.php';
// require_once CSVP_PLUGIN_PATH . 'tests/class-voucher-test.php';
// 


$database = new CSVP_Initialize_Database();

// Initialize the plugin
function csvp_init_plugin() {
    global $database;

    $router = new CSVP_Router();
    $router->register_routes();
}

register_activation_hook(__FILE__, 'csvp_activate');
register_deactivation_hook(__FILE__, 'csvp_deactivate');

add_action('plugins_loaded', 'csvp_init_plugin');

// Activate the plugin
function csvp_activate() {
    // Initialize database structure
    CSVP_Initialize_Database::create_tables();
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


// Joining Request:

// create_joining_request()
// get_joining_request_by_id($request_id)
// update_joining_request($request_id, $data)
// delete_joining_request($request_id)
// get_all_joining_requests()
// Transaction:


// Order:


// Voucher:

// Voucher Transaction:


// Walk Order:


// Community Member:

// Balance:
