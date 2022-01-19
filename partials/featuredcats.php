<section class="featuredcats full-banner">
<div class="wrapper contained">
<?php
if ( get_theme_mod('fp-featuredlink-1-link') && get_theme_mod('fp-featuredlink-1-title')) {
?>
<a href="<?php echo get_theme_mod( 'fp-featuredlink-1-link' ) ?>"><?php echo get_theme_mod( 'fp-featuredlink-1-title' ); ?></a>
<?php
}
if ( get_theme_mod('fp-featuredlink-2-link') && get_theme_mod('fp-featuredlink-2-title')) {
?>
<a href="<?php echo get_theme_mod( 'fp-featuredlink-2-link' ) ?>"><?php echo get_theme_mod( 'fp-featuredlink-2-title' ); ?></a>
<?php
}
if ( get_theme_mod('fp-featuredlink-3-link') && get_theme_mod('fp-featuredlink-3-title')) {
?>
<a href="<?php echo get_theme_mod( 'fp-featuredlink-3-link' ) ?>"><?php echo get_theme_mod( 'fp-featuredlink-3-title' ); ?></a>
<?php
}
if ( get_theme_mod('fp-featuredlink-4-link') && get_theme_mod('fp-featuredlink-4-title')) {
?>
<a href="<?php echo get_theme_mod( 'fp-featuredlink-4-link' ) ?>"><?php echo get_theme_mod( 'fp-featuredlink-4-title' ); ?></a>
<?php
}?>
</div>
</section> <!-- /featuredcats -->