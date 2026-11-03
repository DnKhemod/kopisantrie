<?php
/**
 * Header.
 *
 * @package IramaSantriTheme
 */

defined( 'ABSPATH' ) || exit;
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'bg-cream-50 text-coffee-900 antialiased' ); ?>>
<?php wp_body_open(); ?>
<a class="sr-only focus:not-sr-only focus:absolute focus:left-4 focus:top-4 focus:z-50 focus:rounded focus:bg-white focus:px-4 focus:py-2 focus:text-coffee-900" href="#primary">
	<?php esc_html_e( 'Lewati ke konten', 'irama-santri' ); ?>
</a>
<header class="sticky top-0 z-40 border-b border-cream-200/80 bg-cream-50/95 backdrop-blur">
	<div class="container-page flex flex-wrap items-center justify-between gap-4 py-4">
		<div class="site-branding">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<a class="font-display text-xl font-semibold tracking-tight" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<?php bloginfo( 'name' ); ?>
				</a>
			<?php endif; ?>
		</div>

		<button
			type="button"
			class="btn btn-secondary px-4 py-2 md:hidden"
			data-nav-toggle
			aria-expanded="false"
			aria-controls="primary-menu"
		>
			<?php esc_html_e( 'Menu', 'irama-santri' ); ?>
		</button>

		<nav
			id="primary-menu"
			class="site-nav order-last hidden basis-full md:order-none md:block md:basis-auto"
			data-nav-menu
			aria-label="<?php esc_attr_e( 'Navigasi utama', 'irama-santri' ); ?>"
		>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_class'     => 'flex flex-col gap-3 md:flex-row md:items-center md:gap-6',
					'fallback_cb'    => 'irama_santri_theme_nav_fallback',
					'depth'          => 2,
				)
			);
			?>
		</nav>

		<a class="btn btn-primary hidden lg:inline-flex" href="<?php echo esc_url( irama_santri_theme_page_url( 'contact' ) ); ?>">
			<?php esc_html_e( 'Kunjungi Kedai', 'irama-santri' ); ?>
		</a>
	</div>
</header>
