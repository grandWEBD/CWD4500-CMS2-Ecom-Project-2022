<?php

/**
 * Functions which enhance the theme by creating custom post types
 *
 * @package CMS2_eCOMM_Theme
 */

function cms_ecomm_post_types() {
    $labels = array(
        'name'                  => _x( 'Events', 'Post type general name', 'cms_ecomm' ),
        'singular_name'         => _x( 'Event', 'Post type singular name', 'cms_ecomm' ),
        'menu_name'             => _x( 'Events', 'Admin Menu text', 'cms_ecomm' ),
        'name_admin_bar'        => _x( 'Event', 'Add New on Toolbar', 'cms_ecomm' ),
        'add_new'               => __( 'Add New', 'cms_ecomm' ),
        'add_new_item'          => __( 'Add New event', 'cms_ecomm' ),
        'new_item'              => __( 'New event', 'cms_ecomm' ),
        'edit_item'             => __( 'Edit event', 'cms_ecomm' ),
        'view_item'             => __( 'View event', 'cms_ecomm' ),
        'all_items'             => __( 'All events', 'cms_ecomm' ),
        'search_items'          => __( 'Search events', 'cms_ecomm' ),
        'parent_item_colon'     => __( 'Parent events:', 'cms_ecomm' ),
        'not_found'             => __( 'No events found.', 'cms_ecomm' ),
        'not_found_in_trash'    => __( 'No events found in Trash.', 'cms_ecomm' ),
        'featured_image'        => _x( 'Event Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'cms_ecomm' ),
        'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'cms_ecomm' ),
        'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'cms_ecomm' ),
        'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'cms_ecomm' ),
        'archives'              => _x( 'Event archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'cms_ecomm' ),
        'insert_into_item'      => _x( 'Insert into event', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'cms_ecomm' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this event', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'cms_ecomm' ),
        'filter_items_list'     => _x( 'Filter events list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'cms_ecomm' ),
        'items_list_navigation' => _x( 'Events list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'cms_ecomm' ),
        'items_list'            => _x( 'Events list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'cms_ecomm' ),
    );     
    $args = array(
        'labels'             => $labels,
        'description'        => 'Event custom post type.',
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'events' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 20,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail' ),
        'taxonomies'         => array( 'category', 'post_tag' ),
        'show_in_rest'       => true
    );

    register_post_type( 'cms_ecomm_event', $args );
}
add_action( 'init', 'cms_ecomm_post_types' );