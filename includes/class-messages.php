<?php

class CSVP_CommunityMessage{
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
        $to_id = $data['to_id'];
        $from_id = $data['from_id'];
        $to_user_role = $data['to_user_role'];
        $full_name = $data['full_name'];
        $phone_no = $data['phone_no'];
        $content = $data['content'];

        // Insert data into the database
        $wpdb->insert(
            $this->table_name,
            array(
                'to_id' => $to_id,
                'from_id' => $from_id,
                'to_user_role' => $to_user_role,
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

    public function get_all_community_messages_of_admin() {
        global $wpdb;
        $role = CSVP_User_Roles::ROLE_SYSTEM_ADMIN;
        // Prepare SQL query to select all community messages
        $query = $wpdb->prepare("SELECT * FROM $this->table_name where to_user_role = %s ",$role);

        // Execute the query and fetch the results
        $messages = $wpdb->get_results($query, ARRAY_A);

        // Return the results if any, otherwise return null
        return !empty($messages) ? $messages : null;
    }

    // Method to retrieve community messages by member ID
    public function get_community_messages_by_from_id($data) {
        global $wpdb;
        
        $member_id = $data['from_id'];
        
        // Prepare SQL query to select community messages by member ID
        $query = $wpdb->prepare("SELECT * FROM $this->table_name WHERE from_id = %d", $member_id);

        // Execute the query and fetch the results
        $messages = $wpdb->get_results($query, ARRAY_A);

        // Return the results if any, otherwise return null
        return !empty($messages) ? $messages : null;
    }

    // Method to retrieve community messages by community ID
    public function get_community_messages_by_to_id($data) {
        global $wpdb;

        $community_id = $data['to_id'];

        // Prepare SQL query to select community messages by community ID
        $query = $wpdb->prepare("SELECT * FROM $this->table_name WHERE to_id = %d", $community_id);

        // Execute the query and fetch the results
        $messages = $wpdb->get_results($query, ARRAY_A);

        // Return the results if any, otherwise return null
        return !empty($messages) ? $messages : null;
    }


    public function update_message_status($data) {
        global $wpdb;
    
        // Extract data from input array
        $message_id = isset($data['message_id']) ? (int)$data['message_id'] : 0;
        $new_status = isset($data['new_status']) ? $data['new_status'] : '';
    
        // Validate input data
        if ($message_id <= 0 || empty($new_status)) {
            // Invalid input data
            return "No Data";
        }
    
        // Prepare SQL query to update message status
        $query = $wpdb->prepare("UPDATE $this->table_name SET message_status = %s WHERE id = %d", $new_status, $message_id);
    
        // Execute the query
        $result = $wpdb->query($query);
    
        // Check if the query was successful
        if ($result !== false) {
            // Query executed successfully, check if rows were affected
            if ($result > 0) {
                // Rows were affected, update successful
                return "Updated";
            } else {
                // No rows were affected, message ID not found
                return "No data matched";
            }
        } else {
            // Query execution failed
            return "Update Fail";
        }
    }
    

    
}

?>
