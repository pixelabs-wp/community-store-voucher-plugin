<?php

class CSVP_CommunityMember_Test {
    private $test_results = [];

    public function __construct() {
        // $this->test_results['create_community_member'] = $this->test_create_community_member();
        // $this->test_results['get_community_member_by_id'] = $this->test_get_community_member_by_id();
        // $this->test_results['update_community_member'] = $this->test_update_community_member();
        // $this->test_results['delete_community_member'] = $this->test_delete_community_member();
        // $this->test_results['get_all_community_members'] = $this->test_get_all_community_members();
        // $this->test_results['get_community_members_by_community_id'] = $this->test_get_community_members_by_community_id();
        // $this->test_results['test_get_community_member_by_email'] = $this->test_get_community_member_by_email();

        // Write test results to a file
        $this->write_results_to_file();
    }

    private function test_create_community_member() {
        global $wpdb;

        // Prepare data for testing
        $data = array(
            'is_active' => 1,
            'community_id' => 1,
            'full_name' => 'John Doe',
            'phone_number' => '1234567890',
            'email_address' => 'john@example.com',
            'lesson' => 'Mathematics',
            'id_number' => 'ABC123',
            'address' => '123 Main Street',
            'magnetic_card_number_association' => 'XYZ456',
            'card_balance' => 100.00
        );

        // Call the create_community_member method
        $community_member = new CSVP_CommunityMember();
        $result = $community_member->create_community_member($data);

        // Check if the result is numeric (insertion successful)
        return is_numeric($result) ? 'Pass' : 'Fail';
    }

    private function test_get_community_member_by_id() {
        global $wpdb;

        // Prepare data for testing
        $data = array(
            'community_member_id' => 2
        );

        // Call the get_community_member_by_id method
        $community_member = new CSVP_CommunityMember();
        $result = $community_member->get_community_member_by_id($data);

        // Check if the result is an object
        return is_object($result) ? 'Pass' : 'Fail';
    }

    
    private function test_get_community_member_by_email() {
        global $wpdb;

        // Prepare data for testing
        $data = array(
            'email_address' => 'test_member_nre11@khan.asd1'
        );

        // Call the get_community_member_by_id method
        $community_member = new CSVP_CommunityMember();
        $result = $community_member->get_community_member_by_email($data);

        // Check if the result is an object
        return json_encode($result);
    }

    private function test_update_community_member() {
        global $wpdb;

        // Prepare data for testing
        $data = array(
            'community_member_id' => 2,
            'full_name' => 'Updated Name'
            // Add other fields to update as needed
        );

        // Call the update_community_member method
        $community_member = new CSVP_CommunityMember();
        $result = $community_member->update_community_member($data);

        // Check if the result is true (update successful)
        return $result === true ? 'Pass' : 'Fail';
    }

    private function test_delete_community_member() {
        global $wpdb;

        // Prepare data for testing
        $data = array(
            'community_member_id' => 3
        );

        // Call the delete_community_member method
        $community_member = new CSVP_CommunityMember();
        $result = $community_member->delete_community_member($data);

        // Check if the result is true (deletion successful)
        return $result === true ? 'Pass' : 'Fail';
    }

    private function test_get_all_community_members() {
        global $wpdb;

        // Call the get_all_community_members method
        $community_member = new CSVP_CommunityMember();
        $result = $community_member->get_all_community_members();

        // Check if the result is an array
        return is_array($result) ? 'Pass' : 'Fail';
    }

    private function test_get_community_members_by_community_id() {
        global $wpdb;

        // Prepare data for testing
        $data = array(
            'community_id' => 1
        );

        // Call the get_community_members_by_community_id method
        $community_member = new CSVP_CommunityMember();
        $result = $community_member->get_community_members_by_community_id($data);

        // Check if the result is an array
        return is_array($result) ? 'Pass' : 'Fail';
    }

    private function write_results_to_file() {
        // Write test results to a file
        $file_path = CSVP_PLUGIN_PATH.'tests/reports/CSVP_CommunityMember_Test.txt';
        $file_content = '';
        foreach ($this->test_results as $test_name => $result) {
            $file_content .= "Test: $test_name | Result: $result\n";
        }
        file_put_contents($file_path, $file_content);
    }
}

// Run the test class
new CSVP_CommunityMember_Test();

?>
