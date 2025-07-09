<?php
/**
 * Lege functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Lege
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function lege_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Lege, use a find and replace
		* to change 'lege' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'lege', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// Регистрация меню навигации.
	register_nav_menus(
		array(
			'menu-header' => esc_html__( 'Header Navigation', 'lege' ),
			'menu-footer1' => esc_html__( 'Footer Navigation 1', 'lege' ),
			'menu-footer2' => esc_html__( 'Footer Navigaion 2', 'lege' ),
		)
	);

	/*
	* Switch default core markup for search form, comment form, and comments
	* to output valid HTML5.
	*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'lege_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	// Размеры для картинок.
	add_image_size( 'testimonial-thumb', 225, 231, true );
    add_image_size( 'feature-thumb', 438, 455, true );
    add_image_size( 'news-thumb', 633, 476, true );

    // Поддержка WooCommerce.
    //add_theme_support( 'woocommerce' );

    // Поддержка Gutenberg.
    //add_editor_style( 'editor-style.css' );

}
add_action( 'after_setup_theme', 'lege_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function lege_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'lege_content_width', 640 );
}
add_action( 'after_setup_theme', 'lege_content_width', 0 );


/**
* Deregister the default jQuery safely with a CDN version, to use a specific jQuery version
*/
function lege_replace_jquery() {
if (!is_admin()) {
    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', array(), '3.1.1', true);
    wp_enqueue_script('jquery');
    }
}
add_action('wp_enqueue_scripts', 'lege_replace_jquery', 0);

/**
 * Подключение скриптов и стилей.
 */
function lege_scripts() {
    wp_enqueue_style( 'lege-style', get_stylesheet_uri(), array(), '1.0' );
    wp_enqueue_style( 'lege-main', get_template_directory_uri(). '/assets/css/main.min.css', array(), '1.0' );
    wp_enqueue_style( 'lege-vendor', get_template_directory_uri(). '/assets/css/vendor.min.css', array(), '1.0' );
    wp_enqueue_script( 'goodshare', 'https://cdn.jsdelivr.net/npm/goodshare.js@4/goodshare.min.js', array(), 1.0, true);
    wp_enqueue_script( 'lege-vendor', get_template_directory_uri(). '/assets/js/vendor.min.js', array(), 1.0, true );
    wp_enqueue_script( 'lege-common', get_template_directory_uri(). '/assets/js/common.min.js', array(), 1.0, true );
    wp_enqueue_script( 'lege-svg-sprite', get_template_directory_uri(). '/assets/img/svg-sprite/svg-sprite.js', array(), 1.0, false );


    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'lege_scripts' );

/**
 * Подключение скриптов и стилей в админке.
 */
function lege_admin_scripts($hook) {

  	if ( $hook == 'post.php' || $hook == 'post-new.php' || $hook == 'page-new.php' || $hook == 'page.php' ) {
		wp_enqueue_script( 'lege_metaboxes', get_template_directory_uri() . '/assets/js/libs/metaboxes.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-datepicker', 'media-upload', 'thickbox') );
		wp_enqueue_style('lege_metabox', get_template_directory_uri() . '/assets/css/libs/metabox.css', array(), '1.0');
	}
}
add_action( 'admin_enqueue_scripts', 'lege_admin_scripts', 10 );

/**
 * Подключение скриптов медиафайлов для административной панели WordPress.
 * Enqueue media scripts for the WordPress admin.
 */
function lege_enqueue_widget_scripts() {
	wp_enqueue_media();
	wp_enqueue_script(
    'lege-widget-js',
    get_template_directory_uri() . '/assets/js/libs/lege-widget.js',
    array('jquery'),
    filemtime(get_template_directory() . '/assets/js/libs/lege-widget.js'), // version
    true
);
}
add_action( 'admin_enqueue_scripts', 'lege_enqueue_widget_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Подключение social кнопок.
 */
require_once get_template_directory() . '/inc/social.php';

/**
 * Подключение widgets.
 */
require get_template_directory() . '/inc/widgets/widgets.php';
require get_template_directory() . '/inc/widgets/widget-about.php';
require get_template_directory() . '/inc/widgets/widget-customcategory.php';
require get_template_directory() . '/inc/widgets/widget-subscribe.php';
require get_template_directory() . '/inc/widgets/widget-customsearch.php';


/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Настройки Redux.
 */
require get_template_directory() . '/inc/options-panel-redux.php';

/**
 * Подключение хлебные крошки.
 */
require get_template_directory() . '/inc/breadcrumbs.php';

/**
 * Подключение Metabox.
 */
require get_template_directory() . '/inc/metaboxes/metaboxes.php';
require get_template_directory() . '/inc/metaboxes/register_metabox.php';

/**
 * Класс на боди для специфической страницы.
*/
function lege_body_class( $classes ) {
    if ( is_page_template('template-home.php') ) {
        $classes[] = 'is-home';
    } else {
        $classes[] = 'inner-page';
    }
    return $classes;
}
add_filter( 'body_class', 'lege_body_class' );

/** 
 * Регистрируем постайп для Testimonials
 */
function lege_register_custom_post_type() {

    register_post_type( 'testimonial', array(
        'labels'             => array(
            'name'            => _x( 'Отзывы', 'lege' ),
            'singular_name'   => _x( 'Отзыв', 'lege' ),
            'add_new'         => __( 'Добавить новый', 'lege' )
        ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'testimonials' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'menu_icon'          => 'dashicons-format-quote',
        'supports'           => array( 'title', 'editor', 'thumbnail' ),
    ) );

    register_post_type( 'service', array(
        'labels'             => array(
            'name'                  => __( 'Услуги','lege' ),
            'singular_name'         => __( 'Услуга','lege' ),
            'add_new'               => __( 'Добавить новую', 'lege' ),
        ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'services' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'menu_icon'          => 'dashicons-admin-tools',
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
    ) );

    register_post_type( 'news', array(
        'labels'             => array(
            'name'                  => __( 'Новости','lege' ),
            'singular_name'         => __( 'Новость','lege' ),
            'add_new'               => __( 'Добавить новую', 'lege' ),
        ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'news' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'menu_icon'          => 'dashicons-format-aside',
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
    ) );

    register_post_type( 'feature', array(
        'labels'             => array(
            'name'                  => __( 'Кейсы', 'lege' ),
            'singular_name'         => __( 'Кейс', 'lege' ),
            'add_new'               => __( 'Добавить новый', 'lege' ),
        ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'feature' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'menu_icon'          => 'dashicons-dashboard',
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
    ) );

	// Регистрируем Taxonomy.
	register_taxonomy(
		'service-type',
		'service',
		array(
			'label' => __( 'Категории услуг', 'lege' ),
			'rewrite' => array( 'slug' => 'service-type' ),
			'hierarchical' => true,
		)
	);

	register_taxonomy(
		'news-category',
		'news',
		array(
			'label' =>  __( 'Категории новостей', 'lege' ),
			'rewrite' => array( 'slug' => 'news-category' ),
			'hierarchical' => true,
		)
	);

	register_taxonomy(
		'feature-type',
		'feature',
		array(
			'label'   => __( 'Case Type', 'lege' ),
			'rewrite' => array( 'slug' => 'case-type' ),
			'hierarchical' => true,
		)
	);	
}
add_action( 'init', 'lege_register_custom_post_type' );


/**
 * Pagination. Количество постов на странице архива.
 */
function lege_posts_per_archiepage( $query ) {
    global $lege_options;
    $posts_per_page_testy = -1;
    $posts_per_page_news = -1;
    if($lege_options['testimonial_posts']){ $posts_per_page_testy =$lege_options['testimonial_posts']; }
    if($lege_options['newspostsperpage']){ $posts_per_page_news =$lege_options['newspostsperpage']; }

    if (is_post_type_archive('testimonial')) {
        $query->set( 'posts_per_page', $posts_per_page_testy );
    }
    if (is_post_type_archive('news')) {
        $query->set( 'posts_per_page', $posts_per_page_news );
    }
}
add_action( 'pre_get_posts', 'lege_posts_per_archiepage' );

/**
 * Функция возвращает массив с данными вложения по его ID.
 */
function lege_get_attachment( $attachment_id ) {
    $attachment = get_post( $attachment_id );

    return array(
        'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
        'caption' => $attachment->post_excerpt,
        'description' => $attachment->post_content,
        'href' => get_permalink( $attachment->ID ),
        'src' => wp_get_attachment_url( $attachment->ID ), 
        'title' => $attachment->post_title,
    );
}
add_filter( 'get_attachment', 'lege_get_attachment' );

/**
 * MC4WP Mailchimp form response for success and error messages
 */
add_filter('mc4wp_form_response_position', function() {
    return 'after'; // or before
});
