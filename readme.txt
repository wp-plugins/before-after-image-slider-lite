﻿=== Before After Image Slider Lite ===
Contributors: adrian2k7
Donate link: http://q.gs/83UXn
Tags: after, before, compare, editor, image, shortcode, slider, vafpress
Requires at least: 4.0
Tested up to: 4.2
Stable tag: 1.13
License: GPLv3
License URI: http://www.gnu.org/licenses/agpl-3.0.html

A simple and easy way to compare two images.

== Description ==

The Before After Image Slider for WordPress allows you to easily show and compare two images. See screenshots or [demo](http://test.moewe-studio.com/before-after-image-slider-lite) for more information.

The lite version contains the following features:

* One mode (overlay)
* Define left and right alt-Attribute
* Set width
* Set title
* Shortcode generator (**Note**: You have to install the optional Vafpress framework for this, see FAQ)
* Define additional classes

**Support**

Please use the [support forum](http://wordpress.org/support/plugin/before-after-image-slider-lite) in case of any problems or questions before
just giving a bad rating. We really take this seriously.

** Usage **

Please see the [Usage](https://wordpress.org/plugins/before-after-image-slider-lite/other_notes/) section for more details on this.

**Translators**

* Serbian: [Ogi Djuraskovic](http://firstsiteguide.com/)
* Turkish: [İbrahim Mumcu](http://www.ibrahimmumcu.com/)

Help to [translate](https://poeditor.com/projects/view?order=trans_asc&id=29123) this plugin.

= HINT: = 
>There is also a [pro version](http://q.gs/83UXn) available with direct support and additional features like more modes, Visual Composer support, setting an inital value, linking images and more...
>
>[View pro version](http://q.gs/83UXn)

== Frequently Asked Questions ==

= Where is the shortcode generator? =

To be able to use the shortcode generator, you have to install the optional Vafpress framework. You should be prompted
for this after activating the plugin. In case of any problems with this read [here](https://www.moewe-studio.com/demo/installation-updating/#install_vafpress).

== Installation ==

You can install the plugin in two ways:

= From within WordPress plugin installation (recommended) =

1. Search for "Before After Image Slider"
1. Download it and then active it.

or

1. Upload and activate the file "wordpress-before-after-images-slider-lite.zip" manually.

= From the WordPress plugins page =

1. Download the plugin, extract the zip file.
1. Upload the "wordpress-before-after-images-slider-lite" folder to your /wp-content/plugins/ directory.
1. Active the plugin in the plugin menu panel in your administration area.

= Upgrade Notice =

Always upgrade to the newest release to profit from bugfixes and new features.


== Screenshots ==

1. Usage Example 1
2. Usage Example 2
3. Shortcode Generator

== Changelog ==

= 1.12.2 =

* *Security Fix* Updated TGM to latest version
* Improved theme compatibility

= 1.12.1 =

* Added link to support forum and rating in administration

= 1.12 =

* (Hopefully) improved performance for hover mode
* Updated slider layout to be a little smaller and "darker"
* Updated icons for shortcode generator

= 1.11.2 =

* Improved description
* Added Turkish translaton. Thanks to [İbrahim Mumcu](http://www.ibrahimmumcu.com/)

= 1.11.1 =
* Removed screenshots from plugin (reduces size)


= 1.11 =
* Added German translation
* Added Serbian translation. Thanks to [Ogi Djuraskovic](http://firstsiteguide.com/)

= 1.10 =
* Updated noUISlider to 7.0.10
* Added better support for localization

= 1.9 =
* Intial public release

== Usage ==

= Shortcode Generator =

To be a able to use the handy shortcode generator, you have to install the optional Vafpress framework.
Set [FAQ](https://wordpress.org/plugins/before-after-image-slider-lite/faq/) for this.

**Hint**: After you've created your pages, you can safely deactivate (and remove) Vafpress again. It is only needed for this editor functionality.

**Note**: The generator currently only works in the visual editor mode.

= Shortcode =

The basic shortcode looks like this:

`[image-comparator][/image-comparator]`

You may use the following parameters:

<table>
    <tr>
        <td>**left**</td>
        <td>(**Required**) Url or id of the left image.</td>
    </tr>
    <tr>
        <td>left_alt</td>
        <td>"alt" attribute of the left image.</td>
    </tr>
    <tr>
        <td>**right**</td>
        <td>(**Required**) Url or id of the right image.</td>
    </tr><tr>
        <td>right_alt</td>
        <td>"alt" attribute of the right image.</td>
    </tr><tr>
        <td>title</td>
        <td>Optional title.</td>
    </tr><tr>
        <td>width</td>
        <td>Optional width, i.e. 70%.</td>
    </tr><tr>
        <td>classes</td>
        <td>Additional CSS classes. **Hint** Use 'hover' to enable a mouse hover effect-</td>
    </tr>
</table>

= Shortcode Examples =

Just images:

`[image-comparator left="http://.../left.jpg" right="http://.../right.jpg"][/image-comparator]`

When you know the media id of the images you can do it like this:

`[image-comparator left="123" right="456"][/image-comparator]`

(This will also let you translate the media using WPML.)

Enable hover effect:
`[image-comparator classes="hover"][/image-comparator]`

Full example:

    [image-comparator
        left="http://test.moewe-studio.com/before-after-image-slider-lite/wp-content/uploads/sites/12/2015/03/cobra_blend_right1.jpg"
        left_alt="The cobra is red"
        right="http://test.moewe-studio.com/before-after-image-slider-lite/wp-content/uploads/sites/12/2015/03/cobra_blend_left.jpg"
        right_alt="The cobra is black"
        width="70%" classes="hover"
        title="With hover (just move the mouse)"]
    [/image-comparator]


