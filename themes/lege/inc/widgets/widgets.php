<?php

/*
 * Register Sidebars
 */
function lege_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar1', 'lege' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'lege' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="subscr__title"><svg width="19" height="19"><use xlink:href="#mail"></use></svg>',
        	'after_title'   => '</div>'
		)
	);
	register_sidebar(
		array(
			'name'			=> esc_html__('Sidebar Cases', 'lege' ),
			'id'			=> 'sidebarcases',
			'description'	=> esc_html__('Add widgets here.', 'lege' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>', 
			'before_title'  => '<div class="subscr__title"><svg width="19" height="19"><use xlink:href="#mail"></use></svg>',
			'after_title'	=> '</div>'
		)
	);
	/*
    register_sidebar(
		array(
			'name'          => esc_html__( 'Shop', 'lege' ),
			'id'            => 'woocommerce',
			'description'   => esc_html__( 'Add widgets here.', 'lege' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	*/
	register_sidebar(
		array(
			'name'          => esc_html__( 'Shop', 'lege' ),
			'id'            => 'woocommerce',
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
 * Register Theme Widgets 
 */
function lege_init_widgets() {
    register_widget('Lege_About_Widget');
	register_widget('Lege_Category_Widget');
	register_widget('Lege_Subscribe_Widget');
	register_widget('Lege_Customsearch_Widget');
	register_widget('Lege_Shopbanner_Widget');
	register_widget('Lege_PriceRange_Widget');
	register_widget('Lege_Category_Filter_Widget');
	register_widget('Lege_Rating_Widget');
	register_widget('Lege_Category_Case_Widget');
}

add_action('widgets_init', 'lege_init_widgets');

/**
 * Image field for widgets 
 */
class Lege_WidgetImageField {

	private $widget;
	private $field_name;
	private $attachment_id;

	public function __construct( $widget, $attachment_id = 0, $field_name = 'image' ) {
		$this->widget        = $widget;
		$this->field_name    = $field_name;
		$this->attachment_id = $attachment_id;
	}

	public function get_image_src() {
		if ( $this->attachment_id ) {
			$image = wp_get_attachment_image_src( $this->attachment_id, 'medium' );
			if ( $image ) {
				return $image[0];
			}
		}
		return '';
	}

	public function get_widget_field() {
		$field_id    = $this->widget->get_field_id( $this->field_name );
        $field_name  = $this->widget->get_field_name( $this->field_name );
		$image_thumb = $this->get_image_src();

		ob_start();
		?>
		<div class="lege-widget-image-field">
			<div class="lege-widget-preview">
				<?php if ( $image_thumb ) : ?>
					<img src="<?php echo esc_url( $image_thumb ); ?>" style="max-width:100%;" />
				<?php endif; ?>
			</div>

			<input type="hidden"
            id="<?php echo esc_attr( $field_id ); ?>"
            name="<?php echo esc_attr( $field_name ); ?>"
            value="<?php echo is_scalar( $this->attachment_id ) ? esc_attr( $this->attachment_id ) : ''; ?>" />

			<button class="button lege-upload-image"><?php esc_html_e( 'Choose Image', 'lege' ); ?></button>
			<button class="button lege-remove-image"><?php esc_html_e( 'Remove Image', 'lege' ); ?></button>
		</div>

		<?php
		return ob_get_clean();
	}
}
