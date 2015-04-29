<?php
/**
 * Admin interface for the Forbes Databases plugin.
 */

/**
 * Returns the html for the database urls box on the forbes_databases edit page.
 */
function forbes_databases_editbox_database_urls(){
  global $post;
  $custom = get_post_custom($post->ID);
  $database_main_url = $custom["database_main_url"][0];
  $database_home_use_url = $custom["database_home_use_url"][0];
  ?>
  <label>Main URL:</label>
  <input name="database_main_url" value="<?php echo $database_main_url; ?>" />
  <label>Home Use URL (if different):</label>
  <input name="database_home_use_url" value="<?php echo $database_home_use_url; ?>" />
  <?php
}

/**
 * Returns the html for the database availability box on the forbes_databases edit page.
 */
function forbes_databases_editbox_database_availability(){
  global $post;
  $custom = get_post_custom($post->ID);
  $database_availability = $custom["database_availability"][0];
  ?>
  <label for="forbes-database_availability-state-wide">Free State Wide</label>
  <input id="forbes-database_availability-state-wide" type="radio" name="database_availability" value="state-wide" <?php if ($database_availability=='state-wide'):?>checked<?php endif;?> ><br>
  <label for="forbes-database_availability-cwmars">Free With C/W Mars Card</label>
  <input id="forbes-database_availability-cwmars" type="radio" name="database_availability" value="cwmars" <?php if ($database_availability=='cwmars'):?>checked<?php endif;?> ><br>
  <label for="forbes-database_availability-forbes-card">Free With Forbes Card</label>
  <input id="forbes-database_availability-forbes-card" type="radio" name="database_availability" value="forbes-card" <?php if ($database_availability=='forbes-card'):?>checked<?php endif;?> ><br>
  <label for="forbes-database_availability-bpl-ecard">Free With BPL ECard</label>
  <input id="forbes-database_availability-bpl-ecard" type="radio" name="database_availability" value="bpl-ecard" <?php if ($database_availability=='bpl-ecard'):?>checked<?php endif;?> ><br>
  <label for="forbes-database_availability-in-library">Free In Library</label>
  <input id="forbes-database_availability-in-library" type="radio" name="database_availability" value="in-library" <?php if ($database_availability=='in-library'):?>checked<?php endif;?> ><br>
  <label for="forbes-database_availability-anywhere">Free Anywhere</label>
  <input id="forbes-database_availability-anywhere" type="radio" name="database_availability" value="anywhere" <?php if ($database_availability=='anywhere'):?>checked<?php endif;?> ><br>
  <?php
}