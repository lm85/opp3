<?php
namespace OperaPlus;

class Admin {
    function initialize() {
        add_action( 'init', array($this,'redirect_users'));
        add_action( 'admin_enqueue_scripts', array($this,'enqueue_admin_scripts'));

    }

    function enqueue_admin_scripts() {
        wp_enqueue_script( 'media-script', OPERAPLUS_URL . '/js/media-script.js', array( 'jquery', 'media-editor' ), '', true );
    }

    /**
     * Redirect non-admin users from wp-admin to homepage
     * https://alka-web.com/blog/how-to-restrict-access-to-wordpress-dashboard-programmatically/
     * https://wordpress.stackexchange.com/questions/195353/how-to-disable-profile-php-for-users
     */

    function redirect_users() {

        if (strpos ($_SERVER ['REQUEST_URI'] , 'wp-admin/profile.php' )) {
            $admin_redirects = true;
        }
        // Check if the current page is an admin page
        // && and ensure that this is not an ajax call
        if ( is_admin() && !( defined( 'DOING_AJAX' ) && DOING_AJAX ) && !$admin_redirects ){

            //Get all capabilities of the current user
            $user = get_userdata( get_current_user_id() );
            $caps = ( is_object( $user) ) ? array_keys($user->allcaps) : array();

            //All capabilities/roles listed here are not able to see the dashboard
            $block_access_to = array('subscriber');

            if(array_intersect($block_access_to, $caps)) {
                wp_redirect( home_url() );
                exit;
            }
        }
    }



}

$admin = new Admin();
$admin->initialize();

