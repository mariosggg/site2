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
        'icon' => 'zmdi zmdi-grid',
        'title' => esc_html__('TB Add-Ons Elementor', 'fana'),
	)
);


// Addons General settings
Redux::set_section(
	$opt_name,
	array(
        'subsection' => true,
        'title' => esc_html__('General Add-Ons', 'fana'),
        'desc'       => esc_html__( 'Use the Toggle To Activate or Deactivate the TB Add-Ons elements below.', 'fana' ),
        'class' => 'tab-addons',
        'fields' => fana_redux_elementor_to_list_addons( fana_elementor_general_widgets() ),
	)
);

// Addons Header settings
Redux::set_section(
	$opt_name,
	array(
        'subsection' => true,
        'title' => esc_html__('Header Add-Ons', 'fana'),
        'desc'       => esc_html__( 'Use the Toggle To Activate or Deactivate the TB Add-Ons elements below.', 'fana' ),
        'class' => 'tab-addons',
        'fields' => fana_redux_elementor_to_list_addons( fana_elementor_header_widgets() ),
	)
);

// Addons WooCommerce settings
Redux::set_section(
	$opt_name,
	array(
        'subsection' => true,
        'title' => esc_html__('WooCommerce Add-Ons', 'fana'),
        'desc'       => esc_html__( 'Use the Toggle To Activate or Deactivate the TB Add-Ons elements below.', 'fana' ),
        'class' => 'tab-addons',
        'fields' => fana_redux_elementor_to_list_addons( fana_elementor_woocommerce_widgets() ),
	)
);
