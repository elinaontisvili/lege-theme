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

	$regular_price = (float) wc_get_price_to_display( $product, [ 'price' => $product->get_regular_price() ] ); 
	$sale_price    = (float) wc_get_price_to_display( $product, [ 'price' => $product->get_sale_price() ] ); 

	if ( $regular_price > 0 && $sale_price > 0 ) {
		$percentage = ( ( $regular_price - $sale_price ) / $regular_price ) * 100;
		$saving_percentage = round( $percentage ); 
		echo apply_filters(
			'woocommerce_sale_flash', 
			'<span class="discount_sale">-' . $saving_percentage . '%</span>',
			$post, 
			$product
		);
	}

endif;

// HOT / NEW badge 
$status = get_post_meta(get_the_ID(), 'lege_sale_button_title', true);
$color = get_post_meta(get_the_ID(), 'lege_sale_button_color', true);

if ($status) {
	echo '<span class="new-item_sale" style="background:'.esc_attr($color).'">' . esc_html($status) . '</span>';
}

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
