<?php
/**
 * Halaman 404.
 *
 * @package IramaSantriTheme
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main id="primary" class="container-page py-20 text-center">
	<p class="eyebrow"><?php esc_html_e( '404', 'irama-santri' ); ?></p>
	<h1 class="section-title mt-3"><?php esc_html_e( 'Halaman tidak ditemukan.', 'irama-santri' ); ?></h1>
	<p class="section-lead mx-auto">
		<?php esc_html_e( 'Tautan yang Anda buka mungkin sudah berubah atau tidak tersedia.', 'irama-santri' ); ?>
	</p>
	<a class="btn btn-primary mt-8" href="<?php echo esc_url( home_url( '/' ) ); ?>">
		<?php esc_html_e( 'Kembali ke Beranda', 'irama-santri' ); ?>
	</a>
</main>
<?php
get_footer();
