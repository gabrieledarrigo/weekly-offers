<?php if (!empty($product)):?>
    <article class="weekly-product">
        <figure class="weekly-product-picture">
            <?php $src = wp_get_attachment_url( get_post_thumbnail_id($product['id'])); ?>
            <a class="weekly-product-image"
               href="<?php echo esc_attr($product['externalLink']); ?>"
               title="<?php echo esc_attr($product['title']); ?>"
               style="background-image: url('<?php echo esc_attr($src); ?>')"></a>
        </figure>

        <div class="weekly-product-content">
            <h5 class="weekly-product-link">
                <a href="<?php echo esc_attr($product['externalLink']); ?>" title="<?php echo esc_attr($product['title']); ?>">
                    <?php echo esc_html($product['title']); ?>
                </a>
            </h5>

            <?php if (!empty($product['price'])) : ?>
                <h5 class="weekly-product-price">
                    <a href="<?php echo esc_attr($product['externalLink']); ?>" title="Prezzo">
                        <?php echo esc_html($product['price']); ?> €
                    </a>
                </h5>
            <?php endif; ?>

            <footer class="weekly-product-footer">
                <a class="weekly-product-buy" href="<?php echo esc_attr($product['externalLink']); ?>" title="<?php echo esc_attr($product['title']); ?>">
                    Acquista
                </a>
            </footer>
        </div>
    </article>
<?php endif; ?>


