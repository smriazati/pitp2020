<?php
/**
 * Template part for displaying product custom posts
 * @package pitp2020
 */

?>

 <article class="product product-item" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if (has_post_thumbnail()) :?>
		<a href="<?php the_field('rstyle_link'); ?>" target="_blank" class="product-thumbnail">
			<?php echo get_the_post_thumbnail(get_the_ID(), 'pitp2020-post-thumbnail', NULL) ?>
        </a>
    <?php else :?>
        <a href="<?php the_field('rstyle_link'); ?>" target="_blank" class="product-thumbnail product-placeholder">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/PrettyinthePines-Favicon-White.png" alt="instagram icon" />
        </a>
	<?php endif ?>
	
	<div class="product-copy">
		<?php 
			the_title( '<h3 class="entry-title"><a href="'. get_field('rstyle_link') .'" target="_blank">', '</a></h3>' ); 
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
	
</article><!-- #post-<?php the_ID(); ?> -->
