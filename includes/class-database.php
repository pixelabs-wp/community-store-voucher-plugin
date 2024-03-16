<?php

require_once ABSPATH . '/wp-admin/includes/upgrade.php';

class CSVP_Initialize_Database {
    public static function create_tables() {
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();

        // Community table
        $community_table = $wpdb->prefix . 'csvp_community';
        $sql_community = "CREATE TABLE $community_table (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            is_active tinyint(1) NOT NULL DEFAULT 1,
            created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            wp_user varchar(255) NOT NULL DEFAULT 1,
            community_name varchar(255) NOT NULL,
            community_manager_name varchar(255) NOT NULL,
            community_manager_phone varchar(20) NOT NULL,
            community_logo varchar(255) NOT NULL,
            community_mail_address varchar(255) NOT NULL,
            community_address varchar(255) NOT NULL,
            wp_user_id bigint(20) NOT NULL,
            payment_link varchar(255) NOT NULL,
            commision_percentage decimal(10,2) NOT NULL,
            api_valid varchar(255) NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;";
        dbDelta( $sql_community );

        // Store table
        $store_table = $wpdb->prefix . 'csvp_store';
        $sql_store = "CREATE TABLE $store_table (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            is_active tinyint(1) NOT NULL DEFAULT 1,
            created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            wp_user varchar(255) NOT NULL DEFAULT 1,
            store_name varchar(255) NOT NULL,
            store_phone varchar(20) NOT NULL,
            store_cashier_phone varchar(255) NOT NULL,
            store_address varchar(255) NOT NULL,
            store_logo varchar(255) NOT NULL,
            store_mail_address varchar(255) NOT NULL,
            wp_user_id bigint(20) NOT NULL,
            fee_amount_per_transaction decimal(10,2) NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;";
        dbDelta( $sql_store );

        // Commission table
        $commission_table = $wpdb->prefix . 'csvp_commission';
        $sql_commission = "CREATE TABLE $commission_table (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            is_active tinyint(1) NOT NULL DEFAULT 1,
            created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            wp_user varchar(255) NOT NULL DEFAULT 1,
            entity_id bigint(20) NOT NULL,
            entity_type varchar(255) NOT NULL,
            commission_type varchar(255) NOT NULL,
            commission_value decimal(10,2) NOT NULL,
            commission_status varchar(255) NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;";
        dbDelta( $sql_commission );

        // Joining request table
        $joining_request_table = $wpdb->prefix . 'csvp_joining_request';
        $sql_joining_request = "CREATE TABLE $joining_request_table (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            is_active tinyint(1) NOT NULL DEFAULT 1,
            created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            wp_user varchar(255) NOT NULL DEFAULT 1,
            community_id bigint(20) NOT NULL,
            store_id bigint(20) NOT NULL,
            requested_by varchar(255) NOT NULL, 
            request_status varchar(255) NOT NULL,
            credit_limit varchar(255) NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;";
        dbDelta( $sql_joining_request );

        // Transaction table
        $transaction_table = $wpdb->prefix . 'csvp_transaction';
        $sql_transaction = "CREATE TABLE $transaction_table (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            is_active tinyint(1) NOT NULL DEFAULT 1,
            created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            wp_user varchar(255) NOT NULL DEFAULT 1,
            community_id bigint(20) NOT NULL,
            store_id bigint(20) NOT NULL,
            transaction_type varchar(255) NOT NULL,
            transaction_amount decimal(10,2) NOT NULL,
            transaction_date datetime NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;";
        dbDelta( $sql_transaction );

        // Order table
        $order_table = $wpdb->prefix . 'csvp_order';
        $sql_order = "CREATE TABLE $order_table (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            is_active tinyint(1) NOT NULL DEFAULT 1,
            created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            wp_user varchar(255) NOT NULL DEFAULT 1,
            community_id bigint(20) NOT NULL,
            store_id bigint(20) NOT NULL,
            order_status varchar(255) NOT NULL,
            order_total decimal(10,2) NOT NULL,
            order_date datetime NOT NULL,
            order_info_file varchar(255) NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;";
        dbDelta( $sql_order );

        $order_data = $wpdb->prefix . 'csvp_order_data';
        $order_data_sql = "CREATE TABLE $order_data (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            is_active tinyint(1) NOT NULL DEFAULT 1,
            created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            wp_user varchar(255) NOT NULL DEFAULT 1,
            order_id varchar(255) NOT NULL,
            product_name varchar(255) NOT NULL,
            cost_per_item varchar(255) NOT NULL,
            total_items varchar(255) NOT NULL,
            total_cost varchar(255) NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;";
        dbDelta($order_data_sql);

        // Voucher table
        $voucher_table = $wpdb->prefix . 'csvp_voucher';
        $sql_voucher = "CREATE TABLE $voucher_table (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            is_active tinyint(1) NOT NULL DEFAULT 1,
            created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            wp_user varchar(255) NOT NULL DEFAULT 1,
            store_id bigint(20) NOT NULL,
            community_id bigint(20) NOT NULL,
            product_name varchar(255) NOT NULL,
            voucher_price decimal(10,2) NOT NULL,
            normal_price decimal(10,2) NOT NULL,
            product_image varchar(255) NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;";
        dbDelta( $sql_voucher );

 

        // Voucher transaction table
        $voucher_transaction_table = $wpdb->prefix . 'csvp_voucher_transaction';
        $sql_voucher_transaction = "CREATE TABLE $voucher_transaction_table (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            is_active tinyint(1) NOT NULL DEFAULT 1,
            created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            wp_user varchar(255) NOT NULL DEFAULT 1,
            community_member_id bigint(20) NOT NULL,
            voucher_id bigint(20) NOT NULL,
            transaction_type varchar(255) NOT NULL,
            transaction_amount decimal(10,2) NOT NULL,
            transaction_date datetime NOT NULL,
            status varchar(255) NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;";
        dbDelta( $sql_voucher_transaction );

        // Walk order table
        $walk_order_table = $wpdb->prefix . 'csvp_walk_order';
        $sql_walk_order = "CREATE TABLE $walk_order_table (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            is_active tinyint(1) NOT NULL DEFAULT 1,
            created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            wp_user varchar(255) NOT NULL DEFAULT 1,
            community_member_id bigint(20) NOT NULL,
            store_id bigint(20) NOT NULL,
            order_status varchar(255) NOT NULL,
            order_type varchar(255) NOT NULL,
            payment_link varchar(255) NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;";
        dbDelta( $sql_walk_order );

        // Community member table
        $community_member_table = $wpdb->prefix . 'csvp_community_member';
        $sql_community_member = "CREATE TABLE $community_member_table (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            is_active tinyint(1) NOT NULL DEFAULT 1,
            created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            wp_user varchar(255) NOT NULL DEFAULT 1,
            community_id bigint(20) NOT NULL,
            full_name varchar(255) NOT NULL,
            phone_number varchar(20) NOT NULL,
            email_address varchar(255) NOT NULL,
            lesson varchar(255) NOT NULL,
            id_number varchar(20) NOT NULL,
            wp_user_id varchar(20) NOT NULL,
            address varchar(255) NOT NULL,
            magnetic_card_number_association varchar(255) NOT NULL,
            card_balance decimal(10,2) NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;";
        dbDelta( $sql_community_member );

        // Balance table
        $balance_table = $wpdb->prefix . 'csvp_balance';
        $sql_balance = "CREATE TABLE $balance_table (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            is_active tinyint(1) NOT NULL DEFAULT 1,
            created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            wp_user varchar(255) NOT NULL DEFAULT 1,
            community_member_id bigint(20) NOT NULL,
            balance_amount decimal(10,2) NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;";
        dbDelta( $sql_balance );
        
        $val = MESSAGE_STATUS_UNSEEN;
        $message_table = $wpdb->prefix . 'csvp_community_message';
        $message_table_sql = "CREATE TABLE $message_table (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            is_active tinyint(1) NOT NULL DEFAULT 1,
            created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            wp_user varchar(255) NOT NULL DEFAULT 1,
            from_id bigint(20) NOT NULL,
            to_id bigint(20) NOT NULL,
            to_user_role varchar(255) NOT NULL,
            full_name varchar(255) NOT NULL,
            phone_no varchar(20) NOT NULL,
            content text NOT NULL,
            message_status varchar(255) NOT NULL DEFAULT '$val',
            PRIMARY KEY (id)
        ) $charset_collate;";
        dbDelta($message_table_sql);
    }
}