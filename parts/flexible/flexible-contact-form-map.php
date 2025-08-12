<?php
$background_image = get_sub_field('background_image');
$content = get_sub_field('content');
$map_content = get_sub_field('map_content');
$google_map = get_sub_field('google_map');

if (!$content && !$map_content) {
    return;
}
?>

<section class="contact-form-map-module" data-scroll <?php if ($background_image) bg($background_image, 'full_hd'); ?>>
    <div class="container">
        <div class="row contact-form-map__content">
            <!-- Contact Form Section -->
            <?php if ($content): ?>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="contact-form-map__form-wrapper">
                        <div class="contact-form-map__content">
                            <?php echo $content; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Map Section -->
            <?php if ($map_content || $google_map): ?>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="contact-form-map__map-wrapper">
                        <?php if ($map_content): ?>
                            <div class="contact-form-map__map-content">
                                <?php echo $map_content; ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($google_map): ?>
                            <div class="contact-form-map__map">
                                <div class="acf-map">
                                    <div class="marker" data-lat="<?php echo $google_map['lat']; ?>" data-lng="<?php echo $google_map['lng']; ?>">
                                        <?php echo '<p>' . $google_map['address'] . '</p>'; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>