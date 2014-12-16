<?php
/**
 * Plugin Name: Embedded omeka
 * Description: Allows easy embedding of an Omeka Site. Currently hardcoded for Forbes Library's Omeka Installation.
 * Version: 0.1
 * Author: Benjamin Kalish
 */
  
 add_shortcode( 'embed_omeka', 'embed_omeka_shortcode_handler' );
 
 function embed_omeka_shortcode_handler( $atts, $content = null ) {
    $omeka_base_url = 'images.forbeslibrary.org/';

    $this_page_url = strtok($_SERVER['REQUEST_URI'],'?');
    $query = $_GET;

    $action = $query['action'];
    unset($query['action']);

    if ($query) {
        $query_string = '?' . http_build_query($query);
    }

    $omeka_url = $omeka_base_url . $action . $query_string;
    $omeka_url = 'http://' . preg_replace('#/+#','/',$omeka_url);
    
    $DOM = DOMDocument::loadHTMLFile($omeka_url);
    $content = $DOM->getElementByID('content');
    $content->setAttribute('id','gallery-content');
    
    $anchors = $DOM->getElementsByTagName('a');
    foreach ($anchors as $anchor) {
       $href = $anchor->getAttribute('href');
	   
	   if (!string_starts_with($href, 'http://')) {
	     if (!string_starts_with($href, 'archive/')) {
		   $href = '?action=' . str_replace('?','&', $href);
		 }
	   }
	   if (string_starts_with($href, 'http://' . $omeka_base_url)) {
	     if (!string_starts_with($href, 'http://' . $omeka_base_url . 'archive/')) {
	       #$href = '?action=' . str_replace('?','&', explode('http://' . $omeka_base_url, $href)[1]);
		 }
	   }
	   
       $anchor->setAttribute('href', $href);
    }
    $forms = $DOM->getElementsByTagName('form');
    foreach ($forms as $form) {
       $action = $form->getAttribute('action');
       $url_data = explode('/omeka', $action);
       if ($url_data[1]) {
         $action = $url_data[1];
       } else {
         $action = $url_data[0];
       }
       $hidden_input = $DOM->createElement('input');
       $hidden_input->setAttribute('type', 'hidden');
       $hidden_input->setAttribute('name', 'action');
       $hidden_input->setAttribute('value', $action);
       
       $form->setAttribute('action', $this_page_url);
       $form->appendChild($hidden_input);
    }

    return $DOM->saveHTML($content);
}

function string_starts_with($haystack, $needle) {
  return (substr($haystack, 0, strlen($needle)) === $needle);
}
