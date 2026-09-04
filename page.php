<?php
/**
 * Plantilla para mostrar páginas individuales.
 *
 * @package    MyTheme
 * @subpackage Templates
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Evita el acceso directo.
}

get_header();

// 1. Obtener la opción del metabox de la página actual (con fallback 'no-sidebar').
$page_id     = get_the_ID();
$meta_layout = get_post_meta( $page_id, 'page_layout', true );
$layout      = ! empty( $meta_layout ) ? $meta_layout : 'no-sidebar';

// 2. Evaluamos si cada sidebar debe mostrarse REALMENTE (opción activa Y widgets asignados).
// *Nota: Asegúrate de ajustar 'sidebar-1' o los IDs según los sidebars registrados en tu functions.php.
$show_left_sidebar  = ( 'sidebar-left' === $layout || 'both-sidebars' === $layout ) && is_active_sidebar( 'sidebar-left' );
$show_right_sidebar = ( 'sidebar-right' === $layout || 'both-sidebars' === $layout ) && is_active_sidebar( 'sidebar-right' );

// 3. Calculamos la columna central dinámicamente.
$main_class = 'col-12';

if ( $show_left_sidebar && $show_right_sidebar ) {
	// Ambos sidebars activos -> ancho de 6 columnas.
	$main_class = 'col-12 col-lg-6';
} elseif ( $show_left_sidebar || $show_right_sidebar ) {
	// Solo un sidebar activo -> ancho de 9 columnas.
	$main_class = 'col-12 col-lg-9';
}
// Si ninguno tiene widgets o la opción es 'no-sidebar', permanece en 'col-12'.
?>

<div class="container my-4">
	<div class="row">

		<?php if ( $show_left_sidebar ) : ?>
			<aside class="col-12 col-lg-3 order-2 order-lg-1 page-sidebar-left">
				<?php dynamic_sidebar( 'sidebar-left' ); ?>
			</aside>
		<?php endif; ?>

		<!-- Contenido Principal -->
		<main id="primary" class="site-main <?php echo esc_attr( $main_class ); ?> order-1 order-lg-2">
			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', 'page' );

				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile;
			?>
		</main>

		<?php if ( $show_right_sidebar ) : ?>
			<aside class="col-12 col-lg-3 order-3 page-sidebar-right">
				<?php dynamic_sidebar( 'sidebar-right' ); ?>
			</aside>
		<?php endif; ?>

	</div><!-- .row -->
</div><!-- .container -->

<?php
get_footer();