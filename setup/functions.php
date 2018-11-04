<?php
/**
 * SETUP-BLOCKHEADER
 * This file adds functions to the SETUP Theme.
 *
 * @package SETUP
 * @author  Mark Corpuz
 * @license GPL-2.0+
 * @link    http://markcorpuz.com/
 */

// Start the engine.
include_once( get_template_directory() . '/lib/init.php' );

// Setup Theme.
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

// Set Localization (do not remove).
add_action( 'after_setup_theme', 'setupbasic_localization_setup' );
function setupbasic_localization_setup(){
	load_child_theme_textdomain( 'setup-basic', get_stylesheet_directory() . '/languages' );
}

// Add the helper functions.
include_once( get_stylesheet_directory() . '/lib/helper-functions.php' );

// Add Image upload and Color select to WordPress Theme Customizer.
require_once( get_stylesheet_directory() . '/lib/customize.php' );

// Include Customizer CSS.
include_once( get_stylesheet_directory() . '/lib/output.php' );

// Add WooCommerce support.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-setup.php' );

// Add the required WooCommerce styles and Customizer CSS.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-output.php' );

// Add the Genesis Connect WooCommerce notice.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-notice.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'SETUP-BLOCKHEADER' );
define( 'CHILD_THEME_URL', 'https://setup.smartwebpackage.com/block-header' );
define( 'CHILD_THEME_VERSION', '2.6.1.1' );


// ------------------------------------------------------------------------
// THEME SETTINGS

// Add support for custom header.
add_theme_support( 'custom-header', array(
	'width'           => 800,
	'height'          => 200,
	'header-selector' => '.site-title a',
	'header-text'     => false,
	'flex-height'     => true,
) );

// Add support for custom background.
add_theme_support( 'custom-background' );

// Add HTML5 markup structure.
add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );

// Add Accessibility support
add_theme_support( 'genesis-accessibility', array( '404-page', 'drop-down-menu', 'headings', 'rems', 'search-form', 'skip-links' ) );

// Add viewport meta tag for mobile browsers.
add_theme_support( 'genesis-responsive-viewport' );

// Add support for after entry widget.
add_theme_support( 'genesis-after-entry-widget-area' );

// Remove Edit Link.
add_filter( 'edit_post_link', '__return_false' );

// THEME SETTINGS -- END
// ------------------------------------------------------------------------

// ------------------------------------------------------------------------
// FONT SETTINGS

// Enqueue Scripts and Styles.
add_action( 'wp_enqueue_scripts', 'setupbasic_enqueue_scripts_styles' );
function setupbasic_enqueue_scripts_styles() {
	wp_enqueue_style( 'setupbasic-fonts', '//fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Roboto+Condensed:300,400,700|Lato:100,300,400,700,900', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'dashicons' );
}

// FONT SETTINGS -- END
// ------------------------------------------------------------------------

// ------------------------------------------------------------------------
// IMAGE SETTINGS

// Add Image Sizes.
add_image_size( 'featured-icon', 60, 60, TRUE );
add_image_size( 'featured-image', 768, 576, TRUE );

// Modify the size of the Gravatar in the author box
add_filter( 'genesis_author_box_gravatar_size', 'author_box_gravatar_size' );
function author_box_gravatar_size( $size ) {
	return 64;
}

// Modify the size of the Gravatar in comments
add_filter( 'genesis_comment_list_args', 'sp_comments_gravatar' );
function sp_comments_gravatar( $args ) {
	$args['avatar_size'] = 64;
	return $args;
}

// IMAGE SETTINGS -- END
// ------------------------------------------------------------------------

// ------------------------------------------------------------------------
// MENU

// Add support for 3 menus
add_theme_support ( 'genesis-menus' , array ( 
	'primary'   => __( 'Header Menu', 'setupbasic' ),
	'secondary' => __( 'Top Menu', 'setupbasic' ),
    'footer'    => __( 'Footer Menu', 'setupbasic' ),
) );

// Reposition the secondary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_before_header', 'genesis_do_subnav', 5 );

// Add footer menu just above footer widget area
add_action( 'genesis_before_footer', 'setupbasic_footer_menu', 9 );
function setupbasic_footer_menu() {

	genesis_nav_menu( array(
		'theme_location' => 'footer',
	) );

}

// MENU -- END
// ------------------------------------------------------------------------

// ------------------------------------------------------------------------
// SITE-HEADER | LOGOMENU

// Remove the header right widget area
unregister_sidebar( 'header-right' );

// Reposition the primary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav', 11 );

// SITE-HEADER -- END
// ------------------------------------------------------------------------








// WIDGET ------ FOOTER-MENU

genesis_register_sidebar( array(
	'id' 			=> 'footer-menu',
	'name' 			=> __( 'Footer Menu', 'genesis' ),
	'description' 	=> __( 'Place your footer menu(s) or short entries', 'setupbasic' ),
) );

add_action( 'genesis_before_footer', 'setupbasic_footermenu_widgetarea' );
function setupbasic_footermenu_widgetarea() {
	genesis_widget_area( 'footer-menu', array(
		'before' => '<div class="footer-menu"><div class="wrap">',
		'after'  => '</div></div>',
    ) );
}



// ------------------------------------------------------------------------
// CREDITS

//* Add the credits section on the site footer
remove_action( 'genesis_footer', 'genesis_do_footer' );
add_action( 'genesis_footer', 'swp_sitefooter_credit' );
function swp_sitefooter_credit() {
	?>
	<div class="credit">
		<div class="sitefor">
			<div class="credit-brand"></div>
			<div class="credit-copyright">Copyright © <?php echo date("Y"); ?> Smarter Better · All Rights Reserved | <a href="<?php echo site_url(); ?>/privacy-policy/">Privacy Policy</a></div>
			<div class="credit-designby">Site Design by <a href="https://smarterwebpackages.com/">SmarterWebPackages.com</a></div>
		</div>
		<div class="siteby"><a href="https://smarterwebpackages.com/">SmarterWebPackages.com</a></div>
	</div>
	<?php
}

// CREDITS -- END
// ------------------------------------------------------------------------
