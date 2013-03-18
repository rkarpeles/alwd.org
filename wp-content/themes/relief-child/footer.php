<?php 
	// Fetch options stored in $data
	global $data; 
?>

<!-- BEGIN #footer-wrapper -->
<div id="footer-wrapper">

	<div class="footer-tear"></div>
	
	<!-- BEGIN #footer -->
	<div id="footer">
		
		<div class="clearfix">
			<div class="two-forths">
				<?php dynamic_sidebar( 'footer-widget-area-one' ); ?>
			</div>
			<div class="one-forth">
				<?php dynamic_sidebar( 'footer-widget-area-two' ); ?>
			</div>
			<div class="one-forth last-col">
				<?php dynamic_sidebar( 'footer-widget-area-three' ); ?>
			</div>
		</div>
		
		<?php // Display Sponsors 
		if( $data['sponsors_display'] ) {	
			if( $data['sponsors_title'] ) : 
				$sponsors_title = $data['sponsors_title'];
			else :
				$sponsors_title = __('Sponsors','qns');
			endif;
		?>
		
		<!-- BEGIN .widget .bottom -->
		<div class="widget bottom">
			<div class="widget-title">
				<h4><?php echo $sponsors_title; ?></h4>
			</div>
			<div class="widget-content">
				<ul id="mycarousel" class="jcarousel-skin-tango">	
					<?php echo do_shortcode( $data['sponsors_list'] ); ?>
		 		</ul>
			</div>
		</div>
		<!-- END .widget .bottom -->
			
		<?php } ?>
		
	<!-- END #footer -->
	</div>
	
	<!-- BEGIN #footer-copy-wrapper -->
	<div id="footer-copy-wrapper">
		
		<!-- BEGIN #footer-copy -->
		<div id="footer-copy" class="clearfix">
			<p class="fl">
				
				<?php // Display footer message
				if ( $data['footer_msg'] ) :
					$footer_msg = $data['footer_msg'];
					echo $footer_msg;	
				else :
					echo '&copy; Copyright 2012';
				endif;
				?>

			</p>	
				
			<?php if ( has_nav_menu( 'footer' ) ) { ?>
				
				<!-- Secondary Menu -->
				<?php wp_nav_menu( array(
					'theme_location' => 'footer',
					'container' =>false,
					'items_wrap' => '<ul class="footer-menu fr">%3$s</ul>',
					'echo' => true,
					'before' => '',
					'after' => '<span>/</span>',
					'link_before' => '',
					'link_after' => '',
					'depth' => 0 )
				 ); ?>
				
			<?php } ?>
			
		<!-- END #footer-copy -->
		</div>
		
	<!-- END #footer-copy-wrapper -->
	</div>
	
<!-- END #footer-wrapper -->
</div>

<?php wp_footer(); ?>

<!-- END body -->
</body>
</html>