<?php
defined( 'ABSPATH' ) || exit;
include plugin_dir_path( plugin_dir_path( __FILE__ ) )
    .'classes/basic-infotsw-core.php';
?>

<h1><?php _e( 'Basic Site Information' , 'basic-infotsw'); ?></h1><br>
<h2><?php _e( 'Basic Information', 'basic-infotsw'); ?></h2>

<div id="basic-infotsw-short"><?php echo Basic_Info_Tsw_Core::short_basic_debug_info(); ?></div>
<hr id="basic-infotsw-hr"><br>

<h2><?php _e( 'Debug Information', 'basic-infotsw' ); ?></h2>
<div id="basic-infotsw-long"><?php echo Basic_Info_Tsw_Core::basic_debug_info(); ?></div>

<h2><?php _e( 'Download site info', 'basic-infotsw' ); ?></h2>
<div id="basic-infotsw-download"><a href=""><?php esc_html_e( 'Download Report', 'basic-infotsw' ); ?></a></div> 
