<?php
/**
 * Redux Framework checkbox config.
 * For full documentation, please visit: http://devs.redux.io/
 *
 * @package Redux Framework
 */

defined( 'ABSPATH' ) || exit;

/** General Settings **/
Redux::set_section(
	$opt_name,
	array(
        'icon' => 'zmdi zmdi-settings',
        'title' => esc_html__('General', 'fana'),
        'fields' => array(
            array(
                'id'        => 'active_theme',
                'type'      => 'image_select', 
                'compiler'  => true,
                'class'     => 'image-large active_skins',
                'title'     => esc_html__('Activated Skin', 'fana'),
                'options'   => fana_tbay_get_themes(),
                'default'   => 'basic'
            ), 
            array(
                'id'            => 'config_media',
                'type'          => 'switch',
                'title'         => esc_html__('Enable Config Image Size', 'fana'),
                'subtitle'      => esc_html__('Config image size in WooCommerce and Media Setting', 'fana'),
                'default'       => false
            ),
            array(
                'id' => 'ajax_dropdown_megamenu',
                'type' => 'switch',
                'title' => esc_html__('Enable "Ajax Dropdown" Mega Menu', 'fana'),
                'default' => false,
            ),
            array(
                'id' => 'dark_mode',
                'type' => 'switch',
                'title' => esc_html__('Enable Dark Mode', 'fana'),
                'default' => false,
            ),
        )
	)
);