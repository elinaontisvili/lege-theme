<?php 
get_header();


if ( have_posts() ) : 
    while ( have_posts() ) : the_post();

        the_title();
        the_content();

    endwhile; 

    else :

        echo "<div>Нет постов</div>";

endif;


get_footer();
?>