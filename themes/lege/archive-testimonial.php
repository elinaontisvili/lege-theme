<?php
get_header();

global $lege_options;
?>

<section class="inner clients">
    <div class="wrapper">
        <h2 class="clients__title secondary-title"><span><?php echo esc_html( $lege_options['testylabel1'] ); ?></span><br><?php echo esc_html( $lege_options['testylabel2'] ); ?></h2>
        
        <?php

        // Pagination
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;


        if ( have_posts() ) : 
            while ( have_posts() ) : the_post(); ?> 

                <div class="clients__box">
                    <div class="clients__photo">
                        <div class="clients__img">
                            <?php echo get_the_post_thumbnail(get_the_ID(), 'testimonial-thumb'); ?>
                        </div>

                        <?php $fb = get_metadata('post', get_the_ID(), 'lege_social_link', true); ?>
                        <?php if($fb) { ?>
                        <a href="<?php echo esc_url($fb); ?>" class="clients__link">
                            <svg  width="14" height="17">
                                <use xlink:href="#facebook"/>
                            </svg>
                        </a>
                        <?php } ?>
                    </div>
                    <div class="clients__say">
                        <p class="clients__name"><?php the_title(); ?></p>
                        <div class="clients__text">
                            <?php the_content(); ?>
                        </div>
                    </div>

                    <?php $date = get_metadata('post', get_the_ID(), 'lege_testy_date', true); ?>
                    <?php if($date) { ?>
                    <div class="add-time">
                        <svg width="13" height="13">
                            <use xlink:href="#time"/>
                        </svg>
                        <p class="add-time__date"><?php echo esc_html( $date ); ?></p>
                    </div>
                    <?php } ?>
                </div>

            <?php endwhile; ; 
else :

                echo "<div>No testimonials found</div>";

            endif; ?>

        <!-- Pagination -->
        <?php 

        global $wp_query;

        if ( $wp_query->max_num_pages > 1 ) { 
            
        ?> 
            <nav class="pagination">
                <div class="nav-links">

                    <?php 
                    // Выводим левую стрелку для первой страницы.
                    if( get_query_var('paged') < 2){ ?>
                        <span class="prev page-numbers"></span>
                    <?php } ?>

                    <?php
                    // Вывод стандартной пагинации.
                    $big = 999999999;

                    echo paginate_links( array(
                        'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                        'format'    => '?paged=%#%',
                        'current'   => max( 1, get_query_var('paged') ),
                        'total'     => $wp_query->max_num_pages,
                        'prev_text' => '',
                        'next_text' => '',
                    ) );
                    ?>

                    <?php 
                    // Выводим правую стрелку для последней страницы.
                    if( get_query_var('paged') == $wp_query->max_num_pages){ ?>
                        <span class="next page-numbers"></span>
                    <?php } ?>

                </div>
            </nav>
            <?php } ?>
        <!-- Pagination end -->

        <?php echo do_shortcode($lege_options['testimonial_form_shortcode']); ?>

    </div>
</section>

<?php

get_footer();