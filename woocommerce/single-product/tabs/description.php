<?php
/**
 * Description tab
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;
global $product;

$heading = esc_html( apply_filters( 'woocommerce_product_description_heading', __( 'Product Description', 'woocommerce' ) ) );

?>


	<div class="left">
		<h5><?php the_title(); ?></h5>
		<?php the_content(); ?>
		<h5><?php the_field('materials') ?></h5>
		<p><?php the_field('care_instructions') ?></p>
	
	</div>
	
	<div class="right">
		
		<div class="characteristics">
		<?php $options = get_field_object('characteristics');
		$values = get_field('characteristics');
		if ($values) {
			foreach ($values as $value) { ?>
				<li class="characteristic">
					<img src="<?php echo get_template_directory_uri(); ?>/images/<?php echo $value ?>" alt="">
					<span><?php echo $options['choices'][$value] ?></span>
				</li>	
			<?php }
		} ?>
		
	
	
	</div>


</div>
