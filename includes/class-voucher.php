<?php
class CSVP_Voucher{
    // Properties
    public $table_name;

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
        $store_id = $data['store_id'];
        $community_id = $data['community_id'];
        $wp_user = get_current_user_id();

        if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] == UPLOAD_ERR_OK) {

             // Handle file upload
            $upload_dir = wp_upload_dir(); // Get the upload directory
            $file_name = basename($_FILES['product_image']['name']);

            // Get the file extension
            $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);

            // Generate a unique identifier (timestamp or random string)
            $unique_identifier = uniqid(); // Using a timestamp-based unique identifier

            // Construct the file name with the extension
            $file_name = 'store_voucher_' . $store_id . '_' . $unique_identifier . '.' . $file_extension;

    
                // Check if the upload directory is writable
            $moved = move_uploaded_file($_FILES['product_image']['tmp_name'], $upload_dir['path'] . '/' . $file_name);
            
            if ($moved) {

                $file_path = $upload_dir['subdir'] . '/' . $file_name;



                    // Insert data into the database
                    $wpdb->insert(
                        $this->table_name, // Table name
                        array(
                            'product_name' => $product_name,
                            'voucher_price' => $voucher_price,
                            'normal_price' => $normal_price,
                            'product_image' => $file_path,
                            'store_id' => $store_id,
                            'community_id' => $community_id,
                            'wp_user'=>  $wp_user
                        ) // Data to be inserted
                    );

                // Check if the insertion was successful
                if ($wpdb->insert_id) {
                    // Return the ID of the newly inserted voucher
                    // return $wpdb->insert_id; 
                    return array("status"=>true, "response"=>"Voucher created successfully for Product: ".$data["product_name"]);
                } else {
                    // Failed to move uploaded file
                    return array("status" => false, "response" => "Something Went Wrong");
                    }
               
            }
        } else {
            return array("status" => false, "response" => "No product image uploaded or error occurred");
        }
    
    }


    public function get_voucher_by_id($data) {
        global $wpdb;

        $voucher_id = $data['voucher_id'];

        // Prepare SQL query to retrieve voucher data by ID
        $query = "SELECT * FROM $this->table_name WHERE id = $voucher_id";

        // Execute the query
        $voucherData = $wpdb->get_results($query);

        // Check if a voucher was found
        if ($voucherData) {
            // Return voucher data as an object
            return $voucherData;
        } else {
            // Return false if voucher not found
            return $query;
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

        $voucher_id = $data['id'];
        //Prepare SQL query to select product image and product name by ID
        $query = $wpdb->prepare("SELECT product_image, product_name FROM $this->table_name WHERE id = %d", $voucher_id);

        // Execute the query to fetch the product image and product name
        $voucher_data = $wpdb->get_row($query, ARRAY_A);

        // Check if voucher data is retrieved
        if (!$voucher_data) {
            return array("status" => false, "response" => "Voucher not found");
        }

        
    
        // Prepare SQL query to delete voucher by ID
        $query = $wpdb->prepare("DELETE FROM $this->table_name WHERE id = %d", $voucher_id);

        // Execute the query and return true on success, false on failure
        if( $wpdb->query($query) ){
           
            $upload_dir = wp_upload_dir();
            $image_path = $upload_dir['basedir'] . '/' . $voucher_data['product_image'];
            if (file_exists($image_path)) {
                unlink($image_path);
            }
                return array("status"=>true, "response"=>"Voucher ". $voucher_data['product_name'] . " deleted successfully");
            } else {
            // Failed to move uploaded file
            return array("status" => false, "response" => "Something Went Wrong");
            }
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

    public function get_all_vouchers_by_store_id_and_community_id($data) {
        global $wpdb, $store;


        $store_id = isset($data['store_id']) ? $data['store_id'] : $store->get_store_id();   
        $community_id = $data['community_id'];
        
        // Prepare SQL query to select all vouchers by store ID
        $query = $wpdb->prepare("SELECT * FROM $this->table_name WHERE store_id = %d  AND community_id = %d", $store_id, $community_id);

        // Execute the query and fetch the results
        $vouchers = $wpdb->get_results($query, ARRAY_A);

        // Return the results if any, otherwise return null
        return !empty($vouchers) ? $vouchers : null;
    }

    public function get_all_vouchers_by_community_id($data)
    {
        global $wpdb;
        $community_id = $data['community_id'];

        // Prepare SQL query to select all vouchers by store ID
        $query = $wpdb->prepare("SELECT * FROM $this->table_name WHERE community_id = %d", $community_id);

        // Execute the query and fetch the results
        $vouchers = $wpdb->get_results($query, ARRAY_A);

        // Return the results if any, otherwise return null
        return !empty($vouchers) ? $vouchers : array();
    }


}
?>
