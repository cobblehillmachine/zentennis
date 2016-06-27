<?php
/**
 * The template for displaying search results pages.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>

<div class=" mid-cont mobile-cont">

	<div class="search-page-form">
		<?php get_search_form( true ); ?>
	</div>

	<div class="search-results-list">
		<?php if ( have_posts() ) : 
			$mySearch =& new WP_Query("s=$s & showposts=-1");
			$NumResults = $mySearch->post_count; ?>
			<h3 class="page-title"><?php printf( __( '%s Results for: <span>%s</span>', 'twentyfifteen' ), $NumResults, get_search_query() ); ?></h3>
			<?php while ( have_posts() ) : the_post(); ?>
			<div class="search-result">
				<a href="<?php the_permalink() ?>">
				<div class="cont">
					<h3><?php the_title(); ?></h3>
					<?php the_excerpt() ?>
				</div>
				<a href="<?php the_permalink() ?>" class='cta'><img src="<?php echo get_template_directory_uri(); ?>/images/big-white-arrow.png"></a>
				</a>
			</div>
			<?php endwhile;

		else :
			get_template_part( 'content', 'none' );
		endif; ?>
	</div>

</div>

<?php get_footer(); ?>
