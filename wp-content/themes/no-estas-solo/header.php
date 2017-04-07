<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Mutual_eventos
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/img/ic.png" type="image/png" >
<link rel="profile" href="http://gmpg.org/xfn/11">

<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap-theme.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/animate.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/style.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/font-awesome/css/font-awesome.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/magnific-popup.css">
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.js"></script>

<?php wp_head(); ?>
</head>

<body>
