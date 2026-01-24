<?php
/**
 * Single variation cart button
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 10.2.0
 */

defined( 'ABSPATH' ) || exit;

global $product;
?>

<div class="product__form woocommerce-variation-add-to-cart variations_button">
	<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
    
    <?php 
	do_action( 'woocommerce_before_add_to_cart_quantity' );

    woocommerce_quantity_input( array(
        'min_value'   => $product->get_min_purchase_quantity(),
		'max_value'   => $product->get_max_purchase_quantity(),
		'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
    ) ); 

	do_action( 'woocommerce_after_add_to_cart_quantity' );
    ?>

<div class="product__btns">
	<button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button product__btn btn">
		<?php echo esc_html( $product->single_add_to_cart_text() ); ?>
	</button>

	<a href="#one-click"
		class="product__btn btn popup-link-quickview buy-in-one-click-btn-hide-on-popup"
		data-product-id="<?php echo esc_attr( $product->get_id() ); ?>">
		<?php esc_html_e( 'Buy in one click', 'lege' ); ?>
	</a>
</div>
	<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

	<input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="variation_id" class="variation_id" value="0" />
</div>
