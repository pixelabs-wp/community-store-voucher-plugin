<?php
class CSVP_Community{
    // Properties
    private $table_name;
    public $community_id;
    public $community_member;
    public $voucher;

    // Constructor
    public function __construct() {
        global $wpdb;
        $this->table_name = $wpdb->prefix . 'csvp_community';
        $this->community_id = get_current_user_id();
        $this->community_member = new CSVP_CommunityMember();
        $this->voucher = new CSVP_VoucherTransaction();
    }

    public function render_dashboard(){
        $pageData["count_members"] = $this->community_member->get_community_members_by_community_id(array("community_id"=> $this->community_id,"count"=>true));
        echo $pageData["redeemed_voucher"] = $this->voucher->get_all_voucher_transactions_by_community_id(array("community_id" => $this->community_id, "status" => VOUCHER_STATUS_USED));
        CSVP_View_Manager::load_view('dashboard', $pageData);
    }

    public function render_manage_guys(){
        //Sample Post Request
        if(isset($_POST["csvp_request"]) && $_POST["csvp_request"] == "add_guy"){

            $payload = $_POST;
            if(!$this->community_member->get_community_member_by_email($payload)){
                $payload["is_active"] = true;
                $payload["community_id"] = $this->community_id;
                $payload["community_id"] = $this->community_id;
                $payload["card_balance"] = 0;
                $response = $this->community_member->create_community_member($payload);
                if($response["status"] !== false){
                    CSVP_Notification::add(CSVP_Notification::SUCCESS, $response["response"]);
                } else {
                    CSVP_Notification::add(CSVP_Notification::ERROR, $response["response"]);
                }
            } else {
                CSVP_Notification::add(CSVP_Notification::ERROR, 'Guy with this email already exists');
            }
        }

        // Load Data
        $members_data = $this->community_member->get_community_members_by_community_id(array('community_id'=>$this->community_id));
        $pageData["members"] = $members_data;

        CSVP_View_Manager::load_view('manage-guys', $pageData);

    }

    public static function render_messages(){
        CSVP_View_Manager::load_view('messages');
    }

    public static function render_transaction_history(){
        CSVP_View_Manager::load_view('transaction-history');
    }

    public static function render_store_management(){
        CSVP_View_Manager::load_view('store-management');
    }

    public static function render_order_management(){
        CSVP_View_Manager::load_view('order-management');
    }

    public static function render_coupon_management(){
        CSVP_View_Manager::load_view('coupon-management');
    }
    
    /**
     * Function to create a new community in the database.
     *
     * @param array $data An associative array containing community data.
     * @return int|WP_Error The ID of the newly inserted community if successful, or WP_Error on failure.
     */
    public function create_community($data) {
        global $wpdb;

        // Extract data from the input array
        $community_name = $data['community_name'];
        $community_manager_name = $data['community_manager_name'];
        $community_manager_phone = $data['community_manager_phone'];
        $community_logo = $data['community_logo'];
        $community_mail_address = $data['community_mail_address'];
        $wp_user_id = $data['wp_user_id'];
        $payment_link = $data['payment_link'];

        // Insert data into the database
        $insert_result = $wpdb->insert(
            $this->table_name, // Table name
            array(
                'community_name' => $community_name,
                'community_manager_name' => $community_manager_name,
                'community_manager_phone' => $community_manager_phone,
                'community_logo' => $community_logo,
                'community_mail_address' => $community_mail_address,
                'wp_user_id' => $wp_user_id,
                'payment_link' => $payment_link
            ) // Data to be inserted
        );

        // Check if the insertion was successful
        if ($insert_result) {
            // Return the ID of the newly inserted community
            return $wpdb->insert_id;
        } else {
            // Send error response
            return new WP_Error('database_error', __('Failed to create community.', 'csvp'), array('status' => 500));
        }
    }

    /**
     * Function to retrieve a community by its ID from the database.
     *
     * @param int $community_id The ID of the community to retrieve.
     * @return object|WP_Error Community data as an object if found, or WP_Error if not found.
     */
    public function get_community_by_id($community_id) {
        global $wpdb;

        // Prepare SQL query to retrieve community data by ID
        $query = $wpdb->prepare(
            "SELECT * FROM $this->table_name WHERE id = %d",
            $community_id
        );

        // Execute the query
        $community = $wpdb->get_row($query);

        // Check if a community was found
        if ($community) {
            // Return community data as an object
            return $community;
        } else {
            // Send error response
            return new WP_Error('not_found', __('Community not found.', 'csvp'), array('status' => 404));
        }
    }

    /**
     * Function to retrieve communities by their name (partial or full match) from the database.
     *
     * @param string $community_name The name of the community to search for.
     * @return array|WP_Error Array of community objects matching the search criteria, or WP_Error on failure.
     */
    public function get_communities_by_name($community_name) {
        global $wpdb;

        // Prepare SQL query to retrieve communities by name using LIKE operator
        $query = $wpdb->prepare(
            "SELECT * FROM $this->table_name WHERE community_name LIKE %s",
            '%' . $wpdb->esc_like($community_name) . '%'
        );

        // Execute the query
        $communities = $wpdb->get_results($query);

        // Check if communities were found
        if ($communities) {
            // Return array of community objects
            return $communities;
        } else {
            // Send error response
            return new WP_Error('not_found', __('No communities found.', 'csvp'), array('status' => 404));
        }
    }

    /**
     * Function to update a community in the database based on its ID.
     *
     * @param array $data Associative array containing the updated community data.
     * @return bool|WP_Error True on success, WP_Error on failure.
     */
    public function update_community($data) {
        global $wpdb;

        // Extract community ID from the data array
        $community_id = $data['community_id'];

        // Remove community_id from the data array to prevent updating it
        unset($data['community_id']);

        // Format the update data for the SQL query
        $update_data = [];
        foreach ($data as $key => $value) {
            $update_data[] = "$key = '$value'";
        }

        // Prepare SQL query to update community data
        $query = $wpdb->prepare(
            "UPDATE $this->table_name SET " . implode(', ', $update_data) . " WHERE id = %d",
            $community_id // Community ID for the WHERE clause
        );

        // Execute the query
        $update_result = $wpdb->query($query);

        // Check if the update was successful
        if ($update_result !== false) {
            // Send success response
            return true;
        } else {
            // Send error response
            return new WP_Error('database_error', __('Failed to update community.', 'csvp'), array('status' => 500));
        }
    }


    /**
     * Function to delete a community from the database based on its ID.
     *
     * @param array $data Associative array containing the community ID.
     * @return bool|WP_Error True on success, WP_Error on failure.
     */
    public function delete_community($data) {
        global $wpdb;

        $community_id = $data['community_id'];

        // Prepare SQL query to delete community by ID
        $query = $wpdb->prepare("DELETE FROM $this->table_name WHERE id = %d", $community_id);

        // Execute the query
        $delete_result = $wpdb->query($query);

        // Check if the deletion was successful
        if ($delete_result !== false) {
            // Send success response
            return true;
        } else {
            // Send error response
            return new WP_Error('database_error', __('Failed to delete community.', 'csvp'), array('status' => 500));
        }
    }


    /**
     * Function to retrieve all communities from the database.
     *
     * @return array|WP_Error Array of communities on success, WP_Error on failure.
     */
    public function get_all_communities() {
        global $wpdb;

        // Prepare SQL query to select all communities
        $query = "SELECT * FROM $this->table_name";

        // Execute the query and fetch the results
        $results = $wpdb->get_results($query, ARRAY_A);

        // Check if communities were found
        if ($results) {
            // Return the results
            return $results;
        } else {
            // Send error response
            return new WP_Error('not_found', __('No communities found.', 'csvp'), array('status' => 404));
        }
    }

}
