<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package pitp2020
 */

get_header();
?>

	<main id="primary" class="site-main narrow-contain">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">
					<?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Search Results for: %s', 'pitp2020' ), '<span>' . get_search_query() . '</span>' );
					?>
				</h1>
			</header><!-- .page-header -->

			<div class="posts-container">
			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();
				if ( get_post_type() === 'products') :
					get_template_part( 'template-parts/content-products', get_post_type() );
				else : 
					get_template_part( 'template-parts/content-archive', get_post_type() );
				endif;			
			endwhile;

			?></div> <!-- posts-container -->
			<?php

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;

		if(have_posts()){
			$term = sanitize_text_field($_GET['s']);
			if(empty($term)){
			   $term = 'WordPress';
			}
			echo do_shortcode('[ajax_load_more post_type="post, page, portfolio" offset="10" search="'. $term .'" orderby="relevance" posts_per_page="9" pause="true" scroll="false" button_label="Load More" button_loading_label="Loading posts..." no_results_text="Sorry, no posts were found. "]');
		} 
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
