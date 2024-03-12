<?php

class CSVP_CommunityMember {
    // Properties
    private $table_name;
    private $joining_request;
    public $community_member_user;
    // Constructor
    public function __construct() {
        global $wpdb;
        $this->table_name = $wpdb->prefix . 'csvp_community_member';
        $this->joining_request = new CSVP_JoiningRequest();
        $this->community_member_user = $this->get_community_member_by_user_id(array('wp_user_id'=> get_current_user_id()));
    }

    //Method to render transaction history
    public static function render_transaction_history(){
        CSVP_View_Manager::load_view('transaction-history');
    }

    public static function render_loading_history(){
        CSVP_View_Manager::load_view('loading-history');
    }

    public static function render_load_card(){
        CSVP_View_Manager::load_view('load-card');
    }

    public static function render_coupons(){
        CSVP_View_Manager::load_view('coupons');
    }
    
    public function render_shops(){
        $shops = $this->joining_request->get_all_joining_requests(array(
                "community_id" => $this->community_member_user->community_id,
                "status"=> JOINING_REQUEST_STATUS_APPROVED
        ));
        $pageData["shops"] = $shops;
        CSVP_View_Manager::load_view('shops', $pageData);
    }

    // Method to create a community member
    public function create_community_member($data) {
        global $wpdb;

        // Create WordPress user
        $user_id = wp_create_user($data['email_address'], wp_generate_password(), $data['email_address']);
        $user_id_role = new WP_User($user_id);
        $user_id_role->set_role(CSVP_User_Roles::ROLE_COMMUNITY_MEMBER);
        if (!is_wp_error($user_id)) {
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
                    'card_balance' => $data['card_balance'],
                    'wp_user_id' => $user_id // Pass WordPress user ID
                )
            );

            // Check if the insertion was successful
            if ($wpdb->insert_id) {
                // Return the ID of the newly inserted community member
                return array("status"=>true, "response"=>"Guy created successfully: ".$data["full_name"]);

            } else {
                $error_message = $wpdb->last_error;
                // Delete user if insertion failed
                wp_delete_user($user_id);
                return array("status"=>false, "response"=>$error_message);
            }
        } else {
            if (is_wp_error($user_id)) {
                // Error occurred during user creation
                $error_message = $user_id->get_error_message();
                return array("status"=>false, "response"=>$error_message);
            } else {
                return array("status"=>false, "response"=>"Something Went Wrong");
            }
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

    // Method to get a community member by ID
    public function get_community_member_by_user_id($data)
    {
        global $wpdb;

        $wp_user_id = $data['wp_user_id'];

        // Prepare SQL query to retrieve community member by ID
        $query = $wpdb->prepare(
            "SELECT * FROM $this->table_name WHERE wp_user_id = %d",
            $wp_user_id
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


    // // Method to get a community member by ID
    // public function get_current_user()
    // {
    //     global $wpdb;

    //     $community_member_id = get_current_user_id();


    //     $member_data = get_community_member_by_user_id(array('user_id' => $community_member_id)) ? get_community_member_by_user_id(array('user_id' => $community_member_id)) : null;
    //     $member_data = get_community_member_by_user_id(array('user_id'=> $community_member_id)) ? get_community_member_by_user_id(array('user_id' => $community_member_id)) : null;
        
        

    //     // Prepare SQL query to retrieve community member by ID
    //     $query = $wpdb->prepare(
    //         "SELECT * FROM $this->table_name WHERE id = %d",
    //         $community_member_id
    //     );

    //     // Execute the query
    //     $community_member = $wpdb->get_row($query);

    //     // Check if a community member was found
    //     if ($community_member) {
    //         // Return community member data as an object
    //         return $community_member;
    //     } else {
    //         // Return false if community member not found
    //         return false;
    //     }
    // }

        // Method to get a community member by ID
    public function get_community_member_by_email($data) {
        global $wpdb;

        $email_address = $data['email_address'];
        
        // Prepare SQL query to retrieve community member by ID
        $query = $wpdb->prepare(
            "SELECT * FROM $this->table_name WHERE email_address = %s",
            $email_address
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
        $count = isset($data["count"]) ? true : false;
        
        // Prepare SQL query to select community members by community ID
        $query = $wpdb->prepare("SELECT * FROM $this->table_name WHERE community_id = %d", $community_id);

        // Execute the query and fetch the results
        $community_members = $wpdb->get_results($query, ARRAY_A);
        if($count){
            return $wpdb->num_rows;
        } else {
            // Return the results if any, otherwise return null
            return !empty($community_members) ? $community_members : null;
        }
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
