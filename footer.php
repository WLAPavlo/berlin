<?php
/**
 * Footer
 */
?>

<!-- BEGIN of footer -->
<footer class="footer" style="background: <?php echo get_field('footer_background_color', 'options') ?: 'rgba(47, 58, 85, 0.75)'; ?>;">
    <div class="container">
        <div class="row">
            <!-- Address Section -->
            <div class="col-lg-3 col-md-6 col-12 text-center">
                <div class="footer-section">
                    <div class="footer-icon" style="width: <?php echo get_field('footer_icon_size', 'options') ?: '60'; ?>px; height: <?php echo get_field('footer_icon_size', 'options') ?: '60'; ?>px;">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="footer-content">
                        <?php if ( $address_label = get_field( 'address_label', 'options' ) ): ?>
                            <strong><?php echo esc_html( $address_label ); ?></strong>
                        <?php endif; ?>

                        <?php if ( $address = get_field( 'address', 'options' ) ): ?>
                            <?php $map_url = 'https://www.google.com/maps/search/?api=1&query=' . urlencode( $address ); ?>
                            <address>
                                <a href="<?php echo esc_url( $map_url ); ?>" target="_blank" rel="noopener noreferrer">
                                    <?php echo esc_html( $address ); ?>
                                </a>
                            </address>
                        <?php endif; ?>
                    </div>
                </div>
            </div>


            <!-- Phone Section -->
            <div class="col-lg-3 col-md-6 col-12 text-center">
                <div class="footer-section">
                    <div class="footer-icon" style="width: <?php echo get_field('footer_icon_size', 'options') ?: '60'; ?>px; height: <?php echo get_field('footer_icon_size', 'options') ?: '60'; ?>px;">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <div class="footer-content">
                        <?php if ( $phone_label = get_field( 'phone_label', 'options' ) ): ?>
                            <strong><?php echo $phone_label; ?></strong>
                        <?php endif; ?>
                        <?php if ( $phone = get_field( 'phone', 'options' ) ): ?>
                            <p><a href="tel:<?php echo sanitize_number( $phone ); ?>"><?php echo $phone; ?></a></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Schedule Section -->
            <div class="col-lg-3 col-md-6 col-12 text-center">
                <div class="footer-section">
                    <div class="footer-icon" style="width: <?php echo get_field('footer_icon_size', 'options') ?: '60'; ?>px; height: <?php echo get_field('footer_icon_size', 'options') ?: '60'; ?>px;">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="footer-content">
                        <?php if ( $schedule_label = get_field( 'schedule_label', 'options' ) ): ?>
                            <strong><?php echo $schedule_label; ?></strong>
                        <?php endif; ?>
                        <?php if ( $schedule = get_field( 'schedule', 'options' ) ): ?>
                            <?php echo $schedule; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Give Section -->
            <div class="col-lg-3 col-md-6 col-12 text-center">
                <div class="footer-section">
                    <div class="footer-icon" style="width: <?php echo get_field('footer_icon_size', 'options') ?: '60'; ?>px; height: <?php echo get_field('footer_icon_size', 'options') ?: '60'; ?>px;">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="footer-content">
                        <?php if ( $give_label = get_field( 'give_label', 'options' ) ): ?>
                            <strong><?php echo $give_label; ?></strong>
                        <?php endif; ?>
                        <?php if ( $give_link = get_field( 'give_link', 'options' ) ): ?>
                            <p><a href="<?php echo esc_url( $give_link ); ?>" target="_blank">Give Online</a></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer__bottom">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="footer-bottom-content">
                        <div class="footer-bottom-left">
                            <?php if ( $copyright = get_field( 'copyright', 'options' ) ): ?>
                                <span class="footer-copyright"><?php echo $copyright; ?></span>
                            <?php endif; ?>
                            <?php
                            if ( has_nav_menu( 'footer-menu' ) ) {
                                wp_nav_menu( array(
                                    'theme_location' => 'footer-menu',
                                    'menu_class' => 'footer-menu',
                                    'depth' => 1,
                                    'container' => false
                                ) );
                            }
                            ?>
                            <a href="<?php echo home_url('/sitemap/'); ?>">Site Map</a>
                            <a href="<?php echo home_url('/accessibility/'); ?>">Accessibility</a>
                            <?php if ( $website_design_text = get_field( 'website_design_text', 'options' ) ): ?>
                                <?php echo $website_design_text; ?>
                            <?php endif; ?>
                        </div>

                        <div class="footer-bottom-right">
                            <?php get_template_part('parts/socials'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- END of footer -->

<button id="back-to-top"><span class="arrow"></span></button>

<?php wp_footer(); ?>
<?php if ( $ada_script = get_field( 'ada', 'options' ) ) : ?>
    <?php echo $ada_script; ?>
<?php endif; ?>
</body>
</html>
