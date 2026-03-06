<?php

class WD_Basic_ShortCode {
    function __construct() {
        add_shortcode('helloworld', [$this, 'render']);
    }

    function render($attributes) {
        return "<h2>Hello World!!!!</h1>";
    }
}