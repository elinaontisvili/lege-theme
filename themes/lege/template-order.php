<?php
/**
*  Template name: Order page
*/

get_header();

$cost = 0;
$title = __( 'Not selected', 'lege' );
$content = '';

$service_id = isset( $_GET['service_id'] )
    ? absint( $_GET['service_id'] )
    : 0;

/*
* No Direct URL access
* No Invalid IDs
* No Wrong post types
* No Language mismatch
*/
$has_service_context = (
    $service_id &&
    get_post_status( $service_id ) &&
    get_post_type( $service_id ) === 'service'
);

// Translate service to current language
if ( function_exists( 'pll_get_post' ) && $service_id ) {
    $translated_id = pll_get_post( $service_id );
    if ( $translated_id ) {
        $service_id = $translated_id;
    }
}

if ( $service_id ) {
    $title   = get_the_title( $service_id );
    $content = wp_strip_all_tags(
        get_post_field( 'post_content', $service_id )
    );
    $cost    = get_post_meta( $service_id, 'lege_service_cost', true );
}

$cost = isset( $_GET['price'] )
    ? floatval( wp_unslash( $_GET['price'] ) )
    : 0;
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
            
                <?php if ( $has_service_context ) : ?>

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
                    
                <?php else : ?>

                    <div class="order-fallback">
                        <h5 class="inner__top">
                            <?php esc_html_e( 'No service selected', 'lege' ); ?>
                        </h5>

                        <p>
                            <?php esc_html_e(
                                'Please select a service first in order to proceed with your order.',
                                'lege'
                            ); ?>
                        </p>

                        <a href="<?php echo esc_url( get_post_type_archive_link( 'service' ) ); ?>"
                        class="btn">
                            <?php esc_html_e( 'View services', 'lege' ); ?>
                        </a>

                    </div>
                <?php endif; ?>

                <!-- Form -->
                <?php if($has_service_context) : ?>
                    <?php echo do_shortcode(get_metadata('post',get_the_ID(),'lege_shortcode_order',true)); ?>
                <?php endif; ?>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</section>

<?php get_footer(); ?>
