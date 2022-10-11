<?php
// Preload links
// function preload_links()
// {
//   $manifest = json_decode(file_get_contents(get_template_directory_uri().'/build/manifest.json'));
//   var_dump($manifest);


//   $main = 'a';

//   $targets = [
//     (object) [
//       'src' => get_template_directory_uri() . '/build/' . $main->css,
//       'as' => 'style',
//       'type' => 'text/css'
//     ],
//     (object) [
//       'src' => get_template_directory_uri() . '/build/' . $main->js,
//       'as' => 'script',
//       'type' => 'application/javascript'
//     ]
//   ];
//   foreach ($targets as $key => $target) {
//     echo '<link rel="preload" as="' . $target->as . '" href="' . $target->src . '" type="' . $target->type . '" >';
//   }
// }

// add_action('wp_head', 'preload_links');