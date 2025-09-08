<?php global $product; ?> 

<div id="one-click" class="click mfp-hide">
    <div id="popupOrder" class="click__form log order-form">
        <div class="click__half">
            <p class="click__head">Купить в один клик</p>
            <p class="click__text">Оставьте свои контакнтые данные и мы свяжемся с вами в ближайшее время для уточнения заказа</p>
            <div class="log__group">
                <label>Имя</label>
                <input type="text" name="name" class="log__input">
            </div>
            <div class="log__group">
                <label>Телефон</label>
                <input type="tel" name="tel" class="log__input">
            </div>
            <div class="log__btn">
                <input id="ordered" type="submit" data-submit value="Отправить" class="btn"/>
            </div>
        </div>
        <div class="click__half">
            <p class="click__info">Информация о заказе</p>

            <?php //print_r( $product ); ?>

            <div class="result">
                <div class="result__block">
                    <a href="<?php the_permalink(); ?>" class="result__image">
                        <?php echo get_the_post_thumbnail(get_the_ID(),'thumbnail'); ?>
                    </a>

                <form class="product__form" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>

                        <div class="result__desc">
                            <a href="<?php the_permalink(); ?>" class="result__title">
                                <?php
                                if(get_post_meta(get_the_ID(),'lege_short_title',true)){
                                    echo get_post_meta(get_the_ID(),'lege_short_title',true);
                                } else {
                                    echo get_the_title();
                                }
                                ?>
                            </a>
                            <div class="result__price">
                                <?php  
                                if ( $product ) {
                                    echo $product->get_price_html(); 
                                } ?>
                            </div>
                            
                            <?php
                            do_action( 'woocommerce_before_add_to_cart_quantity' );
                                /*
                                woocommerce_quantity_input( array(
                                    'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
                                    'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
                                    'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
                                    'classes'     => array( 'input-text', 'qty'),
                                    'input_attrs' => array(
                                        //'data-price' => $product->get_price(),
                                        'data-price' => wc_get_price_to_display($product),
                                        ),
                                    ) );
                                    */ 

                                woocommerce_quantity_input( array(
                                    'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
                                    'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
                                    'input_value' => isset( $_POST['quantity'] )
                                        ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) )
                                        : $product->get_min_purchase_quantity(),
                                    'classes'     => array( 'input-text', 'qty' ),
                                    'input_attrs' => array(
                                        'data-price' => wc_get_price_to_display( $product ),
                                    ),
                                ) );

                            do_action( 'woocommerce_after_add_to_cart_quantity' );
                            ?>

                            <div class="result__cost">
                                <p>Итого:</p> <?php echo get_woocommerce_currency_symbol(); ?><span><?php echo $product->get_price(); ?></span>
                            </div>
    
                            <button type="submit" 
                                    name="add-to-cart"
                                    value="<?php echo esc_attr( $product->get_id()); ?>" 
                                    class="single_add_to_cart_button button click__link link-more alt<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>">
                                <svg width="18" height="20"> 
                                    <use xlink:href="#nav-right"/>
                                </svg>
                                <?php echo esc_html($product->single_add_to_cart_text()); ?>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Thank you popup -->
<div id="taken" class="sub mfp-hide">
    <p class="sub__thank">Спасибо!</p>
    <p class="sub__text">Ваша заявка принята. Наши специалисты свяжутся с вами в ближайшее время.</p>
</div>