    <?php
    /**
     * Plugin Name: My Custom Plugin
     * Plugin URI: https://example.com/my-custom-plugin
     * Description: A brief description of my custom WordPress plugin.
     * Version: 1.0.0
     * Author: MF Dube
     * Author URI: https://example.com
     * License: GPL2
     */

    // Prevent direct access to the file
    if ( ! defined( 'ABSPATH' ) ) {
        exit;
    }

    // Example: Add a custom shortcode
    function my_custom_shortcode_function() {
        return "Hello from My Custom Plugin!";
    }
    add_shortcode( 'my_custom_shortcode', 'my_custom_shortcode_function' );

    // Example: Add a new admin menu item
    function my_custom_admin_menu() {
        add_menu_page(
            'My Custom Plugin Settings', // Page title
            'Custom Plugin',            // Menu title
            'manage_options',           // Capability required
            'my-custom-plugin',         // Menu slug
            'my_custom_plugin_settings_page' // Callback function
        );
    }
    add_action( 'admin_menu', 'my_custom_admin_menu' );

    function my_custom_plugin_settings_page() {
        ?>
        <div class="wrap">
            <h1>My Custom Plugin Settings</h1>
            <p>Welcome to the settings page of My Custom Plugin.</p>
        </div>
        <?php
    }