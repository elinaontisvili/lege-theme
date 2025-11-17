<!-- Login -->
<div id="enter" class="login mfp-hide">
    <h4 class="login__title modal-title"><?php esc_html_e('Log in to your account', 'lege'); ?></h4>
    
    <p class="login__question modal-text"><?php printf(wp_kses(
        /* translators: %1$s and %2$s are HTML tags around the "Register now" link */
        __('Don’t have an account yet? %1$sRegister now%2$s, it only takes a minute.', 'lege'),
        array(
            'a' => array(
                'href'  => array(),
                'class' => array(),
            ),
            'span'  => array(
                'class' => array(),
            ),
        )
        ),
        '<span><a href="#reg" class="popup-link-2 link-more">',
        '</a></span>'
    );
    ?> 
    </p>
        <form id="log" class="woocommerce-form woocommerce-form-login log" method="post">

        <?php do_action( 'woocommerce_login_form_start' ); ?>

        <div class="log__group">
            <label><?php esc_html_e('Email or Username','lege' ); ?></label>
            <input type="text" name="username" value="<?php echo ( ! empty( $_POST['username'] ) && is_string( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" class="log__input">
        </div>

        <div class="log__group show-pass">
            <label><?php esc_html_e('Password', 'lege'); ?></label>
            <input id="password" type="password" name="password" class="log__input">
            <span class="log__eye password-eye" data-target="#password">
                <svg width="34" height="22">
                    <use xlink:href="#eye"/>
                </svg>
            </span>
        </div>

        <?php do_action( 'woocommerce_login_form' ); ?>

        <div class="log__wrap">

            <div class="log__group check">
                <input id="check" class="woocommerce-form__input woocommerce-form__input-checkbox" type="checkbox" name="rememberme" value="forever">
                <label for="check"><?php esc_html_e('Remember me', 'lege'); ?></label>
            </div>
            <a href="#recovery" class="popup-link-1 log__forget"><?php esc_html_e('Forgot password?', 'lege'); ?></a>
        </div>
        <div class="log__btn">
            <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
            <input type="submit" name="login" value="<?php esc_attr_e( 'Log in', 'lege' ); ?>" class="btn woocommerce-button button woocommerce-form-login__submit" />
        </div>

        <?php do_action( 'woocommerce_login_form_end' ); ?>

    </form>
    
    <!-- Socials -->
    <div class="var">
        <p class="var__text"><?php esc_html_e('Or sign in using','lege'); ?></p>

        <?php echo do_shortcode('[TheChamp-Login]'); ?>

    </div>
</div>

<!-- Forget password -->
<div id="recovery" class="recovery mfp-hide">
    <div class="forget">
        <p class="forget__title modal-subtitle"><?php esc_html_e('Forgot password?', 'lege'); ?></p>
        <p class="forget__text modal-text"><?php esc_html_e('Enter your email. A verification code will be sent to you. After confirming it, you can choose a new password for your account.','lege'); ?></p>
        
        <form action="<?php echo home_url('/my-account'); ?>" method="post" id="recover" class="woocommerce-ResetPassword lost_reset_password log">

            <div class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first log__group">
                <label for="user_login"><?php esc_html_e( 'Username or email', 'lege' ); ?>&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text"><?php esc_html_e( 'Required', 'lege' ); ?></span></label>
                <input class="log__input woocommerce-Input woocommerce-Input--text input-text" type="text" name="user_login" id="user_login" autocomplete="username" required aria-required="true" />
            </div>

            <div class="clear"></div>

            <?php do_action( 'woocommerce_lostpassword_form' ); ?>

            <div class="woocommerce-form-row form-row log__btn">
                <input type="hidden" name="wc_reset_password" value="true" />
                <input id="pass" type="submit"vname="wc_reset_password" value="<?php esc_attr_e('Send password reset','lege'); ?>" class="btn woocommerce-Button button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>"/>
            </div>

            <?php wp_nonce_field( 'lost_password', 'woocommerce-lost-password-nonce' ); ?>

        </form>

        <a href="#enter" class="popup-link-1 link-more">
            <svg width="18" height="20">
                <use xlink:href="#nav-right"/>
            </svg>
            <?php esc_html_e('Back', 'lege'); ?>
        </a>
    </div>

<!-- Registration -->
<div id="reg" class="reg mfp-hide">
    
    <p class="reg__question modal-text">
        <?php esc_html_e( 'Already have an account?', 'lege' ); ?>
            <span>
                <a href="#enter" class="popup-link-1 link-more">
                    <?php esc_html_e( 'Log in', 'lege' ); ?>
                </a>
            </span>
    </p>
    
    <form id="regist" method="post" class="woocommerce-form woocommerce-form-register register log" <?php do_action( 'woocommerce_register_form_tag' ); ?> >

			<?php do_action( 'woocommerce_register_form_start' ); ?>

			<?php /* if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : */ ?>

				<div class="log__group woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<label for="reg_username"><?php esc_html_e( 'Name', 'lege' ); ?>&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text"><?php esc_html_e( 'Required', 'lege' ); ?></span></label>
					<input type="text" class="log__input woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" required aria-required="true" /><?php // @codingStandardsIgnoreLine ?>
                </div>

			<?php /* endif; */ ?>

			<div class="log__group woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="reg_email"><?php esc_html_e( 'Email', 'lege' ); ?>&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text"><?php esc_html_e( 'Required', 'lege' ); ?></span></label>
				<input type="email" class="log__input woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" required aria-required="true" /><?php // @codingStandardsIgnoreLine ?>
            </div>

            <div class="log__group woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <label for="reg_phone"><?php esc_html_e('Phone', 'lege'); ?>&nbsp;<span class="required">*</span></label>
                <input type="tel" name="billing_phone" class="log__input woocommerce-Input woocommerce-Input--text input-text" id="reg_phone" autocomplete="tel" pattern="[0-9\s\-\+\(\)]*" value="<?php echo ( ! empty( $_POST['billing_phone'] ) ) ? esc_attr( wp_unslash( $_POST['billing_phone'] ) ) : ''; ?>" required aria-required="true" title="<?php esc_attr_e('Please enter numbers only.','lege'); ?>" />
            </div>

			<?php /* if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : */ ?>

            <div class="log__group show-pass woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <label for="reg_password"><?php esc_html_e( 'Password', 'lege' ); ?>&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text"><?php esc_html_e( 'Required', 'lege' ); ?></span></label>
                <input id="reg-pass" type="password" class="log__input woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" required aria-required="true" />
                <span class="log__eye password-eye" data-target="#reg-pass">
                    <svg width="34" height="22">
                        <use xlink:href="#eye"/>
                    </svg>
                </span>
            </div>

			<?php /* else : */ ?>

				<div><?php /* esc_html_e( 'A link to set a new password will be sent to your email address.', 'woocommerce' ); */ ?></div>

			<?php /* endif; */ ?>

			<?php do_action( 'woocommerce_register_form' ); ?>

			<div class="woocommerce-form-row form-row log__wrap">
				<div class="log__btn">
                <input id="do-reg" type="submit" name="register" value="<?php esc_attr_e( 'Register', 'lege' ); ?>" class="woocommerce-Button woocommerce-button button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?> woocommerce-form-register__submit btn"/>
                </div>
                <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
                <div class="log__group check">
                    <input id="check" class="woocommerce-form__input woocommerce-form__input-checkbox" type="checkbox" name="rememberme" value="forever">
                    <label for="check"><?php esc_html_e('Remember me', 'lege'); ?></label>
                </div>
            </div>

			<?php do_action( 'woocommerce_register_form_end' ); ?>

		</form>

    <div class="var">
        <p class="var__text"><?php esc_html_e('Or sign in using','lege'); ?></p>

        <?php echo do_shortcode('[TheChamp-Login]'); ?>

    </div>
</div>