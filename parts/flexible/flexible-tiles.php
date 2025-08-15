<?php
$section_title = get_sub_field('section_title');
$tiles = get_sub_field('tiles');

if (!$tiles || empty($tiles)) {
    return;
}
?>

<section class="tiles-module" data-scroll>
    <div class="container">
        <?php if ($section_title): ?>
            <div class="row">
                <div class="col-12">
                    <h2 class="tiles-module__title text-center"><?php echo esc_html($section_title); ?></h2>
                </div>
            </div>
        <?php endif; ?>

        <div class="row tiles-module__grid">
            <?php foreach ($tiles as $tile): ?>
            <?php
            $background_image = $tile['background_image'];
            $title = $tile['title'];
            $link = $tile['link'];

            if (!$background_image || !$title) continue;

            $tile_tag = $link ? 'a' : 'div';
            $tile_attrs = '';

            if ($link) {
                $tile_attrs = sprintf(
                    'href="%s"%s%s',
                    $link['url'],
                    $link['target'] ? ' target="' . $link['target'] . '"' : '',
                    $link['target'] === '_blank' ? ' rel="noopener noreferrer"' : ''
                );
            }
            ?>

            <div class="col-xl-4 col-lg-6 col-md-6 col-12 tile-item-wrapper">
                <<?php echo $tile_tag; ?> class="tile-item" <?php echo $tile_attrs; ?>>
                <div class="tile-item__image" <?php bg($background_image, 'large'); ?>></div>
                <div class="tile-item__content">
                    <h3 class="tile-item__title"><?php echo $title; ?></h3>
                </div>
            </<?php echo $tile_tag; ?>>
        </div>
    <?php endforeach; ?>
    </div>
    </div>
</section>