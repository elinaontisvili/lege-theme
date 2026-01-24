<?php
if ( ! defined( 'ABSPATH' ) ) exit; 

global $product;
if ( ! is_object( $product ) && isset( $args['product'] ) ) {
    $product = $args['product'];
}

if ( ! $product ) return;
?>

<div class="result__block simple-custom-popup-layout simple-product">
    <div class="result__image">
        <?php echo $product->get_image( 'thumbnail' ); ?>
    </div>

    <div class="result__desc">

        <h3 class="result__title"><?php echo $product->get_name(); ?></h3>

        <form class="product__form product__form_popup_simple" method="post" enctype='multipart/form-data'>

            <div class="result__price">
                <?php echo $product->get_price_html(); ?>
            </div>
            
            <?php woocommerce_quantity_input(  array(
                'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
                'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
                'input_value' => isset( $_POST['quantity'] )
                    ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) )
                    : $product->get_min_purchase_quantity(),
                'classes'     => array( 'input-text', 'qty' ),
                'input_attrs' => array(
                    'data-price' => wc_get_price_to_display( $product ),
                ),
            )); ?>

            <div class="result__cost">
                <p><?php echo esc_html__('Total:', 'lege'); ?></p> <?php echo get_woocommerce_currency_symbol(); ?><span><?php echo $product->get_price(); ?></span>
            </div>
            
            <button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button click__link link-more button">
                <svg width="18" height="20"> 
                    <use xlink:href="#nav-right"/>
                </svg>
                <?php echo esc_html( $product->single_add_to_cart_text() ); ?>
            </button>

        </form>
    </div>
</div>