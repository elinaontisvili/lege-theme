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
}

