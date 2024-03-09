<?php
class CSVP_Ajax_Handler{
    public function __construct() {
        add_action( 'wp_ajax_csvp_ajax', array( $this, 'process_request' ) );
        add_action( 'wp_ajax_nopriv_csvp_ajax', array( $this, 'process_request' ) );
    }

    public function process_request() {
        // Check if the request is valid
        if ( ! isset( $_POST['action'] ) || $_POST['action'] !== 'csvp_ajax' ) {
            $this->send_error_response( 'Invalid request.', 400 );
        }
        
        // Check if csvp_request and csvp_handler are specified
        if ( ! isset( $_POST['csvp_request'] ) || ! isset( $_POST['csvp_handler'] ) ) {
            $this->send_error_response( 'Class name or handler function not specified.', 400 );
        }

        // Get the class name and handler function name
         $class_name = $_POST['csvp_request'];
         $handler_function = $_POST['csvp_handler'];

        // Check if the class exists
        if ( ! class_exists( $class_name ) ) {
            $this->send_error_response( 'Class does not exist.', 400 );
        }

        // Create an instance of the class
        $class_instance = new $class_name();

        // Check if the handler function exists within the class
        if ( ! method_exists( $class_instance, $handler_function ) ) {
            $this->send_error_response( 'Handler function does not exist.', 400 );
        }

        // Get the data from the request
        $data = isset( $_POST['data'] ) ? $_POST['data'] : array();
        
        // Call the handler function of the class and pass the data
        $response = $class_instance->$handler_function( $data );
        wp_send_json($response);
    }

    public static function send_error_response( $message, $status ) {
        status_header( $status );
        wp_send_json_error( $message );
        exit;
    }

    public static function send_success_response( $message, $status = 200, $extra_data = array() ) {
        $response = array(
            'status' => 'success',
            'message' => $message,
            'data' => $extra_data
        );

        status_header( $status );
        wp_send_json_success( $response );
        exit;
    }
}
