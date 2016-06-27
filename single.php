<?php get_header(); ?>
<div class="blog">
	<div class="blog-header">
		<h4>VIDEOS</h4>
		<h1>WAY OF THE ZEN</h1>
	</div>	
	<div class="blog-feed mid-cont mobile-cont single">
		<?php if ( have_posts() ) :
			while ( have_posts() ) : the_post();?>
		
			<div class="blog-post">
			 	<?php the_category(); ?>
				<a href="<?php the_permalink() ?>"><h3><?php the_title(); ?></h3></a>
				<?php the_content(); ?>
			</div>
		<?php endwhile; wp_reset_query();
		
		else :
			get_template_part( 'content', 'none' );
		endif; ?>
	</div>
</div>
<?php get_footer(); ?>