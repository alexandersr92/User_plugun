<?php
/**
 * Plugin Name: User API 
 * Plugin URI: https://www.google.com/
 * Description: Plugin for get User API for inpsyde
 * Version: 1.0
 * Author: Alexander Sanchez
 * Author URI: https://www.linkedin.com/in/alexandersr92/
 **/

/**
 * @package  User_Plugin
 */


include_once plugin_dir_path(__FILE__) . 'inc/functions.php';
include_once plugin_dir_path(__FILE__) . 'inc/enqueue.php';


function registerSettings(){
    global $wpdb;
    $table = $wpdb->prefix . 'options';
    $wpdb->insert(
        $table,
        array(
            'option_name' => 'userPlugin_endpoint',
            'option_value' => 'users',
            'autoload' => 'no'
        )

    );
    $wpdb->insert(
        $table,
        array(
            'option_name' => 'userPlugin_cache',
            'option_value' => '30',
            'autoload' => 'no'
        )
    );
    $wpdb->insert(
        $table,
        array(
            'option_name' => 'userPlugin_theme',
            'option_value' => 'light',
            'autoload' => 'no'
        )
    );

}

register_activation_hook(__FILE__,"registerSettings");

function plz_plugin_desactivar(){
    global $wpdb;
    $table = $wpdb->prefix . 'options';
    $wpdb->delete(
        $table,
        array('option_name' => 'userPlugin_endpoint',)
    );
    $wpdb->delete(
        $table,
        array('option_name' => 'userPlugin_cache',)
    );
    $wpdb->delete(
        $table,
        array('option_name' => 'userPlugin_theme',)
    );
}

register_deactivation_hook(__FILE__,"plz_plugin_desactivar");