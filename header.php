<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>