<?php 

/* 
Template Name: Photo Gallery 
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

				<?php
					if ( $data['custom_page_limit'] ) {
						$gallery_perpage = $data['custom_page_limit'];
					}
					else {
						$gallery_perpage = '10';
					}
					
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;	
					query_posts( "post_type=gallery&posts_per_page=$gallery_perpage&paged=$paged" );

					if( have_posts() ) :
					$c = 0;while (have_posts()) : the_post(); $c++; ?>

						<?php
						$col_number = 4;
						$col_type = 'one-forth';
						
						if( $c == $col_number) {
							$last_col = ' last-col';
							$c = 0;
						}
						else $last_col='';
						?>
						
						<div class="<?php echo $col_type . $last_col; ?>">
							
							<!-- BEGIN .gallery-item -->
							<div class="gallery-item">
								
								<!-- BEGIN .gallery-thumbnail -->
								<div class="gallery-thumbnail">
									
									<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">	
										
										<span class="zoom-wrapper">
											<span class="zoom"></span>
										</span>
			
										<?php // if has an image
											if( has_post_thumbnail() ) :	
											// Get the Thumbnail URL
											the_post_thumbnail( 'photo-gallery' );
										?>
									
										<?php // if not display a default image
											else : ?>
											<img src="<?php echo get_template_directory_uri(); ?>/images/temp-gallery1.jpg" alt=""/>
										<?php endif; ?>
										
									</a>
								
								<!-- END .gallery-thumbnail -->
								</div>

								<h4><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>

							<!-- END .gallery-item -->
							</div>
						
						<!-- END .section -->
						</div>
						
					<?php endwhile; endif; ?>

				<?php // Include Pagination feature
					load_template( TEMPLATEPATH . '/includes/pagination.php' );
				?>
			
		</div>
		
	<!-- END #content -->
	</div>

<?php get_footer(); ?>