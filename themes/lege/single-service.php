<?php get_header(); ?>

		<section class="inner service">
			<div class="wrapper">

            <?php while ( have_posts() ) : the_post(); ?>

            <div class="inner__content">
					<h2 class="inner__title inner-title"><span><?php the_title(); ?></span></h2>
					<div class="inner__img blue-noise">
						<?php echo get_the_post_thumbnail(get_the_ID(), 'full'); ?> 
						
                        <?php $image_data = lege_get_attachment(get_post_thumbnail_id(get_the_ID())); ?> 
                        <p class="inner__short"><?php echo esc_html($image_data['description']); ?></p>
						
                        <span class="inner__price"><?php echo esc_html($lege_options['servicecurrency']); echo get_metadata('post',get_the_ID(), 'lege_service_cost', true); ?></span>
					</div>
					<div class="inner__text">
                    <?php the_content(); ?>
                        <?php
                            $price = get_metadata('post',get_the_ID(),'lege_service_cost',true);
                        ?>
                        <a href="<?php echo esc_url(home_url('/order/') . '?price=' . urlencode($price) . '&title=' . rawurlencode(get_the_title()) . '&content=' . rawurlencode(strip_tags(get_the_content()))); ?>" class="inner__btn btn">Заказать</a>
                    </div>
				</div>

            <?php endwhile; ?>
				
			<!-- Slider -->
				<div class="cases">
					<h4 class="cases__cap">Посмотрите наши последние кейсы</h4>
					<div class="cases__slider">
						<div class="cases__slide">
							<div class="cases__item">
								<div class="cases__block">
									<h3 class="cases__heading">Представление интересов компании PPD</h3>
									<a href="#" class="cases__link link-more">
										Читать больше
										<svg width="18" height="20">
											<use xlink:href="#nav-right"/>
										</svg>
									</a>
								</div>
								<div class="cases__img">
									<img src="img/case4.jpg" alt="Изображение">
								</div>
							</div>
						</div>
						<div class="cases__slide">
							<div class="cases__item">
								<div class="cases__block">
									<h3 class="cases__heading">Вывод денег через текущие платежи</h3>
									<a href="#" class="cases__link link-more">
										Читать больше
										<svg width="18" height="20">
											<use xlink:href="#nav-right"/>
										</svg>
									</a>
								</div>
								<div class="cases__img">
									<img src="img/case2.jpg" alt="Изображение">
								</div>
							</div>
						</div>
						<div class="cases__slide">
							<div class="cases__item">
								<div class="cases__block">
									<h3 class="cases__heading">Взыскание задолженности с дебитора</h3>
									<a href="#" class="cases__link link-more">
										Читать больше
										<svg width="18" height="20">
											<use xlink:href="#nav-right"/>
										</svg>
									</a>
								</div>
								<div class="cases__img">
									<img src="img/case1.jpg" alt="Изображение">
								</div>
							</div>
						</div>
						<div class="cases__slide">
							<div class="cases__item">
								<div class="cases__block">
									<h3 class="cases__heading">Урегулирование налогового спора</h3>
									<a href="#" class="cases__link link-more">
										Читать больше
										<svg width="18" height="20">
											<use xlink:href="#nav-right"/>
										</svg>
									</a>
								</div>
								<div class="cases__img">
									<img src="img/case3.jpg" alt="Изображение">
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</section><!-- End slider -->

<?php get_footer(); 
