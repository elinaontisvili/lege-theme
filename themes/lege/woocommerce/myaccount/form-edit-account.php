<?php
/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.7.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Hook - woocommerce_before_edit_account_form.
 *
 * @since 2.6.0
 */
do_action( 'woocommerce_before_edit_account_form' );

$user_id = get_current_user_id(); 
$user = get_userdata( $user_id ); 

if ( ! $user )
	return; 

$phone = get_user_meta( $user_id, 'billing_phone', true );
?>


<form action="" id="displayMessage" method="post" class="cabinet__form woocommerce-EditAccountForm edit-account" <?php do_action( 'woocommerce_edit_account_form_tag' ); ?> style="flex-wrap:wrap;">

<div class="avatar" style="width:100%">
		<div class="avatar__img" style="margin: 0 auto">
			<img src="<?php echo get_avatar_url($user_id, array('size' => 200)); ?>" alt="Personal photo">
			<a href="http://gravatar.com" title="Delete avatar" class="avatar__delete"></a>
		</div>
		<div class="avatar__load" style="margin: 7px auto;">
			<a href="http://gravatar.com">
			<button type="button">
				<svg>
					<use xlink:href="#camera"/>
				</svg>
				<?php esc_html_e('Change avatar', 'lege'); ?>
			</button>
			</a>
		</div>
	</div>
	<div class="edit" style="width: 100%">
		<a href="<?php echo wp_logout_url(home_url()); ?>" class="exit">
			<svg class="exit__icon" width="17" height="15">
				<use xlink:href="#login"/>
			</svg>
			<?php esc_html_e('Logout', 'lege'); ?>
		</a>
		<span class="modal-сaution"><?php esc_html_e('Personal data has been successfully changed', 'lege'); ?></span>
		
<div class="edit__block">
		
<?php do_action('woocommerce_edit_account_form_start'); ?>
		
<div class="woocommerce-form-row woocommerce-form-row--first form-row edit__group">
		<label for="account_first_name"><?php esc_html_e( 'First name', 'lege' ); ?>&nbsp;<span class="required" aria-hidden="true">*</span></label>
		<input type="text" class="woocommerce-Input woocommerce-Input--text edit__input" name="account_first_name" id="account_first_name" autocomplete="given-name" value="<?php echo esc_attr( $user->first_name ); ?>" aria-required="true" />
</div>

<div class="woocommerce-form-row woocommerce-form-row--last form-row edit__group">
		<label for="account_last_name"><?php esc_html_e( 'Last name', 'lege' ); ?>&nbsp;<span class="required" aria-hidden="true">*</span></label>
		<input type="text" class="woocommerce-Input woocommerce-Input--text edit__input" name="account_last_name" id="account_last_name" autocomplete="family-name" value="<?php echo esc_attr( $user->last_name ); ?>" aria-required="true" />
</div>

<div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide edit__group">
		<label for="account_display_name"><?php esc_html_e( 'Display name', 'lege' ); ?>&nbsp;<span class="required" aria-hidden="true">*</span></label>
		<input type="text" class="woocommerce-Input woocommerce-Input--text edit__input" name="account_display_name" id="account_display_name" aria-describedby="account_display_name_description" value="<?php echo esc_attr( $user->display_name ); ?>" aria-required="true" /> <span id="account_display_name_description" class="modal-text"><em><?php esc_html_e( 'This will be how your name will be displayed in the account section and in reviews', 'lege' ); ?></em></span>
</div>

	<div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide edit__group">
		<label for="account_email"><?php esc_html_e( 'Email address', 'lege' ); ?>&nbsp;<span class="required" aria-hidden="true">*</span></label>
		<input type="email" class="woocommerce-Input woocommerce-Input--email edit__input" name="account_email" id="account_email" autocomplete="email" value="<?php echo esc_attr( $user->user_email ); ?>" aria-required="true" />
</div>

	<?php
		/**
		 * Hook where additional fields should be rendered.
		 *
		 * @since 8.7.0
		 */
		do_action( 'woocommerce_edit_account_form_fields' );
	?>

		<div class="edit__group">
			<label><?php esc_html_e('Phone','lege'); ?></label>
			<input type="tel" name="billing_phone" class="edit__input" value="<?php echo esc_attr($phone); ?>" >
		</div>

	<div class="edit__group show-pass woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
		<label for="password_current"><?php esc_html_e( 'Current password', 'lege' ); ?></label>
		<input id="edit-pass" type="password" class="woocommerce-Input woocommerce-Input--password edit__input" name="password_current" id="password_current" autocomplete="off" />
		<span class="edit__eye password-eye" data-target="#edit-pass">
			<svg width="34" height="22">
				<use xlink:href="#eye"/>
			</svg>
		</span>
	</div>

	<div class="edit__group show-pass woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
		<label for="password_1"><?php esc_html_e( 'New password', 'lege' ); ?></label>
		<input id="edit-pass" type="password" class="woocommerce-Input woocommerce-Input--password edit__input" name="password_1" id="password_1" autocomplete="off" />
		<span class="edit__eye password-eye" data-target="#edit-pass">
			<svg width="34" height="22">
				<use xlink:href="#eye"/>
			</svg>
		</span>
	</div>
	<div class="edit__group show-pass woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
		<label for="password_2"><?php esc_html_e( 'Confirm new password', 'lege' ); ?></label>
		<input id="edit-pass" type="password" class="woocommerce-Input woocommerce-Input--password edit__input" name="password_2" id="password_2" autocomplete="off" />
		<span class="edit__eye password-eye" data-target="#edit-pass">
			<svg width="34" height="22">
				<use xlink:href="#eye"/>
			</svg>
		</span>
	</div>

	<?php
		/**
		 * My Account edit account form.
		 *
		 * @since 2.6.0
		 */
		do_action( 'woocommerce_edit_account_form' );
	?>

	<div class="edit__btn">

		<?php wp_nonce_field( 'save_account_details', 'save-account-details-nonce' ); ?>

		<input type="submit" id="save-edit" name="save_account_details" value="<?php esc_attr_e('Save changes', 'lege'); ?>" class="btn edit__submit" />
		
		<input type="hidden" name="action" value="save_account_details" />
		
	</div>

	<?php do_action( 'woocommerce_edit_account_form_end' ); ?>

</div> 
</div>
</form>

<?php do_action( 'woocommerce_after_edit_account_form' ); ?>
