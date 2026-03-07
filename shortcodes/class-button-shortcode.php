<?php
/**
 * Button Shortcode
 * 
 * Usage: [button url="https://example.com" text="Click Me" style="primary" size="medium"]
 * Styles: primary, secondary, success, danger, warning, info
 * Sizes: small, medium, large
 * Example: [button url="/contact" text="Contact Us" style="primary"]
 */

class WD_Button_Shortcode {
    
    public function __construct() {
        add_shortcode('button', array($this, 'render'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_styles'));
    }
    
    /**
     * Enqueue button styles
     */
    public function enqueue_styles() {
        wp_add_inline_style('wp-block-library', $this->get_button_css());
    }
    
    /**
     * Get button CSS
     * 
     * @return string
     */
    private function get_button_css() {
        return '
            .wd-button {
                display: inline-block;
                padding: 10px 20px;
                text-decoration: none;
                border-radius: 4px;
                transition: all 0.3s ease;
                font-weight: 500;
                text-align: center;
                cursor: pointer;
            }
            .wd-button-small { padding: 5px 15px; font-size: 14px; }
            .wd-button-medium { padding: 10px 20px; font-size: 16px; }
            .wd-button-large { padding: 15px 30px; font-size: 18px; }
            
            .wd-button-primary { background: #0073aa; color: #fff; }
            .wd-button-primary:hover { background: #005177; color: #fff; }
            
            .wd-button-secondary { background: #6c757d; color: #fff; }
            .wd-button-secondary:hover { background: #5a6268; color: #fff; }
            
            .wd-button-success { background: #28a745; color: #fff; }
            .wd-button-success:hover { background: #218838; color: #fff; }
            
            .wd-button-danger { background: #dc3545; color: #fff; }
            .wd-button-danger:hover { background: #c82333; color: #fff; }
            
            .wd-button-warning { background: #ffc107; color: #212529; }
            .wd-button-warning:hover { background: #e0a800; color: #212529; }
            
            .wd-button-info { background: #17a2b8; color: #fff; }
            .wd-button-info:hover { background: #138496; color: #fff; }
        ';
    }
    
    /**
     * Render the shortcode
     * 
     * @return string
     */
    public function render($atts) {
        // Extract shortcode attributes
        $atts = shortcode_atts(array(
            'url' => '#',
            'text' => 'Click Here',
            'style' => 'primary',
            'size' => 'medium',
            'target' => '_blank',
            'class' => '',
        ), $atts);
        
        $classes = array(
            'wd-button',
            'wd-button-' . sanitize_html_class($atts['style']),
            'wd-button-' . sanitize_html_class($atts['size'])
        );
        
        if (!empty($atts['class'])) {
            $classes[] = sanitize_html_class($atts['class']);
        }
        
        return sprintf(
            '<p><a href="%s" class="%s" target="%s">%s</a></p>',
            esc_url($atts['url']),
            esc_attr(implode(' ', $classes)),
            esc_attr($atts['target']),
            esc_html($atts['text'])
        );
    }
}

// Frontend usage example:
// [button url="https://example.com" text="Visit Example" style="primary" size="large"]

// Nested example:
// [alertbox type="success"]This is a success message with a button! [button url="https://example.com" text="Learn More" style="success"][/alertbox]