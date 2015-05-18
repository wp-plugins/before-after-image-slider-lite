<?php
/*
Plugin Name: Before After Image Slider Lite
Version: 1.14
Plugin URI: https://wordpress.org/plugins/before-after-image-slider-lite/
Description: A simple and easy way to compare two images. There is also <a href="http://codecanyon.net/item/wordpressjquery-before-after-image-slider/6503930?ref=scrobbleme" target="_blank">pro version</a> available with more features and better support.
Author: MOEWE (by Adrian M&ouml;rchen)
Author URI: https://www.moewe-studio.com/
Text Domain: wordpress-before-after-images-slider-lite
Domain Path: /languages/
*/

if (!class_exists('WP')) {
    die();
}

define('BEFORE_AFTER_IMAGE_SLIDER_LITE_VERSION', '1.14');

require_once 'modules/tgm-plugin-activation.php';

// Add scripts and shortcode
add_shortcode('image-comparator', 'wpbaimages_shortcode');
add_action('admin_enqueue_scripts', 'wpbaimages_admin_scripts_and_styles');
add_action('after_setup_theme', 'wpbaimage_extend_vafpress');
add_action('wp_enqueue_scripts', 'wpbaimages_enque_scripts_and_styles');
add_action('plugins_loaded', 'wpbaimages_load_textdomain');


function wpbaimages_load_textdomain()
{
    load_plugin_textdomain('wordpress-before-after-images-slider-lite', false, dirname(__FILE__) . '/languages/');
}

function wpbaimages_enque_scripts_and_styles()
{
    wp_enqueue_style('nouislider-css', plugins_url('jquery.nouislider.css', __FILE__), false, '7.0.10');
    wp_enqueue_script('nouislider-js', plugins_url('jquery.nouislider.js', __FILE__), array('jquery'), '7.0.10', false);
    wp_enqueue_style('wpbaimages-css', plugins_url('ImageComparisonSlider.css', __FILE__), false, BEFORE_AFTER_IMAGE_SLIDER_LITE_VERSION);
    wp_enqueue_script('wpbaimages-js', plugins_url('ImageComparisonSlider.js', __FILE__), array('nouislider-js'), BEFORE_AFTER_IMAGE_SLIDER_LITE_VERSION, false);
}

function wpbaimages_admin_scripts_and_styles()
{
    wp_enqueue_style('wpbaimages-vafpress-css', plugins_url('vafpress/vafpress.css', __FILE__), false, BEFORE_AFTER_IMAGE_SLIDER_LITE_VERSION);
}

/**
 * @param $attributes Array of attributes the shortcode uses.
 * @param null $content The content (is not used).
 * @return string The HTML output.
 */
function wpbaimages_shortcode($attributes, $content = null)
{
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
function wpbaimage_extend_vafpress()
{

    require_once 'modules/class-tgm-plugin-activation.php';

    if ((!current_user_can('edit_posts') && !current_user_can('edit_pages')) || get_user_option('rich_editing') != 'true') {
        return;
    }
    if (!class_exists('VP_ShortcodeGenerator')) {
        return;
    }
    $field_definition = include 'vafpress/vafpress-field-definition.php';
    new VP_ShortcodeGenerator($field_definition);
}

class Moewe_Before_After_Slider_Lite
{
    function Moewe_Before_After_Slider_Lite()
    {
        if (is_admin()) {
            add_filter('plugin_row_meta', array($this, 'init_row_meta'), 10, 2);
        }
    }

    /**
     * Add additional useful links.
     * @param $links array Already existing links.
     * @param $file string The current file.
     * @return array Links including new ones.
     */
    function init_row_meta($links, $file)
    {
        if (strpos($file, 'wordpress-before-after-images-slider-lite.php') !== false) {
            $links[] = '<a href="https://poeditor.com/projects/view?id=29123" target="_blank">' . __('Translate', 'wordpress-before-after-images-slider-lite') . '</a>';
            $links[] = '<a href="http://wordpress.org/support/plugin/before-after-image-slider-lite" target="_blank">' . __('Support Forum', 'wordpress-before-after-images-slider-lite') . '</a>';
            $links[] = '<a href="http://wordpress.org/support/view/plugin-reviews/before-after-image-slider-lite" target="_blank">' . __('Please Rate', 'wordpress-before-after-images-slider-lite') . '</a>';
            $links[] = '<a href="http://codecanyon.net/item/wordpressjquery-before-after-image-slider/6503930?ref=scrobbleme" target="_blank">' . __('Get Pro Version', 'wordpress-before-after-images-slider-lite') . '</a>';

            if (!defined('VP_VERSION')) {
                $links[] = '<p style="padding-top: 10px;"><a href="' . admin_url('themes.php?page=tgmpa-install-plugins') . '" style="color: darkgreen;"><span class="dashicons dashicons-info"></span><span style="text-decoration: underline;">Install or activate</span> Vafpress for optional shortcode generator.</a></p>';
            }
        }
        return $links;
    }
}

new Moewe_Before_After_Slider_Lite();