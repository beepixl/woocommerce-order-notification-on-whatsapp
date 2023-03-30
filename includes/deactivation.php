<?php
/**
 * Define the function that will be called when the plugin is deactivated
 */
function bpxl_won_deactivate() {
    // Perform any necessary cleanup tasks here
}
register_deactivation_hook( __FILE__, 'bpxl_won_deactivate' );
