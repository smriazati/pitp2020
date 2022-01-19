<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package pitp2020
 */

get_header();
?>

	<main id="primary" class="site-main contained">
		<?php 
		
		if (is_tax('product_categories')) {
			$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); 
			$ref = get_term_by('slug', 'room', 'product_categories'); 
		?>

			<?php if ( is_tax('product_categories', 'Room') || $ref->term_id === $term->parent ) : ?>
				<nav class="shop-by-room shop-filters">
					<?php
						wp_nav_menu(
							array(
								'theme_location' => 'shop-by-room-filters',
								'menu_id'        => 'shop-by-room-filters'
							)
						);
					?>
				</nav>
			<?php elseif ( is_tax('product_categories') ) : ?>
				<nav class="shop-main shop-filters">
					<?php
						wp_nav_menu(
							array(
								'theme_location' => 'shop-main-filters',
								'menu_id'        => 'shop-main-filters'
							)
						);
					?>
				</nav>
			<?php endif ?>
		<?php } ?> 

		<?php if ( have_posts() ) : ?>
			
			<?php if ( is_tax('product_categories') ) : ?>
				<div class="shop-container">
			<?php else : ?>
				<div class="posts-container">
			<?php endif ?>
			<?php
			while ( have_posts() ) :
				the_post();
				if ( get_post_type() === 'products') :
					get_template_part( 'template-parts/content-products', get_post_type() );
				else : 
					get_template_part( 'template-parts/content-archive', get_post_type() );
				endif;

			endwhile;
			?></div> <!-- #-container -->
			<?php
			
		else :
			get_template_part( 'template-parts/content', 'none' );
		endif;

		if(is_category() && have_posts()){
			$cat = get_query_var('cat');
			$category = get_category ($cat);
			$count = $category->category_count;
			if ($count > 10) {
				echo do_shortcode('[ajax_load_more category="'.$category->slug.'" offset="10" cache="true" cache_id="cache-'.$category->slug.'" container_type="div" post_type="post" posts_per_page="9" pause="true" scroll="false" button_label="Load More" button_loading_label="Loading posts..." button_done_label="No posts remain..." no_results_text="Sorry, no posts were found. " ]');
			}
		}

		if ( is_tax('product_categories') && have_posts() ) :
	
			$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); 
			$count = get_term_post_count( 'product_categories', $term->term_id ); // custom function to count category & children
			// echo $term->slug; // will show the slug
			$showLoadMore = false;
			if ($count > 9) {
				$showLoadMore = true;
			}
			if ($showLoadMore) {
				echo do_shortcode('[ajax_load_more id="6507810973" container_type="div" post_type="products" posts_per_page="9" taxonomy="product_categories" taxonomy_terms="'.$term->slug.'" taxonomy_operator="IN" offset="9" cache="true" cache_id="cache-'.$term->slug.'" pause="true" scroll="false" button_label="Load more" button_loading_label="Loading products..." button_done_label="No products remain..." no_results_text="Sorry, no products were found."]');
			}
		endif;
	
		?>

	</main><!-- #main -->

	<?php include get_theme_file_path( '/partials/featuredcats.php' ); ?>

<?php
get_sidebar();
get_footer();
