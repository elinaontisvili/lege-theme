<?php 
if(in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {

    // Интеграция WooCommerce Шаблона
    function lege_add_woocommerce_support() {
        add_theme_support('woocommerce');
    }
    add_action('after_setup_theme', 'lege_add_woocommerce_support');

    // Enable woo's built-in Ajax fragment refresh for cart count
    add_filter('woocommerce_add_to_cart_fragments', 'lege_header_add_to_cart_fragment');
    function lege_header_add_to_cart_fragment( $fragments ) {
        global $woocommerce; 

        ob_start(); 

        echo '<a href="'.esc_url(wc_get_cart_url()).'" class="heading__bag"><svg width="17" height="20"><use xlink:href="#bag"/></svg><span class="count">'. esc_attr(WC()->cart->get_cart_contents_count()).'</span></a>';

        $fragments['a.heading__bag'] = ob_get_clean();
        return $fragments; 
    }

    // Убираем старый сайдбар и заменяем его персональным
    remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

    add_action('woocommerce_sidebar', function() {
        get_sidebar('woocommerce');
    });

    // Убираем описание в архиве товаров
    remove_action('woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10);
    remove_action('woocommerce_archive_description', 'woocommerce_product_archive_description', 10);

    // Переносим уведомление выше
    remove_action('woocommerce_before_shop_loop','woocommerce_result_count',20);
    add_action('woocommerce_archive_description','woocommerce_result_count',10);

    // Удаление Хлебных Крошек
    remove_action('woocommerce_before_main_content','woocommerce_breadcrumb',20);

    // Перенос сортировки Страницы
    remove_action('woocommerce_before_shop_loop','woocommerce_catalog_ordering',30);

    /* Карточка Продукта, Product Image */
    add_action('woocommerce_before_shop_loop_item','lege_wrapforimage_open', 5);
    add_action('woocommerce_before_shop_loop_item_title','lege_wrapforimage_close', 20);
    function lege_wrapforimage_open(){
        echo '<div class="products__img">';
    }
    function lege_wrapforimage_close(){
        echo '</div>';
    }
    
    add_action('woocommerce_before_shop_loop_item_title','woocommerce_template_loop_product_link_close', 15);
    remove_action ('woocommerce_after_shop_loop_item','woocommerce_template_loop_product_link_close', 5);
 
    add_action('woocommerce_shop_loop_item_title',function(){
        echo '<div class="products__bottom">';
    },5);
    add_action('woocommerce_after_shop_loop_item',function(){
        echo '</div>';
    },15);

    remove_action('woocommerce_shop_loop_item_title','woocommerce_template_loop_product_title',10);
    add_action('woocommerce_shop_loop_item_title','lege_product_data',10);
    function lege_product_data(){

        global $product;

        $rating_count = $product->get_rating_count();
        $average      = $product->get_average_rating();
        $title = get_the_title();
        ?>

        <div class="products__detail">
            <a href="<?php the_permalink(); ?>" class="products__name">
                <?php
                if(get_post_meta(get_the_ID(),'lege_short_title',true)){
                    echo get_post_meta(get_the_ID(),'lege_short_title',true);
                } else {
                    echo mb_substr( get_the_title(), 0, 17, 'UTF-8' );
                }  
                ?>
                </a>
            <div class="price">
                <?php echo $product->get_price_html(); ?>
            </div>
            <?php echo wc_get_rating_html( $average, $rating_count ); ?>
        </div>

    <?php }

    // Remove rating and price
    remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating',5);
    remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_price',10);


    // Sale - Display the “HOT / NEW” badge
    function lege_show_status() {
        global $product;

        if ( ! $product ) {
            return;
        }

        $product_id = $product->get_id();
        $title = get_post_meta( $product_id, 'lege_sale_button_title', true );
        $color = get_post_meta( $product_id, 'lege_sale_button_color', true );

        if ( ! empty( $title ) ) {
            $style = $color ? 'style="background:' . esc_attr( $color ) . ';"' : '';
            echo '<span class="new-item" ' . $style . '>' . esc_html( $title ) . '</span>';
        }
    }
    add_action( 'woocommerce_before_shop_loop_item', 'lege_show_status', 9 );

    // Show sale price at cart
    function my_custom_show_sale_price_at_cart( $old_display, $cart_item, $cart_item_key ) {
        /** @var WC_Product $product */
        $product = $cart_item['data'];
        if ($product) {
            return $product->get_price_html();
        }
        return $old_display;
    }
    add_filter('woocommerce_cart_item_price', 'my_custom_show_sale_price_at_cart', 10, 3 );

    // Single product page - Sku and in stock()
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40); 
    add_action('woocommerce_single_product_summary', 'lege_woo_sku_custom', 4);

    function lege_woo_sku_custom() {
        global $product;
        ?>
        <div class="product__article">
        <?php esc_html_e( 'SKU:', 'lege' ); ?>
            <span class="product__article-value"><?php echo $product->get_sku(); ?></span>
        </div>

        <div class="availability <?php echo $product->is_in_stock() ? 'true' : 'false'; ?>"> 
            <span class="true"> 
                <?php esc_html_e( 'In stock', 'lege' ); ?>
        </span>
        <span class="false" style="<?php echo $product->is_in_stock() ? 'display:none;' : ''; ?>"> 
            <?php esc_html_e( 'Out of stock', 'lege' ); ?>
    </span> 
    </div> 
    <?php
    }

    // Remove woo's stock output completetly from single product
    add_filter('woocommerce_get_stock_html', function($html, $product) {
        if( is_product() ) {
            return '';
        } else {
            return $html;
        }
    }, 10, 2);

    // Title 
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
    add_action('woocommerce_single_product_summary', 'lege_template_single_title', 5); 

    // Excerpt - remove description cpmletele
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 6);

    function lege_template_single_title() {
        if(get_post_meta(get_the_ID(), 'lege_short_title', true)) {
            echo '<h1 class="product__title">' . get_post_meta(get_the_ID(), 'lege_short_title', true) . '</h1>';
        } else {
            echo '<h1 class="product__title">' . get_the_title() . '</h1>';
        }
        if(get_the_excerpt()) {
            echo '<p class="product__desc">' . get_the_excerpt() . '</p>';
        }
    }

    // Price
    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
    add_action('woocommerce_before_add_to_cart_button', 'lege_custom_addtocart_price', 5);
    function lege_custom_addtocart_price() {
        global $product; ?>
        <div class="product__price"> 
            <?php echo $product->get_price_html(); ?> 
        </div>

        <?php }

    // Share Icons on single product page
    add_action('woocommerce_share', 'lege_custom_share', 5);
    function lege_custom_share() { 
        ?>
        <div class="share">
        <p class="share__title">
            <?php esc_html_e( 'Share:', 'lege' ); ?>
        </p>
        <ul class="social">
            <li class="social__item">
                <span><?php esc_html_e( 'Vk', 'lege' ); ?></span>
                <a data-social="vkontakte" onclick="window.open(this.href, 'Share on VK', 'width=600,height=300'); return false" class="social__icon social__icon_vk" href="<?php echo lege_get_share('vk', get_the_permalink(), get_the_title()); ?>">
                    <svg  width="21" height="18">
                        <use xlink:href="#vk"/>
                    </svg>
                </a>
            </li>
            <li class="social__item">
                <span><?php esc_html_e( 'Fb', 'lege' ); ?></span>
                <a data-social="facebook" onclick="window.open(this.href, 'Share on Facebook', 'width=600,height=300'); return false" class="social__icon social__icon_fb" href="<?php echo lege_get_share('fb', get_the_permalink(), get_the_title()); ?>">
                    <svg  width="14" height="17">
                        <use xlink:href="#facebook"/>
                    </svg>
                </a>
            </li>
            <li class="social__item">
                <span><?php esc_html_e( 'Tw', 'lege'); ?></span>
                <a data-social="twitter" onclick="window.open(this.href, 'Share on Twitter', 'width=600,height=300'); return false" class="social__icon social__icon_tw" href="<?php echo lege_get_share('twi', get_the_permalink(), get_the_title()); ?>">
                    <svg  width="18" height="15">
                        <use xlink:href="#twitter"/>
                    </svg>
                </a>
            </li>
        </ul>
        </div>
    
    <?php }

    // Change Add to Cart button text on single product page in popup modal window
    add_filter( 'woocommerce_product_single_add_to_cart_text', function( $text ) {
        return __( 'View cart', 'lege' );
    });     

    // Remove default avatar
    remove_action('woocommerce_review_before', 'woocommerce_review_display_gravatar', 10);

    /* Comment Form on Single Product Page */
    function my_custom_comment_fields( $fields ) {
        $commenter = wp_get_current_commenter();
        $req = (bool) get_option( 'require_name_email', 1 );
        $aria_req = ( $req ? " aria-required='true'" : '' );
        
        // Custom field template with <div> wrappers
        $custom_field_template = function( $field_html, $key, $field_data ) use ( $commenter, $req, $aria_req ) {
            $value = esc_attr( $commenter[ 'comment_author_' . $key ] );
            $required_html = ( $field_data['required'] ? '&nbsp;<span class="required">*</span>' : '' );
            
            return '<div class="comment-form-' . esc_attr( $key ) . ' log__group">' .
                    '<label for="' . esc_attr( $key ) . '" class="log__label">' . esc_html( $field_data['label'] ) . $required_html . '</label>' .
                    '<input id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" type="' . esc_attr( $field_data['type'] ) . '" autocomplete="' . esc_attr( $field_data['autocomplete'] ) . '" value="' . $value . '" size="30" ' . ( $field_data['required'] ? 'required' : '' ) . ' class="log__input" />' .
                '</div>';
        };

        // Modify the default fields and apply the custom template
        if ( isset( $fields['author'] ) ) {
            $fields['author'] = call_user_func( $custom_field_template, '', 'author', array(
                'label' => __( 'Name', 'lege' ),
                'type' => 'text',
                'required' => $req,
                'autocomplete' => 'name'
            ) );
        }

        if ( isset( $fields['email'] ) ) {
            $fields['email'] = call_user_func( $custom_field_template, '', 'email', array(
                'label' => __( 'Email', 'lege' ),
                'type' => 'email',
                'required' => $req,
                'autocomplete' => 'email'
            ) );
        }

        // Add your custom fields using the same structure
        $fields['lege_phone'] = '<div class="comment-form-lege_phone log__group">' .
                                    '<label for="lege_phone" class="log__label">' . __( 'Phone', 'lege' ) . '</label>' .
                                    '<input id="lege_phone" name="lege_phone" type="tel" value="" size="30" class="log__input" />' .
                                '</div>';
        
        $fields['lege_social'] = '<div class="comment-form-lege_social log__group">' .
                                    '<label for="lege_social" class="log__label">' . __( 'Social', 'lege' ) . '</label>' .
                                    '<input id="lege_social" name="lege_social" type="url" value="" size="30" class="log__input" />' .
                                '</div>';
        
        return $fields;
    }
    add_filter( 'comment_form_default_fields', 'my_custom_comment_fields' );

    // Saves the data from the custom fields to the database (phone, social)
    add_action('comment_post', 'lege_save_comment_meta_data');
    function lege_save_comment_meta_data($comment_id) {
        if(!empty($_POST['lege_phone'])) {
            $phone = preg_replace( '/[^0-9+\-\s\(\)]/', '', $_POST['lege_phone'] );
            add_comment_meta($comment_id, 'lege_phone', $phone);
        }
        if(!empty($_POST['lege_social'])) {
            $social = esc_url_raw($_POST['lege_social']);
            add_comment_meta($comment_id, 'lege_social', $social);
        }
    }

    // Show phone number, only to admins (Only validate for non-admins)
    add_filter('preprocess_comment', 'lege_validate_comment_fields');
    function lege_validate_comment_fields($commentdata) {
        if ( ! current_user_can('manage_options') ) {
            if ( empty($_POST['lege_phone']) ) {
                wp_die(__('Error: Phone field is required.', 'lege'));
            }
        }
        return $commentdata;
    }
    // Show phone number to admins only in the comment text
    add_filter('comment_text', 'lege_show_phone_to_admin', 10, 2);
    function lege_show_phone_to_admin($comment_text, $comment) {
        if ( current_user_can('manage_options') ) {
            $phone = get_comment_meta($comment->comment_ID, 'lege_phone', true);
            if ($phone) {
                $comment_text .= '<p class="phone_number_admin_style">Phone: ' . esc_html($phone) . '</p>';
            }
        }
        return $comment_text;
    }

    // Move comment field to bottom
    function lege_move_comment_field_to_bottom($fields) {
        $comment_field = $fields['comment'];
        unset($fields['comment']);
        $fields['comment'] = $comment_field; 
        return $fields;
    }
    add_filter('comment_form_fields', 'lege_move_comment_field_to_bottom');
 
    // Remove the default cookies field
    function remove_comment_cookies_field( $fields ) {
    if ( isset( $fields['cookies'] ) ) {
        unset( $fields['cookies'] );
    }
    return $fields;
    }
    add_filter( 'comment_form_fields', 'remove_comment_cookies_field' );

    /* Cart */ 

    // Move cross sell - cart page */ 
    remove_action('woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');
    add_action('woocommerce_after_cart', 'display_cross_sells_under_cart_results');
    function display_cross_sells_under_cart_results() {
        echo '<div class="cart__cross-sells">';
        woocommerce_cross_sell_display(); 
        echo '</div>';
    }

    /* Checkout */
    remove_action( 'woocommerce_checkout_terms_and_conditions', 'wc_checkout_privacy_policy_text', 20);


}




















 



    


