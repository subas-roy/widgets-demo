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
        $post_counts = wp_count_posts();
        $page_counts = wp_count_posts('page');
        $comment_counts = wp_count_comments();
        $user_count = count_users();
        $categories = wp_count_terms('category');
        $tags = wp_count_terms('post_tag');
        ?>
        <div class="site-stats-widget">
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-value"><?php echo ($post_counts->publish); ?></div>
                    <div class="stat-label">Published Posts</div>
                    <div class="stat-breakdown">
                        Drafts: <?php echo ($post_counts->draft); ?> |
                        Pending: <?php echo ($post_counts->pending); ?>
                    </div>
                </div>

                <div class="stat-item">
                    <div class="stat-value"><?php echo ($page_counts->publish); ?></div>
                    <div class="stat-label">Pages</div>
                    <div class="stat-breakdown">
                        Drafts: <?php echo ($page_counts->draft); ?>
                    </div>
                </div>

                <div class="stat-item">
                    <div class="stat-value"><?php echo ($comment_counts->approved); ?></div>
                    <div class="stat-label">Comments</div>
                    <div class="stat-breakdown">
                        Pending: <?php echo ($comment_counts->moderated); ?> |
                        Spam: <?php echo ($comment_counts->spam); ?>
                    </div>
                </div>

                <div class="stat-item">
                    <div class="stat-value"><?php echo ($user_count['total_users']); ?></div>
                    <div class="stat-label">Total Users</div>
                    <div class="stat-breakdown">
                        Active members on your site
                    </div>
                </div>

                <div class="stat-item">
                    <div class="stat-value"><?php echo $categories; ?></div>
                    <div class="stat-label">Categories</div>
                    <div class="stat-breakdown">
                        Content categories
                    </div>
                </div>

                <div class="stat-item">
                    <div class="stat-value"><?php echo ($tags); ?></div>
                    <div class="stat-label">Tags</div>
                    <div class="stat-breakdown">
                        Content labels
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

}