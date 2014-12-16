<?php
/**
 * Creates YouTube style cover art from a panoramic image. When the page is resized the
 * image will be cropped instead of resized.
 *
 * @wp-hook add_shortcode forbes_panorama
 */
function forbes_panorama_shortcode_handler( $atts, $content = null ) {
  extract( shortcode_atts( array(
    'src' => null,
    'href' => null,
    'height' => 200,
    'title' => null,
    'xpos' => '50%',
    'ypos' => '50%',
    'size' => 'cover',
    'border' => true,
  ), $atts ) );
  
  if ($href) {
    $tag = 'a';
  } else {
    $tag = 'div';
  }

  if ($title) {
    $caption = "<p class=\"wp-caption-text\">$title</p>";
    $title = "title=\"$title\"";
  }
  
  if ($border) {
    $border = "border: solid black 1px;";
  } else {
    $border = "";
  }

    return "<$tag $title class=\"wp-caption forbes_panorama_wrapper\" href=\"$href\"><div style=\"background-image:url('$src'); height:${height}px; background-size:$size; background-position: $xpos $ypos; margin-bottom:0.5em; $border display:block; background-repeat:no-repeat;\"></div>$caption</$tag>";
}
