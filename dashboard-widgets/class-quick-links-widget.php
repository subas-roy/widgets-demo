<?php

class WD_Quick_Links {
    function __construct() {
        add_action('wp_dashboard_setup', [$this, 'register_widget']);
    }

    function register_widget() {
        wp_add_dashboard_widget(
            'wd_quick_links_widget',
            'WD Quick Links Widget',
            [$this, 'render']
        );
    }

    function render() {
        $links = [
            [
                'title' => 'Create New Post',
                'url' => admin_url('post-new.php'),
                'icon' => '📝',
                'description' => 'Write a new blog post',
            ],
            [
                'title' => 'Add New Page',
                'url' => admin_url('post-new.php?post_type=page'),
                'icon' => '📄',
                'description' => 'Create a new page',
            ],
            [
                'title' => 'Upload Media',
                'url' => admin_url('media-new.php'),
                'icon' => '🖼️',
                'description' => 'Add images or files',
            ],
            [
                'title' => 'Manage Comments',
                'url' => admin_url('edit-comments.php'),
                'icon' => '💬',
                'description' => 'Moderate comments',
            ],
            [
                'title' => 'Theme Customizer',
                'url' => admin_url('customize.php'),
                'icon' => '🎨',
                'description' => 'Customize your theme',
            ],
            [
                'title' => 'Plugin Manager',
                'url' => admin_url('plugins.php'),
                'icon' => '🔌',
                'description' => 'Manage plugins',
            ],
            [
                'title' => 'View Site',
                'url' => home_url(),
                'icon' => '🌐',
                'description' => 'Visit your website',
            ],
            [
                'title' => 'Settings',
                'url' => admin_url('options-general.php'),
                'icon' => '⚙️',
                'description' => 'General settings',
            ],
        ];

        echo '<div class="quick-links-grid">';
        foreach ($links as $link) {
            //you always need to escape data before output
            ?>
            <a href="<?php echo $link['url']; ?>" class="quick-link-item">
                <div class="quick-link-icon"><?php echo $link['icon']; ?></div>
                <div class="quick-link-content">
                    <div class="quick-link-title"><?php echo $link['title']; ?></div>
                    <div class="quick-link-desc"><?php echo $link['description']; ?></div>
                </div>
            </a>
            <?php
        }
        echo '</div>';
    }
}