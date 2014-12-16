<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
/* Weaver II - admin Help
 *
 * This is the intro form. It won't have any options because it will be outside the main form
 */

function weaverii_admin_help() {
	$tdir = get_template_directory_uri();

	$readme = $tdir."/help/help.html";

?>
	<span style="font-size:larger;font-weight:bold;padding-right:70px;">Weaver II Help</span>

<small><strong>Media Library Picker Tool:</strong></small>&nbsp;<input name="wii_media_url" type="text" style="width:400px;height:22px;" class="regular-text" name="wii_media_url"
				id="wii_media_url" value="Paste media URL here that you can then Copy/Paste elsewhere." />
				<?php   weaverii_media_lib_button('wii_media_url'); ?>
	<p>You will notice
	<?php weaverii_help_link('help.html#top', weaverii_t_('Weaver II Help' /*a*/ )); ?>
	next to many options and option sections on the Weaver Admin tabs. Clicking the ? will open the Weaver Help
	file to the appropriate place.</p>

	<p>More help is available at the <?php weaverii_site(); ?><strong>Weaver Theme web site</strong></a>, which includes
	a support forum.</p>
<?php
	do_action('weaverii_child_help');
?>
<div style="float:left;width:40%;padding-right:3%">
<?php
	echo("<div class=\"wvr-help\"><h2><b><a href=\"$readme\" target=\"_blank\">Weaver II Theme Documentation</a></b></h2>
<h3>Table of Contents</h3>
	  <ul>
	  <li><a href=\"$readme#get_started\" target=\"_blank\">How to get started</a></li>
	  <li><a href=\"$readme#DesignHints\" target=\"_blank\">Design Hints</a></li>
	  <li><a href=\"$readme#homepage\" target=\"_blank\">All About Your Site's Home Page</a></li>
	  <li><a href=\"$readme#PredefinedThemes\" target=\"_blank\">Weaver Predefined Subthemes</a></li>
	  <li><a href=\"$readme#MainOptions\" target=\"_blank\">Weaver Main Options</a>
		<ul>
		  <li><a href=\"$readme#GenApp\" target=\"_blank\">General Appearance</a></li>
		  <li><a href=\"$readme#layout\" target=\"_blank\">Layout</a></li>
		  <li><a href=\"$readme#WidgetAreas\" target=\"_blank\">Widget Areas</a></li>
		  <li><a href=\"$readme#HeaderOpt\" target=\"_blank\">Header Options</a></li>
		  <li><a href=\"$readme#HeaderWidgetArea\" target=\"_blank\">Header Horizontal Widget Area</a></li>
		  <li><a href=\"$readme#MenuBar\" target=\"_blank\">Menu Bar and Info Bar</a></li>
		  <li><a href=\"$readme#Links\" target=\"_blank\">Links</a></li>
		  <li><a href=\"$readme#ContentAreas\" target=\"_blank\">Content Areas</a></li>
		  <li><a href=\"$readme#PPSpecifics\" target=\"_blank\">Post Specifics</a></li>
		  <ul>
			<li><a href=\"$readme#FeaturedImage\" target=\"_blank\">The Featured Image</a></li>
			<li><a href=\"$readme#CustomInfo\" target=\"_blank\">Custom Post Info Lines</a></li>
		  </ul>
		  <li><a href=\"$readme#FooterOpt\" target=\"_blank\">Footer</a></li>
		  <li><a href=\"$readme#Fonts\" target=\"_blank\">Fonts</a></li>
		</ul>
	  </li>
	  <li><a href=\"$readme#AdvancedOptions\" target=\"_blank\">Weaver Advanced Options</a>
	  <ul>
	  <li><a href=\"$readme#HeadSection\" target=\"_blank\">Site
		  &lt;HEAD&gt;
Section</a></li>
	  <li><a href=\"$readme#HTMLInsertion\" target=\"_blank\">HTML Code Insertion Areas</a></li>
	  <li><a href=\"$readme#pageTemplateOptions\" target=\"_blank\">Page Templates</a></li>
	  <li><a href=\"$readme#ArchivePages\" target=\"_blank\">Archive-type Pages</a></li>
	  <li><a href=\"$readme#BackgroundImages\" target=\"_blank\">Background images</a></li>
	  <li><a href=\"$readme#Mobile\" target=\"_blank\">Mobile</a></li>
	  <li><a href=\"$readme#SEO\" target=\"_blank\">SEO</a></li>
	  <li><a href=\"$readme#AdvSiteOptions\" target=\"_blank\">Site Options</a></li>
	  </ul>
	  </li>
	  <li><a href=\"$readme#AdminOptions\" target=\"_blank\">Admin Options</a></li>
	  <li><a href=\"$readme#WeaverIIPro\" target=\"_blank\">Weaver II Pro</a></li>
	  <li><a href=\"$readme#ProShortcodes\" target=\"_blank\">Shortcodes</a></li>
	  <li><a href=\"$readme#SaveRestore\" target=\"_blank\">Save/Restore Themes</a></li>
	  <li><a href=\"$readme#PageTemplates\" target=\"_blank\">Weaver Page Templates</a></li>
	  <ul>
		<li><a href=\"$readme#PerPostTemplate\" target=\"_blank\">Settings for \"Page with Posts\" Template</a></li>
	  </ul>
	  <li><a href=\"$readme#editstyling\" target=\"_blank\">Post/Page Editor Styling</a>
	  <li><a href=\"$readme#raw_html\" target=\"_blank\">Entering Raw HTML and Scripts </a>
	  <li><a href=\"$readme#post_formats\" target=\"_blank\">Post Formats </a>
	  <li><a href=\"$readme#PerPage\" target=\"_blank\">Per Page and Per Post Options</a>
		<ul>
		  <li><a href=\"$readme#perpoststyle\" target=\"_blank\">Per Post Style</a></li>
		  <li><a href=\"$readme#shortcodes\" target=\"_blank\">Weaver Shortcodes</a></li>
		  <ul>
				<li><a href=\"$readme#breadcrumbs\" target=\"_blank\">[weaver_breadcrumbs]</a></li>
				<li><a href=\"$readme#headerimage\" target=\"_blank\">[weaver_header_image]</a></li>
				<li><a href=\"$readme#schtml\" target=\"_blank\">[weaver_html]</a></li>
				<li><a href=\"$readme#scdiv\" target=\"_blank\">[div]</a></li>
				<li><a href=\"$readme#sciframe\" target=\"_blank\">[weaver_iframe]</a></li>
				<li><a href=\"$readme#pagenav\" target=\"_blank\">[weaver_pagenav]</a></li>
				<li><a href=\"$readme#showhidemobile\" target=\"_blank\">[weaver_show_if_mobile] / [weaver_hide_if_mobile]</a></li>
				<li><a href=\"$readme#showhideloggedin\" target=\"_blank\">[weaver_show_if_logged_in] / [weaver_hide_if_logged_in]</a></li>
				<li><a href=\"$readme#showposts\" target=\"_blank\">[weaver_show_posts]</a></li>
				<li><a href=\"$readme#sitetitlesc\" target=\"_blank\">[weaver_site_desc]</a></li>
				<li><a href=\"$readme#video\" target=\"_blank\">[weaver_vimeo], [weaver_youtube]</a></li>
		  </ul>
		</ul>
	  <li><a href=\"$readme#CustomMenus\" target=\"_blank\">Custom Menus</a></li>
	  <li><a href=\"$readme#plugins\" target=\"_blank\">Built-in Support for Other Plugins</a></li>
	  <li><a href=\"$readme#quickcache\" target=\"_blank\">Compatible Caching Plugins</a></li>
	  <li><a href=\"$readme#language_support\" target=\"_blank\">Using Weaver in your language</a></li>
	  <li><a href=\"$readme#ie\" target=\"_blank\">Internet Explorer Compatibility</a></li>
	  <li><a href=\"$readme#TechNotes\" target=\"_blank\">Technical Notes</a></li>
	  <li><a href=\"$readme#divhierarchy\" target=\"_blank\">Weaver HTML&lt;div&gt;Hierarchy</a></li>
	  <li><a href=\"$readme#Version1_0\" target=\"_blank\">Release Notes</a></li>
	  <li><a href=\"$readme#UpgradingWeaver\" target=\"_blank\">Upgrading from Weaver</a>
	  <ul>
	  <li><a href=\"$readme#oldnewdiff\" target=\"_blank\">Differences between Weaver and Weaver II</a></li>
	<li><a href=\"$readme#conversion\" target=\"_blank\">The Conversion Process</a></li>
	<li><a href=\"$readme#newsidebars\" target=\"_blank\">The New Sidebars</a></li>
	<li><a href=\"$readme#converttemplates\" target=\"_blank\">Converting Page Templates</a></li>
	  </ul>
	  </li>
	</ul></div>\n");
?>
</div>
<div style="float:left;width:42%;padding-right:1%">
	<h2><b><a href="<?php echo $tdir . '/help/css-help.html';?>" target="blank">CSS HELP</a></b></h2>
	<p>A short CSS Tutorial</p>
	<h2><b><a href="<?php echo $tdir . '/help/weaverii_snippets.html';?>" target="blank">SNIPPETS</a></b></h2>
	<p><strong>CSS Snippets for styling your Weaver II theme</strong>
	<ul>
  <li>Change Any Font Size</li>
  <li>Change the Comment Bubble</li>
  <li>Change Margins of Footer Widget Areas</li>
  <li>When you make the Footer (#colophon) Last</li>
  <li>Hide Divider Lines on Vertical Menu</li>
  <li>Post Information Line Icons</li>
  <li>Alternate Menu Bar Gradient</li>
  <li>Styling Menus</li>
</ul>
<p style="font-size:8px">Versions: Weaver II V <?php echo weaverii_getopt('wii_version_id'); ?>
 | Settings: <?php echo weaverii_getopt('wii_style_version');?> | Saved Settings: <?php echo (int) weaverii_getopt('wii_saved_settings'); ?>
</p>
</div>


<div style="clear:both;"></div>

<?php
}

?>
