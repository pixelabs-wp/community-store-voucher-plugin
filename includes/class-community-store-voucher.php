<?php
// Initialize user roles class
define('VOUCHER_STATUS_PENDING', 'Pending');
define('VOUCHER_STATUS_APPROVED', 'Approved');
define('VOUCHER_STATUS_REJECTED', 'Rejected');
define('VOUCHER_STATUS_USED', 'Used');
define('VOUCHER_STATUS_REQUESTED', 'Requested');
define('VOUCHER_STATUS_EXPIRED', 'Expired');
define('VOUCHER_STATUS_PAID', 'Paid');

define('COMMISSION_STATUS_PENDING', 'Pending');
define('COMMISSION_STATUS_APPROVED', 'Approved');
define('COMMISSION_STATUS_REJECTED', 'Rejected');
define('COMMISSION_STATUS_PAID', 'Paid');
define('COMMISSION_TYPE_ORDER', 'Order');
define('COMMISSION_TYPE_VOUCHER', 'Voucher');
define('COMMISSION_TYPE_ACCUMULATED', 'accumulated');


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
define('MESSAGE_STATUS_ARCHIVED', 'Archived');

define( 'VOUCHER_TRANSACTION_PURCHASE', 'Voucher Purchase');
define('VOUCHER_TRANSACTION_LOAD', 'Voucher Load');
define('VOUCHER_TRANSACTION_REDEEM', 'Voucher Redeem');

define('TRANSACTION_TYPE_DEBIT', 'debit');
define('TRANSACTION_TYPE_CREDIT', 'credit');


const ACTION_LOAD_CARD = 'Load Card';
const ACTION_PURCHASE_VOUCHER = 'Purchase Voucher';
const ACTION_SEND_MESSAGE = 'Send Message';
const ACTION_CLAIM_VOUCHER = 'Claim Voucher';
const ACTION_JOIN_REQUEST = 'Join Request';
const ACTION_CREATE_ORDER = 'Create Order';
const ACTION_CREATE_RETURN = 'Create Return';
const ACTION_MESSAGE_STATUS = 'Message Status';
const ACTION_ADD_VOUCHER = 'Add Voucher';
const ACTION_DELETE_VOUCHER = 'Delete Voucher';
const ACTION_CREDIT_LIMIT_UPDATE = 'Credit Limit Update';
const ACTION_UPDATE_TRANSACTION_STATUS = 'Update Transaction Status';
const ACTION_UPDATE_ORDER_STATUS = 'Update Order Status';
const ACTION_UPDATE_RETURN_STATUS = 'Update Return Status';
const ACTION_CREATE_TRANSACTION = 'Create Transaction';
const ACTION_JOIN_REQUEST_STATUS_UPDATE = 'Join Request Status Update';
const ACTION_COMMISSION_STATUS_UPDATE = 'Commission Status Update';
const ACTION_MESSAGE_STATUS_UPDATE = 'Message Status Update';


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

function nestedLowercase($value)
{
  if (is_array($value)) {
    return array_map('nestedLowercase', $value);
  }
  return strtolower($value);
}

// Function to calculate days ago
function calculateDaysAgo($date)
{
  // Create DateTime object for the given date
  $date_obj = new DateTime($date);

  // Get current date
  $current_date = new DateTime();

  // Calculate the difference
  $interval = $current_date->diff($date_obj);

  // Get the number of days
  $days = $interval->format('%a');


  if ($days < 1) {
    return "Today";
  } else {
    return $days . ' ago';
  }
}