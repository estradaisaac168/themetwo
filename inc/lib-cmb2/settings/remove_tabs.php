<?php

// Remove tabs themes.php

add_action( 'admin_menu', function() {
    // Reemplaza con tus option_key exactos
    remove_submenu_page( 'themes.php', MY_TEXT_PREFIX . 'woocommerce_options' );
    remove_submenu_page( 'themes.php', MY_TEXT_PREFIX . 'banner_options' );
    remove_submenu_page( 'themes.php', MY_TEXT_PREFIX . 'example_options' );
}, 999 );