<?php
class CSVP_Community
{
    // Properties
    private $table_name;
    public $community_id;
    public $community_member;
    public $voucher;
    public $joining_request;
    public $order;
    public $transaction;


    // Constructor
    public function __construct()
    {
        global $wpdb;
        $this->table_name = $wpdb->prefix . 'csvp_community';
        $this->community_member = new CSVP_CommunityMember();
        $this->voucher = new CSVP_VoucherTransaction();
        $this->joining_request = new CSVP_JoiningRequest();
        $this->order = new CSVP_Order();
        $this->transaction = new CSVP_Transaction();
    }

    public function render_dashboard()
    {
        global $order;
        $pageData["count_members"] = $this->community_member->get_community_members_by_community_id(array("community_id" => $this->get_current_community_id(), "count" => true));
        $pageData["redeemed_voucher"] = $this->voucher->get_all_voucher_transactions_by_community_id(array("community_id" => $this->get_current_community_id(), "status" => VOUCHER_STATUS_USED, "count" => true));



        $pageData["creditBalance"] = $this->getCreditLimit();
        

        $pageData["total_transactions"] = $this->getSaleByMonth();
        CSVP_View_Manager::load_view('dashboard', $pageData);
    }

    public function render_manage_guys()
    {
        global $voucher, $store, $community, $voucher_transaction, $filter, $community_member, $commision;
        //Sample Post Request
        if (isset ($_POST["csvp_request"]) && $_POST["csvp_request"] == "add_guy") {

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
        if (isset ($_POST["csvp_request"]) && $_POST["csvp_request"] == "delete_guy") {
            $payload = $_POST;
            $payload_1['community_member_id'] = $payload['community_member_id'];
            $payload_1['is_active'] = 0;
        
            $response = $this->community_member->inactive_community_member($payload_1);
            if (!is_wp_error($response)) {
                CSVP_Notification::add(CSVP_Notification::SUCCESS, "Guy Deleted");
            } else {
                CSVP_Notification::add(CSVP_Notification::ERROR, $response);
            }
        }
        if (isset ($_POST["csvp_request"]) && $_POST["csvp_request"] == "edit_guy") {

                $payload = $_POST;
                $payload_1['phone_number'] = $payload['phone_number'];
                $payload_1['full_name'] = $payload['full_name'];
                $payload_1['address'] = $payload['address'];
                $payload_1['id_number'] = $payload['id_number'];
                $payload_1['lesson'] = $payload['lesson'];
                $payload_1['magnetic_card_number_association'] = $payload['magnetic_card_number_association'];
                $payload_1['community_member_id'] = $payload['community_member_id'];
    
                $response = $this->community_member->update_community_member($payload_1);
                if (!is_wp_error($response)) {

                    CSVP_Notification::add(CSVP_Notification::SUCCESS, "Guy Updated");
                } else {
                    CSVP_Notification::add(CSVP_Notification::ERROR, $response);
    
                }
        }


        if (isset ($_POST["csvp_request"]) && $_POST["csvp_request"] == "load_voucher") {
            $payload = $_POST;



            $payload["transaction_type"] = VOUCHER_TRANSACTION_LOAD;
            $payload["transaction_date"] = date("Y-m-d H:i:s");
            $payload["status"] = VOUCHER_STATUS_PENDING;
            $response = $voucher_transaction->create_voucher_transaction($payload);
            if (!is_wp_error($response)) {


            $communtiy = $this->get_community_data_by_id($this->get_current_community_id()); // line 118
            $commision_Data = array(
                "entity_id" => $this->get_current_community_id(),
                "entity_type" => CSVP_User_Roles::ROLE_COMMUNITY_MANAGER,
                "commission_type" => COMMISSION_TYPE_VOUCHER,
                "commission_value" => $communtiy->commision_percentage,
                "commission_status" => COMMISSION_STATUS_PENDING
            );
            $commision->create_commission($commision_Data);
            
                CSVP_Notification::add(CSVP_Notification::SUCCESS, "Voucher has been purchased successfully");
            }
            else {
                CSVP_Notification::add(CSVP_Notification::ERROR, $response);

            }
        }

        if (isset($_FILES['community_members_excel_sheet'])) {
            $response = $community_member->import_community_members_from_excel_sheet();
            if($response["status"]){
                CSVP_Notification::add(CSVP_Notification::SUCCESS, $response["response"]);
            } else {
                CSVP_Notification::add(CSVP_Notification::ERROR, $response["response"]);
            }
        } 
        $voucherData = $voucher->get_all_vouchers_by_community_id(array('community_id' => $this->get_current_community_id()));
        $modified_storeData = array();
        foreach ($voucherData as $voucher) {

            $voucher["store_data"] = $store->get_store_by_id($voucher["store_id"]);
            $voucher["community_data"] = $community->get_community_by_id($voucher["community_id"]);
            array_push($modified_storeData, $voucher);
        }
        $pageData["vouchers"] = $modified_storeData;

        // Load Data
        $members_data = $this->community_member->get_community_members_by_community_id(array('community_id' => $this->get_current_community_id()));
        $pageData["members"] = $members_data;


        if (isset ($_POST["magnetic_card_filter"])) {

            unset($_POST["magnetic_card_filter"]);

            $pageData["members"] = $filter->filterData($pageData["members"], $_POST);

        }

       else if (isset ($_POST["lesson_filter"])) {

            unset($_POST["lesson_filter"]);

            foreach ($_POST["lesson_array"] as $lesson_array) {
                $pageData["members"] = $filter->filterData($pageData["members"], array('lesson' => $lesson_array));
            }

        }


        else if (isset ($_POST["guy_name_filter"])) {

            unset($_POST["guy_name_filter"]);

            foreach ($_POST["guyname_array"] as $guyname_array) {
                $pageData["members"] = $filter->filterData($pageData["members"], array('full_name' => $guyname_array));
            }

        }


        CSVP_View_Manager::load_view('manage-guys', $pageData);
    }

    public static function render_messages()
    {
        global $community, $messages, $filter;

        if (isset ($_POST["csvp_request"]) && $_POST["csvp_request"] == "delete_message") {
            $payload = $_POST;
            $response = $messages->delete_community_message($payload);
            if (!is_wp_error($response)) {

                CSVP_Notification::add(CSVP_Notification::SUCCESS, "Message has been Deleted successfully");
            } else {
                CSVP_Notification::add(CSVP_Notification::ERROR, $response);

            }
        }


        $messagesData = $messages->get_community_messages_by_to_id(array("to_id" => $community->get_current_community_id()));


        $modifiedMessages = array();

        foreach ($messagesData as $message) {
            $message["message_filter_date"] = date('Y-m-d', strtotime($message["created_at"]));
            array_push($modifiedMessages, $message);
        }

        $pageData["messages"] = $modifiedMessages;

        if (isset ($_POST["csvp_filter"]) && $_POST["csvp_filter"] == "filter_by_date") {
            unset($_POST["csvp_filter"]);
            $pageData["messages"] = $filter->filterData($pageData["messages"], $_POST);
        } else if (isset ($_POST["csvp_filter"]) && $_POST["csvp_filter"] == "filter_by_name") {
            unset($_POST["csvp_filter"]);

            $pageData["messages"] = $filter->filterData($pageData["messages"], $_POST);
        }

        CSVP_View_Manager::load_view('messages', $pageData);
    }

    public function render_transaction_history()
    {

        global $filter;

        $pageData = [];
        $payload["community_id"] = $this->get_current_community_id();
        $id = $this->get_current_community_id();
        $voucher_transaction = $this->voucher->get_all_voucher_transactions_by_community_id($payload);
        $check_1["voucher_transaction"] = $voucher_transaction;
        if (!is_wp_error($check_1["voucher_transaction"])) {
            $pageData["voucher_transaction"] = $voucher_transaction;
        }

        $amount_transaction = $this->transaction->get_transactions_by_community_id($id);
        $check_2["amount_transaction"] = $amount_transaction;
        if (!is_wp_error($check_2["amount_transaction"])) {
            $pageData["amount_transaction"] = $amount_transaction;
        }


        $modified_voucher_transaction = array();

        foreach ($voucher_transaction as $voucher) {
            $voucher["created_at"] = date("Y-m-d", strtotime($voucher["created_at"]));
            array_push($modified_voucher_transaction, $voucher);
        }

        $pageData["voucher_transaction"] = $modified_voucher_transaction;


        $modified_amount_transaction = array();

        foreach ($amount_transaction as $voucher) {
            $voucher["created_at"] = date("Y-m-d", strtotime($voucher["created_at"]));
            array_push($modified_amount_transaction, $voucher);
        }

        $pageData["amount_transaction"] = $modified_amount_transaction;


        if (isset ($_POST["order_range_filter"])) {


            $first_date = $_POST["first_date"];
            $second_date = $_POST["second_date"];

            // Initialize an empty array to store the dates
            $date_range = array();

            // Convert the string dates to DateTime objects
            $start_date = new DateTime($first_date);
            $end_date = new DateTime($second_date);

            // Iterate through the dates
            while ($start_date <= $end_date) {
                // Store the current date in the array
                $date_range[] = $start_date->format('Y-m-d');

                // Move to the next day
                $start_date->modify('+1 day');
            }

            // Now $date_range contains all the dates between $first_date and $second_date


            // Now $date_range contains all the dates between $first_date and $second_date

            $date_data_voucher = array();
            $date_data_amount = array();

            foreach ($date_range as $date) {

                $filtered_data_voucher = $filter->filterData($pageData["voucher_transaction"], array('created_at' => $date));
                if (!empty ($filtered_data_voucher)) {
                    array_push($date_data_voucher, $filtered_data_voucher);
                }

                $filtered_data_amount = $filter->filterData($pageData["amount_transaction"], array('created_at' => $date));
                if (!empty ($filtered_data_amount)) {
                    array_push($date_data_amount, $filtered_data_amount);
                }

            }

            $pageData["voucher_transaction"] = array_merge(...$date_data_voucher);
            $pageData["amount_transaction"] = array_merge(...$date_data_amount);
        }
        $member_data[] = $pageData['amount_transaction'][0]['member_data'];
        $pageData['members'] = $member_data;
        CSVP_View_Manager::load_view('transaction-history', $pageData);
    }

    public function render_store_management()
    {
        global $store, $filter, $joining_request;


        if (isset ($_POST["csvp_request"]) && $_POST["csvp_request"] == "joining_request") {
            $payload = $_POST;
            $payload["is_active"] = true;
            $payload["community_id"] = $this->get_current_community_id();
            $payload["request_status"] = JOINING_REQUEST_STATUS_PENDING;
            // Get user data
            $user_data = get_userdata(get_current_user_id());
            // Check if user data exists
            if ($user_data) {
                // Get user role
                $user_role = isset ($user_data->roles[0]) ? $user_data->roles[0] : '';
            }

            $payload["requested_by"] = $user_role;
            $response = $this->joining_request->create_joining_request($payload);
            if ($response["status"] !== false) {
                CSVP_Notification::add(CSVP_Notification::SUCCESS, $response["response"]);
            } else {
                CSVP_Notification::add(CSVP_Notification::ERROR, $response["response"]);
            }
        } else if (isset ($_POST["csvp_request"]) && $_POST["csvp_request"] == "add_order_request") {
            $payload = $_POST;
            $payload["is_active"] = true;
            $payload["community_id"] = $this->get_current_community_id();
            $payload["message"] = "Order Created Successfully";
            $totalcost = 0;
            foreach ($payload["total_cost"] as $value) {
                $totalcost = $totalcost + $value;
            }
            $payload["order_total"] = $totalcost;


            $credit_limit = $joining_request->get_credit_limit($payload["store_id"],$this->get_current_community_id());
            $credit_balance = $this->getCreditLimit(array("store_id"=> $payload["store_id"]));


            if(($credit_balance + $totalcost) >= $credit_limit){
                CSVP_Notification::add(CSVP_Notification::ERROR, "Order exceeds credit limit");

            } else {
                $response = $this->order->create_order($payload);
                if ($response["status"] !== false) {
                    CSVP_Notification::add(CSVP_Notification::SUCCESS, $response["response"]. " ". ($credit_balance + $totalcost) . " ". json_encode($credit_limit));
                } else {
                    CSVP_Notification::add(CSVP_Notification::ERROR, $response["response"]);
                }
            }

           
        } else if (isset ($_POST["csvp_request"]) && $_POST["csvp_request"] == "add_return_request") {
            $payload = $_POST;
            $payload["is_active"] = true;
            $payload["community_id"] = $this->get_current_community_id();
            $payload["order_status"] = ORDER_STATUS_RETURNED;
            $payload["message"] = "Return Order Request Sent";
            $totalcost = 0;
            foreach ($payload["total_cost"] as $value) {
                $totalcost = $totalcost + $value;
            }
            $payload["order_total"] = $totalcost;
            $response = $this->order->create_order($payload);
            if ($response["status"] !== false) {
                CSVP_Notification::add(CSVP_Notification::SUCCESS, $response["response"]);
            } else {
                CSVP_Notification::add(CSVP_Notification::ERROR, $response["response"]);
            }
        }

        $pageData = [];

        $joined_store = $store->get_all_joined_store_for_communities();
        $check_1["joined_store"] = $joined_store;
        if (!is_wp_error($check_1["joined_store"])) {
            $pageData["joined_store"] = $joined_store;
        }

        $requested_stores = $store->get_all_requested_store_for_communities();
        $check_2["requested_stores"] = $requested_stores;
        if (!is_wp_error($check_2["requested_stores"])) {
            $pageData["requested_stores"] = $requested_stores;
        }

        $not_requested_stores = $store->get_all_not_requested_store_for_communities();
        $check_3["not_requested_stores"] = $not_requested_stores;
        if (!is_wp_error($check_3["not_requested_stores"])) {
            $pageData["not_requested_stores"] = $not_requested_stores;
        }

        if (isset ($_POST["csvp_filter"]) && $_POST["csvp_filter"] == "filter_by_joined") {
            $pageData["not_requested_stores"] = array();
        } else if (isset ($_POST["csvp_filter"]) && $_POST["csvp_filter"] == "filter_by_not_joined") {
            $pageData["joined_store"] = array();
        } else if (isset ($_POST["csvp_filter"]) && $_POST["csvp_filter"] == "filter_by_name") {
            unset($_POST["csvp_filter"]);

            $pageData["not_requested_stores"] = $filter->filterData($pageData["not_requested_stores"], $_POST);
            $pageData["requested_stores"] = $filter->filterData($pageData["requested_stores"], $_POST);
            $pageData["joined_store"] = $filter->filterData($pageData["joined_store"], $_POST);
        }

        CSVP_View_Manager::load_view('store-management', $pageData);

        // CSVP_View_Manager::load_view('store-management');
    }

    public static function render_order_management()
    {
        global $order, $filter, $community, $store;
        $pageData = [];
        $data = [];
        $community_id = $community->get_current_community_id();
        $data['community_id'] = $community_id;
        $data['suffix'] = '_store';
        $pageData['all_order_data'] = $order->get_all_orders_by_community_id($data);


        $modified_order_data = array();

        foreach ($pageData['all_order_data'] as $request) {
            $request["created_at"] = date("Y-m-d", strtotime($request["created_at"]));
            array_push($modified_order_data, $request);
        }
        $pageData["all_order_data"] = $modified_order_data;


        if (isset ($_POST["order_range_filter"])) {


            $first_date = $_POST["first_date"];
            $second_date = $_POST["second_date"];

            // Initialize an empty array to store the dates
            $date_range = array();

            // Convert the string dates to DateTime objects
            $start_date = new DateTime($first_date);
            $end_date = new DateTime($second_date);

            // Iterate through the dates
            while ($start_date <= $end_date) {
                // Store the current date in the array
                $date_range[] = $start_date->format('Y-m-d');

                // Move to the next day
                $start_date->modify('+1 day');
            }

            // Now $date_range contains all the dates between $first_date and $second_date


            // Now $date_range contains all the dates between $first_date and $second_date

            $date_data = array();

            foreach ($date_range as $date) {
                $filtered_data = $filter->filterData($pageData["all_order_data"], array('created_at' => $date));
                if (!empty ($filtered_data)) {
                    array_push($date_data, $filtered_data);
                }
            }


            $pageData["all_order_data"] = array_merge(...$date_data);

        } 
        
        else if (isset ($_POST["filter_by_order"])) {
            foreach ($_POST["order_array"] as $order_array) {
                $pageData["all_order_data"] = $filter->filterData($pageData["all_order_data"], array('id' => $order_array));
            }
        }
        else if (isset ($_POST["filter_by_stores"])) {
            foreach ($_POST["stores_array"] as $stores_array) {
                $pageData["all_order_data"] = $filter->filterData($pageData["all_order_data"], array('store_id' => $stores_array));

                $stores_data = $store->get_store_by_id($stores_array);
                        
                // var_dump($community_data['community_name']);
                // echo json_encode($stores_data);
                array_push($_POST["stores_array"], $stores_data->store_name);

                $index = array_search($stores_array, $_POST["stores_array"]);

                if ($index !== false) {
                    unset($_POST["stores_array"][$index]);
                }
            }
        }


        CSVP_View_Manager::load_view('order-management',$pageData);
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


                if (isset ($_FILES['community_logo']) && $_FILES['community_logo']['error'] == UPLOAD_ERR_OK) {

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
                    return new WP_Error('response', __('No Community image uploaded or error occurred', 'csvp'), array('status' => 500));
                }
            } else {

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

    function getDashboardSales($month = null)
    {
        // If $month is not provided, assume current month
        if ($month === null) {
            $month = date('m');
        }

        // Initialize an array to store sales data for each month
        $salesData = array();

        // Loop through the past 10 months including the current month
        for ($i = 0; $i < 12; $i++) {
            // Calculate the target month using strtotime
            $targetMonth = date('Y-m', strtotime("-$i months"));
            $targetMonthData = date('F', strtotime("-$i months"));

            // Fetch sales data for the target month
            $sales = $this->getSaleByMonth($targetMonth)["total_order_value"];

            // Store the sales data for the current month
            $salesData["$targetMonthData"] = $sales;
        }

        return $salesData;
    }


    function getSaleByMonth($month = null)
    {
        // Set the default month to the current month if not provided
        if ($month === null) {
            $month = date('Y-m');
        }

        $payload["community_id"] = $this->get_current_community_id();
        $id = $this->get_current_community_id();
        $voucher_transaction = $this->voucher->get_all_voucher_transactions_by_community_id($payload);
        $check_1["voucher_transaction"] = $voucher_transaction;
        if (!is_wp_error($check_1["voucher_transaction"])) {
            $pageData["voucher_transaction"] = $voucher_transaction;
        }

        $amount_transaction = $this->transaction->get_transactions_by_community_id($id);
        $check_2["amount_transaction"] = $amount_transaction;
        if (!is_wp_error($check_2["amount_transaction"])) {
            $pageData["amount_transaction"] = $amount_transaction;
        }

        $modified_voucher_transaction = array();
        $modified_amount_transaction = array();

        foreach ($voucher_transaction as $voucher) {
            if (date('Y-m', strtotime($voucher["created_at"])) == $month) {
                $voucher["created_at"] = date("Y-m-d", strtotime($voucher["created_at"]));
                array_push($modified_voucher_transaction, $voucher);
            }
        }

        foreach ($amount_transaction as $voucher) {
            if (date('Y-m', strtotime($voucher["created_at"])) == $month) {
                $voucher["created_at"] = date("Y-m-d", strtotime($voucher["created_at"]));
                array_push($modified_amount_transaction, $voucher);
            }
        }


        $pageData["voucher_transaction"] = $modified_voucher_transaction;
        $pageData["amount_transaction"] = $modified_amount_transaction;

        $total_order = 0;
        $total_order_value = 0;

        foreach ($pageData["voucher_transaction"] as $transaction) {
            $total_order = $total_order + 1;
            $total_order_value = $total_order_value + $transaction['transaction_amount'];
        }

        foreach ($pageData["amount_transaction"] as $transaction) {
            $total_order = $total_order + 1;
            $total_order_value = $total_order_value + $transaction['transaction_amount'];
        }

        return array(
            'total_orders' => $total_order,
            'total_order_value' => $total_order_value,
            'amount_transactions' => $pageData["amount_transaction"],
            'voucher_transaction' => $pageData["voucher_transaction"],
        );
    }

    function getCreditLimit($data = array())
    {
        global $order;

        // Set the default status to 3 if not provided
        $id = isset($data["community_id"]) ? $data["community_id"] : $this->get_current_community_id();
        $amount_transaction = $this->transaction->get_transactions_by_community_id($id);


        $modified_amount_transaction = array();

        foreach ($amount_transaction as $voucher) {

            if ($voucher["is_active"] != '3') {
                $voucher["created_at"] = date("Y-m-d", strtotime($voucher["created_at"]));
                array_push($modified_amount_transaction, $voucher);
            }

        }


        $total_order = 0;
        $total_order_value = 0;
        $debtBalance = 0;

        foreach ($modified_amount_transaction as $transaction) {


            if($transaction["transaction_type"] == "debit"){

                if(isset($data["store_id"]) ){

                    if($transaction["store_id"] == $data["store_id"]){
                        $total_order = $total_order + 1;
                        $total_order_value = $total_order_value + $transaction['transaction_amount'];
                        $debtBalance += $transaction['transaction_amount'];
                    }
                } else {
                    $total_order = $total_order + 1;
                    $total_order_value = $total_order_value + $transaction['transaction_amount'];
                    $debtBalance += $transaction['transaction_amount'];
                }
                
            }

           
        }

        if (isset($data["community_id"])) {
            $orders = $order->get_orders_data_community(array('suffix' => "_store", "community_id" => $data["community_id"]));
        } else {
            $orders = $order->get_orders_data_community(array('suffix' => "_store"));
        }

        foreach ($orders as $key => $order) {


            if ($order["order_status"] !== ORDER_STATUS_PAID && $order["order_status"] !== ORDER_STATUS_CANCELLED && $order["order_status"] !== ORDER_STATUS_RETURNED && $order["order_status"] !== ORDER_STATUS_RETURNED_PAID ) {
                if (isset($data["store_id"])) {
                    if ($order["store_id"] == $data["store_id"]) {
                        $total_order = $total_order + 1;
                        $debtBalance += $order["order_total"];
                    }
                } else {
                    $debtBalance += $order["order_total"];
                }
            }

        }


        return $debtBalance;
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

        // Prepare SQL query to select voucher transactions by member ID
        $query = $wpdb->prepare("SELECT * FROM {$wpdb->prefix}csvp_joining_request WHERE store_id = %d AND request_status = %s", $store_id, JOINING_REQUEST_STATUS_APPROVED);

        // Execute the query and fetch the results
        $joined_communities = $wpdb->get_results($query, ARRAY_A);

        foreach ($joined_communities as $key => $community) {
            $order_data = $this->get_order_data_by_id(($community["community_id"]));
            $joined_communities[$key]["order_data"] = $order_data;

            $community_data = $this->get_community_data_by_id(($community["community_id"]));
            $joined_communities[$key]["community_data"] = $community_data;
            $joined_communities[$key]["community_name"] = $community_data->community_name;

            $community_member_data = $this->get_community_member_data_by_id(($community["community_id"]));
            $joined_communities[$key]["community_member_data"] = $community_member_data;
        }
        // Check if communities were found
        if ($joined_communities) {
            // Return array of community objects
            return $joined_communities;
        } else {
            // Send error response
            return new WP_Error('not_found', __('No Joined Communities.', 'csvp'), array('status' => 404));
        }
    }
    public function get_order_data_by_id($community_id)
    {
        global $wpdb;
        $query = $wpdb->prepare("SELECT community_id, COUNT(id) AS order_count, SUM(order_total) AS total_order_amount FROM {$wpdb->prefix}csvp_order WHERE community_id = %d GROUP BY community_id", $community_id);
        // Execute the query
        $order_data = $wpdb->get_row($query);

        // Check if a voucher was found
        if ($order_data) {
            // Return voucher data as an object
            return $order_data;
        } else {
            // Return false if voucher not found
            return false;
        }
    }


    public function get_community_member_data_by_id($community_id)
    {
        global $wpdb;
        $query = $wpdb->prepare("SELECT community_id, COUNT(id) AS member_count FROM {$wpdb->prefix}csvp_community_member WHERE community_id = %d", $community_id);
        // Execute the query
        $member_data = $wpdb->get_row($query);

        // Check if a voucher was found
        if ($member_data) {
            // Return voucher data as an object
            return $member_data;
        } else {
            // Return false if voucher not found
            return false;
        }
    }



    public function get_community_data_by_id($community_id)
    {
        global $wpdb;
        $query = $wpdb->prepare("SELECT * FROM {$wpdb->prefix}csvp_community WHERE id = %d", $community_id);
        // Execute the query
        $community_data = $wpdb->get_row($query);

        // Check if a voucher was found
        if ($community_data) {
            // Return voucher data as an object
            return $community_data;
        } else {
            // Return false if voucher not found
            return false;
        }
    }

    public function get_community_user_data_by_id($data)
    {
        $id = $data['id'];
        $user_data = get_userdata($id);
        return $user_data;

    }


    public function get_all_requested_communities_for_store()
    {
        global $wpdb, $store;
        $store_id = $store->get_store_id();
        // Prepare SQL query to retrieve communities by name using LIKE operator

        // Prepare SQL query to select voucher transactions by member ID
        $query = $wpdb->prepare("SELECT * FROM {$wpdb->prefix}csvp_joining_request WHERE store_id = %d AND request_status = %s", $store_id, JOINING_REQUEST_STATUS_PENDING);

        // Execute the query and fetch the results
        $requested_community = $wpdb->get_results($query, ARRAY_A);


        foreach ($requested_community as $key => $community) {
            $order_data = $this->get_order_data_by_id(($community["community_id"]));
            $requested_community[$key]["order_data"] = $order_data;

            $community_data = $this->get_community_data_by_id(($community["community_id"]));
            $requested_community[$key]["community_data"] = $community_data;
            $requested_community[$key]["community_name"] = $community_data->community_name;

            $community_member_data = $this->get_community_member_data_by_id(($community["community_id"]));
            $requested_community[$key]["community_member_data"] = $community_member_data;
        }

        // Check if communities were found
        if ($requested_community) {
            // Return array of community objects
            return $requested_community;
        } else {
            // Send error response
            return new WP_Error('not_found', __('No Requested Communities.', 'csvp'), array('status' => 404));
        }
    }


    public function get_all_not_requested_communities_for_store()
    {
        global $wpdb, $store;
        $store_id = $store->get_store_id();
        // Prepare SQL query to retrieve store IDs
        $query = $wpdb->prepare("SELECT id FROM {$wpdb->prefix}csvp_community");
        $community_ids = $wpdb->get_results($query, ARRAY_A);
        $communitiesWithoutRequests = [];
        // Iterate over each store ID
        foreach ($community_ids as $row) {
            $community_id = $row["id"];
            // Prepare SQL query to check if there are any requests for this store and community
            $query = $wpdb->prepare("SELECT COUNT(*) AS count FROM {$wpdb->prefix}csvp_joining_request WHERE community_id = %d AND store_id = %d", $community_id, $store_id);
            $ids_result = $wpdb->get_results($query, ARRAY_A);
            // Check if there are any rows
            if ($ids_result && isset ($ids_result[0]["count"]) && $ids_result[0]["count"] == 0) {
                $communitiesWithoutRequests[] = $community_id;
            }
        }
        $not_requested_community = [];
        // Iterate over each store ID without requests
        foreach ($communitiesWithoutRequests as $key => $community_id) {
            // Get order data by store ID
            $order_data = $this->get_order_data_by_id($community_id);
            $community_data = $this->get_community_data_by_id($community_id);
            $community_member_data = $this->get_community_member_data_by_id($community_id);

            $not_requested_community[$key]["order_data"] = $order_data;
            $not_requested_community[$key]["community_data"] = $community_data;
            $not_requested_community[$key]["community_name"] = $community_data->community_name;

            $not_requested_community[$key]["community_member_data"] = $community_member_data;
        }
        // Check if joined store data was found
        if (!empty ($not_requested_community)) {
            // Return array of joined store data
            return $not_requested_community;
        } else {
            // Send error response
            return new WP_Error('not_found', __('No Communities without requests found.', 'csvp'), array('status' => 404));
        }
    }


    public function get_community_data_for_store_popup($data)
    {
        global $wpdb, $store;

        $community_id = $data['community_id'];
        $store_id = $store->get_store_id();

        $query = $wpdb->prepare(
            "SELECT c.*, jr.credit_limit 
            FROM {$wpdb->prefix}csvp_community c 
            LEFT JOIN {$wpdb->prefix}csvp_joining_request jr 
            ON c.id = jr.community_id 
            WHERE c.id = %d AND jr.store_id = %d",
            $community_id,
            $store_id
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

        $count = isset ($data["count"]) ? true : false;

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
