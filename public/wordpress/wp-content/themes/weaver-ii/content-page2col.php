<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
/**
 * The template used for displaying 2 col page content in page.php
 *
 * @package WordPress
 * @subpackage Weaver II
 * @since Weaver II 1.0
 */
weaverii_trace_template(__FILE__);
global $weaverii_cur_post_id;
$weaverii_cur_post_id = get_the_ID();
weaverii_per_post_style();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('content-page'); ?>>
<?php
    weaverii_fi_pre_title('page');
?>
	<header class="entry-header<?php weaverii_hide_page_title(); ?>">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content cf">
<?php
    weaverii_the_page_contnt_featured(false);	// put any featured image at the top...

	$content = get_the_content('', FALSE,''); //arguments remove 'more' text

	$content = apply_filters('the_content', $content);
	$content = str_replace(']]>', ']]&gt;', $content);

	// the first "more" is converted to a span with ID
	$columns = preg_split('/(<span id="more-\d+"><\/span>)|(<!--more-->)<\/p>/', $content);
	$col_count = count($columns);

	if ($col_count > 1) {
		for ($i=0; $i < $col_count; $i++) {
            // check to see if there is a final </p>, if not add it
            if( !preg_match('/<\/p>\s?$/', $columns[$i]) )  {
                $columns[$i] .= '</p>';
            }
            // check to see if there is an appending </p>, if there is, remove
            $columns[$i] = preg_replace('/^\s?<\/p>/', '', $columns[$i]);
            // now add the div wrapper
            if ((int)($i % 2) == 0) $coldiv = 'left'; else $coldiv = 'right';
            if ($coldiv == 'right' && ($i+1) < $col_count) {
                $break_cols ='<hr class="wvr-2-col-divider"/>';
            } else {
                $break_cols = '';
            }
            $columns[$i] = '<div class="cf content-2-col-'.$coldiv.'">'.$columns[$i] .'</div>' . $break_cols ;
		}
		$content = join($columns, "\n");
	} else {
		// this page does not have dynamic columns
		$content = wpautop($content);
	}
	// remove any left over empty <p> tags
	$content = str_replace('<p></p>', '', $content);
	echo $content;
?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:','weaver-ii') . '</span>', 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
	<footer class="entry-utility-page">
		<?php edit_post_link( __( 'Edit','weaver-ii'), '<span class="edit-link">', '</span>' ); ?>

	</footer><!-- .entry-utility-page -->
</article><!-- #post-<?php the_ID(); ?> -->
