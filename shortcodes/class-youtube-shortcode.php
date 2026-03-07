<?php

class WD_Youtube_Shortcode {
    function __construct() {
        add_shortcode('youtube', [$this, 'render']);
    }

    function render($attributes) {
        $defaults = ['id' => 'BGZB9dn0GV4'];
        $attributes = shortcode_atts($defaults, $attributes);
        $embed = <<<EOF
            <p><iframe width="560" height="315" src="https://www.youtube.com/embed/{$attributes['id']}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe></p>
        EOF;

        return $embed;
    }
}

// Frontend usage example:
// [youtube id="BGZB9dn0GV4"]