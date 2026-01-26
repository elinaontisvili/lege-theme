
<?php
/**
 * Template part for displaying variable product content inside the order popup.
 *
 * Outputs product image, title, and WooCommerce variable
 * add-to-cart form with attribute selection.
 *
 * Only renders for variable product types.
 *
 * @package Lege
 */
?>

<?php
if ( ! defined( 'ABSPATH' ) ) exit; 
global $product;

if ( ! $product || ! $product->is_type( 'variable' ) ) return;

?>

<div class="result__block variable-custom-popup-layout variable-product is-popup">
    
    <div class="result__image">
        <?php echo $product->get_image( 'thumbnail' ); ?>
    </div>

    <div class="result__desc">
        <h3 class="result__title"><?php echo $product->get_name(); ?></h3>

        <div class="result__variations">
            <?php echo woocommerce_variable_add_to_cart(); ?>
        </div>

</div>