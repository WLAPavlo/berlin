<?php
/**
 * Template Name: Home Page
 */
get_header(); ?>

<!--HOME PAGE SLIDER-->
<?php home_slider_template(); ?>
<!--END of HOME PAGE SLIDER-->

<!-- BEGIN of homepage modules -->
<?php if (have_rows('homepage_content')): ?>
    <?php while (have_rows('homepage_content')): the_row(); ?>
        <?php
        $layout = get_row_layout();
        $template_file = 'parts/flexible/flexible-' . str_replace('_', '-', $layout);
        get_template_part($template_file);
        ?>
    <?php endwhile; ?>
<?php endif; ?>
<!-- END of homepage modules -->

<!-- BEGIN of main content -->
<div class="container">
    <div class="row">
        <div class="col-12">
            <?php if ( have_posts() ) : ?>
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php the_content(); ?>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- END of main content -->

<script>
    document.body.classList.add('home');
</script>

<?php get_footer(); ?>
