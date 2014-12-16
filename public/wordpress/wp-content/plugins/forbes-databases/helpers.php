<?php
/**
 * Helper functions for the Forbes Databases plugin.
 */


/**
 * Returns the URL of the availability icon.
 */
function forbes_databases_get_availability_icon($post) {
  $custom = get_post_custom($post->ID);
  $availability = $custom["database_availability"][0];
  return '<span class="forbes_database_availability_icon ico_' . $availability . '"> </span>';
}

/**
 * Returns a statement about the availability and funding source of the database.
 */
function forbes_databases_get_availability_text($post) {
  $custom = get_post_custom($post->ID);
  $availability = $custom["database_availability"][0];
  switch ($availability) {
    case 'state-wide':
      $text = "Free for all Massachusetts residents. Provided by the Massachusetts Board of Library Commissioners and the Massachusetts Library System.";
      break;
    case 'cwmars':
      $text = "Free with any C/W MARS library card, and provided by the C/W MARS library network.";
      break;
    case 'forbes-card':
      $text = "Provided by Forbes Library. Remote access requires a Forbes Library card.";;
      break;
    case 'bpl-ecard':
      $text = 'Provided by the Boston Public Library and available for free with a BPL eCard. Individuals who live in, own property in, or commute to work in Massachusetts may <a href="https://www.bpl.org/contact/form_ecard.php">register for an eCard.</a>';
      break;
    case 'in-library':
      $text = "Provided by Forbes Library and available for use in the library.";
      break;
  }
  return $text;
}

/**
 * Is the database inaccessible to the user?
 *
 * Returns TRUE for remote users if the database is in library use only.
 */
function forbes_databases_is_inaccessible($post) {
  $custom = get_post_custom($post->ID);
  $availability = $custom["database_availability"][0];
  if ($availability == 'in-library' && !forbes_databases_user_in_library()) {
    return TRUE;
  }
  return FALSE;  
}

/**
 * Does the database require a BPL card?
 *
 * Returns TRUE for remote users if the database is provided by BPL.
 */
function forbes_databases_requires_bpl_card($post) {
  $custom = get_post_custom($post->ID);
  $availability = $custom["database_availability"][0];
  if ($availability == 'bpl-ecard') {
    return TRUE;
  }
  return FALSE;  
}

/**
 * Is the user in the library?
 */
function forbes_databases_user_in_library() {
  $in_library_ip_addresses = array(
    '75.144.185.90',
    '24.128.105.221',
    '173.162.229.229'
  );
  $remote_address =  $_SERVER['REMOTE_ADDR'];
  return in_array($remote_address, $in_library_ip_addresses);
}

/**
 * Returns the URL needed to access the database.
 *
 * The URL returned will be the home use url if and only it has been
 * defined and the user is outside of the library.
 */
function forbes_databases_get_database_url($post) {

  $custom = get_post_custom($post->ID);
  $database_main_url = $custom["database_main_url"][0];
  $database_home_use_url = $custom["database_home_use_url"][0];
  $database_availability = $custom["database_availability"][0];
  if ($database_home_use_url && !forbes_databases_user_in_library()) {
     return $database_home_use_url;
  }
  return $database_main_url;
}

/**
 * Returns a simple HTML rendering of the database.
 */
function forbes_databases_display($post) {
  ob_start();?>
  <article id="post-<?php the_ID(); ?>" class="forbes_databases post hentry">
    <?php if (forbes_databases_is_inaccessible(get_post())): ?>
    <h2 class="entry-title forbes_databases_database_unavailable">
      <?php echo forbes_databases_get_availability_icon($post); ?>
      <?php the_title(); ?>
      <span> (available in library)</span>
    </h2>
    <?php else: ?>
    <h2 class="entry-title">
      <a href="<?php echo forbes_databases_get_database_url($post); ?>">
      <?php echo forbes_databases_get_availability_icon($post); ?>
      <?php the_title(); ?>
      <?php if (has_post_thumbnail( $post->ID )) {
        $image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail');
        $feature_image_url = $image_attributes[0];
        echo "<img src=\"$feature_image_url\" class=\"forbes_database_feature_icon\">";
    }?>
    </a>
    </h2>
    <?php endif; ?>
  <div class="entry-content">
    <?php echo apply_filters('the_content', $post->post_content); ?>
    <?php $availability_text = forbes_databases_get_availability_text($post);
    if ($availability_text) { echo '<p class="forbes_databases_availability_text">' . $availability_text . '</p>'; } ?>   
  </div>
  <?php if (is_user_logged_in()): ?>
    <footer class="entry-utility"><span class="edit-link"><?php edit_post_link('Edit Database'); ?></span></footer>
  <?php endif; ?>
  </article><?php
  return ob_get_clean();
}

/**
 * Returns a wp_query object for the passed shortcode attributes.
 */
function forbes_databases_query($atts) {
  extract( shortcode_atts( array(
    'research_area' => null,
    'exclude_free' => null,
  ), $atts ) );

  $query_args = array(
    'post_type' => 'forbes_databases',
    'orderby' => 'title',
    'order' => 'ASC',
    'posts_per_page'=>-1,
    );
  
  if ($research_area) {
    $query_args['tax_query'] = array( array('taxonomy' => 'research-area', 'field'=>'slug', 'include_children'=>FALSE, 'terms' => $research_area) );
  }

  if ($exclude_free) {
    $query_args['meta_query'] = array( array('key' => 'database_availability', 'value'=>'anywhere', 'compare'=>'!=') );
  }
  
  $the_query = new WP_Query( $query_args );
  
  return $the_query;
}
