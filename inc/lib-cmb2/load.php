<?php

/**
 * Include CMB2 if it has not been included yet.
 */
if ( file_exists( get_stylesheet_directory() . '/inc/lib-cmb2/cmb2/init.php' ) ) {
	require_once get_stylesheet_directory() . '/inc/lib-cmb2/cmb2/init.php';
}



/**
 * Include the theme's icon helpers.
 */
// require_once get_stylesheet_directory() . '/inc/lib-cmb2/icons.php';


/**
 * Include the theme's admin options page.
 */
require_once get_stylesheet_directory() . '/inc/lib-cmb2/theme-options.php';

/**
 * Include field option into product page.
 */
require_once get_stylesheet_directory() . '/inc/lib-cmb2/metaboxes/product-fields.php';
require_once get_stylesheet_directory() . '/inc/lib-cmb2/metaboxes/pages.php';