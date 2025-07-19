<?php
/**
* Template Name: Шаблон: О Компании
*/
get_header();
?>



<?php while ( have_posts() ) : the_post();

the_content(); ?> <!-- штобы вывести контент страницы из админки -->

    <!-- Breadcrumbs -->
    <section class="breadcrumbs">
        <div class="wrapper">
            <ul class="breadcrumbs__list">
                <li class="breadcrumbs__item"><a href="/">Главная</a></li>
                <li class="breadcrumbs__item"><span>О компании</span></li>
            </ul>
        </div>
    </section><!-- End breadcrumbs -->


<!-- Choice -->
    <section class="choice">
        <div class="wrapper">
            <div class="choice__block">
                <div class="choice__image">
                    <div class="choice__pic blue-noise">
                        <img src="img/about.jpg" alt="JC">
                    </div>
                    <div class="director">
                        <div class="director__img">
                            <img src="img/director.jpg" alt="Дмитрий Львович">
                        </div>
                        <div class="director__text">
                            <p class="director__quote">Мы здесь, чтобы помочь вам построить и поддержать свою мечту.</p>
                            <div class="director__pers">
                                <span>Дмитрий Львович</span>
                                Директор компании
                            </div>
                        </div>
                        <div class="director__sign">
                            <img src="img/signature.png" alt="Подпись">
                        </div>
                    </div>
                </div>
                <div class="choice__wrap">
                    <h2 class="choice__title secondary-title"><span>Почему мы –</span><br>правильный выбор для вас</h2>
                    <div class="choice__descr">
                        <p>JC - это юридическая фирма с полным спектром услуг, специализирующаяся на стартапах, фрилансерах и малом бизнесе.</p>
                        <p>Мы придерживаемся принципа, что первоклассный юрисконсульт должен быть доступен для компаний всех размеров, у нас инновационный подход к традиционной культуре юридической фирмы.</p>
                        <p>Наша команда опытных юристов предоставит необходимые советы и рекомендации, которые помогут вам ориентироваться в сложных и эмоциональных юридических ситуациях.</p>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End choice -->

    <!-- Progress bars-->
    <section class="numbers">
        <div class="wrapper">

            <div class="numbers__item">
                <svg class="radial-progress" data-percentage="100" viewBox="0 0 80 80">
                    <!-- Gradient -->
                    <linearGradient id="linear-gradient">
                        <stop offset="0%" stop-color="#00a2ff"/>
                        <stop offset="100%" stop-color="#0cf"/>
                    </linearGradient>
                    <!-- Shadow -->
                    <defs>
                        <filter id="dropshadow" x="-40%" y="-40%" width="180%" height="180%" filterUnits="userSpaceOnUse">
                            <feOffset result="offOut" in="SourceGraphic" dx="0" dy="0" />
                            <feColorMatrix result="matrixOut" in="offOut" type="matrix"
                                values="0.5 0 0 0 0 0 0.5 0 0 0 0 0 0.5 0 0 0 0 0 1 0" />
                            <feGaussianBlur result="blurOut" in="matrixOut" stdDeviation="2" />
                            <feBlend in="SourceGraphic" in2="blurOut" mode="normal" />
                        </filter>
                        </defs>
                    
                    <circle class="incomplete" cx="40" cy="40" r="35">></circle>
                    <circle class="complete"  cx="40" cy="40" r="35" style="stroke-dashoffset: 39.58406743523136;"></circle>
                    <text class="percentage" x="50%" y="57%" transform="matrix(0, 1, -1, 0, 80, 0)"></text>
                </svg>
                <span class="numbers__text">Качество обслуживания</span>
            </div>

            <div class="numbers__item">
                <svg class="radial-progress" data-percentage="87" viewBox="0 0 80 80">
                    <circle class="incomplete" cx="40" cy="40" r="35"></circle>
                    <circle class="complete" cx="40" cy="40" r="35" style="stroke-dashoffset: 39.58406743523136;"></circle>
                    <text class="percentage" x="50%" y="57%" transform="matrix(0, 1, -1, 0, 80, 0)"></text>
                </svg>
                <span class="numbers__text">Довольных клиентов</span>
            </div>

            <div class="numbers__item">
                <svg class="radial-progress" data-percentage="66" viewBox="0 0 80 80">
                    <circle class="incomplete" cx="40" cy="40" r="35"></circle>
                    <circle class="complete" cx="40" cy="40" r="35" style="stroke-dashoffset: 39.58406743523136;"></circle>
                    <text class="percentage" x="50%" y="57%" transform="matrix(0, 1, -1, 0, 80, 0)"></text>
                </svg>
                <span class="numbers__text">Завершенных дел</span>
            </div>

            <div class="numbers__item">
                <svg class="radial-progress" data-percentage="31" viewBox="0 0 80 80">
                    <circle class="incomplete" cx="40" cy="40" r="35"></circle>
                    <circle class="complete" cx="40" cy="40" r="35" style="stroke-dashoffset: 39.58406743523136;"></circle>
                    <text class="percentage" x="50%" y="57%" transform="matrix(0, 1, -1, 0, 80, 0)"></text>
                </svg>
                <span class="numbers__text">Достигнутых целей</span>
            </div>
        </div>
    </section>
    <!-- End progress -->

    <!-- Team -->
    <section class="team">
        <div class="wrapper">
            <h2 class="team__title secondary-title"><span>Наша</span><br>команда</h2>
        </div>
        <div class="wrapper sl">
            <div class="team__slider">
                <!-- One slide -->
                <div class="team__slide">
                    <div class="team__item">
                        <div class="team__img">
                            <img src="img/pers3.jpg" alt="Андрей Егоров">
                            <p class="team__pers">Андрей Егоров</p>
                            <p class="team__position">Старший партнер</p>
                        </div>
                        <div class="description">
                            <p>Сергей помог бесчисленным компаниям справиться с юридическими и нормативными трудностями и стать процветающими источниками дохода и создания рабочих мест в Москве</p>
                            <ul class="social">
                                <li class="social__item">
                                    <span>Vk</span>
                                    <a class="social__icon social__icon_vk" href="#">
                                        <svg  width="21" height="18">
                                            <use xlink:href="#vk"/>
                                        </svg>
                                    </a>
                                </li>
                                <li class="social__item">
                                    <span>Fb</span>
                                    <a class="social__icon social__icon_fb" href="#">
                                        <svg  width="14" height="17">
                                            <use xlink:href="#facebook"/>
                                        </svg>
                                    </a>
                                </li>
                                <li class="social__item">
                                    <span>Tw</span>
                                    <a class="social__icon social__icon_tw" href="#">
                                        <svg  width="18" height="15">
                                            <use xlink:href="#twitter"/>
                                        </svg>
                                    </a>
                                </li>
                                <li class="social__item">
                                    <a class="social__icon social__icon_inst" href="#">
                                        <svg width="16" height="16">
                                            <use xlink:href="#instagram"/>
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div><!-- End one slide -->
            
                <div class="team__slide">
                    <div class="team__item">
                        <div class="team__img">
                            <img src="img/pers1.jpg" alt="Сергей Михайленко ">
                            <p class="team__pers">Сергей Михайленко </p>
                            <p class="team__position">Старший юрист</p>
                        </div>
                        <div class="description">
                            <p>Сергей помог бесчисленным компаниям справиться с юридическими и нормативными трудностями и стать процветающими источниками дохода и создания рабочих мест в Москве</p>
                            <ul class="social">
                                <li class="social__item">
                                    <span>Vk</span>
                                    <a class="social__icon social__icon_vk" href="#">
                                        <svg  width="21" height="18">
                                            <use xlink:href="#vk"/>
                                        </svg>
                                    </a>
                                </li>
                                <li class="social__item">
                                    <span>Fb</span>
                                    <a class="social__icon social__icon_fb" href="#">
                                        <svg  width="14" height="17">
                                            <use xlink:href="#facebook"/>
                                        </svg>
                                    </a>
                                </li>
                                <li class="social__item">
                                    <span>Tw</span>
                                    <a class="social__icon social__icon_tw" href="#">
                                        <svg  width="18" height="15">
                                            <use xlink:href="#twitter"/>
                                        </svg>
                                    </a>
                                </li>
                                <li class="social__item">
                                    <a class="social__icon social__icon_inst" href="#">
                                        <svg width="16" height="16">
                                            <use xlink:href="#instagram"/>
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            
                <div class="team__slide">
                    <div class="team__item">
                        <div class="team__img">
                            <img src="img/pers2.jpg" alt="Мария Юмашева">
                            <p class="team__pers">Мария Юмашева</p>
                            <p class="team__position">Старший юрист</p>
                        </div>
                        <div class="description">
                            <p>Сергей помог бесчисленным компаниям справиться с юридическими и нормативными трудностями и стать процветающими источниками дохода и создания рабочих мест в Москве</p>
                            <ul class="social">
                                <li class="social__item">
                                    <span>Vk</span>
                                    <a class="social__icon social__icon_vk" href="#">
                                        <svg  width="21" height="18">
                                            <use xlink:href="#vk"/>
                                        </svg>
                                    </a>
                                </li>
                                <li class="social__item">
                                    <span>Fb</span>
                                    <a class="social__icon social__icon_fb" href="#">
                                        <svg  width="14" height="17">
                                            <use xlink:href="#facebook"/>
                                        </svg>
                                    </a>
                                </li>
                                <li class="social__item">
                                    <span>Tw</span>
                                    <a class="social__icon social__icon_tw" href="#">
                                        <svg  width="18" height="15">
                                            <use xlink:href="#twitter"/>
                                        </svg>
                                    </a>
                                </li>
                                <li class="social__item">
                                    <a class="social__icon social__icon_inst" href="#">
                                        <svg width="16" height="16">
                                            <use xlink:href="#instagram"/>
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            
                <div class="team__slide">
                    <div class="team__item">
                        <div class="team__img">
                            <img src="img/pers1.jpg" alt="Сергей Михайленко ">
                            <p class="team__pers">Сергей Михайленко </p>
                            <p class="team__position">Старший юрист</p>
                        </div>
                        <div class="description">
                            <p>Сергей помог бесчисленным компаниям справиться с юридическими и нормативными трудностями и стать процветающими источниками дохода и создания рабочих мест в Москве.
                            Сергей помог бесчисленным компаниям справиться с юридическими и нормативными трудностями и </p>
                            <ul class="social">
                                <li class="social__item">
                                    <span>Vk</span>
                                    <a class="social__icon social__icon_vk" href="#">
                                        <svg  width="21" height="18">
                                            <use xlink:href="#vk"/>
                                        </svg>
                                    </a>
                                </li>
                                <li class="social__item">
                                    <span>Fb</span>
                                    <a class="social__icon social__icon_fb" href="#">
                                        <svg  width="14" height="17">
                                            <use xlink:href="#facebook"/>
                                        </svg>
                                    </a>
                                </li>
                                <li class="social__item">
                                    <span>Tw</span>
                                    <a class="social__icon social__icon_tw" href="#">
                                        <svg  width="18" height="15">
                                            <use xlink:href="#twitter"/>
                                        </svg>
                                    </a>
                                </li>
                                <li class="social__item">
                                    <a class="social__icon social__icon_inst" href="#">
                                        <svg width="16" height="16">
                                            <use xlink:href="#instagram"/>
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End team -->

    <!-- Connect -->
    <section class="connect">
        <div class="connect__decor"></div>
        <div class="wrapper">
            <div class="connect__wrap">
                <h3 class="connect__title">Свяжитесь с нами, чтобы узнать, как&nbsp;мы можем помочь вашему бизнесу</h3>
                <a href="contacts.html#callback" class="connect__btn btn-white popup-link">Связаться с нами</a>
            </div>
            <div class="connect__img"></div>
        </div>
    </section><!-- End connect -->

    <!-- Offices -->
    <section class="offices">
        <div class="wrapper">
            <h2 class="offices__title secondary-title"><span>Наши офисы расположены по</span><br>всей России</h2>
            <div class="map">
                <div class="address address_01">
                    <div class="address__descr">
                        <div class="address__img blue-noise">
                            <img src="img/office.jpg" alt="Изображение">
                        </div>
                        <p class="address__text">
                            <span>Главный офис</span>
                            г. Москва, ул. Бутырская, 62 Z-Plaza, 5-й этаж
                        </p>
                    </div>
                </div>
                <div class="address address_02">
                    <div class="address__descr">
                        <div class="address__img blue-noise">
                            <img src="img/office.jpg" alt="Изображение">
                        </div>
                        <p class="address__text">
                            <span>Офис в Калининграде</span>
                            г. Москва, ул. Бутырская, 62 Z-Plaza, 5-й этаж
                        </p>
                    </div>
                </div>
                <div class="address address_03">
                    <div class="address__descr">
                        <div class="address__img blue-noise">
                            <img src="img/office.jpg" alt="Изображение">
                        </div>
                        <p class="address__text">
                            <span>Офис в Казани</span>
                            г. Москва, ул. Бутырская, 62 Z-Plaza, 5-й этаж
                        </p>
                    </div>
                </div>
                <div class="address address_04">
                    <div class="address__descr">
                        <div class="address__img blue-noise">
                            <img src="img/office.jpg" alt="Изображение">
                        </div>
                        <p class="address__text">
                            <span>Офис в Тюмени</span>
                            г. Москва, ул. Бутырская, 62 Z-Plaza, 5-й этаж
                        </p>
                    </div>
                </div>
                <div class="address address_05">
                    <div class="address__descr">
                        <div class="address__img blue-noise">
                            <img src="img/office.jpg" alt="Изображение">
                        </div>
                        <p class="address__text">
                            <span>Офис в Благовещенске</span>
                            г. Москва, ул. Бутырская, 62 Z-Plaza, 5-й этаж
                        </p>
                    </div>
                </div>
                <div class="address address_06">
                    <div class="address__descr">
                        <div class="address__img blue-noise">
                            <img src="img/office.jpg" alt="Изображение">
                        </div>
                        <p class="address__text">
                            <span>Офис в Норильске</span>
                            г. Москва, ул. Бутырская, 62 Z-Plaza, 5-й этаж
                        </p>
                    </div>
                </div>
                <div class="address address_07">
                    <div class="address__descr">
                        <div class="address__img blue-noise">
                            <img src="img/office.jpg" alt="Изображение">
                        </div>
                        <p class="address__text">
                            <span>Офис во Владивостоке</span>
                            г. Москва, ул. Бутырская, 62 Z-Plaza, 5-й этаж
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End offices -->


<?php endwhile;


?>

<?php get_footer();