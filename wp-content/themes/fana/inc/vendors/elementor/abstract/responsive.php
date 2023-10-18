<?php
if (!defined('ABSPATH') || function_exists('Fana_Elementor_Responsive_Base')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;

abstract class Fana_Elementor_Responsive_Base extends Fana_Elementor_Widget_Base
{
    public function get_name()
    {
        return 'tbay-responsive';
    }

    /**
     * @since 2.1.0
     * @access private
     */
    public function get_columns()
    {
        $value = apply_filters('fana_admin_elementor_columns', [
           1 => 1,
           2 => 2,
           3 => 3,
           4 => 4,
           5 => 5,
           6 => 6,
           7 => 7,
           8 => 8,
           9 => 9
        ]);

        return $value;
    }

    protected function add_control_responsive($condition = array())
    {
        $this->start_controls_section(
            'section_responsive',
            [
                'label' => esc_html__('Responsive Settings', 'fana'),
                'type' => Controls_Manager::SECTION,
                'condition' => $condition,
            ]
        );
   

        $this->add_responsive_control(
            'column',
            [
                'label'     => esc_html__('Columns', 'fana'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 4,
                'options'   => $this->get_columns(),
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'desktop_default' => 4,
                'tablet_default' => 3,
                'mobile_default' => 2,
            ]
        );

        $this->add_control(
            'col_desktop',
            [
                'label'     => esc_html__('Columns desktop', 'fana'),
                'description' => esc_html__('Column apply when the width is between 1200px and 1600px', 'fana'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 4,
                'options'   => $this->get_columns(),
            ]
        );

        $this->add_control(
            'col_desktopsmall',
            [
                'label'     => esc_html__('Columns desktopsmall', 'fana'),
                'description' => esc_html__('Column apply when the width is between 992px and 1199px', 'fana'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 2,
                'options'   => $this->get_columns(),
            ]
        );
 
        $this->add_control(
            'col_landscape',
            [
                'label'     => esc_html__('Columns mobile landscape', 'fana'),
                'description' => esc_html__('Column apply when the width is between 576px and 767px', 'fana'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 2,
                'options'   => $this->get_columns(),
            ]
        );

        $this->end_controls_section();
    }

    
}
