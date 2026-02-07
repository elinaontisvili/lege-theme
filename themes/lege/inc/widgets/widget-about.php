<?php
/**
 * Blog Widget 
 */
class Lege_About_Widget extends WP_Widget 
{
	public $image_field = 'image';
	
	/**
	 * General Setup 
	 */
	public function __construct() {
	
		/* Widget settings. */
		$widget_ops = array(
			'classname' => 'lege_about_widget', 
			'description' => __('A widget that displays a short information about the company.', 'lege') 
		);

		/* Widget control settings. */
		$control_ops = array(
			'width'		=> 500, 
			'height'	=> 450, 
			'id_base'	=> 'lege_about_widget' 
		);

		/* Create the widget. */
		parent::__construct( 'lege_about_widget', __('Lege - About Widget', 'lege'), $widget_ops, $control_ops );
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

        $title = __( $instance['title'] );
        $text  = __( $instance['text'] );
        $link_more = !empty($instance['link_more']) ? __( $instance['link_more'] ) : '';

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

                <a href="<?php echo esc_url( __( $link_more ) ); ?>" class="banner__btn btn" data-content="<?php echo esc_attr( __( 'Read more', 'lege' ) ); ?>"><?php echo esc_html( __( 'Read more', 'lege' ) ); ?></a>

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

        // Handle ID | URL format
        if ( ! empty( $new_instance['image'] ) ) {
            $image_data = sanitize_text_field( $new_instance['image'] );
            // Extract ID (first part before |)
            $image_parts = explode( '|', $image_data );
            $instance['image'] = intval( $image_parts[0] );
        } else {
            $instance['image'] = '';
        }

        return $instance;
	}

	/**
	 * Widget Settings
	 * @param array $instance 
	 */
    public function form( $instance ) {
        $defaults = array(
            'title'     => __('Company title', 'lege'),
            'text'      => __('Company description', 'lege'),
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
            <label><?php esc_html_e('Image:', 'lege'); ?></label><br>
            <input type="text"
                class="widefat lege-image-url"
                name="<?php echo esc_attr( $this->get_field_name('image') ); ?>"
                value="<?php echo esc_attr( $instance['image'] ); ?>" />
            <button class="button lege-media-button">
                <?php esc_html_e('Select Image', 'lege'); ?>
            </button>
        </p>
    <?php
    }
}