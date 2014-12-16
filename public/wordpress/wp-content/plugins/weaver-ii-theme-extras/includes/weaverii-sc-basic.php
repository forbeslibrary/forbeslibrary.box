<?php
/*
Weaver II Pro Shortcodes - Version 1.0

This code is Copyright 2011 by Bruce Wampler, all rights reserved.
This code is licensed under the terms of the accompanying license file: license.html.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.

Note - same file for both versions...
*/
function weaveriip_has_show_posts() {return true;}

function weaveriip_show_posts_admin() {
?>
<label><span style="color:blue;font-weight:bold; font-size: larger;"><b>Show Posts - [weaver_show_posts]</b></span></label>&nbsp;
<?php weaverii_help_link('help.html#showposts','Help for Weaver Shortcodes'); ?>
<p>The Weaver <code>[weaver_show_posts]</code> shortcode allows you to display posts on your pages or in a text widget
in the sidebar. You can specify a large number of filtering options to select a specific set of posts to show.</p>
<p>
<strong>Summary of all parameters, shown with default values.</strong> You don't need to supply every
option when you add the [weaver_show_posts] to your own content. The options available for this short code allow
you a lot of flexibility id displaying posts. A full description of all the parameters
is included in the Help file - <em>please</em> read it to learn more about this shortcode. Just click the ? above.</p>
<p>
<em>[weaver_show_posts cats="" tags="" author="" author_id="" single_post="" post_type='' orderby="date" sort="DESC" number="5" paged=false nth="1" show="full" hide_title=""
hide_top_info="" hide_bottom_info="" show_featured_image="" hide_featured_image="" show_avatar="" show_bio="" excerpt_length="" style=""
class="" header="" header_style="" header_class="" more_msg="" left=0 right=0 clear=0]</em>
</p>
<?php
}

function weaveriip_has_breadcrumbs() {return true;}

function weaveriip_breadcrumbs_admin() {
?>
    <label><span style="color:blue;font-weight:bold; font-size: larger;"><b>Breadcrumbs - [weaver_breadcrumbs]</b></span></label>&nbsp;
<?php weaverii_help_link('help.html#breadcrumbs','Help for Weaver Breadcrumbs');
?>
<p>The <code>[weaver_breadcrumbs]</code> shortcode allows you display "breadcrumbs" to the current page. This is the same
breadcrumb content as displayed in the standard Info Bar. The intent of this short code is to allow you to disable
the default Info Bar and place the breadcrumbs wherever you like.</p>

<p><strong>Shortcode usage:</strong> <code>[weaver_breadcrumbs class='alt-class' style='inline-style']</code>
<br />
<ol>
    <li><strong>class='alt-class-name'</strong> - By default, the breadcrumb is wrapped with the same <code>.breadcrumbs</code>
    class used in the Info Bar. You can specify an alternate wrapping class if you wish.
    </li>
    <li><strong>style='inline-style-rules'</strong> - Allows you to add inline style to wrap output of the shortcode.
    Don't include the 'style=' or wrapping quotation marks. Do include a ';' at the end of each rule. The output will look like
    <code>style="your-rules;"</code> - using double quotation marks.
    </li>
</ol>
</p>
<?php
}

function weaveriip_has_headerimg() {return true;}

function weaveriip_headerimg_admin() {
?>
    <label><span style="color:blue;font-weight:bold; font-size: larger;"><b>Header Image - [weaver_header_image]</b></span></label>&nbsp;
<?php weaverii_help_link('help.html#headerimage','Help for Weaver Header Image');
?>
<p>The <code>[weaver_header_image]</code> shortcode allows you display the current header image wherever you want.
For example, you can get the header image into the Header Widget Area by using this shortcode in a text widget.
The current standard or mobile header image will be displayed. Only the <code>&lt;img ... &gt;</code> is displayed --
the image will not be wrapped in a link to the site.</p>

<p><strong>Shortcode usage:</strong> <code>[weaver_header_image h='size' w='size' style='inline-style']</code>
<br />
<ol>
    <li><strong>w='size' h='size'</strong> - By default, no height or image properties are included with the
    header <code>&lt;img ... &gt;</code>, which will result in an image scaled to fit into whatever the natural
    width of the enclosing HTML container is (the content area, a text widget, etc.). You may specify an explicit
    value (usually in px) for the height and width of the image.
    </li>
    <li><strong>style='inline-style-rules'</strong> - Allows you to add inline style to wrap output of the shortcode.
    Don't include the 'style=' or wrapping quotation marks. Do include a ';' at the end of each rule. The output will look like
    <code>style="your-rules;"</code> - using double quotation marks.
    </li>
    </ol>
</p>
<?php
}

function weaveriip_has_pagenav() {return true;}

function weaveriip_pagenav_admin() {
?>
    <label><span style="color:blue;font-weight:bold; font-size: larger;"><b>Blog Page Navigation - [weaver_pagenav]</b></span></label>&nbsp;
<?php weaverii_help_link('help.html#pagenav','Help for Weaver Page Navigation');
?>
<p>The <code>[weaver_pagenav]</code> shortcode allows you display numbered blog page navigation
links on blog pages. This is the same Weaver II based
page navigation content as displayed in the standard Info Bar. The intent of this short code is to allow you to disable
the default Info Bar and place the numbered navigation wherever you like. Note: this shortcode will display
output only on blog pages - there will be nothing on standard static pages. It is probably most useful
when used in an HTML insertion area or in a text widget in a blog page widget area.</p>

<p><strong>Shortcode usage:</strong> <code>[weaver_pagenav style='inline-style' end_size=1 mid_size=2]</code>
<br />
<ol>
    <li><strong>style='inline-style-rules'</strong> - Allows you to add inline style to wrap output of the shortcode.
    Don't include the 'style=' or wrapping quotation marks. Do include a ';' at the end of each rule. The output will look like
    <code>style="your-rules;"</code> - using double quotation marks.
    </li>
    <li><strong>end_size=1 mid_size=2</strong> - This shortcode uses the standard WordPress function <code>paginate_links</code>
    to generate the links. The <code>end_size</code> and <code>mid_size</code> are used to specify how many page numbers
    are displayed at the ends of the list, and surrounding the current page when in the middle of the list. The defaults
    are 1 and 2. You can experiment to get whatever looks best for your site.
    </li>
    <li><strong>error_message='text'</strong> - If you want, you can have the shortcode display a message on non-blog pages.
    </li>
</ol>
</p>
<?php
}

function weaveriip_has_sitetitle() {return true;}

function weaveriip_sitetitle_admin() {
?>
    <label><span style="color:blue;font-weight:bold; font-size: larger;"><b>Site Title - [weaver_site_title]</b></span></label>&nbsp;
<?php weaverii_help_link('help.html#sitetitlesc','Help for Weaver Site Title and Tagline');
?>
<br />
<label><span style="color:blue;font-weight:bold; font-size: larger;"><b>Site Tagline - [weaver_site_desc]</b></span></label>

<p>The <code>[weaver_site_title]</code> and <code>[weaver_site_desc]</code> shortcodes allow you display the current
site title and site tagline. (Site Tagline was formerly called Site Description.) This can be useful in a text widget in the Header Widget Area, for example.</p>
<p><em>Note:</em> If you want to position the content of a text widget within the a cell of the Header Widget Area, you could use the following
example:</p>
    <p><code>[weaver_site_title style='font-size:150%;position:absolute;padding-left:20px;padding-top:30px;']</code></p>

<p><strong>Shortcode usage:</strong> <code>[weaver_site_title style='inline-style'] [weaver_site_desc style='inline-style']</code>
<br />
<ol>
    <li><strong>style='inline-style-rules'</strong> - Allows you to add inline style to wrap output of the shortcode.
    Don't include the 'style=' or wrapping quotation marks. Do include a ';' at the end of each rule. The output will look like
    <code>style="your-rules;"</code> - using double quotation marks.
    </li>
</ol>
</p>

<?php
}

function weaveriip_has_video() {return true;}

function weaveriip_video_admin() {
?>
<label><span style="color:blue;font-weight:bold; font-size: larger;"><b>Vimeo - [weaver_vimeo]</b></span></label>&nbsp;
<?php weaverii_help_link('help.html#video','Help for Weaver Video shortcodes');
?>
<br /><label><span style="color:blue;font-weight:bold; font-size: larger;"><b>YouTube - [weaver_youtube]</b></span></label>
<br />
<p>Weaver II supports specialized shortcodes to display video. While there are other ways to embed video, the Weaver II versions have two important features. First, they will auto adjust to the width of your content, <em><strong>including</strong></em> the mobile view. Second, they use the latest iframe/HTML5 interface provided by YouTube and Vimeo. Both the YouTube and Vimeo shortcodes assume your video will be 16:9 HD aspect ratio unless you
specify sd=1..</p>
<h4>Vimeo</h4>
<strong>Shortcode usage:</strong> <code>[weaver_vimeo vimeo-url <em>or</em> id=videoid sd=0 percent=100 center=1 color=#hex autoplay=0 loop=0 portrait=1 title=1 byline=1]</code>

<p>This will display Vimeo videos. At the minimum, you can provide the standard http://vimeo.com/nnnnn link, or just the video ID number (which is part of the Vimeo Link). Don't provide both! The other options are explained in the Help document</p>
<h4>YouTube</h4>
<strong>Shortcode usage:</strong> <code>[weaver_youtube youtube-url <em>or</em> id=videoid sd=0 percent=100 center=1 rel=0 https=0 privacy=0  see_help_for_others]</code>
<p>This will display YouTube videos. At the minimum, you can provide the standard http://youtu.be/xxxxxx share link (including the options YouTube lets you specify), the long format share link, <strong>OR</strong> just the video ID number (which is part of the YouTube Link) Don't provide both! The other options are explained in the Help document</p>

<?php
}

function weaveriip_has_showhide_mobile() {return true;}

function weaveriip_showhide_mobile_admin() {
?>
    <label><span style="color:blue;font-weight:bold; font-size: larger;"><b>Show If Mobile - [weaver_show_if_mobile]</b></span></label>&nbsp;
<?php weaverii_help_link('help.html#showhidemobile','Help for Show/Hide if Mobile');
?>
<br />
<label><span style="color:blue;font-weight:bold; font-size: larger;"><b>Hide If Mobile - [weaver_hide_if_mobile]</b></span></label>

<p>The <code>[weaver_show_if_mobile]</code> and <code>[weaver_hide_if_mobile]</code>shortcodes allow you to selectively
display content depending if the visitor is using a standard browser or a mobile device browser. You might want
to disable a video on for mobile devices, or even disable the Weaver Slider Menu on mobile devices, for example.</p>

<p><strong>Shortcode usage:</strong> <code>[weaver_show_if_mobile type='mobile']content to show[/weaver_show_if_mobile]</code>
</p>
<p>You bracket the content you want to selectively display with <code>[weaver_show/hide_if_mobile]</code> and closing
<code>[/weaver_show/hide_if_mobile]</code> tags. That content can contain other shortcodes as needed.
</p>
<p>
The <code>type</code> argument can specify 'mobile' which includes all mobile devices (not tablets), 'touch' which includes
touch sensitive mobile devices (e.g., small screen phones),'smalltablet' for small screen tablets (e.g. Kindle Fire), 'tablet' which includes only tablets such as the iPad,
or 'any' which will include any mobile device. The default is 'mobile'.
</p>
<?php
}

function weaveriip_has_showhide_logged_in() {return true;}

function weaveriip_showhide_logged_in_admin() {
?>
    <label><span style="color:blue;font-weight:bold; font-size: larger;"><b>Show If Logged In - [weaver_show_if_logged_in]</b></span></label>&nbsp;
<?php weaverii_help_link('help.html#showhideloggedin','Help for Show/Hide if Logged In');
?>
<br />
<label><span style="color:blue;font-weight:bold; font-size: larger;"><b>Hide If Logged In - [weaver_hide_if_logged_in]</b></span></label>

<p>The <code>[weaver_show_if_logged_in]</code> and <code>[weaver_hide_if_logged_in]</code>shortcodes allow you to selectively
display content depending if the visitor is logged in or not.</p>

<p><strong>Shortcode usage:</strong> <code>[weaver_show_if_logged_in]content to show[/weaver_show_if_logged_in]</code>
</p>
<p>You bracket the content you want to selectively display with <code>[weaver_show_if_logged_in] or [weaver_hide_if_logged_in]</code>
and closing tags <code>[/weaver_show_if_logged_in]</code> or
<code>[/weaver_hide_if_logged_in]</code>. That content can contain other shortcodes as needed. </p>


<?php
}

function weaveriip_has_sc_html() {return true;}

function weaveriip_sc_html_admin() {
?>
    <label><span style="color:blue;font-weight:bold; font-size: larger;"><b>HTML - [weaver_html]</b></span></label>&nbsp;
<?php weaverii_help_link('help.html#schtml','Help for HTML Shortcode');
?>
<p>The Weaver <code>[weaver_html]</code> shortcode allows you to add arbitrary HTML to your post and page content. The
main purpose of this shortcode is to get around the auto paragraph and line break and other HTML stripping functionality
of the WordPress editor. See the Help document for more details.</p>

<p><strong>Shortcode usage:</strong> <code>[weaver_html html-tag args='parameters']</code>
<br />
<ol>
    <li><strong>html-tag</strong> - The first parameter to the shortcode must be present, and must be a standard
    HTML tag - <code>p</code>, <code>br</code>, or <code>span</code>, for example. You just supply the tag - no quotation
    marks, no '=', just the tag. The shortcode provides the &lt; and &gt;. If you need a wrapping HTML tag (e.g., <code>span</code> and <code>/span</code>), use
    two shortcodes:<br />
    <code>[weaver_html span args='style="color:red"']content to make red[weaver_html /span]</code>
    </li>
    <li><strong>args='parameters'</strong> - Allows you to specify arbitrary parameters for your HTML tag. See the example above.
    </li>
</ol>
</p>
<?php
}

function weaveriip_has_sc_div() {return true;}

function weaveriip_sc_div_admin() {
?>
    <label><span style="color:blue;font-weight:bold; font-size: larger;"><b>DIV - [div]text[/div]<br />SPAN - [span]text[/span]</b></span></label>&nbsp;
<?php weaverii_help_link('help.html#scdiv','Help for div Shortcode');
?>
<p>The Weaver <code>[div]</code> and <code>[span]</code> shortcodes allow easily add HTML &lt;div&gt; and &lt;span&gt; tags
to your post and page content. The main purpose of these shortcodes is to get around need to switch to the HTML editor view when you need to
wrap your content in a &lt;div&gt; or &lt;span&gt;.</p>
<p>
	These will work exactly like a standard HMTL &lt;div&gt; or &lt;span&gt; tag. They support 'id', 'class',
    and 'style' parameters, which are the most useful. Instead of wrapping your text in &lt;div&gt; or &lt;span&gt; tags, wrap them like
    this (the Visual view will work just fine):<br />
    <code>[div style="font-size:20px;']This content will be large.[/div]</code> or <br />
    <code>[span style="font-size:20px;']This content will be large.[/span]</code> or <br />
</p>

<p><strong>Shortcode usage:</strong> <code>[div id='class_id' class='class_name' style='style_values']text[/div]</code>
<br /><code>[span id='class_id' class='class_name' style='style_values']text[/span]</code>
<br />
<ol>
    <li><strong>id='class_id' class='class_name' style='style_values'</strong> - Allows you to specify id, class, and style for the &lt;div&gt;. See the example above.
    </li>
</ol>
</p>
<?php
}

function weaveriip_has_sc_iframe() {return true;}

function weaveriip_sc_iframe_admin() {
?>
    <label><span style="color:blue;font-weight:bold; font-size: larger;"><b>iFrame - [weaver_iframe]</b></span></label>&nbsp;
<?php weaverii_help_link('help.html#sciframe','Help for Weaver iFrame');
?>
<p>The <code>[weaver_iframe]</code> shortcode allows you easily display the content of an external site. You simply have to specify
the URL for the external site, and optionally a height. This shortcode automatically generates the correct HTML &lt;iframe&gt; code.</p>

<p><strong>Shortcode usage:</strong> <code>[weaver_iframe src='http://example.com' height=600 percent=100 style="style"]</code>
<br />
<ol>
    <li><strong>src='http://example.com'</strong> - The standard URL for the external site.
    </li>
    <li><strong>height=600</strong> - Optional height to allocate for the site - in px. Default is 600.
    </li>
    <li><strong>percent=100</strong> - Optional width specification in per cent. Default is 100%.
    </li>
    <li><strong>style="style"</strong> - Optional style values. Added to &lt;iframe&gt; tag as style="values" (shortcode adds double quotation marks).
    </li>
</ol>
</p>

<?php
}

?>
