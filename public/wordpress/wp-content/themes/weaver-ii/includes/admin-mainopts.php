<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
/* Weaver II - admin Main Options
 *
 * This function will start the main sapi form, which will be closed in admin-adminopts
 */

// ======================== Main Options > Top Level ========================
function weaverii_admin_mainopts() {
?>
<div id="tabwrap_main" style="padding-left:4px;">

<div id="tab-container-main" class='yetiisub'>
	<ul id="tab-container-main-nav" class='yetiisub'>
		<li><a href="#ogenappear" title="Wrapping background colors, rounded corners, borders, fade, shadow, search form"><?php echo(weaverii_t_('General Appearance' /*a*/ )); ?></a></li>
		<li><a href="#olayout" title="Theme width, margins; Sidebar Layouts"><?php echo(weaverii_t_('Layout' /*a*/ )); ?></a></li>
		<li><a href="#ofonts" title="Set fonts for various page elements."><?php echo(weaverii_t_('Fonts' /*a*/ )); ?></a></li>
		<li><a href="#owidgets" title="Backgrounds, margins, borders, text colors of widgets and widget areas"><?php echo(weaverii_t_('Widget Areas' /*a*/ )); ?></a></li>
		<li><a href="#oheaderopts" title="Site Title/Tagline properties, Header Image"><?php echo(weaverii_t_('Header' /*a*/ )); ?></a></li>
		<li><a href="#omenus" title="Menu text and bg colors and other properties; Info Bar properties"><?php echo(weaverii_t_('Menus' /*a*/ )); ?></a></li>
		<li><a href="#olinks" title="Colors and properties of links"><?php echo(weaverii_t_('Links' /*a*/ )); ?></a></li>
		<li><a href="#ocontent" title="Text colors and bg, image borders, featured image, other properties related to all content"><?php echo(weaverii_t_('Content Areas' /*a*/ )); ?></a></li>
		<li><a href="#opostspecific" title="Properties related to posts: titles, meta info, navigation, excerpts, featured images, and more."><?php echo(weaverii_t_('Post Specifics' /*a*/ )); ?></a></li>
		<li><a href="#ofooter" title="Footer options: bg color, borders, more. Site Copyright."><?php echo(weaverii_t_('Footer' /*a*/ )); ?></a></li>
	</ul>

<h3>Main Options<?php weaverii_help_link('help.html#MainOptions','Help for Main Options'); ?></h3>

	<div id="ogenappear" class="tab_mainopt" >
		<?php weaverii_mainopts_general(); ?>
	</div>

	<div id="olayout" class="tab_mainopt" >
		<?php weaverii_mainopts_layout(); ?>
	</div>

	<div id="ofonts" class="tab_mainopt" >
		<?php weaverii_mainopts_fonts(); ?>
	</div>

	<div id="owidgets" class="tab_mainopt" >
		<?php weaverii_mainopts_widgets(); ?>
	</div>

	<div id="oheaderopts" class="tab_mainopt" >
		<?php weaverii_mainopts_header(); ?>
	</div>

	<div id="omenus" class="tab_mainopt" >
		<?php weaverii_mainopts_menus(); ?>
	</div>

	<div id="olinks" class="tab_mainopt" >
		<?php weaverii_mainopts_links(); ?>
	</div>
	<div id="ocontent" class="tab_mainopt" >
		<?php weaverii_mainopts_content(); ?>
	</div>

	<div id="opostspecific" class="tab_mainopt" >
		<?php weaverii_mainopts_posts(); ?>
	</div>

	<div id="ofooter" class="tab_mainopt" >
		<?php weaverii_mainopts_footer(); ?>
	</div>

</div> <!-- #tab-container-main -->
<?php
	weaverii_sapi_submit();
?>
</div>  <!-- #tabwrap_main -->
   <script type="text/javascript">
		var tabberMainOpts = new Yetii({
		id: 'tab-container-main',
		tabclass: 'tab_mainopt',
		persist: true
		});
</script>
<?php
}

// ======================== Main Options > General Appearance ========================
function weaverii_mainopts_general() {
	$opts = array(
	array( 'type' => 'submit'),
	array('name' => 'General Appearance', 'id' => 'a_generalappearance', 'type' => 'header',
		'info' => 'Overall settings that affect content and widget areas',
			'help' => 'help.html#GenApp'),
	array('name' => 'Outside BG', 'id' => 'wii_body_bgcolor', 'type' => 'ctext',
		  'info' => 'Background color that wraps entire page. (&lt;body&gt;) Using <em>Appearance->Background</em> will override this value, or allow a background image instead.'),
	array('name' => 'Wrapper Page BG', 'id' => 'wii_page_bgcolor', 'type' => 'ctext',
		  'info' => "Background for top level #wrapper div - default BG if you don't change others."),
	array('name' => 'Default Text Color', 'id' => 'wii_body_color', 'type' => 'ctext',
		  'info' => "Default text color (&lt;body&gt;). Most areas will override this color with their own color."),
	array('name' => 'Main Area BG', 'id' => 'wii_main_bgcolor', 'type' => 'ctext',
		  'info' => 'Background for main page #main div - wraps container, content and sidebars (uses wrapper bg if not set).'),
	array('name' => '<small>Wide Main Area BG</small>', 'id' => 'wii_wide_main_bg', 'type' => '+checkbox',
			'info' => "Extend Main Area BG to edges. Most useful with Wide Header and Footer (see those tabs) (&#9679;Pro)') "),
	array('name' => 'Container Area BG', 'id' => 'wii_container_bgcolor', 'type' => 'ctext',
		  'info' => 'Background for #container div - wraps content and sidebars (Uses wrapper bg if not set.).'),

	array('name' => 'Rounded Corners', 'id' => 'wii_rounded_corners', 'type' => 'checkbox',
			'info' => "Use rounded corners for main area, menu bars, widgetareas, header and footer"),
	array('name' => 'Rounded Corners (Content)', 'id' => 'wii_rounded_corners_content', 'type' => 'checkbox',
			'info' => "Use rounded corners for content area (page and post content)"),
	array('name' => '<small>Corner Radius</small>', 'id' => 'wii_rounded_corners_radius', 'type' => '=text',
			'info' => 'Controls how "round" corners are. Specify a value (5 to 15 look best) for corner radius. (Default: 10)'),


	array('name' => 'Fade Outside BG', 'id' => 'wii_fadebody_bg', 'type' => 'checkbox',
			'info' => 'Will fade the Outside BG color, darker at top to lighter at bottom.'),
	array('name' => 'Wrap site with shadow', 'id' => 'wii_wrap_shadow', 'type' => 'checkbox',
			'info' => "Will wrap site's main area with a shadow"),


	array('name' => 'Borders', 'id' => 'a_borders','type' =>'subheader',
		  'info' => 'Border Attributes for various areas'),
	array('name' => 'Major Area Borders', 'id' => 'wii_useborders', 'type' => 'checkbox',
			'info' => 'Include border around site wrapper area and all sidebars.'),
	array('name' => 'Site Wrapper Border', 'id' => 'wii_wrapper_border', 'type' => 'checkbox',
			'info' => 'Include border around site wrapper area (<em>Major Area Borders</em> also includes this border)'),
	array('name' => 'For Widget Areas:', 'type' =>'note',
			'info' => 'You can set borders for individual widget areas from the <em>Widget Areas</em> tab'),
	array('name' => 'Border Attributes', 'type' => '=subheader_alt',
		  'info' => 'Border attributes apply to all areas set to show border'),
	array('name' => '<small>Border Color</small>', 'id' => 'wii_border_color', 'type' => '+color',
			'info' => 'Color of borders. (Default: #222) (&#9679;Pro)'),
	array('name' => '<small>Border Width</small>', 'id' => 'wii_border_width_int', 'type' => '+val_px',
			'info' => 'Width of borders. (Default: 1px) (&#9679;Pro)'),
	array('name' => '<small>Border Style</small>', 'id' => 'wii_border_style', 'type' => '+select_id',
			'info' => 'Style of borders - width needs to be > 1 for some styles to work correctly (&#9679;Pro)',
			'value' => array(
				array('val' => 'solid', 'desc' => 'Solid' ),
				array('val' => 'dotted', 'desc' => 'Dotted' ),
				array('val' => 'dashed', 'desc' => 'Dashed' ),
				array('val' => 'double', 'desc' => 'Double' ),
				array('val' => 'groove', 'desc' => 'Groove' ),
				array('val' => 'ridge', 'desc' => 'Ridge' ),
				array('val' => 'inset', 'desc' => 'Inset' ),
				array('val' => 'outset', 'desc' => 'Outset' )
				)),

	array('name' => 'Background Gradient', 'id' => 'a_grad','type' => '=subheader',
		  'info' => 'Define custom BG gradient - used for widget and other areas'),
	array('name' => 'Top Gradient Color', 'id' => 'grad_top', 'type' => '+color',
			'info' => 'Color for top of gradient (&#9679;Pro)'),
	array('name' => 'Bottom Gradient Color', 'id' => 'grad_bottom', 'type' => '+color',
			'info' => 'Color for bottom of gradient (&#9679;Pro)'),
	array('name' => 'Usage note:', 'type' =>'=note',
			'info' => 'You can select this gradient for use on the header, the footer, and different widget areas using the BG Gradient checkbox found with those items. You can also add class="wvr-gradient" to use elsewhere.'),
	array('name' => '<small>Disable Background Gradient</small>', 'id' =>'grad_disable' , 'type' => '=checkbox',
		  'info' => 'Disable using custom Background Gradient everywhere - useful for imported subthemes created with Weaver II Pro version if you don\'t want BG Gradient.'),

	array('name' => 'Search Form', 'id' => 'a_searchform', 'type' => '=subheader',
		  'info' => 'Attributes of the Search Form'),
	array('name' => 'Search Message', 'id' =>'wii_search_msg' , 'type' => '+widetext', //code - option done in code
		  'info' => 'New default search message. (Default: Search Site) (&#9679;Pro)'),
	array('name' => 'Use Go Button', 'id' =>'wii_go_button' , 'type' => '+checkbox',    //code
		  'info' => 'Use "Go" button instead of default "magnifier" button. (&#9679;Pro)'),
	array('name' => '<small>Search Button URL</small>', 'id' =>'_wii_search_button_url' , 'type' => '+textmedia', //code
		  'info' => 'URL for replacement Search Button image. Should be 20px by 20px. (Default: Magnifier) (&#9679;Pro) &diams;'),
	array('name' => '<small>Hide Search when Nothing Found', 'id' =>'_wii_hide_not_found_search' , 'type' => '+checkbox',       //code
		  'info' => 'Hide the Search Box when a Search fails, or there are no matching posts in an archive. (&#9679;Pro) &diams;'),
	array('name' => '', 'type'=>'note',
			'info' => 'Note: &diams; indicates options saved only with full backup save'),

	array('name' => 'Style Sheet', 'id' => 'a_stylesheet', 'type' =>'=subheader',
		  'info' => 'Advanced Option: Use alternative style sheet'),

	array('name' => 'Use style-minimal.css', 'id' =>'wii_minimial_style', 'type' => '=checkbox',
		  'info' => 'Use the alternative "style-minimal.css" style sheet instead of the standard "style.css". Most useful when used for custom themes based on the "Blank" subtheme. Using this style sheet will likely "break" other subthemes.'),
	array ('name' => '<small>Custom Replacement CSS File</small>', 'id' => '_wii_custom_style', 'type' => '=textarea',
		   'info' => 'Advanced Option. Specify URL for custom .css file to replace theme standard style.css. Ideally, save file in media library. Will survive theme updates. &diams;'),
	);

?>
   <p>
Overall options that affect site's <strong>General Appearance</strong>, including main background colors, rounded corners, <strong>Borders</strong>,
the <strong>Search Form</strong>, and alternate style sheet.
   </p>
<?php
	weaverii_form_show_options($opts);
}

// ======================== Main Options > Header ========================
function weaverii_mainopts_header() {
	$opts = array(
	array( 'type' => 'submit'),
	array('name' => 'Header Options', 'id' => 'a_header_opts', 'type' => 'header',
			'info' => 'Options affecting site Header',
			'help' => 'help.html#HeaderOpt'),
	array('name' => 'Header BG', 'id' => 'wii_header_bgcolor', 'type' => 'ctext',
			'info' => 'Background for the header area.'),
	array('name' => '<small>Use BG Gradient</small>', 'id' => 'gradient_header', 'type' => '+checkbox',
			'info' => 'Add Weaver Background Gradient (as set on General Appearance tab) to header (works best when you hide header imaage) (&#9679;Pro)'),
	array('name' => '<small>Header Padding: Top/Bottom</small>', 'id' => 'wii_branding_padding', 'type' => '=text_tb',
			'info' => 'Padding at top/bottom of header. (Default:0/0)'),
	array('name' => '<small>Space After Header</small>', 'id' => 'wii_after_header_int', 'type' => '=val_px',
			'info' => 'Change the space between Header and Body'),

	array('name' => 'Site Title/Tagline', 'id' => 'a_site_title_des', 'type' =>'subheader',
		  'info' => 'Settings related to the Site Title and Tagline (Tagline sometimes called Site Description)'),
	array('name' => 'Site Title', 'id' => 'wii_title_color', 'type' => 'ctext',
			'info' => "The site's main title in the header (blog title)"),
	array('name' => '<small>Site Title Font Size</small>', 'id' => 'wii_title_font_size', 'type' => 'val_percent',
			'info' => "Title font size (default: 300%)"),

	array('name' => '<small>Title Position</small>', 'id' => 'wii_title_position_xy', 'type' => '=text_xy_percent',
			'info' => 'Adjust left and top margins for Title. Decimal and negative values allowed. (Default: X: 7%, Y:1%)'),
	array('name' => 'Note on X/Y Percentages:', 'id' => 'wii_headern1', 'type' => 'note',
			'info' => 'The exact effect of the X/Y percentages for title/tagline/extra html will require some experimentation to get the positioning you want, and will work differently if you move them over the header image. When not moved over the header, you typically will use single digit Y values, while you will need double digit values when moved over the header. You can use negative values.'),
	array('name' => '<small>Title Max Width</small>', 'id' => 'wii_title_max_w', 'type' => '=val_percent',
			'info' => "Maximum width of title in header area (Default: 90%)"),
	array('name' => '<small>Move Title over Header Image</small>', 'id' => 'wii_title_over_header', 'type' => '=checkbox',
			'info' => 'Move the site Title over the Header Image.'),
	array('name' => '#070<small>Also Move on Mobile Views</small>', 'id' => 'wii_title_over_header_mobile', 'type' => '+checkbox',
			'info' => 'Also move the site Title over the Header Image on mobile view. (&#9679;Pro)'),
	array('name' => 'Hide Site Title/Tagline', 'id' => 'wii_hide_site_title', 'type' => '=checkbox',
			'info' => 'Hide display of Site Title, Tagline (Uses "display:none;" : SEO friendly.)'),
	array('name' => '#070<small>Hide on phones', 'id' => 'wii_hide_site_title_mobile', 'type' => '=checkbox',
			'info' => 'Hide title on phone sized devices.'),

	array('name' => 'Site Tagline', 'id' => 'wii_desc_color', 'type' => 'ctext',
			'info' => "The site's tagline (blog description)"),
	array('name' => '<small>Site Tagline Font Size</small>', 'id' => 'wii_desc_font_size', 'type' => 'val_percent',
			'info' => 'Site Tagline font size (default: 133%)'),

	array('name' => '<small>Tagline Position</small>', 'id' => 'wii_desc_position_xy', 'type' => '=text_xy_percent',
			'info' => 'Adjust default left and top margins for Tagline. (Default: X: 10% Y:0%)'),
	array('name' => '<small>Tagline Max Width</small>', 'id' => 'wii_desc_max_w', 'type' => '=val_percent',
			'info' => "Maximum width of Tagline in header area (Default: 90%)"),
	array('name' => '#070<small>Show Tagline on phone view</small>', 'id' => 'wii_desc_show_mobile', 'type' => '+checkbox',
			'info' => 'Display site Tagline on phone view. (&#9679;Pro)'),
	array('name' => '<small>Move Tagline over Header Image</small>', 'id' => 'wii_desc_over_header', 'type' => '=checkbox',
			'info' => 'Move the site Tagline over the Header Image.'),

	array('name' => 'Header Extra HTML', 'id' => 'wii_header_html', 'type' => '+textarea',
			'info' => "Add arbitrary HTML to Header Area (in &lt;div id=\"header-extra-html\"&gt;) (&#9679;Pro)"),

	array('name' => '<small>Extra HTML Position</small>', 'id' => 'wii_header_html_position_xy', 'type' => '+text_xy_percent',
			'info' => 'Adjust default left and top margins for Extra HTML. (In top area, or over header image.) (&#9679;Pro)'),
	array('name' => '<small>Move Extra HTML over Header Image</small>', 'id' => 'wii_header_html_over_header', 'type' => '+checkbox',
			'info' => 'Move the Extra HTML over the Header Image. <em>Must also check move Title and Tagline over Header optinos!</em> (&#9679;Pro)'),
	array('name' => '#070<small>Hide on Mobile</small>', 'id' =>'wii_header_html_hide_mobile' , 'type' => '+checkbox',  //code
		  'info' => 'Hide the extra HTML on phone and small tablet mobile views. (&#9679;Pro)'),


	array( 'type' => '=submit'),


	array('name' => 'Header Image', 'id' => 'a_header_image', 'type' =>'subheader', 'info' => 'Settings related to standard header image'),

	array('name' => 'Hide Header Image', 'id' => 'wii_hide_header_image', 'type' => 'checkbox',
			'info' => 'Hide display of standard header image on all pages.'),
	array('name' => '<small>Suggested Header Image Height</small>', 'id' => 'wii_header_image_height_int', 'type' => 'val_px',
			'info' => 'Change the default height of the Header Image. Standard size is 188. Beginning with WP 3.4, this is a <em>suggested</em> height. Header images will be responsively resized to retain the original proportions of the image.'),
	array('name' => '<small>Suggested Header Image Width</small>', 'id' => 'wii_header_image_width_int', 'type' => 'val_px',
			'info' => 'Change the default suggested width of the Header Image. (Default: theme width)'),
	array('name' => '<small>Use Actual Image Size</small>', 'id' => 'wii_header_actual_size', 'type' => '=checkbox',
			'info' => 'Use actual header image size. Useful for narrower header images. See Image Layout option below. (Default display size: theme width)'),
	array ('name' => '<small>Image Layout</small>',
		   'id' => 'wii_header_layout', 'type' => '=select_id', 'info' => 'Header Image Layour when displaying actual image size',
			'value' => array(
						array('val' => 'center', 'desc' => 'Centered (default)'),
						array('val' => 'left', 'desc' => 'Left Side'),
						array('val' => 'right', 'desc' => 'Right Side'))
		  ),
	array('name' => '<small>Hide Header Image on Normal View</small>', 'id' => 'wii_normal_hide_header_image', 'type' => '=checkbox',
			'info' => 'Hide display of standard header image when site viewed on normal devices (non-Mobile - only works properly with &#9688;Smart Mode).'),
	array('name' => '<small>Show Header Image on Large Tablet</small>', 'id' => 'wii_ipad_show_header_image', 'type' => '=checkbox',
			'info' => 'Show the Header on large tablets (e.g., iPad) - <em>Mostly useful when used with slider menu.</em>'),
	array('name' => '#070<small>Hide Header Image on Mobile View</small>', 'id' => 'wii_mobile_hide_header_image', 'type' => '=checkbox',
			'info' => 'Hide display of standard header image when site viewed on phones and small tablet devices.'),
	array('name' => '<small>Hide Header Image Front Page</small>', 'id' => 'wii_hide_header_image_front', 'type' => '=checkbox',
			'info' => 'Hide display of standard header image on front page only. (Also see Show Header Widget Area on Front Page.)'),


	array('name' => '<small>Header Image Links to Site</small>', 'id' => 'wii_link_site_image', 'type' => '=checkbox',
			'info' => 'Add a link to site home page for Header Image'),

	array( 'name' => '<small>Hide Featured Image for Header</small>', 'id' => 'wii_hide_featured_header', 'type' => '=checkbox',
			'info' => 'Hide the "Featured Image" (when set to image as wide as normal header image in Post/Page edit) from appearing as the header image in all views. (Also see "Show Featured Image in Posts").'),
	array( 'name' => '#070<small>Hide F.I. for Header (Mobile)</small>', 'id' => 'wii_hide_mobile_fi', 'type' => '+checkbox',
			'info' => 'Hide the "Featured Image" from appearing as the header image on &#9688;Smart Modes Mobile Views. (&#9679;Pro).'),
	array ('name' => '<small>Alternate Header Image</small>', 'id' => 'wii_alt_header_img', 'type' => '=textmedia', //code
		   'info' => 'URL for Alternate Header Image. You may also enter full &lt;img&gt; specification.'),


	array('name' => 'Header Widget Area', 'id' => 'a_headerwidgetarea', 'type' =>'subheader',
		  'info' => 'Settings for Header Horizontal Widget Area',
		  'help' => 'help.html#HeaderWidgetArea'),
	array('name' => 'Area BG', 'id' => '_wii_hdr_widg_bgcolor', 'type' => 'ctext',
		'info' => 'Background for the header horizontal widget area. &diams;'),
	array('name' => 'Area Font Size', 'id' => '_wii_hdr_widg_fontsize', 'type' => 'val_percent',
		'info' => 'Header Widget Area font size (default: 100%). &diams;'),
	array('name' => 'Area Height', 'id' => '_wii_hdr_widg_h_int', 'type' => 'val_px',
			'info' => 'Header widget area height. (default:tallest widget) &diams;'),
	array('name' => '<small>Show on Front Page Only</small>', 'id' => '_wii_hdr_widg_frontpage', 'type' => '=checkbox',
			'info' => 'Display the header widget area on the front page only. (Also see Hide Header Image on Front Page.) &diams;'),
	array('name' => '<small>Display After Header Image</small>', 'id' => '_wii_hdr_widg_afterimg', 'type' => '=checkbox',
			'info' => 'Display the header widget area after (under) the header image. &diams;'),

	array('name' => '<small>Hide Widget Area for Normal View</small>', 'id' => '_wii_hdr_widg_hide_normal', 'type' => '=checkbox',
		  'info' => 'Hide entire header widget area on all pages for normal (desktop) view (will show on narrow desktop and mobile views). &diams;' ),
	array('name' => '#070<small>Hide Widget Area for Mobile View</small>', 'id' => '_wii_hdr_widg_hide_mobile', 'type' => '=checkbox',
		  'info' => 'Hide entire header widget area for mobile devices. &diams;' ),
	array( 'type' => 'submit'),

	array('name' => 'Header Widget Area Widgets', 'type' =>'subheader', 'info' => 'Settings for widgets within Header Widget Area (Entire section: &diams;)'),

	array('name' => 'First', 'id' => '_wii_hdr_widg_1', 'type' => 'hdr_widget',
		  'info' => '' ),
	array('name' => '<span style="color:red;">IMPORTANT!</span>', 'id' => 'wii_headern4', 'type' => '=note',
			'info' => 'You must specify a width for each widget you use in this area for proper layout on all browsers.'),

	array('name' => 'Second', 'id' => '_wii_hdr_widg_2', 'type' => 'hdr_widget',
		  'info' => '' ),
	array('name' => 'Third', 'id' => '_wii_hdr_widg_3', 'type' => 'hdr_widget',
		  'info' => '' ),
	array('name' => 'Fourth', 'id' => '_wii_hdr_widg_4', 'type' => 'hdr_widget',
		  'info' => '' ),

    array('name' => '<small>Disable Header Clipping</small>', 'id' => 'disable_header_clipping', 'type' => 'checkbox', //code
			'info' => 'This option allows menus and other content that overflows the header widget area to work properly. <em>Important!</em> Individual Widget BG colors will not fill the background of each widget equally when using this option.'),

	array('name' => '<span style="color:red;">Images in Header Widgets</span>', 'id' => 'wii_headern3', 'type' => '=note',
			'info' => 'The HTML model for the Header Widget Area has been changed beginning with Weaver II 2.0 to use &lt;div&gt;s instead of a table.
Images larger than a widget will have a max-size:100%; to fill the entire widget width.'),

	array('name' => 'Header Widget Padding:', 'id' => 'wii_headern2', 'type' => '=note',
			'info' => 'To add padding to a header widget, use widget\'s BG "CSS+" and add "{padding-left:5px;padding-right:5px;}" - adjust values as needed. If you specify a "padding-bottom" value, you also <strong>must</strong> specify "margin-bottom:0;" (or use "Disable Header Clipping"), but the individual widget BG colors will not fill the background of each widget equally. This is a technical limitation to the Header Widget Area implementation.'),

	// bg color, font size, min height, max-width; margins?, 1: bg, %, 2:bg, %, 3: bg, %, 4: bg, % bg-image?

	array('name' => 'Header Width', 'id' => 'a_hdr_advanced', 'type' =>'=subheader',
		  'info' => 'Control Width of Header Area'),
	array('name' => 'Make Header Area BG Wide', 'id' => 'wii_header_first', 'type' => '+checkbox', //code
			'info' => 'Make Header Area Background full screen width
			(or width specified below). <em>This applies to BG color only!</em> See next option below. (&#9679;Pro)'),
	array('name' => '<small>Wide Header Content</small>', 'id' => 'wii_header_first_content', 'type' => '+checkbox', //code
			'info' => 'Also make Header Content (Title, tagline, image, Header Insert Code) use full screen width.
			If not checked, then content will be constrained to Theme Width. (&#9679;Pro)'),
	array('name' => '<small>Wide Menus</small>', 'id' => 'wii_header_first_menus', 'type' => '+checkbox', //code
			'info' => 'Make menus wide. You can also use <em>Center Menu</em> on <em>Menus</em> tab in conjunction with this option. (&#9679;Pro)'),
	array('name' => 'Note:', 'id' => 'wii_headern0', 'type' => 'note',
			'info' => 'See Header Image section above for more options about sizing the header image.'),
	array('name' => '<small>Header Area Width</small>', 'id' => 'wii_header_area_width_int', 'type' => '+val_px',
			'info' => 'For wide header area, set the maximum width of the Header Area. If blank, full screen width used. Most effective if more than Theme Width. (&#9679;Pro)'),



	array('name' => 'Note:', 'id' => 'wii_headern1', 'type' => 'note',
			'info' => 'There are more Header options available on the Dashboard Appearance->Header panel.')
	);

?>
   <p>
Options for objects in the <strong>Header</strong>, including the <strong>Site Title and Site Tagline</strong>, the <strong>Header Image</strong>,
the <strong>Header Widget Area</strong> and its widgets, and some other advanced options.
   </p>
<?php
	weaverii_form_show_options($opts);
}

// ======================== Main Options > Menus ========================
function weaverii_mainopts_menus() {
	$opts = array(
	array( 'type' => 'submit'),
	array('name' => 'Menu Bar and Info Bar', 'id' => 'a_menubarinfobar', 'type' => 'header',
			'info' => 'Options affecting site Menus and the Info Bar',
			'help' => 'help.html#MenuBar'),
	array('name' =>'Menu Bar', 'id' => 'a_menubar', 'type'=>'subheader',
			'info' => 'Attributes of main menu bar (Primary, Secondary, and main extra menu)'),
	array('name' => 'Menu Bar BG', 'id' => 'wii_menubar_bgcolor', 'type' => 'ctext',
			'info' => 'The main menu bar background color'),
	array('name' => 'Menu Bar text', 'id' => 'wii_menubar_text_color', 'type' => 'ctext',
			'info' => 'Main menu bar text item when not hovering'),
	array('name' => 'Menu Bar hover BG', 'id' => 'wii_menubar_hover_bgcolor', 'type' => 'ctext',
			'info' => 'The menu item background when hovering over item.'),
	array('name' => 'Menu Bar hover text', 'id' => 'wii_menubar_hover_color', 'type' => 'ctext',
			'info' => 'Main menu bar text item when hovering'),
	array('name' => '<small>Bold Menu Text</small>', 'id' => 'wii_bold_menu', 'type' => 'checkbox',
			'info' => 'Use bold font style for menu text.'),
	array('name' => '<small>Italic Menu Text</small>', 'id' => 'wii_italic_menu', 'type' => 'checkbox',
			'info' => 'Use italic font style for menu text.'),

	array('name' =>'Sub-Menu Drop Downs','type'=>'subheader_alt',
			'info' => 'Attributes of menu drop downs'),
	array('name' => 'Sub-Menu Item BG', 'id' => 'wii_submenubar_bgcolor', 'type' => 'ctext',
			'info' => 'The sub-menu drop down items'),

	array('name' => 'Sub-Menu text', 'id' => 'wii_submenubar_text_color', 'type' => 'ctext',
			'info' => 'Sub-menu bar text item when not hovering'),
	array('name' => 'Sub-Menu hover BG', 'id' => 'wii_submenubar_hover_bgcolor', 'type' => 'ctext',
			'info' => 'The submenu drop down background when hovering over item.'),
	array('name' => 'Sub Menu text hover', 'id' => 'wii_submenubar_hover_color', 'type' => 'ctext',
			'info' => 'Sub-menu drop down text item when hovering'),
	array('name' => '<small>Bold Sub-Menu Text</small>', 'id' => 'wii_bold_submenu', 'type' => 'checkbox',
			'info' => 'Use bold font style for sub-menu text.'),
	array('name' => '<small>Italic Sub-Menu Text</small>', 'id' => 'wii_italic_submenu', 'type' => 'checkbox',
			'info' => 'Use italic font style for sub-menu text.'),

	array('name' =>'Current Page','type'=>'subheader_alt',
			'info' => 'Attributes of menu text when indicating current page and its ancestors'),
	array('name' => 'Current Page Text', 'id' => 'wii_menubar_curpage_color', 'type' => 'ctext',
			'info' => 'Color for the currently displayed page and its ancestors.'),
	array('name' => '<small>Bold Current Page</small>', 'id' => 'wii_menubar_curpage_bold', 'type' => 'checkbox',
			'info' => 'Bold Face Current Page and ancestors'),
	array('name' => '<small>Italic Current Page</small>', 'id' => 'wii_menubar_curpage_em', 'type' => 'checkbox',
			'info' => 'Italic Current Page and ancestors'),
	array('name' => '<small>Do Not Highlight Ancestors</small>', 'id' => 'menubar_curpage_noancestors', 'type' => '=checkbox',
			'info' => 'Highlight Current Page only - do not also highlight ancestor items'),

	array( 'type' => 'submit'),

	array('name' => 'Mobile', 'type' => '=subheader_alt',
			'info' => 'Options for Mobile Menus'),
	array('name' => '#070<small>Hide Menu Extras</small>', 'id' => 'wii_mobile_hide_menu_extras', 'type' => '=checkbox',
			'info' => "Hide menu extras on the Slide Open Mobile Menu - html right, social buttons, search, and login."),
	array('name' => '#070<small>Threshold for Slide Open Menu</small>', 'id' =>'wii_mobile_slide_threshold' , 'type' => 'val_px',
		  'info' => 'Threshold width for switching to Slide Open Menu. Suggested values: Never: 0 - Phones: 580, Small Tablets: 640, Tablets (portrait): 768, All: 5000. (Default: 640)'),
	array('name' => '#070<small>Text for Home label</small>', 'id' =>'wii_mobile_slide_home_label' , 'type' => '=widetext',
		  'info' => 'This lets you change the Home label on the phone slide open menu bar. (Default: Home)'),
	array('name' => '#070<small>Text for Primary Menu label</small>', 'id' =>'wii_mobile_slide_nav_label' , 'type' => '=widetext',
		  'info' => 'This lets you change the Menu label on the phone slide open Primary menu bar. (Default: Menu)'),
	array('name' => '#070<small>Text for Secondary Menu label</small>', 'id' =>'wii_mobile_slide_nav_label_sec' , 'type' => '=widetext',
		  'info' => 'This lets you change the Menu label on the phone slide open secondary menu bar. (Default: Menu)'),
    array('name' => '#070<small>Use &#9776; for Menu Labels</small>', 'id' => 'mobile_menu_icon', 'type' => '=checkbox',
		'info' => "Use the &#9776; menu icon for top and bottom mobile menus instead of 'Menu'."),
	array('name' => '#070<small>Hide Secondary Menu Bar for &#9688;Smart Modes Mobile</small>', 'id' => 'wii_mobile_hide_secondary_menu', 'type' => '=checkbox',
			'info' => "Hide just the secondary menu on mobile <em>phone</em> view."),
	array('name' => '#070<small>Hide Menu Bars - Desktop</small>', 'id' => 'wii_hide_menu_bar', 'type' => '=checkbox',
			'info' => "Hides default primary and secondary menu bars, but just on the desktop view. Still shows mobile slide open menu."),

	array('name' => 'Menu Bar Extras', 'type' => 'subheader_alt',
			'info' => 'Menu Bar enhancements and features'),

	array('name' => 'Menu Bar Gradient', 'id' => 'wii_gradient_menu', 'type' => 'checkbox',
			'info' => 'Add gradient effect to menu bars'),
	array('name' => 'Menu Bar Shadow', 'id' => 'wii_menu_shadow', 'type' => 'checkbox',
			'info' => 'Add a slight shadow to the Menu Bar. (Does\'t display on older IE versions.)'),
	array('name' => 'Use Menu Effects', 'id' => 'wii_use_superfish', 'type' => 'checkbox',
			'info' => 'Use Menu Effects: arrows for sub-menus, shadows, smooth open'),
	array('name' => weaverii_t_('<small>Arrow color</small>' /*a*/ ), 'id' => 'wii_superfish_arrows', 'type' => 'select_id',
		  'info' => weaverii_t_('Select color for arrow used with Menu Effects' /*a*/ ),
		  'value' => array(
						array('val' => 'ffffff', 'desc'=> 'White Arrows' ),
						array('val' => 'c0c0c0', 'desc'=> 'Light Gray Arrows' ),
						array('val' => '7f7f7f', 'desc' => 'Gray Arrows'),
						array('val' => '404040', 'desc'=> 'Dark Gray Arrows' ),
						array('val' => '000000', 'desc' => 'Black Arrows')
				)),

	array('name' => 'Add Search to Menu Bar', 'id' => 'wii_menu_addsearch', 'type' => 'checkbox',
			'info' => "Add a search box to Primary menu bar on right."),
	array('name' => 'Add Log in to Menu Bar', 'id' => 'wii_menu_addlogin', 'type' => '=checkbox',
			'info' => "Add a simple Log In link to Primary menu bar on right."),

	array('name' => '<small>Hide Menu Bars</small>', 'id' => 'wii_hide_menu', 'type' => '=checkbox',
			'info' => "Hides default primary and secondary menu bars, including mobile menu."),

	array('name' => '<small>No Home Menu Item</small>', 'id' => 'wii_menu_nohome', 'type' => '=checkbox',
			'info' => 'Don\'t automatically add Home menu item for home page (as defined in Settings->Reading)'),

	array('name' => 'Menu Bar Layout', 'type' => '=subheader_alt',
			'info' => 'Additional settings for menu bar look'),
		 array('name' => 'Center Menu', 'id' => 'wii_menu_center', 'type' => 'checkbox',
			'info' => "Center Primary and Secondary menus (non-mobile menus). IMPORTANT! Search/Login moved to left side. Does not work when not enough width available."),
	array('name' => '<small>Move Primary Menu to Right</small>', 'id' => 'wii_menu_right_primary', 'type' => 'checkbox',
			'info' => "Move Primary menu to right side (non-mobile; left for RTL)"),
	array('name' => '<small>Move Secondary Menu to Right</small>', 'id' => 'wii_menu_right_secondary', 'type' => 'checkbox',
			'info' => "Move Secondary menu to right side (non-mobile; left for RTL)"),

	array('name' => '<small>Move Primary Menu to Top</small>', 'id' => 'wii_move_menu', 'type' => 'checkbox',
			'info' => 'Move the Primary Menu to top of header area (Secondary Menu will then be on bottom if defined)'),
	array('name' => '<small>Move Top Menu outside #wrapper</small>', 'id' => 'wii_top_menu_before_wrapper', 'type' => '+checkbox',
			'info' => 'Move the top menu outside (right before) the #wrapper &lt;div&gt;. (Custom style using #nav-top-menu) (&#9679;Pro)'),
	array('name' => '<small>Move Top Menu next to header image</small>', 'id' => 'wii_top_menu_before_header', 'type' => '=checkbox',
			'info' => 'Move the top menu next to (right above) the header image/header insert code area/horizontal widget area.'),


	array('name' => 'Menu Bar Height', 'id' => 'wii_menu_height_int', 'type' => '+val_px',
			'info' => 'Height of Menu Bar. Non-default value won\'t work well with default gradient, but works okay with custom gradient on General Appearance tab. (Default: 38px) (&#9679;Pro)'),
	array ('name' => 'Menu Item Padding', 'id' =>'wii_menu_spacing_int', 'type' => '+val_px',
			'info' => 'Adjust padding between menu bar items. Determines separation of menu items. (Default: 10px) (&#9679;Pro)'),


	array('name' => '<small>Menu Left Padding (primary)</small>', 'id' => 'wii_menu_leftpad_int', 'type' => '+val_px',
			'info' => 'You can adjust the position of the primary menu items by adding left padding. (&#9679;Pro)'),
	array ('name' => '<small>Menu Left Padding (secondary)</small>','id' => 'wii_menu_leftpad2_int', 'type' => '+val_px',
			'info' => 'You can adjust the position of the secondary menu items by adding left padding (in px). (&#9679;Pro)'),

	array ('name' => 'Separator Bars on Menus', 'id' => 'wii_menubar_sep', 'type' => '+checkbox',
			'info' => 'Add vertical separator bars between items on menu bars. (&#9679;Pro)'),
	array ('name' => 'Separator Bars on Sub-Menus', 'id' => 'wii_submenu_bars', 'type' => '+checkbox',
			'info' => 'Add horizontal separator bars between items on sub-menu drop downs. (&#9679;Pro)'),
	array ('name' => 'Dotted Separator on Sub-Menus', 'id' => 'wii_submenu_dotted', 'type' => '+checkbox',
			'info' => 'Add horizontal dotted separator line on sub-menu drop downs. This and Separator bars don\'t mix. (&#9679;Pro)'),

	array ('name' => 'Separator Bar Width','id' => 'wii_separator_width_int','type' => '+val_px',
			'info' => 'Width of separator bars in px, if used. (Default: 2px) (&#9679;Pro)'),
	array ('name' => 'Fixed Width Menu Items', 'id' =>'wii_menu_liwidth', 'type' => '+val_px',
			'info' => 'Make each menu bar item fixed width in px. Should be wide enough for widest text item. (Default: not fixed, try more than 40px) (&#9679;Pro)'),

	array( 'type' => '=submit'),

	 array('name' => 'Add HTML to Menu Bar', 'type' => '=subheader_alt',
			'info' => 'Add HTML to the left or right end of the primary menu bar.'),
	array('name' => 'Control Vertical Position:', 'type' => '=note',
		  'info' => 'The added HTML can include images, links, text, and shortcodes. The maximum height for images is 24px. Add <em>style="top:10px"</em>
				to the &lt;img&gt; tag, and adjust the 10px value as needed. Wrap text in &lt;span class="add-text"&gt;text&lt;span&gt; for proper centering.'),
	array('name' => 'Add HTML to Left', 'id' => 'wii_menu_addhtml-left', 'type' => '=textarea',
		  'info' => 'Add HTML to left end of menu bar.'),
	array('name' => 'Add HTML to Right', 'id' => 'wii_menu_addhtml', 'type' => '=textarea',
		  'info' => 'Add HTML to right end of menu bar.'),


	array('name' => 'Info Bar', 'id'=>'a_infobar', 'type' => 'subheader',
		  'info' => 'Options for the top Info Bar'),
	array('name' => 'Hide Info Bar', 'id'=>'wii_infobar_hide', 'type' => 'checkbox',
		  'info' => 'Do not display the Info Bar'),
	array('name' => 'Hide Breadcrumbs', 'id'=>'wii_info_hide_breadcrumbs', 'type' => 'checkbox',
		  'info' => 'Do not display the Breadcrumbs'),
	array('name' => 'Hide Page Navigation', 'id'=>'wii_info_hide_pagenav', 'type' => 'checkbox',
		  'info' => 'Do not display the numbered Page navigation'),
	array('name' => 'Show Search box', 'id'=>'wii_info_search', 'type' => '=checkbox',
		  'info' => 'Include a Search box on the right'),
	array('name' => 'Show Log In', 'id'=>'wii_info_addlogin', 'type' => '=checkbox',
		  'info' => 'Include a simple Log In link on the right'),
	 array('name' => 'Info Bar Location', 'id' => 'wii_infobar_location', 'type' => 'select_id',
		  'info' => 'Info bar can be placed after the menu bar before sidebars and content, or right before content area',
		  'value' => array(
						array('val' => 'top', 'desc'=> 'After Menu Bar' ),
						array('val' => 'content', 'desc'=> 'Above Content Area' )
				)),
	array('name' => 'Breadcrumb for Blog', 'id' =>'wii_info_blog_label' , 'type' => '=widetext', //code - option done in code
		  'info' => 'This lets you change the breadcrumb label for your blog page. (Default: Blog)'),
	array('name' => 'Breadcrumb for Home', 'id' =>'wii_info_home_label' , 'type' => '=widetext', //code - option done in code
		  'info' => 'This lets you change the breadcrumb label for your home page. (Default: Home)'),

	array('name' => 'Add HTML', 'id'=>'', 'type' => '=subheader_alt',
		  'info' => 'Add HTML to Info Bar - can include shortcodes'),
	array('name' => 'Left HTML', 'id'=>'wii_info_html1', 'type' => '+textarea', //code
		  'info' => 'Add HTML code to left end of Info Bar (&#9679;Pro)'),
	array('name' => 'Middle HTML', 'id'=>'wii_info_html2', 'type' => '+textarea',       //code
		  'info' => 'Add HTML code to middle of Info Bar (&#9679;Pro)'),
	array('name' => 'Right HTML', 'id'=>'wii_info_html3', 'type' => '+textarea',        //code
		  'info' => 'Add HTML code to right end of Info Bar (&#9679;Pro)'),

	array('name' => 'Info Bar Attributes', 'id'=>'', 'type' => '=subheader_alt',
		  'info' => 'Additional Attributes for Info Bar'),
	array('name' => 'Background', 'id' => 'wii_infob_bgcolor', 'type' => '=ctext',
		  'info' => 'Background color for Info Bar'),
	array('name' => 'Text Color', 'id' => 'wii_infob_color', 'type' => '=ctext',
		  'info' => 'Text color for Info Bar'),
	array('name' => '<small>Top/Bottom Padding</small>', 'id' => 'wii_infob_padding', 'type' => '=text_tb',
		  'info' => 'Top and Bottom padding for Info Bar'),
	array('name' => '<small>Left/Right Padding</small>', 'id' => 'wii_infob_padding', 'type' => '=text_lr',
		  'info' => 'Left and Right padding for Info Bar'),
	);

?>
<p>
Options for the <strong>Menu Bar</strong> (colors, font style, Mobile menu, Search) and the <strong>Info Bar</strong>
(breadcrumbs, page navigation)
</p>
<?php
	weaverii_form_show_options($opts);
}

// ======================== Main Options > Links ========================
function weaverii_mainopts_links() {
	/* other links to consider:
	  .page-link a

	*/
	$opts = array(
	array( 'type' => 'submit'),
	array('name' => 'Links', 'id' => 'mainopts_links', 'type' => 'header',
		'info'=> 'Color attributes for links',
		'help' => 'help.html#Links'),

	array('name' => 'Standard Link', 'id' => 'wii_link', 'type' => 'link',
			'info' => 'Default for links - colors used if not overridden by other link settings. Bold, Italic, and Underline are set per link type.'),

	array('name' => 'Post Entry Title Link', 'id' => 'wii_plink', 'type' => 'link',
		  'info' => 'Post entry title link color (Use this color for Post title on blog pages. On single view, post title same as page title.)'),

	array('name' => 'Post Info Link', 'id' => 'wii_ilink', 'type' => 'link',
			'info' => 'Links in post information top and bottom lines.'),

	array('name' => 'Widget Link', 'id' => 'wii_wlink', 'type' => 'link',
			'info' => 'Color for links in widgets (uses Standard Link colors if left blank).'),

	array('name' => 'Info Bar Link', 'id' => 'wii_ibarlink', 'type' => 'link',
			'info' => 'Color for links in Info Bar (uses Standard Link colors if left blank).'),

	array('name' => 'Footer Link', 'id' => 'wii_footerlink', 'type' => 'link',
			'info' => 'Color for links in Footer (includes footer widgets; uses Standard Link colors if left blank).'),

	array('name' => 'Additional Option', 'type'=> '=header_alt',
		  'info' => 'Additional Options for Links'),
	array('name' => 'Hide Menu/Link Tool Tips', 'id' => 'wii_hide_tooltip', 'type' => '+checkbox',
		  'info' => 'Hide the tool tip pop up over all menus and links. (&#9679;Pro)')

	);
?>
<p>
	Attributes for <strong>Links</strong> used in various places: Standard Links, Post Entry Title, Post Info lines,
links in widgets, links in the Info Bar, and links in the Footer.
</p>
<?php

	weaverii_form_show_options($opts);
}

// ======================== Main Options > Content Areas ========================
function weaverii_mainopts_content() {
	$opts = array(
	array( 'type' => 'submit'),
	array('name' => 'Content Areas', 'id' => 'maintab2', 'type' => 'header',
		'info'=> 'Settings for the content areas (posts and pages)',
		'help' => 'help.html#ContentAreas'),

	array('name' => 'Text','type'=>'subheader_alt',
		  'info' => 'Text related options'),
	array('name' => 'Content BG', 'id' => 'wii_content_bgcolor', 'type' => 'ctext',
			'info' => 'Background for post and page #content div (uses main bg if not set).'),
	array('name' => '<small>Page/Post Editor BG</small>', 'id' => 'wii_editor_bgcolor', 'type' => '=ctext',
			'info' => 'Alternative Background Color to use for Page/Post editor if you\'re using transparent or image backgrounds.'),
	array('name' => '<small>Use BG Gradient</small>', 'id' => 'gradient_content', 'type' => '+checkbox',
			'info' => 'Add Weaver Background Gradient (as set on General Appearance tab) to content area (&#9679;Pro)'),
	array('name' => 'Content text', 'id' => 'wii_content_color', 'type' => 'ctext',
			'info' => 'Main post and page content text.'),
	array('name' => '<small>Page/Post Content Font size</small>', 'id' => 'wii_content_size_int', 'type' => 'val_percent',
		  'info' => 'Font size for Post and Page titles. (Default: 133% of Site Base Font Size)'),
	array('name' => 'Heading text', 'id' => 'wii_content_headings_color', 'type' => 'ctext',
			'info' => 'Content non-title headings and other labels'),
	array('name' => 'Page Title Text', 'id' => 'wii_page_title_color', 'type' => 'ctext',
			'info' => "Main Title for static and post single view pages (note: post title on blog page is 'Post Entry Title Link')"),
	array('name' => '<small>Page/Post Title Font size</small>', 'id' => 'wii_entrytitle_size_int', 'type' => 'val_percent',
		  'info' => 'Font size for Post and Page titles. (Default: 150%)'),

	array('name' => '<small>Bar under Titles</small>', 'id' => 'wii_header_underline_int', 'type' => 'val_px',
			'info' => 'Enter size in px if you want a bar under page and post Titles. Leave blank or 0 for no bar.'),
	array('name' => '<small>Input Area BG</small>', 'id' => 'wii_input_bgcolor', 'type' => 'ctext',
			'info' => 'Background color for text input (search, textareas, including ins, pre) boxes.'),
	array('name' => '<small>Input Area Text</small>', 'id' => 'wii_input_color', 'type' => 'ctext',
			'info' => 'Text color for text input (search, textareas) boxes.'),

	array('name' => 'Padding and Spacing', 'type'=>'=subheader_alt',
		  'info' => 'Padding around content area (adds extra space around edges). Spacing after elements.'),
	array('name' => 'Content Top/Bottom Padding', 'id' => 'wii_content_padding', 'type' => '=text_tb',
		  'info' => 'Top and Bottom padding for content area'),
	array('name' => 'Content Left/Right Padding', 'id' => 'wii_content_padding', 'type' => '=text_lr',
		  'info' => 'Left and Right padding for content area'),
	array('name' => '<small>Space between title and content</small>', 'id' => 'wii_content_top_dec', 'type' => '=val_em',
			'info' => 'Space in Page or Post title and beginning of content (Default: 1.625 em)'),
	array('name' => '<small>Space after paragraphs and lists</small>', 'id' => 'wii_content_p_list_dec', 'type' => '=val_em',
			'info' => 'Space after paragraphs and lists (Default: 1.5 em)'),


	array( 'type' => 'submit'),
	array('name' => 'Images', 'type'=>'subheader_alt',
		  'info' => 'Image related options'),
	array('name' => '<small>Image Border Color</small>', 'id' => 'wii_media_lib_border_color', 'type' => 'ctext',
			'info' => 'Border color for images.'),
	array('name' => '<small>Image Border Width</small>', 'id' => 'wii_media_lib_border_int', 'type' => 'val_px',
			'info' => 'Border width for images.'),
	array('name' => '<small>No Image Borders', 'id' => 'wii_hide_img_borders', 'type' => 'checkbox',
		  'info' => 'Do not use borders or shadows on images.'),
	array('name' => '<small>No Image Shadows', 'id' => 'wii_hide_img_shadows', 'type' => 'checkbox',
		  'info' => 'Do not use shadows on images. Borders retained if previous option not checked.'),
	array('name' => '<small>Caption text color</small>', 'id' => 'wii_caption_color', 'type' => 'ctext',
			'info' => 'Color of captions - e.g., below media images.'),

	array('name' => 'Featured Image', 'type'=>'subheader_alt',
		  'info' => 'Display of Page Featured Images'),
	array('name' => '<small>Hide Featured Image on Pages', 'id' => 'wii_hide_page_featured', 'type' => 'checkbox',
		  'info' => 'Hide any small Featured Image associated with a Page (Posts have their own setting.)'),
	array ('name' => 'Page Featured Image Size',
		   'id' => 'wii_fi_size_page', 'type' => 'select_id', 'info' => 'Image Size for Featured Image on pages.',
			'value' => array(
						   array('val' => 'thumbnail', 'desc' => 'Thumbnail (default)'),
						   array('val' => 'medium', 'desc' => 'Medium'),
						   array('val' => 'large', 'desc' => 'Large'))
		  ),
	array('name' => '<small>Featured Image Width, Pages</small>', 'id' => 'wii_featured_page_width', 'type' => '=val_px',
			'info' => 'Width of Featured Image when shown on pages. Height will remain proportional. Use 0 to hide.' ),
	array('name' => '<small>Featured Image Before Title, Pages</small>', 'id' => 'wii_fi_pre_page_title', 'type' => '+checkbox',
			'info' => 'Show Featured Image above page title. (&#9679;Pro)' ),

    array('name' => 'Video', 'type'=>'subheader_alt',
		  'info' => 'Video Options <strong>REQUIRES Weaver Theme Extras plugin</strong>'),
    array('name' => 'Use FitVids to size videos', 'id' => 'use_fitvids', 'type' => 'checkbox',
			'info' => 'Use Weaver II\'s version of FitVids to auto-size all videos responsively. This will <strong>NOT</strong> work unless the "Weaver II Theme Extras" plugin is active!' ),

	array('name' => 'Lists- &lt;HR&gt; - Tables', 'type'=>'subheader_alt',
		  'info' => 'Other options related to content'),
	array ('name' => 'Content List Bullet',
		   'id' => 'wii_contentlist_bullet', 'type' => 'select_id', 'info' => 'Bullet used for Unorderd Lists in Content areas',
			'value' => array(
						   array('val' => 'disc', 'desc' => 'Filled Disc (default)'),
						   array('val' => 'circle', 'desc' => 'Circle'),
						   array('val' => 'square', 'desc' => 'Square'),
						   array('val' => 'none', 'desc' => 'None'),
						   array('val' => 'custom', 'desc' => 'Custom bullet'))
		  ),
	array ('name' => '<small>Custom Bullet URL</small>', 'id' => 'wii_contentlist_bullet_custom_url', 'type' => '+textmedia', //code
		   'info' => 'URL for "Custom" bullet image (&#9679;Pro)'),

	array('name' => '&lt;HR&gt; color', 'id' => 'wii_hr_color', 'type' => 'ctext',
			'info' => 'Color of horizontal (&lt;hr&gt;) lines in posts and pages.'),

	array ('name' => 'Table Style', 'id' => 'wii_weaverii_tables', 'type' => 'select_id',
			'info' => 'Style used for tables in content.',
			'value' => array(
						   array('val' => 'default', 'desc' => 'Theme Default'),
						   array('val' => 'bold', 'desc' => 'Bold Headings'),
						   array('val' => 'noborders', 'desc' => 'No Borders'),
						   array('val' => 'fullwidth', 'desc' => 'Wide'),
						   array('val' => 'wide', 'desc' => 'Wide 2'),
						   array('val' => 'plain', 'desc' => 'Minimal'))
		  ),

	array('name' => 'Comments', 'type' => 'subheader',
		  'info' => 'Settings for displaying comments'),
	array('name' => 'Comment Headings', 'id' => 'wii_comment_headings_color', 'type' => 'ctext',
		  'info' => 'Color for various headings in comment form'),
	array('name' => 'Comment Content BG', 'id' => 'wii_comment_content_bgcolor', 'type' => 'ctext',
		  'info' => 'BG Color of Comment Content area'),
	array('name' => 'Comment Submit Button BG', 'id' => 'wii_comment_submit_bgcolor', 'type' => 'ctext',
		  'info' => 'BG Color of "Post Comment" submit button'),
	array('name' => '<small><em>Leave a Reply</em> Message</small>', 'id' => '_wii_comment_reply_msg', 'type' => '+widetext',
			'info' => 'Change default <em>Leave a Reply</em> message. Can include HTML (e.g., &lt;img>) (&#9679;Pro)'),
	array('name' => '<small>Show Allowed HTML</small>', 'id' => 'wii_form_allowed_tags', 'type' => '=checkbox',
		  'info' => 'Show the allowed HTML tags below comment input box'),
	array('name' => '<small>Hide Comment Title Icon</small>', 'id' => 'wii_hide_comment_bubble', 'type' => '=checkbox',
		  'info' => 'Hide the comment icon before the Comments title'),
	array('name' => '<small>Hide Separator Above Comments</small>', 'id' => 'wii_hide_comment_hr', 'type' => '=checkbox',
		  'info' => 'Hide the (&lt;hr&gt;) separator line above the Comments area'),
	array('name' => '<small>Hide Comment Borders</small>', 'id' => 'wii_hide_comment_borders', 'type' => '=checkbox',
		  'info' => 'Hide Borders around comment sections'),
	array('name' => '<small>Allow Comments on Page with Posts</small>', 'id' => 'wii_pwp_comments', 'type' => '=checkbox',
		  'info' => 'Allow "global" comments for Page with Posts pages - appear at bottom. (You still must enable comments for each Page with Posts.)')
	);

?>
   <p>
Options for <strong>Content Areas</strong>, including pages and posts. Includes options for <strong>Text</strong>,
<strong>Padding</strong>, <strong>Images</strong>, <strong>Lists &amp; Tables</strong>, and user <strong>Comments</strong>.
   </p>
<?php
	weaverii_form_show_options($opts);
?>
	<span style="color:green;"><b>Hiding/Enabling Page and Post Comments</b></span>
<?php
	weaverii_help_link('help.html#LeavingComments',weaverii_t_('Help for Leaving Comments' /*a*/ ));
?>
	<p>Controlling "Reply/Leave a Comment" visibility for pages and posts is <strong>not</strong> a theme function. It is
	controlled by WordPress settings. Please click the ? just above to see the help file entry!</p>
<?php
}

// ======================== Main Options > Post Specifics ========================
function weaverii_mainopts_posts() {
	$opts = array(
	array( 'type' => 'submit'),
	array('name' => 'Post Specifics', 'id' => 'maintab3', 'type' => 'header',
		'info'=> 'Settings affecting Posts',
		'help' => 'help.html#PPSpecifics'),

	array('name' => 'Post BG', 'id' => 'wii_post_bgcolor', 'type' => 'ctext',
			'info' => 'Background color used for posts.'),
	array('name' => '<small>Post Top/Bottom Padding</small>','id' => 'wii_post_padding', 'type' => '=text_tb',
		  'info' => 'Top and Bottom padding for Posts - most useful if bg color specified'),
	array('name' => '<small>Post Left/Right Padding</small>','id' => 'wii_post_padding', 'type' => '=text_lr',
		  'info' => 'Left and right padding for Posts - most useful if bg color specified'),
	array('name' => 'Sticky Post BG', 'id' => 'wii_stickypost_bgcolor', 'type' => 'ctext',
			'info' => 'BG color for sticky posts, author info. (Add {border:none;padding:0;} to CSS to make sticky posts same as regular posts.)'),
	array('name' => 'Columns of Posts', 'id' => 'wii_blog_cols', 'type' => 'select_id', //code
		  'info' => 'Display posts on blog page with this many columns. (You should adjust "Display posts on blog page with this many columns" on Settings:Reading to be a multiple of this value.)',
		  'value' => array(
						array('val' => '1', 'desc' => '1 Column'),
						array('val' => '2', 'desc' => '2 Columns'),
						array('val' => '3', 'desc' => '3 Columns'))
		  ),
	array('name' => 'First Post One Column', 'id' => 'wii_blog_first_one', 'type' => '=checkbox',
			'info' => 'Always display the first post in one column.'),
	array('name' => 'Sticky Posts One Column', 'id' => 'wii_blog_sticky_one', 'type' => '=checkbox',
			'info' => "Display opening Sticky Posts in one column. If First Post One Column also checked, then first non-sticky post will be one column."),
	array('name' => 'Use <em>Masonry</em> for Posts', 'id' => 'masonry_cols', 'type' => '+select_id',   //code
		  'info' => 'Use the <em>Masonry</em> blog layout option to show dynamically packed posts on blog and archive-like pages. Overrides "Columns of Posts" setting. (&#9679;Pro)',
		  'value' => array(
						array('val' => '0', 'desc' => ''),
						array('val' => '2', 'desc' => '2 Columns'),
						array('val' => '3', 'desc' => '3 Columns'),
						array('val' => '4', 'desc' => '4 Columns'),
						array('val' => '5', 'desc' => '5 Columns'))
		  ),
	array('name' => 'Photo Bloging', 'info' => 'Read the Help entry for information on creating a Photo Blog page',
		  'type' => '=note','help' => 'help.html#PhotoBlog'),

	array('name' => '"Post Format" for Posts', 'type' => 'subheader_alt',
		  'info' => 'Settings for posts with "Post Format" set (Image, Gallery, Status, etc.)'),

	array('name' => 'Compact "Post Format" Posts', 'id' => 'compact_post_formats', 'type' => '=checkbox',
			'info' => 'Use compact layout for posts with <em>Post Format</em> specified (Image, Gallery, Video, etc.). Useful for photo blogs and multi-column layouts. Looks great with <em>Masonry</em>.'),
	array('name' => 'Hide "Post Format" Pre-Title', 'id' => 'hide_post_format_title', 'type' => '=checkbox',
			'info' => 'Hide the Pre-Title for posts with Post Format specified.'),
	array('name' => '"Post Format" Pre-Title', 'id' => 'wii_post_format_color', 'type' => 'ctext',
			'info' => 'Color for the Post Format Title displayed on posts with Post Format specified.'),

	array('name' => 'Post Title Area', 'type' => 'subheader_alt',
		  'info' => 'Post title area options'),

	array('name'=>'Post Title:','type'=>'note',
		  'info'=>'Please use "Links:Post Entry Title Link" to set post title color for blog/archive view. On Single page, Post Title is
same color as Content Page Title Text.'),
	array('name' => 'Hide Comment Bubble', 'id' => 'wii_hide_post_bubble', 'type' => 'checkbox',
			'info' => "Hide the comment bubble displayed on the post info line"),
	array('name' => '<small>Show avatar with posts</small>', 'id' => 'wii_show_post_avatar', 'type' => '=checkbox',
			'info' => 'Show author avatar at top of posts (also can be set per post with post editor)'),
	array('name' => '<small>Make avatar tiny</small>', 'id' => 'wii_show_tiny_avatar', 'type' => '=checkbox',
			'info' => 'Make the avatar tiny and display right after author name. (Must check "Show avatar", too.)'),
	array('name' => '<small>Post Title - no link</small>', 'id' => 'wii_post_no_titlelink', 'type' => '+checkbox', //code
		  'info' => 'Don\'t make post titles a link. (&#9679;Pro)'),

	array('name' => 'Navigation', 'type' => 'subheader_alt',
		  'info' => 'Navigation for pages displaying posts'),
	array('name' => 'Blog Navigation Style', 'id' => 'wii_nav_style', 'type' => 'select_id',
		  'info' => 'Style of navigation links on blog pages: "Older/Newer posts", "Previous/Next Post", or by page numbers',
		  'value' => array(
						array('val' => 'old_new', 'desc' => 'Older/Newer'),
						array('val' => 'prev_next', 'desc' => 'Previous/Next'),
						array('val' => 'paged_left', 'desc' => 'Paged - Left'),
						array('val' => 'paged_right', 'desc' => 'Paged - Right'))
		  ),
	array('name' => '<small>Hide Top Links</small>', 'id' => 'wii_nav_hide_above', 'type' => '=checkbox',
		  'info' => 'Hide the blog navigation links at the top'),
	array('name' => '<small>Hide Bottom Links</small>', 'id' => 'wii_nav_hide_below', 'type' => '=checkbox',
		  'info' => 'Hide the blog navigation links at the bottom'),
	array('name' => '<small>Show Top on First Page</small>', 'id' => 'wii_nav_show_first', 'type' => '=checkbox',
		  'info' => 'Show navigation at top even on the first page'),

	array('name' => 'Single Page Navigation Style', 'id' => 'wii_single_nav_style', 'type' => 'select_id',
		  'info' => 'Style of navigation links on post Single pages: Previous/Next, by title, or none',
		  'value' => array(
						array('val' => 'title', 'desc' => 'Post Titles'),
						array('val' => 'prev_next', 'desc' => 'Previous/Next'),
						array('val' => 'hide', 'desc' => 'None - no display'))
		  ),
	array('name' => '<small>Link to Same Categories</small>', 'id' => 'wii_single_nav_link_cats', 'type' => '=checkbox',
		  'info' => 'Single Page navigation links point to posts with same categories.'),
	array('name' => '<small>Hide Top Links</small>', 'id' => 'wii_single_nav_hide_above', 'type' => '=checkbox',
		  'info' => 'Hide the single page navigation links at the top'),
	array('name' => '<small>Hide Bottom Links</small>', 'id' => 'wii_single_nav_hide_below', 'type' => '=checkbox',
		  'info' => 'Hide the single page navigation links at the bottom'),

	array( 'type' => '=submit'),
	array('name' => 'Post Meta Info Areas', 'type' => 'subheader_alt',
		  'info' => 'Top and Bottom Post Meta Information areas'),
	array('name' => 'Post Info text', 'id' => 'wii_info_color', 'type' => 'ctext',
			'info' => 'Color for post information text. (also called Meta Info)'),
	array('name' => 'Top Post Info BG', 'id' => 'wii_infotop_bgcolor', 'type' => 'ctext',
			'info' => "The top post info area ('Posted on x by y' line - add {display:none;} to CSS to hide entire line.)"),

	array('name' => 'Bottom Post Info BG', 'id' => 'wii_infobottom_bgcolor', 'type' => 'ctext',
			'info' => "The bottom post info area ('Posted in' line - add {display:none;} to CSS to hide entire line.)"),
	array('name' => '<small>Use Icons in Post Info</small>', 'id' => 'wii_post_icons', 'type' => 'checkbox',
			'info' => 'Use icons in Post Info (Meta Info)'),

	array('name' => '<small>Move Top Post Info to Bottom</small>', 'id' => 'wii_post_info_move_top', 'type' => '+checkbox',     //code
		  'info' => 'Move the top post info line to bottom of post. (&#9679;Pro)'),
	array('name' => '<small>Move Bottom Post Info to Top</small>', 'id' => 'wii_post_info_move_bottom', 'type' => '+checkbox',  //code
		  'info' => 'Move the bottom post info line to top of post. (&#9679;Pro)'),
	array('name' => '<small>Hide top post info</small>', 'id' => 'wii_post_info_hide_top', 'type' => '+checkbox',       //code
		  'info' => 'Hide entire top info line (posted on, by) of post. (&#9679;Pro)'),
	array('name' => '#070<small>Hide top post info on Mobile</small>', 'id' => 'wii_mobile_post_info_hide_top', 'type' => '+checkbox',
		  'info' => 'Hide entire top info line (posted on, by) of post when viewed on Mobile devices. (&#9679;Pro)'),
	array('name' => '<small>Hide bottom post info</small>', 'id' => 'wii_post_info_hide_bottom', 'type' => '+checkbox', //code
		  'info' => 'Hide entire bottom info line (posted in, comments) of post. (&#9679;Pro)'),
	array('name' => '#070<small>Hide bottom post info on Mobile</small>', 'id' => 'wii_mobile_post_info_hide_bottom', 'type' => '+checkbox', //CSS
		  'info' => 'Hide entire bottom info line (posted in, comments) of post when viewed on Mobile devices. (&#9679;Pro)'),

	array('name' => 'Note:', 'type' => '=note', 'info' => 'Hiding any meta info item automatically uses Icons instead of words'),
	array('name' => '<small>Hide Post Date</small>', 'id' => 'wii_post_hide_date', 'type' => '=checkbox',
			'info' => 'Hide the post date everywhere it is normally displayed.'),
	array('name' => '<small>Hide Post Author</small>', 'id' => 'wii_post_hide_author', 'type' => '=checkbox',
			'info' => 'Hide the post author everywhere it is normally displayed.'),
	array('name' => '<small>Hide Post Categories</small>', 'id' => 'wii_post_hide_cats', 'type' => '=checkbox',
			'info' => 'Hide the post categories and tags wherever they are normally displayed.'),
	array('name' => '<small>Hide Post Tags</small>', 'id' => 'wii_post_hide_tags', 'type' => '=checkbox',
			'info' => 'Hide the post tags wherever they are normally displayed.'),
	array('name' => '<small>Hide Permalink</small>', 'id' => 'wii_hide_permalink', 'type' => '=checkbox',
			'info' => 'Hide the permalink.'),
	array('name' => '<small>Hide Category if Only One</small>', 'id' => 'wii_hide_singleton_cat', 'type' => '=checkbox',
			'info' => 'If there is only one overall category defined (Uncategorized), don\'t show Category of post.'),
	array('name' => '<small>Hide Author for Single Author Site</small>', 'id' => 'wii_post_hide_single_author', 'type' => '=checkbox',
			'info' => 'Hide author information if site has only a single author.'),

	array('name' => 'Custom Info Lines', 'type' => '=subheader_alt',
		  'info' => 'Replace Info Lines with custom info line templates. Advanced options: see help file', 'help' => 'help.html#CustomInfo'),
	array('name' => '<small>Top Post Info Line<small>', 'id' => '_wvr_custom_posted_on', 'type' => '+textarea',
		  'info' => 'Custom template for top post info line. See help file! (&#9679;Pro) &diams;'),
	array('name' => '<small>Bottom Post Info Line<small>', 'id' => '_wvr_custom_posted_in', 'type' => '+textarea',
		  'info' => 'Custom template for bottom post info line. (&#9679;Pro) &diams;'),
	array('name' => '<small>Top Post Info Line (Single)<small>', 'id' => '_wvr_custom_posted_on_single', 'type' => '+textarea',
		  'info' => 'Custom template for top post info line on single pages. (&#9679;Pro) &diams;'),
	array('name' => '<small>Bottom Post Info Line (Single)<small>', 'id' => '_wvr_custom_posted_in_single', 'type' => '+textarea',
		  'info' => 'Custom template for bottom post info line on single pages. (&#9679;Pro) &diams;'),


	array( 'type' => 'submit'),
	array('name' => 'Excerpts', 'type' => 'subheader_alt',
		  'info' => 'All about displaying excerpts'),
	array('name' => 'Excerpt Blog Posts', 'id' => 'wii_excerpt_blog', 'type' => 'checkbox',
			'info' => 'Will display excerpts instead of full posts on <em>blog pages</em>. Useful when used with Featured Image.'),
	array('name' => '<small>Full Post for Archives</small>', 'id' => 'wii_fullpost_archive', 'type' => '=checkbox',
			'info' => 'Display the full posts instead of excerpts on <em>special post pages</em>. (Archives, Categories, etc.) Does not override manually added &lt;--more--> breaks.'),
	array('name' => '<small>Full Post for Searches</small>', 'id' => 'wii_fullpost_search', 'type' => '=checkbox',
			'info' => 'Display the full posts instead of excerpts for Search results. Does not override manually added &lt;--more--> breaks.'),
	array('name' => '<small>Full text for 1st <em>"n"</em> Posts</small>', 'id' => 'wii_fullpost_first', 'type' => '+val_num',
			'info' => 'Display the full post for the first "n" posts on Blog pages. Does not override manually added &lt;--more--> breaks.'),
	array('name' => '<small>Excerpt length</small>', 'id' => 'wii_excerpt_length', 'type' => '=val_num',
			'info' => 'Change post excerpt length. (Default: 40 words)'),
	array('name' => '<small><em>Continue reading</em> Message</small>', 'id' => 'wii_excerpt_more_msg', 'type' => '=widetext',
			'info' => 'Change default <em>Continue reading &rarr;</em> message for excerpts. Can include HTML (e.g., &lt;img>).'),

	array('name' => 'Featured Images', 'type' => 'subheader_alt',
		  'info' => 'Display of Post Featured Images'),
	array('name' => '<small>Show Featured Image for full posts</small>', 'id' => 'wii_show_featured_image_fullposts', 'type' => 'checkbox',
			'info' => 'Show the "Featured Image" (set on Post edit page) with full post displays'),
	array('name' => '<small>Show Featured Image for excerpts</small>', 'id' => 'wii_show_featured_image_excerptedposts', 'type' => 'checkbox',
			'info' => 'Show the "Featured Image" (set on Post edit page) with excerpted post displays'),
	array ('name' => '<small>Post Featured Image Size, Blog</small>',
		   'id' => 'wii_fi_size_post', 'type' => 'select_id', 'info' => 'Image Size for Featured Image post displayed on blog pages.',
			'value' => array(
						array('val' => 'thumbnail', 'desc' => 'Thumbnail (default)'),
						array('val' => 'medium', 'desc' => 'Medium'),
						array('val' => 'large', 'desc' => 'Large'))
		  ),
	array('name' => '<small>Featured Image Width, Blog</small>', 'id' => 'wii_featured_blog_width', 'type' => '=val_px',
			'info' => 'Alternate option: Width of Featured Image when shown on Blog pages. Height will remain proportional. Use 0 to hide.' ),
	array('name' => '<small>Always Show Featured Image on Blog</small>', 'id' => 'wii_show_featured_image_for_blog', 'type' => 'checkbox',
			'info' => 'Always show the "Featured Image" for blog views of post (including if header image sized)'),
	array('name' => '<small>Featured Image Before Title, Post</small>', 'id' => 'wii_fi_pre_post_title', 'type' => '+checkbox',
			'info' => 'Show Featured Image above post title. (&#9679;Pro)' ),

	array ('name' => '<small>Post Featured Image Size, Single</small>',
		   'id' => 'wii_fi_size_post_single', 'type' => 'select_id', 'info' => 'Image Size for Featured Image posts displayed on Single pages.',
			'value' => array(
						array('val' => 'medium', 'desc' => 'Medium (default)'),
						array('val' => 'large', 'desc' => 'Large'),
						array('val' => 'thumbnail', 'desc' => 'Thumbnail'))
		  ),
	array('name' => '<small>Featured Image Width, Single</small>', 'id' => 'wii_featured_single_width', 'type' => '=val_px',
			'info' => 'Alternate option: Width of Featured Image when shown on Single post page. Height will remain proportional. Use 0 to hide.'),
	array('name' => '<small>Featured Image Before Title, Single</small>', 'id' => 'wii_fi_pre_single_title', 'type' => '+checkbox',
			'info' => 'Show Featured Image above post title on single page view. (&#9679;Pro)' ),



	array('name' => 'Other Post Related Options', 'type' => '=subheader_alt',
		  'info' => 'Other options related to post display, including single pages'),
	array('name' => '<small>Show <em>Comments are closed.</em></small>', 'id' => 'wii_show_comments_closed', 'type' => '=checkbox',
			'info' => 'If comments are off, and no comments have been made, show the <em>Comments are closed.</em> message.' ),
    array('name' => 'Author Info BG', 'id' => 'wii_post_author_bgcolor', 'type' => 'ctext',
			'info' => 'Background color used for Author Bio.'),
	array('name' => '<small>Hide Author Bio</small>', 'id' => 'wii_hide_author_bio', 'type' => '=checkbox',
			'info' => 'Hide display of author bio box on single post page view'),
	array('name' => '<small>Allow comments for attachments</small>', 'id' => 'wii_allow_attachment_comments', 'type' => '=checkbox',
			'info' => 'Allow visitors to leave comments for attachments (usually full size media image - only if comments allowed).')
	);

?>
   <p>
Options related to <strong>Posts</strong>, including <strong>Background</strong> color, <strong>Columns</strong> displayed
on blog pages, <strong>Title</strong> options, <strong>Navigation</strong> to earlier and later posts, the post <strong>
Info Lines</strong>, <strong>Excerpts</strong>, and <strong>Featured Image</strong> handling.
   </p>
<?php
	weaverii_form_show_options($opts);
?>
	<span style="color:green;"><b>Hiding/Enabling Page and Post Comments</b></span>
<?php
	weaverii_help_link('help.html#LeavingComments',weaverii_t_('Help for Leaving Comments' /*a*/ ));
?>
	<p>Controlling "Reply/Leave a Comment" visibility for pages and posts is <strong>not</strong> a theme function. It is
	controlled by WordPress settings. Please click the ? just above to see the help file entry! (Additional options for comment
	<em>styling</em> are found on the Content Areas tab.)</p>
<?php
}


// ======================== Main Options > Footer ========================
function weaverii_mainopts_footer() {
	$opts = array(
	array( 'type' => 'submit'),
	array('name' => 'Footer Options', 'id' => 'maintab4', 'type' => 'header',
		'info'=> 'Settings for the footer',
		'help' => 'help.html#FooterOpt'),

	array('name' => 'Footer BG', 'id' => 'wii_footer_bgcolor', 'type' => 'ctext',
			'info' => 'Background for the footer area.'),
	array('name' => 'Footer Text', 'id' => 'wii_footer_color', 'type' => 'ctext',
			'info' => 'Footer Text Color (use Widget Areas->Widget Area Text if needed for widget text color)'),
	array('name' => '<small>Footer Font size</small>', 'id' => 'wii_footer_size_int', 'type' => 'val_percent',
		  'info' => 'Font size for footer. (Default: 150%)'),
	array('name' => 'Footer Border', 'id' => 'wii_footer_border_color', 'type' => 'ctext',
			'info' => 'Color of the border above the footer area.'),
	array('name' => 'Footer Border', 'id' => 'wii_footer_border_int', 'type' => 'val_px',
			'info' => 'Height of footer border (Default: 4px)'),
	array('name' => '<small>Use BG Gradient</small>', 'id' => 'gradient_footer', 'type' => '+checkbox',
			'info' => 'Add Weaver Background Gradient (as set on General Appearance tab) to footer area (&#9679;Pro)'),
	array('name' => '<small>Hide Entire Footer</small>', 'id' => 'wii_hide_footer', 'type' => '=checkbox',
			'info' => 'Hide the entire footer area.'),
	array('name' => '<small>Hide "final" area</small>', 'id' => 'wii_hide_final', 'type' => '=checkbox',
			'info' => 'Hide the display (but NOT functionality) of script and plugin messages at the very bottom of your site.'),

	array('name' => 'Footer Width', 'type' =>'=subheader', 'info' => 'Control width of footer area'),
	array('name' => 'Wide Footer Area BG', 'id' => 'wii_footer_last', 'type' => '+checkbox',    //code
			'info' => 'Make Footer Area Background full screen width
			(or width specified below). (&#9679;Pro)'),
	array('name' => '<small>Wide Footer Content</small>', 'id' => 'wii_footer_wide_content', 'type' => '+checkbox', //code
			'info' => 'Also make Footer Content (Widget Areas, Footer Insert Code, Copyright/Powered By) use full screen width.
			If not checked, then content will be constrained to Theme Width. (&#9679;Pro)'),

	array('name' => '<small>Footer Width</small>', 'id' => 'wii_footer_width_int', 'type' => '+val_px',
			'info' => 'For wide footer area, set the maximum width of the Footer Area. Can be less than theme width. If blank, full screen width used. (&#9679;Pro)'),


		array('name' => 'Note:', 'id' => 'wii_footer_note', 'type' => 'note',
			'info' => 'The footer area supports up to 4 widget areas. These auto-adjust their widths.'),
	);

?>
<p>
	Options affecting the <strong>Footer</strong> area, including <strong>Background</strong> color, <strong>Borders</strong>,
	and the <strong>Copyright</strong> message.
</p>
<?php
	weaverii_form_show_options($opts);
	if (! weaverii_hide_advanced_optval('_wii_copyright')) {
?>
		   <span style="color:blue;"><b>Site Copyright</b></span><br/>
		<small>If you fill this in, the default copyright notice in the footer will be replaced with the text here. It will not
		automatically update from year to year.<br /> Use &amp;copy; to display &copy;. You can use other HTML as well.
		Use <span class="style4">&amp;nbsp;</span> to hide the copyright notice. &diams;</small>
		<br />

		<textarea name="<?php weaverii_sapi_main_name('_wii_copyright'); ?>" rows=1 style="width:750px;"><?php echo(esc_textarea(weaverii_getopt('_wii_copyright'))); ?></textarea>
<?php
	}
	if (! weaverii_hide_advanced_optval('_wii_hide_poweredby')) {
?>
		<br>
		<label>Hide Powered By tag: <input type="checkbox" name="<?php weaverii_sapi_main_name('_wii_hide_poweredby'); ?>" id="_wii_hide_poweredby" <?php checked(weaverii_getopt_checked( '_wii_hide_poweredby' )); ?> /></label>
				<small>Check this to hide the "Proudly powered by" notice in the footer.</small>
		<br /><br />
		You can add other content to the Footer from the Advanced Options:HTML Insertion tab.
<?php
	}
}

// ======================== Main Options > Widget Areas ========================
function weaverii_mainopts_widgets() {
	$opts = array(
	array( 'type' => 'submit'),
	array('name' => 'Widget Areas', 'id' => 'maintab5', 'type' => 'header',
			'info'=> 'Settings affecting widget areas',
			'help' => 'help.html#WidgetAreas'),

	array('name' => 'Individual Widgets', 'id' => 'wii_widget_widget', 'type' => 'widget_area',
			'info' => 'Properties for individual widgets (e.g., Text, Recent Posts, etc.)'),
	array('name' => 'Widget Padding', 'id'=> 'wii_widget_widget_padding_int', 'type'=>'=val_px',
		  'info' => 'Padding used around all sides of individual widgets. Not usually needed unless widgets have bg color.'),
	array('name' => 'Widget Title', 'id' => 'wii_widget_title_color', 'type' => 'ctext',
			'info' => 'Color for Widget titles and labels.'),
	array('name' => 'Bar under Widget Titles', 'id' => 'wii_widget_header_underline_int', 'type' => 'val_px',
			'info' => 'Enter size in px if you want a bar under Widget Titles. Leave blank or 0 for no bar.'),
	array('name' => 'Widget Area Text', 'id' => 'wii_widget_color', 'type' => 'ctext',
			'info' => 'Color for widget area content (text color).'),
	array('name' => '<small>Widget Area Font size</small>', 'id' => 'wii_widget_size_int', 'type' => 'val_percent',
		  'info' => 'Font size for widgets. (Default: 120%)'),
	array ('name' => 'Widget List Bullet',
		   'id' => 'wii_widgetlist_bullet', 'type' => '=select_id', 'info' => 'Bullet used for Unorderd Lists in Widget areas',
			'value' => array(
						array('val' => 'disc', 'desc' => 'Filled Disc (default)'),
						array('val' => 'circle', 'desc' => 'Circle'),
						array('val' => 'square', 'desc' => 'Square'),
						array('val' => 'none', 'desc' => 'None'),
						array('val' => 'custom', 'desc' => 'Custom bullet'))
		  ),
	array ('name' => '<small>Custom Bullet URL</small>', 'id' => 'wii_widgetlist_bullet_custom_url', 'type' => '+textmedia',    //code
		   'info' => 'URL for "Custom" bullet image (&#9679;Pro)'),
	array( 'type' => 'submit'),

	array('name' => 'Sidebar Widths:', 'type'=>'note', 'info'=>'Widths of Sidebars set under Layout tab.'),
	array('name' => 'Primary Widget Area', 'id' => 'wii_widget_primary', 'type' => 'widget_area',
			'info' => 'Properties for the Primary Sidebar Widget Area. (Applies to Mobile Widget area also.)'),

	array('name' => 'Upper/Right Widget Area', 'id' => 'wii_widget_right', 'type' => 'widget_area',
			'info' => 'Properties for the Upper/Right Sidebar Widget Area.'),

	array('name' => 'Lower/Left Widget Area', 'id' => 'wii_widget_left', 'type' => 'widget_area',
			'info' => 'Properties for the Lower/Left Sidebar Widget Area.'),
	array('name' => 'Primary, Right, Left Margins', 'type' => 'subheader_alt',
		 'info' => 'Left and Right margins for Primary, Upper/Right, and Lower/Left Widget areas'),
	array('name' => 'Left/Right Margins', 'id' => 'wii_sidbar_widget_margins', 'type' => 'text_lr',
		  'info' => 'Left and right margins for the sidebar widget areas.'),

	array('name' => 'Top Widget Areas', 'id' => 'wii_widget_top', 'type' => 'widget_area',
			'info' => 'Properties for all Top Widget areas (Sitewide, Pages, Blog, Archive).'),
	array('name' => 'Left/Right indent', 'id' => 'wii_widget_top_indent_int', 'type' => 'val_percent',
			'info' => 'Top Widget Areas: Set the left and right indents - centers widget area in content area'),

	array('name' => 'Bottom Widget Areas', 'id' => 'wii_widget_bottom', 'type' => 'widget_area',
			'info' => 'Properties for all Bottom Widget areas (Sitewide, Pages, Blog, Archive).'),
	array('name' => 'Left/Right indent', 'id' => 'wii_widget_bottom_indent_int', 'type' => 'val_percent',
			'info' => 'Bottom Widget Areas: Set the left and right indents - centers widget area in content area'),

	array('name' => 'Footer Widget Areas', 'id' => 'wii_widget_footer', 'type' => 'widget_area',
			'info' => 'Properties for all Footer Widget areas.'),

	array('name' => 'All Widget Areas','type' => 'subheader_alt',
		  'info' => 'Properties that apply to all widget areas.'),
	array('name' => 'Widget Area Padding', 'id'=>'wii_widget_padding_int', 'type'=>'val_px',
		  'info' => 'Padding used around all sides of widget areas.'),

	);
?>
<p>
Options affecting <strong>Widget Areas</strong>. This includes properties of <strong>Widgets</strong>, as well as
properties of various <strong>Widget Areas</strong>. This is also where you can define new
<strong>Per Page Widget Areas</strong>.
</p>
<?php
	weaverii_form_show_options($opts);
?>
<span style="color:blue;"><b>Define Per Page Widget Areas</b></span>
<?php
	weaverii_help_link('help.html#PPWidgets',weaverii_t_('Help for Per Page Widget Areas' /*a*/ ));
?>
	<br/>
	<small>You may define extra widget areas that can then be used in the <em>Per Page</em> settings. Enter
	a list of one or more widget area names separated by commas. Your names should include only letters, numbers, or underscores -
	no spaces or other special characters. The widgets areas will then appear on the Appearance->Widgets menus. They can be included
	on individual pages by adding the name you define here to the "Weaver II Options For This Page" box on the Edit Page screen.</small>
	<br />
	<textarea name="<?php weaverii_sapi_main_name('wii_perpagewidgets'); ?>" rows=1 style="width: 95%"><?php echo(esc_textarea(weaverii_getopt('wii_perpagewidgets'))); ?></textarea>
	<br />
	<small>These extra widget areas are also used by the Weaver II Pro Widget Area shortcode.</small>
<?php
?>

<p style="color:green;"><strong>Note: Specify the layout of sidebar widget areas on the Layout tab.
</strong></p>
<?php
}

// ======================== Main Options > Fonts ========================
function weaverii_mainopts_fonts() {
	$opts = array(
	array( 'type' => 'submit'),
	array('name' => 'Fonts', 'id' => 'mainopts_fonts', 'type' => 'header',
		'info'=> 'Fonts',
		'help' => 'help.html#Fonts'),
	array ('name' => 'Content Font',
		'id' => 'wii_content_font', 'type' => 'selectold',
		'info' => 'Font used for most content and widget text (Default: "Times New Roman", Times, serif;)',
		'value' => array( '',
		'"Helvetica Neue", Helvetica, sans-serif', 'Arial,Helvetica,sans-serif', 'Verdana,Arial,sans-serif',
		'Tahoma, Arial,sans-serif', '"Arial Black",Arial,sans-serif', '"Avant Garde",Arial,sans-serif', '"Comic Sans MS",Arial,sans-serif',
		'Impact,Arial,sans-serif', '"Trebuchet MS", Helvetica, sans-serif', '"Century Gothic",Arial,sans-serif', '"Lucida Grande",Arial,sans-serif',
		'Univers,Arial,sans-serif', '"Times New Roman",Times,serif', '"Bitstream Charter",Times,serif', 'Georgia,Times,serif',
		'Palatino,Times,serif', 'Bookman,Times,serif', 'Garamond,Times,serif', '"Courier New",Courier', '"Andale Mono",Courier'
		 )),
	array ('name' => 'Titles Font', 'id' => 'wii_title_font', 'type' => 'selectold',
		'info' => 'Font used for post, page, and widget titles, info labels, and menus. (Default: "Helvetica Neue", Helvetica, Arial, sans-serif;)',
		'value' => array('',
		'"Helvetica Neue", Helvetica, sans-serif', 'Arial,Helvetica,sans-serif', 'Verdana,Arial,sans-serif',
		'Tahoma, Arial,sans-serif', '"Arial Black",Arial,sans-serif', '"Avant Garde",Arial,sans-serif', '"Comic Sans MS",Arial,sans-serif',
		'Impact,Arial,sans-serif', '"Trebuchet MS", Helvetica, sans-serif', '"Century Gothic",Arial,sans-serif', '"Lucida Grande",Arial,sans-serif',
		'Univers,Arial,sans-serif', '"Times New Roman",Times,serif', '"Bitstream Charter",Times,serif', 'Georgia,Times,serif',
		'Palatino,Times,serif', 'Bookman,Times,serif', 'Garamond,Times,serif', '"Courier New",Courier', '"Andale Mono",Courier'
		)),

	array('name' => 'Site Base Font Size', 'id' => 'wii_site_fontsize_int', 'type' => 'val_px',
		  'info' => 'Set the Base Font size. All other font sizes are calculated as a percentage of this size. (Default: 12px)'),
	array('name' => 'Site Base Line Height', 'id' => 'wii_site_line_height_dec', 'type' => 'text',
		  'info' => 'Set the Base line-height. Most other line heights based on this multiplier. (Default: 1.5 - no units)'),
	array('name' => '#080Site Base Font Size - Mobile', 'id' => 'wii_site_fontsize_mobile_int', 'type' => 'val_px',
		  'info' => 'Set the Base Font size for Mobile Devices. (Default: 12px)')
	);
?>
<p>
	Define <strong>Fonts</strong> for Content and Titles, as well as base Font Size and Line Spacing. Pro Version supports
	setting fonts for specific objects, as well as using <strong>Google Fonts</strong>.
</p>
<?php

	weaverii_form_show_options($opts);

	if (weaverii_init_base())
		weaverii_fonts_pro_admin();
	else {
?>
<h3>Weaver II Pro Font Control</h3>
<p>The Weaver II Pro Font Control panel gives you fine tuned control over the fonts various elements of your site will use.
	You can use a set of standard Web fonts, or for total flexibility, you can use <em>any</em> of the free
	<?php weaverii_site('/webfonts', 'http://www.google.com'); ?><strong>Google Web Fonts</strong></a>. In addition to the
	two general areas available in the basic Weaver II version, the Pro version lets you set the font of virtually every
	text element on your site. You can also specify font size, style, and other attributes.
	<p>
<?php
	}
}

// ======================== Main Options > Layout ========================
function weaverii_mainopts_layout() {
	$opts = array(
	array( 'type' => 'submit'),
	array('name' => 'Layout', 'id' => 'mainopts_layout', 'type' => 'header',
		'info'=> 'Settings for site layout: theme width and margins, sidebar layout, bg color flow',
		'help' => 'help.html#layout'),
	array( 'name' => 'Theme Width', 'id' => 'wii_theme_width_int', 'type' => 'val_px',
			'info' => 'Change Theme Width. Standard size is 940px. Header Image width is automatically changed, too. Does not include wrapper padding. Widths less than 650px will give unexpected results on mobile devices. (Uses CSS "max-width" to set width, which gives "flexible width" shrinking for displays smaller than the width specified.)'),
	array('name' => '<small>Theme Width Fixed</small>', 'id' => 'wii_theme_width_fixed', 'type' => '=checkbox',
			'info' => 'Force the theme width to be fixed (use CSS "width" instead of "max-width"). Using this option is not recommended. This setting will also "break" the Mobile View, so you should disable Mobile Support as well.'),
	array('name' => 'Theme Margins: Top/Bottom', 'id' => 'wii_site_margins', 'type' => 'text_tb',
			'info' => 'Top and bottom margins around whole site. (Default: 20px)'),
	array('name' => 'Theme Margins: Left/Right', 'id' => 'wii_site_margins', 'type' => 'text_lr',
			'info' => 'Left and right margins around whole site. (Default: 20px)'),
	array('name' => 'Wrapper Padding', 'id' => 'wii_wrapper_padding', 'type' => 'val_px',
			'info' => 'Wrapper Padding - space between wrapper edges and header, content, sidebars, footer. (Default: 10px)'),


	array('name' => 'Sidebar Layout', 'type' => 'subheader', 'info' => 'Sidebar Layout for each type of page'),
	array('name' => weaverii_t_('Blog, Post, Page Default' /*a*/ ), 'id' => 'wii_layout_default', 'type' => 'select_id',
		  'info' => weaverii_t_('Select the default theme layout for blog, single post, and pages.' /*a*/ ),
		  'value' => array(
						array('val' => 'right-1-col', 'desc'=> 'Single column sidebar on Right' ),
						array('val' => 'left-1-col', 'desc' => 'Single column sidebar on Left'),
						array('val' => 'right-2-col', 'desc' => 'Double Cols, Right (top wide)'),
						array('val' => 'left-2-col', 'desc' => 'Double Cols, Left (top wide)'),
						array('val' => 'right-2-col-bottom', 'desc' => 'Double Cols, Right (bottom wide)'),
						array('val' => 'left-2-col-bottom', 'desc' => 'Double Cols, Left (bottom wide)'),
						array('val' => 'split', 'desc' => 'Split - sidebars on Right and Left'),
						array('val' => 'one-column', 'desc' => 'No sidebars, one column content')
				)),

	array('name' => weaverii_t_('Archive-like Default' /*a*/ ), 'id' => 'wii_layout_default_archive', 'type' => 'select_id',
		  'info' => weaverii_t_('Select the default theme layout for all other pages - archives, search, etc.' /*a*/ ),
		  'value' => array(
						array('val' => 'one-column', 'desc' => 'No sidebars, one column content'),
						array('val' => 'right-1-col', 'desc'=> 'Single column sidebar on Right' ),
						array('val' => 'left-1-col', 'desc' => 'Single column sidebar on Left'),
						array('val' => 'right-2-col', 'desc' => 'Double Cols, Right (top wide)'),
						array('val' => 'left-2-col', 'desc' => 'Double Cols, Left (top wide)'),
						array('val' => 'right-2-col-bottom', 'desc' => 'Double Cols, Right (bottom wide)'),
						array('val' => 'left-2-col-bottom', 'desc' => 'Double Cols, Left (bottom wide)'),
						array('val' => 'split', 'desc' => 'Split - sidebars on Right and Left')
				)),

	array('name' => weaverii_t_('<small>Page</small>' /*a*/ ), 'id' => 'wii_layout_page', 'type' => 'select_layout',
		  'info' => weaverii_t_('Layout for normal Pages on your site.' /*a*/ ),
		  'value' => ''
		  ),
	array('name' => weaverii_t_('<small>Blog</small>' /*a*/ ), 'id' => 'wii_layout_blog', 'type' => 'select_layout',
		  'info' => weaverii_t_('Layout for main blog page. Includes "Page with Posts" Page templates.' /*a*/ ),
		  'value' => ''
		  ),
	array('name' => weaverii_t_('<small>Post Single Page</small>' /*a*/ ), 'id' => 'wii_layout_single', 'type' => 'select_layout',
		  'info' => weaverii_t_('Layout for Posts displayed as a single page.' /*a*/ ),
		  'value' => ''
		  ),
	array('name' => weaverii_t_('<small>Archive</small>' /*a*/ ), 'id' => 'wii_layout_archive', 'type' => '+select_layout',     //code
		  'info' => weaverii_t_('Layout for archive pages on your site. Used for all archive-like pages unless otherwise specified. (&#9679;Pro)' /*a*/ ),
		  'value' => ''
		  ),
	array('name' => weaverii_t_('<small>Category Archive</small>' /*a*/ ), 'id' => 'wii_layout_category', 'type' => '+select_layout',   //code
		  'info' => weaverii_t_('Layout for category archive pages. (&#9679;Pro)' /*a*/ ),
		  'value' => ''
		  ),
	array('name' => weaverii_t_('<small>Tags Archive</small>' /*a*/ ), 'id' => 'wii_layout_tag', 'type' => '+select_layout',    //code
		  'info' => weaverii_t_('Layout for tag archive pages. (&#9679;Pro)' /*a*/ ),
		  'value' => ''
		  ),
	array('name' => weaverii_t_('<small>Author Archive</small>' /*a*/ ), 'id' => 'wii_layout_author', 'type' => '+select_layout',       //code
		  'info' => weaverii_t_('Layout for author archive pages. (&#9679;Pro)' /*a*/ ),
		  'value' => ''
		  ),
	array('name' => weaverii_t_('<small>Search Results, 404</small>' /*a*/ ), 'id' => 'wii_layout_search', 'type' => '+select_layout',  //code
		  'info' => weaverii_t_('Layout for search results and 404 pages. (&#9679;Pro)' /*a*/ ),
		  'value' => ''
		  ),
	array('name' => weaverii_t_('<small>Attachments</small>' /*a*/ ), 'id' => 'wii_layout_image', 'type' => '+select_layout',   //code
		  'info' => weaverii_t_('Layout for attachment pages such as images. (&#9679;Pro)' /*a*/ ),
		  'value' => ''
		  ),

	array('name' => weaverii_t_('Container & Sidebar Color Flow' /*a*/ ), 'id' => 'wii_layout_image', 'type' => '=subheader',
		  'info' => weaverii_t_('Allow color to flow to bottom' /*a*/ )
		  ),
	array('name' => 'Flow color to bottom', 'id' => 'wvr_flow_to_bottom', 'type' => '+checkbox',
		'info' => 'If checked, Container and Sidebar Wrappers bg colors will flow to bottom of each area
(that is, equal heights). You must provide background colors for the Container and Sidebar Wrapper
properties below or the default bg color will be used. <strong style="color:red">IMPORTANT NOTICE!</strong>
Equal color height will not be maintained on pages with content that changes height dynamically (e.g., show/hide, widgets that resize). Flow color is not used or needed on mobile devices. (&#9679;Pro)'),

	array('name' => weaverii_t_('Container Wrapper Properties' /*a*/ ), 'id' => 'wii_layout_image', 'type' => '=subheader',
		  'info' => weaverii_t_('Background, and Column Color Flow of Container wrapper' /*a*/ )
		  ),
	array('name' => 'Background', 'id' => 'sb_container_bgcolor', 'type' => '+ctext',
			'info' => 'Background color of content area wrapper - most useful when flowing color to bottom (&#9679;Pro)'),

	array('name' => 'Note:', 'type'=>'=note',
		  'info'=>'Width of container automatically calculated based on sidebar widths.
CAUTION: Using CSS+ to add borders or other width changes to the container or sidebar wrappers can break sidebar layout.'),

	array( 'type' => '=submit'),

	array('name' => weaverii_t_('Sidebar Wrappers Properties' /*a*/ ), 'id' => 'wii_layout_image', 'type' => '=subheader',
		  'info' => weaverii_t_('Widths, Background, and Column Color Flow of Sidebars' /*a*/ )
		  ),

	array('name' => 'Default Width for Sidebars', 'id' => 'sb_default_width_int', 'type' => '=val_percent',
		  'info' => 'If specified, will override all default sidebar widths specified below. This is mostly used for compatibility with the previous version of Weaver.'),

	array('name' => 'Right Side, One Column', 'type' => '=subheader_alt',
			'info' => 'Wrapper area for Single column sidebar on Right (Top+Upper+Lower Widget Areas)'),
	array('name' => 'Sidebar Width', 'id' => 'sb_right_1_col_width_int', 'type' => '+val_percent',
			'info' => 'Width of sidebar (Default: 25%) (&#9679;Pro)'),
	array('name' => 'Background', 'id' => 'sb_right_1_col_bgcolor', 'type' => '+ctext',
			'info' => 'Background color of sidebar wrapper (&#9679;Pro)'),

	array('name' => 'Left Side, One Column', 'type' => '=subheader_alt',
			'info' => 'Wrapper area for Single column sidebar on Left (Top+Upper+Lower Widget Areas)'),
	array('name' => 'Sidebar Width', 'id' => 'sb_left_1_col_width_int', 'type' => '+val_percent',
			'info' => 'Width of sidebar (Default: 25%) (&#9679;Pro)'),
	array('name' => 'Background', 'id' => 'sb_left_1_col_bgcolor', 'type' => '+ctext',
			'info' => 'Background color of sidebar wrapper. (&#9679;Pro)'),

	array('name' => 'Right Side, Two Column', 'type' => '=subheader_alt',
			'info' => 'Wrapper area for Double column sidebar on Right (Top above Left+Right Widget Areas)'),
	array('name' => 'Sidebar Width', 'id' => 'sb_right_2_col_width_int', 'type' => '+val_percent',
			'info' => 'Width of sidebar (Primary/Top Widget Area is this width) (Default: 33%) (&#9679;Pro)'),
	array('name' => 'Background', 'id' => 'sb_right_2_col_bgcolor', 'type' => '+ctext',
			'info' => 'Background color of sidebar wrapper (&#9679;Pro)'),

	array('name' => 'Left Side, Two Column', 'type' => '=subheader_alt',
			'info' => 'Wrapper area for Double column sidebar on Left (Top above Left+Right Widget Areas)'),
	array('name' => 'Sidebar Width', 'id' => 'sb_left_2_col_width_int', 'type' => '+val_percent',
			'info' => 'Width of sidebar (Primary/Top Widget Area is this width) (Default: 33%) (&#9679;Pro)'),
	array('name' => 'Background', 'id' => 'sb_left_2_col_bgcolor', 'type' => '+ctext',
			'info' => 'Background color of sidebar wrapper (&#9679;Pro)'),

	array('name' => 'Two Column - Left/Right', 'type' => '=subheader_alt',
			'info' => 'The Left and Right sidebars under the Primary (top) area in Double column sidebars.'),
	array('name' => 'Left Width', 'id' => 'sb_2_left_area_int', 'type' => '+val_percent',
			'info' => 'Left Width as % of double sidebar area width (Right set automatically) (Default: 55%) (&#9679;Pro)'),

	array('name' => 'Split Sidebars', 'type' => '=subheader_alt',
			'info' => 'Wrapper area for Split sidebars - Left side and Right side (Top above Right)'),
	array('name' => 'Sidebar Width - Left', 'id' => 'sb_split_left_width_int', 'type' => '+val_percent',
			'info' => 'Width of Left Side sidebar (Default: 17%) (&#9679;Pro)'),
	array('name' => 'Sidebar Width - Right', 'id' => 'sb_split_right_width_int', 'type' => '+val_percent',
			'info' => 'Width of Right Side sidebar (Default: 17%) (&#9679;Pro)'),
	array('name' => 'Background - Left', 'id' => 'sb_split_left_bgcolor', 'type' => '+ctext',
			'info' => 'Background color of left split sidebar wrapper (&#9679;Pro)'),
	array('name' => 'Background - Right', 'id' => 'sb_split_right_bgcolor', 'type' => '+ctext',
			'info' => 'Background color of right split sidebar wrapper (&#9679;Pro)')
	);

?>
<p>
	Settings affecting overall <strong>Site Layout</strong>. This includes <strong>Widths</strong>, <strong>Margins</strong>,
	<strong>Sidebar Layout</strong>, and <strong>Background</strong> colors of major layout regions.
</p>
<?php
	weaverii_form_show_options($opts);
}
?>
