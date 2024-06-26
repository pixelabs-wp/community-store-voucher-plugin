<?php
class CSVP_Commission{
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
        $commission_status = $data['commission_status'];

        // Insert data into the database
        $wpdb->insert(
            $this->table_name, // Table name
            array(
                'entity_id' => $entity_id,
                'entity_type' => $entity_type,
                'commission_type' => $commission_type,
                'commission_value' => $commission_value,
                'commission_status' => $commission_status
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
     * @param array $data Associative array containing the updated commission data,
     *                    including 'month', 'year', 'status', 'entity_type', and 'entity_id' keys.
     * @return bool True on success, false on failure.
     */
    public function update_commission($data)
    {
        global $wpdb;

        // Remove commission_id and month, year, status, entity_type, entity_id from the data array to prevent updating them
        $month = $data['month'];
        $year = $data['year'];
        $status = $data['status'];
        $entity_type = $data['entity_type'];
        $entity_id = $data['entity_id'];
        unset($data['month'], $data['year'], $data['status'], $data['entity_type'], $data['entity_id']);

        // Add condition to set commission_status to the provided status where month, year, entity_type, and entity_id match
        $data['commission_status'] = "CASE WHEN MONTH(created_at) = $month AND YEAR(created_at) = $year AND entity_type = '$entity_type' AND entity_id = $entity_id THEN '$status' ELSE commission_status END";

        // Format the update data for the SQL query
        $update_data = [];
        foreach ($data as $key => $value) {
            $update_data[] = "$key = $value";
        }

        // Prepare SQL query to update commission data
        $query = "UPDATE $this->table_name SET " . implode(', ', $update_data);

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
     * Function to retrieve commissions by type from the database.
     *
     * @param string $commission_type The type of commission to search for.
     * @return array|null Array of commissions matching the search criteria on success, null on failure.
     */
    public function get_entity_commissions($entity_type)
    {
        global $wpdb;

        // $entity_type = $data["entity_type"];

        // Prepare SQL query to retrieve commissions by type
        $query = $wpdb->prepare(
            "SELECT *, YEAR(created_at) AS year,
    MONTH(created_at) AS month,
    SUM(commission_value) AS total_commision,
    COUNT(*) AS total_loads FROM $this->table_name WHERE entity_type = %s GROUP BY 
    entity_id,
    YEAR(created_at),
    MONTH(created_at)
    ",
            $entity_type
        );
        // Execute the query and fetch the results
        $results = $wpdb->get_results($query, ARRAY_A);

        // Return the results if any, otherwise return null
        return !empty($results) ? $results : array();
    }

    /**
     * Function to retrieve commissions by community name (partial or full match) from the database.
     *
     * @param string $community_name The name of the community to search for.
     * @return array|null Array of commissions matching the search criteria on success, null on failure.
     */
    public function get_commissions_by_entity_id($entity_id, $entity_role) {
        global $wpdb;

        // Prepare SQL query to retrieve commissions by community name using LIKE operator
        $query = $wpdb->prepare("SELECT * FROM $this->table_name WHERE entity_id = %s AND entity_type = %s", $entity_id, $entity_role);

        // Execute the query and fetch the results
        $results = $wpdb->get_results($query, ARRAY_A);

        // Return the results if any, otherwise return null
        return $results;
    }


    /**
     * Function to retrieve commissions by community name (partial or full match) from the database.
     *
     * @param string $community_name The name of the community to search for.
     * @return array|null Array of commissions matching the search criteria on success, null on failure.
     */
    public function get_due_commision($entity_id, $entity_role, $status)
    {
        global $wpdb;

        // Prepare SQL query to retrieve commissions by community name using LIKE operator
        $query = $wpdb->prepare("SELECT * FROM $this->table_name WHERE entity_id = %s AND entity_type = %s AND commission_status = %s", $entity_id, $entity_role, $status);

        // Execute the query and fetch the results
        $results = $wpdb->get_results($query, ARRAY_A);

        // Return the results if any, otherwise return null
        return $results;
    }

}
