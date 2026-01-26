<?php
/**
 * Template part for displaying the call me modal popup.
 *
 * Outputs a modal window containing a Contact Form 7 shortcode,
 * used for collecting user contact requests.
 *
 * Loaded via get_template_part().
 *
 * @package Lege
 */
?>

<div id="call" class="callme mfp-hide">
    <h4 class="login__title modal-title"><?php esc_html_e( 'Submit your application', 'lege' ); ?></h4>
    <p class="login__question modal-text"><?php esc_html_e( 'And our specialists will contact you!', 'lege' ); ?></p>

    <div id="popupOrder" class="log callme-form">
        <?php global $lege_options; echo do_shortcode($lege_options['modal_contact_shortcode']); ?>
    </div>
</div>
</div>
