<?php
class CSVP_Community
{
    // Properties
    private $table_name;
    public $community_id;
    public $community_member;
    public $voucher;

    // Constructor
    public function __construct()
    {
        global $wpdb;
        $this->table_name = $wpdb->prefix . 'csvp_community';
        $this->community_member = new CSVP_CommunityMember();
        $this->voucher = new CSVP_VoucherTransaction();
    }

    public function render_dashboard(){
        $pageData["count_members"] = $this->community_member->get_community_members_by_community_id(array("community_id"=> $this->get_current_community_id(),"count"=>true));
        $pageData["redeemed_voucher"] = $this->voucher->get_all_voucher_transactions_by_community_id(array("community_id" => $this->get_current_community_id(), "status" => VOUCHER_STATUS_USED));
        CSVP_View_Manager::load_view('dashboard', $pageData);
    }

    public function render_manage_guys()
    {
        //Sample Post Request
        if (isset($_POST["csvp_request"]) && $_POST["csvp_request"] == "add_guy") {

            $payload = $_POST;
            if (!$this->community_member->get_community_member_by_email($payload)) {
                $payload["is_active"] = true;
                $payload["community_id"] = $this->get_current_community_id();
                $payload["card_balance"] = 0;
                $response = $this->community_member->create_community_member($payload);
                if ($response["status"] !== false) {
                    CSVP_Notification::add(CSVP_Notification::SUCCESS, $response["response"]);
                } else {
                    CSVP_Notification::add(CSVP_Notification::ERROR, $response["response"]);
                }
            } else {
                CSVP_Notification::add(CSVP_Notification::ERROR, 'Guy with this email already exists');
            }
        }

        // Load Data
        $members_data = $this->community_member->get_community_members_by_community_id(array('community_id' => $this->get_current_community_id()));
        $pageData["members"] = $members_data;

        CSVP_View_Manager::load_view('manage-guys', $pageData);
    }

    public static function render_messages()
    {
        CSVP_View_Manager::load_view('messages');
    }

    public static function render_transaction_history()
    {
        CSVP_View_Manager::load_view('transaction-history');
    }

    public function render_store_management()
    {
        global $store;

        $pageData = [];

        $joined_store = $store->get_all_joined_store_for_communities();
        $check_1["joined_store"] = $joined_store;
        if (!is_wp_error($check_1["joined_store"])) 
        {
            $pageData["joined_store"] = $joined_store;
        }

        $requested_stores = $store->get_all_requested_store_for_communities();
        $check_2["requested_stores"] = $requested_stores;
        if (!is_wp_error($check_2["requested_stores"])) 
        {
            $pageData["requested_stores"] = $requested_stores;
        }
        
        $not_requested_stores = $store->get_all_not_requested_store_for_communities();
        $check_3["not_requested_stores"] = $not_requested_stores;
        if (!is_wp_error($check_3["not_requested_stores"])) 
        {
            $pageData["not_requested_stores"] = $not_requested_stores;
        }
        
        CSVP_View_Manager::load_view('store-management', $pageData);

        // CSVP_View_Manager::load_view('store-management');
    }

    public static function render_order_management()
    {
        CSVP_View_Manager::load_view('order-management');
    }

    public static function render_coupon_management()
    {
        CSVP_View_Manager::load_view('coupon-management');
    }

    /**
     * Function to create a new community in the database.
     *
     * @param array $data An associative array containing community data.
     * @return int|WP_Error The ID of the newly inserted community if successful, or WP_Error on failure.
     */
    public function create_community($data)
    {
        global $wpdb;

        // Extract data from the input array
        $community_name = $data['community_name'];
        $community_manager_name = $data['community_manager_name'];
        $community_manager_phone = $data['community_manager_phone'];
        $community_mail_address = $data['community_mail_address'];
        $payment_link = $data['payment_link'];
        $api_valid = $data['api_valid'];
        $community_address = $data['community_address'];
        $username = $data['username'];
        $password = $data['password'];
        $commision_percentage = $data['commision_percentage'];


        if (!$this->get_community_by_email(array('email_address' => $community_mail_address))) {
            $email_exists = email_exists($community_mail_address);

            if (!$email_exists) {


            if (isset($_FILES['community_logo']) && $_FILES['community_logo']['error'] == UPLOAD_ERR_OK) {

                // Handle file upload
                $upload_dir = wp_upload_dir(); // Get the upload directory
                $file_name = basename($_FILES['community_logo']['name']);

                // Get the file extension
                $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);

                // Generate a unique identifier (timestamp or random string)
                $unique_identifier = uniqid(); // Using a timestamp-based unique identifier

                // Construct the file name with the extension
                $file_name = 'community_logo_' . $unique_identifier . '.' . $file_extension;


                // Check if the upload directory is writable
                $moved = move_uploaded_file($_FILES['community_logo']['tmp_name'], $upload_dir['path'] . '/' . $file_name);

                if ($moved) {

                    $file_path = $upload_dir['subdir'] . '/' . $file_name;

                    // Create WordPress user
                    $user_id = wp_create_user($username, $password, $community_mail_address);
                    $user_id_role = new WP_User($user_id);
                    $user_id_role->set_role(CSVP_User_Roles::ROLE_COMMUNITY_MANAGER);

                    // Insert data into the database
                    $insert_result = $wpdb->insert(
                        $this->table_name, // Table name
                        array(
                            'community_name' => $community_name,
                            'community_manager_name' => $community_manager_name,
                            'community_manager_phone' => $community_manager_phone,
                            'community_logo' => $file_path,
                            'community_mail_address' => $community_mail_address,
                            'community_address' => $community_address,
                            'wp_user_id' => $user_id,
                            'payment_link' => $payment_link,
                            'api_valid' => $api_valid,
                            'commision_percentage' => $commision_percentage,
                            'wp_user' => get_current_user_id()
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
            } else {
                return array("status" => false, "response" => "No Community image uploaded or error occurred");
            }
            }else{
              
                // Send error response
                return new WP_Error('request_error', __('Failed to create community. Email Already Exists', 'csvp'), array('status' => 500));
            }
        } else {
           
            // Send error response
            return new WP_Error('request_error', __('Failed to create community. Email Already Exists', 'csvp'), array('status' => 500));
        }
    }

    /**
     * Function to retrieve a community by its ID from the database.
     *
     * @param int $community_id The ID of the community to retrieve.
     * @return object|WP_Error Community data as an object if found, or WP_Error if not found.
     */
    public function get_community_by_id($community_id)
    {
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
     * Function to retrieve a community by its ID from the database.
     *
     * @param int $community_id The ID of the community to retrieve.
     * @return object|WP_Error Community data as an object if found, or WP_Error if not found.
     */
    public function get_community_by_user_id($user_id)
    {
        global $wpdb;

        // Prepare SQL query to retrieve community data by ID
        $query = $wpdb->prepare(
            "SELECT * FROM $this->table_name WHERE wp_user_id = %d",
            $user_id
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

    public function get_current_community_id()
    {

        if (CSVP_User_Roles::user_has_role(get_current_user_id(), CSVP_User_Roles::ROLE_COMMUNITY_MANAGER)) {
            $community_data = $this->get_community_by_user_id(get_current_user_id());
            return $community_data->id;
        } else if (CSVP_User_Roles::user_has_role(get_current_user_id(), CSVP_User_Roles::ROLE_COMMUNITY_MEMBER)) {
            $member_data = $this->community_member->get_community_member_by_user_id(array('wp_user_id' => get_current_user_id()));
            return $member_data->community_id;
        }
    }

    /**
     * Function to retrieve a community by its ID from the database.
     *
     * @param int $community_id The ID of the community to retrieve.
     * @return object|WP_Error Community data as an object if found, or WP_Error if not found.
     */
    public function get_community_by_email($data)
    {
        global $wpdb;

        $community_email = $data["email_address"];
        // Prepare SQL query to retrieve community data by ID
        $query = "SELECT * FROM $this->table_name WHERE community_mail_address = '$community_email'";

        // Execute the query
        $community = $wpdb->get_row($query);

        // Check if a community was found
        if ($community) {
            // Return community data as an object
            return $community;
        } else {
            // Send error response
            return false;
        }
    }


    /**
     * Function to retrieve communities by their name (partial or full match) from the database.
     *
     * @param string $community_name The name of the community to search for.
     * @return array|WP_Error Array of community objects matching the search criteria, or WP_Error on failure.
     */
    public function get_communities_by_name($community_name = "")
    {
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

    public function get_all_joined_communities_for_store()
    {
        global $wpdb, $store;
        $store_id = $store->get_store_id();
        // Prepare SQL query to retrieve communities by name using LIKE operator
        $query = $wpdb->prepare("
        SELECT 
            c.id AS community_id,
            c.community_name,
            COUNT(DISTINCT cm.id) AS active_members_count,
            SUM(o.order_total) AS total_order_amount
        FROM 
            {$wpdb->prefix}csvp_community c
        LEFT JOIN 
            {$wpdb->prefix}csvp_community_member cm ON c.id = cm.community_id AND cm.is_active = 1
        LEFT JOIN 
            {$wpdb->prefix}csvp_order o ON c.id = o.community_id
        INNER JOIN 
            {$wpdb->prefix}csvp_joining_request jr ON c.id = jr.community_id AND jr.store_id = $store_id AND jr.request_status = %s
        GROUP BY 
            c.id, c.community_name;
        ", JOINING_REQUEST_STATUS_APPROVED);

        $communities = $wpdb->get_results($query);

        // Check if communities were found
        if ($communities) {
            // Return array of community objects
            return $communities;
        } else {
            // Send error response
            return new WP_Error('not_found', __('No Joined communities.', 'csvp'), array('status' => 404));
        }
    }

    public function get_all_requested_communities_for_store()
    {
        global $wpdb, $store;
        $store_id = $store->get_store_id();
        // Prepare SQL query to retrieve communities by name using LIKE operator
        $query = $wpdb->prepare("
        SELECT 
            c.id AS community_id,
            c.community_name,
            COUNT(DISTINCT cm.id) AS active_members_count,
            SUM(o.order_total) AS total_order_amount
        FROM 
            {$wpdb->prefix}csvp_community c
        LEFT JOIN 
            {$wpdb->prefix}csvp_community_member cm ON c.id = cm.community_id AND cm.is_active = 1
        LEFT JOIN 
            {$wpdb->prefix}csvp_order o ON c.id = o.community_id
        INNER JOIN 
            {$wpdb->prefix}csvp_joining_request jr ON c.id = jr.community_id AND jr.store_id = $store_id AND jr.request_status = %s
        GROUP BY 
            c.id, c.community_name;
        ", JOINING_REQUEST_STATUS_PENDING);
        $communities = $wpdb->get_results($query);

        // Check if communities were found
        if ($communities) {
            // Return array of community objects
            return $communities;
        } else {
            // Send error response
            return new WP_Error('not_found', __('No Pending Request communities.', 'csvp'), array('status' => 404));
        }
    }

    public function get_all_not_requested_communities_for_store()
    {
        global $wpdb, $store;
        $store_id = $store->get_store_id();
        // Prepare SQL query to retrieve communities by name using LIKE operator
        $query = $wpdb->prepare("
            SELECT 
                c.id AS community_id,
                c.community_name,
                COUNT(DISTINCT cm.id) AS active_members_count,
                SUM(o.order_total) AS total_order_amount
            FROM 
                {$wpdb->prefix}csvp_community c
            LEFT JOIN 
                {$wpdb->prefix}csvp_community_member cm ON c.id = cm.community_id AND cm.is_active = 1
            LEFT JOIN 
                {$wpdb->prefix}csvp_order o ON c.id = o.community_id
            WHERE 
                c.id NOT IN (
                    SELECT jr.community_id
                    FROM {$wpdb->prefix}csvp_joining_request jr
                    WHERE jr.store_id = %d
                )
            GROUP BY 
                c.id, c.community_name;
        ", $store_id);

        $communities = $wpdb->get_results($query);

        // Check if communities were found
        if ($communities) {
            // Return array of community objects
            return $communities;
        } else {
            // Send error response
            return new WP_Error('not_found', __('No New communities.', 'csvp'), array('status' => 404));
        }
    }




    public function get_community_data_for_store_popup($data)
    {
        global $wpdb, $store;

        $community_id = $data['community_id'];
        $store_id = $store->get_store_id();

        $query = $wpdb->prepare(
            "SELECT c.*, jr.credit_limit 
            FROM $this->table_name c 
            LEFT JOIN {$wpdb->prefix}csvp_joining_request jr 
            ON c.id = jr.community_id 
            WHERE c.id = %d",
            $community_id
        );


        // Execute the query
        $community_data = $wpdb->get_results($query);

        // Check if communities were found
        if ($community_data) {
            // Return array of community objects
            return $community_data;
        } else {
            // Send error response
            return new WP_Error('not_found', __('No communities Data found.', 'csvp'), array('status' => 404));
        }
    }

    /**
     * Function to update a community in the database based on its ID.
     *
     * @param array $data Associative array containing the updated community data.
     * @return bool|WP_Error True on success, WP_Error on failure.
     */
    public function update_community($data)
    {
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
    public function delete_community($data)
    {
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
    public function get_all_communities($data = array())
    {
        global $wpdb;

        $count = isset($data["count"]) ? true : false;

        // Prepare SQL query to select all communities
        $query = "SELECT * FROM $this->table_name";

        // Execute the query and fetch the results
        $results = $wpdb->get_results($query, ARRAY_A);

        if ($count) {
            return $wpdb->num_rows;
        } else {
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
}
