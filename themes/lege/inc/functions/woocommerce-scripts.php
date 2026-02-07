<?php
/*
 * AJAX handler for WooCommerce filter 
 */

function lege_show_products(){

    $query_data = $_GET;

    $paged = (isset($query_data['paged']) ) ? intval($query_data['paged']) : 1;

    /* Set orderby (default = date) */
    $orderby = isset($query_data['orderby']) ? sanitize_text_field($query_data['orderby']) : 'date';

    $posts_per_page = get_option('woocommerce_catalog_columns') * get_option('woocommerce_catalog_rows');

    /* Filter by category IDs */
    $cats = !empty($query_data['category']) ? explode('.', $query_data['category']) : false;

    $tax_query = $cats ? [
        [
            'taxonomy' => 'product_cat',
            'field'    => 'id',
            'terms'    => $cats,
        ]
    ] : [];

    /* Base query */
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

    /* Sorting logic */
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

                    /* Выводим левую стрелку для первой страницы */
                    if( $paged == 0 or $paged == 1){ ?>
                        <span class="prev page-numbers"></span>
                    <?php } ?>

                    <?php

                    /* Вывод стандартной пагинации */
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

                    /* Выводим правую стрелку для последней страницы */
                    if( $paged == $loop->max_num_pages){ ?>
                        <span class="next page-numbers"></span>
                    <?php } ?>
                </div>
            </nav>
        <?php } ?>
    </nav>

  <?php
    } else {
        echo esc_html__( 'No products found','lege' );
    }

    wp_reset_postdata();
    die();
}
add_action('wp_ajax_lege_filter', 'lege_show_products');
add_action('wp_ajax_nopriv_lege_filter', 'lege_show_products');