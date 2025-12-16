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
			'menu-header'  => esc_html__( 'Header Navigation', 'lege' ),
			'menu-footer1' => esc_html__( 'Footer Navigation 1', 'lege' ),
			'menu-footer2' => esc_html__( 'Footer Navigation 2', 'lege' ),
            'menu-language'=> esc_html__( 'Language Switcher 1', 'lege')
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
    add_image_size( 'testimonial-vertical', 225, 332, true );
    add_image_size( 'feature-thumb', 438, 455, true );
    add_image_size( 'news-thumb', 633, 476, true );
    add_image_size( 'news-home', 410, 270, true );

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

    //ajax request for woo filter
    if ( is_shop() || is_product_taxonomy() ) {
        wp_register_script(
        'lege_woo_filter',
        get_template_directory_uri() . '/assets/js/woo_filter.js',
        array('jquery'),
        '',
        true
        );

        wp_localize_script(
            'lege_woo_filter',
            'lege_settings',
            array(
                'ajax_url' => admin_url('admin-ajax.php'),
            )
        );
        wp_enqueue_script('lege_woo_filter');
    }

}
add_action( 'wp_enqueue_scripts', 'lege_scripts' );

/**
 * Подключение Elementor скриптов.
 */
function lege_register_elementor_scripts() {
    wp_register_script(
        'lege-circular-progress',
        get_stylesheet_directory_uri() . '/assets/js/circular-progress.js',
        [ 'jquery' ],
        '1.0',
        true
    );
}
add_action( 'wp_enqueue_scripts', 'lege_register_elementor_scripts' );
add_action( 'elementor/frontend/after_register_scripts', 'lege_register_elementor_scripts' );


// AJAX handler for WooCommerce filter 
function lege_show_products(){

    $query_data = $_GET;

    $paged = (isset($query_data['paged']) ) ? intval($query_data['paged']) : 1;

    // set orderby (default = date)
    $orderby = isset($query_data['orderby']) ? sanitize_text_field($query_data['orderby']) : 'date';

    $posts_per_page = get_option('woocommerce_catalog_columns') * get_option('woocommerce_catalog_rows');

    //filter by category IDs
    $cats = !empty($query_data['category']) ? explode('.', $query_data['category']) : false;

    $tax_query = $cats ? [
        [
            'taxonomy' => 'product_cat',
            'field'    => 'id',
            'terms'    => $cats,
        ]
    ] : [];

    // base query
    $meta_query = [
        [
            'key'     => '_price',
            'value'   => [isset($query_data['min']) ? floatval($query_data['min']) : 0,
                          isset($query_data['max']) ? floatval($query_data['max']) : 999999],
            'compare' => 'BETWEEN',
            'type'    => 'NUMERIC',
        ]
    ];

    $args = [
        'post_type'      => 'product',
        'paged'          => $paged,
        'posts_per_page' => $posts_per_page,
        'tax_query'      => $tax_query,
        'meta_query'     => $meta_query,
    ];

    // sorting logic
    switch ($orderby) {
        case 'price':
            $args['orderby']  = 'meta_value_num';
            $args['meta_key'] = '_price';
            $args['order']    = 'ASC';
            break;

        case 'price-desc':
            $args['orderby']  = 'meta_value_num';
            $args['meta_key'] = '_price';
            $args['order']    = 'DESC';
            break;

        case 'popularity':
            $args['orderby']  = 'meta_value_num';
            $args['meta_key'] = 'total_sales';
            $args['order']    = 'DESC';
            break;

        case 'rating':
            $args['meta_query'][] = [
                'relation' => 'OR',
                [
                    'key'     => '_wc_average_rating',
                    'compare' => 'EXISTS',
                ],
                [
                    'key'     => '_wc_average_rating',
                    'compare' => 'NOT EXISTS',
                ],
            ];
            $args['orderby'] = [
                'meta_value_num' => 'DESC',
                'title'          => 'ASC',
            ];
            $args['meta_key'] = '_wc_average_rating';
            break;

        case 'date':
        default:
            $args['orderby']  = 'date';
            $args['order']    = 'DESC';
            break;
    }

    $loop = new WP_Query( $args );
    if ( $loop->have_posts() ) {
        echo '<div class="products columns-3" id="products">';

        while ( $loop->have_posts() ) : $loop->the_post();
            wc_get_template_part( 'content', 'product' );
        endwhile;

        echo '</div>';
?>
    <nav class="woocommerce-pagination">
        <?php if($loop->max_num_pages > 1){ ?>
            <nav class="pagination">
                <div class="nav-links">
                    <?php
                    //Выводим левую стрелку для первой страницы
                    if( $paged == 0 or $paged == 1){ ?>
                        <span class="prev page-numbers"></span>
                    <?php } ?>

                    <?php

                    //Вывод стандартной пагинации
                    $big = 999999999; // need an unlikely integer

                    echo paginate_links( array(
                        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                        'format' => '?paged=%#%',
                        'current' => max( 1, $paged ),
                        'prev_text'          => '',
                        'next_text'          => '',
                        'total' => $loop->max_num_pages
                    ) );
                    ?>

                    <?php
                    //Выводим правую стрелку для последней страницы
                    if( $paged == $loop->max_num_pages){ ?>
                        <span class="next page-numbers"></span>
                    <?php } ?>
                </div>
            </nav>
        <?php } ?>
    </nav>

  <?php
    } else {
        echo __( 'No products found','lege' );
    }

    wp_reset_postdata();
    die();
}
add_action('wp_ajax_lege_filter', 'lege_show_products');
add_action('wp_ajax_nopriv_lege_filter', 'lege_show_products');

/**
 * Подключение скриптов и стилей в админке (для метабоксов).
 */
function lege_admin_scripts($hook) {
    // Load only on post/page/product edit screens
    if ( in_array( $hook, ['post.php', 'post-new.php', 'page.php', 'page-new.php'] ) ) {

        // Modern uploader
        wp_enqueue_media();

        wp_enqueue_script(
            'lege_metaboxes',
            get_template_directory_uri() . '/assets/js/libs/metaboxes.js',
            array('jquery', 'jquery-ui-core', 'jquery-ui-datepicker'),
            filemtime(get_template_directory() . '/assets/js/libs/metaboxes.js'),
            true
        );

        wp_enqueue_style(
            'lege_metabox',
            get_template_directory_uri() . '/assets/css/libs/metabox.css',
            array(),
            '1.0'
        );
    }
}
add_action( 'admin_enqueue_scripts', 'lege_admin_scripts', 10 );


/**
 * Подключение скриптов для медиазагрузки в виджетах.
 * Enqueue media scripts for the Widgets admin screen.
 */
function lege_enqueue_widget_scripts($hook) {
    // Widgets page
    if ( $hook === 'widgets.php' ) {
        wp_enqueue_media();

        wp_enqueue_script(
            'lege-widget-js',
            get_template_directory_uri() . '/assets/js/libs/lege-widget.js',
            array('jquery'),
            filemtime(get_template_directory() . '/assets/js/libs/lege-widget.js'),
            true
        );
    }
}
add_action( 'admin_enqueue_scripts', 'lege_enqueue_widget_scripts' );


/**
 * Подключение функций WooCommerce.
 */
require get_template_directory() . '/inc/functions/woocommerce.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php'; 

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Подключение social кнопок.
 */
require_once get_template_directory() . '/inc/social.php';
require_once get_template_directory() . '/inc/functions/contact.php';

/**
 * Подключение widgets.
 */
require get_template_directory() . '/inc/widgets/widgets.php';
require get_template_directory() . '/inc/widgets/widget-about.php';
require get_template_directory() . '/inc/widgets/widget-customcategory.php';
require get_template_directory() . '/inc/widgets/widget-subscribe.php';
require get_template_directory() . '/inc/widgets/widget-customsearch.php';
require get_template_directory() . '/inc/widgets/widget-shopbanner.php';
require get_template_directory() . '/inc/widgets/widget-pricerange.php';
require get_template_directory() . '/inc/widgets/widget-categoryfilter.php';
require get_template_directory() . '/inc/widgets/widget-rating.php';
require get_template_directory() . '/inc/widgets/widget-customcategory-cases.php';

// Disable the block editor for widgets.
add_filter( 'use_widgets_block_editor', '__return_false' );

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

    register_post_type( 'team', array(
        'labels' => array(
            'name'                  => __( 'Team', 'lege' ),
            'singular_name'         => __( 'Team Member', 'lege' ),
            'add_new'               => __( 'Add New Member', 'lege' ),
            'add_new_item'          => __( 'Add New Team Member', 'lege' ),
            'edit_item'             => __( 'Edit Team Member', 'lege' ),
            'new_item'              => __( 'New Team Member', 'lege' ),
            'view_item'             => __( 'View Team Member', 'lege' ),
        ),
        'public'                 => true,
        'publicly_queryable'     => true,
        'show_ui'                => true,
        'show_in_menu'           => true,
        'query_var'              => true,
        'rewrite'                => array( 'slug' => 'team' ),
        'capability_type'        => 'post',
        'has_archive'            => true,
        'hierarchical'           => false,
        'menu_position'          => null,
        'menu_icon'              => 'dashicons-groups',
        'supports'               => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
    ) );

    register_post_type( 'offices', array(
        'labels' => array(
            'name'                  => __( 'Offices', 'lege' ),
            'singular_name'         => __( 'Office', 'lege' ),
            'add_new'               => __( 'Add New Office', 'lege' ),
            'add_new_item'          => __( 'Add New Office', 'lege' ),
            'edit_item'             => __( 'Edit Office', 'lege' ),
            'new_item'              => __( 'New Office', 'lege' ),
            'view_item'             => __( 'View Office', 'lege' ),
        ),
        'public'                 => true,
        'publicly_queryable'     => true,
        'show_ui'                => true,
        'show_in_menu'           => true,
        'query_var'              => true,
        'rewrite'                => array( 'slug' => 'office' ),
        'capability_type'        => 'post',
        'has_archive'            => true,
        'hierarchical'           => false,
        'menu_position'          => null,
        'menu_icon'              => 'dashicons-building',
        'supports'               => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
    ) );

    register_post_type( 'testimonial', array(
        'labels'             => array(
            'name'            => _x( 'Testimonials', 'lege' ),
            'singular_name'   => _x( 'Testimonial', 'lege' ),
            'add_new'         => __( 'Add new', 'lege' )
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
            'name'                  => __( 'Services','lege' ),
            'singular_name'         => __( 'Service','lege' ),
            'add_new'               => __( 'Add new', 'lege' ),
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
            'name'                  => __( 'News','lege' ),
            'singular_name'         => __( 'News','lege' ),
            'add_new'               => __( 'Add new', 'lege' ),
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
            'name'                  => __( 'Cases', 'lege' ),
            'singular_name'         => __( 'Case', 'lege' ),
            'add_new'               => __( 'Add new', 'lege' ),
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
			'label' => __( 'Services categories', 'lege' ),
			'rewrite' => array( 'slug' => 'service-type' ),
			'hierarchical' => true,
		)
	);

	register_taxonomy(
		'news-category',
		'news',
		array(
			'label' =>  __( 'News categories', 'lege' ),
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

    // Show all posts in admin 
    if ( is_admin() || ! $query->is_main_query() ) {
        return;
    }     

    if ( $query->is_post_type_archive('testimonial') ) {
        $posts_per_page = isset( $lege_options['testimonial_posts'] ) ? (int) $lege_options['testimonial_posts'] : 6;
        $query->set( 'posts_per_page', $posts_per_page );
    }

    if ( $query->is_post_type_archive('news') || $query->is_archive() && $query->get('post_type') == 'post') {
        $posts_per_page = isset( $lege_options['newspostsperpage'] ) ? (int) $lege_options['newspostsperpage'] : 10; // Use a default if not set
        $query->set( 'posts_per_page', $posts_per_page );
    }

}
add_action( 'pre_get_posts', 'lege_posts_per_archiepage', 5 );


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

// Функция для обрезки текста в excerpt
function lege_custom_excerpt($limit) {
    $excerpt = explode(' ', get_the_excerpt(), $limit);

    if (count($excerpt) >= $limit) {
        array_pop($excerpt);
        $excerpt = implode(" ", $excerpt) . '...';
    } else {
        $excerpt = implode(" ", $excerpt);
    }

    $excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);

    return $excerpt;
}

/**
 * MC4WP Mailchimp form response for success and error messages
 */
add_filter('mc4wp_form_response_position', function() {
    return 'after';
});


/**
 * Registration Form
 */
// Add phone field to Woo registration form 
add_action( 'register_form', 'lege_add_registration_fields' );
function lege_add_registration_fields() {
    // Get and set any value already sent 
    $user_phone = ( isset( $_POST['billing_phone'] ) ) ? $_POST['billing_phone'] : '';
    ?> 

    <p>
        <label for="user_extra"><?php _e( 'Phone', 'lege' ) ?><br />
            <input type="text" name="billing_phone" id="billing_phone" class="input" value="<?php echo esc_attr( stripslashes( $user_phone ) ); ?>" /></label>
    </p>

    <?php
}
// Validate the phone field (field is required)
add_filter( 'registration_errors', 'lege_registration_errors', 10, 3 );
function lege_registration_errors( $errors, $sanitized_user_login, $user_email ) {

    if ( empty( $_POST['billing_phone'] ) || ! empty( $_POST['billing_phone'] ) && trim( $_POST['billing_phone'] ) == '' ) {
        $errors->add( 'billing_phone_error', sprintf('<strong>%s</strong>: %s',__( 'ERROR', 'lege' ),__( 'Please enter your phone number.', 'lege' ) ) );
    }

    return $errors;
}
// Save the phone number to user meta after registration
add_action( 'user_register', 'lege_user_register' );
function lege_user_register( $user_id ) {
    if ( ! empty( $_POST['billing_phone'] ) ) {
        update_user_meta( $user_id, 'billing_phone', sanitize_text_field( $_POST['billing_phone'] ) );
    }
}

add_action('woocommerce_save_account_details', 'lege_woocommerce_save_account_details'); 
function lege_woocommerce_save_account_details( $user_id ) {
    update_user_meta( $user_id, 'billing_phone', sanitize_text_field( $_POST['billing_phone']));
}

// In admin always show all posts all languages
add_filter( 'pll_the_languages_args', function( $args ) {
    $args['hide_if_empty'] = 0;
    return $args;
} );