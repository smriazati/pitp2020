<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package pitp2020
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'pitp2020' ); ?></a>

	<header id="masthead" class="site-header">

		<nav class="top-mini-nav">
			<?php
				wp_nav_menu(
					array(
						'theme_location' => 'top-mini-menu',
						'menu_id'        => 'top-mini-menu'
					)
				);
			?>
		</nav>

		<div id="logo" class="site-logo">
			<a href="<?php echo get_home_url() ?>">
				<img class="image-tall" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/PrettyinthePines-Logo-Primary.png" alt="pretty in the pines logo" />
				<img class="image-flat" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/PrettyinthePines-Logo-Horizontal.png" alt="pretty in the pines logo" />
			</a>
		</div>

		<div id="site-navigation">
			<button class="mobile-search-toggle" aria-controls="mobile-search" aria-expanded="false">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/search.png" alt="search icon" />
			</button>

			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
				<span class="bar1"></span>
				<span class="bar2"></span>
				<span class="bar3"></span>
			</button>

			<div class="site-nav-wrapper nav-col-2 mobile-search-form">

				<div id="mobile-search" class="search-wrapper">
					<?php 
						add_filter( 'get_search_form', 'mobile_search_form' );
						get_search_form();
						remove_filter( 'get_search_form', 'mobile_search_form' );
					?>
				</div>
			</div>

			<div class="site-nav-wrapper nav-col-2 mobile-menu">

				<nav class="main-nav">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'primary-menu',
							'menu_id'        => 'primary-menu',
						)
					);
					?>
				</nav>

				<nav class="side-nav">
					<ul>
						<li>
							<a href="https://www.instagram.com/prettyinthepines/" target="_blank">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/insta.png" alt="instagram icon" />
							</a>
						</li>
						<li>
							<a href="https://www.facebook.com/prettyinthepines/" target="_blank">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/facebook.png" alt="facebook icon" />
							</a>
						</li>
						<li>
							<a href="https://www.pinterest.com/prettyinthepines/" target="_blank">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/pinterest.png" alt="pinterest icon" />
							</a>
						</li>
						<li>
							<a href="https://twitter.com/shelbslv" target="_blank">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/twitter.png" alt="twitter icon" />
							</a>
						</li>	
						<li>
							<span class="divider"></span>
						</li>	
						<li id="header-nav-search">
							<button onclick="toggleSearch()">
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/search.png" alt="search icon" />
							</button>
							<div class="search-wrapper">
								<?php 
									add_filter( 'get_search_form', 'header_search_form' );
									get_search_form();
									remove_filter( 'get_search_form', 'header_search_form' );
								?>
							</div>
						</li>
					</ul>

				</nav>
			</div>
		</div> <!-- .nav-col-2 -->

		
	</header><!-- #masthead -->
