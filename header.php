<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
	<![endif]-->
	<script>(function(){document.documentElement.className='js'})();</script>
	<script src="//use.typekit.net/zsg4ejb.js"></script>
	<script>try{Typekit.load();}catch(e){}</script>
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	
	  ga('create', 'UA-66579423-1', 'auto');
	  ga('send', 'pageview');
	
	</script>
	<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
	<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.flexslider.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/instafeed.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/retina.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/general.js"></script>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<header class="">
		<div class="mobile-header">
<!-- 			<a href="/" class="logo-wrapper"><img class="logo" src="<?php echo get_template_directory_uri(); ?>/images/triangle-logo.png"></a> -->
			<div class="skinny">
				<div class="nav">
					<a href="/" class="logo-wrapper"><img class="logo" src="<?php echo get_template_directory_uri(); ?>/images/triangle-logo.png"></a>
					<div class="center-cont"><a href="/" class="skinny-logo-wrapper">ZEN TENNIS</a></div>
					<a id="nav-toggle" href="#"><img class="hamburger active" src="<?php echo get_template_directory_uri(); ?>/images/hamburger.png"><img class="close" src="<?php echo get_template_directory_uri(); ?>/images/close.png"></a>
				</div>
				<div class="side-nav">
					<a href="/cart" class="cart-wrapper"><img class="cart" src="<?php echo get_template_directory_uri(); ?>/images/cart-icon.png"></a>
					<span class="magnifying-glass-wrapper"><img class="magnifying-glass" src="<?php echo get_template_directory_uri(); ?>/images/magnifying-glass-icon.png"></span>
				</div>
			</div>
			<div class="dropdown-nav">
				<?php wp_nav_menu(array('menu' => 'Main Nav - Part 1'))  ?>
				<?php wp_nav_menu(array('menu' => 'Main Nav - Part 2')) ?>
			</div>
			<div class="dropdown-search">
				<?php get_search_form( true ); ?>
			</div>

		</div>
		<div class="desktop-header mid-cont">
			<?php wp_nav_menu(array('menu' => 'Main Nav - Part 1'))  ?>
			<a href="/" class="logo-wrapper"><img class="logo" src="<?php echo get_template_directory_uri(); ?>/images/triangle-logo.png"></a>
			<?php wp_nav_menu(array('menu' => 'Main Nav - Part 2')) ?>
			
		</div>
		<div class="side-nav desktop">
			<a href="/cart" class="cart-wrapper"><img class="cart" src="<?php echo get_template_directory_uri(); ?>/images/cart-icon.png"></a>
			<div class="search">
				<img class="magnifying-glass" src="<?php echo get_template_directory_uri(); ?>/images/magnifying-glass-icon.png">
				<?php get_search_form( true ); ?>
			</div>
		</div>
		
	</header>
	<?php if (!is_home()) { ?>
		<div class="hero">
			<?php if (is_product_category()) {
				global $wp_query;
				$cat = $wp_query->get_queried_object();
				$thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
				$image = wp_get_attachment_url( $thumbnail_id ); ?>
				<img src="<?php echo $image ?>" alt="" width="762" height="365" />

			<?php } else if (is_product()) { ?>
				<?php $image = get_field('hero_image'); 
				if ($image) { ?>
					<img src="<?php echo $image ?>" alt="" width="762" height="365" />
				<?php } else { ?>
					<span class="no-hero"></span>
				<?php } ?>
			<?php } else if (is_archive() || is_single()) { 
				echo get_the_post_thumbnail('21','full'); 
	
			} else {
				
					the_post_thumbnail('full'); 
		
				
			} ?>
		</div>
	<?php } ?>
