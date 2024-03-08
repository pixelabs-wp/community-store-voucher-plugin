<?php
class CSVPC_Transaction {
    // Properties
    private $table_name;

    // Constructor
    public function __construct() {
        global $wpdb;
        $this->table_name = $wpdb->prefix . 'csvp_transaction';
    }

    /**
     * Function to create a new transaction in the database.
     *
     * @param array $data An associative array containing transaction data.
     * @return int|false The ID of the newly inserted transaction if successful, or false on failure.
     */
    public function create_transaction($data) {
        global $wpdb;

        // Extract data from the input array
        $community_id = $data['community_id'];
        $store_id = $data['store_id'];
        $transaction_type = $data['transaction_type'];
        $transaction_amount = $data['transaction_amount'];
        $transaction_date = isset($data['transaction_date']) ? $data['transaction_date'] : current_time('mysql');

        // Insert data into the database
        $wpdb->insert(
            $this->table_name, // Table name
            array(
                'community_id' => $community_id,
                'store_id' => $store_id,
                'transaction_type' => $transaction_type,
                'transaction_amount' => $transaction_amount,
                'transaction_date' => $transaction_date
            ) // Data to be inserted
        );

        // Check if the insertion was successful
        if ($wpdb->insert_id) {
            // Return the ID of the newly inserted transaction
            return $wpdb->insert_id;
        } else {
            // Return false if insertion failed
            return false;
        }
    }

    public function get_transaction_by_id($transaction_id) {
        global $wpdb;

        // Prepare SQL query to retrieve transaction data by ID
        $query = $wpdb->prepare(
            "SELECT * FROM $this->table_name WHERE id = %d",
            $transaction_id
        );

        // Execute the query
        $transaction = $wpdb->get_row($query);

        // Check if a transaction was found
        if ($transaction) {
            // Return transaction data as an object
            return $transaction;
        } else {
            // Return false if transaction not found
            return false;
        }
    }

    public function update_transaction($transaction_id, $data) {
        global $wpdb;

        // Extract transaction ID from the data array
        $transaction_id = $data['transaction_id'];

        // Remove transaction_id from the data array to prevent updating it
        unset($data['transaction_id']);

        // Format the update data for the SQL query
        $update_data = [];
        foreach ($data as $key => $value) {
            $update_data[] = "$key = '$value'";
        }

        // Prepare SQL query to update transaction data
        $query = $wpdb->prepare(
            "UPDATE $this->table_name SET " . implode(', ', $update_data) . " WHERE id = %d",
            array_values($data), // Values to be replaced in the query
            $transaction_id // Transaction ID for the WHERE clause
        );

        // Execute the query and return true on success, false on failure
        return $wpdb->query($query) !== false;
    }

    public function delete_transaction($transaction_id) {
        global $wpdb;

        // Prepare SQL query to delete transaction by ID
        $query = $wpdb->prepare("DELETE FROM $this->table_name WHERE id = %d", $transaction_id);

        // Execute the query and return true on success, false on failure
        return $wpdb->query($query) !== false;
    }

    public function get_all_transactions() {
        global $wpdb;

        // Prepare SQL query to select all transactions
        $query = "SELECT * FROM $this->table_name";

        // Execute the query and fetch the results
        $results = $wpdb->get_results($query, ARRAY_A);

        // Return the results if any, otherwise return null
        return !empty($results) ? $results : null;
    }

    public function get_transactions_by_community_id($community_id) {
        global $wpdb;

        // Prepare SQL query to select transactions by community ID
        $query = $wpdb->prepare(
            "SELECT * FROM $this->table_name WHERE community_id = %d",
            $community_id
        );

        // Execute the query and fetch the results
        $results = $wpdb->get_results($query, ARRAY_A);

        // Return the results if any, otherwise return null
        return !empty($results) ? $results : null;
    }

    public function get_transactions_by_store_id($store_id) {
        global $wpdb;

        // Prepare SQL query to select transactions by store ID
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