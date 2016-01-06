<?php
/**Theme Name	: elitepress-child
 * Theme Core Functions and Codes
*/
/**Includes reqired resources here**/
define('MY_TEMPLATE_DIR_URI', get_stylesheet_directory_uri());
define('MY_TEMPLATE_DIR',get_stylesheet_directory());
define('MY_THEME_FUNCTIONS_PATH',MY_TEMPLATE_DIR.'/functions');

require( MY_THEME_FUNCTIONS_PATH . '/widget/custom-sidebar.php');
require_once( MY_THEME_FUNCTIONS_PATH . '/scripts/scripts.php');

add_action ('wp_enqueue_scripts','theme_enqueue_style');
function theme_enqueue_style() {
	wp_enqueue_style ('parent-style', get_template_directory_uri() . '/style.css');
	wp_enqueue_style( 'child-style', get_stylesheet_uri(), array('parent-style')  );
	wp_enqueue_script('utility', get_stylesheet_directory_uri() .'/js/utility.js');
}

add_filter('get_the_excerpt','my_post_slider_excerpt', 999);
function my_post_slider_excerpt($output){

		return '<div class="">' .'<h4>'.$output.'</h4>'.'</div>';
}

function remove_parent_post_slider_excerpt() {	//This function is created to remove and stop the 'parent_post_slider_excerpt' function from executing.   
    remove_filter('get_the_excerpt','elitepress_post_slider_excerpt'); //This WordPress API hook/function removes the function, elitepress_post_slider_excerpt from the parent.  
}
add_action( 'wp_loaded', 'remove_parent_post_slider_excerpt' ); //This WordPress API hook/function loads and executes the 'remove_parent_post_slider_excerpt' 

function remove_parent_enqueue_scripts() {	//This function is used to remove and stop the 'parent_post_slider_excerpt' function from executing					
    remove_action('wp_enqueue_scripts','elitepress_scripts'); 
}
add_action( 'wp_loaded', 'remove_parent_enqueue_scripts' );
?>
