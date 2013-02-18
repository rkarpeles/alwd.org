<?php

function create_post_type_gallery() {
	
	register_post_type('gallery', 
		array(
			'labels' => array(
				'name' => __( 'Photo Galleries', 'qns' ),
                'singular_name' => __( 'Photo Gallery', 'qns' ),
				'add_new' => __('Add New', 'qns' ),
				'add_new_item' => __('Add New Photo Gallery' , 'qns' )
			),
		'public' => true,
		'menu_position' => 5,
		'rewrite' => array(
			'slug' => 'gallery'
		), 
		'supports' => array( 'title','editor','thumbnail'),
	));
}

add_action( 'init', 'create_post_type_gallery' );

?>