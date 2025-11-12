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

        <h2 class="clients__title secondary-title"><span><?php echo $lege_options['casearchivetitle1']; ?></span><br><?php echo $lege_options['casearchivetitle2']; ?></h2>
			
			<?php

			if ( have_posts() ) :

				while ( have_posts() ) : the_post(); ?>

					<article class="news__item">
						<div class="news__wrap">
							<div class="news__img blue-noise">

								<?php echo get_the_post_thumbnail(get_the_ID(),'news-thumb'); ?>
								<ul class="tags-list">
									<?php
										$taxonomies = get_object_taxonomies(get_post_type(), 'objects');
										foreach ($taxonomies as $taxonomy) {
											if ($taxonomy->public && ! $taxonomy->hierarchical) continue;
											$terms = get_the_terms(get_the_ID(), $taxonomy->name);
											if ($terms && !is_wp_error($terms)) {
												foreach ($terms as $term) {
													echo '<li><a href="' . esc_url(get_term_link($term)) . '">' . esc_html($term->name) . '</a></li>';
												}
											}
										}
										?>
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
											<span><?php esc_html_e('Vk','lege'); ?></span>
											<a data-social="vkontakte" onclick="window.open(this.href, 'Share on VK', 'width=600,height=300'); return false" class="social__icon social__icon_vk" href="<?php echo esc_url( lege_get_share('vk', get_the_permalink(), get_the_title()) ); ?>">
												<svg  width="21" height="18">
													<use xlink:href="#vk"/>
												</svg>
											</a>
										</li>
										<li class="social__item">
											<span><?php esc_html_e('Fb','lege'); ?></span>
											<a data-social="facebook" onclick="window.open(this.href, 'Share on Facebook', 'width=600,height=300'); return false" class="social__icon social__icon_fb" href="<?php echo esc_url( lege_get_share('fb', get_the_permalink(), get_the_title()) ); ?>">
												<svg  width="14" height="17">
													<use xlink:href="#facebook"/>
												</svg>
											</a>
										</li>
										<li class="social__item">
											<span><?php esc_html_e('Tw', 'lege'); ?></span>
											<a data-social="twitter" onclick="window.open(this.href, 'Share on Twitter', 'width=600,height=300'); return false" class="social__icon social__icon_tw" href="<?php echo esc_url( lege_get_share('twi', get_the_permalink(), get_the_title()) ); ?>">
												<svg  width="18" height="15">
													<use xlink:href="#twitter"/>
												</svg>
											</a>
										</li>
									</ul>
								</div>
								<a href="<?php the_permalink(); ?>" class="news__link link-more">
									<?php esc_html_e('Читать больше', 'lege'); ?>
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

				wp_reset_postdata();

			endif; ?>

			<?php if($wp_query->max_num_pages > 1){ ?>
				<nav class="pagination">
					<div class="nav-links">
						<?php
						//Выводим левую стрелку для первой страницы
						if( get_query_var('paged') == 0){ ?>
							<span class="prev page-numbers"></span>
						<?php } ?>

						<?php

						//Вывод стандартной пагинации
						$big = 999999999; // need an unlikely integer

						echo paginate_links( array(
							'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
							'format' => 'page/%#%/',
							'current' => max( 1, get_query_var('paged') ? get_query_var('paged') : get_query_var('page') ),
							'prev_text'          => '',
							'next_text'          => '',
							'total' => $wp_query->max_num_pages
						) );
						?>

						<?php
						//Выводим правую стрелку для последней страницы
						if( get_query_var('paged') == $wp_query->max_num_pages){ ?>
							<span class="next page-numbers"></span>
						<?php } ?>
					</div>
				</nav>
			<?php } ?>

		</div>

		<?php get_sidebar('sidebarcases'); ?>
	</div>
</section>

<?php
get_footer();
