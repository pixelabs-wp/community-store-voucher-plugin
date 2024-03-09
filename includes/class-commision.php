<?php
class CSVP_Commission extends CSVP_Base{
    // Properties
    private $table_name;

    // Constructor
    public function __construct() {
        global $wpdb;
        $this->table_name = $wpdb->prefix . 'csvp_commission';
    }

    /**
     * Function to create a new commission in the database.
     *
     * @param array $data An associative array containing commission data.
     * @return int|false The ID of the newly inserted commission if successful, or false on failure.
     */
    public function create_commission($data) {
        global $wpdb;

        // Extract data from the input array
        $entity_id = $data['entity_id'];
        $entity_type = $data['entity_type'];
        $commission_type = $data['commission_type'];
        $commission_value = $data['commission_value'];

        // Insert data into the database
        $wpdb->insert(
            $this->table_name, // Table name
            array(
                'entity_id' => $entity_id,
                'entity_type' => $entity_type,
                'commission_type' => $commission_type,
                'commission_value' => $commission_value
            ) // Data to be inserted
        );

        // Check if the insertion was successful
        if ($wpdb->insert_id) {
            // Return the ID of the newly inserted commission
            return $wpdb->insert_id;
        } else {
            // Send error response
            return false;
        }
    }

    /**
     * Function to retrieve a commission by its ID from the database.
     *
     * @param int $commission_id The ID of the commission to retrieve.
     * @return object|false Commission data as an object if found, or false if not found.
     */
    public function get_commission_by_id($commission_id) {
        global $wpdb;

        // Prepare SQL query to retrieve commission data by ID
        $query = $wpdb->prepare(
            "SELECT * FROM $this->table_name WHERE id = %d",
            $commission_id
        );

        // Execute the query
        $commission = $wpdb->get_row($query);

        // Check if a commission was found
        if ($commission) {
            // Return commission data as an object
            return $commission;
        } else {
            // Send error response
            return false;
        }
    }

    /**
     * Function to update a commission in the database based on its ID.
     *
     * @param array $data Associative array containing the updated commission data.
     * @return bool True on success, false on failure.
     */
    public function update_commission($data) {
        global $wpdb;

        // Extract commission ID from the data array
        $commission_id = $data['commission_id'];

        // Remove commission_id from the data array to prevent updating it
        unset($data['commission_id']);

        // Format the update data for the SQL query
        $update_data = [];
        foreach ($data as $key => $value) {
            $update_data[] = "$key = '$value'";
        }

        // Prepare SQL query to update commission data
        $query = $wpdb->prepare(
            "UPDATE $this->table_name SET " . implode(', ', $update_data) . " WHERE id = %d",
            $commission_id // Commission ID for the WHERE clause
        );

        // Execute the query and return true on success, false on failure
        $result = $wpdb->query($query);
        if ($result !== false) {
            return true;
        } else {
            // Send error response
            return false;
        }
    }

    /**
     * Function to delete a commission from the database based on its ID.
     *
     * @param int $commission_id ID of the commission to delete.
     * @return bool True on success, false on failure.
     */
    public function delete_commission($commission_id) {
        global $wpdb;

        // Prepare SQL query to delete commission by ID
        $query = $wpdb->prepare("DELETE FROM $this->table_name WHERE id = %d", $commission_id);

        // Execute the query and return true on success, false on failure
        $result = $wpdb->query($query);
        if ($result !== false) {
            return true;
        } else {
            // Send error response
            return false;
        }
    }

        /**
     * Function to retrieve all commissions from the database.
     *
     * @return array|null Array of commissions on success, null on failure.
     */
    public function get_all_commissions() {
        global $wpdb;

        // Prepare SQL query to select all commissions
        $query = "SELECT * FROM $this->table_name";

        // Execute the query and fetch the results
        $results = $wpdb->get_results($query, ARRAY_A);

        // Return the results if any, otherwise return null
        return !empty($results) ? $results : null;
    }

    /**
     * Function to retrieve commissions by type from the database.
     *
     * @param string $commission_type The type of commission to search for.
     * @return array|null Array of commissions matching the search criteria on success, null on failure.
     */
    public function get_commissions_by_type($commission_type) {
        global $wpdb;

        // Prepare SQL query to retrieve commissions by type
        $query = $wpdb->prepare(
            "SELECT * FROM $this->table_name WHERE commission_type = %s",
            $commission_type
        );

        // Execute the query and fetch the results
        $results = $wpdb->get_results($query, ARRAY_A);

        // Return the results if any, otherwise return null
        return !empty($results) ? $results : null;
    }

    /**
     * Function to retrieve commissions by community name (partial or full match) from the database.
     *
     * @param string $community_name The name of the community to search for.
     * @return array|null Array of commissions matching the search criteria on success, null on failure.
     */
    public function get_commissions_by_entity_id($entity_id) {
        global $wpdb;

        // Prepare SQL query to retrieve commissions by community name using LIKE operator
        $query = $wpdb->prepare("SELECT * FROM $this->table_name WHERE entity_id = %s", $entity_id);

        // Execute the query and fetch the results
        $results = $wpdb->get_results($query, ARRAY_A);

        // Return the results if any, otherwise return null
        return $results;
    }
}
