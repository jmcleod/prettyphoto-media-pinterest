<?php
/*
 * Plugin Name: prettyPhoto Media Pinterest
 * Depends: prettyPhoto Media
 * Plugin URI: http://github.com/jmcleod/prettyphoto-media-pinterest
 * Description: Adds a Pinterest "Pin It" Button to prettyPhoto.
 * Version: 0.1
 * Author: James McLeod
 */
add_action('init', 'ppm_pinterest_init');

function ppm_pinterest_init() {
	define('PPM_PINTEREST_URI', trailingslashit( plugin_dir_url( __FILE__ ) ) );
	define('PPM_PINTEREST_VERSION', '0.1' );
	
	if (!is_admin()) {
		wp_enqueue_style('ppm_pinterest', PPM_PINTEREST_URI . 'css/ppm-pinterest.css', false, PPM_PINTEREST_VERSION, 'screen');
		add_action('wp_footer', 'ppm_pinterest_footer_script', 101);
	}	
}

function ppm_pinterest_footer_script() {
	$out = '<script>' . "\n";
	$out .= 'jQuery(function($) {' . "\n";	
	$out .= '  $(document).bind(\'DOMNodeInserted\', function(event) {' . "\n";
	$out .= '    if (window.settings && !window.settings.changepicturecallbackupdated) {' . "\n";
	$out .= '      window.settings.changepicturecallback = add_pinterest_pin_it_button' . "\n";
	$out .= '      window.settings.changepicturecallbackupdated = true;' . "\n"; 
	$out .= '    }' . "\n";
	$out .= '  });' . "\n";
	$out .= '});' . "\n";
	$out .= "\n";
	$out .= 'function add_pinterest_pin_it_button() {' . "\n";
	$out .= '  var i = jQuery(\'.pp_gallery\').find(\'li\').index(jQuery(\'.selected\'));' . "\n";
	$out .= '  var m = pp_images[i];' . "\n";
	$out .= '  jQuery(\'.pp_social\').append(\'<div class="pinterest"><a href="http://pinterest.com/pin/create/button/?url=\' + encodeURI(location.href) + \'&media=\' + encodeURI(m) + \'" class="pin-it-button" count-layout="none"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a></div>\');' . "\n";
	$out .= '}' . "\n";
	$out .= '</script>' . "\n";
	
	echo $out;
}

?>

