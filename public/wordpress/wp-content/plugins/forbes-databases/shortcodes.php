<?php
/**
 * Shortcodes for the Forbes Databases plugin.
 */
 
/**
 * A shortcode for listing forbes_databases.
 *
 * @wp-hook add_shortcode forbes_database_list
 */
function forbes_database_list_shortcode_handler( $atts, $content = null ) {
  if (is_search()) { return ''; }
  $the_query = forbes_databases_query($atts);
  
  ob_start(); 
  if ( $the_query->have_posts() ) {
    while ( $the_query->have_posts() ) {
      $the_query->the_post();
      echo forbes_databases_display(get_post());
    }
  } else {
    echo 'no databases found';
  }
  wp_reset_postdata();

  return ob_get_clean();
}

/**
 * This shortcode creates a select menu of database titles.
 *
 * @wp-hook add_shortcode forbes_database_list
 */
function forbes_database_select_shortcode_handler( $atts, $content = null ) {
  if (is_search()) { return ''; }
  $the_query = forbes_databases_query($atts);
  
  $menu_data = array();

  if ( $the_query->have_posts() ) {
    while ( $the_query->have_posts() ) {
      $the_query->the_post();
      $menu_option = array(
        'title' => get_the_title(),
        'url' => forbes_databases_get_database_url(get_post()),
      );
			if (forbes_databases_requires_bpl_card(get_post())) {
			  $menu_option['title'] = $menu_option['title'] . ' (with BPL eCard)';
			}
      if (forbes_databases_is_inaccessible(get_post())) {
        $menu_option['title'] = $menu_option['title'] . ' (available in library)';
        $menu_option['disabled'] = TRUE;
      }
      array_push($menu_data, $menu_option);
    }
  }
  wp_reset_postdata();

  ob_start();?>
  <div id="forbes_databases_nav"></div>
  <script>
  jQuery("#forbes_databases_nav").append('<label for="forbes_databases_select">Database Quick Access</label>');
  jQuery("#forbes_databases_nav").append('<select id="forbes_databases_select"><option>—Select a Database—</option></select>');
  options = jQuery.map(JSON.parse('<?php echo json_encode($menu_data); ?>'), function( value, index ) {
     option = jQuery('<option></option>');
     option.html(value.title);
     option.attr('value',value.url);
     if (value.disabled) { option.attr('disabled','disabled'); }
     return option;
  });
  jQuery("#forbes_databases_select").append(options);
  jQuery("#forbes_databases_select").change(function() {
    window.location = jQuery("#forbes_databases_select option:selected").val();
  });
  </script>
  <?php

  return ob_get_clean();
}

/**
 * A shortcode for displaying featured databases.
 *
 * This is a work in progress and does very little currently.
 *
 * @wp-hook add_shortcode forbes_database_feature
 */
function forbes_database_feature_shortcode_handler( $atts, $content = null ) {
  $the_query = forbes_databases_query($atts);
  
  $featured_posts = array();
  
  if ( $the_query->have_posts() ) {
    while ( $the_query->have_posts() ) {
      $the_query->the_post();
      if (has_post_thumbnail(get_post()->ID)) {
        array_push($featured_posts,get_post());
      }
    }
  }
  
  ob_start();
  ?>
  <a href="<?php echo get_permalink( $featured_posts[0]->ID ) ?>">
      <?php echo get_the_post_thumbnail( $featured_posts[0]->ID ); ?>
  </a><?php

  return ob_get_clean();  
}

