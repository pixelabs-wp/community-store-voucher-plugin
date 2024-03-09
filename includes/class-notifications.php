<?php

class CSVP_Notification{
    // Store notification types
    const SUCCESS = 'success';
    const INFO = 'info';
    const WARNING = 'warning';
    const ERROR = 'error';

    // Add notification to session
    public static function add($type, $message) {

        // Add notification to session
        $_SESSION['notifications'][] = array(
            'type' => $type,
            'message' => $message
        );
    }

    // Retrieve notifications from session and clear them
    public static function get() {
        // Initialize session if not already started

        // Retrieve notifications from session
        $notifications = isset($_SESSION['notifications']) ? $_SESSION['notifications'] : array();

        // Clear notifications from session
        $_SESSION['notifications'] = array();

        return $notifications;
    }
}

?>
