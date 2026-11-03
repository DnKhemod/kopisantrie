<?php
/**
 * Kartu produk.
 *
 * @package IramaSantriTheme
 */

defined( 'ABSPATH' ) || exit;

$irama_santri_post_id = isset( $args['post_id'] ) ? (int) $args['post_id'] : (int) get_the_ID();

if ( ! function_exists( 'irama_santri_get_product_data' ) ) {
	return;
}

$irama_santri_product = irama_santri_get_product_data( $irama_santri_post_id );

if ( empty( $irama_santri_product ) ) {
	return;
}

$irama_santri_categories = irama_santri_theme_product_category_names( $irama_santri_post_id );
$irama_santri_price      = irama_santri_theme_price_label( $irama_santri_post_id );
$irama_santri_available  = ! empty( $irama_santri_product['is_available'] );
?>
<article class="card group flex h-full flex-col">
	<a
		class="block overflow-hidden"
		href="<?php echo esc_url( $irama_santri_product['permalink'] ); ?>"
		tabindex="-1"
		aria-hidden="true"
	>
		<?php if ( ! empty( $irama_santri_product['thumbnail_id'] ) ) : ?>
			<?php
			echo wp_get_attachment_image(
				(int) $irama_santri_product['thumbnail_id'],
				'product-card',
				false,
				array(
					'class'   => 'aspect-square w-full object-cover transition duration-300 group-hover:scale-105',
					'loading' => 'lazy',
				)
			);
			?>
		<?php else : ?>
			<?php irama_santri_theme_image_placeholder( 'aspect-square w-full' ); ?>
		<?php endif; ?>
	</a>

	<div class="flex flex-1 flex-col gap-3 p-5">
		<div class="flex flex-wrap items-center gap-2">
			<?php if ( ! empty( $irama_santri_categories ) ) : ?>
				<p class="text-xs font-semibold uppercase tracking-[0.18em] text-accent-700">
					<?php echo esc_html( $irama_santri_categories[0] ); ?>
				</p>
			<?php endif; ?>

			<?php if ( ! empty( $irama_santri_product['is_featured'] ) ) : ?>
				<span class="badge badge-featured"><?php esc_html_e( 'Unggulan', 'irama-santri' ); ?></span>
			<?php endif; ?>
		</div>

		<h3 class="font-display text-xl font-semibold leading-snug">
			<a class="transition-colors hover:text-accent-700" href="<?php echo esc_url( $irama_santri_product['permalink'] ); ?>">
				<?php echo esc_html( $irama_santri_product['name'] ); ?>
			</a>
		</h3>

		<p class="text-sm leading-6 text-coffee-700">
			<?php echo esc_html( irama_santri_theme_product_excerpt( $irama_santri_product ) ); ?>
		</p>

		<div class="mt-auto flex flex-wrap items-center justify-between gap-2 pt-2">
			<p class="font-semibold">
				<?php echo esc_html( $irama_santri_price ); ?>
			</p>

			<?php if ( ! $irama_santri_available ) : ?>
				<span class="badge badge-muted"><?php esc_html_e( 'Tidak tersedia', 'irama-santri' ); ?></span>
			<?php endif; ?>
		</div>
	</div>
</article>
