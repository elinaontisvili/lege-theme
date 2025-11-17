<!-- Call me Modal Window --> 
 <div id="call" class="callme mfp-hide">
    <h4 class="login__title modal-title"><?php esc_html_e( 'Отправьте заявку', 'lege' ); ?></h4>
    <p class="login__question modal-text"><?php esc_html_e( 'И наши специалисты свяжутся с вами!', 'lege' ); ?></p>
 
<div id="popupOrder" class="log callme-form">
        <?php global $lege_options; echo do_shortcode($lege_options['modal_contact_shortcode']); ?>
    </div>
</div>
</div>
