<?php
/**
 * Understrap enqueue scripts
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'understrap_scripts' ) ) {
	/**
	 * Load theme's JavaScript and CSS sources.
	 */
	function understrap_scripts() {
		// Get the theme data.
		$the_theme     = wp_get_theme();
		$theme_version = $the_theme->get( 'Version' );

		$css_version = $theme_version . '.' . filemtime( get_template_directory() . '/css/theme.min.css' );
		wp_enqueue_style( 'understrap-styles', get_stylesheet_directory_uri() . '/css/theme.min.css', array(), $css_version );

		wp_enqueue_script( 'jquery' );

		$js_version = $theme_version . '.' . filemtime( get_template_directory() . '/js/theme.min.js' );
		wp_enqueue_script( 'understrap-scripts', get_template_directory_uri() . '/js/theme.min.js', array(), $js_version, true );
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
} // endif function_exists( 'understrap_scripts' ).

add_action( 'wp_enqueue_scripts', 'understrap_scripts' );


if(!function_exists('load_vcu_brandbar_script')){
    function load_vcu_brandbar_script() {
        global $post;
        $version= '1.0'; 
        $in_footer = false;
        wp_enqueue_script('vcu_brand', '//branding.vcu.edu/bar/academic/latest.js', null, $version, $in_footer);       
    }
}
add_action('wp_enqueue_scripts', 'load_vcu_brandbar_script');

if(!function_exists('load_main_course_script')){
    function load_main_course_script() {      
        $version= '1.0'; 
        $in_footer = true;
        wp_enqueue_script('bsExpandJs', get_template_directory_uri() . '/js/course.js', null, $version, $in_footer);
    }
}
add_action('wp_enqueue_scripts', 'load_main_course_script');

