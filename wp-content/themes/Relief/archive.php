<?php get_header();

// Category
if (is_category()) :
	$page_title = sprintf( __('All posts in: "%s"', 'qns'), single_cat_title('',false) );

// Tag
elseif (is_tag()) :
	$page_title = sprintf( __('All posts tagged: "%s"', 'qns'), single_tag_title('',false) );

// Author
elseif ( is_author() ) :	
	$userdata = get_userdata($author);
	$page_title = sprintf( __('All posts by: "%s"', 'qns'), $userdata->display_name );

// Day
elseif ( is_day() ) :
	$page_title = sprintf( __( 'Daily Archives: <span>%s</span>', 'qns' ), get_the_date() );
	
// Month	
elseif ( is_month() ) :
	$page_title = sprintf( __( 'Monthly Archives: <span>%s</span>', 'qns' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'qns' ) ) );
	
// Year
elseif ( is_year() ) :
	$page_title = sprintf( __( 'Yearly Archives: <span>%s</span>', 'qns' ), get_the_date( _x( 'Y', 'yearly archives date format', 'qns' ) ) );
	
else : 
	$page_title = __('Archives', 'qns');
	
endif; ?>

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
		<div class="blog-event-prev-wrapper section clearfix">
			
			<div class="<?php echo sidebar_position('primary-content'); ?>">
				<?php if ( have_posts() ) the_post(); ?>
					<h2 class="title2">
						<?php echo $page_title; ?>
					</h2>
					<?php rewind_posts(); ?>
					<?php load_template( TEMPLATEPATH . '/includes/loop.php' ); ?>
			</div>
			
			<?php get_sidebar(); ?>
		
		<!-- END .section -->			
		</div>
		
	<!-- END #content -->
	</div>

<?php get_footer(); ?>