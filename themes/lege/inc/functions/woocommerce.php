<?php 
if(in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {

    function lege_add_woocommerce_support() {
        add_theme_support('woocommerce');
    }
    add_action('after_setup_theme', 'lege_add_woocommerce_support');

    //Убираем старый сайдбар и заменяем его персональным
    remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

    add_action('woocommerce_sidebar', function() {
        get_sidebar('woocommerce');
    });

    // Убираем описание в архиве товаров
    remove_action('woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10);
    remove_action('woocommerce_archive_description', 'woocommerce_product_archive_description', 10);

    //Переносим уведомление выше (woocommerce_result_count hook)
    remove_action('woocommerce_before_shop_loop','woocommerce_result_count',20);
    add_action('woocommerce_archive_description','woocommerce_result_count',10);

    //Удаление Хлебных Крошек
    remove_action('woocommerce_before_main_content','woocommerce_breadcrumb',20);

    //Перенос сортировки Страницы
    remove_action('woocommerce_before_shop_loop','woocommerce_catalog_ordering',30);

    //Карточка Продукта, Product Image

       //Create new hook to wrap product image in <di> tag and add custom class
       //add <div> wrapper with class products__img
    add_action('woocommerce_before_shop_loop_item','lege_wrapforimage_open', 5); //open wrapper
    add_action('woocommerce_before_shop_loop_item_title','lege_wrapforimage_close', 20); //close wrapper
    function lege_wrapforimage_open(){
        echo '<div class="products__img">';
    }
    function lege_wrapforimage_close(){
        echo '</div>';
    }

        //wrap <a> tag around product image
    add_action('woocommerce_before_shop_loop_item_title','woocommerce_template_loop_product_link_close', 15);
    remove_action ('woocommerce_after_shop_loop_item','woocommerce_template_loop_product_link_close', 5);
 

    //wrap in <div> tag and add custom class to product item
    //add <div> wrapper with class products__bottom
    add_action('woocommerce_shop_loop_item_title',function(){
        echo '<div class="products__bottom">';
    },5);
    add_action('woocommerce_after_shop_loop_item',function(){
        echo '</div>';
    },15);

    //add <div> wrapper with class products__detail
    remove_action('woocommerce_shop_loop_item_title','woocommerce_template_loop_product_title',10);
    add_action('woocommerce_shop_loop_item_title','lege_product_data',10);
    function lege_product_data(){
        global $product;
        $rating_count = $product->get_rating_count();
        $average      = $product->get_average_rating();
        $title = get_the_title();
        ?>

        <!--
        <div class="products__detail">
           <a href="<?php //the_permalink(); ?>" class="products__name"><?php //the_title(); ?></a>
           <div class="price">
                <div class="price__old"><span class="currency">$</span>89</div>
                <div class="price__now"><span class="currency">$</span>67</div>
           </div>
           <div class="rate"></div> 
        </div>
        -->
        <div class="products__detail">
            <a href="<?php the_permalink(); ?>" class="products__name"><?php
                if(get_post_meta(get_the_ID(),'lege_short_title',true)){
                    echo get_post_meta(get_the_ID(),'lege_short_title',true);
                } else {
                    /* echo $title; 
                    echo strlen($title) > 17 ? substr($title, 0, 17) : $title; */
                    echo mb_substr( get_the_title(), 0, 17, 'UTF-8' );
                    
                    /* echo wp_trim_words( get_the_title(), 3, '...' ); //trim by words */
                }  ?>
                </a>
            <div class="price">
                <?php echo $product->get_price_html(); ?>
            </div>
            <?php echo wc_get_rating_html( $average, $rating_count ); ?>
        </div>

    <?php }

        //remove rating and price
    remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating',5);
    remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_price',10);
}

//Sale 
function lege_show_status(){
    if(get_post_meta(get_the_ID(),'lege_sale_button_title',true)){
        $color = '';
        if(get_post_meta(get_the_ID(),'lege_sale_button_color',true)){
            $color = 'style="background:'.get_post_meta(get_the_ID(),'lege_sale_button_color',true).'"';
        }
        echo '<span class="new-item" '.$color.'>'.get_post_meta(get_the_ID(),'lege_sale_button_title',true).'</span>';
    }
}
add_action('woocommerce_before_shop_loop_item', 'lege_show_status', 9);

function my_custom_show_sale_price_at_cart( $old_display, $cart_item, $cart_item_key ) {
    /** @var WC_Product $product */
    $product = $cart_item['data'];
    if ($product) {
        return $product->get_price_html();
    }
    return $old_display;
}
add_filter('woocommerce_cart_item_price', 'my_custom_show_sale_price_at_cart', 10, 3 );
