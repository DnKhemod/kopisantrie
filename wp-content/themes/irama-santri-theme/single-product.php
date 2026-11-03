<?php
/**
 * Detail produk.
 *
 * @package IramaSantriTheme
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();

	$irama_santri_product_id = (int) get_the_ID();
	$irama_santri_data       = function_exists( 'irama_santri_get_product_data' )
		? irama_santri_get_product_data( $irama_santri_product_id )
		: array();
	$irama_santri_menu_url   = irama_santri_theme_page_url( 'menu' );
	$irama_santri_contact_url = irama_santri_theme_page_url( 'contact' );
	?>
	<main id="primary" class="container-page py-10 sm:py-14">
		<nav class="text-sm text-coffee-700" aria-label="<?php esc_attr_e( 'Breadcrumb', 'irama-santri' ); ?>">
			<a class="transition-colors hover:text-accent-700" href="<?php echo esc_url( $irama_santri_menu_url ); ?>">
				<?php esc_html_e( 'Menu', 'irama-santri' ); ?>
			</a>
			<span class="mx-2" aria-hidden="true">/</span>
			<span aria-current="page"><?php the_title(); ?></span>
		</nav>

		<?php if ( empty( $irama_santri_data ) ) : ?>
			<article class="prose-is mt-8">
				<h1 class="font-display text-4xl font-semibold"><?php the_title(); ?></h1>
				<?php the_content(); ?>
			</article>
		<?php else : ?>
			<?php
			$irama_santri_categories = irama_santri_theme_product_category_names( $irama_santri_product_id );
			$irama_santri_price      = irama_santri_theme_price_label( $irama_santri_product_id );
			$irama_santri_available  = ! empty( $irama_santri_data['is_available'] );
			?>
			<article class="mt-8 grid gap-10 lg:grid-cols-2 lg:items-start">
				<div>
					<?php if ( ! empty( $irama_santri_data['thumbnail_id'] ) ) : ?>
						<?php
						echo wp_get_attachment_image(
							(int) $irama_santri_data['thumbnail_id'],
							'product-detail',
							false,
							array(
								'class'   => 'aspect-square w-full rounded-3xl object-cover shadow-soft',
								'loading' => 'eager',
							)
						);
						?>
					<?php else : ?>
						<?php irama_santri_theme_image_placeholder( 'aspect-square w-full rounded-3xl' ); ?>
					<?php endif; ?>
				</div>

				<div>
					<div class="flex flex-wrap items-center gap-2">
						<?php foreach ( $irama_santri_categories as $irama_santri_category ) : ?>
							<span class="badge badge-muted"><?php echo esc_html( $irama_santri_category ); ?></span>
						<?php endforeach; ?>
					</div>

					<h1 class="mt-4 font-display text-4xl font-semibold tracking-tight">
						<?php echo esc_html( $irama_santri_data['name'] ); ?>
					</h1>

					<div class="mt-4 flex flex-wrap items-center gap-3">
						<p class="text-2xl font-semibold">
							<?php echo esc_html( $irama_santri_price ); ?>
						</p>
						<?php if ( $irama_santri_available ) : ?>
							<span class="badge badge-available"><?php esc_html_e( 'Tersedia', 'irama-santri' ); ?></span>
						<?php else : ?>
							<span class="badge badge-muted"><?php esc_html_e( 'Tidak tersedia', 'irama-santri' ); ?></span>
						<?php endif; ?>
					</div>

					<div class="prose-is mt-6">
						<?php echo wp_kses_post( apply_filters( 'the_content', $irama_santri_data['description'] ) ); ?>
					</div>

					<?php if ( ! empty( $irama_santri_data['variants'] ) ) : ?>
						<section class="mt-8">
							<h2 class="font-display text-xl font-semibold"><?php esc_html_e( 'Varian', 'irama-santri' ); ?></h2>
							<table class="mt-3 w-full text-left text-sm">
								<caption class="sr-only"><?php esc_html_e( 'Daftar varian dan harga', 'irama-santri' ); ?></caption>
								<thead>
									<tr class="border-b border-cream-200">
										<th scope="col" class="py-2 font-semibold"><?php esc_html_e( 'Pilihan', 'irama-santri' ); ?></th>
										<th scope="col" class="py-2 text-right font-semibold"><?php esc_html_e( 'Harga', 'irama-santri' ); ?></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ( $irama_santri_data['variants'] as $irama_santri_variant ) : ?>
										<tr class="border-b border-cream-100">
											<th scope="row" class="py-2 font-medium">
												<?php echo esc_html( $irama_santri_variant['label'] ); ?>
											</th>
											<td class="py-2 text-right">
												<?php echo esc_html( irama_santri_theme_format_price( (int) $irama_santri_variant['price'] ) ); ?>
											</td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</section>
					<?php endif; ?>

					<?php if ( ! empty( $irama_santri_data['addons'] ) ) : ?>
						<section class="mt-8">
							<h2 class="font-display text-xl font-semibold"><?php esc_html_e( 'Add-on', 'irama-santri' ); ?></h2>
							<ul class="mt-3 space-y-2 text-sm">
								<?php foreach ( $irama_santri_data['addons'] as $irama_santri_addon ) : ?>
									<li class="flex justify-between gap-4 border-b border-cream-100 pb-2">
										<span><?php echo esc_html( $irama_santri_addon['label'] ); ?></span>
										<span class="font-medium">
											<?php if ( (int) $irama_santri_addon['price'] > 0 ) : ?>
												+<?php echo esc_html( irama_santri_theme_format_price( (int) $irama_santri_addon['price'] ) ); ?>
											<?php endif; ?>
										</span>
									</li>
								<?php endforeach; ?>
							</ul>
						</section>
					<?php endif; ?>

					<div class="mt-8 flex flex-wrap gap-3">
						<a class="btn btn-secondary" href="<?php echo esc_url( $irama_santri_menu_url ); ?>">
							<?php esc_html_e( 'Kembali ke Menu', 'irama-santri' ); ?>
						</a>
						<a class="btn btn-primary" href="<?php echo esc_url( $irama_santri_contact_url ); ?>">
							<?php esc_html_e( 'Kunjungi Kedai', 'irama-santri' ); ?>
						</a>
					</div>
				</div>
			</article>
		<?php endif; ?>
	</main>
	<?php
endwhile;

get_footer();
