<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Evitar acceso directo
}


/**
 * Renderiza los banners según la ubicación especificada desde Theme Options.
 *
 * @param string $target_location Identificador de la ubicación.
 */
function testingtheme_display_banners_by_location( $target_location = '' ) {
    
    // 1. Si la función fue llamada por un hook nativo de WC sin parámetro, detectamos la ubicación
    if ( empty( $target_location ) ) {
        $current_action = current_action();
        switch ( $current_action ) {
            case 'woocommerce_after_add_to_cart_form':
                $target_location = 'single_product';
                break;
            case 'woocommerce_before_cart_table':
                $target_location = 'wc_cart_top';
                break;
            default:
                $target_location = $current_action;
        }
    }

    // 2. Obtener los banners desde la Options Page de CMB2 (wp_options)
    $theme_options = get_option( MY_THEME_PREFIX . 'banner_options', array() );
    

    // Extraer el grupo repetible de banners
    $banners = isset( $theme_options[MY_THEME_PREFIX . 'banners_wc_group'] ) ? $theme_options[MY_THEME_PREFIX . 'banners_wc_group'] : array();


    if ( empty( $banners ) || ! is_array( $banners ) ) {
        return;
    }

    // 3. Recorrer y filtrar por ubicación
    foreach ( $banners as $banner ) {
        $posicion = isset( $banner['position_id'] ) ? $banner['position_id'] : '';
        if ( $posicion !== $target_location ) {
            continue;
        }

        // Validación de WooCommerce y Expiración del Cupón
        $coupon_id = isset( $banner['coupon_id'] ) ? absint( $banner['coupon_id'] ) : 0;
        $coupon    = ( $coupon_id && class_exists( 'WooCommerce' ) ) ? new WC_Coupon( $coupon_id ) : false;

        if ( $coupon && $coupon->get_id() ) {
            $date_expires = $coupon->get_date_expires();
            if ( $date_expires && current_time( 'timestamp' ) > $date_expires->getTimestamp() ) {
                continue; // Saltar si el cupón está vencido
            }
        }

        $image_id = isset( $banner["image_src_id"] ) ? absint( $banner['image_src_id'] ) : 0;
        $alignment = isset( $banner['align_id'] ) ? absint( $banner['align_id'] ) : "center";


        // 4. Cargar la vista parcial delegando el renderizado
        get_template_part( 
            'template-parts/fragments/content', 
            'banner-promo', 
            array(
                'title'          => isset( $banner['title'] ) ? $banner['title'] : '',
                'img_src'         => $image_id ? wp_get_attachment_image_url( $image_id, 'full' ) : '',
                'coupon'          => $coupon,
                'alignment'          => $alignment,
                'target_location' => $target_location,
            ) 
        );
    }
}



/**
 * Callback para CMB2: Puebla el select con la lista de cupones de WooCommerce.
 *
 * @return array Opciones con formato [ ID_del_cupon => "CODIGO - Descuento (Vencimiento)" ]
 */
function testingtheme_get_coupons_wc_options() {
    $options = array();

    // Validar que WooCommerce esté instalado y activo
    if ( ! class_exists( 'WooCommerce' ) ) {
        return $options;
    }

    // Consultar todos los cupones publicados
    $coupons = get_posts( array(
        'post_type'      => 'shop_coupon',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'orderby'        => 'title',
        'order'          => 'ASC',
    ) );


    if ( empty( $coupons ) ) {
        return $options;
    }

    foreach ( $coupons as $coupon_post ) {
        $coupon = new WC_Coupon( $coupon_post->ID );
        
        if ( ! $coupon->get_id() ) {
            continue;
        }

        $code          = $coupon->get_code();
        $discount_type = $coupon->get_discount_type();
        $amount        = $coupon->get_amount();
        $expiry_date   = $coupon->get_date_expires();
        
        // Dar formato a la fecha de vencimiento para la etiqueta del selector
        $expiry_str = $expiry_date ? ' (Vence: ' . $expiry_date->date( 'd/m/Y' ) . ')' : ' (Sin vencimiento)';
        $type_symbol = ( 'percent' === $discount_type ) ? '%' : ' OFF';

        // Construir la opción: ID del post => Etiqueta legible en Admin
        $options[ $coupon_post->ID ] = sprintf(
            '%1$s - %2$s%3$s%4$s',
            strtoupper( $code ),
            $amount,
            $type_symbol,
            $expiry_str
        );
    }

    return $options;
}

// 1. Hook Personalizado para la Front Page y plantillas propias
add_action( 'testingtheme_render_banner_location', 'testingtheme_display_banners_by_location', 10, 1 );

// 2. Enganche directo a Hooks Nativos de WooCommerce
add_action( 'woocommerce_after_add_to_cart_form', 'testingtheme_display_banners_by_location', 10, 0 );
add_action( 'woocommerce_before_cart_table', 'testingtheme_display_banners_by_location', 10, 0 );