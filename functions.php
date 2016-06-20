<?php


add_theme_support( 'post-thumbnails' );
// NAVIGATION
function register_my_menu() {
  register_nav_menu('header-menu',__( 'Header Menu' ));
}
add_action( 'init', 'register_my_menu' );

// REST
function rest_theme_scripts() {
	wp_enqueue_style( 'normalize', get_template_directory_uri() . '/assets/normalize.css', false, '3.0.3' );
	wp_enqueue_style( 'style', get_template_directory_uri() . '/rest-theme/dist/style.css', array( 'normalize' ) );

	$base_url  = esc_url_raw( home_url() );
	$base_path = rtrim( parse_url( $base_url, PHP_URL_PATH ), '/' );

	wp_enqueue_script( 'rest-theme-vue', get_template_directory_uri() . '/rest-theme/dist/build.js', array(), '1.0.0', true );

	wp_localize_script( 'rest-theme-vue', 'wp', array(
		'root'      => esc_url_raw( rest_url() ),
		'base_url'  => $base_url,
		'base_path' => $base_path ? $base_path . '/' : '/',
    'theme_path' => get_template_directory_uri(),
		'nonce'     => wp_create_nonce( 'wp_rest' ),
		'site_name' => get_bloginfo( 'name' ),
		'routes'    => rest_theme_routes(),
	) );
}

add_action( 'wp_enqueue_scripts', 'rest_theme_scripts' );

function rest_theme_routes() {
	$routes = array();

	$query = new WP_Query( array(
		'post_type'      => ['page'],
		'post_status'    => 'publish',
		'posts_per_page' => -1,
	) );
	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			$routes[] = array(
				'id'   => get_the_ID(),
				'type' => get_post_type(),
				'slug' => basename( get_permalink() ),
			);
		}
	}
	wp_reset_postdata();

	return $routes;
}


// QUERY
function my_json_prepare_term( $data, $term, $context ) {
	global $wp_query;
	$route = $wp_query->query['json_route'];
	if ( ! preg_match( '/(terms\/.+)/', $route) )
		return $data;
	$args = array(
		'tax_query' => array(
			array(
				'taxonomy' => $term->taxonomy,
				'field' => 'slug',
				'terms' => $term->slug
			)
		),
		'posts_per_page' => 5
	);
	$posts = get_posts( $args );
	$posts_arr = array();
	foreach ( $posts as $p ) {
		$posts_arr[] = array(
			'ID' => $p->ID,
			'title' => $p->post_title
			);
	}
	$data['posts'] = $posts_arr;
	return $data;
}
add_filter( 'json_prepare_term', 'my_json_prepare_term', 10, 3 );


function my_rest_prepare_post( $data, $post, $request ) {
	$_data = $data->data;
	$thumbnail_id = get_post_thumbnail_id( $post->ID );
	$thumbnail = wp_get_attachment_image_src( $thumbnail_id );
	$_data['featured_image_thumbnail_url'] = $thumbnail[0];
	$data->data = $_data;
	return $data;
}
add_filter( 'rest_prepare_post', 'my_rest_prepare_post', 10, 3 );
