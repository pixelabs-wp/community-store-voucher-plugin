<?php

class CSVP_Admin
{
    private $community;
    private $community_member;
    private $store;
    
    public function __construct()
    {
        $this->community = new CSVP_Community();
        $this->store = new CSVP_Store();
        $this->community_member = new CSVP_CommunityMember();
    }
    //Method to render transaction history
    public function render_community_management()
    {
        if (isset($_POST["csvp_request"]) && $_POST["csvp_request"] == "add_community") {
            $payload = $_POST;

            $response = $this->community->create_community($payload);
            if (is_wp_error($response)) {
                CSVP_Notification::add(CSVP_Notification::ERROR, $response->get_error_message());
            } else{
                CSVP_Notification::add(CSVP_Notification::SUCCESS, 'Community Added Successfully');
            }
        }
        $pageData = array(); // or $emptyArray = [];

        $communities = $this->community->get_all_communities();
        $modifiedCommunities = array(); // Create a new array to hold modified data
      
        if (!is_wp_error($communities)) 
        {  
            foreach ($communities as $community) {
                $number_of_guys = $this->community_member->get_community_members_by_community_id(array('count' => 'true', 'community_id' => $community['id']));
                // Add the count of members as a new key in each community array
                $community['number_of_guys'] = $number_of_guys;
                $modifiedCommunities[] = $community; // Add the modified community to the new array
            }
            $number_of_communities = $this->community->get_all_communities(array("count"=>true));
            $pageData["communities"] = $modifiedCommunities;
            $pageData["total_communities"] = $number_of_communities;
            // Assuming CSVP_View_Manager::load_view() is properly configured  
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
        CSVP_View_Manager::load_view('store-commision');
    }

    public function render_messages()
    {
        CSVP_View_Manager::load_view('messages');
    }

    public function render_community_commisions()
    {
        CSVP_View_Manager::load_view('community-commision');
    }

}
