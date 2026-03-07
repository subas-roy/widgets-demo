<?php
/**
* Plugin Name: Widgets Demo
* Description: Demonstration of various types of widgets and shortcode.
* Author: Subas Roy
* version: 1.0.0
*/

define('WD_ADMIN_ASSETS_URL', plugin_dir_url(__FILE__) . "assets/admin/");
define('WD_PLUGIN_PATH', plugin_dir_path(__FILE__));

define('WIDGET_DEMO_VERSION', '1.0.0');
define('WIDGET_DEMO_PATH', plugin_dir_path(__FILE__));
define('WIDGET_DEMO_URL', plugin_dir_url(__FILE__));

class Widgets_Demo {
    public function __construct() {
        add_action('admin_enqueue_scripts', [$this, 'load_admin_assets']);
        $this->load_dependencies();
        $this->initialize();
    }

    public function load_admin_assets($hook) {
        if ($hook == 'index.php') {
            wp_enqueue_style('wd-admin-css', WD_ADMIN_ASSETS_URL . "css/admin.css", [], time());
        }
    }

    public function load_dependencies() {
        require_once(WD_PLUGIN_PATH . "dashboard-widgets/class-basic-widget.php");
        require_once(WD_PLUGIN_PATH . "dashboard-widgets/class-quick-links-widget.php");
        require_once(WD_PLUGIN_PATH . "dashboard-widgets/class-stats-widget.php");
        require_once(WD_PLUGIN_PATH . "shortcodes/class-basic-shortcode.php");
        require_once(WD_PLUGIN_PATH . "shortcodes/class-nested-shortcode.php");
        require_once(WD_PLUGIN_PATH . "shortcodes/class-button-shortcode.php");
        require_once(WD_PLUGIN_PATH . "shortcodes/class-youtube-shortcode.php");
        require_once(WD_PLUGIN_PATH . "block-widgets/class-alert-block.php");
    }

    // Initialize widgets and shortcodes
    public function initialize() {
        new Basic_Widget();
        new WD_Quick_Links();
        new WD_Stats_Widget();
        new WD_Basic_ShortCode();
        new WD_Nested_ShortCode();
        new WD_Button_Shortcode();
        new WD_Youtube_Shortcode();
        new WD_Alert_Block();
    }
}

new Widgets_Demo();