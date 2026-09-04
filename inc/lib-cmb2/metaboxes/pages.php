<?php
/**
 * Registro de Metaboxes para Páginas con CMB2.
 *
 * @package    MyTheme
 * @subpackage Core/Metaboxes
 * @link       https://github.com/CMB2/CMB2
 */

// Evitar el acceso directo si no se ejecuta dentro del entorno de WordPress.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registra el metabox de diseño para el Post Type 'page'.
 */
function themetwo_register_page_layout_metabox() {

	// Crear el metabox asignado a 'page'.
	$cmb_pages = new_cmb2_box( array(
		'id'           => MY_THEME_PREFIX . 'page_layout_metabox',
		'title'        => esc_html__( 'Opciones de Diseño de Página', MY_THEME_DOMAIN ),
		'object_types' => array( 'page' ),
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true,
	) );

	// Agregar el campo para la selección de sidebars.
	$cmb_pages->add_field( array(
		'name'    => esc_html__( 'Diseño de esta Página', MY_THEME_DOMAIN ),
		'desc'    => esc_html__( 'Selecciona la distribución de columnas para esta página en particular.', MY_THEME_DOMAIN ),
		'id'      => 'page_layout',
		'type'    => 'radio_inline',
		'options' => array(
			'no-sidebar'    => esc_html__( 'Sin Sidebars', MY_THEME_DOMAIN ),
			'sidebar-left'  => esc_html__( 'Solo Izquierda', MY_THEME_DOMAIN ),
			'sidebar-right' => esc_html__( 'Solo Derecha', MY_THEME_DOMAIN ),
			'both-sidebars' => esc_html__( 'Ambas Sidebars', MY_THEME_DOMAIN ),
		),
		'default' => 'no-sidebar',
	) );

}
add_action( 'cmb2_admin_init', MY_THEME_PREFIX . 'register_page_layout_metabox' );