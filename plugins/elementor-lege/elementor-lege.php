<?php 
/**
 * Plugin Name: Elementor Lege
 * Description: Elementor Lege Addons
 * Version: 1.0.0
 * Author: Elina Ontisvili 
 * Author URI: https://github.com/elinaontisvili
 * Text Domain: elementor-lege 
 * 
 * Requires Plugins: elementor
 * Elementor tested up to: 3.33.2
 * Elementor Pro tested up to: 3.33.2
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function register_elementor_lege_widget( $widgets_manager ) {

    require_once( __DIR__ . '/widgets/help-widget.php' );
    require_once( __DIR__ . '/widgets/why-us-widget.php' );
    require_once( __DIR__ . '/widgets/cta-widget.php' );
    require_once( __DIR__ . '/widgets/cases-widget.php' );
    require_once( __DIR__ . '/widgets/testimonials-widget.php' );

    $widgets_manager->register( new \Elementor_Help_Widget() ); 
    $widgets_manager->register( new \Elementor_Why_Us_Widget() );
    $widgets_manager->register( new \Elementor_CTA_Widget() );
    $widgets_manager->register( new \Elementor_Cases_Widget() );
    $widgets_manager->register( new \Elementor_Testimonials_Widget() );

}
add_action( 'elementor/widgets/register', 'register_elementor_lege_widget' );

// Add Category 
add_action( 'elementor/elements/categories_registered', function( $elements_manager ) {
    $elements_manager->add_category(
        'lege-widgets',
        [
            'title' => __( 'Lege Category', 'elementor-lege' ),
            'icon' => 'fa fa-plug',
        ]
    );
});