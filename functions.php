<?php
/**
 * pitp2020 functions and definitions
 * @package pitp2020
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'pitp2020_setup' ) ) :
	function pitp2020_setup() {
		load_theme_textdomain( 'pitp2020', get_template_directory() . '/languages' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);
		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'pitp2020_setup' );

function pitp2020_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'pitp2020_content_width', 640 );
}
add_action( 'after_setup_theme', 'pitp2020_content_width', 0 );

function pitp2020_scripts() {
	wp_enqueue_style( 'pitp2020-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'pitp2020-style', 'rtl', 'replace' );

	wp_enqueue_script( 'pitp2020-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'pitp2020_scripts' );

require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/template-functions.php';

if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

function pitp2020_unregister_default_widgets() {
	unregister_widget('WP_Widget_Pages');
	unregister_widget('WP_Widget_Calendar');
	unregister_widget('WP_Widget_Archives');
	unregister_widget('WP_Widget_Links');
	unregister_widget('WP_Widget_Meta');
	unregister_widget('WP_Widget_Search');
	unregister_widget('WP_Widget_Text');
	unregister_widget('WP_Widget_Categories');
	unregister_widget('WP_Widget_Recent_Posts');
	unregister_widget('WP_Widget_Recent_Comments');
	unregister_widget('WP_Widget_RSS');
	unregister_widget('WP_Widget_Tag_Cloud');
	unregister_widget('WP_Nav_Menu_Widget');
	unregister_widget('Twenty_Eleven_Ephemera_Widget');
	unregister_widget('WP_Widget_Media_Audio');
	unregister_widget('WP_Widget_Media_Image');
	unregister_widget('WP_Widget_Media_Video');
	unregister_widget('WP_Widget_Custom_HTML');
}
add_action('widgets_init', 'pitp2020_unregister_default_widgets', 11);

function pitp2020_imports() {
	wp_enqueue_style( 'open-sans', 'https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap', false ); 
	wp_enqueue_style( 'baskervilleNormal', 'https://fonts.googleapis.com/css2?family=Baskervville:ital@0;1&display=swap', false ); 
	wp_enqueue_style( 'swiper-slider-css', get_stylesheet_directory_uri().'/libs/swiper.min.css', array(), null, false ); 
	wp_enqueue_script( 'swiper-slider-lib', 'https://unpkg.com/swiper/swiper-bundle.min.js', false );
}

add_action( 'wp_enqueue_scripts', 'pitp2020_imports' );

require get_stylesheet_directory() . '/inc/customizer.php';
new PITPFrontPage_Customizer();

function pitp2020_custom_menus_setup() {	
	register_nav_menus(
		array(
			'top-mini-menu' => esc_html__( 'Top Mini Menu', 'pitp2020' ),
			'primary-menu' => esc_html__( 'Primary Menu', 'pitp2020' ),
			'left-footer-menu' => esc_html__( 'Left Footer Menu', 'pitp2020' ),
			'right-footer-menu' => esc_html__( 'Right Footer Menu', 'pitp2020' ),
			'shop-by-room-filters' => esc_html__( 'Shop By Room Filters', 'pitp2020' ),
			'shop-main-filters' => esc_html__( 'Shop Main Filters', 'pitp2020' )		)
	);
}
add_action( 'after_setup_theme', 'pitp2020_custom_menus_setup' );

function pitp2020_favicon() {
    echo '<link rel="shortcut icon" type="image/png" href="'. get_stylesheet_directory_uri() .'/assets/favicon.ico" />';
}
add_action('wp_head', 'pitp2020_favicon');

function pitp2020_products_custom_post_type() {
	$labels = array(
		'name'                => _x( 'Products', 'Post Type General Name', 'pitp2020' ),
		'singular_name'       => _x( 'Product', 'Post Type Singular Name', 'pitp2020' ),
		'menu_name'           => __( 'Products', 'pitp2020' ),
		'parent_item_colon'   => __( 'Parent Product', 'pitp2020' ),
		'all_items'           => __( 'All Products', 'pitp2020' ),
		'view_item'           => __( 'View Product', 'pitp2020' ),
		'add_new_item'        => __( 'Add New Product', 'pitp2020' ),
		'add_new'             => __( 'Add New', 'pitp2020' ),
		'edit_item'           => __( 'Edit Product', 'pitp2020' ),
		'update_item'         => __( 'Update Product', 'pitp2020' ),
		'search_items'        => __( 'Search Product', 'pitp2020' ),
		'not_found'           => __( 'Not Found', 'pitp2020' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'pitp2020' ),
	);
	$args = array(
		'label'               => __( 'products', 'pitp2020' ),
		'description'         => __( 'Custom Products', 'pitp2020' ),
		'labels'              => $labels,
		'show_in_rest'        => true,
		'supports'            => array( 'title', 'author', 'thumbnail', 'revisions', 'custom-fields', ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 6,
		'menu_icon'           => 'dashicons-cart',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
		'taxonomies'          => array( 'product_categories' )
	);
	register_post_type( 'products', $args );	
}
	
add_action( 'init', 'pitp2020_products_custom_post_type', 0 );

function pitp2020_products_custom_post_taxonomy() {
		$portfolio_cats = array(
		'name' => _x( 'Product Categories', 'taxonomy general name' ),
		'singular_name' => _x( 'Product Category', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Product Categories' ),
		'all_items' => __( 'All Product Categories' ),
		'parent_item' => __( 'Parent Product Category' ),
		'parent_item_colon' => __( 'Parent Product Category:' ),
		'edit_item' => __( 'Edit Product Category' ), 
		'update_item' => __( 'Update Product Category' ),
		'add_new_item' => __( 'Add New Product Category' ),
		'new_item_name' => __( 'New Product Category' ),
		'menu_name' => __( 'Product Categories' ),
		);    
		register_taxonomy('product_categories',array('products'), array(
			'hierarchical' => true,
			'labels' => $product_cats,
			'show_ui' => true,
			'show_admin_column' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'shop' ),
		));
	}
add_action( 'init', 'pitp2020_products_custom_post_taxonomy', 0 );

add_action( 'pre_get_posts', 'pitp2020_shop_archive_num_posts' );
function pitp2020_shop_archive_num_posts( $query ) {
    if ( !is_admin() && $query->is_main_query() && is_tax('product_categories') ) {
            $query->set( 'posts_per_page', '9' );
    }
}

add_filter( 'pre_get_posts', 'pitp2020_change_num_products_on_cpt_archive_page' );
function pitp2020_change_num_products_on_cpt_archive_page( $query ) {
    if ( $query->is_post_type_archive( 'products' ) && ! is_admin() && $query->is_main_query() ) {
          $query->set( 'posts_per_page', '9' );
    }
    return $query;
}

function default_comments_off( $data ) {
    if( $data['post_type'] == 'products') {
        $data['comment_status'] = 0;
    }
    return $data;
}
add_filter( 'wp_insert_post_data', 'default_comments_off' );

function pitp2020_custom_js() {
	wp_enqueue_script( 'piptp2020-main', get_template_directory_uri() . '/js/main.js', array(), _S_VERSION, true );

	if ( is_page( 'Home') ) {
		wp_enqueue_script( 'pitp2020-home', get_template_directory_uri() . '/js/home.js', array(), _S_VERSION, true );
	}
	if ( is_single() || is_page() ) {
		wp_enqueue_script( 'pitp2020-single', get_template_directory_uri() . '/js/single.js', array(), _S_VERSION, true );
	}
	// social sharing: pinterest
	if(is_single()) {
		wp_enqueue_script( 'pinterest-share', 'https://assets.pinterest.com/js/pinit.js', null, false );
	}
}

add_action( 'template_redirect', 'pitp2020_custom_js' );

add_filter('get_the_archive_title', function ($title) {
    return preg_replace('/^\w+: /', '', $title);
});

add_action('wp_head', 'fc_opengraph');
function fc_opengraph() {
  if( is_single() || is_page() ) {
    $post_id = get_queried_object_id();
    $url = get_permalink($post_id);
    $title = get_the_title($post_id);
    $site_name = get_bloginfo('name');
    $description = wp_trim_words( get_post_field('post_content', $post_id), 25 );
    $image = get_the_post_thumbnail_url($post_id);
    if( !empty( get_post_meta($post_id, 'og_image', true) ) ) $image = get_post_meta($post_id, 'og_image', true);
    $locale = get_locale();
    echo '<meta property="og:locale" content="' . esc_attr($locale) . '" />';
    echo '<meta property="og:type" content="article" />';
    echo '<meta property="og:title" content="' . esc_attr($title) . ' | ' . esc_attr($site_name) . '" />';
    echo '<meta property="og:description" content="' . esc_attr($description) . '" />';
    echo '<meta property="og:url" content="' . esc_url($url) . '" />';
    echo '<meta property="og:site_name" content="' . esc_attr($site_name) . '" />';
    if($image) echo '<meta property="og:image" content="' . esc_url($image) . '" />';
    // Twitter Card
    echo '<meta name="twitter:card" content="summary_large_image" />';
    echo '<meta name="twitter:site" content="@ShelbsLV" />';
    echo '<meta name="twitter:creator" content="@ShelbsLV" />';
  }
}

add_filter( 'the_content', 'wp_make_content_images_responsive' ); 

function fjarrett_get_attachment_id_by_url( $url ) {
	$parsed_url  = explode( parse_url( WP_CONTENT_URL, PHP_URL_PATH ), $url );
	$this_host = str_ireplace( 'www.', '', parse_url( home_url(), PHP_URL_HOST ) );
	$file_host = str_ireplace( 'www.', '', parse_url( $url, PHP_URL_HOST ) );
	if ( ! isset( $parsed_url[1] ) || empty( $parsed_url[1] ) || ( $this_host != $file_host ) ) {
		return;
	}
	global $wpdb;
	$attachment = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM {$wpdb->prefix}posts WHERE guid RLIKE %s;", $parsed_url[1] ) );
	return $attachment[0];
}

// unfortunately, this won't help with site loading speed, because it is a filter on the DOM, after page is loaded :'( )
function make_divi_images_responsive($the_content) {
	$post = new DOMDocument();
	libxml_use_internal_errors(true);
	$post->loadHTML('<?xml encoding="utf-8" ?>'.$the_content); 
	libxml_clear_errors();
	$xpath = new DOMXPath($post);
	$nodes = $xpath->query('//div[contains(@class, "divi-col")]');

	foreach ($nodes as $node) {
		$figures = $node->getElementsByTagName('figure');
		foreach ($figures as $figure) {

			$figureClass = $figure->getAttribute('class');
			$figure->setAttribute('class', $figureClass . 'divi-image');
			
			$imgs = $figure->getElementsByTagName('img');
			foreach ($imgs as $img) {
				$src = $img->getAttribute('src');
				$attachId = fjarrett_get_attachment_id_by_url( $src );

				if ($attachId > 0) {
					$img->removeAttribute('src');   
					$img->setAttribute('data-attachID', $attachId);
					$srcset = wp_get_attachment_image_srcset( $attachId, 'medium', null );
					$img->setAttribute('srcset', $srcset); 
					
					// $sizes = '(min-width: 1200px) 1097w, (min-width: 768px) 720w, (min-width: 576px) 214w, calc(100vw - 30px)';
					$sizes = '(min-width: 576px) 576px, 100vw';
					$img->setAttribute('sizes', $sizes);
				}
			};
		};

	};

	return $post->saveHTML();	
}

add_filter('the_content', 'make_divi_images_responsive');


// define the wp_calculate_image_sizes callback 
function filter_wp_calculate_image_sizes( $sizes, $size, $image_src, $image_meta, $attachment_id ) { 
	$sizes = '(min-width: 400px) 400px, 100vw';
    return $sizes; 
}; 
         
// add the filter 
add_filter( 'wp_calculate_image_sizes', 'filter_wp_calculate_image_sizes', 10, 5 ); 


function be_body_classes( $classes ) {
  $classes[] = 'no-touch';
  return $classes;
}
add_filter( 'body_class', 'be_body_classes' );

// Gutenberg customizations
function pitp2020_disable_gutenberg_custom_styles() {
	add_theme_support( 'editor-color-palette' );
	add_theme_support( 'disable-custom-colors' );
	add_theme_support( 'disable-custom-gradients' );
	add_theme_support( 'editor-gradient-presets', array() );
	add_theme_support( 'editor-font-sizes', [] );
	add_theme_support( 'disable-custom-font-sizes' );
}

add_action( 'after_setup_theme', 'pitp2020_disable_gutenberg_custom_styles' );

add_action( 'init', 'remove_block_style' );

function remove_block_style() {
	// Register the block editor script.
	wp_register_script( 'remove-block-style', get_stylesheet_directory_uri() . '/js/blockstyles.js', [ 'wp-blocks', 'wp-edit-post' ] );
	// register block editor script.
	register_block_type( 'remove/block-style', [
		'editor_script' => 'remove-block-style',
	] );
}

function wpdocs_my_search_form( $form ) {
    $form = '<form role="search" method="get" id="searchform" class="search-form" action="' . home_url( '/' ) . '" >
		<label class="screen-reader-text" for="s">' . __( 'Search for:' ) . '</label>
		<input type="text" value="' . get_search_query() . '" placeholder="Search" name="s" id="s" />
		<input type="submit" id="searchsubmit" value="" />	
    </form>';
    return $form;
}

add_filter( 'get_search_form', 'wpdocs_my_search_form' );

function header_search_form( $form ) {

    $form = '<form role="search" method="get" id="searchformHeader" class="search-form" action="' . home_url( '/' ) . '" >
		<label class="screen-reader-text" for="s">' . __( 'Search for:' ) . '</label>
		<input type="text" value="' . get_search_query() . '" placeholder="What are you looking for?" name="s" id="s" />
		<input type="submit" id="searchsubmit" value="" />
		
    </form>';
 
    return $form;
}

function mobile_search_form( $form ) {

    $form = '<form role="search" method="get" id="searchformMobile" class="search-form" action="' . home_url( '/' ) . '" >
		<label class="screen-reader-text" for="s">' . __( 'Search for:' ) . '</label>
		<input type="text" value="' . get_search_query() . '" placeholder="Search" name="s" id="s" />
		<input type="submit" id="searchsubmit" value="" />
		
    </form>';
 
    return $form;
}


//make image sizes for theme - archive page sizes 
add_image_size( 'pitp2020-post-thumbnail', 350, 500 ); 



// ty https://wordpress.stackexchange.com/questions/207923/count-posts-in-category-including-child-categories
function get_term_post_count( $taxonomy = 'category', $term = '', $args = [] )
{
    // Lets first validate and sanitize our parameters, on failure, just return false
    if ( !$term )
        return false;

    if ( $term !== 'all' ) {
        if ( !is_array( $term ) ) {
            $term = filter_var(       $term, FILTER_VALIDATE_INT );
        } else {
            $term = filter_var_array( $term, FILTER_VALIDATE_INT );
        }
    }

    if ( $taxonomy !== 'category' ) {
        $taxonomy = filter_var( $taxonomy, FILTER_SANITIZE_STRING );
        if ( !taxonomy_exists( $taxonomy ) )
            return false;
    }

    if ( $args ) {
        if ( !is_array ) 
            return false;
    }

    // Now that we have come this far, lets continue and wrap it up
    // Set our default args
    $defaults = [
        'posts_per_page' => 1,
        'fields'         => 'ids'
    ];

    if ( $term !== 'all' ) {
        $defaults['tax_query'] = [
            [
                'taxonomy' => $taxonomy,
                'terms'    => $term
            ]
        ];
    }
    $combined_args = wp_parse_args( $args, $defaults );
    $q = new WP_Query( $combined_args );

    // Return the post count
    return $q->found_posts;
}



// ty https://gist.github.com/amboutwe/66c583d2ef4015a8a244ee3e0e8cd1a0
add_filter( 'wpseo_next_rel_link', 'custom_remove_wpseo_next' );
function custom_remove_wpseo_next( $link ) {
     if ( is_home() ) {
          return false;
     } else { 
          return $link;
     }
}

// remove ... after excerpts
// ty https://wordpress.stackexchange.com/questions/162109/remove-more-or-text-from-short-post
function new_excerpt_more( $more ) {
    return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');
// custom excerpt link
// ty https://wordpress.stackexchange.com/questions/141125/allow-html-in-excerpt/141136#141136
function wpse_excerpt_length( $length ) {
    return 45;
}
add_filter( 'excerpt_length', 'wpse_excerpt_length', 999 );

//Page Slug Body Class
function add_slug_body_class( $classes ) {
	global $post;
	if ( isset( $post ) ) {
		$classes[] = $post->post_type . '-' . $post->post_name;
	}
	return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );