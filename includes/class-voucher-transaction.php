<?php

class CSVP_VoucherTransaction{
    // Properties
    private $table_name;
    private $voucher;

    // Constructor
    public function __construct() {
        global $wpdb;
        $this->table_name = $wpdb->prefix . 'csvp_voucher_transaction';
        $this->voucher = new CSVP_Voucher();
    }

   public function create_voucher_transaction($data) {
        global $wpdb;

        // Extract data from the input array
        $community_member_id = $data['community_member_id'];
        $voucher_id = $data['voucher_id'];
        $transaction_type = $data['transaction_type'];
        $transaction_amount = $data['transaction_amount'];
        $transaction_date = $data['transaction_date'];
        $status = $data['status'];

        // Insert data into the database
        $wpdb->insert(
            $this->table_name,
            array(
                'community_member_id' => $community_member_id,
                'voucher_id' => $voucher_id,
                'transaction_type' => $transaction_type,
                'transaction_amount' => $transaction_amount,
                'transaction_date' => $transaction_date,
                'status' => $status
            )
        );

        // Check if the insertion was successful
        if ($wpdb->insert_id) {
            // Return the ID of the newly inserted voucher transaction
            return $wpdb->insert_id;
        } else {
            // Return false if insertion failed
            return new WP_Error('database_error', __('Failed to create community.', 'csvp'), array('status' => 500));
        }
    }

    public function update_voucher_transaction($data) {
        global $wpdb;

        $voucher_transaction_id = $data['voucher_transaction_id'];

        // Remove voucher_transaction_id from the data array to prevent updating it
        unset($data['voucher_transaction_id']);

        // Format the update data for the SQL query
        $update_data = [];
        foreach ($data as $key => $value) {
            $update_data[] = "$key = '$value'";
        }

        // Prepare SQL query to update voucher transaction data
        $query = $wpdb->prepare(
            "UPDATE $this->table_name SET " . implode(', ', $update_data) . " WHERE id = %d",
            $voucher_transaction_id // Voucher transaction ID for the WHERE clause
        );

        // Execute the query and return true on success, false on failure
        return $wpdb->query($query) !== false;
    }

    public function delete_voucher_transaction($data) {
        global $wpdb;

        $voucher_transaction_id = $data['voucher_transaction_id'];

        // Prepare SQL query to delete voucher transaction by ID
        $query = $wpdb->prepare("DELETE FROM $this->table_name WHERE id = %d", $voucher_transaction_id);

        // Execute the query and return true on success, false on failure
        return $wpdb->query($query) !== false;
    }

    public function get_all_voucher_transactions($data) {
        global $wpdb;

        $status = isset($data['status']) ? $data['status'] : false;
        if (!$status) {
            // Prepare SQL query to select voucher transactions by member ID
            $query = "SELECT * FROM $this->table_name";
        } else {
            $query = $wpdb->prepare("SELECT * FROM $this->table_name WHERE status = %d", $status);
        }    
        // Execute the query and fetch the results
        $voucher_transactions = $wpdb->get_results($query, ARRAY_A);

        // Return the results if any, otherwise return null
        return !empty($voucher_transactions) ? $voucher_transactions : null;
    }

    public function get_all_voucher_transactions_by_store_id($data) {
        global $wpdb;
        $status = isset($data['status']) ? $data['status'] : false;
        $logged_in_store_id = $data['store_id'];

            // Prepare SQL query to select voucher transactions by member ID
            $query = $wpdb->prepare("SELECT vt.*
            FROM wp_csvp_voucher_transaction vt
            INNER JOIN wp_csvp_voucher v ON vt.voucher_id = v.id
            WHERE v.store_id  = %d AND vt.status = %s",  $logged_in_store_id, $status);
    
        // Execute the query and fetch the results
        $voucher_transactions = $wpdb->get_results($query, ARRAY_A);

        foreach ($voucher_transactions as $key => $vouchers) {
            $voucher_data = $this->get_voucher_data_by_id(($vouchers["voucher_id"]));
            $voucher_transactions[$key]["voucher_data"] = $voucher_data;

            $community = $this->get_community_data_by_id($voucher_data->community_id); // line 118
            $voucher_transactions[$key]["community_data"] = $community;

            $member = $this->get_member_data_by_id($vouchers["community_member_id"]); // line 118
            $voucher_transactions[$key]["member_data"] = $member;
        }

        // Return the results if any, otherwise return null
        return !empty($voucher_transactions) ? $voucher_transactions : array();
    }

    public function get_voucher_data_by_id($voucher_id) {
        global $wpdb;

        $voucher_data_table = $wpdb->prefix . 'csvp_voucher';
        // Prepare SQL query to retrieve voucher data by ID
        $query = $wpdb->prepare(
            "SELECT * FROM $voucher_data_table WHERE id = %d",
            $voucher_id
        );

        // Execute the query
        $voucher = $wpdb->get_row($query);

        // Check if a voucher was found
        if ($voucher) {
            // Return voucher data as an object
            return $voucher;
        } else {
            // Return false if voucher not found
            return false;
        }
    }
    
    public function get_community_data_by_id($community_id) {
        global $wpdb;
      
        $community_data_table = $wpdb->prefix . 'csvp_community';
        // Prepare SQL query to retrieve community data by ID
        $query = $wpdb->prepare(
            "SELECT * FROM $community_data_table WHERE id = %d",
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


    public function get_store_data_by_id($store_id) {
        global $wpdb;
      
        $store_data_table = $wpdb->prefix . 'csvp_store';
        // Prepare SQL query to retrieve community data by ID
        $query = $wpdb->prepare(
            "SELECT * FROM $store_data_table WHERE id = %d",
            $store_id
        );

        // Execute the query
        $store = $wpdb->get_row($query);

        // Check if a community was found
        if ($store) {
            // Return community data as an object
            return $store;
        } else {
            // Send error response
            return new WP_Error('not_found', __('Store not found.', 'csvp'), array('status' => 404));
        }
    }

    public function get_member_data_by_id($community_member_id) {
        global $wpdb;
        
        $community_member_data_table = $wpdb->prefix . 'csvp_community_member';
        // Prepare SQL query to retrieve community member by ID
        $query = $wpdb->prepare(
            "SELECT * FROM $community_member_data_table WHERE id = %d",
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

    public function get_all_voucher_transactions_by_community_id($data)
        {
            global $wpdb, $community;
            $community_member = $wpdb->prefix . 'csvp_community_member';
            $status = isset($data['status']) ? $data['status'] : false;
            $community_id = isset($data['community_id']) ? $data['community_id'] : $community->get_current_community_id();
            if (!$status) {
            // Prepare SQL query to select voucher transactions by member ID
            $query = $wpdb->prepare("SELECT t.* FROM $this->table_name AS t  INNER JOIN $community_member AS m ON t.community_member_id = m.id WHERE m.community_id = %d", $community_id);

            } else {
                $query = $wpdb->prepare("SELECT t.* FROM $this->table_name AS t  INNER JOIN $community_member AS m ON t.community_member_id = m.id WHERE m.community_id = %d AND t.status = %d", $community_id, $status);
            }
            // Execute the query and fetch the results
            $voucher_transactions = $wpdb->get_results($query, ARRAY_A);

        foreach ($voucher_transactions as $key => $transaction) {
            
            $member = $this->get_member_data_by_id($transaction["community_member_id"]); // line 118
            $voucher_transactions[$key]["member_data"] = $member;

            $voucher_data = $this->get_voucher_data_by_id(($transaction["voucher_id"]));
            $voucher_transactions[$key]["voucher_data"] = $voucher_data;

            $store = $this->get_store_data_by_id($voucher_data->store_id); // line 118
            $voucher_transactions[$key]["store_data"] = $store;
        }


            // Return the results if any, otherwise return null
            return !empty($voucher_transactions) ? $voucher_transactions : null;
        }
    


    public function get_voucher_transactions_by_member_id($data) {
        global $wpdb, $store, $voucher;
        
        $member_id = $data['member_id'];
        $status = isset($data['status']) ? $data['status'] : false;
        $count = isset($data['count']) ? $data['count'] : false;
        
        if(!$status){
            // Prepare SQL query to select voucher transactions by member ID
            $query = $wpdb->prepare("SELECT * FROM $this->table_name WHERE community_member_id = %d", $member_id);
        } else {
            $query = $wpdb->prepare("SELECT * FROM $this->table_name WHERE community_member_id = %d AND status = %d", $member_id, $status);

        }
        // Execute the query and fetch the results
        $voucher_transactions = $wpdb->get_results($query, ARRAY_A);

        if(!$count){

            $modifiedTransactions = array();

            foreach ($voucher_transactions as $transaction) {
                $transaction["voucher_data"] = $this->voucher->get_voucher_by_id(array("voucher_id"=>$transaction["voucher_id"]));
                $transaction["store_data"] = $store->get_store_by_id($transaction["voucher_data"][0]->store_id);
                array_push($modifiedTransactions, $transaction);
            }

            return $modifiedTransactions;
        } else {
            return $wpdb->num_rows;
        }
       
    }


    public function get_vouchers_by_member_id_and_store_id($data)
    {
        global $wpdb, $store, $voucher;

        $member_id = $data['member_id'];
        $store_id = $data['store_id'];
        $status = $data['status'];
        $count = isset($data['count']) ? $data['count'] : false;

        $query = $wpdb->prepare("SELECT * FROM $this->table_name WHERE community_member_id = %d AND status = %s", $member_id, $status);
        // Execute the query and fetch the results
        $voucher_transactions = $wpdb->get_results($query, ARRAY_A);

        if (!$count) {

            $modifiedTransactions = array();

            foreach ($voucher_transactions as $transaction) {
                $transaction["voucher_data"] = $this->voucher->get_voucher_by_id(array("voucher_id" => $transaction['voucher_id']));
                $transaction["store_data"] = $store->get_store_by_id($transaction["voucher_data"][0]->store_id);
                if($transaction["voucher_data"][0]->store_id == $store_id){
                    array_push($modifiedTransactions, $transaction);
                }
            }

            return $modifiedTransactions;
        } else {
            return $wpdb->num_rows;
        }
    }

    public function get_voucher_transactions_by_voucher_id($data) {
        global $wpdb;

        $voucher_id = $data['voucher_id'];

        // Prepare SQL query to select voucher transactions by voucher ID
        $query = $wpdb->prepare("SELECT * FROM $this->table_name WHERE voucher_id = %d", $voucher_id);

        // Execute the query and fetch the results
        $voucher_transactions = $wpdb->get_results($query, ARRAY_A);

        // Return the results if any, otherwise return null
        return !empty($voucher_transactions) ? $voucher_transactions : null;
    }

}

?>
