<?php
class CSVP_Assets_Loader {
    // Register and enqueue styles and scripts
    public static function register_assets() {
        add_action('wp_enqueue_scripts', array(__CLASS__, 'enqueue_styles'));
        add_action('admin_enqueue_scripts', array(__CLASS__, 'enqueue_admin_styles'));
        add_action('admin_enqueue_scripts', array(__CLASS__, 'enqueue_admin_scripts'));
    }

    // Enqueue styles for the front-end
    public static function enqueue_styles() {
        // Enqueue stylesheets
        wp_enqueue_style('csvp-tabler-styles', CSVP_PLUGIN_URL . 'assets/dist/css/tabler.min.css?1684106062', array(), CSVP_PLUGIN_VERSION);
        wp_enqueue_style('csvp-tabler-flags', CSVP_PLUGIN_URL . 'assets/dist/css/tabler-flags.min.css?1684106062', array(), CSVP_PLUGIN_VERSION);
        wp_enqueue_style('csvp-tabler-payments', CSVP_PLUGIN_URL . 'assets/dist/css/tabler-payments.min.css?1684106062', array(), CSVP_PLUGIN_VERSION);
        wp_enqueue_style('csvp-tabler-vendors', CSVP_PLUGIN_URL . 'assets/dist/css/tabler-vendors.min.css?1684106062', array(), CSVP_PLUGIN_VERSION);
        wp_enqueue_style('csvp-core', CSVP_PLUGIN_URL . 'assets/dist/css/demo.min.css?1684106062', array(), CSVP_PLUGIN_VERSION);
        wp_enqueue_style('csvp-helper', CSVP_PLUGIN_URL . 'assets/dist/css/demo.min.css?1684106062', array(), CSVP_PLUGIN_VERSION);
        wp_enqueue_script('csvp-core', CSVP_PLUGIN_URL . 'assets/dist/js/demo-theme.min.js?1684106062', array('jquery'), CSVP_PLUGIN_VERSION, true);
    }

    // Enqueue styles for the admin area
    public static function enqueue_admin_styles() {
        // Enqueue stylesheets
        // wp_enqueue_style('csvp-admin-styles', CSVP_PLUGIN_URL . 'assets/css/admin-styles.css', array(), CSVP_PLUGIN_VERSION);
    }

    // Enqueue scripts for the admin area
    public static function enqueue_admin_scripts($hook) {
        // Enqueue scripts only on plugin admin pages
        if (strpos($hook, 'community-store-voucher-plugin') === false) {
            return;
        }

        // Enqueue scripts
        // wp_enqueue_script('csvp-admin-scripts', CSVP_PLUGIN_URL . 'assets/js/admin-scripts.js', array('jquery'), CSVP_PLUGIN_VERSION, true);

        // Localize script data
        wp_localize_script('csvp-admin-scripts', 'csvp_admin_vars', array(
            'csvp_ajax' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('csvp_admin_nonce')
        ));
    }
}

// Initialize assets loader
CSVP_Assets_Loader::register_assets();
