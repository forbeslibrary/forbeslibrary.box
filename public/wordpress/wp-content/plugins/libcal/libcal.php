<?php
/**
 * Plugin Name: LibCal
 * Description: Allows easy embedding of the LibCal widgets using shortcodes and allows the widget to be dynamically resized.
 * Version: 0.1
 * Author: Benjamin Kalish
 */
 
 add_shortcode( 'libcal', 'libcal_shortcode_handler' );
 
 function libcal_shortcode_handler( $atts, $content = null ) {
  $atts = shortcode_atts( array(
    'institution_id' => '1448',
    'calendar_id' => '3294',
    'months' => '6',
    'target' => '_blank',
    'categories' => NULL
    ), $atts );
    
  $atts['d'] = $atts['categories'];
  unset($atts['categories']);
  
  $atts['iid'] = $atts['institution_id'];
  unset($atts['institution_id']);
  
  $atts['cid'] = $atts['calendar_id'];
  unset($atts['calendar_id']);
  
  $javascript_url = "http://forbeslibrary.libcal.com/api_events.php?m=month&context=object&format=js&" . http_build_query($atts);
  $embed_url = "http://forbeslibrary.libcal.com/api_events.php?m=month&context=object&" . http_build_query($atts);
  $div_id = "api_month_cid" . $atts['cid'] . '_iid' . $atts['iid'];
  
  ob_start(); ?> 
<!-- LibCal Widget Start -->
<script>
//<![CDATA[
jQuery(document).ready(function($) {
  jQuery.getScript("<?php echo $javascript_url; ?>", function() {
    jQuery("#th3").hide();
  });
});
//]]>
</script>

<div id="<?php echo $div_id; ?>"></div>

<noscript>
  <iframe src="<?php echo $embed_url; ?>" width="800" height="2000"><a href="<?php echo $embed_url; ?>">See events on LibCal.</a> (To see events embedded in this page please use a browser that supports javascript or iframes.)</iframe>
</noscript>
<!-- Libcal Widget End --> <?php
  return ob_get_clean();
}
