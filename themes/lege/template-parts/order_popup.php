<div id="one-click" class="click mfp-hide">
    <div class="click__form log order-form">

        <div class="click__half">
            <p class="click__head"><?php esc_html_e('Купить в один клик','lege'); ?></p>
            <p class="click__text">
                <?php esc_html_e('Оставьте свои контакнтые данные и мы свяжемся с вами в ближайшее время для уточнения заказа', 'lege'); ?>
            </p>

            <?php
            global $lege_options;
            echo do_shortcode( $lege_options['modal_order_shortcode'] );
            ?>
        </div>

        <div class="click__half">
            <p class="click__info"><?php esc_html_e('Информация о заказе', 'lege'); ?></p>

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
    <p class="sub__thank"><?php esc_html_e( 'Спасибо!', 'lege' ); ?></p>
    <p class="sub__text"><?Php esc_html_e( 'Ваша заявка принята. Наши специалисты свяжутся с вами в ближайшее время.', 'lege'); ?></p>
</div>