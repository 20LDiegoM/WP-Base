<?php
// Include your functions files here 
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
  require_once(__DIR__ . '/vendor/autoload.php');
};
include('inc/wp-setup.php');
include('inc/wp-enqueues.php');
include('inc/acf.php');
include('inc/acf-pages.php');
include('inc/acf-block.php');
include('inc/wp-menu.php');
include('inc/wp-ajax.php');
include('inc/wp-posts.php');
include('inc/api.php');
include('inc/wp-custom-functions.php');
include('inc/alm-functions.php');
