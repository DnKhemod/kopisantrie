<?php
/**
 * Homepage.
 *
 * @package IramaSantriTheme
 */

defined( 'ABSPATH' ) || exit;

get_header();

if ( have_posts() ) :
	the_post();

	$irama_santri_front_id = (int) get_the_ID();
	$irama_santri_menu_url = irama_santri_theme_page_url( 'menu' );
	$irama_santri_contact_url = irama_santri_theme_page_url( 'contact' );
	$irama_santri_info    = irama_santri_theme_business_info();
	?>
	<main id="primary">
		<section class="border-b border-cream-200 bg-cream-100/60">
			<div class="container-page grid gap-10 py-14 lg:grid-cols-[1.05fr_0.95fr] lg:items-center lg:py-24">
				<div>
					<p class="eyebrow"><?php esc_html_e( 'Community Space & Modern Coffee Shop', 'irama-santri' ); ?></p>
					<h1 class="mt-4 font-display text-4xl font-semibold leading-tight tracking-tight sm:text-5xl">
						<?php esc_html_e( 'Kopi, ruang, dan irama untuk bertemu.', 'irama-santri' ); ?>
					</h1>
					<p class="mt-5 max-w-xl text-lg leading-8 text-coffee-700">
						<?php esc_html_e( 'Tempat untuk menikmati kopi, berdiskusi, belajar, dan berbagi pengalaman di Cirebon.', 'irama-santri' ); ?>
					</p>
					<div class="mt-8 flex flex-wrap gap-3">
						<a class="btn btn-primary" href="<?php echo esc_url( $irama_santri_menu_url ); ?>">
							<?php esc_html_e( 'Lihat Menu', 'irama-santri' ); ?>
						</a>
						<a class="btn btn-secondary" href="<?php echo esc_url( $irama_santri_contact_url ); ?>">
							<?php esc_html_e( 'Kunjungi Kedai', 'irama-santri' ); ?>
						</a>
					</div>
				</div>

				<div>
					<?php if ( has_post_thumbnail( $irama_santri_front_id ) ) : ?>
						<?php
						echo get_the_post_thumbnail(
							$irama_santri_front_id,
							'product-detail',
							array(
								'class'   => 'aspect-[4/3] w-full rounded-3xl object-cover shadow-soft',
								'loading' => 'eager',
							)
						);
						?>
					<?php else : ?>
						<div class="flex aspect-[4/3] items-end overflow-hidden rounded-3xl bg-gradient-to-br from-coffee-500 via-coffee-700 to-coffee-900 p-8 shadow-soft">
							<p class="font-display text-3xl font-semibold text-cream-50/90">
								<?php esc_html_e( 'Irama Santri', 'irama-santri' ); ?>
							</p>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</section>

		<section class="container-page py-16 sm:py-20">
			<div class="grid gap-10 lg:grid-cols-[0.8fr_1.2fr]">
				<div>
					<p class="eyebrow"><?php esc_html_e( 'Tentang Kami', 'irama-santri' ); ?></p>
					<h2 class="section-title mt-3"><?php esc_html_e( 'Lebih dari sekadar tempat ngopi.', 'irama-santri' ); ?></h2>
				</div>
				<div class="prose-is">
					<?php
					$irama_santri_intro = get_the_content();

					if ( '' !== trim( wp_strip_all_tags( $irama_santri_intro ) ) ) {
						echo wp_kses_post( apply_filters( 'the_content', $irama_santri_intro ) );
					} else {
						?>
						<p><?php esc_html_e( 'Kedai Kopi Irama Santri adalah community space di Cirebon untuk menikmati kopi, berdiskusi, belajar, dan bekerja.', 'irama-santri' ); ?></p>
						<p><?php esc_html_e( 'Kami percaya secangkir kopi bisa menjadi awal dari banyak hal baik: pertemuan, gagasan, dan cerita yang tumbuh dari obrolan sederhana.', 'irama-santri' ); ?></p>
						<?php
					}
					?>
				</div>
			</div>
		</section>

		<?php if ( function_exists( 'irama_santri_get_featured_products' ) ) : ?>
			<?php $irama_santri_featured = irama_santri_get_featured_products( 4 ); ?>
			<?php if ( $irama_santri_featured->have_posts() ) : ?>
				<section class="border-y border-cream-200 bg-white/60">
					<div class="container-page py-16">
						<div class="flex flex-wrap items-end justify-between gap-4">
							<div>
								<p class="eyebrow"><?php esc_html_e( 'Menu Unggulan', 'irama-santri' ); ?></p>
								<h2 class="section-title mt-3"><?php esc_html_e( 'Pilihan yang sering dicari.', 'irama-santri' ); ?></h2>
							</div>
							<a class="btn btn-secondary" href="<?php echo esc_url( $irama_santri_menu_url ); ?>">
								<?php esc_html_e( 'Lihat Semua Menu', 'irama-santri' ); ?>
							</a>
						</div>

						<div class="mt-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
							<?php
							while ( $irama_santri_featured->have_posts() ) :
								$irama_santri_featured->the_post();
								get_template_part( 'template-parts/product/card', null, array( 'post_id' => get_the_ID() ) );
							endwhile;
							?>
						</div>
					</div>
				</section>
				<?php wp_reset_postdata(); ?>
			<?php endif; ?>
		<?php endif; ?>

		<?php if ( function_exists( 'irama_santri_get_facilities' ) ) : ?>
			<?php $irama_santri_facilities = irama_santri_get_facilities( array( 'posts_per_page' => 3 ) ); ?>
			<?php if ( $irama_santri_facilities->have_posts() ) : ?>
				<section class="container-page py-16">
					<div class="max-w-2xl">
						<p class="eyebrow"><?php esc_html_e( 'Fasilitas', 'irama-santri' ); ?></p>
						<h2 class="section-title mt-3"><?php esc_html_e( 'Tempat yang nyaman untuk berlama-lama.', 'irama-santri' ); ?></h2>
						<p class="section-lead"><?php esc_html_e( 'Wi-Fi, area outdoor, dan ruang diskusi untuk menemani waktu Anda.', 'irama-santri' ); ?></p>
					</div>

					<div class="mt-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
						<?php
						while ( $irama_santri_facilities->have_posts() ) :
							$irama_santri_facilities->the_post();
							get_template_part( 'template-parts/facility/card', null, array( 'post_id' => get_the_ID() ) );
						endwhile;
						?>
					</div>
				</section>
				<?php wp_reset_postdata(); ?>
			<?php endif; ?>
		<?php endif; ?>

		<?php $irama_santri_gallery_ids = irama_santri_theme_gallery_ids(); ?>
		<?php if ( ! empty( $irama_santri_gallery_ids ) ) : ?>
			<section class="border-y border-cream-200 bg-white/60">
				<div class="container-page py-16">
					<div class="max-w-2xl">
						<p class="eyebrow"><?php esc_html_e( 'Galeri', 'irama-santri' ); ?></p>
						<h2 class="section-title mt-3"><?php esc_html_e( 'Suasana kedai, dari waktu ke waktu.', 'irama-santri' ); ?></h2>
					</div>
					<div class="mt-8">
						<?php
						get_template_part(
							'template-parts/gallery/grid',
							null,
							array(
								'ids'   => $irama_santri_gallery_ids,
								'limit' => 6,
							)
						);
						?>
					</div>
				</div>
			</section>
		<?php endif; ?>

		<section class="container-page py-16">
			<div class="overflow-hidden rounded-3xl bg-coffee-900 px-6 py-10 text-cream-50 sm:px-10 lg:flex lg:items-center lg:justify-between lg:gap-10">
				<div>
					<p class="text-xs font-semibold uppercase tracking-[0.22em] text-cream-100/80">
						<?php esc_html_e( 'Kunjungi', 'irama-santri' ); ?>
					</p>
					<h2 class="mt-3 font-display text-3xl font-semibold">
						<?php esc_html_e( 'Mampir dan temukan tempat Anda.', 'irama-santri' ); ?>
					</h2>
					<?php if ( ! empty( $irama_santri_info['address'] ) ) : ?>
						<p class="mt-3 max-w-xl text-sm leading-6 text-cream-100/80">
							<?php echo esc_html( $irama_santri_info['address'] ); ?>
						</p>
					<?php endif; ?>
					<?php if ( ! empty( $irama_santri_info['hours'] ) ) : ?>
						<p class="mt-1 text-sm leading-6 text-cream-100/80">
							<?php echo esc_html( $irama_santri_info['hours'] ); ?>
						</p>
					<?php endif; ?>
				</div>
				<a class="btn btn-light mt-6 shrink-0 lg:mt-0" href="<?php echo esc_url( $irama_santri_contact_url ); ?>">
					<?php esc_html_e( 'Lihat Lokasi', 'irama-santri' ); ?>
				</a>
			</div>
		</section>
	</main>
	<?php
endif;

get_footer();
