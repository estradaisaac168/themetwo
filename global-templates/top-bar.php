<?php


// Exit if accessed directly.
defined('ABSPATH') || exit;
?>
<div id="top-search-bar" class="d-none d-lg-block bg-gradient-client py-2">
    <div class="search-header mt-2">
        <div class="container">
            <div class="row align-items-center">

                <?php
                // Evaluamos si el bloque del carrito debe mostrarse
                $show_cart_block = class_exists('WooCommerce') && ! is_cart() && ! is_checkout();

                // Si hay carrito, el buscador toma 6 cols en 'lg', si no, toma 9 cols para completar las 12
                $brand_lg_col = $show_cart_block ? 'col-lg-3' : 'col-lg-6';
                $search_lg_col = $show_cart_block ? 'col-lg-6' : 'col-lg-6';
                ?>

                <!-- 1. Logo / Branding -->
                <div class="col-12 col-md-4 <?php echo esc_attr($brand_lg_col); ?> d-flex justify-content-center justify-content-md-start align-items-center mb-2 mb-md-0">
                    <div class="site-branding">
                        <?php
                        the_custom_logo();
                        if (is_front_page() && is_home()) :
                        ?>
                            <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
                        <?php
                        else :
                        ?>
                            <p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
                        <?php
                        endif;
                        $themetwo_description = get_bloginfo('description', 'display');
                        if ($themetwo_description || is_customize_preview()) :
                        ?>
                            <p class="site-description"><?php echo $themetwo_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
                                                        ?></p>
                        <?php endif; ?>
                    </div><!-- .site-branding -->
                </div>

                <!-- 2. Buscador (Estructura dinámica) -->
                <div class="col-12 col-md-8 <?php echo esc_attr($search_lg_col); ?>">
                    <div class="my-1">
                        <?php echo do_shortcode('[aws_search_form]'); ?>
                    </div>
                </div>

                <!-- 3. Botón del Carrito (Opcional) -->
                <?php if ($show_cart_block) : ?>
                    <div class="col-12 d-none d-lg-flex col-lg-3 justify-content-end align-items-center js-cart-block-wrapper">
                        <a class="cart-customlocation btn btn-outline-dark btn-lg" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php esc_attr_e('View your shopping cart', 'woocommerce'); ?>">
                            <i class="bi bi-cart3 me-1"></i>
                            <?php echo sprintf(_n('%d item', '%d items', WC()->cart->get_cart_contents_count(), 'woocommerce'), WC()->cart->get_cart_contents_count()); ?> - <?php echo WC()->cart->get_cart_total(); ?>
                        </a>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>