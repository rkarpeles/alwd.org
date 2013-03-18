<?php 

/* 
Template Name: Full Width 
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
		
		<?php // Display Breadcrumbs
			echo display_breadcrumbs(); 
		?>
		
		<!-- BEGIN .section -->
		<div class="section clearfix">

			<h2 class="title2"><?php the_title(); ?></h2>
			<?php load_template( TEMPLATEPATH . '/includes/loop.php' ); ?>
		
		<!-- END .section -->
		</div>
		
	<!-- END #content -->
	</div>

<?php get_footer(); ?>