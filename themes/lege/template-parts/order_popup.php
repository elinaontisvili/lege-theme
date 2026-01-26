<?php
/**
 * Template part for displaying the "Buy in One Click" modal popup.
 *
 * Outputs the main modal layout containing:
 * - A contact/order form (via shortcode)
 * - An AJAX-loaded product information section
 * - A confirmation ("Thank you") popup
 *
 * Used as a wrapper popup for quick purchase functionality.
 *
 * @package Lege
 */
?>

<div id="one-click" class="click mfp-hide">
    <div class="click__form log order-form">

        <div class="click__half">
            <p class="click__head"><?php esc_html_e('Buy in one click','lege'); ?></p>
            <p class="click__text">
                <?php esc_html_e('Leave your contact information and we will contact you shortly to clarify your order', 'lege'); ?>
            </p>

            <?php
            global $lege_options;
            echo do_shortcode( $lege_options['modal_order_shortcode'] );
            ?>
        </div>

        <div class="click__half">
            <p class="click__info"><?php esc_html_e('Order information', 'lege'); ?></p>

            <!-- AJAX target -->
            <div class="result js-popup-product">
                <div class="popup-loader">
                    <?php esc_html_e( 'Loading…', 'lege' ); ?>
                </div>
            </div>

        </div>

    </div>
</div>

<!-- Thank you popup -->
<div id="taken" class="sub mfp-hide">
    <p class="sub__thank"><?php esc_html_e( 'Thank you!', 'lege' ); ?></p>
    <p class="sub__text"><?Php esc_html_e( 'Your request has been accepted. Our specialists will contact you shortly.', 'lege'); ?></p>
</div>