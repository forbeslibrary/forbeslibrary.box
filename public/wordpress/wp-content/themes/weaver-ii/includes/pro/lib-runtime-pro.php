<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
/*
Weaver II Pro Runtime Library

This code is Copyright 2011 by Bruce Wampler, all rights reserved.
This code is licensed under the terms of the accompanying license file: license.html.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.

*/

//==================== Pro RUN TIME ==========
function weaverii_trans($id, $text) {
	return $text;
}

if (!function_exists('weaverii_t_')) {
function weaverii_t_($t) {
	return $t;
}
}

if (!function_exists('weaverii_te_')) {
function weaverii_te_($t) {
	echo $t;
}
}


function weaverii_init_base() {
	return false;
}

function weaverii_pro_wp_head() {

}

function weaverii_pro_output_style($sout) {

}

function weaveriip_header_insert() {

}
function weaveriip_clear_opts() {
}
function weaveriip_save_opts_backup() {

}

// ============================ OPTIONS ===========================
function weaverii_opt_cache($switch = null) {
	// load the options cache - only weaver_settings in basic version
	global $weaverii_opts_cache;

	if (isset($switch)) {
        $weaverii_opts_cache = $switch;
	} else if (!$weaverii_opts_cache) {
        $weaverii_opts_cache = apply_filters('weaverii_switch_theme',
            get_option(apply_filters('weaver_options','weaverii_settings') ,array()));	// start with the default
	}
}

function weaverii_pro_opt_cache($switch = null) {
}

function weaveriip_restore_opts_backup() {
}

function weaverii_pro_getopt($name) {
	return false;
}

function weaverii_masonry($args=false) {
	return false;
}

function weaverii_pro_isset($name){
	return false;
}

function weaverii_pro_update_options($id) {
}

/* ------------------------------------ Weaver II Pro FEATURE IMPLEMENTATIONS ------------------------ */
?>
