<?php
/**
 * Template tags Theme.
 *
 * @package IramaSantriTheme
 */

defined( 'ABSPATH' ) || exit;

/**
 * Menghasilkan label harga produk.
 *
 * @param int $post_id ID produk.
 * @return string
 */
function irama_santri_theme_price_label( int $post_id ): string {
	if ( ! function_exists( 'irama_santri_get_price_range' ) || ! function_exists( 'irama_santri_format_price' ) ) {
		return '';
	}

	$range = irama_santri_get_price_range( $post_id );

	if ( empty( $range['min'] ) ) {
		return __( 'Harga belum tersedia', 'irama-santri' );
	}

	$formatted = irama_santri_format_price( (int) $range['min'] );

	if ( ! empty( $range['has_variants'] ) && (int) $range['max'] > (int) $range['min'] ) {
		/* translators: %s: harga terendah. */
		return sprintf( __( 'Mulai dari %s', 'irama-santri' ), $formatted );
	}

	return $formatted;
}

/**
 * Memeriksa ketersediaan produk dengan fallback.
 *
 * @param int $post_id ID produk.
 * @return bool
 */
function irama_santri_theme_is_available( int $post_id ): bool {
	if ( function_exists( 'irama_santri_is_available' ) ) {
		return irama_santri_is_available( $post_id );
	}

	return true;
}

/**
 * Memformat harga dengan fallback.
 *
 * @param int $price Harga dalam rupiah.
 * @return string
 */
function irama_santri_theme_format_price( int $price ): string {
	if ( ! function_exists( 'irama_santri_format_price' ) ) {
		return '';
	}

	$formatted = irama_santri_format_price( $price );

	return '' !== $formatted ? $formatted : __( 'Harga belum tersedia', 'irama-santri' );
}

/**
 * Mengambil kategori produk terurut.
 *
 * @return WP_Term[]
 */
function irama_santri_theme_get_categories(): array {
	if ( function_exists( 'irama_santri_get_product_categories' ) ) {
		return irama_santri_get_product_categories();
	}

	return array();
}

/**
 * Mengambil nama kategori sebuah produk.
 *
 * @param int $post_id ID produk.
 * @return string[]
 */
function irama_santri_theme_product_category_names( int $post_id ): array {
	$terms = get_the_terms( $post_id, 'product_category' );

	if ( is_wp_error( $terms ) || empty( $terms ) ) {
		return array();
	}

	return array_map(
		static function ( WP_Term $term ): string {
			return $term->name;
		},
		$terms
	);
}

/**
 * Membuat ringkasan teks produk.
 *
 * @param array<string, mixed> $data Data produk dari Public API.
 * @param int                  $words Jumlah kata.
 * @return string
 */
function irama_santri_theme_product_excerpt( array $data, int $words = 18 ): string {
	$text = ! empty( $data['excerpt'] ) ? $data['excerpt'] : $data['description'];

	return wp_trim_words( wp_strip_all_tags( (string) $text ), $words, '…' );
}

/**
 * Membuat ringkasan teks fasilitas.
 *
 * @param int $post_id ID fasilitas.
 * @param int $words   Jumlah kata.
 * @return string
 */
function irama_santri_theme_facility_excerpt( int $post_id, int $words = 16 ): string {
	$excerpt = get_the_excerpt( $post_id );

	if ( '' === trim( $excerpt ) ) {
		$excerpt = get_post_field( 'post_content', $post_id );
	}

	return wp_trim_words( wp_strip_all_tags( (string) $excerpt ), $words, '…' );
}

/**
 * Menampilkan placeholder gambar.
 *
 * @param string $class Class pembungkus.
 * @return void
 */
function irama_santri_theme_image_placeholder( string $class = '' ): void {
	?>
	<div class="<?php echo esc_attr( $class ); ?> flex items-center justify-center bg-cream-100 text-coffee-700/60">
		<span class="text-[0.65rem] font-semibold uppercase tracking-[0.2em]">
			<?php esc_html_e( 'Foto belum tersedia', 'irama-santri' ); ?>
		</span>
	</div>
	<?php
}

/**
 * Fallback navigasi bila menu belum dibuat.
 *
 * @return void
 */
function irama_santri_theme_nav_fallback(): void {
	echo '<ul class="space-y-2 md:flex md:flex-row md:items-center md:gap-6 md:space-y-0">';
	wp_list_pages(
		array(
			'title_li' => '',
			'depth'    => 1,
		)
	);
	echo '</ul>';
}

