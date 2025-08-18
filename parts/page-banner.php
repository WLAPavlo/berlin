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
    // Get featured image or use placeholder
    $banner_image = has_post_thumbnail() ? get_attached_img_url(get_the_ID(), 'full_hd') : IMAGE_PLACEHOLDER;
    $page_title = get_the_title();
} elseif (is_category()) {
    $page_title = single_cat_title('', false);
    // Try to get category featured image if available
    $category = get_queried_object();
    if ($category && function_exists('get_field')) {
        $banner_image = get_field('featured_image', $category);
        if (is_array($banner_image) && !empty($banner_image['url'])) {
            $banner_image = $banner_image['url'];
        } elseif (!$banner_image) {
            $banner_image = IMAGE_PLACEHOLDER;
        }
    } else {
        $banner_image = IMAGE_PLACEHOLDER;
    }
} elseif (is_archive()) {
    $page_title = get_the_archive_title();
    $banner_image = IMAGE_PLACEHOLDER;
} elseif (is_search()) {
    $page_title = sprintf(__('Search Results for: %s', 'default'), '<span>' . esc_html(get_search_query()) . '</span>');
    $banner_image = IMAGE_PLACEHOLDER;
} elseif (is_404()) {
    $page_title = __('404: Page Not Found', 'default');
    $banner_image = IMAGE_PLACEHOLDER;
}

// Ensure we always have a banner image
if (!$banner_image) {
    $banner_image = IMAGE_PLACEHOLDER;
}

$banner_style = bg($banner_image, '', false);
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