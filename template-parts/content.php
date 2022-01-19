<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package pitp2020
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="hero-banner narrow-contain">
		<div class="wrapper">
			<?php if (pitp2020_post_thumbnail()) :?>
			<div class="thumbnail">
				<?php echo get_the_post_thumbnail(get_the_ID(), 'large', NULL) ?>
			</div>	
			<?php endif ?>
			<header class="entry-header copy">
				<?php
				if ( is_singular() ) :
					the_title( '<h1 class="entry-title">', '</h1>' );
				else :
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				endif;

				if ( 'post' === get_post_type() ) :
					?>
					<div class="entry-meta">
						<?php
						pitp2020_posted_on();
						pitp2020_posted_by();
						?>
					</div><!-- .entry-meta -->
				<?php endif; ?>
			</header><!-- .entry-header -->
		</div> <!-- .wrapper -->
	</div> <!-- .hero-banner -->

	<div class="social-sharing narrow-contain">

	<?php 
		// URL ENCODING FOR PINTEREST BUTTONS
		// Dear future dev. Pardon my clunky code. I am not great at PHP.
		$linkOg = get_permalink();
		$slashlessLink = rtrim($linkOg,'/');
		$pintLinkAlmost = str_replace("/", "%2F",$slashlessLink);
		$pintLink = str_replace(":", "%3A", $pintLinkAlmost);

		$pintImageOg = get_the_post_thumbnail_url();
		$pintImageAlmost = str_replace("/", "%2F",$pintImageOg);
		$pintImage = str_replace(":", "%3A",$pintImageAlmost);

		$pintDescOg = get_the_title();
		$pintDesc = str_replace(" ", "%20", $pintDescOg)

		// FACEBOOK SHARING
		//https://developers.facebook.com/docs/sharing/reference/share-dialog
	?>
		<ul>
			<!-- from https://developers.pinterest.com/tools/widget-builder/?buttonType=oneImage&round=true -->
			<li id="pinterest">
				<a target="_blank" data-pin-do="buttonPin" data-pin-custom="true" data-pin-tall="true" data-pin-round="true" href="https://www.pinterest.com/pin/create/button/?url=<?php echo $pintLink ?>&media=<?php echo $pintImage ?>&description=<?php echo $pintDesc ?>">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/single-pinterest.png" />
				</a>
			</li>
			<li id="email">
				<a target="_blank" href="mailto:?body=<?php echo get_permalink() ?>&subject=Pretty in the Pines: <?php echo get_the_title() ?>">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/single-email.png" />
				</a>
			</li>
			<li id="facebook" onclick="facebookShareButton('<?php echo get_permalink()?>')">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/single-facebook.png" />
			</li>
		</ul>
	</div>

	<div class="entry-content narrow-contain">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'pitp2020' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);
		?>
		<div class="narrow-contain"><?
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'pitp2020' ),
				'after'  => '</div>',
			)
		);
		?></div><?php
		?>
	</div><!-- .entry-content -->
	<div class="narrow-contain">
	<?php
		if (get_post_type() === 'post') { ?>
			<footer class="entry-footer">
				<?php pitp2020_entry_footer(); ?>
			</footer><!-- .entry-footer -->
		<?php
		} ?>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
