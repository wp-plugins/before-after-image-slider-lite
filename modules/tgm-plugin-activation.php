<?php

if (!defined('ABSPATH')) {
    die("Don't touch this.");
}

add_action('tgmpa_register', 'moewe_studio_register_required_plugins');

if (!function_exists('moewe_studio_register_required_plugins')) {
    function moewe_studio_register_required_plugins()
    {
        $plugins = array(
            array(
                'name' => __('Vafpress', '__PRODUCT_LANGUAGE_KEY__'),
                'slug' => 'vafpress-framework-plugin',
                'source' => 'https://github.com/scrobbleme/vafpress-framework/releases/download/v2.0.1-MOEWE/vafpress-framework-plugin-2.0.1-MOEWE-Edition.zip',
                'required' => false,
                'version' => ''
            )
        );

        $config = array(
            'default_path' => '', // Default absolute path to pre-packaged plugins.
            'menu' => 'tgmpa-install-plugins', // Menu slug.
            'has_notices' => true, // Show admin notices or not.
            'dismissable' => true, // If false, a user cannot dismiss the nag message.
            'dismiss_msg' => '', // If 'dismissable' is false, this message will be output at top of nag.
            'is_automatic' => true, // Automatically activate plugins after installation or not.
            'message' => '', // Message to output right before the plugins table.
            'strings' => array(
                'notice_can_install_required' => _n_noop('Before After Image Slider Lite requires the following plugin: %1$s.', 'Before After Image Slider Lite requires the following plugins: %1$s.'), // %1$s = plugin name(s).
                'notice_ask_to_update' => _n_noop('The following plugin needs to be updated to its latest version to ensure maximum compatibility with Before After Image Slider Lite: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with Before After Image Slider Lite: %1$s.'), // %1$s = plugin name(s).
                'nag_type' => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
            )
        );
        tgmpa($plugins, $config);
    }
}