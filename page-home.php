<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package pitp2020
 */

get_header();
?>

	<main id="primary" class="site-main">
		<h1 class="sr-only">Pretty in the Pines</h1>
		<?php
		if ( have_posts() ) :

			
				// LATEST POST WITH FEATURED TAG
				$featuredpost_args = array(
					'posts_per_page' => 1,
					'post_status' => 'publish',
					'tag' => 'featured'
				);
				$featuredpost_query = new WP_Query( $featuredpost_args );
				if ( $featuredpost_query->have_posts() ) {
					while ( $featuredpost_query->have_posts() ) {
						$featuredpost_query->the_post();

						$featuredcategories = get_the_category();

						?>
						<section class="featured-post full-banner flex-2">
							<div class="wrapper mobile-overlap contained">
								<div class="thumbnail">
									<a href="<?php echo get_the_permalink()?>">
										<?php echo get_the_post_thumbnail(get_the_ID(), 'large', NULL) ?>
									</a>
								</div>
								<div class="copy">
									<div class="copy-wrapper">
										<p class="banner"> <?php echo esc_html( $featuredcategories[0]->name ); ?></p>
										<h2> <?php echo get_the_title() ?></h2>
										<p> <?php echo get_the_excerpt() ?></p>
										<a class="detail" href="<?php echo get_the_permalink()?>">Read more</a>
									</div>
								</div>
							</div>
						</section> <!-- featured-post -->
						<?php
					}
				} 
				wp_reset_postdata();?> 


<?php include get_theme_file_path( '/partials/featuredcats.php' ); ?>


				
<?php 
// CURRENTLY LOVING SLIDER
$currentloving_args = array(
	'post_type' => 'products',
	'tax_query' => array(
		array (
			'taxonomy' => 'product_categories',
			'field' => 'slug',
			'terms'    => array( 'homepage-featured-products' ),
		)
	),
);


$currentlyloving_query = new WP_Query( $currentloving_args );

if ( $currentlyloving_query->have_posts() ) {
	?>
	<section class="currently-loving">
		<div class="wrapper">
			<div class="section-title">
				<h2>Currently loving</h2>
			</div>

			<!-- Slider main container -->
			<div class="swiper-container contained">
				<div class="swiper-wrapper">
					<?php
					while ( $currentlyloving_query->have_posts() ) {
						$currentlyloving_query->the_post();
						?>
						<div class="swiper-slide">
							<?php if (has_post_thumbnail()) :?>
								<a href="<?php the_field('rstyle_link'); ?>" target="_blank" class="product-thumbnail">
									<?php echo get_the_post_thumbnail($post_id, 'thumbnail') ?>
								</a>
							<?php else :?>
								<a href="<?php the_field('rstyle_link'); ?>" target="_blank" class="product-thumbnail product-placeholder">
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/PrettyinthePines-Favicon-White.png" alt="instagram icon" />
								</a>
							<?php endif ?>
							
						</div>
					<?php }
					wp_reset_postdata();
					?>
				</div> <!-- / .swiper-wrapper -->
				<div class="swiper-button-prev"></div>
				<div class="swiper-button-next"></div>
			</div> <!-- / .swiper-container -->
		</div> <!-- /wrapper -->
	</section> 
	<?php
} 


?>




<?php


				// LATEST POSTS (3)
				$recentposts_args = array(
					'posts_per_page' => 3,
					'post_status' => 'publish'
				);
				$recentposts_query = new WP_Query( $recentposts_args );
				function recent_post_excerpt(){
					$excerpt = get_the_excerpt();
					$excerpt = strip_shortcodes($excerpt);
					$excerpt = strip_tags($excerpt);
					//$the_str = substr($excerpt, 0, 280);
					return $excerpt;
				}
				if ( $recentposts_query->have_posts() ) {
					?>
					<section class="recent-posts contained">
						<div class="wrapper">
							<div class="section-title">
								<h2>The Latest</h2>
							</div>
							<?php
							while ( $recentposts_query->have_posts() ) {
								$recentposts_query->the_post();
								$recentpostcat = get_the_category();

								?>
								<div class="recent-post card">
									<div class="card-thumbnail">
										<a href="<?php echo get_the_permalink()?>">
											<?php echo get_the_post_thumbnail(get_the_ID(), 'pitp2020-post-thumbnail', NULL) ?>
										</a>
									</div>
									<div class="card-copy">
										<?php 
											the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); 
										?>
										<h4 class="detail"><a href="category/<?php echo esc_html( $recentpostcat[0]->slug );?>"><?php echo esc_html( $recentpostcat[0]->name ); ?></a></h4>
										<p> <?php echo recent_post_excerpt() ?></p>
										<a class="button button-dark" href="<?php echo get_the_permalink()?>">Read more</a>
									</div>
								</div>
								<?php
							} // end while loop
							?>

						</div> <!-- / wrapper -->
						<div class="see-all-posts-btn"><a href="/blog">See all posts</a></div>
					</section>
				<?php
				} 
				wp_reset_postdata();
				?>
				<?php
					// VLOG SECTION
					$vlogimage = get_theme_mod( 'fp-vlog-image'); 						
				?>
				<section class="vlog contained">
					<div class="wrapper">
						<div class="section-title">
							<h2>Featured</h2>
						</div>
						<div class="featured-vlog-wrapper">
							<div class="thumbnail" onClick="playFeaturedVideo()">
									<?php echo wp_get_attachment_image($vlogimage, 'full')  ?>
									<span class='play-icon'></span>
							</div>
							<div class="vlog-embed-wrapper wp-block-embed__wrapper" data-vlog-id="<?php echo get_theme_mod( 'fp-vlog-id')  ?>">
							</div>
						</div>
						<div class="featured-vlog-copy">
							<h3 class="featured-vlog-title">
								<?php echo get_theme_mod( 'fp-vlog-title' ) ?>
							</h3>
						</div>
					</div>
				</section> <!-- featured-post -->

				<?php
// DAILY OUTFITS section
$dailyoutfits_args = array(
    'post_type' => 'products',
	'posts_per_page' => 3,
	'post_status' => 'publish',
	'tax_query' => array(
        array(
            'taxonomy' => 'product_categories',
            'field' => 'slug',
            'terms' => 'daily-outfits'
        )
    )
);
$dailyoutfits_query = new WP_Query( $dailyoutfits_args );

if ( $dailyoutfits_query->have_posts() ) {
	?>
	<section class="daily-outfits contained">
		<div class="wrapper">
			<div class="section-title">
				<h2>Daily Outfits</h2>
			</div>
			<?php
			while ( $dailyoutfits_query->have_posts() ) {
				$dailyoutfits_query->the_post();
				?>
				<div class="daily-outfit card">
					<div class="card-thumbnail">
						<a href="<?php the_field('rstyle_link'); ?>" target="_blank" class="product-thumbnail">
							<?php echo get_the_post_thumbnail(get_the_ID(), 'pitp2020-post-thumbnail', NULL) ?>
						</a>
					</div>
					<div class="card-copy">
						<?php 
							the_title( '<h3 class="entry-title">', '</h3>' ); 
						?>
						<?php 
							$terms = wp_get_post_terms( $post->ID, 'product_categories');
							foreach ( $terms as $term ) {
								$term_link = get_term_link( $term );
								if ( $term->name !== 'Homepage Featured Products') {
									echo '<h4><a href="'. $term_link .'">'. $term->name . '</a></h4>' . ' ';
								} 
							}
						?>
					</div>
				</div>
				<?php
			} // end while loop
			?>
			
		</div> <!-- / wrapper -->
		<div class="section-link align-text-center">
				<h3><a class="button button-dark" href="/shop/daily-outfits">Explore More</a></h3>
			</div>
	</section>
<?php
} 
wp_reset_postdata();
?>

				<?php
					// SHOP SECTION
					$shopimage = get_theme_mod( 'fp-shop-image'); 						
				?>
				<section class="shop flex-2 full-banner">
					<div class="wrapper contained">
						<div class="copy">
							<div class="copy-wrapper">
								<h2 class="small"> <?php echo get_theme_mod( 'fp-shop-toptext' ) ?></h2>
								<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/pinesprints.png" alt="instagram icon" />
								<a class="button button-dark" href="<?php echo get_theme_mod( 'fp-shop-link' ) ?>" target="_blank">Shop</a>
							</div>
						</div>
						<div class="thumbnail">
							<a href="<?php echo get_theme_mod( 'fp-shop-link' ) ?>" target="_blank"> 
								<?php echo wp_get_attachment_image($shopimage, 'full')  ?>
							</a>
						</div>
					</div>
				</section> <!-- featured-post -->


				<?php
					// BIO SECTION
					$bioimage = get_theme_mod( 'fp-bio-image'); 		
				?>
				<section class="bio contained bio-grid">
					<div class="wrapper">
						<div class="thumbnail">
							<?php echo wp_get_attachment_image($bioimage, 'full')  ?>
						</div>
						<div class="copy">
							<div class="copy-wrapper">
								<h2> <?php echo get_theme_mod( 'fp-bio-title' ) ?></h2>
								<p> <?php echo get_theme_mod( 'fp-bio-copy' ) ?></p>
								<a class="detail" href="<?php echo get_home_url().'/about' ?>">Read more</a>
							</div>
						</div>
					</div>
				</section> <!-- bio -->

				<?php
					// SUBSCRIBE SECTION	
				?>
				<section class="subscribe full-padded-container">
					<div class="wrapper">
						<div class="copy">
							<h2> <?php echo get_theme_mod( 'fp-subscribe-headline' ) ?></h2>
							<p class="detail"> <?php echo get_theme_mod( 'fp-subscribe-tagline' ) ?></p>
						</div>
						<div class="subscribe-form">
							<form action="https://prettyinthepines.us13.list-manage.com/subscribe/post?u=0cef19a5e103ffb6929c611d3&amp;id=cfe850f76b" method="post" target="_blank" name="fp-subscribe-form">
								<div class="content__formFields">

									<label for="subbox1" class="screenread">Name</label>
									<input type="text" id="subbox1" class="enews-subbox" value="" placeholder="Name" name="name" />		

									<label for="subbox" class="screenread">E-Mail</label>
									<input type="email" value="" id="subbox" placeholder="E-Mail" name="email" required="required" />
								</div>
								<div class="content__button">
									<input class="button button-green" type="submit" value="SUBSCRIBE" id="subbutton" />
								</div>
							</form>
					
						</div>
					</div>
				</section>
				<?php 
				// INSTAGRAM SECTION
				?>
				<section class="instagram full-padded-container">
					<div class="wrapper">

					<?php echo do_shortcode('[instagram-feed]') ?>

				</section>
				<?php
			endif;

	
		?>

	</main><!-- #main -->

<?php
// get_sidebar();
get_footer();
