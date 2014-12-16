=== HTML5 Details Polyfill ===
Contributors: Joe Anzalone
Donate link: http://joeanzalone.com/plugins/html5-details-polyfill/
Tags: HTML5, details, summary, polyfill, jQuery
Requires at least: 3.0.1
Tested up to: 3.4
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Adds fallback support for the HTML5 &lt;details&gt; and &lt;summary&gt; elements in browsers that don't support them.

== Description ==

Adds fallback support for the HTML5 [&lt;details&gt; and &lt;summary&gt; elements](http://html5doctor.com/the-details-and-summary-elements/) in browsers that don't support them using [Mathias Bynens' &lt;details&gt;/&lt;summary&gt; jQuery plugin.](http://mathiasbynens.be/notes/html5-details-jquery)

Once the plugin is activated on your site, the following HTML should work in all modern browsers, even if they don't natively support the &lt;details&gt; and &lt;summary&gt; elements:

`<details>
  <summary>Click for more info...</summary>
  This is where you'd add the additional content that won't be seen until the "summary" is clicked.
</details>`

== Installation ==

Extract the zip file and drop the contents in the wp-content/plugins/ directory of your WordPress installation and then activate the plugin from the "Plugins" page.

== Changelog ==

= 1.0 =
* First public release!