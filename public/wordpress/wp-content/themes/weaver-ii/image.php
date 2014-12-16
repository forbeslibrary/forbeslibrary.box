<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
/**
 * The template for displaying image attachments.
 *
 * @package WordPress
 * @subpackage Weaver II
 * @since Weaver II 1.0
 */

weaverii_get_header('image');
if ( weaverii_getopt('wii_infobar_location') == 'top' ) get_template_part('infobar');
weaverii_inject_area('premain');
echo("\t<div id=\"main\">\n");
weaverii_trace_template(__FILE__);
weaverii_get_sidebar_left('image');
?>
		<div id="container_wrap"<?php weaverii_get_page_class('image', 'container-image'); ?>>
<?php
        if (weaverii_getopt('wii_infobar_location') == 'content')
            get_template_part('infobar');
		weaverii_inject_area('precontent'); ?>
		<div id="container" class="image-attachment">
<?php		weaverii_get_sidebar_top('image'); ?>
			<div id="content" role="main">

			<?php weaverii_post_count_clear(); the_post(); ?>

			<nav id="nav-above">
				<h3 class="assistive-text"><?php echo __( 'Image navigation','weaver-ii'); ?></h3>
				<span class="nav-previous"><?php previous_image_link( false, __( '&larr; Previous' ,'weaver-ii') ); ?></span>
				<span class="nav-next"><?php next_image_link( false, __( 'Next &rarr;' ,'weaver-ii') ); ?></span>
			</nav><!-- #nav-above -->

				<article id="post-<?php the_ID(); ?>" <?php post_class('page-image'); ?>>
					<header class="entry-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>

						<div class="entry-meta">
							<?php
								$metadata = wp_get_attachment_metadata();
								printf( __( '<span class="meta-prep meta-prep-entry-date">Published </span> <span class="entry-date"><abbr class="published" title="%1$s">%2$s</abbr></span> at <a href="%3$s" title="Link to full-size image">%4$s &times; %5$s</a> in <a href="%6$s" title="Return to %7$s" rel="gallery">%8$s</a>','weaver-ii'),
									esc_attr( get_the_time() ),
									get_the_date(),
									esc_url( wp_get_attachment_url() ),
									$metadata['width'],
									$metadata['height'],
									esc_url( get_permalink( $post->post_parent ) ),
									esc_attr( strip_tags( get_the_title( $post->post_parent ) ) ),
									get_the_title( $post->post_parent )
								);
							?>
							<?php edit_post_link( __( 'Edit','weaver-ii'), '<span class="edit-link">', '</span>' ); ?>
						</div><!-- .entry-meta -->

					</header><!-- .entry-header -->

					<div class="entry-content cf">

						<div class="entry-attachment">
							<div class="attachment">
<?php
	/**
	 * Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
	 * or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
	 */
	$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
	foreach ( $attachments as $k => $attachment ) {
		if ( $attachment->ID == $post->ID )
			break;
	}
	$k++;
	// If there is more than 1 attachment in a gallery
	if ( count( $attachments ) > 1 ) {
		if ( isset( $attachments[ $k ] ) )
			// get the URL of the next image attachment
			$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
		else
			// or get the URL of the first image attachment
			$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
	} else {
		// or, if there's only 1 image, get the URL of the image
		$next_attachment_url = wp_get_attachment_url();
	}
?>
								<a href="<?php echo esc_url( $next_attachment_url ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php
                                $attachment_size = apply_filters( 'weaverii_attachment_size', 'large' );
								echo wp_get_attachment_image( $post->ID, $attachment_size );

								?></a>

								<?php if ( ! empty( $post->post_excerpt ) ) : ?>
								<div class="entry-caption">
									<?php weaverii_the_excerpt_featured(); ?>
								</div>
								<?php endif; ?>
							</div><!-- .attachment -->

						</div><!-- .entry-attachment -->

						<div class="entry-description">
							<?php weaverii_the_contnt_featured(); ?>
							<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:','weaver-ii') . '</span>', 'after' => '</div>' ) ); ?>
						</div><!-- .entry-description -->

					</div><!-- .entry-content -->

				</article><!-- #post-<?php the_ID(); ?> -->
			<nav id="nav-below">
				<h3 class="assistive-text"><?php echo __( 'Image navigation','weaver-ii'); ?></h3>
				<span class="nav-previous"><?php previous_image_link( false, __( '&larr; Previous' ,'weaver-ii') ); ?></span>
				<span class="nav-next"><?php next_image_link( false, __( 'Next &rarr;' ,'weaver-ii') ); ?></span>
			</nav><!-- #nav-below -->

				<?php if (weaverii_getopt_checked('wii_allow_attachment_comments')) comments_template(); ?>

			</div><!-- #content -->
<?php
        weaverii_get_sidebar_bottom('image'); ?>
		</div><!-- #container -->
		</div><!-- #container_wrap -->

<?php
    weaverii_get_sidebar_right('image');
	weaverii_get_footer('image'); ?>
