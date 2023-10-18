<?php
/**
 * @version    1.0
 * @package    fana
 * @author     Thembay Team <support@thembay.com>
 * @copyright  Copyright (C) 2023 Thembay.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Websites: https://thembay.com
 */
  function fana_child_enqueue_styles() {
    wp_enqueue_style( 'fana-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'fana-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'fana-style' ),
        wp_get_theme()->get('Version')
    );
  }

  add_action(  'wp_enqueue_scripts', 'fana_child_enqueue_styles', 10000 );