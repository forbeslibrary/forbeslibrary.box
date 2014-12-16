=== Weaver II Theme Extras ===
Contributors: Bruce Wampler
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Tags: weaver theme, settings, save, subthemes
Requires at least: 3.5
Tested up to: 3.7
Stable tag: 2.1.10

== Description ==

This plugin provides several enhancements for the Weaver II theme.

= Shortcode Support for Weaver II =

Beginning with Weaver II 2.0, integrated shortcode support is no longer provide with the theme, but is included with this plugin. This version of the plugin remains compatible with previous versions of Weaver II Free and Weaver II Pro.

Shortcodes supported include:

    * Show Posts - [weaver_show_posts] - This shortcode allows you to display posts on any page or text area, and provides extensive filtering options. A perfect companion for the Page with Posts template. This shortcode is an essential part of building sites with Weaver II.
    * Breadcrumbs - [weaver_breadcrumbs]
    * Header Image - [weaver_header_image]
    * HTML - [weaver_html]
    * DIV - [div]text[/div]
    * SPAN - [span]text[/span]
    * iFrame - [weaver_iframe]
    * Blog Page Navigation - [weaver_pagenav]
    * Show If Mobile - [weaver_show_if_mobile]
    * Hide If Mobile - [weaver_hide_if_mobile]
    * Show If Logged In - [weaver_show_if_logged_in]
    * Hide If Logged In - [weaver_hide_if_logged_in]
    * Site Title - [weaver_site_title]
    * Site Tagline - [weaver_site_desc]
    * Vimeo - [weaver_vimeo]
    * YouTube - [weaver_youtube]

= Add-on Themes =

This plugin also allows you to upload and install new, add-on subthemes. There are free add-on subthemes available
at http://weavertheme.com.

All add-on subthemes will work with both the free Weaver II theme, and with Weaver II Pro.

= Theme Updating =

Because WordPress does not allow you to update a theme you've installed by upload (instead of directly from
WordPress.org), in the past updating Weaver II Pro required using the "Easy Theme and Plugin Update" plugin.
While that will still work, you can now update Weaver II Pro (or even Weaver II downloaded directly from
WeaverTheme.com) easily from the download using this Theme Extras plugin. There is a new option added near
the bottom of the Save/Restore admin tab that will let you easily and quickly upgrade Weaver II Pro.

= Quick Cache Support =

Beginning with version 2.1.1, Weaver II Theme Extras adds automatic support for the latest version of Quick
Cache. Weaver II + Quick Cache will now work together automatically to cache all visits, including desktops
and all mobile devices.

== Installation ==

It is easiest to use the Plugin Add Plugin page, but you can do it manually, too:

1. Download the plugin archive and expand it
2. Upload the weaver-ii-theme-extra.php file to your wp-content/plugins/weaver-ii-theme-extras directory
3. Go to the Plugins page in your WordPress Administration area and click 'Activate' for Weaver II Theme Extras.

== Frequently Asked Questions ==

= Will I lose all my settings and design work if I update? =

All of your Weaver II settings are saved in the WordPress database. Updating a theme (or plugin, for that matter)
usually involves only replacing the theme's files on the /wp-content/themes/weaver-ii directory. None of your
settings will be touched. Of course, it is always a good idea to have recent backups of your settings - either
by using the Save Theme Settings button to save a copy in the WordPress database, or using one of the other options
to save a copy on your own computer, or is a save file on your host's filesystem.

= What is the difference between a theme save, and a theme backup file? =

Weaver II supports two kinds of theme save files - .w2t and .w2b. A subtheme-only backup (.w2t) saves the settings that
are really associated with the appearance of any site using the subtheme settings. This doesn't include site
specific settings, such as the Favicon, the SEO strings, and so on. A full theme setting backup (.w2b) will save
every setting - including settings that apply just to the specific site. Items that are saved only in the full
backup save are marked with a diamond in the admin options pages.


== Changelog ==

== 2.2.10 ==
* Fixed video centering/percent issue
* Added support for new WordPress standards for <HEAD> Section option.

== 2.1.8 ==
* Added FitVids support. Ratio now automatic.
* Fixed video center option

== 2.1.4 ==
* Fixed Quick Cache detection bug - did not change how it worked, just detect message

== 2.1.2 ==
* Added automatic support for Quick Cache
* Refactored some code to load only at admin time

= 2.1.1 =
* Fixed clear=1 option for [weaver_show_posts]

= 2.1 =
* Added support for Weaver II Pro

= 2.0 =
* Added Weaver II shortcode support via this plugin

= 1.3 =
* Save/Upload theme to your computer removed from plugin - now included in all Weaver II versions

= 1.2 =

* Added Add-on Theme support
* Added self-update to Save/Restore tab

= 1.0 =

First release.
