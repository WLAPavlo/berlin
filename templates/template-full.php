<?php
/**
 * Template Name: Full Width
 */
get_header(); ?>

<main class="main-content">
    <div class="container">
        <div class="row">
            <!-- BEGIN of page content -->
            <div class="col-12">
                <?php if ( have_posts() ) : ?>
                    <?php while ( have_posts() ) : the_post(); ?>
                        <article <?php post_class('entry'); ?>>
                            <div class="entry__content">
                                <?php the_content( '', true ); ?>
                            </div>
                        </article>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
            <!-- END of page content -->
        </div>
    </div>
</main>

<?php get_footer(); ?>
