<?php

// CSVP Router class for handling plugin routing
class CSVP_Router {
    // Array to store registered routes
    private $routes = array();
    
    // Register routes
    public function register_routes() {
        // Define routes here
        $this->routes = apply_filters('csvp_routes', array(

            //Community Member Routes
            'member_transaction_history' => array(
                'path' => 'member/transaction-history',
                'callback' => array('CSVP_CommunityMember', 'render_transaction_history'),
            ),
            'member_loading_history' => array(
                'path' => 'member/loading-history',
                'callback' => array('CSVP_CommunityMember', 'render_loading_history'),
            ),
            'member_load_card' => array(
                'path' => 'member/load-card',
                'callback' => array('CSVP_CommunityMember', 'render_load_card'),
            ),
            'member_coupons' => array(
                'path' => 'member/coupons',
                'callback' => array('CSVP_CommunityMember', 'render_coupons'),
            ),
            'member_shops' => array(
                'path' => 'member/shops',
                'callback' => array('CSVP_CommunityMember', 'render_shops'),
            ),
            'member_default' => array(
                'path' => 'member',
                'callback' => array('CSVP_CommunityMember', 'render_transaction_history'),
            ),
            //Community Manager Routes
            'community_default' => array(
                'path' => 'community',
                'callback' => array('CSVP_Community', 'render_dashboard'
                ),
            ),
            'community_dashboard' => array(
                'path' => 'community/dashboard',
                'callback' => array('CSVP_Community', 'render_dashboard'),
            ),
            'community_manage_guys' => array(
                'path' => 'community/manage-guys',
                'callback' => array('CSVP_Community', 'render_manage_guys'),
            ),
            'community_messages' => array(
                'path' => 'community/messages',
                'callback' => array('CSVP_Community', 'render_messages'),
            ),
            'community_transaction_history' => array(
                'path' => 'community/transaction-history',
                'callback' => array('CSVP_Community', 'render_transaction_history'),
            ),
            'community_store_management' => array(
                'path' => 'community/manage-stores',
                'callback' => array('CSVP_Community', 'render_store_management'),
            ),
            'community_order_management' => array(
                'path' => 'community/manage-orders',
                'callback' => array('CSVP_Community', 'render_order_management'),
            ),
            'community_coupon_management' => array(
                'path' => 'community/manage-coupons',
                'callback' => array('CSVP_Community', 'render_coupon_management'),
            ),
            // Store Manager Routes
            'store_default_route' => array(
                'path' => 'store',
                'callback' => array('CSVP_Store', 'render_transaction_history'),
            ),
            'store_community_management' => array(
                'path' => 'store/manage-communities',
                'callback' => array('CSVP_Store', 'render_community_management'),
            ),
            'store_coupon_management' => array(
                'path' => 'store/manage-coupons',
                'callback' => array('CSVP_Store', 'render_coupon_management'),
            ),
            'store_order_management' => array(
                'path' => 'store/manage-orders',
                'callback' => array('CSVP_Store', 'render_order_management'),
            ),
            'store_order_request' => array(
                'path' => 'store/manage-order-requests',
                'callback' => array('CSVP_Store', 'render_order_request'),
            ),
            'store_return_management' => array(
                'path' => 'store/manage-returns',
                'callback' => array('CSVP_Store', 'render_return_management'),
            ),
            'store_transaction_history' => array(
                'path' => 'store/transaction-history',
                'callback' => array('CSVP_Store', 'render_transaction_history'),
            ),
            'store_walk_order' => array(
                'path' => 'store/walk-order',
                'callback' => array('CSVP_Store', 'render_walk_order'),
            ),
            'store_creating_transactions' => array(
                'path' => 'store/creating-transactions',
                'callback' => array('CSVP_Store', 'render_creating_transactions'),
            ),
            // Admin Routes
            'admin_default' => array(
                'path' => 'admin',
                'callback' => array('CSVP_Admin', 'render_community_management'),
            ),
            'admin_community' => array(
                'path' => 'admin/manage-communities',
                'callback' => array('CSVP_Admin', 'render_community_management'),
            ),
            'admin_store' => array(
                'path' => 'admin/manage-stores',
                'callback' => array('CSVP_Admin', 'render_store_management'),
            ),
            'admin_store_commisions' => array(
                'path' => 'admin/store-commisions',
                'callback' => array('CSVP_Admin', 'render_store_commisions'),
            ),
            'admin_community_commisions' => array(
                'path' => 'admin/community-commisions',
                'callback' => array('CSVP_Admin', 'render_community_commisions'),
            ),
            'admin_messages' => array(
                'path' => 'admin/messages',
                'callback' => array('CSVP_Admin', 'render_messages'),
            ),
            'admin_requests' => array(
                'path' => 'admin/joining-requests',
                'callback' => array('CSVP_Admin', 'render_requests'),
            ),
            'admin_requests' => array(
                'path' => 'admin/community-login',
                'callback' => array('CSVP_Admin', 'login_community'),
            ),
        ));

       
        // Register WordPress hooks to handle routes
        add_action('init', array($this, 'handle_routes'));
    }

    // Handle incoming requests and execute corresponding callback functions
    public function handle_routes() {
        global $wp;
        
        // Extract requested URL path
       $requested_path = trim(parse_url(add_query_arg(array()), PHP_URL_PATH), '/');
        // Match requested path against registered routes
        foreach ($this->routes as $route) {
            if ($requested_path === $route['path']) {
                // Execute callback function for matched route
                $class = new $route['callback'][0]();
                $handler = $route['callback'][1];
                $class->$handler();
                exit; // Stop further processing
            }
        }
    }

}