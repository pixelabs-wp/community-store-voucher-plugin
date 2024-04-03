<?php

class CSVP_CommunityMember
{
    // Properties
    private $table_name;
    private $joining_request;
    public $community_member_user;
    public $community_id;
    public $balance_table;
    // Constructor
    public function __construct()
    {
        global $wpdb;
        $this->table_name = $wpdb->prefix . 'csvp_community_member';
        $this->balance_table = $wpdb->prefix . 'csvp_balance';
        $this->joining_request = new CSVP_JoiningRequest();
        $this->community_member_user = $this->get_community_member_by_user_id(array('wp_user_id' => get_current_user_id()));
    }

    //Method to render transaction history
    public function render_transaction_history()
    {
        global $transaction;
        $pageData = [];
        $pageData["data"] = $transaction->get_all_transactions_by_community_member_id();
        CSVP_View_Manager::load_view('transaction-history', $pageData);
    }

    public function render_loading_history()
    {

        global $filter;
        $pageData = [];
        $pageData["transactions"] = $this->get_all_balances(array("member_id" => $this->community_member_user->id));

        // if (isset ($_POST["filter_by_load_id"])) {


        //     unset($_POST["filter_by_load_id"]);
        //     echo json_encode($_POST);

        //     foreach ($_POST["id_array"] as $id) {
        //         $pageData["transactions"] = $filter->filterData($pageData["transactions"], array('id' => $id));
        //     }

        // }

        // echo json_encode($pageData);
        CSVP_View_Manager::load_view('loading-history', $pageData);
    }

    public function render_load_card()
    {
        global $community;
        $pageData["community"] = $community->get_community_by_id($community->get_current_community_id());
        $pageData["member"] = $this->community_member_user;
        $pageData["transactions"] = $this->get_all_balances(array("member_id" => $this->community_member_user->id, "limit" => 2));
        CSVP_View_Manager::load_view('load-card', $pageData);
    }

    public function render_coupons()
    {
        global $voucher_transaction, $voucher, $store, $community, $filter;

        if (isset($_POST["csvp_request"]) && $_POST["csvp_request"] == "purchase_voucher") {
            $payload = $_POST;

            $member_balance = $this->community_member_user->card_balance;

            if ($payload["transaction_amount"] > $member_balance) {
                CSVP_Notification::add(CSVP_Notification::ERROR, "You card balance is less than the required amount");
            } else {
                $payload["transaction_type"] = VOUCHER_TRANSACTION_PURCHASE;
                $payload["transaction_date"] = date("Y-m-d H:i:s");
                $payload["status"] = VOUCHER_STATUS_PENDING;
                $response = $voucher_transaction->create_voucher_transaction($payload);

                if (!is_wp_error($response)) {

                    $updated_balance = $member_balance - $payload["transaction_amount"];
                    $this->update_community_member(array("community_member_id" => $payload["community_member_id"], "card_balance" => $updated_balance));

                    CSVP_Notification::add(CSVP_Notification::SUCCESS, "Voucher has been purchased successfully");
                } else {
                    CSVP_Notification::add(CSVP_Notification::ERROR, $response->get_error_message());
                }
            }
        }
        $voucherData = $voucher->get_all_vouchers_by_community_id(array('community_id' => $this->community_member_user->community_id));
        $modified_storeData = array();
        foreach ($voucherData as $voucher) {

            $voucher["store_data"] = $store->get_store_by_id($voucher["store_id"]);
            $voucher["community_data"] = $community->get_community_by_id($voucher["community_id"]);
            array_push($modified_storeData, $voucher);
        }


        $pageData["vouchers"] = $modified_storeData;


        if (isset($_POST["product_search"])) {

            unset($_POST["product_search"]);

            $pageData["vouchers"] = $filter->filterData($pageData["vouchers"], $_POST);

        } 

        else if (isset ($_POST["filter_by_stores"])) {
            foreach ($_POST["stores_array"] as $stores_array) {
                $pageData["vouchers"] = $filter->filterData($pageData["vouchers"], array('store_id' => $stores_array));

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

        else if (isset ($_POST["filter_by_product"])) {
            foreach ($_POST["product_array"] as $product_array) {
                $pageData["vouchers"] = $filter->filterData($pageData["vouchers"], array('product_name' => $product_array));
            }
        }


        CSVP_View_Manager::load_view('coupons', $pageData);
    }

    public function render_shops()
    {
        global $voucher_transaction;

        if (isset($_POST["csvp_request"]) && $_POST["csvp_request"] == "purchase_voucher") {
            $payload = $_POST;

            $member_balance = $this->community_member_user->card_balance;

            if ($payload["transaction_amount"] > $member_balance) {
                CSVP_Notification::add(CSVP_Notification::ERROR, "You card balance is less than the required amount");
            } else {
                $payload["transaction_type"] = VOUCHER_TRANSACTION_PURCHASE;
                $payload["transaction_date"] = date("Y-m-d H:i:s");
                $payload["status"] = VOUCHER_STATUS_PENDING;
                $response = $voucher_transaction->create_voucher_transaction($payload);

                if (!is_wp_error($response)) {

                    $updated_balance = $member_balance - $payload["transaction_amount"];
                    $this->update_community_member(array("community_member_id" => $payload["community_member_id"], "card_balance" => $updated_balance));

                    CSVP_Notification::add(CSVP_Notification::SUCCESS, "Voucher has been purchased successfully");
                } else {
                    CSVP_Notification::add(CSVP_Notification::ERROR, $response->get_error_message());
                }
            }


        }

        $shops = $this->joining_request->get_all_joining_requests(
            array(
                "community_id" => $this->community_member_user->community_id,
                "status" => JOINING_REQUEST_STATUS_APPROVED
            )
        );
        $pageData["shops"] = $shops;
        CSVP_View_Manager::load_view('shops', $pageData);
    }

    // Method to create a community member
    public function create_community_member($data)
    {
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
                return array("status" => true, "response" => "Guy created successfully: " . $data["full_name"]);

            } else {
                $error_message = $wpdb->last_error;
                // Delete user if insertion failed
                wp_delete_user($user_id);
                return array("status" => false, "response" => $error_message);
            }
        } else {
            if (is_wp_error($user_id)) {
                // Error occurred during user creation
                $error_message = $user_id->get_error_message();
                return array("status" => false, "response" => $error_message);
            } else {
                return array("status" => false, "response" => "Something Went Wrong");
            }
        }
    }


    // Method to get a community member by ID
    public function get_community_member_by_id($data)
    {
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
    public function get_community_member_by_email($data)
    {
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
    public function update_community_member($data)
    {
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
    public function delete_community_member($data)
    {
        global $wpdb;

        $community_member_id = $data['community_member_id'];

        // Prepare SQL query to delete community member by ID
        $query = $wpdb->prepare("DELETE FROM $this->table_name WHERE id = %d", $community_member_id);

        // Execute the query and return true on success, false on failure
        return $wpdb->query($query) !== false;
    }

    // Method to get all community members
    public function get_all_community_members()
    {
        global $wpdb;

        // Prepare SQL query to select all community members
        $query = "SELECT * FROM $this->table_name";

        // Execute the query and fetch the results
        $community_members = $wpdb->get_results($query, ARRAY_A);

        // Return the results if any, otherwise return null
        return !empty($community_members) ? $community_members : null;
    }

    // Method to get community members by community ID
    public function get_community_members_by_community_id($data)
    {
        global $wpdb;

        $community_id = $data['community_id'];
        $count = isset($data["count"]) ? true : false;

        // Prepare SQL query to select community members by community ID
        $query = $wpdb->prepare("SELECT * FROM $this->table_name WHERE community_id = %d", $community_id);

        // Execute the query and fetch the results
        $community_members = $wpdb->get_results($query, ARRAY_A);
        if ($count) {
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
    public function get_balance_by_member_id($member_id)
    {
        global $wpdb;

        $query = $wpdb->prepare(
            "SELECT balance_amount, SUM(balance_amount) as total_balance FROM $this->balance_table WHERE community_member_id = %d GROUP BY community_member_id",
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
    public function update_balance($data)
    {
        global $wpdb;
        [$member_id, $new_balance] = $data;
        $result = $wpdb->update(
            $this->balance_table,
            array('balance_amount' => $new_balance),
            array('community_member_id' => $member_id)
        );

        return $result !== false;
    }

    /**
     * Update balance for a member.
     *
     * @param int $member_id The ID of the community member.
     * @param float $new_balance The new balance amount.
     * @return bool True if update successful, false otherwise.
     */
    public function add_balance($data)
    {
        global $wpdb, $transaction, $notification;
        $member_id = $data['member_id'];
        $store_id = isset($data['store_id']) ? $data['store_id'] : 0;
        $transaction_type = isset($data['transaction_type']) ? $data['transaction_type'] : TRANSACTION_TYPE_CREDIT;
        $new_balance = $data['new_balance'];
        $current_balance = $this->get_balance_by_member_id($member_id);
        $current_balance = $current_balance + $new_balance;

        $member = $this->get_community_member_by_id(array("community_member_id" => $member_id));
        $card_balance = $member->card_balance;
        $card_balance = $card_balance + $new_balance;
        $this->update_community_member(array("community_member_id" => $member_id, "card_balance" => $card_balance));

        $result = $wpdb->insert(
            $this->balance_table,
            array(
                'balance_amount' => $new_balance,
                'community_member_id' => $member_id
            )
        );

        $transaction_data = array(
            'community_id' => $member->community_id,
            'store_id' => $store_id,
            'transaction_amount' => $new_balance,
            'transaction_type' => $transaction_type,
            'community_member_id' => $member_id
        );

        $transaction->create_transaction($transaction_data);

        // $args = array(
        //     "wp_user" => get_current_user_id(),
        //     "action_type" => ACTION_LOAD_CARD,
        //     "recipients" => json_encode(array(CSVP_User_Roles::ROLE_COMMUNITY_MEMBER => $member_id, CSVP_User_Roles::ROLE_COMMUNITY_MANAGER => $member->community_id))
        // );

        // echo json_encode($args);

        // $notification->create_notification($args);

        return $result !== false;
    }

    /**
     * Get all balances.
     *
     * @return array|false Array of balance amounts if found, false otherwise.
     */
    public function get_all_balances($data)
    {
        global $wpdb;

        $member_id = $data["member_id"] ? $data["member_id"] : false;
        $imit = isset($data["limit"]) ? "  ORDER BY id DESC LIMIT " . $data["limit"] . "" : "";
        if ($member_id) {
            $query = "SELECT * FROM $this->balance_table WHERE community_member_id = '$member_id' $imit";
        } else {
            $query = "SELECT * FROM $this->balance_table $imit";
        }


        $balances = $wpdb->get_results($query);

        return $balances !== null ? $balances : false;
    }

    public function get_member_by_member_id($user_id)
    {
        global $wpdb;

        // Prepare SQL query to retrieve store data by ID
        $query = $wpdb->prepare(
            "SELECT * FROM $this->table_name WHERE wp_user_id = %d",
            $user_id
        );

        // Execute the query
        $member = $wpdb->get_row($query);

        // Check if a store was found
        if ($member) {
            // Return store data as an object
            return $member;
        } else {
            // Send error response
            return false;
        }
    }


    public function get_community_id($user_id = false)
    {
        if (!$user_id) {
            if (CSVP_User_Roles::user_has_role(get_current_user_id(), CSVP_User_Roles::ROLE_COMMUNITY_MEMBER)) {
                $member_data = $this->get_member_by_member_id(get_current_user_id());
                return $member_data->id;
            } else {
                return false;
            }
        } else {
            $member_data = $this->get_member_by_member_id($user_id);
            return $member_data->id;
        }
    }
}

?>