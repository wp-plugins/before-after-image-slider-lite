<?php
return array(
    'modal_title' => __('Before After Image Slider', 'wordpress-image-comparator'),
    'button_title' => __('Before After Image Slider', 'wordpress-image-comparator'),
    'types' => array('post', 'page'),
    'main_image' => plugins_url('main_image.jpg', __FILE__),
    'sprite_image' => plugins_url('sprite_image.jpg', __FILE__),
    'name' => 'image_comparator',
    'template' => array(
        'Media' => array(
            'elements' => array(
                'image-comparator' => array(
                    'title' => __('Before After Image Slider Lite', 'wordpress-image-comparator'),
                    'code' => '[image-comparator][/image-comparator]',
                    'active' => true,
                    'attributes' => array(
                        array(
                            'name' => 'title',
                            'type' => 'textbox',
                            'label' => __('Title', 'wordpress-image-comparator'),
                            'description' => __('An optional title above the images.', 'wordpress-image-comparator')
                        ),
                        array(
                            'type' => 'upload',
                            'label' => __('Left Image', 'wordpress-image-comparator'),
                            'name' => 'left',
                            'validation' => 'required',
                            'description' => __('The left image to use. (Required)', 'wordpress-image-comparator'),
                        ),
                        array(
                            'type' => 'upload',
                            'label' => __('Right Image', 'wordpress-image-comparator'),
                            'name' => 'right',
                            'validation' => 'required',
                            'description' => __('The right image to use. (Required)', 'wordpress-image-comparator'),
                        ),
                        array(
                            'type' => 'textbox',
                            'label' => __('Width', 'wordpress-image-comparator'),
                            'name' => 'width',
                            'default' => '100%',
                            'description' => __('An optional width, use px or % (default is 500px)', 'wordpress-image-comparator')
                        ),
                        array(
                            'type' => 'textbox',
                            'label' => __('Left Alt', 'wordpress-image-comparator'),
                            'name' => 'left_alt',
                            'description' => __('Specify a value for the <b>"alt"</b> attribute of the left image.', 'wordpress-image-comparator'),
                        ),
                        array(
                            'type' => 'textbox',
                            'label' => __('Right Alt', 'wordpress-image-comparator'),
                            'name' => 'right_alt',
                            'description' => __('Specify a value for the <b>"alt"</b> attribute of the right image.', 'wordpress-image-comparator')
                        ),
                        array(
                            'type' => 'textbox',
                            'label' => __('CSS Classes (i.e. hover)', 'wordpress-image-comparator'),
                            'name' => 'classes',
                            'description' => __('Additional CSS classes, use <b>"hover"</b> to enable these extras', 'wordpress-image-comparator'),
                            'default' => 'hover'
                        ),
                        array(
                            'type' => 'notebox',
                            'name' => 'nb_1',
                            'label' => __('Want to support this plugin or need more features?', 'wordpress-image-comparator'),
                            'description' => __('There is also a <a href="http://codecanyon.net/item/wordpressjquery-before-after-image-slider/6503930?ref=scrobbleme" target="_blank">pro version</a> available with direct support and additional features like <strong>more modes, Visual Composer support, setting an inital value, linking images</strong> and <strong>more</strong>...<br />'
                                . '<a href="http://codecanyon.net/item/wordpressjquery-before-after-image-slider/6503930?ref=scrobbleme" target="_blank">Get Pro Version</a>', 'wordpress-image-comparator'),
                            'status' => 'normal'
                        )
                    )
                )
            )
        )
    )
);