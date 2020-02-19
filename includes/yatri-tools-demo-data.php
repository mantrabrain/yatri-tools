<?php

add_filter('yatri_tools_demos_data', 'yatri_tools_demo_data_config');

function yatri_tools_demo_data_config()
{
    $demo_data_root_path = 'https://raw.githubusercontent.com/mantrabrain/yatri-demo-data/master/';

    return array(
        'main' => array(
            'categories' => array('Elementor', 'Corporate & Business', 'WooCommerce'),
            'xml_file' => $demo_data_root_path . 'main/content.xml',
            'theme_settings' => $demo_data_root_path . 'main/customizer.dat',
            'widgets_file' => $demo_data_root_path . 'main/widgets.wie',
            'screenshot' => $demo_data_root_path . 'main/screenshot.png',
            'home_title' => 'Home',
            'blog_title' => 'Blog',
            'posts_to_show' => '5',
            'elementor_width' => '1140',
            'required_plugins' => array(
                'free' => array(
                    array(
                        'slug' => 'elementor',
                        'init' => 'elementor/elementor.php',
                        'name' => 'Elementor',
                    ),

                )
            ),
        ),
        'agency' => array(
            'categories' => array('Elementor', 'Corporate & Business', 'WooCommerce'),
            'xml_file' => $demo_data_root_path . 'agency/content.xml',
            'theme_settings' => $demo_data_root_path . 'agency/customizer.dat',
            'widgets_file' => $demo_data_root_path . 'agency/widgets.wie',
            'screenshot' => $demo_data_root_path . 'agency/screenshot.png',
            'home_title' => 'Home',
            'blog_title' => 'Blog',
            'posts_to_show' => '5',
            'elementor_width' => '1140',
            'required_plugins' => array(
                'free' => array(
                    array(
                        'slug' => 'elementor',
                        'init' => 'elementor/elementor.php',
                        'name' => 'Elementor',
                    ),

                )
            ),
        ),
        'personal' => array(
            'categories' => array('Elementor', 'Corporate & Business', 'Blog'),
            'xml_file' => $demo_data_root_path . 'personal/content.xml',
            'theme_settings' => $demo_data_root_path . 'personal/customizer.dat',
            'widgets_file' => $demo_data_root_path . 'personal/widgets.wie',
            'screenshot' => $demo_data_root_path . 'personal/screenshot.png',
            'home_title' => 'Home',
            'blog_title' => 'Blog',
            'posts_to_show' => '5',
            'elementor_width' => '1140',
            'required_plugins' => array(
                'free' => array(
                    array(
                        'slug' => 'elementor',
                        'init' => 'elementor/elementor.php',
                        'name' => 'Elementor',
                    ),

                )
            ),
        ),
        'online-shop' => array(
            'categories' => array('Elementor', 'Corporate & Business', 'eCommerce', 'WooCommerce'),
            'xml_file' => $demo_data_root_path . 'online-shop/content.xml',
            'theme_settings' => $demo_data_root_path . 'online-shop/customizer.dat',
            'widgets_file' => $demo_data_root_path . 'online-shop/widgets.wie',
            'screenshot' => $demo_data_root_path . 'online-shop/screenshot.png',
            'home_title' => 'Home',
            'blog_title' => 'Blog',
            'posts_to_show' => '5',
            'elementor_width' => '1140',
            'required_plugins' => array(
                'free' => array(
                    array(
                        'slug' => 'elementor',
                        'init' => 'elementor/elementor.php',
                        'name' => 'Elementor',
                    ),
                    array(
                        'slug' => 'woocommerce',
                        'init' => 'woocommerce/woocommerce.php',
                        'name' => 'WooCommerce',
                    ),

                )
            ),
        ),

    );
}