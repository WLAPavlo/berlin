<?php
/**
 * Page Banner Component
 * Displays banner with featured image background and page title
 * Used on all pages except home page
 */

// Don't show banner on home page
if (is_page_template('templates/template-home.php') || is_front_page()) {
    return;
}

// Prevent duplicate banner loading
static $banner_loaded = false;
if ($banner_loaded) {
    return;
}
$banner_loaded = true;

$banner_image = '';
$page_title = '';

// Get featured image and title based on page type
if (is_single() || is_page()) {
    // Only get featured image if it exists, don't force it
    if (has_post_thumbnail()) {
        $banner_image = get_attached_img_url(get_the_ID(), 'full_hd');
    }
    $page_title = get_the_title();
} elseif (is_category()) {
    $page_title = single_cat_title('', false);
    // Try to get category featured image if available
    $category = get_queried_object();
    if ($category && function_exists('get_field')) {
        $banner_image = get_field('featured_image', $category);
        if (is_array($banner_image)) {
            $banner_image = $banner_image['url'];
        }
    }
} elseif (is_archive()) {
    $page_title = get_the_archive_title();
} elseif (is_search()) {
    $page_title = sprintf(__('Search Results for: %s', 'default'), '<span>' . esc_html(get_search_query()) . '</span>');
} elseif (is_404()) {
    $page_title = __('404: Page Not Found', 'default');
}

// Use default background from body if no featured image
$banner_style = $banner_image ? bg($banner_image, '', false) : '';
?>

<div id="page-banner" class="page-banner" <?php echo $banner_style; ?>>
    <!-- Header inside banner -->
    <header class="header header--in-slider">
        <div class="container-fluid menu-container">
            <div class="row no-gutters-xs">
                <div class="col-auto">
                    <div class="logo">
                        <?php show_custom_logo(); ?>
                    </div>
                </div>
                <div class="col">
                    <?php if (has_nav_menu('header-menu')): ?>
                        <div class="navbar navbar-expand-lg">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainMenu" aria-controls="mainMenu" aria-expanded="false" aria-label="Toggle navigation">
                               <span class="navbar-toggler-icon">
                                   <span></span>
                               </span>
                            </button>
                            <nav class="collapse navbar-collapse" id="mainMenu">
                                <?php wp_nav_menu(array(
                                    'theme_location' => 'header-menu',
                                    'menu_class'     => 'header-menu navbar-nav ml-auto',
                                    'container'      => false,
                                    'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                    'walker'         => new Bootstrap_Navigation(),
                                )); ?>
                            </nav>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>

    <!-- Banner content -->
    <div class="page-banner__content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-banner__inner">
                        <h1 class="page-banner__title"><?php echo $page_title; ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>
<main class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <article class="entry">
                    <div class="entry__content">
                        <p>Berlin First Baptist Church is committed to ensuring digital accessibility for people with disabilities. We are continually improving the user experience for everyone and applying the relevant accessibility standards.</p>

                        <h2>Measures to Support Accessibility</h2>
                        <p>Berlin First Baptist Church takes the following measures to ensure accessibility:</p>
                        <ul>
                            <li>Include accessibility as part of our mission statement</li>
                            <li>Include accessibility throughout our internal policies</li>
                            <li>Integrate accessibility into our procurement practices</li>
                            <li>Provide continual accessibility training for our staff</li>
                            <li>Assign clear accessibility goals and responsibilities</li>
                            <li>Employ formal accessibility quality assurance methods</li>
                        </ul>

                        <h2>Conformance Status</h2>
                        <p>The Web Content Accessibility Guidelines (WCAG) defines requirements for designers and developers to improve accessibility for people with disabilities. It defines three levels of conformance: Level A, Level AA, and Level AAA. This website is partially conformant with WCAG 2.1 level AA.</p>

                        <h2>Feedback</h2>
                        <p>We welcome your feedback on the accessibility of this website. Please let us know if you encounter accessibility barriers:</p>
                        <ul>
                            <li>Phone: <?php echo get_field('phone', 'options') ?: '(410) 641-4300'; ?></li>
                            <li>Email: <?php echo get_field('email', 'options') ?: 'info@berlinfbc.org'; ?></li>
                            <li>Visitor Address: <?php echo get_field('address', 'options') ?: '613 William St, Berlin, MD 21811'; ?></li>
                        </ul>

                        <h2>Technical Specifications</h2>
                        <p>Accessibility of this website relies on the following technologies to work with the particular combination of web browser and any assistive technologies or plugins installed on your computer:</p>
                        <ul>
                            <li>HTML</li>
                            <li>WAI-ARIA</li>
                            <li>CSS</li>
                            <li>JavaScript</li>
                        </ul>

                        <h2>Assessment Approach</h2>
                        <p>Berlin First Baptist Church assessed the accessibility of this website by the following approaches:</p>
                        <ul>
                            <li>Self-evaluation</li>
                            <li>External evaluation</li>
                        </ul>

                        <p><em>This statement was created on <?php echo date('F j, Y'); ?> using the W3C Accessibility Statement Generator Tool.</em></p>
                    </div>
                </article>
            </div>
        </div>
    </div>
</main>
