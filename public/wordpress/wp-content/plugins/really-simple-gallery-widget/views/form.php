<?php
$from_options = array (
	__( 'Full Media Library', 'rsgwidget' ) => 'full_library',
	__( 'Specific Page or Post', 'rsgwidget' ) => 'post',
	__( 'Attachment IDs', 'rsgwidget' ) => 'ids',
);

$orderby_options = array (
	__( 'Random', 'rsgwidget' ) => 'rand',
	__( 'Date', 'rsgwidget' ) => 'date',
	__( 'Menu/Specified Order', 'rsgwidget' ) => 'menu_order',
	__( 'Title', 'rsgwidget' ) => 'title',
);

$order_options = array (
	__( 'Ascending', 'rsgwidget' ) => 'asc',
	__( 'Descending', 'rsgwidget' ) => 'desc',
);

$link_type_options = array (
	__( 'File', 'rsgwidget' ) => 'file',
	__( 'Anchor on Post/Page', 'rsgwidget' ) => 'anchor',
	__( 'Post/Page', 'rsgwidget' ) => 'post',
	__( 'Attachment', 'rsgwidget' ) => 'attachment',
	__( 'None', 'rsgwidget' ) => 'none',
);

$instance_defaults = array (
	'title' => '',
	'from' => 'full_library',
	'post_id' => '',
	'att_ids' => '',
	'full_library' => false,
	'current_post_images' => false,
	'num_images' => '0',
	'show_captions' => false,
	'image_size' => 'thumbnail',
	'orderby',
	'order' => 'asc',
	'link_type' => 'file',
	'before_link_title' => '',
	'link_rel' => '',
);

// filter options and defaults
$from_options = apply_filters( 'rsgw_from_options', $from_options );
$orderby_options = apply_filters( 'rsgw_orderby_options', $orderby_options );
$order_options = apply_filters( 'rsgw_order_options', $order_options );
$link_type_options = apply_filters( 'rsgw_link_type_options', $link_type_options );
$image_size_options = apply_filters( 'rsgw_image_size_options', get_intermediate_image_sizes() );
$instance_defaults = apply_filters( 'rsgw_instance_defaults', $instance_defaults );

$instance = wp_parse_args( (array) $instance, $instance_defaults );

$title = $instance['title'];
$from = $instance['from'];
$post_id = $instance['post_id'];
$att_ids = $instance['att_ids'];
$current_post_images = $instance['current_post_images'] ? true : false;
$num_images = absint( $instance['num_images'] );
$image_size = $instance['image_size'];
$orderby = $instance['orderby'];
$order = $instance['order'];
$link_type = $instance['link_type'];
$show_captions = $instance['show_captions'] ? true : false;
$before_link_title = $instance['before_link_title'];
$link_rel = $instance['link_rel'];

// back compat for old full_library item
if ( ! $instance['full_library'] && ! empty( $post_id ) )
	$from = 'post';
?>

<p>
	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'rsgwidget' ); ?>:</label>
	<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>

<p>
	<label for="<?php echo $this->get_field_id( 'from' ); ?>"><?php _e( 'Select images from', 'rsgwidget' ); ?></label>
	<select class="widefat rsgw_from_options" id="<?php echo $this->get_field_id( 'from' ); ?>" name="<?php echo $this->get_field_name( 'from' ); ?>">
<?php
foreach ( $from_options as $from_name => $from_value ) {
echo '
		<option value="' . $from_value . '"'
		. selected( $from_value, $instance['from'], false )
		. '>' . $from_name . '</option>';
}
?>
	</select>

	<span class="post_id_option<?php if ( 'post' != $instance['from'] ) echo ' hide-if-js'; ?>">
		<label for="<?php echo $this->get_field_id( 'post_id' ); ?>"><?php _e( 'Page or post ID', 'rsgwidget' ); ?>:</label>
		<input id="<?php echo $this->get_field_id( 'post_id' ); ?>" name="<?php echo $this->get_field_name( 'post_id' ); ?>" type="text" size="3" value="<?php echo esc_attr( $post_id ); ?>" />
	</span>

	<span class="att_ids_option<?php if ( 'ids' != $instance['from'] ) echo ' hide-if-js'; ?>">
		<label for="<?php echo $this->get_field_id( 'att_ids' ); ?>" class="hide-if-js"><?php _e( 'Attachment IDs', 'rsgwidget' ); ?>:</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'att_ids' ); ?>" name="<?php echo $this->get_field_name( 'att_ids' ); ?>" type="text" value="<?php echo esc_attr( $att_ids ); ?>" />
		<span class="description">Comma-separated list of attachment IDs</span>
	</span>
</p>

<p>
	<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'current_post_images' ); ?>" name="<?php echo $this->get_field_name( 'current_post_images' ); ?>"<?php checked( $current_post_images ) ?> />
	<label for="<?php echo $this->get_field_id( 'current_post_images' ); ?>"><?php _e( 'When on a single page/post, only show its attached images', 'rsgwidget' ); ?></label><br />
</p>

<p>
	<label for="<?php echo $this->get_field_id( 'num_images' ); ?>"><?php _e('Number of images to show'); ?>:</label>
	<input id="<?php echo $this->get_field_id( 'num_images' ); ?>" name="<?php echo $this->get_field_name( 'num_images' ); ?>" type="text" size="1" value="<?php echo esc_attr( $num_images ); ?>" /><br />
	<span class="description"><?php _e( 'Enter 0 for all images', 'rsgwidget' ); ?></span>
</p>

<p>
	<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'show_captions' ); ?>" name="<?php echo $this->get_field_name( 'show_captions' ); ?>"<?php checked( $show_captions ) ?> />
	<label for="<?php echo $this->get_field_id( 'show_captions' ); ?>"><?php _e( 'Show captions', 'rsgwidget' ); ?></label>
</p>

<?php if ( ! empty( $image_size_options ) ) : ?>
<p>
	<label for="<?php echo $this->get_field_id( 'image_size' ); ?>"><?php _e( 'Image size', 'rsgwidget' ); ?></label>
	<select class="widefat" id="<?php echo $this->get_field_id( 'image_size' ); ?>" name="<?php echo $this->get_field_name( 'image_size' ); ?>">
<?php
foreach ( $image_size_options as $image_size_option ) {
  echo '
		<option value="' . esc_attr( $image_size_option ) . '"'
		. selected( $image_size_option, $instance['image_size'], false )
		. '>' . $image_size_option . '</option>';
}
?>
	</select>
</p>
<?php endif; ?>

<p>
	<label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php _e( 'Order images by', 'rsgwidget' ); ?></label>
	<select class="widefat rsgw_orderby_options" id="<?php echo $this->get_field_id( 'orderby' ); ?>" name="<?php echo $this->get_field_name( 'orderby' ); ?>">
<?php
foreach ( $orderby_options as $orderby_name => $orderby_value ) {
echo '
		<option value="' . $orderby_value . '"'
		. selected( $orderby_value, $instance['orderby'], false )
		. '>' . $orderby_name . '</option>';
}
?>
	</select>

	<span class="rsgw_order_option<?php if ( 'rand' == $instance['orderby'] || ( 'menu_order' == $instance['orderby'] && 'ids' == $instance['from'] ) ) echo ' hide-if-js'; ?>">
		<label class="hide-if-js" for="<?php echo $this->get_field_id( 'order' ); ?>"><?php _e( 'Order of images', 'rsgwidget' ); ?></label>
		<select class="widefat" id="<?php echo $this->get_field_id( 'order' ); ?>" name="<?php echo $this->get_field_name( 'order' ); ?>">
		<?php
		foreach ( $order_options as $order_name => $order_value ) {
		echo '
			<option value="' . $order_value . '"'
			. selected( $order_value, $instance['order'], false )
			. '>' . $order_name . '</option>';
		}
		?>
		</select>
	</span>
</p>

<p>
	<label for="<?php echo $this->get_field_id( 'link_type' ); ?>"><?php _e( 'Type of link', 'rsgwidget' ); ?></label>
	<select class="widefat" id="<?php echo $this->get_field_id( 'link_type' ); ?>" name="<?php echo $this->get_field_name( 'link_type' ); ?>">
<?php
foreach ( $link_type_options as $link_type_name => $link_type_value ) {
	echo '
		<option value="' . esc_attr( $link_type_value ) . '"'
		. selected( $link_type_value, $instance['link_type'], false )
		. '>' . $link_type_name . '</option>';
}
?>
	</select>
</p>

<p><strong>Advanced Options</strong> <a href="#" class="toggle hide-if-no-js">[Toggle]</a></p>

<div class="rsgw-advanced hide-if-js">

<p>
	<label for="<?php echo $this->get_field_id( 'before_link_title' ); ?>"><?php _e( 'Text before link title', 'rsgwidget' ); ?>:</label>
	<input id="<?php echo $this->get_field_id( 'before_link_title' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'before_link_title' ); ?>" type="text" value="<?php echo esc_attr( $before_link_title ); ?>" />
	<span class="description"><?php _e( 'Appears as tooltip', 'rsgwidget' ); ?></span>
</p>

<p>
	<label for="<?php echo $this->get_field_id( 'link_rel' ); ?>"><?php _e( 'Link rel attribute', 'rsgwidget' ); ?>:</label>
	<input id="<?php echo $this->get_field_id( 'link_rel' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'link_rel' ); ?>" type="text" size="3" value="<?php echo esc_attr( $link_rel ); ?>" />
	<span class="description"><?php _e( 'e.g. lightbox[gallery-widget]', 'rsgwidget' ); ?></span>
</p>

</div><!-- advanced -->
