<?php
/**
 * Template Name: Template - Generic
 * Description: Generic Sub Page Template
 *
 * @package WordPress
 * @subpackage themename
 */

get_header();the_post(); ?>


<?php if (is_cart()) { ?>
     	<div id="container">
     		<?php echo do_shortcode('[woocommerce_cart]'); ?>
     	</div>
      <?php } else if (is_checkout()) { ?>
      	<div id="container">
	        <?php echo do_shortcode('[woocommerce_checkout]'); ?>
	    </div>
	    <?php } else { ?>
	    <div class="page-generic">
	<div class="header">
		<h2><?php the_title(); ?></h2>
	</div>
	<div class="content">
		<?php the_content(); ?>
	</div>
</div>
<?php } ?>
<?php get_footer(); ?>
