<?php
/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.7.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! comments_open() ) {
    return;
}

?>
<div id="reviews" class="woocommerce-Reviews">
    <div id="comments">
        <h2 class="woocommerce-Reviews-title">
            <?php
            $count = $product->get_review_count();
            if ( $count && wc_review_ratings_enabled() ) {
                /* translators: 1: reviews count 2: product name */
                $reviews_title = sprintf( esc_html( _n( '%1$s review for %2$s', '%1$s reviews for %2$s', $count, 'lege' ) ), esc_html( $count ), '<span>' . get_the_title() . '</span>' );
                echo apply_filters( 'woocommerce_reviews_title', $reviews_title, $count, $product ); // WPCS: XSS ok.
            } else {
                esc_html_e( 'Reviews', 'lege' );
            }
            ?>
        </h2>

        <?php if ( have_comments() ) : ?>
            <ol class="commentlist">
                <?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
            </ol>

            <?php
            if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
                echo '<nav class="woocommerce-pagination">';
                paginate_comments_links(
                    apply_filters(
                        'woocommerce_comment_pagination_args',
                        array(
                            'prev_text' => is_rtl() ? '&rarr;' : '&larr;',
                            'next_text' => is_rtl() ? '&larr;' : '&rarr;',
                            'type'      => 'list',
                        )
                    )
                );
                echo '</nav>';
            endif;
            ?>
        <?php else : ?>
            <p class="woocommerce-noreviews"><?php esc_html_e( 'There are no reviews yet.', 'lege' ); ?></p>
        <?php endif; ?>
    </div>

    <?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>
        <div id="review_form_wrapper">
            <div id="review_form">
                <?php
                $commenter    = wp_get_current_commenter();
                $name_email_required = (bool) get_option( 'require_name_email', 1 );
               
                $fields              = array(
                    'author' => array(
                        'label'        => __( 'Name', 'lege' ),
                        'type'         => 'text',
                        'value'        => $commenter['comment_author'],
                        'required'     => $name_email_required,
                        'autocomplete' => 'name',
                    ),
                    'email'  => array(
                        'label'        => __( 'Email', 'lege' ),
                        'type'         => 'email',
                        'value'        => $commenter['comment_author_email'],
                        'required'     => $name_email_required,
                        'autocomplete' => 'email',
                    ),
                    'lege_phone' => array(
                        'label'         => __( 'Phone', 'lege' ),
                        'type'          => 'tel',
                        'value'         => '',
                        'required'      => false,
                        'autocomplete'  => 'tel',  
                    ),
                    'lege_social' => array(
                        'label'         => __( 'Social', 'lege'),
                        'type'          => 'url',
                        'value'         => '',
                        'required'      => false,
                        'autocomplete'  => 'url',
                    ),
                );

                $comment_form = array(
					'class_container'     => 'log clients',
                    'class_form'          => 'clients__form log__wrap',
                    /* translators: %s is product title */
                    'title_reply'         => have_comments() ? esc_html__( 'Add a review', 'lege' ) : sprintf( esc_html__( 'Be the first to review &ldquo;%s&rdquo;', 'lege' ), get_the_title() ),
                    /* translators: %s is product title */
                    'title_reply_to'      => esc_html__( 'Leave a Reply to %s', 'lege' ),
                    'title_reply_before'  => '<h2 id="reply-title" class="comment-reply-title log__title log__title_custom" role="heading" aria-level="3">',
                    'title_reply_after'   => '</h2>',
                    'comment_notes_after' => '<p class="log__line"><span>*</span>' . esc_html__( 'Fields are required', 'lege' ) . '</p>',
                    'logged_in_as'        => '',
                    'comment_field'       => '',
                    'comment_notes_after' => '<p class="comment-form-cookies-consent">' .
                             '<input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes" />' .
                             '<label class="cookies__consent" for="wp-comment-cookies-consent">' . esc_html__( 'Save my name, email, and website in this browser for the next time I comment.', 'lege' ) . '</label>' .
                             '</p>',
					'submit_button' => '<button type="submit" class="btn bnt_woo log__submit">' . esc_html__( 'Send Review', 'lege' ) . '</button>',
                );

                // Initialize the fields array for the comment form
                $comment_form['fields'] = array();

                foreach ( $fields as $key => $field ) {
                    $required_html = ( $field['required'] ) ? '&nbsp;<span class="required">*</span>' : '';
                    $input_name = esc_attr( $key );
                    $label_text = esc_html( $field['label'] );
                    $input_value = esc_attr( $field['value'] );
                    $inout_type = esc_attr($field['type'] );
                    $input_required = ( $field['required'] ) ? 'required' : '';
                    $input_autocompete = esc_attr( $field['autocomplete'] );


                    $comment_form['fields'][$key] =
                    '<div class="log__group">' .
                        '<label class="label_custom" for="' . $input_name . '">' . $label_text . $required_html . '</label>' .
                        '<input id="' . $input_name . '" name="' . $input_name . '" type="' . $input_type . '" autocomplete="' . $input_autocomplete . '" value="' . $input_value . '" size="30" ' . $input_required . ' class="log__input" />' .
                    '</div>';
                }

                $comment_form['fields']['lege_social'] = str_replace('<div class="log__group_custom_to_disable_it"', '<div class="log__group_custom_to_disable_it log__group_socials"', $comment_form['fields']['lege_social']);
               
				// Build comment textarea first
				$comment_form['comment_field'] =
					'<div class="log__group log__group_textarea">' .
						'<label class="label_custom" for="comment">' . esc_html__('Your review', 'lege') . '&nbsp;<span class="required">*</span></label>' .
						'<textarea id="comment" name="comment" cols="45" rows="8" required class="log__group_textarea_custom"></textarea>' .
					'</div>';

                $account_page_url = wc_get_page_permalink( 'myaccount' );
                if ( $account_page_url ) {
                    /* translators: %s opening and closing link tags respectively */
                    $comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( esc_html__( 'You must be %1$slogged in%2$s to post a review.', 'lege' ), '<a href="' . esc_url( $account_page_url ) . '">', '</a>' ) . '</p>';
                }

				if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
				$comment_form['comment_field'] .= '
				<div class="log__block">
					<div class="log__rate log__rate_custom rating">
						<span>Your rating</span>
						<div class="rating__choice" id="rate-choice">
							<div class="rating__group"><input type="radio" value="1" name="rating"><label></label></div>
							<div class="rating__group"><input type="radio" value="2" name="rating"><label></label></div>
							<div class="rating__group"><input type="radio" value="3" name="rating"><label></label></div>
							<div class="rating__group"><input type="radio" value="4" name="rating"><label></label></div>
							<div class="rating__group"><input type="radio" value="5" name="rating" checked="checked"><label></label></div>
						</div>
					</div>

				</div>';
				}

                comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
                ?>
            </div>
        </div>
    <?php else : ?>
        <p class="woocommerce-verification-required"><?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review.', 'lege' ); ?></p>
    <?php endif; ?>

    <div class="clear"></div>
</div>
