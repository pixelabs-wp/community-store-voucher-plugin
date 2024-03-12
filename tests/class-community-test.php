<?php
// Include the class to be tested
require_once ABSPATH . '/wp-admin/includes/upgrade.php';

require_once CSVP_PLUGIN_PATH.'includes/class-community.php';

// Create a new instance of the class
$community = new CSVP_Community();

// Create a function to save the test results to a file
function save_test_report($test_results) {
    $file = fopen(CSVP_PLUGIN_PATH.'tests/reports/CSVP_Community.txt', 'w');
    fwrite($file, $test_results);
    fclose($file);
}

// Test create_community function
function test_create_community($community) {
    // Test data
    $data = array(
        'community_name' => 'Test Community New',
        'community_manager_name' => 'Manager Name',
        'community_manager_phone' => '1234567890',
        'community_logo' => 'logo.jpg',
        'community_mail_address' => 'test@example.com',
        'wp_user_id' => get_current_user_id(),
        'payment_link' => 'payment_link'
    );

    // Call the function
    $result = $community->create_community($data);

    // Check if the result is an integer (ID) or false
    if (is_int($result)) {
        return 'create_community test: Passed
        , Response:'. json_encode($result).'
        ';
    } else {
        return 'create_community test: Failed
        , Response:'. json_encode($result).'
        ';
    }
}

// Test get_community_by_id function
function test_get_community_by_id($community) {
    // Call the function with a valid ID
    $community_data = $community->get_community_by_id(5);

    // Check if community data is returned
    if ($community_data !== false) {
        return 'get_community_by_id test: Passed
        , Response:'. json_encode($community_data).'
        ';
    } else {
        return 'get_community_by_id test: Failed
        , Response:'. json_encode($community_data).'
        ';
    }
}

// Test get_communities_by_name function
function test_get_communities_by_name($community) {
    // Call the function with a valid name
    $communities = $community->get_communities_by_name('Test');

    // Check if array of communities is returned
    if (!empty($communities)) {
        return 'get_communities_by_name test: Passed
        , Response:'. json_encode($communities).'
        ';
    } else {
        return 'get_communities_by_name test: Failed
        , Response:'. json_encode($communities).'
        ';
    }
}

// Test update_community function
function test_update_community($community) {
    // Test data
    $data = array(
        'community_id' => 4, // Valid community ID
        'community_name' => 'Updated Community Name'
    );

    // Call the function
    $result = $community->update_community($data);

    // Check if the result is true (success) or false
    if ($result === true) {
        return 'update_community test: Passed
        , Response:'. json_encode($result).'
        ';
    } else {
        return 'update_community test: Failed
        , Response:'. json_encode($result).'
        ';
    }
}

// Test delete_community function
function test_delete_community($community) {
    // Test data
    $data = array(
        'community_id' => 1 // Valid community ID
    );

    // Call the function
    $result = $community->delete_community($data);

    // Check if the result is true (success) or false
    if ($result === true) {
        return 'delete_community test: Passed
        , Response:'. json_encode($result).'
        ';
    } else {
        return 'delete_community test: Failed
        , Response:'. json_encode($result).'
        ';
    }
}

// Test get_all_communities function
function test_get_all_communities($community) {
    // Call the function
    $communities = $community->get_all_communities();

    // Check if array of communities is returned
    if (!empty($communities)) {
        return 'get_all_communities test: Passed
        , Response:'. json_encode($communities).'
        ';
    } else {
        return 'get_all_communities test: Failed
        , Response:'. json_encode($communities).'
        ';
    }
}

// Run tests and save results to a file
$test_results = '';
$test_results .= test_create_community($community) . PHP_EOL;
// $test_results .= test_get_community_by_id($community) . PHP_EOL;
// $test_results .= test_get_communities_by_name($community) . PHP_EOL;
// $test_results .= test_update_community($community) . PHP_EOL;
// $test_results .= test_delete_community($community) . PHP_EOL;
// $test_results .= test_get_all_communities($community) . PHP_EOL;

// Save test results to a file
save_test_report($test_results);

echo 'Test completed. Check reports/CSVP_Community.txt for the test results.' . PHP_EOL;
?>
