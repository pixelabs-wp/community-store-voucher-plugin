<?php
// Initialize user roles class
define('VOUCHER_STATUS_PENDING', 'Pending');
define('VOUCHER_STATUS_APPROVED', 'Approved');
define('VOUCHER_STATUS_REJECTED', 'Rejected');
define('VOUCHER_STATUS_USED', 'Used');
define('VOUCHER_STATUS_EXPIRED', 'Expired');

define('COMMISSION_STATUS_PENDING', 'Pending');
define('COMMISSION_STATUS_APPROVED', 'Approved');
define('COMMISSION_STATUS_REJECTED', 'Rejected');
define('COMMISSION_STATUS_PAID', 'Paid');
define('COMMISSION_TYPE_ORDER', 'Order');
define('COMMISSION_TYPE_VOUCHER', 'Voucher');

define('MESSAGE_STATUS_UNREAD', 'Unread');
define('MESSAGE_STATUS_READ', 'Read');
define('MESSAGE_STATUS_ARCHIVED', 'Archived');

define('JOINING_REQUEST_STATUS_PENDING', 'Pending');
define('JOINING_REQUEST_STATUS_APPROVED', 'Approved');
define('JOINING_REQUEST_STATUS_REJECTED', 'Rejected');

define('ORDER_STATUS_PENDING', 'Pending');
define('ORDER_STATUS_PROCESSING', 'Processing');
define('ORDER_STATUS_COMPLETED', 'Completed');
define('ORDER_STATUS_RETURNED', 'Returned');
define('ORDER_STATUS_PAID', 'Paid');
define('ORDER_STATUS_CANCELLED', 'Cancelled');


define('MESSAGE_STATUS_UNSEEN', 'Unseen');
define('MESSAGE_STATUS_SEEN', 'Seen');


add_action('init', 'redirect_user');

function redirect_user() {
    // Check if user is logged in
    if (is_user_logged_in()) {
        $current_url = $_SERVER['REQUEST_URI'];

        // Check if user is an admin and not already on /admin or its child pages, but allow access to wp-admin
        if (CSVP_User_Roles::user_has_role(get_current_user_id(), CSVP_User_Roles::ROLE_SYSTEM_ADMIN) && !preg_match('/\/admin(\/.*)?$/', $current_url) && !is_admin()) {
            // Redirect the admin user to the admin page
            wp_redirect(site_url('/admin'));
            exit;
        }

        // Check if user is a community manager and not already on /community or its child pages
        elseif (CSVP_User_Roles::user_has_role(get_current_user_id(), CSVP_User_Roles::ROLE_COMMUNITY_MANAGER) && !preg_match('/\/community(\/.*)?$/', $current_url)) {
            // Redirect the community manager user to the community page
            wp_redirect(site_url('/community'));
            exit;
        }

        // Check if user is a store manager and not already on /store or its child pages
        elseif (CSVP_User_Roles::user_has_role(get_current_user_id(), CSVP_User_Roles::ROLE_STORE_MANAGER) && !preg_match('/\/store(\/.*)?$/', $current_url)) {
            // Redirect the store manager user to the store page
            wp_redirect(site_url('/store'));
            exit;
        }

        // Check if user is a community member and not already on /member or its child pages
        elseif (CSVP_User_Roles::user_has_role(get_current_user_id(), CSVP_User_Roles::ROLE_COMMUNITY_MEMBER) && !preg_match('/\/member(\/.*)?$/', $current_url)) {
            // Redirect the community member user to the member page
            wp_redirect(site_url('/member'));
            exit;
        }
    }
}



// Add the CSVP menu item
add_action( 'admin_menu', 'my_add_csvp_menu' );

function my_add_csvp_menu() {
  add_menu_page(
    'CSVP', // Page title
    'CSVP', // Menu text
    'manage_options', // Capability required to access the menu
    'my-csvp-page', // Unique menu slug (used internally)
    'my_csvp_page_callback' // Function to call when clicking the menu
  );
}

function my_csvp_page_callback() {
    echo '<script>window.location.href = "' . home_url() . '";</script>';
    exit;
  }
  