<?php
class Lege_Customsearch_Widget extends WP_Widget
{
    /**
     * General Setup
     */
    public function __construct() {

        /* Widget settings. */
        $widget_ops = array(
            'classname' => 'lege_customsearch_widget',
            'description' => 'Виджет который выводит персональный поиск'
        );
        /* Widget control settings. */
        $control_ops = array(
            'width'		=> 500,
            'height'	=> 450,
            'id_base'	=> 'lege_customwidget_widget'
        );
        /* Create the widget. */
        parent::__construct( 'lege_customwidget_widget', 'Lege | Персональный поиск', $widget_ops, $control_ops );
    }

    /**
     * Display Widget
     * @param array $args
     * @param array $instance
     */
    public function widget( $args, $instance )
    {
        extract( $args );

        $custom_placeholder = $instance['custom_placeholder'];
        $custom_post_type = $instance['custom_post_type'];


        // Display Widget
        ?>

        <div class="widget widget_customsearch" >
            <form role="search" method="get" id="searchform" action="<?php echo esc_url( home_url("/") ); ?>">

                <input class="text-search" type="search" name="s" value="" placeholder="<?php echo esc_attr( $custom_placeholder ); ?>">
                <input type="hidden" name="post_type" value="<?php echo esc_attr( $custom_post_type ); ?>" />
                <input type="submit" class="submit-search" value="" />

            </form>
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

        $instance['custom_placeholder'] = strip_tags( $new_instance['custom_placeholder'] );
        $instance['custom_post_type'] = strip_tags( $new_instance['custom_post_type'] );

        return $instance;
    }

    /**
     * Widget Settings
     * @param array $instance
     */
    public function form( $instance )
    {
        //default widget settings.
        $defaults = array(
            'custom_placeholder'		=> 'Поиск по Новостям',
            'custom_post_type'		    => 'news',
        );
        $instance = wp_parse_args( (array) $instance, $defaults );

        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'custom_placeholder' )); ?>"><?php esc_html__('Заголовок', 'lege' ); ?></label>
            <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'custom_placeholder' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'custom_placeholder' )); ?>" value="<?php echo esc_attr($instance['custom_placeholder']); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'custom_post_type' )); ?>"><?php esc_html__('Заголовок', 'lege' ); ?></label>
            <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'custom_post_type' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'custom_post_type' )); ?>" value="<?php echo esc_attr($instance['custom_post_type']); ?>" />
        </p>

        <?php
    }
}
