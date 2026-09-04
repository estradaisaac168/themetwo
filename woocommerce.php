<?php
/**
 * Plantilla principal de WooCommerce.
 *
 * @package    MyTheme
 * @subpackage Templates/WooCommerce
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Evita el acceso directo si no se ejecuta dentro de WordPress.
}

get_header();

// 1. Leemos la opción guardada desde CMB2.
$layout = cmb2_get_option( MY_THEME_PREFIX . 'woocommerce_options', 'shop_layout', 'no-sidebar' );

// 2. Evaluamos si cada sidebar debe mostrarse REALMENTE (opción activa Y widgets asignados).
$show_left_sidebar  = ( 'sidebar-left' === $layout || 'both-sidebars' === $layout ) && is_active_sidebar( 'shop-sidebar-left' );
$show_right_sidebar = ( 'sidebar-right' === $layout || 'both-sidebars' === $layout ) && is_active_sidebar( 'shop-sidebar-right' );

// 3. Calculamos la columna central dinámicamente según cuántos sidebars se muestran REALMENTE.
$main_class = 'col-12';

if ( $show_left_sidebar && $show_right_sidebar ) {
	// Están activos ambos sidebars -> ancho de 6 columnas.
	$main_class = 'col-12 col-lg-6';
} elseif ( $show_left_sidebar || $show_right_sidebar ) {
	// Solo hay un sidebar activo (izquierdo o derecho) -> ancho de 9 columnas.
	$main_class = 'col-12 col-lg-9';
}
// Si ninguno está activo o no tienen widgets, se mantiene 'col-12' (ancho completo).
?>

<div class="container my-5">
	<div class="row">

		<?php if ( $show_left_sidebar ) : ?>
			<aside class="col-12 col-lg-3 order-2 order-lg-1 shop-sidebar-left d-none d-lg-block">
				<?php dynamic_sidebar( 'shop-sidebar-left' ); ?>
			</aside>
		<?php endif; ?>

		<!-- Contenido de WooCommerce -->
		<main id="primary" class="site-main <?php echo esc_attr( $main_class ); ?> order-1 order-lg-2">
			<?php woocommerce_content(); ?>
		</main>

		<?php if ( $show_right_sidebar ) : ?>
			<aside class="col-12 col-lg-3 order-3 shop-sidebar-right d-none d-lg-block">
				<?php dynamic_sidebar( 'shop-sidebar-right' ); ?>
			</aside>
		<?php endif; ?>

	</div><!-- .row -->
</div><!-- .container -->

<?php
get_footer();