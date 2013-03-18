<?php 
	// Fetch options stored in $data
	global $data; 
?>

<!DOCTYPE html>
<!--[if lt IE 7]> <html <?php language_attributes(); ?> class="ie6"> <![endif]-->
<!--[if IE 7]>    <html <?php language_attributes(); ?> class="ie7"> <![endif]-->
<!--[if IE 8]>    <html <?php language_attributes(); ?> class="ie8"> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->

<!-- BEGIN head -->
<head>

	<!-- Meta Tags -->
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=Edge;chrome=1" >
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
	
	<!-- Title -->
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	
	<!-- Stylesheets -->
	<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>" type="text/css"  media="all"  />
	
	<?php // Load Google Fonts
		echo google_fonts();
	?>
	
	<?php // Load Custom CSS 
		echo custom_css(); 
	?>
	
	<!-- RSS Feeds & Pingbacks -->
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
	<?php wp_head() ?>

<!-- END head -->
</head>

<!-- BEGIN body -->
<body <?php body_class(); ?>>

	<!-- BEGIN #header -->
	<div id="header">
		
		<div id="header-inner">
		
		<!-- BEGIN #top-bar -->
		<div id="top-bar" class="clearfix">

			<?php //Only load top bar if there is a secondary menu or social icons to put in it
			if ( has_nav_menu( 'secondary' ) or no_icons() !== true ) { ?>
						
			<div class="top-inner">
				
				<?php echo display_social(); ?>
				
				<?php if ( has_nav_menu( 'secondary' ) ) { ?>
				
					<!-- Secondary Menu -->
					<?php wp_nav_menu( array(
						'theme_location' => 'secondary',
						'container' =>false,
						'items_wrap' => '<ul class="top-menu fr">%3$s</ul>',
						'echo' => true,
						'before' => '',
						'after' => '<span>/</span>',
						'link_before' => '',
						'link_after' => '',
						'depth' => 0 )
				 	); ?>
				
				<?php } ?>
			
			</div>
			
			<?php } ?>

		<!-- END #top-bar -->
		</div>
		
		<div class="title-wrapper clearfix">
		
			<?php if( $data['text_logo'] ) : ?>
				<div id="title" class="fl">
					<h1>
						<a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ) ?></a>
						<span id="tagline"><?php bloginfo( 'description' ) ?></span>
					</h1>
				</div>

			<?php elseif( $data['image_logo'] ) : ?>
				<div id="title" class="fl">
					<h1>
						<a href="<?php echo home_url(); ?>"><img src="<?php echo $data['image_logo']; ?>" alt="" /></a>
						<span id="tagline" <?php echo tagline_position(); ?>><?php bloginfo( 'description' ) ?></span>
					</h1>
				</div>

			<?php else : ?>	
				<div id="title" class="fl">
					<h1>
						<a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ) ?></a>
						<span id="tagline"><?php bloginfo( 'description' ) ?></span>
					</h1>
				</div>
			<?php endif ?>
			
			<?php // Display Donate Button
				if( $data['donate-btn'] ) {
					if( !$data['donate-btn-text'] ) { $donate_text = 'Donate Now+'; }
					else { $donate_text = $data['donate-btn-text']; }
			?>
				
				<div class="donate-btn fr" <?php echo donate_position(); ?>>
					<div class="donate-left"></div>
						<a href="<?php echo $data['donate-btn-url']; ?>" class="donate-mid"><span><?php echo $donate_text; ?></span></a>
					<div class="donate-right">
						<div class="donate-right-inner"></div>
					</div>
				</div>
			<?php } ?>

		</div>	
		
		<div id="main-menu-wrapper" class="clearfix">
			
			<!-- Main Menu -->
			<?php wp_nav_menu( array(
				'theme_location' => 'primary',
				'container' =>false,
				'items_wrap' => '<ul id="main-menu" class="fl">%3$s</ul>',
				'fallback_cb' => 'wp_page_menu_qns',
				'echo' => true,
				'before' => '',
				'after' => '',
				'link_before' => '',
				'link_after' => '',
				'depth' => 0 )
			 ); ?>
			
			<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" id="menu-search" class="fr search">
				<input type="text" onblur="if(this.value=='')this.value='<?php _e('Search...', 'qns') ?>';" onfocus="if(this.value=='<?php _e('Search...', 'qns') ?>')this.value='';" value="<?php _e('Search...', 'qns') ?>" name="s" />
			</form>
			
		</div>
	
		<!-- END #header-inner -->
		</div>
	
	<!-- END #header -->
	</div>