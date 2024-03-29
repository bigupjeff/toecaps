<?php
/**
 * Toecaps Template - Header.
 *
 * @package   Toecaps
 * @author    Jefferson Real <me@jeffersonreal.uk>
 * @copyright Copyright (c) 2022, Jefferson Real
 */

namespace BigupWeb\Toecaps;

use BigupWeb\Toecaps\Helpers;
use BigupWeb\Toecaps\Tags;

get_template_part( 'template-parts/css-loader' );

?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" prefix="og: https://ogp.me/ns/website#">

<head>
	<?php
	$seo = new Seo_Meta();
	echo $seo->head_meta;
	wp_head();
	?>
</head>

<body <?php body_class(); ?> >

	<header class="header parallax_trigger">

		<?php get_template_part( 'template-parts/promo-banner' ); ?>

		<div class="container">
			<div class="header_main">

				<a class="identity" href="<?php echo esc_url( get_bloginfo( 'wpurl' ) ); ?>" aria-label="Home">
					<?php
					if ( has_custom_logo() ) {
						$logo_id  = get_theme_mod( 'custom_logo' );
						$logo_src = wp_get_attachment_image_src( $logo_id, 'full' );
						if ( $logo_src ) {
							$logo_alt = get_post_meta( $logo_id, '_wp_attachment_image_alt', true );
							echo '<img class="identity_logo" alt="' . esc_attr( $logo_alt ) . '" src="' . esc_url( $logo_src[0] ) . '">';
						}
					}
					?>
				</a>

				<nav class="secondaryMenu" aria-label="Secondary Menu">
					<a
						class="secondaryMenu_item button"
						href="/contact#find-us"
						aria-label="Find us"
					>
						<i class="fa-solid fa-location-dot"></i>	
						<span class="secondaryMenu_label">
							Find us
						</span>
					</a>
					<button
						class="secondaryMenu_item button search_button"
						aria-label="Search the site"
					>
						<i class="fa-solid fa-magnifying-glass"></i>	
						<span class="secondaryMenu_label">
							Search
						</span>
					</button>
					<button
						class="secondaryMenu_item fullscreenMenu_open button"
						aria-label="Menu"
					>
						<i class="fullscreenMenu_icon fa fa-solid fa-bars"></i>
					</button>
				</nav>

				<input id="search_form" class="search_toggle" type="checkbox">
				<div class="search_container" style="margin-bottom: -5em;">
					<?php
					get_search_form(
						array(
							'echo'       => true,
							'aria_label' => 'Search our website',
						)
					);
					?>
				</div>

			</div>
		</div>

		<div class="header_menu theme_fill-prominent">
			<input id="fullscreenMenu_toggle" class="fullscreenMenu_toggle" type="checkbox">
			<div class="fullscreenMenu" style="transform: translateX(-100%);">
				<div class="fullscreenMenu_contents">
					<button class="fullscreenMenu_close">
						<i class="fullscreenMenu_icon fa-solid fa-xmark"></i>
					</button>
					<div class="fullscreenMenu_scroll">
						<?php
						Menu_Walker::output_theme_location_menu(
							array(
								'theme_location'   => 'homepage-menu',
								'menu_class'       => 'mainMenu',
								'nav_or_div'       => 'nav',
								'nav_aria_label'   => 'Main Menu',
								'html_tab_indents' => 6,
							)
						);
						?>
					</div>
					<div class="fullscreenMenu_social">
						<?php get_template_part( 'template-parts/social-links' ); ?>
					</div>
				</div>
			</div>
			<div class="navBar">
				<!--<div class="container">-->
					<?php
					Menu_Walker::output_theme_location_menu(
						array(
							'theme_location'   => 'homepage-menu',
							'menu_class'       => 'mainMenu',
							'nav_or_div'       => 'nav',
							'nav_aria_label'   => 'Main Menu',
							'html_tab_indents' => 5,
						)
					);
					?>
				<!--</div>-->
			</div>
		</div>

		<?php
		get_template_part( 'template-parts/usp' );
		?>

		<div class="header_hero">

			<div class="parallax">
				<div class="parallax_inner">
					<?php
					$is_homepage  = is_front_page() || is_home();
					$is_parent    = is_page() && ! empty( get_pages( array( 'child_of' => get_queried_object_id() ) ) );
					$filter_class = ( $is_homepage || $is_parent ) ? ' header_filter-light' : ' header_filter-dark';

					if ( has_post_thumbnail() ) {
						$image_id = get_post_thumbnail_id();
						?>
						<img
							src="<?php echo esc_url( wp_get_attachment_image_url( $image_id, 'hero-banner-small' ) ); ?>"
							srcset="<?php echo esc_attr( wp_get_attachment_image_srcset( $image_id ) ); ?>"
							alt="<?php echo esc_attr( get_post_meta( $image_id, '_wp_attachment_image_alt', true ) ); ?>"
							class="<?php echo esc_attr( 'header_image' . $filter_class ); ?>"
						/>
						<?php
					} else {
						?>
						<img
							class="header_image wpreturn8001/wp-content/uploads/2022/04/hero-background.webp"
							alt="Joinery Workshop"
							loading="lazy"
							srcset="<?php echo esc_url( get_template_directory_uri() ); ?>/imagery/rasters/hero-fallback/hero-fallback.webp 1920w,
									<?php echo esc_url( get_template_directory_uri() ); ?>/imagery/rasters/hero-fallback/hero-fallback-1536x768.webp 1536w,
									<?php echo esc_url( get_template_directory_uri() ); ?>/imagery/rasters/hero-fallback/hero-fallback-1024x512.webp 1024w,
									<?php echo esc_url( get_template_directory_uri() ); ?>/imagery/rasters/hero-fallback/hero-fallback-768x384.webp 768w,
									<?php echo esc_url( get_template_directory_uri() ); ?>/imagery/rasters/hero-fallback/hero-fallback-300x150.webp 300w"
							sizes="( max-width: 300px ) 300px,
								   ( max-width: 768px ) 768px,
								   ( max-width: 1024px ) 1024px,
								   ( max-width: 1536px ) 1536px,
								   1920px"
						>
						<?php
					}
					?>
				</div>
			</div>

			<?php get_template_part( 'template-parts/h1' ); ?>

		</div>

	</header>

	<?php
	if ( ! is_front_page() && ! is_home() ) {
		Tags::print_html_breadcrumb();
	}

	get_template_part( 'template-parts/menu' );
	?>

	<div class="header_margin"></div>
