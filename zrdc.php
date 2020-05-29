<?php
/*
Plugin Name:  ZRDC SRAS
Description:  Plugin for Zibagwe Rural Distict Council for registration & allocation of stands
Version:      1.1
Author:       Walter Mkwananzi
*/

defined('ABSPATH') or die('Illegal Access!!!');

if ( !defined( 'ZR_PLUGIN_FILE' ) ) {
    define( 'ZR_PLUGIN_FILE', __FILE__ );
}

require_once plugin_dir_path( __FILE__ ) . 'inc/autoload/zr-autoloader.php';

class ZRDC
{
    public function __construct() {
        ZR_Installer::instance();
    }
}

$zrdc = new ZRDC();
?>
