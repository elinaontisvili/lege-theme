<?php

class Lege_Category_Widget extends WP_Widget
{

    /**
     * General Setup
     */
    public function __construct() {

        /* Widget settings. */
        $widget_ops = array(
            'classname' => 'lege_category_widget',
            'description' => 'Виджет который выводит блок категории'
        );
        /* Widget control settings. */
        $control_ops = array(
            'width'		=> 500,
            'height'	=> 450,
            'id_base'	=> 'lege_category_widget'
        );
        /* Create the widget. */
        parent::__construct( 'lege_category_widget', 'Lege | Категории', $widget_ops, $control_ops );
    }

    /**
     * Display Widget
     * @param array $args
     * @param array $instance
     */
    public function widget( $args, $instance )
    {
        extract( $args );

        $title = pll__( $instance['title'] );

        // Display Widget
        ?>

        <div class="widget categories side-nav">
            <h5 class="categories__title">
                <svg  width="19" height="19">
                    <use xlink:href="#content-post"/>
                </svg>
                <?php echo esc_html( $title ); ?>
            </h5>
            <ul>

                <?php $news_cats = get_terms( array(
                    'taxonomy' => 'news-category',
                    'hide_empty' => false,
                ) );

                foreach($news_cats as $cat){ ?>
                        <li>
                            <a href="<?php echo esc_url(get_term_link($cat)); ?>"><?php echo esc_html($cat->name); ?></a>
                            <span><?php echo (int) $cat->count; ?></span>
                        </li>
                    <?php
                } ?>
            </ul>
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

        $instance['title'] = strip_tags( $new_instance['title'] );

        // Register strings for Polylang 
        if ( function_exists( 'pll_register_string' ) ) {
            pll_register_string( 'Categories Widget Title', $instance['title'], 'Widgets' );
        } 

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
            'title'		=> 'Категории новостей',
        );
        $instance = wp_parse_args( (array) $instance, $defaults );

        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Заголовок', 'lege' ); ?></label>
            <input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
        </p>

        <?php
    }
}