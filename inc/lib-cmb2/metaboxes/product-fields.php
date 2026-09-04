<?php

/**
 * Metabox del producto (ficha de producto).
 *
 * Añade opciones por producto:
 * - Mostrar/ocultar el carrusel de reseñas.
 * - Título de la tabla de especificaciones.
 * - Tabla de especificaciones.
 * - Mostrar las especificaciones antes de la descripción.
 */

defined('ABSPATH') || exit;

function themetwo_product_fields() {

    if (! function_exists('new_cmb2_box')) {
        return;
    }


    $product = new_cmb2_box(
        array(
            'id'           => MY_THEME_PREFIX. '_product_metabox',
            'title'        => __('Contenido de la ficha de producto', MY_THEME_DOMAIN),
            'object_types' => array('product'),
            'context'      => 'normal',
            'priority'     => 'high',
        )
    );

    /*
     * Mostrar reseñas
     */
    $product->add_field(
        array(
            'name'    => __('Mostrar reseñas', MY_THEME_DOMAIN),
            'desc'    => __('Muestra las reseñas como testimonios en un carrusel al final de la pestaña "Descripción".', MY_THEME_DOMAIN),
            'id'      => MY_THEME_PREFIX. '_product_show_reviews',
            'type'    => 'checkbox',
            //'default' => 'on',
        )
    );
}

add_action('cmb2_admin_init', 'themetwo_product_fields');