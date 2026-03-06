<?php

class WD_Basic_ShortCode {
    function __construct() {
        add_shortcode('helloworld', [$this, 'render']);
    }

    function render($attributes) {
        return "<h2 style='color: $attributes[color]; font-size: $attributes[font_size];'>Hello World!!!!</h2>";
    }
}

// Frontend
// [helloworld color='red' font_size='20px']