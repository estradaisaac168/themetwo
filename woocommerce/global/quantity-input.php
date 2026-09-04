<?php
/**
 * Product quantity inputs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/quantity-input.php.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 10.1.0
 *
 * @var bool   $readonly If the input should be set to readonly mode.
 * @var string $type     The input type attribute.
 */

defined( 'ABSPATH' ) || exit;

/* translators: %s: Quantity. */
$label = ! empty( $args['product_name'] ) 
    ? sprintf( esc_html__( '%s quantity', 'woocommerce' ), wp_strip_all_tags( $args['product_name'] ) ) 
    : esc_html__( 'Quantity', 'woocommerce' );

$classes      = is_array( $classes ) ? $classes : (array) $classes;
$autocomplete = $autocomplete ?? 'on';
?>
<div class="quantity">
    <?php do_action( 'woocommerce_before_quantity_input_field' ); ?>

    <label class="screen-reader-text" for="<?php echo esc_attr( $input_id ); ?>">
        <?php echo esc_html( $label ); ?>
    </label>

    <div class="input-group input-group-sm">
        <button type="button" class="qty-btn minus" aria-label="<?php esc_attr_e( 'Disminuir cantidad', 'woocommerce' ); ?>">
            <i class="bi bi-dash" aria-hidden="true"></i>
        </button>

        <input
            type="<?php echo esc_attr( $type ); ?>"
            <?php echo $readonly ? 'readonly="readonly"' : ''; ?>
            id="<?php echo esc_attr( $input_id ); ?>"
            class="form-control <?php echo esc_attr( implode( ' ', $classes ) ); ?>"
            name="<?php echo esc_attr( $input_name ); ?>"
            value="<?php echo esc_attr( $input_value ); ?>"
            aria-label="<?php esc_attr_e( 'Product quantity', 'woocommerce' ); ?>"
            <?php if ( in_array( $type, array( 'text', 'search', 'tel', 'url', 'email', 'password' ), true ) ) : ?>
                size="4"
            <?php endif; ?>
            min="<?php echo esc_attr( $min_value ); ?>"
            <?php if ( 0 < $max_value ) : ?>
                max="<?php echo esc_attr( $max_value ); ?>"
            <?php endif; ?>
            <?php if ( ! $readonly ) : ?>
                step="<?php echo esc_attr( $step ); ?>"
                placeholder="<?php echo esc_attr( $placeholder ); ?>"
                inputmode="<?php echo esc_attr( $inputmode ); ?>"
                autocomplete="<?php echo esc_attr( $autocomplete ); ?>"
            <?php endif; ?>
        />

        <button type="button" class="qty-btn plus" aria-label="<?php esc_attr_e( 'Aumentar cantidad', 'woocommerce' ); ?>">
            <i class="bi bi-plus" aria-hidden="true"></i>
        </button>
    </div>

    <?php do_action( 'woocommerce_after_quantity_input_field' ); ?>
</div>