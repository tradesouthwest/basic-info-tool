<?php
/*
* Plugin Name: Basic Info Tool
* Plugin URI: https://github.com/tradesouthwest/basic-info-tool
* Description: Display website information on your WordPress administrator screen.
* Version: 1.0.1
* Author: Tradesouthwest
* Author URI: https://classicpress-themes.com
* Text Domain: basic-info-tool
*
*/
defined( 'ABSPATH' ) or exit;

class Basic_Info_Tool{

	private static $instance = null;

	public function __construct(){

		add_action( 'admin_menu', array( $this, 'basic_info_tool_add_page' ) );

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

	public static function basic_info_tool_add_page(){
		add_submenu_page( 'tools.php', 
						'Site Information', 
						'Basic Info Tool', 
						'manage_options', 
						'basic-info-tool', 
						array( 'basic_info_tool', 
							'basic_info_tool_info_page' 
							) 
						);
	}

	public static function basic_info_tool_info_page(){
		include 'admin/basic-info-tool-infopage.php';
	}


} //class ends here

Basic_Info_Tsw::get_instance(); 
