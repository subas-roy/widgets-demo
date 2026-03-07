<?php
/**
 * Alert Block Widget
 * 
 * A custom Gutenberg block for displaying alert messages
 */

if (!defined('ABSPATH')) {
    exit;
}

class WD_Alert_Block {
    
    /**
     * Constructor
     */
    public function __construct() {
        add_action('init', array($this, 'register_block'));
    }
    
    /**
     * Register the block
     */
    public function register_block() {
        // Register block script
        wp_register_script(
            'alert-block-script',
            WIDGET_DEMO_URL . 'block-widgets/js/alert-block.js',
            array('wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-i18n'),
            WIDGET_DEMO_VERSION,
            true
        );
        
        // Register block styles
        wp_register_style(
            'alert-block-style',
            WIDGET_DEMO_URL . 'block-widgets/css/alert-block.css',
            array(),
            WIDGET_DEMO_VERSION
        );
        
        // Register editor styles
        wp_register_style(
            'alert-block-editor-style',
            WIDGET_DEMO_URL . 'block-widgets/css/alert-block-editor.css',
            array('wp-edit-blocks'),
            WIDGET_DEMO_VERSION
        );
        
        // Register the block
        register_block_type('widget-demo/alert-block', array(
            'editor_script' => 'alert-block-script',
            'style' => 'alert-block-style',
            'editor_style' => 'alert-block-editor-style',
            'render_callback' => array($this, 'render_block'),
            'attributes' => array(
                'message' => array(
                    'type' => 'string',
                    'default' => 'This is an alert message!',
                ),
                'type' => array(
                    'type' => 'string',
                    'default' => 'info',
                ),
                'dismissible' => array(
                    'type' => 'boolean',
                    'default' => false,
                ),
            ),
        ));
    }
    
    /**
     * Render the block
     */
    public function render_block($attributes) {
        $message = $attributes['message'] ?? 'This is an alert message!';
        $type = $attributes['type'] ?? 'info';
        $dismissible = $attributes['dismissible'] ?? false;

        $classes = ['alert-block', 'alert-' . sanitize_html_class($type)];
        if ($dismissible) {
            $classes[] = 'alert-dismissible';
        }

        $dismiss_button = $dismissible ? '<button class="alert-dismiss" onclick="this.parentElement.style.display=\'none\'">
                <span aria-hidden="true">&times;</span>
            </button>' : '';

        $class_string = esc_attr(implode(' ', $classes));

        return '<div class="' . $class_string . '">' .
            '<div class="alert-icon">' . $this->get_icon($type) . '</div>' .
            '<div class="alert-content">' . wp_kses_post($message) . '</div>' .
            $dismiss_button .
            '</div>';
    }
    
    /**
     * Get icon based on alert type
     */
    private function get_icon($type) {
        $icons = array(
            'info' => '&#9432;',
            'success' => '&#10004;',
            'warning' => '&#9888;',
            'danger' => '&#10006;',
        );
        
        return isset($icons[$type]) ? $icons[$type] : $icons['info'];
    }
}