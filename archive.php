<?php get_header(); ?>
<div class="blog">
	<div class="blog-header">
		<h4>BLOG</h4>
		<h1>WAY OF THE ZEN</h1>
	</div>	
	<div class="category-sort">
		<span>SORT BY</span><?php wp_dropdown_categories(array('hide_empty' => 0, 'exclude' => 1, 'show_option_all' => "Show All")); ?>
		<script type="text/javascript">
			var dropdown = document.getElementById("cat");
			function onCatChange() {
				if ( dropdown.options[dropdown.selectedIndex].value > 0 ) {
					location.href = "<?php echo esc_url( home_url( '/' ) ); ?>?cat="+dropdown.options[dropdown.selectedIndex].value;
				}
			}
			dropdown.onchange = onCatChange;
		</script>
	</div>
	<div class="blog-feed mid-cont mobile-cont">
		<?php $cur_cat_id = get_cat_id( single_cat_title("",false) );
		query_posts( array(  'post_type' => 'post', 'cat' => $cur_cat_id, 'posts_per_page' => 3, 'order' => 'ASC' ) );
		if ( have_posts() ) :
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