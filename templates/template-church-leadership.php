<?php
/**
 * Template Name: Church Leadership
 */
get_header(); ?>

    <main class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <?php if (have_posts()): ?>
                        <?php while (have_posts()): the_post(); ?>
                            <article <?php post_class('entry'); ?>>
                                <div class="entry__content">
                                    <?php the_content('', true); ?>
                                </div>
                            </article>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Staff Section -->
        <div class="staff-section">
            <div class="container">
                <?php
                // Get all staff categories
                $staff_categories = get_terms(array(
                    'taxonomy' => 'staff_category',
                    'hide_empty' => false,
                    'orderby' => 'term_order'
                ));

                if ($staff_categories && !is_wp_error($staff_categories)):
                    foreach ($staff_categories as $category):
                        // Get staff members for this category
                        $staff_query = new WP_Query(array(
                            'post_type' => 'staff',
                            'posts_per_page' => -1,
                            'orderby' => 'menu_order',
                            'order' => 'ASC',
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'staff_category',
                                    'field'    => 'term_id',
                                    'terms'    => $category->term_id,
                                ),
                            ),
                        ));

                        if ($staff_query->have_posts()):
                            ?>
                            <div class="staff-category-section">
                                <h2 class="staff-category-title"><?php echo esc_html($category->name); ?></h2>
                                <div class="row staff-grid">
                                    <?php while ($staff_query->have_posts()): $staff_query->the_post(); ?>
                                        <?php
                                        $staff_email = get_field('staff_email');
                                        $staff_position = get_field('staff_position');
                                        ?>
                                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                                            <div class="staff-member">
                                                <div class="staff-member__image-wrap">
                                                    <?php if (has_post_thumbnail()): ?>
                                                        <?php the_post_thumbnail('medium', array('class' => 'staff-member__image')); ?>
                                                    <?php else: ?>
                                                        <div class="staff-member__placeholder">
                                                            <i class="fas fa-user"></i>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="staff-member__content">
                                                    <h3 class="staff-member__name"><?php the_title(); ?></h3>
                                                    <?php if ($staff_position): ?>
                                                        <p class="staff-member__position"><?php echo esc_html($staff_position); ?></p>
                                                    <?php endif; ?>
                                                    <?php if (get_the_content()): ?>
                                                        <div class="staff-member__description">
                                                            <?php the_content(); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if ($staff_email): ?>
                                                        <a href="mailto:<?php echo esc_attr($staff_email); ?>" class="staff-member__contact">
                                                            CONTACT
                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            </div>
                        <?php
                        endif;
                        wp_reset_postdata();
                    endforeach;
                endif;
                ?>
            </div>
        </div>
    </main>

<?php get_footer(); ?>