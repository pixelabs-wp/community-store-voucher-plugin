<?php

class CSVP_CommunityMessage_Test {
    private $test_results = [];

    public function __construct() {
        $this->test_results['create_community_message'] = $this->test_create_community_message();
        // $this->test_results['get_community_message_by_id'] = $this->test_get_community_message_by_id();
        // $this->test_results['update_community_message'] = $this->test_update_community_message();
        // $this->test_results['delete_community_message'] = $this->test_delete_community_message();
        // $this->test_results['get_all_community_messages'] = $this->test_get_all_community_messages();
        // $this->test_results['get_community_messages_by_member_id'] = $this->test_get_community_messages_by_member_id();
        // $this->test_results['get_community_messages_by_community_id'] = $this->test_get_community_messages_by_community_id();

        // Write test results to a file
        $this->write_results_to_file();
    }

    private function test_create_community_message() {
        global $wpdb;

        // Prepare data for testing
        $data = array(
            'from_id' => 1,
            'to_id' => 1,
            'to_user_role'=> 'Admin',
            'full_name' => 'John Doe',
            'phone_no' => '1234567890',
            'content' => 'Test message content'
        );

        // Call the create_community_message method
        $community_message = new CSVP_CommunityMessage();
        $result = $community_message->create_community_message($data);

        // Check if the result is numeric (insertion successful)
        return is_numeric($result) ? 'Pass' : 'Fail';
    }

    private function test_get_community_message_by_id() {
        global $wpdb;

        // Prepare data for testing
        $data = array(
            'message_id' => 5
        );

        // Call the get_community_message_by_id method
        $community_message = new CSVP_CommunityMessage();
        $result = $community_message->get_community_message_by_id($data);

        // Check if the result is an object
        return is_object($result) ? 'Pass' : 'Fail';
    }

    private function test_update_community_message() {
        global $wpdb;

        // Prepare data for testing
        $data = array(
            'message_id' => 4,
            'content' => 'Updated message content'
            // Add other fields to update as needed
        );

        // Call the update_community_message method
        $community_message = new CSVP_CommunityMessage();
        $result = $community_message->update_community_message($data);

        // Check if the result is true (update successful)
        return $result === true ? 'Pass' : 'Fail';
    }

    private function test_delete_community_message() {
        global $wpdb;

        // Prepare data for testing
        $data = array(
            'message_id' => 7
        );

        // Call the delete_community_message method
        $community_message = new CSVP_CommunityMessage();
        $result = $community_message->delete_community_message($data);

        // Check if the result is true (deletion successful)
        return $result === true ? 'Pass' : 'Fail';
    }

    private function test_get_all_community_messages() {
        global $wpdb;

        // Call the get_all_community_messages method
        $community_message = new CSVP_CommunityMessage();
        $result = $community_message->get_all_community_messages();

        // Check if the result is an array
        return is_array($result) ? 'Pass' : 'Fail';
    }

    private function test_get_community_messages_by_member_id() {
        global $wpdb;

        // Prepare data for testing
        $data = array(
            'from_id' => 1
        );

        // Call the get_community_messages_by_member_id method
        $community_message = new CSVP_CommunityMessage();
        $result = $community_message->get_community_messages_by_member_id($data);

        // Check if the result is an array
        return is_array($result) ? 'Pass' : 'Fail';
    }

    private function test_get_community_messages_by_community_id() {
        global $wpdb;

        // Prepare data for testing
        $data = array(
            'to_id' => 1
        );

        // Call the get_community_messages_by_community_id method
        $community_message = new CSVP_CommunityMessage();
        $result = $community_message->get_community_messages_by_community_id($data);

        // Check if the result is an array
        return is_array($result) ? 'Pass' : 'Fail';
    }

    private function write_results_to_file() {
        // Write test results to a file
        $file_path = CSVP_PLUGIN_PATH.'tests/reports/CSVP_CommunityMessage_Test.txt';
        $file_content = '';
        foreach ($this->test_results as $test_name => $result) {
            $file_content .= "Test: $test_name | Result: $result\n";
        }
        file_put_contents($file_path, $file_content);
    }
}

// Run the test class
new CSVP_CommunityMessage_Test();

?>
