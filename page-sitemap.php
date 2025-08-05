<?php
/**
 * Template Name: Site Map
 */
get_header(); ?>

    <main class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <article class="entry">
                        <div class="entry__content">
                            <div class="sitemap-section">
                                <h2>Pages</h2>
                                <ul>
                                    <?php
                                    $pages = get_pages(array(
                                        'sort_column' => 'menu_order',
                                        'sort_order' => 'ASC'
                                    ));
                                    foreach($pages as $page) {
                                        echo '<li><a href="' . get_permalink($page->ID) . '">' . $page->post_title . '</a></li>';
                                    }
                                    ?>
                                </ul>
                            </div>

                            <?php if (has_nav_menu('header-menu')): ?>
                                <div class="sitemap-section">
                                    <h2>Navigation</h2>
                                    <?php wp_nav_menu(array(
                                        'theme_location' => 'header-menu',
                                        'container' => 'ul',
                                        'menu_class' => 'sitemap-menu'
                                    )); ?>
                                </div>
                            <?php endif; ?>

                            <div class="sitemap-section">
                                <h2>Blog Posts</h2>
                                <ul>
                                    <?php
                                    $posts = get_posts(array(
                                        'numberposts' => 20,
                                        'post_status' => 'publish'
                                    ));
                                    foreach($posts as $post) {
                                        echo '<li><a href="' . get_permalink($post->ID) . '">' . $post->post_title . '</a></li>';
                                    }
                                    wp_reset_postdata();
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </main>

<?php get_footer(); ?>