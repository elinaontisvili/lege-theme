<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Lege
 */
get_header();

?>
<section class="inner-clients">
	<div class="wrapper error-wrapper">
		<h2 class="clients__title secondary-title error-title"><span><?php esc_html_e( 'Error 404', 'lege' ); ?></span><br><?php esc_html_e( 'The page does not exist!' ); ?></h2>
		<div class="error__box"> 
			 <?php esc_html_e( 'Page not found! Check the URL and refresh the page.', 'lege' ); ?>
		</div>
		<a href="<?php echo esc_url(home_url()); ?>" class="error__btn btn"><?php esc_html_e( 'Go to homepage', 'lege' ); ?></a>
	</div>
</section>
	
<?php
get_footer();
