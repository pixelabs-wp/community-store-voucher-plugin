<?php
class CSVP_View_Manager{
    // Constructor
    public function __construct() {}

    // Load view based on user role
    public static function load_view($view_type, $data = array()) {
        if (CSVP_User_Roles::user_has_role(get_current_user_id(), CSVP_User_Roles::ROLE_SYSTEM_ADMIN)) {
            self::load_admin_view($view_type, $data);
        } elseif (CSVP_User_Roles::user_has_role(get_current_user_id(), CSVP_User_Roles::ROLE_COMMUNITY_MANAGER)) {
            self::load_community_manager_view($view_type, $data);
        } elseif (CSVP_User_Roles::user_has_role(get_current_user_id(), CSVP_User_Roles::ROLE_STORE_MANAGER)) {
            self::load_store_manager_view($view_type, $data);
        } elseif (CSVP_User_Roles::user_has_role(get_current_user_id(), CSVP_User_Roles::ROLE_COMMUNITY_MEMBER)) {
            self::load_community_member_view($view_type, $data);
        } else {
            echo "Bad Request" . $view_type;
        }
    }

    // Load admin view
    private static function load_admin_view($view_type, $data) {
        self::load_view_file("system-admin/$view_type", $data);
    }

    // Load community manager view
    private static function load_community_manager_view($view_type,  $data) {
        self::load_view_file("community-manager/$view_type", $data);
    }

    // Load store manager view
    private static function load_store_manager_view($view_type, $data) {
        self::load_view_file("store-manager/$view_type", $data);
    }

    // Load community member view
    private static function load_community_member_view($view_type, $data) {
        self::load_view_file("community-member/$view_type", $data);
    }

    // Load view file
    private static function load_view_file($view_file, $pageData) {
        global $community_member, $voucher_transaction, $store;
        $view_path = CSVP_PLUGIN_PATH . "views/$view_file.php";
        if (file_exists($view_path)) {
            wp_head();
            include $view_path;
            echo '<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>';
        } else {
            echo "Bad Request : $view_path";
        }
    }
}
