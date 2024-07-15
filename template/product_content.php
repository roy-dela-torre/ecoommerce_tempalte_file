<?php $img = get_stylesheet_directory_uri() . '/assets/img/global'; ?>
<div class="product_content <?php echo ($product->get_stock_status() === "outofstock") ? 'outofstock' : '' ?> bg-white">
    <?php if (!empty($video_iframe)) : ?>
        <div class="iframe d-none">
            <?php echo $video_iframe; ?>
        </div>
    <?php endif; ?>
    <div class="product_image position-relative">
        <img src="<?php echo $img_url ?>" alt="<?php echo $title; ?>" class="featured_img w-100">
        <div class="absolute_button position-absolute justify-content-end">
            <?php if (is_page('wishlist')) : ?>
                <?php if ($show_remove_product) : ?>
                    <div class="product-remove">
                        <span class="nobr">
                            <a href="<?php echo esc_url($item->get_remove_url()); ?>" class="remove remove_from_wishlist" title="<?php echo esc_html(apply_filters('yith_wcwl_remove_product_wishlist_message_title', __('Remove this product', 'yith-woocommerce-wishlist'))); ?>">
                                &times;
                            </a>
                        </span>
                    </div>
                <?php endif; ?>
            <?php else : ?>
                <?php echo do_shortcode('[yith_wcwl_add_to_wishlist]') ?>
            <?php endif; ?>
        </div>
        <div class="group_button_on_hover">
            <div class="view d-flex flex-column align-items-center position-relative">
                <?php echo file_get_contents($img . '/view.svg'); ?>
                <a href="<?php echo $product_url; ?>" target="_blank" rel="noopener noreferrer" class="stretched-link view">
                    View
                </a>
            </div>
            <?php if (!empty($video_iframe)) : ?>
                <div class="play d-flex flex-column align-items-center">
                    <?php echo file_get_contents($img . '/play.svg'); ?>
                    <span class="play">Play</span>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="product_main_content">
        <h5 class="text-center product_title"><?php echo $title; ?></h5>
        <div class="product_reviews d-flex align-items-center justify-content-center">
            <?php
            $total_reviews = $product->get_review_count();
            for ($i = 1; $i <= 5; $i++) : ?>
                <?php if ($i <= $total_reviews) : ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="19" viewBox="0 0 20 19" fill="#FFD600">
                        <path d="M10 0.5L12.2451 7.40983H19.5106L13.6327 11.6803L15.8779 18.5902L10 14.3197L4.12215 18.5902L6.36729 11.6803L0.489435 7.40983H7.75486L10 0.5Z" />
                    </svg>
                <?php else : ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="19" viewBox="0 0 20 19" fill="#A9A9A9">
                        <path d="M10 0.5L12.2451 7.40983H19.5106L13.6327 11.6803L15.8779 18.5902L10 14.3197L4.12215 18.5902L6.36729 11.6803L0.489435 7.40983H7.75486L10 0.5Z" />
                    </svg>
                <?php endif; ?>
            <?php endfor; ?>
            <div class="review_summary">
                <span><?php echo number_format($total_reviews, 1); ?></span>
            </div>
        </div>
        <p class="price <?php echo $product->is_on_sale() ? "sale" : "" ?>">
            <?php echo $price; ?>
        </p>
    </div>
    <div class="add_to_cart">
        <?php echo do_shortcode('[add_to_cart id="' . $product->get_id() . '"]'); ?>
    </div>
</div>