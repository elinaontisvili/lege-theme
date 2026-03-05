<?php 
/**
 * Plugin Name: Elementor Lege
 * Description: Elementor Lege Addons
 * Version: 1.0.0
 * Author: Elina Ontisvili 
 * Author URI: https://github.com/elinaontisvili
 * Text Domain: elementor-lege 
 * * Requires Plugins: elementor
 * Elementor tested up to: 3.33.2
 * Elementor Pro tested up to: 3.33.2
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Elementor_Lege {

    public function __construct() {
        // Load translation
        add_action( 'init', [ $this, 'load_textdomain' ] );

        // Register styles
        add_action( 'wp_enqueue_scripts', [ $this, 'register_widget_styles' ] );

        // Register Category
        add_action( 'elementor/elements/categories_registered', [ $this, 'register_categories' ] );

        // Register widgets
        add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );

        // Hook for scripts
        add_action( 'elementor/frontend/after_register_scripts', [ $this, 'register_widget_scripts' ] );
    }

    /**
     * Register widget-specific scripts
     */
    public function register_widget_scripts() {
        $url = plugin_dir_url( __FILE__ );
        $path = plugin_dir_path( __FILE__ );

        if ( file_exists( $path . 'assets/js/circular-progress.js' ) ) {
            wp_register_script(
                'lege-circular-progress',
                $url . 'assets/js/circular-progress.js',
                [ 'jquery' ],
                filemtime( $path . 'assets/js/circular-progress.js' ),
                true
            );
        }

        if ( file_exists( $path . 'assets/js/team-slide.js' ) ) {
            wp_register_script(
                'lege-team-slide',
                $url . 'assets/js/team-slide.js',
                [ 'jquery' ],
                filemtime( $path . 'assets/js/team-slide.js' ),
                true
            );
        }
    }

    /**
     * Load plugin textdomain for translations
     */
    public function load_textdomain() {
        load_plugin_textdomain(
            'elementor-lege',
            false,
            dirname( plugin_basename( __FILE__ ) ) . '/languages'
        );
    }

    /**
     * Register widget-specific styles
     */
    public function register_widget_styles() {
        $base = plugin_dir_path( __FILE__ );
        $url  = plugin_dir_url( __FILE__ );

        if ( file_exists( $base . 'assets/css/news-widget.css' ) ) {
            wp_register_style(
                'lege-news-widget',
                $url . 'assets/css/news-widget.css',
                [],
                filemtime( $base . 'assets/css/news-widget.css' )
            );
        }

        if ( file_exists( $base . 'assets/css/services-widget.css' ) ) {
            wp_register_style(
                'lege-services-widget',
                $url . 'assets/css/services-widget.css',
                [],
                filemtime( $base . 'assets/css/services-widget.css' )
            );
        }

        if ( file_exists( $base . 'assets/css/team-widget.css' ) ) {
            wp_register_style(
                'lege-team-widget',
                $url . 'assets/css/team-widget.css',
                [],
                filemtime( $base . 'assets/css/team-widget.css' )
            );
        }
    }

    /**
     * Register Custom Elementor Category
     */
    public function register_categories( $elements_manager ) {
        $elements_manager->add_category(
            'lege-widgets',
            [
                'title' => __( 'Lege Widgets', 'elementor-lege' ),
                'icon' => 'fa fa-plug',
            ]
        );
    }

    /**
     * Require and Register Widgets
     */
    public function register_widgets( $widgets_manager ) {
        $widgets_path = __DIR__ . '/widgets/';

        // List of widget files and class names
        $widgets = [
            'help-widget.php'        => 'Elementor_Help_Widget',
            'why-us-widget.php'      => 'Elementor_Why_Us_Widget',
            'cta-widget.php'         => 'Elementor_CTA_Widget',
            'testimonials-widget.php'=> 'Elementor_Testimonials_Widget',
            'services-widget.php'    => 'Elementor_Services_Widget',
            'news-widget.php'        => 'Elementor_News_Widget',
            'office-widget.php'      => 'Elementor_Office_Widget',
            'about-choose-us.php'    => 'Elementor_About_Choose_Us_Widget',
            'team-widget.php'        => 'Elementor_Team_Widget',
            'progress-widget.php'    => 'Elementor_Progress_Widget',
            'lege-button.php'        => 'Elementor_Lege_Button',
            'cases-widget.php'       => 'Elementor_Cases_Widget',
        ];

        foreach ( $widgets as $file => $class ) {
            if ( file_exists( $widgets_path . $file ) ) {
                require_once( $widgets_path . $file );
                $full_class = '\\' . $class;
                if ( class_exists( $full_class ) ) {
                    $widgets_manager->register( new $full_class() );
                }
            }
        }
    }
}

// Initialize the plugin
new Elementor_Lege();