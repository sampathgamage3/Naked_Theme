<?php

 /**
   * Register a Portfolio post type, with REST API support
   *
   * Based on example at: http://codex.wordpress.org/Function_Reference/register_post_type
   */

  add_action( 'init', 'meetup_portfolio' );
  
  function meetup_portfolio() {
    $labels = array(
      'name'               => _x( 'Portfolio', 'post type general name', 'your-plugin-textdomain' ),
      'singular_name'      => _x( 'Portfolio', 'post type singular name', 'your-plugin-textdomain' ),
      'menu_name'          => _x( 'Portfolio', 'admin menu', 'your-plugin-textdomain' ),
      'name_admin_bar'     => _x( 'Portfolio', 'add new on admin bar', 'your-plugin-textdomain' ),
      'add_new'            => _x( 'Add New', 'portfolio', 'your-plugin-textdomain' ),
      'add_new_item'       => __( 'Add New Portfolio', 'your-plugin-textdomain' ),
      'new_item'           => __( 'New Portfolio', 'your-plugin-textdomain' ),
      'edit_item'          => __( 'Edit Portfolio', 'your-plugin-textdomain' ),
      'view_item'          => __( 'View Portfolio', 'your-plugin-textdomain' ),
      'all_items'          => __( 'All Portfolio', 'your-plugin-textdomain' ),
      'search_items'       => __( 'Search Portfolio', 'your-plugin-textdomain' ),
      'parent_item_colon'  => __( 'Parent Portfolio:', 'your-plugin-textdomain' ),
      'not_found'          => __( 'No portfolio found.', 'your-plugin-textdomain' ),
      'not_found_in_trash' => __( 'No portfolio found in Trash.', 'your-plugin-textdomain' )
    );
  
    $args = array(
      'labels'             => $labels,
      'description'        => __( 'Description.', 'your-plugin-textdomain' ),
      'public'             => true,
      'publicly_queryable' => true,
      'show_ui'            => true,
      'show_in_menu'       => true,
      'query_var'          => true,
      'rewrite'            => array( 'slug' => 'portfolio' ),
      'capability_type'    => 'post',
      'has_archive'        => true,
      'hierarchical'       => false,
      'menu_position'      => null,
      'register_meta_box_cb' => 'add_your_fields_meta_box',
      'show_in_rest'       => true,
      'rest_base'          => 'portfolio-api',
      'rest_controller_class' => 'WP_REST_Posts_Controller',
      'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
    );
  
    register_post_type( 'portfolio', $args );
}

