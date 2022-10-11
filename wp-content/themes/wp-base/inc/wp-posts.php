<?php 
//Register custom post type and taxonomies
 
// add_action('init', 'createCustomPostType');

// function createCustomPostType()
// {
//  // Post Types Array
//  $postsType = array(
//   'lugares' => array(
//     'name' => 'lugares', // Post Types Name
//     'icon' => 'dashicons-location' // Post Types icon
//   ),
//   'hoteles' => array(
//     'name' => 'hoteles',
//     'icon' => 'dashicons-admin-home'
//   ),
//   'transportes' => array(
//     'name' => 'transportes',
//     'icon' => 'dashicons-groups'
//   ),
//   'tours' => array(
//     'name' => 'tours',
//     'icon' => 'dashicons-megaphone'
//   ),
//   'restaurantes' => array(
//     'name' => 'restaurantes',
//     'icon' => 'dashicons-menu'
//   ),
//   'eventos' => array(
//     'name' => 'eventos',
//     'icon' => 'dashicons-admin-users'
//   ),
//   'turisteando' => array(
//     'name' => 'turisteando',
//     'icon' => 'dashicons-admin-users'
//   ),
// );

//   foreach ($postsType() as $postType) {
//     register_post_type(
//       $postType['name'],
//       array(
//         'labels' => array(
//           'name'          => __(ucfirst($postType['name'])),
//           'singular_name' => __(ucfirst($postType['name'])),
//           'all_items'     => __('All ' . ucfirst($postType['name'])),
//           'add_new'       => __('Add New'),
//           'add_new_item'  => __('Add New ' . ucfirst($postType['name'])),
//         ),
//         'public'              => true,
//         'exclude_from_search' => false,
//         'show_ui'             => true,
//         'query_var'           => true,
//         'menu_icon'           => $postType['icon'],
//         'rewrite'             => array('slug' => $postType['name']),
//         'capability_type'     => 'post',
//         'hierarchical'        => false,
//         'show_in_rest'        => true,
//         'has_archive'         => true,
//         'supports'            => array('title', 'editor', 'author', 'page-attributes', 'author', 'thumbnail', 'revisions')
//       )
//     );

//     register_taxonomy(
//       $postType['name'].'_category', // Slug
//       // Post Types Array
//       array(
//         $postType['name']
//       ),
//       // Taxonomy Properties
//       array(
//         'label'              => __($postType['name'].'Category'),
//         'hierarchical'       => true,
//         'show_admin_column'  => true,
//         'show_ui'            => true,
//         'query_var'          => true,
//         'publicly_queryable' => true,
//         'show_in_rest' => true
//       )
//     );
//   };
// };

























// Custom Post Type Example

/*add_action('init', 'create_custom_post_type');
function create_custom_post_type()
{
    register_post_type('custom',
        array(
            'labels'              => array(
                'name'          => __('Custom'),
                'menu_name'     => __('Custom'),
                'all_items'     => __('All Custom Items'),
                'singular_name' => __('Custom'),
                'add_new_item'  => __('Add New Custom'),
            ),
            'public'              => true,
            'publicly_queryable'  => true,
            'show_ui'             => true,
            'exclude_from_search' => false,
            'show_in_nav_menus'   => true,
            'has_archive'         => false,
            'rewrite'             => array('slug' => 'custom'),
            'taxonomies'          => array(''),
            'menu_icon'           => 'dashicons-info',
            'hierarchical'        => true,
            'show_in_rest'        => true,
            'supports'            => array('title', 'author', 'thumbnail', 'page-attributes','revisions'),
        )
    );
}

add_action('init', 'custom_type_category');
function custom_type_category()
{
    register_taxonomy(
        'custom-type-category',
        array('custom'),
        array(
             'rewrite' => array(
                'slug' => 'custom'
            ),
            'label'              => __('Custom Categories'),
            'hierarchical'       => true,
            'show_admin_column'  => true,
            'show_ui'            => true,
            'query_var'          => true,
            'publicly_queryable' => true,
        )
    );
}*/