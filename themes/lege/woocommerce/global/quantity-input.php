<?php
/**
 * Product quantity inputs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/quantity-input.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 10.1.0
 *
 * Note: this theme overrides the template but preserves theme-specific
 * layout/classes (plus/minus buttons and input classes).
 */

defined( 'ABSPATH' ) || exit;

if ( $max_value && $min_value === $max_value ) {
	?>
	<div class="quantity hidden">
		<input type="hidden" id="<?php echo esc_attr( $input_id ); ?>" class="qty" name="<?php echo esc_attr( $input_name ); ?>" value="<?php echo esc_attr( $min_value ); ?>" />
	</div>
	<?php
} else {
	/* translators: %s: Quantity. */
	$label = ! empty( $args['product_name'] ) ? sprintf( esc_html__( '%s quantity', 'woocommerce' ), wp_strip_all_tags( $args['product_name'] ) ) : esc_html__( 'Quantity', 'woocommerce' );

	// Support variables introduced in newer templates but keep theme classes/layout.
	$type     = isset( $type ) ? $type : 'text';
	$classes  = isset( $classes ) ? (array) $classes : array( 'qty', 'text' );
	$readonly = ! empty( $readonly );

	?>

	<div class="quantity">
		<?php
		/**
		 * Hook to output something before the quantity input field.
		 *
		 * @since 7.2.0
		 */
		do_action( 'woocommerce_before_quantity_input_field' );
		?>
		<span class="minus" title="<?php echo esc_attr__( 'Nah, better a bit less', 'lege' ); ?>">-</span>

		<label class="screen-reader-text" for="<?php echo esc_attr( $input_id ); ?>"><?php echo esc_html( $label ); ?></label>		
		<input
			type="<?php echo esc_attr( $type ); ?>"
			<?php echo $readonly ? 'readonly="readonly"' : ''; ?>
			id="<?php echo esc_attr( $input_id ); ?>"
			class="qty text"
			step="<?php echo esc_attr( $step ); ?>"
			min="<?php echo esc_attr( $min_value ); ?>"
			<?php if ( 0 < $max_value ) : ?>
				max="<?php echo esc_attr( $max_value ); ?>"
			<?php endif; ?>
			<?php if ( ! $readonly ) : ?>
				step="<?php echo esc_attr( $step ); ?>"
				placeholder="<?php echo esc_attr( $placeholder ); ?>"
				inputmode="<?php echo esc_attr( $inputmode ); ?>"
				autocomplete="<?php echo esc_attr( isset( $autocomplete ) ? $autocomplete : 'on' ); ?>"
			<?php endif; ?>
			name="<?php echo esc_attr( $input_name ); ?>"
			value="<?php echo esc_attr( $input_value ); ?>"
			aria-label="<?php esc_attr_e( 'Product quantity', 'woocommerce' ); ?>"
			size="4"
			<?php 
			if ( ! empty( $input_attrs ) && is_array( $input_attrs )) {
				foreach ( $input_attrs as $attr => $val ) {
					printf( '%s="%s" ', esc_attr( $attr ), esc_attr( $val ) );
				}
			}
			?>
		/>
		<?php
		/**
		 * Hook to output something after quantity input field
		 *
		 * @since 3.6.0
		 */
		do_action( 'woocommerce_after_quantity_input_field' );
		?>
		<span class="plus" title="<?php echo esc_attr__( 'Yeah, yeah, more!', 'lege' ); ?>">+</span>
	</div>
	<?php
}
