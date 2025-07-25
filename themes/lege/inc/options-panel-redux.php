<?php

// phpcs:disable
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Redux' ) ) {
	return;
}

// Переменная для настроект.
$opt_name = 'lege_options';

// Uncomment to disable demo mode.
/* Redux::disable_demo(); */  // phpcs:ignore Squiz.PHP.CommentedOutCode

$dir = __DIR__ . DIRECTORY_SEPARATOR;

/*
 * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
 */

// Background Patterns Reader.
$sample_patterns_path = Redux_Core::$dir . '../sample/patterns/';
$sample_patterns_url  = Redux_Core::$url . '../sample/patterns/';
$sample_patterns      = array();

if ( is_dir( $sample_patterns_path ) ) {
	$sample_patterns_dir = opendir( $sample_patterns_path );

	if ( $sample_patterns_dir ) {

		// phpcs:ignore Generic.CodeAnalysis.AssignmentInCondition.FoundInWhileCondition
		while ( false !== ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) ) {
			if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
				$name              = explode( '.', $sample_patterns_file );
				$name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
				$sample_patterns[] = array(
					
					'alt' => $name,
					'img' => $sample_patterns_url . $sample_patterns_file,
				);
			}
		}
	}
}

// Used to except HTML tags in description arguments where esc_html would remove.
$kses_exceptions = array(
	'a'      => array(
		'href' => array(),
	),
	'strong' => array(),
	'br'     => array(),
	'code'   => array(),
);

/*
 * ---> BEGIN ARGUMENTS
 */

/**
 * All the possible arguments for Redux.
 * For full documentation on arguments, please refer to: https://devs.redux.io/core/arguments/
 */
$theme = wp_get_theme(); // For use with some settings. Not necessary.

// TYPICAL → Change these values as you need/desire.
$args = array(
	// This is where your data is stored in the database and also becomes your global variable name.
	'opt_name'                  => $opt_name,

	// Name that appears at the top of your panel.
	'display_name'              => $theme->get( 'Name' ),

	// Version that appears at the top of your panel.
	'display_version'           => $theme->get( 'Version' ),

	// Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only).
	'menu_type'                 => 'menu',

	// Show the sections below the admin menu item or not.
	'allow_sub_menu'            => true,

	// The text to appear in the admin menu.
	'menu_title'                => esc_html__( 'Sample Options', 'lege' ),

	// The text to appear on the page title.
	'page_title'                => esc_html__( 'Sample Options', 'lege' ),

	// Disable to create your own Google fonts loader.
	'disable_google_fonts_link' => false,

	// Show the panel pages on the admin bar.
	'admin_bar'                 => true,

	// Icon for the admin bar menu.
	'admin_bar_icon'            => 'dashicons-portfolio',

	// Priority for the admin bar menu.
	'admin_bar_priority'        => 50,

	// Sets a different name for your global variable other than the opt_name.
	'global_variable'           => $opt_name,

	// Show the time the page took to load, etc. (forced on while on localhost or when WP_DEBUG is enabled).
	'dev_mode'                  => true,

	// Enable basic customizer support.
	'customizer'                => true,

	// Allow the panel to open expanded.
	'open_expanded'             => false,

	// Disable the save warning when a user changes a field.
	'disable_save_warn'         => false,

	// Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
	'page_priority'             => 90,

	// For a full list of options, visit: https://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters.
	'page_parent'               => 'themes.php',

	// Permissions needed to access the options panel.
	'page_permissions'          => 'manage_options',

	// Specify a custom URL to an icon.
	'menu_icon'                 => '',

	// Force your panel to always open to a specific tab (by id).
	'last_tab'                  => '',

	// Icon displayed in the admin panel next to your menu_title.
	'page_icon'                 => 'icon-themes',

	// Page slug used to denote the panel, will be based off page title, then menu title, then opt_name if not provided.
	'page_slug'                 => $opt_name,

	// On load save the defaults to DB before user clicks save.
	'save_defaults'             => true,

	// Display the default value next to each field when not set to the default value.
	'default_show'              => false,

	// What to print by the field's title if the value shown is default.
	'default_mark'              => '*',

	// Shows the Import/Export panel when not used as a field.
	'show_import_export'        => true,

	// Shows the Options Object for debugging purposes. Show be set to false before deploying.
	'show_options_object'       => true,

	// The time transients will expire when the 'database' arg is set.
	'transient_time'            => 60 * MINUTE_IN_SECONDS,

	// Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output.
	'output'                    => true,

	// Allows dynamic CSS to be generated for customizer and google fonts,
	// but stops the dynamic CSS from going to the page head.
	'output_tag'                => true,

	// Disable the footer credit of Redux. Please leave if you can help it.
	'footer_credit'             => '',

	// If you prefer not to use the CDN for ACE Editor.
	// You may download the Redux Vendor Support plugin to run locally or embed it in your code.
	'use_cdn'                   => true,

	// Set the theme of the option panel.  Use 'wp' to use a more modern style, default is classic.
	'admin_theme'               => 'wp',

	// Enable or disable flyout menus when hovering over a menu with submenus.
	'flyout_submenus'           => true,

	// Mode to display fonts (auto|block|swap|fallback|optional)
	// See: https://developer.mozilla.org/en-US/docs/Web/CSS/@font-face/font-display.
	'font_display'              => 'swap',

	// HINTS.
	'hints'                     => array(
		'icon'          => 'el el-question-sign',
		'icon_position' => 'right',
		'icon_color'    => 'lightgray',
		'icon_size'     => 'normal',
		'tip_style'     => array(
			'color'   => 'red',
			'shadow'  => true,
			'rounded' => false,
			'style'   => '',
		),
		'tip_position'  => array(
			'my' => 'top left',
			'at' => 'bottom right',
		),
		'tip_effect'    => array(
			'show' => array(
				'effect'   => 'slide',
				'duration' => '500',
				'event'    => 'mouseover',
			),
			'hide' => array(
				'effect'   => 'slide',
				'duration' => '500',
				'event'    => 'click mouseleave',
			),
		),
	),

	// FUTURE → Not in use yet, but reserved or partially implemented.
	// Use at your own risk.
	// Possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
	'database'                  => '',
	'network_admin'             => true,
	'search'                    => true,
);


// ADMIN BAR LINKS → Set up custom links in the admin bar menu as external items.
// PLEASE CHANGE THESE SETTINGS IN YOUR THEME BEFORE RELEASING YOUR PRODUCT!!
// If these are left unchanged, they will not display in your panel!
$args['admin_bar_links'][] = array(
	'id'    => 'redux-docs',
	'href'  => '//devs.redux.io/',
	'title' => __( 'Documentation', 'lege' ),
);

$args['admin_bar_links'][] = array(
	'id'    => 'redux-support',
	'href'  => '//github.com/ReduxFramework/redux-framework/issues',
	'title' => __( 'Support', 'lege' ),
);

// SOCIAL ICONS → Set up custom links in the footer for quick links in your panel footer icons.
// PLEASE CHANGE THESE SETTINGS IN YOUR THEME BEFORE RELEASING YOUR PRODUCT!!
// If these are left unchanged, they will not display in your panel!
$args['share_icons'][] = array(
	'url'   => '//github.com/ReduxFramework/ReduxFramework',
	'title' => 'Visit us on GitHub',
	'icon'  => 'el el-github',
);
$args['share_icons'][] = array(
	'url'   => '//www.facebook.com/pages/Redux-Framework/243141545850368',
	'title' => 'Like us on Facebook',
	'icon'  => 'el el-facebook',
);
$args['share_icons'][] = array(
	'url'   => '//twitter.com/reduxframework',
	'title' => 'Follow us on Twitter',
	'icon'  => 'el el-twitter',
);
$args['share_icons'][] = array(
	'url'   => '//www.linkedin.com/company/redux-framework',
	'title' => 'Find us on LinkedIn',
	'icon'  => 'el el-linkedin',
);

// Panel Intro text → before the form.
if ( ! isset( $args['global_variable'] ) || false !== $args['global_variable'] ) {
	if ( ! empty( $args['global_variable'] ) ) {
		$v = $args['global_variable'];
	} else {
		$v = str_replace( '-', '_', $args['opt_name'] );
	}

	// translators:  Panel opt_name.
	$args['intro_text'] = '<p>' . sprintf( esc_html__( 'Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: $%1$s', 'lege' ), '<strong>' . $v . '</strong>' ) . '<p>';
} else {
	$args['intro_text'] = '<p>' . esc_html__( 'This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.', 'lege' ) . '</p>';
}

// Add content after the form.
$args['footer_text'] = '<p>' . esc_html__( 'This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.', 'lege' ) . '</p>';

Redux::set_args( $opt_name, $args );

/*
 * ---> END ARGUMENTS
 */

/*
 * ---> START HELP TABS
 */
$help_tabs = array(
	array(
		'id'      => 'redux-help-tab-1',
		'title'   => esc_html__( 'Theme Information 1', 'lege' ),
		'content' => '<p>' . esc_html__( 'This is the tab content, HTML is allowed.', 'lege' ) . '</p>',
	),
	array(
		'id'      => 'redux-help-tab-2',
		'title'   => esc_html__( 'Theme Information 2', 'lege' ),
		'content' => '<p>' . esc_html__( 'This is the tab content, HTML is allowed.', 'lege' ) . '</p>',
	),
);
Redux::set_help_tab( $opt_name, $help_tabs );

// Set the help sidebar.
$content = '<p>' . esc_html__( 'This is the sidebar content, HTML is allowed.', 'lege' ) . '</p>';

Redux::set_help_sidebar( $opt_name, $content );

/*
 * <--- END HELP TABS
 */

/*
 * ---> START SECTIONS
 */

// -> START Basic Fields

Redux::set_section( $opt_name, array(
    'title'            => __( 'Global Settings', 'lege' ),
    'id'               => 'globalsettings',
    'desc'             => __( 'Options for Global Settings', 'lege' ),
    'customizer_width' => '400px',
    'icon'             => 'el el-wrench',
));

Redux::set_section($opt_name, array(
    'title' => __('Social Profiles', 'lege'),
    'id' => 'social_profiles',
    'subsection' => true,
    'customizer_width' => '450px',
    'desc' => __('Add profile links for Social', 'lege'),
    'fields' => array(
        array(
            'id'       => 'social_links',
            'type'     => 'sortable',
            'title'    => __('Social Links', 'lege'),
            'subtitle' => __('Add your social links', 'lege'),
            'desc'     => __('Let the field empty if you don\'t have a social profile', 'lege'),
            'label'    => true,
            'options'  => array(
                'Vkontakte Link' => '',
                'Facebook Link'  => '',  
                'Twitter Link'   => '',
                'Instagram Link' => '',
            )
		),
    )
));

Redux::set_section($opt_name, array(
    'title' => __('Contact Data', 'lege'),
    'id' => 'contacts',
    'subsection' => true,
    'customizer_width' => '450px',
    'desc' => __('Add Contact Data for Header and Footer', 'lege'),
    'fields' => array(

		// Header Data
		array(
            'id'     => 'header_start',
            'type'   => 'section',
            'title'  => __('Header Data', 'lege'),
            'indent' => true, 
		),
        array(
            'id'       => 'header_phone_label',
            'type'     => 'text',
            'title'    => __('Header Phone Label', 'lege'),
            'subtitle' => __('Insert the Label', 'lege'),
            'default'  => 'Заказать звонок',
		),
		array(
            'id'       => 'header_phone',
            'type'     => 'text',
            'title'    => __('Header Phone', 'lege'),
            'subtitle' => __('Insert the Phone', 'lege'),
		),
		array(
            'id'     => 'header_end',
            'type'   => 'section',
            'indent' => false,
		),

		// Footer Data
		array(
            'id'     => 'footer_start',
            'type'   => 'section',
            'title'  => __('Footer Data', 'lege'),
            'indent' => true,
		),
		array(
			'id'       => 'footer_address',
			'type'     => 'text',
			'title'    => __( 'Your Address', 'lege' ),
			'default'  => '',
		),
		array(
            'id'       => 'footer_phone',
            'type'     => 'multi_text',
            'title'    => __('Contact Phone', 'lege'),
            'subtitle' => __('Add your Phones', 'lege'),
            'desc'     => __('Add or remove items', 'lege'),
		),
		array(
			'id'       => 'footer_email',
			'type'     => 'text',
			'title'    => __( 'Email', 'lege' ),
			'validate' => 'email',
			'msg'      => 'Email Format is not correct',
			'default'  => '',
		),
		array(
			'id'      => 'footer_info',
			'type'    => 'text',
			'title'   => __( 'Footer Info', 'lege' ),
			'subtitle'=> __( 'Info after social icons', 'lege' ),
		),

		array(
			'id'      => 'footer_copyrights',
			'type'    => 'editor',
			'title'   => __( 'Copyrights', 'lege' ),
			'default' => '©2007-2018 Все права защищены',
			'args'    => array(
				'wpautop'       => false,
				'media_buttons' => false,
				'textarea_rows' => 5,
				'teeny'         => false,
				'quicktags'     => false,
			)
		),
		array(
            'id'     => 'Footer_end',
            'type'   => 'section',
            'indent' => false,
		),

		// Footer Navigation
		array(
			'id'       => 'footer-widget-start',
			'type'     => 'section',
			'title'    => __( 'Footer Section Headers', 'lege' ),
			'indent'   => true,
		),
		array(
			'id'      => 'footer_section1',
			'type'    => 'text',
			'title'   => __( 'First Section Title', 'lege' ),
			'default' => 'Карта сайта'
		),
		array(
			'id'      => 'footer_section2',
			'type'    => 'text',
			'title'   => __( 'Second Section Title', 'lege' ),
			'default' => 'Услуги'
		),
		array(
			'id'      => 'footer_section3',
			'type'    => 'text',
			'title'   => __( 'Third Section Title', 'lege' ),
			'default' => 'Контакты'
		),
		array(
			'id'      => 'footer_section4',
			'type'    => 'text',
			'title'   => __( 'Fourth Section Title', 'lege' ),
			'default' => 'Подписаться на рассылку новостей'
		),
		array(
			'id'     => 'footer-widget-end',
			'type'   => 'section',
			'indent' => false, // false -> End indentation. Options below are not nested until the next 'indent' => true section.
		),
		array(
			'id'       => 'footer-subscribe-start',
			'type'     => 'section',
			'title'    => esc_html__( 'Footer Subscribe Form', 'lege' ),
			'indent'   => true, // Start a new subsection. Options below will be nested under this section.
		),
		array(
			'id'      => 'footer_subscribeshortcode',
			'type'    => 'text',
			'title'   => esc_html__( 'Shortcode for Subscribe plugin', 'lege' ),
		),
		array(
			'id'     => 'footer-subscribe-end',
			'type'   => 'section',
			'indent' => false, // false -> End indentation.
		),
    )
));

// Slider / Home Header
Redux::set_section( $opt_name, array(
	'title'            => __( 'Home Header', 'lege' ),
	'id'               => 'home_header',
	'subsection'       => true,
	'customizer_width' => '450px',
	'desc'             => __( 'Add Media files and data for Home Header', 'lege' ),
	'fields'           => array(
		array(
			'id'       => 'header_bg',
			'type'     => 'media',
			'url'      => true,
			'title'    => __( 'Background for Home Header', 'lege' ),
			'compiler' => 'true',
			'desc'     => __( 'Recommended size 1920x-998px', 'lege' ),
			'default'  => array( 'url' => get_template_directory_uri().'/assets/img/bg.jpg' ),
		),
		array(
			'id'      => 'header_time',
			'type'    => 'text',
			'title'   => __( 'Specify the Time', 'lege' ),
			'default' => '',
		),
		array(
			'id'      => 'header_video',
			'type'    => 'text',
			'title'   => __( 'Specify the video link', 'lege' ),
			'default' => '',
			'text_hint' => array(
				'title'   => 'Ссылка с YouTube',
				'content' => 'Используйте простую ссылку из строки браузера на ролик с Ютуб'
			)
		),
		array(
			'id'      => 'header_video_title',
			'type'    => 'text',
			'title'   => __( 'Specify the video title', 'lege' ),
			'default' => '',
		),

		array(
			'id'          => 'home_header_slider',
			'type'        => 'slides',
			'title'       => __( 'Slides Options', 'lege' ),
			'subtitle'    => __( 'Unlimited slides with drag and drop sortings.', 'lege' ),
			'desc'        => __( 'This field will store all slides values into a multidimensional array to use into a foreach loop.', 'lege' ),
			'placeholder' => array(
				'title'       => __( 'This is a title', 'lege' ),
				'description' => __( 'Description Here', 'lege' ),
				'url'         => __( 'Give us a link!', 'lege' ),
			),
		),
	)
));

// Post Types
Redux::set_section( $opt_name, array(
	'title'            => __( 'Post Types', 'lege' ),
	'id'               => 'posttypes',
	'desc'             => __( 'Options for Custom Post Types', 'lege' ),
	'customizer_width' => '400px',
	'icon'             => 'el el-home'
	) );

Redux::set_section( $opt_name, array(
	'title'            => __( 'Testimonials', 'lege' ),
	'id'               => 'testimonialsposttype',
	'subsection'       => true,
	'customizer_width' => '450px',
	'desc'             => __( 'Data for Testimonials Page', 'lege' ),
	'fields'           => array(

		array(
			'id'      => 'testylabel1',
			'type'    => 'text',
			'title'   => __( 'Specify the Label', 'lege' ),
			'default' =>'За нас говорят'
		),
		array(
			'id'      => 'testylabel2',
			'type'    => 'text',
			'title'   => __( 'Specify the Label', 'lege' ),
			'default' =>'НАШИ КЛИЕНТЫ'
		),
		array(
			'id'      => 'testimonial_posts',
			'type'    => 'text',
			'title'   => __( 'Specify the count of testimonials per page', 'lege' ),
			'default' => '6' 
		),
		/*
		array(
			'id'      => 'testimonial_form_label',
			'type'    => 'text',
			'title'   => esc_html__( 'Form Label', 'lege' ),
			'default' => 'Оставьте ваш отзыв'
		),
		*/
		array(
			'id'      => 'testimonial_form_shortcode',
			'type'    => 'text',
			'title'   => __( 'Form Shortcode', 'lege' ),
			'desc'    => __( 'Install the plugin and enter the contact form shortcode in this field.', 'lege' ),
			'default' => ''
		),
	)
) );

Redux::set_section( $opt_name, array(
	'title'            => __( 'Services', 'lege' ),
	'id'               => 'servicesposttype',
	'subsection'       => true,
	'customizer_width' => '450px',
	'desc'             => __( 'Data for Service Page', 'lege' ),
	'fields'           => array(

		array(
			'id'      => 'servicecurrency',
			'type'    => 'text',
			'title'   => __( 'Specify the Currency', 'lege' ),
			'default' =>'$'
		),
		array(
			'id'      => 'caseslabel',
			'type'    => 'text',
			'title'   => __( 'Title for the Cases Slider', 'lege' ),
			'default' => 'Посмотрите наши последние кейсы',
		),

		array(
			'id'      => 'servicearchivetitle11',
			'type'    => 'text',
			'title'   => __( 'Page Archive Heading 1', 'lege' ),
			'default' => 'НАШИ'
		),
		array(
			'id'      => 'servicearchivetitle12',
			'type'    => 'text',
			'title'   => __( 'Page Archive Heading 2', 'lege' ),
			'default' => 'УСЛУГИ'
		),
		array(
			'id'      => 'servicearchivedesc',
			'type'    => 'text',
			'title'   => __( 'Archive Page Description', 'lege' ),
			'default' => 'Вы хотите реализовать свои бизнес идеи?<br>Начало вашего нового бизнеса требует прочной юридической основы, и мы поможем вам на каждом этапе'
		),
	)
) );

Redux::set_section( $opt_name, array(
	'title'            => __( 'News', 'lege' ),
	'id'               => 'newsposttype',
	'subsection'       => true,
	'customizer_width' => '450px',
	'desc'             => __( 'Options for the News page', 'lege' ),
	'fields'           => array(
		array(
			'id'      => 'newstitle1',
			'type'    => 'text',
			'title'   => __( 'Heading (first part)', 'lege' ),
			'default' => 'Актуальные'
		),
		array(
			'id'      => 'newstitle2',
			'type'    => 'text',
			'title'   => __( 'Heading (second part)', 'lege' ),
			'default' => 'НОВОСТИ'
		),
		array(
			'id'      => 'newspostsperpage',
			'type'    => 'text',
			'title'   => __( 'Number of news items per page', 'lege' ),
			'default' => '4'
		),
		array(
			'id'      => 'categorytitle',
			'type'    => 'text',
			'title'   => __( 'Heading for category archive page', 'lege' ),
			'default' => 'Категории новостей'
		),

	)
) );

// Internal Pages
Redux::set_section( $opt_name, array(
	'title'            => __( 'Settings for Internal Pages', 'lege' ),
	'id'               => 'internalpages',
	'desc'             => __( 'Options for Internal Pages', 'lege' ),
	'customizer_width' => '400px',
	'icon'             => 'el el-home'
	) );

Redux::set_section( $opt_name, array(
	'title'            => __( 'Blog', 'lege' ),
	'id'               => 'blogposts',
	'subsection'       => true,
	'customizer_width' => '450px',
	'desc'             => __( 'Data for Blog Posts Page', 'lege' ),
	'fields'           => array(

		array(
			'id'      => 'bloglabel1',
			'type'    => 'text',
			'title'   => __( 'Specify the Label', 'lege' ),
			'default' =>'Наш'
		),
		array(
			'id'      => 'bloglabel2',
			'type'    => 'text',
			'title'   => __( 'Specify the Label', 'lege' ),
			'default' =>'БЛОГ'
		)
	)
) );

// Contact form concent checkbox
Redux::set_section( $opt_name, array(
	'title'            => __( 'Settings for Contact Form Policy Text', 'lege' ),
	'id'               => 'contactformconcent',
	'desc'             => __( 'Option for Contact Form Concent', 'lege' ),
	'customizer_width' => '400px',
	'icon'             => 'el el-home'
	) );

Redux::set_section( $opt_name, array(
	'title'            => __( 'Contact Form Policy Text', 'lege' ),
	'id'               => 'contactformpolicytext',
	'subsection'       => true,
	'customizer_width' => '450px',
	'desc'             => __( 'Data for Contact Form Concent Checkbox', 'lege' ),
	'fields'           => array(
		array(
			'id'       => 'lege_form_policy_text',
			'type'     => 'editor',
			'title'    => __( 'Текст согласия для формы', 'lege' ),
			'default'  => __( 'Я ознакомился и согласен с <a href="#">Правилами пользования</a> и <a href="#">политикой конфиденциальности</a> сайта', 'lege' ),
			'subtitle' => __( 'Этот текст будет отображаться рядом с чекбоксом согласия.', 'lege' ),
		),
	)
) );

// Settings for woocommerce shop page
Redux::set_section( $opt_name, array(
	'title'            => __( 'Settings for woocommerce shop page', 'lege' ),
	'id'               => 'woocommercesett',
	'desc'             => __( 'Option for woocommerce shop page', 'lege' ),
	'customizer_width' => '400px',
	'icon'             => 'el el-home'
	) );
	
Redux::set_section( $opt_name, array(
	'title'            => 'Магазин',
	'id'			   => 'woosettings',
	'subsection'       => true, 
	'customizer_width' => '450px',
	'desc'			 => __( 'Опции для страницы Магазина', 'lege' ),
	'fields'           => array(
		array(
			'id'      => 'wootitle1',
			'type'    => 'text',
			'title'   => __( 'Заголовок первой части', 'lege' ),
			'default' => 'НОВАЯ КОЛЛЕКЦИЯ 2018'
		),
		array(
			'id'      => 'wootitle2',
			'type'    => 'text',
			'title'   => __( 'Заголовок второй части', 'lege' ),
			'default' => 'FOR REAL MAN.'
		),
		array(
			'id'      => 'woolink',
			'type'    => 'text',
			'title'   => __( 'Ссылка на коллекцию', 'lege' ),
			'default' => '#'
		),
		array(
			'id'	  => 'woo_bg',
			'type'    => 'media',
			'url'     => true,
			'title'  => __( 'Фон для Шапки', 'lege' ),
			'compiler' => 'true',
			'desc'    => __( 'Загрузите картинку', 'lege' ),
			'default' => array( 'url' => get_template_directory_uri() . '/assets/img/wshop_bg.jpg'),
		)
	)
));

// -> END Basic Fields



/**
 * Raw README
 */
if ( file_exists( $dir . '/../README.md' ) ) {
	$section = array(
		'icon'   => 'el el-list-alt',
		'title'  => esc_html__( 'Documentation', 'lege' ),
		'fields' => array(
			array(
				'id'           => 'opt-raw-documentation',
				'type'         => 'raw',
				'markdown'     => true,
				'content_path' => __DIR__ . '/../README.md', // FULL PATH, not relative, please.
			),
		),
	);

	Redux::set_section( $opt_name, $section );
}

Redux::set_section(
	$opt_name,
	array(
		'icon'            => 'el el-list-alt',
		'title'           => esc_html__( 'Customizer Only', 'lege' ),
		'desc'            => '<p class="description">' . esc_html__( 'This Section should be visible only in Customizer', 'lege' ) . '</p>',
		'customizer_only' => true,
		'fields'          => array(
			array(
				'id'              => 'opt-customizer-only',
				'type'            => 'select',
				'title'           => esc_html__( 'Customizer Only Option', 'lege' ),
				'subtitle'        => esc_html__( 'The subtitle is NOT visible in customizer', 'lege' ),
				'desc'            => esc_html__( 'The field desc is NOT visible in customizer.', 'lege' ),
				'customizer_only' => true,
				'options'         => array(
					'1' => esc_html__( 'Opt 1', 'lege' ),
					'2' => esc_html__( 'Opt 2', 'lege' ),
					'3' => esc_html__( 'Opt 3', 'lege' ),
				),
				'default'         => '2',
			),
		),
	)
);

/*
 * <--- END SECTIONS
 */

/*
 * YOU MUST PREFIX THE FUNCTIONS BELOW AND ACTION FUNCTION CALLS OR OTHER CONFIGS MAY OVERRIDE YOUR CODE.
 */

/*
 * --> Action hook examples.
 */

// Function to test the compiler hook and demo CSS output.
// Above 10 is a priority, but 2 is necessary to include the dynamically generated CSS to be sent to the function.
// add_filter('redux/options/' . $opt_name . '/compiler', 'compiler_action', 10, 3);
//
// Change the arguments after they've been declared, but before the panel is created.
// add_filter('redux/options/' . $opt_name . '/args', 'change_arguments' );
//
// Change the default value of a field after it's been set, but before it's been used.
// add_filter('redux/options/' . $opt_name . '/defaults', 'change_defaults' );
//
// Dynamically add a section.
// It can be also used to modify sections/fields.
// add_filter('redux/options/' . $opt_name . '/sections', 'dynamic_section');
// .
if ( ! function_exists( 'compiler_action' ) ) {
	/**
	 * This is a test function that will let you see when the compiler hook occurs.
	 * It only runs if a field's value has changed and compiler => true is set.
	 *
	 * @param array  $options        Options values.
	 * @param string $css            Compiler selector CSS values  compiler => array( CSS SELECTORS ).
	 * @param array  $changed_values Any values that have changed since last save.
	 */
	function compiler_action( array $options, string $css, array $changed_values ) {
		echo '<h1>The compiler hook has run!</h1>';
		echo '<pre>';
		// phpcs:ignore WordPress.PHP.DevelopmentFunctions
		print_r( $changed_values ); // Values that have changed since the last save.
		// echo '<br/>';
		// print_r($options); //Option values.
		// echo '<br/>';
		// print_r($css); // Compiler selector CSS values compiler => array( CSS SELECTORS ).
		echo '</pre>';
	}
}

if ( ! function_exists( 'redux_validate_callback_function' ) ) {
	/**
	 * Custom function for the callback validation referenced above
	 *
	 * @param array $field          Field array.
	 * @param mixed $value          New value.
	 * @param mixed $existing_value Existing value.
	 *
	 * @return array
	 */
	function redux_validate_callback_function( array $field, $value, $existing_value ): array {
		$error   = false;
		$warning = false;

		// Do your validation.
		if ( 1 === (int) $value ) {
			$error = true;
			$value = $existing_value;
		} elseif ( 2 === (int) $value ) {
			$warning = true;
			$value   = $existing_value;
		}

		$return['value'] = $value;

		if ( true === $error ) {
			$field['msg']    = 'your custom error message';
			$return['error'] = $field;
		}

		if ( true === $warning ) {
			$field['msg']      = 'your custom warning message';
			$return['warning'] = $field;
		}

		return $return;
	}
}


if ( ! function_exists( 'dynamic_section' ) ) {
	/**
	 * Custom function for filtering the section array.
	 * Good for child themes to override or add to the sections.
	 * Simply include this function in the child themes functions.php file.
	 * NOTE: the defined constants for URLs and directories will NOT be available at this point in a child theme,
	 * so you must use get_template_directory_uri() if you want to use any of the built-in icons.
	 *
	 * @param array $sections Section array.
	 *
	 * @return array
	 */
	function dynamic_section( array $sections ): array {
		$sections[] = array(
			'title'  => esc_html__( 'Section via hook', 'lege' ),
			'desc'   => '<p class="description">' . esc_html__( 'This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.', 'lege' ) . '</p>',
			'icon'   => 'el el-paper-clip',

			// Leave this as a blank section, no options just some intro text set above.
			'fields' => array(),
		);

		return $sections;
	}
}

if ( ! function_exists( 'change_arguments' ) ) {
	/**
	 * Filter hook for filtering the args.
	 * Good for child themes to override or add to the args array.
	 * It can also be used in other functions.
	 *
	 * @param array $args Global arguments array.
	 *
	 * @return array
	 */
	function change_arguments( array $args ): array {
		$args['dev_mode'] = true;

		return $args;
	}
}

if ( ! function_exists( 'change_defaults' ) ) {
	/**
	 * Filter hook for filtering the default value of any given field. Very useful in development mode.
	 *
	 * @param array $defaults Default value array.
	 *
	 * @return array
	 */
	function change_defaults( array $defaults ): array {
		$defaults['str_replace'] = esc_html__( 'Testing filter hook!', 'lege' );

		return $defaults;
	}
}

if ( ! function_exists( 'redux_custom_sanitize' ) ) {
	/**
	 * Function to be used if the field sanitizes argument.
	 * Return value MUST be formatted or cleaned text to display.
	 *
	 * @param string $value Value to evaluate or clean.  Required.
	 *
	 * @return string
	 */
	function redux_custom_sanitize( string $value ): string {
		$return = '';

		foreach ( explode( ' ', $value ) as $w ) {
			foreach ( str_split( $w ) as $k => $v ) {
				if ( ( $k + 1 ) % 2 !== 0 && ctype_alpha( $v ) ) {
					$return .= mb_strtoupper( $v );
				} else {
					$return .= $v;
				}
			}

			$return .= ' ';
		}

		return $return;
	}
}
// phpcs:enable
