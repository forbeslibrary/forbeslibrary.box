<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
// The Weaver II File Handlers

function weaverii_f_file_access_fail($who = '') {
	static $weaverii_f_file_access_fail_sent = false;
	if ($weaverii_f_file_access_fail_sent) return;      // only show once...
	$weaverii_f_file_access_fail_sent = true;
?>
		<div class="error">
		<strong style="color:#f00; line-height:150%;">*** Weaver II File Access Error! ***</strong> <small style="padding-left:20px;">(But don't panic!)</small>
		<p>Weaver II is unable to process a file access request. You may need proper FTP credentials set in
		WordPress, or in your wp-config.php file. It is unusual to see this error. It may be displayed
		after you move to a new host - be sure the <em></em>Settings : Media : Uploads</em> directory path is set properly for your current host.</p>
		<p>You may have to change the directory permissions on your web hosting server.</p>
		<?php echo "<p>Diagnostics: $who</p>\n"; ?>
		</div>
<?php
		return;
}
function weaverii_f_file_access_available() {
	if (function_exists('aspentw_f_file_access'))
		return true;
	return false;
}

function weaverii_f_open($fn, $how) {
	if ($fn == 'php://output' || $fn == 'echo')
		return 'echo';
	if (function_exists('aspentw_f_open'))
		return aspentw_f_open( $fn, $how );
	return false;
}

function weaverii_f_write($fn,$data) {
	 if ($fn == 'php://output' || $fn == 'echo') {
		echo $data;
		return true;
	}
	else if (function_exists('aspentw_f_write'))
		return aspentw_f_write( $fn, $data);
	else
		return false;
}

function weaverii_f_close($fn) {
	if ($fn == 'php://output' || $fn == 'echo')
		return true;
	else if (function_exists('aspentw_f_close'))
		return aspentw_f_close( $fn );
	else
		return false;
}

function weaverii_f_delete($fn) {
	if ($fn == 'php://output' || $fn == 'echo')
		return false;
	if (function_exists('aspentw_f_delete'))
		return aspentw_f_delete( $fn );
	return false;
}

function weaverii_f_is_writable($fn) {
	if ($fn == 'php://output' || $fn == 'echo')
		return true;
	if (function_exists('aspentw_f_is_writable'))
		return aspentw_f_is_writable( $fn );
	return false;
}

function weaverii_f_touch($fn) {
	if ($fn == 'php://output' || $fn == 'echo')
		return true;
	if (function_exists('aspentw_f_touch'))
		return aspentw_f_touch( $fn );
	return false;
}

function weaverii_f_mkdir($fn) {
	if ($fn == 'php://output' || $fn == 'echo')
		return false;
	if (function_exists('aspentw_f_mkdir'))
		return aspentw_f_mkdir( $fn );
	return false;
}

function weaverii_f_exists($fn) {
	// this one must use native PHP version since it is used at theme runtime as well as admin
	if ($fn == 'php://output' || $fn == 'echo')
		return true;
	if (function_exists('aspentw_f_exists'))
		return aspentw_f_exists( $fn );
	return @file_exists($fn);
}

function weaverii_f_get_contents($fn) {
	if ($fn == 'php://output' || $fn == 'echo')
		return '';
	if (function_exists('aspentw_f_get_contents'))
		return aspentw_f_get_contents( $fn );
	return implode('',file($fn));       // works if no newlines in the file...
}

// =========================== helper functions ===========================
function weaverii_pop_msg($msg) {
	echo "<script> alert('" . $msg . "'); </script>";
	// echo "<h1>*** $msg ***</h1>\n";
}

function weaverii_f_content_dir() {
	return trailingslashit(WP_CONTENT_DIR);
 }

function weaverii_f_plugins_dir() {
	// delivers appropraite path for using weaverii_f_ functions. WP_PLUGIN_DIR
	return trailingslashit(WP_PLUGIN_DIR);
}

function weaverii_f_themes_dir() {
	// delivers appropraite path for using weaverii_f_ functions.
	return weaverii_f_content_dir() . 'themes/';
}

function weaverii_f_wp_lang_dir() {
	// delivers appropraite path for using weaverii_f_ functions. WP_LANG_DIR
	return trailingslashit(WP_LANG_DIR);
}

function weaverii_f_uploads_base_dir() {
	// delivers appropraite path for using weaverii_f_ functions.
	$upload_dir = wp_upload_dir();
	return trailingslashit($upload_dir['basedir']);
}

function weaverii_f_uploads_base_url() {
	$wpdir = wp_upload_dir();           // get the upload directory
	return trailingslashit(trim($wpdir['baseurl']));
}

function weaverii_f_wp_filesystem_error() {
	return;
}

function weaverii_f_fail($msg) {
	weaverii_pop_msg($msg);
	return false;
}


?>
