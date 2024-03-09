<?php

class CSVP_Voucher_Test {
    private $voucher;

    public function __construct() {
        $this->voucher = new CSVP_Voucher();
    }

    public function run_tests() {
        $results = array();

        // Test create_voucher
        // $create_voucher_result = $this->test_create_voucher();
        // $results['create_voucher'] = $create_voucher_result;

        // // Test get_voucher_by_id
        // $get_voucher_by_id_result = $this->test_get_voucher_by_id();
        // $results['get_voucher_by_id'] = ($get_voucher_by_id_result ? 'Pass' : 'Fail') . ' | Response : '.json_encode($get_voucher_by_id_result);

        // // Test update_voucher
        // $update_voucher_result = $this->test_update_voucher();
        // $results['update_voucher'] = $update_voucher_result;

        // // Test delete_voucher
        // $delete_voucher_result = $this->test_delete_voucher();
        // $results['delete_voucher'] = $delete_voucher_result;

        // // Test get_all_vouchers_by_store_id
        // $get_all_vouchers_by_store_id_result = $this->test_get_all_vouchers_by_store_id();
        // $results['get_all_vouchers_by_store_id'] = ($get_all_vouchers_by_store_id_result ? 'Pass' : 'Fail') . ' | Response : '.json_encode($get_all_vouchers_by_store_id_result);

        // Save results to file
        $this->save_results_to_file($results);
    }

    private function test_create_voucher() {
        // Test data
        $data = array(
            'product_name' => 'Test Product',
            'voucher_price' => 10.50,
            'normal_price' => 15.00,
            'product_image' => 'test_product.jpg',
            'store_id' => 1
        );

        // Create voucher
        $result = $this->voucher->create_voucher($data);

        // Return result
        return $result ? 'Pass' : 'Fail';
    }

    private function test_get_voucher_by_id() {
        // Test data
        $data = array(
            'voucher_id' => 6
        );

        // Get voucher by ID
        $result = $this->voucher->get_voucher_by_id($data);

        // Return result
        return $result;
    }

    private function test_update_voucher() {
        // Test data
        $data = array(
            'voucher_id' => 2,
            'product_name' => 'Updated Product Name'
        );

        // Update voucher
        $result = $this->voucher->update_voucher($data);

        // Return result
        return $result ? 'Pass' : 'Fail';
    }

    private function test_delete_voucher() {
        // Test data
        $data = array(
            'voucher_id' => 5
        );

        // Delete voucher
        $result = $this->voucher->delete_voucher($data);

        // Return result
        return $result ? 'Pass' : 'Fail';
    }

    private function test_get_all_vouchers_by_store_id() {
        // Test data
        $data = array(
            'store_id' => 1
        );

        // Get all vouchers by store ID
        $result = $this->voucher->get_all_vouchers_by_store_id($data);

        // Return result
        return $result;
    }

    private function save_results_to_file($results) {
        $file_path = CSVP_PLUGIN_PATH.'tests/reports/CSVP_Voucher.txt';

        // Open file for writing
        $file = fopen($file_path, 'w');

        // Write results to file
        foreach ($results as $test_name => $result) {
            fwrite($file, "Test: $test_name | Result: $result\n");
        }

        // Close file
        fclose($file);
    }
}

// Run tests
$voucher_test = new CSVP_Voucher_Test();
$voucher_test->run_tests();

?>
