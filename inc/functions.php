<?php
global $wpdb;

/*
 * Add my new menu to the Admin Control Panel
 */


//
add_action('admin_menu', 'kevro_menu');

function kevro_menu()
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