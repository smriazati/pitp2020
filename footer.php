<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package pitp2020
 */

?>

	<footer id="colophon" class="site-footer">
		
		<nav class="left-footer-nav">
			<?php
				wp_nav_menu(
					array(
						'theme_location' => 'left-footer-menu',
						'menu_id'        => 'left-footer-menu'
					)
				);
			?>
		</nav>
		
		<div class="site-logo">
			<a href="<?php echo get_home_url() ?>">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/PrettyinthePines-Favicon-White.png" alt="pretty in the pines logo" />
			</a>
		</div>

		<nav class="right-footer-nav">
			<?php
				wp_nav_menu(
					array(
						'theme_location' => 'right-footer-menu',
						'menu_id'        => 'right-footer-menu'
					)
				);
			?>
		</nav>

		<div class="footer-credit">
			<p>&copy; <?php echo date('Y'); ?> Pretty in the Pines. All rights reserved. Brand & Web by <a href="http://www.otherlove.co" target="_blank">Otherlove</a>.</p>
		</div>

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
