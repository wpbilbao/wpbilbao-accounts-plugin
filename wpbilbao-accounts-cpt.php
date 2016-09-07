<?php
/*
Plugin Name: WPBilbao - Accounts CPT
Description: Custom Post Type for adding the accounts of the WPBilbao Community. Requieres the use of Genesis Framework for the Page Template and Single Template.
Plugin URI: http://www.wpbilbao.es
Author: Ibon Azkoitia
Author URI: https://www.wpbilbao.es
Version: 1.0
License: GPL2
Text Domain: wpbilbao-accounts-cpt
*/

function wpbilbao_cpt_accounts_load_plugin_textdomain() {
  load_plugin_textdomain( 'wpbilbao-accounts-cpt', false, basename( dirname( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'wpbilbao_cpt_accounts_load_plugin_textdomain' );

/**
* Registers a new post type
* @uses $wp_post_types Inserts new post type object into the list
*
* @param string  Post type key, must not exceed 20 characters
* @param array|string  See optional args description above.
* @return object|WP_Error the registered post type object, or an error object
*/
function wpbilbao_cpt_accounts() {

  $labels = array(
    'name'                => __( 'Accounts', 'wpbilbao-accounts-cpt' ),
    'singular_name'       => __( 'Account', 'wpbilbao-accounts-cpt' ),
    'add_new'             => __( 'Add New', 'wpbilbao-accounts-cpt' ),
    'add_new_item'        => __( 'Add New Account', 'wpbilbao-accounts-cpt' ),
    'edit_item'           => __( 'Edit Account', 'wpbilbao-accounts-cpt' ),
    'new_item'            => __( 'New Account', 'wpbilbao-accounts-cpt' ),
    'view_item'           => __( 'View Account', 'wpbilbao-accounts-cpt' ),
    'search_items'        => __( 'Search Accounts', 'wpbilbao-accounts-cpt' ),
    'not_found'           => __( 'Not Found', 'wpbilbao-accounts-cpt' ),
    'not_found_in_trash'  => __( 'Not Found in Trash', 'wpbilbao-accounts-cpt' ),
    'parent_item_colon'   => __( 'Parent Account:', 'wpbilbao-accounts-cpt' ),
    'menu_name'           => __( 'Accounts', 'wpbilbao-accounts-cpt' ),
  );

  $args = array(
    'labels'              => $labels,
    'hierarchical'        => false,
    'description'         => 'description',
    'public'              => false,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => null,
    'menu_icon'           => 'dashicons-analytics',
    'show_in_nav_menus'   => true,
    'publicly_queryable'  => true,
    'exclude_from_search' => false,
    'has_archive'         => false,
    'query_var'           => true,
    'can_export'          => true,
    'rewrite'             => true,
    'capability_type'     => 'post',
    'supports'            => array(
        'title', 'author', 'thumbnail',
        'revisions', 'page-attributes', 'post-formats'
        )
  );

  register_post_type( 'cuentas', $args );
}

add_action( 'init', 'wpbilbao_cpt_accounts' );



/**
 * Create a taxonomy
 *
 * @uses  Inserts new taxonomy object into the list
 * @uses  Adds query vars
 *
 * @param string  Name of taxonomy object
 * @param array|string  Name of the object type for the taxonomy object.
 * @param array|string  Taxonomy arguments
 * @return null|WP_Error WP_Error if errors, otherwise null.
 */
function wpbilbao_taxonomies_accounts() {

  $labels = array(
    'name'                  => _x( 'Types', 'Taxonomy plural name', 'wpbilbao-accounts-cpt' ),
    'singular_name'         => _x( 'Type', 'Taxonomy singular name', 'wpbilbao-accounts-cpt' ),
    'search_items'          => __( 'Search Types', 'wpbilbao-accounts-cpt' ),
    'popular_items'         => __( 'Popular Types', 'wpbilbao-accounts-cpt' ),
    'all_items'             => __( 'All Types', 'wpbilbao-accounts-cpt' ),
    'parent_item'           => __( 'Parent Type', 'wpbilbao-accounts-cpt' ),
    'parent_item_colon'     => __( 'Parent Type:', 'wpbilbao-accounts-cpt' ),
    'edit_item'             => __( 'Edit Type', 'wpbilbao-accounts-cpt' ),
    'update_item'           => __( 'Update Type', 'wpbilbao-accounts-cpt' ),
    'add_new_item'          => __( 'Add New Type', 'wpbilbao-accounts-cpt' ),
    'new_item_name'         => __( 'New Type Name', 'wpbilbao-accounts-cpt' ),
    'add_or_remove_items'   => __( 'Add or Remove Types', 'wpbilbao-accounts-cpt' ),
    'choose_from_most_used' => __( 'Choose from most used', 'wpbilbao-accounts-cpt' ),
    'menu_name'             => __( 'Type', 'wpbilbao-accounts-cpt' ),
  );

  $args = array(
    'labels'            => $labels,
    'public'            => true,
    'show_in_nav_menus' => true,
    'show_admin_column' => false,
    'hierarchical'      => true,
    'show_tagcloud'     => true,
    'show_ui'           => true,
    'query_var'         => true,
    'rewrite'           => true,
    'query_var'         => true,
    'capabilities'      => array(),
  );

  register_taxonomy( 'tipo', array( 'cuentas' ), $args );
}

add_action( 'init', 'wpbilbao_taxonomies_accounts' );



function wpbilbao_cpt_accounts_rewrite_flush() {
  // First, we "add" the custom post type via the above written function.
  // Note: "add" is written with quotes, as CPTs don't get added to the DB,
  // They are only referenced in the post_type column with a post entry,
  // when you add a post of this CPT.
  wpbilbao_cpt_accounts();

  // ATTENTION: This is *only* done during plugin activation hook in this example!
  // You should *NEVER EVER* do this on every page load!!
  flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'wpbilbao_cpt_accounts_rewrite_flush' );


@include 'lib/loop-cuentas-2015.php';
@include 'lib/loop-cuentas-2016.php';


// We create the Page Template for tht Accounts Page
@include 'lib/create-page-template.php';


