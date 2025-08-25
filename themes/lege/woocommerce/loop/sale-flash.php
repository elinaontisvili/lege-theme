<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product;

?>
<?php if ( $product->is_on_sale() ) :

    $regular_price = (float) wc_get_price_to_display( $product, [ 'price' => $product->get_regular_price() ] );
    $sale_price    = (float) wc_get_price_to_display( $product, [ 'price' => $product->get_sale_price() ] );

    if ( $regular_price > 0 && $sale_price > 0 ) {
        $percentage = ( ( $regular_price - $sale_price ) / $regular_price ) * 100;

        $saving_percentage = round( $percentage ); // nearest
    
        echo apply_filters(
            'woocommerce_sale_flash',
            '<span class="discount">-' . $saving_percentage . '%</span>',
            $post,
            $product
        );
    } ?>
    
<?php endif;
/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
