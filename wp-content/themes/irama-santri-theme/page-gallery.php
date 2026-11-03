<?php
/**
 * Template Name: Galeri
 *
 * @package IramaSantriTheme
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();
	$irama_santri_gallery_ids = irama_santri_theme_gallery_ids();
	?>
	<main id="primary">
		<header class="border-b border-cream-200 bg-cream-100/60">
			<div class="container-page py-12 sm:py-16">
				<p class="eyebrow"><?php esc_html_e( 'Galeri', 'irama-santri' ); ?></p>
				<h1 class="section-title mt-3"><?php the_title(); ?></h1>
				<div class="prose-is mt-4 max-w-2xl">
					<?php the_content(); ?>
				</div>
			</div>
		</header>

		<div class="container-page py-12 sm:py-16">
			<?php if ( ! empty( $irama_santri_gallery_ids ) ) : ?>
				<?php
				get_template_part(
					'template-parts/gallery/grid',
					null,
					array( 'ids' => $irama_santri_gallery_ids )
				);
				?>
			<?php else : ?>
				<div class="card p-8 text-center">
					<h2 class="font-display text-2xl font-semibold"><?php esc_html_e( 'Galeri belum tersedia', 'irama-santri' ); ?></h2>
					<p class="mt-2 text-sm leading-6 text-coffee-700">
						<?php esc_html_e( 'Foto akan tampil di sini setelah dipilih melalui dashboard.', 'irama-santri' ); ?>
					</p>
				</div>
			<?php endif; ?>
		</div>
	</main>
	<?php
endwhile;

get_footer();
