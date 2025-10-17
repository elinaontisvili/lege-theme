<?php
/**
 * Description tab
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.0.0
 */

defined( 'ABSPATH' ) || exit;

global $post;

$heading = apply_filters( 'woocommerce_product_description_heading', __( 'Description', 'lege' ) );

?>

<div class="description_box">

	<?php the_content(); ?>
</div>

<?php 
$image_url = get_post_meta( get_the_ID(), 'lege_photo_one', true );
$image_alt = get_post_meta( get_the_ID(), 'lege_photo_one_alt', true );

if ( $image_url ) : ?>
    <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $image_alt ?: get_the_title() ); ?>">
<?php endif; ?>
