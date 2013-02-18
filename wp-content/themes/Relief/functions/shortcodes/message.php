<?php

function message_shortcode( $atts, $content = null ) {
	
	// type: info / notice / success / fail	
	extract( shortcode_atts( array(
			'type' => '',
		), $atts ) );
	
	if( !isset($atts['type']) ) {
		$class = "default";
	}
	
	else {
		$class = $atts['type'];
	}
	
	if ( $atts['type'] == 'announcement' ) {
		return '<div class="msg1">
			<div class="edge-top"></div>
			<p>' . do_shortcode($content) . '</p>
			<div class="edge-bottom"></div>
		</div>';
	}
	
	else {
		return '<div class="msg ' . $class . ' clearfix"><p>' . do_shortcode($content) . '</p></div>';
	}

}

add_shortcode( 'msg', 'message_shortcode' );

?>