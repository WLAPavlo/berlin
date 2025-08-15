<?php
$staff_categories_ordered = get_sub_field('staff_categories_ordered');

// If no categories selected, show all in default order
if (empty($staff_categories_ordered)) {
    $staff_categories = get_terms(array(
        'taxonomy' => 'staff_category',
        'hide_empty' => false,
        'orderby' => 'term_order',
        'order' => 'ASC'
    ));
} else {
    // Use the ordered categories from the repeater
    $staff_categories = array();
    foreach ($staff_categories_ordered as $category_item) {
        if (!empty($category_item['category'])) {
            $staff_categories[] = $category_item['category'];
        }
    }
}

if (!$staff_categories || is_wp_error($staff_categories)) {
    return;
}
?>

<section class="staff-section-module" data-scroll>
    <div class="container">
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
                <div class="staff-category-section" data-category="<?php echo esc_attr($category->slug); ?>">
                    <h3 class="staff-category-title"><?php echo $category->name; ?></h3>
                    <?php
                    // Count staff members to determine grid alignment
                    $staff_count = $staff_query->found_posts;
                    $grid_class = $staff_count;
                    ?>
                    <div class="row <?php echo $grid_class; ?>">
                        <?php while ($staff_query->have_posts()): $staff_query->the_post(); ?>
                            <?php
                            $staff_contact_link = get_field('staff_contact_link');
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
                                        <?php if (get_the_content()): ?>
                                            <div class="staff-member__description">
                                                <?php the_content(); ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php
                                        $staff_contact_text = get_field('staff_contact_text');
                                        $staff_email = get_field('staff_email');
                                        ?>
                                        <?php if ($staff_email): ?>
                                            <a href="mailto:<?php echo esc_attr($staff_email); ?>"
                                               class="staff-member__contact"
                                               rel="noopener">
                                                <?php echo $staff_contact_text; ?>
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