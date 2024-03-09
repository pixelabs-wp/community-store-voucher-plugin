<?php
// Base class with imports
class CSVP_Base {
    public $commision;
    public $community_member;
    public $community;
    public $database;
    public $joining_request;
    public $messages;
    public $order;
    public $request_handler;
    public $store;
    public $transaction;
    public $user_roles;
    public $view_manager;
    public $voucher_transaction;
    public $voucher;
    public $walk_order;
    public $community_message;
    public $user_id;

    public function __construct() {
        // Initialize all classes
        $this->commision = new CSVP_Commission();
        $this->community_member = new CSVP_CommunityMember();
        $this->community = new CSVP_Community();
        $this->database = new CSVP_Initialize_Database();
        $this->joining_request = new CSVP_JoiningRequest();
        $this->messages = new CSVP_CommunityMessage();
        $this->order = new CSVP_Order();
        $this->request_handler = new CSVP_Ajax_Handler();
        $this->store = new CSVP_Store();
        $this->transaction = new CSVP_Transaction();
        $this->user_roles = new CSVP_User_Roles();
        $this->view_manager = new CSVP_View_Manager();
        $this->voucher_transaction = new CSVP_VoucherTransaction();
        $this->voucher = new CSVP_Voucher();
        $this->walk_order = new CSVP_WalkOrder();
        $this->community_message = new CSVP_CommunityMessage();
        $this->user_id = get_current_user_id();
    }
}
?>
