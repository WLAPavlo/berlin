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
        'meta_box_cb'       => 'post_categories_meta_box',
    );

    register_taxonomy('staff_category', array('staff'), $args);
}

add_action('init', 'register_staff_category_taxonomy');

// Create default staff categories
function create_default_staff_categories() {
    if (!term_exists('Pastors', 'staff_category')) {
        $pastors_term = wp_insert_term('Pastors', 'staff_category', array(
            'description' => 'Church Pastors',
            'slug'        => 'pastors'
        ));
        if (!is_wp_error($pastors_term)) {
            update_term_meta($pastors_term['term_id'], 'term_order', 1);
        }
    }

    if (!term_exists('Ministry Leaders', 'staff_category')) {
        $ministry_term = wp_insert_term('Ministry Leaders', 'staff_category', array(
            'description' => 'Ministry Leaders',
            'slug'        => 'ministry-leaders'
        ));
        if (!is_wp_error($ministry_term)) {
            update_term_meta($ministry_term['term_id'], 'term_order', 2);
        }
    }

    if (!term_exists('Deacons', 'staff_category')) {
        $deacons_term = wp_insert_term('Deacons', 'staff_category', array(
            'description' => 'Church Deacons',
            'slug'        => 'deacons'
        ));
        if (!is_wp_error($deacons_term)) {
            update_term_meta($deacons_term['term_id'], 'term_order', 3);
        }
    }
}

add_action('init', 'create_default_staff_categories');

// Add staff category metabox to staff edit screen
function add_staff_category_metabox() {
    // Remove the custom metabox since we're using the default taxonomy metabox
    remove_meta_box('staff_categorydiv', 'staff', 'side');
}
// Remove the duplicate metabox functionality since WordPress provides default taxonomy metabox
// add_action('add_meta_boxes', 'add_staff_category_metabox');

// Add custom column for staff category in admin
function add_staff_category_column($columns) {
    // Remove the default taxonomy column and add our custom one
    unset($columns['taxonomy-staff_category']);
    $columns['staff_category'] = __('Category', 'default');
    return $columns;
}
add_filter('manage_staff_posts_columns', 'add_staff_category_column');

// Display staff category in admin column
function display_staff_category_column($column, $post_id) {
    if ($column === 'staff_category') {
        $terms = get_the_terms($post_id, 'staff_category');
        if ($terms && !is_wp_error($terms)) {
            $term_names = array();
            foreach ($terms as $term) {
                $term_names[] = $term->name;
            }
            echo implode(', ', $term_names);
        } else {
            echo '—';
        }
    }
}
add_action('manage_staff_posts_custom_column', 'display_staff_category_column', 10, 2);

// Make staff category column sortable
function make_staff_category_sortable($columns) {
    $columns['staff_category'] = 'staff_category';
    return $columns;
}
add_filter('manage_edit-staff_sortable_columns', 'make_staff_category_sortable');

// Add filter dropdown for staff categories in admin
function add_staff_category_filter() {
    global $typenow;

    if ($typenow === 'staff') {
        $selected = isset($_GET['staff_category']) ? $_GET['staff_category'] : '';
        $terms = get_terms(array(
            'taxonomy' => 'staff_category',
            'hide_empty' => false,
        ));

        if ($terms) {
            echo '<select name="staff_category" id="staff_category">';
            echo '<option value="">All Categories</option>';
            foreach ($terms as $term) {
                printf(
                    '<option value="%s"%s>%s</option>',
                    $term->slug,
                    selected($selected, $term->slug, false),
                    $term->name
                );
            }
            echo '</select>';
        }
    }
}
add_action('restrict_manage_posts', 'add_staff_category_filter');

// Handle staff category filtering
function filter_staff_by_category($query) {
    global $pagenow;

    if (is_admin() && $pagenow === 'edit.php' && isset($_GET['post_type']) && $_GET['post_type'] === 'staff' && isset($_GET['staff_category']) && $_GET['staff_category'] !== '') {
        $query->query_vars['tax_query'] = array(
            array(
                'taxonomy' => 'staff_category',
                'field'    => 'slug',
                'terms'    => $_GET['staff_category']
            )
        );
    }
}
add_filter('parse_query', 'filter_staff_by_category');

// Handle staff category sorting
function handle_staff_category_sorting($query) {
    if (!is_admin() || !$query->is_main_query()) {
        return;
    }

    if ($query->get('orderby') === 'staff_category') {
        $query->set('meta_key', 'staff_category_order');
        $query->set('orderby', 'meta_value');
    }
}
add_action('pre_get_posts', 'handle_staff_category_sorting');

// Custom ordering for staff categories
function staff_category_custom_order($query) {
    if (!is_admin() && $query->is_main_query()) {
        if (is_tax('staff_category') || (isset($query->query_vars['post_type']) && $query->query_vars['post_type'] === 'staff')) {
            $query->set('meta_key', 'term_order');
            $query->set('orderby', 'meta_value_num menu_order');
            $query->set('order', 'ASC');
        }
    }
}
add_action('pre_get_posts', 'staff_category_custom_order');

// Add quick edit support for staff categories
function add_staff_category_quick_edit($column_name, $post_type) {
    if ($post_type !== 'staff' || $column_name !== 'staff_category') {
        return;
    }

    $terms = get_terms(array(
        'taxonomy' => 'staff_category',
        'hide_empty' => false,
    ));

    echo '<fieldset class="inline-edit-col-right">';
    echo '<div class="inline-edit-col">';
    echo '<label class="inline-edit-categories-label">' . __('Staff Category', 'default') . '</label>';
    echo '<ul class="cat-checklist staff-category-checklist">';

    foreach ($terms as $term) {
        echo '<li><label class="selectit">';
        echo '<input type="radio" name="staff_category[]" value="' . $term->term_id . '">';
        echo ' ' . esc_html($term->name);
        echo '</label></li>';
    }

    echo '</ul>';
    echo '</div>';
    echo '</fieldset>';
}
add_action('quick_edit_custom_box', 'add_staff_category_quick_edit', 10, 2);

// Save quick edit staff category
function save_quick_edit_staff_category($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (get_post_type($post_id) !== 'staff') {
        return;
    }

    if (isset($_POST['staff_category']) && !empty($_POST['staff_category'])) {
        $term_ids = array_map('intval', $_POST['staff_category']);
        wp_set_post_terms($post_id, $term_ids, 'staff_category');
    }
}
add_action('save_post', 'save_quick_edit_staff_category');

// Add instructions for staff ordering
function add_staff_ordering_instructions() {
    $screen = get_current_screen();
    if ($screen && $screen->post_type === 'staff') {
        echo '<div class="notice notice-info"><p><strong>:</strong></p></div>';
    }
}
add_action('admin_notices', 'add_staff_ordering_instructions');

// Enable drag and drop ordering for staff posts
function enable_staff_drag_drop_ordering() {
    $screen = get_current_screen();
    if ($screen && $screen->post_type === 'staff' && $screen->base === 'edit') {
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                if (typeof $.fn.sortable !== 'undefined') {
                    $('#the-list').sortable({
                        items: 'tr',
                        cursor: 'move',
                        axis: 'y',
                        containment: 'parent',
                        scrollSensitivity: 40,
                        helper: function(e, ui) {
                            ui.children().each(function() {
                                $(this).width($(this).width());
                            });
                            return ui;
                        },
                        update: function(event, ui) {
                            var order = $(this).sortable('toArray', {attribute: 'id'});
                            $.post(ajaxurl, {
                                action: 'update_staff_order',
                                order: order,
                                nonce: '<?php echo wp_create_nonce('staff_order_nonce'); ?>'
                            });
                        }
                    });
                }
            });
        </script>
        <style>
            #the-list tr { cursor: move; }
            #the-list tr:hover { background-color: #f5f5f5; }
        </style>
        <?php
    }
}
add_action('admin_footer', 'enable_staff_drag_drop_ordering');

// Handle AJAX request for updating staff order
function handle_staff_order_update() {
    if (!wp_verify_nonce($_POST['nonce'], 'staff_order_nonce')) {
        wp_die('Security check failed');
    }

    if (!current_user_can('edit_posts')) {
        wp_die('Insufficient permissions');
    }

    $order = $_POST['order'];

    foreach ($order as $position => $post_id) {
        $post_id = (int) str_replace('post-', '', $post_id);
        wp_update_post(array(
            'ID' => $post_id,
            'menu_order' => $position
        ));
    }

    wp_die('Order updated successfully');
}
add_action('wp_ajax_update_staff_order', 'handle_staff_order_update');