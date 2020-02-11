<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}


class Yatri_Tools_Elementor_Helper
{
    private $api_url = 'https://wpyatri.com/yatri-tools-elementor-data/';
    /**
     * All Activated Plugins
     *
     * @since 1.0.0
     */
    private $activated_plugins = [];

    public function __construct()
    {
        add_action('elementor/editor/before_enqueue_scripts', [$this, 'enqueue_editor_scripts']);
        add_action('elementor/preview/enqueue_styles', [$this, 'enqueue_editor_scripts']);
        add_action('wp_ajax_yatri_tools_elementor_fetch_tmpl_data', [$this, 'fetch_tmpl_data'], 1);
        add_action('wp_ajax_save_yatri_tools_elementor_extension_media', [$this, 'yatri_tools_elementor_extension_media']);
    }

    /**
     * Load styles and scripts for Elementor modal.
     */
    public function enqueue_editor_scripts()
    {

        if (!$this->activated_plugins) {
            $active_plugins = apply_filters('active_plugins', get_option('active_plugins'));
            $active_sitewide_plugins = get_site_option('active_sitewide_plugins');
            if (!is_array($active_plugins)) {
                $active_plugins = [];
            }
            if (!is_array($active_sitewide_plugins)) {
                $active_sitewide_plugins = [];
            }
            if (!function_exists('get_plugins')) {
                require_once ABSPATH . 'wp-admin/includes/plugin.php';
            }
            $active_plugins = array_merge($active_plugins, array_keys($active_sitewide_plugins));
            $this->activated_plugins['active'] = $active_plugins;
            $this->activated_plugins['all'] = get_plugins();
        }

        if (in_array('elementor-pro/elementor-pro.php', $this->activated_plugins['active'], true)) {
            $elementorPro = true;
        } else {
            $elementorPro = false;
        }

        wp_enqueue_style('yatri-tools-elementor-modal-style', YATRI_TOOLS_PLUGIN_URI . 'includes/elementor/assets/css/elementor-modal.css', [], YATRI_TOOLS_VERSION);

        wp_enqueue_script('yatri-tools-elementor-modal-script', YATRI_TOOLS_PLUGIN_URI . 'includes/elementor/assets/js/elementor-modal.js', ['jquery'], YATRI_TOOLS_VERSION);

        wp_enqueue_script(
            'yatri-tools-elementor-library-react',
            YATRI_TOOLS_PLUGIN_URI . 'includes/elementor/assets/admin/js/compiled.js',
            ['wp-element', 'wp-components'],
            YATRI_TOOLS_VERSION,
            true
        );

        wp_localize_script('yatri-tools-elementor-library-react', 'YatriToolsElementorThemesLibrary', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'baseUrl' => YATRI_TOOLS_PLUGIN_URI . 'includes/elementor/',
            'apiUrl' => $this->api_url,
            'elementorPro' => $elementorPro,
            'key' => "",
            'host' => $_SERVER['HTTP_HOST'],
            'nonce' => "YatriToolsElementorThemesLibrary",
            'pxStatus' => false,
            'pxKey' => "54c67446-89e5250d-3808bb85-942e870d",
            'pxUrl' => "pixabay/image/"
        ));
    }

    /**
     * Fetches the selected tmpl by user.
     */
    public function fetch_tmpl_data()
    {
        $template_id = !isset($_POST['item_id']) ? '' : $_POST['item_id'];

        $template_data_url = $this->api_url . 'templates.php?item_id=' . $template_id;

        $response = wp_remote_get($template_data_url, [
            'key' => '',
            'host' => $_SERVER['HTTP_HOST']
        ]);

        $template = json_decode($response['body'], true);

        $content = @$this->process_import_ids($template);

        $content = @$this->process_import_content($template, 'on_import');

        echo json_encode($content);

        die();
    }

    /**
     * Fetches the selected image by user.
     */
    public function yatri_tools_elementor_extension_media()
    {
        $image = $_POST['image'];

        if ($image) {
            $imageurl = stripslashes($image);
            $uploads = wp_upload_dir();
            // $post_id = isset($_POST['postid']) ? (int) $_POST['postid'] : 0;
            $ext = pathinfo(basename($imageurl), PATHINFO_EXTENSION);
            $newfilename = basename($imageurl);
            $filename = wp_unique_filename($uploads['path'], $newfilename, $unique_filename_callback = null); // Get a filename that is sanitized and unique for the given directory.
            $wp_filetype = wp_check_filetype($filename, null);
            $fullpathfilename = $uploads['path'] . "/" . $filename;

            try {
                if (!substr_count($wp_filetype['type'], "image")) {
                    throw new Exception(basename($imageurl) . ' is not a valid image. ' . $wp_filetype['type'] . '');
                }

                $image_string = wp_remote_get($image);

                $fileSaved = file_put_contents($uploads['path'] . "/" . $filename, $image_string['body']);

                if (!$fileSaved) {
                    throw new Exception("The file cannot be saved.");
                }

                $attachment = array(
                    'post_mime_type' => $wp_filetype['type'],
                    'post_title' => preg_replace('/\.[^.]+$/', '', $filename),
                    'post_content' => '',
                    'post_status' => 'inherit',
                    'guid' => $uploads['url'] . "/" . $filename,
                );

                $attach_id = wp_insert_attachment($attachment, $fullpathfilename);

                if (!$attach_id) {
                    throw new Exception("Failed to save record into database.");
                }

                $attach_data = wp_generate_attachment_metadata($attach_id, $fullpathfilename);
                wp_update_attachment_metadata($attach_id, $attach_data);

                // Local URL
                $localUrl = $uploads['baseurl'] . '/' . $attach_data['file'];

                $data = array(
                    "status" => true,
                    "category" => "photos",
                    "photoId" => "2QSPL8V",
                    "attachmentData" => [
                        "id" => 133,
                        "title" => "Lorem ipsum dolor sit amet",
                        "filename" => "lorem-ipsum-dolor-sit-amet.jpg",
                        "url" => $localUrl,
                        "link" => "#",
                        "alt" => "Lorem ipsum dolor sit amet",
                        "author" => "1",
                        "description" => "Lorem ipsum dolor sit amet, ipsum dolor",
                        "caption" => "Lorem ipsum dolor sit amet, ipsum dolor",
                        "name" => "lorem-ipsum-dolor-sit-amet",
                        "mime" => "image/jpeg",
                        "type" => "image",
                        "subtype" => "jpeg",
                        "dateFormatted" => "January 24, 2020",
                    ]
                );

                print_r(\json_encode($data));

                wp_die();

            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
    }

    protected function process_import_ids($content)
    {
        return \Elementor\Plugin::$instance->db->iterate_data($content, function ($element) {
            $element['id'] = \Elementor\Utils::generate_random_string();
            return $element;
        });
    }

    protected function process_import_content($content, $method)
    {
        return \Elementor\Plugin::$instance->db->iterate_data($content, function ($element_data) use ($method) {
            $element = \Elementor\Plugin::$instance->elements_manager->create_element_instance($element_data);

            if (!$element) {
                return null;
            }

            $r = $this->process_import_element($element, $method);

            return $r;
        });
    }

    protected function process_import_element($element, $method)
    {
        $element_data = $element->get_data();
        if (method_exists($element, $method)) {
            $element_data = $element->{$method}($element_data);
        }
        foreach ($element->get_controls() as $control) {
            $control_class = \ELementor\Plugin::$instance
                ->controls_manager
                ->get_control($control['type']);
            if (!$control_class) {
                return $element_data;
            }
            if (method_exists($control_class, $method)) {
                $element_data['settings'][$control['name']] = $control_class->{$method}($element->get_settings($control['name']), $control);
            }
        }
        return $element_data;
    }
}

new Yatri_Tools_Elementor_Helper();
