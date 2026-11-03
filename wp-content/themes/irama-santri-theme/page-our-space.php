<?php
/**
 * Template Name: Our Space
 *
 * @package IramaSantriTheme
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();

	$irama_santri_facilities = function_exists( 'irama_santri_get_facilities' )
		? irama_santri_get_facilities()
		: null;
	?>
	<main id="primary">
		<header class="border-b border-cream-200 bg-cream-100/60">
			<div class="container-page py-12 sm:py-16">
				<p class="eyebrow"><?php esc_html_e( 'Our Space', 'irama-santri' ); ?></p>
				<h1 class="section-title mt-3"><?php the_title(); ?></h1>
				<div class="prose-is mt-4 max-w-2xl">
					<?php the_content(); ?>
				</div>
			</div>
		</header>

		<div class="container-page py-12 sm:py-16">
			<?php if ( $irama_santri_facilities && $irama_santri_facilities->have_posts() ) : ?>
				<div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
					<?php
					while ( $irama_santri_facilities->have_posts() ) :
						$irama_santri_facilities->the_post();
						get_template_part( 'template-parts/facility/card', null, array( 'post_id' => get_the_ID() ) );
					endwhile;
					?>
				</div>
				<?php wp_reset_postdata(); ?>
			<?php else : ?>
				<div class="card p-8 text-center">
					<h2 class="font-display text-2xl font-semibold"><?php esc_html_e( 'Informasi fasilitas belum tersedia', 'irama-santri' ); ?></h2>
					<p class="mt-2 text-sm leading-6 text-coffee-700">
						<?php esc_html_e( 'Fasilitas akan tampil di sini setelah ditambahkan melalui dashboard.', 'irama-santri' ); ?>
					</p>
				</div>
			<?php endif; ?>
		</div>
	</main>
	<?php
endwhile;

get_footer();
