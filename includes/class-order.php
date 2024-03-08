<?php
class CSVP_Order {
    // Properties
    private $table_name;

    // Constructor
    public function __construct() {
        global $wpdb;
        $this->table_name = $wpdb->prefix . 'csvp_order';
    }

    /**
     * Function to create a new order in the database.
     *
     * @param array $data An associative array containing order data.
     * @return int|false The ID of the newly inserted order if successful, or false on failure.
     */
    public function create_order($data) {
        global $wpdb;

        // Extract data from the input array
        $community_id = $data['community_id'];
        $store_id = $data['store_id'];
        $order_status = $data['order_status'];
        $order_total = $data['order_total'];
        $order_date = isset($data['order_date']) ? $data['order_date'] : current_time('mysql');

        // Insert data into the database
        $wpdb->insert(
            $this->table_name, // Table name
            array(
                'community_id' => $community_id,
                'store_id' => $store_id,
                'order_status' => $order_status,
                'order_total' => $order_total,
                'order_date' => $order_date
            ) // Data to be inserted
        );

        // Check if the insertion was successful
        if ($wpdb->insert_id) {
            // Return the ID of the newly inserted order
            return $wpdb->insert_id;
        } else {
            // Return false if insertion failed
            return false;
        }
    }

    /**
     * Function to retrieve an order by its ID from the database.
     *
     * @param int $order_id The ID of the order to retrieve.
     * @return object|false Order data as an object if found, or false if not found.
     */
    public function get_order_by_id($data) {
        global $wpdb;
        $order_id = $data['order_id'];
        // Prepare SQL query to retrieve order data by ID
        $query = $wpdb->prepare(
            "SELECT * FROM $this->table_name WHERE id = %d",
            $order_id
        );

        // Execute the query
        $order = $wpdb->get_row($query);

        // Check if an order was found
        if ($order) {
            // Return order data as an object
            return $order;
        } else {
            // Return false if order not found
            return false;
        }
    }

    /**
     * Function to update an order in the database based on its ID.
     *
     * @param int $order_id ID of the order to update.
     * @param array $data Associative array containing the updated order data.
     * @return bool True on success, false on failure.
     */
    public function update_order($data) {
        global $wpdb;
        $order_id = $data['order_id'];

        // Extract order ID from the data array
        unset($data['order_id']);

        // Format the update data for the SQL query
        $update_data = [];
        foreach ($data as $key => $value) {
            $update_data[] = "$key = '$value'";
        }

        // Prepare SQL query to update order data
        $query = $wpdb->prepare(
            "UPDATE $this->table_name SET " . implode(', ', $update_data) . " WHERE id = %d",
            $order_id // Order ID for the WHERE clause
        );

        // Execute the query and return true on success, false on failure
        return $wpdb->query($query) !== false;
    }

    /**
     * Function to delete an order from the database based on its ID.
     *
     * @param int $order_id ID of the order to delete.
     * @return bool True on success, false on failure.
     */
    public function delete_order($data) {
        global $wpdb;
        
        $order_id = $data['order_id'];

        // Prepare SQL query to delete order by ID
        $query = $wpdb->prepare("DELETE FROM $this->table_name WHERE id = %d", $order_id);

        // Execute the query and return true on success, false on failure
        return $wpdb->query($query) !== false;
    }

    /**
     * Function to retrieve all orders from the database.
     *
     * @return array|null Array of orders on success, null on failure.
     */
    public function get_all_orders() {
        global $wpdb;

        // Prepare SQL query to select all orders
        $query = "SELECT * FROM $this->table_name";

        // Execute the query and fetch the results
        $results = $wpdb->get_results($query, ARRAY_A);

        // Return the results if any, otherwise return null
        return !empty($results) ? $results : null;
    }

    /**
     * Function to retrieve orders by community ID from the database.
     *
     * @param int $community_id The ID of the community to retrieve orders for.
     * @return array|null Array of orders for the specified community on success, null on failure.
     */
    public function get_orders_by_community_id($data) {
        global $wpdb;

        $community_id = $data['community_id'];

        // Prepare SQL query to select orders by community ID
        $query = $wpdb->prepare(
            "SELECT * FROM $this->table_name WHERE community_id = %d",
            $community_id
        );

        // Execute the query and fetch the results
        $results = $wpdb->get_results($query, ARRAY_A);

        // Return the results if any, otherwise return null
        return !empty($results) ? $results : null;
    }

    /**
     * Function to retrieve orders by store ID from the database.
     *
     * @param int $store_id The ID of the store to retrieve orders for.
     * @return array|null Array of orders for the specified store on success, null on failure.
     */
    public function get_orders_by_store_id($data) {
        global $wpdb;

        $store_id = $data['store_id'];

        // Prepare SQL query to select orders by store ID
        $query = $wpdb->prepare(
            "SELECT * FROM $this->table_name WHERE store_id = %d",
            $store_id
        );

        // Execute the query and fetch the results
        $results = $wpdb->get_results($query, ARRAY_A);

        // Return the results if any, otherwise return null
        return !empty($results) ? $results : null;
    }
}
