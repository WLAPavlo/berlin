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

        <!-- BEGIN of church leadership modules -->
        <?php if (have_rows('church_leadership_content')): ?>
            <?php while (have_rows('church_leadership_content')): the_row(); ?>
                <?php
                $layout = get_row_layout();
                $template_file = 'parts/flexible/flexible-' . str_replace('_', '-', $layout);
                get_template_part($template_file);
                ?>
            <?php endwhile; ?>
        <?php endif; ?>
        <!-- END of church leadership modules -->
    </main>

<?php get_footer(); ?>