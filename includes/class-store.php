<?php
class CSVP_Store
{
    // Properties
    private $table_name;
    public $voucher;
    public $community;
    public $store_manager_id;
    public $joining_request;
    public $order;
    // Constructor
    public function __construct()
    {
        global $wpdb;
        $this->table_name = $wpdb->prefix . 'csvp_store';
        $this->store_manager_id = get_current_user_id();
        $this->voucher = new CSVP_Voucher(); 
        $this->community = new CSVP_Community(); 
        $this->joining_request = new CSVP_JoiningRequest();
        $this->order = new CSVP_Order();
    }

    public function render_community_management()
    {
        if (isset($_POST["csvp_request"]) && $_POST["csvp_request"] == "add_new_benifit") {
            $payload = $_POST;
                $payload["is_active"] = true;
                $payload["store_id"] = $this->store_manager_id;

                $response = $this->voucher->create_voucher($payload);
                if ($response["status"] !== false) {
                    CSVP_Notification::add(CSVP_Notification::SUCCESS, $response["response"]);
                } else {
                    CSVP_Notification::add(CSVP_Notification::ERROR, $response["response"]);
                }
        }

        else if(isset($_POST["csvp_request"]) && $_POST["csvp_request"] == "set_credit_limit")
        {
            $payload = $_POST;
            $payload["is_active"] = true;
            $payload["store_id"] = $this->store_manager_id;

            $response = $this->joining_request->set_credit_limit_by_store_manager($payload);
            if ($response["status"] !== false) {
                CSVP_Notification::add(CSVP_Notification::SUCCESS, $response["response"]);
            } else {
                CSVP_Notification::add(CSVP_Notification::ERROR, $response["response"]);
            }
        }

        else if(isset($_POST["csvp_request"]) && $_POST["csvp_request"] == "add_order_request")
        {
            $payload = $_POST;
            $payload["is_active"] = true;
            $payload["store_id"] = $this->store_manager_id;
            $totalcost = 0;
            foreach($payload["total_cost"] as $value)
            {
                $totalcost = $totalcost + $value;
            }
            $payload["order_total"] =  $totalcost;
            $response = $this->order->create_order($payload);
            if ($response["status"] !== false) {
                CSVP_Notification::add(CSVP_Notification::SUCCESS, $response["response"]);
            } else {
                CSVP_Notification::add(CSVP_Notification::ERROR, $response["response"]);
            }
        }
        else if(isset($_POST["csvp_request"]) && $_POST["csvp_request"] == "delete_voucher")
        {
            $payload = $_POST;
            $payload["is_active"] = true;
            $payload["store_id"] = $this->store_manager_id;
            $response = $this->voucher->delete_voucher($payload);
            if ($response["status"] !== false) {
                CSVP_Notification::add(CSVP_Notification::SUCCESS, $response["response"]);
            } else {
                CSVP_Notification::add(CSVP_Notification::ERROR, $response["response"]);
            }
        }
        else if(isset($_POST["csvp_request"]) && $_POST["csvp_request"] == "joining_request")
        {
            $payload = $_POST;
            $payload["is_active"] = true;
            $payload["store_id"] = $this->store_manager_id;
            $payload["request_status"] = JOINING_REQUEST_STATUS_PENDING;
            // Get user data
            $user_data = get_userdata($this->store_manager_id);
            // Check if user data exists
            if ($user_data) {
                // Get user role
                $user_role = isset($user_data->roles[0]) ? $user_data->roles[0] : '';
            }

            $payload["requested_by"] = $user_role;
            $response = $this->joining_request->create_joining_request($payload);
            if ($response["status"] !== false) {
                CSVP_Notification::add(CSVP_Notification::SUCCESS, $response["response"]);
            } else {
                CSVP_Notification::add(CSVP_Notification::ERROR, $response["response"]);
            }
        }
        else if(isset($_POST["csvp_request"]) && $_POST["csvp_request"] == "aprrove_payment")
        {
            $payload = $_POST;
            $payload["store_id"] = $this->store_manager_id;
            $payload["order_status"] = ORDER_STATUS_PAID;
            $response = $this->order->update_order_status($payload);
            if ($response) 
            {
                CSVP_Notification::add(CSVP_Notification::SUCCESS, "Order Set As Paid");
            }
            else
            {
                CSVP_Notification::add(CSVP_Notification::ERROR, "Something is Wrong");
            }
        }
        

        $joined_communities = $this->community->get_all_joined_communities_for_store();
        $response["joined_communities"] = $joined_communities;
        if (is_wp_error($response["joined_communities"])) 
        {
        }
        else
        {
            $pageData["joined_communities"] = $joined_communities;
        }

        $requested_communities = $this->community->get_all_requested_communities_for_store();
        $response["requested_communities"] = $requested_communities;
        if (!is_wp_error($response["requested_communities"])) 
        {
            $pageData["requested_communities"] = $requested_communities;
        }
        
        $not_requested_communities = $this->community->get_all_not_requested_communities_for_store();
        $response["not_requested_communities"] = $not_requested_communities;
        if (!is_wp_error($response["not_requested_communities"])) 
        {
            $pageData["not_requested_communities"] = $not_requested_communities;
        }
        
        CSVP_View_Manager::load_view('community-management', $pageData);
    }

    public static function render_coupon_management()
    {
        CSVP_View_Manager::load_view('coupon-management');
    }

    public function render_order_management()
    {

        if(isset($_POST["csvp_request"]) && $_POST["csvp_request"] == "aprrove_payment")
        {
            $payload = $_POST;
            $payload["store_id"] = $this->store_manager_id;
            $payload["order_status"] = ORDER_STATUS_PAID;
            $response = $this->order->update_order_status($payload);
            if ($response) 
            {
                CSVP_Notification::add(CSVP_Notification::SUCCESS, "Order Set As Paid");
            }
            else
            {
                CSVP_Notification::add(CSVP_Notification::ERROR, "Something is Wrong");
            }
        }
        $user_id = get_current_user_id();
        if ($user_id) {
            $data = array(
                'store_id' => $user_id, // Replace 123 with the actual store ID
                'suffix' => '_store' // Replace '_xyz' with the actual suffix value
            );
        
            $order_requests = $this->order->get_orders_by_store_id($data);
        
            if (!is_wp_error($order_requests)) {
                $pageData["accepted_store_orders"] = $order_requests;
                CSVP_View_Manager::load_view('order-management', $pageData);
            } else {
                // Handle error
                CSVP_Notification::add(CSVP_Notification::ERROR, "Something is Wrong");
            }
        } else {
            // Handle error
            CSVP_Notification::add(CSVP_Notification::ERROR, "User Not Loggined");
        }
        
    }

    public function render_order_request()
    {
        if(isset($_POST["csvp_request"]) && $_POST["csvp_request"] == "accept_order_request")
        {
            $payload = $_POST;
            $payload["order_status"] = ORDER_STATUS_COMPLETED;
            $response = $this->order->update_order_status($payload);
            if ($response) 
            {
                CSVP_Notification::add(CSVP_Notification::SUCCESS, "Order Approved");
            }
            else
            {
                CSVP_Notification::add(CSVP_Notification::ERROR, "Something is Wrong");
            }

        }
        else if(isset($_POST["csvp_request"]) && $_POST["csvp_request"] == "cancel_order_request")
        {
            $payload = $_POST;
            $payload["order_status"] = ORDER_STATUS_CANCELLED;
            $response = $this->order->update_order_status($payload);
            if ($response) 
            {
                CSVP_Notification::add(CSVP_Notification::SUCCESS, "Order Rejected");
            }
            else
            {
                CSVP_Notification::add(CSVP_Notification::ERROR, "Something is Wrong");
            }
        }
        
        $user_id = get_current_user_id();
        if ($user_id) {
            $data = array(
                'store_id' => $user_id, // Replace 123 with the actual store ID
                'suffix' => '_store' // Replace '_xyz' with the actual suffix value
            );
        
            $order_requests = $this->order->get_orders_by_store_id($data);
        
            if (!is_wp_error($order_requests)) {
                $pageData["store_order_requests"] = $order_requests;
                CSVP_View_Manager::load_view('order-requests', $pageData);
            } else {
                // Handle error
                CSVP_Notification::add(CSVP_Notification::ERROR, "Something is Wrong");
            }
        } else {
            // Handle error
            CSVP_Notification::add(CSVP_Notification::ERROR, "User Not Loggined");
        }
        
    }

    public static function render_return_management()
    {
        CSVP_View_Manager::load_view('return-management');
    }

    public static function render_transaction_history()
    {
        CSVP_View_Manager::load_view('transaction-history');
    }

    public static function render_walk_order()
    {
        CSVP_View_Manager::load_view('walk-order');
    }
    /**
     * Function to create a new store in the database.
     *
     * @param array $data An associative array containing store data.
     * @return int|false The ID of the newly inserted store if successful, or false on failure.
     */
    public function create_store($data)
    {
        global $wpdb;

        // Extract data from the input array
        $store_name = $data['store_name'];
        $store_phone = $data['store_phone'];
        $store_address = $data['store_address'];
        $store_logo = $data['store_logo'];
        $store_mail_address = $data['store_mail_address'];
        $wp_user_id = $data['wp_user_id'];
        $fee_amount_per_transaction = $data['fee_amount_per_transaction'];
        if (!$this->get_store_by_email(array('email_address' => $store_mail_address))) {
            // Create WordPress user
            $user_id = wp_create_user($store_mail_address, wp_generate_password(), $store_mail_address);
            $user_id_role = new WP_User($user_id);
            $user_id_role->set_role(CSVP_User_Roles::ROLE_STORE_MANAGER);

            // Insert data into the database
            $wpdb->insert(
                $this->table_name, // Table name
                array(
                    'store_name' => $store_name,
                    'store_phone' => $store_phone,
                    'store_address' => $store_address,
                    'store_logo' => $store_logo,
                    'store_mail_address' => $store_mail_address,
                    'wp_user_id' => get_current_user_id(),
                    'fee_amount_per_transaction' => $fee_amount_per_transaction,
                    'wp_user_id'=> $user_id
                ) // Data to be inserted
            );

            // Check if the insertion was successful
            if ($wpdb->insert_id) {
                // Return the ID of the newly inserted store
                return $wpdb->insert_id;
            } else {
                // Send error response
                return false;
            }
        }

    }

    /**
     * Function to retrieve a store by its ID from the database.
     *
     * @param int $store_id The ID of the store to retrieve.
     * @return object|false Store data as an object if found, or false if not found.
     */
    public function get_store_by_id($store_id)
    {
        global $wpdb;

        // Prepare SQL query to retrieve store data by ID
        $query = $wpdb->prepare(
            "SELECT * FROM $this->table_name WHERE id = %d",
            $store_id
        );

        // Execute the query
        $store = $wpdb->get_row($query);

        // Check if a store was found
        if ($store) {
            // Return store data as an object
            return $store;
        } else {
            // Send error response
            return false;
        }
    }

    /**
     * Function to retrieve stores by their name (partial or full match) from the database.
     *
     * @param string $store_name The name of the store to search for.
     * @return array Array of store objects matching the search criteria.
     */
    public function get_stores_by_name($store_name)
    {
        global $wpdb;

        // Prepare SQL query to retrieve stores by name using LIKE operator
        $query = $wpdb->prepare(
            "SELECT * FROM $this->table_name WHERE store_name LIKE %s",
            '%' . $wpdb->esc_like($store_name) . '%'
        );

        // Execute the query
        $stores = $wpdb->get_results($query);

        // Check if stores were found
        if ($stores) {
            // Return array of store objects
            return $stores;
        } else {
            // Send error response
            return false;
        }
    }

    /**
     * Function to retrieve a community by its ID from the database.
     *
     * @param int $community_id The ID of the community to retrieve.
     * @return object|WP_Error Community data as an object if found, or WP_Error if not found.
     */
    public function get_store_by_email($data)
    {
        global $wpdb;

        $community_email = $data["email_address"];
        // Prepare SQL query to retrieve community data by ID
        $query = $wpdb->prepare(
            "SELECT * FROM $this->table_name WHERE store_mail_address = %d",
            $community_email
        );

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
     * Function to update a store in the database based on its ID.
     *
     * @param array $data Associative array containing the updated store data.
     * @return bool True on success, false on failure.
     */
    public function update_store($data)
    {
        global $wpdb;

        // Extract store ID from the data array
        $store_id = $data['store_id'];

        // Remove store_id from the data array to prevent updating it
        unset($data['store_id']);

        // Format the update data for the SQL query
        $update_data = [];
        foreach ($data as $key => $value) {
            $update_data[] = "$key = '$value'";
        }

        // Prepare SQL query to update store data
        $query = $wpdb->prepare(
            "UPDATE $this->table_name SET " . implode(', ', $update_data) . " WHERE id = %d",
            $store_id // Store ID for the WHERE clause
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
     * Function to delete a store from the database based on its ID.
     *
     * @param int $store_id ID of the store to delete.
     * @return bool True on success, false on failure.
     */
    public function delete_store($store_id)
    {
        global $wpdb;

        // Prepare SQL query to delete store by ID
        $query = $wpdb->prepare("DELETE FROM $this->table_name WHERE id = %d", $store_id);

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
     * Function to retrieve all stores from the database.
     *
     * @return array|null Array of stores on success, null on failure.
     */
    public function get_all_stores()
    {
        global $wpdb;

        // Prepare SQL query to select all stores
        $query = "SELECT * FROM $this->table_name";

        // Execute the query and fetch the results
        $results = $wpdb->get_results($query, ARRAY_A);

        // Check if any stores were found
        if ($results) {
            // Return the results
            return $results;
        } else {
            // Send error response
            return null;
        }
    }
}
