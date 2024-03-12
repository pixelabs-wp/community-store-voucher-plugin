<?php
require_once ABSPATH . '/wp-admin/includes/upgrade.php';

// Instantiate the class
$joiningRequest = new CSVP_JoiningRequest();

// Define sample data
$requestData = array(
    'community_id' => 1,
    'store_id' => 2,
    'request_status' => JOINING_REQUEST_STATUS_PENDING,
    'requested_by' => 'John Doe'
);

// Test create_joining_request method
$createResult = $joiningRequest->create_joining_request($requestData);
$createTestResult = $createResult ? 'Pass' : 'Fail';

// // Test get_joining_request_by_id method
// $requestId = 'John Doe'; // Change to an existing request ID for testing
// $getByIdResult = $joiningRequest->get_joining_requests_by_requested_by($requestId);
// $getByIdTestResult = $getByIdResult ? 'Pass' : 'Fail';

// // Test update_joining_request method
// $updateData = array(
//     'request_status' => 'approved',
//     'request_id' => 5
// );
// $updateResult = $joiningRequest->update_joining_request($updateData);
// $updateTestResult = $updateResult;

// $requestId = 1; // Change to an existing request ID for testing
// // Test delete_joining_request method
// $deleteResult = $joiningRequest->delete_joining_request($requestId);
// $deleteTestResult = $deleteResult ? 'Pass' : 'Fail';

// Write test results to a text file
$testResults = "Test: create_joining_request | Result: $createTestResult\n";
// $testResults .= "Test: get_joining_requests_by_requested_by | Result: $getByIdTestResult\n";
// $testResults .= "Test: update_joining_request | Result: $updateTestResult\n";
// $testResults .= "Test: delete_joining_request | Result: $deleteTestResult\n";

file_put_contents(CSVP_PLUGIN_PATH.'tests/reports/CSVP_JoiningRequest.txt', $testResults);

echo "Tests completed. Results saved to reports/CSVP_JoiningRequest.txt\n";
