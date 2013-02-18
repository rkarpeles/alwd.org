<?php 

/* 
Template Name: Homepage 
*/ 

?>

<?php 
	// Fetch options stored in $data
	global $data; 
?>

<?php get_header(); ?>

	<?php // Display Slideshow 
	if ( $data['slideshow_display'] ) : 
		echo do_shortcode( $data['slideshow'] ); 
	endif;
	?> 
	
	<!-- BEGIN #content -->
	<div id="content">
	
		<!-- BEGIN .section -->
		<div class="section clearfix block-section">
			
			<div class="one-third clearfix">	
				<?php if ($data['homepage_block_title_1'] ) :
					echo '<h3 class="title1">' . $data['homepage_block_title_1'] . '<span class="title-end"></span></h3>';
				endif;
				echo $data['homepage_block_content_1'];
				if ($data['homepage_block_button_1'] ) :
					echo '<p><a href="' . $data['homepage_block_link_1'] . '" class="button2">' . $data['homepage_block_button_1'] . '</a></p>';
				endif; ?>
			</div>
			
			<div class="one-third clearfix">	
				<?php if ($data['homepage_block_title_2'] ) :
					echo '<h3 class="title1">' . $data['homepage_block_title_2'] . '<span class="title-end"></span></h3>';
				endif;
				echo $data['homepage_block_content_2'];
				if ($data['homepage_block_button_2'] ) :
					echo '<p><a href="' . $data['homepage_block_link_2'] . '" class="button2">' . $data['homepage_block_button_2'] . '</a></p>';
				endif; ?>
			</div>
			
			<div class="one-third last-col clearfix">	
				<?php if ($data['homepage_block_title_3'] ) :
					echo '<h3 class="title1">' . $data['homepage_block_title_3'] . '<span class="title-end"></span></h3>';
				endif;
				echo $data['homepage_block_content_3'];
				if ($data['homepage_block_button_3'] ) :
					echo '<p><a href="' . $data['homepage_block_link_3'] . '" class="button2">' . $data['homepage_block_button_3'] . '</a></p>';
				endif; ?>
			</div>
		
		<!-- END .section -->
		</div>
		
		<?php // Announcement Message
		if ($data['homepage_announcement'] ) : ?>
		<div class="section">
			<div class="msg1">
				<div class="edge-top"></div>
				<p><?php echo $data['homepage_announcement']; ?></p>
				<div class="edge-bottom"></div>
			</div>
		</div>
		<?php endif; ?>

		<?php // News/Events On/Off
		if ( $data['home_events_news'] ) : ?>
		
		<div class="blog-event-prev-wrapper section clearfix">
			<div class="two-thirds">
				
				<?php // News Title
				if ($data['homepage_news_title'] ) : 
					$news_title = $data['homepage_news_title'];
				else :
					$news_title = __('Latest News','qns');
				endif;
				?>
				
				<h3 class="title1"><?php echo $news_title; ?><span class="title-end"></span></h3>
				
				<?php // Set News Limit
				if ($data['homepage_news_limit'] ) : 
					$news_limit = $data['homepage_news_limit'];
				elseif ( !is_numeric ( $data['homepage_news_limit'] ) )	:
					$news_limit = '3';
				else :
					$news_limit = '3';
				endif;
				?>
				
				<?php
				
				$args = array(
	                'posts_per_page' => $news_limit,
	                'ignore_sticky_posts' => 1,
	                'post_type' => 'post',
	                'order' => 'DESC',
	                'orderby' => 'date'
	            );

				$post_query = new WP_Query( $args );

				if( $post_query->have_posts() ) : while( $post_query->have_posts() ) : $post_query->the_post(); ?>
							
					<div class="blog-prev clearfix">
						<div class="blog-prev-img">
							<a href="<?php echo get_permalink(); ?>" rel="bookmark">

							<?php // Display Thumbnail
							if( has_post_thumbnail() ) :
								the_post_thumbnail( 'blog-thumb-small' );
							else :
								echo '<img src="' . get_template_directory_uri() . '/images/noimage1.png" alt="" />';
							endif; 
							?>

							</a>
						</div>
						
						<div class="blog-prev-content">
							<h4>
								<a href="<?php echo get_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
								<span> <?php _e('Posted','qns'); ?> <?php the_time('M d, Y'); ?> <?php _e('By', 'qns'); ?> <?php the_author(); ?></span>
							</h4>
							<p><?php the_excerpt(); ?></p>
						</div>
					</div>
						
					<?php endwhile; endif; ?>
				
			</div>
			
			<div class="one-third last-col">

				<?php // Events Title 
				if ($data['homepage_events_title'] ) : 
					$events_title = $data['homepage_events_title'];
				else :
					$events_title = __('Events','qns');
				endif;	
				?>
				
				<h3 class="title1"><?php echo $events_title; ?><span class="title-end"></span></h3>
				
				<?php // Set Events Limit 
				if ($data['homepage_events_limit'] ) : 
						$events_limit = $data['homepage_events_limit'];
					elseif ( !is_numeric ( $data['homepage_events_limit'] ) )	:
						$events_limit = '3';
					else :
						$events_limit = '3';
					endif;
				?>
				
				<?php // Begin Events Query
				$today = date('Y-m-d');
				
				$event_query = new WP_query(array(
					'post_type' => 'event',
					'posts_per_page' => $events_limit,
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
				));

		    	while ( $event_query->have_posts() ) : $event_query->the_post(); ?>

						<?php // Get event date
							$e_date = get_post_meta($post->ID, $prefix.'event_date', true);
							if ( $e_date !== '' ) { 
								$event_date_string = $e_date;
								$event_monthM = mysql2date( 'M', $event_date_string );
								$event_day = mysql2date( 'd', $event_date_string );
								$event_month = apply_filters('get_the_date', $event_monthM, 'M');
							}
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
							
						</div>

					<?php endwhile;

					// Reset Post Data
					wp_reset_postdata();

					?>

			</div>
		</div>
		
	<?php endif; ?>
		
	<!-- END #content -->
	</div>
	
<?php get_footer(); ?>