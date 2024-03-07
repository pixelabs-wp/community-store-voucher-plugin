<?php

// CSVP Router class for handling plugin routing
class CSVP_Router {
    // Array to store registered routes
    private $routes = array();

    // Register routes
    public function register_routes() {
        // Define routes here
        $this->routes = apply_filters('csvp_routes', array(
            'admin_page' => array(
                'path' => 'admin-page',
                'callback' => array($this, 'render_admin_page'),
            ),
            'public_page' => array(
                'path' => 'public-page',
                'callback' => array($this, 'render_public_page'),
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
                call_user_func($route['callback']);
                exit; // Stop further processing
            }
        }
    }

    // Callback function to render admin page
    public function render_admin_page() {
        // Render admin page content here
    }

    // Callback function to render public page
    public function render_public_page() {
        echo "sad";
    }
}