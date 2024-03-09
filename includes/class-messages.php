<?php

class CSVP_CommunityMessage extends CSVP_Base{
    // Properties
    private $table_name;

    // Constructor
    public function __construct() {
        global $wpdb;
        $this->table_name = $wpdb->prefix . 'csvp_community_message';
    }

    // Method to create a new community message
    public function create_community_message($data) {
        global $wpdb;

        // Extract data from the input array
        $community_member_id = $data['community_member_id'];
        $community_id = $data['community_id'];
        $full_name = $data['full_name'];
        $phone_no = $data['phone_no'];
        $content = $data['content'];

        // Insert data into the database
        $wpdb->insert(
            $this->table_name,
            array(
                'community_member_id' => $community_member_id,
                'community_id' => $community_id,
                'full_name' => $full_name,
                'phone_no' => $phone_no,
                'content' => $content
            )
        );

        // Check if the insertion was successful
        if ($wpdb->insert_id) {
            // Return the ID of the newly inserted community message
            return $wpdb->insert_id;
        } else {
            // Return false if insertion failed
            return false;
        }
    }

    // Method to retrieve a community message by its ID
    public function get_community_message_by_id($data) {
        global $wpdb;

        $message_id = $data['message_id'];
        
        // Prepare SQL query to retrieve community message by ID
        $query = $wpdb->prepare(
            "SELECT * FROM $this->table_name WHERE id = %d",
            $message_id
        );

        // Execute the query
        $message = $wpdb->get_row($query);

        // Check if a message was found
        if ($message) {
            // Return message data as an object
            return $message;
        } else {
            // Return false if message not found
            return false;
        }
    }

    // Method to update a community message
    public function update_community_message($data) {
        global $wpdb;

        // Extract message ID from the data array
        $message_id = $data['message_id'];

        // Remove message_id from the data array to prevent updating it
        unset($data['message_id']);

        // Format the update data for the SQL query
        $update_data = [];
        foreach ($data as $key => $value) {
            $update_data[] = "$key = '$value'";
        }

        // Prepare SQL query to update community message data
        $query = $wpdb->prepare(
            "UPDATE $this->table_name SET " . implode(', ', $update_data) . " WHERE id = %d",
            $message_id // Message ID for the WHERE clause
        );

        // Execute the query and return true on success, false on failure
        return $wpdb->query($query) !== false;
    }

    // Method to delete a community message
    public function delete_community_message($data) {
        global $wpdb;

        $message_id = $data['message_id'];

        // Prepare SQL query to delete community message by ID
        $query = $wpdb->prepare("DELETE FROM $this->table_name WHERE id = %d", $message_id);

        // Execute the query and return true on success, false on failure
        return $wpdb->query($query) !== false;
    }

    // Method to retrieve all community messages
    public function get_all_community_messages() {
        global $wpdb;

        // Prepare SQL query to select all community messages
        $query = "SELECT * FROM $this->table_name";

        // Execute the query and fetch the results
        $messages = $wpdb->get_results($query, ARRAY_A);

        // Return the results if any, otherwise return null
        return !empty($messages) ? $messages : null;
    }

    // Method to retrieve community messages by member ID
    public function get_community_messages_by_member_id($data) {
        global $wpdb;
        
        $member_id = $data['member_id'];
        
        // Prepare SQL query to select community messages by member ID
        $query = $wpdb->prepare("SELECT * FROM $this->table_name WHERE community_member_id = %d", $member_id);

        // Execute the query and fetch the results
        $messages = $wpdb->get_results($query, ARRAY_A);

        // Return the results if any, otherwise return null
        return !empty($messages) ? $messages : null;
    }

    // Method to retrieve community messages by community ID
    public function get_community_messages_by_community_id($data) {
        global $wpdb;

        $community_id = $data['community_id'];

        // Prepare SQL query to select community messages by community ID
        $query = $wpdb->prepare("SELECT * FROM $this->table_name WHERE community_id = %d", $community_id);

        // Execute the query and fetch the results
        $messages = $wpdb->get_results($query, ARRAY_A);

        // Return the results if any, otherwise return null
        return !empty($messages) ? $messages : null;
    }
}

?>
