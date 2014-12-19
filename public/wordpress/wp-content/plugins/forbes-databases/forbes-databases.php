<?php
/**
 * Plugin Name: Forbes Databases
 * Description: Adds a custom post type 'Forbes Databases'. To include a list of databases on a page use the shortcode [forbes_database_list], optionally with the research_area parameter, e.g. [forbes_database_list research_area="business"].
 * Version: 0.1
 * Author: Benjamin Kalish
 */

require_once( dirname( __FILE__ ) . '/helpers.php' );
require_once( dirname( __FILE__ ) . '/shortcodes.php' );

// action hooks
add_action('init',           'fobres_databases_init');
add_action('add_meta_boxes', 'forbes_databases_add_meta_boxes');
add_action('save_post',      'forbes_databases_save_details');
add_action('manage_forbes_databases_posts_custom_column', 'forbes_databases_custom_columns');
add_action('admin_head', 'forbes_databases_admin_css' );
add_action('wp_head', 'forbes_databases_public_css');
add_action('dashboard_glance_items', 'forbes_databases_add_glance_items');

// filter hooks
add_filter('manage_forbes_databases_posts_columns', 'forbes_databases_manage_columns');
add_filter('single_template', 'forbes_database_single_template');

// shortcode hooks
add_shortcode( 'forbes_database_list', 'forbes_database_list_shortcode_handler' );
add_shortcode( 'forbes_database_feature', 'forbes_database_feature_shortcode_handler' );
add_shortcode( 'forbes_database_select', 'forbes_database_select_shortcode_handler' );


/**
 * Registers the custom post type forbes_databases and the custom taxonomy research-area.
 *
 * @wp-hook init
 */
function fobres_databases_init() { 
  $labels = array(
    'name' => _x('Forbes Databases', 'post type general name'),
    'singular_name' => _x('Database', 'post type singular name'),
    'add_new' => _x('Add New', 'portfolio item'),
    'add_new_item' => __('Add New Forbes Database'),
    'edit_item' => __('Edit Forbes Database'),
    'new_item' => __('New Forbes Database'),
    'view_item' => __('View Database Page'),
    'search_items' => __('Search Forbes Databases'),
    'not_found' =>  __('Nothing found'),
    'not_found_in_trash' => __('Nothing found in Trash'),
    'parent_item_colon' => ''
  );
  
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' =>  true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_position' => 5, // admin menu appears after Posts but before Media
    'supports' => array('title','editor','thumbnail')
  ); 
  
  register_post_type( 'forbes_databases' , $args );
  register_taxonomy("research-area", array("forbes_databases"), array("label" => "Research Areas", "singular_label" => "Research Area", 'hierarchical'=>True, 'show_ui'=>True));

}


/**
 * Adds custom fields to the forbes_databases edit page.
 *
 * @wp-hook add_meta_boxes
 */ 
function forbes_databases_add_meta_boxes(){
  require_once( dirname( __FILE__ ) . '/admin.php' );
  add_meta_box("database-availability-meta", "Database Availability", "forbes_databases_editbox_database_availability", "forbes_databases", "side", "high");
  add_meta_box("database-url-meta", "Database URL", "forbes_databases_editbox_database_urls", "forbes_databases", "side", "high");
}

/**
 * Save custom fields from forbes_databases edit page.
 *
 * @wp-hook save_post
 */
function forbes_databases_save_details(){
  global $post;
 
  update_post_meta($post->ID, "database_main_url", $_POST["database_main_url"]);
  update_post_meta($post->ID, "database_home_use_url", $_POST["database_home_use_url"]);
  update_post_meta($post->ID, "database_availability", $_POST["database_availability"]);
}

/**
 * Adds custom CSS to admin pages.
 *
 * @wp-hook admin_head
 */
function forbes_databases_admin_css() {
  ?>
  <style>
    #database-url-meta label { display:block; margin-top:1em; }
    #database-url-meta label:first-child { margin-top: 0; }
    .column-research-area { width: 8em; }
    .column-uam_access { width: 8em; } /* this column created by User Access Manager plugin */
  </style>
  <?php
}

/**
 * Adds custom CSS to public pages.
 *
 * @wp-hook wp_head
 */
function forbes_databases_public_css() {
  ?>
  <style>
    #content .forbes_databases_database_unavailable { color:#888; }
    #content .forbes_databases_database_unavailable span { font-size:small; }
    #content .forbes_databases_availability_text { font-style:italic; color:#555; }
    #content .forbes_databases_availability_text a { font-weight:bold; }
    .ico_in-library, .ico_state-wide, .ico_cwmars, .ico_bpl-ecard, .ico_forbes-card, .ico_anywhere {
      display: inline-block;
      background-image: url(<?php echo plugins_url('img/database-availability.png',__FILE__ )?>);
      background-repeat: no-repeat
    }

    .ico_in-library {
      background-position: -0px -0px;
      height: 69px;
      width: 64px
    }

    .ico_state-wide {
      background-position: -64px -0px;
      height: 64px;
      width: 64px
    }

    .ico_cwmars {
      background-position: -128px -0px;
      height: 64px;
      width: 64px
    }

    .ico_bpl-ecard {
      background-position: -0px -69px;
      height: 64px;
      width: 64px
    }

    .ico_forbes-card {
      background-position: -64px -69px;
      height: 64px;
      width: 64px
    }

    .ico_anywhere {
      background-position: -128px -69px;
      height: 64px;
      width: 64px
    }
  </style>
  <?php
}

/**
 * Outputs the contents of each custom column on the forbes_databases admin page.
 *
 * @wp-hook manage_forbes_databases_posts_custom_column
 */
function forbes_databases_custom_columns($column){
  global $post;
 
  switch ($column) {
    case "description":
      the_excerpt();
      break;
    case 'research-area':
      echo implode(', ', wp_get_post_terms($post->ID, 'research-area', array("fields" => "names")));
      break;
  }
}

/**
 * Customizes the columns on the forbes_databases admin page.
 *
 * @wp-hook manage_forbes_databases_posts_columns
 */
function forbes_databases_manage_columns($columns){
  $columns = array_merge( $columns, array(
    'title' => 'Database Title',
    'research-area' => 'Research Area',
    'description' => 'Description',
  ));
 
  return $columns;
}

/**
 * Use a special template for showing a single fobres_database on a page.
 *
 * @wp-hook single_template
 */
function forbes_database_single_template($template){
  global $post;
  
  if ($post->post_type == 'forbes_databases') {
     $template = dirname( __FILE__ ) . '/single-forbes-database.php';
  }
  return $template;
}

/**
 * Add information about forbes_databases to the glance items.
 *
 * @wp-hook dashboard_glance_items
 */ 
function forbes_databases_add_glance_items() {
  $pt_info = get_post_type_object('forbes_databases');
  $num_posts = wp_count_posts('forbes_databases');
  $num = number_format_i18n($num_posts->publish);
  $text = _n( $pt_info->labels->singular_name, $pt_info->labels->name, intval($num_posts->publish) ); // singular/plural text label
  echo '<li class="page-count '.$pt_info->name.'-count"><a href="edit.php?post_type=forbes_databases">'.$num.' '.$text.'</li>';
}
