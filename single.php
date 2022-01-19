<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package pitp2020
 */

get_header();
?>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId            : '301782157652833', 
      autoLogAppEvents : true,
      xfbml            : true,
      version          : 'v2.12'
    });
  };
  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			?> 

			<div class="narrow-contain">
				<?php
				    $next_post = get_next_post();
					$previous_post = get_previous_post();
					the_post_navigation( array(
						'next_text' => get_the_post_thumbnail($next_post->ID,'thumbnail') . '<span class="post-title"> <span class="meta-nav" aria-hidden="true">Next post</span> %title</span>',
						'prev_text' => '<span class="post-title"><span class="meta-nav" aria-hidden="true">Previous post</span> %title</span>' . get_the_post_thumbnail($previous_post->ID,'thumbnail'),
					) );

				?>

				<?
				if (get_post_type() === 'post') {
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
					
				} ?>
			</div>
		<?php
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
