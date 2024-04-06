<?php

class CSVP_Notification{
    // Store notification types
    const SUCCESS = 'success';
    const INFO = 'info';
    const WARNING = 'warning';
    const ERROR = 'error';
    public static $table_name;

    public static function setTable()
    {
        global $wpdb;
        self::$table_name = $wpdb->prefix . 'csvp_notification';
    }

    // Method to create a new notification
    public static function create_notification($data)
    {
        global $wpdb;

        // Extract data from input array
        $wp_user = $data['wp_user'];
        $action_type = $data['action_type'];
        $recipients = $data['recipients'];

        // Insert data into the database
        $wpdb->insert(
            self::$table_name,
            array(
                'wp_user' => $wp_user,
                'action_type' => $action_type,
                'recipients' => $recipients
            )
        );

        // Check if insertion was successful
        if ($wpdb->insert_id) {
            // Return the ID of the newly inserted notification
            return $wpdb->insert_id;
        } else {
            // Return false if insertion failed
            return false;
        }
    }

    // Method to retrieve notifications by WordPress user
    public static function get_notifications_by_user($wp_user)
    {
        global $wpdb;
        $table = self::$table_name;
        // Prepare SQL query to select notifications by WordPress user
         $query = $wpdb->prepare(
            "SELECT * FROM $table WHERE wp_user = %s",
            $wp_user
        );

        // Execute the query and fetch the results
        $notifications = $wpdb->get_results($query, ARRAY_A);

        // Return the results if any, otherwise return null
        return !empty($notifications) ? $notifications : null;
    }

    // Method to retrieve notifications by action_type
    public function get_notifications_by_action_type($action_type)
    {
        global $wpdb;

        // Prepare SQL query to select notifications by action_type
        $query = $wpdb->prepare(
            "SELECT * FROM $this->table_name WHERE action_type = %s",
            $action_type
        );

        // Execute the query and fetch the results
        $notifications = $wpdb->get_results($query, ARRAY_A);

        // Return the results if any, otherwise return null
        return !empty($notifications) ? $notifications : null;
    }

    // Method to retrieve all notifications
    public function get_all_notifications()
    {
        global $wpdb;

        // Prepare SQL query to select all notifications
        $query = "SELECT * FROM $this->table_name";

        // Execute the query and fetch the results
        $notifications = $wpdb->get_results($query, ARRAY_A);

        // Return the results if any, otherwise return null
        return !empty($notifications) ? $notifications : null;
    }

    // Add notification to session
    public static function add($type, $message)
    {

        // Add notification to session
        $_SESSION['notifications'][] = array(
            'type' => $type,
            'message' => $message
        );

        self::create_notification(array("wp_user"=> get_current_user_id(), "action_type"=> $message, "recipients"=>""));
    }

    // Retrieve notifications from session and clear them
    public static function get()
    {
        // Initialize session if not already started

        // Retrieve notifications from session
        $notifications = isset($_SESSION['notifications']) ? $_SESSION['notifications'] : array();

        // Clear notifications from session
        $_SESSION['notifications'] = array();

        return $notifications;
    }

}

?>
