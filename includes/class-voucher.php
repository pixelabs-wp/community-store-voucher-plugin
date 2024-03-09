<?php
class CSVP_Voucher extends CSVP_Base{
    // Properties
    private $table_name;

    // Constructor
    public function __construct() {
        global $wpdb;
        $this->table_name = $wpdb->prefix . 'csvp_voucher';
    }

    public function create_voucher($data) {
        global $wpdb;

        // Extract data from the input array
        $product_name = $data['product_name'];
        $voucher_price = $data['voucher_price'];
        $normal_price = $data['normal_price'];
        $product_image = $data['product_image'];
        $store_id = $data['store_id'];

        // Insert data into the database
        $wpdb->insert(
            $this->table_name, // Table name
            array(
                'product_name' => $product_name,
                'voucher_price' => $voucher_price,
                'normal_price' => $normal_price,
                'product_image' => $product_image,
                'store_id' => $product_image
            ) // Data to be inserted
        );

        // Check if the insertion was successful
        if ($wpdb->insert_id) {
            // Return the ID of the newly inserted voucher
            // return $wpdb->insert_id; 
            return array("status"=>true, "response"=>"Voucher created successfully for Product: ".$data["product_name"]);
        } else {
            // Return false if insertion failed
            return array("status"=>false, "response"=>"Something Went Wrong");
        }
    }


    public function get_voucher_by_id($data) {
        global $wpdb;

        $voucher_id = $data['voucher_id'];

        // Prepare SQL query to retrieve voucher data by ID
        $query = $wpdb->prepare(
            "SELECT * FROM $this->table_name WHERE id = %d",
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


    public function update_voucher($data) {
        global $wpdb;

        // Extract voucher ID from the data array
        $voucher_id = $data['voucher_id'];

        // Remove voucher_id from the data array to prevent updating it
        unset($data['voucher_id']);

        // Format the update data for the SQL query
        $update_data = [];
        foreach ($data as $key => $value) {
            $update_data[] = "$key = '$value'";
        }

        // Prepare SQL query to update voucher data
        $query = $wpdb->prepare(
            "UPDATE $this->table_name SET " . implode(', ', $update_data) . " WHERE id = %d",
            $voucher_id // Voucher ID for the WHERE clause
        );

        // Execute the query and return true on success, false on failure
        return $wpdb->query($query) !== false;
    }


    public function delete_voucher($data) {
        global $wpdb;

        $voucher_id = $data['voucher_id'];

        // Prepare SQL query to delete voucher by ID
        $query = $wpdb->prepare("DELETE FROM $this->table_name WHERE id = %d", $voucher_id);

        // Execute the query and return true on success, false on failure
        return $wpdb->query($query) !== false;
    }


    public function get_all_vouchers_by_store_id($data) {
        global $wpdb;

        $store_id = $data['store_id'];
        
        // Prepare SQL query to select all vouchers by store ID
        $query = $wpdb->prepare("SELECT * FROM $this->table_name WHERE store_id = %d", $store_id);

        // Execute the query and fetch the results
        $vouchers = $wpdb->get_results($query, ARRAY_A);

        // Return the results if any, otherwise return null
        return !empty($vouchers) ? $vouchers : null;
    }

}
?>
