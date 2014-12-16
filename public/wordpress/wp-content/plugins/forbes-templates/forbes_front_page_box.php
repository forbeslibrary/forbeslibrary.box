<?php
/**
 * Creates an attractive box for advertising content, typically used on the front page.
 *
 * @wp-hook add_shortcode forbes_front_page_box
 */
function forbes_front_page_box_shortcode_handler( $atts, $content = null ) {
  extract( shortcode_atts( array(
    'href' => null,
    'src' => null,
    'background_color' => '#ccccff',
    'background_image' => null,
    'background_stretch' => false,
    'white_text' => false,
	'height' => null,
	'content_in_box' => false
  ), $atts ) );
  
  $class = 'forbes_front_page_box';
  if ($white_text) {
    $class .= ' white_text';
  }
  if ($content_in_box) {
    $class .= ' content_in_box';
  } 
  
  if ($background_image) {
    $background_image = "background-image:url('$background_image');";
  } else {
    $background_image = '';
  }

  if ($background_stretch) {
    $background_size = "background-size:100% 100%;";
  } else {
    $background_size = 'background-size:cover; background-position:center;';
  }
  
  if ($height) {
    $height = "height:$height;";
  }
  
  $box_style = "background-color:$background_color; $background_image $background_size $height";

  ob_start();
  if ($href) {
    echo "<a href=\"$href\" class=\"$class\" title=\"$title\" style=\"$box_style\">";
  } else {
    echo "<div class=\"$class\" style=\"$box_style\">";
  }
  if ($src):
    ?><img class="forbes_front_page_box_image" src="<?php echo $src; ?>" alt="<?php echo $alt; ?>"/>
  <?php endif; ?>
  <div class="forbes_front_page_box_content"><?php echo $content; ?></div><?php
  if ($href) {
    echo '</a>';
  } else {
    echo '</div>';
  }
  return ob_get_clean();
}
