<?php
class CSVP_Store_Test {
    private $store_instance;
    private $report_directory;

    public function __construct() {
        $this->store_instance = new CSVP_Store();
        $this->report_directory = CSVP_PLUGIN_PATH.'tests/reports';
    }

    public function run_tests() {
        // $this->create_store_test();
        // $this->get_store_by_id_test();
        // $this->get_stores_by_name_test();
        // $this->update_store_test();
        // $this->delete_store_test();
        // $this->get_all_stores_test();
    }

    private function create_store_test() {
        $test_data = array(
            'store_name' => 'Test Store',
            'store_phone' => '123-456-7890',
            'store_address' => '123 Test Street',
            'store_logo' => 'test_logo.jpg',
            'store_mail_address' => 'test@store.com',
            'wp_user_id' => 1,
            'fee_amount_per_transaction' => 10.00
        );

        $result = $this->store_instance->create_store($test_data);

        // Write test result to report file
        $this->write_to_report('create_store_test', $result ? 'Pass' : 'Fail', $result);
    }

    private function get_store_by_id_test() {
        $store_id = 5;
        $result = $this->store_instance->get_store_by_id($store_id);

        // Write test result to report file
        $this->write_to_report('get_store_by_id_test', $result ? 'Pass' : 'Fail', $result);
    }

    private function get_stores_by_name_test() {
        $store_name = 'Test';
        $result = $this->store_instance->get_stores_by_name($store_name);

        // Write test result to report file
        $this->write_to_report('get_stores_by_name_test', $result ? 'Pass' : 'Fail', $result);
    }

    private function update_store_test() {
        $test_data = array(
            'store_id' => 5,
            'store_phone' => '987-654-3210'
            // Add other fields to update here if needed
        );

        $result = $this->store_instance->update_store($test_data);

        // Write test result to report file
        $this->write_to_report('update_store_test', $result ? 'Pass' : 'Fail', $result);
    }

    private function delete_store_test() {
        $store_id = 1;
        $result = $this->store_instance->delete_store($store_id);

        // Write test result to report file
        $this->write_to_report('delete_store_test', $result ? 'Pass' : 'Fail', $result);
    }

    private function get_all_stores_test() {
        $result = $this->store_instance->get_all_stores();

        // Write test result to report file
        $this->write_to_report('get_all_stores_test', $result !== null ? 'Pass' : 'Fail', $result);
    }

    private function write_to_report($test_name, $result, $data) {
        $report_file = $this->report_directory . '/CSVP_Store.txt';
        $report = "Test: $test_name | Result: $result | Response: ". json_encode($data) . PHP_EOL;

        // Append test result to the report file
        file_put_contents($report_file, $report, FILE_APPEND);
    }
}

// Instantiate and run the tests
$store_test = new CSVP_Store_Test();
$store_test->run_tests();
