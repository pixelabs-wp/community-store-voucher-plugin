<?php


class CSVP_WalkOrder_Test {
    private $report_filename = CSVP_PLUGIN_PATH.'tests/reports/CSVP_WalkOrder_Test.txt';

    // Method to write test results to file
    private function write_to_file($test_name, $result) {
        $fp = fopen($this->report_filename, 'a');
        fwrite($fp, "Test: $test_name | Result: $result\n");
        fclose($fp);
    }

    // Method to test create_walk_order
    public function create_walk_order_test() {
        $walk_order = new CSVP_WalkOrder();

        // Test data
        $data = array(
            'community_member_id' => 1,
            'store_id' => 2,
            'order_status' => 'pending',
            'order_type' => 'walk',
            'payment_link' => 1,
            'product_name' => array('Shirts', 'Jeans', 'Ties'),
            'cost_per_item' => array('10', '15', '20'),
            'total_item' => array('2', '1', '5'),
            'total_cost' => array('20', '15', '100')
        );

        // Perform create_walk_order
        $result = $walk_order->create_walk_order($data);

        // Check if result is valid
        if ($result) {
            $this->write_to_file(__FUNCTION__, 'Pass');
        } else {
            $this->write_to_file(__FUNCTION__, 'Fail');
        }
    }

    // Method to test get_walk_order_by_id
    public function get_walk_order_by_id_test() {
        $walk_order = new CSVP_WalkOrder();

        // Test data
        $data = array(
            'walk_order_id' =>5
        );

        // Perform get_walk_order_by_id
        $result = $walk_order->get_walk_order_by_id($data);

        // Check if result is valid
        if ($result) {
            $this->write_to_file(__FUNCTION__, 'Pass');
        } else {
            $this->write_to_file(__FUNCTION__, 'Fail');
        }
    }

    // Method to test update_walk_order
    public function update_walk_order_test() {
        $walk_order = new CSVP_WalkOrder();

        // Test data
        $data = array(
            'walk_order_id' => 8,
            'order_status' => 'completed'
        );

        // Perform update_walk_order
        $result = $walk_order->update_walk_order($data);

        // Check if result is valid
        if ($result) {
            $this->write_to_file(__FUNCTION__, 'Pass');
        } else {
            $this->write_to_file(__FUNCTION__, 'Fail');
        }
    }

    // Method to test delete_walk_order
    public function delete_walk_order_test() {
        $walk_order = new CSVP_WalkOrder();

        // Test data
        $data = array(
            'walk_order_id' => 7
        );

        // Perform delete_walk_order
        $result = $walk_order->delete_walk_order($data);

        // Check if result is valid
        if ($result) {
            $this->write_to_file(__FUNCTION__, 'Pass');
        } else {
            $this->write_to_file(__FUNCTION__, 'Fail');
        }
    }

    // Method to test get_all_walk_orders
    public function get_all_walk_orders_test() {
        $walk_order = new CSVP_WalkOrder();

        // Perform get_all_walk_orders
        $result = $walk_order->get_all_walk_orders();

        // Check if result is valid
        if ($result) {
            $this->write_to_file(__FUNCTION__, 'Pass');
        } else {
            $this->write_to_file(__FUNCTION__, 'Fail');
        }
    }

    // Method to test get_walk_orders_by_community_id
    public function get_walk_orders_by_community_id_test() {
        $walk_order = new CSVP_WalkOrder();

        // Test data
        $data = array(
            'community_member_id' => 1
        );

        // Perform get_walk_orders_by_community_id
        $result = $walk_order->get_walk_orders_by_community_member_id($data);

        // Check if result is valid
        if ($result) {
            $this->write_to_file(__FUNCTION__, 'Pass');
        } else {
            $this->write_to_file(__FUNCTION__, 'Fail');
        }
    }

    // Method to test get_walk_orders_by_store_id
    public function get_walk_orders_by_store_id_test() {
        $walk_order = new CSVP_WalkOrder();

        // Test data
        $data = array(
            'store_id' => 2
        );

        // Perform get_walk_orders_by_store_id
        $result = $walk_order->get_walk_orders_by_store_id($data);

        // Check if result is valid
        if ($result) {
            $this->write_to_file(__FUNCTION__, 'Pass');
        } else {
            $this->write_to_file(__FUNCTION__, 'Fail');
        }
    }

    // Method to run all test methods
    public function run_tests() {
        $this->create_walk_order_test();
        // $this->get_walk_order_by_id_test();
        // $this->update_walk_order_test();
        // $this->delete_walk_order_test();
        // $this->get_all_walk_orders_test();
        // $this->get_walk_orders_by_community_id_test();
        // $this->get_walk_orders_by_store_id_test();
    }
}

// Run tests
$test = new CSVP_WalkOrder_Test();
$test->run_tests();

?>
