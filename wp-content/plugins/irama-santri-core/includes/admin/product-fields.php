<?php
/**
 * Meta box produk: harga, status, varian, dan add-on.
 *
 * @package IramaSantriCore
 */

defined( 'ABSPATH' ) || exit;

/**
 * Menampilkan satu baris repeater.
 *
 * @param string $key      Kunci field: variants atau addons.
 * @param int    $index    Indeks baris.
 * @param array  $item     Data baris.
 * @param bool   $template Apakah ini template JavaScript.
 * @return void
 */
function irama_santri_render_item_row( string $key, int $index, array $item = array(), bool $template = false ): void {
	$label     = isset( $item['label'] ) ? (string) $item['label'] : '';
	$price     = isset( $item['price'] ) ? (int) $item['price'] : 0;
	$name_base = 'irama_santri_' . $key . '[' . $index . ']';
	?>
	<div class="is-repeater__row" data-row>
		<input
			type="text"
			<?php if ( ! $template ) : ?>
				name="<?php echo esc_attr( $name_base . '[label]' ); ?>"
			<?php endif; ?>
			data-field="label"
			value="<?php echo esc_attr( $label ); ?>"
			placeholder="<?php esc_attr_e( 'Nama', 'irama-santri' ); ?>"
			aria-label="<?php esc_attr_e( 'Nama', 'irama-santri' ); ?>"
		>
		<input
			type="number"
			min="0"
			step="1"
			<?php if ( ! $template ) : ?>
				name="<?php echo esc_attr( $name_base . '[price]' ); ?>"
			<?php endif; ?>
			data-field="price"
			value="<?php echo esc_attr( (string) $price ); ?>"
			placeholder="<?php esc_attr_e( 'Harga', 'irama-santri' ); ?>"
			aria-label="<?php esc_attr_e( 'Harga dalam rupiah', 'irama-santri' ); ?>"
		>
		<button type="button" class="button" data-remove>
			<?php esc_html_e( 'Hapus', 'irama-santri' ); ?>
		</button>
	</div>
	<?php
}

/**
 * Menampilkan repeater varian atau add-on.
 *
 * @param string $key      Kunci field.
 * @param string $title    Judul section.
 * @param string $singular Label tombol tambah.
 * @param array  $items    Daftar item.
 * @return void
 */
function irama_santri_render_items_repeater( string $key, string $title, string $singular, array $items ): void {
	?>
	<div class="is-repeater" data-repeater="<?php echo esc_attr( $key ); ?>">
		<div class="is-repeater__header">
			<h3><?php echo esc_html( $title ); ?></h3>
			<p class="description">
				<?php esc_html_e( 'Kosongkan jika produk tidak memiliki bagian ini. Harga dalam rupiah.', 'irama-santri' ); ?>
			</p>
		</div>

		<div class="is-repeater__head" aria-hidden="true">
			<span><?php esc_html_e( 'Nama', 'irama-santri' ); ?></span>
			<span><?php esc_html_e( 'Harga (Rp)', 'irama-santri' ); ?></span>
			<span></span>
		</div>

		<div class="is-repeater__rows" data-rows>
			<?php
			foreach ( array_values( $items ) as $index => $item ) {
				irama_santri_render_item_row( $key, (int) $index, is_array( $item ) ? $item : array() );
			}
			?>
		</div>

		<template data-template>
			<?php irama_santri_render_item_row( $key, 0, array(), true ); ?>
		</template>

		<p class="is-repeater__actions">
			<button type="button" class="button" data-add>
				<?php
				/* translators: %s: nama bagian, misalnya varian. */
				printf( esc_html__( 'Tambah %s', 'irama-santri' ), esc_html( $singular ) );
				?>
			</button>
		</p>
	</div>
	<?php
}

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
	$variants  = irama_santri_get_variants( $post->ID );
	$addons    = irama_santri_get_addons( $post->ID );

	wp_nonce_field( 'irama_santri_product_meta', 'irama_santri_product_nonce' );
	?>
	<div class="is-product-fields">
		<div class="is-field-grid">
			<p class="is-field">
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
				<span class="description">
					<?php esc_html_e( 'Isi 0 jika harga ditentukan oleh varian.', 'irama-santri' ); ?>
				</span>
			</p>

			<fieldset class="is-field">
				<legend><strong><?php esc_html_e( 'Status', 'irama-santri' ); ?></strong></legend>
				<label class="is-checkbox">
					<input
						type="checkbox"
						name="irama_santri_available"
						value="1"
						<?php checked( $available ); ?>
					>
					<?php esc_html_e( 'Tersedia', 'irama-santri' ); ?>
				</label>
				<label class="is-checkbox">
					<input
						type="checkbox"
						name="irama_santri_featured"
						value="1"
						<?php checked( $featured ); ?>
					>
					<?php esc_html_e( 'Tampilkan sebagai menu unggulan', 'irama-santri' ); ?>
				</label>
			</fieldset>
		</div>

		<?php
		irama_santri_render_items_repeater( 'variants', __( 'Varian', 'irama-santri' ), __( 'varian', 'irama-santri' ), $variants );
		irama_santri_render_items_repeater( 'addons', __( 'Add-on', 'irama-santri' ), __( 'add-on', 'irama-santri' ), $addons );
		?>
	</div>
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
		'normal',
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

	$price    = isset( $_POST['irama_santri_base_price'] )
		? irama_santri_sanitize_price( wp_unslash( $_POST['irama_santri_base_price'] ) )
		: 0;
	$variants = isset( $_POST['irama_santri_variants'] )
		? irama_santri_sanitize_json_items( wp_unslash( $_POST['irama_santri_variants'] ), 20 )
		: '[]';
	$addons   = isset( $_POST['irama_santri_addons'] )
		? irama_santri_sanitize_json_items( wp_unslash( $_POST['irama_santri_addons'] ), 20 )
		: '[]';

	update_post_meta( $post_id, '_is_base_price', $price );
	update_post_meta( $post_id, '_is_available', isset( $_POST['irama_santri_available'] ) ? 1 : 0 );
	update_post_meta( $post_id, '_is_featured', isset( $_POST['irama_santri_featured'] ) ? 1 : 0 );
	update_post_meta( $post_id, '_is_variants', $variants );
	update_post_meta( $post_id, '_is_addons', $addons );
}
add_action( 'save_post_product', 'irama_santri_save_product_meta' );
