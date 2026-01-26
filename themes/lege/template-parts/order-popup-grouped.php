<?php
/**
 * Template part for displaying grouped product content inside the order popup.
 *
 * Outputs product image, title, and grouped product
 * add-to-cart form for selecting multiple child products.
 *
 * Only renders for grouped product types.
 *
 * @package Lege
 */
?>

<?php
if ( ! defined( 'ABSPATH' ) ) exit;

global $product;

if ( ! $product || ! $product->is_type( 'grouped' ) ) {
    return;
}
?>

<div class="result__block grouped-custom-popup-layout grouped-product is-popup">

    <div class="result__image">
        <?php echo $product->get_image( 'thumbnail' ); ?>
    </div>

    <div class="result__desc">

        <h3 class="result__title">
            <?php echo esc_html( $product->get_name() ); ?>
        </h3>

        <div class="result__grouped">
            <?php woocommerce_grouped_add_to_cart(); ?>
        </div>

    </div>
</div>
