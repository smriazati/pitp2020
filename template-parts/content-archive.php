<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package pitp2020
 */

?>

 <article class="archive-post card" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if (pitp2020_post_thumbnail()) :?>
		<div class="card-thumbnail">
			<?php echo get_the_post_thumbnail(get_the_ID(), 'pitp2020-post-thumbnail', NULL) ?>
		</div>
	<?php endif ?>
	
	<div class="card-copy">
		<?php 
			the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); 

			$archiveCategories = get_the_category();
			$excerpt = get_the_excerpt();
			$excerpt = strip_shortcodes($excerpt);
			$excerpt = strip_tags($excerpt);
		?>
		<h4 class="category"><?php echo $archiveCategories[0]->name; ?></h4>
		<p class="description"><?php echo get_the_excerpt() ?></p>
		<a class="detail" href="<?php echo get_the_permalink()?>">Read more</a>
	</div> 
	
</article><!-- #post-<?php the_ID(); ?> -->
