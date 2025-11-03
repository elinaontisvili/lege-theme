<!---------------------- Login ---------------------->
<div id="enter" class="login mfp-hide">
    <h4 class="login__title modal-title"><?php esc_html_e('Войдите в свой аккаунт', 'lege'); ?></h4>
    
    <p class="login__question modal-text"><?php printf(wp_kses(
        /* translators: %1$s and %2$s are HTML tags around the "Register now" link */
        __('Еще нет учетной записи? %1$sЗарегистрируйтесь сейчас%2$s, это займет не более минуты', 'lege'),
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
            <label><?php esc_html_e('Email или Имя пользователя','lege' ); ?></label>
            <input type="text" name="username" value="<?php echo ( ! empty( $_POST['username'] ) && is_string( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" class="log__input">
        </div>

        <div class="log__group show-pass">
            <label><?php esc_html_e('Пароль', 'lege'); ?></label>
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
                <label for="check"><?php esc_html_e('Запомнить пароль', 'lege'); ?></label>
            </div>
            <a href="#recovery" class="popup-link-1 log__forget"><?php esc_html_e('Забыли пароль?', 'lege'); ?></a>
        </div>
        <div class="log__btn">
            <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
            <input type="submit" name="login" value="<?php esc_attr_e( 'Log in', 'lege' ); ?>" class="btn woocommerce-button button woocommerce-form-login__submit" />
        </div>

        <?php do_action( 'woocommerce_login_form_end' ); ?>

    </form>
    
    <!-- SOCIALS -->
    <div class="var">
        <p class="var__text">Или войдите в систему с помощью</p>
        <ul class="var__list">
            <li>
                <a href="#" class="var__link var__link_goo">
                    <svg width="14" height="14">
                        <use xlink:href="#google"/>
                    </svg>
                </a>
            </li>
            <li>
                <a href="#" class="var__link var__link_vk">
                    <svg width="18" height="18">
                        <use xlink:href="#vk"/>
                    </svg>
                </a>
            </li>
            <li>
                <a href="#" class="var__link var__link_fb">
                    <svg width="16" height="16">
                        <use xlink:href="#facebook"/>
                    </svg>
                </a>
            </li>
        </ul>
    </div>
</div>

<!---------------------- Forget password ---------------------->
<div id="recovery" class="recovery mfp-hide">
    <div class="forget">
        <p class="forget__title modal-subtitle"><?php esc_html_e('Забыли пароль?', 'lege'); ?></p>
        <p class="forget__text modal-text"><?php esc_html_e('Введите ваш Email. Вам будет выслан проверочный код. После получения кода подтверждения вы сможете выбрать новый пароль для своей учетной записи.','lege'); ?></p>
        
        <form action="<?php echo home_url('/my-account'); ?>" method="post" id="recover" class="woocommerce-ResetPassword lost_reset_password log">

            <div class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first log__group">
                <label for="user_login"><?php esc_html_e( 'Username or email', 'lege' ); ?>&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text"><?php esc_html_e( 'Required', 'lege' ); ?></span></label>
                <input class="log__input woocommerce-Input woocommerce-Input--text input-text" type="text" name="user_login" id="user_login" autocomplete="username" required aria-required="true" />
            </div>

            <div class="clear"></div>

            <?php do_action( 'woocommerce_lostpassword_form' ); ?>

            <div class="woocommerce-form-row form-row log__btn">
                <input type="hidden" name="wc_reset_password" value="true" />
                <input id="pass" type="submit"vname="wc_reset_password" value="<?php esc_attr_e('Отправить пароль','lege'); ?>" class="btn woocommerce-Button button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>"/>
            </div>

            <?php wp_nonce_field( 'lost_password', 'woocommerce-lost-password-nonce' ); ?>

        </form>

        <a href="#enter" class="popup-link-1 link-more">
            <svg width="18" height="20">
                <use xlink:href="#nav-right"/>
            </svg>
            <?php esc_html_e('Назад', 'lege'); ?>
        </a>
    </div>

<!---------------------- Сonfirmation code 
    <div class="confirm">

        <p class="confirm__title  modal-subtitle">Введите код подтверждения</p>

        <form action="#" id="key" class="log">

            <span class="modal-caution">Неверный код</span>

            <div class="log__group">
                <label>Код подтверждения</label>
                <input type="text" name="confirm" class="log__input">
            </div>
            <div class="log__btn">
                <input id="confirm" type="submit" data-submit value="Подтвердить" class="btn"/>
            </div>
        </form>
        <a href="#enter" class="popup-link-1 link-more">
            <svg width="18" height="20">
                <use xlink:href="#nav-right"/>
            </svg>
            Назад
        </a>
    </div> 
    ---------------------->

<!---------------------- New password 
    <div class="new-pass">

        <p class="new-pass__title  modal-subtitle">Придумайте новый пароль</p>
        <p class="new-pass__text modal-text">Пароль должен содержать не менее 9 символов></p>

        <form action="#" id="create" class="log">

            <span class="modal-caution">Вы успешно сменили пароль</span>

            <div class="log__group show-pass">
                <label>Новый пароль</label>
                <input id="new-pass" type="password" name="password_mod" class="log__input">
                <span class="log__eye password-eye" data-target="#new-pass">
                    <svg width="34" height="22">
                        <use xlink:href="#eye"/>
                    </svg>
                </span>
            </div>
            <div class="log__group show-pass">
                <label>Подтвердите пароль</label>
                <input id="confirm-pass" type="password" name="password_mod" class="log__input">
                <span class="log__eye password-eye" data-target="#confirm-pass">
                    <svg width="34" height="22">
                        <use xlink:href="#eye"/>
                    </svg>
                </span>
            </div>
            <div class="log__wrap">
                <div class="log__btn">
                    <input type="submit" id="conf" data-submit value="Подтвердить" class="btn"/>
                </div>
                <a href="#enter" class="popup-link-1 log__enter">Войти</a>
            </div>
        </form>
        <a href="#enter" class="popup-link-1 link-more">
            <svg width="18" height="20">
                <use xlink:href="#nav-right"/>
            </svg>
            Назад
        </a>
    </div>

</div> ---------------------->

<!---------------------- Registration ---------------------->
<div id="reg" class="reg mfp-hide">
    
    <p class="reg__question modal-text">
        <?php esc_html_e( 'Уже есть аккаунт?', 'your-text-domain' ); ?>
            <span>
                <a href="#enter" class="popup-link-1 link-more">
                    <?php esc_html_e( 'Войдите', 'your-text-domain' ); ?>
                </a>
            </span>
    </p>
    
    <form id="regist" method="post" class="woocommerce-form woocommerce-form-register register log" <?php do_action( 'woocommerce_register_form_tag' ); ?> >

			<?php do_action( 'woocommerce_register_form_start' ); ?>

			<?php /* if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : */ ?>

				<div class="log__group woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<label for="reg_username"><?php esc_html_e( 'Имя', 'lege' ); ?>&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text"><?php esc_html_e( 'Required', 'lege' ); ?></span></label>
					<input type="text" class="log__input woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" required aria-required="true" /><?php // @codingStandardsIgnoreLine ?>
                </div>

			<?php /* endif; */ ?>

			<div class="log__group woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="reg_email"><?php esc_html_e( 'Email', 'lege' ); ?>&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text"><?php esc_html_e( 'Required', 'lege' ); ?></span></label>
				<input type="email" class="log__input woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" required aria-required="true" /><?php // @codingStandardsIgnoreLine ?>
            </div>

            <div class="log__group woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <label for="reg_phone"><?php esc_html_e('Телефон', 'lege'); ?>&nbsp;<span class="required">*</span></label>
                <input type="tel" name="billing_phone" class="log__input woocommerce-Input woocommerce-Input--text input-text" id="reg_phone" autocomplete="tel" pattern="[0-9\s\-\+\(\)]*" value="<?php echo ( ! empty( $_POST['billing_phone'] ) ) ? esc_attr( wp_unslash( $_POST['billing_phone'] ) ) : ''; ?>" required aria-required="true" title="<?php esc_attr_e('Please enter numbers only.','lege'); ?>" />
            </div>

			<?php /* if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : */ ?>

            <div class="log__group show-pass woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <label for="reg_password"><?php esc_html_e( 'Пароль', 'lege' ); ?>&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text"><?php esc_html_e( 'Required', 'lege' ); ?></span></label>
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
                <input id="do-reg" type="submit" name="register" value="<?php esc_attr_e( 'Зарегистрироваться', 'lege' ); ?>" class="woocommerce-Button woocommerce-button button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?> woocommerce-form-register__submit btn"/>
                </div>
                <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
                <div class="log__group check">
                    <input id="check" class="woocommerce-form__input woocommerce-form__input-checkbox" type="checkbox" name="rememberme" value="forever">
                    <label for="check"><?php esc_html_e('Запомнить пароль', 'lege'); ?></label>
                </div>
            </div>

			<?php do_action( 'woocommerce_register_form_end' ); ?>

		</form>

    <div class="var">
        <p class="var__text">Или войдите в систему с помощью</p>
        <ul class="var__list">
            <li>
                <a href="#" class="var__link var__link_goo">
                    <svg width="14" height="14">
                        <use xlink:href="#google"/>
                    </svg>
                </a>
            </li>
            <li>
                <a href="#" class="var__link var__link_vk">
                    <svg width="18" height="18">
                        <use xlink:href="#vk"/>
                    </svg>
                </a>
            </li>
            <li>
                <a href="#" class="var__link var__link_fb">
                    <svg width="16" height="16">
                        <use xlink:href="#facebook"/>
                    </svg>
                </a>
            </li>
        </ul>
    </div>
</div>