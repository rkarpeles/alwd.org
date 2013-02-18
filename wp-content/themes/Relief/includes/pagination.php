<?php if ( $wp_query->max_num_pages > 1 ) : ?>
	
	<!--BEGIN .pagination_container -->
	<div class="pagination_container">
	
		<?php if( function_exists( 'wp_pagenavi' ) ) { ?>
		
			<?php wp_pagenavi(); ?>

		<?php } else { ?>

			<p class="clearfix">
				<span class="fl"><?php next_posts_link( __( '&larr; Older posts', 'qns' ) ); ?></span>
				<span class="fr"><?php previous_posts_link( __( 'Newer posts &rarr;', 'qns' ) ); ?></span>
			</p>

		<?php } ?>
	
	<!--END .pagination_container -->
	</div>

<?php endif; ?>