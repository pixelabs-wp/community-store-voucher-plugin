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
define('COMMISSION_TYPE_ACCUMULATED', 'accumulated');

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
define('ORDER_STATUS_RETURNED_PAID', 'Return Paid');
define('ORDER_STATUS_PAID', 'Paid');
define('ORDER_STATUS_CANCELLED', 'Cancelled');


define('MESSAGE_STATUS_UNSEEN', 'Unseen');
define('MESSAGE_STATUS_SEEN', 'Seen');

define('VOUCHER_TRANSACTION_PURCHASE', 'Voucher Purchase');
define('VOUCHER_TRANSACTION_REDEEM', 'Voucher Redeem');

define('TRANSACTION_TYPE_DEBIT', 'debit');
define('TRANSACTION_TYPE_CREDIT', 'credit');


add_action('wp_login', 'redirect_after_login', 10, 2);

function redirect_after_login($user_login, $user)
{
    // Check if the user is a community manager
    if (CSVP_User_Roles::user_has_role($user->ID, CSVP_User_Roles::ROLE_COMMUNITY_MANAGER)) {
        wp_redirect(site_url('/community'));
        exit;
    }
    // Check if the user is a store manager
    elseif (CSVP_User_Roles::user_has_role($user->ID, CSVP_User_Roles::ROLE_STORE_MANAGER)) {
        wp_redirect(site_url('/store'));
        exit;
    }
    // Check if the user is a community member
    elseif (CSVP_User_Roles::user_has_role($user->ID, CSVP_User_Roles::ROLE_COMMUNITY_MEMBER)) {
        wp_redirect(site_url('/member'));
        exit;
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
    echo '<script>window.location.href = "' . home_url('/admin') . '";</script>';
    exit;
  }
  