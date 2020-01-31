<?php
/**
 * Yatri_Tools install setup
 *
 * @package Yatri_Tools
 * @since 1.0.0
 */

defined('ABSPATH') || exit;

/**
 * Main Yatri_Tools_Install Class.
 *
 * @class Yatri_Tools
 */
final class Yatri_Tools_Install
{

    public static function install()
    {
        add_option('yatri_tools_plugin_do_activation_redirect', true);
        update_option('yatri_tools_version', YATRI_TOOLS_VERSION);

    }


}