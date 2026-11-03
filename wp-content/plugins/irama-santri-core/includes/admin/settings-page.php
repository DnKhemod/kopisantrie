<?php
/**
 * Halaman pengaturan plugin.
 *
 * @package IramaSantriCore
 */

defined( 'ABSPATH' ) || exit;

/**
 * Mendaftarkan menu admin.
 *
 * @return void
 */
function irama_santri_register_admin_pages(): void {
	add_menu_page(
		__( 'Irama Santri', 'irama-santri' ),
		__( 'Irama Santri', 'irama-santri' ),
		'manage_options',
		'irama-santri',
		'irama_santri_render_settings_page',
		'dashicons-store',
		3
	);
}

/**
 * Menampilkan halaman Info Kedai dan Galeri.
 *
 * @return void
 */
function irama_santri_render_settings_page(): void {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	$info        = irama_santri_get_business_info();
	$map         = irama_santri_get_page_map();
	$gallery_ids = irama_santri_get_gallery_ids();
	?>
	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

		<form method="post" action="options.php">
			<?php settings_fields( 'irama_santri_settings' ); ?>

			<h2><?php esc_html_e( 'Info Kedai', 'irama-santri' ); ?></h2>
			<table class="form-table" role="presentation">
				<tr>
					<th scope="row">
						<label for="irama_santri_address"><?php esc_html_e( 'Alamat', 'irama-santri' ); ?></label>
					</th>
					<td>
						<textarea
							id="irama_santri_address"
							name="irama_santri_business_info[address]"
							rows="3"
							class="large-text"
						><?php echo esc_textarea( $info['address'] ); ?></textarea>
					</td>
				</tr>
				<tr>
					<th scope="row">
						<label for="irama_santri_hours"><?php esc_html_e( 'Jam operasional', 'irama-santri' ); ?></label>
					</th>
					<td>
						<input
							type="text"
							id="irama_santri_hours"
							name="irama_santri_business_info[hours]"
							value="<?php echo esc_attr( $info['hours'] ); ?>"
							class="regular-text"
						>
					</td>
				</tr>
			</table>

			<h2><?php esc_html_e( 'Pemetaan Halaman', 'irama-santri' ); ?></h2>
			<p class="description">
				<?php esc_html_e( 'Pilih halaman yang menjadi tujuan tombol Menu dan Contact.', 'irama-santri' ); ?>
			</p>
			<table class="form-table" role="presentation">
				<tr>
					<th scope="row">
						<label for="irama_santri_menu_page_id"><?php esc_html_e( 'Halaman Menu', 'irama-santri' ); ?></label>
					</th>
					<td>
						<?php
						wp_dropdown_pages(
							array(
								'name'              => 'irama_santri_page_map[menu_page_id]',
								'id'                => 'irama_santri_menu_page_id',
								'selected'          => $map['menu_page_id'],
								'show_option_none'  => __( '— Pilih halaman —', 'irama-santri' ),
								'option_none_value' => 0,
							)
						);
						?>
					</td>
				</tr>
				<tr>
					<th scope="row">
						<label for="irama_santri_contact_page_id"><?php esc_html_e( 'Halaman Contact', 'irama-santri' ); ?></label>
					</th>
					<td>
						<?php
						wp_dropdown_pages(
							array(
								'name'              => 'irama_santri_page_map[contact_page_id]',
								'id'                => 'irama_santri_contact_page_id',
								'selected'          => $map['contact_page_id'],
								'show_option_none'  => __( '— Pilih halaman —', 'irama-santri' ),
								'option_none_value' => 0,
							)
						);
						?>
					</td>
				</tr>
			</table>

			<h2><?php esc_html_e( 'Galeri', 'irama-santri' ); ?></h2>
			<p class="description">
				<?php esc_html_e( 'Pilih foto dari Media Library, lalu atur urutannya dengan tombol Naik dan Turun.', 'irama-santri' ); ?>
			</p>

			<input
				type="hidden"
				name="irama_santri_gallery_ids"
				value="<?php echo esc_attr( implode( ',', $gallery_ids ) ); ?>"
				data-gallery-input
			>

			<p>
				<button type="button" class="button" data-gallery-add>
					<?php esc_html_e( 'Pilih Foto', 'irama-santri' ); ?>
				</button>
			</p>

			<p class="description" data-gallery-empty <?php echo empty( $gallery_ids ) ? '' : 'hidden'; ?>>
				<?php esc_html_e( 'Belum ada foto galeri.', 'irama-santri' ); ?>
			</p>

			<ul class="is-gallery" data-gallery-list>
				<?php foreach ( $gallery_ids as $gallery_id ) : ?>
					<?php $gallery_title = get_the_title( $gallery_id ); ?>
					<li data-id="<?php echo esc_attr( (string) $gallery_id ); ?>">
						<?php
						echo wp_get_attachment_image(
							$gallery_id,
							'thumbnail',
							false,
							array( 'class' => 'is-gallery__thumb' )
						);
						?>
						<div class="is-gallery__actions">
							<button
								type="button"
								class="button"
								data-move="up"
								aria-label="<?php echo esc_attr( sprintf( /* translators: %s: judul foto. */ __( 'Naik: %s', 'irama-santri' ), $gallery_title ) ); ?>"
							>
								<?php esc_html_e( 'Naik', 'irama-santri' ); ?>
							</button>
							<button
								type="button"
								class="button"
								data-move="down"
								aria-label="<?php echo esc_attr( sprintf( /* translators: %s: judul foto. */ __( 'Turun: %s', 'irama-santri' ), $gallery_title ) ); ?>"
							>
								<?php esc_html_e( 'Turun', 'irama-santri' ); ?>
							</button>
							<button
								type="button"
								class="button button-link-delete"
								data-remove
								aria-label="<?php echo esc_attr( sprintf( /* translators: %s: judul foto. */ __( 'Hapus: %s', 'irama-santri' ), $gallery_title ) ); ?>"
							>
								<?php esc_html_e( 'Hapus', 'irama-santri' ); ?>
							</button>
						</div>
					</li>
				<?php endforeach; ?>
			</ul>

			<?php submit_button(); ?>
		</form>
	</div>
	<?php
}
