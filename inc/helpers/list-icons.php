<?php



/**
 * Retorna la lista de iconos de Bootstrap Icons permitidos para los banners.
 *
 * @return array Array asociativo con clase CSS => Nombre legible
 */
function testingtheme_get_banner_icons() {
    return array(
        ''                   => __( 'Sin icono', MY_TEXT_DOMAIN ),
        'bi-tag-fill'        => __( 'Etiqueta / Descuento', MY_TEXT_DOMAIN ),
        'bi-gift-fill'       => __( 'Regalo / Promoción', MY_TEXT_DOMAIN ),
        'bi-percent'         => __( 'Porcentaje (%)', MY_TEXT_DOMAIN ),
        'bi-lightning-fill'  => __( 'Rayo / Oferta Flash', MY_TEXT_DOMAIN ),
        'bi-bag-check-fill'  => __( 'Bolsa de compras', MY_TEXT_DOMAIN ),
        'bi-truck'           => __( 'Envío / Transporte', MY_TEXT_DOMAIN ),
        'bi-star-fill'       => __( 'Estrella / Destacado', MY_TEXT_DOMAIN ),
        'bi-clock-history'   => __( 'Reloj / Tiempo limitado', MY_TEXT_DOMAIN ),
        'bi-shield-check'    => __( 'Garantía / Seguridad', MY_TEXT_DOMAIN ),
        'bi-fire'            => __( 'Fuego / Tendencia', MY_TEXT_DOMAIN ),
    );
}

