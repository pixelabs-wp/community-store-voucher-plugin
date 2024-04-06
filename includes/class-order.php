<?php
class CSVP_Order{
    // Properties
    private $table_name;

    // Constructor
    public function __construct() {
        global $wpdb;
        $this->table_name = $wpdb->prefix . 'csvp_order';
    }

    /**
     * Function to create a new order in the database.
     *
     * @param array $data An associative array containing order data.
     * @return int|false The ID of the newly inserted order if successful, or false on failure.
     */
    public function create_order($data) {
        global $wpdb;

        // Extract data from the input array
        $community_id = $data['community_id'];
        $store_id = $data['store_id'];
        $order_status = isset($data['order_status']) ? $data['order_status'] : ORDER_STATUS_PENDING;
        $order_total = $data['order_total'];
        $order_date = isset($data['order_date']) ? $data['order_date'] : current_time('mysql');
        $loggined_id = get_current_user_id();
        $message = $data['message'];

        if (isset($_FILES['order_info_file']) && $_FILES['order_info_file']['error'] == UPLOAD_ERR_OK) {

            // Handle file upload
           $upload_dir = wp_upload_dir(); // Get the upload directory
           $file_name = basename($_FILES['order_info_file']['name']);

           // Get the file extension
           $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);

           // Generate a unique identifier (timestamp or random string)
           $unique_identifier = uniqid(); // Using a timestamp-based unique identifier

           // Construct the file name with the extension
           $file_name = 'order_info_' . $store_id . '_' . $unique_identifier . '.' . $file_extension;

   
               // Check if the upload directory is writable
           $moved = move_uploaded_file($_FILES['order_info_file']['tmp_name'], $upload_dir['path'] . '/' . $file_name);
           
           if ($moved) {

               $file_path = $upload_dir['subdir'] . '/' . $file_name;

                // Insert data into the database
                $wpdb->insert(
                    $this->table_name, // Table name
                    array(
                        'wp_user' => $loggined_id,
                        'community_id' => $community_id,
                        'store_id' => $store_id,
                        'order_status' => $order_status,
                        'order_total' => $order_total,
                        'order_date' => $order_date,
                        'order_info_file'=> $file_path
                    ) // Data to be inserted
                );

                // Check if the insertion was successful
                if ($wpdb->insert_id) {

                    $this->add_order_data($data["product_name"], $data["cost_per_item"], $data["total_item"], $data["total_cost"], $wpdb->insert_id."_store");
                    // Return the ID of the newly inserted order
                    return array("status" => true, "response" => $message);
                } else {
                    // Failed to move uploaded file
                    return array("status" => false, "response" => "Something Went Wrong");
                    }
                }
            }
        else{
             // Insert data into the database
             $wpdb->insert(
                $this->table_name, // Table name
                array(
                    'wp_user' => $loggined_id,
                    'community_id' => $community_id,
                    'store_id' => $store_id,
                    'order_status' => $order_status,
                    'order_total' => $order_total,
                    'order_date' => $order_date,
                    'order_info_file'=> ""
                ) // Data to be inserted
            );

            // Check if the insertion was successful
            if ($wpdb->insert_id) {

                $this->add_order_data($data["product_name"], $data["cost_per_item"], $data["total_item"], $data["total_cost"], $wpdb->insert_id."_store");
                // Return the ID of the newly inserted order
                return array("status" => true, "response" => $message);
            } else {
                // Failed to move uploaded file
                return array("status" => false, "response" => "Something Went Wrong");
                }
        }
    }

    /**
     * Function to retrieve an order by its ID from the database.
     *
     * @param int $order_id The ID of the order to retrieve.
     * @return object|false Order data as an object if found, or false if not found.
     */
    public function get_order_by_id($data) {
        global $wpdb;
        $order_id = $data['order_id'];
        // Prepare SQL query to retrieve order data by ID
        $query = $wpdb->prepare(
            "SELECT * FROM $this->table_name WHERE id = %d",
            $order_id
        );

        // Execute the query
        $order = $wpdb->get_row($query);

        // Check if an order was found
        if ($order) {
            $order_data = $this->get_order_data_by_id($order_id."_store");
            // Return order data as an object
            return array($order, "order_data" => $order_data);
        } else {
            // Return false if order not found
            return false;
        }
    }

    /**
     * Function to update an order in the database based on its ID.
     *
     * @param int $order_id ID of the order to update.
     * @param array $data Associative array containing the updated order data.
     * @return bool True on success, false on failure.
     */
    public function update_order($data) {
        global $wpdb;
        $order_id = $data['order_id'];

        // Extract order ID from the data array
        unset($data['order_id']);

        // Format the update data for the SQL query
        $update_data = [];
        foreach ($data as $key => $value) {
            $update_data[] = "$key = '$value'";
        }

        // Prepare SQL query to update order data
        $query = $wpdb->prepare(
            "UPDATE $this->table_name SET " . implode(', ', $update_data) . " WHERE id = %d",
            $order_id // Order ID for the WHERE clause
        );

        // Execute the query and return true on success, false on failure
        return $wpdb->query($query) !== false;
    }
    function update_order_status($data)
    {
        global $wpdb;
        $order_id = $data['order_id'];
        $order_status = $data['order_status'];
        $store_id = $data['store_id'];
        $message = $data['message'];
        $query = $wpdb->prepare(
            "UPDATE $this->table_name
            SET order_status = %s
            WHERE id = %d",
            $order_status,
            $order_id
        );
         // Check if the insertion was successful
         if ($wpdb->query($query)) {

            if($order_status == ORDER_STATUS_PAID)
            {
                $store = $this->get_store_data_by_id($store_id); // line 118
                $store_user_id = $store->wp_user_id;
                $store_data = get_userdata($store_user_id);
                $store_roles = $store_data->roles;
                $data ['order_id'] = $order_id;
                $result = $this->get_order_by_id($data);
                $community_id = $result[0]->community_id;
                $order_total = $result[0]->order_total;
                

              

                $community = $this->get_communtiy_data_by_id($community_id);
                $commision_percentage = $community->commision_percentage;
                $community_user_id = $community->wp_user_id;

                $community_data = get_userdata($community_user_id);
                $communtiy_roles = $community_data->roles;
               
                $commission_amount = $order_total * ($commision_percentage / 100);

                $this->create_order_commission($store_id , $store_roles[0], $store->fee_amount_per_transaction);
                
                $this->create_order_commission($community_id , $communtiy_roles[0], $commission_amount);
                // Return the ID of the newly inserted order
                return array("status" => true, "response" => $message);
            }

            return array("status" => true, "response" => $message);
            
        } else {
            // Failed to move uploaded file
            return array("status" => false, "response" => "Something Went Wrong");
            }
    }

    public function get_store_data_by_id($store_id)
    {
        global $wpdb;
        $store_data_table = $wpdb->prefix . 'csvp_store';
        // Prepare SQL query to retrieve store data by ID
        $query = $wpdb->prepare(
            "SELECT * FROM $store_data_table WHERE id = %d",
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


    public function get_communtiy_data_by_id($community_id)
    {
        global $wpdb;
        $community_data_table = $wpdb->prefix . 'csvp_community';
        // Prepare SQL query to retrieve store data by ID
        $query = $wpdb->prepare(
            "SELECT * FROM $community_data_table WHERE id = %d",
            $community_id
        );

        // Execute the query
        $community = $wpdb->get_row($query);

        // Check if a store was found
        if ($community) {
            // Return store data as an object
            return $community;
        } else {
            // Send error response
            return false;
        }
    }
    
    public function create_order_commission($entity_id , $user_roles, $commission_value) {
        global $wpdb;
        $commision_data_table = $wpdb->prefix . 'csvp_commission';
        // Insert data into the database
        $wpdb->insert(
            $commision_data_table, // Table name
            array(
                'entity_id' => $entity_id,
                'entity_type' => $user_roles,
                'commission_type' => COMMISSION_TYPE_ORDER,
                'commission_value' => $commission_value,
                'commission_status' => COMMISSION_STATUS_PENDING
            ) // Data to be inserted
        );
        // Check if the insertion was successful
        if ($wpdb->insert_id) {
            // Return the ID of the newly inserted commission
            return $wpdb->insert_id;
        } else {
            // Send error response
            return false;
        }
    }

    /**
     * Function to delete an order from the database based on its ID.
     *
     * @param int $order_id ID of the order to delete.
     * @return bool True on success, false on failure.
     */
    public function delete_order($data) {
        global $wpdb;
        
        $order_id = $data['order_id'];

        // Prepare SQL query to delete order by ID
        $query = $wpdb->prepare("DELETE FROM $this->table_name WHERE id = %d", $order_id);

        $this->delete_order_data($order_id."_store");

        // Execute the query and return true on success, false on failure
        return $wpdb->query($query) !== false;
    }

    /**
     * Function to retrieve all orders from the database.
     *
     * @return array|null Array of orders on success, null on failure.
     */
    public function get_all_orders() {
        global $wpdb;

        // Prepare SQL query to select all orders
        $query = "SELECT * FROM $this->table_name";

        // Execute the query and fetch the results
        $results = $wpdb->get_results($query, ARRAY_A);

        foreach ($results as $key => $order) {
            $order_data = $this->get_order_data_by_id(($order["id"]));
            $results[$key]["order_data"] = $order_data;
        }

        // Return the results if any, otherwise return null
        return !empty($results) ? $results : null;
    }

    /**
     * Function to retrieve orders by community ID from the database.
     *
     * @param int $community_id The ID of the community to retrieve orders for.
     * @return array|null Array of orders for the specified community on success, null on failure.
     */
    public function get_orders_by_community_id($data) {
        global $wpdb;

        $community_id = $data['community_id'];
        $suffix = $data['suffix'];
        // Prepare SQL query to select orders by community ID
        $query = $wpdb->prepare(
            "SELECT * FROM $this->table_name WHERE community_id = %d",
            $community_id
        );

        // Execute the query and fetch the results
        $results = $wpdb->get_results($query, ARRAY_A);

        foreach ($results as $key => $order) {
            $order_data = $this->get_order_data_by_id(($order["id"]. $suffix));
            $results[$key]["order_data"] = $order_data;
        }

        // Return the results if any, otherwise return null
        return !empty($results) ? $results : null;
    }


    public function get_all_orders_by_community_id($data) {
        global $wpdb;

        $community_id = $data['community_id'];
        $suffix = $data['suffix'];
        // Prepare SQL query to select orders by community ID
        $query = $wpdb->prepare(
            "SELECT * FROM $this->table_name WHERE community_id = %d",
            $community_id
        );

        // Execute the query and fetch the results
        $results = $wpdb->get_results($query, ARRAY_A);

        foreach ($results as $key => $order) {
            $order_data = $this->get_order_data_by_id(($order["id"]. $suffix));
            $results[$key]["order_data"] = $order_data;

            $store_data = $this->get_store_data_by_id(($order["store_id"]));
            $results[$key]["store_data"] = $store_data;
        }

        // Return the results if any, otherwise return null
        return !empty($results) ? $results : null;
    }

    /**
     * Function to retrieve orders by store ID from the database.
     *
     * @param int $store_id The ID of the store to retrieve orders for.
     * @return array|null Array of orders for the specified store on success, null on failure.
     */
    public function get_orders_by_store_id($data) {
        global $wpdb;

        $store_id = $data['store_id'];
        $suffix = $data['suffix'];
        // Prepare SQL query to select orders by store ID
        $query = $wpdb->prepare(
            "SELECT * FROM $this->table_name WHERE store_id = %d",
            $store_id
        );

        $results = $wpdb->get_results($query, ARRAY_A);
        foreach ($results as $key => $order) {
            $order_data = $this->get_order_data_by_id(($order["id"]. $suffix));
            $results[$key]["order_data"] = $order_data;
        }

        // Execute the query and fetch the results
        // Return the results if any, otherwise return null
        return !empty($results) ? $results : null;
    }

    public function get_orders_data_using_store_and_community($data) {
        global $wpdb, $store, $community;

        if($data['type'] == "community")
        {
            $store_id = $data['id'];
            $community_id = $community->get_current_community_id();
        }
        else if($data['type'] == "store"){
            $store_id = $store->get_store_id();
            $community_id = $data['id'];
        }
        $suffix = $data['suffix'];
        // Prepare SQL query to select orders by store ID
        $query = $wpdb->prepare(
            "SELECT * FROM $this->table_name WHERE store_id = %d AND community_id = %d",
            $store_id, $community_id
        );

        $results = $wpdb->get_results($query, ARRAY_A);
        foreach ($results as $key => $order) {
            $order_data = $this->get_order_data_by_id(($order["id"]. $suffix));
            $results[$key]["order_data"] = $order_data;
        }

        // Execute the query and fetch the results
        // Return the results if any, otherwise return null
        return !empty($results) ? $results : null;
    }


    public function get_orders_data_community($data = array())
    {
        global $wpdb, $community;

        $community_id = isset($data['community_id']) ? $data['community_id'] : $community->get_current_community_id();

        $suffix = isset($data['suffix']) ? $data['suffix'] : "_store";
        // Prepare SQL query to select orders by store ID
        $query = $wpdb->prepare(
            "SELECT * FROM $this->table_name WHERE community_id = %d",
            $community_id
        );

        $results = $wpdb->get_results($query, ARRAY_A);
        foreach ($results as $key => $order) {
            $order_data = $this->get_order_data_by_id(($order["id"] . $suffix));
            $results[$key]["order_data"] = $order_data;
        }

        // Execute the query and fetch the results
        // Return the results if any, otherwise return null
        return !empty($results) ? $results : null;
    }



    // Function to retrieve order data by ID
    function get_order_data_by_id($order_id)
    {
        global $wpdb;
        $order_data_table = $wpdb->prefix . 'csvp_order_data';
        $sql = $wpdb->prepare("SELECT * FROM $order_data_table WHERE order_id = %s", $order_id);
        return $wpdb->get_results($sql, ARRAY_A);
    }

    // Function to add order data
    function add_order_data($product_names, $cost_per_items, $total_items, $total_costs, $order_id)
    {
        global $wpdb;
        $order_data_table = $wpdb->prefix . 'csvp_order_data';

        // Prepare data for insertion
        $data = [];
        foreach ($product_names as $key => $product_name) {
            $data[] = array(
                'order_id' => $order_id,
                'product_name' => $product_name,
                'cost_per_item' => $cost_per_items[$key],
                'total_items' => $total_items[$key],
                'total_cost' => $total_costs[$key]
            );
        }

        // Insert data into the database
        foreach ($data as $row) {
            $wpdb->insert($order_data_table, $row);
        }
    }

    // Function to update order data (assuming you have an ID for each row)
    function update_order_data($data)
    {
        global $wpdb;
        $order_data_table = $wpdb->prefix . 'csvp_order_data';

        foreach ($data as $row) {
            $wpdb->update($order_data_table, $row, array('id' => $row['id']));
        }
    }

    // Function to delete order data by ID
    function delete_order_data($order_id)
    {
        global $wpdb;
        $order_data_table = $wpdb->prefix . 'csvp_order_data';
        $wpdb->delete($order_data_table, array('order_id' => $order_id));
    }

}
