<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class(); ?>>

	<?php
	/**
	 * Hook: woocommerce_before_single_product_summary.
	 *
	 * @hooked woocommerce_show_product_sale_flash - 10
	 * @hooked woocommerce_show_product_images - 20
	 */
	do_action( 'woocommerce_before_single_product_summary' );
	?>
<!--
	<div class="product__gallery">
		<div class="product__main-photo">
			<img class="product__img" src="img/view1.jpg"
					alt="" data-index="0">
		</div>
		<div class="product__slider">
			<div class="product__item">
				<img class="product__pic" src="img/view2.jpg" alt="banner">
			</div>
			<div class="product__item">
				<img class="product__pic" src="img/view3.jpg" alt="banner">
			</div>
			<div class="product__item">
				<img class="product__pic" src="img/view4.jpg" alt="banner">
			</div>
			<div class="product__item">
				<img class="product__pic" src="img/view5.jpg" alt="banner">
			</div>
			<div class="product__item">
				<img class="product__pic" src="img/view1.jpg" alt="banner">
			</div>
		</div>
	</div>
-->
	<div class="product__about">

	<?php /* <div class="summary entry-summary"> */ ?>
		<?php
		/**
		 * Hook: woocommerce_single_product_summary.
		 *
		 * @hooked woocommerce_template_single_title - 5
		 * @hooked woocommerce_template_single_rating - 10
		 * @hooked woocommerce_template_single_price - 10
		 * @hooked woocommerce_template_single_excerpt - 20
		 * @hooked woocommerce_template_single_add_to_cart - 30
		 * @hooked woocommerce_template_single_meta - 40
		 * @hooked woocommerce_template_single_sharing - 50
		 * @hooked WC_Structured_Data::generate_product_data() - 60
		 */
		do_action( 'woocommerce_single_product_summary' );
		?>
	<?php /* </div> */ ?>

	</div>
</div>

<?php
/**
 * Hook: woocommerce_after_single_product_summary.
 *
 * @hooked woocommerce_output_product_data_tabs - 10
 * @hooked woocommerce_upsell_display - 15
 * @hooked woocommerce_output_related_products - 20
 */
//do_action( 'woocommerce_after_single_product_summary' );
?>

<div class="tabs">
	<ul class="tabs__caption">
		<li class="active">Описание</li>
		<li>Характеристики</li>
		<li>Отзывы <span>(2)</span></li>
	</ul>
	<div class="tabs__content active">
		<div class="description">
			<p>Уникальной особенностью «умных» часов Apple Watch Hermès 42mm из нержавеющей стали с ремешком Simple Tour из кожи Barenia цена на которые идеально соответствует безупречному качеству и впечатляющим характеристикам, стал ремешок Simple Tour. Он оснащён раскладывающейся застёжкой и изготовлен вручную из натуральной кожи Barenia, размер экрана составляет 42 мм по диагонали. Застёжка раскладывается при нажатии на кнопки с обеих сторон. Ремешок великолепно подходит для повседневного ношения, он не натирает запястье. Пользователь всегда может приобрести дополнительные ремешки, свободно заменяя их по мере необходимости.</p>
			<p>Новинка работает на микропроцессоре Apple S2 и имеет 8 GB встроенной памяти. Экран AMOLED обеспечивает великолепную цветопередачу и широчайшие углы обзора. Благодаря watchOS 3 Вы получаете доступ к огромной библиотеке разнообразных приложений, включая программы для фитнеса и регулярных тренировок!</p>
		</div>
		<img src="img/good-img.jpg" alt="Изображение">
	</div>
	<div class="tabs__content">
		<ul class="details">
			<li class="details__item">
				<p class="details__name">Исполнение</p>
				<ul>
					<li>Корпус: закаленная сталь</li>
					<li>Ремешок: кожа с классической застежкой</li>
					<li>Двухядерный процессор S2</li>
					<li>Цифровая коронка</li>
					<li>Водонепроницаемый корпус</li>
				</ul>
				<div class="details__block">
					<img src="img/display.jpg" alt="Дисплей">
					<ul>
						<li>Высота: 38.6 мм</li>
						<li>Ширина: 33.3 мм</li>
						<li>Толщина: 11.4 мм</li>
						<li>Вес: 41.9 г</li>
					</ul>
				</div>
			</li>
			<li class="details__item">
				<p class="details__name">Дисплей</p>
				<ul>
					<li>Более яркий Retina дисплей с функцией Force Touch</li>
					<li>Сапфировое стекло</li>
				</ul>
			</li>
			<li class="details__item">
				<p class="details__name">Батарея</p>
				<ul>
					<li>до 18 часов в режиме повседневного использования</li>
					<li>до 3 часа в режиме разговора</li>
					<li>до 6.5 часов прослушивания музыки</li>
					<li>до 8 часов в режиме тренировки</li>
					<li>Батарея заряжается с помощью индукционной зарядки на протяжении 1.5 (80%) - 2.5 (100%) часов</li>
				</ul>
			</li>
			<li class="details__item">
				<p class="details__name">Датчики</p>
				<ul>
					<li>Датчик сердечного ритма</li>
					<li>Акселерометр</li>
					<li>Гироскоп</li>
					<li>Датчик освещенности</li>
				</ul>
			</li>
			<li class="details__item">
				<p class="details__name">Коммуникации</p>
				<ul>
					<li>GPS</li>
					<li>Встроенный динамик и микрофон</li>
					<li>Wi-Fi (802.11b/g/n 2.4GHz)</li>
					<li>Bluetooth 4.0</li>
				</ul>
			</li>
		</ul>
	</div>
	<div class="tabs__content">
		<div class="clients">
			<div class="clients__box">
				<div class="clients__photo">
					<div class="clients__img">
						<img src="img/callback1.jpg" alt="Анна Свиридова">
					</div>
					<a href="#" class="clients__link">
						<svg  width="14" height="17">
							<use xlink:href="#facebook"/>
						</svg>
					</a>
				</div>
				<div class="clients__say">
					<p class="clients__name">Анна Свиридова</p>
					<div class="clients__text">
						<p>Новый этап в развитии, умные девайсы теперь можно носить на себе и через них можно управлять телефоном, планшетом, машиной. Apple Watch Series 3 — это не просто дубликатор уведомлений и трекер активности, это полезный, красивый и приятный в использовании гаджет. Они делают жизнь лучше, управление девайсами Apple — проще, а самое главное, позволяют избавиться от патологической привязанности к телефону.</p>
					</div>
					<div class="rate"></div>
				</div>
				<div class="add-time">
					<svg width="13" height="13">
						<use xlink:href="#time"/>
					</svg>
					<p class="add-time__date">20.05.2018</p>
				</div>
			</div>
			<div class="clients__box">
				<div class="clients__photo">
					<div class="clients__img">
						<img src="img/callback6.jpg" alt="Дмитрий Борсук">
					</div>
					<a href="#" class="clients__link">
						<svg  width="14" height="17">
							<use xlink:href="#facebook"/>
						</svg>
					</a>
				</div>
				<div class="clients__say">
					<p class="clients__name">Дмитрий Борсук</p>
					<div class="clients__text">
						<p>Поддавшись на рекламу купил себе Apple Watch Series 3. Что могу сказать - в первую очередь это игрушка. В отличии от смартфона это совершенно не необходимый аксессуар. Хотя польза от использования конечно есть. Если сравнивать его полезность и его цену, цена перевешивает сильнее полезности. Но! Я покупкой все равно доволен. А кто сказал что взрослым не нужны игрушки? Часы классно выглядят, делают использование смартфона удобнее за счет всяких уведомлений.</p>
					</div>
					<div class="rate"></div>
				</div>
				<div class="add-time">
					<svg width="13" height="13">
						<use xlink:href="#time"/>
					</svg>
					<p class="add-time__date">20.05.2018</p>
				</div>
			</div>
			<form action="#" class="log clients__form review-form" id="popupMessage">
				<p class="log__title">Оставьте ваш отзыв</p>
				<div class="log__wrap">
					<div class="log__group">
						<label>Имя</label>
						<input type="text" name="name" class="log__input">
					</div>
					<div class="log__group">
						<label>Email</label>
						<input type="email" name="email" class="log__input">
					</div>
					<div class="log__group">
						<label>Телефон</label>
						<input type="tel" name="tel" class="log__input">
					</div>
					<div class="log__group log__group_socials">
						<label>Ссылка на соцсеть</label>
						<input type="text" name="social" class="log__input">
					</div>
					<div class="log__group log__group_textarea">
						<label>Ваш отзыв</label>
						<textarea type="text" name="message" class="log__input"></textarea>
					</div>
					<p class="log__line"><span>*</span>Поля обязательные для заполнения</p>
					<div class="log__block">
						<div class="log__rate rating">
							<span>Ваша оценка</span>
							<div class="rating__choice" id="rate-choice">
								<div class="rating__group">
									<input type="radio" value="one-star" name="rating">
									<label></label>
								</div>
								<div class="rating__group">
									<input type="radio" value="two-star" name="rating">
									<label></label>
								</div>
								<div class="rating__group">
									<input type="radio" value="three-star" name="rating">
									<label></label>
								</div>
								<div class="rating__group">
									<input type="radio" value="four-star" name="rating">
									<label></label>
								</div>
								<div class="rating__group">
									<input type="radio" value="five-star" name="rating" checked="checked">
									<label></label>
								</div>
							</div>
						</div>
						<div class="log__btn">
							<input id="send" type="submit" data-submit value="Отправить" class="btn"/>
						</div>
					</div>
				</div>

			</form>
		</div>
	</div>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>

