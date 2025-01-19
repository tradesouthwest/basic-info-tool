<?php
defined( 'ABSPATH' ) || exit;
include plugin_dir_path( plugin_dir_path( __FILE__ ) )
    .'classes/basic-info-tool-core.php';
?>

<h1><?php esc_html_e( 'Basic Site Information' , 'basic-info-tool'); ?></h1><br>
<h2><?php esc_html_e( 'Basic Information', 'basic-info-tool'); ?></h2>

<div id="basic-info-tool-short">
    
    <?php echo wp_kses_post( Basic_Info_Tool_Core::short_basic_debug_info() ); ?>

</div>
<hr id="basic-info-tool-hr"><br>

<h2><?php esc_html_e( 'Debug Information', 'basic-info-tool' ); ?></h2>
<div id="basic-info-tool-long">
    
    <?php echo wp_kses_post( Basic_Info_Tool_Core::basic_debug_info() ); ?>

</div>

<h2><?php esc_html_e( 'Download site info', 'basic-info-tool' ); ?></h2>
    <div id="basic-info-tool-download">
        
        <?php 
        $current_page_url = get_admin_url( null, 'admin.php?page=basic-info-tool' );
        if ( $current_page_url ) : 
        ?>
        <p><a href="<?php echo esc_url( $current_page_url ); ?>" download>
        <?php
        esc_html_e( 'Download Report', 'basic-info-tool' ); ?></a></p>
        <?php 
        endif; ?>

    </div>
