<?php
/**
 * pitp2020 Theme Customizer
 *
 * @package pitp2020
 */

/* Remove unneccesary sections from Customizer */


function pitp2020_cleanup_customizer( $wp_customize ) {

	 $wp_customize->remove_section('title_tagline');
	 $wp_customize->remove_section('colors');
	 $wp_customize->remove_section('background_image');
	 $wp_customize->remove_section('header_image');
	 $wp_customize->remove_section('nav');
	 $wp_customize->remove_section('static_front_page');
   
}
add_action('customize_register','pitp2020_cleanup_customizer');


// CUSTOM FEATURES

class PITPFrontPage_Customizer {

	public function __construct() {
		add_action( 'customize_register', array( $this, 'register_customize_sections' ) );
	}

	public function register_customize_sections( $wp_customize ) {
        $this->fp_featuredcats( $wp_customize );
        $this->fp_bio( $wp_customize );
        $this->fp_shop( $wp_customize );
        $this->fp_vlog( $wp_customize );
        $this->fp_subscribe( $wp_customize );
    }
    
    /* Sanitize Inputs */
    public function sanitize_custom_option($input) {
		//return ( $input === "No" ) ? "No" : "Yes";
		return $input; // fix this later
    }
    public function sanitize_custom_text($input) {
        return filter_var($input, FILTER_SANITIZE_STRING);
    }
    public function sanitize_custom_url($input) {
        return filter_var($input, FILTER_SANITIZE_URL);
    }
    public function sanitize_custom_email($input) {
        return filter_var($input, FILTER_SANITIZE_EMAIL);
    }
    public function sanitize_hex_color( $color ) {
        if ( '' === $color ) {
            return '';
        }
     
        // 3 or 6 hex digits, or the empty string.
        if ( preg_match( '|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
            return $color;
        }
    }
  

	// SUBSCRIBE 
	private function fp_subscribe( $wp_customize ) {
		
        $wp_customize->add_section('fp-subscribe-section', array(
            'title' => 'Homepage Subscribe Banner',
            'priority' => 4,
            'description' => __('Modify the online store banner on the homepage.', 'pitp2020'),
		));
			
		// MAILING LIST HEADLINE
		$wp_customize->add_setting('fp-subscribe-headline', array(
			'default' => 'Stay in the loop',
			'sanitize_callback' => array( $this, 'sanitize_custom_text' )
		));
		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'fp-subscribe-headline-control', array(
			'label' => 'Subscribe Banner Headline',
			'section' => 'fp-subscribe-section',
			'settings' => 'fp-subscribe-headline',
			'type' => 'text'
		)));

		// MAILING LIST TAGLINE
        $wp_customize->add_setting('fp-subscribe-tagline', array(
            'default' => 'tips, news, and more from Shelby',
            'sanitize_callback' => array( $this, 'sanitize_custom_text' )
        ));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'fp-subscribe-tagline-control', array(
            'label' => 'Subscribe Banner Tagline',
            'section' => 'fp-subscribe-section',
            'settings' => 'fp-subscribe-tagline',
			'type' => 'text'
		)));

	}



	/* Online Store Section */
	private function fp_shop( $wp_customize ) {
		
        $wp_customize->add_section('fp-shop-section', array(
            'title' => 'Homepage Store Banner',
            'priority' => 3,
            'description' => __('Modify the online store banner on the homepage.', 'pitp2020'),
		));
			
		// SHOP TOP TEXT
		$wp_customize->add_setting('fp-shop-toptext', array(
			'default' => '',
			'sanitize_callback' => array( $this, 'sanitize_custom_text' )
		));
		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'fp-shop-toptext-control', array(
			'label' => 'Store Banner Top Text',
			'section' => 'fp-shop-section',
			'settings' => 'fp-shop-toptext',
			'type' => 'text'
		)));

		// SHOP BOTTOM TEXT
        $wp_customize->add_setting('fp-shop-link', array(
            'default' => 'https://www.etsy.com/shop/homethisweekend',
			'sanitize_callback' => array( $this, 'sanitize_custom_url' )
        ));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'fp-shop-link-control', array(
            'label' => 'Store Banner Button URL',
            'section' => 'fp-shop-section',
            'settings' => 'fp-shop-link',
			'type' => 'text'
		)));

		// SHOP IMAGE

        $wp_customize->add_setting('fp-shop-image', array(
            'default' => '',
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => array( $this, 'sanitize_custom_url' )
        ));
    
        $wp_customize->add_control(new WP_Customize_Cropped_Image_Control($wp_customize, 'fp-shop-image-control', array(
            'label' => 'Shop Banner Image',
            'section' => 'fp-shop-section',
            'settings' => 'fp-shop-image',
            'width' => 830,
            'height' => 830
        )));
	}

	
	
	/* Bio Section */
	private function fp_bio( $wp_customize ) {
		
        $wp_customize->add_section('fp-bio-section', array(
            'title' => 'Homepage Bio',
            'priority' => 2,
            'description' => __('Modify the bio info on the homepage.', 'pitp2020'),
		));
			

		// BIO TITLE
        $wp_customize->add_setting('fp-bio-title', array(
            'default' => 'Meet Shelby',
            'sanitize_callback' => array( $this, 'sanitize_custom_text' )
        ));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'fp-bio-title-control', array(
            'label' => 'Bio headline',
            'section' => 'fp-bio-section',
            'settings' => 'fp-bio-title',
			'type' => 'text'
		)));

		// BIO PARAGRAPH
		$wp_customize->add_setting('fp-bio-copy', array(
			'default' => '',
			'sanitize_callback' => array( $this, 'sanitize_custom_text' )
		));
		$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'fp-bio-copy-control', array(
			'label' => 'Bio paragraph',
			'section' => 'fp-bio-section',
			'settings' => 'fp-bio-copy',
			'type' => 'textarea'
		)));

		// BIO IMAGE

        $wp_customize->add_setting('fp-bio-image', array(
            'default' => '',
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => array( $this, 'sanitize_custom_url' )
        ));
    
        $wp_customize->add_control(new WP_Customize_Cropped_Image_Control($wp_customize, 'fp-bio-image-control', array(
            'label' => 'Bio Image',
            'section' => 'fp-bio-section',
            'settings' => 'fp-bio-image',
            'width' => 564,
            'height' => 705
        )));
	}

	/* Featured Categories Section */
	
    private function fp_featuredcats( $wp_customize ) {
		
        $wp_customize->add_section('fp-featuredcats', array(
            'title' => 'Homepage Featured Categories',
            'priority' => 1,
            'description' => __('Modify the homepage featured categories.', 'pitp2020'),
		));
		
 
		// based on https://wordpress.stackexchange.com/questions/261147/wordpress-customizer-dropdown-with-category-output
		$categories = get_categories();

		$cats = array();
		$i = 0;
		foreach($categories as $category){
			if($i==0){
				$default = $category->slug;
				$i++;
			}
			$cats[$category->slug] = $category->name;
		}
		
	

		// CATEGORY 1
        $wp_customize->add_setting('fp-featuredcat-1-cat', array(
            'default' => 'No',
            'sanitize_callback' => array( $this, 'sanitize_custom_option' )
        ));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'fp-featuredcat-1-cat-control', array(
            'label' => 'Select first featured category',
            'section' => 'fp-featuredcats',
            'settings' => 'fp-featuredcat-1-cat',
			'type' => 'select',
			'choices' => $cats
		)));
		
        $wp_customize->add_setting('fp-featuredcat-1-title', array(
            'default' => '',
            'sanitize_callback' => array( $this, 'sanitize_custom_text' )
        ));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'fp-featuredcat-1-title', array(
            'label' => 'Label first featured category',
            'section' => 'fp-featuredcats',
            'settings' => 'fp-featuredcat-1-title',
            'type' => 'text'
		)));
		

		// CATEGORY 2
        $wp_customize->add_setting('fp-featuredcat-2-cat', array(
            'default' => 'No',
            'sanitize_callback' => array( $this, 'sanitize_custom_option' )
        ));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'fp-featuredcat-2-cat-control', array(
            'label' => 'Select second featured category',
            'section' => 'fp-featuredcats',
            'settings' => 'fp-featuredcat-2-cat',
			'type' => 'select',
			'choices' => $cats
		)));
		
        $wp_customize->add_setting('fp-featuredcat-2-title', array(
            'default' => '',
            'sanitize_callback' => array( $this, 'sanitize_custom_text' )
        ));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'fp-featuredcat-2-title', array(
            'label' => 'Label second featured category',
            'section' => 'fp-featuredcats',
            'settings' => 'fp-featuredcat-2-title',
            'type' => 'text'
		)));
		

		// CATEGORY 3
        $wp_customize->add_setting('fp-featuredcat-3-cat', array(
            'default' => 'No',
            'sanitize_callback' => array( $this, 'sanitize_custom_option' )
        ));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'fp-featuredcat-3-cat-control', array(
            'label' => 'Select third featured category',
            'section' => 'fp-featuredcats',
            'settings' => 'fp-featuredcat-3-cat',
			'type' => 'select',
			'choices' => $cats
		)));
		
        $wp_customize->add_setting('fp-featuredcat-3-title', array(
            'default' => '',
            'sanitize_callback' => array( $this, 'sanitize_custom_text' )
        ));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'fp-featuredcat-3-title', array(
            'label' => 'Label third featured category',
            'section' => 'fp-featuredcats',
            'settings' => 'fp-featuredcat-3-title',
            'type' => 'text'
        )));
		

		// CATEGORY 4
        $wp_customize->add_setting('fp-featuredcat-4-cat', array(
            'default' => 'No',
            'sanitize_callback' => array( $this, 'sanitize_custom_option' )
        ));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'fp-featuredcat-4-cat-control', array(
            'label' => 'Select fourth featured category',
            'section' => 'fp-featuredcats',
            'settings' => 'fp-featuredcat-4-cat',
			'type' => 'select',
			'choices' => $cats
		)));
		
        $wp_customize->add_setting('fp-featuredcat-4-title', array(
            'default' => '',
            'sanitize_callback' => array( $this, 'sanitize_custom_text' )
        ));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'fp-featuredcat-4-title', array(
            'label' => 'Label fourth featured category',
            'section' => 'fp-featuredcats',
            'settings' => 'fp-featuredcat-4-title',
            'type' => 'text'
        )));

    } // end featured categories
    
    /* VLOG Section */
	private function fp_vlog( $wp_customize ) {
		
        $wp_customize->add_section('fp-vlog-section', array(
            'title' => 'Vlog',
            'priority' => 2,
            'description' => __('Feature a vlog on the home page.', 'pitp2020'),
		));
			

		// VLOG YOUTUBE ID
        $wp_customize->add_setting('fp-vlog-id', array(
            'default' => 'ID HERE',
            'sanitize_callback' => array( $this, 'sanitize_custom_text' )
        ));
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'fp-vlog-id-control', array(
            'label' => 'Vlog ID',
            'section' => 'fp-vlog-section',
            'settings' => 'fp-vlog-id',
			'type' => 'text'
		)));

		// VLOG IMAGE

        $wp_customize->add_setting('fp-vlog-image', array(
            'default' => '',
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => array( $this, 'sanitize_custom_url' )
        ));
    
        $wp_customize->add_control(new WP_Customize_Cropped_Image_Control($wp_customize, 'fp-vlog-image-control', array(
            'label' => 'Vlog Thumbnail Image',
            'section' => 'fp-vlog-section',
            'settings' => 'fp-vlog-image',
            'width' => 1280,
            'height' => 720
        )));
	}
}
	