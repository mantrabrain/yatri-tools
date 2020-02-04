<?php
add_filter('yatri_tools_demos_data', 'yatri_tools_demo_data_config');

function yatri_tools_demo_data_config()
{
    $demo_data_root_path = 'https://raw.githubusercontent.com/mantrabrain/yatri-demo-data/master/';

    return array(
        'main' => array(
            'categories' => array('Elementor', 'Business', 'WooCommerce'),
            'xml_file' => $demo_data_root_path . 'main/content.xml',
            'theme_settings' => $demo_data_root_path . 'main/customizer.dat',
            'widgets_file' => $demo_data_root_path . 'main/widgets.wie',
            'screenshot' => $demo_data_root_path . 'main/screenshot.png',
            'home_title' => 'Home',
            'blog_title' => 'Blog',
            'posts_to_show' => '3',
            'elementor_width' => '1220',
            'required_plugins' => array(
                'free' => array(
                    array(
                        'slug' => 'elementor',
                        'init' => 'elementor/elementor.php',
                        'name' => 'Elementor',
                    ),
                    array(
                        'slug' => 'contact-form-7',
                        'init' => 'contact-form-7/wp-contact-form-7.php',
                        'name' => 'Contact Form 7',
                    ),

                ),
                'premium' => array(
                    array(
                        'slug' => 'elementor',
                        'init' => 'elementor/elementor.php',
                        'name' => 'Elementor',
                    ),
                    array(
                        'slug' => 'contact-form-7',
                        'init' => 'contact-form-7/wp-contact-form-7.php',
                        'name' => 'Contact Form 7',
                    ),

                ),
            ),
        ),

    );
}