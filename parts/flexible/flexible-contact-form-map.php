<?php
$background_image = get_sub_field('background_image');
$content = get_sub_field('content');
$map_content = get_sub_field('map_content');
$google_map = get_sub_field('google_map');

if (!$content && !$map_content) {
    return;
}

// Generate Google Maps iframe URL if location is set
$map_iframe_url = '';
if ($google_map && !empty($google_map['lat']) && !empty($google_map['lng'])) {
    $map_iframe_url = sprintf(
        'https://www.google.com/maps/embed/v1/place?key=%s&q=%s,%s&zoom=15',
        get_theme_mod('google_maps_api') ?: 'AIzaSyBgg23TIs_tBSpNQa8RC0b7fuV4SOVN840',
        $google_map['lat'],
        $google_map['lng']
    );
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
            <?php if ($map_content || $map_iframe_url): ?>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="contact-form-map__map-wrapper">
                        <?php if ($map_content): ?>
                            <div class="contact-form-map__map-content">
                                <?php echo $map_content; ?>

                                <!-- Відображення адреси з Google Map -->
                                <?php if ($google_map && !empty($google_map['address'])): ?>
                                    <div class="contact-form-map__address">
                                        <?php echo esc_html($google_map['address']); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($map_iframe_url): ?>
                            <div class="contact-form-map__map">
                                <iframe
                                        src="<?php echo esc_url($map_iframe_url); ?>"
                                        width="100%"
                                        height="100%"
                                        style="border:0;"
                                        allowfullscreen=""
                                        loading="lazy"
                                        referrerpolicy="no-referrer-when-downgrade">
                                </iframe>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>