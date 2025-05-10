<?php get_header(); 

global $wp_query;
?>
<section class="inner events">
    <div class="wrapper">
        <div class="news">
            <h2 class="news__title secondary-title"><span><?php echo $lege_options['categorytitle']; ?></span><br><?php echo single_term_title(); ?></h2>

            <!-- цикл -->
            <?php

            if ( have_posts() ) : 
                while ( have_posts() ) : the_post(); ?>
            <!-- цикл -->

            <article class="news__item">
                <div class="news__wrap">
                    <div class="news__img blue-noise">
                        <?php echo get_the_post_thumbnail(get_the_ID(), 'news-thumb'); ?>
                        <ul class="tags-list">
                            <?php $news_categories = wp_get_post_terms(get_the_ID(),'news-category'); 
                            foreach($news_categories as $category){ ?>
                                <li><a href="<?php echo get_term_link($category); ?>"><?php echo $category->name; ?></a></li>
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
                                <?php esc_html_e('Поделиться:', 'lege'); ?>
                            </p>
                            <ul class="social">
                                <li class="social__item">
                                    <span>Vk</span>
                                    <a data-social="vkontakte" class="social__icon social__icon_vk" href="<?php echo lege_get_share(type: 'vk', permalink: get_the_permalink(), title: get_the_title()); ?>">
                                        <svg  width="21" height="18">
                                            <use xlink:href="#vk"/>
                                        </svg>
                                    </a>
                                </li>
                                <li class="social__item">
                                    <span>Fb</span>
                                    <a data-social="facebook" class="social__icon social__icon_fb" href="<?php echo lege_get_share(type: 'fb', permalink: get_the_permalink(), title: get_the_title()); ?>">
                                        <svg  width="14" height="17">
                                            <use xlink:href="#facebook"/>
                                        </svg>
                                    </a>
                                </li>
                                <li class="social__item">
                                    <span>Tw</span>
                                    <a data-social="twitter" class="social__icon social__icon_tw" href="<?php echo lege_get_share(type: 'twi', permalink: get_the_permalink(), title: get_the_title()); ?>">
                                        <svg  width="18" height="15">
                                            <use xlink:href="#twitter"/>
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <a href="<?php echo esc_url( get_permalink() ); ?>" class="news__link link-more">
                            <?php esc_html_e( 'Читать больше', 'lege' ); ?>
                            <svg width="18" height="20">
                                <use xlink:href="#nav-right"/>
                            </svg>
                        </a>
                    </div>
                </div>
                <h5 class="news__heading"><?php the_title(); ?></h5>
                <p class="news__text"><?php the_excerpt(); ?></p>
            </article>
            
            <!-- цикл -->
            <?php endwhile; 
            wp_reset_postdata(); 
else :
                echo "<div>Нет новых новостей</div>";

            endif; ?>
            <!-- цикл -->

            <!-- Pagination -->
            <?php if($wp_query->max_num_pages > 1) { ?> 
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
                        'total'   => $wp_query->max_num_pages
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