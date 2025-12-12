<?php 
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Lege
 */

get_header();

global $lege_options;

?>

<section class="inner events">
    <div class="wrapper">
        <div class="news">
            <h2 class="news__title secondary-title"><span><?php echo esc_html( $lege_options['newstitle1'] ); ?></span><br><?php echo esc_html( $lege_options['newstitle2'] ); ?></h2>

            <?php
            // Pagination
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

            if ( have_posts() ) : 
                while ( have_posts() ) : the_post(); ?> 

            <article class="news__item">
                <div class="news__wrap">
                    <div class="news__img blue-noise">
                        <?php echo get_the_post_thumbnail(get_the_ID(), 'news-thumb'); ?>
                        <ul class="tags-list">
                            <?php $news_categories = wp_get_post_terms(get_the_ID(),'news-category'); 
                            foreach($news_categories as $category){ ?>
                                <li><a href="<?php echo esc_url( get_term_link($category) ); ?>"><?php echo esc_html ( $category->name ); ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="news__side">
                        <div class="add-time">
                            <svg width="13" height="13">
                                <use xlink:href="#time"/>
                            </svg>
                            <p class="add-time__date"><?php echo get_the_date(); ?></p>
                        </div>
                        <div class="rate"></div>
                        <div class="share">
                            <p class="share__title">
                                <svg width="15" height="15">
                                    <use xlink:href="#link"/>
                                </svg>
                                <?php esc_html_e('Share:', 'lege'); ?>
                            </p>
                            <ul class="social">
                                <li class="social__item">
                                    <span><?php esc_html_e('Vk','lege'); ?></span>
                                    <a data-social="vkontakte" class="social__icon social__icon_vk" href="<?php echo esc_url( lege_get_share(type: 'vk', permalink: get_the_permalink(), title: get_the_title()) ); ?>">
                                        <svg  width="21" height="18">
                                            <use xlink:href="#vk"/>
                                        </svg>
                                    </a>
                                </li>
                                <li class="social__item">
                                    <span><?php esc_html_e('Fb','lege'); ?></span>
                                    <a data-social="facebook" class="social__icon social__icon_fb" href="<?php echo esc_url( lege_get_share(type: 'fb', permalink: get_the_permalink(), title: get_the_title()) ); ?>">
                                        <svg  width="14" height="17">
                                            <use xlink:href="#facebook"/>
                                        </svg>
                                    </a>
                                </li>
                                <li class="social__item">
                                    <span><?php esc_html_e('Tw','lege'); ?></span>
                                    <a data-social="twitter" class="social__icon social__icon_tw" href="<?php echo esc_url( lege_get_share(type: 'twi', permalink: get_the_permalink(), title: get_the_title()) ); ?>">
                                        <svg  width="18" height="15">
                                            <use xlink:href="#twitter"/>
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <a href="<?php echo esc_url( get_permalink() ); ?>" class="news__link link-more">
                            <?php esc_html_e( 'Read more', 'lege' ); ?>
                            <svg width="18" height="20">
                                <use xlink:href="#nav-right"/>
                            </svg>
                        </a>
                    </div>
                </div>
                <h5 class="news__heading"><?php the_title(); ?></h5>
                <p class="news__text"><?php the_excerpt(); ?></p>
            </article>
            
            <?php endwhile; 
else :
                echo "<div>No news found</div>";

            endif; ?>

            <!-- Pagination -->
            <?php 
            
            if ( $wp_query->max_num_pages > 1 ) { ?> 
            <nav class="pagination">
                <div class="nav-links">

                    <?php 
                    if( get_query_var('paged') < 2){ ?>
                        <span class="prev page-numbers"></span>
                    <?php } ?>

                    <?php
                    $big = 999999999;

                    echo paginate_links( array(
                        'base'    => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                        'format'  => '?paged=%#%',
                        'current' => max( 1, get_query_var('paged') ),
                        'prev_text'          => '',
                        'next_text'          => '',
                        'total'     => $wp_query->max_num_pages,
                    ) ); ?>

                    <?php 
                    if( get_query_var('paged') == $wp_query->max_num_pages){ ?>
                        <span class="next page-numbers"></span>
                    <?php } ?>

                </div>
            </nav>
            <?php } ?>
        </div>
        <?php get_sidebar(); ?>
    </div>
</section>
<?php get_footer(); ?>