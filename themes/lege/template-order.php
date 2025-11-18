<?php
/**
* Template name: Шаблон: заказ
*/

get_header();

$cost = 0;
$title = 'Not selected';
$content = 'Not selected';

if(isset($_GET["price"])) {
    $cost = $_GET["price"];
}
if(isset($_GET["title"])) {
    $title = $_GET["title"];
}
if(isset($_GET["content"])) {
    $content = $_GET["content"];
}

?>

<section class="inner order-page">
    <div class="wrapper">

    <?php while ( have_posts() ) : the_post(); ?>

        <div class="inner__content">
            <h2 class="inner__title inner-title"><span><?php the_title(); ?></h2>
            <div class="inner__img blue-noise">
                <?php echo get_the_post_thumbnail(get_the_ID(), 'full'); ?>
            </div>
            <div class="inner__block">
                <div class="inner__text">
                    <h5 class="inner__top"><?php echo esc_html($title); ?></h5>
                    
                    <?php
                    $trimmed_content = mb_substr($content, 0, 897);
                    $last_space = strrpos($trimmed_content, ' ');
                    if ($last_space !== false) {
                        $trimmed_content = substr($trimmed_content, 0, $last_space);
                    }
                        echo wp_kses_post($trimmed_content . '...');
                    ?>

                    <!-- Price -->
                    <span class="inner__price">$<?php echo esc_html($cost); ?></span>
                </div>

                <!-- Form -->
                <?php echo do_shortcode(get_metadata('post',get_the_ID(),'lege_shortcode_order',true)); ?>

            </div>
        </div>
        <?php endwhile; ?>
    </div>
</section>

<?php get_footer(); ?>
