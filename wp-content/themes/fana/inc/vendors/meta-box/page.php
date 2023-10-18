<?php
if (!function_exists('fana_register_page_meta_boxes')) {
    add_filter( 'rwmb_meta_boxes', 'fana_register_page_meta_boxes' );
    function fana_register_page_meta_boxes( $meta_boxes ) {
        $sidebars = fana_sidebars_array();

        $footers = array_merge(array('global' => esc_html__('Global Setting', 'fana')), fana_tbay_get_footer_layouts());
        $headers = array_merge(array('global' => esc_html__('Global Setting', 'fana')), fana_tbay_get_header_layouts());

        $prefix = 'tbay_page_';

        $fields = array(
            array(
                'id' => $prefix.'header_type',
                'type' => 'select',
                'name' => esc_html__('Header Layout Type', 'fana'),
                'description' => esc_html__('Choose a header for your website.', 'fana'),
                'options' => $headers,
                'std' => 'global'
            ),
            array(
                'id' => $prefix.'footer_type',
                'type' => 'select',
                'name' => esc_html__('Footer Layout Type', 'fana'),
                'description' => esc_html__('Choose a footer for your website.', 'fana'),
                'options' => $footers,
                'std' => 'global'
            ),
            array(
                'id' => $prefix.'show_breadcrumb',
                'type'      => 'switch',
                'style'     => 'rounded',            
                'name' => esc_html__('Show Breadcrumb?', 'fana'),
                'on_label'  => 'Yes',
                'off_label' => 'No',
                'std' => false,
            ),
            array(
                'name' => esc_html__('Select Breadcrumbs Layout', 'fana'),
                'id'   => $prefix.'breadcrumbs_layout',
                'type' => 'radio',
                'visible' => array( $prefix.'show_breadcrumb', '=', true ),
                'options' => array(
                    'image' => esc_html__('Background Image', 'fana'),
                    'color' => esc_html__('Background color', 'fana'),
                    'text' => esc_html__('Just text', 'fana')
                ),
                'std' => 'text',
            ),
            array(
                'id' => $prefix.'breadcrumb_color',
                'type' => 'color',
                'visible' => array( $prefix.'breadcrumbs_layout', '=', 'color' ),
                'name' => esc_html__('Breadcrumb Background Color', 'fana')
            ),
            array(
                'id' => $prefix.'breadcrumb_image',  
                'type' => 'single_image',
                'visible' => array( $prefix.'breadcrumbs_layout', '=', 'image' ),
                'name' => esc_html__('Breadcrumb Background Image', 'fana')
            ),
            array(
                'name' => esc_html__('Select Layout', 'fana'),
                'id'   => $prefix.'layout',
                'type' => 'select',
                'options' => array(
                    'main' => esc_html__('Main Content Only', 'fana'),
                    'left-main' => esc_html__('Left Sidebar - Main Content', 'fana'),
                    'main-right' => esc_html__('Main Content - Right Sidebar', 'fana'),
                )
            ),
            array(
                'id' => $prefix.'left_sidebar',
                'type' => 'select',
                'name' => esc_html__('Left Sidebar', 'fana'),
                'options' => $sidebars
            ),
            array(
                'id' => $prefix.'right_sidebar',
                'type' => 'select',
                'name' => esc_html__('Right Sidebar', 'fana'),
                'options' => $sidebars
            ),
            array(
                'id' => $prefix.'extra_class',
                'type' => 'text',
                'name' => esc_html__('Extra Class', 'fana'),
                'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'fana')
            )
        );

        $meta_boxes[$prefix . 'display_setting'] = array(
            'id'                        => $prefix . 'display_setting',
            'title'                     => esc_html__('Display Settings', 'fana'),
            'post_types'                => ['page'],
            'context'                   => 'normal',
            'priority'                  => 'high',
            'autosave'                  => true,
            'fields'                    => $fields
        );

        return $meta_boxes;
    }
}