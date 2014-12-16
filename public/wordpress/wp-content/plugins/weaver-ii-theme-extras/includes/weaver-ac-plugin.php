<?php
if(!defined('WPINC')) // MUST have WordPress.
	exit('Do NOT access this file directly: '.basename(__FILE__));

/*
 * Weaver II Theme Extras - Support for Quick Cache - Version 11/29/13
 * 
 * If implemented; this file should go in this special directory.
 *    `/wp-content/ac-plugins/my-ac-plugin.php`
 */

function weaverii_ac_plugin()  { // Example plugin.

    /**
     * All plugins need a reference to this class object instance.
     *
     * @var $ac \quick_cache\advanced_cache Object instance.
     */

    if ( isset($GLOBALS['quick_cache__advanced_cache']) ) {
        $ac = $GLOBALS['quick_cache__advanced_cache']; // See: `advanced-cache.php`.

    /*
     * This plugin will dynamically modify the version salt.
     */
        $ac->add_filter(get_class($ac).'__version_salt', 'weaverii_ac_version_salt_shaker');
    }
}


weaverii_ac_plugin(); // Run this plugin.

/*
 * Any other function(s) that may support your plugin.
 */

function weaverii_ac_version_salt_shaker($version_salt) { // Salt shaker.

    if (isset($_SERVER["HTTP_USER_AGENT"]) ) {
		$agent = $_SERVER['HTTP_USER_AGENT'];

		// these need to be searched in this order because Android will end up catching most devices in 2012
		$devices = array(
		'A100'          => 'tablet',            // Acer: 1024x768
		'A500'          => 'tablet',            // Acer A500:1280x768
		'hp-tablet'     => 'tablet',            // HP: 1024x768
		'iPad'          => 'tablet',            // 1024x768
		'GT-P7'         => 'tablet',            // Galaxy Tab 10: 1280x800
		'LG-V900'       => 'tablet',            // LG Optimus Pad:1280x768
		'ThinkPad'      => 'tablet',            // Lenovo ThinkPad: 1280x800
		'Xoom'          => 'tablet',            // Motorola Xoom: 1280x800

		'A1_07'         => 'smalltablet',       // Lenovo IdeaPad A1 (8/2012)
		'BNTV250'       => 'smalltablet',       // NOOK:1024x600
		'NOOK'          => 'smalltablet',
		'GT-P3'         => 'smalltablet',       // Galaxy Tab 7: 1024x600 (assume smaller)
		'SCH-I800'      => 'smalltablet',       // Galaxy Tab 7 (8/2012)
		'Nexus 7'       => 'smalltablet',       // Google Nexus 7 (8/2012)
		'HTC_Salsa'     => 'smalltablet',       // HTC Flyer 1024x600 HTC_Salsa_C510
		'Kindle Fire'   => 'smalltablet',        // 1024x600 (android)
		'Silk'          => 'smalltablet',        // 1024x600 (android)
		'NXM901'        => 'smalltablet',       // Nextbook: 800x600
		'RIM Tablet'    => 'smalltablet',       // PlayBook, RIM Tablet 1024x600
		'TSB_CLOUD_COMPANION' => 'smalltablet', // TOSHIBA (maybe 600?)
		'OliPad'        => 'smalltablet',       // Olivetti: 1024x600
		'Opera Tablet'  => 'smalltablet',

		'Opera Mini'    => 'touch',
		'iPod'          => 'touch',
		'iPhone'        => 'touch',
		'Android'       => 'touch',
		'IEMobile'      => 'touch',

		'BlackBerry9'   => 'touch',
		'BB10'          => 'touch',
		'LG-TU915 Obigo'=> 'touch', // LG touch browser
		'LGE VX'        => 'touch',
		'webOS'         => 'touch', // Palm Pre, etc.
		'Nokia5'        => 'touch',

		'2.0 MMP'       => 'mobile',
		'240x320'       => 'mobile',
		'400X240'       => 'mobile',
		'AvantGo'       => 'mobile',
		'BlackBerry'    => 'mobile',
		'Blazer'        => 'mobile',
		'Cellphone'     => 'mobile',
		'Danger'        => 'mobile',
		'DoCoMo'        => 'mobile',
		'Elaine'        => 'mobile',
		'EudoraWeb'     => 'mobile',
		'Googlebot-Mobile'=> 'mobile',
		'hiptop'        => 'mobile',
		'KYOCERA'       => 'mobile',
		'LG/U990'       => 'mobile',
		'MMEF20'        => 'mobile',
		'MOT'           => 'mobile',
		'NetFront'      => 'mobile',
		'Newt'          => 'mobile',
		'Nintendo Wii'  => 'mobile',
		'Nitro'         => 'mobile', // Nintendo DS
		'Nokia'         => 'mobile',
		'Palm'          => 'mobile',
		'PlayStation Portable'  => 'mobile',
		'portalmmm'     => 'mobile',
		'Proxinet'      => 'mobile',
		'ProxiNet'      => 'mobile',
		'SHARP'         => 'mobile',
		'SHG'           => 'mobile',
		'Small'         => 'mobile',
		'SonyEricsson'  => 'mobile',
		'Symbian'       => 'mobile',
		'TS21i-10'      => 'mobile',
		'UP.Browser'    => 'mobile',
		'UP.Link'       => 'mobile',
		'Windows CE'    => 'mobile',
		'WinWAP'        => 'mobile',
		'YahooSeeker'   => 'mobile',
		'Alcatel'       => 'mobile',
		'Dmobo'         => 'mobile',
		'Gradiente'     => 'mobile',
		'GRUNDIG'       => 'mobile',
		'HTC'           => 'mobile',
		'Mitsu'         => 'mobile',
		'Motorola'      => 'mobile',
		'PANTECH'       => 'mobile',
		'Samsung'       => 'mobile',
		'SAMSUNG'       => 'mobile',
		'Siemens'       => 'mobile',
		'Vodafone'      => 'mobile',
		'Smartphone'    => 'mobile',
		);

        $version_salt = 'desktop';

		foreach ($devices as $browser => $type) {
			if (strpos($agent,$browser) !== false) {
				$version_salt = $type;
				if ($browser == 'Android') {
					if (strpos($agent,'Mobile') === false)
						$version_salt = 'tablet';    // Android tablets don't have Mobile in UA
				}
                if (isset($_COOKIE['weaverii_mobile']) ) {  // cookie to change mobile view - need salt for each version...
                    if ( $_COOKIE['weaverii_mobile'] != 'true' )
                        $version_salt .= '-desk';      // they want web view
                    }
				break;
			}
		}
	}

    return $version_salt;
}
