<?php

if (! defined('ABSPATH') || function_exists('Fana_Elementor_Compare_Our_Fit')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;


/**
 * Elementor tabs widget.
 *
 * Elementor widget that displays vertical or horizontal tabs with different
 * pieces of content.
 *
 * @since 1.0.0
 */
class Fana_Elementor_Compare_Our_Fit extends Fana_Elementor_Widget_Base
{
    /**
     * Get widget name.
     *
     * Retrieve tabs widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'tbay-compare-our-fit';
    }

    /**
     * Get widget title.
     *
     * Retrieve tabs widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return esc_html__('Fana Compare Our Fit', 'fana');
    }

 
    /**
     * Get widget icon.
     *
     * Retrieve tabs widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'eicon-sync';
    }

    /**
     * Register tabs widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */

    protected function register_controls()
    {
        $this->start_controls_section(
            'heading_our_fit_left_section',
            [
                'label' => esc_html__('Our Fit Left', 'fana'),
            ]
        );

        $this->add_control(
            'our_fit_image_left',
            [
                'label' => esc_html__('Choose Image', 'fana'),
                'type' => Controls_Manager::MEDIA,
            ]
        ); 

        $this->add_control(
            'our_fit_title_left',
            [
                'label'       => esc_html__('Title', 'fana'),
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => [
                    'active' => true,
                ],
                'default'     => esc_html__('This is the heading', 'fana'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'our_fit_description_left_first',
            [
                'label'       => esc_html__('Description First', 'fana'),
                'type'        => Controls_Manager::WYSIWYG,
                'dynamic'     => [
                    'active' => true,
                ],
                'default'     => esc_html__('Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'fana'),
                'placeholder' => esc_html__('Enter your description', 'fana'),
                'separator'   => 'none',
                'rows'        => 10,
            ]
        );

        $this->add_control(
            'our_fit_description_left_second',
            [
                'label'       => esc_html__('Description Second', 'fana'),
                'type'        => Controls_Manager::WYSIWYG,
                'dynamic'     => [
                    'active' => true,
                ],
                'default'     => esc_html__('Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'fana'),
                'placeholder' => esc_html__('Enter your description', 'fana'),
                'separator'   => 'none',
                'rows'        => 10,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'heading_our_fit_right_section',
            [
                'label' => esc_html__('Our Fit Right', 'fana'),
            ]
        );

        $this->add_control(
            'our_fit_image_right',
            [
                'label' => esc_html__('Choose Image', 'fana'),
                'type' => Controls_Manager::MEDIA,
            ]
        ); 

        $this->add_control(
            'our_fit_title_right',
            [
                'label'       => esc_html__('Title', 'fana'),
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => [
                    'active' => true,
                ],
                'default'     => esc_html__('This is the heading', 'fana'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'our_fit_description_right_first',
            [
                'label'       => esc_html__('Description First', 'fana'),
                'type'        => Controls_Manager::WYSIWYG,
                'dynamic'     => [
                    'active' => true,
                ],
                'default'     => esc_html__('Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'fana'),
                'placeholder' => esc_html__('Enter your description', 'fana'),
                'separator'   => 'none',
                'rows'        => 10,
            ]
        );

        $this->add_control(
            'our_fit_description_right_second',
            [
                'label'       => esc_html__('Description Second', 'fana'),
                'type'        => Controls_Manager::WYSIWYG,
                'dynamic'     => [
                    'active' => true,
                ],
                'default'     => esc_html__('Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'fana'),
                'placeholder' => esc_html__('Enter your description', 'fana'),
                'separator'   => 'none',
                'rows'        => 10,
            ]
        );

        $this->end_controls_section();

        $this->register_controls_general_style();
    }
    
    protected function register_controls_general_style()
    {
        $this->start_controls_section(
            'section_general_style',
            [
                'label' => esc_html__('General', 'fana'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'heading_our_fit_top',
            [
                'label' => esc_html__('Our Fit Top', 'fana'),
                'type' => Controls_Manager::HEADING,
                'separator'    => 'before',
            ]
        );

        $this->start_controls_tabs('general_tabs');

        $this->start_controls_tab(
            'our_fit_top_tab_normal',
            [
                'label' => esc_html__('Normal', 'fana'),
            ]
        );

        $this->add_control(
            'our_fit_top_text_bg_color',
            [
                'label' => esc_html__('Background', 'fana'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .our-fit-top' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'our_fit_top_tab_hover',
            [
                'label' => esc_html__('Hover', 'fana'),
            ]
        );

        $this->add_control(
            'our_fit_top_bg_color_hover',
            [
                'label' => esc_html__('Background', 'fana'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .our-fit-top:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'our_fit_top_title_margin',
            [
                'label'      => esc_html__('Margin', 'fana'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .our-fit-top' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'heading_title',
            [
                'label' => esc_html__('Title', 'fana'),
                'type' => Controls_Manager::HEADING,
                'separator'    => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'general_title_typography',
                'selector' => '{{WRAPPER}} .title',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Color', 'fana'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'general_title_align',
            [
                'label' => esc_html__('Align', 'fana'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'fana'),
                        'icon' => 'fa fa-align-left'
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'fana'),
                        'icon' => 'fa fa-align-center'
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'fana'),
                        'icon' => 'fa fa-align-right'
                    ],
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .title'  => 'text-align: {{VALUE}}',
                ]
            ]
        );

        $this->add_responsive_control(
            'general_title_margin',
            [
                'label'      => esc_html__('Margin', 'fana'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'heading_description_first',
            [
                'label' => esc_html__('Description First', 'fana'),
                'type' => Controls_Manager::HEADING,
                'separator'    => 'before',
            ]
        );

        $this->add_control(
            'description_first_color',
            [
                'label' => esc_html__('Color', 'fana'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .text-first' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'general_description_first_typography',
                'selector' => '{{WRAPPER}} .text-first',
            ]
        );

        $this->add_responsive_control(
            'general_description_first_align',
            [
                'label' => esc_html__('Align', 'fana'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'fana'),
                        'icon' => 'fa fa-align-left'
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'fana'),
                        'icon' => 'fa fa-align-center'
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'fana'),
                        'icon' => 'fa fa-align-right'
                    ],
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .text-first'  => 'text-align: {{VALUE}}',
                ]
            ]
        );

        $this->add_responsive_control(
            'general_description_first_margin',
            [
                'label'      => esc_html__('Margin', 'fana'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .text-first' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'heading_description_second',
            [
                'label' => esc_html__('Description Second', 'fana'),
                'type' => Controls_Manager::HEADING,
                'separator'    => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'general_description_second_typography',
                'selector' => '{{WRAPPER}} .text-second',
            ]
        );

        
        $this->add_control(
            'description_second_color',
            [
                'label' => esc_html__('Color', 'fana'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .text-second' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'general_description_second_align',
            [
                'label' => esc_html__('Align', 'fana'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'fana'),
                        'icon' => 'fa fa-align-left'
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'fana'),
                        'icon' => 'fa fa-align-center'
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'fana'),
                        'icon' => 'fa fa-align-right'
                    ],
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .text-second'  => 'text-align: {{VALUE}}',
                ]
            ]
        );

        $this->add_responsive_control(
            'general_description_second_margin',
            [
                'label'      => esc_html__('Margin', 'fana'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .text-second' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render_item_left() {
        $settings = $this->get_settings_for_display();

        $html = '<div class="content-wrapper our-fit-left col-lg-5">';

        $html .= '<div class="our-fit-text">';

        $html .= '<div class="our-fit-top">';

        if( ! empty( $settings['our_fit_title_left'] ) ) {
            $html .= '<h3 class="title">'. $settings['our_fit_title_left'] .'</h3>';
        }

        if( ! empty( $settings['our_fit_description_left_first'] ) ) {
            $html .= '<div class="text-first">'. $settings['our_fit_description_left_first'] .'</div>';
        }

        $html .= '</div>';

        $html .= '<div class="our-fit-bottom">';

        if( ! empty( $settings['our_fit_description_left_second'] ) ) {
            $html .= '<div class="text-second">'. $settings['our_fit_description_left_second'] .'</div>';
        }

        $html .= '</div>';

        $html .= '</div>';


		if ( ! empty( $settings['our_fit_image_left']['url'] ) ) {

			$image_html = wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'our_fit_image_left' ) );

			$html .= '<figure class="our-fit-img">' . $image_html . '</figure>';
		}

        $html .= '</div>';
        

        return $html;
    }

    
    protected function render_item_right() {
        $settings = $this->get_settings_for_display();

        $html = '<div class="content-wrapper our-fit-right col-lg-5">';

		if ( ! empty( $settings['our_fit_image_right']['url'] ) ) {

			$image_html = wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'our_fit_image_right' ) );

			$html .= '<figure class="our-fit-img">' . $image_html . '</figure>';
		}

        $html .= '<div class="our-fit-text">';

        $html .= '<div class="our-fit-top">';

        if( ! empty( $settings['our_fit_title_right'] ) ) {
            $html .= '<h3 class="title">'. $settings['our_fit_title_right'] .'</h3>';
        }

        if( ! empty( $settings['our_fit_description_right_first'] ) ) {
            $html .= '<div class="text-first">'. $settings['our_fit_description_right_first'] .'</div>';
        }

        $html .= '</div>';

        $html .= '<div class="our-fit-bottom">';

        if( ! empty( $settings['our_fit_description_right_second'] ) ) {
            $html .= '<div class="text-second">'. $settings['our_fit_description_right_second'] .'</div>';
        }

        $html .= '</div>';

        $html .= '</div>';

        $html .= '</div>';
        

        return $html;
    }

    public function render_item() {

        $html = '<div class="elementor-our-fit-wrapper row">';

        $html .= $this->render_item_left();

        $html .= '<div class="our-fit-center col-lg-2"><span>VS</span></div>';

        $html .= $this->render_item_right();

        $html .= '</div>';

        Utils::print_unescaped_internal_string( $html );
    }
}
$widgets_manager->register(new Fana_Elementor_Compare_Our_Fit());