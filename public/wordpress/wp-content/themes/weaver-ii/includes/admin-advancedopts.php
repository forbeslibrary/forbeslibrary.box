<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
/* Weaver II - admin Advanced Options
 *
 */

function weaverii_admin_advancedopts() {
?>
<div id="tabwrap_adv" style="padding-left:5px;">
	<div id="tab-container-adv" class='yetiisub'>
		<ul id="tab-container-adv-nav" class='yetiisub'>
<?php if (weaverii_allow_multisite()) { ?>
			<li><a href="#adtab0" title="Insert custom HTML, scripts, and CSS into &lt;HEAD&gt; section."><?php echo(weaverii_t_('&lt;HEAD&gt; Section' /*a*/ )); ?></a></li>
			<li><a href="#adtab1" title="Insert custom HTML into several different page areas."><?php echo(weaverii_t_('HTML Insertion' /*a*/ )); ?></a></li>
<?php } ?>
			<li><a href="#adtab2" title="Information for Weaver's Page Templates"><?php echo(weaverii_t_('Page Templates' /*a*/ )); ?></a></li>
			<li><a href="#adtab4" title="Options to control display properties of archive pages."><?php echo(weaverii_t_('Archive-type Pages' /*a*/ )); ?></a></li>
			<li><a href="#bkimg" title="Add background images to page areas."><?php echo(weaverii_t_('Background Images' /*a*/ )); ?></a></li>
			<li><a href="#oseo" title="Set options related to SEO"><?php echo(weaverii_t_('SEO' /*a*/ )); ?></a></li>
			<li><a href="#adtab3" title="Options related to this site: FavIcon, Home Page, more."><?php echo(weaverii_t_('Site Options' /*a*/ )); ?></a></li>

		</ul>
<h3>Advanced Options<?php weaverii_help_link('help.html#AdvancedOptions','Help for Advanced Options'); ?></h3>

<?php weaverii_sapi_submit('', '<br /><br />'); ?>

<!-- ***************************************************** -->
<?php if (weaverii_allow_multisite() ) { ?>
<div id="adtab0" class="tab_adv" >
	<?php weaverii_adv_head_section();
?>
</div> <!-- adtab 0 -->

<!-- ***************************************************** -->

<div id="adtab1" class="tab_adv" >
	<?php weaverii_adv_html_insert(); ?>
</div> <!-- adtab1 -->
<?php } // end of major section of not allowed on multisite ?>

<!-- ***************************************************** -->
<div id="adtab2" class="tab_adv" >
	<?php weaverii_adv_page_template(); ?>
</div> <!-- adtab2 -->

<!-- ***************************************************** -->
<div id="adtab4" class="tab_adv" >
	<?php weaverii_adv_archive_pages(); ?>
</div> <!-- archive pages -->

<!-- ***************************************************** -->
<div id="bgimg" class="tab_adv" >
	<?php weaverii_adv_bgimages(); ?>
</div> <!-- total css -->

<!-- ***************************************************** -->
<div id="oseo" class="tab_adv" >
	<?php weaverii_adv_seo_opts(); ?>
</div> <!-- SEO -->

<!-- ***************************************************** -->
<div id="adtab3" class="tab_adv" >
	<?php weaverii_adv_site_opts(); ?>
</div> <!-- site options -->

</div> <!-- tab-container-adv -->
<?php weaverii_sapi_submit(); ?>
</div> <!-- #tabwrap_adv-->

<script type="text/javascript">
		var tabberAdv = new Yetii({
		id: 'tab-container-adv',
		tabclass: 'tab_adv',
		persist: true
		});
</script>
<?php
}

function weaverii_adv_head_section() {
	weaverii_hide_advanced('begin');
?>
<div class="wvr-option-header">The Site &lt;HEAD&gt; Section
<?php weaverii_help_link('help.html#HeadSection','Help for site HEAD section');?></div><br />
<p>
	This tab allows you to define custom code and style rules to the &lt;HEAD&gt; Section of every page on your site.
</p>

<?php if (weaverii_allow_multisite()) { ?>

	<p><small>PLEASE NOTE: Only minimal validation is made on the field values, so be careful not to use invalid code.
	Invalid code is usually harmless, but it can make your site display incorrectly. If your site looks broken after make changes here,
	 please double check that what you entered uses valid HTML or CSS rules.</small></p>

    <a name="advancedcss" id="advancedcss"></a>
	<div class="wvr-option-subheader">Custom CSS Rules</div><br />

	<!-- ======== -->
	<span style="color:#6666FF;"><b>Add your own custom CSS Rules to Weaver II's style rules</b></span><br/>
	<p>
		This section allows you to add new CSS Rules to your theme to enhance or override the styling set using
		Weaver's Main Options. For example, Weaver's documentation includes many <em>CSS Snippets</em> that allow you
		to find tune the look of your site. You simply add whatever CSS Rules you need into the box below. Include the
		complete rule. You do <em>not</em> need to add &lt;style&gt; HTML tags to bracket your rules.</p>
	<p>
		Rules you add here
		will be the <em>last</em> CSS Rules included by Weaver, and thus override all other Weaver generated CSS rules.
		It is possible that other plugins might generate CSS that comes after these rules.
	</p>
<textarea name="<?php weaverii_sapi_main_name('wii_add_css'); ?>" rows=7 style="width: 95%"><?php weaverii_esc_textarea(weaverii_getopt('wii_add_css')); ?></textarea>

<br /><br /><?php weaverii_sapi_submit(); ?><br /><br />

		<!-- ======== -->

	<a name="headsection" id="headsection"></a>
	<div class="wvr-option-subheader">&lt;HEAD&gt; Section</div><br/>

<p>
	This input area allows you to enter custom HTML such as &lt;link&gt; and &lt;meta&gt; statements, or JavaScript code to your site.
	Code entered into this box is included right before the &lt;/HEAD&gt; HTML tag on each page of your site.
    Shortcodes are not supported in this option.
    We recommend using dedicated WordPress plugins to add things like ad tracking, SEO tags, Facebook code, and the like.
	<small>Note: Use the "Custom CSS Rules" option above to add custom CSS Rules to your site.</small>
</p>
<p>
	You can also add code to the &lt;HEAD&gt; section on a per page basis using the per page options from the page editor.
</p>
<?php
    $head = weaverii_getopt('wii_head_opts');
    if ($head != '' || weaverii_init_base() || function_exists('weaverii_tx_head_opts') ) {
?>
				<textarea name="<?php weaverii_sapi_main_name('wii_head_opts'); ?>" rows=2 style="width: 95%"><?php weaverii_esc_textarea($head); ?></textarea>

<?php
    } else {
        // WordPress 3.9 standards compliance: Themes are no longer allowed to add JavaScript via the wp_head action.
        // After a long discussion on the Theme Reviewers mail list, the consent was reached that for backward compatibility,
        // the previous option could be displayed IF a previous setting was already present (i.e., $head != ''), or the user
        // had installed the theme support plugin, or the premium version of the theme is used.
?>
<p style="color:red;">Due to WordPress.org theme standards (since WP 3.9), this option is not supported
by Weaver II Free. You must install the <em>Weaver II Theme Extras</em> plugin, or have <em>Weaver II Pro</em> to add
code to this option.
</p>
<?php
    }
?>
    <br />
	 <small>Weaver II will <em>always</em> load the jQuery Library.</small>
	<!-- ===================================================== -->
    <br />
	<br />

	<a name="headsection" id="headsection"></a>
	<div class="wvr-option-subheader">&lt;HEAD&gt; Section (Advanced Alternative - &diams;)</div>

<p>
	<small>Same as normal &lt;HEAD&gt; box above, but works like other &diams; options - it survives changing
	the subtheme from the Weaver II Subthemes tab, and is saved only on a full backup Save. This option is
	not commonly used, and is intended for more advanced Weaver II users to add &lt;script&gt; and &lt;style&gt;
	blocks to the &lt;head&gt; section.
	</small>
</p>
				<textarea name="<?php weaverii_sapi_main_name('_wii_althead_opts'); ?>" rows=2 style="width: 95%"><?php weaverii_esc_textarea(weaverii_getopt('_wii_althead_opts')); ?></textarea>
<br />
<br />
<?php
	if (weaverii_init_base()) {
?>
	<div class="wvr-option-header">Actions and Filters
<?php weaverii_help_link('help.html#ActionsFilters','Help for Actions and Filters');?></div><br />
	<p><strong>This Option for Advanced Users!</strong> You can add arbitrary PHP code here. This option is intended to allow
	you to add WordPress Actions and Filters to your own site. This PHP code is executed at the very
	beginning of the theme's header.php template file before any site HTML is emitted. Do NOT bracket the code with &lt;?php and ?&gt;. See the Help file for more technical details.</p>

	<textarea name="<?php weaverii_sapi_main_name('_phpactions'); ?>" rows=2 style="width: 95%"><?php echo stripslashes(wp_check_invalid_utf8(addslashes(weaverii_getopt('_phpactions')))); ?></textarea>

<?php
	} else {
		echo "<p><strong>Weaver II Pro Feature:</strong> <em>Actions and Filters</em> allows
	you to add arbitrary PHP code to support WordPress Actions and Filters on your own site.</p> ";
	}
	}   // not multisite
	weaverii_hide_advanced('end');
}

function weaverii_adv_html_insert() {
	weaverii_hide_advanced('begin');
?>
<div class="wvr-option-header">HTML Insertion
<?php weaverii_help_link('help.html#HTMLInsertion','Help on HTML Code Insertion Areas');?></div><br />
<p>The <b>Advanced Options&rarr;HTML Insertion</b> tab allows you to insert custom HTML code in many places on your site.
These fields allow you to add HTML code, special CSS rules, or even JavaScripts. You will need at least
a bit of knowledge of HTML coding to use these fields most effectively.</p>

<p><small>The values you put here are saved in the WordPress database, and will survive theme upgrades and other changes.</small></p>

<p><small>PLEASE NOTE: Only minimal validation is made on the field values, so be careful not to use invalid code.
Invalid code is usually harmless, but it can make your site display incorrectly. If your site looks broken after make changes here,
please double check that what you entered uses valid HTML or CSS rules.</small></p>
<hr />
<?php

	$areas = array(
		array ('name'=>'Site Header Insert Code', 'id'=>'header', 'info'=>
"This HTML code will be inserted into the <em>#branding div</em> header area right above where the standard site
header image goes. You can use it for logos, better site name text - whatever. When used in combination with hiding the site title,
header image, and the menu, you can design a completely custom header. If you hide the title, image, and header, no other code is generated
in the #branding div, so this code can be a complete header replacement. You can also use WP shortcodes to embed plugins, including
rotating image slideshows such as <a href=\"http://aspenthemeworks.com/atw-show-sliders/\" target=\"_blank\">Aspen Themeworks Show Sliders</a>.", 'help' => ''),

		array ('name'=>'Footer Code', 'id'=>'footer', 'info' =>
			'This code will be inserted into the site footer area, just before the before the copyright and "Powered by" credits, but after any Footer widgets (check option below to move to before widgets). This could include extra information, visit counters, etc.',
			'help' => ''),

		array ('name'=>'Pre-Wrapper Code', 'id'=>'+prewrapper', 'info' =>
			'This code will be inserted just before the #wrapper and #branding divs, before any other site content. (&#9679;Pro)',
			'help' => ''),

		array('name'=>'', 'id'=>'submit', 'info' => '', 'help' => ''),

		array ('name'=>'Pre-Header Code', 'id'=>'preheader', 'info' =>
			'This code will be inserted just before the header area (between the "#wrapper" and the "#branding" divs), above the menus and site image.',
			'help' => ''),
		array ('name'=>'Pre-Main Code', 'id'=>'+premain', 'info' =>
			'This code will be inserted after the #branding div and before the #main div. (&#9679;Pro)',
			'help' => ''),

		array ('name'=>'Pre-Container Code', 'id'=>'+precontent', 'info' =>
			'This code will be inserted inside the #container div that wraps content, including before the top widget areas. It will have the same width as the container area. (&#9679;Pro)',
			'help' => ''),

		array ('name'=>'Post-Post Content Code', 'id'=>'+postpostcontent', 'info' =>
			'This code will be inserted after the content area of each post. (&#9679;Pro)',
			'help' => ''),

		array('name'=>'', 'id'=>'submit', 'info' => '', 'help' => ''),

		array ('name'=>'Pre-Comments Code', 'id'=>'+precomments', 'info' =>
			'This code will be inserted just before the #comments div where comments are displayed. If comments
are open for the page, this area will include the class <em>.precomments-comments</em>, if closed <em>.precomments-nocomments</em>. (&#9679;Pro)',
			'help' => ''),

		array ('name'=>'Post-Comments Code', 'id'=>'+postcomments', 'info' =>
			'This code will be inserted right after the #comments div where comments are displayed. If comments
are open for the page, this area will include the class <em>.postcomments-comments</em>, if closed <em>.postcomments-nocomments</em>. (&#9679;Pro)',
			'help' => ''),
		array ('name'=>'Pre-Footer Code', 'id'=>'+prefooter', 'info' =>
			'This code will be inserted just before the footer #colophon div. (&#9679;Pro)',
			'help' => ''),

		array('name'=>'', 'id'=>'submit', 'info' => '', 'help' => ''),

		array ('name'=>'Post-Footer', 'id'=>'postfooter', 'info' =>
			'This code will be inserted just after the footer #colophon div, outside the #wrapper div.',
			'help' => ''),
		array ('name'=>'Pre-Left Sidebar', 'id'=>'+presidebar_left',
'info' => 'This code will be inserted just before the left sidebar area. (&#9679;Pro)',
			'help' => ''),
		array ('name'=>'Pre-Right Sidebar', 'id'=>'+presidebar_right', 'info' =>
			'This code will be inserted just before the right sidebar area. (&#9679;Pro)',
			'help' => '')
	);


	if ( ! weaverii_hide_advanced() )
		weaverii_sapi_submit('', "<br /><br />\n");

	foreach ($areas as $area => $def) {
		weaverii_add_html_field($def['name'],$def['id'],$def['info'],$def['help']);
	}
	weaverii_hide_advanced('end');
}

function weaverii_add_html_field($title, $name, $info, $help='') {

	if ($name=='submit') {
		weaverii_sapi_submit('', "<br /><br />\n");
		return;
	}

	$pro = weaverii_fix_type($name);

	if ($name[0] == '+') $name = substr($name,1); // fix locally

	$area_name = 'wii_' . $name . '_insert';
	$hide_front = 'wii_hide_front_' . $name;
	$hide_rest = 'wii_hide_rest_' . $name;
	$style_id = 'inject_' . $name;


	$val = array ('name'=> $title . ' BG', 'id'=> $style_id . '_bgcolor' , 'info' =>
		'BG Color for area',
		'help' => '');

	if ( $pro == 'inactive' ) {
		if ($title[0] == '#') $title = substr($title,4);
?>
<div class="wvr-option-subheader"><span style="color:#999;"><b><?php echo $title; ?></b> - (Pro Version)</span><br /></div><br />
<?php
		if ($info)
            echo '<span style="color:#999;">' . $info. "<br /> <br />\n";
		weaverii_adv_hidden_opt($area_name);            // keep it working for Pro settings, even on free version
		weaverii_adv_hidden_opt($hide_front);
		weaverii_adv_hidden_opt($hide_rest);
		if ($info)
            echo '</span>';
		return;
	}
?>
<div class="wvr-option-subheader"><span style="color:blue;"><b><?php echo $title; ?></b></span></div><br />
<?php   if ($info) echo $info;
	if ($style_id == 'inject_postpostcontent')
		echo (" (Style with <em>class</em> <code>.$style_id</code>.)");
	else
		echo (" (Style with <code>#$style_id</code>.)");
?>
	<br />
	<textarea name="<?php weaverii_sapi_main_name($area_name); ?>" rows=3 style="width: 95%"><?php weaverii_esc_textarea(weaverii_getopt($area_name)); ?></textarea>
	<br />
<?php
	 echo '<table>'; weaverii_form_row_ctext($val); echo '</table>';
?>
	<label>Hide on front page: <input type="checkbox" name="<?php weaverii_sapi_main_name($hide_front); ?>" id="<?php echo $hide_front; ?>" <?php checked(weaverii_getopt_checked($hide_front)); ?> /></label>
	<small>If you check this box, then the code from this area will not be displayed on the front (home) page.</small><br />
	<label>Hide on non-front pages: <input type="checkbox" name="<?php weaverii_sapi_main_name($hide_rest); ?>" id="<?php echo $hide_rest; ?>" <?php checked(weaverii_getopt_checked( $hide_rest )); ?> /></label>
	<small>If you check this box, then the code from this area will not be displayed on non-front pages.</small>
<?php
	if ($name == 'footer') {
?>
<br /><label>Move to before widget areas: <input type="checkbox" name="<?php weaverii_sapi_main_name('wii_footer_inject_move'); ?>" id="wii_footer_inject_move" <?php checked(weaverii_getopt_checked( 'wii_footer_inject_move' )); ?> /></label>
	<small>If you check this box, then the code from this area will be inserted <em>before</em> the footer widgets instead of after.</small>
<?php
	}
?>
	<br /><br />
<?php
}

function weaverii_adv_hidden_opt($name) {
?>
<input name="<?php weaverii_sapi_main_name($name); ?>" id="<?php echo $name;?>" type="hidden" value="<?php echo weaverii_getopt($name); ?>" />
<?php
}

function weaverii_free_hidden_opt($name) {
	// show hidden field for an option not supported by Free only - (but present in Pro or Theme Extras)
	if (!weaverii_init_base() && !function_exists('weaverii_extras_shortcodes_installed')) {
?>
<input name="<?php weaverii_sapi_main_name($name); ?>" id="<?php echo $name;?>" type="hidden" value="<?php echo weaverii_getopt($name); ?>" />
<?php
	}
}
// ==============================================   PAGE TEMPLATES ===========================================

function weaverii_adv_page_template() {
?>
	<a name="custompage" id="custompage"></a>
	<span style="color:#00f; font-weight:bold; font-size: larger;">Custom Page Templates</span><br />

	<p>Weaver II includes several page templates - which is the WordPress tool for giving different look and functionality
	do individual static pages. Many of the properties of any given page, independent of the page template, can be
	set using the "Weaver II Options For This Page" box on the regular WordPress Page Editor admin page.</p>

	<p>One of the most requested features included in the Per Page box is the ability to set the sidebar layout for
	each page. If this is not set, the page will use the global options for the page type. The other popular option
	includes the ability to replace any of the sidebar widget areas, as well as the ability to add an additional top
	widget area. To use a new widget area you must first tell Weaver II to create a new one. These
	<strong>Per Page Widget Areas</strong> are defined on the Main Options:Widget Areas tab.</p>
	<h3>Overview of Page Templates</h3>

		<ul style="list-style-type:disc;margin-left:20px;">
		<li>
		The <strong>2 Col Content</strong> template splits content into two columns. You manually set the column
		split using the standard WP '&lt;--more-->' convention. (Note - since WordPress only used the '&lt--more-->' to
		show the "Continue reading..." for posts, it can serve this purpose for this template on pages. Columns will split first
		horizontally, then vertically (you can have more than one &lt;--more--> tag).
		</li>
		<li>
		The <strong>Blank</strong> page template will wrap the content of an associated page with an HTML div with class
		<code>.content-blank</code>  which you can add CSS rules to style using the standard Weaver II options.
		The standard page &lt;article&gt; wrapping is not used. The page title is not displayed. Use Per Page Options
		on Page edit menu to control Menu, Site Title, and Header Image visibility.
		</li>
		<li>
		<strong>Page with Posts</strong> serves as an alternative way to display posts. After you select the Page with Posts
		template, a new set of options will be added to the Per Page menu. There is additional help in the help documentation.
		<li>
		The <strong>Raw</strong> template allows total custom HTML styling with no predefined div's. It useful for Pop Up pages.
		</li>
		<li>
		The <strong>Sitemap</strong> provides a page with a basic sitemap.
		</li>
		<li>
		The <strong>iframe</strong> template is designed for full width display of html iframes. You can control sidebars
		and titles using standard Per Page options.
		</li>
		<li>
		The <strong>HTML Source</strong> template will display the page content as syntax-highlighted HTML or PHP code.
		It is useful for showing source code. Any text (e.g., an explanation) defined in per page Custom Field called 'html_source_intro' will
		be displayed before the content source code.
		</li>

	</ul>
	<!-- ===================================================== -->

<?php
}

// ============================================== ARCHIVE-TYPE PAGES ===========================================
function weaverii_adv_archive_pages() {
	weaverii_hide_advanced('begin');

	$opts = array(
        array('name' => 'Archive Type Pages', 'type' => '=header0',
            'info'=> 'Extra options for Archive-like pages - Categories, Tags, etc.',
            'help' => 'help.html#ArchivePages'),

        array('name' => 'Hide Categories Archives Title', 'id' => 'wii_hide_p_category', 'type' => '+checkbox',
            'info' => 'Hide "Category Archives" title on category pages. (&#9679;Pro)'),

        array('name' => '<small>Custom CSS</small>', 'id' => 'wii_p_category_css', 'type' => '+textarea',
            'info' => 'Custom CSS to add to Category Archive page. (&#9679;Pro)'),

        array('name' => 'Hide Tag Archives Title', 'id' => 'wii_hide_p_tag', 'type' => '+checkbox',
            'info' => 'Hide "Tag Archives" title on category pages. (&#9679;Pro)'),
        array('name' => '<small>Custom CSS</small>', 'id' => 'wii_p_tag_css', 'type' => '+textarea',
            'info' => 'Custom CSS to add to Tag Archive page. (&#9679;Pro)'),

        array('name' => 'Hide Author Archives Title', 'id' => 'wii_hide_p_author', 'type' => '+checkbox',
            'info' => 'Hide "Author Archives" title on author pages. (&#9679;Pro)'),
        array('name' => '<small>Custom CSS</small>', 'id' => 'wii_p_author_css', 'type' => '+textarea',
            'info' => 'Custom CSS to add to Author Archive page. (&#9679;Pro)'),

        array('name' => 'Hide Date Archives Title', 'id' => 'wii_hide_p_date', 'type' => '+checkbox',
            'info' => 'Hide "Date Archives" title on date archive pages. (&#9679;Pro)'),
        array('name' => '<small>Custom CSS</small>', 'id' => 'wii_p_date_css', 'type' => '+textarea',
            'info' => 'Custom CSS to add to Date Archive page. (&#9679;Pro)'),

        array('name' => 'Hide Search Results Title', 'id' => 'wii_hide_p_search', 'type' => '+checkbox',
            'info' => 'Hide "Search Results" title on search pages. (&#9679;Pro)'),
        array('name' => '<small>Custom CSS</small>', 'id' => 'wii_p_search_css', 'type' => '+textarea',
            'info' => 'Custom CSS to add to Search Archive page. (&#9679;Pro)'),
	);

	weaverii_form_show_options($opts);
	weaverii_hide_advanced('end');
}

// ==============================================   SITE OPTIONS ===========================================

function weaverii_adv_site_opts() {
?>
	<div class="wvr-option-header">Site Options
	<?php weaverii_help_link('help.html#AdvSiteOptions','Help on Advanced Site Options');?></div><br />
	These options are available to fine tune various aspects of your site. Technically, these features
	are not part of the theme styling, but cover other aspects of site functionality. <strong>NOTE:</strong>
	The <em>FavIcon</em> and <em>Preferred Image for Facebook</em> options will be displayed only for
	Weaver II Pro or if you have the "Weaver II Theme Extras" plugin installed.<br /><hr /><br />
   <!-- ======== -->
<?php
	weaverii_free_hidden_opt('_wii_favicon_url');
	do_action('weaverii_favicon');

	weaverii_free_hidden_opt('_wii_imgsrc_url');
	do_action('weaverii_facebook');

?>
	<div class="wvr-option-subheader"><span style="color:blue;font-size:larger;"><b>Home Page</b></span></div>
	<p>WordPress allows you to specify what page is used for your home page - either the standard WordPress blog,
	or a static page (which can be a Weaver "Page with Posts" page). How to set the Front page displays options
	is not totally obvious - please see the Weaver Help topic for a more complete explanation.</p>
	<p>You can set the front page on the Dashboard <em>Settings&rarr;Reading panel</em>:
	<a href="<?php echo esc_url( home_url( '/' ) . 'wp-admin/options-reading.php' ); ?>"><strong>Set Front Page Displays</strong></a></p><br />

	<div class="wvr-option-subheader"><span style="color:blue;font-size:larger;"><b>Author Avatars</b></span></div>
	<p>For the best look, your site should support Avatars - a small image associated with
	a contributors e-mail address. <?php weaverii_site('','<?php weaverii_site(); ?>'); ?>Gravatar.com</a>
	is probably the most popular Avatar support, and is closely associated with WordPress. You should set up a Gravatar for
	the main authors of your blog. For contributors without any avatar, you can select an automatically
	generated avatar from several options found on the
	<a href="<?php echo esc_url( home_url( '/' ) . 'wp-admin/options-discussion.php' ); ?>">
	<strong>Settings&rarr;Discussion</strong></a> panel.
	</p>
	<hr />
<?php
	do_action('weaverii_child_siteoptions');
}

/* ================================= MOBILE OPTIONS =============================== */

function weaverii_admin_mobileopts() {
	$opts = array(

	array('name' => '#070Mobile Support Mode', 'id' => '_wii_mode_mobile', 'type' => 'select_id',
		  'info' => 'Select how Weaver II generates mobile views. (Default: Smart, hide sidebars) Important: see the help file!. &diams;',
		  'value' => array(
						   array('val' => 'weaver-mobile-smart-nostack', 'desc' => 'Smart, hide sidebars'),
						   array('val' => 'weaver-mobile-smart-stacked', 'desc'=> 'Smart, stacked sidebars' ),
						   array('val' => 'weaver-mobile-resp-nostack', 'desc' => 'Responsive, hide sidebars'),
						   array('val' => 'weaver-mobile-responsive', 'desc' => 'Responsive, stacked sidebars')
		 )),

	array('name' => '#070<small>Disable Mobile Support</small>', 'id' => '_wii_mobile_disable', 'type' => '=checkbox',
			'info' => 'Disable support for mobile devices. Your site will shrink the sizes of the sidebars and content
areas, but will otherwise not be responsive or stack sidebars. &diams;'),

	array('name' => '<small>Alternative Mobile Plugins:</small>','type'=> '=note',
			'info' => 'If you need to use an alternative Mobile Theme plugin, you <strong>must</strong> set one of the
responsive <em>Mobile Support Modes</em> above, in which case your site will continue to display responsively on desktop browsers and unrecognized mobile devices, while using the alternative plugin for recognized mobile devices.
You can also <em>Disable Mobile Support</em>, in which case you will not get fully responsive desktop support.'),

	array('name' =>'Mobile Simulator Options','type'=>'subheader',
			'info' => 'Settings for the Mobile simulator. Available only when using "Smart" Mobile Modes.'),
	array('name' => '#070Simulate Mobile Device', 'id' => '_wii_sim_mobile', 'type' => 'select_id',
		  'info' => 'Simulate Mobile Device (&#9688;Smart Modes Only): Select type to see what your site will look like on mobile devices. The simulator works only when using a "Smart" mobile support mode. Otherwise, just shrink your browser for the Responsive modes (IE7/IE8 don\'t work to shrink). &diams;',
		  'value' => array(
				array('val' => 'none', 'desc' => 'Simulation Off'),
				array('val' => 'WeaverMobile', 'desc'=> 'Smart Phone' ),
				array('val' => 'WeaverMobileSmallTablet', 'desc' => 'Small Tablet (Fire)'),
				array('val' => 'WeaverMobileTablet', 'desc' => 'Large Tablet (iPad)')
			)),

	array('name' => '#070<small>... even if not admin</small>', 'id' => '_wii_sim_mobile_always', 'type' => '=checkbox',
		'info' => 'Normally, the mobile simulation will be displayed only for admins. Checking this allows visitors to view the simulated mobile view. IMPORTANT! Be careful using this option - it is intended for development and demos only and normally should be disabled for productions sites. &diams;'),


	array('name' =>'Small Screen Devices','type'=>'=subheader',
		'info' => 'Settings for smartphones, other small screen devices, and small tablets.'),

	array('name' => '#070Show Full Blog Posts', 'id' => 'wii_mobile_full_posts', 'type' => '+checkbox',
		'info' => 'Show full post text on blog pages - posts are excerpted by default on mobile devices (&#9688;Smart Modes only). (&#9679;Pro)'),

	array('name' => '#070Show Footer Widgets', 'id' => 'wii_mobile_show_footerwidgets', 'type' => '+checkbox',
		'info' => 'Will show footer widget area on non-stacked Mobile Modes for mobile devices. (Footer widget is always displayed on stacked Mobile Modes.) (&#9679;Pro)'),

	array('name' => '#070Hide Top/Bottom Widget Areas', 'id' => 'wii_mobile_hide_topbottom_widgets', 'type' => '+checkbox',
		'info' => 'Hide Top and Bottom Widget Areas in addition to Sidebars. (&#9679;Pro)'),

	array('name' => '#070No Auto-Underline Links', 'id' => 'wii_mobile_nounderline', 'type' => '+checkbox',
		'info' => 'Underlined links are easier to use on most mobile devices. This will disable auto-underlined links. (&#9679;Pro)'),

	array('name' => '#070View Toggle', 'id' => 'wii_layout_view_toggle', 'type' => '+select_id',
		  'info' => 'How to display the Full View/Mobile View toggle button on mobile devices (&#9688;Smart Modes only). (&#9679;Pro)',
		  'value' => array(
				array('val' => 'both', 'desc' => 'Both top &amp; bottom'),
				array('val' => 'top', 'desc'=> 'Top only' ),
				array('val' => 'bottom', 'desc' => 'Bottom only'),
				array('val' => 'hide', 'desc' => 'Hide view toggle')
			)),
	array('name' => '#070<small>Alternate Full View HTML</small>', 'id' => '_wvr_mobile_fullmsg', 'type' => '+textarea',
		'info' => 'HTML to replace standard Full View icon (include style if needed). (&#9679;Pro) &diams;'),
	array('name' => '#070<small>Alternate Mobile View HTML</small>', 'id' => '_wvr_mobile_mobilemsg', 'type' => '+textarea',
		'info' => 'HTML to replace standard Mobile View icon. (&#9679;Pro) &diams;'),

	array('name' => '#070Mobile Home Page', 'id' => 'wii_mobile_home_int', 'type' => '+text',
		'info' => 'Specify page ID for alternate Home page when site viewed from mobile device (&#9688;Smart Modes only). Recommended: check "Hide Page on the default Primary Menu" Per Page option for the page. (&#9679;Pro)'),

	array('name' => '#070Mobile Site Title', 'id' => '_wii_mobile_site_title', 'type' => '+textarea',
		'info' => 'Specify alternate Site Title if needed (&#9688;Smart Modes only) (Use &amp;nbsp; to hide Site Title on mobile). (&#9679;Pro) &diams;'),

	array('name' => '#070<small>Mobile Site Title Color</small>', 'id' => 'wii_mobile_title_color', 'type' => '+color',
		'info' => 'Alternate Color for Mobile Site Title (includes Responsive Modes). (&#9679;Pro)'),

	array('name' => '#070Mobile Header Image', 'id' => '_wii_mobile_header_url', 'type' => '+textmedia',
		'info' => 'Specify alternate header image for phone/small tablet mobile view (&#9688;Smart Modes only). (&#9679;Pro) &diams;'),

	array('name' => '#070<small>Mobile Header Image - Tablet</small>', 'id' => '_wii_mobile_tablet_header_url', 'type' => '+textmedia',
		'info' => 'Specify alternate header image for tablet mobile view (will usually not be necessary, &#9688;Smart Modes only). (&#9679;Pro) &diams;'),


	array('name' => '#070Custom CSS', 'id' => '_wii_mobile_css', 'type' => '+textarea',
		'info' => 'Custom site wide CSS included only when viewed on Mobile Device. Note that ".weaver-mobile" wrapping class can also be used for this purpose in the &lt;HEAD&gt; Section Custom CSS option (&#9688;Smart Modes only). (&#9679;Pro) &diams;'),

	array('name'=>'<span style="color:green;">More Mobile Options:</span>','type'=>'note',
		'info'=>'More mobile options are available for specific areas: Header, Menus, Post Specifics, Shortcodes.'),
	array( 'type' => 'submit'),


	array('name' =>'Tablets','type'=>'=subheader',
		'info' => 'Settings for iPad and other tablets'),

	array('name' => '#070Keep Site Margins', 'id' => 'wii_mobile_keep_site_margins', 'type'=>'+checkbox',
		'info' => 'Retain standard site margins on tablets (&#9688;Smart Modes only) - will normally reduce outer margins by default. (&#9679;Pro)'),

	array('name' => '#070No Auto-Underline Links', 'id' => 'wii_mobile_tablet_nounderline', 'type' => '+checkbox',
		'info' => 'Underlined links are easier to use on most tablet devices. This will disable auto-underlined links. (&#9688;Smart Modes only - Responsive Modes never auto-underline links on tablets.) (&#9679;Pro)'),


	array('name' =>'Alternate Mobile Theme','type'=>'=subheader',
		'info' => 'Use Alternate Mobile Theme when site viewed by Mobile Device.'),

	array('name' => '#070Use Alternate Mobile Theme', 'id' => '_wii_mobile_alt_theme', 'type' => '+checkbox',
		'info' => 'Mobile Devices will use the Mobile Theme Settings saved in the "Save Settings to Mobile Settings"
option on the "Save/Restore" tab (&#9688;Smart Modes only). (The Alternate Mobile Theme can not be displayed with the Mobile Simulator.) (&#9679;Pro) &diams;')
	);
?>
<h3>Mobile Device Options <?php weaverii_help_link('help.html#MobileHelp','Help for Mobile Options'); ?></h3>
<p style="font-size:small">
	These are the main options that control how Weaver II displays your site on Mobile devices. Please note that there are
	other options that affect the mobile view located on other tabs (e.g., the Main Options : Header tab). Options that affect
	the mobile view are displayed with a <span style="color:#080;font-weight:bold;">Green Label</span>.
</p>
<?php
	weaverii_sapi_submit();
    weaverii_check_cache_plugins();

	weaverii_form_show_options($opts);

	if (weaverii_getopt_checked('_wii_mobile_alt_theme')) {
		$temp = get_option( apply_filters('weaver_options','weaverii_settings_mobile') );
		if ($temp === false) {
			echo '<strong style="color:red;">Warning: No Mobile Theme Settings have been saved. You <strong>must</strong> use the "Save Settings to Mobile Settings" from the Save/Restore tab first!</strong><br />';
		}
	}

?>
<br />
<?php if ( ! weaverii_hide_advanced_optval('_wii_apple_touch_icon_url')) {
?>
   <span style="color:blue;"><b>Apple Touch Icon for iOS</b></span><br />
	<p>When this site is viewed on an Apple iOS device such as an iPhone or iPad (&#9688;Smart Modes only), Apple iOS recognizes a special icon
	that can be displayed on the device's home screen. The recommend size for this icon is a <code>.png</code> file 57x57 px for basic display,
	or 114x114 px for enhanced display. &diams;</p>
	<p>
<?php
	$icon=weaverii_getopt('_wii_apple_touch_icon_url');
	if ($icon != '') {
		echo '<img src="' . $icon . '" alt="apple touch" />&nbsp;';
	}
?>
<strong style="color:#070">Apple Touch Icon URL: </strong>
	<textarea name="<?php weaverii_sapi_main_name('_wii_apple_touch_icon_url'); ?>" id="_wii_apple_touch_icon_url" rows=1 style="width: 350px"><?php echo(esc_textarea(weaverii_getopt('_wii_apple_touch_icon_url'))); ?></textarea><?php weaverii_media_lib_button('_wii_apple_touch_icon_url'); ?>&nbsp;&nbsp;Full path to Apple Touch Icon</p>
	<br />
<?php
}
?>

   <span style="color:blue;"><b>Caching Plugins for Weaver II</b></span><br />
	<p>Because of the advanced Smart Mobile View capabilities provided by Weaver II, many existing WordPress Caching plugins
	will <strong>not</strong> work correctly with Weaver II <em>when it is displayed in Smart Mobile Device mode</em>.
	(Using one of the Responsive mobile display modes will allow Weaver II to work correctly with any cache plugin.)
	For using the &#9688;Smart Modes mobile support, we have found that the <strong>Quick Cache</strong> and
	<strong>W3 Total Cache</strong> plugins do work with Weaver Smart Mobile mode when
	properly configured. Please see the Weaver II help file for instructions on
	using compatible cache plugin &rarr;. <?php weaverii_help_link('help.html#quickcache','Cache Setting for Weaver II');?>
	<p>

<?php
weaverii_sapi_submit();
}

function weaverii_adv_seo_opts() {
?>
		<a name="siteopts" id="siteopts"></a>
		<div class="wvr-option-header">SEO
		<?php weaverii_help_link('help.html#SEO','Help on SEO');?></div>
		<p>Weaver II has been designed to follow the latest SEO (Search Engine Optimization) guidelines.
		Each non-home page will use the recommended "Page Title | Site Title" format, and the site is formatted
		using the appropriate HTML5 tags for optimal SEO performance.</p>
		<p>If you want optimal SEO for your site, we recommend using an SEO plugin such as
		<em>WordPress SEO by Yoast.</em>
		<hr />

		<!-- ======== -->
		<div class="wvr-option-subheader">SEO/Meta Tags (legacy support)</div><br/>
		<p>Previous versions of Weaver II supported two &lt;meta&gt; tags: "description" and "keywords". This is no
		longer supported. If you want these values in your site, you can use the <em>Advanced Options : &lt;HEAD&gt;
		Section</em> option to add them.</p>

<input name="<?php weaverii_sapi_main_name('_wii_metainfo'); ?>" id="<?php echo '_wii_metainfo';?>" type="hidden" value="<?php echo esc_textarea(addslashes(weaverii_getopt('_wii_metainfo'))); ?>" />

<?php
	$oldmeta = weaverii_getopt('_wii_metainfo');
	if ($oldmeta != '') {
?>
		<p>You have a value for this meta information saved in your settings - probably from a previous
		version of Weaver II. If you had set these to something other than the default, you might want
		to copy/paste these into the <em>Advanced Options : &lt;HEAD&gt; Section</em> option. Otherwise,
		you should consider using an SEO plugin.</p>

		<p style="background:#ddd;">
			<?php echo esc_textarea($oldmeta); ?>
		</p>
<?php

	}
}
?>
