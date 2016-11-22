<?php if (!empty($product)):?>
    <article class="weekly-product">
        <header class="weekly-product-header">
            <h3>
                <?php echo $product['title'] ?>
            </h3>
        </header>

        <figure class="weekly-product-picture">
            <?php $src = wp_get_attachment_url( get_post_thumbnail_id($product['id'])); ?>
            <img src="<?php echo esc_attr($src); ?>"
                 alt="<?php echo esc_attr($product['title']); ?>"
                 title="<?php echo esc_attr($product['title']); ?>" />
        </figure>
    </article>
<?php endif; ?>