<?php
/**
 * The template for displaying product search form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/product-searchform.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="widget widget_search widget_search_form">
    <form role="search" method="get" id="searchform1" class="woocommerce-product-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <input 
            class="text-search" 
            type="search" 
            value="<?php echo get_search_query(); ?>" 
            placeholder="<?php echo esc_attr__( 'Search products', 'lege' ); ?>" 
            name="s" 
            id="woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>"
        />
        <input 
            type="submit" 
            class="submit-search" 
            value="" 
        />
        <input type="hidden" name="post_type" value="product" />
    </form>
</div>
