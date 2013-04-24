<?php
/**
 * Wordpress Rest API using PHP SlimFramework
 *
 * @author Asep Bagja Priandana (@bepitulaz)
 */
define('WP_USE_THEMES', false);

require 'vendor/autoload.php';
require '../wp-load.php';

$app = new \Slim\Slim(array(
	'debug' => true,
	'mode' => 'development'
));

$app->setName('Wordpress Rest API');

/**
 * Get the recent post, using pagination
 *
 * @param :paged for showing the content in X page
 */
$app->get('/recent/:paged', function($paged) {
	// wordpress loop
	$wp_query = new WP_Query(array(
			'post_status' => 'publish',
			'paged' => $paged
		));
	
	$response = array();

	if($wp_query->have_posts()) {
		$response['post_count'] = wp_count_posts()->publish;
		$init = 0;
		while($wp_query->have_posts()) {
			$wp_query->the_post();

			$i = $init++;
			$response['posts'][$i]['post_title']   = get_the_title();
			$response['posts'][$i]['post_content'] = get_the_content();
			$response['posts'][$i]['post_author']  = get_the_author();
			$response['posts'][$i]['post_date']    = get_the_date();
		}

		echo json_encode($response);
	} else {
		$response['post_count'] = '0';
		$response['message']    = 'you are looking for nothing';

		echo json_encode($response);
	}

	wp_reset_postdata();
});

/**
 * Get the category in wordpress
 *
 * @param none
 */
$app->get('/category', function() {
	$categories = get_categories();
	
	$response = array();
	$init = 0;
	foreach($categories as $category) {
		$i = $init++;

		$category_id   = get_cat_ID($category->name);
		$category_link = get_category_link($category_id);

		$response['categories'][$i]['category_id']   = $category_id;
		$response['categories'][$i]['category_link'] = $category_link;
		$response['categories'][$i]['category_name'] = $category->name;
	}

	echo json_encode($response);
});

// run the app
$app->run();