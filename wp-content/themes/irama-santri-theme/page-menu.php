<?php
/**
 * Template Name: Menu Katalog
 *
 * @package IramaSantriTheme
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();

	$irama_santri_categories        = irama_santri_theme_get_categories();
	$irama_santri_products_by_term  = array();
	$irama_santri_uncategorized     = array();
	$irama_santri_has_products      = false;

	if ( function_exists( 'irama_santri_get_products' ) ) {
		$irama_santri_query = irama_santri_get_products();
		$irama_santri_has_products = ! empty( $irama_santri_query->posts );

		foreach ( $irama_santri_query->posts as $irama_santri_product_post ) {
			$irama_santri_data = irama_santri_get_product_data( (int) $irama_santri_product_post->ID );

			if ( empty( $irama_santri_data ) ) {
				continue;
			}

			$irama_santri_term_ids = array_map( 'intval', (array) $irama_santri_data['category_ids'] );

			if ( empty( $irama_santri_term_ids ) ) {
				$irama_santri_uncategorized[] = (int) $irama_santri_product_post->ID;
				continue;
			}

			foreach ( $irama_santri_term_ids as $irama_santri_term_id ) {
				$irama_santri_products_by_term[ $irama_santri_term_id ][] = (int) $irama_santri_product_post->ID;
			}
		}
	}

	$irama_santri_visible_terms = array_values(
		array_filter(
			$irama_santri_categories,
			static function ( WP_Term $term ) use ( $irama_santri_products_by_term ): bool {
				return ! empty( $irama_santri_products_by_term[ $term->term_id ] );
			}
		)
	);
	?>
	<main id="primary">
		<header class="border-b border-cream-200 bg-cream-100/60">
			<div class="container-page py-12 sm:py-16">
				<p class="eyebrow"><?php esc_html_e( 'Menu', 'irama-santri' ); ?></p>
				<h1 class="section-title mt-3"><?php the_title(); ?></h1>
				<div class="prose-is mt-4 max-w-2xl">
					<?php the_content(); ?>
				</div>
			</div>
		</header>

		<div class="container-page py-12">
			<?php if ( ! $irama_santri_has_products ) : ?>
				<div class="card p-8 text-center">
					<h2 class="font-display text-2xl font-semibold"><?php esc_html_e( 'Menu belum tersedia', 'irama-santri' ); ?></h2>
					<p class="mt-2 text-sm leading-6 text-coffee-700">
						<?php esc_html_e( 'Produk akan tampil di sini setelah ditambahkan melalui dashboard.', 'irama-santri' ); ?>
					</p>
				</div>
			<?php else : ?>
				<?php if ( ! empty( $irama_santri_visible_terms ) ) : ?>
					<nav class="mb-10 flex flex-wrap gap-2" aria-label="<?php esc_attr_e( 'Kategori menu', 'irama-santri' ); ?>">
						<?php foreach ( $irama_santri_visible_terms as $irama_santri_term ) : ?>
							<a class="badge badge-muted transition-colors hover:bg-cream-100" href="#kategori-<?php echo esc_attr( $irama_santri_term->slug ); ?>">
								<?php echo esc_html( $irama_santri_term->name ); ?>
							</a>
						<?php endforeach; ?>
					</nav>
				<?php endif; ?>

				<div class="space-y-14">
					<?php foreach ( $irama_santri_visible_terms as $irama_santri_term ) : ?>
						<section id="kategori-<?php echo esc_attr( $irama_santri_term->slug ); ?>" class="scroll-mt-24">
							<div class="flex flex-wrap items-end justify-between gap-4 border-b border-cream-200 pb-4">
								<div>
									<h2 class="font-display text-2xl font-semibold tracking-tight sm:text-3xl">
										<?php echo esc_html( $irama_santri_term->name ); ?>
									</h2>
									<?php if ( ! empty( $irama_santri_term->description ) ) : ?>
										<p class="mt-2 max-w-2xl text-sm leading-6 text-coffee-700">
											<?php echo esc_html( $irama_santri_term->description ); ?>
										</p>
									<?php endif; ?>
								</div>
								<span class="badge badge-muted">
									<?php
									printf(
										/* translators: %d: jumlah produk. */
										esc_html( _n( '%d menu', '%d menu', count( $irama_santri_products_by_term[ $irama_santri_term->term_id ] ), 'irama-santri' ) ),
										count( $irama_santri_products_by_term[ $irama_santri_term->term_id ] )
									);
									?>
								</span>
							</div>

							<div class="mt-6 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
								<?php foreach ( $irama_santri_products_by_term[ $irama_santri_term->term_id ] as $irama_santri_product_id ) : ?>
									<?php
									get_template_part(
										'template-parts/product/card',
										null,
										array( 'post_id' => $irama_santri_product_id )
									);
									?>
								<?php endforeach; ?>
							</div>
						</section>
					<?php endforeach; ?>

					<?php if ( ! empty( $irama_santri_uncategorized ) ) : ?>
						<section id="kategori-lainnya" class="scroll-mt-24">
							<div class="flex flex-wrap items-end justify-between gap-4 border-b border-cream-200 pb-4">
								<h2 class="font-display text-2xl font-semibold tracking-tight sm:text-3xl">
									<?php esc_html_e( 'Lainnya', 'irama-santri' ); ?>
								</h2>
								<span class="badge badge-muted">
									<?php echo esc_html( (string) count( $irama_santri_uncategorized ) ); ?>
								</span>
							</div>

							<div class="mt-6 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
								<?php foreach ( $irama_santri_uncategorized as $irama_santri_product_id ) : ?>
									<?php
									get_template_part(
										'template-parts/product/card',
										null,
										array( 'post_id' => $irama_santri_product_id )
									);
									?>
								<?php endforeach; ?>
							</div>
						</section>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>
	</main>
	<?php
endwhile;

get_footer();
