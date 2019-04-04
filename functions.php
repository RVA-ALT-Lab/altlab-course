<?php
/**
 * Understrap functions and definitions
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$understrap_includes = array(
	'/theme-settings.php',                  // Initialize theme default settings.
	'/setup.php',                           // Theme setup and custom theme supports.
	'/widgets.php',                         // Register widget area.
	'/enqueue.php',                         // Enqueue scripts and styles.
	'/template-tags.php',                   // Custom template tags for this theme.
	'/pagination.php',                      // Custom pagination for this theme.
	'/hooks.php',                           // Custom hooks.
	'/extras.php',                          // Custom functions that act independently of the theme templates.
	'/customizer.php',                      // Customizer additions.
	'/custom-comments.php',                 // Custom Comments file.
	'/jetpack.php',                         // Load Jetpack compatibility file.
	'/class-wp-bootstrap-navwalker.php',    // Load custom WordPress nav walker.
	'/woocommerce.php',                     // Load WooCommerce functions.
	'/editor.php',                          // Load Editor functions.
	'/deprecated.php',                      // Load deprecated functions.
);

foreach ( $understrap_includes as $file ) {
	$filepath = locate_template( 'inc' . $file );
	if ( ! $filepath ) {
		trigger_error( sprintf( 'Error locating /inc%s for inclusion', $file ), E_USER_ERROR );
	}
	require_once $filepath;
}


//custom stuff

if(!function_exists('load_vcu_brandbar_script')){
    function load_vcu_brandbar_script() {
        global $post;
        $version= '1.0'; 
        $in_footer = false;
        wp_enqueue_script('bsExpandJs', '//branding.vcu.edu/bar/academic/latest.js', null, $version, $in_footer);
        wp_localize_script('my-script', 'my_script_vars', array(
                'postID' => $post->ID
            )
        );
    }
}
add_action('wp_enqueue_scripts', 'load_vcu_brandbar_script');

//ACF

function get_learning_objectives(){
	if( have_rows('learning_objectives') ):
	$html = '<div class="col-md-6 learning-objectives"><h2>Learning Objectives</h2><ul>';
 	// loop through the rows of data
    while ( have_rows('learning_objectives') ) : the_row();

        // display a sub field value
        $html .= '<li>' .get_sub_field('objective').'</li>';

    endwhile;
    $html .= '</ul></div>';
    return $html;

else :

    // no rows found

endif;
}



function acf_fetch_introduction(){
  $html = '';
  $introduction = get_field('introduction');

    if( $introduction) {  
      $html  = '<div class="col-md-6 module-intro"><h2>Introduction</h2>';   
      $html .= $introduction;  
      $html .= '</div>';
     return $html;    
    }

}


