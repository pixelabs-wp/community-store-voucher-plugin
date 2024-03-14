<?php

class CSVP_VoucherTransaction_Test {
    private $test_results = [];

    public function __construct() {
        $this->run_tests();
        $this->save_results();
    }

    private function run_tests() {
        // $this->test_create_voucher_transaction();
        // $this->test_update_voucher_transaction();
        // $this->test_delete_voucher_transaction();
        // $this->test_get_all_voucher_transactions();
        // $this->test_get_voucher_transactions_by_member_id();
        // $this->test_get_voucher_transactions_by_voucher_id();
    }

    private function test_create_voucher_transaction() {
        $voucher_transaction_data = array(
            'community_member_id' => 1,
            'voucher_id' => 1,
            'transaction_type' => 'Purchase',
            'transaction_amount' => 50.00,
            'transaction_date' => '2024-03-03',
            'status' => 'Completed'
        );

        $voucher_transaction = new CSVP_VoucherTransaction();
        $result = $voucher_transaction->create_voucher_transaction($voucher_transaction_data);

        if ($result !== false) {
            $this->test_results[] = "Test: create_voucher_transaction | Result: Pass | Response: $result";
        } else {
            $this->test_results[] = "Test: create_voucher_transaction | Result: Fail";
        }
    }


    private function test_update_voucher_transaction() {
        $voucher_transaction_data = array(
            'voucher_transaction_id' => 3,
            'transaction_type' => 'Refund',
            'status' => 'Pending'
        );

        $voucher_transaction = new CSVP_VoucherTransaction();
        $result = $voucher_transaction->update_voucher_transaction($voucher_transaction_data);

        if ($result) {
            $this->test_results[] = "Test: update_voucher_transaction | Result: Pass";
        } else {
            $this->test_results[] = "Test: update_voucher_transaction | Result: Fail";
        }
    }

    private function test_delete_voucher_transaction() {
        $voucher_transaction_id = 2;
        $voucher_transaction = new CSVP_VoucherTransaction();
        $result = $voucher_transaction->delete_voucher_transaction(array("voucher_transaction_id"=>$voucher_transaction_id));

        if ($result) {
            $this->test_results[] = "Test: delete_voucher_transaction | Result: Pass";
        } else {
            $this->test_results[] = "Test: delete_voucher_transaction | Result: Fail";
        }
    }

    private function test_get_all_voucher_transactions() {
        $voucher_transaction = new CSVP_VoucherTransaction();
        $result = $voucher_transaction->get_all_voucher_transactions();

        if ($result !== null) {
            $this->test_results[] = "Test: get_all_voucher_transactions | Result: Pass | Response: " . json_encode($result);
        } else {
            $this->test_results[] = "Test: get_all_voucher_transactions | Result: Fail";
        }
    }

    private function test_get_voucher_transactions_by_member_id() {
        $member_id = 1;
        $voucher_transaction = new CSVP_VoucherTransaction();
        $result = $voucher_transaction->get_voucher_transactions_by_member_id(array("member_id"=>$member_id));

        if ($result !== null) {
            $this->test_results[] = "Test: get_voucher_transactions_by_member_id | Result: Pass | Response: " . json_encode($result);
        } else {
            $this->test_results[] = "Test: get_voucher_transactions_by_member_id | Result: Fail";
        }
    }

    private function test_get_voucher_transactions_by_voucher_id() {
        $voucher_id = 1;
        $voucher_transaction = new CSVP_VoucherTransaction();
        $result = $voucher_transaction->get_voucher_transactions_by_voucher_id(array("voucher_id"=>$voucher_id));

        if ($result !== null) {
            $this->test_results[] = "Test: get_voucher_transactions_by_voucher_id | Result: Pass | Response: " . json_encode($result);
        } else {
            $this->test_results[] = "Test: get_voucher_transactions_by_voucher_id | Result: Fail";
        }
    }

    private function save_results() {
        $file_path = CSVP_PLUGIN_PATH.'tests/reports/CSVP_VoucherTransaction.txt';
        $file_content = implode(PHP_EOL, $this->test_results);
        file_put_contents($file_path, $file_content);
    }
}

// Run the test
new CSVP_VoucherTransaction_Test();

?>
