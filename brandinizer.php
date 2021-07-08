<?php

/**
 * 
 * Plugin Name:       Brandinizer - Custom Dashboard Branding
 * Plugin URI:        https://froosty.tech/
 * Description:       Add Custom Brand Info in wordpress backend.
 * Version:           1.0.0
 * Author:            Shubham Shinde (froosty)
 * Author URI:        https://froosty.tech/about/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       brandinizer
 * Domain Path:       /languages
 * Stable tag:        5.0
 */

if( !defined('ABSPATH') ) : exit(); endif;

/**
 *  plugin constants
 */
define( 'BRANDINIZER_PLUGIN_PATH', trailingslashit( plugin_dir_path(__FILE__) ) );
define( 'BRANDINIZER_PLUGIN_URL',  trailingslashit( plugins_url('/', __FILE__) ) );

define( 'BRANDINIZER_LOGO',  BRANDINIZER_PLUGIN_URL . 'admin/img/brandinizer_logo_2.png' );
define( 'BRANDINIZER_ICON',  BRANDINIZER_PLUGIN_URL . 'admin/img/favicon.png' );



/**
 * Include brandinizer-admin.php
 */
if( is_admin() ) {
    require_once BRANDINIZER_PLUGIN_PATH . '/admin/brandinizer-admin.php';
}

/**
 *  Settings Page
 */
require_once BRANDINIZER_PLUGIN_PATH . '/inc/settings/brandinizer-settings.php';

/**
 *  Frontend Code
 */
require_once BRANDINIZER_PLUGIN_PATH . '/inc/settings/brandinizer-frontend.php';

