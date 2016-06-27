<?php get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
<div class="cont-wrapper about">	
	<div class="mid-cont mobile-cont story">
		<?php the_content() ?>
	</div>
	<div href=".cont-wrapper.founders" class="smooth-arrow"></div>
</div>
<div class="cont-wrapper founders about">
	<div class="mid-cont mobile-cont">
		<div class="founders-wrapper">
			<?php the_field('founders') ?>
		</div>
	</div>
	<div href=".cont-wrapper.ambassadors" class="smooth-arrow black"></div>
</div>
<div class="cont-wrapper about ambassadors flexslider">
	<ul class="slides">
		<?php query_posts( array( 'post_type' => 'Ambassadors', 'order' => 'ASC' ) ); ?>
		<?php while ( have_posts() ) : the_post();?>
		 <li class="ambassador">
		 	<div class="cont">
				<h5>Zen Tennis Ambassador</h5>
				<h3><?php the_title() ?></h3>
			
				<?php the_content(); ?>
			</div>
			<?php the_post_thumbnail() ?>
		 </li>
	  	<?php endwhile; wp_reset_query(); ?>

	</ul>
</div>

<?php endwhile; wp_reset_query(); ?>
<?php get_footer(); ?>