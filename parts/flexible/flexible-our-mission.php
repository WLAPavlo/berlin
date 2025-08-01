<?php
$background_image = get_sub_field('background_image');
$mission_items = get_sub_field('mission_items');

if (!$mission_items || empty($mission_items)) {
    return;
}
?>

<section class="our-mission-module" data-scroll <?php if ($background_image) bg($background_image, 'full_hd'); ?>>
    <div class="container">
        <div class="row our-mission-module__grid">
            <?php foreach ($mission_items as $item): ?>
                <?php
                $icon = $item['icon'];
                $content = $item['content'];
                $link = $item['link'];

                if (!$content) continue;
                ?>

                <div class="col-lg-6 col-md-6 col-12 mission-item-wrapper">
                    <div class="mission-item">
                        <?php if ($icon): ?>
                            <div class="mission-item__icon-wrap">
                                <div class="mission-item__icon" <?php bg($icon, 'medium'); ?>></div>
                            </div>
                        <?php endif; ?>

                        <div class="mission-item__content">
                            <?php echo $content; ?>
                        </div>

                        <?php if ($link): ?>
                            <a href="<?php echo esc_url($link['url']); ?>"
                               class="mission-item__link"
                               <?php if ($link['target']): ?>target="<?php echo esc_attr($link['target']); ?>"<?php endif; ?>>
                                <?php echo $link['title'] ?: 'Learn More'; ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>