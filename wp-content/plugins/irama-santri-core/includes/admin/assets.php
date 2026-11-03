<?php
/**
 * Enqueue aset admin.
 *
 * @package IramaSantriCore
 */

defined( 'ABSPATH' ) || exit;

/**
 * Memuat CSS dan JavaScript admin pada layar yang relevan.
 *
 * @param string $hook_suffix Hook layar admin.
 * @return void
 */
function irama_santri_enqueue_admin_assets( string $hook_suffix ): void {
	$screen      = get_current_screen();
	$is_product  = $screen && 'product' === $screen->post_type && in_array( $hook_suffix, array( 'post.php', 'post-new.php' ), true );
	$is_settings = 'toplevel_page_irama-santri' === $hook_suffix;

	if ( ! $is_product && ! $is_settings ) {
		return;
	}

	$css_path = IRAMA_SANTRI_PLUGIN_DIR . 'assets/css/admin.css';
	$css_ver  = file_exists( $css_path ) ? (string) filemtime( $css_path ) : IRAMA_SANTRI_VERSION;

	wp_enqueue_style(
		'irama-santri-admin',
		IRAMA_SANTRI_PLUGIN_URL . 'assets/css/admin.css',
		array(),
		$css_ver
	);

	if ( $is_product ) {
		$js_path = IRAMA_SANTRI_PLUGIN_DIR . 'assets/js/product-fields.js';
		$js_ver  = file_exists( $js_path ) ? (string) filemtime( $js_path ) : IRAMA_SANTRI_VERSION;

		wp_enqueue_script(
			'irama-santri-product-fields',
			IRAMA_SANTRI_PLUGIN_URL . 'assets/js/product-fields.js',
			array(),
			$js_ver,
			true
		);
	}

	if ( $is_settings ) {
		$js_path = IRAMA_SANTRI_PLUGIN_DIR . 'assets/js/gallery.js';
		$js_ver  = file_exists( $js_path ) ? (string) filemtime( $js_path ) : IRAMA_SANTRI_VERSION;

		wp_enqueue_media();
		wp_enqueue_script(
			'irama-santri-gallery',
			IRAMA_SANTRI_PLUGIN_URL . 'assets/js/gallery.js',
			array( 'media-editor' ),
			$js_ver,
			true
		);
	}
}
add_action( 'admin_enqueue_scripts', 'irama_santri_enqueue_admin_assets' );
