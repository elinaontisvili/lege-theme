<?php
/**
 * Template Name: Page Without Title
 *
 * @package Lege
 */

get_header();
?>

<section class="inner contacts">
    <div class="wrapper">
		<div id="primary" class="content-area"> 

		<main id="primary" class="site-main">

			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', 'page-notitle' );

				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile;
			?>

		</main>

		</div> 
	</div> 
</section>

<?php
get_footer();
