<?php

class Lege_PriceRange_Widget extends WP_Widget
{

    /**
     * General Setup
     */
    public function __construct() {

        /* Widget settings. */
        $widget_ops = array(
            'classname' => 'lege_pricerange_widget',
            'description' => 'Виджет который выводит блок с фильтром по цене'
        );
        /* Widget control settings. */
        $control_ops = array(
            'width'		=> 500,
            'height'	=> 450,
            'id_base'	=> 'lege_pricerange_widget'
        );
        /* Create the widget. */
        parent::__construct( 'lege_pricerange_widget', 'Lege | Ajax Фильтрация', $widget_ops, $control_ops );
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

        $prices = $this->get_filtered_price();
        $min_price = floor( $prices->min_price);
        $max_price = ceil( $prices->max_price);

        global $woocommerce;

        ?>
        <div class="sortby lege_sortby" data-minprice="<?php echo esc_attr($min_price); ?>" data-maxprice="<?php echo esc_attr($max_price); ?>"> 
            <h5 class="sortby__title"><?php echo esc_html( $title ); ?></h5>
            <div id="slider-range"></div>
            <p class="sortby__price">
                <label for="amount"><?php esc_html_e( 'Цена：', 'lege' ); ?></label>
                <span class="field">
                    <?php echo get_woocommerce_currency_symbol(); ?><input type="text" id="priceMin" class="min_price"> - <?php echo get_woocommerce_currency_symbol(); ?> <input type="text" id="priceMax" class="max_price">
                </span>
            </p>
        </div>
        <?php
    }

    protected function get_filtered_price() {
		global $wpdb;

		$args       = WC()->query->get_main_query()->query_vars;
		$tax_query  = isset( $args['tax_query'] ) ? $args['tax_query'] : array();
		$meta_query = isset( $args['meta_query'] ) ? $args['meta_query'] : array();

		if ( ! is_post_type_archive( 'product' ) && ! empty( $args['taxonomy'] ) && ! empty( $args['term'] ) ) {
			$tax_query[] = WC()->query->get_main_tax_query();
		}

		foreach ( $meta_query + $tax_query as $key => $query ) {
			if ( ! empty( $query['price_filter'] ) || ! empty( $query['rating_filter'] ) ) {
				unset( $meta_query[ $key ] );
			}
		}

		$meta_query = new WP_Meta_Query( $meta_query );
		$tax_query  = new WP_Tax_Query( $tax_query );
		$search     = WC_Query::get_main_search_query_sql();

		$meta_query_sql   = $meta_query->get_sql( 'post', $wpdb->posts, 'ID' );
		$tax_query_sql    = $tax_query->get_sql( $wpdb->posts, 'ID' );
		$search_query_sql = $search ? ' AND ' . $search : '';

		$sql = "
			SELECT min( min_price ) as min_price, MAX( max_price ) as max_price
			FROM {$wpdb->wc_product_meta_lookup}
			WHERE product_id IN (
				SELECT ID FROM {$wpdb->posts}
				" . $tax_query_sql['join'] . $meta_query_sql['join'] . "
				WHERE {$wpdb->posts}.post_type IN ('" . implode( "','", array_map( 'esc_sql', apply_filters( 'woocommerce_price_filter_post_type', array( 'product' ) ) ) ) . "')
				AND {$wpdb->posts}.post_status = 'publish'
				" . $tax_query_sql['where'] . $meta_query_sql['where'] . $search_query_sql . '
			)';

		$sql = apply_filters( 'woocommerce_price_filter_sql', $sql, $meta_query_sql, $tax_query_sql );

		return $wpdb->get_row( $sql ); // WPCS: unprepared SQL ok.
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
            pll_register_string( 'Price Range Widget Title', $instance['title'], 'Widgets' );
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
            'title'		=> 'Сортировать по цене',
        );
        $instance = wp_parse_args( (array) $instance, $defaults );

        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Фильтрация по цене | Заголовок', 'lege' ); ?></label>
            <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
        </p>

        <?php
    }
}