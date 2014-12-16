=== Really Simple Gallery Widget ===
Contributors: helen
Donate link: http://helen.wordpress.com/donate/
Tags: gallery, widget
Requires at least: 2.8
Tested up to: 3.5
Stable tag: 1.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Simple widget for displaying images from the Media Library with plenty of configurable options.

== Description ==

Really Simple Gallery Widget adds a widget to display images from the Media Library, no extra uploading or creating custom post types required. You can choose to show images from a specific post/page, the entire media library, or a specific set of attachment IDs. On single pages/posts, you can also show only images attached to the item currently being viewed. Especially helpful if your galleries are based on what's attached to a post and you want to be able to easily display those images in a widget area.

= Features =
* Add as many widgets as you want, wherever you want
* Display images from a specific post/page, the entire Media Library, or a specific set of attachment IDs
* Display images from the post/page currently being viewed
* Select a number of images
* Select any registered size in WordPress
* Display the images in various orders
* Show or hide captions
* Link the images to the original file, post, anchor in the post, attachment page, or nothing. NOTE: If the image is not attached to a post, the file link will be used instead of the post or anchor in the post.
* Add a prefix to the link and image title (appears as a tooltip)
* Use a rel attribute for the link - great for lightboxes

== Installation ==

Really Simple Gallery Widget is most easily installed automatically via the Plugins tab in your blog administration panel.

= Manual Installation =

1. Upload the `really-simple-gallery-widget` folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Head over to Appearance &rarr; Widgets to set up one or more Really Simple Gallery Widgets

== Frequently Asked Questions ==

= How does this work with the new-style galleries introduced in WP 3.5? =
For the time being, galleries that use the ids parameter (similar to the already-existing include parameter) will not influence the widget unless you copy-paste the list of IDs and use the Attachment IDs option. Old style galleries that would just use the `[gallery]` shortcode will work as expected, as will images attached/uploaded to a post. This has to do with how attachments work in WordPress, which is the basis for this plugin. New-style galleries no longer depend on attachments to a specific post.

= Why won't images I've hotlinked or copy-pasted into my content appear? =
This widget can only grab images that were uploaded into your Media Library. See the [WordPress Codex](http://codex.wordpress.org/Using_Image_and_File_Attachments#Attachment_to_a_Post "WordPress Codex") for more information.

= Why is the wrong kind of link being used? =
The image is probably not associated with a post or page and will default to linking to the file if a link option is chosen. To associate (attach) an image with a post or page, go to your Media Library and click on the Unattached link next to the item to choose a post to attach it to. See the [WordPress Codex](http://codex.wordpress.org/Using_Image_and_File_Attachments#Attachment_to_a_Post "WordPress Codex") for more information. The link behavior can be altered via filter.

= How do I get the ID for the post or page? =
The easiest way is to mouseover or click an edit link for the post or page in question. The ID number will appear in the URL; e.g. `http://yoursite.com/wp-admin/post.php?post=41&action=edit` indicates that the ID of the post or page you want to reference is 41.

= Why is the anchor link not working? =
The anchor link relies on the ID that WordPress automatically generates when you insert an image with a caption. If you inserted the image manually or without a caption, the anchor won't jump you to the spot in the page. The ability to specify an anchor may be added at a later time, or you can just add the ID (attachment_##) to the img tag.

= I selected a registered size but the images are showing up huge or in the wrong size. =
The images may be missing the thumbnails of that size and by default will pull the full size image instead. Try using Viper007Bond's fantastic [Regenerate Thumbnails](http://wordpress.org/extend/plugins/regenerate-thumbnails/ "Regenerate Thumbnails") plugin to create new versions for any new or changed image sizes.

= How can I make the widget look prettier? =
See [Styling the Really Simple Gallery Widget](http://helen.wordpress.com/2011/02/styling-the-really-simple-gallery-widget/ "Styling the Really Simple Gallery Widget") for more information and some examples of what you might do.

== Screenshots ==

1. Widget options
2. Sample display in Twenty Twelve with minimal styling added for spacing

== Changelog ==

= 1.3 =
* Fixed a bug caused by assuming that image sizes are named key-style.
* Added two actions: `rsgw_before_widget` and `rsgw_after_widget`.

= 1.2 =
**Fixed**

* Caption no longer always shows the one for the last image queried.
* Can now be used on custom post types.

**New**

* Mostly rewritten code - no notices, cleaner with coding standards, more sane data sanitization.
* More intuitive interface for specifying where to select images from, including a new option to specify image attachment IDs
* Additional option for what to order by.
* Text before link title and link rel attribute are hdiden under "Advanced Options" to reduce some of the visual weight of the widget options.
* Better markup - now using dl/dt/dd, with filterable classes. The original classes should remain, but styling may change or break depending on how your CSS was written.

**Filters!**

* `rsgw_from_options`
* `rsgw_order_options`
* `rsgw_orderby_options`
* `rsgw_link_type_options`
* `rsgw_image_size_options`
* `rsgw_instance_defaults`
* `rsgw_query_args`
* `rsgw_images`
* `rsgw_dl_class`
* `rsgw_dt_class`
* `rsgw_dd_class`
* `rsgw_image_link_url`

= 1.1 =
* New options for entire media library and single post/page
* HTML output cleanup
* Better security
* Smaller memory footprint (hopefully)

= 1.0 =
* First version

== Upgrade Notice ==

= 1.2 =
Major update - bugs fixed, features added. You may need to tweak any custom styling.

= 1.1 =
More display options
