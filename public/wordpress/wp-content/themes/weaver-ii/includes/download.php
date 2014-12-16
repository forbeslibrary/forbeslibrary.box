<?php
// will down load current settings based on db setting

$wp_root = dirname(__FILE__) .'/../../../../';
if(file_exists($wp_root . 'wp-load.php')) {
	require_once($wp_root . "wp-load.php");
} else if(file_exists($wp_root . 'wp-config.php')) {
	require_once($wp_root . "wp-config.php");
} else {
		exit;
}

@error_reporting(0);
	$wii_is_theme = false;

	if (isset($_REQUEST['_wpnonce']))
		$nonce = $_REQUEST['_wpnonce'];
	else if (isset($_REQUEST['_wpnoncet'])) {
		$nonce = $_REQUEST['_wpnoncet'];
		$wii_is_theme = true;
	} else
		$nonce = '';

	if (! wp_verify_nonce($nonce, 'wii_download')) {
		@header('Content-Type: ' . get_option('html_type') . '; charset=' . get_option('blog_charset'));
		wp_die('Sorry - download must be initiated from admin panel.');
	}

	if (headers_sent()) {
		@header('Content-Type: ' . get_option('html_type') . '; charset=' . get_option('blog_charset'));
		wp_die('Headers Sent: The headers have been sent by another plugin - there may be a plugin conflict.');
	}


	$wii_opts = get_option( apply_filters('weaver_options','weaverii_settings') ,array());
	$wii_pro_opts = get_option( apply_filters('weaver_options','weaverii_pro') ,array());
	$wii_save = array();
	$wii_save['weaverii_base'] = $wii_opts;

	if ($wii_is_theme) {
		$wii_header = 'W2T-V01.00';
		$wii_fn = 'weaver-ii-theme-settings.w2t';
		foreach ($wii_opts as $opt => $val) {
			if ($opt[0] == '_')
				$wii_save['weaverii_base'][$opt] = false;
		}
		$wii_save['weaverii_pro'] = array();
	}
	else {
		$wii_header = 'W2B-V01.00';                     /* Save all settings: 10 byte header */
		$wii_fn = 'weaver-ii-backup-settings.w2b';
		$wii_save['weaverii_pro'] = $wii_pro_opts;
	}

	$wii_settings = $wii_header . serialize($wii_save); /* serialize full set of options right now */

	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename='.$wii_fn);
	header('Content-Transfer-Encoding: binary');
	header('Expires: 0');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Pragma: public');
	header('Content-Length: ' . strlen($wii_settings));
	//ksort ($wii_opts);
	//print_r($wii_opts);
	echo $wii_settings;
	exit;
?>
