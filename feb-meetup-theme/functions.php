<?php
 //All the Functions Goes Here

register_nav_menu( 'feb_primary_menu', __( 'FebMeetup Primary Menu', 'febmeetup' ) );
 
register_sidebar( array(
        'name' => __( 'Widget Area', 'FebMeetup' ),
        'id' => 'sidebar-1'
));
/* Portfolio Post Type With Rest Api Support */
include_once('function-includes/portfolio-post-type.php');

/* Portfolio Meta Box and Fields */
include_once('function-includes/portfolio-meta.php');


function enqueue_styles_and_scripts()  { 
 
	
	// get the theme directory style.css and link to it in the header
	wp_enqueue_style('bootstrap.css', get_stylesheet_directory_uri() . '/css/bootstrap.min.css');
	wp_enqueue_style('portfolio.css', get_stylesheet_directory_uri() . '/css/portfolio-item.css');
	
	// add fitvid
	wp_enqueue_script( 'jquery.js', get_template_directory_uri() . '/js/jquery.js', array( 'jquery' ), NAKED_VERSION, true );
	wp_enqueue_script( 'bootstrap.js', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), NAKED_VERSION, true );
	
	 
}
add_action( 'wp_enqueue_scripts', 'enqueue_styles_and_scripts' ); 



/* Shortcode */

function get_post_ID( $atts ) {  

  return  get_the_ID() ;
}

add_shortcode( 'getPostID', 'get_post_ID' );

