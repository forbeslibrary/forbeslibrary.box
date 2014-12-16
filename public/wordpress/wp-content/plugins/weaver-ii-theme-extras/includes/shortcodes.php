<?php
/*
 Weaver II Shortcodes

*/

// same as Weaver II Pro shortcodes - except add_shortcode mapped to just add_shortcode here

function weaverii_show_posts_shortcode($args = '') {
    /* implement [weaver_show_posts]  */

/* DOC NOTES:
CSS styling: The group of posts will be wrapped with a <div> with a class called
.wvr-show-posts. You can add an additional class to that by providing a 'class=classname' option
(without the leading '.' used in the actual CSS definition). You can also provide inline styling
by providing a 'style=value' option where value is whatever styling you need, each terminated
with a semi-colon (;).

The optional header is in a <div> called .wvr_show_posts_header. You can add an additional class
name with 'header_class=classname'. You can provide inline styling with 'header_style=value'.

.wvr-show-posts .hentry {margin-top: 0px; margin-right: 0px; margin-bottom: 40px; margin-left: 0px;}
.widget-area .wvr-show-posts .hentry {margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px;}
*/

    global $more;
    global $weaverii_cur_post_id;

    extract(shortcode_atts(array(
	     /* query options */
	    'cats' => '',			/* by slug, use - to exclude  */
	    'tags' => '',			/* by slug (tag) */
	    'author' => '',			/* author - use nickname (auhor_name)*/
	    'author_id' => '',			/* list of author IDs */
	    'single_post' => '',		/* by slug - only one article (name) */
	    'post_type' => '',			/* add post_type */
	    'orderby' => 'date',		/* author | date | title | rand | modified | parent {date} (orderby) */
	    'sort' => 'DESC',			/* ASC | DESC {DESC} (order)*/
	    'number' => '5',			/* number of posts to show  {5} (posts_per_page)*/
        'paged' => false,			/* use paging? */
        'sticky' => false,          // show sticky?
        'nth' => '0',			/* show just the nth post that matches other criteria */
	    /* formatting options */
	    'show' => 'full',			/* show: title | title_featured | excerpt | full | titlelist  */
	    'hide_title' => '',			/* hide the title? */
	    'hide_top_info' => '',		/* hide the top info line */
	    'hide_bottom_info' => '',		/* hide bottom info line */
	    'show_featured_image' => '', 	/* force showing featured image */
	    'hide_featured_image' => '', 	/* force showing featured image */
	    'show_avatar' => '',		/* show the author avatar */
	    'show_bio' => '',			/* show the bio below */
	    'excerpt_length' => '',		/* override excerpt length */
	    'style' => '',			/* inline CSS style for wvr-show-posts */
	    'class' => '',			/* optional class to allow outside styling */
	    'header' => '',			/* optional header for post */
	    'header_style' => '',		/* styling for the header */
	    'header_class' => '',		/* class for header */
	    'more_msg' => '',			/* replacement for Continue Reading */
	    'left' => '',
	    'right' => '',
	    'clear' => ''
    ), $args));

    $save_cur_post = $weaverii_cur_post_id;

    /* Setup query arguments using the supplied args */
    $qargs = array(
        'ignore_sticky_posts' => 1
    );

    $qargs['orderby'] = $orderby;	/* enter opts that have defaults first */
    $qargs['order'] = $sort;
    $qargs['posts_per_page'] = $number;
    if (!empty($cats)) $qargs['cat'] = weaverii_cat_slugs_to_ids($cats);
    if (!empty($tags)) $qargs['tag'] = $tags;
    if (!empty($single_post)) $qargs['name'] = $single_post;
    if (!empty($author)) $qargs['author_name'] = $author;
    if (!empty($author_id)) $qargs['author'] = $author_id;
    if (!empty($post_type)) $qargs['post_type'] = $post_type;
    if (!empty($sticky) && $sticky) $qargs['ignore_sticky_posts'] = 0;

    weaverii_sc_reset_opts();

    weaverii_sc_setopt('showposts',true);	// global to see if we are in this function

    weaverii_sc_setopt('show',$show);	// this will always be set

    if ($hide_title != '') weaverii_sc_setopt('hide_title',true);
    if ($hide_top_info != '') weaverii_sc_setopt('hide_top_info',true);
    if ($hide_bottom_info != '') weaverii_sc_setopt('hide_bottom_info',true);
    if ($show_featured_image != '') weaverii_sc_setopt('show_featured_image',true);
    if ($hide_featured_image != '') weaverii_sc_setopt('hide_featured_image',true);
    if ( isset($args['show_avatar'])) {
        if ($show_avatar) {
            weaverii_sc_setopt('show_avatar', true);
        } else {
            weaverii_sc_setopt('show_avatar','no');
        }
    }

    if ($excerpt_length != '') weaverii_sc_setopt('excerpt_length',$excerpt_length);
    if ($more_msg != '') weaverii_sc_setopt('more_msg',$more_msg);

    if ( $paged ) {
	if ( get_query_var( 'paged' ) )
	    $qargs['paged'] = get_query_var('paged');
	else if ( get_query_var( 'page' ) )
	    $qargs['paged'] = get_query_var( 'page' );
	else
	    $qargs['paged'] = 1;
    }

    $ourposts = new WP_Query(apply_filters('weaver_show_posts_wp_query',$qargs, $args));
	// now modify the query using custom fields for this page

    /* now start the content */

    $div_add = '';
    if ($left) $class .= ' weaver-left';
    else if ($right) $class .= ' weaver-right';
    if (!empty($style)) $div_add = ' style="' . $style . '"';
    $content = '<div class="wvr-show-posts ' . $class . '"'  . $div_add . '>';

    $h_add = '';
    if (!empty($header_style)) $h_add = ' style="' . $header_style . '"';

    if (!empty($header)) {
        $content .= '<div class="wvr-show-posts-header ' . $header_class . '"' . $h_add . '>' . $header . '</div>';
    }

    ob_start();	// use built-in weaver code to generate a weaver standard post

    if ($show == 'titlelist') echo '<ul>';

    weaverii_post_count_clear();
    $posts_out = 0;

    if ($paged && $ourposts->have_posts()) {		// top paging?
        global $wp_query;
        $wp_query = $ourposts;
        weaverii_content_nav( 'nav-above' );
    }

    while ( $ourposts->have_posts() ) {
        $ourposts->the_post();
        weaverii_post_count_bump();
        $weaverii_cur_post_id = get_the_ID();
            $posts_out++;
        if ($nth != 0) {
            if ($posts_out < $nth)
                continue;
            if ($posts_out > $nth)
                break;			// all done...
        }

        // weaverii_per_post_style();
        if ($show == 'titlelist') {
    ?>
            <li><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr(__( 'Permalink to %s','weaver-ii')),
           the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></li>
    <?php
        } else {
            get_template_part( 'content', get_post_format() );
        }

    } // end loop
    if ($show == 'titlelist') echo "</ul>\n";
    if (!empty($show_bio) && get_the_author_meta( 'description' ) ) { ?>
    <hr />
		<div id="author-info">
			<div id="author-avatar">
				<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'weaverii_author_bio_avatar_size', 68 ) ); ?>
			</div><!-- #author-avatar -->
			<div id="author-description">
				<h2><?php printf( esc_attr__( 'About %s','weaver-ii'), get_the_author() ); ?></h2>
				<?php the_author_meta( 'description' ); ?>
				<div id="author-link">
					<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
						<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>','weaver-ii'), get_the_author() ); ?>
					</a>
				</div><!-- #author-link	-->
			</div><!-- #author-description -->
		</div><!-- #entry-author-info -->
<?php
    }
    echo "<div class=\"weaver-clear\"></div>\n";
    if ($paged && $ourposts->have_posts()) {
        global $wp_query;
        $wp_query = $ourposts;
        weaverii_content_nav( 'nav-below' );
    }

    $content .= ob_get_clean();	// get the output

    // get posts

    $content .= '</div><!-- #wvr-show-posts -->';
    if ($clear) $content .= "<div class=\"weaver-clear\"></div>\n";
    wp_reset_query();
    wp_reset_postdata();

    $weaverii_cur_post_id = $save_cur_post;

    weaverii_sc_reset_opts();	// done, clear for other shortcodes

    return $content;
}

add_shortcode('weaver_show_posts', 'weaverii_show_posts_shortcode');

// ===============  [weaver_header_image style='customstyle'] ===================
function weaverii_sc_header_image($args = '') {
    extract(shortcode_atts(array(
	    'style' => '',	// STYLE
	    'h' => '',
	    'w' => ''
    ), $args));

    $width = $w ? ' width="' . $w . '"' : '';
    $height = $h ? ' height="' . $h . '"' : '';
    $st = $style ? ' style="' . $style . '"' : '';

    if (weaverii_use_mobile('mobile') && weaverii_getopt('_wii_mobile_header_url')) {
        $hdrimg = '<img src="' . esc_attr(apply_filters('weaverii_css',weaverii_getopt('_wii_mobile_header_url'))) .
            '" width="100%" alt="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" ' .  $st . $width . $height . ' />' ;
    } else {
        $hdrimg = '<img src="' . get_header_image() . '"' . $st . $width . $height
            . ' alt="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" />' ;
    }
    return $hdrimg;
}

add_shortcode('weaver_header_image', 'weaverii_sc_header_image');

// ===============  [weaver_bloginfo arg='name'] ======================
function weaverii_sc_bloginfo($args = '') {
    extract(shortcode_atts(array(
	    'arg' => 'name'		/* styling for the header */
    ), $args));

    return esc_attr( get_bloginfo( $arg ));
}

add_shortcode('weaver_bloginfo', 'weaverii_sc_bloginfo');

// ===============  [weaver_site_title style='customstyle'] ======================
function weaverii_sc_site_title($args = '') {
    extract(shortcode_atts(array(
	    'style' => ''		/* styling for the header */
    ), $args));
    $title = (weaverii_getopt('_wii_mobile_site_title') && weaverii_use_mobile('mobile') )
		? esc_html(weaverii_getopt('_wii_mobile_site_title')) : esc_attr( get_bloginfo( 'name', 'display' ) );

    if ($style) {
        return '<span style="' . $style . '">' . $title . '</span>';
    }
    return $title;

}

add_shortcode('weaver_site_title', 'weaverii_sc_site_title');

// ===============  [weaver_site_title style='customstyle'] ======================
function weaverii_sc_site_desc($args = '') {
    extract(shortcode_atts( array(
                            'style' => ''		/* styling for the header */
                            ), $args));
    $title = get_bloginfo( 'description' );

    if ($style) {
        return '<span style="' . $style . '">' . $title . '</span>';
    }
    return $title;
}

add_shortcode('weaver_site_desc', 'weaverii_sc_site_desc');

// ===============  [weaver_breadcrumbs style='customstyle'] ======================
function weaverii_sc_breadcrumbs($args = '') {
    extract(shortcode_atts(array(
	    'style' => '',
	    'class' => 'breadcrumbs' /* styling for the header */
    ), $args));
    $title = weaverii_breadcrumb(false, $class);

    if ($style) {
        return '<span style="' . $style . '">' . $title . '</span>';
    }
    return $title;

}

add_shortcode('weaver_breadcrumbs', 'weaverii_sc_breadcrumbs');

// ===============  [weaver_pagenav style='customstyle'] ======================
function weaverii_sc_pagenav($args = '') {
    extract(shortcode_atts(array(
	    'style' => '',
	    'end_size' => '1',
	    'mid_size' => '2',
	    'error_msg' => ''

    ), $args));
    $title = weaverii_get_paginate_archive_page_links( 'plain',$end_size,$mid_size );

    if (!$title) return $error_msg;

    if ($style) {
        return '<span style="' . $style . '">' . $title . '</span>';
    }
    return $title;
}

add_shortcode('weaver_pagenav', 'weaverii_sc_pagenav');

// ===============  [weaver_iframe src='address' height=nnn] ======================
function weaverii_sc_iframe($args = '') {
    extract(shortcode_atts(array(
	    'src' => '',
	    'height' => '600', /* styling for the header */
	    'percent' => 100,
	    'style' => 'border:1px;'
    ), $args));

    $sty = $style ? ' style="' . $style . '"' : '';

    if (!$src) return '<h4>No src address provided to [weaver_iframe].</h4>';
    return "\n" . '<iframe src="' . $src . '" height="' .  $height . 'px" width="' . $percent . '%"' . $sty . '></iframe>' . "\n";
}

add_shortcode('weaver_iframe', 'weaverii_sc_iframe');

// ===============  [weaver_show_if_mobile style='customstyle'] ======================
function weaverii_sc_show_if_mobile($args = '',$text) {
    extract(shortcode_atts(array(
	    'type' => 'mobile'		// mobile, smalltablet, tablet, any
    ), $args));

    if ( weaverii_smart_mode() ) {
        if ( weaverii_use_mobile($type) ) {
            return do_shortcode($text);
        } else {
            return '';
        }
    } else {
        if ($type == 'touch') $type = 'mobile';
        return '<span class="wvr-show-mobile-' . $type . '">' . do_shortcode($text) . '</span>';
    }

    return '';
}

add_shortcode('weaver_show_if_mobile', 'weaverii_sc_show_if_mobile');

function weaverii_sc_hide_if_mobile($args = '',$text) {
    extract(shortcode_atts(array(
	    'type' => 'mobile'		// mobile, touch, tablet, any
    ), $args));

    if ( weaverii_smart_mode() ) {
        if ( !weaverii_use_mobile($type) ) {
            return do_shortcode($text);
        } else {
            return '';
        }
    } else {
        if ($type == 'touch') $type = 'mobile';
        return '<span class="wvr-hide-mobile-' . $type . '">' . do_shortcode($text) . '</span>';
    }

    return '';
}

add_shortcode('weaver_hide_if_mobile', 'weaverii_sc_hide_if_mobile');

// ===============  [weaver_show_if_logged_in] ======================
function weaverii_sc_show_if_logged_in($args = '',$text) {

    if (is_user_logged_in()) {
        return do_shortcode($text);
    }
    return '';
}

add_shortcode('weaver_show_if_logged_in', 'weaverii_sc_show_if_logged_in');

function weaverii_sc_hide_if_logged_in($args = '',$text) {

    if (!is_user_logged_in()) {
        return do_shortcode($text);
    }
    return '';
}

add_shortcode('weaver_hide_if_logged_in', 'weaverii_sc_hide_if_logged_in');

// ===============  [weaver_youtube id=videoid sd=0 hd=0 related=0 https=0 privacy=0 w=0 h=0] ======================
function weaverii_sc_youtube($args = '') {
    $share = '';
    if ( isset ( $args[0] ) )
        $share = trim($args[0]);

    // http://code.google.com/apis/youtube/player_parameters.html
    // not including: enablejsapi, fs,playerapiid,

    extract(shortcode_atts(array(
        'id' => '',
        'sd' => false,
        'related' => '0',
        'https' => false,
        'privacy' => false,
        'w' => 0,
        'h' => 0,
        'ratio' => false,
        'center' => '1',
        'autohide' => '1',
        'autoplay' => '0',
        'border' => '0',
        'color' => false,
        'color1' => false,
        'color2' => false,
        'controls' => '1',
        'disablekb' => '0',
        'egm' => '0',
        'fs' => '1',
        'fullscreen' => 1,
        // 'hd' => '1',
        'iv_load_policy' => '1',
        'loop' => '0',
        'modestbranding' => '0',
        'origin' => false,
        'percent' => 100,
        'playlist' => false,
        'rel' => '0',
        'showinfo' => '1',
        'showsearch' => '1',
        'start' => false,
        'theme' => 'dark',
        'wmode' => 'transparent'

    ), $args));

    if (!$share && !$id) return '<strong>No share or id values provided for weaver_youtube shortcode.</strong>';

    if ( $w == 0 ) {
        $w = $sd ? 640 : 1280;
    }
    if ( $h == 0 ) {
        $h = $sd ? 480 : 720;
    }
    if ( $ratio )
        $h = $w * $ratio;

    $GLOBALS['wvr_videos_count'] = true;

    if ($share)	{	// let the share override any id
        $share = str_replace('http://youtu.be/','',$share);
        if (strpos($share,'youtube.com/watch') !== false) {
            $share = str_replace('http://www.youtube.com/watch?v=', '', $share);
            $share = str_replace('&amp;','+',$share);
            $share = str_replace('&','+',$share);
        }
        if ($share) $id = $share;
    }

    $opts = $id . '%%';

    // $opts = weaverii_add_url_opt($opts, $hd != '0', 'hd=1');
    $opts = weaverii_add_url_opt($opts, $autohide != '2', 'autohide='.$autohide);
    $opts = weaverii_add_url_opt($opts, $autoplay != '0', 'autoplay=1');
    $opts = weaverii_add_url_opt($opts, $border != '0', 'border=1');
    $opts = weaverii_add_url_opt($opts, $color, 'color='.$color);
    $opts = weaverii_add_url_opt($opts, $color1, 'color1='.$color1);
    $opts = weaverii_add_url_opt($opts, $color2, 'color2='.$color2);
    $opts = weaverii_add_url_opt($opts, $controls != '1', 'controls=0');
    $opts = weaverii_add_url_opt($opts, $disablekb != '0', 'disablekb=1');
    $opts = weaverii_add_url_opt($opts, $egm != '0', 'egm=1');
    $opts = weaverii_add_url_opt($opts, $fs != '1', 'fs=0');
    $opts = weaverii_add_url_opt($opts, $iv_load_policy != '1', 'iv_load_policy='.$iv_load_policy);
    $opts = weaverii_add_url_opt($opts, $loop != '0', 'loop=1');
    $opts = weaverii_add_url_opt($opts, $modestbranding != '0', 'modestbranding=1');
    $opts = weaverii_add_url_opt($opts, $origin, 'origin='.$origin);
    $opts = weaverii_add_url_opt($opts, $playlist, 'playlist='.$playlist);
    $opts = weaverii_add_url_opt($opts, true, 'rel='.$rel);
    $opts = weaverii_add_url_opt($opts, $showinfo != '1', 'showinfo=0');
    $opts = weaverii_add_url_opt($opts, $showsearch != '1', 'showsearch=0');
    $opts = weaverii_add_url_opt($opts, $start, 'start='.$start);
    $opts = weaverii_add_url_opt($opts, $theme != 'dark', 'theme=light');
    $opts = weaverii_add_url_opt($opts, $wmode, 'wmode='.$wmode);

    if ($https) $url = 'https://';
    else $url = 'http://';
    if ($privacy) $url .= 'www.youtube-nocookie.com';
    else $url .= 'www.youtube.com';

    $opts = str_replace('%%+','%%?', $opts);
    $opts = str_replace('%%','', $opts);
    $opts = str_replace('+','&amp;', $opts);

    $url .= '/embed/' . $opts;

    // $vert = $sd ? 0.75 : 0.5625;
    if ($ratio) $vert = $ratio;
    if (weaverii_use_mobile('mobile') && $percent < 90) $percent = 99;

    $allowfull = $fullscreen ? ' allowfullscreen' : '';
    $cntr1 = $center ? '<div class="wvr-fitvids" style="margin:0 auto;max-width:' . $percent . '%;">'
                     : '<div class="wvr-fitvids" style="max-width:' . $percent . '%;">';
    $cntr2 = '</div>';

    return "\n" . $cntr1 . '<iframe src="' . $url
     . '" width="' . $w . '" height="' . $h . '" frameborder="0"' . $allowfull . '></iframe>'
     . $cntr2 . "\n";
}
add_shortcode('weaver_youtube', 'weaverii_sc_youtube');

// ===============  [weaver_vimeo id=videoid sd=0 w=0 h=0 color=#hex autoplay=0 loop=0 portrait=1 title=1 byline=1] ======================
function weaverii_sc_vimeo($args = '') {
    $share = '';
    if ( isset ( $args[0] ) )
        $share = trim($args[0]);

    extract(shortcode_atts(array(
        'id' => '',
        'sd' => false,
        'color' => '',
        'autoplay' => false,
        'loop' => false,
        'portrait' => true,
        'title' => true,
        'byline' => true,
        'w' => 0,
        'h' => 0,
        'ratio' => false,
        'percent' => 100,
        'center' => '1'
    ), $args));

    if (!$share && !$id) return '<strong>No share or id values provided for weaver_vimeo shortcode.</strong>';

    if ( $w == 0 ) {
        $w = $sd ? 640 : 1280;
    }
    if ( $h == 0 ) {
        $h = $sd ? 480 : 720;
    }
    if ( $ratio )
        $h = $w * $ratio;

    $GLOBALS['wvr_videos_count'] = true;


    if ($share)	{	// let the share override any id
        $share = str_replace('http://vimeo.com/','',$share);
        if ($share) $id = $share;
    }

    $opts = $id . '##';

    $opts = weaverii_add_url_opt($opts, $autoplay, 'autoplay=1');
    $opts = weaverii_add_url_opt($opts, $loop, 'loop=1');
    $opts = weaverii_add_url_opt($opts, $color, 'color=' . $color);
    $opts = weaverii_add_url_opt($opts, !$portrait, 'portrait=0');
    $opts = weaverii_add_url_opt($opts, !$title, 'title=0');
    $opts = weaverii_add_url_opt($opts, !$byline, 'byline=0');

    $url = 'http://player.vimeo.com/video/';

    $opts = str_replace('##+','##?', $opts);
    $opts = str_replace('##','', $opts);
    $opts = str_replace('+','&amp;', $opts);

    $url .= $opts;

    if (weaverii_use_mobile('mobile')) $percent = 100;

    // $vert = $sd ? 0.75 : 0.5625;
    // if ($ratio) $vert = $ratio;
    $cntr1 = $center ? '<div class="wvr-fitvids" style="margin:0 auto;max-width:' . $percent. '%;">'
                     : '<div class="wvr-fitvids" style="max-width:' . $percent. '%;">';
    $cntr2 = '</div>';

    return "\n" . $cntr1 . '<iframe src="' . $url
     . '" width="'. $w . '" height="' . $h . '" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>'
     . $cntr2 . "\n";
}
add_shortcode('weaver_vimeo', 'weaverii_sc_vimeo');

// ===== video utils =====

function weaverii_add_url_opt($opts, $add, $add_val) {
    if ($add) {
        $opts = $opts . '+' . $add_val;
    }
    return $opts;
}

// ===============  [html style='customstyle'] ======================

function weaverii_sc_html($vals = '') {
    $tag = 'span';
    if ( isset ( $vals[0] ) )
        $tag = trim( $vals[0]);

    extract(shortcode_atts(array(
        'args' => ''
    ), $vals));
    if ($args) $args = ' ' . $args;
    return '<' . $tag . $args .  '>';
}

add_shortcode('weaver_html', 'weaverii_sc_html');

function weaverii_sc_div($vals = '',$text) {
    extract(shortcode_atts(array(
        'id' => '',
        'class' => '',
        'style' => ''
    ), $vals));

    $args = '';
    if ($id) $args .= ' id="' . $id . '"';
    if ($class) $args .= ' class="' . $class . '"';
    if ($style) $args .= ' style="' . $style . '"';

    return '<div' . $args . '>' . do_shortcode($text) . '</div>';
}

add_shortcode('div', 'weaverii_sc_div');

function weaverii_sc_span($vals = '',$text) {
    extract(shortcode_atts(array(
        'id' => '',
        'class' => '',
        'style' => ''
    ), $vals));

    $args = '';
    if ($id) $args .= ' id="' . $id . '"';
    if ($class) $args .= ' class="' . $class . '"';
    if ($style) $args .= ' style="' . $style . '"';

    return '<span' . $args . '>' . do_shortcode($text) . '</span>';
}

add_shortcode('span', 'weaverii_sc_span');

// ===============  [weaver_info] ======================
function weaverii_sc_info() {
    global $current_user;
    $out = '<strong>' . WEAVERII_THEMEVERSION . ' Info</strong><hr />';

    get_currentuserinfo();
    if (isset($current_user->display_name)) {
        $out .= '<em>User:</em> ' . $current_user->display_name . '<br />';
    }
    $out .= '&nbsp;&nbsp;' . wp_register('','<br />',false);
    $out .= '&nbsp;&nbsp;' . wp_loginout('',false) . '<br />';

    global $weaverii_mobile;
    $device = $weaverii_mobile;
    $out .= '<em>Browser:</em> ' . ($device ? $device['browser'] . '/' . $device['type'] .'/'.$device['os'] : 'Non-Mobile Browser') . '<br />';
    $agent = 'Not Available';
    if (isset($_SERVER["HTTP_USER_AGENT"]) )
        $agent = $_SERVER['HTTP_USER_AGENT'];
    $out .= '<em>User Agent</em>: <small>' . $agent . '</small>';
    $out .= '<div id="example"></div>
<script type="text/javascript">
var txt = "";
var myWidth;
if( typeof( window.innerWidth ) == "number" ) {
//Non-IE
myWidth = window.innerWidth;
} else if( document.documentElement &&
( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) {
//IE 6+ in "standards compliant mode"
myWidth = document.documentElement.clientWidth;
} else if ( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
//IE 4 compatible
myWidth = document.body.clientWidth;
}
txt+= "<em>Browser Width: </em>" + myWidth + " px<br>";
document.getElementById("example").innerHTML=txt;
</script>';

    if (!weaverii_use_inline_css( weaverii_get_css_filename() ))
        $out .= '<em>Using CSS file:</em> ' . weaverii_get_css_filename();
    else
        $out .= '<em>Using Inline CSS</em>';

    $out .= '<br /><em>Mobile Mode: </em> ' . weaverii_getopt('_wii_mode_mobile');

    $out .= '<br /><em>Feed title:</em> ' . get_bloginfo_rss('name') . get_wp_title_rss();

    $out .= '<br /><em>You are using</em> WordPress ' . $GLOBALS['wp_version'] . '<br /><em>PHP Version:</em> ' . phpversion();
    $out .= '<br /><em>Memory:</em> ' . round(memory_get_usage()/1024/1024,2) . 'M of ' .  (int)ini_get('memory_limit') . 'M <hr />';
    return $out;
}

add_shortcode('weaver_info', 'weaverii_sc_info');

// ADD Quick Cache support...
function weaverii_sc_check_quick_cache() {
    if (!current_user_can('edit_theme_options'))
        return '';  // fail quietly

    if ( isset($GLOBALS['quick_cache__advanced_cache']) )
        $ac = $GLOBALS['quick_cache__advanced_cache'];
    else
        return '';

    $ac_dir = WP_CONTENT_DIR . '/ac-plugins';
    if ( !is_dir( $ac_dir) ) {          // need to create the ac directory...
        mkdir($ac_dir, 0755, TRUE);
    }

    $ac_file = $ac_dir . '/weaver-ac-plugin.php';

    if (!is_writable($ac_dir))
        return $ac_dir . 'not writable.';

    if ( is_file($ac_file) )
        return ''; // Already created...


    $ac_template = dirname(__FILE__).'/weaver-ac-plugin.php';

    if(!is_file($ac_template) || !is_readable($ac_template))
        return $ac_template . ' template file not found'; // Template file is missing; or not readable.

    if(!($ac_contents = file_get_contents($ac_template)))
        return $ac_template . ' template file not readable';; // Template file is missing; or is not readable.


    if(!file_put_contents($ac_file, $ac_contents))
        return ' unable to create file: ' . $ac_file; // Failure; could not write file.

    return ''; // All done :-)
}

?>
