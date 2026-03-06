<?php
class Basic_Widget {
    public function __construct() {
        add_action('wp_dashboard_setup', [$this, 'register_widget']);
    }

    public function register_widget() {
        wp_add_dashboard_widget(
            'wd_basic_widget',
            'WD Basic Widget',
            [$this, 'render']
        );
    }

    public function render() {
        echo "<h3>My First Dashboard Widget</h3>";
        ?>
            <ul class="fruit-list">
                <li>🍎 Apple</li>
                <li>🍌 Banana</li>
                <li>🍊 Orange</li>
                <li>🍇 Grapes</li>
                <li>🍍 Pineapple</li>
                <li>🥭 Mango</li>
                <li>🍉 Watermelon</li>
                <li>🍓 Strawberry</li>
                <li>🥝 Kiwi</li>
                <li>🍐 Pear</li>
            </ul>
        <?php
    }
}
