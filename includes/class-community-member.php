<?php

class CSVP_CommunityMember {
    // Properties
    private $table_name;

    // Constructor
    public function __construct() {
        global $wpdb;
        $this->table_name = $wpdb->prefix . 'csvp_community_member';
    }

    // Method to create a community member
    public function create_community_member($data) {
        global $wpdb;

        // Insert data into the database
        $wpdb->insert(
            $this->table_name,
            array(
                'is_active' => $data['is_active'],
                'community_id' => $data['community_id'],
                'full_name' => $data['full_name'],
                'phone_number' => $data['phone_number'],
                'email_address' => $data['email_address'],
                'lesson' => $data['lesson'],
                'id_number' => $data['id_number'],
                'address' => $data['address'],
                'magnetic_card_number_association' => $data['magnetic_card_number_association'],
                'card_balance' => $data['card_balance']
            )
        );

        // Check if the insertion was successful
        if ($wpdb->insert_id) {
            // Return the ID of the newly inserted community member
            return $wpdb->insert_id;
        } else {
            // Return false if insertion failed
            return false;
        }
    }

    // Method to get a community member by ID
    public function get_community_member_by_id($data) {
        global $wpdb;

        $community_member_id = $data['community_member_id'];
        
        // Prepare SQL query to retrieve community member by ID
        $query = $wpdb->prepare(
            "SELECT * FROM $this->table_name WHERE id = %d",
            $community_member_id
        );

        // Execute the query
        $community_member = $wpdb->get_row($query);

        // Check if a community member was found
        if ($community_member) {
            // Return community member data as an object
            return $community_member;
        } else {
            // Return false if community member not found
            return false;
        }
    }

    // Method to update a community member
    public function update_community_member($data) {
        global $wpdb;

        // Extract community member ID from the data array
        $community_member_id = $data['community_member_id'];

        // Remove community_member_id from the data array to prevent updating it
        unset($data['community_member_id']);

        // Format the update data for the SQL query
        $update_data = [];
        foreach ($data as $key => $value) {
            $update_data[] = "$key = '$value'";
        }

        // Prepare SQL query to update community member data
        $query = $wpdb->prepare(
            "UPDATE $this->table_name SET " . implode(', ', $update_data) . " WHERE id = %d",
            $community_member_id // Community member ID for the WHERE clause
        );

        // Execute the query and return true on success, false on failure
        return $wpdb->query($query) !== false;
    }

    // Method to delete a community member
    public function delete_community_member($data) {
        global $wpdb;

        $community_member_id = $data['community_member_id'];

        // Prepare SQL query to delete community member by ID
        $query = $wpdb->prepare("DELETE FROM $this->table_name WHERE id = %d", $community_member_id);

        // Execute the query and return true on success, false on failure
        return $wpdb->query($query) !== false;
    }

    // Method to get all community members
    public function get_all_community_members() {
        global $wpdb;

        // Prepare SQL query to select all community members
        $query = "SELECT * FROM $this->table_name";

        // Execute the query and fetch the results
        $community_members = $wpdb->get_results($query, ARRAY_A);

        // Return the results if any, otherwise return null
        return !empty($community_members) ? $community_members : null;
    }

    // Method to get community members by community ID
    public function get_community_members_by_community_id($data) {
        global $wpdb;

        $community_id = $data['community_id'];
        
        // Prepare SQL query to select community members by community ID
        $query = $wpdb->prepare("SELECT * FROM $this->table_name WHERE community_id = %d", $community_id);

        // Execute the query and fetch the results
        $community_members = $wpdb->get_results($query, ARRAY_A);

        // Return the results if any, otherwise return null
        return !empty($community_members) ? $community_members : null;
    }
    /**
     * Get balance by member ID.
     *
     * @param int $member_id The ID of the community member.
     * @return float|false Balance amount if found, false otherwise.
     */
    public function get_balance_by_member_id($member_id) {
        global $wpdb;

        $query = $wpdb->prepare(
            "SELECT balance_amount FROM $this->balance_table WHERE community_member_id = %d",
            $member_id
        );

        $balance = $wpdb->get_var($query);

        return $balance !== null ? (float) $balance : false;
    }

    /**
     * Update balance for a member.
     *
     * @param int $member_id The ID of the community member.
     * @param float $new_balance The new balance amount.
     * @return bool True if update successful, false otherwise.
     */
    public function update_balance($member_id, $new_balance) {
        global $wpdb;

        $result = $wpdb->update(
            $this->balance_table,
            array('balance_amount' => $new_balance),
            array('community_member_id' => $member_id)
        );

        return $result !== false;
    }

    /**
     * Get all balances.
     *
     * @return array|false Array of balance amounts if found, false otherwise.
     */
    public function get_all_balances() {
        global $wpdb;

        $query = "SELECT balance_amount FROM $this->balance_table";

        $balances = $wpdb->get_col($query);

        return $balances !== null ? array_map('floatval', $balances) : false;
    }
}

?>
