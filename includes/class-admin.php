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

        $communities = $this->community->get_all_communities();
        $modifiedCommunities = array(); // Create a new array to hold modified data
      
        if (!is_wp_error($communities)) 
        {  
            foreach ($communities as $community) {
                $number_of_guys = $this->community_member->get_community_members_by_community_id(array('count' => 'true', 'community_id' => $community['id']));
                // Add the count of members as a new key in each community array
                $community['number_of_guys'] = $number_of_guys;
                $community['commision_pending'] = count($commision->get_commissions_by_entity_id($community['id'], CSVP_User_Roles::ROLE_COMMUNITY_MANAGER, COMMISSION_STATUS_PENDING)) > 0 ? 0 : 1;
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

        }
       
        CSVP_View_Manager::load_view('community-management', $pageData);
    }

    public function render_store_management()
    {
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
        $pageData = array(); // or $emptyArray = [];
        $stores = $this->store->get_all_stores();
        if (!is_wp_error($stores)) 
        {
            $pageData["stores"] = $stores;
        }
        $number_of_stores = $this->store->get_all_stores(array("count" => true));
        if (!is_wp_error($stores)) 
        {
            $pageData["total_stores"] = $number_of_stores;
        }
        

        CSVP_View_Manager::load_view('store-management', $pageData);
    }

    public function render_store_commisions()
    {
        global $commision, $store;

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
            array_push($commisions, $value);
        }
        $pageData["commision"] = $commisions;
        CSVP_View_Manager::load_view('store-commision', $pageData);
    }

    public function render_messages()
    {
        $pageData = array();

        $messages = $this->message->get_all_community_messages_of_admin();
        $pageData["messages"] = $messages;
        CSVP_View_Manager::load_view('messages', $pageData);
    }

    public function render_community_commisions()
    {
        global $commision, $community;

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
            array_push($commisions, $value);
        }
        $pageData["commision"] = $commisions;
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
        $community_id = isset($_REQUEST["community_id"]) ? $_REQUEST["community_id"] : false;
        $referrer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : home_url('/admin');
        if($community_id){
            if(CSVP_User_Roles::user_has_role(get_current_user_id(), CSVP_User_Roles::ROLE_SYSTEM_ADMIN)){
                // switch_to_user
            }
        } else {
            CSVP_Notification::add(CSVP_Notification::ERROR, "Invalid Community");
            header("Location: ". $referrer);
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
    }

}
