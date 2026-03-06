<?php

class WD_Stats_Widget {
    function __construct() {
        add_action('wp_dashboard_setup', [$this, 'register_widget']);
    }

    function register_widget() {
        wp_add_dashboard_widget(
            'wd_stats_widget',
            'WD Stats Widget',
            [$this, 'render']
        );
    }

    function render() {
        echo '<h3>WD Stats Widgets</h3>';
    }
}