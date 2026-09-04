<?php

/**
 * WooCommerce Options Section (CMB2)
 */

// 1. Define los identificadores del tema

$parent_slug = 'themes.php';
$tab_group   = MY_THEME_PREFIX . 'options_tabs';

$woocommerce = new_cmb2_box(
    array(
        'id'           => MY_THEME_PREFIX . 'woocommerce_options',
        'object_types' => array('options-page'),
        'option_key'   => MY_THEME_PREFIX . 'woocommerce_options',
        'parent_slug'  => $parent_slug, // Menú de Apariencia
        'menu_title'   => __('Woocommerce', MY_THEME_DOMAIN),
        'capability'   => 'manage_options',
        'tab_group'    => $tab_group,
        'tab_title'    => __('Woocommerce', MY_THEME_DOMAIN),
    )
);


/**
 * Sección: Layout de la Tienda
 */
$woocommerce->add_field(
    array(
        'name' => __('Layout de la Tienda', MY_THEME_DOMAIN),
        'desc' => __('Selecciona la disposición de las barras laterales para las páginas de catálogo y productos.', MY_THEME_DOMAIN),
        'type' => 'title',
        'id'   => MY_THEME_PREFIX . 'shop_layout_title',
    )
);

$woocommerce->add_field(
    array(
        'name'    => esc_html__('Diseño de la Tienda', MY_THEME_DOMAIN),
        'id'      => 'shop_layout',
        'type'    => 'radio_inline',
        'options' => array(
            'no-sidebar'    => esc_html__('Sin Sidebars', MY_THEME_DOMAIN),
            'sidebar-left'  => esc_html__('Solo Izquierda', MY_THEME_DOMAIN),
            'sidebar-right' => esc_html__('Solo Derecha', MY_THEME_DOMAIN),
            'both-sidebars' => esc_html__('Ambas Sidebars', MY_THEME_DOMAIN),
        ),
        'default' => 'no-sidebar',
    )
);





/**
 * Sección: Single Product
 */
$woocommerce->add_field(
    array(
        'name' => __('Single Product', MY_THEME_DOMAIN),
        'desc' => __('Configure los elementos y ventajas de la página de producto individual.', MY_THEME_DOMAIN),
        'type' => 'title',
        'id'   => MY_THEME_PREFIX . 'single_product_title',
    )
);

// Enlace opcional (Por si lleva a una página de información)
// $woocommerce->add_group_field(
//     $single_payment_group,
//     array(
//         'name' => __('Enlace (Opcional)', MY_THEME_DOMAIN),
//         'desc' => __('URL a políticas de pago o más detalles.', MY_THEME_DOMAIN),
//         'id'   => 'link',
//         'type' => 'text_url',
//     )
// );


// Grupo repetible para Métodos de Pago o Badges de Confianza
$single_payment_group = $woocommerce->add_field(
    array(
        'id'          => 'single_product_payment_methods',
        'type'        => 'group',
        'description' => __('Añada los métodos de pago o ventajas que se mostrarán en la ficha del producto.', MY_THEME_DOMAIN),
        'repeatable'  => true,
        'options'     => array(
            'group_title'   => __('Método Pago {#}', MY_THEME_DOMAIN),
            'add_button'    => __('Añadir Método', MY_THEME_DOMAIN),
            'remove_button' => __('Eliminar', MY_THEME_DOMAIN),
            'sortable'      => true,
            'closed'        => true,
        ),
    )
);

// Nombre del método de pago
$woocommerce->add_group_field(
    $single_payment_group,
    array(
        'name' => __('Nombre', MY_THEME_DOMAIN),
        'desc' => __('Ej: Tarjeta de Crédito, Transferencia, Envío Gratis', MY_THEME_DOMAIN),
        'id'   => 'title',
        'type' => 'text',
    )
);


// Imagen / SVG
$woocommerce->add_group_field(
    $single_payment_group,
    array(
        'name'         => __('Icono / SVG', MY_THEME_DOMAIN),
        'desc'         => __('Suba un archivo SVG o imagen pequeña (Ej: visa.svg, mastercard.svg)', MY_THEME_DOMAIN),
        'id'           => 'icon_svg',
        'type'         => 'file',
        'options'      => array(
            'url' => true,
        ),
        'query_args'   => array(
            'type' => array(
                'image/svg+xml',
                'image/png',
                'image/jpeg',
            ),
        ),
        'preview_size' => array(40, 40),
    )
);

// Descripción corta o subtítulo (Opcional)
$woocommerce->add_group_field(
    $single_payment_group,
    array(
        'name' => __('Texto secundario / Leyenda', MY_THEME_DOMAIN),
        'desc' => __('Ej: Hasta 12 cuotas sin interés / Pago seguro', MY_THEME_DOMAIN),
        'id'   => 'subtitle',
        'type' => 'text',
    )
);




