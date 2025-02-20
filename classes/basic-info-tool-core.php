<?php 

/**
* Code used and altered from Caldera Forms (www.calderaforms.com) 
* Thanks Josh! (https://profiles.wordpress.org/shelob9/)
*/

defined( 'ABSPATH' ) || exit;

class Basic_Info_Tool_Core {

	/**
	 * Return an array of plugin names and versions
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	public static function get_plugins() {
		$plugins     = array();
		include_once ABSPATH . '/wp-admin/includes/plugin.php';
		$all_plugins = get_plugins(); 
		foreach ( $all_plugins as $plugin_file => $plugin_data ) {
			if ( is_plugin_active( $plugin_file ) ) {
				$plugins[ $plugin_data['Name'] ] = $plugin_data['Version'];
			}
		}

		return $plugins;
	}


	/**
	 * Debug Information
	 *
	 * @since 1.0.0
	 *
	 * @param bool $html Optional. Return as HTML or not
	 * @param getenv — Gets the value of a single or all environment variables
	 * @return string
	 */
	public static function basic_debug_info( $html = true ) {
		global $wp_version, $wpdb, $wp_scripts;
		if (isset( $_SERVER['HTTP_USER_AGENT'] ) ) {  
			$servagent   = wp_unslash( sanitize_key( $_SERVER['HTTP_USER_AGENT'] ) ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotValidated
			} else {  
			$servagent   = null; 
		}
		if( isset( $_SERVER['HTTP_USER_AGENT'] ) ) {  
			$servsoft    = wp_unslash( sanitize_key( $_SERVER['SERVER_SOFTWARE'] ) ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotValidated
	    	} else {
			$servsoft    = null; 
		} 
		$wp          = $wp_version;
		$php         = phpversion();
		$mysql       = $wpdb->db_version();
		$plugins     = self::get_plugins();
		$stylesheet    = get_stylesheet();
		$theme         = wp_get_theme( $stylesheet );
		$theme_name    = $theme->get( 'Name' );
		$theme_version = $theme->get( 'Version' );
		$user_browser  = wp_unslash(
							esc_attr($servagent)) 
							?? 'undefined'; 
		$user_software = wp_unslash(
							esc_attr($servsoft))
							?? 'undefined'; 
		
		$opcode_cache  = array(
			'Apc'       => function_exists( 'apc_cache_info' ) ? 'Yes' : 'No',
			'Memcached' => class_exists( 'eaccelerator_put' ) ? 'Yes' : 'No',
			'Redis'     => class_exists( 'xcache_set' ) ? 'Yes' : 'No',
		);
		$object_cache  = array(
			'Apc'       => function_exists( 'apc_cache_info' ) ? 'Yes' : 'No',
			'Apcu'      => function_exists( 'apcu_cache_info' ) ? 'Yes' : 'No',
			'Memcache'  => class_exists( 'Memcache' ) ? 'Yes' : 'No',
			'Memcached' => class_exists( 'Memcached' ) ? 'Yes' : 'No',
			'Redis'     => class_exists( 'Redis' ) ? 'Yes' : 'No',
		);
		$versions      = array(
			'WordPress Version'           => $wp,
			'PHP Version'                 => $php,
			'MySQL Version'               => $mysql,
			'JQuery Version'			  => $wp_scripts->registered['jquery']->ver,
			'Server Software'             => esc_attr( $user_software ),
			'Your User Agent'             => esc_attr( $user_browser ),
			'Session Save Path'           => session_save_path(),
			'Session Save Path Exists'    => ( file_exists( session_save_path() ) ? 'Yes' : 'No' ),
			'Session Save Path Writeable' => ( is_writable( session_save_path() ) ? 'Yes' : 'No' ),
			'Session Max Lifetime'        => ini_get( 'session.gc_maxlifetime' ),
			'Opcode Cache'                => $opcode_cache,
			'Object Cache'                => $object_cache,
			'WPDB Prefix'                 => $wpdb->prefix,
			'WP Multisite Mode'           => ( is_multisite() ? 'Yes' : 'No' ),
			'WP Memory Limit'             => WP_MEMORY_LIMIT,
			'Currently Active Theme'      => $theme_name . ': ' . $theme_version,
			'Parent Theme'				  => $theme->template,
			'Currently Active Plugins'    => $plugins,
		);
		if ( $html ) {
			$debug = '';
			foreach ( $versions as $what => $version ) {
				$debug .= '<p><strong>' . $what . '</strong>: ';
				if ( is_array( $version ) ) {
					$debug .= '</p><ul class="ul-disc">';
					foreach ( $version as $what_v => $v ) {
						$debug .= '<li><strong>' . $what_v . '</strong>: ' . $v . '</li>';
					}
					$debug .= '</ul>';
				} else {
					$debug .= $version . '</p>';
				}
			}
			return $debug;
		} else {
			return $versions;
		}
	}

	public static function short_basic_debug_info( $html = true ) {
		global $wp_version, $wpdb;

		$data = array(
			'WordPress Version'     => $wp_version,
			'PHP Version'           => phpversion(),
			'MySQL Version'         => $wpdb->db_version(),
			'WP_DEBUG'              => ( !defined ( WP_DEBUG ) ) ? 'false' : WP_DEBUG,
		);
		if ( $html ) {
			$html = '';
			foreach ( $data as $what_v => $v ) {
				$html .= '<li style="display: inline;"><strong>' . $what_v . '</strong>: ' . $v . ' </li>';
			}

			return '<ul>' . $html . '</ul>';
		}
	}

}