<?php
/**
 * Index
 *
 * Standard loop for the search result page
 */
get_header(); ?>

<main class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <!-- BEGIN of search results -->
                <?php get_search_form(); ?>

                <?php if ( get_search_query() ) : ?>
                    <div class="search-results-info">
                        <h2 class="search-results-title">
                            <?php printf( __( 'Search Results for: %s', 'default' ), '<span class="search-query">' . esc_html( get_search_query() ) . '</span>' ); ?>
                        </h2>
                        <?php if ( have_posts() ) : ?>
                            <p class="search-results-count">
                                <?php
                                global $wp_query;
                                $total = $wp_query->found_posts;
                                printf( _n( 'Found %d result', 'Found %d results', $total, 'default' ), $total );
                                ?>
                            </p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <?php if ( have_posts() ) : ?>
                    <div class="search-results-list">
                        <?php while ( have_posts() ) : the_post(); ?>
                            <?php get_template_part( 'parts/loop', 'post' ); // Post item ?>
                        <?php endwhile; ?>
                    </div>
                <?php else: ?>
                    <div class="no-search-results">
                        <h3><?php _e( 'No Results Found', 'default' ); ?></h3>
                        <p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'default' ); ?></p>
                        <?php get_search_form(); ?>
                    </div>
                <?php endif; ?>

                <!-- BEGIN of pagination -->
                <?php bootstrap_pagination(); ?>
                <!-- END of pagination -->
                <!-- END of search results -->
            </div>
            <!-- END of sidebar -->
        </div>
    </div>
</main>

<?php get_footer(); ?>
