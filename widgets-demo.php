<?php
/**
* Plugin Name: Widgets Demo
* Description: Demonstration of various types of widgets and shortcode.
* Author: Subas Roy
* version: 1.0.0
*/

define('WD_ADMIN_ASSETS_URL', plugin_dir_url(__FILE__) . "assets/admin/");
define('WD_PLUGIN_PATH', plugin_dir_path(__FILE__));

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
    }
}

new Widgets_Demo();