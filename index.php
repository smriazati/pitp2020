<?php
/**
 * @package pitp2020
 */
get_header();
?>

<main id="primary" class="site-main contained">
	<h1 class="sr-only">Pretty in the Pines</h1>
	<?php
	if (have_posts()) :
		echo '<div class="posts-container">';

		while (have_posts()) :
			the_post();
			get_template_part('template-parts/content-archive', get_post_type());

		endwhile;
		echo '</div>';

		echo do_shortcode('[ajax_load_more offset="10" loading_style="white" container_type="div" post_type="post" posts_per_page="9" pause="true" scroll="false" button_label="Load More" button_loading_label="Loading posts..." button_done_label="No posts remain..." no_results_text="Sorry, no posts were found. " ]');
	else :
		get_template_part('template-parts/content', 'none');

	endif;

	?>

	<?php include get_theme_file_path( '/partials/featuredcats.php' ); ?>


</main><!-- #main -->

<?php
// get_sidebar();
get_footer();
