<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>

  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="shortcut icon" href="<?= get_bloginfo('template_directory') ?>/favicon.ico" type="image/x-icon">
  <?php wp_head(); ?>


  <?php if (get_template_part('/template-parts/commons/codes-head')) { get_template_part('/template-parts/commons/codes-head'); }; ?>
</head>

<body <?php body_class();?>>
  <?php if (get_template_part('/template-parts/commons/codes-body')) { get_template_part('/template-parts/commons/codes-body'); }; ?>

  <?php get_template_part('template-parts/commons/header') ?>