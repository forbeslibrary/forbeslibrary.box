<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
// Admin panel that gets added to the page edit page for per page options

add_action('admin_menu', 'weaverii_add_page_fields');

function weaverii_add_page_fields() {
	add_meta_box('wii_page-box', 'Weaver II Options For This Page', 'weaverii_page_extras', 'page', 'normal', 'high');
	add_meta_box('wii_post-box', 'Weaver II Options For This Post', 'weaverii_post_extras', 'post', 'normal', 'high');
	$i = 1;
	$args=array( 'public'   => true, '_builtin' => false );
	$post_types=get_post_types($args,'names','and');
	foreach ($post_types  as $post_type ) {
		add_meta_box('wii_post-box' . $i, 'Weaver II Options For This Post', 'weaverii_post_extras', $post_type, 'normal', 'high');
		$i++;
	}
}

function weaverii_page_checkbox($opt, $msg, $br = 0) {
		global $post;
?>
	<label></label><input type="checkbox" id="<?php echo($opt); ?>" name="<?php echo($opt); ?>"
<?php if (get_post_meta($post->ID, $opt, true)) { echo " checked='checked' ";} ?> />
<?php   echo($msg . '</label>&nbsp;&nbsp;');
	for ($i = 0 ; $i < $br ; $i++)
		echo '<br />';
}

function weaverii_page_layout() {
		global $post;
?>
		<select name="wvr_page_layout" id="wvr_page_layout">
		<option value=""></option>
		<option value="one-column" <?php if ( get_post_meta($post->ID, 'wvr_page_layout', true) == 'one-column') { echo ' selected="selected"'; }?>>
No sidebars, one column content</option>

		<option value="right-1-col" <?php if ( get_post_meta($post->ID, 'wvr_page_layout', true) == 'right-1-col') { echo ' selected="selected"'; }?>>
Single column sidebar on Right</option>

		<option value="left-1-col" <?php if ( get_post_meta($post->ID, 'wvr_page_layout', true) == 'left-1-col') { echo ' selected="selected"'; }?>>
Single column sidebar on Left</option>

		<option value="right-2-col" <?php if ( get_post_meta($post->ID, 'wvr_page_layout', true) == 'right-2-col') { echo ' selected="selected"'; }?>>
Double Cols, Right (top wide)</option>

		<option value="left-2-col" <?php if ( get_post_meta($post->ID, 'wvr_page_layout', true) == 'left-2-col') { echo ' selected="selected"'; }?>>
Double Cols, Left (top wide)</option>

		<option value="right-2-col-bottom" <?php if ( get_post_meta($post->ID, 'wvr_page_layout', true) == 'right-2-col-bottom') { echo ' selected="selected"'; }?>>
Double Cols, Right (bottom wide)</option>

		<option value="left-2-col-bottom" <?php if ( get_post_meta($post->ID, 'wvr_page_layout', true) == 'left-2-col-bottom') { echo ' selected="selected"'; }?>>
Double Cols, Left (bottom wide)</option>


		<option value="split" <?php if ( get_post_meta($post->ID, 'wvr_page_layout', true) == 'split') { echo ' selected="selected"'; }?>>
Split - sidebars on Right and Left</option>
		</select>&nbsp;Select <em>Sidebar Layout</em> for this page - overrides default Page layout.

<?php
}

function weaverii_pwp_atw_show_post_filter() {
    // use plugin options...
	global $post;

if ( function_exists( 'atw_showposts_installed' ) ) {
    $filters = atw_posts_getopt('filters');

    $first = true;
    echo '<select id="pp_post_filter" name="pp_post_filter" >';
    foreach ($filters as $filter => $val) {     // display dropdown of available filters
        if ( $first ) {
            $first = false;
            echo '<option value="" ' . selected(get_post_meta($post->ID, 'pp_post_filter', true) == '') . '>Don\'t Use Filter</option>';
        } else {
            echo '<option value="' . $filter .'" ' . selected(get_post_meta($post->ID, 'pp_post_filter', true) == $filter) . '>' . $val['name'] . '</option>';
        }
    }
    echo '</select>&nbsp;Use a Filter from <em>ATW Show Posts Plugin</em> <strong>instead</strong> of above post selection options.<br /> ' .
    '<span style="margin-left:12em;"><span>(Note: Filter Display Options and Use Paging option <em>not</em> used for posts using this filter.)<br />';
}
}



function weaverii_pwp_type() {
		global $post;
?>
Display posts as: &nbsp;&nbsp;
		<select name="wvr_pwp_type" id="wvr_pwp_type">
		<option value="" <?php if ( get_post_meta($post->ID, 'wvr_pwp_type', true) == '') { echo ' selected="selected"'; }?>></option>

		<option value="full" <?php if ( get_post_meta($post->ID, 'wvr_pwp_type', true) == 'full') { echo ' selected="selected"'; }?>>
Full post</option>

		<option value="excerpt" <?php if ( get_post_meta($post->ID, 'wvr_pwp_type', true) == 'excerpt') { echo ' selected="selected"'; }?>>
Excerpt</option>

		<option value="title" <?php if ( get_post_meta($post->ID, 'wvr_pwp_type', true) == 'title') { echo ' selected="selected"'; }?>>
Title only</option>

<option value="title_featured" <?php if ( get_post_meta($post->ID, 'wvr_pwp_type', true) == 'title_featured') { echo ' selected="selected"'; }?>>
Title + Featured Image</option>
		</select> &nbsp;How to display posts on this Page with Posts - default is to use global "Post Specifics" settings

<?php
}

function weaverii_pwp_cols() {
		global $post;
?>
Display post columns: &nbsp;&nbsp;&nbsp;
		<select name="wvr_pwp_cols" id="wvr_pwp_cols">
			<option value="" <?php if ( get_post_meta($post->ID, 'wvr_pwp_cols', true) == '') { echo ' selected="selected"'; }?>>
&nbsp;</option>
		<option value="1" <?php if ( get_post_meta($post->ID, 'wvr_pwp_cols', true) == '1') { echo ' selected="selected"'; }?>>
1 Column</option>

		<option value="2" <?php if ( get_post_meta($post->ID, 'wvr_pwp_cols', true) == '2') { echo ' selected="selected"'; }?>>
2 Columns</option>

		<option value="3" <?php if ( get_post_meta($post->ID, 'wvr_pwp_cols', true) == '3') { echo ' selected="selected"'; }?>>
3 Columns</option>
		</select> &nbsp;Display posts in this many columns - left to right, then top to bottom

		<br />
		Use <em>Masonry</em> columns: &nbsp;
		<select name="wvr_pwp_masonry" id="wvr_pwp_masonry">
			<option value="" <?php if ( get_post_meta($post->ID, 'wvr_pwp_masonry', true) == '') { echo ' selected="selected"'; }?>>
&nbsp;</option>
		<option value="2" <?php if ( get_post_meta($post->ID, 'wvr_pwp_masonry', true) == '2') { echo ' selected="selected"'; }?>>
2 Columns</option>

		<option value="3" <?php if ( get_post_meta($post->ID, 'wvr_pwp_masonry', true) == '3') { echo ' selected="selected"'; }?>>
3 Columns</option>
<option value="4" <?php if ( get_post_meta($post->ID, 'wvr_pwp_masonry', true) == '4') { echo ' selected="selected"'; }?>>
4 Columns</option>
<option value="5" <?php if ( get_post_meta($post->ID, 'wvr_pwp_masonry', true) == '5') { echo ' selected="selected"'; }?>>
5 Columns</option>
		</select> &nbsp;Use <em>Masonry</em> for multi-column display (&#9679; Pro only)
		<br />
<?php
	weaverii_page_checkbox('wvr_pwp_compact', 'For posts with <em>Post Format</em> specified, use compact layout on blog/archive pages.',true);
	weaverii_page_checkbox('wvr_pwp_compact_posts', 'For regular, <em>non-PostFormats</em> posts, show <em>title + first image</em> on blog pages.');
}

function weaverii_page_extras() {
		global $post;
		$opts = get_option( apply_filters('weaver_options','weaverii_settings') , array());     // need to fetch weaver options
		if ( !( current_user_can('edit_themes')
			|| (current_user_can('edit_theme_options') && !isset($opts['_wii_hide_mu_admin_per']))      // multi-site regular admin
			|| (current_user_can('edit_pages') && !isset($opts['_wii_hide_editor_per']))        // Editor
			|| (current_user_can('edit_posts') && !isset($opts['_wii_hide_author_per']))) // Author/Contributor
		   ) {
			echo '<p>Weaver II Per Page Options not available for your User Role.</p>';
			return;     // don't show per post panel
		   }

		echo("<div style=\"line-height:150%;\"><p>\n");
        if (get_the_ID() == get_option( 'page_on_front' ) ) { ?>
<div style="padding:2px; border:2px solid yellow; background:#FF8;">Information: This page has been set
to serve as your front page in the <em>Dashboard:Settings:Reading</em> 'Front page:' option.
</div><br />
<?php
        }

        if (get_the_ID() == get_option( 'page_for_posts' ) ) { ?>
<div style="padding:2px; border:2px solid red; background:#FAA;"><strong>WARNING!</strong> You have the
<em>Dashboard:Settings:Reading</em> 'Posts page:' option set to this page. You may intend to do this, but
note this means that <em>only</em> this page's Title will be used
on the default WordPress blog page, and any content you may have entered above is <em>not</em> used.
If you want this page to serve as your blog page, and enable Weaver II Per Page options,
including the option of using the Page with Posts page template,
then that Reading:'Posts page:' selection <strong><em>must</em></strong> be set to the '&mdash; Select &mdash;' default value.
</div><br />
<?php
            return;
        }
		echo("<strong>Page Templates</strong>" /*a*/ );
		weaverii_help_link('help.html#PageTemplates',weaverii_t_('Help for Weaver II Page Templates' /*a*/ ));
		echo '<span style="float:right;">(This Page\'s ID: '; the_ID() ; echo ')</span>';
		weaverii_html_br();
		echo('Please click the (?) for more information about all the Weaver II Page Templates.' /*a*/ );
		echo("</p><p>\n");
		echo("<strong>Per Page Options</strong>" /*a*/ );
		weaverii_help_link('help.html#optsperpage', weaverii_t_('Help for Per Page Options' /*a*/ ));
		weaverii_html_br();
		echo("These settings let you hide various elements on a per page basis." /*a*/ );
		weaverii_html_br();

		weaverii_page_checkbox('ttw-hide-page-title',weaverii_t_('Hide Page Title' /*a*/ ));
		weaverii_page_checkbox('ttw-hide-site-title',weaverii_t_('Hide Site Title/Tagline' /*a*/ ));
		weaverii_page_checkbox('ttw-hide-menus',weaverii_t_('Hide Menus' /*a*/ ));
		weaverii_page_checkbox('ttw-hide-header-image',weaverii_t_('Hide Standard Header Image' /*a*/ ),1);

		weaverii_page_checkbox('ttw-hide-header',weaverii_t_('Hide Entire Header' /*a*/ ));
		weaverii_page_checkbox('wvr-hide-page-infobar',weaverii_t_('Hide Info Bar on this page' /*a*/ ));
		weaverii_page_checkbox('ttw-hide-footer',weaverii_t_('Hide Entire Footer' /*a*/ ),1);

		echo '<em>Note:</em> the following hide "Page on Primary Menu" options work with the default menu - not custom menus.<br>';
		weaverii_page_checkbox('ttw-hide-on-menu',weaverii_t_('Hide Page on the default Primary Menu' /*a*/ ));
		weaverii_page_checkbox('wvr-hide-on-mobile',weaverii_t_('Hide Page on mobile devices (default menu only)' /*a*/ ),1);


		weaverii_page_checkbox('wvr-hide-on-menu-logged-in',weaverii_t_('Hide Page on the default Primary Menu if logged in' /*a*/ ));
		weaverii_page_checkbox('wvr-hide-on-menu-logged-out',weaverii_t_('Hide Page on the default Primary Menu if NOT logged in' /*a*/ ),1);

		weaverii_page_checkbox('ttw-stay-on-page',weaverii_t_('Menu "Placeholder" page. Useful for top-level menu item - don\'t go anywhere when menu item is clicked.' /*a*/ ),1);

		weaverii_page_checkbox('hide_visual_editor',weaverii_t_('Disable Visual Editor for this page. Useful if you enter simple HTML or other code.' /*a*/ ),1);

		if (weaverii_allow_multisite()) {
			weaverii_page_checkbox('wvr_raw_html',weaverii_t_('Allow Raw HTML and scripts. Disables auto paragraph, texturize, and other processing.' /*a*/ ),1);
		}
		weaverii_page_layout();
?>
<br />
		<input type="text" size="15" id="bodyclass" name="bodyclass"
		value="<?php echo esc_textarea(get_post_meta($post->ID, "bodyclass", true)); ?>" />
		<?php echo("<em>Per Page body Class</em> - CSS class name to add to HTML &lt;body&gt; block. Allows Per Page custom styling." /*a*/ ); ?> <br />
<?php
		weaverii_html_br();

		echo("<strong>Selective Display of Widget Areas</strong><br />
		These settings let you hide display of widget areas that would normally be displayed for a given page template. (Note that
		different page templates don't necessarily display the same widget areas.)" /*a*/ );
		weaverii_html_br();
		weaverii_page_checkbox('ttw-hide-header-widget',weaverii_t_('Hide Header Horizontal Area' /*a*/ ),1);

		weaverii_page_checkbox('hide_sidebar_primary',weaverii_t_('Hide Primary (top) Area' /*a*/ ));
		weaverii_page_checkbox('hide_sidebar_right',weaverii_t_('Hide Upper/Right Area' /*a*/ ));
		weaverii_page_checkbox('hide_sidebar_left',weaverii_t_('Hide Lower/Left Area' /*a*/ ),1);

		weaverii_page_checkbox('top-widget-area',weaverii_t_('Hide Top Area' /*a*/ ));
		weaverii_page_checkbox('bottom-widget-area',weaverii_t_('Hide Bottom Area' /*a*/ ));

		weaverii_page_checkbox('sitewide-top-widget-area',weaverii_t_('Hide Sitewide Top Area' /*a*/ ));
		weaverii_page_checkbox('sitewide-bottom-widget-area',weaverii_t_('Hide Sitewide Bottom Area' /*a*/ ));
		?>
		<br />
		Use Weaver II <em>Main Options&rarr;Widget Areas&rarr;Define Per Page Widget Areas</em> (near bottom) tab to define widget areas to use here.
		<?php weaverii_help_link('help.html#PPWidgets',weaverii_t_('Help for Per Page Widget Areas' /*a*/ )); ?>
		<br />

		<input type="text" size="15" id="ttw_show_extra_areas" name="ttw_show_extra_areas"
		value="<?php echo esc_textarea(get_post_meta($post->ID, "ttw_show_extra_areas", true)); ?>" />
		<?php echo("<em>Additional Top Widget Area</em> - Enter name of a Per Page Widget Top Area to display." /*a*/ ); ?> <br />

		<input type="text" size="15" id="replace_horiz_header" name="replace_horiz_header"
		value="<?php echo esc_textarea(get_post_meta($post->ID, "replace_horiz_header", true)); ?>" />
		<?php echo("<em>Header Horizontal Area Replacement</em> - Enter name of a Per Page Widget Area to replace the Header Horizontal area." /*a*/ ); ?> <br />

		<input type="text" size="15" id="ttw_show_replace_primary" name="ttw_show_replace_primary"
		value="<?php echo esc_textarea(get_post_meta($post->ID, "ttw_show_replace_primary", true)); ?>" />
		<?php echo("<em>Primary (top) Replacement</em> - Enter name of a Per Page Widget Area to replace the standard Primary (top) area." /*a*/ ); ?> <br />

		<input type="text" size="15" id="ttw_replace_right" name="ttw_replace_right"
		value="<?php echo esc_textarea(get_post_meta($post->ID, "ttw_replace_right", true)); ?>" />
		<?php echo("<em>Upper/Right Replacement</em> - Enter name of a Per Page Widget Area to replace the standard Upper/Right area." /*a*/ ); ?> <br />
		<input type="text" size="15" id="ttw_replace_left" name="ttw_replace_left"
		value="<?php echo esc_textarea(get_post_meta($post->ID, "ttw_replace_left", true)); ?>" />
		<?php echo("<em>Lower/Left Replacement</em> - Enter name of a Per Page Widget Area to replace the standard Lower/Left area." /*a*/ ); ?> <br />

		<?php // No need to hide other widget areas - it would make no sense to hide the alt widget area, for example ?>
</p>
<p>
		<?php echo('<strong>Settings for "Page with Posts" Template</strong>' /*a*/ );
		weaverii_help_link('help.html#PerPostTemplate',weaverii_t_('Help for Page with Posts Template' /*a*/ ) );

		$template = !empty($post->page_template) ? $post->page_template : "Default Template";
		if ($template == 'paget-posts.php') {
		?>
		<br />
		<?php echo('These settings are optional, and can filter which posts are displayed when you use the "Page
		with Posts" template. The settings will be combined for the final filtered list of posts displayed.
		(If you make mistakes in your settings, it won\'t be apparent until you display the page.)' /*a*/ ); ?><br />


		<input type="text" size="30" id="ttw_category" name="ttw_category"
		value="<?php echo esc_textarea(get_post_meta($post->ID, "ttw_category", true)); ?>" />
		<?php echo("<em>Category</em> - Enter list of category slugs of posts to include. (-slug will exclude specified category)" /*a*/ ); ?> <br />

		<input type="text" size="30" id="ttw_tag" name="ttw_tag"
		value="<?php echo esc_textarea(get_post_meta($post->ID, "ttw_tag", true)); ?>" />
		<?php echo("<em>Tags</em> - Enter list of tag slugs of posts to include." /*a*/ ); ?> <br />

		<input type="text" size="30" id="ttw_onepost" name="ttw_onepost"
		value="<?php echo esc_textarea(get_post_meta($post->ID, "ttw_onepost", true)); ?>" />
		<?php echo("<em>Single Post</em> - Enter post slug of a single post to display." /*a*/ ); ?> <br />

		<input type="text" size="30" id="ttw_orderby" name="ttw_orderby"
		value="<?php echo esc_textarea(get_post_meta($post->ID, "ttw_orderby", true)); ?>" />
		<?php echo("<em>Order by</em> - Enter method to order posts by: author, date, title, or rand." /*a*/ ); ?> <br />

		<input type="text" size="30" id="ttw_order" name="ttw_order"
		value="<?php echo esc_textarea(get_post_meta($post->ID, "ttw_order", true)); ?>" />
		<?php echo("<em>Sort order</em> - Enter ASC or DESC for sort order." /*a*/ ); ?> <br />

		<input type="text" size="30" id="ttw_posts_per_page" name="ttw_posts_per_page"
		value="<?php echo esc_textarea(get_post_meta($post->ID, "ttw_posts_per_page", true)); ?>" />
		<?php echo("<em>Posts per Page</em> - Enter maximum number of posts per page." /*a*/ ); ?> <br />

		<input type="text" size="30" id="ttw_author" name="ttw_author"
		value="<?php echo esc_textarea(get_post_meta($post->ID, "ttw_author", true)); ?>" />
		<?php echo('<em>Author</em> - Enter author (use username, including spaces), or list of author IDs' /*a*/ ); ?> <br />

		<input type="text" size="30" id="wvr_post_type" name="wvr_post_type"
		value="<?php echo esc_textarea(get_post_meta($post->ID, "wvr_post_type", true)); ?>" />
		<?php echo('<em>Custom Post Type</em> - Enter slug of one custom post type to display' /*a*/ ); ?> <br />

		<?php weaverii_pwp_atw_show_post_filter(); ?><br />
        <?php weaverii_pwp_type(); ?><br />
		<?php weaverii_pwp_cols(); ?><br />
		<input type="text" size="5" id="wvr_fullposts" name="wvr_fullposts"
		value="<?php echo esc_textarea(get_post_meta($post->ID, "wvr_fullposts", true)); ?>" />
		<?php echo("<em>Enter number. Don't excerpt 1st <em>\"n\"</em> Posts</em> - Display the non-excerpted post for the first \"n\" posts."); ?>
		<br />

		<input type="text" size="5" id="wvr_hide_n_posts" name="wvr_hide_n_posts"
		value="<?php echo esc_textarea(get_post_meta($post->ID, "wvr_hide_n_posts", true)); ?>" />
		<?php echo("<em>Hide first \"n\" posts</em> - Start with post n+1.
Useful with plugin that will display first n posts using a shortcode. (e.g., Post slider)" /*a*/ ); ?>
		<br />
		<?php weaverii_page_checkbox('ttw_hide_sticky',weaverii_t_('No special treatment for Sticky Posts' /*a*/ )); ?>
		<?php weaverii_page_checkbox('ttw_hide_pp_infotop',weaverii_t_('Hide top info line' /*a*/ )); ?>
		<?php weaverii_page_checkbox('ttw_hide_pp_infobot',weaverii_t_('Hide bottom info line' /*a*/ )); ?>
		<?php weaverii_page_checkbox('wvr_show_pp_featured_img',weaverii_t_('Show post featured image' /*a*/ )); ?>
</p>
<?php
		} else {        // NOT a page with posts
?>      <p><strong>Note:</strong> After you choose the "Page with Posts" template from the <em>Template</em>
		option in the <em>Page Attributes</em> box, <strong>and</strong> <em>Publish</em> or <em>Save Draft</em>,
		settings for "Page with Posts" will be displayed here. (Current page template: <?php echo $template; ?>)
		</p>
<?php
		}
?>
<hr />
<p style="line-height:1.3em;">
<?php   echo('<strong>Per Page Code Insertion</strong>' /*a*/ );
		weaverii_help_link('help.html#ExtraPP', weaverii_t_('Help for Extra Per Page Options' /*a*/ ));
?>
Weaver supports code and HTML insertion for the following areas. To add code, manually define the specified
<em>Custom Field Name</em> and <em>Value</em>):
<br />
&nbsp;&nbsp;Define <em>page-head-code</em>, and the value contents will be added to the
&lt;HEAD&gt; section. Include &lt;style>...&lt;/style> if adding CSS.
<br />
&nbsp;&nbsp;Define the following <em>Custom Field Names</em> and values to specify the
equivalent HTML Insertion areas for this page:
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<em>prewrapper, preheader, header, premain, precontent, presidebar_left,
presidebar_right, precomments, prefooter, footer, postfooter</em>
</p>
		<input type='hidden' id='wii_post_meta' name='wii_post_meta' value='wii_post_meta'/>
		</div>
<?php
}

function weaverii_post_extras() {
		global $post;
		$opts = get_option( apply_filters('weaver_options','weaverii_settings') , array());     // need to fetch weaver options
		if ( !( current_user_can('edit_themes')
			|| (current_user_can('edit_theme_options') && !isset($opts['_wii_hide_mu_admin_per']))      // multi-site regular admin
			|| (current_user_can('edit_pages') && !isset($opts['_wii_hide_editor_per']))        // Editor
			|| (current_user_can('edit_posts') && !isset($opts['_wii_hide_author_per']))) // Author/Contributor
		   ) {
			echo '<p>Weaver II Per Post Options not available for your User Role.</p>';
			return;     // don't show per post panel
		   }
?>
<div style="line-height:150%;">
<p>
		<?php
		echo("<strong>Per Post Options</strong>" /*a*/ );
		weaverii_help_link('help.html#PerPage', weaverii_t_('Help for Per Post Options' /*a*/ ));
		echo '<span style="float:right;">(This Post\'s ID: '; the_ID() ; echo ')</span>';
		weaverii_html_br();
		echo("These settings let you control display of this individual post. Many of these options override global options set on the Weaver II admin tabs." /*a*/ );
		weaverii_html_br();
		weaverii_page_checkbox('ttw-force-post-full',weaverii_t_('Display as full post where normally excerpted.' /*a*/ ));
		weaverii_page_checkbox('ttw-force-post-excerpt',weaverii_t_('Display post as excerpt' /*a*/ ), 1);

		weaverii_page_checkbox('ttw-show-featured',weaverii_t_('Show Featured Image with post' /*a*/ ));
		// Can't add an option to hide featured in header per post because we don't know the post at header time.

		weaverii_page_checkbox('ttw-show-post-avatar',weaverii_t_('Show author avatar with post' /*a*/ ));
		weaverii_page_checkbox('ttw-favorite-post',weaverii_t_('Mark as a favorite post (adds star to title)' /*a*/ ), 1);

		weaverii_page_checkbox('hide_post_format_label',weaverii_t_('Hide <em>Post Format</em> label' /*a*/ ));
		weaverii_page_checkbox('hide_post_title',weaverii_t_('Hide post title' /*a*/ ));
		weaverii_page_checkbox('post_add_link',weaverii_t_('Show link to single page icon at bottom of post' /*a*/ ),1);

		weaverii_page_checkbox('hide_top_post_meta',weaverii_t_('Hide top post info line' /*a*/ ));
		weaverii_page_checkbox('hide_bottom_post_meta',weaverii_t_('Hide bottom post info line' /*a*/ ));
		weaverii_page_checkbox('hide_post_bubble',weaverii_t_('Hide the comment bubble' /*a*/ ), 1);

		weaverii_page_checkbox('ttw_hide_sidebars',weaverii_t_('Hide Sidebars when this post displayed on Single Post page.' /*a*/ ), 1);

		weaverii_page_checkbox('wvr_masonry_span2',weaverii_t_('For <em>Masonry</em> multi-columns: make this post span two columns. (&#9679;Pro only)' /*a*/ ),1);

		weaverii_page_checkbox('hide_visual_editor',weaverii_t_('Disable Visual Editor for this page. Useful if you enter simple HTML or other code.' /*a*/ ),  1);

		if (weaverii_allow_multisite()) {
			weaverii_page_checkbox('wvr_raw_html',weaverii_t_('Allow Raw HTML and scripts. Disables auto paragraph, texturize, and other processing.' /*a*/ ), 1);
		}
		?>
</p>
<p>
		<?php echo('The above settings are not used by the [weaver_show_posts] shortcode.' /*a*/ ); ?><br />
		<?php echo('<strong>Per Post Style</strong>' /*a*/ );
				weaverii_help_link('help.html#perpoststyle', weaverii_t_('Help for Per Post Style' /*a*/ ));?> <br />
		<?php echo("Enter optional per post CSS style rules. <strong>Do not</strong> include the &lt;style> and &lt;/style> tags.
			Include the {}'s. Don't use class names if rules apply to whole post, but do include class names
			(e.g., <em>.entry-title a</em>) for specific elements. Custom styles will not be displayed by the Post Editor."); ?> <br />
		<textarea name="ttw_per_post_style" rows=2 style="width: 95%"><?php echo(get_post_meta($post->ID, "ttw_per_post_style", true)); ?></textarea>
		<br>
Define a Custom Field called <em>postclass</em> to add a custom class name to the &lt;article&gt; section that wraps this post.
<br />
		<?php echo('<strong>Post Format</strong>' /*a*/ );
		weaverii_help_link('help.html#gallerypost', weaverii_t_('Help for Per Post Format' /*a*/ ));
		weaverii_html_br();
		echo('Weaver II supports Post Formats as shown in the "Format" option box to the right. Click the ? for more info.' /*a*/ );
		weaverii_html_br();
		weaverii_html_br();

		echo('<em>Note:</em> when you add settings for the post here, values will be created and displayed in the "Custom Fields" box.' /*a*/ ); ?>
</p>
		<input type='hidden' id='wii_post_meta' name='wii_post_meta' value='wii_post_meta'/>
</div>
<?php
}

function weaverii_save_post_fields($post_id) {
	// for backward compatibility, we will retain the ttw prefix names so old sites will still work with per page options - mostly...
	$default_post_fields = array('ttw_category', 'ttw_tag', 'ttw_onepost', 'ttw_orderby', 'ttw_order',
		'ttw_author', 'ttw_posts_per_page', 'hide_sidebar_primary','hide_sidebar_right','hide_sidebar_left',
		'top-widget-area','bottom-widget-area','sitewide-top-widget-area', 'sitewide-bottom-widget-area',
		'wvr_post_type', 'ttw-hide-page-title','ttw-hide-site-title','ttw-hide-menus','ttw-hide-header-image',
		'ttw-hide-footer','ttw-hide-header','ttw_hide_sticky', 'ttw-force-post-full','ttw-force-post-excerpt',
		'ttw-show-post-avatar','ttw-favorite-post','ttw_show_extra_areas','ttw_hide_sidebars','bodyclass',
		'ttw_show_replace_primary','ttw_replace_right','ttw_replace_left','hide_top_post_meta','hide_bottom_post_meta',
		'ttw-show-featured','ttw-hide-featured-header','ttw-stay-on-page', 'ttw-hide-on-menu', 'wvr_show_pp_featured_img',
		'ttw_hide_pp_infotop','ttw_hide_pp_infobot','ttw_show_replace_alternative', 'ttw_per_post_style',
		'hide_visual_editor', 'wvr_masonry_span2', 'hide_post_bubble', 'hide_post_title', 'post_add_link', 'hide_post_format_label',
		'wvr_page_layout', 'wvr_pwp_type', 'wvr_pwp_cols', 'ttw-hide-header-widget', 'wvr-hide-page-infobar', 'pp_post_filter',
		'wvr-hide-on-menu-logged-in','wvr-hide-on-menu-logged-out','wvr-hide-on-mobile','wvr_hide_n_posts','wvr_fullposts',
		'replace_horiz_header','wvr_pwp_masonry','wvr_pwp_compact', 'wvr_pwp_compact_posts'
		);
if (weaverii_allow_multisite()) {
		array_push($default_post_fields, 'wvr_raw_html');
}

	$all_post_fields = $default_post_fields;

	if (isset($_POST['wii_post_meta'])) {
		foreach ($all_post_fields as $post_field) {
			if (isset($_POST[$post_field])) {
				$data = stripslashes($_POST[$post_field]);
				if ($post_field == 'ttw_show_extra_areas' || $post_field == 'ttw_replace_right' ||
					$post_field == 'ttw_replace_left') {
					$data = strtolower($data);  // force to lower case
				}
				if (get_post_meta($post_id, $post_field) == '') {
					add_post_meta($post_id, $post_field, weaverii_filter_textarea($data), true);
				}
				else if ($data != get_post_meta($post_id, $post_field, true)) {
					update_post_meta($post_id, $post_field, weaverii_filter_textarea($data));
				}
				else if ($data == '') {
					delete_post_meta($post_id, $post_field, get_post_meta($post_id, $post_field, true));
				}
			} else {
				delete_post_meta($post_id, $post_field, get_post_meta($post_id, $post_field, true));
			}
		}
	}
}

add_action("save_post", "weaverii_save_post_fields");
add_action("publish_post", "weaverii_save_post_fields");
?>
