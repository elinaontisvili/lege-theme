<?php
if ( ! is_active_sidebar( 'sidebar-1' ) ) {
    return;
}
?>

<aside class="sidebar">
  <?php dynamic_sidebar( 'sidebar-1' ); ?>

	<div class="categories side-nav">
		<h5 class="categories__title">
			<svg  width="19" height="19">
				<use xlink:href="#content-post"/>
			</svg>
			Категории новостей
		</h5>
		<ul>
			<li>
				<a href="#">Налоги и бухучет</a>
				<span>8</span>
			</li>
			<li>
				<a href="#">Судебная практика</a>
				<span>15</span>
			</li>
			<li>
				<a href="#">Социальная сфера</a>
				<span>5</span>
			</li>
			<li>
				<a href="#">Образование</a>
				<span>7</span>
			</li>
			<li>
				<a href="#">Новости в сфере IT</a>
				<span>33</span>
			</li>
			<li>
				<a href="#">Бизнес</a>
				<span>31</span>
			</li>
			<li>
				<a href="#">Проверки</a>
				<span>14</span>
			</li>
		</ul>
	</div>

	<div class="banner" style="background: url(img/banner.jpg) no-repeat center top/ cover;">
		<h4 class="banner__title">Юридические консультации для малого бизнеса</h4>
		<p class="banner__text">Не позволяйте юридическим вопросам отвлекать вас от ведения бизнеса</p>
		<a href="#" class="banner__btn btn">Подробнее</a>
	</div>

	<div class="subscr">
		<div class="subscr__title">
			<svg  width="19" height="19">
				<use xlink:href="#mail"/>
			</svg>
			Подписаться на рассылку
		</div>
		<form action="#" class="subscr__form log" id="popupSubscribe">
			<div class="log__group">
				<label>Имя</label>
				<input type="text" name="name_mod" class="log__input">
			</div>
			<div class="log__group">
				<label>Email</label>
				<input type="email" name="email" class="log__input">
			</div>
			<div class="log__btn">
				<input id="subscribe" type="submit" data-submit value="Подписаться" class="btn"/>
			</div>
		</form>
	</div>
</aside>

