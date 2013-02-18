<?php get_header(); ?>

	<?php //Display Page Header
		global $wp_query;
		$postid = $wp_query->post->ID;
		echo page_header( get_post_meta($postid, 'qns_page_header_image', true) );
		wp_reset_query();
	?>
	
	<!-- BEGIN #content -->
	<div id="content" <?php post_class("entry"); ?>>
		
		<?php // Display Breadcrumbs
			echo display_breadcrumbs(); 
		?>
		
		<!-- BEGIN .section -->
		<div class="blog-event-prev-wrapper section clearfix">
			
			<div class="<?php echo sidebar_position('primary-content'); ?>">
				<h2 class="title2"><?php _e('Page Not Found', 'qns') ?></h2>
				<p><?php echo __('Oops! looks like you clicked on a broken link.','qns') . ' <a href="' . home_url() . '">' . __('Go home?</a>', 'qns') ?></p>
			</div>
			
			<?php get_sidebar(); ?>

		<!-- END .section -->				
		</div>
		
	<!-- END #content -->
	</div>

<?php get_footer(); ?>