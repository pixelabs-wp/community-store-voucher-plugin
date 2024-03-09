<?php

class CSVP_VoucherTransaction{
    // Properties
    private $table_name;

    // Constructor
    public function __construct() {
        global $wpdb;
        $this->table_name = $wpdb->prefix . 'csvp_voucher_transaction';
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
            return false;
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

    public function get_all_voucher_transactions_by_community_id($data)
        {
            global $wpdb;
            $community_member = $wpdb->prefix . 'csvp_community_member';
            $status = isset($data['status']) ? $data['status'] : false;
            $community_id = isset($data['community_id']) ? $data['community_id'] : get_current_user_id();
            if (!$status) {
            // Prepare SQL query to select voucher transactions by member ID
            $query = $wpdb->prepare("SELECT t.* FROM $this->table_name AS t  INNER JOIN $community_member AS m ON t.community_member_id = m.id WHERE m.community_id = %d", $community_id);

            } else {
                $query = $wpdb->prepare("SELECT t.* FROM $this->table_name AS t  INNER JOIN $community_member AS m ON t.community_member_id = m.id WHERE m.community_id = %d AND t.status = %d", $community_id, $status);
            }
            // Execute the query and fetch the results
            $voucher_transactions = $wpdb->get_results($query, ARRAY_A);

            // Return the results if any, otherwise return null
            return !empty($voucher_transactions) ? $voucher_transactions : null;
        }

    public function get_voucher_transactions_by_member_id($data) {
        global $wpdb;
        
        $member_id = $data['member_id'];
        $status = isset($data['status']) ? $data['status'] : false;
        
        if(!$status){
            // Prepare SQL query to select voucher transactions by member ID
            $query = $wpdb->prepare("SELECT * FROM $this->table_name WHERE community_member_id = %d", $member_id);
        } else {
            $query = $wpdb->prepare("SELECT * FROM $this->table_name WHERE community_member_id = %d AND status = %d", $member_id, $status);

        }

        // Execute the query and fetch the results
        $voucher_transactions = $wpdb->get_results($query, ARRAY_A);

        // Return the results if any, otherwise return null
        return !empty($voucher_transactions) ? $voucher_transactions : null;
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
