<?php // ADMIN PAGE for PITP 2020 Theme Settings


// /* ADD OPTIONS PAGE TO THE ADMIN MENU 
// menu slug name = 'pitp2020-theme-settings'
// */
function add_theme_menu_item() {
    add_theme_page("Theme Customization", "Theme Customization", "manage_options", "theme-options", "theme_option_page", null, 99);
}
add_action("admin_menu", "add_theme_menu_item");


//DESIGN ADMIN PAGE FORM 
function theme_option_page() {
    ?>
        <div class="wrap">
            <h1>Pretty in the Pines 2020 Custom Theme Options</h1>
            <form method="post" action="options.php">
                <?php
                // display settings field on theme-option page
                settings_fields("pitp2020_fp_featured_cat_1");
                settings_fields("pitp2020_fp_featured_cat_1_title");
                settings_fields("twitter_url");
                // display all sections for theme-options page
                do_settings_sections("theme-options");
                submit_button();
                ?>
            </form>
        </div>
    <?php }

// /* ADD SETTINGS 
// - fp_featured_cats
// - fp_shop_banner
// - fp_about
// - fp_subscribe
// */

function test_theme_settings(){

    /* FYI SETTING STRUCTURE + DEMO CODE
    - add option to DB ---  add_option('first_field_option',1);
    - add setting section --- add_settings_section( 'first_section', 'New Theme Options Section', 'theme_section_description','theme-options');
    - add setting fields --- add_settings_field('first_field_option','Test Settings Field','options_callback', 'theme-options','first_section');
    - register setting --- register_setting( 'theme-options-grp', 'first_field_option');
    */

    // featured category 1 
    add_option('pitp2020_fp_featured_cat_1', 1);
    add_option('pitp2020_fp_featured_cat_1_title', 1);
    add_option('twitter_url',1);

    // create category 1 section & fields
    add_settings_section( 'pitp2020_fp_featured_cat_1_section', 'Front Page: Featured Category 1', 'featured_category_section_callback','theme-options');
    
    add_settings_field('pitp2020_fp_featured_cat_1','Select a category','featured_category_select_callback', 'theme-options','pitp2020_fp_featured_cat_1_section');
    add_settings_field('pitp2020_fp_featured_cat_1_title','Title','featured_category_title_callback', 'theme-options','pitp2020_fp_featured_cat_1_section');
    add_settings_field('twitter_url', 'Test Twitter Profile Url', 'display_test_twitter_element', 'theme-options', 'pitp2020_fp_featured_cat_1_section');

    // registor category 1 settings (fields)
    register_setting( 'pitp2020_fp_featured_cat_1', 'pitp2020_fp_featured_cat_1');
    register_setting( 'pitp2020_fp_featured_cat_1_title', 'pitp2020_fp_featured_cat_1_title');
    register_setting( 'twitter_url', 'twitter_url');


    // category callbacks
    function featured_category_section_callback() {
        echo 'Please sel a category and write a title.';
    }

    function featured_category_select_callback() {
        echo 'dropdown here';
    }

    function featured_category_title_callback() {
        ?>
        <input type="text" name="fp_featured_category" id="fp_featured_category" value="<?php echo get_option('pitp2020_fp_featured_cat_1_title'); ?>" />
        <?php
    }

    function display_test_twitter_element(){
        //php code to take input from text field for twitter URL.
        ?>
        <input type="text" name="test_twitter_url" id="test_twitter_url" value="<?php echo get_option('test_twitter_url'); ?>" />
        <?php
    }
    
}


add_action('admin_init','test_theme_settings');



    