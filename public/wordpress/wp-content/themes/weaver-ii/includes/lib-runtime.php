<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
/* Weaver II - runtime utils
 *
 * needed both at admin time and runtime
 */

// # CONTENTS

// # OPTIONS
// # PER PAGE OPTIONS
// # WIDGET AREA OPTIONS
// # HTML CODE AREAS
// # RUNTIME SAPI HELPER FUNCTIONS
// # PAGE WITH POSTS
// # FILTERS
// # MISC
// # OTHER UTILS

// # Weaver II Globals ==============================================================
$weaverii_opts_cache = false;   // internal cache for all settings
$weaverii_cur_page_ID = false;  // the ID of the current page
$weaverii_cur_post_id = false;  // the ID of the current page
$weaverii_cur_post_count = 0;   // to keep track of even/odd
$weaverii_cur_template = '';    // current page template - set in functions.php setup
$weaverii_crumbs = false;
$weaverii_header = array();     // as of WP 3.4
$weaverii_timer = false;        // page generation timer
$weaverii_mobile = false;       // mobile device data
$weaverii_mobile_view = true;   // show as mobile view if mobile (used with view icon)
$weaverii_sc_opts = array();    // shortcode opts
$weaverii_sticky = false;
$weaverii_header_who = '';

// # OPTIONS ==============================================================


function weaverii_getopt($opt) {
	global $weaverii_opts_cache;
	weaverii_opt_cache();

	if (!isset($weaverii_opts_cache[$opt]))     // handles changes to data structure
	  {
		return false;
	  }
	return $weaverii_opts_cache[$opt];
}

function weaverii_getopt_checked($opt) {
	global $weaverii_opts_cache;
	weaverii_opt_cache();

	if (!isset($weaverii_opts_cache[$opt]))     // handles changes to data structure
	  {
		return false;
	  }
	if (!$weaverii_opts_cache[$opt]) return false;
	return true;
}

function weaverii_setopt($opt, $val, $save = true) {
	global $weaverii_opts_cache;
	if (!$weaverii_opts_cache)
		$weaverii_opts_cache = get_option( apply_filters('weaver_options','weaverii_settings') ,array());

	$weaverii_opts_cache[$opt] = $val;
	if ($save) {
		weaverii_wpupdate_option('weaverii_settings',$weaverii_opts_cache, 'setopt:' . $opt);
	}
}

function weaverii_delete_all_options() {
	global $weaverii_opts_cache;
	$weaverii_opts_cache = false;
	if (current_user_can( 'manage_options' ))
		delete_option( apply_filters('weaver_options','weaverii_settings') );
}

function weaverii_wpupdate_option( $name, $opts, $who='') {
	if (current_user_can( 'edit_theme_options' )) {
		update_option(apply_filters('weaver_options',$name), $opts);
        $GLOBALS['wvrNoSettings'] = false;  // user has saved something.
	}
}

function weaverii_update_options($id) {
	global $weaverii_opts_cache;
	if (!$weaverii_opts_cache)
		$weaverii_opts_cache = get_option( apply_filters('weaver_options','weaverii_settings') ,array());
	weaverii_wpupdate_option('weaverii_settings',$weaverii_opts_cache, 'update_options:' . $id);
}


function weaverii_save_opts($who='') {
	// Save options
	// Here's the strategy. Using weaverii_getopt always loads the cache if it hasn't been.
	// Using weaverii_setopt will save the cache to the database by default
	// So we take advantage of this by bumping the style version, and using weaverii_setopt,
	// which saves to the database

    if ( weaverii_no_settings() )   // don't save before user has set something
        return;

	if (weaverii_f_file_access_available()) {   // and now is the time to update the style file
		require_once('generatecss.php');
		weaverii_save_current_css();
	}
}

function weaverii_e_opt($opt,$str) {
	if (weaverii_getopt_checked($opt))
		echo $str;
}

function weaverii_e_notopt($opt,$str) {
	if (!weaverii_getopt_checked($opt))
		echo $str;
}

// # PER PAGE OPTIONS =========================================================
function weaverii_get_per_page_value($name) {
	global $weaverii_cur_page_ID;
	return get_post_meta($weaverii_cur_page_ID,$name,true);
}

function weaverii_get_per_post_value($meta_name) {
	global $weaverii_cur_post_id;

	return get_post_meta($weaverii_cur_post_id,$meta_name,true);  // retrieve meta value
}

function weaverii_is_checked_post_opt($meta_name) {
	// the standard is to check options to hide things
	global $weaverii_cur_post_id;

	$val = get_post_meta($weaverii_cur_post_id,$meta_name,true);  // retrieve meta value
	if (!empty($val)) return true;              // value exists - 'on'
	return false;
}

function weaverii_is_checked_page_opt($meta_name) {
	// the standard is to check options to hide things
	global $weaverii_cur_page_ID;

	$val = get_post_meta($weaverii_cur_page_ID,$meta_name,true);  // retrieve meta value
	if (!empty($val)) return true;              // value exists - 'on'
	return false;
}

function weaverii_page_posts_error($info='') {
	echo('<h2 style="color:red;">WARNING: error defining Custom Field on Page with Posts.</h2>');
	if (strlen($info) > 0) echo('More info: '.$info.'<br />');
}

// # Shortcode (transient) OPTIONS ======================================================
function weaverii_sc_getopt($name) {
	// get a shortcode temporary opt
	global $weaverii_sc_opts;
	if (isset($weaverii_sc_opts[$name])) return $weaverii_sc_opts[$name];
	return false;
}

function weaverii_sc_reset_opts() {
	global $weaverii_sc_opts;
	$weaverii_sc_opts = array();        // clear out with a new array
}

function weaverii_sc_setopt($name,$val) {
	global $weaverii_sc_opts;
	$weaverii_sc_opts[$name] = $val;
}

// # WIDGET AREA OPTIONS ======================================================
function weaverii_replace_area($area,$style,$extraclass='') {
	global $weaverii_cur_page_ID;

	$extra = trim(get_post_meta($weaverii_cur_page_ID,$area,true));
	$area = 'per-page-' . $extra;  // retrieve meta value

	if (strlen($extra) > 0) {           // want to display some areas
		if (!weaverii_check_perpage_exists($area,$style))
			return true;        // must be true so we don't get double area ids
		if ( !is_active_sidebar($area)) {
			return false;
		}
		ob_start(); /* let's use output buffering to allow use of Dynamic Widgets plugin and not have empty sidebar */
		$success = dynamic_sidebar($area);
		$content = ob_get_clean();
		if ($success) {
		?>
			<div id="<?php echo $style; ?>" class="widget-area <?php echo $area . ' ' . $extraclass; ?>" role="complementary" >
			<?php echo($content) ; ?>
			</div>
		<?php
			return true;
		}
		return false;
	}
	return false;
}

function weaverii_replace_primary() {
	return weaverii_replace_area('ttw_show_replace_primary','sidebar_primary');
}

function weaverii_replace_left() {
	return weaverii_replace_area('ttw_replace_left','sidebar_left');
}

function weaverii_replace_right() {
	return weaverii_replace_area('ttw_replace_right','sidebar_right');
}

function weaverii_put_perpage_widgetarea() {
	if ( is_search() || is_archive())
		return;
	weaverii_trace_sidebar(__FILE__ . ':put_perpage_widgetarea');
	return weaverii_replace_area('ttw_show_extra_areas','per-page-widget', 'sidebar_top');
}


// # HTML CODE AREAS ==========================================================

// function weaverii_put_area($name) now in functions.php as weaverii_inject_area

// # RUNTIME SAPI HELPER FUNCTIONS ============================================

function weaverii_sapi_options_init() {
	/* this will initialize the SAPI stuff, must be called from the admin_init cb function .
		In reality, we really only need to register one setting - 'weaverii_main_settings_group',
		and the settings will be saved in the WP DB as 'weaverii_main_settings'. The SAPI uses
		the name param of any <input> fields to figure out where to store the input value.

		The validation will have to scan the ENTIRE list of options and lookup the kind of
		validation each parameter needs.
	*/

	register_setting('weaverii_settings_group', /* the group name of our settings */
		apply_filters('weaver_options','weaverii_settings'),    /* the get_option name */
		'weaverii_validate_cb');                        /* a validation call back */
}

function weaverii_validate_cb($in) {
	// keep the definition in runtime, load as needed at admin time
require_once( dirname( __FILE__ ) . '/lib-admin.php' );

	return weaverii_validate_all_options($in);
}

/*
	================= nonce helpers =====================
*/
function weaverii_submitted($submit_name) {
	// do a nonce check for each form submit button
	// pairs 1:1 with weaverii_nonce_field
	$nonce_act = $submit_name.'_act';
	$nonce_name = $submit_name.'_nonce';

	if (isset($_POST[$submit_name])) {
		if (isset($_POST[$nonce_name]) && wp_verify_nonce($_POST[$nonce_name],$nonce_act)) {
			return true;
		} else {
			die("WARNING: invalid form submit detected ($submit_name). Probably caused by session time-out, or, rarely, a failed security check. Please contact WeaverTheme.com if you continue to receive this message.");
		}
	} else {
		return false;
	}
}

function weaverii_nonce_field($submit_name,$echo = true) {
	// pairs 1:1 with wii_sumbitted
	// will be one for each form submit button

	return wp_nonce_field($submit_name.'_act',$submit_name.'_nonce',$echo);
}

// # PAGE WITH POSTS ==============================================================

function weaverii_get_page() {
	/* get the current posts display number
	  needed for when Page with Posts is front page
	*/
	$paged = get_query_var('paged');
		if (!isset($paged) || empty($paged)) {
				$paged = 1;
		}
	$page = get_query_var( 'page' );
	if ( $page > 1)
		$paged = $page;
	return $paged;
}

function weaverii_setup_post_args($args) {
   /* setup WP_Query arg list */

	$cats = weaverii_get_page_categories();
	if (!empty($cats)) $args['cat'] = $cats;

	$tags = weaverii_get_page_tags();
	if (!empty($tags)) $args['tag'] = $tags;

	$onepost = weaverii_get_page_onepost();
	if (!empty($onepost)) $args['name'] = $onepost;

	$orderby = weaverii_get_page_orderby();
	if (!empty($orderby)) $args['orderby'] = $orderby;

	$order = weaverii_get_page_order();
	if (!empty($order)) $args['order'] = $order;

	$author_name = weaverii_get_page_author();
	if (!empty($author_name)) {
		$nosp = str_replace(' ', '', $author_name);
		$id_list=str_replace(',','',$nosp);
		if (is_numeric($id_list)) {
			$args['author'] = $author_name;
		} else {
			$args['author_name'] = $author_name;
		}
	}

	$posts_per_page = weaverii_get_page_posts_per();
	if (!empty($posts_per_page)) $args['posts_per_page'] = $posts_per_page;

	$post_type = weaverii_get_per_page_value('wvr_post_type');
	if ($post_type)
		$args['post_type'] = $post_type;

	if (weaverii_is_checked_page_opt('ttw_hide_sticky')) $args['ignore_sticky_posts'] = true;


	return $args;
}

function weaverii_get_page_categories() {
	$cats = weaverii_get_per_page_value('ttw_category');
	if (empty($cats)) return '';
	// now convert slugs to ids
	return weaverii_cat_slugs_to_ids($cats);
}

function weaverii_cat_slugs_to_ids($cats) {
	if (empty($cats)) return '';
	// now convert slugs to numbers
	$cats = str_replace(' ','',$cats);
	$clist = explode(',',$cats);        // break into a list
	$cat_list = '';
	foreach ($clist as $slug) {
		$neg = 1;       // not negative
		if ($slug[0] == '-') {
			$slug = substr($slug,1);    // zap the -
			$neg = -1;
		}
		if (strlen($slug) > 0 && is_numeric($slug)) { // allow both slug and id
			$cat_id = $neg * (int)$slug;
			if ($cat_list == '') $cat_list = strval($cat_id);
			else $cat_list .= ','.strval($cat_id);
		} else {
			$cur_cat = get_category_by_slug($slug);
			if ($cur_cat) {
				$cat_id = $neg * (int)$cur_cat->cat_ID;
				if ($cat_list == '') $cat_list = strval($cat_id);
				else $cat_list .= ','.strval($cat_id);
			}
		}
	}
	if (empty($cat_list)) $cat_list='99999999';
	return $cat_list;
}

function weaverii_get_page_tags() {
	$tags = weaverii_get_per_page_value('ttw_tag');
	if (empty($tags)) return '';
	return str_replace(' ','',$tags);
}
function weaverii_get_page_onepost() {
	$the_post = weaverii_get_per_page_value('ttw_onepost');
	if (empty($the_post)) return '';
	return $the_post;
}
function weaverii_get_page_orderby() {
	$orderby = weaverii_get_per_page_value('ttw_orderby');
	if (empty($orderby)) return '';

	if ($orderby == 'author' || $orderby == 'date' || $orderby == 'title' || $orderby == 'rand')
		return $orderby;
	weaverii_page_posts_error('orderby must be author, date, title, or rand. You used: '. $orderby);
	return '';
}
function weaverii_get_page_order() {
	$order = weaverii_get_per_page_value('ttw_order');
	if (empty($order)) return '';
	if ($order == 'ASC' || $order == 'DESC')
		return $order;
	weaverii_page_posts_error('order value must be ASC or DESC. You used: '. $order);
	return '';
}
function weaverii_get_page_posts_per() {
	$ppp = weaverii_get_per_page_value('ttw_posts_per_page');
	if (empty($ppp)) return '';
	// now convert slugs to numbers
	return $ppp;
}
function weaverii_get_page_author() {
	$author = weaverii_get_per_page_value('ttw_author');
	if (empty($author)) return '';
	return $author;
}


function weaverii_add_q($q, $item, $tag='') {
	if ($item == '') return $q;

	if (!empty($q))
		return $q . '&' . $tag . $item;
	else
		return $tag . $item;
}

function weaverii_check_perpage_exists($area,$styleid) {
	$sidebars_widgets = wp_get_sidebars_widgets();
	if ( empty($sidebars_widgets[$area]) ) { ?>
		<div id="<?php echo $styleid; ?>" class="widget-area <?php echo $area; ?>" role="complementary" ><ul class="xoxo">
			<?php echo("<strong>Note: Per Page widget area: $area not found.</strong> You've likely mistyped the name, haven't defined the area yet, or haven't added a widget.") ; ?>
			</ul>
		</div>
		<?php
		return false;
	}
	return true;
}

// # FILTERS ==============================================================

//  ============ validation filters ===============

function weaverii_filter_textarea( $text ) {
	// virtually all option text input from Weaver II can be code, and thus must not be
	// content filtered. Treat like code for now....
	return weaverii_filter_code($text);
}

function weaverii_esc_textarea($text) {
	echo esc_textarea(stripslashes($text));
}

function weaverii_filter_code( $text ) {
	static $weaverii_allowedadmintags = array(
				'address' => array(),
				'a' => array(
						'class' => array (),
						'href' => array (),
						'id' => array (),
						'title' => array (),
						'rel' => array (),
						'rev' => array (),
						'name' => array (),
						'target' => array()),
				'abbr' => array(
						'class' => array (),
						'title' => array ()),
				'acronym' => array(
						'title' => array ()),
				'article' => array(
						'align' => array (),
						'class' => array (),
						'dir' => array (),
						'lang' => array(),
						'style' => array (),
						'xml:lang' => array(),
				),
				'aside' => array(
						'align' => array (),
						'class' => array (),
						'dir' => array (),
						'lang' => array(),
						'style' => array (),
						'xml:lang' => array(),
				),
				'b' => array(),
				'big' => array(),
				'blockquote' => array(
						'id' => array (),
						'cite' => array (),
						'class' => array(),
						'lang' => array(),
						'xml:lang' => array()),
				'br' => array (
						'class' => array ()),
				'button' => array(
						'disabled' => array (),
						'name' => array (),
						'type' => array (),
						'value' => array ()),
				'caption' => array(
						'align' => array (),
						'class' => array ()),
				'cite' => array (
						'class' => array(),
						'dir' => array(),
						'lang' => array(),
						'title' => array ()),
				'code' => array (
						'style' => array()),
				'col' => array(
						'align' => array (),
						'char' => array (),
						'charoff' => array (),
						'span' => array (),
						'dir' => array(),
						'style' => array (),
						'valign' => array (),
						'width' => array ()),
				'del' => array(
						'datetime' => array ()),
				'dd' => array(),
				'details' => array(
						'align' => array (),
						'class' => array (),
						'dir' => array (),
						'lang' => array(),
						'open' => array (),
						'style' => array (),
						'xml:lang' => array(),
				),
				'div' => array(
						'align' => array (),
						'class' => array (),
						'dir' => array (),
						'lang' => array(),
						'style' => array (),
						'xml:lang' => array()),
				'dl' => array(),
				'dt' => array(),
				'em' => array(),
				'fieldset' => array(),
				'figure' => array(
						'align' => array (),
						'class' => array (),
						'dir' => array (),
						'lang' => array(),
						'style' => array (),
						'xml:lang' => array(),
				),
				'figcaption' => array(
						'align' => array (),
						'class' => array (),
						'dir' => array (),
						'lang' => array(),
						'style' => array (),
						'xml:lang' => array(),
				),
				'font' => array(
						'color' => array (),
						'face' => array (),
						'size' => array ()),
				'footer' => array(
						'align' => array (),
						'class' => array (),
						'dir' => array (),
						'lang' => array(),
						'style' => array (),
						'xml:lang' => array(),
				),
				'form' => array(
						'action' => array (),
						'accept' => array (),
						'accept-charset' => array (),
						'enctype' => array (),
						'method' => array (),
						'name' => array (),
						'target' => array ()),
				'h1' => array(
						'align' => array (),
						'class' => array (),
						'id'    => array (),
						'style' => array ()),
				'h2' => array (
						'align' => array (),
						'class' => array (),
						'id'    => array (),
						'style' => array ()),
				'h3' => array (
						'align' => array (),
						'class' => array (),
						'id'    => array (),
						'style' => array ()),
				'h4' => array (
						'align' => array (),
						'class' => array (),
						'id'    => array (),
						'style' => array ()),
				'h5' => array (
						'align' => array (),
						'class' => array (),
						'id'    => array (),
						'style' => array ()),
				'h6' => array (
						'align' => array (),
						'class' => array (),
						'id'    => array (),
						'style' => array ()),
				'header' => array(
						'align' => array (),
						'class' => array (),
						'dir' => array (),
						'lang' => array(),
						'style' => array (),
						'xml:lang' => array(),
				),
				'hr' => array (
						'align' => array (),
						'class' => array (),
						'noshade' => array (),
						'size' => array (),
						'width' => array ()),
				'i' => array(),
				'img' => array(
						'alt' => array (),
						'align' => array (),
						'border' => array (),
						'class' => array (),
						'height' => array (),
						'hspace' => array (),
						'longdesc' => array (),
						'vspace' => array (),
						'src' => array (),
						'style' => array (),
						'width' => array ()),
				'ins' => array(
						'datetime' => array (),
						'cite' => array ()),
				'kbd' => array(),
				'label' => array(
						'for' => array ()),
				'legend' => array(
						'align' => array ()),
				'li' => array (
						'align' => array (),
						'class' => array ()),
                'link' => array(),
				'menu' => array (
						'class' => array (),
						'style' => array (),
						'type' => array ()),
                'meta' => array(),
				'nav' => array(
						'align' => array (),
						'class' => array (),
						'dir' => array (),
						'lang' => array(),
						'style' => array (),
						'xml:lang' => array(),
				),
				'p' => array(
						'class' => array (),
						'align' => array (),
						'dir' => array(),
						'lang' => array(),
						'style' => array (),
						'xml:lang' => array()),
				'pre' => array(
						'style' => array(),
						'width' => array ()),
				'q' => array(
						'cite' => array ()),
				's' => array(),
				//'script' => array(),          // only admin or multi-site super-admin can add scripts
				'span' => array (
						'class' => array (),
						'dir' => array (),
						'align' => array (),
						'lang' => array (),
						'style' => array (),
						'title' => array (),
						'xml:lang' => array()),
				'section' => array(
						'align' => array (),
						'class' => array (),
						'dir' => array (),
						'lang' => array(),
						'style' => array (),
						'xml:lang' => array(),
				),
				'strike' => array(),
				'strong' => array(),
				'style' => array(),
				'sub' => array(),
				'summary' => array(
						'align' => array (),
						'class' => array (),
						'dir' => array (),
						'lang' => array(),
						'style' => array (),
						'xml:lang' => array(),
				),
				'sup' => array(),
				'table' => array(
						'align' => array (),
						'bgcolor' => array (),
						'border' => array (),
						'cellpadding' => array (),
						'cellspacing' => array (),
						'class' => array (),
						'dir' => array(),
						'id' => array(),
						'rules' => array (),
						'style' => array (),
						'summary' => array (),
						'width' => array ()),
				'tbody' => array(
						'align' => array (),
						'char' => array (),
						'charoff' => array (),
						'valign' => array ()),
				'td' => array(
						'abbr' => array (),
						'align' => array (),
						'axis' => array (),
						'bgcolor' => array (),
						'char' => array (),
						'charoff' => array (),
						'class' => array (),
						'colspan' => array (),
						'dir' => array(),
						'headers' => array (),
						'height' => array (),
						'nowrap' => array (),
						'rowspan' => array (),
						'scope' => array (),
						'style' => array (),
						'valign' => array (),
						'width' => array ()),
				'textarea' => array(
						'cols' => array (),
						'rows' => array (),
						'disabled' => array (),
						'name' => array (),
						'readonly' => array ()),
				'tfoot' => array(
						'align' => array (),
						'char' => array (),
						'class' => array (),
						'charoff' => array (),
						'valign' => array ()),
				'th' => array(
						'abbr' => array (),
						'align' => array (),
						'axis' => array (),
						'bgcolor' => array (),
						'char' => array (),
						'charoff' => array (),
						'class' => array (),
						'colspan' => array (),
						'headers' => array (),
						'height' => array (),
						'nowrap' => array (),
						'rowspan' => array (),
						'scope' => array (),
						'valign' => array (),
						'width' => array ()),
				'thead' => array(
						'align' => array (),
						'char' => array (),
						'charoff' => array (),
						'class' => array (),
						'valign' => array ()),
				'title' => array(),
				'tr' => array(
						'align' => array (),
						'bgcolor' => array (),
						'char' => array (),
						'charoff' => array (),
						'class' => array (),
						'style' => array (),
						'valign' => array ()),
				'tt' => array(),
				'u' => array(),
				'ul' => array (
						'class' => array (),
						'style' => array (),
						'type' => array ()),
				'ol' => array (
						'class' => array (),
						'start' => array (),
						'style' => array (),
						'type' => array ()),
				'var' => array ());
	// virtually all option input from Weaver II can be code, and thus must not be
	// content filtered. The utf8 check is about the extent of it, although even
	// that is more restrictive than the standard text widget uses.
	// Note: this check also works OK for simple checkboxes/radio buttons/selections,
	// so it is ok to blindly pass those options in here, too.
	$noslash = trim(stripslashes($text));
	if ($noslash == ' ') return '';

	if ( current_user_can('unfiltered_html') ) {
		return wp_check_invalid_utf8( $noslash );
	} else if (current_user_can('add_users')) {
		return wp_kses( $text , $weaverii_allowedadmintags);
	} else {
		return stripslashes( wp_filter_post_kses( addslashes($text) ) ); // wp_filter_post_kses() expects slashed
	}
}

// # MISC ==============================================================
function weaverii_t_($t) {
	// translation tool stub
	return $t;
}

function weaverii_media_lib_button($fillin = '') {
?>
&nbsp;&larr;&nbsp;<a style='text-decoration:none;' href="javascript:weaverii_media_lib('<?php echo $fillin;?>');" ><img src="<?php echo weaverii_relative_url('images/theme/media-button.png'); ?>" title="Select image from Media Library. Click 'Insert into Post' to paste url here." alt="media" /></a>
<?php
}

function weaverii_site($sub='', $site = 'http://weavertheme.com', $title = '') {
	if ($title == '') $title = $site;
	echo '<a href="' . esc_url($site . $sub) . '" target="_blank" title="' . $title . '">';
}

function weaverii_smart_mode() {
	return strpos( weaverii_getopt('_wii_mode_mobile'), 'smart' ) !== false;
}

function weaverii_post_count_clear() {
	global $weaverii_cur_post_count;
	$weaverii_cur_post_count = 0;
}

function weaverii_post_count_bump() {
	global $weaverii_cur_post_count;
	$weaverii_cur_post_count++;
}

function weaverii_post_count() {
	global $weaverii_cur_post_count;
	return $weaverii_cur_post_count;
}

function weaverii_post_count_class($hidecount = false) {
	global $weaverii_cur_post_count;
	global $weaverii_sticky;

	if ($weaverii_sticky)       // For page with posts - re-ordering sticky posts
		$postclass = weaverii_get_per_post_value('postclass') . ' sticky ';
	else
		$postclass = weaverii_get_per_post_value('postclass') . ' ';

	if ($weaverii_cur_post_count == 0 || $hidecount) return $postclass;
	return $postclass . 'post-' . (($weaverii_cur_post_count % 2) ? 'odd' : 'even') . ' post-order-' . $weaverii_cur_post_count;
}

function weaverii_use_inline_css($css_file) {
	 return weaverii_getopt_checked('_wii_inline_style') || !weaverii_f_file_access_available()
	 || !weaverii_f_exists($css_file) || weaverii_dev_mode();
}

function weaverii_hide_page_title() {
	if (weaverii_is_checked_page_opt('ttw-hide-page-title')) {
		echo ' wvr-hide';       // is included in a class=
	}
}

function weaverii_allow_multisite() {
	// return true if it is allowed to use on MultiSite

	$restrict =  (defined('WEAVERII_MULTISITE_RESTRICT_OPTIONS')) ? WEAVERII_MULTISITE_RESTRICT_OPTIONS : false;

	return ((!is_multisite() && current_user_can('install_themes'))
		|| (is_multisite() && current_user_can('manage_network_themes'))
		|| !$restrict);
}

function weaverii_help_link($link, $info) {
	$t_dir = weaverii_relative_url('');
	$pp_help =  '<a href="' . $t_dir . 'help/' . $link . '" target="_blank" title="' . $info . '">'
				. '<img class="entry-cat-img" src="' . $t_dir . 'images/icons/help-1.png" style="position:relative; top:4px; padding-left:4px;" title="Click for help" alt="Click for help" /></a>';
	echo($pp_help);
}

function weaverii_html_br() {
	echo ' <br /> ';
}

function weaverii_compact_post() {
	return weaverii_getopt('compact_post_formats') || weaverii_is_checked_page_opt('wvr_pwp_compact');
}

function weaverii_get_first_post_image($content='') {
	if (has_post_thumbnail()) {
		$img = wp_get_attachment_image_src( get_post_thumbnail_id( ), 'medium' );
		return '<img class="format-image-img" src="' . esc_url($img[0]) . '" "alt="post image" />';
	}

	if ($content == '')
		$content = do_shortcode(apply_filters( 'the_content', get_the_content('')));    // pick up wp 3.6 post format meta image
	if (preg_match('/<img[^>]+>/i',$content, $images)) {        // grab <img>s
		$src = '';
		if (preg_match('/src="([^"]*)"/', $images[0], $srcs)) {
			$src = $srcs[0];
		} else if (preg_match("/src='([^']*)'/", $images[0], $srcs)) {
			$src = $srcs[0];
		}
		return '<img class="format-image-img" ' . $src . 'alt="post image" />';
	} else {
		return '';
	}
}

function weaverii_compact_link($check = '') {
	if ($check == 'check' && !weaverii_is_checked_post_opt('post_add_link'))
		return;

	$link_img =  weaverii_relative_url('') . 'images/icons/expand.png';
?>
	<div><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( 'echo=1' ); ?>" rel="bookmark">
<img src="<?php echo $link_img; ?>" /></a></div>
<?php
}

/* Breadcrumbs
 * Credit: Dimox
 *      http://dimox.net/wordpress-breadcrumbs-without-a-plugin/
 */
if (!function_exists('weaverii_breadcrumb')) {
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
	if ( is_category() ) {
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
	elseif ( ! is_front_page() && is_page() && $post->post_parent ) {
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
	if ( get_query_var('paged') && ! function_exists( 'wp_paginate' ) ) {
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
}

/**
 * Paginate Archive Index Page Links
 *
 * Code based on codex examples
 */

if (!function_exists('weaverii_get_paginate_archive_page_links')) {
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

		if ( !empty($wp_query->query_vars['s']) )
				$pagination['add_args'] = array( 's' => get_query_var( 's' ) );

		return paginate_links( $pagination );
}
}

// # MOBILE ===================================================================
function weaverii_setup_mobile() {

	global $weaverii_mobile, $weaverii_mobile_view;
	$weaverii_mobile = false;
	$weaverii_mobile_view = false;

	if (weaverii_disable_mobile())
		return;

	// see if we switched modes
	if (!empty($_GET['weaverii_mobile_toggle'])) {      // check for ?weaverii_mobile_toggle action
		$url = parse_url(home_url( '/' ));
		$domain = $url['host'];
		$path = '/';
		$redirect = false;
		switch ($_GET['weaverii_mobile_toggle']) {
			case 'web_view':
				setcookie('weaverii_mobile','false',time()+7200, $path,$domain);        // 2 hours
				$redirect = true;
				break;
			case 'mobile_view':
				setcookie('weaverii_mobile','true',time()-7200, $path,$domain);         // delete cookie if mobile view
				$redirect = true;
				break;
			default:
				break;
		}
		if ($redirect) {
			$go = home_url( '/' );
			if (is_front_page()) {      // redirect if mobile?
				$new_home = weaverii_getopt('wii_mobile_home_int');
				if ($new_home && $_GET['weaverii_mobile_toggle'] == 'mobile_view') {
					$go = get_permalink( $new_home );
				}
			} else if (false && !empty($_SERVER['HTTP_REFERER'])) {
				$go = $_SERVER['HTTP_REFERER'];
			}

			header('Location: '.$go);
			// header('Location: http://google.com');
			die();
		}
	}

	$weaverii_mobile = false;

	if (isset($_SERVER["HTTP_USER_AGENT"]) ) {
		$agent = $_SERVER['HTTP_USER_AGENT'];

		// these need to be searched in this order because Android will end up catching most devices in 2012
		$devices = array(
		'A100'          => 'tablet,android',            // Acer: 1024x768
		'A500'          => 'tablet,android',            // Acer A500:1280x768
		'hp-tablet'     => 'tablet',                    // HP: 1024x768
		'iPad'          => 'tablet,ios',                // 1024x768
		'GT-P7'         => 'tablet,android',            // Galaxy Tab 10: 1280x800
		'LG-V900'       => 'tablet,android',            // LG Optimus Pad:1280x768
		'ThinkPad'      => 'tablet,android',            // Lenovo ThinkPad: 1280x800
		'Xoom'          => 'tablet,android',            // Motorola Xoom: 1280x800
		'WeaverMobileTablet' => 'tablet,wvrsim',        // For simulation

		'A1_07'         => 'smalltablet,android',       // Lenovo IdeaPad A1 (8/2012)
		'BNTV250'       => 'smalltablet,android',       // NOOK:1024x600
		'NOOK'          => 'smalltablet,android',
		'GT-P3'         => 'smalltablet,android',       // Galaxy Tab 7: 1024x600 (assume smaller)
		'SCH-I800'      => 'smalltablet,android',       // Galaxy Tab 7 (8/2012)
		'Nexus 7'       => 'smalltablet,android',       // Google Nexus 7 (8/2012)
		'HTC_Salsa'     => 'smalltablet,android',       // HTC Flyer 1024x600 HTC_Salsa_C510
		'Kindle Fire'   => 'smalltablet,kindle',        // 1024x600 (android)
		'Silk'          => 'smalltablet,kindle',        // 1024x600 (android)
		'NXM901'        => 'smalltablet,android',       // Nextbook: 800x600
		'RIM Tablet'    => 'smalltablet,android',       // PlayBook, RIM Tablet 1024x600
		'TSB_CLOUD_COMPANION' => 'smalltablet,android', // TOSHIBA (maybe 600?)
		'OliPad'        => 'smalltablet,android',       // Olivetti: 1024x600
		'Opera Tablet'  => 'smalltablet',
		'WeaverMobileSmallTablet' => 'smalltablet,wvrsim',      // for sim

		'Opera Mini'    => 'touch,flat',                // must be here - opera mini needs flat menus
		'Opera Mobi'    => 'touch,flat',
		'iPod'          => 'touch,ios',
		'iPhone'        => 'touch,ios',
		'Android'       => 'touch,android',
		'IEMobile'      => 'touch,ie',

		'BlackBerry9'   => 'touch',
		'BB10'          => 'touch',
		'LG-TU915 Obigo'=> 'touch', // LG touch browser
		'LGE VX'        => 'touch',
		'webOS'         => 'touch', // Palm Pre, etc.
		'Nokia5'        => 'touch',
		'WeaverMobileFlat'      => 'touch,flat',        // for simulation
		'WeaverMobile'  => 'touch,wvrsim',              // for simulation

		'2.0 MMP'       => 'mobile',
		'240x320'       => 'mobile',
		'400X240'       => 'mobile',
		'AvantGo'       => 'mobile',
		'BlackBerry'    => 'mobile',
		'Blazer'        => 'mobile',
		'Cellphone'     => 'mobile',
		'Danger'        => 'mobile',
		'DoCoMo'        => 'mobile',
		'Elaine'        => 'mobile',
		'EudoraWeb'     => 'mobile',
		'Googlebot-Mobile'=> 'mobile',
		'hiptop'        => 'mobile',
		'KYOCERA'       => 'mobile',
		'LG/U990'       => 'mobile',
		'MMEF20'        => 'mobile',
		'MOT'           => 'mobile',
		'NetFront'      => 'mobile',
		'Newt'          => 'mobile',
		'Nintendo Wii'  => 'mobile',
		'Nitro'         => 'mobile', // Nintendo DS
		'Nokia'         => 'mobile',
		'Palm'          => 'mobile',
		'PlayStation Portable'  => 'mobile',
		'portalmmm'     => 'mobile',
		'Proxinet'      => 'mobile',
		'ProxiNet'      => 'mobile',
		'SHARP'         => 'mobile',
		'SHG'           => 'mobile',
		'Small'         => 'mobile',
		'SonyEricsson'  => 'mobile',
		'Symbian'       => 'mobile',
		'TS21i-10'      => 'mobile',
		'UP.Browser'    => 'mobile',
		'UP.Link'       => 'mobile',
		'Windows CE'    => 'mobile',
		'WinWAP'        => 'mobile',
		'YahooSeeker'   => 'mobile',
		'Alcatel'       => 'mobile',
		'Dmobo'         => 'mobile',
		'Gradiente'     => 'mobile',
		'GRUNDIG'       => 'mobile',
		'HTC'           => 'mobile',
		'Mitsu'         => 'mobile',
		'Motorola'      => 'mobile',
		'PANTECH'       => 'mobile',
		'Samsung'       => 'mobile',
		'SAMSUNG'       => 'mobile',
		'Siemens'       => 'mobile',
		'Vodafone'      => 'mobile',
		'Smartphone'    => 'mobile',
		);

		foreach ($devices as $browser => $type_os) {
			if (strpos($agent,$browser) !== false) {
				$type = explode(',',$type_os);
				if (!isset($type[1]) || !$type[1])
					$type[1] = 'generic';
				$weaverii_mobile = array();
				$weaverii_mobile['browser'] = $browser;
				$weaverii_mobile['type'] = $type[0];
				$weaverii_mobile['os'] = (isset($type[1]) && $type[1]) ? $type[1] : 'generic';
				if ($browser == 'Android') {
					if (strpos($agent,'Mobile') === false)
						$weaverii_mobile['type'] = 'tablet';    // Android tablets don't have Mobile in UA
				}
				break;
			}
		}
	}

	if (!$weaverii_mobile && weaverii_sim_mobile()) {
		$weaverii_mobile = array();
		switch (weaverii_getopt('_wii_sim_mobile')) {
			case 'WeaverMobileSmallTablet':
				$weaverii_mobile['browser'] = 'WeaverMobileSmallTablet';        // Give a special name to simulation
				$weaverii_mobile['type'] = 'smalltablet';
				$weaverii_mobile['os'] = 'generic';
				break;
			case 'WeaverMobileTablet':
				$weaverii_mobile['browser'] = 'WeaverMobileTablet';     // Give a special name to simulation
				$weaverii_mobile['type'] = 'tablet';
				$weaverii_mobile['os'] = 'generic';
				break;
			default:            // 'WeaverMobile'
				$weaverii_mobile['browser'] = 'WeaverMobile';   // Give a special name to simulation
				$weaverii_mobile['type'] = 'touch';
				$weaverii_mobile['os'] = 'generic';
				break;
		}
	}

	$weaverii_mobile_view = true;       // start by assuming we are using mobile view

	if (isset($_COOKIE['weaverii_mobile']) ) {  // cookie to change mobile view?
		if ( $_COOKIE['weaverii_mobile'] != 'true' )
			$weaverii_mobile_view = false;      // they want web view
	}

	if (weaverii_use_mobile('mobile') && is_front_page()) {     // redirect if mobile?
		$new_home = weaverii_getopt('wii_mobile_home_int');
		if ($new_home && $weaverii_mobile_view) {
			$url = get_permalink( $new_home );
			header('Location: ' . $url);
			die();
		}
	}

    if ( $weaverii_mobile && function_exists('wpsupercache_site_admin')) {     // fix for WP Super Cache
        define('DONOTCACHEPAGE', TRUE);
    }
}

function weaverii_is_mobile() {
	// are we on a mobile device? Doesn't matter about the view.
	global $weaverii_mobile;
	if (weaverii_sim_mobile())
		return true;
	return $weaverii_mobile ? $weaverii_mobile['browser'] : '';
}

function weaverii_mobile_usesf() {
	if (weaverii_use_mobile('any'))
		return !weaverii_getopt_checked('wii_mobile_nosf') && weaverii_mobile_getos() != 'flat';
}

function weaverii_get_mobile_browser() {
	// are we on a mobile device? Doesn't matter about the view.
	global $weaverii_mobile;
	return $weaverii_mobile['browser'];
}

function weaverii_disable_mobile() {
	if (weaverii_getopt_checked('_wii_mobile_disable'))
		return true;
	$model = weaverii_getopt('_wii_mode_mobile');

	return $model == 'weaver-mobile-responsive'
		||  $model == 'weaver-mobile-resp-nostack';
}

function weaverii_sim_mobile() {
	if (weaverii_disable_mobile())
		return false;
	$sim = weaverii_getopt('_wii_sim_mobile');
	if ($sim && $sim != 'none') {
		if (weaverii_getopt_checked('_wii_sim_mobile_always'))
			return true;
		if (current_user_can('edit_theme_options'))
			return true;
	}
	return false;
}

function weaverii_use_sf() {
	return weaverii_getopt('wii_use_superfish');
	// weaverii_mobile_usesf()) ) ? true : false;
}

function weaverii_in_mobile_view() {
	global $weaverii_mobile_view;
	return $weaverii_mobile_view;
}

function weaverii_use_mobile($type = 'any') {
	// Do we use mobile features?
	// Need the $skip_sim to avoid recursion on weaverii_getopt
	global $weaverii_mobile;

	if (!weaverii_in_mobile_view())
		return false;                   // user set cookie to use full view

	if (!$weaverii_mobile) return false;

	switch (apply_filters('weaverii_use_mobile',$type) ) {
		case 'mobile':
			return $weaverii_mobile['type'] == 'mobile' || $weaverii_mobile['type'] == 'touch' || $weaverii_mobile['type'] == 'smalltablet';
		case 'smalltablet':
			return $weaverii_mobile['type'] == 'smalltablet';
		case 'phone':
			return $weaverii_mobile['type'] == 'mobile' || $weaverii_mobile['type'] == 'touch';
		case 'touch':
			return $weaverii_mobile['type'] == 'touch';
		case 'tablet':
			return $weaverii_mobile['type'] == 'tablet';
		case 'any':
			return true;
		default:
			return false;
	}
	return false;
}

function weaverii_excerpt_mobile() {
	if (weaverii_use_mobile('mobile')) {
		return (!weaverii_getopt_checked('wii_mobile_full_posts'));
	} else {
		return false;
	}
}

function weaverii_mobile_gettype() {
	global $weaverii_mobile;
	return $weaverii_mobile['type'];
}
function weaverii_mobile_getos() {
	global $weaverii_mobile;
	return $weaverii_mobile['os'];
}

function weaverii_mobile_toggle($loc) {
	global $weaverii_mobile_view;

	if (weaverii_is_mobile() && weaverii_mobile_gettype() != 'tablet' && weaverii_getopt('wii_layout_view_toggle') != 'none') {
		$home = home_url( '/' );
		$how = weaverii_getopt('wii_layout_view_toggle');
		if (!$how) $how = 'both';
		if ($weaverii_mobile_view) {
			$url = weaverii_relative_url('images/icons/notebook.png');
			$mob = weaverii_getopt('_wvr_mobile_fullmsg');
			//$mob = 'Full View';
			if (!$mob) $link = '<img src="' . $url . '" alt="full" />';
			else $link = $mob;

			if ($loc == 'header' && ($how == 'top' || $how == 'both')) {
				echo '<span class="wvr-to-desktop-top">';
				echo '<a href="' . $home . '?weaverii_mobile_toggle=web_view" title="Switch to standard web view.">';
				echo $link;
				echo '</a></span><div class="weaver-clear"></div>';
			}
			if ($loc == 'footer' && ($how == 'bottom' || $how == 'both')) {
				echo '<div class="wvr-to-desktop-bottom">
				<a href="' . $home . '?weaverii_mobile_toggle=web_view" title="Switch to standard web view.">';
				echo $link;
				echo '</a></div><div class="weaver-clear"></div>';
			}
		} else {
			$url = weaverii_relative_url('images/icons/smartphone.png');
			$mob = weaverii_getopt('_wvr_mobile_mobilemsg');
			//$mob = 'Mobile';
			if (!$mob) $link = '<img src="' . $url . '" alt="mobile" />';
			else $link = $mob ;
			if ($loc == 'header' && ($how == 'top' || $how == 'both')) {
				echo '<span class="wvr-to-mobile-top">
					<a href="' . $home . '?weaverii_mobile_toggle=mobile_view" title="Switch to mobile view.">';
				echo $link;
				echo '</a></span><div class="weaver-clear"></div>';
			}
			if ($loc == 'footer' && ($how == 'bottom' || $how == 'both')) {
				echo '<div class="wvr-to-mobile-bottom">';
				echo '<a href="' . $home . '?weaverii_mobile_toggle=mobile_view" title="Switch to mobile view.">';
				echo $link;
				echo '</a></div><div class="weaver-clear"></div>';
			}
		}
	}
}

function weaverii_trace_mobile() {
	if (weaverii_dev_mode() && weaverii_getopt_checked('_wii_diag_trace_mobile')) {
		global $weaverii_mobile;
		$device = $weaverii_mobile;
		$msg = $device ? $device['browser'] . '/' . $device['type'] : 'Not Mobile';
		$agent = false;
		if (isset($_SERVER["HTTP_USER_AGENT"]) )
			$agent = $_SERVER['HTTP_USER_AGENT'];
		if ($agent) echo $agent;
		echo "<h2>**** $msg ****</h2>\n";
	}
	if (weaverii_sim_mobile()) {
		global $weaverii_mobile;
		$device = $weaverii_mobile;
?>
<div class="aligncenter" style="border:1px solid red;background:#FFAAAA;width:320px;text-align:center;">
<strong>Weaver Mobile Device Simulator</strong> <?php echo ' (' . $device['type'] . ')' ; ?>
<strong class="ie-show">* Sorry - simulator incompatible with IE7 and IE8. *</strong>

</div>
<?php
	}
}

// ============================ MOBILE MENU ======================================
function weaverii_mobile_menu_bar($mobile_id, $menu_id, $nohome = '') {
	if (weaverii_getopt('_wii_mobile_disable'))
		return; // don't generate when mobile disabled
	// alternatives for slide open menu
	$home = weaverii_getopt('wii_mobile_slide_home_label');
	if (!$home) $home = __('Home','weaver-ii');

	$menu_label = ($nohome != 'no-home') ? weaverii_getopt('wii_mobile_slide_nav_label') :
		weaverii_getopt('wii_mobile_slide_nav_label_sec')    ;  // use 'wii_mobile_slide_nav_label_sec' for top menu

	if (!$menu_label) $menu_label = __('Menu','weaver-ii');
    $mm_class = 'mobile-menu-link';
	$img_hide = $menu_label . ' &uarr;';
	$img_show = $menu_label . ' &darr;';
	$img_toggle = $img_show;

    if (weaverii_getopt('mobile_menu_icon')) {
        $mm_class = 'mobile-menu-link-icon';
        $img_hide = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        $img_show = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        $img_toggle = $img_show;
    }
?>
<div id="<?php echo $mobile_id; ?>" class="mobile_menu_bar" style="padding:5px 10px 5px 10px;clear:both;">
	<div style="margin-bottom:20px;">
<?php
	if ($nohome != 'no-home') {
?>
<span class="mobile-home-link">
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php echo $home; ?></a></span>
<?php
	}
?>
	<span class="<?php echo $mm_class; ?>"><a href="javascript:void(null);" onclick="weaverii_ToggleMenu(document.getElementById('<?php echo $menu_id; ?>'), this, '<?php echo $img_show; ?>', '<?php echo $img_hide; ?>')"><?php echo $img_toggle; ?></a></span></div>
</div>
<?php
}

function weaverii_extra_menu_generate_code($menu, $wrap = 'extra_menu', $style='menu-vertical', $border_color='',$css='',$width='',$id='') {

	$container_class = $wrap;

	if ($style[0] == '.') $style = substr($style,1);

	$wstyle = $width ? 'width:' . $width . ';' : '';

	if ($border_color == '') $bstyle = '';
	else $bstyle = 'border: 1px solid ' . $border_color .';';

	if ($bstyle != '' || $css != '' || $wstyle != '' ) $add_style = ' style="' . $bstyle . $css . $wstyle .'"';
	else $add_style = '';

	$out = '<div ' . $id . 'class="' . $container_class . '" role="navigation"' . $add_style . ">\n";

	//if (weaverii_getopt('wii_use_superfish') && $style == 'menu_bar')
	//   $out .= wp_nav_menu( array( 'container_class' => $style, 'echo' => false, 'menu' => $menu_id, 'menu_class' => 'sf-menu', 'fallback_cb' => '' ) );
	//else
	if (is_string($menu) && strpos($menu,'location:') !== false) {      // specified a theme location
		$nav_menu = str_replace('location:','',$menu);
		$the_menu = wp_nav_menu( array( 'container_class' => $style, 'echo' => false,
									   'theme_location' => $nav_menu ) );
		$out .= str_replace('<div class="menu">','<div class="menu ' . $style . '">',$the_menu);
	} else {
		$menu_id = wp_get_nav_menu_object($menu);
		$out .= wp_nav_menu( array( 'container_class' => $style, 'echo' => false, 'menu' => $menu_id,
								   'fallback_cb' => '' ) );
	}
	$out .= "</div><div class=\"weaver-clear\"></div>\n";
	return $out;
}

// # OTHER UTILS ==============================================================
function weaverii_dev_mode() {
	return weaverii_getopt_checked('_wii_development_mode') && current_user_can('edit_theme_options');
}

function weaverii_relative_url($subpath){
	// generate a relative URL from the site's root
	return parse_url(trailingslashit(get_template_directory_uri()) . $subpath,PHP_URL_PATH);
}

function weaverii_trace($msg) {
	if (WEAVERII_DEBUG) {
		echo "<h2>******** $msg ********</h2>\n";
	}
}

function weaverii_trace_template($msg) {
	if (weaverii_dev_mode() && weaverii_getopt_checked('_wii_diag_trace_templates')) {
		$fixed = strstr($msg, '/weaver');
		if (!$fixed) $fixed = $msg;
		echo '<h3 style="background:yellow;color:blue;">*' . $fixed . "*</h3>\n";
	}
}

function weaverii_trace_sidebar($msg) {
	if (weaverii_dev_mode() && weaverii_getopt_checked('_wii_diag_trace_sidebars')) {
		$fixed = strstr($msg, '/weaver');
		if (!$fixed) $fixed = $msg;
		echo '<h3 style="background:#afa;color:blue;">*' . $fixed . "*</h3>\n";
	}
}

function weaverii_filter_css($css) {
	// filter user added CSS for root relative file paths

	if (strpos($css, '%template_directory%') !== false)
		$css = str_replace('%template_directory%',
				parse_url(trailingslashit(get_template_directory_uri()),PHP_URL_PATH) ,
				$css);
	if (strpos($css, '%stylesheet_directory%') !== false)
		$css = str_replace('%stylesheet_directory%',
				parse_url(trailingslashit(get_stylesheet_directory_uri()),PHP_URL_PATH) ,
				$css);
	if (strpos($css, '%addon_directory%') !== false)
		$css = str_replace('%addon_directory%' ,
				parse_url(trailingslashit(weaverii_f_uploads_base_url()) . 'weaverii-subthemes/addon-subthemes/',PHP_URL_PATH),
				$css);

	return $css;
}
add_filter('weaverii_css','weaverii_filter_css');

function weaverii_add_shortcode($p1, $p2) {
	// don't add if plugin is there
	if (!weaverii_getopt('_wii_disable_shortcodes') &&
		!function_exists('aspen_sw_installed'))
		add_shortcode($p1,$p2);
}

function weaveriip_add_shortcode($p1, $p2) {
	if (!weaverii_getopt('_wii_disable_shortcodes') &&
		!function_exists('aspen_swplus_installed'))
		add_shortcode($p1,$p2);
}

/* ----------------- hide visual editor filter ----------------- */
function weaverii_disable_visual_editor() {
  global $wp_rich_edit;

  if (!isset($_GET['post']))
	  return;
  $post_id = $_GET['post'];
  $value = get_post_meta($post_id, 'hide_visual_editor', true);
  $raw = get_post_meta($post_id, 'wvr_raw_html', true);
  if($value == 'on' || $raw == 'on')
	$wp_rich_edit = false;
}
add_action('load-page.php', 'weaverii_disable_visual_editor');
add_action('load-post.php', 'weaverii_disable_visual_editor');

require_once( dirname( __FILE__ ) . '/fileio.php' );
?>
