<?php
/**
 * Template Name: Tentang Kedai
 *
 * @package IramaSantriTheme
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();
	$irama_santri_has_image = has_post_thumbnail();
	?>
	<main id="primary">
		<header class="border-b border-cream-200 bg-cream-100/60">
			<div class="container-page py-12 sm:py-16">
				<p class="eyebrow"><?php esc_html_e( 'Tentang Kami', 'irama-santri' ); ?></p>
				<h1 class="section-title mt-3"><?php the_title(); ?></h1>
			</div>
		</header>

		<div class="container-page py-12 sm:py-16">
			<div class="grid gap-10 <?php echo $irama_santri_has_image ? 'lg:grid-cols-2 lg:items-start' : ''; ?>">
				<?php if ( $irama_santri_has_image ) : ?>
					<div class="overflow-hidden rounded-3xl">
						<?php
						the_post_thumbnail(
							'product-detail',
							array(
								'class'   => 'aspect-[4/5] w-full object-cover',
								'loading' => 'lazy',
							)
						);
						?>
					</div>
				<?php endif; ?>

				<div class="prose-is max-w-3xl">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	</main>
	<?php
endwhile;

get_footer();
