<?php
global $wpdb;

/*
 * Add my new menu to the Admin Control Panel
 */


//
add_action('admin_menu', 'users_menu');

function users_menu()
{
    $current_user = new WP_User(get_current_user_id());
    global $current_user;
    // now admins and the custom_user_role will see the menu and can work with it
    // if (in_array('administrator', $current_user->roles)) {
    // use the dynamic role to register the menu. so as your different users log in, the menu will load for them
    add_menu_page(
        'User List', // Title of the page
        'Users list', // Text to show on the menu link
        $current_user->roles[0], // Capability requirement to see the link
        'users/admin/index.php', // The 'slug' - file to display when clicking the link
        '',
        'dashicons-excerpt-view'
    );
    // }

}

add_action('init', function () {
    global $wpdb;
    $table = $wpdb->prefix . 'options';
    $endpoint = $wpdb->get_results("SELECT option_value from $table WHERE option_name = 'userPlugin_endpoint'")[0]->option_value;
    add_rewrite_rule($endpoint, "index.php?$endpoint=table", 'top');
});

add_filter('query_vars', function ($query_vars) {
    global $wpdb;
    $table = $wpdb->prefix . 'options';
    $endpoint = $wpdb->get_results("SELECT option_value from $table WHERE option_name = 'userPlugin_endpoint'")[0]->option_value;
    $query_vars[] = $endpoint ;
    return $query_vars;
});


add_action('template_include', function ($template) {
    global $wpdb;
    $table = $wpdb->prefix . 'options';
    $endpoint = $wpdb->get_results("SELECT option_value from $table WHERE option_name = 'userPlugin_endpoint'")[0]->option_value;
    if (get_query_var($endpoint) == false || get_query_var($endpoint) == '') {
        return $template;
    }
    return  substr(plugin_dir_path(__FILE__), 0, -4) . '/public/index.php';
});

add_action('wp_head', 'myplugin_ajaxurl');

function myplugin_ajaxurl()
{

    echo '<script type="text/javascript">
           var ajaxurl = "' . admin_url('admin-ajax.php') . '";
         </script>';
}

function ajax_url()
{

    // The wp_localize_script allows us to output the ajax_url path for our script to use. foundation
    wp_localize_script(
        'custom',
        'ajaxurl',
        array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('ajax-nonce')
        )
    );
}
add_action('wp_enqueue_scripts', 'ajax_url');


add_action('wp_ajax_getSingleUser', 'getSingleUser');
add_action('wp_ajax_nopriv_getSingleUser', 'getSingleUser');

function getSingleUser()
{
    $id = $_REQUEST['userID'];
    include_once plugin_dir_path(__DIR__) . "src/view/single.php";

    wp_die();
}



add_action('wp_ajax_setSettings', 'setSettings');

function setSettings()
{
    global $wpdb;
    $endpoint = $_REQUEST['endpoint'];
    $cache = $_REQUEST['cache'];
    $theme = $_REQUEST['theme'];


    $table = $wpdb->prefix . 'options';

    $wpdb->update(
        $table,
        array(
            'option_name' => 'userPlugin_endpoint',
            'option_value' => $endpoint,
            'autoload' => 'no'
        ),
        array(
            'option_name' => 'userPlugin_endpoint',
        )

    );
    $wpdb->update(
        $table,
        array(
            'option_name' => 'userPlugin_cache',
            'option_value' => $cache,
            'autoload' => 'no'
        ),
        array(
            'option_name' => 'userPlugin_cache',
        )
    );
    $wpdb->update(
        $table,
        array(
            'option_name' => 'userPlugin_theme',
            'option_value' => $theme,
            'autoload' => 'no'
        ),
        array(
            'option_name' => 'userPlugin_theme',
        )
    );

}
