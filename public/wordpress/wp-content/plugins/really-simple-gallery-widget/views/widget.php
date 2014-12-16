<?php
echo $args['before_widget'];

if ( ! empty( $args['title'] ) ) {
	echo $args['before_title'] . $args['title'] . $args['after_title'];
}

do_action( 'rsgw_before_widget' );

// initialize the images array
$images = array();

$post_id = $args['post_id'];

// on single post and option for images from single post on
if ( $args['current_post_images'] && is_singular() ) {
	global $post;
	$post_id = $post->ID;
}

// using full media library
elseif ( 'full_library' == $args['from'] ) {
	// unset the post_id for the next if statement
	$post_id = false;

	$query_images_args = array(
		'post_type' => 'attachment',
		'post_mime_type' => 'image',
		'post_status' => 'inherit',
		'orderby' => $args['orderby'],
		'order' => $args['order'],
		'posts_per_page' => -1,
		'no_found_rows' => true,
	);

	// limited number of images
	if ( 0 != $args['num_images'] ) {
		$query_images_args['posts_per_page'] = $args['num_images'];
	}

	// filter the args used to query for images from the full library
	$query_images_args = apply_filters( 'rsgw_query_args', $query_images_args, $args );

	$query_images = new WP_Query( $query_images_args );

	if ( $query_images->have_posts() ) {
		while( $query_images->have_posts() ) {
			$query_images->the_post();
			global $post;

			$image = wp_get_attachment_image_src( get_the_ID(), $args['image_size'] );
			$image['ID'] = get_the_ID();
			$image['title'] = get_the_title();
			$image['caption'] = $post->post_excerpt;
			$image['parent'] = $post->post_parent;
			$images[] = $image;
		}

		wp_reset_postdata();
	}
}

// using attachment IDs
elseif ( 'ids' == $args['from'] ) {
	// unset the post_id for the next if statement
	$post_id = false;

	$query_images_args = array(
		'post_type' => 'attachment',
		'post_mime_type' => 'image',
		'post_status' => 'inherit',
		'orderby' => $args['orderby'],
		'order' => $args['order'],
		'posts_per_page' => -1,
		'no_found_rows' => true,
	);

	// limited number of images
	if ( 0 != $args['num_images'] ) {
		$query_images_args['posts_per_page'] = $args['num_images'];
	}

	// specified IDs
	$query_images_args['post__in'] = explode( ',', $args['att_ids'] );

	// menu/specified order desired - post__in
	// this will ignore the order arg
	if ( 'menu_order' == $args['orderby'] )
		$query_images_args['orderby'] = 'post__in';

	// filter the args used to query for images from the full library
	$query_images_args = apply_filters( 'rsgw_query_args', $query_images_args, $args );

	$query_images = new WP_Query( $query_images_args );

	if ( $query_images->have_posts() ) {
		while( $query_images->have_posts() ) {
			$query_images->the_post();
			global $post;

			$image = wp_get_attachment_image_src( get_the_ID(), $args['image_size'] );
			$image['ID'] = get_the_ID();
			$image['title'] = get_the_title();
			$image['caption'] = $post->post_excerpt;
			$image['parent'] = $post->post_parent;
			$images[] = $image;
		}

		wp_reset_postdata();
	}
}

// using specific post ID or on single post/page
if ( $post_id ) {
	$query_images_args = array(
		'post_parent' => $post_id,
		'post_status' => 'inherit',
		'post_type' => 'attachment',
		'post_mime_type' => 'image',
		'numberposts' => -1,
		'orderby' => $args['orderby'],
		'order' => $args['order'],
	);

	// limited number of images
	if ( 0 != $args['num_images'] ) {
		$query_images_args['numberposts'] = $args['num_images'];
	}

	// filter the args used to query for images from a single specified post
	$query_images_args = apply_filters( 'rsgw_query_args', $query_images_args, $args );

	$attachments = get_children( $query_images_args );

	if ( ! empty( $attachments ) ) {
	  	foreach( $attachments as $id => $attachment ) {
	  		$image = wp_get_attachment_image_src( $id, $args['image_size'] );
	  		$image['ID'] = $id;
	  		$image['title'] = $attachment->post_title;
	  		$image['caption'] = $attachment->post_excerpt;
	  		$images[] = $image;
		}
	}
}

/**
 * You can filter the images array to unset or add items as desired
 * Each item should be an array with the keys ID, title,
 * caption (optional), and parent (optional, would be a post ID)
 */
$images = apply_filters( 'rsgw_images', $images, $args );

// there's stuff in the images array, hooray! let's output them images
if ( ! empty( $images ) ) {
	// Filter the classes to be applied to the dl element
	$dl_class = apply_filters( 'rsgw_dl_class', array( 'rsgallery' ) );

	// Filter the classes to be applied to the dt element for each item
	$dt_class = apply_filters( 'rsgw_dt_class', array( 'rsg_item' ) );

	$output = '
	<dl class="' . implode( ' ', $dl_class ) . '">';

	foreach( $images as $image ) {
		if ( ! empty( $args['before_link_title'] ) )
			$link_title = "{$args['before_link_title']} {$image['title']}";
		else
			$link_title = $image['title'];

		$image_output = '<img src="' . $image[0] . '" alt="' . esc_attr( $link_title ) . '" title="' . esc_attr( $link_title ) . '" width="' . $image[1] . '" height="' . $image[2] . '" class="rsg_image" />';
		$link_output = '';

		$id = $image['ID'];

		if ( isset( $image['parent'] ) )
			$post_id = $image['parent'];

		$item_link_type = $args['link_type'];

		// no post parent - set this one to use a file link if links are being used
		if ( $post_id == '0' )
			$item_link_type = 'file';

		// filter what type of link to use - helpful if you need to deal with an individual item
		$item_link_type = apply_filters( 'rsgw_item_link_type', $item_link_type, $image, $args );

		if ( 'none' != $item_link_type ) {
			$link_url = '';

			if ( 'file' == $item_link_type )
				$link_url = wp_get_attachment_url( $id );
			elseif ( 'post' == $item_link_type )
				$link_url = get_permalink( $post_id );
			elseif ( 'anchor' == $item_link_type )
				$link_url = get_permalink( $post_id ) . "#attachment_$id";
			elseif ( 'attachment' == $item_link_type )
				$link_url = get_attachment_link( $id );

			// Filter the link URL - passes attachment ID and the args for the widget
			// If you've added custom link types, this is the place to deal with it
			$link_url = apply_filters( 'rsgw_image_link_url', $link_url, $id, $args );

			$link_output .= '<a href="' . esc_url( $link_url ) . '"';

			if ( ! empty( $args['link_rel'] ) )
				$link_output .= ' rel="' . esc_attr( $args['link_rel'] ) . '"';

			$link_output .= ' title="' . esc_attr( $link_title ) . '">' . $image_output . '</a>';
		}

		else
			$link_output = $image_output;

		$output .= '
		<dt class="' . implode( ' ', $dt_class ) . '">
			' . $link_output . '
		</dt>';

		if ( $args['show_captions'] && ! empty( $image['caption'] ) ) {
			// Filter the classes to be applied to the dd element for the caption
			$dd_class = apply_filters( 'rsgw_dd_class', array( 'rsg_caption' ) );

			$output .= '
		<dd class="' . implode( ' ', $dd_class ) . '">' . $image['caption'] . '</dd>';
		}
	}

	$output .= '
	</dl>';

	echo $output;
} // !empty( $images )

do_action( 'rsgw_after_widget' );

echo $args['after_widget'];
