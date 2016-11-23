<?php if (!empty($product)):?>
    <article class="weekly-product">
        <figure class="weekly-product-picture">
            <?php $src = wp_get_attachment_url( get_post_thumbnail_id($product['id'])); ?>
            <a class="weekly-product-image"
               href="<?php echo get_permalink($product['id']); ?>"
               title="<?php echo esc_attr($product['title']); ?>"
               style="background-image: url('<?php echo esc_attr($src); ?>')"></a>
        </figure>

        <div class="weekly-product-content">
            <h5 class="weekly-product-link">
                <a href="<?php echo get_permalink($product['id']); ?>" title="<?php echo esc_attr($product['title']); ?>">
                    <?php echo esc_html($product['title']); ?>
                </a>
            </h5>
        </div>
    </article>

    <article class="weekly-product">
        <figure class="weekly-product-picture">
            <?php $src = wp_get_attachment_url( get_post_thumbnail_id($product['id'])); ?>
            <a class="weekly-product-image"
               href="<?php echo get_permalink($product['id']); ?>"
               title="<?php echo esc_attr($product['title']); ?>"
               style="background-image: url('<?php echo esc_attr($src); ?>')"></a>
        </figure>

        <div class="weekly-product-content">
            <h5 class="weekly-product-link">
                <a href="<?php echo get_permalink($product['id']); ?>" title="<?php echo esc_attr($product['title']); ?>">
                    <?php echo esc_html($product['title']); ?>
                </a>
            </h5>
        </div>
    </article>

    <article class="weekly-product">
        <figure class="weekly-product-picture">
            <?php $src = wp_get_attachment_url( get_post_thumbnail_id($product['id'])); ?>
            <a class="weekly-product-image"
               href="<?php echo get_permalink($product['id']); ?>"
               title="<?php echo esc_attr($product['title']); ?>"
               style="background-image: url('<?php echo esc_attr($src); ?>')"></a>
        </figure>

        <div class="weekly-product-content">
            <h5 class="weekly-product-link">
                <a href="<?php echo get_permalink($product['id']); ?>" title="<?php echo esc_attr($product['title']); ?>">
                    <?php echo esc_html($product['title']); ?>
                </a>
            </h5>
        </div>
    </article>
<?php endif; ?>