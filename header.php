<?php
/**
 * Header
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <!-- Set up Meta -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta charset="<?php bloginfo( 'charset' ); ?>">

    <!-- Set the viewport width to device width for mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, user-scalable=yes">
    <!-- Remove Microsoft Edge's & Safari phone-email styling -->
    <meta name="format-detection" content="telephone=no,email=no,url=no">

    <!-- Add external fonts below (GoogleFonts / Typekit) -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700&display=swap">

    <?php wp_head(); ?>
</head>

<body <?php body_class('no-outline'); ?>>
<?php wp_body_open(); ?>

<!-- <div class="preloader hide-for-medium">
	<div class="preloader__icon"></div>
</div> -->

<!-- BEGIN of Alert Bar -->
<?php if (get_field('enable_alert_bar', 'options')) :
    $bg_color = get_field('alert_background_color', 'options');
    $text_color = get_field('alert_text_color', 'options');
    $content = get_field('alert_content', 'options');

    if ( $content ): ?>
        <div id="alert-bar" class="alert-bar"
             style="background-color: <?php echo $bg_color; ?>; color: <?php echo $text_color; ?>;">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="alert-bar__content">
                            <?php echo $content; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif;
endif; ?>
<!-- END of Alert Bar -->

<?php if (is_page_template('templates/template-home.php') || is_front_page()): ?>
    <!-- BEGIN of header for home page -->
    <header class="header header--in-slider">
        <div class="container-fluid menu-container">
            <div class="row no-gutters-xs">
                <div class="col-auto">
                    <div class="logo">
                        <?php show_custom_logo(); ?>
                    </div>
                </div>
                <div class="col">
                    <?php if ( has_nav_menu( 'header-menu' ) ) : ?>
                        <div class="navbar navbar-expand-lg">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainMenu" aria-controls="mainMenu" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon">
                                    <span></span>
                                </span>
                            </button>
                            <nav class="collapse navbar-collapse" id="mainMenu">
                                <?php wp_nav_menu( array(
                                    'theme_location' => 'header-menu',
                                    'menu_class'     => 'header-menu navbar-nav ml-auto',
                                    'container'      => false,
                                    'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                    'walker'         => new Bootstrap_Navigation(),
                                ) ); ?>
                            </nav>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>
    <!-- END of header for home page -->
<?php else: ?>
    <!-- Page banner with header inside for other pages -->
    <?php get_template_part('parts/page-banner'); ?>
<?php endif; ?>

