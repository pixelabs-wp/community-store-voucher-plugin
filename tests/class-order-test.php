<?php
class CSVP_Order_Test {
    public function run_tests() {
        $this->test_create_order();
        // $this->test_get_order_by_id();
        // $this->test_update_order();
        // $this->test_delete_order();
        // $this->test_get_all_orders();
        // $this->test_get_orders_by_community_id();
        // $this->test_get_orders_by_store_id();
    }

    public function test_create_order() {
        // Prepare test data
        $order_data = array(
            'community_id' => 1,
            'store_id' => 1,
            'order_status' => 'Pending',
            'order_total' => 100.00,
            'order_date' => date('Y-m-d H:i:s'),
            'product_name' => array('Shirts', 'Jeans', 'Ties'),
            'cost_per_item' => array('10', '15', '20'),
            'total_item' => array('2', '1', '5'),
            'total_cost' => array('20','15', '100'),
            'message' => "Order Created Successfully"
        );

        // Create CSVPC_Order instance
        $order = new CSVP_Order();

        // Test create_order method
        $result = $order->create_order($order_data);

        // Write test result to file
        $this->write_result('create_order', $result ? 'Pass' : 'Fail', $result);
    }

    public function test_get_order_by_id() {
        // Set order ID for testing
        $order_id = 3;

        // Create CSVP_Order instance
        $order = new CSVP_Order();

        // Test get_order_by_id method
        $result = $order->get_order_by_id(array('order_id'=>$order_id));

        // Write test result to file
        $this->write_result('get_order_by_id', $result ? 'Pass' : 'Fail', $result);
    }

    public function test_update_order() {
        // Prepare test data
        $order_id = 2;
        $order_data = array(
            'order_status' => 'Completed',
            'order_total' => 150.00,
            'order_id' => 3
        );

        // Create CSVP_Order instance
        $order = new CSVP_Order();

        // Test update_order method
        $result = $order->update_order($order_data);

        // Write test result to file
        $this->write_result('update_order', $result ? 'Pass' : 'Fail', $result);
    }

    public function test_delete_order() {
        // Set order ID for testing
        $order_id = 7;

        // Create CSVP_Order instance
        $order = new CSVP_Order();

        // Test delete_order method
        $result = $order->delete_order(array('order_id'=>$order_id));

        // Write test result to file
        $this->write_result('delete_order', $result ? 'Pass' : 'Fail', $result);
    }

    public function test_get_all_orders() {
        // Create CSVP_Order instance
        $order = new CSVP_Order();

        // Test get_all_orders method
        $result = $order->get_all_orders();

        // Write test result to file
        $this->write_result('get_all_orders', $result ? 'Pass' : 'Fail', $result);
    }

    public function test_get_orders_by_community_id() {
        // Set community ID for testing
        $community_id = 1;

        // Create CSVP_Order instance
        $order = new CSVP_Order();

        // Test get_orders_by_community_id method
        $result = $order->get_orders_by_community_id(array('community_id'=>$community_id));

        // Write test result to file
        $this->write_result('get_orders_by_community_id', $result ? 'Pass' : 'Fail', $result);
    }

    public function test_get_orders_by_store_id() {
        // Set store ID for testing
        $store_id = 1;

        // Create CSVP_Order instance
        $order = new CSVP_Order();

        // Test get_orders_by_store_id method
        $result = $order->get_orders_by_store_id(array('store_id'=>$store_id));

        // Write test result to file
        $this->write_result('get_orders_by_store_id', $result ? 'Pass' : 'Fail', $result);
    }

    private function write_result($test_name, $result, $response) {
        $file_path = CSVP_PLUGIN_PATH.'tests/reports/CSVP_Order.txt';
        $output = "Test: $test_name | Result: $result | Response: " . json_encode($response) . "\n";
        file_put_contents($file_path, $output, FILE_APPEND);
    }
}

// Run tests
$order_test = new CSVP_Order_Test();
$order_test->run_tests();
?>
