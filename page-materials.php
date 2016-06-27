<?php get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>	
<div class="cont-wrapper materials">
	<div class="mid-cont mobile-cont conscious-clothing">
		<?php the_content() ?>
	</div>
	<div href=".cont-wrapper.benefits-of-bamboo" class="smooth-arrow"></div>
</div>
<div class="cont-wrapper benefits-of-bamboo materials">
	
	<div class="wide-cont mobile-cont">
		<?php the_field('benefits_of_bamboo_heading') ?>
		<?php query_posts( array( 'post_type' => 'Benefits of Bamboo', 'order' => 'ASC' ) ); ?>
		<?php while ( have_posts() ) : the_post();?>
		 <div class="bamboo-benefit">
			<h5><?php the_title(); ?></h5>
			<?php the_content(); ?>
		 </div>
	  	<?php endwhile; wp_reset_query(); ?>
	</div>
	
</div>

<div class="cont-wrapper materials better-for-planet">
	
	<div class=" wide-cont mobile-cont">
		<?php the_field('better_for_the_planet_heading') ?>
		<?php query_posts( array( 'post_type' => 'Environmental', 'order' => 'ASC' ) ); ?>
		<?php while ( have_posts() ) : the_post();?>
		 <div class="environmental-benefit">
		 	<?php the_post_thumbnail(); ?>
			<h5><?php the_title(); ?></h5>
			<?php the_content(); ?>
		 </div>
	  	<?php endwhile; wp_reset_query(); ?>
	</div>

</div>

<?php endwhile; wp_reset_query(); ?>
<?php get_footer(); ?>