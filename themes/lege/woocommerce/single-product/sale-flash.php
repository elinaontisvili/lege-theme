<?php
/**
 * Single Product Sale Flash
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/sale-flash.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product;

if ( $product->is_on_sale() ) :

	$discount = lege_get_product_discount_percentage( $product );

if ( $discount ) {
	echo apply_filters(
		'woocommerce_sale_flash',
		'<span class="discount">-' . esc_html( $discount ) . '%</span>',
		$post,
		$product
	);
}

endif;

// HOT / NEW badge 
$status = get_post_meta(get_the_ID(), 'lege_sale_button_title', true);
$color = get_post_meta(get_the_ID(), 'lege_sale_button_color', true);

if ($status) {
	echo '<span class="new-item" style="background:'.esc_attr($color).'">' . esc_html($status) . '</span>';
}

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
