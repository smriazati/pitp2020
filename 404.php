<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package pitp2020
 */

get_header();
?>

	<main id="primary" class="site-main narrow-contain error-404 not-found">

		<header class="page-header">
			<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'pitp2020' ); ?></h1>
			<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'pitp2020' ); ?></p>
		</header><!-- .page-header -->

		
		<?php include get_theme_file_path( '/partials/featuredcats.php' ); ?>
	
		<section class="search">
			<?php get_search_form(); ?>
		</section>

	</main><!-- #main -->
	
<?php
get_footer();
