<?php
get_header();

global $lege_options;
?>

<section class="inner clients">
    <div class="wrapper">
        <h2 class="clients__title secondary-title"><span><?php echo $lege_options['testylabel1']; ?></span><br><?php echo $lege_options['testylabel2']; ?></h2>
        
        <?php
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
                        <p class="add-time__date"><?php echo $date; ?></p>
                    </div>
                    <?php } ?>
                </div>

            <?php endwhile; else :

                echo "<div>Нет отзывов</div>";

        endif; ?>

        <nav class="pagination">
            <div class="nav-links">
                <a href="#" class="prev page-numbers"></a>
                <a href="#" class=" page-numbers">1</a>
                <span href="#" class="current page-numbers">2</span>
                <a href="#" class="page-numbers">3</a>
                <a href="#" class="page-numbers">4</a>
                <a href="#" class="page-numbers">5</a>
                <span class="page-numbers page-break">...</span>
                <a href="#" class=" page-numbers">7</a>
                <a href="#" class="next page-numbers"></a>
            </div>
        </nav>
        <div class="clients__form-block">
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
                    <div class="log__btn">
                        <input id="send" type="submit" data-submit value="Отправить" class="btn"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<?php get_footer(); ?>