<?php

// Add the settings link next to the activate/deactivate links
function bpxl_won_plugin_settings_link($links)
{
    $settings_link = '<a href="admin.php?page=bpxl-won-settings">Settings</a>';
    array_push($links, $settings_link);
    return $links;
}
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'bpxl_won_plugin_settings_link');


// Enqueue the custom CSS file for the admin settings page
function bpxl_won_enqueue_admin_styles()
{
    wp_enqueue_style('bpxl-won-admin-styles', plugins_url('../css/bpxl-won-styles.css', __FILE__));
}

add_action('admin_enqueue_scripts', 'bpxl_won_enqueue_admin_styles');


// Add the settings page to the WordPress admin menu
function bpxl_won_add_admin_menu()
{
    add_menu_page(
        'WhatsApp Order Notification Settings',
        'WhatsApp Order Notification',
        'manage_options',
        'bpxl-won-settings',
        'bpxl_won_settings_page',
        'dashicons-whatsapp',
        90
    );
}
add_action('admin_menu', 'bpxl_won_add_admin_menu');

// Define the function to render the settings page
function bpxl_won_settings_page()
{
    // Check if the user is allowed to access the settings page
    if (!current_user_can('manage_options')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }

    // Get the saved settings
    $instance_id = get_option('bpxl_won_instance_id');
    $token = get_option('bpxl_won_token');
    $website_url = get_option('bpxl_won_website_url');
    $admin_mobile_number = get_option('bpxl_won_admin_mobile_number');

    // Render the settings page
?>
    <div class="wrap bpxl-won-settings-wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>

        <form method="post" action="options.php">
            <?php settings_fields('bpxl_won_settings_group'); ?>
            <?php do_settings_sections('bpxl_won_settings_group'); ?>

            <table class="form-table">
                <tr>
                    <th scope="row"><?php esc_html_e('Instance ID', 'bpxl-won'); ?></th>
                    <td>
                        <input type="text" name="bpxl_won_instance_id" value="<?php echo esc_attr($instance_id); ?>" />
                        <p class="description"><?php esc_html_e('Enter your WhatsApp instance ID.', 'bpxl-won'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php esc_html_e('Token', 'bpxl-won'); ?></th>
                    <td>
                        <input type="text" name="bpxl_won_token" value="<?php echo esc_attr($token); ?>" />
                        <p class="description"><?php esc_html_e('Enter your WhatsApp token.', 'bpxl-won'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php esc_html_e('Website URL', 'bpxl-won'); ?></th>
                    <td>
                        <input type="text" name="bpxl_won_website_url" value="<?php echo esc_attr($website_url); ?>" />
                        <p class="description"><?php esc_html_e('Enter the URL of your website.', 'bpxl-won'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php esc_html_e('Admin Mobile Number', 'bpxl-won'); ?></th>
                    <td>
                        <input type="text" name="bpxl_won_admin_mobile_number" value="<?php echo esc_attr($admin_mobile_number); ?>" />
                        <p class="description"><?php esc_html_e('Enter the mobile number of the admin who should receive notifications.', 'bpxl-won'); ?></p>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
<?php
}

function bpxl_won_register_settings()
{
    register_setting('bpxl_won_settings_group', 'bpxl_won_instance_id');
    register_setting('bpxl_won_settings_group', 'bpxl_won_token');
    register_setting('bpxl_won_settings_group', 'bpxl_won_website_url');
    register_setting('bpxl_won_settings_group', 'bpxl_won_admin_mobile_number');
}
add_action('admin_init', 'bpxl_won_register_settings');
