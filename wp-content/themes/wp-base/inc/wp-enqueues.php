<?php
// Preload links
function preload_links()
{
  $manifest = json_decode(file_get_contents(get_template_directory_uri().'/build/assets.json'));

  $main = $manifest->main;
  $libs = $manifest->libs;
  $bootstrap = $manifest->bootstrap;

  $targets_main = [
    (object) [
      'src' => get_template_directory_uri() . '/build/' . $main->css,
      'as' => 'style',
      'type' => 'text/css'
    ],
    (object) [
      'src' => get_template_directory_uri() . '/build/' . $main->js,
      'as' => 'script',
      'type' => 'application/javascript'
    ]
  ];

  $targets_libs = [
    (object) [
      'src' => get_template_directory_uri() . '/build/' . $libs->css,
      'as' => 'style',
      'type' => 'text/css'
    ],
    (object) [
      'src' => get_template_directory_uri() . '/build/' . $libs->js,
      'as' => 'script',
      'type' => 'application/javascript'
    ]
  ];

  $targets_bootstrap = [
    (object) [
      'src' => get_template_directory_uri() . '/build/' . $bootstrap->css,
      'as' => 'style',
      'type' => 'text/css'
    ],
    (object) [
      'src' => get_template_directory_uri() . '/build/' . $bootstrap->js,
      'as' => 'script',
      'type' => 'application/javascript'
    ]
  ];

  $targets = array_merge($targets_bootstrap, $targets_libs, $targets_main);

  foreach ($targets as $key => $target) {
    echo "<link rel='preload' as='" . $target->as . "' href='" . $target->src . "' type='" . $target->type . "' >";
    echo "\n";
  }
}

add_action('wp_head', 'preload_links');