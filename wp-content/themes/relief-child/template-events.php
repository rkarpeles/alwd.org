<?php 

/* 
Template Name: Events 
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
			
			<!-- BEGIN .event-list-wrapper -->
			<div class="<?php echo sidebar_position('primary-content'); ?> event-list-wrapper">
				<h2 class="title2"><?php the_title(); ?></h2>
				
					<?php
						// Fetch options stored in $data
						global $data; 
						
						if ( $data['custom_page_limit'] ) {
							$event_perpage = $data['custom_page_limit'];
						}
						else {
							$event_perpage = '10';
						}
						
						$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;	

						$today = date('Y-m-d');
						
						query_posts(array(
							
							'post_type' => 'event',
							'posts_per_page' => $event_perpage,
							'paged' => $paged,
							'meta_key' => 'qns_event_date',
							'orderby' => 'meta_value',
							'order' => 'ASC',
							     'meta_query' => array(
								array(
								'key' => 'qns_event_date',
								'meta-value' => $value,
								'value' => $today,
								'compare' => '>=',
								'type' => 'CHAR'
								)
							)

					    ) );

						// The Loop
						while (have_posts()) : the_post();
							
							// Get event date
							$e_date = get_post_meta($post->ID, $prefix.'event_date', true);
							if ( $e_date !== '' ) { 									
								$event_date_string = $e_date;
								$event_monthM = mysql2date( 'M', $event_date_string );
								$event_day = mysql2date( 'd', $event_date_string );
								$event_month = apply_filters('get_the_date', $event_monthM, 'M');
							}
								
							// If no date set
							else { 	
								$event_month = "---";
								$event_day = "00";	
							}
								
							// Get event time
							$e_time = get_post_meta($post->ID, $prefix.'event_time', true);
							if ( $e_time !== '' ) { $event_time = $e_time; }
							else { $event_time = __('No time set','qns'); }
								
							// Get event location
							$e_location = get_post_meta($post->ID, $prefix.'event_location', true);
							if ( $e_location !== '' ) { $event_location = $e_location; }
							else { $event_location = __('No location set','qns'); }
							
						?>
							
						<!-- BEGIN .event-prev -->	
						<div class="event-prev clearfix">
							<div class="event-prev-date">
								<p class="month"><?php echo $event_month; ?></p>
								<p class="day"><?php echo $event_day; ?></p>
							</div>
							<div class="event-prev-content">
								<h4><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
								<p><strong><?php _e('Time','qns') ?>:</strong> <?php echo $event_time; ?> <br>
								<strong><?php _e('Location','qns') ?>:</strong> <?php echo $event_location; ?></p>
							</div>
						<!-- END .event-prev -->
						</div>
								
						<?php endwhile;

						// Reset Post Data
						wp_reset_postdata();

						?>

					<?php // Include Pagination feature
						load_template( TEMPLATEPATH . '/includes/pagination.php' );
					?>	
			
			<!-- END .event-list-wrapper -->
			</div>
			
			<?php get_sidebar(); ?>
		
		<!-- END .section -->		
		</div>
		
	<!-- END #content -->
	</div>

<?php get_footer(); ?>