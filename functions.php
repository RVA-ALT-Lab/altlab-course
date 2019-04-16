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

//ACF

function get_learning_objectives(){
	if( have_rows('learning_objectives') ):
	$html = '<div class="col-md-6"><div class="learning-objectives"><h2>Learning Objectives</h2><ul>';
 	// loop through the rows of data
    while ( have_rows('learning_objectives') ) : the_row();

        // display a sub field value
        $html .= '<li>' .get_sub_field('objective').'</li>';

    endwhile;
    $html .= '</ul></div></div>';
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


function acf_fetch_next_page(){
  global $post;
  $html = '';
  $next_page = get_field('next_page');

    if( $next_page) {      
      $html = '<a class="module-next-nav" href="' . $next_page . '">Next <i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a>';  
     return $html;    
    }

}


function get_extra_resources(){
  if( have_rows('resource_list') ):
  $html = '<div class="col-12"><h2>Learn More</h2></div>';
  // loop through the rows of data
    while ( have_rows('resource_list') ) : the_row();

        // display a sub field value
        $html .= '<div class="col-md-4 extras"><a href="'.get_sub_field('resource_link').'"><h3>' .get_sub_field('resource_title').'</h3></a><p>'.get_sub_field('resource_description').'</p></div>';

    endwhile;  
    return $html;

else :

    // no rows found

endif;
}


//from https://www.advancedcustomfields.com/resources/local-json/
add_filter('acf/settings/save_json', 'my_acf_json_save_point');
 
function my_acf_json_save_point( $path ) {
    
    // update path
    $path = get_stylesheet_directory() . '/acf-json';
    
    
    // return
    return $path;
    
}


//LETS YOU CONTROL WHAT GETS STRIPPED IN CUT/PASTE TO MCE EDITOR 
//fix cut paste drama from https://jonathannicol.com/blog/2015/02/19/clean-pasted-text-in-wordpress/
add_filter('tiny_mce_before_init','configure_tinymce');

/**
 * Customize TinyMCE's configuration
 *
 * @param   array
 * @return  array
 */
function configure_tinymce($in) {
  $in['paste_preprocess'] = "function(plugin, args){
    // Strip all HTML tags except those we have whitelisted
    var whitelist = 'p,b,strong,i,em,h2,h3,h4,h5,h6,ul,li,ol,a,href';
    var stripped = jQuery('<div>' + args.content + '</div>');
    var els = stripped.find('*').not(whitelist);
    for (var i = els.length - 1; i >= 0; i--) {
      var e = els[i];
      jQuery(e).replaceWith(e.innerHTML);
    }
    // Strip all class and id attributes
    stripped.find('*').removeAttr('id').removeAttr('class').removeAttr('style');
    // Return the clean HTML
    args.content = stripped.html();
  }";
  return $in;
}


//step forward/backwards
//id =4



function gform_stepper($entry, $form){
   $search_criteria = array(
    'status'        => 'active',
    // 'field_filters' => array(
    //     'mode' => 'any',       
    //     array(
    //         'key'   => '6',
    //         'value' => $id
    //     )
    // )
);

  $sorting         = array();
  $paging          = array( 'offset' => 0, 'page_size' => 100 );
  $total_count     = 0;

  $entries = GFAPI::get_entries(4, $search_criteria, $sorting, $paging, $total_count );
  //print("<pre>".print_r($entries,true)."</pre>");
  $html = '';
  $total_scores = [];
  var_dump(intval($entry['gsurvey_score']));
    foreach ($entries as $entry) {
      if (intval($entry['gsurvey_score'])>0){
        $pre = 'pos-';
      }
      if (intval($entry['gsurvey_score'])<0){
        $pre = 'neg';
      } else {
        $pre = 'zero-';
      }
      array_push($total_scores,$pre . $entry['gsurvey_score']);
    }
    var_dump($total_scores);
}


add_shortcode( 'steps', 'gform_stepper' );

function make_bubbles(){
  return '<div class="bubble-holder" id="bubble-zone">
  <div class="bubble" id="neg-10" data-count="0">-10</div>
  <div class="bubble" id="neg-9" data-count="0">-9</div>
  <div class="bubble" id="neg-8" data-count="0">-8</div>
  <div class="bubble" id="neg-7" data-count="0">-7</div>
  <div class="bubble" id="neg-6" data-count="0">-6</div>
  <div class="bubble" id="neg-5" data-count="0">-5</div>
  <div class="bubble" id="neg-4" data-count="0">-4</div>
  <div class="bubble" id="neg-3" data-count="0">-3</div>
  <div class="bubble" id="neg-2" data-count="0">-2</div>
  <div class="bubble" id="neg-1" data-count="0">-1</div>
  <div class="bubble" id="zero-0" data-count="0">0</div>
  <div class="bubble" id="pos-1" data-count="0">1</div>
  <div class="bubble" id="pos-2" data-count="0">2</div> 
  <div class="bubble" id="pos-3" data-count="0">3</div>
  <div class="bubble" id="pos-4" data-count="0">4</div>  
  <div class="bubble" id="pos-5" data-count="0">5</div>
  <div class="bubble" id="pos-6" data-count="0">6</div>
  <div class="bubble" id="pos-7" data-count="0">7</div>
  <div class="bubble" id="pos-8" data-count="0">8</div>
  <div class="bubble" id="pos-9" data-count="0">9</div>
  <div class="bubble" id="pos-10" data-count="0">10</div>
</div>';
}

add_shortcode( 'show_bubbles', 'make_bubbles' );

