<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>


	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="footer-top">
			<img src="<?php echo get_template_directory_uri(); ?>/images/footer-logo.png">
			<div class="social mobile">
				<a target=_blank href="<?php the_field('instagram_link', 'user_2') ?>"><i class="fa fa-instagram"></i></a>
				<a target=_blank href="<?php the_field('facebook_link', 'user_2') ?>"><i class="fa fa-facebook"></i></a>
				<a target=_blank href="http://eepurl.com/bi_u51"><i class="fa fa-envelope"></i></a>
			</div>
			<ul class="footer-nav">

				<li class="desktop"><a href="mailto:<?php the_field('email_address', 'user_2') ?>"><?php the_field('email_address', 'user_2') ?></a></li>
				<?php wp_nav_menu(array('menu' => 'Footer Menu')) ?>
				<li class="mobile"><a href="mailto:<?php the_field('email_address', 'user_2') ?>"><?php the_field('email_address', 'user_2') ?></a></li>
			</ul>
			<div class="social desktop">
				<a target=_blank href="<?php the_field('instagram_link', 'user_2') ?>"><i class="fa fa-instagram"></i></a>
				<a target=_blank href="<?php the_field('facebook_link', 'user_2') ?>"><i class="fa fa-facebook"></i></a>
				<a target=_blank href="http://eepurl.com/bi_u51"><i class="fa fa-envelope"></i></a>
			</div>
		</div>
		<div class="footer-bottom mobile-cont">
			<span>&copy;2015 Zen Tennis, All Rights Reserved</span>
			<span><a href="http://cobblehilldigital.com" target=_blank>Site by Cobble Hill</a></span>
			<!--
<div class="signup-form">



				<form action="//findyourzen.us10.list-manage.com/subscribe/post?u=0affcf89966898d971d3e88d7&amp;id=b4ec696c23" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
				    <div id="mc_embed_signup_scroll">
					
						<div class="mc-field-group">
							<label for="mce-EMAIL">Sign up for our mailing list</label>
							<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
						</div>
						<div id="mce-responses" class="clear">
							<div class="response" id="mce-error-response" style="display:none"></div>
							<div class="response" id="mce-success-response" style="display:none"></div>
						</div>
					    <div style="position: absolute; left: -5000px;"><input type="text" name="b_0affcf89966898d971d3e88d7_b4ec696c23" tabindex="-1" value=""></div>
				    </div>
				</form>
				<script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script>
				<script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
			</div>
-->
		</div>
	</footer>

</div>

<?php wp_footer(); ?>

</body>
</html>
