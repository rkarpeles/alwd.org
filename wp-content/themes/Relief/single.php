<?php
	
	if ( is_post_type( "event" )) {
		load_template(TEMPLATEPATH.'/single-events.php');
	}
	
	elseif ( is_post_type( "gallery" )) {
		load_template(TEMPLATEPATH.'/single-gallery.php');
	}

	else {
		load_template(TEMPLATEPATH.'/single-default.php');
	}

?>