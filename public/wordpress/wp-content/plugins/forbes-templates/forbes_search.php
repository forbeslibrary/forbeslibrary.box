<?php
// filter hooks
add_filter( 'query_vars', 'forbes_search_add_query_vars_filter' );

// action hooks
add_action( 'parse_query', 'forbes_search_redirect' );

/**
 * Displays a search widget
 *
 * @wp-hook add-shortcode forbes_search
 */
 function forbes_search_shortcode_handler( $atts, $content = null ) {
  $searchOpt = get_query_var( 'searchOpt' ) or $searchOpt = $_COOKIE['searchOpt'];
  if ($searchOpt == 'catalog' ) {
    $catalogSearchOpt = TRUE;
    $action = 'http://bark.cwmars.org/eg/opac/results';
    $searchName = 'query';    
   // $placeholder = 'search catalog (books, movies, music, and more...)';
  } else {
    $websiteSearchOpt = TRUE;
    $action = 'http://forbeslibrary.org/';
    $searchName = 's';
    //$placeholder = 'search website';
    
    setcookie( 'searchOpt', 'website', 0, '/' , 'forbeslibrary.org');
  }
 
 
  ob_start();
  ?> 
  <form role="search" id="searchForm" method="get" class="searchform" action="<?php echo $action?>">
    <div class="searchMain">
      <label id="searchLabel" class="screen-reader-text" for="search">Search for:</label>
      <input type="search" value="" name="<?php echo $searchName;?>" id="search" placeholder="<?php echo $placeholder; ?>" tabindex="2">
      <input class="searchformimg" type="image" src="/wp-content/themes/weaver-ii/images/search_button.gif" alt="Submit Search" tabindex="5">
    </div>
    <div class="searchOptions">
      <fieldset>
        <legend class="assistive-text">What to search</legend>
        <input id="searchOpt_website" class="inline" name="searchOpt" value="website" <?php if ($websiteSearchOpt) { echo 'checked="CHECKED"'; } ?> type="radio" tabindex="4"><label class="inline" for="searchOpt_website">Website</label>
        <input id="searchOpt_catalog" class="inline" name="searchOpt" value="catalog" <?php if ($catalogSearchOpt) { echo 'checked="CHECKED"'; } ?> type="radio" tabindex="3"><label class="inline" for="searchOpt_catalog">Catalog</label>
      </fieldset>
      <input name="locg" value="247" type="hidden"/>
      <a id="searchOpt_advanced" class="moreSearch" href="http://bark.cwmars.org/eg/opac/advanced" tabindex="6">Advanced Catalog Search</a>
    </div>
  </form>
  <script>
  /**
   * Enable the radio buttons to switch between searching the catalog or the WordPress site.
   */
  jQuery(document).ready( function($) {
    $("#search").attr("placeholder", "search website");
    $("#searchOpt_catalog").click( function() {
        $("#search").attr("placeholder", "search catalog (books, movies, music, and more...)");
        $("#search").attr("name", "query");
        $("#searchForm").attr("action", "http://bark.cwmars.org/eg/opac/results");
        document.cookie="searchOpt=catalog; path=/; domain=forbeslibrary.org";
    });
    $("#searchOpt_website").click( function() {
        $("#search").attr("placeholder", "search website");
        $("#search").attr("name", "s");
        $("#searchForm").attr("action", "http://forbeslibrary.org/");
        document.cookie="searchOpt=website; path=/; domain=forbeslibrary.org";
    });
  }) ;
  </script>
  <?php
  return ob_get_clean();
}

/**
 * Adds custom query variables so they will be recognized by wordpress
 */
function forbes_search_add_query_vars_filter( $vars ){
  $vars[] = "searchOpt";
  return $vars;
}

/**
 * Redirects search to the online catalog if needed.
 *
 * This may happen if the user does not have Javascript enabled.
 */
function forbes_search_redirect() {
  if (get_query_var( 'searchOpt' ) == 'catalog') {
    $atts = array();
    parse_str($_SERVER['QUERY_STRING'], $atts);
    $atts['query'] = $atts['s'];
    unset($atts['s']);
    header('Location: http://bark.cwmars.org/eg/opac/results?' . http_build_query($atts));
    exit();
  }
}
