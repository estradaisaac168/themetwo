<?php



/**
 * 2. Enganchar el Shortcode automáticamente en Single Product
 */
function mitema_render_payment_methods_in_single_product() {
    echo do_shortcode( '[metodos_pago_single]' );
}
add_action( 'woocommerce_after_add_to_cart_form', 'mitema_render_payment_methods_in_single_product', 25 );



/**
 * Enganchar el Shortcode de confianza debajo de los métodos de pago
 */
// function mitema_render_trust_badges_in_single_product() {
//     echo do_shortcode( '[badges_confianza_single]' );
// }
// add_action( 'woocommerce_after_add_to_cart_form', 'mitema_render_trust_badges_in_single_product', 35 );