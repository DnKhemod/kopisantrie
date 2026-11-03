<?php
/**
 * Footer.
 *
 * @package IramaSantriTheme
 */

defined( 'ABSPATH' ) || exit;

$irama_santri_info = irama_santri_theme_business_info();
?>
<footer class="mt-20 border-t border-cream-200 bg-cream-100/50">
	<div class="container-page grid gap-10 py-12 sm:grid-cols-2 lg:grid-cols-[1.2fr_0.8fr_1fr]">
		<div>
			<p class="font-display text-xl font-semibold tracking-tight">
				<?php bloginfo( 'name' ); ?>
			</p>
			<p class="mt-3 max-w-sm text-sm leading-6 text-coffee-700">
				<?php esc_html_e( 'Community space untuk menikmati kopi, berdiskusi, belajar, dan berbagi pengalaman.', 'irama-santri' ); ?>
			</p>
		</div>

		<nav class="site-nav" aria-label="<?php esc_attr_e( 'Navigasi footer', 'irama-santri' ); ?>">
			<p class="mb-3 text-xs font-semibold uppercase tracking-[0.2em] text-coffee-700">
				<?php esc_html_e( 'Jelajahi', 'irama-santri' ); ?>
			</p>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'footer',
					'container'      => false,
					'menu_class'     => 'space-y-2 text-sm',
					'fallback_cb'    => 'irama_santri_theme_nav_fallback',
					'depth'          => 1,
				)
			);
			?>
		</nav>

		<div class="text-sm text-coffee-700">
			<p class="mb-3 text-xs font-semibold uppercase tracking-[0.2em] text-coffee-700">
				<?php esc_html_e( 'Kunjungi', 'irama-santri' ); ?>
			</p>
			<?php if ( ! empty( $irama_santri_info['address'] ) ) : ?>
				<p class="leading-6"><?php echo esc_html( $irama_santri_info['address'] ); ?></p>
			<?php endif; ?>
			<?php if ( ! empty( $irama_santri_info['hours'] ) ) : ?>
				<p class="mt-2 leading-6"><?php echo esc_html( $irama_santri_info['hours'] ); ?></p>
			<?php endif; ?>
		</div>
	</div>

	<div class="border-t border-cream-200">
		<div class="container-page flex flex-col gap-2 py-5 text-xs text-coffee-700 sm:flex-row sm:items-center sm:justify-between">
			<p>
				&copy; <?php echo esc_html( wp_date( 'Y' ) ); ?>
				<?php bloginfo( 'name' ); ?>
			</p>
			<p><?php esc_html_e( 'Dibuat untuk menemani waktu Anda di Cirebon.', 'irama-santri' ); ?></p>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
