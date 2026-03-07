<?php

class WD_Nested_Shortcode {
    function __construct() {
        add_shortcode('alertbox', [$this, 'render']);
    }

    function render($attributes, $content = null) {
        $defaults = [
            'type' => 'info'
        ];

        $bgcolors = [
            'info' => '#d1ecf1',
            'error' => '#f8d7da',
            'success' => '#d4edda',
            'warning' => '#fff3cd'
        ];
        $colors = [
            'info' => '#0c5460',
            'error' => '#721c24',
            'success' => '#155724',
            'warning' => '#856404'
        ];
        $attributes = shortcode_atts($defaults, $attributes);

        $output = "<div style='background-color: {$bgcolors[$attributes['type']]}; color: {$colors[$attributes['type']]}; padding: 10px; border: 1px solid #ffeaa7; border-radius: 4px; margin-bottom: 10px;'>";
        $output .= do_shortcode($content);
        $output .="</div>";

        return $output;
    }
}

// Frontend usage example:
// [alertbox type="error"]This is an error message![/alertbox]

// Nested example:
// [alertbox type="success"]This is a success message with a button! [button url="https://example.com" text="Learn More" style="success"][/alertbox]
