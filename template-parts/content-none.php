<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package pitp2020
 */

?>

<section class="no-results not-found">
	<header class="page-header">
		<?php
		if ( is_search() ) :
			?>

			<h1 class="page-title"><?php esc_html_e( 'There were no results for your search terms!', 'pitp2020' ); ?></h1>
		<?php
		else :
			?>

			<h1 class="page-title"><?php esc_html_e( 'Oops! There&rsquo;s nothing here.', 'pitp2020' ); ?></h1>
			<?php
		endif;
		?>

	</header>

	<div class="page-content">
		<?php
		if ( is_search() ) :
			?>

			<p><?php esc_html_e( 'Want to try again with different keywords?', 'pitp2020' ); ?></p>
			<?php
			get_search_form();
		
		else :
			?>

			<p><?php esc_html_e( 'Want to try a search?', 'pitp2020' ); ?></p>
			<?php
			get_search_form();

		endif;
		?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
