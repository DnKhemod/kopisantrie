<?php
/**
 * Kartu fasilitas.
 *
 * @package IramaSantriTheme
 */

defined( 'ABSPATH' ) || exit;

$irama_santri_post_id = isset( $args['post_id'] ) ? (int) $args['post_id'] : (int) get_the_ID();
$irama_santri_post    = get_post( $irama_santri_post_id );

if ( ! $irama_santri_post ) {
	return;
}
?>
<article class="card flex h-full flex-col">
	<?php if ( has_post_thumbnail( $irama_santri_post_id ) ) : ?>
		<?php
		echo get_the_post_thumbnail(
			$irama_santri_post_id,
			'large',
			array(
				'class'   => 'aspect-[3/2] w-full object-cover',
				'loading' => 'lazy',
			)
		);
		?>
	<?php else : ?>
		<?php irama_santri_theme_image_placeholder( 'aspect-[3/2] w-full' ); ?>
	<?php endif; ?>

	<div class="flex flex-1 flex-col gap-3 p-5">
		<h3 class="font-display text-xl font-semibold leading-snug">
			<?php echo esc_html( get_the_title( $irama_santri_post_id ) ); ?>
		</h3>
		<p class="text-sm leading-6 text-coffee-700">
			<?php echo esc_html( irama_santri_theme_facility_excerpt( $irama_santri_post_id ) ); ?>
		</p>
	</div>
</article>
