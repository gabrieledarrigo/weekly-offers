<p>
    <label for="<?php echo esc_attr($fields['id']); ?>">
        Inserisci l'id del prodotto
    </label>

    <input class="widefat" id="<?php echo esc_attr($fields['id']); ?>"
           name="<?php echo esc_attr($fields['name']); ?>" type="number"
           value="<?php echo esc_attr(empty($product) ? '' : $product['id']); ?>"/>

    <?php if(empty($product)): ?>
        <div>
            Non esiste nessun prodotto con questo id.
        </div>
    <?php else : ?>
        <div>
            <h4>
                <a href="<?php echo esc_attr(get_post_permalink($product['id']))?>">
                    Titolo: <?php echo esc_attr($product['title']);?>
                </a>
            </h4>
            <?php if(empty($product['externalLink'])): ?>
                <h4>
                    Questo prodotto non ha un link allo shop.
                </h4>
            <?php else: ?>
                <h4>
                    <a href="<?php echo esc_attr($product['externalLink']);?>">
                        Link shop: <?php echo esc_attr($product['externalLink']);?>
                    </a>
                </h4>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</p>



