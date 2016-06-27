<?php get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>	
<div class="flexslider homepage">
	<ul class="slides">
		<?php $rows = get_field('slider');
		if ($rows) {
			foreach ($rows as $row) {
				$image = $row["slide_image"];
				$content = $row["slide_content"]; ?>
				<li style="background-image: url(<?php echo $image ?>)">
					<img src="<?php echo $image ?>">
					<?php if ($content) { ?>
						<div class="slider-text">
							<?php echo $content ?>
							<img href=".main-cont.home" class="smooth-arrow mobile" src="<?php echo get_template_directory_uri(); ?>/images/big-white-arrow.png">
						</div>
					<?php } ?>
					<img href=".main-cont.home" class="smooth-arrow desktop" src="<?php echo get_template_directory_uri(); ?>/images/big-white-arrow.png">
				</li>
			<?php } ?>
		<?php } ?>
	</ul>
</div>
<div class="mid-cont mobile-cont main-cont home">
	<?php the_content(); ?>		
</div>
<div class="instagram-wrapper">
	<div id="instafeed"></div>
</div>
		
<?php endwhile; wp_reset_query(); ?>
<?php get_footer(); ?>