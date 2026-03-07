<?php

class WD_Basic_ShortCode {
    function __construct() {
        add_shortcode('helloworld', [$this, 'render']);
    }

    function render($attributes) {
        $defaults = [
            'color' => 'blue',
            'font_size' => '32px'
        ];
        $attributes = shortcode_atts($defaults, $attributes); // Merge user attributes with defaults
        return "<h2 style='color: $attributes[color]; font-size: $attributes[font_size];'>Hello World!!!!</h2>";
    }
}

// Frontend usage example:
// [helloworld color='red' font_size='20px']