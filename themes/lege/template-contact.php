<?php
/**
* Template Name: Шаблон: Контакты
*/
if (isset($_POST['contact'])) {
    $error = lege_send_contact($_POST['contact']);
}
get_header(); 

global $lege_options;

?>

<?php while ( have_posts() ) : the_post();?>
<section class="inner contacts">
    <div class="wrapper">
        <div class="detail">
            <p class="detail__title"><?php echo get_metadata('post', get_the_ID(), 'lege_contact_title_left', true); ?></p>
            <ul class="contact">
                <?php if(get_metadata('post', get_the_ID(), 'lege_contact_address', true)) { ?>
                <li class="contact__item">
                    <div class="contact__icon">
                        <svg width="19" height="24">
                            <use xlink:href="#pin"/>
                        </svg>
                    </div>
                    <p class="contact__text contact__text_address"><?php echo get_metadata('post', get_the_ID(), 'lege_contact_address', true); ?></p>
                </li>
                <?php } ?> 

                <?php if(get_metadata('post', get_the_ID(), 'lege_contact_phone1', true) || get_metadata('post', get_the_ID(), 'lege_contact_phone2', true)) { ?>
                <li class="contact__item">
                    <div class="contact__icon">
                        <svg width="17" height="17">
                            <use xlink:href="#phone"/>
                        </svg>
                    </div>
                    <div class="contact__phones">
                        <?php if(get_metadata('post',get_the_ID(),'lege_contact_phone1',true)){ ?><a href="tel:<?php echo get_metadata('post',get_the_ID(),'lege_contact_phone1',true); ?>" class="contact__text contact__text_phone"><?php echo esc_attr(get_metadata('post',get_the_ID(),'lege_contact_phone1',true)); ?></a><?php } ?>
                        <?php if(get_metadata('post',get_the_ID(),'lege_contact_phone2',true)){ ?><a href="tel:<?php echo get_metadata('post',get_the_ID(),'lege_contact_phone2',true); ?>" class="contact__text contact__text_phone"><?php echo esc_attr(get_metadata('post',get_the_ID(),'lege_contact_phone2',true)); ?></a><?php } ?>
                    </div>
                </li>
                <?php } ?> 
                
                <?php if(get_metadata('post', get_the_ID(), 'lege_contact_email', true)) { ?>
                <li class="contact__item">
                    <div class="contact__icon">
                        <svg width="23" height="17">
                            <use xlink:href="#mail"/>
                        </svg>
                    </div>
                    <p class="contact__text contact__text_mail"><?php echo get_metadata('post', get_the_ID(), 'lege_contact_email', true); ?></p>
                </li>
                <?php } ?>
                
            </ul>

            <?php if(get_metadata('post', get_the_ID(),'lege_contact_calendar',true)){ ?>
            <div class="detail__time">
                <svg width="35" height="35">
                    <use xlink:href="#time"/>
                </svg>
                <p><?php echo get_metadata('post',get_the_ID(),'lege_contact_calendar',true) ?></p>
            </div>
            <?php } ?> 
        </div>

        <?php //echo do_shortcode('[contact-form-7 id="3e6a8ba" title="Contact Page"]'); ?> 
        
        <!-- Custom Contact Form -->
        <form method="post" action="<?php the_permalink(); ?>" class="inner__form log" id="popupOrder"> 
            <p class="log__title"><?php echo get_metadata('post', get_the_ID(), 'lege_contact_title_right', true); ?></p>
            <div class="log__subtitle"><?php the_content(); ?></div> 
            
            <!-- Debug, success url -->
            <?php //echo '<pre>' . esc_url(home_url( add_query_arg( null, null ))) . '</pre>'; ?>

            <?php if (isset($_GET['success'])) : ?>
                <p class="success"><?php _e('Thank you for your message!', 'lege')?></p>
            <?php endif; ?>
            <?php if (isset($error) && isset($error['msg'])) : ?>
                <p class="error"><?php echo $error['msg']?></p>
            <?php endif; ?>
            
            <div class="log__group">
                <label><?php _e('Name', 'lege'); ?></label>
                <input type="text" name="contact[name]" class="log__input" required>
            </div>
            <div class="log__group">
                <label><?php _e('Phone', 'lege'); ?></label>
                <input type="tel" name="contact[tel]" class="log__input" required>
            </div>
            <div class="log__group log__group_company">
                <label><?php _e('Company', 'lege'); ?></label>
                <input type="text" name="contact[company]" class="log__input" required>
            </div>
            <div class="log__group log__group_textarea">
                <label><?php _e('Message', 'lege'); ?></label>
                <textarea type="text" name="contact[message]" class="log__input"></textarea>
            </div>
            <p class="log__line"><span>*</span><?php _e('Required field', 'lege'); ?></p>
            <div class="log__wrap">
                <div class="log__group check">
                    <input id="insight" type="checkbox" name="contact[learn]" value="learn">
                    <label for="insight">
                        <?php
                        if(!empty($lege_options['lege_form_policy_text'])) {
                        echo wp_kses_post($lege_options['lege_form_policy_text']); 
                        } else {
                            echo wp_kses_post(
                                sprintf(
                                    __('I agree with the <a href="%s">privacy policy</a>', 'lege'),
                                    esc_url('/privacy-policy')
                                )
                            );
                        }
                    ?></label>
                </div>
                <div class="log__btn">
                    <input id="order" data-submit type="submit" value="<?php _e('Send', 'lege'); ?>" class="btn"/>
                </div>
            </div>
            
            <input type="hidden" name="contact[email]" value="no-reply@localhost.com">
            
            <?php wp_nonce_field('lege_contact_form_nonce') ?> <!-- Security nonce field -->
        </form>

    </div>
</section>

    <!-- Шорткод для карты -->
    <?php if(get_metadata('post', get_the_ID(), 'lege_contact_map', true)) { ?>
        <section class="map">
            <div class="map__frame">
                <?php echo do_shortcode(get_metadata('post', get_the_ID(), 'lege_contact_map', true)) ; ?>
            </div>
        </section>
    <?php }

endwhile;

get_footer();