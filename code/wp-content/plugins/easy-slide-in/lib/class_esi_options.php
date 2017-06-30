<?php
/**
 * Handles options access.
 */
class ESI_Options {

	//function ESI_Options () { $this->__construct(); }

	function __construct () {
		// demo options code
		
	}

	/**
	 * Gets a single option from options storage.
	 */
	function get_option ($key) {
		//$opts = WP_ALLOW_MULTISITE ? get_site_option('esi') : get_option('esi');
		$opts = get_option('esi');
		return @$opts[$key];
	}

	/**
	 * Sets all stored options.
	 */
	function set_options ($opts) {
		return WP_NETWORK_ADMIN ? update_site_option('esi', $opts) : update_option('esi', $opts);
	}

	/**
	 * Populates options key for storage.
	 *
	 * @static
	 */
	function populate () {
		$site_opts = get_site_option('esi');
		$site_opts = is_array($site_opts) ? $site_opts : array();

		$opts = get_option('esi');
		$opts = is_array($opts) ? $opts : array();

		$res = array_merge($site_opts, $opts);
		update_option('esi', $res);
	}

}