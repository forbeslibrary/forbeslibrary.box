<?php
/**
 * Plugin Name: Wowbrary
 * Description: Allows easy embedding of the Wowbrary widget using shortcodes and allows the widget to be dynamically resized.
 * Version: 0.1
 * Author: Benjamin Kalish
 */
 
 add_shortcode( 'wowbrary', 'wowbrary_shortcode_handler' );
 
 function wowbrary_shortcode_handler( $atts, $content = null ) {
  $atts = shortcode_atts( array(
    'container' => NULL,
    'library' => '6594', // Forbes Library
    'providertype' => 'contentcafe',
    'provideraccount' => 'EBSCO2',
    'password' => 'CWMARS',
    'providertype' => 'contentcafe',
    'width' => '1000',
    'height' => NULL,
    'imagesize' => NULL,
    'imagescale' => NULL,
    'spacing' => NULL,
    'speed' => NULL,
    'pause' => NULL,
    'captionflip' => NULL,
    'category' => NULL,
    'noelectronic' => NULL,
    'count' => NULL,
    'borderstyle' => NULL,
    'background' => NULL,
    'headingtext' => NULL,
    'headingstyle' => NULL,
    'titlestyle' => NULL,
    'motion' => NULL,
    'notitles' => NULL,
    'buttonheight' => NULL,
    'buttoncolor' => NULL,
    'buttonstyle' => NULL,
    'buttontextcolor' => NULL,
    'buttonsymbolcolor' => NULL,
    'buttonpath' => NULL,
    'target' => NULL,
    'reverse' => NULL,
    'sidearrows' => NULL,
    'debug' => NULL,
    ), $atts );
    
  $container_selector = $atts['container'];
  unset($atts['container']);
    
  $widget_url = "http://wowbrary.org/widgetslider.aspx?" . http_build_query($atts, '', '&amp;');
    
  ob_start(); ?> 
<!--Wowbrary Widget Start-->
<div id="wowbrary">
<script src="<?php echo $widget_url; ?>"  type="text/javascript"></script>
<script>
jQuery(document).ready( function($) {
   $("#wowbrary>table").addClass("plain"); 
   function setTableWidth() {
      $("#wowbrary>table").width($("<?php echo $container_selector; ?>").width());
      $("#wowbrary>table tr").width($("<?php echo $container_selector; ?>").width());
      $("#wowbrary>table div").width($("<?php echo $container_selector; ?>").width());
   }
   setTableWidth();
   $("#wowbrary>table tr:nth-child(4)>td").css("text-align","center"); 
   $("#wowbrary>table tr:nth-child(5)>td").css("text-align","center");
   $(window).resize( function() {
     setTableWidth();
   } );
});
</script>
</div>
<!--Wowbrary Widget End--><?php
  return ob_get_clean();
}
