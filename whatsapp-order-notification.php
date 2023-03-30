<?php
/**
 * Plugin Name: WhatsApp Order Notification
 * Plugin URI: https://www.beepixl.com
 * Description: Send order notifications via WhatsApp
 * Version: 1.0
 * Author: Beepixl
 * Author URI: https://www.beepixl.com
 * License: GPL2
 */

// Define constants for the plugin
define( 'BPXL_WON_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'BPXL_WON_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

// Include the activation, deactivation, and message sending files
include_once( BPXL_WON_PLUGIN_DIR . 'includes/activation.php' );
include_once( BPXL_WON_PLUGIN_DIR . 'includes/deactivation.php' );
include_once( BPXL_WON_PLUGIN_DIR . 'includes/message-sending.php' );
include_once( BPXL_WON_PLUGIN_DIR . 'includes/admin-settings.php' );

// Register the function that will be called when an order is placed
add_action( 'woocommerce_thankyou', 'bpxl_won_send_order_notification', 10, 1 );
