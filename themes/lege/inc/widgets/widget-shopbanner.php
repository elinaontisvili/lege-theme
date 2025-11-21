<?php
/**
 * Blog Widget 
 */
class Lege_Shopbanner_Widget extends WP_Widget 
{
	public $image_field = 'image';
	
	/**
	 * General Setup 
	 */
	public function __construct() {
	
		/* Widget settings. */
		$widget_ops = array(
			'classname' => 'lege_shopbanner_widget', 
			'description' => __('A widget that displays a product on sale.', 'lege') 
		);

		/* Widget control settings. */
		$control_ops = array(
			'width'		=> 500, 
			'height'	=> 450, 
			'id_base'	=> 'lege_shopbanner_widget' 
		);

		/* Create the widget. */
		parent::__construct( 'lege_shopbanner_widget', __('Lege - Shop Banner Widget', 'lege'), $widget_ops, $control_ops );
	}

	/**
	 * Display Widget
	 * @param array $args
	 * @param array $instance 
	 */
public function widget( $args, $instance ) {
    extract( $args );

    $instance = wp_parse_args( (array) $instance, array(
        'title'     => __('Company title', 'lege'),
        'text'      => __('Company description', 'lege'),
        'link_more' => '',
        'image'     => 0,
    ) );

    // Polylang
    $title = pll__( $instance['title'] );
    $text  = pll__( $instance['text'] );
    $link_more = !empty($instance['link_more']) ? pll__( $instance['link_more'] ) : '';

    /* Our variables from the widget settings. */
    $image_id = (int) $instance[$this->image_field];

    $image      = new Lege_WidgetImageField( $this, $image_id, 'image' );
    $image_src = $image->get_image_src();

    // Display Widget
    ?> 
        <div class="banner"<?php if ( $image_src ) echo ' style="background-image: url(' . esc_url( $image_src ) . '); background-size: cover; background-position: center;"'; ?>>
            <?php if ( $title ) : ?>
                <h4 class="banner__title"><?php echo esc_html( $title ); ?></h4>
            <?php endif; ?>

            <p class="banner__text"><?php echo wp_kses_post( $text ); ?></p>

            <?php if ( $link_more ) : ?>
                <a href="<?php echo esc_url( pll__( $link_more ) ); ?>" class="banner__btn" ><?php echo esc_html( __( 'Buy', 'lege' ) ); ?></a>
            <?php endif; ?>
        </div>
    <?php
}

	/**
	 * Update Widget
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array 
	 */
	public function update( $new_instance, $old_instance ) 
	{
		$instance = $old_instance;
		
        $instance['title'] = sanitize_text_field( $new_instance['title'] );
        $instance['text'] = sanitize_textarea_field( $new_instance['text'] );
        $instance['link_more'] = esc_url_raw( $new_instance['link_more'] );

        $instance['image'] = ! empty( $new_instance['image'] ) ? intval( $new_instance['image'] ) : '';

        // Register strings for Polylang
        if ( function_exists( 'pll_register_string' ) ) {
            pll_register_string( 'Shop Widget Title', $instance['title'], 'Widgets' );
            pll_register_string( 'Shop Widget Text', $instance['text'], 'Widgets' );
            pll_register_string( 'Shop Widget Link', $instance['link_more'], 'Widgets' );
        }

		return $instance;
	}
	
	/**
	 * Widget Settings
	 * @param array $instance 
	 */
public function form( $instance ) {
    $defaults = array(
        'title'     => __('Product title', 'lege'),
        'text'      => __('Product description', 'lege'),
        'link_more' => "",
        'image'     => 0,
    );
    $instance = wp_parse_args( (array) $instance, $defaults ); 

    $image_id = isset( $instance[$this->image_field] ) ? (int) $instance[$this->image_field] : 0;
    $image      = new Lege_WidgetImageField( $this, $image_id );
    ?>
    <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e('Title:', 'lege') ?></label>
        <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
    </p>
    <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>"><?php esc_html_e('Description:', 'lege') ?></label>
        <textarea class="widefat" cols="100" rows="5" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>" ><?php echo esc_textarea( $instance['text'] ); ?></textarea>
    </p>
    <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'link_more' ) ); ?>"><?php esc_html_e('Url:', 'lege') ?></label>
        <textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_more' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_more' ) ); ?>" ><?php echo esc_textarea( $instance['link_more'] ); ?></textarea>
    </p>
    <p>
    <label><?php esc_html_e('Image:', 'lege'); ?> </label>
        <?php
            $field_html = $image->get_widget_field();

            if (is_string($field_html)) {
                echo $field_html;
            }
        ?>
    </p>
<?php
}
}