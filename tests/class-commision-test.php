<?php


// Test the create_commission method
function create_commission_test() {
    $commission_data = array(
        'entity_id' => 1,
        'entity_type' => 'community',
        'commission_type' => 'type1',
        'commission_value' => 10.50
    );

    $commission_obj = new CSVP_Commission();
    $commission_id = $commission_obj->create_commission($commission_data);

    if ($commission_id) {
        return "Pass";
    } else {
        return "Fail";
    }
}

// Test the get_commission_by_id method
function get_commission_by_id_test() {
    $commission_id = 1;

    $commission_obj = new CSVP_Commission();
    $commission = $commission_obj->get_commission_by_id($commission_id);

    if ($commission) {
        return "Pass";
    } else {
        return "Fail";
    }
}

// Test the get_all_commissions method
function get_all_commissions_test() {
    $commission_obj = new CSVP_Commission();
    $commissions = $commission_obj->get_all_commissions();

    if (!empty($commissions)) {
        return "Pass";
    } else {
        return "Fail";
    }
}

// Test the get_commissions_by_type method
function get_commissions_by_type_test() {
    $commission_type = 'type1';

    $commission_obj = new CSVP_Commission();
    $commissions = $commission_obj->get_commissions_by_type($commission_type);

    if (!empty($commissions)) {
        return "Pass";
    } else {
        return "Fail";
    }
}

// Test the get_commissions_by_entity_name method
function get_commissions_by_entity_id_test() {
    $entity_id = 1;

    $commission_obj = new CSVP_Commission();
    $commissions = $commission_obj->get_commissions_by_entity_id($entity_id);

    if (!empty($commissions)) {
        return "Pass";
    } else {
        return "Fail".json_encode( $commissions );
    }
}

// Create an array to store test results
$test_results = array(
    'create_commission_test' => create_commission_test(),
    'get_commission_by_id_test' => get_commission_by_id_test(),
    'get_all_commissions_test' => get_all_commissions_test(),
    'get_commissions_by_type_test' => get_commissions_by_type_test(),
    'get_commissions_by_entity_id_test' => get_commissions_by_entity_id_test()
);


// Write test results to a text file
$report_file = fopen(CSVP_PLUGIN_PATH.'tests/reports/CSVP_Commision.txt', 'w');
foreach ($test_results as $test => $result) {
    fwrite($report_file, "Test: $test | Result: $result" . PHP_EOL);
}
fclose($report_file);

echo "Test report generated successfully!\n";
?>
