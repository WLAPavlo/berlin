<?php
$section_title = get_sub_field('section_title') ?: 'Our Staff';
$selected_categories = get_sub_field('staff_categories');

// If no categories selected, show all
if (empty($selected_categories)) {
    $staff_categories = get_terms(array(
        'taxonomy' => 'staff_category',
        'hide_empty' => false,
        'orderby' => 'term_order'
    ));
} else {
    $staff_categories = $selected_categories;
}

if (!$staff_categories || is_wp_error($staff_categories)) {
    return;
}
?>

<section class="staff-section-module" data-scroll>
    <div class="container">
        <?php if ($section_title): ?>
            <div class="row">
                <div class="col-12">
                    <h2 class="staff-section__title text-center"><?php echo esc_html($section_title); ?></h2>
                </div>
            </div>
        <?php endif; ?>

        <?php foreach ($staff_categories as $category): ?>
            <?php
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
                    <h3 class="staff-category-title"><?php echo esc_html($category->name); ?></h3>
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
                                        <h4 class="staff-member__name"><?php the_title(); ?></h4>
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
        ?>
    </div>
</section>