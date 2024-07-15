<?php

/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_mini_cart'); ?>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/inc/css/mini-cart.css">
<?php if (!WC()->cart->is_empty()) : ?>
	<div class="header d-flex align-items-center justify-content-between">
		<h3 class="mb-0">Your Cart</h3>
		<span class="close">
			<svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
				<g clip-path="url(#clip0_1752_74741)">
					<path d="M2.93008 17.5701C1.97498 16.6476 1.21316 15.5442 0.689065 14.3241C0.164975 13.1041 -0.110887 11.7919 -0.122425 10.4641C-0.133963 9.1363 0.119054 7.8195 0.621863 6.59054C1.12467 5.36158 1.8672 4.24506 2.80613 3.30613C3.74506 2.3672 4.86158 1.62467 6.09054 1.12186C7.3195 0.619054 8.6363 0.366037 9.96409 0.377575C11.2919 0.389113 12.6041 0.664975 13.8241 1.18907C15.0442 1.71316 16.1476 2.47498 17.0701 3.43008C18.8917 5.3161 19.8996 7.84212 19.8768 10.4641C19.854 13.0861 18.8023 15.5942 16.9483 17.4483C15.0942 19.3023 12.5861 20.354 9.96409 20.3768C7.34212 20.3996 4.8161 19.3917 2.93008 17.5701ZM11.4001 10.5001L14.2301 7.67008L12.8201 6.26008L10.0001 9.09008L7.17008 6.26008L5.76008 7.67008L8.59008 10.5001L5.76008 13.3301L7.17008 14.7401L10.0001 11.9101L12.8301 14.7401L14.2401 13.3301L11.4101 10.5001H11.4001Z" fill="#212121" />
				</g>
				<defs>
					<clipPath id="clip0_1752_74741">
						<rect width="20" height="20" fill="white" transform="translate(0 0.5)" />
					</clipPath>
				</defs>
			</svg>
		</span>
	</div>

	<ul class="woocommerce-mini-cart cart_list product_list_widget <?php echo esc_attr($args['list_class']); ?>">
		<?php
		do_action('woocommerce_before_mini_cart_contents');

		foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {

			$_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
			$product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

			if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key)) {
				$product_name      = apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key);
				$thumbnail         = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);
				$product_price     = apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key);
				$product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);

		?>
				<div data-ic_product_id="<?php echo esc_attr($product_id); ?>" data-key="<?php echo $cart_item_key; ?>" class="test woocommerce-mini-cart-item <?php echo esc_attr(apply_filters('woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key)); ?>">

					<div class="main_product">
						<div class="product_image">
							<?php if (empty($product_permalink)) : ?>
								<?php echo $thumbnail; ?>
							<?php else : ?>
								<a href="<?php echo esc_url($product_permalink); ?>">
									<?php echo $thumbnail; ?>
								</a>
							<?php endif; ?>
						</div>

						<div class="product_name">
							<?php echo wp_kses_post($product_name); ?>
							<p class="price">
								<?php
								$product_price = apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($cart_item['data']), $cart_item, $cart_item_key);
								echo $product_price;
								?>
							</p>
						</div>
					</div>

					<div class="quantity_remove">
						<div class="ic-mini-cart-count-price ic-mini-cart-title-input">
							<?php


							echo woocommerce_quantity_input(
								array(
									'input_value' => $cart_item['quantity'],
								),
								$cart_item['data'],
								false
							);
							?>

							<!-- <div class="ic-custom-render-total">
							<? //php echo get_woocommerce_currency_symbol() . $cart_item['line_total']; 
							?>
						</div> -->
						</div>

						<?php echo wc_get_formatted_cart_item_data($cart_item); ?>

						<?php
						echo apply_filters(
							'woocommerce_cart_item_remove_link',
							sprintf(
								'<a href="%s" class="remove remove_from_cart_button" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s">remove</a>',
								esc_url(wc_get_cart_remove_url($cart_item_key)),
								esc_attr__('Remove this item', 'woocommerce'),
								esc_attr($product_id),
								esc_attr($cart_item_key),
								esc_attr($_product->get_sku())
							),
							$cart_item_key
						);
						?>
					</div>
				</div>
		<?php
			}
		}

		do_action('woocommerce_mini_cart_contents');
		?>
	</ul>

	<p class="woocommerce-mini-cart__total total">
		<?php
		/**
		 * Hook: woocommerce_widget_shopping_cart_total.
		 *
		 * @hooked woocommerce_widget_shopping_cart_subtotal - 10
		 */
		do_action('woocommerce_widget_shopping_cart_total');
		?>
	</p>

	<?php do_action('woocommerce_widget_shopping_cart_before_buttons'); ?>

	<p class="woocommerce-mini-cart__buttons buttons"><?php do_action('woocommerce_widget_shopping_cart_buttons'); ?></p>

	<?php do_action('woocommerce_widget_shopping_cart_after_buttons'); ?>

<?php else : ?>

	<p class="woocommerce-mini-cart__empty-message"><?php esc_html_e('No products in the cart.', 'woocommerce'); ?></p>

<?php endif; ?>

<?php do_action('woocommerce_after_mini_cart'); ?>