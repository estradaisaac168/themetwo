<?php
/**
 * themetwo functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package themetwo
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}


// Definición al inicio de functions.php
define( 'MY_THEME_PREFIX', 'themetwo_' );
define( 'MY_THEME_DOMAIN', 'themetwo' );


/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function themetwo_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on themetwo, use a find and replace
		* to change 'themetwo' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'themetwo', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'themetwo' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'themetwo_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);


	add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'themetwo_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function themetwo_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'themetwo_content_width', 640 );
}
add_action( 'after_setup_theme', 'themetwo_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function themetwo_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'themetwo' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'themetwo' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);



    // Sidebar Izquierdo de la Tienda
	register_sidebar(
		array(
			'name'          => esc_html__( 'Tienda - Barra Lateral Izquierda', MY_THEME_DOMAIN ),
			'id'            => 'shop-sidebar-left',
			'description'   => esc_html__( 'Muestra widgets en la izquierda de las páginas de WooCommerce.', MY_THEME_DOMAIN ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	// Sidebar Derecho de la Tienda
	register_sidebar(
		array(
			'name'          => esc_html__( 'Tienda - Barra Lateral Derecha', MY_THEME_DOMAIN ),
			'id'            => 'shop-sidebar-right',
			'description'   => esc_html__( 'Muestra widgets en la derecha de las páginas de WooCommerce.', MY_THEME_DOMAIN ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
}
add_action( 'widgets_init', 'themetwo_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function themetwo_scripts() {
	wp_enqueue_style( 'themetwo-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_enqueue_style( 'themetwo-main-style', get_template_directory_uri() . '/css/main.css', array(), _S_VERSION );
	wp_style_add_data( 'themetwo-style', 'rtl', 'replace' );


	// Estilos CSS de Swiper
    wp_enqueue_style(
        'swiper-css',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css',
        array(),
        '11.0.0'
    );

    // JavaScript de Swiper
    wp_enqueue_script(
        'swiper-js',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',
        array(),
        '11.0.0',
        true // Carga el script en el footer
    );


	wp_enqueue_style( 
        'bootstrap-icons', 
        'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css', 
        array(), 
        '1.11.3' 
    );

	wp_enqueue_style( 'google-fonts-preconnect-api', 'https://fonts.googleapis.com', array(), null );
    wp_enqueue_style( 'google-fonts-preconnect-gstatic', 'https://fonts.gstatic.com', array(), null );

    // 2. Encolar la fuente deseada (Cambia "Inter" por tu fuente)
    wp_enqueue_style(
        'mi-tienda-custom-font',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap',
        array(),
        null
    );

	wp_enqueue_script( 'themetwo-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'themetwo-main-script', get_template_directory_uri() . '/js/main.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'themetwo_scripts' );


// Añadir atributo crossorigin a la conexión de gstatic (Rendimiento)
function themetwo_font_loader_tag( $html, $handle ) {
    if ( 'google-fonts-preconnect-gstatic' === $handle ) {
        return str_replace( "rel='stylesheet'", "rel='preconnect' crossorigin", $html );
    }
    if ( 'google-fonts-preconnect-api' === $handle ) {
        return str_replace( "rel='stylesheet'", "rel='preconnect'", $html );
    }
    return $html;
}
add_filter( 'style_loader_tag', 'themetwo_font_loader_tag', 10, 2 );








/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Include CMB2 if it has not been included yet.
 */
if ( file_exists( get_stylesheet_directory() . '/inc/lib-cmb2/load.php' ) ) {
	require_once get_stylesheet_directory() . '/inc/lib-cmb2/load.php';
}


// require_once get_stylesheet_directory() . '/inc/functions/single-product.php';
require_once get_stylesheet_directory() . '/inc/shortcodes/pay-methods.php';
require_once get_stylesheet_directory() . '/inc/woocommerce/single-product.php';
require_once get_stylesheet_directory() . '/inc/fragments/load.php';






// 1. Declarar soporte para WooCommerce
function mytheme_add_woocommerce_support() {
    add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'mytheme_add_woocommerce_support');

// 2. Desactivar estilos nativos específicos de WooCommerce
// Desactivar TODOS los estilos nativos de WooCommerce
function remove_woocommerce_styles($enqueue_styles) {
    unset($enqueue_styles['woocommerce-general']);     // Estilos generales (botones, colores)
    unset($enqueue_styles['woocommerce-layout']);      // Maquetación y estructura base
    unset($enqueue_styles['woocommerce-smallscreen']); // Estilos responsivos / pantallas pequeñas
    return $enqueue_styles;
}
add_filter('woocommerce_enqueue_styles', 'remove_woocommerce_styles');

// 3. Encolar CSS personalizado (CORREGIDO)
// function wp_enqueue_woocommerce_style() {
//     if (class_exists('WooCommerce')) {
//         $file_path = get_template_directory() . '/css/woocommerce/woocommerce.css';
        
//         // Verificación para evitar errores si el archivo no existe
//         $version = file_exists($file_path) ? filemtime($file_path) : '1.0.0';

//         wp_enqueue_style(
//             'mytheme-woocommerce',
//             get_template_directory_uri() . '/css/woocommerce/woocommerce.css',
//             array('woocommerce-smallscreen'), // 'woocommerce-layout' eliminado para evitar dependencias rotas
//             $version
//         );
//     }
// }
// add_action('wp_enqueue_scripts', 'wp_enqueue_woocommerce_style', 99);

/**
 * Renderiza estrellas personalizadas usando Bootstrap Icons.
 */
function custom_woocommerce_bootstrap_rating( $rating = 0, $count = 0 ) {
    $rating = (float) $rating;
    
    $html = '<div class="custom-rating-stars text-warning d-flex align-items-center gap-1" title="' . esc_attr( sprintf( __( 'Valorado con %s de 5', 'woocommerce' ), $rating ) ) . '">';
    
    // Generar 5 estrellas
    for ( $i = 1; $i <= 5; $i++ ) {
        if ( $rating >= $i ) {
            $html .= '<i class="bi bi-star-fill"></i>';
        } elseif ( $rating >= ( $i - 0.5 ) ) {
            $html .= '<i class="bi bi-star-half"></i>';
        } else {
            $html .= '<i class="bi bi-star"></i>';
        }
    }

    if ( $count > 0 ) {
        $html .= '<span class="rating-count text-muted ms-1 small">(' . esc_html( $count ) . ')</span>';
    }

    $html .= '</div>';

    return $html;
}

/**
 * Reemplaza el hook nativo de WooCommerce en el loop de la tienda
 */
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

add_action( 'woocommerce_after_shop_loop_item_title', function() {
    global $product;

    if ( ! $product || ! wc_review_ratings_enabled() ) {
        return;
    }

    $rating_count = $product->get_rating_count();
    $average      = $product->get_average_rating();

    if ( $rating_count > 0 ) {
        echo custom_woocommerce_bootstrap_rating( $average, $rating_count );
    }
}, 5 );



/**
 * Reemplaza el rating nativo de WooCommerce en la vista de Producto Individual (Single Product)
 */
// 1. Remover el template nativo de WooCommerce en Single Product
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );

// 2. Insertar las estrellas de Bootstrap personalizadas
add_action( 'woocommerce_single_product_summary', function() {
    global $product;

    if ( ! $product || ! wc_review_ratings_enabled() ) {
        return;
    }

    $rating_count = $product->get_rating_count();
    $review_count = $product->get_review_count();
    $average      = $product->get_average_rating();

    if ( $rating_count > 0 ) {
        echo '<div class="woocommerce-product-rating mb-3 d-flex flex-column align-items-start gap-2">';
        
        // Llamada a tu helper existente
        echo custom_woocommerce_bootstrap_rating( $average, $rating_count );

        // Enlace directo a las valoraciones/reseñas
        if ( comments_open() ) {
            echo '<a href="#reviews" class="woocommerce-review-link text-decoration-none small text-muted" rel="nofollow">';
            printf(
                _n( '%s cliente valoró este producto', '%s clientes valoraron este producto', $review_count, 'woocommerce' ),
                '<span class="count fw-semibold">' . esc_html( $review_count ) . '</span>'
            );
            echo '</a>';
        }

        echo '</div>';
    }
}, 10 );



/**
 * Renombrar la pestaña 'Reviews' a 'Valorar'
 */
add_filter( 'woocommerce_product_tabs', 'mi_tienda_renombrar_tab_reviews', 98 );
function mi_tienda_renombrar_tab_reviews( $tabs ) {
    if ( isset( $tabs['reviews'] ) ) {
        $tabs['reviews']['title'] = __( 'Valorar', 'woocommerce' );
    }
    return $tabs;
}








// Mostrar productos recomendados cuando el carrito está vacío
add_action( 'woocommerce_cart_is_empty', 'mostrar_productos_carrito_vacio', 20 );

function mostrar_productos_carrito_vacio() {
    echo '<div class="empty-cart" style="margin-top: 2rem;">';
    echo '<h3>Productos recomendados para ti</h3>';
    
    // Renderiza una cuadrícula de 4 productos populares usando el shortcode nativo de WooCommerce
    // echo do_shortcode( '[products limit="4" orderby="popularity"]' );
	echo do_shortcode( '[products limit="4" orderby="popularity" class="mis-productos-destacados"]' );
    
    echo '</div>';
}


// Abrir contenedor con clases personalizadas alrededor de .woocommerce
add_action( 'woocommerce_before_cart', function() {
    echo '<div class="mi-woocommerce-custom-wrapper mi-clase-extra">';
}, 1 );

// Cerrar contenedor
add_action( 'woocommerce_after_cart', function() {
    echo '</div>';
}, 99 );




add_filter( 'woocommerce_checkout_fields', 'mi_tema_quitar_campos_checkout' );

function mi_tema_quitar_campos_checkout( $fields ) {

    // CAMPOS DE FACTURACIÓN (Billing)
    // unset( $fields['billing']['billing_first_name'] ); // Nombre
    // unset( $fields['billing']['billing_last_name'] );  // Apellidos
    unset( $fields['billing']['billing_company'] );     // Nombre de la empresa
    unset( $fields['billing']['billing_address_2'] );   // Dirección línea 2 (apartamento, suite, etc.)
    unset( $fields['billing']['billing_city'] );        // Ciudad
    unset( $fields['billing']['billing_postcode'] );    // Código postal
    unset( $fields['billing']['billing_country'] );     // País
    unset( $fields['billing']['billing_state'] );       // Estado / Provincia
    unset( $fields['billing']['billing_phone'] );       // Teléfono

    // CAMPOS DE ENVÍO (Shipping - si se envía a una dirección distinta)
    unset( $fields['shipping']['shipping_company'] );
    unset( $fields['shipping']['shipping_address_2'] );
    unset( $fields['shipping']['shipping_postcode'] );

    // NOTAS DEL PEDIDO (Order Notes)
    unset( $fields['order']['order_comments'] );

    return $fields;
}



/**
 * Inyecta CSS crítico en el <head> para evitar FOUC en el slider de precios de WooCommerce.
 */
function my_theme_critical_price_filter_css() {
	if ( function_exists( 'is_woocommerce' ) && ( is_shop() || is_product_taxonomy() ) ) {
		?>
		<style id="critical-price-filter-css">
			.widget_price_filter input#min_price,
			.widget_price_filter input#max_price { display: none !important; }
			.price_slider_wrapper .price_slider {
				position: relative !important;
				height: 6px !important;
				background-color: #e9ecef !important;
				border-radius: 10px !important;
				margin-bottom: 1.5rem !important;
			}
			.price_slider_wrapper .ui-slider-handle {
				position: absolute !important;
				top: 50% !important;
				transform: translate(-50%, -50%) !important;
				transition: none !important; /* Desactiva animaciones de posición al inicializar */
			}
		</style>
		<?php
	}
}
add_action( 'wp_head', 'my_theme_critical_price_filter_css', 1 );






