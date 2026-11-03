<?php
/**
 * Template Name: Contact & Location
 *
 * @package IramaSantriTheme
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();

	$irama_santri_info    = irama_santri_theme_business_info();
	$irama_santri_menu_url = irama_santri_theme_page_url( 'menu' );
	?>
	<main id="primary">
		<header class="border-b border-cream-200 bg-cream-100/60">
			<div class="container-page py-12 sm:py-16">
				<p class="eyebrow"><?php esc_html_e( 'Contact & Location', 'irama-santri' ); ?></p>
				<h1 class="section-title mt-3"><?php the_title(); ?></h1>
				<div class="prose-is mt-4 max-w-2xl">
					<?php the_content(); ?>
				</div>
			</div>
		</header>

		<div class="container-page py-12 sm:py-16">
			<div class="grid gap-8 lg:grid-cols-[1.1fr_0.9fr] lg:items-start">
				<div class="prose-is max-w-2xl">
					<h2><?php esc_html_e( 'Mampir ke kedai', 'irama-santri' ); ?></h2>
					<p>
						<?php esc_html_e( 'Kami terbuka untuk siapa saja yang ingin menikmati kopi, bekerja, belajar, atau berdiskusi.', 'irama-santri' ); ?>
					</p>
					<p>
						<?php esc_html_e( 'Silakan datang langsung pada jam operasional. Tidak diperlukan reservasi atau pemesanan melalui website.', 'irama-santri' ); ?>
					</p>
				</div>

				<div class="card p-6 sm:p-8">
					<h2 class="font-display text-2xl font-semibold"><?php esc_html_e( 'Alamat', 'irama-santri' ); ?></h2>
					<p class="mt-2 text-sm leading-6 text-coffee-700">
						<?php echo esc_html( $irama_santri_info['address'] ); ?>
					</p>

					<h2 class="mt-8 font-display text-2xl font-semibold"><?php esc_html_e( 'Jam Operasional', 'irama-santri' ); ?></h2>
					<p class="mt-2 text-sm leading-6 text-coffee-700">
						<?php echo esc_html( $irama_santri_info['hours'] ); ?>
					</p>

					<a class="btn btn-primary mt-8" href="<?php echo esc_url( $irama_santri_menu_url ); ?>">
						<?php esc_html_e( 'Lihat Menu', 'irama-santri' ); ?>
					</a>
				</div>
			</div>
		</div>
	</main>
	<?php
endwhile;

get_footer();
