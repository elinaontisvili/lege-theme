<?php
if ( ! is_active_sidebar( 'woocommerce' ) ) {
    return;
}
?>

<aside class="sidebar">

    <?php dynamic_sidebar( 'woocommerce' ); ?>

</aside>