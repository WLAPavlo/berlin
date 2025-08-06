<?php
/**
 * Staff Custom Post Type
 */

// Register Staff Custom Post Type
function register_staff_post_type() {
    $labels = array(
        'name'               => _x('Staff', 'post type general name', 'default'),
        'singular_name'      => _x('Staff Member', 'post type singular name', 'default'),
        'add_new'            => _x('Add New', 'staff member', 'default'),
        'add_new_item'       => __('Add New Staff Member', 'default'),
        'edit_item'          => __('Edit Staff Member', 'default'),
        'new_item'           => __('New Staff Member', 'default'),
        'all_items'          => __('All Staff', 'default'),
        'view_item'          => __('View Staff Member', 'default'),
        'search_items'       => __('Search Staff', 'default'),
        'not_found'          => __('No staff members found.', 'default'),
        'not_found_in_trash' => __('No staff members found in Trash.', 'default'),
        'parent_item_colon'  => '',
        'menu_name'          => 'Staff'
    );

    $args = array(
        'labels'        => $labels,
        'description'   => 'Church Staff Members',
        'public'        => true,
        'show_ui'       => true,
        'show_in_menu'  => true,
        'menu_icon'     => 'dashicons-groups',
        'menu_position' => 6,
        'supports'      => array(
            'title',
            'editor',
            'thumbnail',
            'page-attributes'
        ),
        'has_archive'   => false,
        'hierarchical'  => false,
        'rewrite'       => array('slug' => 'staff'),
        'capability_type' => 'post'
    );

    register_post_type('staff', $args);
}

add_action('init', 'register_staff_post_type');

// Register Staff Category Taxonomy
function register_staff_category_taxonomy() {
    $labels = array(
        'name'              => _x('Staff Categories', 'taxonomy general name', 'default'),
        'singular_name'     => _x('Staff Category', 'taxonomy singular name', 'default'),
        'search_items'      => __('Search Staff Categories', 'default'),
        'all_items'         => __('All Staff Categories', 'default'),
        'parent_item'       => __('Parent Staff Category', 'default'),
        'parent_item_colon' => __('Parent Staff Category:', 'default'),
        'edit_item'         => __('Edit Staff Category', 'default'),
        'update_item'       => __('Update Staff Category', 'default'),
        'add_new_item'      => __('Add New Staff Category', 'default'),
        'new_item_name'     => __('New Staff Category Name', 'default'),
        'menu_name'         => __('Staff Categories', 'default'),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'staff-category'),
        'show_in_rest'      => true,
    );

    register_taxonomy('staff_category', array('staff'), $args);
}

add_action('init', 'register_staff_category_taxonomy');

// Create default staff categories
function create_default_staff_categories() {
    if (!term_exists('Pastors', 'staff_category')) {
        wp_insert_term('Pastors', 'staff_category', array(
            'description' => 'Church Pastors',
            'slug'        => 'pastors'
        ));
    }

    if (!term_exists('Ministry Leaders', 'staff_category')) {
        wp_insert_term('Ministry Leaders', 'staff_category', array(
            'description' => 'Ministry Leaders',
            'slug'        => 'ministry-leaders'
        ));
    }

    if (!term_exists('Deacons', 'staff_category')) {
        wp_insert_term('Deacons', 'staff_category', array(
            'description' => 'Church Deacons',
            'slug'        => 'deacons'
        ));
    }
}

add_action('init', 'create_default_staff_categories');