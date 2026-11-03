<?php
/**
 * Template halaman umum.
 *
 * @package IramaSantriTheme
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<main id="primary" class="container-page py-12 sm:py-16">
		<header class="max-w-3xl">
			<p class="eyebrow"><?php bloginfo( 'name' ); ?></p>
			<h1 class="section-title mt-3"><?php the_title(); ?></h1>
		</header>

		<?php if ( has_post_thumbnail() ) : ?>
			<div class="mt-8 overflow-hidden rounded-3xl">
				<?php
				the_post_thumbnail(
					'product-detail',
					array(
						'class'   => 'aspect-[16/9] w-full object-cover',
						'loading' => 'lazy',
					)
				);
				?>
			</div>
		<?php endif; ?>

		<div class="prose-is mt-8 max-w-3xl">
			<?php the_content(); ?>
		</div>
	</main>
	<?php
endwhile;

get_footer();
