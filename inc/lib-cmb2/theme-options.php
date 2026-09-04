<?php

/**
 * Theme options page.
 *
 * Registers the theme options pages under the "Appearance" menu using CMB2,
 * split into tabs: "Generales" (colors and typography) and "Front Page" (topbar).
 *
 * @package UnderstrapChild
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

/**
 * Registers the theme options boxes and their fields with CMB2.
 *
 * @return void
 */
function understrap_child_register_theme_options()
{
    // Identificador del grupo de pestañas
    $tab_group = MY_THEME_PREFIX . '_options_tabs';

    // Slug del elemento principal bajo Apariencia
    $parent_slug = 'themes.php';

    require_once get_stylesheet_directory() . '/inc/lib-cmb2/tabs-theme-options/generals.php';
    require_once get_stylesheet_directory() . '/inc/lib-cmb2/tabs-theme-options/frontpage.php';
    require_once get_stylesheet_directory() . '/inc/lib-cmb2/tabs-theme-options/features.php';
    require_once get_stylesheet_directory() . '/inc/lib-cmb2/tabs-theme-options/about.php';
    require_once get_stylesheet_directory() . '/inc/lib-cmb2/tabs-theme-options/woocommerce.php';
}
add_action('cmb2_admin_init', 'understrap_child_register_theme_options');




/**
 * Ocultar del menú lateral las pestañas 2, 3, 4 y 5
 */
function myMY_THEME_PREFIX_hide_extra_tabs_from_menu()
{
    remove_submenu_page('themes.php', 'themetwo_front_page_options');
    remove_submenu_page('themes.php', 'themetwo_features_options');
    remove_submenu_page('themes.php', 'themetwo_banners_options');
    remove_submenu_page('themes.php', 'themetwo_about_options');
    remove_submenu_page('themes.php', 'themetwo_woocommerce_options');
}
add_action('admin_menu', 'myMY_THEME_PREFIX_hide_extra_tabs_from_menu', 999);





/**
 * Obtiene el layout final considerando: 
 * 1. Anulación individual en el Post/Página actual.
 * 2. Opción global del contexto en CMB2.
 * 3. Valor por defecto 'no-sidebar'.
 *
 * @param string $global_option_key Clave global ('shop_layout', 'page_layout', etc.)
 * @return string Nombre del layout final
 */
function themetwo_get_layout( $global_option_key = 'page_layout' ) {
    $current_id = get_the_ID();

    // 1. Si estamos en una página o post individual, revisamos si tiene un override específico
    if ( is_singular() && $current_id ) {
        $individual_layout = get_post_meta( $current_id, MY_THEME_PREFIX . 'custom_layout', true );
        
        if ( ! empty( $individual_layout ) && 'default' !== $individual_layout ) {
            return $individual_layout;
        }
    }

    // 2. Si no hay override individual, usamos la opción global del contexto
    // Buscamos según la pestaña donde esté guardado (main_options o secondary_options)
    $option_page = ( 'shop_layout' === $global_option_key ) ? MY_THEME_PREFIX . 'main_options' : MY_THEME_PREFIX . 'woocommerce_options';
    $global_layout = cmb2_get_option( $option_page, $global_option_key, 'no-sidebar' );

    return ! empty( $global_layout ) ? $global_layout : 'no-sidebar';
}

/**
 * Retorna la clase CSS de Bootstrap para el contenedor principal
 */
function themetwo_get_content_class( $global_option_key = 'page_layout' ) {
    $layout = themetwo_get_layout( $global_option_key );

    switch ( $layout ) {
        case 'both-sidebars':
            return 'col-12 col-lg-6';

        case 'sidebar-left':
        case 'sidebar-right':
            return 'col-12 col-lg-9';

        case 'no-sidebar':
        default:
            return 'col-12';
    }
}
