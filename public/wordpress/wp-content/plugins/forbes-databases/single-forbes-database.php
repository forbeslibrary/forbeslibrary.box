<?php
/*
Template Name: Single Forbes Database
*/
$post = get_post();

get_header();
?>
<div id="content">
<?php echo forbes_databases_display($post); ?>
</div>
<?php
get_footer();
