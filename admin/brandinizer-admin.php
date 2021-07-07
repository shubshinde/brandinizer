<?php 
/**
 * Init Styles & scripts
 *
 * @return void
 */
function brandinizer_admin_styles_scripts() {

    // froosty scripts
    wp_register_style( 'froosty-bootstrap-css', BRANDINIZER_PLUGIN_URL . 'admin/css/brandinizer-bootstrap.min.css', '', rand() );
    wp_register_script( 'froosty-bootstrap-js', BRANDINIZER_PLUGIN_URL . 'admin/js/brandinizer-bootstrap.min.js', array(), rand(), true );
   
    // plugin scripts
    wp_register_style( 'brandinizer-image-uplaoder', BRANDINIZER_PLUGIN_URL . 'admin/css/brandinizer-image-uploader.css', '', rand() );
    wp_enqueue_style( 'brandinizer-admin-style', BRANDINIZER_PLUGIN_URL . 'admin/css/brandinizer-admin.css', '', rand());

    wp_register_script( 'brandinizer-image-uploader', BRANDINIZER_PLUGIN_URL . 'admin/js/brandinizer-image-uploader.js', array('jquery'), rand(), true );
    wp_enqueue_script( 'brandinizer-admin-script', BRANDINIZER_PLUGIN_URL . 'admin/js/brandinizer-admin.js', array('jquery'), rand(), true );
}
add_action( 'admin_enqueue_scripts', 'brandinizer_admin_styles_scripts' );
