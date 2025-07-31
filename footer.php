<?php
/**
 * Footer
 */
?>

<!-- BEGIN of footer -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <!-- Contact Info Section -->
            <div class="col-lg-3 col-md-6 col-12">
                <div class="footer-section">
                    <div class="footer-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="footer-content">
                        <?php if ( $address = get_field( 'address', 'options' ) ): ?>
                            <address><?php echo $address; ?></address>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12">
                <div class="footer-section">
                    <div class="footer-icon">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <div class="footer-content">
                        <?php if ( $phone = get_field( 'phone', 'options' ) ): ?>
                            <p><a href="tel:<?php echo sanitize_number( $phone ); ?>"><?php echo $phone; ?></a></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12">
                <div class="footer-section">
                    <div class="footer-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="footer-content">
                        <?php if ( $schedule = get_field( 'schedule', 'options' ) ): ?>
                            <?php echo $schedule; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12">
                <div class="footer-section">
                    <div class="footer-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="footer-content">
                        <p><strong>GIVE TO BFBC</strong></p>
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
                        <div class="footer-links">
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
                            <span class="separator">|</span>
                            <a href="<?php echo home_url('/accessibility/'); ?>">Accessibility</a>
                        </div>

                        <div class="footer-copyright">
                            <p>Copyright © <?php echo date('Y'); ?> <a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></p>
                            <p>Website Design by <a href="https://d3corp.com/" target="_blank">D3</a> <a href="https://visitoceancity.com/" target="_blank">Ocean City, Maryland</a></p>
                        </div>

                        <div class="footer-social">
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
