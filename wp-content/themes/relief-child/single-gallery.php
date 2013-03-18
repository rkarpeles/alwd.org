<?php /* Template Name: Photo Gallery */ ?>

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
		
			<?php // Get Attachments
			$attachments = get_children(array(
				'post_parent'=> $post->ID, 
				'post_status'=>'inherit', 
				'post_type'=> 'attachment', 
				'post_mime_type'=>'image'
			));
			
			// Set Columns
			$columns = 4;
			if ( $columns == 3 ) { $class = 'one-third'; }
			if ( $columns == 4 ) { $class = 'one-forth'; }
			$i = 0;
			
			// Display Attachments
			foreach ( $attachments as $id => $attachment ) {		
				$link = wp_get_attachment_link($id, 'photo-gallery', true); ?>
				
				<?php 
					if( $i == $columns ){ $i = 1; } else { $i++; } 
				?>

				<?php
					if ( $i == $columns ) { $last_col = ' last-col'; }
					else { $last_col = ''; }
				?>

				<div class="<?php echo $class . $last_col; ?>">
					
					<!-- BEGIN .gallery-item -->
					<div class="gallery-item">
						
						<!-- BEGIN .gallery-thumbnail -->
						<div class="gallery-thumbnail">
							
							<?php
								if ( $data['lightbox_album'] ) {
									$lightbox_album = 'prettyPhoto[gallery]';
								}
								else {
									$lightbox_album = 'prettyPhoto';
								}
							?>
							
							<?php
								$large_image_url = wp_get_attachment_image_src( $id, 'large');
								echo '<a href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" rel="' . $lightbox_album . '">';
							?>
		
							<span class="zoom-wrapper">
								<span class="zoom"></span>
							</span>
				
							<?php
								echo $link;	
							?>

							</a>
							
						<!-- END .gallery-thumbnail -->
						</div>

						<h4></h4>

					<!-- END .gallery-item -->
					</div>
					
				</div>

			<?php } ?>
		
		<!-- END .section -->
		</div>
		
	<!-- END #content -->
	</div>

<?php get_footer(); ?>