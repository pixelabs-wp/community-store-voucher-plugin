<?php

class CSVP_WalkOrder {
    // Properties
    private $table_name;

    // Constructor
    public function __construct() {
        global $wpdb;
        $this->table_name = $wpdb->prefix . 'csvp_walk_order';
    }

    // Method to create a walk order
    public function create_walk_order($data) {
        global $wpdb;

        // Extract data from the input array
        $community_member_id = $data['community_member_id'];
        $store_id = $data['store_id'];
        $order_status = $data['order_status'];
        $order_type = $data['order_type'];
        $payment_link = $data['payment_link'];

        // Insert data into the database
        $wpdb->insert(
            $this->table_name,
            array(
                'community_member_id' => $community_member_id,
                'store_id' => $store_id,
                'order_status' => $order_status,
                'order_type' => $order_type,
                'payment_link' => $payment_link
            )
        );

        // Check if the insertion was successful
        if ($wpdb->insert_id) {
            // Return the ID of the newly inserted walk order
            return $wpdb->insert_id;
        } else {
            // Return false if insertion failed
            return false;
        }
    }

    // Method to get walk order by ID
    public function get_walk_order_by_id($data) {
        global $wpdb;

        $walk_order_id = $data['walk_order_id'];
        
        // Prepare SQL query to retrieve walk order by ID
        $query = $wpdb->prepare(
            "SELECT * FROM $this->table_name WHERE id = %d",
            $walk_order_id
        );

        // Execute the query
        $walk_order = $wpdb->get_row($query);

        // Check if a walk order was found
        if ($walk_order) {
            // Return walk order data as an object
            return $walk_order;
        } else {
            // Return false if walk order not found
            return false;
        }
    }

    // Method to update a walk order
    public function update_walk_order($data) {
        global $wpdb;

        // Extract walk order ID from the data array
        $walk_order_id = $data['walk_order_id'];

        // Remove walk_order_id from the data array to prevent updating it
        unset($data['walk_order_id']);

        // Format the update data for the SQL query
        $update_data = [];
        foreach ($data as $key => $value) {
            $update_data[] = "$key = '$value'";
        }

        // Prepare SQL query to update walk order data
        $query = $wpdb->prepare(
            "UPDATE $this->table_name SET " . implode(', ', $update_data) . " WHERE id = %d",
            $walk_order_id // Walk order ID for the WHERE clause
        );

        // Execute the query and return true on success, false on failure
        return $wpdb->query($query) !== false;
    }

    // Method to delete a walk order
    public function delete_walk_order($data) {
        global $wpdb;

        $walk_order_id = $data['walk_order_id'];

        // Prepare SQL query to delete walk order by ID
        $query = $wpdb->prepare("DELETE FROM $this->table_name WHERE id = %d", $walk_order_id);

        // Execute the query and return true on success, false on failure
        return $wpdb->query($query) !== false;
    }

    // Method to get all walk orders
    public function get_all_walk_orders() {
        global $wpdb;

        // Prepare SQL query to select all walk orders
        $query = "SELECT * FROM $this->table_name";

        // Execute the query and fetch the results
        $walk_orders = $wpdb->get_results($query, ARRAY_A);

        // Return the results if any, otherwise return null
        return !empty($walk_orders) ? $walk_orders : null;
    }

    // Method to get walk orders by community ID
    public function get_walk_orders_by_community_member_id($data) {
        global $wpdb;
        
        $community_member_id = $data['community_member_id'];
        
        // Prepare SQL query to select walk orders by community ID
        $query = $wpdb->prepare("SELECT * FROM $this->table_name WHERE community_member_id = %d", $community_member_id);

        // Execute the query and fetch the results
        $walk_orders = $wpdb->get_results($query, ARRAY_A);

        // Return the results if any, otherwise return null
        return !empty($walk_orders) ? $walk_orders : null;
    }

    // Method to get walk orders by store ID
    public function get_walk_orders_by_store_id($data) {
        global $wpdb;

        $store_id = $data['store_id'];

        // Prepare SQL query to select walk orders by store ID
        $query = $wpdb->prepare("SELECT * FROM $this->table_name WHERE store_id = %d", $store_id);

        // Execute the query and fetch the results
        $walk_orders = $wpdb->get_results($query, ARRAY_A);

        // Return the results if any, otherwise return null
        return !empty($walk_orders) ? $walk_orders : null;
    }
}

?>
