<?php
class CSVP_Transaction{
    // Properties
    private $table_name;

    // Constructor
    public function __construct() {
        global $wpdb;
        $this->table_name = $wpdb->prefix . 'csvp_transaction';
    }

    /**
     * Function to create a new transaction in the database.
     *
     * @param array $data An associative array containing transaction data.
     * @return int|false The ID of the newly inserted transaction if successful, or false on failure.
     */
    public function create_transaction($data) {
        global $wpdb;

        // Extract data from the input array
        $community_id = $data['community_id'];
        $store_id = $data['store_id'];
        $transaction_type = $data['transaction_type'];
        $transaction_amount = $data['transaction_amount'];
        $community_member_id = $data['community_member_id'];
        $transaction_date = isset($data['transaction_date']) ? $data['transaction_date'] : current_time('mysql');

        // Insert data into the database
        $wpdb->insert(
            $this->table_name, // Table name
            array(
                'community_id' => $community_id,
                'store_id' => $store_id,
                'transaction_type' => $transaction_type,
                'transaction_amount' => $transaction_amount,
                'transaction_date' => $transaction_date,
                'community_member_id' => $community_member_id
            ) // Data to be inserted
        );

        // Check if the insertion was successful
        if ($wpdb->insert_id) {
            // Return the ID of the newly inserted transaction
            return $wpdb->insert_id;
        } else {
            // Return false if insertion failed
            return false;
        }
    }

    public function get_transaction_by_id($transaction_id) {
        global $wpdb;

        // Prepare SQL query to retrieve transaction data by ID
        $query = $wpdb->prepare(
            "SELECT * FROM $this->table_name WHERE id = %d",
            $transaction_id
        );

        // Execute the query
        $transaction = $wpdb->get_row($query);

        // Check if a transaction was found
        if ($transaction) {
            // Return transaction data as an object
            return $transaction;
        } else {
            // Return false if transaction not found
            return false;
        }
    }

    public function update_transaction($transaction_id, $data) {
        global $wpdb;

        // Extract transaction ID from the data array
        $transaction_id = $data['transaction_id'];

        // Remove transaction_id from the data array to prevent updating it
        unset($data['transaction_id']);

        // Format the update data for the SQL query
        $update_data = [];
        foreach ($data as $key => $value) {
            $update_data[] = "$key = '$value'";
        }

        // Prepare SQL query to update transaction data
        $query = $wpdb->prepare(
            "UPDATE $this->table_name SET " . implode(', ', $update_data) . " WHERE id = %d",
            array_values($data), // Values to be replaced in the query
            $transaction_id // Transaction ID for the WHERE clause
        );

        // Execute the query and return true on success, false on failure
        return $wpdb->query($query) !== false;
    }

    public function delete_transaction($transaction_id) {
        global $wpdb;

        // Prepare SQL query to delete transaction by ID
        $query = $wpdb->prepare("DELETE FROM $this->table_name WHERE id = %d", $transaction_id);

        // Execute the query and return true on success, false on failure
        return $wpdb->query($query) !== false;
    }

    public function get_all_transactions() {
        global $wpdb;

        // Prepare SQL query to select all transactions
        $query = "SELECT * FROM $this->table_name";

        // Execute the query and fetch the results
        $results = $wpdb->get_results($query, ARRAY_A);

        // Return the results if any, otherwise return null
        return !empty($results) ? $results : null;
    }

    public function get_transactions_by_community_id($community_id) {
        global $wpdb;

        // Prepare SQL query to select transactions by community ID
        $query = $wpdb->prepare(
            "SELECT * FROM $this->table_name WHERE community_id = %d",
            $community_id
        );

        // Execute the query and fetch the results
        $amount_transactions = $wpdb->get_results($query, ARRAY_A);

        foreach ($amount_transactions as $key => $transaction) {
            $member = $this->get_member_data_by_id($transaction["community_member_id"]); // line 118
            $amount_transactions[$key]["member_data"] = $member;
        }



        // Return the results if any, otherwise return null
        return !empty($amount_transactions) ? $amount_transactions : null;
    }

    public function get_unpaid_transactions_monthly_data_by_community_id($data) {
        global $wpdb, $store;
        $community_id = $data['community_id'];
        $store_id = $data['community_id'];
        $current_month = date('m');
        $current_year = date('Y');
        // $store_id = $store->get_store_id();
    
        $previous_month_1 = date('m-Y', strtotime('-1 month'));
        $previous_month_2 = date('m-Y', strtotime('-2 months'));
    
        $query_current_month = $wpdb->prepare("SELECT SUM(transaction_amount) AS total_amount, COUNT(id) as total_transactions FROM $this->table_name WHERE MONTH(transaction_date) = %d AND YEAR(transaction_date) = %d AND community_id = %d AND store_id = %d AND transaction_type = %s AND is_active = 1", $current_month, $current_year, $community_id, $store_id, TRANSACTION_TYPE_DEBIT );
        $current_month_data = $wpdb->get_row($query_current_month, ARRAY_A);

        $query_current_month_voucher = $wpdb->prepare("SELECT SUM(v.voucher_price) AS total_amount, COUNT(vt.id) AS total_transactions FROM {$wpdb->prefix}csvp_voucher_transaction AS vt INNER JOIN {$wpdb->prefix}csvp_voucher AS v ON vt.voucher_id = v.id WHERE MONTH(vt.transaction_date) = %d AND YEAR(vt.transaction_date) = %d AND v.community_id = %d AND v.store_id = %d AND vt.status = %s", $current_month, $current_year, $community_id, $store_id, VOUCHER_STATUS_USED );
        $current_month_voucher_data = $wpdb->get_row($query_current_month_voucher);

        $query_current_month = $wpdb->prepare("SELECT SUM(transaction_amount) AS total_amount, COUNT(id) as total_transactions FROM $this->table_name WHERE MONTH(transaction_date) = %d AND YEAR(transaction_date) = %d AND community_id = %d AND store_id = %d AND transaction_type = %s AND is_active = 1", $current_month, $current_year, $community_id, $store_id, TRANSACTION_TYPE_DEBIT );
        $current_month_data = $wpdb->get_row($query_current_month, ARRAY_A);
    
        $query_previous_month_1 = $wpdb->prepare("SELECT SUM(transaction_amount) AS total_amount, COUNT(id) as total_transactions FROM $this->table_name WHERE MONTH(transaction_date) = %d AND YEAR(transaction_date) = %d AND community_id = %d AND store_id = %d AND transaction_type = %s AND is_active = 1", substr($previous_month_1, 0, 2),  substr($previous_month_1, 3),  $community_id, $store_id, TRANSACTION_TYPE_DEBIT );
        $previous_month_1_data = $wpdb->get_row($query_previous_month_1, ARRAY_A);

        $query_previous_month_1_voucher = $wpdb->prepare("SELECT SUM(v.voucher_price) AS total_amount, COUNT(vt.id) AS total_transactions FROM {$wpdb->prefix}csvp_voucher_transaction AS vt INNER JOIN {$wpdb->prefix}csvp_voucher AS v ON vt.voucher_id = v.id WHERE MONTH(vt.transaction_date) = %d AND YEAR(vt.transaction_date) = %d AND v.community_id = %d AND v.store_id = %d AND vt.status = %s", substr($previous_month_1, 0, 2), substr($previous_month_1, 3), $community_id, $store_id, VOUCHER_STATUS_USED );
        $previous_month_1_voucher_data = $wpdb->get_row($query_previous_month_1_voucher);

        $query_previous_month_2 = $wpdb->prepare("SELECT SUM(transaction_amount) AS total_amount, COUNT(id) as total_transactions FROM $this->table_name WHERE MONTH(transaction_date) = %d AND YEAR(transaction_date) = %d AND community_id = %d AND store_id = %d AND transaction_type = %s", substr($previous_month_2, 0, 2), substr($previous_month_2, 3),  $community_id, $store_id, TRANSACTION_TYPE_DEBIT );
        $previous_month_2_data = $wpdb->get_row($query_previous_month_2, ARRAY_A);

        $query_previous_month_2_voucher = $wpdb->prepare("SELECT SUM(v.voucher_price) AS total_amount, COUNT(vt.id) AS total_transactions FROM {$wpdb->prefix}csvp_voucher_transaction AS vt INNER JOIN {$wpdb->prefix}csvp_voucher AS v ON vt.voucher_id = v.id WHERE MONTH(vt.transaction_date) = %d AND YEAR(vt.transaction_date) = %d AND v.community_id = %d AND v.store_id = %d AND vt.status = %s", substr($previous_month_2, 0, 2), substr($previous_month_2, 3), $community_id, $store_id, VOUCHER_STATUS_USED );
        $previous_month_2_voucher_data = $wpdb->get_row($query_previous_month_2_voucher);
          
        $transactions['community_id'] =  $community_id;
        $transactions['store_id'] =  $store_id;
        $transactions['current_month'] =  $current_month."-".$current_year;
        $transactions['previous_month_1'] =  $previous_month_1;
        $transactions['previous_month_2'] =  $previous_month_2;

        $transactions['transaction']['current_month'] = $current_month_data;
        $transactions['transaction']['previous_month_1'] = $previous_month_1_data;
        $transactions['transaction']['previous_month_2'] = $previous_month_2_data;
        $transactions['voucher_transaction']['current_month'] = $current_month_voucher_data;
        $transactions['voucher_transaction']['previous_month_1'] = $previous_month_1_voucher_data;
        $transactions['voucher_transaction']['previous_month_2'] = $previous_month_2_voucher_data;

        return $transactions;

    }

    public function get_requested_transactions_monthly_data_by_community_id($data) {
        global $wpdb;
        $current_month = date('m');
        $current_year = date('Y');
        $community_id = $data['community_id'];
        $store_id = $data['community_id'];
    
        $previous_month_1 = date('m-Y', strtotime('-1 month'));
        $previous_month_2 = date('m-Y', strtotime('-2 months'));
    
        $query_current_month = $wpdb->prepare("SELECT SUM(transaction_amount) AS total_amount, COUNT(id) as total_transactions FROM $this->table_name WHERE MONTH(transaction_date) = %d AND YEAR(transaction_date) = %d AND community_id = %d AND store_id = %d AND transaction_type = %s AND is_active = 2", $current_month, $current_year, $community_id, $store_id, TRANSACTION_TYPE_DEBIT );
        $current_month_data = $wpdb->get_row($query_current_month, ARRAY_A);

        $query_current_month_voucher = $wpdb->prepare("SELECT SUM(v.voucher_price) AS total_amount, COUNT(vt.id) AS total_transactions FROM {$wpdb->prefix}csvp_voucher_transaction AS vt INNER JOIN {$wpdb->prefix}csvp_voucher AS v ON vt.voucher_id = v.id WHERE MONTH(vt.transaction_date) = %d AND YEAR(vt.transaction_date) = %d AND v.community_id = %d AND v.store_id = %d AND vt.status = %s", $current_month, $current_year, $community_id, $store_id, VOUCHER_STATUS_REQUESTED );
        $current_month_voucher_data = $wpdb->get_row($query_current_month_voucher);

        $query_current_month = $wpdb->prepare("SELECT SUM(transaction_amount) AS total_amount, COUNT(id) as total_transactions FROM $this->table_name WHERE MONTH(transaction_date) = %d AND YEAR(transaction_date) = %d AND community_id = %d AND store_id = %d AND transaction_type = %s AND is_active = 2", $current_month, $current_year, $community_id, $store_id, TRANSACTION_TYPE_DEBIT );
        $current_month_data = $wpdb->get_row($query_current_month, ARRAY_A);
    
        $query_previous_month_1 = $wpdb->prepare("SELECT SUM(transaction_amount) AS total_amount, COUNT(id) as total_transactions FROM $this->table_name WHERE MONTH(transaction_date) = %d AND YEAR(transaction_date) = %d AND community_id = %d AND store_id = %d AND transaction_type = %s AND is_active = 2", substr($previous_month_1, 0, 2),  substr($previous_month_1, 3),  $community_id, $store_id, TRANSACTION_TYPE_DEBIT );
        $previous_month_1_data = $wpdb->get_row($query_previous_month_1, ARRAY_A);

        $query_previous_month_1_voucher = $wpdb->prepare("SELECT SUM(v.voucher_price) AS total_amount, COUNT(vt.id) AS total_transactions FROM {$wpdb->prefix}csvp_voucher_transaction AS vt INNER JOIN {$wpdb->prefix}csvp_voucher AS v ON vt.voucher_id = v.id WHERE MONTH(vt.transaction_date) = %d AND YEAR(vt.transaction_date) = %d AND v.community_id = %d AND v.store_id = %d AND vt.status = %s", substr($previous_month_1, 0, 2), substr($previous_month_1, 3), $community_id, $store_id, VOUCHER_STATUS_REQUESTED );
        $previous_month_1_voucher_data = $wpdb->get_row($query_previous_month_1_voucher);

        $query_previous_month_2 = $wpdb->prepare("SELECT SUM(transaction_amount) AS total_amount, COUNT(id) as total_transactions FROM $this->table_name WHERE MONTH(transaction_date) = %d AND YEAR(transaction_date) = %d AND community_id = %d AND store_id = %d AND transaction_type = %s", substr($previous_month_2, 0, 2), substr($previous_month_2, 3),  $community_id, $store_id, TRANSACTION_TYPE_DEBIT );
        $previous_month_2_data = $wpdb->get_row($query_previous_month_2, ARRAY_A);

        $query_previous_month_2_voucher = $wpdb->prepare("SELECT SUM(v.voucher_price) AS total_amount, COUNT(vt.id) AS total_transactions FROM {$wpdb->prefix}csvp_voucher_transaction AS vt INNER JOIN {$wpdb->prefix}csvp_voucher AS v ON vt.voucher_id = v.id WHERE MONTH(vt.transaction_date) = %d AND YEAR(vt.transaction_date) = %d AND v.community_id = %d AND v.store_id = %d AND vt.status = %s", substr($previous_month_2, 0, 2), substr($previous_month_2, 3), $community_id, $store_id, VOUCHER_STATUS_REQUESTED );
        $previous_month_2_voucher_data = $wpdb->get_row($query_previous_month_2_voucher);
          
        $transactions['community_id'] =  $community_id;
        $transactions['store_id'] =  $store_id;
        $transactions['current_month'] =  $current_month."-".$current_year;
        $transactions['previous_month_1'] =  $previous_month_1;
        $transactions['previous_month_2'] =  $previous_month_2;

        $transactions['transaction']['current_month'] = $current_month_data;
        $transactions['transaction']['previous_month_1'] = $previous_month_1_data;
        $transactions['transaction']['previous_month_2'] = $previous_month_2_data;
        $transactions['voucher_transaction']['current_month'] = $current_month_voucher_data;
        $transactions['voucher_transaction']['previous_month_1'] = $previous_month_1_voucher_data;
        $transactions['voucher_transaction']['previous_month_2'] = $previous_month_2_voucher_data;

        return $transactions;

    }
    
    public function get_paid_transactions_monthly_data_by_community_id($data) {
        global $wpdb, $store;
        $current_month = date('m');
        $current_year = date('Y');
        $community_id = $data['community_id'];
        $store_id = $data['community_id'];
    
        $previous_month_1 = date('m-Y', strtotime('-1 month'));
        $previous_month_2 = date('m-Y', strtotime('-2 months'));
    
        $query_current_month = $wpdb->prepare("SELECT SUM(transaction_amount) AS total_amount, COUNT(id) as total_transactions FROM $this->table_name WHERE MONTH(transaction_date) = %d AND YEAR(transaction_date) = %d AND community_id = %d AND store_id = %d AND transaction_type = %s AND is_active = 3", $current_month, $current_year, $community_id, $store_id, TRANSACTION_TYPE_DEBIT );
        $current_month_data = $wpdb->get_row($query_current_month, ARRAY_A);

        $query_current_month_voucher = $wpdb->prepare("SELECT SUM(v.voucher_price) AS total_amount, COUNT(vt.id) AS total_transactions FROM {$wpdb->prefix}csvp_voucher_transaction AS vt INNER JOIN {$wpdb->prefix}csvp_voucher AS v ON vt.voucher_id = v.id WHERE MONTH(vt.transaction_date) = %d AND YEAR(vt.transaction_date) = %d AND v.community_id = %d AND v.store_id = %d AND vt.status = %s", $current_month, $current_year, $community_id, $store_id, VOUCHER_STATUS_PAID );
        $current_month_voucher_data = $wpdb->get_row($query_current_month_voucher);

        $query_current_month = $wpdb->prepare("SELECT SUM(transaction_amount) AS total_amount, COUNT(id) as total_transactions FROM $this->table_name WHERE MONTH(transaction_date) = %d AND YEAR(transaction_date) = %d AND community_id = %d AND store_id = %d AND transaction_type = %s AND is_active = 3", $current_month, $current_year, $community_id, $store_id, TRANSACTION_TYPE_DEBIT );
        $current_month_data = $wpdb->get_row($query_current_month, ARRAY_A);
    
        $query_previous_month_1 = $wpdb->prepare("SELECT SUM(transaction_amount) AS total_amount, COUNT(id) as total_transactions FROM $this->table_name WHERE MONTH(transaction_date) = %d AND YEAR(transaction_date) = %d AND community_id = %d AND store_id = %d AND transaction_type = %s AND is_active = 3", substr($previous_month_1, 0, 2),  substr($previous_month_1, 3),  $community_id, $store_id, TRANSACTION_TYPE_DEBIT );
        $previous_month_1_data = $wpdb->get_row($query_previous_month_1, ARRAY_A);

        $query_previous_month_1_voucher = $wpdb->prepare("SELECT SUM(v.voucher_price) AS total_amount, COUNT(vt.id) AS total_transactions FROM {$wpdb->prefix}csvp_voucher_transaction AS vt INNER JOIN {$wpdb->prefix}csvp_voucher AS v ON vt.voucher_id = v.id WHERE MONTH(vt.transaction_date) = %d AND YEAR(vt.transaction_date) = %d AND v.community_id = %d AND v.store_id = %d AND vt.status = %s", substr($previous_month_1, 0, 2), substr($previous_month_1, 3), $community_id, $store_id, VOUCHER_STATUS_PAID );
        $previous_month_1_voucher_data = $wpdb->get_row($query_previous_month_1_voucher);

        $query_previous_month_2 = $wpdb->prepare("SELECT SUM(transaction_amount) AS total_amount, COUNT(id) as total_transactions FROM $this->table_name WHERE MONTH(transaction_date) = %d AND YEAR(transaction_date) = %d AND community_id = %d AND store_id = %d AND transaction_type = %s", substr($previous_month_2, 0, 2), substr($previous_month_2, 3),  $community_id, $store_id, TRANSACTION_TYPE_DEBIT );
        $previous_month_2_data = $wpdb->get_row($query_previous_month_2, ARRAY_A);

        $query_previous_month_2_voucher = $wpdb->prepare("SELECT SUM(v.voucher_price) AS total_amount, COUNT(vt.id) AS total_transactions FROM {$wpdb->prefix}csvp_voucher_transaction AS vt INNER JOIN {$wpdb->prefix}csvp_voucher AS v ON vt.voucher_id = v.id WHERE MONTH(vt.transaction_date) = %d AND YEAR(vt.transaction_date) = %d AND v.community_id = %d AND v.store_id = %d AND vt.status = %s", substr($previous_month_2, 0, 2), substr($previous_month_2, 3), $community_id, $store_id, VOUCHER_STATUS_PAID );
        $previous_month_2_voucher_data = $wpdb->get_row($query_previous_month_2_voucher);
          
        $transactions['community_id'] =  $community_id;
        $transactions['store_id'] =  $store_id;
        $transactions['current_month'] =  $current_month."-".$current_year;
        $transactions['previous_month_1'] =  $previous_month_1;
        $transactions['previous_month_2'] =  $previous_month_2;

        $transactions['transaction']['current_month'] = $current_month_data;
        $transactions['transaction']['previous_month_1'] = $previous_month_1_data;
        $transactions['transaction']['previous_month_2'] = $previous_month_2_data;
        $transactions['voucher_transaction']['current_month'] = $current_month_voucher_data;
        $transactions['voucher_transaction']['previous_month_1'] = $previous_month_1_voucher_data;
        $transactions['voucher_transaction']['previous_month_2'] = $previous_month_2_voucher_data;

        return $transactions;

    }
    
    public function update_transaction_status($payload)
    {
        global $wpdb, $store;

        $month_tran = $payload['month_tran'];
        $year_tran = $payload['year_tran'];
        $store_id = $store->get_store_id();
        $community_id_tran = $payload['community_id_tran'];
        $message = $payload['message'];
        $status = $payload['status'];
        $status_transaction = $payload['status_transaction'];
        $update_query_voucher_transaction = $wpdb->prepare(
            "UPDATE {$wpdb->prefix}csvp_voucher_transaction AS vt
            INNER JOIN {$wpdb->prefix}csvp_voucher AS v ON vt.voucher_id = v.id
            SET vt.status = %s
            WHERE MONTH(vt.transaction_date) = %d
            AND YEAR(vt.transaction_date) = %d
            AND v.community_id = %d
            AND v.store_id = %d",
            $status, // New status value
            $month_tran,
            $year_tran,
            $community_id_tran,
            $store_id
        );
        
        // Prepare SQL query to update transaction is_active status
        $update_query_transaction = $wpdb->prepare(
            "UPDATE $this->table_name
            SET is_active = %d
            WHERE MONTH(transaction_date) = %d
            AND YEAR(transaction_date) = %d
            AND community_id = %d
            AND store_id = %d",
           $status_transaction, // New is_active value
            $month_tran,
            $year_tran,
            $community_id_tran,
            $store_id
        );
        
        if ($wpdb->query($update_query_transaction) || $wpdb->query($update_query_voucher_transaction)) {
                return array("status" => true, "response" => $message);
        }
        else{
            return array("status" => false, "response" => "Something Went Wrong");
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


      public function get_all_voucher_transactions_by_store_id($data) {
        global $wpdb;
        $status = isset($data['status']) ? $data['status'] : false;
        $logged_in_store_id = $data['store_id'];

            // Prepare SQL query to select voucher transactions by member ID
            $query = $wpdb->prepare("SELECT vt.*
            FROM {$wpdb->prefix}csvp_voucher_transaction vt
            INNER JOIN {$wpdb->prefix}csvp_voucher v ON vt.voucher_id = v.id
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

    public function get_transactions_by_store_id($store_id) {
        global $wpdb;

        // Prepare SQL query to select transactions by store ID
        $query = $wpdb->prepare(
            "SELECT * FROM $this->table_name WHERE store_id = %d",
            $store_id
        );

        // Execute the query and fetch the results
        $results = $wpdb->get_results($query, ARRAY_A);

        // Return the results if any, otherwise return null
        return !empty($results) ? $results : array();
    }


    public function get_transactions_by_community_member_id($data) {
        global $wpdb;
        $community_member_id = $data['id'];
        // Prepare SQL query to select transactions by store ID
        $query = $wpdb->prepare(
            "SELECT * FROM $this->table_name WHERE community_member_id = %d",
            $community_member_id
        );

        // Execute the query and fetch the results
        $results = $wpdb->get_results($query, ARRAY_A);

        // Return the results if any, otherwise return null
        return !empty($results) ? $results : array();
    }


    public function get_all_transactions_by_community_member_id() {
        global $wpdb, $community_member, $voucher_transaction ;
        $member_id = $community_member->get_community_id();
        // Prepare SQL query to select voucher transactions by member ID
        $query = $wpdb->prepare("SELECT * FROM {$wpdb->prefix}csvp_voucher_transaction WHERE community_member_id = %d ", $member_id);
    
        // Execute the query and fetch the results
        $voucher_transactions = $wpdb->get_results($query, ARRAY_A);

        foreach ($voucher_transactions as $key => $vouchers) {
            $voucher_data = $voucher_transaction->get_voucher_data_by_id(($vouchers["voucher_id"]));
            $voucher_transactions[$key]["voucher_data"] = $voucher_data;

            $store = $voucher_transaction->get_store_data_by_id($voucher_data->store_id); // line 118
            $voucher_transactions[$key]["store_data"] = $store;
        }


        $query = $wpdb->prepare("SELECT * FROM $this->table_name WHERE community_member_id = %d AND transaction_type = %s", $member_id, TRANSACTION_TYPE_DEBIT);
    
        // Execute the query and fetch the results
        $transactions = $wpdb->get_results($query, ARRAY_A);

        foreach ($transactions as $key => $transaction) {
            $store = $voucher_transaction->get_store_data_by_id($transaction["store_id"]); // line 118
            $transactions[$key]["store_data"] = $store;
        }

        $pageData['transactions'] = $transactions;
        $pageData['voucher_transactions']  = $voucher_transactions;
        return $pageData;
    }
}
