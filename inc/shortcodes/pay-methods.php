<?php


/**
 * Shortcode 1: Métodos de Pago
 */
function mitema_single_payment_methods_shortcode()
{
    $options         = get_option('themetwo_woocommerce_options');
    $payment_methods = isset($options['single_product_payment_methods']) ? $options['single_product_payment_methods'] : array();

    if (empty($payment_methods) || ! is_array($payment_methods)) {
        return '';
    }

    ob_start();
?>
    <!-- Añadimos width: fit-content y justify-self en línea (o mediante clase) para que no ocupen todo el grid -->
    <div class="product-payment-badges border-top border-bottom py-3 my-3 bg-light rounded px-3" style="width: fit-content; justify-self: start;">
        <div class="d-flex flex-wrap justify-content-start align-items-center text-center gap-3 content-pay">
            <?php foreach ($payment_methods as $method) :
                $title    = isset($method['title']) ? $method['title'] : '';
                $icon_url = isset($method['icon_svg']) ? $method['icon_svg'] : '';
                $subtitle = isset($method['subtitle']) ? $method['subtitle'] : '';
            ?>
                <div class="d-flex flex-column align-items-center px-2">
                    <?php if (! empty($icon_url)) : ?>
                        <div class="payment-icon-wrapper mb-1">
                            <img src="<?php echo esc_url($icon_url); ?>"
                                 alt="<?php echo esc_attr($title); ?>"
                                 loading="lazy"
                                 style="max-height: 28px; width: auto; object-fit: contain;">
                        </div>
                    <?php endif; ?>

                    <div class="lh-sm">
                        <?php if (! empty($title)) : ?>
                            <span class="payment-title fw-semibold text-dark d-block" style="font-size: 0.85rem;">
                                <?php echo esc_html($title); ?>
                            </span>
                        <?php endif; ?>

                        <?php if (! empty($subtitle)) : ?>
                            <span class="payment-subtitle text-muted d-block" style="font-size: 0.75rem;">
                                <?php echo esc_html($subtitle); ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php
    return ob_get_clean();
}
add_shortcode('metodos_pago_single', 'mitema_single_payment_methods_shortcode');


/**
 * Shortcode 2: Insignias de Confianza
 */
function mitema_trust_badges_shortcode()
{
    $options     = get_option('themetwo_woocommerce_options');
    $trust_items = isset($options['single_product_trust_badges']) ? $options['single_product_trust_badges'] : array();

    if (empty($trust_items) || ! is_array($trust_items)) {
        $trust_items = array(
            array(
                'icon_class' => 'bi-shield-check',
                'title'      => 'Compra Segura',
                'subtitle'   => 'Protección de datos'
            ),
            array(
                'icon_class' => 'bi-truck',
                'title'      => 'Envío Garantizado',
                'subtitle'   => 'A todo el país'
            ),
            array(
                'icon_class' => 'bi-arrow-counterclockwise',
                'title'      => 'Devolución Fácil',
                'subtitle'   => '30 días de garantía'
            ),
        );
    }

    ob_start();
?>
    <!-- Contenedor adaptado al ancho de su contenido y alineado al inicio del grid -->
    <div class="product-trust-badges border-top border-bottom py-3 my-3 bg-light rounded px-3"">
    <!-- <div class="product-trust-badges border-top border-bottom py-3 my-3 bg-light rounded px-3" style="width: fit-content; justify-self: start;"> -->
        <div class="d-flex flex-column flex-sm-row justify-content-center align-items-center text-center gap-3" >
            <?php foreach ($trust_items as $item) :
                $icon_class = isset($item['icon_class']) ? $item['icon_class'] : 'bi-check-circle';
                $title      = isset($item['title']) ? $item['title'] : '';
                $subtitle   = isset($item['subtitle']) ? $item['subtitle'] : '';
            ?>
                <div class="d-flex flex-column align-items-center px-2">
                    <div>
                        <?php if (! empty($icon_class)) : ?>
                            <div class="trust-icon-wrapper mb-1">
                                <i class="bi <?php echo esc_attr($icon_class); ?> fs-4 text-primary"></i>
                            </div>
                        <?php endif; ?>

                        <div class="lh-sm">
                            <?php if (! empty($title)) : ?>
                                <span class="trust-title fw-bold text-dark d-block" style="font-size: 0.85rem;">
                                    <?php echo esc_html($title); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php if (! empty($subtitle)) : ?>
                        <div class="pt-1">
                            <span class="trust-subtitle text-muted d-block" style="font-size: 0.75rem;">
                                <?php echo esc_html($subtitle); ?>
                            </span>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php
    return ob_get_clean();
}
add_shortcode('badges_confianza_single', 'mitema_trust_badges_shortcode');