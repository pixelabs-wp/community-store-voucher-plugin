<?php
class CSVP_User_Roles extends CSVP_Base{
    // Define user roles
    const ROLE_SYSTEM_ADMIN = 'system_administrator';
    const ROLE_COMMUNITY_MANAGER = 'community_manager';
    const ROLE_STORE_MANAGER = 'store_manager';
    const ROLE_COMMUNITY_MEMBER = 'community_member';

    // Constructor
    public function __construct() {
        // Add hooks
        add_action('init', array($this, 'register_user_roles'));
        add_action('admin_init', array($this, 'assign_default_role'));
    }

    // Assign default role to administrator
    public function assign_default_role() {
        $admin_id = get_role('administrator');
        if ($admin_id && !user_can($admin_id, self::ROLE_SYSTEM_ADMIN)) {
            $admin_id->add_cap(self::ROLE_SYSTEM_ADMIN);
        }
    }
    
    // Register custom user roles
    public function register_user_roles() {
        // Get the administrator role object
        $admin_role = get_role('administrator');

        // Add system administrator role and assign the same capabilities as the administrator role
        add_role(self::ROLE_SYSTEM_ADMIN, __('System Administrator'), $admin_role->capabilities);

        // Add other custom roles as needed
        add_role(self::ROLE_COMMUNITY_MANAGER, __('Community Manager'), array(
            'read' => true,
            // Add capabilities as needed
        ));

        add_role(self::ROLE_STORE_MANAGER, __('Store Manager'), array(
            'read' => true,
            // Add capabilities as needed
        ));

        add_role(self::ROLE_COMMUNITY_MEMBER, __('Community Member'), array(
            'read' => true,
            // Add capabilities as needed
        ));
    }

    // Check if a user has a specific role
    public static function user_has_role($user_id, $role) {
        $user = get_userdata($user_id);
        if ($user && in_array($role, (array) $user->roles)) {
            return true;
        }
        return false;
    }

    // Add a role to a user
    public static function add_role_to_user($user_id, $role) {
        $user = new WP_User($user_id);
        $user->add_role($role);
    }

    // Remove a role from a user
    public static function remove_role_from_user($user_id, $role) {
        $user = new WP_User($user_id);
        $user->remove_role($role);
    }
}

