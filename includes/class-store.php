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
    public $voucherTransaction;
    public $message;
    public $transaction;
    // Constructor
    public function __construct()
    {
        global $wpdb;
        $this->table_name = $wpdb->prefix . 'csvp_store';
        $this->voucher = new CSVP_Voucher();
        $this->community = new CSVP_Community();
        $this->joining_request = new CSVP_JoiningRequest();
        $this->order = new CSVP_Order();
        $this->voucherTransaction = new CSVP_VoucherTransaction();
        $this->message = new CSVP_CommunityMessage();
        $this->transaction = new CSVP_Transaction();
    }

    public function render_community_management()
    {

        global $filter;


        if (isset ($_POST["csvp_request"]) && $_POST["csvp_request"] == "add_new_benifit") {
            $payload = $_POST;
            $payload["is_active"] = true;
            $payload["store_id"] = $this->get_store_id();

            $response = $this->voucher->create_voucher($payload);
            if ($response["status"] !== false) {
                CSVP_Notification::add(CSVP_Notification::SUCCESS, $response["response"]);
            } else {
                CSVP_Notification::add(CSVP_Notification::ERROR, $response["response"]);
            }
        } else if (isset ($_POST["csvp_request"]) && $_POST["csvp_request"] == "edit_benifit") {
            $payload = $_POST;
            $payload_1['product_name'] = $payload['product_name'];
            $payload_1['voucher_price'] = $payload['voucher_price'];
            $payload_1['normal_price'] = $payload['normal_price'];
            $payload_1['voucher_id'] = $payload['voucher_id'];

            $store_id = $this->get_store_id();

            $upload_dir = wp_upload_dir(); 
            $oldpath = $upload_dir['basedir'] . '/' . $payload['old_image'];

            if (isset ($_FILES['product_image']) && $_FILES['product_image']['error'] == UPLOAD_ERR_OK) {
                $file_name = basename($_FILES['product_image']['name']);
                $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
                $unique_identifier = uniqid();
                $file_name = 'store_voucher_' . $store_id . '_' . $unique_identifier . '.' . $file_extension;
                $moved = move_uploaded_file($_FILES['product_image']['tmp_name'], $upload_dir['path'] . '/' . $file_name);
                if ($moved) {
                    if (isset($oldpath) && file_exists($oldpath)) {
                        unlink($oldpath);
                    }
                    $file_path = $upload_dir['subdir'] . '/' . $file_name;
                    $payload_1['product_image'] = $file_path;
                    $response = $this->voucher->update_voucher($payload_1);
                }
            }
            else{
                $response = $this->voucher->update_voucher($payload_1);
            }

            if ($response["status"] !== false) {
                CSVP_Notification::add(CSVP_Notification::SUCCESS, $response["response"]);
            } else {
                CSVP_Notification::add(CSVP_Notification::ERROR, $response["response"]);
            }
        } else if (isset ($_POST["csvp_request"]) && $_POST["csvp_request"] == "set_credit_limit") {
            $payload = $_POST;
            $payload["is_active"] = true;
            $payload["store_id"] = $this->get_store_id();

            $response = $this->joining_request->set_credit_limit_by_store_manager($payload);
            if ($response["status"] !== false) {
                CSVP_Notification::add(CSVP_Notification::SUCCESS, $response["response"]);
            } else {
                CSVP_Notification::add(CSVP_Notification::ERROR, $response["response"]);
            }
        } else if (isset ($_POST["csvp_request"]) && $_POST["csvp_request"] == "add_order_request") {
            $payload = $_POST;
            $payload["is_active"] = true;
            $payload["store_id"] = $this->get_store_id();
            $payload["message"] = "Order Created Successfully";
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
        } else if (isset ($_POST["csvp_request"]) && $_POST["csvp_request"] == "delete_voucher") {
            $payload = $_POST;
            $payload["store_id"] = $this->get_store_id();
            $response = $this->voucher->update_status($payload);
            if ($response["status"] !== false) {
                CSVP_Notification::add(CSVP_Notification::SUCCESS, $response["response"]);
            } else {
                CSVP_Notification::add(CSVP_Notification::ERROR, $response["response"]);
            }
        } else if (isset ($_POST["csvp_request"]) && $_POST["csvp_request"] == "joining_request") {
            $payload = $_POST;
            $payload["is_active"] = true;
            $payload["store_id"] = $this->get_store_id();
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
        } else if (isset ($_POST["csvp_request"]) && $_POST["csvp_request"] == "aprrove_payment") {
            $payload = $_POST;
            $payload["store_id"] = $this->get_store_id();
            $payload["order_status"] = ORDER_STATUS_PAID;
            $payload["message"] = "Order Set As Paid";
            $response = $this->order->update_order_status($payload);
            if ($response["status"] !== false) {
                CSVP_Notification::add(CSVP_Notification::SUCCESS, $response["response"]);
            } else {
                CSVP_Notification::add(CSVP_Notification::ERROR, $response["response"]);
            }
        } else if (isset ($_POST["csvp_request"]) && $_POST["csvp_request"] == "request_payment") {
            $payload = $_POST;
            $payload["store_id"] = $this->get_store_id();
            $payload["order_status"] = ORDER_STATUS_PROCESSING;
            $payload["message"] = "Payment Request Sent";
            $response = $this->order->update_order_status($payload);
            if ($response["status"] !== false) {
                CSVP_Notification::add(CSVP_Notification::SUCCESS, $response["response"]);
            } else {
                CSVP_Notification::add(CSVP_Notification::ERROR, $response["response"]);
            }
        }
        else if (isset($_POST["csvp_request"]) && $_POST["csvp_request"] == "request_trasanction") {
            $payload = $_POST;
            $payload["status"] = VOUCHER_STATUS_REQUESTED;
            $payload['status_transaction'] = 2;
            $payload["message"] = "Payment Request Sent";
            $response = $this->transaction->update_transaction_status($payload);
            if ($response["status"] !== false) {
                CSVP_Notification::add(CSVP_Notification::SUCCESS, $response["response"]);
            } else {
                CSVP_Notification::add(CSVP_Notification::ERROR, $response["response"]);
            }
        }
        else if (isset($_POST["csvp_request"]) && $_POST["csvp_request"] == "aprrove_trasanction") {
            $payload = $_POST;
            $payload["status"] = VOUCHER_STATUS_PAID;
            $payload['status_transaction'] = 3;
            $payload["message"] = "Payment Set as Paid";
            $response = $this->transaction->update_transaction_status($payload);
            if ($response["status"] !== false) {
                CSVP_Notification::add(CSVP_Notification::SUCCESS, $response["response"]);
            } else {
                CSVP_Notification::add(CSVP_Notification::ERROR, $response["response"]);
            }
        }

        $pageData = [];

        $joined_communities = $this->community->get_all_joined_communities_for_store();
        $requested_communities = $this->community->get_all_requested_communities_for_store();
        $not_requested_communities = $this->community->get_all_not_requested_communities_for_store();


        if (isset ($_POST["non_agreed_store_filter"])) {
            $check_3["not_requested_communities"] = $not_requested_communities;
            if (!is_wp_error($check_3["not_requested_communities"])) {
                $pageData["not_requested_communities"] = $not_requested_communities;

            }
        } else if (isset ($_POST["agreed_store_filter"])) {
            $check_1["joined_communities"] = $joined_communities;
            if (is_wp_error($check_1["joined_communities"])) {
            } else {
                $pageData["joined_communities"] = $joined_communities;
            }
        } else {

            $check_1["joined_communities"] = $joined_communities;
            if (is_wp_error($check_1["joined_communities"])) {
            } else {
                $pageData["joined_communities"] = $joined_communities;
            }

            $check_2["requested_communities"] = $requested_communities;
            if (!is_wp_error($check_2["requested_communities"])) {
                $pageData["requested_communities"] = $requested_communities;

            }

            $check_3["not_requested_communities"] = $not_requested_communities;
            if (!is_wp_error($check_3["not_requested_communities"])) {
                $pageData["not_requested_communities"] = $not_requested_communities;

            }

        }

        if (isset ($_POST["csvp_filter"]) && $_POST["csvp_filter"] == "filter_communities_by_name") {

            unset($_POST["csvp_filter"]);
            $pageData["joined_communities"] = $filter->filterData($pageData["joined_communities"], $_POST);
            $pageData["requested_communities"] = $filter->filterData($pageData["requested_communities"], $_POST);
            $pageData["not_requested_communities"] = $filter->filterData($pageData["not_requested_communities"], $_POST);

        }


        CSVP_View_Manager::load_view('community-management', $pageData);
    }

    public static function render_coupon_management()
    {
        CSVP_View_Manager::load_view('coupon-management');
    }

    public function render_order_management()
    {

        global $filter;

        if (isset ($_POST["csvp_request"]) && $_POST["csvp_request"] == "aprrove_payment") {
            $payload = $_POST;
            $payload["store_id"] = $this->get_store_id();
            $payload["order_status"] = ORDER_STATUS_PAID;
            $payload["message"] = "Order Set As Paid";
            $response = $this->order->update_order_status($payload);
            if ($response["status"] !== false) {
                CSVP_Notification::add(CSVP_Notification::SUCCESS, $response["response"]);
            } else {
                CSVP_Notification::add(CSVP_Notification::ERROR, $response["response"]);
            }
        } else if (isset ($_POST["csvp_request"]) && $_POST["csvp_request"] == "request_payment") {
            $payload = $_POST;
            $payload["store_id"] = $this->get_store_id();
            $payload["order_status"] = ORDER_STATUS_PROCESSING;
            $payload["message"] = "Payment Request Sent";
            $response = $this->order->update_order_status($payload);
            if ($response["status"] !== false) {
                CSVP_Notification::add(CSVP_Notification::SUCCESS, $response["response"]);
            } else {
                CSVP_Notification::add(CSVP_Notification::ERROR, $response["response"]);
            }
        }

        $user_id = $this->get_store_id();
        if ($user_id) {
            $data = array(
                'store_id' => $user_id, // Replace 123 with the actual store ID
                'suffix' => '_store' // Replace '_xyz' with the actual suffix value
            );

            $order_requests = $this->order->get_orders_by_store_id($data);


            if (!is_wp_error($order_requests)) {

                $modified_order_requests = array();

                foreach ($order_requests as $request) {
                    $request["created_at"] = date("Y-m-d", strtotime($request["created_at"]));
                    array_push($modified_order_requests, $request);
                }
                $pageData["accepted_store_orders"] = $modified_order_requests;

                if (isset ($_POST["communities_filter"])) {

                    foreach ($_POST["community_array"] as $community_array) {
                        $pageData["accepted_store_orders"] = $filter->filterData($pageData["accepted_store_orders"], array('community_id' => $community_array));
                    }
                } else if (isset ($_POST["filter_by_order"])) {
                    foreach ($_POST["order_array"] as $order_array) {
                        $pageData["accepted_store_orders"] = $filter->filterData($pageData["accepted_store_orders"], array('id' => $order_array));
                    }
                } else if (isset ($_POST["order_range_filter"])) {


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
                        $filtered_data = $filter->filterData($pageData["accepted_store_orders"], array('created_at' => $date));
                        if (!empty ($filtered_data)) {
                            array_push($date_data, $filtered_data);
                        }
                    }


                    $pageData["accepted_store_orders"] = array_merge(...$date_data);

                }


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

    public function get_store_data_for_community_popup($data)
    {
        global $wpdb, $store, $community;

        $store_id = $data['store_id'];
        $community_id = $community->get_current_community_id();

        $query = $wpdb->prepare(
            "SELECT s.*, jr.credit_limit 
            FROM {$wpdb->prefix}csvp_store s 
            LEFT JOIN {$wpdb->prefix}csvp_joining_request jr 
            ON s.id = jr.store_id 
            WHERE s.id = %d AND jr.community_id = %d",
            $store_id,
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
            return new WP_Error('not_found', __('No Store Data found.', 'csvp'), array('status' => 404));
        }
    }

    public function render_order_request()
    {
        global $store;
        global $filter;
        if (isset ($_POST["csvp_request"]) && $_POST["csvp_request"] == "accept_order_request") {
            $payload = $_POST;
            $payload["order_status"] = ORDER_STATUS_COMPLETED;
            $payload["message"] = "Order Approved";
            $payload["store_id"] = $this->get_store_id();
            $response = $this->order->update_order_status($payload);
            if ($response["status"] !== false) {
                CSVP_Notification::add(CSVP_Notification::SUCCESS, $response["response"]);
            } else {
                CSVP_Notification::add(CSVP_Notification::ERROR, $response["response"]);
            }
        } else if (isset ($_POST["csvp_request"]) && $_POST["csvp_request"] == "cancel_order_request") {
            $payload = $_POST;
            $payload["order_status"] = ORDER_STATUS_CANCELLED;
            $payload["message"] = "Order Rejected";
            $payload["store_id"] = $this->get_store_id();
            $response = $this->order->update_order_status($payload);
            if ($response["status"] !== false) {
                CSVP_Notification::add(CSVP_Notification::SUCCESS, $response["response"]);
            } else {
                CSVP_Notification::add(CSVP_Notification::ERROR, $response["response"]);
            }
        }

        $store_id = $this->get_store_id();

        $data = array(
            'store_id' => $store_id, // Replace 123 with the actual store ID
            'suffix' => '_store' // Replace '_xyz' with the actual suffix value
        );

        $order_requests = $this->order->get_orders_by_store_id($data);

        $pageData["store_order_requests"] = $order_requests;

        if (!is_wp_error($order_requests)) {

            
            $modified_order_requests = array();

            foreach ($order_requests as $request) {
                $request["created_at"] = date("Y-m-d", strtotime($request["created_at"]));
                array_push($modified_order_requests, $request);
            }

            $pageData["store_order_requests"] = $modified_order_requests;


            if (isset ($_POST["communities_filter"])) {

                foreach ($_POST["community_array"] as $community_array) {
                    $pageData["store_order_requests"] = $filter->filterData($pageData["store_order_requests"], array('community_id' => $community_array));
                }
            } else if (isset ($_POST["filter_by_order"])) {
                foreach ($_POST["order_array"] as $order_array) {
                    $pageData["store_order_requests"] = $filter->filterData($pageData["store_order_requests"], array('id' => $order_array));
                }
            } else if (isset ($_POST["order_range_filter"])) {


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
                    $filtered_data = $filter->filterData($pageData["store_order_requests"], array('created_at' => $date));
                    if (!empty ($filtered_data)) {
                        array_push($date_data, $filtered_data);
                    }
                }


                $pageData["store_order_requests"] = array_merge(...$date_data);

            }

            CSVP_View_Manager::load_view('order-requests', $pageData);
        } else {
            // Handle error
            CSVP_Notification::add(CSVP_Notification::ERROR, "Something is Wrong");
        }

    }



    public function render_transaction_history()
    {
        global $transaction, $community, $community_member, $filter;


        $pageData = [];
        $data = [];
        $data['status'] = VOUCHER_STATUS_USED;
        $data['store_id'] = $this->get_store_id();
        $voucher_transactions = $this->voucherTransaction->get_all_voucher_transactions_by_store_id($data);

        $d_accumulated_transactions = $transaction->get_transactions_by_store_id($this->get_store_id());
        $accumulated_transactions = array();
        foreach ($d_accumulated_transactions as $transaction) {
            $communityData = $community->get_community_by_id($transaction["community_id"]); // line 118
            $memberData = $community_member->get_community_member_by_id(array('community_member_id' => $transaction["community_member_id"])); // line 118
            $transaction["community_data"] = $communityData;
            $transaction["member_data"] = $memberData;
            array_push($accumulated_transactions, $transaction);
        }

        $transactions = array_merge($voucher_transactions, $accumulated_transactions);
        $response["voucher_transactions"] = $voucher_transactions;
        if (is_wp_error($response["voucher_transactions"])) {
        } else {
            $pageData["transactions"] = $transactions;
        }

        CSVP_View_Manager::load_view('transaction-history', $pageData);
    }



    public function render_creating_transactions()
    {
        global $community_member, $community, $voucher_transaction, $transaction, $commision;

        if (isset ($_POST["csvp_request"]) && $_POST["csvp_request"] == "charge_voucher") {
            $payload = $_POST;
            $payload["transaction_type"] = VOUCHER_TRANSACTION_REDEEM;
            $payload["transaction_date"] = date("Y-m-d H:i:s");
            $payload["status"] = VOUCHER_STATUS_USED;
            unset($payload['csvp_request']);

            $response = $voucher_transaction->update_voucher_transaction($payload);

            if (!is_wp_error($response)) {


                $store = $this->get_store_data_by_id($this->get_store_id()); // line 118


                $commision_Data = array(
                    "entity_id" => $this->get_store_id(),
                    "entity_type" => CSVP_User_Roles::ROLE_STORE_MANAGER,
                    "commission_type" => COMMISSION_TYPE_ACCUMULATED,
                    "commission_value" => $store->fee_amount_per_transaction,
                    "commission_status" => COMMISSION_STATUS_PENDING
                );

                $commision->create_commission($commision_Data);


                CSVP_Notification::add(CSVP_Notification::SUCCESS, "Voucher has been charged successfully");
            } else {
                CSVP_Notification::add(CSVP_Notification::ERROR, $response);
            }

        } else if (isset ($_POST["csvp_request"]) && $_POST["csvp_request"] == "charge_card") {
            $payload = $_POST;

            $member = $community_member->get_community_member_by_id(array('community_member_id' => $payload["community_member_id"]));
            $updated_balance = $member->card_balance - $payload["transaction_amount"];
            $response = $community_member->update_community_member(array("community_member_id" => $payload["community_member_id"], "card_balance" => $updated_balance));

            $transaction_data = array(
                'community_id' => $member->community_id,
                'store_id' => $this->get_store_id(),
                'transaction_amount' => $payload["transaction_amount"],
                'transaction_type' => TRANSACTION_TYPE_DEBIT,
                'community_member_id' => $payload["community_member_id"]
            );

            $transaction->create_transaction($transaction_data);

            unset($payload['csvp_request']);


            if (!is_wp_error($response)) {

                $store = $this->get_store_data_by_id($this->get_store_id()); // line 118


                $commision_Data = array(
                    "entity_id" => $this->get_store_id(),
                    "entity_type" => CSVP_User_Roles::ROLE_STORE_MANAGER,
                    "commission_type" => COMMISSION_TYPE_ACCUMULATED,
                    "commission_value" => $store->fee_amount_per_transaction,
                    "commission_status" => COMMISSION_STATUS_PENDING
                );

                $commision->create_commission($commision_Data);

                CSVP_Notification::add(CSVP_Notification::SUCCESS, "Card has been charged successfully");
            } else {
                CSVP_Notification::add(CSVP_Notification::ERROR, $response->get_error_message());
            }
        }

        $joined_communities = $community->get_all_joined_communities_for_store();

        $community_members = array();
        if (!is_wp_error($joined_communities)) {
            foreach ($joined_communities as $request) {

                $members = $community_member->get_community_members_by_community_id(array("community_id" => $request['community_id']));

                array_push($community_members, $members);
            }
        }
        $community_members = array_reduce($community_members, function ($carry, $item) {
            if (is_array($item)) {
                return array_merge($carry, $item);
            }
            return $carry; // If $item is not an array, just return $carry unchanged
        }, []);

        $pageData["members"] = $community_members;
        CSVP_View_Manager::load_view('creating-transactions', $pageData);
    }


    public function get_all_joined_store_for_communities()
    {
        global $wpdb, $community;
        $community_id = $community->get_current_community_id();
        // Prepare SQL query to retrieve communities by name using LIKE operator

        // Prepare SQL query to select voucher transactions by member ID
        $query = $wpdb->prepare("SELECT * FROM {$wpdb->prefix}csvp_joining_request WHERE community_id = %d AND request_status = %s", $community_id, JOINING_REQUEST_STATUS_APPROVED);

        // Execute the query and fetch the results
        $joined_store = $wpdb->get_results($query, ARRAY_A);

        foreach ($joined_store as $key => $store) {
            $order_data = $this->get_order_data_by_id(($store["store_id"]));
            $joined_store[$key]["order_data"] = $order_data;

            $store_data = $this->get_store_data_by_id(($store["store_id"]));
            $joined_store[$key]["store_data"] = $store_data;
            $joined_store[$key]["store_name"] = $store_data->store_name;
        }

        // Check if communities were found
        if ($joined_store) {
            // Return array of community objects
            return $joined_store;
        } else {
            // Send error response
            return new WP_Error('not_found', __('No Joined Stores.', 'csvp'), array('status' => 404));
        }
    }

    public function get_all_requested_store_for_communities()
    {
        global $wpdb, $community;
        $community_id = $community->get_current_community_id();
        // Prepare SQL query to retrieve communities by name using LIKE operator

        // Prepare SQL query to select voucher transactions by member ID
        $query = $wpdb->prepare("SELECT * FROM {$wpdb->prefix}csvp_joining_request WHERE community_id = %d AND request_status = %s", $community_id, JOINING_REQUEST_STATUS_PENDING);

        // Execute the query and fetch the results
        $joined_store = $wpdb->get_results($query, ARRAY_A);

        foreach ($joined_store as $key => $store) {
            $order_data = $this->get_order_data_by_id(($store["store_id"]));
            $joined_store[$key]["order_data"] = $order_data;

            $store_data = $this->get_store_data_by_id(($store["store_id"]));
            $joined_store[$key]["store_data"] = $store_data;
            $joined_store[$key]["store_name"] = $store_data->store_name;
        }

        // Check if communities were found
        if ($joined_store) {
            // Return array of community objects
            return $joined_store;
        } else {
            // Send error response
            return new WP_Error('not_found', __('No Requested Stores.', 'csvp'), array('status' => 404));
        }
    }

    public function get_all_not_requested_store_for_communities()
    {
        global $wpdb, $community;
        $community_id = $community->get_current_community_id();
        // Prepare SQL query to retrieve store IDs
        $query = $wpdb->prepare("SELECT id FROM {$wpdb->prefix}csvp_store");
        $store_ids = $wpdb->get_results($query, ARRAY_A);
        $storesWithoutRequests = [];
        // Iterate over each store ID
        foreach ($store_ids as $row) {
            $store_id = $row["id"];
            // Prepare SQL query to check if there are any requests for this store and community
            $query = $wpdb->prepare("SELECT COUNT(*) AS count FROM {$wpdb->prefix}csvp_joining_request WHERE community_id = %d AND store_id = %d", $community_id, $store_id);
            $ids_result = $wpdb->get_results($query, ARRAY_A);
            // Check if there are any rows
            if ($ids_result && isset ($ids_result[0]["count"]) && $ids_result[0]["count"] == 0) {
                $storesWithoutRequests[] = $store_id;
            }
        }
        $not_requested_store = [];
        // Iterate over each store ID without requests
        foreach ($storesWithoutRequests as $key => $store_id) {
            // Get order data by store ID
            $order_data = $this->get_order_data_by_id($store_id);
            // Get store data by store ID
            $store_data = $this->get_store_data_by_id($store_id);
            // Append order data and store data to joined store array
            $not_requested_store[$key]["order_data"] = $order_data;
            $not_requested_store[$key]["store_data"] = $store_data;
            $not_requested_store[$key]["store_name"] = $store_data->store_name;

        }
        // Check if joined store data was found
        if (!empty ($not_requested_store)) {
            // Return array of joined store data
            return $not_requested_store;
        } else {
            // Send error response
            return new WP_Error('not_found', __('No stores without requests found.', 'csvp'), array('status' => 404));
        }
    }


    public function get_order_data_by_id($store_id)
    {
        global $wpdb;
        // Prepare SQL query to select aggregated order data
        $query = $wpdb->prepare("
            SELECT 
                store_id, 
                COUNT(id) AS order_count, 
                SUM(order_total) AS total_order_amount 
            FROM 
                {$wpdb->prefix}csvp_order 
            WHERE 
                store_id = %d 
                AND order_status != %s 
                AND order_status != %s 
                AND order_status != %s 
            GROUP BY 
                store_id
        ", $store_id, ORDER_STATUS_RETURNED, ORDER_STATUS_RETURNED_PAID, ORDER_STATUS_CANCELLED);
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



    public function get_store_data_by_id($store_id)
    {
        global $wpdb;
        $query = $wpdb->prepare("SELECT * FROM {$wpdb->prefix}csvp_store WHERE id = %d", $store_id);
        // Execute the query
        $store_data = $wpdb->get_row($query);

        // Check if a voucher was found
        if ($store_data) {
            // Return voucher data as an object
            return $store_data;
        } else {
            // Return false if voucher not found
            return false;
        }

    }


    public function get_store_data($data)
    {
        global $wpdb;

        $wp_user_id = $data['wp_user_id'];

        // Prepare SQL query to retrieve community member by ID
        $query = $wpdb->prepare(
            "SELECT * FROM $this->table_name WHERE wp_user_id = %d",
            $wp_user_id
        );

        // Execute the query
        $store = $wpdb->get_row($query);

        // Check if a community member was found
        if ($store) {
            // Return community member data as an object
            return $store;
        } else {
            // Return false if community member not found
            return false;
        }
    }

    public function render_return_management()
    {

        global $filter;

        if (isset ($_POST["csvp_request"]) && $_POST["csvp_request"] == "accept_order_return_request") {
            $payload = $_POST;
            $payload["order_status"] = ORDER_STATUS_RETURNED_PAID;
            $payload["message"] = "Credit Made";
            $payload["store_id"] = $this->get_store_id();
            $response = $this->order->update_order_status($payload);
            if ($response["status"] !== false) {
                CSVP_Notification::add(CSVP_Notification::SUCCESS, $response["response"]);
            } else {
                CSVP_Notification::add(CSVP_Notification::ERROR, $response["response"]);
            }
        }


        $store_id = $this->get_store_id();

        $data = array(
            'store_id' => $store_id, // Replace 123 with the actual store ID
            'suffix' => '_store' // Replace '_xyz' with the actual suffix value
        );

        $order_requests = $this->order->get_orders_by_store_id($data);


        if (!is_wp_error($order_requests)) {
            
            $pageData["store_return_order_requests"] = $order_requests;
            // echo json_encode($pageData["store_return_order_requests"]);


            $modified_order_requests = array();

            foreach ($order_requests as $request) {
                $request["created_at"] = date("Y-m-d", strtotime($request["created_at"]));
                array_push($modified_order_requests, $request);
            }
            $pageData["store_return_order_requests"] = $modified_order_requests;

            if (isset ($_POST["communities_filter"])) {

                foreach ($_POST["community_array"] as $community_array) {
                    $pageData["store_return_order_requests"] = $filter->filterData($pageData["store_return_order_requests"], array('community_id' => $community_array));
                }
            } else if (isset ($_POST["filter_by_order"])) {
                foreach ($_POST["order_array"] as $order_array) {
                    $pageData["store_return_order_requests"] = $filter->filterData($pageData["store_return_order_requests"], array('id' => $order_array));
                }
            } else if (isset ($_POST["order_range_filter"])) {


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
                    $filtered_data = $filter->filterData($pageData["store_return_order_requests"], array('created_at' => $date));
                    if (!empty ($filtered_data)) {
                        array_push($date_data, $filtered_data);
                    }
                }


                $pageData["store_return_order_requests"] = array_merge(...$date_data);

                

            }
            CSVP_View_Manager::load_view('return-management', $pageData);
        } else {
            // Handle error
            CSVP_Notification::add(CSVP_Notification::ERROR, "Something is Wrong");
        }
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
        $store_mail_address = $data['store_mail_address'];
        $store_cashier_phone = $data["store_cashier_phone"];
        $password = $data["password"];
        $fee_amount_per_transaction = $data['fee_amount_per_transaction'];
        if (!$this->get_store_by_email(array('email_address' => $store_mail_address))) {

            $email_exists = email_exists($store_mail_address);

            if (!$email_exists) {

                if (isset ($_FILES['store_logo']) && $_FILES['store_logo']['error'] == UPLOAD_ERR_OK) {

                    // Handle file upload
                    $upload_dir = wp_upload_dir(); // Get the upload directory
                    $file_name = basename($_FILES['store_logo']['name']);

                    // Get the file extension
                    $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);

                    // Generate a unique identifier (timestamp or random string)
                    $unique_identifier = uniqid(); // Using a timestamp-based unique identifier

                    // Construct the file name with the extension
                    $file_name = 'store_logo' . $unique_identifier . '.' . $file_extension;


                    // Check if the upload directory is writable
                    $moved = move_uploaded_file($_FILES['store_logo']['tmp_name'], $upload_dir['path'] . '/' . $file_name);

                    if ($moved) {

                        $file_path = $upload_dir['subdir'] . '/' . $file_name;


                        // Create WordPress user
                        $user_id = wp_create_user($store_mail_address, $password, $store_mail_address);
                        $user_id_role = new WP_User($user_id);
                        $user_id_role->set_role(CSVP_User_Roles::ROLE_STORE_MANAGER);

                        // Insert data into the database
                        $wpdb->insert(
                            $this->table_name, // Table name
                            array(
                                'store_name' => $store_name,
                                'store_phone' => $store_phone,
                                'store_address' => $store_address,
                                'store_logo' => $file_path,
                                'store_mail_address' => $store_mail_address,
                                'wp_user' => get_current_user_id(),
                                'fee_amount_per_transaction' => $fee_amount_per_transaction,
                                'wp_user_id' => $user_id,
                                'store_cashier_phone' => $store_cashier_phone
                            ) // Data to be inserted
                        );

                        // Check if the insertion was successful
                        if ($wpdb->insert_id) {
                            // Return the ID of the newly inserted store
                            return $wpdb->insert_id;
                        } else {
                            // Send error response
                            return new WP_Error('database_error', __('Failed to create Store.', 'csvp'), array('status' => 500));
                        }
                    }
                } else {
                    return array("status" => false, "response" => "No Store image uploaded or error occurred");
                }
            } else {

                // Send error response
                return new WP_Error('request_error', __('Failed to create Store. Email Already Exists', 'csvp'), array('status' => 500));
            }
        } else {
            return new WP_Error('request_error', __('Failed to create Store. Email Already Exists', 'csvp'), array('status' => 500));
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
     * Function to retrieve a store by its ID from the database.
     *
     * @param int $store_id The ID of the store to retrieve.
     * @return object|false Store data as an object if found, or false if not found.
     */
    public function get_store_by_user_id($user_id)
    {
        global $wpdb;

        // Prepare SQL query to retrieve store data by ID
        $query = $wpdb->prepare(
            "SELECT * FROM $this->table_name WHERE wp_user_id = %d",
            $user_id
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
        $query = "SELECT * FROM $this->table_name WHERE store_mail_address = '$community_email'";

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
    public function get_all_stores($data = array())
    {
        global $wpdb;

        $count = isset ($data["count"]) ? true : false;

        // Prepare SQL query to select all stores
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
                return new WP_Error('not_found', __('No stores found.', 'csvp'), array('status' => 404));
            }
        }
    }

    public function get_store_id($user_id = false)
    {
        if (!$user_id) {
            if (CSVP_User_Roles::user_has_role(get_current_user_id(), CSVP_User_Roles::ROLE_STORE_MANAGER)) {
                $store_data = $this->get_store_by_user_id(get_current_user_id());
                return $store_data->id;
            } else {
                return false;
            }
        } else {
            $store_data = $this->get_store_by_user_id($user_id);
            return $store_data->id;
        }
    }

    public function get_store_user_data_by_id($data)
    {
        $id = $data['id'];
        $user_data = get_userdata($id);
        return $user_data;

    }
}
