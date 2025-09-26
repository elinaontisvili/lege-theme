<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 10.1.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>

<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
	<?php do_action( 'woocommerce_before_cart_table' ); ?>


	<div class="shop_table shop_table_responsive cart woocommerce-cart-form__contents cart__content">
		<div class="cart__heading">
			<p class="cart__name"><?php esc_html_e('Товар', 'lege'); ?></p>
			<div class="cart__wrap">
				<p class="cart__name"><?php esc_html_e('Цена', 'lege'); ?></p>
				<p class="cart__name"><?php esc_html_e('Количество', 'lege'); ?></p>
				<p class="cart__name"><?php esc_html_e('Итого', 'lege'); ?></p>
			</div>
		</div>

<?php do_action( 'woocommerce_before_cart_contents' ); ?>

	<?php
	foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
		$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
		$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
		/**
		 * Filter the product name.
		 *
		 * @since 2.1.0
		 * @param string $product_name Name of the product in the cart.
		 * @param array $cart_item The product in the cart.
		 * @param string $cart_item_key Key for the product in the cart.
		 */
		$product_name = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );

		if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
			$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
			?>
			<div class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?> cart__row">

				<div class="cart__block cart__block_first">
					<?php
					/**
					 * Filter the product thumbnail displayed in the WooCommerce cart.
					 *
					 * This filter allows developers to customize the HTML output of the product
					 * thumbnail. It passes the product image along with cart item data
					 * for potential modifications before being displayed in the cart.
					 *
					 * @param string $thumbnail     The HTML for the product image.
					 * @param array  $cart_item     The cart item data.
					 * @param string $cart_item_key Unique key for the cart item.
					 *
					 * @since 2.1.0
					 */
					$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

					if ( ! $product_permalink ) {
						echo $thumbnail; // PHPCS: XSS ok.
					} else {
						printf( '<a href="%s" class="cart__image">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
					}
					?>

					<div class="product-name cart__desc sale">
						<div style="align-items: center; display: flex;">
					
							<?php 
							$regular_price = (float) $_product->get_regular_price(); // Regular price
							$sale_price = (float) $_product->get_price(); // Active price (the "Sale price" when on-sale)

							$precision = 1; // Max number of decimals
							$saving_percentage = round( 100 - ( $sale_price / $regular_price * 100 ), 1 ) . '%';

							if($regular_price !== $sale_price){
								echo '<span class="discount" style="margin-right: 15px;">'.$saving_percentage.'</span>';
							}

							$rating_count = $_product->get_rating_count();
							$average = $_product->get_average_rating();

							if( $rating_count ) {
								echo '<div class="rating_position">' .
								wc_get_rating_html( $average, $rating_count ) . '</div>';
							} 
							?>
						</div> 
						<?php 
						do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

						if ( ! $product_permalink ) {
							echo wp_kses_post( $product_name . '&nbsp;' );
						} else {
							/**
							 * This filter is documented above.
							 *
							 * @since 2.1.0
							 */
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s" class="cart__product">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
						}

						// Meta data.
						echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

						// Backorder notification.
						if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'lege' ) . '</p>', $product_id ) );
						}
						?>
					</div>

				</div>
				<div class="cart__block cart__block_second">
					<div class="product-price price">

						<?php
							echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
						?>
					</div>
					<div class="product-quantity">

						<?php
						if ( $_product->is_sold_individually() ) {
							$min_quantity = 1;
							$max_quantity = 1;
						} else {
							$min_quantity = 0;
							$max_quantity = $_product->get_max_purchase_quantity();
						}

						$product_quantity = woocommerce_quantity_input(
							array(
								'input_name'   => "cart[{$cart_item_key}][qty]",
								'input_value'  => $cart_item['quantity'],
								'max_value'    => $max_quantity,
								'min_value'    => $min_quantity,
								'product_name' => $product_name,
							),
							$_product,
							false
						);

						echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
						?>

					</div>
					<div class="product-subtotal cart__cost">
						<?php
							echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
						?>
					</div>

						<div class="product-remove cart__action">
						<?php
						echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							'woocommerce_cart_item_remove_link',
							sprintf(
								'<a role="button" href="%s" class="remove cart__del" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
								esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
								/* translators: %s is the product name */
								esc_attr( sprintf( __( 'Remove %s from cart', 'lege' ), wp_strip_all_tags( $product_name ) ) ),
								esc_attr( $product_id ),
								esc_attr( $_product->get_sku() )
							),
							$cart_item_key
						);
					?>
					</div>
				</div>
			</div>
			<?php 
		}
	}
	?>
	<?php do_action( 'woocommerce_cart_contents' ); ?>

		<div class="cart__result">	
			
			<div class="promo"> 
				<div class="coupon">
				<?php if ( wc_coupons_enabled() ) { ?>
					<label for="coupon_code" class="screen-reader-text"><?php esc_html_e( 'Coupon:', 'lege' ); ?></label> 
					<input type="text" name="coupon_code" class="input-text promo__input log__input" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'lege' ); ?>" /> 

					<button type="submit" class="button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?> bnt_woo promo__btn button" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'lege' ); ?>"><?php esc_html_e( 'Apply coupon', 'lege' ); ?></button>

					<?php do_action( 'woocommerce_cart_coupon' ); ?>
					<?php } ?>	
				</div>
			</div>
			
			<button type="submit" class="button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?> bnt_woo promo__btn" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'lege' ); ?>"><?php esc_html_e( 'Update cart', 'lege' ); ?></button>

			<?php do_action( 'woocommerce_cart_actions' ); ?>

			<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>

		</div> 
			
		<?php do_action( 'woocommerce_after_cart_contents' ); ?>


</div> 
	<?php do_action( 'woocommerce_after_cart_table' ); ?>

</form>

<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>
				
<div class="cart-collaterals">
	<?php
		/**
		 * Cart collaterals hook.
		 *
		 * @hooked woocommerce_cross_sell_display
		 * @hooked woocommerce_cart_totals - 10
		 */
		do_action( 'woocommerce_cart_collaterals' );
	?>
</div>

<?php do_action( 'woocommerce_after_cart' ); ?>
