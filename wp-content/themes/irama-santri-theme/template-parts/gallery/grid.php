<?php
/**
 * Grid galeri.
 *
 * @package IramaSantriTheme
 */

defined( 'ABSPATH' ) || exit;

$irama_santri_ids   = isset( $args['ids'] ) && is_array( $args['ids'] ) ? $args['ids'] : array();
$irama_santri_limit = isset( $args['limit'] ) ? (int) $args['limit'] : 0;

if ( $irama_santri_limit > 0 ) {
	$irama_santri_ids = array_slice( $irama_santri_ids, 0, $irama_santri_limit );
}

if ( empty( $irama_santri_ids ) ) {
	return;
}
?>
<ul class="grid grid-cols-2 gap-3 sm:grid-cols-3">
	<?php foreach ( $irama_santri_ids as $irama_santri_id ) : ?>
		<li>
			<figure class="overflow-hidden rounded-2xl bg-cream-100">
				<?php
				echo wp_get_attachment_image(
					(int) $irama_santri_id,
					'gallery-thumb',
					false,
					array(
						'class'   => 'aspect-square w-full object-cover transition duration-300 hover:scale-105',
						'loading' => 'lazy',
					)
				);
				?>
			</figure>
		</li>
	<?php endforeach; ?>
</ul>
