<?php





/**
 * Configuración de los swatches por atributo.
 *
 * La clave es el slug de la taxonomía del atributo (p. ej. "pa_color").
 * - type:   "color" o "button".
 * - colors: mapa término → color hex (solo para type "color").
 *
 * Filtrable con themetwo_variation_swatch_config.
 *
 * @return array
 */
function themetwo_variation_swatch_config()
{

	$config = array(
		'pa_color' => array(
			'type'   => 'color',
			'colors' => array(
				'blue'   => '#0d6efd',
				'gray'   => '#6c757d',
				'green'  => '#198754',
				'red'    => '#dc3545',
				'yellow' => '#ffc107',
			),
		),
		'pa_size'  => array(
			'type' => 'button',
		),
	);

	return apply_filters('themetwo_variation_swatch_config', $config);
}

/**
 * Localiza la configuración de swatches para el bundle JS del tema.
 */
function themetwo_localize_swatches()
{
	wp_localize_script('themetwo-main-script', 'childThemeSwatches', themetwo_variation_swatch_config());
}
add_action('wp_enqueue_scripts', 'themetwo_localize_swatches', 20);



















/**
 * Shortcode para mostrar los iconos de métodos de pago aceptados.
 *
 * Los iconos (SVG) disponibles viven en la carpeta img/svg del tema y se
 * eligen en Apariencia → "Opciones de la tienda" (sección "Métodos de pago").
 *
 * Uso: [metodos_pago titulo="..." metodos="visa,mastercard" alineacion="center" tamano="32px"]
 * El atributo `metodos` es un filtro OPCIONAL: si se omite, se muestran todos
 * los iconos marcados en las opciones del tema.
 */
function registrar_shortcode_metodos_pago($atts)
{
	// Atributos por defecto.
	$atts = shortcode_atts(
		array(
			'titulo'     => 'Métodos de pago aceptados',
			'metodos'    => '',                        // Filtro opcional (separados por coma).
			'alineacion' => 'start',                  // center, start, end
			'tamano'     => '32px',                    // Altura máxima de los iconos
		),
		$atts,
		'metodos_pago'
	);

	$iconos = themetwo_payment_icons();

	if (empty($iconos)) {
		return '';
	}

	// Selección desde la página de opciones del tema (campo payment_method_icons).
	$seleccionados = array();
	if (function_exists('cmb2_get_option')) {
		$seleccionados = (array) cmb2_get_option('themetwo_options', 'payment_method_icons', array());
		$seleccionados = array_values(array_filter(array_map('sanitize_key', $seleccionados)));
	}

	// Filtro opcional del shortcode: intersección con la selección del tema.
	if (! empty($atts['metodos'])) {
		$filtro        = array_filter(array_map('sanitize_key', array_map('trim', explode(',', $atts['metodos']))));
		$seleccionados = $seleccionados ? array_intersect($seleccionados, $filtro) : $filtro;
	}

	// Sin selección configurada: se muestran todos los disponibles.
	if (empty($seleccionados)) {
		$seleccionados = array_keys($iconos);
	}

	ob_start();
?>
	<div class="metodos-pago-wrapper text-<?php echo esc_attr($atts['alineacion']); ?> my-3">
		<?php if (! empty($atts['titulo'])) : ?>
			<p class="metodos-pago-titulo fw-bold mb-2"><?php echo esc_html($atts['titulo']); ?></p>
		<?php endif; ?>

		<ul class="metodos-pago-lista d-flex justify-content-<?php echo esc_attr($atts['alineacion']); ?> align-items-center flex-wrap gap-2 list-unstyled p-0 m-0">
			<?php foreach ($seleccionados as $metodo) : ?>
				<?php if (isset($iconos[$metodo])) : ?>
					<li class="metodo-item">
						<img
							src="<?php echo esc_url($iconos[$metodo]['url']); ?>"
							alt="<?php echo esc_attr($iconos[$metodo]['label']); ?>"
							title="<?php echo esc_attr($iconos[$metodo]['label']); ?>"
							class="img-fluid"
							style="max-height: <?php echo esc_attr($atts['tamano']); ?>; width: auto;"
							loading="lazy" />
					</li>
				<?php endif; ?>
			<?php endforeach; ?>
		</ul>
	</div>
<?php
	return ob_get_clean();
}
add_shortcode('metodos_pago', 'registrar_shortcode_metodos_pago');

// /**
//  * Renderiza el shortcode de métodos de pago en la página de producto individual.
//  */
// function mostrar_metodos_pago_en_producto() {
//     echo do_shortcode( '[metodos_pago titulo="Métodos de pago aceptados" tamano="30px"]' );
// }

/**
 * Muestra el bloque de Garantías + el Shortcode de Métodos de Pago debajo del botón de compra.
 */
function agregar_bloque_confianza_producto()
{
	$garantias = array(
		array(
			'icono'  => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>',
			'titulo' => 'Envío Rápido',
			'desc'   => 'Despacho en 24-48h hábiles'
		),
		array(
			'icono'  => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>',
			'titulo' => 'Garantía Segura',
			'desc'   => '30 días de devolución'
		),
		array(
			'icono'  => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>',
			'titulo' => 'Pago Cifrado',
			'desc'   => 'Tus datos están protegidos'
		),
	);
?>

	<div class="bloque-confianza-producto my-4 p-3 rounded border bg-light">
		<!-- Garantías -->
		<div class="garantias-grid d-flex flex-column gap-2 mb-3 pb-3 border-bottom">
			<?php foreach ($garantias as $item) : ?>
				<div class="garantia-item d-flex align-items-center gap-2">
					<span class="garantia-icono text-primary d-flex align-items-center">
						<?php echo $item['icono']; ?>
					</span>
					<div class="garantia-texto">
						<span class="fw-bold fs-6 text-dark"><?php echo esc_html($item['titulo']); ?></span>
						<small class="text-muted d-block lh-1" style="font-size: 0.8rem;"><?php echo esc_html($item['desc']); ?></small>
					</div>
				</div>
			<?php endforeach; ?>
		</div>

		<!-- Invocación de tu shortcode existente -->
		<?php echo do_shortcode('[metodos_pago titulo="Pago seguro garantizado" tamano="26px"]'); ?>
	</div>

	<?php
}
// Hook justo debajo del botón "Añadir al carrito"
add_action('woocommerce_after_add_to_cart_form', 'agregar_bloque_confianza_producto', 15);







/**
 * Inyectar slider de testimonios después de las tabs del producto
 */
add_action('woocommerce_after_single_product_summary', 'agregar_carrusel_reseñas_single_product', 15);

function agregar_carrusel_reseñas_single_product()
{

	// 1. Obtener la ID del producto actual
	$product_id = get_the_ID();


	// Validación Custom Field (meta box / metabox personalizada)
	if ('on' !== get_post_meta($product_id, MY_THEME_PREFIX . '_product_show_reviews', true)) {
		return;
	}


	// 2. Consultar las reseñas
	$reviews = get_comments(
		array(
			'post_id'      => $product_id,
			'comment_type' => 'review',
			'status'       => 'approve',
			'number'       => 40,
			'orderby'      => 'comment_date_gmt',
			'order'        => 'DESC',
		)
	);

	// 3. Renderizar solo si hay reseñas
	if (! empty($reviews)) : ?>
		<div class="testimonial-container my-5">

			<!-- <div class="row"> -->

				<div class="col">
					<h2 class="testimonial-section-title">Lo que dicen nuestros clientes</h2>
					<p class="testimonial-section-description">
						Descubre las experiencias y valoraciones reales de quienes ya han probado nuestros productos.
					</p>
				<!-- </div>

				<div class="col"> -->
					<div class="swiper testimonial-swiper">
						<div class="swiper-wrapper">
							<?php foreach ($reviews as $review) :
								$avatar_url = get_avatar_url($review->comment_author_email, array('size' => 100));
								$rating     = get_comment_meta($review->comment_ID, 'rating', true);
							?>
								<div class="swiper-slide">
									<div class="testimonial-card">
										<div class="testimonial-card-header">
											<div class="testimonial-card-quotes-icon">
												<img src="quotes.png" alt="Quotes">
											</div>
										</div>
										<p class="testimonial-card-text">
											"<?php echo esc_html($review->comment_content); ?>"
										</p>
										<div class="testimonial-card-footer">
											<img src="<?php echo esc_url($avatar_url); ?>" alt="<?php echo esc_attr($review->comment_author); ?>">
											<div>
												<h5 class="client-name"><?php echo esc_html($review->comment_author); ?></h5>

												<?php if ($rating) : ?>
													<span class="client-designation">
														<?php echo esc_html($rating); ?>/5 ★
													</span>
												<?php endif; ?>

												<br>
												<span class="client-org">
													<?php echo esc_html(get_comment_date('j F, Y', $review->comment_ID)); ?>
												</span>
											</div>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
						<div class="swiper-button-prev"></div>
						<div class="swiper-button-next"></div>
					</div>
				</div>
			<!-- </div> -->

		</div>
<?php endif;
}
