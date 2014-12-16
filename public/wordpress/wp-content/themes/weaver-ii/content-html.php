<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
/**
 * The template used for displaying HTML Source
 *
 * @package WordPress
 * @subpackage Weaver II
 * @since Weaver II 1.0
 */
weaverii_trace_template(__FILE__);
global $weaverii_cur_post_id;
$weaverii_cur_post_id = get_the_ID();
weaverii_per_post_style();

/*  JavaScript/CSS note: in order to avoid loading a separate CSS file and script for
	every page, the pretty printer CSS is loaded here and the script invoked by inline JS here. */
?>
<style type="text/css">
pre.prettyprint {
  margin-left: 5px; padding-left: 18px; border-left: 3px solid #6CE26C;
  font-family: Monaco, 'DejaVu Sans Mono', 'Bitstream Vera Sans Mono', 'Lucida Console', monospace !important;
  overflow: auto; background: #f0f0f0;
}

.str { color: #080; }
.kwd { color: #008; font-weight: bold; }
.com { color: #800; font-style:italic; }
.typ { color: #606; font-weight: bold; }
.lit { color: #066; }
.pun { color: #660; }
.pln { color: #000; } /* text */
.tag { color: #00e; font-style: italic;} /* tags */
.atn { color: #009; font-style:italic; } /* parameter */
.atv { color: #070; font-style:italic; } /* values */
.dec { color: red; }

@media print {
.str { color: #060; }
.kwd { color: #006; font-weight: bold; }
.com { color: #600; font-style: italic; }
.typ { color: #404; font-weight: bold; }
.lit { color: #044; }
.pun { color: #440; }
.pln { color: #000; }
.tag { color: #006; font-weight: bold; }
.atn { color: #404; }
.atv { color: #060; }
}
</style>

<article id="post-<?php the_ID(); ?>" <?php post_class('content-page'); ?>>
	<header class="entry-header<?php weaverii_hide_page_title(); ?>">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content cf">
<?php
	if (($ex = weaverii_get_per_page_value('html_source_intro')) != '') {
		echo do_shortcode($ex);
		echo ('<hr />');
	}
?>
	<pre class="prettyprint lang-html">
<?php 	echo esc_html(get_the_content()); ?>
	</pre>

<?php	wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:','weaver-ii') . '</span>', 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
	<footer class="entry-utility-page">
<?php 	edit_post_link( __( 'Edit','weaver-ii'), '<span class="edit-link">', '</span>' ); ?>

	</footer><!-- .entry-utility-page -->
</article><!-- #post-<?php the_ID(); ?> -->
<script type="text/javascript">
prettyPrint();
</script>
