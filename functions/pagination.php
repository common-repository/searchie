<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function sio_paginator( $posts_per_page, $current_page, $max_page, $first_page_url ){
	// the function works only with $wp_query that's why we must use query_posts() instead of WP_Query()
	//global $wp_query;

	// remove the trailing slash if necessary
	$first_page_url = untrailingslashit( $first_page_url );


	// it is time to separate our URL from search query
	$first_page_url_exploded = array(); // set it to empty array
	$first_page_url_exploded = explode("/?", $first_page_url);
	// by default a search query is empty
	$search_query = '';
	// if the second array element exists
	if( isset( $first_page_url_exploded[1] ) ) {
		$search_query = "/?" . $first_page_url_exploded[1];
		$first_page_url = $first_page_url_exploded[0];
	}

	// get parameters from $wp_query object
	// how much posts to display per page (DO NOT SET CUSTOM VALUE HERE!!!)
	//$posts_per_page = (int) $wp_query->query_vars['posts_per_page'];
	// current page
	//$current_page = (int) $wp_query->query_vars['paged'];
	// the overall amount of pages
	//$max_page = $wp_query->max_num_pages;

	// we don't have to display pagination or load more button in this case
	if( $max_page <= 1 ) return;

	// set the current page to 1 if not exists
	if( empty( $current_page ) || $current_page == 0) $current_page = 1;

	// you can play with this parameter - how much links to display in pagination
	$links_in_the_middle = 4;
	$links_in_the_middle_minus_1 = $links_in_the_middle-1;

	// the code below is required to display the pagination properly for large amount of pages
	// I mean 1 ... 10, 12, 13 .. 100
	// $first_link_in_the_middle is 10
	// $last_link_in_the_middle is 13
	$first_link_in_the_middle = $current_page - floor( $links_in_the_middle_minus_1/2 );
	$last_link_in_the_middle = $current_page + ceil( $links_in_the_middle_minus_1/2 );

	// some calculations with $first_link_in_the_middle and $last_link_in_the_middle
	if( $first_link_in_the_middle <= 0 ) $first_link_in_the_middle = 1;
	if( ( $last_link_in_the_middle - $first_link_in_the_middle ) != $links_in_the_middle_minus_1 ) { $last_link_in_the_middle = $first_link_in_the_middle + $links_in_the_middle_minus_1; }
	if( $last_link_in_the_middle > $max_page ) { $first_link_in_the_middle = $max_page - $links_in_the_middle_minus_1; $last_link_in_the_middle = (int) $max_page; }
	if( $first_link_in_the_middle <= 0 ) $first_link_in_the_middle = 1;

	// begin to generate HTML of the pagination
	$pagination = '<nav id="sio_pagination" class="" role="navigation"><ul class="pagination">';

	// when to display "..." and the first page before it
	if ($first_link_in_the_middle >= 3 && $links_in_the_middle < $max_page) {
		$pagination.= '<li class="page-item"><a href="'. $first_page_url . $search_query . '1" class="page-link page-numbers">1</a></li>';

		if( $first_link_in_the_middle != 2 )
			$pagination .= '<li class="page-item"><a href="#" class="page-link">...</a></li>';

	}

	// arrow left (previous page)
	if ($current_page != 1)
		$pagination.= '<li class="page-item"><a href="'. $first_page_url . $search_query . ($current_page-1) . '" class="prev page-link page-numbers"> Previous </a></li>';

	// loop page links in the middle between "..." and "..."

	for($i = $first_link_in_the_middle; $i <= $last_link_in_the_middle; $i++) {
		if($i == $current_page) {
			$pagination.= '<li class="page-item active"><a href="#" class="page-link">'.$i.'<span class="sr-only">(current)</span> </a></li>';
		} else {
			$pagination .= '<li class="page-item"><a href="'. $first_page_url . $search_query . $i . '" class="page-link page-numbers">'.$i.'</a></li>';
		}
	}

	// arrow right (next page)
	if ($current_page != $last_link_in_the_middle )
		$pagination.= '<li class="page-item"><a href="'. $first_page_url . $search_query . ($current_page+1) . '" class="next page-link page-numbers"> Next </a></li>';


	// when to display "..." and the last page after it
	if ( $last_link_in_the_middle < $max_page ) {

		if( $last_link_in_the_middle != ($max_page-1) )
			$pagination .= '<li class="page-item"><a href="#" class="page-link">...</a></li>';

			$pagination .= '<li class="page-item"><a href="'. $first_page_url . $search_query . $max_page . '" class="page-numbers page-link">'. $max_page .'</a></li>';
	}

	// end HTML
	$pagination.= "</ul></nav>\n";

	// haha, this is our load more posts link
	if( $current_page < $max_page )
		$pagination.= '<div id="sio_loadmore"></div>';

	// replace first page before printing it
	//echo str_replace(array("/page/1?", "/page/1\""), array("?", "\""), $pagination);
	echo $pagination;
}
