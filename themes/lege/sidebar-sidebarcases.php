<?php 

if ( ! is_active_sidebar( 'sidebarcases' ) ) return;

?> 

<aside class="sidebar">
    <?php dynamic_sidebar( 'sidebarcases' ); ?>
</aside>