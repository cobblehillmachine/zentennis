<?php
/**
 * @package WordPress
 * @subpackage zentennis
 */

// removes admin bar on wordpress home
add_filter( 'show_admin_bar', '__return_false' );

// Add Favicon //
function diww_favicon() {
	echo '<link rel="shortcut icon" type="image/x-icon" href="' . get_site_url() . '/favicon.ico" />';
}
add_action('wp_head', 'diww_favicon');
add_action('admin_head', 'diww_favicon');

// pulls in logo for wp admin
function my_login_logo() { ?>
  <style type="text/css">
      body.login div#login h1 a {
          background-image: url(<?php echo get_bloginfo( 'template_directory' ) ?>/images/full-lockup-horizontal-logo.png);
          background-size:contain;
          width: auto;
          height: 90px;
      }
  </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

// ENQUEUE CSS, LESS, & SCSS STYLESHEETS
function add_style_sheets() {
	if( !is_admin() ) {
		wp_enqueue_style( 'reset', get_template_directory_uri().'/style.css', 'screen'  );
		wp_enqueue_style( 'font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css', 'screen');
		wp_enqueue_style( 'main', get_template_directory_uri().'/css/style.less', 'screen' );
		wp_enqueue_style( 'flexslider', get_template_directory_uri().'/css/flexslider.css', 'screen' );
	}
}
add_action('wp_enqueue_scripts', 'add_style_sheets');

/**
 *
 * TAKE GLOBAL DESCRIPTION OUT OF HEADER.PHP AND GENERATE IT FROM A FUNCTION
 *
 */
function site_global_description()
{
	global $page, $paged;
	wp_title( '|', true, 'right' );
	bloginfo( 'name' );
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
	{
		echo " | $site_description";
	}
}


/**
 * REMOVE UNWANTED CAPITAL <P> TAGS
 */
remove_filter( 'the_content', 'capital_P_dangit' );
remove_filter( 'the_title', 'capital_P_dangit' );
remove_filter( 'comment_text', 'capital_P_dangit' );


/**
 * REGISTER NAV MENUS FOR HEADER FOOTER AND UTILITY
 */
register_nav_menus( array(
	'primary' => __( 'Primary Menu', 'themename' ),
	'footer' => __( 'Footer Menu', 'themename' ),
	'utility' => __( 'Utility Menu', 'themename' )
) );


/** 
 * DEFAULT COMMENTS & RSS LINKS IN HEAD
 */
add_theme_support( 'automatic-feed-links' );


/**
 * THEME SUPPORTS THUMBNAILS
 */
add_theme_support( 'post-thumbnails' );


/**
 *	THEME SUPPORTS EDITOR STYLES
 */
add_editor_style("/css/layout-style.css");


/**
 *	ADD TINY IMAGE SIZE FOR ACF FIELDS, BETTER USABILITY
 */
add_image_size( 'mini-thumbnail', 50, 50 );


/**
 *	REPLACE THE HOWDY
 */
function admin_bar_replace_howdy($wp_admin_bar) 
{
    $account = $wp_admin_bar->get_node('my-account');
    $replace = str_replace('Howdy,', 'Welcome,', $account->title);            
    $wp_admin_bar->add_node(array('id' => 'my-account', 'title' => $replace));
}
add_filter('admin_bar_menu', 'admin_bar_replace_howdy', 25);


// custom post type
add_action( 'init', 'create_post_type' );
function create_post_type() {

	$args1 = array(
		'labels' => array(
			'name' => __( 'Benefits of Bamboo' ),
			'singular_name' => __( 'Benefit of Bamboo' )
		),
		'public' => true,
		'menu_icon' => 'dashicons-smiley',
		'exclude_from_search' => true,
		'rewrite' => array('with_front' => false, 'slug' => 'benefits-of-bamboo'),
		'supports' => array( 'title', 'editor' )
	);
  	register_post_type( 'Benefits of Bamboo', $args1);

  	$args2 = array(
		'labels' => array(
			'name' => __( 'Environmental' ),
			'singular_name' => __( 'Environmental' )
		),
		'public' => true,
		'menu_icon' => 'dashicons-admin-site',
		'exclude_from_search' => true,
		'rewrite' => array('with_front' => false, 'slug' => 'environmental'),
		'supports' => array( 'title', 'editor', 'thumbnail')
	);
  	register_post_type( 'Environmental', $args2);
  	
  	$args3 = array(
		'labels' => array(
			'name' => __( 'Ambassadors' ),
			'singular_name' => __( 'Ambassador' )
		),
		'public' => true,
		'menu_icon' => 'dashicons-groups',
		'exclude_from_search' => true,
		'rewrite' => array('with_front' => false, 'slug' => 'ambassadors'),
		'supports' => array( 'title', 'editor', 'thumbnail')
	);
  	register_post_type( 'Ambassadors', $args3);

  	flush_rewrite_rules();
}



// WOOCOMMERCE

add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );


//disable reviews for products
add_filter( 'woocommerce_product_tabs', 'wcs_woo_remove_reviews_tab', 98 );
function wcs_woo_remove_reviews_tab($tabs) {
	unset($tabs['reviews']);
	return $tabs;
}

add_action( 'pre_get_posts', 'custom_pre_get_posts_query' );

function custom_pre_get_posts_query( $q ) {

	if ( ! $q->is_main_query() ) return;
	if ( ! $q->is_post_type_archive() ) return;
	
	if ( ! is_admin() && is_shop() ) {

		$q->set( 'tax_query', array(array(
			'taxonomy' => 'product_cat',
			'field' => 'slug',
			'terms' => array( 'designers picks' ), 
			'operator' => 'IN'
		)));
	
	}

	remove_action( 'pre_get_posts', 'custom_pre_get_posts_query' );

}

add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 16;' ), 20 );


// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);


// function my_post_queries( $query ) {
// 	// do not alter the query on wp-admin pages and only alter it if it's the main query
// 	if (!is_admin() && $query->is_main_query()){

// 		if(is_category()){

// 			$query->set('paged', get_query_var('paged'));
// 			$query->set('posts_per_page', 3);
// 		}

// 	}
// }
// add_action( 'pre_get_posts', 'my_post_queries' );

// customize breadcrumbs
add_action( 'init', 'jk_remove_wc_breadcrumbs' );
function jk_remove_wc_breadcrumbs() {
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}

//single product page reorganization
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);


add_action('woocommerce_after_single_product', 'woocommerce_output_product_data_tabs', 10);

add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

function woo_remove_product_tabs( $tabs ) {

    unset( $tabs['reviews'] ); 			// Remove the reviews tab
    unset( $tabs['additional_information'] );  	// Remove the additional information tab

    return $tabs;

}

add_filter("woocommerce_checkout_fields", "order_fields");

function order_fields($fields) {
	$fields['billing']['billing_first_name']['class'][3] = 'third first';
	$fields['billing']['billing_last_name']['class'][3] = 'third';
	$fields['billing']['billing_address_1']['class'][3] = 'half first';
	$fields['billing']['billing_address_2']['class'][3] = 'half last';
	$fields['billing']['billing_city']['class'][3] = 'third first';
	$fields['billing']['billing_state']['class'][3] = 'third ';
	$fields['billing']['billing_postcode']['class'][3] = 'third last';
	$fields['billing']['billing_country']['class'][3] = 'third first';
	$fields['billing']['billing_phone']['class'][3] = 'third';
	$fields['billing']['billing_email']['class'][3] = 'third first email';

	$fields['shipping']['shipping_first_name']['class'][3] = 'third first';
	$fields['shipping']['shipping_last_name']['class'][3] = 'third';
	$fields['shipping']['shipping_address_1']['class'][3] = 'half first';
	$fields['shipping']['shipping_address_2']['class'][3] = 'half last';
	$fields['shipping']['shipping_city']['class'][3] = 'third first';
	$fields['shipping']['shipping_state']['class'][3] = 'third ';
	$fields['shipping']['shipping_postcode']['class'][3] = 'third last';
	$fields['shipping']['shipping_country']['class'][3] = 'third first';
	$fields['order']['order_comments']['class'][3] = 'two-thirds';

	$fields['billing']['billing_state']['options'] = array(
		'option_1' => 'Option 1 text',
		'option_2' => 'Option 2 text'
	);

	$fields['billing']['billing_city']['label'] = $fields['shipping']['shipping_city']['label'] = 'City';
	$fields['billing']['billing_city']['placeholder'] = $fields['shipping']['shipping_city']['placeholder'] = '';

	$fields['billing']['billing_address_1']['label'] = $fields['shipping']['shipping_address_1']['label'] = 'Street Address';
	$fields['billing']['billing_address_1']['placeholder'] = $fields['shipping']['shipping_address_1']['placeholder'] = '';

	$fields['billing']['billing_address_2']['label'] = $fields['shipping']['shipping_address_2']['label'] = 'Street Address 2';
	$fields['billing']['billing_address_2']['placeholder'] = $fields['shipping']['shipping_address_2']['placeholder'] = '';
	$fields['billing']['billing_address_2']['required'] = $fields['shipping']['shipping_address_2']['required'] = false;
	
	$fields['billing']['billing_postcode']['label'] = $fields['shipping']['shipping_postcode']['label'] = 'Postal Code';
	$fields['billing']['billing_postcode']['placeholder'] = $fields['shipping']['shipping_postcode']['placeholder'] = '';
	$fields['billing']['billing_postcode']['clear'] = $fields['shipping']['shipping_postcode']['clear'] = false;

	$fields['billing']['billing_phone']['clear'] = false;



	$billing = array(
		"billing_first_name",
		"billing_last_name",
		"billing_address_1",
		"billing_address_2",
		"billing_city",
		"billing_state",
		"billing_postcode",
		"billing_country",
		"billing_phone",
		"billing_email"

	);

	$shipping = array(
		"shipping_first_name",
		"shipping_last_name",
		"shipping_address_1",
		"shipping_address_2",
		"shipping_city",
		"shipping_state",
		"shipping_postcode",
		"shipping_country"
	);

	foreach( $billing as $field )
	{
		$billing_fields[$field] = $fields["billing"][$field];
	}

	foreach( $shipping as $field )
	{
		$shipping_fields[$field] = $fields["shipping"][$field];
	}

	$fields["billing"] = $billing_fields;
	$fields["shipping"] = $shipping_fields;

	return $fields;

}

add_filter( 'default_checkout_country', 'change_default_checkout_country' );
 
function change_default_checkout_country() {
  return 'US'; // country code
}

function custom_excerpt_length( $length ) {
	return 15;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function new_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

function wps_highlight_results($text){
     if(is_search()){
	     $sr = get_query_var('s');
	     $keys = explode(" ",$sr);
	     foreach ($keys as $key) {
	     	$text = str_ireplace($key, '<strong class="search-excerpt">'.$key.'</strong>', $text);
	     }
     }
     return $text;
}
add_filter('the_excerpt', 'wps_highlight_results');
add_filter('the_title', 'wps_highlight_results');


if ( ! function_exists( 'woocommerce_template_loop_add_to_cart' ) ) {

  function woocommerce_template_loop_add_to_cart() {
    global $product;

    if ($product->product_type == "variable" && (is_product() || is_product_category() || is_product_tag())) {
      woocommerce_variable_add_to_cart();
    }
    else {
      woocommerce_get_template( 'loop/add-to-cart.php' );
    }
  }

}

add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
