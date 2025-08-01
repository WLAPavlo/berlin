<?php
$image_text_module = get_field('image_text_module');

if (!$image_text_module || !$image_text_module['enable_image_text']) {
    return;
}

$text_content = $image_text_module['text_content'];

if (!$text_content) {
    return;
}

$image = $image_text_module['image'];
$image_position = $image_text_module['image_position'] ?: 'left';
$image_style = $image_text_module['image_style'] ?: 'fitted';

$reverse_class = $image_position === 'right' ? 'flex-row-reverse' : '';
$image_style_class = $image_style === 'stylized' ? 'image-text__image--stylized' : 'image-text__image--fitted';
?>

<section class="image-text-module" data-scroll>
    <div class="container">
        <?php if ($image): ?>
            <div class="row align-items-center <?php echo $reverse_class; ?>">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="image-text__image-wrap">
                        <?php echo wp_get_attachment_image($image['ID'], 'large', false, array(
                            'class' => 'image-text__image ' . $image_style_class,
                            'alt' => $image['alt'] ?: $image['title']
                        )); ?>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="image-text__content">
                        <?php echo $text_content; ?>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="row">
                <div class="col-12">
                    <div class="image-text__content image-text__content--full-width">
                        <?php echo $text_content; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>