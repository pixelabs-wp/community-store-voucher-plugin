<?php

class CSVP_Admin
{
    private $community;
    private $community_member;
    private $store;
    private $message;
    
    public function __construct()
    {
        $this->community = new CSVP_Community();
        $this->store = new CSVP_Store();
        $this->community_member = new CSVP_CommunityMember();
        $this->message = new CSVP_CommunityMessage();
    }
    //Method to render transaction history
    public function render_community_management()
    {
        global $commision, $filter;
        if (isset($_POST["csvp_request"]) && $_POST["csvp_request"] == "add_community") {
            $payload = $_POST;

            $response = $this->community->create_community($payload);
            if (is_wp_error($response)) {
                CSVP_Notification::add(CSVP_Notification::ERROR, $response->get_error_message());
            } else{
                CSVP_Notification::add(CSVP_Notification::SUCCESS, 'Community Added Successfully');
            }
        }

        if (isset($_POST["csvp_request"]) && $_POST["csvp_request"] == "update_community") {
            $payload = $_POST;
            $payload_1['community_manager_phone'] = $payload['community_manager_phone'];
            $payload_1['community_manager_name'] = $payload['community_manager_name'];
            $payload_1['community_address'] = $payload['community_address'];
            $payload_1['community_name'] = $payload['community_name'];
            $payload_1['community_mail_address'] = $payload['community_mail_address'];
            $payload_1['payment_link'] = $payload['payment_link'];
            $payload_1['api_valid'] = $payload['api_valid'];
            $payload_1['commision_percentage'] = $payload['commision_percentage'];
            $payload_1['community_id'] = $payload['community_id'];

            $upload_dir = wp_upload_dir(); 
            $oldpath = $upload_dir['basedir'] . '/' . $payload['oldpath'];

            if (isset ($_FILES['community_logo']) && $_FILES['community_logo']['error'] == UPLOAD_ERR_OK) {
                $file_name = basename($_FILES['community_logo']['name']);
                $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
                $unique_identifier = uniqid();
                $file_name = 'community_logo_' . $unique_identifier . '.' . $file_extension;
                $moved = move_uploaded_file($_FILES['community_logo']['tmp_name'], $upload_dir['path'] . '/' . $file_name);
                if ($moved) {
                    if (isset($oldpath) && file_exists($oldpath)) {
                        unlink($oldpath);
                    }
                    $file_path = $upload_dir['subdir'] . '/' . $file_name;
                    $payload_1['community_logo'] = $file_path;
                    $response = $this->community->update_community($payload_1);
                }
            }
            else{
                $response = $this->community->update_community($payload_1);
            }
            if (is_wp_error($response)) {
               
                CSVP_Notification::add(CSVP_Notification::ERROR, $response->get_error_message());
            } else{
                
                $message = 'Community Updated Successfully';
                $userdata = array(
                    'ID' => $payload['user_id'],
                    'user_email' => $payload['community_mail_address'],
                    'user_pass' => $payload['password']
                );
                
                $user = wp_update_user($userdata);
                if (is_wp_error($user)) {
                    // An error occurred while updating the user
                    $error_message = $user->get_error_message();
                    $message = "Community User update failed: " . $error_message;
                }
                
                CSVP_Notification::add(CSVP_Notification::SUCCESS, $message);
            }
        }


       

        $communities = $this->community->get_all_communities();
        $modifiedCommunities = array(); // Create a new array to hold modified data
      
        if (!is_wp_error($communities)) 
        {  
            foreach ($communities as $community) {
                $number_of_guys = $this->community_member->get_community_members_by_community_id(array('count' => 'true', 'community_id' => $community['id']));
                // Add the count of members as a new key in each community array
                $community['number_of_guys'] = $number_of_guys;
                $community['commision_pending'] = count($commision->get_commissions_by_entity_id($community['id'], CSVP_User_Roles::ROLE_COMMUNITY_MANAGER, COMMISSION_STATUS_PENDING)) > 0 ? 1 : 0;
                $modifiedCommunities[] = $community; // Add the modified community to the new array
            }
            $number_of_communities = $this->community->get_all_communities(array("count"=>true));
            $pageData["communities"] = $modifiedCommunities;
            $pageData["total_communities"] = $number_of_communities;
            // Assuming CSVP_View_Manager::load_view() is properly configured  
        }

        if(isset($_POST["csvp_filter"]) && $_POST["csvp_filter"] == "filter_communities_by_name"){
            unset($_POST["csvp_filter"]);
            $pageData["communities"] = $filter->filterData($pageData["communities"], $_POST);
        } else if (isset($_POST["csvp_filter"]) && $_POST["csvp_filter"] == "filter_communities_by_debt") {
            unset($_POST["csvp_filter"]);
            $pageData["communities"] = $filter->filterData($pageData["communities"], $_POST);


            if ($_POST["commision_pending"] == 1){
                $_POST["commision_pending"] = "קיים חוב";
            } else if ($_POST["commision_pending"] == 0){
                $_POST["commision_pending"] =  "לא קיים חוב";
            }
        }
       

        CSVP_View_Manager::load_view('community-management', $pageData);
    }

    public function render_store_management()
    {
        global $commision, $filter;

        if (isset($_POST["csvp_request"]) && $_POST["csvp_request"] == "add_store") {
            $payload = $_POST;

            $response = $this->store->create_store($payload);
            if (is_wp_error($response)) {
                CSVP_Notification::add(CSVP_Notification::ERROR, $response->get_error_message());
            } else {
                CSVP_Notification::add(CSVP_Notification::SUCCESS, 'Store Added Successfully');
            }

            unset($_POST);
        }
        if (isset($_POST["csvp_request"]) && $_POST["csvp_request"] == "update_store") {
            $payload = $_POST;
            $payload_1['store_name'] = $payload['store_name'];
            $payload_1['store_phone'] = $payload['store_phone'];
            $payload_1['store_cashier_phone'] = $payload['store_cashier_phone'];
            $payload_1['store_address'] = $payload['store_address'];
            // $payload_1['store_mail_address'] = $payload['store_mail_address'];
            $payload_1['fee_amount_per_transaction'] = $payload['fee_amount_per_transaction'];
            $payload_1['store_id'] = $payload['store_id'];
            $upload_dir = wp_upload_dir(); 
            $oldpath = $upload_dir['basedir'] . '/' . $payload['oldpath'];

            if (isset ($_FILES['store_logo']) && $_FILES['store_logo']['error'] == UPLOAD_ERR_OK) {
                $file_name = basename($_FILES['store_logo']['name']);
                $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
                $unique_identifier = uniqid();
                $file_name = 'store_logo' . $unique_identifier . '.' . $file_extension;
                $moved = move_uploaded_file($_FILES['store_logo']['tmp_name'], $upload_dir['path'] . '/' . $file_name);
                if ($moved) {
                    if (isset($oldpath) && file_exists($oldpath)) {
                        unlink($oldpath);
                    }
                    $file_path = $upload_dir['subdir'] . '/' . $file_name;
                    $payload_1['store_logo'] = $file_path;
                    $response = $this->store->update_store($payload_1);
                }
            }

            else{
                $response = $this->store->update_store($payload_1);
            }
            if (is_wp_error($response)) {
               
                CSVP_Notification::add(CSVP_Notification::ERROR, $response->get_error_message());
            } else{
                
                $message = 'Store Updated Successfully';
                $userdata = array(
                    'ID' => $payload['user_id'],
                    'user_email' => $payload['store_mail_address'],
                    'user_pass' => $payload['password']
                );
                
                $user = wp_update_user($userdata);
                if (is_wp_error($user)) {
                    // An error occurred while updating the user
                    $error_message = $user->get_error_message();
                    $message = "Store User update failed: " . $error_message;
                }
                
                CSVP_Notification::add(CSVP_Notification::SUCCESS, $message);
            }
        }
        
        $pageData = array(); // or $emptyArray = [];
        $stores = $this->store->get_all_stores();
        $modifiedStores = array();
        if (!is_wp_error($stores)) 
        {
            foreach ($stores as $store) {
                $store['commision_pending'] = count($commision->get_commissions_by_entity_id($store['id'], CSVP_User_Roles::ROLE_STORE_MANAGER, COMMISSION_STATUS_PENDING)) > 0 ? 1 : 0;
                array_push($modifiedStores, $store);
            }

            $pageData["stores"] = $modifiedStores;
        }
        $number_of_stores = $this->store->get_all_stores(array("count" => true));
        if (!is_wp_error($number_of_stores)) 
        {
            $pageData["total_stores"] = $number_of_stores;
        }


        if (isset($_POST["csvp_filter"]) && $_POST["csvp_filter"] == "filter_stores_by_name") {
            unset($_POST["csvp_filter"]);
            $pageData["stores"] = $filter->filterData($pageData["stores"], $_POST);
        } else if (isset($_POST["csvp_filter"]) && $_POST["csvp_filter"] == "filter_stores_by_debt") {
            unset($_POST["csvp_filter"]);
            $pageData["stores"] = $filter->filterData($pageData["stores"], $_POST);

            if ($_POST["commision_pending"] == 1){
                $_POST["commision_pending"] = "קיים חוב";
            } else if ($_POST["commision_pending"] == 0){
                $_POST["commision_pending"] =  "לא קיים חוב";
            }
        }
        
        CSVP_View_Manager::load_view('store-management', $pageData);
    }

    public function render_store_commisions()
    {
        global $commision, $store, $filter;

        if (isset($_POST["csvp_request"]) && $_POST["csvp_request"] == "pay_commision") {

            $data = array("month" => $_POST["month"], "year" => $_POST["year"], "entity_type" => CSVP_User_Roles::ROLE_STORE_MANAGER, "entity_id" => $_POST["entity_id"], "status" => COMMISSION_STATUS_PAID);

            $reponse = $commision->update_commission($data);
            if ($reponse) {
                CSVP_Notification::add(CSVP_Notification::SUCCESS, "Commision Paid");
            } else {
                CSVP_Notification::add(CSVP_Notification::ERROR, "Commision Not Paid : " . $reponse);
            }
        }

        $commision_data = $commision->get_entity_commissions(CSVP_User_Roles::ROLE_STORE_MANAGER);
        $commisions = array();
        foreach ($commision_data as $value) {
            $value["store_data"] = $store->get_store_by_id($value["entity_id"]);
            $value["store_name"] = $value["store_data"]->store_name;
            $value["month_year"] = date("Y", strtotime($value["year"])) . "-" . date("m", strtotime($value["year"]));
            array_push($commisions, $value);
        }
        $pageData["commision"] = $commisions;

        if (isset($_POST["csvp_filter"]) && $_POST["csvp_filter"] == "filter_commision_by_name") {
            unset($_POST["csvp_filter"]);

            $pageData["commision"] = $filter->filterData($pageData["commision"], $_POST);
        } else if (isset($_POST["csvp_filter"]) && $_POST["csvp_filter"] == "filter_commision_by_my") {
            unset($_POST["csvp_filter"]);

            $pageData["commision"] = $filter->filterData($pageData["commision"], $_POST);
        } 


        CSVP_View_Manager::load_view('store-commision', $pageData);
    }

    public function render_messages()
    {
        global $filter, $messages;
        $pageData = array();

        if (isset ($_POST["csvp_request"]) && $_POST["csvp_request"] == "delete_message") {
            $payload = $_POST;
            $response = $messages->delete_community_message($payload);
            if (!is_wp_error($response)) {

                CSVP_Notification::add(CSVP_Notification::SUCCESS, "Message has been Deleted successfully");
            } else {
                CSVP_Notification::add(CSVP_Notification::ERROR, $response);

            }
        }

        $messages = $this->message->get_all_community_messages_of_admin();

        $modifiedMessages = array();

        foreach ($messages as $message) {
             $message["message_filter_date"] = date('Y-m-d', strtotime($message["created_at"]));
             array_push($modifiedMessages, $message);
        }

        $pageData["messages"] = $modifiedMessages;


        if (isset($_POST["csvp_filter"]) && $_POST["csvp_filter"] == "filter_by_date") {
            unset($_POST["csvp_filter"]);
            $pageData["messages"] = $filter->filterData($pageData["messages"], $_POST);
        } else if (isset($_POST["csvp_filter"]) && $_POST["csvp_filter"] == "filter_by_name") {
            unset($_POST["csvp_filter"]);

            $pageData["messages"] = $filter->filterData($pageData["messages"], $_POST);
        }
        CSVP_View_Manager::load_view('messages', $pageData);
    }

    public function render_community_commisions()
    {
        global $commision, $community, $filter;

        if(isset($_POST["csvp_request"]) && $_POST["csvp_request"] == "pay_commision"){

            $data = array("month" => $_POST["month"], "year" => $_POST["year"], "entity_type"=>CSVP_User_Roles::ROLE_COMMUNITY_MANAGER, "entity_id"=> $_POST["entity_id"], "status"=>COMMISSION_STATUS_PAID);

            $reponse = $commision->update_commission($data);
            if($reponse){
                CSVP_Notification::add(CSVP_Notification::SUCCESS, "Commision Paid");
            } else {
                CSVP_Notification::add(CSVP_Notification::ERROR, "Commision Not Paid : ". $reponse);

            }
        }

        $commision_data = $commision->get_entity_commissions(CSVP_User_Roles::ROLE_COMMUNITY_MANAGER);
        $commisions = array();
        foreach ($commision_data as $value) {
            $value["community_data"] = $community->get_community_by_id($value["entity_id"]);
            $value["community_name"] = $value["community_data"]->community_name;
            $value["month_year"] = date("Y", strtotime($value["year"])) . "-" . date("m", strtotime($value["year"]));
            array_push($commisions, $value);
        }
        $pageData["commision"] = $commisions;


        if (isset($_POST["csvp_filter"]) && $_POST["csvp_filter"] == "filter_commision_by_name") {
            unset($_POST["csvp_filter"]);

            $pageData["commision"] = $filter->filterData($pageData["commision"], $_POST);
        } else if (isset($_POST["csvp_filter"]) && $_POST["csvp_filter"] == "filter_commision_by_my") {
            unset($_POST["csvp_filter"]);

            $pageData["commision"] = $filter->filterData($pageData["commision"], $_POST);
        } 
        CSVP_View_Manager::load_view('community-commision', $pageData);
    }

    public function render_requests(){
        global $joining_request;

        if (isset($_POST["csvp_request"]) && $_POST["csvp_request"] == "accept_request") {
            $payload = $_POST;

            $payload["request_status"] = JOINING_REQUEST_STATUS_APPROVED;

            $response = $joining_request->update_joining_request($payload);

            if (is_wp_error($response)) {
                CSVP_Notification::add(CSVP_Notification::ERROR, $response->get_error_message());
            } else {
                CSVP_Notification::add(CSVP_Notification::SUCCESS, 'Request Approved Successfully');
            }

            unset($_POST);
        }

        $joining_request_data = $joining_request->get_all_joining_requests();
        $pageData["joining_request_data"] = $joining_request_data;
        CSVP_View_Manager::load_view('joining-requests', $pageData);
    }

    function login_community() {
        $community_user_id = isset($_REQUEST["community_user_id"]) ? $_REQUEST["community_user_id"] : false;
        $referrer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : home_url('/admin');
        $target = home_url('/community');
        $admin_id  = get_current_user_id();
        if($community_user_id){
            if(CSVP_User_Roles::user_has_role(get_current_user_id(), CSVP_User_Roles::ROLE_SYSTEM_ADMIN)){
                $response = $this->switch_to_user($community_user_id);
                if(!is_wp_error($response)){
                    update_option('admin_link_id', $admin_id);
                    CSVP_Notification::add(CSVP_Notification::SUCCESS, "Logging In");
                    header("Location: " . $target);
                } else {
                    echo $response->get_error_message();
                    // header("Location: " . $referrer);
                }
            } else {
                CSVP_Notification::add(CSVP_Notification::ERROR, "Invalid request");
                header("Location: " . $referrer);
            }
        } else {
            CSVP_Notification::add(CSVP_Notification::ERROR, "Invalid community_user_id");
            header("Location: ". $referrer);
        }
    }


    function logout_community()
    {
        $admin_link_id = get_option('admin_link_id') ? get_option('admin_link_id') : false;
        $referrer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : home_url('/community');
        $target = home_url('/admin');
        $community_id  = get_current_user_id();
        if ($admin_link_id) {
      
                $response = $this->switch_to_user($admin_link_id);
                if (!is_wp_error($response)) {
                    delete_option('admin_link_id');
                    CSVP_Notification::add(CSVP_Notification::ERROR, "Logging Out");
                    header("Location: " . $target);
                } else {
                    echo $response->get_error_message();
                    header("Location: " . $referrer);
                }
           
        } else {
            CSVP_Notification::add(CSVP_Notification::ERROR, "Invalid admin_link_id");
            header("Location: " . $referrer);
        }
    }


    function login_store()
    {
        $store_user_id = isset($_REQUEST["store_user_id"]) ? $_REQUEST["store_user_id"] : false;
        $referrer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : home_url('/admin');
        $target = home_url('/store');
        $admin_id  = get_current_user_id();
        if ($store_user_id) {
            if (CSVP_User_Roles::user_has_role(get_current_user_id(), CSVP_User_Roles::ROLE_SYSTEM_ADMIN)) {
                $response = $this->switch_to_user($store_user_id);
                if (!is_wp_error($response)) {
                    update_option('admin_link_id', $admin_id);
                    CSVP_Notification::add(CSVP_Notification::SUCCESS, "Logging In");
                    header("Location: " . $target);
                } else {
                    echo $response->get_error_message();
                    // header("Location: " . $referrer);
                }
            } else {
                CSVP_Notification::add(CSVP_Notification::ERROR, "Invalid request");
                header("Location: " . $referrer);
            }
        } else {
            CSVP_Notification::add(CSVP_Notification::ERROR, "Invalid store_user_id");
            header("Location: " . $referrer);
        }
    }


    function logout_store()
    {
        $admin_link_id = get_option('admin_link_id') ? get_option('admin_link_id') : false;
        $referrer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : home_url('/store');
        $target = home_url('/admin');
        $store_id  = get_current_user_id();
        if ($admin_link_id) {

            $response = $this->switch_to_user($admin_link_id);
            if (!is_wp_error($response)) {
                delete_option('admin_link_id');
                CSVP_Notification::add(CSVP_Notification::ERROR, "Logging Out");
                header("Location: " . $target);
            } else {
                echo $response->get_error_message();
                header("Location: " . $referrer);
            }
        } else {
            CSVP_Notification::add(CSVP_Notification::ERROR, "Invalid admin_link_id");
            header("Location: " . $referrer);
        }
    }


    
    function switch_to_user($user_id)
    {
        // Check if the user ID is valid
        if (!is_numeric($user_id) || $user_id <= 0) {
            return new WP_Error('invalid_user_id', 'Invalid user ID provided.');
        }

        // Get the user data
        $user = get_user_by('id', $user_id);
        if (!$user) {
            return new WP_Error('user_not_found', 'User not found.');
        }

        // Set the current user
        wp_set_current_user($user_id, $user->user_login);

        // Log in as the specified user
        wp_set_auth_cookie($user_id);

        return $user;
    }

}
