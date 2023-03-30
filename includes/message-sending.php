<?php
/**
 * Define the function that will send the WhatsApp message
 */
function bpxl_won_send_whatsapp_message( $order_id, $instance_id, $token ) {
    // Code to send the WhatsApp message goes here
    // Use the $order_id parameter to get the order details
    // Use the $instance_id and $token parameters to authenticate the API request
}

/**
 * Define the function that will be called when an order is placed
 */
function bpxl_won_send_order_notification( $order_id ) {
    // Get the instance ID and token from the plugin settings
    $instance_id = get_option( 'bpxl_won_instance_id' );
    $token = get_option( 'bpxl_won_token' );

    // Call the function to send the WhatsApp message
    bpxl_won_send_whatsapp_message( $order_id, $instance_id, $token );
}
