<?php
// Clean up wordpres <head>
remove_action('wp_head', 'rsd_link'); // remove really simple discovery link
remove_action('wp_head', 'wp_generator'); // remove wordpress version
remove_action('wp_head', 'feed_links', 2); // remove rss feed links (make sure you add them in yourself if youre using feedblitz or an rss service)
remove_action('wp_head', 'feed_links_extra', 3); // removes all extra rss feed links
remove_action('wp_head', 'index_rel_link'); // remove link to index page
remove_action('wp_head', 'wlwmanifest_link'); // remove wlwmanifest.xml (needed to support windows live writer)
remove_action('wp_head', 'start_post_rel_link', 10, 0); // remove random post link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // remove parent post link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // remove the next and previous post links
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action('wp_head', 'rest_output_link_wp_head', 10); // Disable REST API link tag
remove_action('wp_head', 'wp_oembed_add_discovery_links', 10); // Disable oEmbed Discovery Links
remove_action('template_redirect', 'rest_output_link_header', 11, 0); // Disable REST API link in HTTP headers
remove_action('wp_head', 'rel_canonical'); // Disabling default canonical linking because of an issue with the insights page
/**
 * Declare theme support
 * ( cf :  http://codex.wordpress.org/Function_Reference/add_theme_support )
 */
function theme_set_theme_supports()
{
    global $wp_version;

    add_theme_support('menus');
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');

    // Custom logo.
  $logo_width  = 256;
  $logo_height = 256;

  // If the retina setting is active, double the recommended width and height.
  if (get_theme_mod('retina_logo', false)) {
    $logo_width  = floor($logo_width * 2);
    $logo_height = floor($logo_height * 2);
  }

  add_theme_support(
    'custom-logo',
    array(
      'height'      => $logo_height,
      'width'       => $logo_width,
      'flex-height' => true,
      'flex-width'  => true,
    )
  );
}
add_action('after_setup_theme', 'theme_set_theme_supports');

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
  global $post;
  if (is_home()) {
    $key = array_search('blog', $classes);
    if ($key > -1) {
      unset($classes[$key]);
    }
  } elseif (is_page()) {
    $classes[] = sanitize_html_class($post->post_name);
  } elseif (is_singular()) {
    $classes[] = sanitize_html_class($post->post_name);
  }
  return $classes;
}
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)

//Register wp-admin ajax url
add_action( 'wp_head', 'my_js_vars', 1000 );
function my_js_vars() {
    ?>
    <script type="text/javascript">
        /* <![CDATA[ */
        var WpUtils = {
            ajaxUrl: '<?php echo admin_url('admin-ajax.php'); ?>',
        };
        /* ]]> */
    </script>
    <?php
}

// Enable SVG to upload media
function cc_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');


/**
 * Add Browser and OS classes to body
 */
function browser_body_class($classes)
{
  global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
  if ($is_lynx) $classes[] = 'lynx';
  elseif ($is_gecko) $classes[] = 'firefox';
  elseif ($is_opera) $classes[] = 'opera';
  elseif ($is_NS4) $classes[] = 'ns4';
  elseif ($is_safari) $classes[] = 'safari';
  elseif ($is_chrome) $classes[] = 'chrome';
  elseif ($is_IE) {
    $classes[] = 'ie';
    if (preg_match('/MSIE ([0-9]+)([a-zA-Z0-9.]+)/', $_SERVER['HTTP_USER_AGENT'], $browser_version))
      $classes[] = 'ie' . $browser_version[1];
  } else $classes[] = 'unknown';
  if ($is_iphone) $classes[] = 'iphone';
  if (stristr($_SERVER['HTTP_USER_AGENT'], "mac")) {
    $classes[] = 'osx';
  } elseif (stristr($_SERVER['HTTP_USER_AGENT'], "linux")) {
    $classes[] = 'linux';
  } elseif (stristr($_SERVER['HTTP_USER_AGENT'], "windows")) {
    $classes[] = 'windows';
  }
  return $classes;
}
add_filter('body_class', 'browser_body_class');



/**
 * Removes the wordpress version from meta (rss too)
 */
remove_action('wp_head', 'wp_generator');
add_filter('the_generator', 'remove_wp_version_rss');
function remove_wp_version_rss()
{
  return '';
}

/**
 * Remove unsafe rest endpoints
 */
add_filter('rest_endpoints', 'remove_rest_endpoints');
function remove_rest_endpoints($endpoints)
{
  $unsafe_endpoints = [
    '/wp/v2/users',
    '/wp/v2/users/(?P<id>[\d]+)',
  ];

  foreach ($unsafe_endpoints as $unsafe_endpoint) {
    if (isset($endpoints[$unsafe_endpoint])) {
      unset($endpoints[$unsafe_endpoint]);
    }
  }

  return $endpoints;
}
