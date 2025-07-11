<?php
/**
* Template Name: Шаблон: Контакты
*/
get_header(); ?>

<section class="inner contacts">
    <div class="wrapper">
        <div class="detail">
            <p class="detail__title">Как нас найти</p>
            <ul class="contact">
                <li class="contact__item">
                    <div class="contact__icon">
                        <svg width="19" height="24">
                            <use xlink:href="#pin"/>
                        </svg>
                    </div>
                    <p class="contact__text contact__text_address">г. Москва, ул. Бутырская, 62
        Z&#8209;Plaza, 5-й этаж</p>
                </li>
                <li class="contact__item">
                    <div class="contact__icon">
                        <svg width="17" height="17">
                            <use xlink:href="#phone"/>
                        </svg>
                    </div>
                    <div class="contact__phones">
                        <a href="#" class="contact__text contact__text_phone">+ 7 (495) 577-18-11</a>
                        <a href="#" class="contact__text contact__text_phone">+ 7 (495) 567-28-15</a>
                    </div>
                </li>
                <li class="contact__item">
                    <div class="contact__icon">
                        <svg width="23" height="17">
                            <use xlink:href="#mail"/>
                        </svg>
                    </div>
                    <p class="contact__text contact__text_mail">JClegal@gmail.com</p>
                </li>
            </ul>
            <div class="detail__time">
                <svg width="35" height="35">
                    <use xlink:href="#time"/>
                </svg>
                <p>Мы работаем с 9:00 до 22:00 в&nbsp;рабочие дни</p>
            </div>
        </div>
        <form action="#" class="inner__form log" id="popupOrder">
            <p class="log__title">Получите бесплатную консультацию уже сегодня</p>
            <p class="log__subtitle">Оставьте свои контакнтые данные и мы свяжемся с вами в ближайшее время</p>
            <div class="log__group">
                <label>Имя</label>
                <input type="text" name="name" class="log__input">
            </div>
            <div class="log__group">
                <label>Телефон</label>
                <input type="tel" name="tel" class="log__input">
            </div>
            <div class="log__group log__group_company">
                <label>Компания</label>
                <input type="text" name="company" class="log__input">
            </div>
            <div class="log__group log__group_textarea">
                <label>Сообщение</label>
                <textarea type="text" name="message" class="log__input"></textarea>
            </div>
            <p class="log__line"><span>*</span>Поля обязательные для заполнения</p>
            <div class="log__wrap">
                <div class="log__group check">
                    <input id="insight" type="checkbox" name="learn" value="learn">
                    <label for="insight">Я ознакомился и согласен с <span><a href="#">Правилами пользования</a></span> и <span><a href="#">политикой конфиденциальности</a></span> сайта</label>
                </div>
                <div class="log__btn">
                    <input id="order" data-submit type="submit" value="Отправить" class="btn"/>
                </div>
            </div>
        </form>
    </div>
</section>
<section class="map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2242.467066602709!2d37.581592916069305!3d55.80249139562584!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46b549fcd3aad429%3A0xae911a34e0878489!2z0JHRg9GC0YvRgNGB0LrQsNGPINGD0LsuLCA2Miwg0JzQvtGB0LrQstCwLCAxMjcwMTU!5e0!3m2!1sru!2sru!4v1534159137914" frameborder="0" style="border:0" allowfullscreen></iframe>
</section>

<?php get_footer();