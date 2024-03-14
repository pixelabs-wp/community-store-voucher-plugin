<?php
class CSVP_JoiningRequest{
    // Properties
    private $table_name;
    private $community;
    // Constructor
    public function __construct() {
        global $wpdb;
        $this->table_name = $wpdb->prefix . 'csvp_joining_request';
        // $this->community = new CSVP_Community();
    }

    /**
     * Create a new joining request.
     *
     * @param array $data Associative array containing joining request data.
     * @return int|false The ID of the newly inserted joining request if successful, or false on failure.
     */
    public function create_joining_request($data) {
        global $wpdb;

        // Extract data from the input array
        $community_id = $data['community_id'];
        $store_id = $data['store_id'];
        $request_status = $data['request_status'];
        $requested_by = $data['requested_by'];


        // Insert data into the database
        $result = $wpdb->insert(
            $this->table_name,
            array(
                'community_id' => $community_id,
                'store_id' => $store_id,
                'request_status' => $request_status,
                'requested_by' => $requested_by,
                'credit_limit' => '10000'
            )
        );

        // Check if the insertion was successful
        if ($result) {
            // Return the ID of the newly inserted joining request
            // return $wpdb->insert_id;
            return array("status"=>true, "response"=>"Join Request Sent");
        } else {
        // Failed to move uploaded file
        return array("status" => false, "response" => "Something Went Wrong");
        }
    }

    /**
     * Update a joining request in the database based on its ID.
     *
     * @param int $request_id ID of the joining request to update.
     * @param array $data Associative array containing the updated joining request data.
     * @return bool True on success, false on failure.
     */
    public function update_joining_request($data) {
        global $wpdb;

        // Extract request ID from the data array
        $request_id = $data['request_id'];

        // Remove request_id from the data array to prevent updating it
        unset($data['request_id']);

        // Format the update data for the SQL query
        $update_data = [];
        foreach ($data as $key => $value) {
            $update_data[] = "$key = '$value'";
        }

        // Prepare SQL query to update joining request data
        $query = $wpdb->prepare(
            "UPDATE $this->table_name SET " . implode(', ', $update_data) . " WHERE id = %d",
            $request_id // Request ID for the WHERE clause
        );

        // Execute the query and return true on success, false on failure
        return $wpdb->query($query) !== false;
    }


    /**
     * Delete a joining request by its ID.
     *
     * @param int $request_id The ID of the joining request to delete.
     * @return bool True on success, false on failure.
     */
    public function delete_joining_request($request_id) {
        global $wpdb;

        // Perform the deletion
        $result = $wpdb->delete(
            $this->table_name,
            array('id' => $request_id)
        );

        // Return true if deletion successful, false otherwise
        return $result !== false;
    }

    /**
     * Retrieve all joining requests.
     *
     * @return array Array of joining request objects.
     */
    public function get_all_joining_requests($data)
    {
        global $wpdb;

        $where_conditions = array();
        if (isset($data["community_id"])) {
            $where_conditions[] = "community_id = '". $data["community_id"]."'";
        }
        if (isset($data["store_id"])) {
            $where_conditions[] = "store_id = '". $data['store_id']."'";
        }
        if (isset($data["status"])) {
            $where_conditions[] = "request_status = '".$data['status']."'";
        }

        $where_clause = !empty($where_conditions) ? "WHERE " . implode(" AND ", $where_conditions) : "";

        // Prepare and execute the query
        $query = "SELECT * FROM $this->table_name $where_clause";
        $results = $wpdb->get_results($query);

        foreach ($results as $key => $request) {
            $results["community_data"] = $this->community->get_community_member_by_id($request["community_id"]);
        }
        return $results;
    }


    /**
     * Retrieve joining requests by the user who made the request.
     *
     * @param string $requested_by The name of the user who made the request.
     * @return array Array of joining request objects.
     */
    public function get_joining_requests_by_requested_by($requested_by) {
        global $wpdb;

        // Prepare SQL query to retrieve joining requests by requested_by using LIKE operator
        $query = $wpdb->prepare(
            "SELECT * FROM $this->table_name WHERE requested_by LIKE %s",
            '%' . $wpdb->esc_like($requested_by) . '%'
        );

        // Retrieve matching joining requests
        $results = $wpdb->get_results($query);

        return $results;
    }

    /**
     * Retrieve joining requests by the user who made the request.
     *
     * @param string $requested_by The name of the user who made the request.
     * @return array Array of joining request objects.
     */
    public function get_joining_requests_by_community_id($community_id)
    {
        global $wpdb;

        // Prepare SQL query to retrieve joining requests by requested_by using LIKE operator
        $query = $wpdb->prepare(
            "SELECT * FROM $this->table_name WHERE community_id = %s",
            $community_id
        );

        // Retrieve matching joining requests
        $results = $wpdb->get_results($query);

        return $results;
    }

    public function set_credit_limit_by_store_manager($data) {
        global $wpdb;

        $credit_limit = $data['credit_limit'];
        $store_id = $data['store_id'];
        $community_id = $data['community_id'];

        $query = $wpdb->prepare(
            "UPDATE {$wpdb->prefix}csvp_joining_request 
            SET credit_limit = %d
            WHERE store_id = %d
            AND community_id = %d",
            $credit_limit,
            $store_id,
            $community_id
        );
        
        // Execute the query
        $result = $wpdb->query($query);
        
        // Check if the query was successful
        if ($result !== false) {
            // Check if any rows were affected (i.e., if the update actually happened)
            if ($result > 0) {
                // Update successful
                return array("status" => true, "response" => "Credit limit updated successfully.");
            } else {
                // No rows were affected, likely because no matching records were found
                return array("status" => false, "response" => "No matching records found for the provided store ID and community ID.");
            }
        } else {
            // Query execution failed
            return array("status" => false, "response" => "Failed to execute the update query.");
        }
    
    }


}
?>
