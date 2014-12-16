=== Weaver II Theme ===

Contributors: wpweaver
Author URI: http://weavertheme.com/about
Theme URI: http://weavertheme.com
Tags: custom-header, custom-colors, custom-background, custom-menu, theme-options, left-sidebar, right-sidebar,
three-columns, two-columns, black, blue, brown, green, orange, red, tan, dark, white, light,
translation-ready, rtl-language-support, editor-style
Requires at least: 3.6
Tested up to: 3.9
Stable tag: 1.0

== Description ==

Weaver II is an advanced Theme platform that supports extensive customization by the user,
as well as automatic support for mobile devices.

== Licenses ==

* Weaver II is licensed under the terms of the GNU GENERAL PUBLIC LICENSE, Version 2,
June 1991. (GPL) The full text of the license is in the license.txt file.
* Weaver II has been derived from the Word Press Twenty Eleven Theme, also licensed
under GPL V2. The source code for Twenty Eleven is available at
http://wordpress.org/extend/themes/twentyeleven
* All images included with Weaver II are either original works of the author which
have been placed into the public domain, or have been derived from other public domain sources,
and thus need no license. (This does not include the images provided with any of the
below listed scripts and libraries. Those images are covered by their respective licenses.)
* Weaver II also includes several scripts and libraries that are covered under the terms
of their own licenses in the listed files in the Weaver II theme distribution:
** Yetii - Yet (E)Another Tab Interface Implementation - license in /js/yetii/yetii.js (BSD)
** Accordion, jQuery Plugin - license in /js/accordion/LICENSE (New BSD)
** jscolor, JavaScript Color Picker - license in /js/jscolor/jscolor.js (GLGPL)
** CSS3 rendering for IE - license in /js/PIE/PIE_uncompressed.js (GPL V2)
** Superfish - jQuery menu widget - license in /js/superfish/superfish.js (MIT/GPL)
** html5 IE lib - license in /js/htm5.js (MIT)
** Google Prettify.js - license in /js/theme/prettify.js (Apache 2.0)
** theme scripts - original to this theme, covered by GPL
** jQuery Masonry - MIT

== Changelog ==

This change log was started beginning with Version 1.0

= Changes Version 1.0 =
This theme, Weaver II, is a brand new theme. It started with Twenty Eleven as the base theme file architecture,
but extensively modified those files. It also incorporated many files and features from the original Weaver theme
by the same author.

= Changes Version 1.0.1 =
* Added titlelist to [weaver_show_posts]
* Added default_hidden_meta_boxes filter to enable Custom Fields and Discussion in post/page editor
* Added doc note about custom CSS precedence
* Added rounded corners for content
* Fixed Custom Excerpt Continue Reading issue
* Fixed TEMPLATEPATH usage
* Fixed title generation code - trim()
* Fixed overflow:hidden on multi-column
* Fixed links bold,italic, and underline precedence issues
* Fixed hide sidebars on single per-post option
* Fixed wrong help file links in some options

= Changes Version 1.0.2 =
* Fixed menu current page color styling (!important)
* Fixed CSS Help link
* Fixed shortcode list on shortcode admin page
* Fixed some minor HTML generation errors
* Fixed .weaver-mobile #branding/#colophon width
* Added custom post type per-post support
* Added Facebook preferred image
* Added [span]
* Added [weaver_youtube] and [weaver_vimeo]
* Added support for 'smalltablet' - phone, small tablets, tablets, standard browsing
* Added detection of major incompatible cache plugins

= Changes Version 1.0.3 =
* Fixed allow attachment comments
* Fixed .widget-area lists
* Fixed @media sidebar rules

= Changes Version 1.0.4 =
* Fixed SIE user agent - removed

= Changes Version 1.0.5 ==
* Added doc note and follow SEO option for Facebook image
* Added full-size, centered BG image to Pro
* Added W3TC support
* Enhanced [weaver_youtube]
* Fixed og:url to get_home_url()
* Fixed [weaver_show_posts] title styling
* Fixed .widget-area list bug with vertical menus

= Changes Version 1.0.6 ==
* Added .post-even and .post-odd to post <article> div
* Added Mobile support for Opera Mini (non-dropdown menu version)
* Added Pre-Wrapper HTML area
* Added custom mobile toggle HTML
* Added shortcode processing to manual post excerpts
* Added Mobile Menu alternative
* Added percent size and center to video shortcodes
* Added post info line custom template
* Added Demo Child theme directory
* Fixed boldface on some admin titles
* Fixed no title displayed when no content on Page with Posts
* Fixed some incorrect /spans
* Fixed (really) [weaver_show_posts] title styling
* Fixed the_title('') for SEO
* Fixed display of Title/Description over header image on tablets
* Fixed alternate header for mobile view
* Dropped SF menus for vertical popout - didn't work so don't use
* Dropped some input#s rules from style-minimal.css
* Enhanced debug/trace display
* Changed #site-info width to 100% if Hide Powered By
* Changed widths for next/prev posts when using paged Nav
* Changed comment paragraph spacing
* Changed color flow from padding/-margin trick to equalheights.js
* Moved output of CSS+ rules to end of generated CSS

== Changes Version 1.0.7 ==
* Added Tablet Alternate Header Image (&#9679;Pro)
* Enhanced Mobile Simulator - added small tablet and tablet sims
* Enhanced [weaver_iframe] - added style, percent
* Enhanced video shortcodes - added ratio; removed w,h; changed YT relative to rel;
  sizing now via JS using ratio to set height
* Updated [weaver_hide/show_if_mobile] docs to include 'any'
* Added #header_widget_table {width:100%;} for header widget area
* Fine tuned some rules in style.css, style-minimal.css, and order of CSS+ rules in css generation.
  Includes a change to the #branding img rule that might affect spacing in custom header rules
* Fixed CSS+ static page title generation
* Fixed problem with menu class display caused by deprecated PHP

== Changes Version 1.0.8 ==
* Added clear:both after mobile/full toggle images
* Added word-wrap:break-word to default styling
* Fixed 'right-margin' css error for left double sidebar
* Fixed Post-Right Sidebar title to Pre-Right Sidebar. Description was correct.
* Fixed 100% width generated when only copyright used.
* Fixed show/hide that 1.0.7 broke.

== Changes Version 1.0.9 ==
* Added Slide Open Menu for Mobile Phone view - made default menu for phones
* Added auto-scaling for iOS devices (<meta viewport>)
* Added [weaver_show/hide_if_logged_in] shortcode
* Added Pre-Header and Post-Footer HTML Insert area back into basic version
* Added %day%, %month%, %year% to post info template parameters (Pro only)
* Added extra link to Pro Shortcode page from Pro tab (Pro only)
* Added "Hide Author for Single Author Site" (changes default behavior)
* Removed flat mobile menu for Opera Mini (use slide open menu now)
* Fixed missing bold/italic/CSS+ styling for vertical menus
* Fixed Page with Posts current page in vertical menus issue
* Fixed [div] and [span] to use do_shortcode() for text
* Fixed version update link
* Fixed color flow script to load vs. ready so images are counted
* Fixed .entry-content total css issue (&#9679;Pro)
* Refined list styling

== Changes Version 1.0.10 ==
* Added Hide on Primary Menu if logged in or not Per Page
* Fixed Title Underline didn't apply on index.php blog
* Fixed [ weaver_feed ] title bottom margin
* Fixed #branding img style

== Changes Version 1.0.11 ==
* Added Custom Post Type to Page with Posts and [weaver_show_posts]
* Added Custom CSS replacement file
* Tweaked #nav-above #nav-below: display:none;margin:0;
* Fixed hide tool tips (&#9679;Pro)
* Fixed postpostcontent to use .inject_postpostcontent instead of #
* Fixed alternate mobile theme bug when no theme saved (&#9679;Pro)

== Changes Version 1.0.12 ==
* Added Slide Open Menu option for standard view sites
* Added Check Theme for Possible Problems in Weaver Admin
* Added Clear Messages button in Weaver Admin
* Added link to help file for info on disabling comments
* Fixed menu bar left indent so didn't also incorrectly indent sub-menu
* Fixed some avatar and image size problems with IE8, avatar placement on IE9,
  Moved post-avatar styling from inline to style.css
* Tweaked move title/description margins, font size (style-minimal.css)

== Changes Version 1.0.13 ==
* Beginning with the version, odd sub versions will represent development version.
  Release versions will be even.

== Changes Version 1.0.14 ==
* Some internal code changes needed for future Weaver II Theme Switcher plugin
* Fixed #content img style (incorrect fix to avatar code in 1.0.12)

== Changes Version 1.0.16 ==
* Added hide secondary menu on Phone view
* Added .bcur_page class for Breadcrumb current page (instead of hardwired strong)
* Added hide large tablet for gadgets (&#9679;Pro)
* Fixed #site-ig-wrap (added clear:both) so long copyrights work correctly
* Fixed styling for Social Buttons (&#9679;Pro)

== Changes Version 1.0.18 ==
* Added clear:left to #branding img (to clear #site-title)
* Fixed Social Buttons on Menu Bar for IE8 (&#9679;Pro)

== Changes Version 1.0.20 ==
* Added warning to Header Width option description. Will ignore if value same as theme width.
* Added note that <HEAD> section code does not support shortcodes
* Fixed original Weaver to Weaver II conversion of top/bottom widget area color CSS
* Revised reademe.txt - added full license info, moved change log to reademe.txt

== Changes Version 1.0.22 ==
* Tweaked instructions for Save Alternate Mobile Theme
* Fixed Apple iOS icon setting
* Added IE8 #ie8 #content img max-width rule

== Changes Version 1.0.24 ==
* Fixed [gallery] images - centered now
* Fixed borders, captions for images from URL instead of Media Lib
* Fixed bug with hide sidebars on post single page view

== Changes Version 1.0.26 ==
* Added (&#9679;Pro) tag to Pro-only options
* Added  &diams; tag to not-theme-related settings
* Added .entry-hdr to single post title
* Added new sidebar support for plugins that use sidebar.php
* Added < html id="ie9"> for IE9
* Fixed title color CSS rules generation problem
* Fixed 404 mobile view styling
* Fixed weaverii_continue_reading_link in child theme demo
* Fixed Add HTML to Menu Bar documentation bugs - location moved since Weaver 2.2
* Fixed print CSS issue for 2nd page
* Fixed weaverii_f_fail message display
* Fixed Page Nav (removed it) and page title links on Search results page
* Fine tuned documentation wording in several places
* Revised license text for images

== Changes Version 1.1 ==
* Added new ways to move Site Title and Description around header space
* Added option to make the first post (and sticky posts) one-column for multi-column blog layouts
* Added new HTML area to accompany Site Title and Description in header space (&#9679;Pro)
* Added option for "Menu" name for secondary mobile slide open menu in addition to primary
* Added option to use alternative slide open menu for small tablets
* Added HTML Source page template
* Added WP 3.4 support for custom headers and background - only noticeable change is that
  user can now upload different sized header images, and they will be flexibly displayed
* Added Post Page Specifics:Columns of Posts is now a standard option (not just Pro)
* Added ability to specify totally custom .css file to replace standard style.css
* Added new alternate header image option
* Added warning message if a Page with Posts is set to the Reading:Posts page
* Added bodyclass (per page) and postclass (per post) Custom Field processing to add custom classes
  to <body> tag for pages and <article> tag for posts.
* Added Site Line Height option to Fonts - also reworked how line-height used in style.css
* Added Info Bar to Fonts options (&#9679;Pro)
* Added Hide Slider on Mobile Views (&#9679;Pro)
* Added automatic support for Yoast SEO's breadcrumbs
* Added list of recommended plugins
* Added space between title and content option
* Added space after paragraphs/list option
* Added options to specify thumb/medium/large for Featured Images
* Made all images use same border/shadow settings, including Featured Images
* Fixed subtheme sort order
* Fixed "Header Padding: option - it was there, but actually never worked
* Fixed incorrect "Blog" breadcrumb when using Page with Posts
* Fixed weaverii_get_header/footer to properly use header/footer-xxx.php files for child themes
* Fixed custom css for archive-type pages (&#9679;Pro)
* Fixed problem with loading theme definitions saved in file (was overwriting some "diamond" settings.)
* Fixed CSS generated for #container bg color option
* Fixed some inconsistencies between style.css and style-minimal.css
* Fixed bug on border for author commenting on own comments
* Fixed display of Post Comment button on small tablets
* Tweaked mobile widget area - now totally follows Primary Widget area, including borders and bg color.
* Tweaked: Added new top line descriptions of admin tabs
* Tweaked: Page with Posts templates now also tagged blog in <body> block
* Tweaked: img styling
* Tweaked: 404 page - added sidebar - use same layout as Search
* Tweaked: number of pages displayed for paged navigation
* Tweaked: better handling of cover-size bg images on IE7, IE8
* Tweaked: removed including <img src=""> for empty header image
* Tweaked: Static Pages will now display with link on title if listed on archive-like page (can
           happen through plugin interactions)
* Tweaked: Wording in breadcrumbs for better match to existing translation files
* IE7 and IE8:
    1. PIE now always loaded by default (supports shadows on images), added documentation on how to
       use PIE for custom CSS rules.
    2. rgba(r,g,b,a) transparency values now supported for bg colors for IE7 and IE8 (adds IE specific codes)
* HTML Change: moved #nav-top-menu and #nav-bottom-menu outside #branding. Includes some changes
  to #site-title and #site-description default CSS. These changes may affect some
  custom rules that use these id's. This change required for other features to work properly.
* Changed all instances of "style=" in visitor side generated code to classes.
* If custom Mobile Menu is defined, it overrides other hide menu bar settings - will always show
* Revised Snippets file - added section organization, added new snippets
* Updated JavaScript enqueues on visitor side code
* Extensively revised translation calls to __(). Created new weaver-ii.pot file and new translations for top languages.
  New files will allow end users to use Poedit to tweak any message wording in any language.

== Changes Version 1.1.1 ==
* Fixed duplicate/incorrect #branding in style-minimal.css
* Fixed broken 2 col page template file

== Changes Version 1.1.2 ==
* Restored missing file for Post/Page editor styling
* Fixed some small doc typos
* Added rule for social buttons in #branding (&#9679;Pro)
* Fixed Post-Post Content hide on home page bug (&#9679;Pro)
* Added auto-settings update when a new version installed
* Added 'Opera Mobi' to touch device list

== Changes Version 1.1.3 ==
* Added option to allow forcing jQuery to load
* Added hide FI as header image on mobile view
* Fixed small-tablet @media nesting in style.css
* Fixed FI for [weaver_show_posts]
* Fixed Spanish translation - had wrong character set
* Tweaked wording on Search results over multiple pages (Previous/Next)

== Changes Version 1.1.4 ==
* Added move top menu next to header image
* Added move top menu outside #wrapper (&#9679;Pro)
* Added use 0 as width to hide FI
* Added '+' prefix to per-post styling to avoid automatic use of post id in rule
* Added "New Page" option to header gadgets link (&#9679;Pro)
* Added link to contributed subtheme page on main site
* Made a few doc changes, including revised instructions for translations
* Fixed Archive FI when size specified
* Fixed custom css file inclusion
* Fixed css for current menu item for categories, etc on custom menus
* Fixed menu z-index for style-minimal.css
* Tweaked #site-description in style-minimal.css

== Changes Version 1.1.5 ==
* Added: Hide Per Page/Post options by User Role (&#9679;Pro)
* Added: author_id="list" option for [weaver_show_posts]
* Fixed: clear:both after top menubar
* Fixed: fixed width layout needed max-width reset, too.
* Fixed: image BG CSS+ rules fixed (added img. to some)
* Fixed: left margin for ordered lists for >= 10 items
* Fixed: [weaver_show_hide] alt show/hide image
* Fixed: bad #sidebar_header rules in style-minimal.css
* Fixed: .entry-utility bug in link color css - missing '.'
* Fixed: specify relative path for style-weaverii.css for enqueue
* Fixed: always show desktop home page on FullView on mobile device
* Tweaked image shadow rules - added #content img[class*="wp-image-"]
* Tweaked .header-widget img CSS rule
* Minor wording and code tweaks

== Changes Version 1.1.6 ==
* Undo https: style sheet fix - doesn't work on subdirs (Pro Only - free 1.1.6 never released)

== Changes Version 1.1.7 ==
* Added .post-order-nn to each blog page post (now have number as well as even/odd)
* Added CZ translation
* Added author ids to Page with Posts author box - enter id list, or author name
* Added .weaver-any-mobile class for any kind of mobile device
* Added message to Featured Image box
* Fixed [ weaver_show_posts ] issue with PwP title only options
* Fixed: PwP layout failed when using global blog layout setting
* Fixed some links on the help screen
* Fixed where < /div ><!-- #main --> is generated.

== Changes Version 1.2 ==
* Extensive enhancement of Mobile support - now both User Agent and pure Responsive modes
  - Moved Mobile to its own top level admin tab
  - Now have 4 mobile modes: Stacked or hidden sidebars on either Smart (User Agent based)
	or "pure" responsive mobile support modes
  - Support for Android pull-down menu hover vs. touch (affects tablets mostly)
  - Added .wvr-show-mobile, .wvr-show-phone, .wvr-show-smalltablet, and .wvr-show-tablet classes
  - Added new responsive rules for embed, iframe, object, video, & twitter
  - Removed support for using pull-down menu for Smart and Responsive mobile views - phones
        now always use Mobile menu
  - Mobile options displayed in green
  - Split mobile CSS rules into separate style file.
  - jQuery library now always loaded by Weaver II
* Added option to not-excerpt 1st "n" blog posts (global and per Page with Posts)
* Added dedicated value box for per-page <body> class name
* Added 'container-pagetype' class to #container_wrap for all page types
* Added don't display 1st n posts on Page with Posts template - useful with plugins that will
  display the 1st n posts in an alternative format - such as a slider.
* Added Video Post Format
* Added horizontal bars to admin pages for readability
* Paged navigation now shows on search and mobile views if that option selected
* Improved Child Demo file, added display of child theme name on admin panel
* Header Extra HTML uses only its own Hide on Mobile setting now.
* Fixed a few minor bugs from beta 92 version: left menu padding, doc errors, admin interface display issues
* Revised JavaScript files - combined all into one file, use global JS vars for option control
* Optimize JavaScript and CSS file sizes by using YUI Compressor (via Minimus on a Mac)
* Tweaked (*Pro) label to make more readable
* Changed how "Menu Effects" option works. Only Arrows now. Sorry, no longer has animated
    pull-down menus. Superfish caused issues with page resize handling.
* Removed upgrade support for Weaver 2.2.x to Weaver II - it is now in a plugin
* Revised Help file

== Changes Version 1.2.1 ==
* Fixed bug with Superfish script conflict
* Mobile Menu now will hide submenus if Menu Effects checked (superfish)
* Fixed show/hide if mobile for IE7, IE8
* Improved migration to first time install of Weaver II Pro from Weaver II free

== Changes Version 1.2.2 ==
* Fixed color picker

== Changes Version 1.2.3 ==
* Tweaked help file to add info about using @media rules for responsive customization
* Tweaked how Disable Mobile Support works - shows full scaled site on

== Changes Version 1.2.4 ==
* Added Gradient definition and options to show on header, content, footer, and widget areas
* Added shortcode support to custom post info lines
* Removed WP 3.3 compatibility - now requires at least WP 3.4
* Added JetPack Infinite Scroll support
* added [ weaver_show_posts ] hide_featured_image option
* Fixed breadcrumbs with nested sub-categories
* Fixed split sidebar responsive issue
* Fixed iOS phone menu issue
* Fixed display of footer widget area on mobile devices (show on all stacked modes, one column)
* Fixed problem with #ie8 and hide title/description

== Changes Version 1.2.5 ==
* Added Weaver II Per Page Text Widget
* Added some child theme hooks to allow child themes to extend admin pages
* Added move header horizontal widget area after header image
* Added %template_directory%, %stylesheet_directory%, and %addon_directory% processing for CSS++ and Custom CSS Rules for url()s
* Added hide menu bars on desktop view option
* Some code optimization in CSS generation
* Changed Weaver II Theme tab - selection of subthemes now by radio button instead of pull-down.
* Changed wording so now always use the term 'subtheme' and not sub-theme.
* Recently added translations: PL, IT, CZ, HU
* Fixed bug on bottom/top mobile menu labels
* Fixed clear:both; problem in infobar when used with left sidebar
* Fixed what "Page Title Text" color is applied to (CSS+ was issue)
* Fixed mobile menu rule in style-minimal.css

== Changes Version 1.2.6 ==
* Note: 1.2.5 never released in Weaver II free version - all changes listed for 1.2.5 also apply to 1.2.6 free
* Improved display issues with Hide Menus - Desktop option
* Added filter to Weaver's settings to allow child themes to easily have their own settings.
* Added option to hide Search box when search fails or archive post not found (Pro)
* Added Per Page subtheme selection when used with Weaver II Theme Switcher plugin
* Changed search pages to treat FIs like archive pages
* Changed behavior of print styling to override body and #wrapper padding.
* Fixed menu padding issue when custom menu used
* Fixed "Trebuchet MS" font name
* Fixed issue with rgba backgrounds for menus on IE7/8
* Fixed problem with excerpts when text < excerpt limit, but had shortcodes - would not display read more message. This was an issue with core WordPress functions.
* Fixed problem on Page with Posts - specifying non-existant category would display all posts instead of none.
* Fixed issue with image captions in sidebars
* Fixed issue with %content% not displaying correctly for custom meta-lines (Pro)
* Fixed issue with Flow to Bottom and left sidebar slide-right vertical menu
* Fixed [ weaver_search ] issue with alternate button url. (Pro)

== Changes Version 1.2.7 ==
* Fixed comment popup issue

== Changes Version 1.2.8 ==
* Added Center Menu option
* Added Per Page Header Horizontal Widget Area Replacement option
* Added basic validation on colors (must be hex or rgb or color name [checks for alpha letters only]). Will detect many typos.
* Added class (< hr class="wvr-2-col-divider"/ >) for column spliter hr on 2-col page template
* Added workaround for iOS iPod/iPhone Full/Mobile switching
* Added check for PHP max_input_vars set too small - very rare host configuration problem
* Added check for wrap site with shadows without specifying #wrapper bg color - that fails on IE7/8
* Added text color for footer
* Added font size for content, widgets, footer
* Added error detection for alternate mobile theme plugins
* Added auto-support for WordPress SEO by Yoast - don't need to check "Use SEO" option
* Added ca_ES translation
* Fixed documentation for [ weaver_show_posts number=-1 ] to show all posts
* Relabeled "Site Description" to "Site Tagline" everywhere
* Changed behavior: Post Title for single page post view no longer a link - displays same as page title - this is preferred WP behavior
* Fixed handling of Page with Posts sticky posts when cat/tag filters used - sticky now works right
* Fixed - images now have an alt="desc" field for all image display
* Fixed page template loops so they always terminate properly
* Fixed Hide secondary menu on smart-mobile display
* Fixed issues on some options that treated blog pages same as front page even when they were not the front page
* Fixed some " escape issues in CSS generator
* Fixed widget margin bug - did not generate correct CSS
* Fix for "Continue Reading" with short text + image/shortcode
* Fixed 3 column blog responsive support - 3 columns switch to 1 column always on narrow devices
* Some code clean-up

== Changes Version 1.2.9 ==
* Changed wording for Mobile Theme Plugin check if Disable Mobile Support option enabled
* Fixed alt= on search form
* Fixed bug with hide image borders
* Fixed type='touch' for [ weaver_shoe/hide_if_mobile ] in responsive mode
* Added completely new Flow color to bottom code - now works on IE

== Changes Version 1.2.9.1 ==
* Fixed auto-update notice for Pro

== Changes for Version 1.2.9.2 ==
* Added class to each button on the Weaver Buttons Pro feature (Pro)
* Fixed JavaScript bug that did not recognize mobile menu threshold value of 0 correctly
* Modified Footer widget area rules for better mobile support
* Fixed bug in [ weaver_slider ] introduced when added alt= support (Pro)

== Changes Version 1.3.0 ==
* For free version, added 1.2.9.2 fixes
* Added Basic/Advanced interface modes - Basic mode hides many advanced options
* Added Masonry support for Pro - allows dynamic multi-column layout, including column spanning
* Added several new per post hide options, a new show link to single page
* Added and reorganized options for post with Post Format specified, including new compact Post Format option for posts with Post Format setting - this support photo blogs nicely
* Added float Primary and Secondary Menus Right
* Added alternative <HEAD> Section code block that survives subtheme change
* Added %author-name% to custom post meta lines (Pro)
* Added option to change "Leave a Reply" (Pro)
* Added .pre/post-nocomments and .pre/post-comments classes to Pre/Post Comments HTML areas depending if comments open
* Fixed how "Flow Color to Bottom" works - will now show dynamic sized content, but with doesn't update flow heights in that case
* Changed Multi-site behavior - now only super-admin can add <script>, but regular admin can still add <style>. Also
changed option to disable most Advanced Options HTML entry boxes to allow configuration in wp-config.php now.
* Removed "Chat" post format - it never really worked as expected
* Added documentation about using alternative mobile theme plugins
* Replaced screen shot for new WP standard size
* Moved "Hide Subtheme Thumbs" to Subtheme Tab from Admin Options
* Unified menu current-page styling for main, and sidebar pop-left/right menus, and vertical menus
* Removed old options from menu - they've been gone a while now...
* Fixed: Will no longer allow only blank for text option value - auto fixes to null
* Fixed bug with tagline max-width
* Fixed issue with Pro Slider non-sliding menu image width
* Fixed some RTL issues: hide comment bubble, move menus to right (rtl:left), 2 col, pop-left/right menus
* Technical tweak: made sure all functions in functions.php are pluggable/filters/actions for child themes
* Technical tweak: changed JavaScript and main .css loads to use Weaver II's version number
* Technical tweak: added .cf (clearfix) class to handle float clearing
* Some code optimizations

== Changes Version 1.3.1 ==
* minor bug fix - free version only

== Changes Version 1.3.2 ==
* Added automatic support for Woo Commerce plugin
* Upgraded support for WP 3.6 Post Format Types
* Fixed some mobile post title and other content styling rules - removed !important on some
* Fixed Masonry invoke script
* Fixed !important on current_page rules.

== Changes Version 1.3.3 ==
* Tweaked Menu Bar Shadow styling
* Fixed settings database name filter
* Fixed Extra Menu horizontal menu layout (Pro)
* One more tweak to color flow - seems very solid now! (Pro)
* Added border-box rule for better img centering
* Added new Slider Menu options for better automatic mobile device support (Pro)
* Fixed bug with layout on 2 and 3 column blog pages (both default and page with posts)
* Fixed Show Footer Widgets for non-stacked mobile view (Pro)
* Fixed bug with RAW display on static page using [weaver_show_posts]
* Fixed bug in chat post format

== Changes Version 1.3.4 ==
* Fixed auto-hide menu issue for Pro Slider Menu

== Changes Version 1.3.5 ==
* Note: some 1.3.5.x versions were released at WeaverTheme.com, but 1.3.5 not released on WP.org

== Changes Version 1.3.6 ==
* Added "Always Show Featured Image on Blog" option
* Added "Disable All Shortcodes"
* Added show only "nth" post option to [ weaver_show_posts ]
* Added "title + first image" option for regular posts on Page with Posts template
* Added option to not generate #weaver-final div for some compatibility issues
* Added Download/Upload to Your Computer functionality to Weaver II without Extras Plugin
* Added detection and conversion of settings to Aspen Theme
* Added auto-switch to Weaver II Admin after Activate theme
* Added support for comments on Page with Posts - after posts - must enable on Content Areas : Comments section
* Improved Woocommerce support - see Help document for options
* Clarified message for special plugin_replacement sidebar
* Fixed default border color for FI (CSS change)
* Fixed mobile menu threshold if 0 issue
* Fixed new page as target for slider menu
* Fixed non-Mansonry multi-column blog layout
* Fixed stray < /a > in FullView icon html
* Fixed Hide Menu on Desktop for IE7/IE8
* Cleanup of <label>s
* Updated Mootools js library to new version

== Changes Version 1.3.7 ==
* Added clear:both at end of #main
* Added checks when trying to save options after admin login has expired
* Added paged=true/false arg for [ weaver_show_posts ] for paging

== Changes Version 1.3.8 ==
* Tweaked widget img auto height (and #ie8 auto width)
* Tweaked Weaver II -> Aspen conversion
* Fixed 'last_option' check

== Changes Version 2.0 ==
* MOST SIGNIFICANT CHANGE: Removed shortcodes from Weaver II Free - functionality now in Weaver II Theme Extras
* Weaver II Pro still includes all shortcodes, plus now has previous functionality of Weaver II Theme Extras (Pro)
* Added 'Show Header Actual Size' option for header image, including center/left/right positioning
* Added 'weaver_nav' action (advanced feature for child themes)
* Added new security measures
* Added BG color box to all HTML Insertion areas
* Header Widget Area totally redesigned - uses div instead of table model. Makes images be correct size.
* Made Hide/Show of Header Widget Area on mobile/desktop use responsive rules instead of smart mobile rules
* Changed styling for header image - height and width specifications reflect actual image size
* Changed header image options to "Suggested" values to more closely match the way header images work now
* Removed obsolete Title over Header options dating back to Weaver I 2.x
* Reorderd some Menu options - moved some Primary Menu options to Layout section from Extras
* Fixed CSS+ box display rows
* Fixed show="full" in [ weaver_show_posts ]
* Fixed shadow display for top menu
* Default fixed menu bar gradient removed from mobile menu - it was sized incorrectly.
* Weaver II Free shortcode help now on theme admin Shortcodes/Plugins tab, not extra Appearance menu
* Updated Check for Errors checking
* Updated Weaver II admin styling
* Changed assistive-text link (#sidebar_primary)
* Fixed IE10/Win8 touch menu issue
* Fixed rgba mapping for IE8 menus
* Fixed some #ie7 menu styling rules
* Fixed italic menus
* Changed hgroup to div for new HTML5 standards compliance
* Added 'Actions and Filters' code block to < HEAD > section (Pro)
* Added new wide header/footer/main areas (Pro)
* Fixed center menu to not center vertical sidebar menu also (Pro)
* Fixed missing Edit button for custom meta line on single page (Pro)
* Added 'weaverii-social-dir' filter for name of social icons directory (Pro)

== Changes Version 2.0.1 ==
* Added 'title_list' to show option for [ weaver_show_posts ]
* Added show featured image above title: pages, posts, single
* Fixed styling for search and other content in menu bar with gradient
* Fixed post format font spec (Pro)
* Fixed gradient menu on IE7/8
* Fixed missing Edit link on blank page template
* Tweaked some style.css and style-minimal.css rules
* Changed handling of menu shadow using z-index now

== Changes Version 2.0.2 ==
* Fixed Header Widget Area Height option
* Fixed Title + FI Page With Posts styling to clear:both;
* Added new easy installer for Weaver II Theme Extras
* Tweaked WP's content width setting (affected large images)
* Tweaked weaverii_fi_pre_title/weaverii_use_fi_in_content for child theme compatibility

== Changes Version 2.1 ==
* Pro version now uses Weaver II Theme Extras, same as Free (Pro)
* Changed file i/o handling - changed php file locations
* Fixed some current page ancestors highlighting issues for categories, etc.
* Added .mobile-home-link class for mobile home button
* Added Weaver II # orange "logo"

== Changes Version 2.1.1 ==
* Fixed PHP/WP3.7 issue with get_post call

== Changes Version 2.1.2 ==
* Improved Reading:Posts page warning message, added info note for front page
* Fixed generated CSS for image borders to include Author Bio avatar
* Added more intelligent title labels for archive.php
* Changed Quick Cache documentation info - Quick Cache now requires Weaver II Theme Extras
* Fixed left margin for [weaver_extra_menu] (Pro)
* Added responsive-layout for new WP 3.8 tag filter

== Changes Version 2.1.4 ==
* Starting with the version, versions released on WordPress.org will have even version number
* Added Finnish
* Added support for ATW Show Posts Filters for Page with Posts
* Added option to disable Header Widget Area clipping to allow extra menu.
* Fixed do_excerpt pluggable typo
* Fixed Hide Posted On issue - required updating all language translation files
* Fixed attachment published date styling bug
* Fixed current-menu styling bug in generated CSS
* Fixed issue with FI before title and [weaver_show_posts]
* Fixed comment bubble when move bottom meta info to top

== Changes Version 2.1.6 ==
* Fixed Hide Front Page/Non-Front Page option for injection areas - BG/CSS+ not being hidden
* Tweaked top margin for reply to reply comment styling
* Added use menu 3-bar icon for mobile menus
* Tweaked theme JS loading
* Switched to WP Masonry lib
* Fixed TinyMCE editor styling for WP3.9
* Tweaked recommended plugins messages so admins only
* Add migration messages for <HEAD> Section prior to 3.9

== Changes Version 2.1.8 ==
* Fixed bottom gradient value if not set when top is
* Fixed problem with change in Yoast breadcrumbs handling
* Tweaked upgrade to new version check
* Added 'weaverii_use_mobile' filter for type

== Changes Version 2.1.10 ==
* Tweaked upgrade checking
* Added nag for Backup Theme options

== Changes Version 2.1.12 =
* Added FitVids responsive auto-sizing (when used with Weaver II Theme Extras)
* Fixed RTL editor styling
* Changed attachment image to 'large'
* Removed pubdate from <time> styling
* Removed Pro label from Mobile menu option
* Changed how "Allow Raw HTML and scripts" works
* Fixed mobile icon menu option
