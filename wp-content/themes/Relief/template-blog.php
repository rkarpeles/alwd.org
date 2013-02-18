<?php 

/* 
Template Name: Blog 
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
		
		<!-- BEGIN .blog-list-wrapper -->
		<div class="blog-list-wrapper section clearfix">
			
			<div class="<?php echo sidebar_position('primary-content'); ?>">
				
				<h2 class="title2"><?php _e('Blog', 'qns') ?></h2>

				<?php
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;	
					query_posts( "post_type=post&paged=$paged" );

					if( have_posts() ) : while( have_posts() ) : the_post(); ?>

						<!-- BEGIN .blog-title -->
						<div <?php post_class("blog-title clearfix"); ?>>
							<div class="fl">
								<h3>
									<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
										<?php the_title(); ?>
									</a>						
									<span>
										<?php _e( 'Posted ', 'qns' ) ?>
										<?php the_time('F j, Y'); ?>
										<?php the_tags( __(' | Tagged: ','qns'), ', ' ); ?>
									</span>		
								</h3>
							</div>
							<div class="comment-count fr">
								<h3><?php comments_popup_link( 
									__( '0', 'qns' ), 
									__( '1', 'qns' ), 
									__( '%', 'qns' ), 
									__( '', 'qns' ),
									__( '<span class="comments-off">Off</span>','qns')
								); ?></h3>
								<div class="comment-point"></div>
							</div>
						<!-- END .blog-title -->
						</div>

						<!-- BEGIN .blog-content -->
						<div class="blog-content clearfix">

							<?php if( has_post_thumbnail() ) { ?>
							<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
								<?php // Get the Thumbnail URL
									$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'blog-thumb-large' );
									echo '<img src="' . $src[0] . '" alt="" class="prev-image"/>';
								?>
							</a>
							<?php } ?>

							<?php the_excerpt(); ?> 
						<!-- END .blog-content -->
						</div>

					<?php endwhile;
				endif; ?>

				<?php // Include Pagination feature
					load_template( TEMPLATEPATH . '/includes/pagination.php' );
				?>
				
			</div>
			
			<?php get_sidebar(); ?>
		
		<!-- END .blog-list-wrapper -->		
		</div>
		
	<!-- END #content -->
	</div>

<?php get_footer(); ?>