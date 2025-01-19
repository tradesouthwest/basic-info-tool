<?php
/*
* Plugin Name: Basic Info
* Plugin URI: https://github.com/tradesouthwest/basic-info-tsw
* Description: Display website information on your WordPress administrator screen.
* Version: 1.0.01
* Author: Tradesouthwest
* Author URI: https://classicpress-themes.com
* Text Domain: basic-infotsw
*
*/
defined( 'ABSPATH' ) or exit;

class Basic_Info_Tsw{

	private static $instance = null;

	public function __construct(){

		add_action( 'admin_menu', array( $this, 'basic_info_tsw_add_page' ) );

	}

	public static function get_instance() {

		if ( null == self::$instance ) {
		    self::$instance = new self;
		}

	return self::$instance;

	}

	/**
	* General functions go below
	*/

	public static function basic_info_tsw_add_page(){
		add_submenu_page( 'tools.php', 
							'Site Information', 
							'Basic Info TSW', 
							'manage_options', 
							'basic-info-tsw', 
							array( 'basic_info_tsw', 
									'basic_info_tsw_info_page' ) 
						);
	}

	public static function basic_info_tsw_info_page(){
		include 'admin/basic-infotsw-infopage.php';
	}


} //class ends here

Basic_Info_Tsw::get_instance();
