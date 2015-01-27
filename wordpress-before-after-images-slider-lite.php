<?php
/*
Plugin Name: Before After Image Slider Lite
Version: 1.10
Plugin URI: http://blog.scrobble.me/wordpress-jquery-before-after-image-slider/
Description: A simple and easy way to compare two images. There is also <a href="http://codecanyon.net/item/wordpressjquery-before-after-image-slider/6503930?ref=scrobbleme" target="_blank">pro version</a> available with more features and better support.
Author: Adrian M&ouml;rchen
Author URI: http://blog.scrobble.me/
Text Domain: wordpress-image-comparator
Domain Path: /languages/
*/

if (!class_exists('WP')) {
    die();
}

require_once('modules/class-tgm-plugin-activation.php');

// Add scripts and shortcode
add_shortcode('image-comparator', 'wpbaimages_shortcode');
add_action('admin_enqueue_scripts', 'wpbaimages_admin_scripts_and_styles');
add_action('after_setup_theme', 'wpbaimage_extend_vafpress');
add_action('wp_enqueue_scripts', 'wpbaimages_enque_scripts_and_styles');
add_action('tgmpa_register', 'wpbaimages_register_required_plugins');

// Administration
if (is_admin()) {
    add_filter('plugin_row_meta', 'wpbaimages_init_row_meta', 10, 2);
}

function wpbaimages_enque_scripts_and_styles() {
    wp_enqueue_style('nouislider-css', plugins_url('jquery.nouislider.css', __FILE__), false, '7.0.10');
    wp_enqueue_script('nouislider-js', plugins_url('jquery.nouislider.js', __FILE__), array('jquery'), '7.0.10', false);
    wp_enqueue_style('wpbaimages-css', plugins_url('ImageComparisonSlider.css', __FILE__), false, '1.10');
    wp_enqueue_script('wpbaimages-js', plugins_url('ImageComparisonSlider.js', __FILE__), array('nouislider-js'), '1.10', false);
}

function wpbaimages_admin_scripts_and_styles() {
    wp_enqueue_style('wpbaimages-vafpress-css', plugins_url('vafpress/vafpress.css', __FILE__), false, 1.9);
}

/**
 * @param $attributes Array of attributes the shortcode uses.
 * @param null $content The content (is not used).
 * @return string The HTML output.
 */
function wpbaimages_shortcode($attributes, $content = null) {
    $shortcode_attributes = shortcode_atts(array(
        'classes' => '',
        'left' => '',
        'left_alt' => '',
        'right' => '',
        'right_alt' => '',
        'title' => '',
        'width' => ''
    ), $attributes, 'image-comparator');

    if (WP_DEBUG) {
        $debug_result = '<!--' . print_r($shortcode_attributes, true) . '-->';
    }
    extract($shortcode_attributes, EXTR_PREFIX_ALL, 'ic');

    if (!isset($ic_classes)) {
        $ic_classes = '';
    }
    $result = '';
    if (isset($ic_width) && trim($ic_width) !== '') {
        $result = $result . ' style="width: ' . $ic_width . ';"';
    }

    $result = $result . '>';
    if (isset($ic_title) && trim($ic_title) !== '') {
        $result = $result . '<span class="title">' . __($ic_title, 'wordpress-image-comparator-user-values') . '</span>';
    }

    if (isset($ic_left) && (is_int($ic_left) || ctype_digit($ic_left))) {
        $ic_left = wp_get_attachment_url($ic_left);
    }
    if (isset($ic_right) && (is_int($ic_right) || ctype_digit($ic_right))) {
        $ic_right = wp_get_attachment_url($ic_right);
    }

    $left_image_result = '<img src = "' . $ic_left . '" alt="' . $ic_left_alt . '"/>';
    $right_image_result = '<img src = "' . $ic_right . '" alt="' . $ic_right_alt . '"/>';

    $left_image_result = apply_filters('image_comparator_left_image', $left_image_result, $shortcode_attributes);
    $right_image_result = apply_filters('image_comparator_right_image', $right_image_result, $shortcode_attributes);

    $result = '<div class="image-comparator overlay ' . $ic_classes . '"'
        . $result
        . '<div class="images">'
        . '<div class="left" >' . $left_image_result . '</div>'
        . '<div class="right" >' . $right_image_result . '</div>'
        . '<div class="ic-clear"><!-- Empty --></div>'
        . '</div><div class="slider" ><!-- Empty --></div></div >';

    $result = apply_filters('image_comparator_content', $result, $shortcode_attributes);

    if (isset($debug_result)) {
        return $result . $debug_result;
    }
    return $result;
}


/**
 * Extend
 */
function wpbaimage_extend_vafpress() {
    if ((!current_user_can('edit_posts') && !current_user_can('edit_pages')) || get_user_option('rich_editing') != 'true') {
        return;
    }
    if (!class_exists('VP_ShortcodeGenerator')) {
        return;
    }
    $field_definition = include 'vafpress/vafpress-field-definition.php';
    new VP_ShortcodeGenerator($field_definition);
}

/**
 * Add additional useful links.
 * @param $links array Already existing links.
 * @param $file string The current file.
 * @return array Links including new ones.
 */
function wpbaimages_init_row_meta($links, $file) {
    if (strpos($file, plugin_basename(__FILE__)) !== false) {
        return array_merge(
            $links,
            array(
                '<a href="http://codecanyon.net/item/wordpressjquery-before-after-image-slider/6503930?ref=scrobbleme" target="_blank">' . __('Get Pro Version', 'wordpress-image-comparator-user-values') . '</a>'
            )
        );
    }
    return $links;
}

function wpbaimages_register_required_plugins() {
    $plugins = array(
        array(
            'name' => __('Vafpress (Needed for shortcode generator)', '__PRODUCT_LANGUAGE_KEY__'),
            'slug' => 'vafpress-framework-plugin',
            'source' => 'https://github.com/scrobbleme/vafpress-framework/releases/download/v2.0-MOEWE/vafpress-framework-plugin-2.0-MOEWE.zip',
            'required' => false,
            'version' => '',
        )
    );

    $config = array(
        'default_path' => '',
        'menu' => 'tgmpa-install-plugins',
        'has_notices' => true,
        'dismissable' => true,
        'dismiss_msg' => '',
        'is_automatic' => true,
        'message' => '',
        'strings' => array(
            'notice_can_install_required' => _n_noop('Before After Image Slider Lite requires the following plugin: %1$s.', 'Before After Image Slider Lite requires the following plugins: %1$s.'), // %1$s = plugin name(s).
            'notice_can_install_recommended' => _n_noop('Before After Image Slider Lite recommends the following plugin: %1$s.', 'Before After Image Slider Lite recommends the following plugins: %1$s.'), // %1$s = plugin name(s).
            'notice_ask_to_update' => _n_noop('The following plugin needs to be updated to its latest version to ensure maximum compatibility with Before After Image Slider Lite: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with Before After Image Slider Lite: %1$s.'), // %1$s = plugin name(s).
            'nag_type' => 'updated'
        )
    );
    tgmpa($plugins, $config);
}