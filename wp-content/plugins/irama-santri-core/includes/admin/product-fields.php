<?php
/**
 * Meta box produk.
 *
 * Variasi harga dan add-on dikelola pada tahap implementasi fitur.
 *
 * @package IramaSantriCore
 */

defined( 'ABSPATH' ) || exit;

/**
 * Menampilkan meta box detail produk.
 *
 * @param WP_Post $post Post yang sedang diedit.
 * @return void
 */
function irama_santri_render_product_meta_box( WP_Post $post ): void {
	$price     = (int) get_post_meta( $post->ID, '_is_base_price', true );
	$available = irama_santri_is_available( $post->ID );
	$featured  = (bool) get_post_meta( $post->ID, '_is_featured', true );

	wp_nonce_field( 'irama_santri_product_meta', 'irama_santri_product_nonce' );
	?>
	<p>
		<label for="irama_santri_base_price">
			<strong><?php esc_html_e( 'Harga dasar (Rp)', 'irama-santri' ); ?></strong>
		</label>
		<input
			type="number"
			min="0"
			step="1"
			class="widefat"
			id="irama_santri_base_price"
			name="irama_santri_base_price"
			value="<?php echo esc_attr( (string) $price ); ?>"
		>
	</p>
	<p class="description">
		<?php esc_html_e( 'Isi 0 jika harga ditentukan oleh varian.', 'irama-santri' ); ?>
	</p>
	<p>
		<label>
			<input
				type="checkbox"
				name="irama_santri_available"
				value="1"
				<?php checked( $available ); ?>
			>
			<?php esc_html_e( 'Tersedia', 'irama-santri' ); ?>
		</label>
	</p>
	<p>
		<label>
			<input
				type="checkbox"
				name="irama_santri_featured"
				value="1"
				<?php checked( $featured ); ?>
			>
			<?php esc_html_e( 'Tampilkan sebagai menu unggulan', 'irama-santri' ); ?>
		</label>
	</p>
	<?php
}

/**
 * Mendaftarkan meta box.
 *
 * @return void
 */
function irama_santri_add_product_meta_box(): void {
	add_meta_box(
		'irama_santri_product_details',
		__( 'Detail Produk', 'irama-santri' ),
		'irama_santri_render_product_meta_box',
		'product',
		'side',
		'high'
	);
}
add_action( 'add_meta_boxes_product', 'irama_santri_add_product_meta_box' );

/**
 * Menyimpan meta produk.
 *
 * @param int $post_id ID produk.
 * @return void
 */
function irama_santri_save_product_meta( int $post_id ): void {
	if ( ! isset( $_POST['irama_santri_product_nonce'] ) ) {
		return;
	}

	$nonce = sanitize_text_field( wp_unslash( $_POST['irama_santri_product_nonce'] ) );

	if ( ! wp_verify_nonce( $nonce, 'irama_santri_product_meta' ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( wp_is_post_revision( $post_id ) ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$price = isset( $_POST['irama_santri_base_price'] )
		? irama_santri_sanitize_price( wp_unslash( $_POST['irama_santri_base_price'] ) )
		: 0;

	update_post_meta( $post_id, '_is_base_price', $price );
	update_post_meta( $post_id, '_is_available', isset( $_POST['irama_santri_available'] ) ? 1 : 0 );
	update_post_meta( $post_id, '_is_featured', isset( $_POST['irama_santri_featured'] ) ? 1 : 0 );
}
add_action( 'save_post_product', 'irama_santri_save_product_meta' );
