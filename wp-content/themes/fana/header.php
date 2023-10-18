<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Fana
 * @since Fana 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="//gmpg.org/xfn/11" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="wrapper-container" class="<?php echo esc_attr(apply_filters('fana_class_wrapper_container', 'wrapper-container')); ?>">


	<?php
        /**
        * fana_before_theme_header hook
        *
        * @hooked fana_tbay_offcanvas_smart_menu - 10
        * @hooked fana_tbay_the_topbar_mobile - 20
        * @hooked fana_tbay_custom_form_login - 30
        * @hooked fana_tbay_footer_mobile - 40
        */
        do_action('fana_before_theme_header');
    ?>

	<?php get_template_part('headers/header'); ?>
	<?php
        /**
        * fana_after_theme_header hook
        */
        do_action('fana_after_theme_header');
    ?>

	<div id="tbay-main-content">