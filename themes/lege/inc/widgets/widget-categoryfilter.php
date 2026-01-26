<?php

class Lege_Category_Filter_Widget extends WP_Widget
{

    /**
     * General Setup
     */
    public function __construct() {

        /* Widget settings. */
        $widget_ops = array(
            'classname' => 'lege_categoryfilter_widget',
            'description' => 'A widget that displays a block with filtering by product categories'
        );
        /* Widget control settings. */
        $control_ops = array(
            'width'		=> 500,
            'height'	=> 450,
            'id_base'	=> 'lege_categoryfilter_widget'
        );
        /* Create the widget. */
        parent::__construct( 'lege_categoryfilter_widget', 'Lege | Ajax Filtering by Product Categories', $widget_ops, $control_ops );
    }

    /**
     * Display Widget
     * @param array $args
     * @param array $instance
     */
    public function widget( $args, $instance )
    {
        extract( $args );

        $title = __( $instance['title']); 

        ?>
        <div class="categories side-nav log">
        <h5 class="categories__title"><?php echo esc_html( $title ); ?></h5>
        <div id="st-accordion" class="st-accordion">
            <ul>

            <?php 

            $categories = get_terms(
                'product_cat',
                array( 
                    'hierarchical' => true,
                    'hide_empty'   => 1,
                    'parent'       => 0,  
                    )
                );

                foreach($categories as $cat) { ?>
                <li class="lege_filter_check">
                    <?php $temp_cat = get_terms(
                        'product_cat', 
                        array(
                            'orderby'      => 'name', 
                            'hierarchical' => true,
                            'hide_empty'   => 1, 
                            'parent'       => $cat->term_id,
                        )
                    );
                
                    $class="";
                    if($temp_cat) {$class="has_child";} else {$class="no_child";} ?> 

                    <a href="#" class="<?php echo esc_attr($class); ?>"><?php echo esc_html($cat->name); ?>
                </a> 

                <?php 

                if($temp_cat) { 
                    echo '<div class="st-content cat-list">'; 

                    foreach ($temp_cat as $temp) { ?> 
                    <div class="log__group check"> 
                        <input id="term<?php echo (int)$temp->term_id; ?>" type="checkbox" name="category" value="<?php echo esc_attr( $temp->term_id ); ?>"> 
                        <label for="term<?php echo (int)$temp->term_id; ?>"><?php echo esc_html($temp->name); ?></label> 
                    </div> 
                    <?php }
                    echo '</div>';
                }
                ?>

                <li>
                <?php } ?> 
            </ul>
        </div>
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
            'title'		=> 'Product categories',
        );
        $instance = wp_parse_args( (array) $instance, $defaults );

        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Filter by category | Heading', 'lege' ); ?></label>
            <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
        </p>

        <?php
    }
}