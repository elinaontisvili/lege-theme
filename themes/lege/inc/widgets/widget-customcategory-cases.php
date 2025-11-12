<?php

class Lege_Category_Case_Widget extends WP_Widget
{

    /**
     * General Setup
     */
    public function __construct() {

        /* Widget settings. */
        $widget_ops = array(
            'classname' => 'lege_category_case_widget',
            'description' => 'Виджет который выводит блок категории'
        );
        /* Widget control settings. */
        $control_ops = array(
            'width'		=> 500,
            'height'	=> 450,
            'id_base'	=> 'lege_category_case_widget'
        );
        /* Create the widget. */
        parent::__construct( 'lege_category_case_widget', 'Lege | Категории Кейсов', $widget_ops, $control_ops );
    }

    /**
     * Display Widget
     * @param array $args
     * @param array $instance
     */
    public function widget( $args, $instance )
    {
        extract( $args );

        $title = $instance['title'];

        // Display Widget
        ?>

        <div class="widget categories side-nav">
            <h5 class="categories__title">
                <svg  width="19" height="19">
                    <use xlink:href="#content-post"/>
                </svg>
                <?php echo $title; ?>
            </h5>
            <ul>

                <?php $case_cats = get_terms( array(
                    'taxonomy' => 'feature-type',
                    'hide_empty' => true, // hide empty terms
                ) );

                foreach($case_cats as $cat){ ?>
                        <li>
                            <a href="<?php echo get_term_link($cat); ?>"><?php echo $cat->name; ?></a>
                            <span><?php echo $cat->count; ?></span>
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
            'title'		=> 'Категории кейсов',
        );
        $instance = wp_parse_args( (array) $instance, $defaults );

        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">Заголовок</label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
        </p>

        <?php
    }
}