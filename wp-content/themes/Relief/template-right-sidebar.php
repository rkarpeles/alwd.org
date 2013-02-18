<?php 

/* 
Template Name: Right Sidebar 
*/ 

?>

<?php get_header(); ?>

	<?php //Display Page Header
		global $wp_query;
		$postid = $wp_query->post->ID;
		echo page_header( get_post_meta($postid, 'qns_page_header_image', true) );
		wp_reset_query();
	?>
	
	<!-- BEGIN #content -->
	<div id="content">
		
		<?php // Display breadcrumbs
			echo display_breadcrumbs(); 
		?>
		
		<!-- BEGIN .section -->
		<div class="blog-event-prev-wrapper section clearfix">
				
			<div class="two-thirds">
				<h2 class="title2"><?php the_title(); ?></h2>
				<?php load_template( TEMPLATEPATH . '/includes/loop.php' ); ?>
			</div>
				
			<?php get_sidebar(); ?>
		
		<!-- END .section -->			
		</div>
		
	<!-- END #content -->
	</div>

<?php get_footer(); ?>