<?php
function fbap_free_network_install($networkwide) {
	global $wpdb;

	if (function_exists('is_multisite') && is_multisite()) {
		// check if it is a network activation - if so, run the activation function for each blog id
		if ($networkwide) {
			$old_blog = $wpdb->blogid;
			// Get all blog ids
			$blogids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");
			foreach ($blogids as $blog_id) {
				switch_to_blog($blog_id);
				fbap_install_free();
			}
			switch_to_blog($old_blog);
			return;
		}
	}
	fbap_install_free();
}

function fbap_install_free()
{
	/*$pluginName = 'xyz-wp-smap/xyz-wp-smap.php';
	if (is_plugin_active($pluginName)) {
		wp_die( "The plugin Facebook Auto Publish cannot be activated unless the premium version of this plugin is deactivated. Back to <a href='".admin_url()."plugins.php'>Plugin Installation</a>." );
	}*/
	
	global $current_user;
	get_currentuserinfo();
	if(get_option('xyz_credit_link')=="")
	{
		add_option("xyz_credit_link", '0');
	}

	add_option('xyz_fbap_application_id','');
	add_option('xyz_fbap_application_secret', '');
	add_option('xyz_fbap_fb_id', '');
	add_option('xyz_fbap_message', 'New post added at {BLOG_TITLE} - {POST_TITLE}');
 	add_option('xyz_fbap_po_method', '2');
	add_option('xyz_fbap_post_permission', '1');
	add_option('xyz_fbap_current_appln_token', '');
	add_option('xyz_fbap_af', '1'); //authorization flag
	add_option('xyz_fbap_pages_ids','-1');

	

	$version=get_option('xyz_fbap_free_version');
	$currentversion=xyz_fbap_plugin_get_version();
	update_option('xyz_fbap_free_version', $currentversion);
	
	add_option('xyz_fbap_include_pages', '0');
	add_option('xyz_fbap_include_categories', 'All');
	add_option('xyz_fbap_include_customposttypes', '');
	
	add_option('xyz_fbap_peer_verification', '1');
	add_option('xyz_fbap_post_logs', '');
	add_option('xyz_fbap_premium_version_ads', '1');

}


register_activation_hook(XYZ_FBAP_PLUGIN_FILE,'fbap_free_network_install');
?>