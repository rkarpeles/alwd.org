<?php

function sponsor_shortcode( $atts, $content = null ) {
	
	extract( shortcode_atts( array(
			'img_url' => '',
			'img_width' => '',
			'img_height' => '',
			'link_url' => '',
		), $atts ) );

	$output = '';
	$output .= '<li>';

	
	if( isset($atts['link_url']) ) {
		$output .= '<a href="' . $atts['link_url'] . '">';
	}
	
	$output .= '<img src="';
	
	$output .= $atts['img_url'];
	
	$output .= '" width="';
	
	$output .= $atts['img_width'];
	
	$output .= '" height="';
	
	$output .= $atts['img_height'];
	
	$output .= '" alt="" />';
	
	if( isset($atts['link_url']) ) {
		$output .= '</a>';
	}
	
	$output .= '</li>';
	
	return $output;

}

add_shortcode( 'sponsor', 'sponsor_shortcode' );

?>