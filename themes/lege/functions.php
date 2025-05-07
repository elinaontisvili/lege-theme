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

	// Размеры для картинок
	add_image_size( 'testimonial-thumb', 225, 231, true );
    add_image_size( 'feature-thumb', 438, 455, true );
    add_image_size( 'news-thumb', 633, 476, true );

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
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function lege_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'lege' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'lege' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'lege_widgets_init' );

/**
 * Подключение скриптов и стилей.
 */
function lege_scripts() {
	wp_enqueue_style( 'lege-style', get_stylesheet_uri(), array(), '1.0' );
	wp_enqueue_style( 'lege-main', get_template_directory_uri(). '/assets/css/main.min.css', array(), '1.0' ); 
	wp_enqueue_style( 'lege-vendor', get_template_directory_uri(). '/assets/css/vendor.min.css', array(), '1.0' );

	// wp_enqueue_script( 'jquery');
	wp_enqueue_script( 'jquery3.1.1', 'http://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', array(), '3.1.1', true);
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
require get_template_directory() . '/inc/metaboxes.php';

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
			'label' => __( 'Категории услуг', '	lege' ),
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
 * Регистрируем Metaboxes.
 */
function lege_metaboxes($meta_boxes) {

    $meta_boxes = array();
    $prefix = "lege_";

    // Testimonial Metabox
    $meta_boxes[] = array(
        'id'         => 'testimonial_metaboxes',
        'title'      => esc_html__( 'Данные для отзыва', 'lege' ),
        'pages'      => array( 'testimonial' ),
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true,
        'fields' => array(
            array(
                'name' => esc_html__( 'Социальная Сеть', 'lege' ),
                'desc' => esc_html__( 'Введите ссылку на соц сеть', 'lege' ),
                'id'   => $prefix . 'social_link',
                'type' => 'text',
            ),
            array(
                'name' => esc_html__( 'Дата отзыва', 'lege' ),
                'desc' => esc_html__( 'Введите дату отзыва', 'lege' ),
                'id'   => $prefix . 'testy_date',
                'type' => 'text_date',
            ),
        )
    );

    // Service Metabox
    $meta_boxes[] = array(
        'id'         => 'service_metaboxes',
        'title'      => esc_html__( 'Данные для сервиса', 'lege' ),
        'pages'      => array( 'service' ),
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true,
        'fields' => array(
            array(
                'name' => esc_html__( 'Стоимость', 'lege' ),
                'desc' => esc_html__( 'Введите цену данной услуги', 'lege' ),
                'id'   => $prefix . 'service_cost',
                'type' => 'text',
            ),
            array(
                'name' => esc_html__( 'Фоновое изображение', 'lege' ),
                'desc' => esc_html__( 'Выберите фон для выбора', 'lege' ),
                'id'   => $prefix . 'service_icon',
                'type' => 'select',
                'options' => array(
                    array('name' => esc_html__( 'Стиль Статистика', 'lege' ), 'value' => 'stat'),
                    array('name' => esc_html__( 'Стиль Идея', 'lege' ), 'value' => 'idea'),
                    array('name' => esc_html__( 'Стиль Интернет', 'lege' ), 'value' => 'internet'),
                    array('name' => esc_html__( 'Стиль Инфо', 'lege' ), 'value' => 'info'),
                    array('name' => esc_html__( 'Стиль Деловой', 'lege' ), 'value' => 'busy'),
                    array('name' => esc_html__( 'Стиль Таргет', 'lege' ), 'value' => 'target'),
                ),
            ),
        )
    );

// Metabox for Template Order, for the form shortcode
$meta_boxes[] = array(
    'id'         => 'order_metaboxes',
    'title'      => esc_html__( 'Данные для страницы заказа', 'lege' ),
    'pages'      => array( 'page' ),
    'context'    => 'normal',
    'priority'   => 'high',
    'show_names' => true,
    'show_on'    => array( 'key' => 'page-template', 'value' => array('template-order.php') ),
    'fields' => array(
        array(
            'name' => esc_html__( 'Шорткод формы', 'lege' ),
            'desc' => esc_html__( 'Установите плагин для формы и вставьте шорткод формы', 'lege' ),
            'id'   => $prefix . 'shortcode_order',
            'type' => 'text',
        ),
    )
);

return $meta_boxes;
}

/*
 * Pagination. Количество постов на странице архива.
 * */
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