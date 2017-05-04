<?php
/**
 * Set up the WordPress core custom header feature.
 *
 * @uses tokoonline_header_style()
 * @uses tokoonline_admin_header_image()
 *
 * @package tokoonline
 * @since Toko Online 1.0
 */
 
// -------------------------------------------------------------
 
function tokoonline_custom_header_setup() {
/**
 * Filter Tokoonline custom-header support arguments.
 *
 * @since Toko Online 1.0
 *
 * @param array $args {
 *     An array of custom-header support arguments.
 *
 *     @type int    $width                  Width in pixels of the custom header image. Default 954.
 *     @type int    $height                 Height in pixels of the custom header image. Default 1300.
 *     @type string $wp-head-callback       Callback function used to styles the header image and text
 *                                          displayed on the blog.
 *     @type string $admin-preview-callback Callback function used to create the custom header markup in
 *                                          the Appearance > Header screen.
 * }
 */
	add_theme_support( 'custom-header', apply_filters( 'tokoonline_custom_header_args', array(
		'default-text-color'     => '220e10',
		'default-image'          => '%s/images/headers/jeti.png',
		'width'                  => 1600,
		'height'                 => 230,
		'wp-head-callback'       => 'tokoonline_header_style',
		'admin-preview-callback' => 'tokoonline_admin_header_image',
		'admin-head-callback'    => 'tokoonline_admin_header_style',		
	) ) );

	register_default_headers( array(
		'jeti' => array(
			'url'           => '%s/images/headers/jeti.png',
			'thumbnail_url' => '%s/images/headers/jeti-thumbnail.png',
			'description'   => _x( 'Jeti', 'header image description', 'tokoonline' )
		),		
	) );	
	
}
add_action( 'after_setup_theme', 'tokoonline_custom_header_setup' );

// -------------------------------------------------------------

/**
 * Styles the header image and text displayed on the blog.
 *
 * @since Tokoonline 1.0
 * @see tokoonline_custom_header_setup().
 */
function tokoonline_header_style() {
	$header_image = get_header_image();
	$text_color   = get_header_textcolor();

	// If no custom options for text are set, let's bail.
	if ( empty( $header_image ) && $text_color == get_theme_support( 'custom-header', 'default-text-color' ) )
		return;

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css" id="tokoonline-header-css">
<?php
		if ( ! empty( $header_image ) ) :
	?>
		.site-header {
			background: url(<?php header_image(); ?>) no-repeat scroll top;
			background-size: 1600px auto;
		}
		@media (max-width: 767px) {
			.site-header {
				background-size: 768px auto;
			}
		}
		@media (max-width: 359px) {
			.site-header {
				background-size: 360px auto;
			}
		}
	<?php
		endif;

		// Has the text been hidden?
		if ( ! display_header_text() ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px 1px 1px 1px); /* IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
			if ( empty( $header_image ) ) :
	?>
		.site-header .home-link {
			min-height: 0;
		}
	<?php
			endif;

		// If the user has set a custom color for the text, use that.
		elseif ( $text_color != get_theme_support( 'custom-header', 'default-text-color' ) ) :
	?>
		.site-title,
		.site-description {
			color: #<?php echo esc_attr( $text_color ); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}

// -------------------------------------------------------------

/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @since Tokoonline 1.0
 * @see tokoonline_custom_header_setup().
 */
function tokoonline_admin_header_image() {
?>
	<div id="headimg" style="background: url(<?php header_image(); ?>) no-repeat scroll top; background-size: 1600px auto;">
		<?php $style = ' style="color:#' . get_header_textcolor() . ';"'; ?>
		<div class="home-link">
			<h1 class="displaying-header-text"><a id="name"<?php echo $style; ?> onclick="return false;" href="#"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 id="desc" class="displaying-header-text"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></h2>
		</div>
	</div>
<?php
}

// -------------------------------------------------------------

/**
 * Enqueue styles to admin screen for custom header display.
 *
 * @since Tokoonline 1.0
 */
function tokoonline_admin_fonts() {
	wp_enqueue_style( 'tokoonline-fonts', tokoonline_fonts_url(), array(), null );
	wp_enqueue_style( 'tokoonline-custom-header', get_template_directory_uri() . '/css/admin-custom-header.css', array(), '20141010' );
}
add_action( 'admin_print_scripts-appearance_page_custom-header', 'tokoonline_admin_fonts' );