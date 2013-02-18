<?php 

/* 
Template Name: Contact Us 
*/ 

?>

<?php 
	// Fetch options stored in $data
	global $data; 
?>

<?php

	// Email Contact Form
	$name_error = '';
	$email_error = '';
	$contact_error = '';
	
	if(isset($_POST['sent'])) {
		
		if(trim($_POST['contact_name']) === '') {
			$name_error = __('(Required)', 'qns');
			$got_error = true;
		} 
	
		else {
			$name = trim($_POST['contact_name']);
		}
		
		if(trim($_POST['email']) === '')  {
			$email_error = __('(Required)', 'qns');
			$got_error = true;
		} 
	
		else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
			$email_error = __('(Invalid email address)', 'qns');
			$got_error = true;
		} 
	
		else {
			$email = trim($_POST['email']);
		}
			
		if(trim($_POST['message']) === '') {
			$contact_error = __('(Required)', 'qns');
			$got_error = true;
		} 
	
		else {
		
			if(function_exists('stripslashes')) {
				$message = stripslashes(trim($_POST['message']));
			} 
		
			else {
				$message = trim($_POST['message']);
			}
		
		}
			
		if(!isset($got_error)) {
		
			$email_to = $data['contact_email'];
		
			if (!isset($email_to) || ($email_to == '') ){
				$email_to = get_option('admin_email');
			}
		
		$subject = get_bloginfo( 'name' ) . __(' Contact Form','qns');
		$body = $message . "\n\n " . __('IP Address','qns') . ": " . $_SERVER['REMOTE_ADDR'];
		$headers = 'From: '.$name.' <'.$email_to.'>' . "\r\n" . 'Reply-To: ' . $email;
			
		mail($email_to, $subject, $body, $headers);
		$emailSent = true;
		
	}
	
} ?>

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
		
		<div class="blog-event-prev-wrapper section clearfix">
			
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
			<div class="<?php echo sidebar_position('primary-content'); ?>">
				<h2 class="title2"><?php the_title(); ?></h2>

				<?php 		
					$street_address = ''; 
					$phone_number = '';
					$email_address = '';
					
					if ( $data['street_address'] ) {
						$street_address = $data['street_address'];
					}
					
					if ( $data['phone_number'] ) {
						$phone_number = $data['phone_number'];
					}
					
					if ( $data['email_address'] ) {
						$email_address = $data['email_address'];
					}	
				?>
				
				<?php // No Content
					if ( $post->post_content == "" ) { $no_the_content = true; } else { $no_the_content = false; }
				?>
				
				<?php // No Contact Details
					if ( !$street_address && !$phone_number && !$email_address ) { $no_details = true; } else { $no_details = false; }
				?>
				
				<?php // Some Contact Details
					if ( $street_address !== '' or $phone_number !== '' or $email_address !== '' ) { $some_details = true; } else { $some_details = false; }
				?>
				
				<?php // No Content, Some Contact Details
					if ( $some_details == true && $no_the_content == true ) { ?>
				 		
						<h4><?php _e ( 'Details','qns' )?></h4>
						
						<!--BEGIN .contact_list -->
						<ul class="contact_list">
							<?php if ( $street_address ) { echo '<li class="address"><span>' . $street_address . '</span></li>'; } ?>
							<?php if ( $phone_number ) { echo '<li class="phone"><span>' . $phone_number . '</span></li>'; } ?>
							<?php if ( $email_address ) { echo '<li class="email"><span>' . $email_address . '</span></li>'; } ?>
						<!--END .contact_list -->
						</ul>
					
				<?php }	?>
				
				<?php // Content, No Contact Details
					if ( $no_details == true && $no_the_content == false ) { 
						the_content(); 
					} ?>
				
				<?php // Content and Contact Details
					if ( $some_details == true && $no_the_content == false ) { ?>
					
					<div class="clearfix">
						<div class="one-half">
							<?php the_content(); ?>
						</div>
							
						<div class="one-half last-col">
							<h4><?php _e ( 'Details','qns' )?></h4>
							
							<!--BEGIN .contact_list -->
							<ul class="contact_list">
								<?php if ( $street_address ) { echo '<li class="address"><span>' . $street_address . '</span></li>'; } ?>
								<?php if ( $phone_number ) { echo '<li class="phone"><span>' . $phone_number . '</span></li>'; } ?>
								<?php if ( $email_address ) { echo '<li class="email"><span>' . $email_address . '</span></li>'; } ?>
							<!--END .contact_list -->
							</ul>
						</div>
					</div>
					
				<?php } ?>
				
				<?php endwhile; endif; ?>
		
				<?php 
					if ( $data['map_address'] ) {
						$map_address = $data['map_address'];
						echo do_shortcode('[googlemap height="250px" marker_address="' . $map_address . '"]');
					}
				?>
		
				<?php 
					if(isset($emailSent) && $emailSent == true) { ?>
			
						<div class="msg success clearfix">
							<p class="fl"><?php _e('Email sent, thank you for contacting us', 'qns') ?></p>
						</div>

					<?php } ?>
			
					<h4><?php _e('Send Us An Email', 'qns') ?></h4>
			
					<form action="<?php the_permalink(); ?>" id="commentform" method="post">

						<div class="field-row">
							<label for="contact_name"><?php _e('Name', 'qns') ?>
								<?php if($name_error != '') { ?>
	        						<span class="error"><?php echo $name_error; ?></span>
								<?php } ?>
							</label>
        					<input type="text" name="contact_name" id="contact_name" class="text_input" value="<?php if(isset($_POST['contact_name'])) echo $_POST['contact_name'];?>" />
						</div>

						<div class="field-row">
							<label for="email"><?php _e('Email', 'qns') ?>
								<?php if($email_error != '') { ?>
									<span class="error"><?php echo $email_error; ?></span>
								<?php } ?>
							</label>
							<input type="text" name="email" id="email" class="text_input" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" />		
						</div>

						<div class="field-row">
							<label for="message_text"><?php _e('Message', 'qns') ?>
								<?php if($contact_error != '') { ?>
									<span class="error"><?php echo $contact_error; ?></span> 
	        						<?php } ?>	
							</label>
							<textarea name="message" id="message_text" class="text_input" cols="60" rows="9"><?php if(isset($_POST['message'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['message']); } else { echo $_POST['message']; } } ?></textarea>
						</div>
				
						<input class="button1" type="submit" value="<?php _e('Send Email', 'qns') ?>" name="submit">
						<input type="hidden" name="sent" value="true" />
				
					</form>

			</div>
			
			<?php get_sidebar(); ?>
						
		</div>
		
	<!-- END #content -->
	</div>

<?php get_footer(); ?>