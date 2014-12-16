<?php
/* Modify buttons for the TinyMCE editor */
add_filter('mce_buttons_2', 'weaveriiforbes_tinymce_buttons');
function weaveriiforbes_tinymce_buttons($buttons) {
	$remove = array('forecolor','underline','justifyfull','alignjustify');
        $add = array();

	return array_diff($buttons,$remove) + $add;
}

/* Add custom CSS to the editor */
add_action( 'init', 'my_theme_add_editor_styles' );
function my_theme_add_editor_styles() {
    add_editor_style( 'custom-editor-style.css' );
}

/* Change default linking behavior for inserted images */
update_option('image_default_link_type','none');

/* Fix for broken search pagination */
function weaverii_get_paginate_archive_page_links( $type = 'plain', $endsize = 1, $midsize = 1 ) {
				global $wp_query, $wp_rewrite;

		$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

		// Sanitize input argument values
		if ( ! in_array( $type, array( 'plain', 'list', 'array' ) ) ) $type = 'plain';
		$endsize = (int) $endsize;
		$midsize = (int) $midsize;

		$big = 999999999;       // from codex - an unlikely number, then str_replace. Makes archive no permalinks work

		if (is_search()) { // works for search on non-permalinks...
			$base = '%_%';
		} else {
			$base = str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) );
		}

		// Setup argument array for paginate_links()
		$pagination = array(
				'base' =>  $base,
				'format' => '?paged=%#%',
				'total' => $wp_query->max_num_pages,
				'current' => $current,
				'show_all' => false,
				'end_size' => $endsize,
				'mid_size' => $midsize,
				'type' => $type,
				'prev_text' => '&lt;&lt;',
				'next_text' => '&gt;&gt;'
		);

		if ( !empty($wp_query->query_vars['s']) ) { // Here's the fix!
		    $search_string = get_query_var( 's' );
		    $search_string = str_replace(' ', '+', $search_string);
				$pagination['add_args'] = array( 's' => $search_string );
		}
		
		return paginate_links( $pagination );
}


// We have modified the breadcrumbs to always show parent page, regardless of the template
// (By default we sometimes saw a category instead)
function weaverii_breadcrumb($echo = true, $wrap = 'breadcrumbs') {
	$bc = '';

	$containerBefore = '<span id="' . $wrap . '">';
	$containerAfter = '</span>';
	$containerCrumb = '<span class="crumbs">';
	$containerCrumbEnd = '</span>';
	$delimiter = '&rarr;'; //' &raquo; ';
	$name = weaverii_getopt('wii_info_home_label') ? weaverii_getopt('wii_info_home_label') : __('Home','weaver-ii'); //text for the 'Home' link
	$blogname = weaverii_getopt('wii_info_blog_label') ? weaverii_getopt('wii_info_blog_label') : __('Blog','weaver-ii'); //text for the 'Blog' link
	$baseLink = '';
	$hierarchy = '';
	$currentLocation = '';
	$currentBefore = '<span class="bcur-page">';
	$currentAfter = '</span>';
	$currentLocationLink = '';
	$crumbPagination = '';

	global $post;

	$bc = '';
	// Output the Base Link
	if (is_front_page() ) {
		$bc .= $currentBefore . $name . $currentAfter;
	} else {
		$home = home_url('/');
		$baseLink =  '<a href="' . $home . '">' . $name . '</a>';
		$bc .= $baseLink;
	}
	// If static Page as Front Page, and on Blog Posts Index
	if ( is_home() && ( 'page' == get_option( 'show_on_front' ) ) ) {
		$bc .= $delimiter . $currentBefore . $blogname . $currentAfter;
	}
	// Weaver II mod: check 'page_for_posts' when using PwP without setting blog host page
	// If static Page as Front Page, and on Blog, output Blog link
	if ( ! is_home() && ! is_page() && ! is_front_page() && ( 'page' == get_option( 'show_on_front' ) ) && get_option( 'page_for_posts' ) ) {
		$blogpageid = get_option( 'page_for_posts' );
		$bloglink = '<a href="' . get_permalink( $blogpageid ) . '">' .  $blogname . '</a>';
		$bc .= $delimiter . $bloglink;
	}

	// Define Category Hierarchy Crumbs for Category Archive
        if ( is_category() && !$post->post_parent ) { // Weaver II Forbes custimization this line
		global $wp_query;
		if (is_object($wp_query->get_queried_object())) {
			$cat_obj = $wp_query->get_queried_object();
			$thisCat = $cat_obj->term_id;
			$thisCat = get_category($thisCat);
			$parentCat = get_category($thisCat->parent);
			if ($thisCat->parent != 0) {
				$hierarchy = ( $delimiter . __( 'Categories','weaver-ii') . ' ' . get_category_parents( $parentCat, TRUE, $delimiter ) );
			} else {
				$hierarchy = $delimiter . __( 'Categories','weaver-ii') . ' ';
			}
		} else {
			$hierarchy = '';
		}
		// Set $currentLocation to the current category
		$currentLocation = single_cat_title( '' , FALSE );

	}
	// Define Crumbs for Day/Year/Month Date-based Archives
	elseif ( is_date() ) {
		// Define Year/Month Hierarchy Crumbs for Day Archive
		if  ( is_day() ) {
			$date_string = '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ' . '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ';
			$date_string .= $delimiter . ' ';
			$currentLocation = get_the_time('d');
		}
		// Define Year Hierarchy Crumb for Month Archive
		elseif ( is_month() ) {
			$date_string = '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ';
			$date_string .= $delimiter . ' ';
			$currentLocation = get_the_time('F');
		}
		// Set CurrentLocation for Year Archive
		elseif ( is_year() ) {
			$date_string = '';
			$currentLocation = get_the_time('Y');
		}
		$hierarchy = $delimiter . __( 'Published','weaver-ii') . ' ' . $date_string ;
	}
	// Define Category Hierarchy Crumbs for Single Posts
	elseif ( is_single() && !is_attachment() ) {
		$cats = get_the_category();
		if ($cats)
			$cur_cat = $cats[0];
		else
			$cur_cat = '';
		foreach ($cats as $cat) {
			$children = get_categories( array ('parent' => $cat->term_id ));
			if (count($children) == 0) {
				$cur_cat = $cat;
				break;
			}
		}
		if ($cur_cat) {
			$hierarchy = $delimiter . get_category_parents( $cur_cat, TRUE, $delimiter );
		} else {
			$hierarchy = $delimiter . '';
		}
			// Note: get_the_title() is filtered to output a
			// default title if none is specified
			$currentLocation = get_the_title();

	}
		// Define Category and Parent Post Crumbs for Post Attachments
	elseif ( is_attachment() ) {
		$parent = get_post($post->post_parent);
		$cat_parents = '';
		if ( get_the_category($parent->ID) ) {
			$cat = get_the_category($parent->ID);
			$cat = $cat ? $cat[0] : '';
			$cat_parents = get_category_parents( $cat, TRUE, $delimiter );
		}
		$hierarchy = $delimiter . $cat_parents . '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter;
		// Note: Titles are forced for attachments; the
		// filename will be used if none is specified
		$currentLocation = get_the_title();
	}
	// Define Current Location for Parent Pages
	elseif ( ! is_front_page() && is_page() && ! $post->post_parent ) {
		$hierarchy = $delimiter;
		// Note: get_the_title() is filtered to output a
		// default title if none is specified
		$currentLocation = get_the_title();
	}
	// Define Parent Page Hierarchy Crumbs for Child Pages
	elseif ( ! is_front_page() && is_page() && $post->post_parent || (is_category() && $post->post_parent) ) { // Weaver II Forbes custimization this line
		$parent_id  = $post->post_parent;
		$breadcrumbs = array();
		while ($parent_id) {
			$page = get_page($parent_id);
			$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
			$parent_id  = $page->post_parent;
		}
		$breadcrumbs = array_reverse($breadcrumbs);
		foreach ($breadcrumbs as $crumb) {
			$hierarchy = $hierarchy . $delimiter . $crumb;
		}
		$hierarchy = $hierarchy . $delimiter;
		// Note: get_the_title() is filtered to output a
		// default title if none is specified
		$currentLocation = get_the_title();
	}
		// Define current location for Search Results page
	elseif ( is_search() ) {
		$hierarchy = $delimiter . __('Search Results','weaver-ii') . ' ';
		$currentLocation = get_search_query();
	}
		// Define current location for Tag Archives
	elseif ( is_tag() ) {
		$hierarchy = $delimiter . __( 'Tags','weaver-ii') . ' ';
		$currentLocation = single_tag_title( '' , FALSE );
	}
		// Define current location for Author Archives
	elseif ( is_author() ) {
		$hierarchy = $delimiter . __( 'Author','weaver-ii') . ' ';
		$currentLocation = get_the_author_meta( 'display_name', get_query_var( 'author' ) );
	}
		// Define current location for 404 Error page
	elseif ( is_404() ) {
		$hierarchy = $delimiter . __( '404','weaver-ii') . ' ';
		$currentLocation = __( 'Page not found','weaver-ii');
	}
		// Define current location for Post Format Archives
	elseif ( get_post_format() && ! is_home() ) {
		$hierarchy = $delimiter . __( 'Post Formats','weaver-ii') . ' ';
		$currentLocation = get_post_format_string( get_post_format() ) . 's';
	}

// Build the Current Location Link markup
	$currentLocationLink = $currentBefore . $currentLocation . $currentAfter;

// Define breadcrumb pagination

// Define pagination for paged Archive pages
	if ( get_query_var('paged') && ! function_exists( 'wp_paginate' )  && !is_category() ) { // Weaver II Forbes custimization this line
	  $crumbPagination = ' - ' . __('Page','weaver-ii') . ' ' . get_query_var('paged');
	}

 // Define pagination for Paged Posts and Pages
	if ( get_query_var('page') ) {
	  $crumbPagination = ' - ' . __('Page','weaver-ii') . ' ' . get_query_var('page') . ' ';
	}

// Output the resulting Breadcrumbs

	$bc .= $hierarchy; // Output Hierarchy
	$bc .= $currentLocationLink; // Output Current Location
	$bc .= $crumbPagination; // Output page number, if Post or Page is paginated

	if (is_rtl()) {
		$list = explode($delimiter,$bc);        // split on the arrow
		$list = array_reverse($list);
		$larrow = '&larr;';
		$bc = implode($larrow,$list);
	}
	// Wrap crumbs
	$bc = $containerBefore . $containerCrumb . $bc . $containerCrumbEnd . $containerAfter;

	if ($echo) echo $bc;
	else return $bc;
	return '';
}
