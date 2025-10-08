<?php
/**
 * Template Name: Шаблон: Корзина и Оформление заказа
 */

get_header(); 
?> 

<section class="single cart pay"> 
    <div class="wrapper"> 
        <?php while (have_posts()) : the_post(); the_content(); endwhile; ?>
    </div>
</section>

<?php 

get_footer();
