<?php

// Slideshow Wrapper
function slideshow_shortcode( $atts, $content = null ) {

	extract( shortcode_atts( array(
			'width' => ''
		), $atts ) );
	
	if( !isset($atts['width']) ) $width = '80%';
	
	return '<div class="slider section slide-loader">
		
		<ul class="slides">' 
			. do_shortcode($content) . 
		'</ul>
			
	</div>';

}

add_shortcode( 'slideshow', 'slideshow_shortcode' );

function slide_shortcode( $atts, $content = null ) {
	
	extract( shortcode_atts( array(
			'image_url' => '',
			'link_url' => '',
			'caption' => '',
			'alt_text' => '',
		), $atts ) );
	
	if( isset($atts['image_url']) ) $image_url = $atts['image_url'];
	if( isset($atts['link_url']) ) $link_url = $atts['link_url'];
	if( isset($atts['caption']) ) $caption = $atts['caption'];
	if( isset($atts['alt_text']) ) $alt_text = $atts['alt_text'];

	$output = '';
	$output .= '<li>';
	
	if( isset($atts['link_url']) ) {
		$output .= '<a href="' . $link_url . '"><img src="' . $image_url . '" alt="' . $alt_text . '" /></a>';
	}

	else {
		$output .= '<img src="' . $image_url . '" alt="' . $alt_text . '" />';
	}
	
	if ( $caption !== '' ) {
		$output .= '<div class="flex-caption">';
		$output .= $caption;
		$output .= '</div>';
	}
	
	$output .= '</li>';

	return $output;

}

add_shortcode( 'slide', 'slide_shortcode' );

?>