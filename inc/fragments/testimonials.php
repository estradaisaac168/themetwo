<?php


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
