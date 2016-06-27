<?php get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
<div class="cont-wrapper contact wide-cont mobile-cont">
	<h3><?php the_field('heading'); ?></h3>
	<div class="contact-info">
		<div>
			<h2 class="desktop"><a href="mailto:<?php the_field('email_address', 'user_2') ?>"><?php the_field('email_address', 'user_2') ?></a></h2>
			<h2 class="mobile"><a href="mailto:<?php the_field('email_address', 'user_2') ?>"><?php the_field('email_address_mobile', 'user_2') ?></a></h2>
		</div>
	</div>
	<div href=".cont-wrapper.contact-form" class="smooth-arrow"></div>
</div>
<div class="cont-wrapper contact-form">
	<div class="wide-cont mobile-cont">
		<?php the_content(); ?>
	</div>
</div>
<?php endwhile; wp_reset_query(); ?>
<?php get_footer(); ?>