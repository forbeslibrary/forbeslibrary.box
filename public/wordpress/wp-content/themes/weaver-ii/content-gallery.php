<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
/**
 * The template for displaying posts in the Gallery Post Format on index and archive pages
 *
 * Learn more: http://codex.wordpress.org/Post_Formats
 *
 * @package WordPress
 * @subpackage Weaver II
 * @since Weaver II 1.0
 */
weaverii_trace_template(__FILE__);
global $weaverii_cur_post_id;
$weaverii_cur_post_id = get_the_ID();
weaverii_per_post_style();
$entry_summary = 'entry-summary';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('content-gallery ' . weaverii_post_count_class()); ?>>
<?php
	if (!weaverii_compact_post()) {
?>
	<header class="entry-header">
<?php 	weaverii_entry_header(__( 'Gallery','weaver-ii')); ?>
		<div class="entry-meta">
			<?php weaverii_post_top_info(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

<?php
		if (weaverii_show_only_title()) {
			return;
		}

	} else {	// not compact
		$entry_summary .= ' compact-post-format';
	}

	$linked = false;
?>
	<div class="<?php echo $entry_summary; ?>">
<?php
	if ( post_password_required() ) {
		 weaverii_the_contnt_featured();
	} else {
		// Let's look for some images from the gallery.
		$images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment',
		'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );

		if ( $images ) {	// found some images
			$total_images = count( $images );
			$image = array_shift( $images );
			$image_img_tag = wp_get_attachment_image( $image->ID, 'thumbnail' );
?>
		<figure class="gallery-thumb">
			<a href="<?php the_permalink(); ?>"><?php echo $image_img_tag; ?></a>
		</figure><!-- .gallery-thumb -->
<?php
			$linked = true;
			if (weaverii_compact_post())
				echo '<div class="weaver-clear"></div>';
?>
		<p><em><?php printf( _n( 'This gallery contains <a %1$s>%2$s photo</a>.', 'This gallery contains <a %1$s>%2$s photos</a>.',
				$total_images,'weaver-ii'), 'href="' . esc_url( get_permalink() ) . '" title="' .
				sprintf( esc_attr__( 'Permalink to %s','weaver-ii'), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark"',
				number_format_i18n( $total_images )); ?></em></p>
<?php
		} else {	// did not find any images from the content.
			// using get_children failed to find any galler image, so let's do it ourselves.

            $content = do_shortcode(apply_filters( 'the_content', get_the_content('')));	// pick up wp 3.6 post format
            if (preg_match('/<img[^>]+>/i',$content, $images)) {	// grab <img>s
                $src = '';
                if (preg_match('/src="([^"]*)"/', $images[0], $srcs)) {
                    $src = $srcs[0];
                } else if (preg_match("/src='([^']*)'/", $images[0], $srcs)) {
                    $src = $srcs[0];
                }
                $the_image = '<img class="gallery-thumb" ' . $src . 'alt="post image" />';
                $linked = true;
?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( 'echo=1' ); ?>" rel="bookmark"><?php echo $the_image; ?></a><p><em><?php echo __( 'Gallery','weaver-ii'); ?></em></p>
<?php
            }
		}

		if ((!weaverii_compact_post() && !$linked) || !$linked)
            weaverii_the_excerpt_featured();
	}	// display gallery format
	wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:','weaver-ii') . '</span>', 'after' => '</div>' ) ); ?>
		</div><!-- .entry-summary -->
<?php
    if (!weaverii_compact_post()) {
?>	    <footer class="entry-utility"><?php
            weaverii_post_bottom_info();
?>	    </footer><!-- #entry-utility --> <?php
            weaverii_compact_link('check');
    } else {
            if (! $linked )
                weaverii_compact_link();
            edit_post_link( __( 'Edit','weaver-ii'), '<span class="edit-link">', '</span>' );
    }
	weaverii_inject_area('postpostcontent');	// inject post comment body
?>
</article><!-- #post-<?php the_ID(); ?> -->
