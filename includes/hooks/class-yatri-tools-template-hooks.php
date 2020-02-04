<?php

class Yatri_Tools_Template_Hooks
{
    public static $instance = null;

    public static function get_instance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;

    }

    public function __construct()
    {
        add_action('yatri_tools_after_demo_import_success_message', array($this, 'success_feedback_form'), 10, 1);
    }

    public function success_feedback_form($demo)
    {

        yatri_tools_load_admin_template('feedback-form');
    }

}

Yatri_Tools_Template_Hooks::get_instance();