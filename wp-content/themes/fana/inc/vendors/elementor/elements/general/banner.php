<?php

if (! defined('ABSPATH') || function_exists('Fana_Elementor_Banner')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Utils;

/**
 * Elementor tabs widget.
 *
 * Elementor widget that displays vertical or horizontal tabs with different
 * pieces of content.
 *
 * @since 1.0.0
 */
class Fana_Elementor_Banner extends Fana_Elementor_Widget_Base
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
        return 'tbay-banner';
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
        return esc_html__('Fana Banner', 'fana');
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
        return 'eicon-banner';
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
            'general_content_section',
            [
                'label' => esc_html__('General', 'fana'),
            ]
        );

        $this->add_control(
            'link',
            [
                'label'       => esc_html__('Link', 'fana'),
                'description' => esc_html__('Enter URL if you want this banner to have a link.', 'fana'),
                'type'        => Controls_Manager::URL,
                'default'     => [
                    'url'         => '#',
                    'is_external' => false,
                    'nofollow'    => false,
                ],
            ]
        );

        $this->end_controls_section();

        $this->register_controls_image_section();
        $this->register_controls_content_section();
        $this->register_controls_general_style();
        $this->register_controls_title_style();
        $this->register_controls_subtitle_style();
        $this->register_controls_description_style();
        $this->register_controls_label_style();
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
            'banner_effects',
            [
                'label' => esc_html__('Effects', 'fana'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'default' => 'no',
                'options' => $this->list_controls_effects(),
            ]
        );
        
        $this->add_control(
            'heading_wrap',
            [
                'label' => esc_html__('Wraper', 'fana'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_responsive_control(
            'general_padding',
            [
                'label'      => esc_html__('Padding', 'fana'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .wrapper-content-banner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('general_tabs');

        $this->start_controls_tab(
            'general_tab_normal',
            [
                'label' => esc_html__('Normal', 'fana'),
            ]
        );

        $this->add_control(
            'general_bg_color',
            [
                'label' => esc_html__('Background', 'fana'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wrapper-content-banner' => 'background: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_tab();

        $this->start_controls_tab(
            'general_tab_hover',
            [
                'label' => esc_html__('Hover', 'fana'),
            ]
        );

        $this->add_control(
            'general_bg_color_hover',
            [
                'label' => esc_html__('Background', 'fana'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wrapper-content-banner:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();
        
        $this->add_control(
            'heading_layout',
            [
                'label' => esc_html__('Layout Content', 'fana'),
                'type' => Controls_Manager::HEADING,
                'separator'   => 'before',
            ]
        );

        $this->add_responsive_control(
            'general_horizontal_alignment',
            [
                'label'   => esc_html__('Horizontal alignment', 'fana'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('left', 'fana'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'fana'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('right', 'fana'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .wrapper-content-banner' => 'align-items: {{VALUE}} !important;',
                ],
                'default' => 'flex-start',
            ]
        );

        $this->add_responsive_control(
            'general_vertical_alignment',
            [
                'label'   => esc_html__('Vertical alignment', 'fana'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Top', 'fana'),
                        'icon' => 'fa fa-arrow-up',
                    ],
                    'center' => [
                        'title' => esc_html__('Middle', 'fana'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('Bottom', 'fana'),
                        'icon' => 'fa fa-arrow-down',
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .wrapper-content-banner' => 'justify-content: {{VALUE}} !important;',
                ],
                'default' => 'flex-start',
            ]
        );

        $this->add_responsive_control(
            'general_text_alignment',
            [
                'label'   => esc_html__('Text alignment', 'fana'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('left', 'fana'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'fana'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('right', 'fana'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .content-banner' => 'text-align: {{VALUE}} !important;',
                ],
                'default' => 'left',
            ]
        );

        $this->add_responsive_control(
            'general_width',
            [
                'label'          => esc_html__('Max Width', 'fana'),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units'     => [ '%' ],
                'range'          => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .content-banner' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function register_controls_title_style()
    {
        $this->start_controls_section(
            'section_title_style',
            [
                'label' => esc_html__('Title', 'fana'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .banner-tbay-title .title',
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label'      => esc_html__('Margin', 'fana'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .banner-tbay-title .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        
        $this->add_responsive_control(
            'title_padding',
            [
                'label'      => esc_html__('Padding', 'fana'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .banner-tbay-title .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

       

        $this->start_controls_tabs('title_tabs');

        $this->start_controls_tab(
            'title_tab_normal',
            [
                'label' => esc_html__('Normal', 'fana'),
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Color', 'fana'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .banner-tbay-title .title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'title_bg_color',
            [
                'label' => esc_html__('Background', 'fana'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .banner-tbay-title .title' => 'background: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_tab();

        $this->start_controls_tab(
            'title_tab_hover',
            [
                'label' => esc_html__('Hover', 'fana'),
            ]
        );

        $this->add_control(
            'title_color_hover',
            [
                'label' => esc_html__('Hover Color', 'fana'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}:hover .banner-tbay-title .title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'title_bg_color_hover',
            [
                'label' => esc_html__('Background', 'fana'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}:hover .banner-tbay-title .title' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'border_title',
                'selector' => '{{WRAPPER}} .banner-tbay-title .title',
                'separator'   => 'before',
            ]
        );
        $this->add_control(
            'border_radius_title',
            [
                'label'     => esc_html__('Border Radius', 'fana'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors'  => [
                    '{{WRAPPER}} .banner-tbay-title .title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();
    }
    protected function register_controls_subtitle_style()
    {
        $this->start_controls_section(
            'section_subtitle_style',
            [
                'label' => esc_html__('Sub Title', 'fana'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'subtitle_typography',
                'selector' => '{{WRAPPER}} .banner-tbay-title .subtitle',
            ]
        );

        $this->add_responsive_control(
            'subtitle_margin',
            [
                'label'      => esc_html__('Margin', 'fana'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .banner-tbay-title .subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        
        $this->add_responsive_control(
            'subtitle_padding',
            [
                'label'      => esc_html__('Padding', 'fana'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .banner-tbay-title .subtitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('subtitle_tabs');

        $this->start_controls_tab(
            'subtitle_tab_normal',
            [
                'label' => esc_html__('Normal', 'fana'),
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label' => esc_html__('Color', 'fana'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .banner-tbay-title .subtitle' => 'color: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_tab();

        $this->start_controls_tab(
            'subtitle_tab_hover',
            [
                'label' => esc_html__('Hover', 'fana'),
            ]
        );

        $this->add_control(
            'subtitle_color_hover',
            [
                'label' => esc_html__('Hover Color', 'fana'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}:hover .banner-tbay-title .subtitle' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();
        
        $this->end_controls_section();
    }

    protected function register_controls_description_style()
    {
        $this->start_controls_section(
            'section_description_style',
            [
                 'label' => esc_html__('Description', 'fana'),
                 'tab'   => Controls_Manager::TAB_STYLE,
             ]
        );
 
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                 'name'     => 'description_typography',
                 'selector' => '{{WRAPPER}} .banner-description',
             ]
        );
 
        $this->add_responsive_control(
            'description_margin',
            [
                 'label'      => esc_html__('Margin', 'fana'),
                 'type'       => Controls_Manager::DIMENSIONS,
                 'size_units' => [ 'px', '%', 'em' ],
                 'selectors'  => [
                     '{{WRAPPER}} .banner-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                 ],
             ]
        );
         
         
        $this->add_responsive_control(
            'description_padding',
            [
                 'label'      => esc_html__('Padding', 'fana'),
                 'type'       => Controls_Manager::DIMENSIONS,
                 'size_units' => [ 'px', '%', 'em' ],
                 'selectors'  => [
                     '{{WRAPPER}} .banner-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                 ],
             ]
        );
 
        $this->start_controls_tabs('description_tabs');
 
        $this->start_controls_tab(
            'description_tab_normal',
            [
                 'label' => esc_html__('Normal', 'fana'),
             ]
        );
 
        $this->add_control(
            'description_color',
            [
                 'label' => esc_html__('Color', 'fana'),
                 'type' => Controls_Manager::COLOR,
                 'default' => '',
                 'selectors' => [
                     '{{WRAPPER}} .banner-description' => 'color: {{VALUE}};',
                 ],
             ]
        );
 
 
        $this->end_controls_tab();
 
        $this->start_controls_tab(
            'description_tab_hover',
            [
                 'label' => esc_html__('Hover', 'fana'),
             ]
        );
 
        $this->add_control(
            'description_color_hover',
            [
                 'label' => esc_html__('Hover Color', 'fana'),
                 'type' => Controls_Manager::COLOR,
                 'default' => '',
                 'selectors' => [
                     '{{WRAPPER}}:hover .banner-description' => 'color: {{VALUE}};',
                 ],
             ]
        );
 
        $this->end_controls_tab();
 
        $this->end_controls_tabs();
         
        $this->end_controls_section();
    }

    protected function register_controls_label_style()
    {
        $this->start_controls_section(
            'section_label_style',
            [
                'label' => esc_html__('Label', 'fana'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'label_typography',
                'selector' => '{{WRAPPER}} .banner-label span',
            ]
        );

        $this->add_responsive_control(
            'label_margin',
            [
                'label'      => esc_html__('Margin', 'fana'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .banner-label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        
        $this->add_responsive_control(
            'label_padding',
            [
                'label'      => esc_html__('Padding', 'fana'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .banner-label span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('label_tabs');

        $this->start_controls_tab(
            'label_tab_normal',
            [
                'label' => esc_html__('Normal', 'fana'),
            ]
        );

        $this->add_control(
            'label_color',
            [
                'label' => esc_html__('Color', 'fana'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .banner-label span' => 'color: {{VALUE}};',
                ],
            ]
        );

        if( fana_tbay_get_theme() !== 'kids' ) {
            $this->add_control(
                'label_bg_color',
                [
                    'label' => esc_html__('Background', 'fana'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .banner-label' => 'background: {{VALUE}};',
                        '{{WRAPPER}} .btn-theme-after:after' => 'border-color: {{VALUE}};',
                    ],
                ]
            );
        } else {
            $this->add_control(
                'label_bg_color',
                [
                    'label' => esc_html__('Background', 'fana'),
                    'type' => Controls_Manager::COLOR,
                    'default' => '',
                    'selectors' => [
                        '{{WRAPPER}} .banner-label span' => 'background: {{VALUE}};',
                    ],
                ]
            );
        }



        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'label_bg_border',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .banner-label span',
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'label_bg_border_radius',
            [
                'label' => esc_html__('Border Radius', 'fana'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .banner-label span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_tab();

        $this->start_controls_tab(
            'label_tab_hover',
            [
                'label' => esc_html__('Hover', 'fana'),
            ]
        );

        $this->add_control(
            'label_color_hover',
            [
                'label' => esc_html__('Hover Color', 'fana'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .banner-label span:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'label_bg_color_hover',
            [
                'label' => esc_html__('Background', 'fana'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .banner-label span:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'label_bg_border_hover',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .banner-label span:hover',
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'label_bg_border_radius_hover',
            [
                'label' => esc_html__('Border Radius', 'fana'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .banner-label span:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'label_css_classes',
            [
                'label'       => esc_html__('CSS Classes', 'fana'),
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => [
                    'active' => true,
                ],
                'label_block' => true,
            ]
        );
        
        $this->end_controls_section();
    }

    protected function register_controls_image_section()
    {
        /**
         * Image settings.
         */
        $this->start_controls_section(
            'image_content_section',
            [
                'label' => esc_html__('Image', 'fana'),
            ]
        );
        $this->add_control(
            'image',
            [
                'label'   => esc_html__('Choose image', 'fana'),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'image',
                'default'   => 'full',
                'separator' => 'none',
            ]
        );
        
        $this->end_controls_section();
    }

    protected function register_controls_content_section()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'fana'),
            ]
        );
        
        $this->add_control(
            'banner_title',
            [
                'label'       => esc_html__('Title', 'fana'),
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => [
                    'active' => true,
                ],
                'default'     => esc_html__('This is the heading', 'fana'),
                'placeholder' => esc_html__('Enter your title', 'fana'),
                'label_block' => true,
            ]
        );
  
        $this->add_control(
            'banner_title_tag',
            [
                'label'   => esc_html__('Title HTML Tag', 'fana'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'h1'   => 'H1',
                    'h2'   => 'H2',
                    'h3'   => 'H3',
                    'h4'   => 'H4',
                    'h5'   => 'H5',
                    'h6'   => 'H6',
                    'div'  => 'div',
                    'span' => 'span',
                    'p'    => 'p',
                ],
                'default' => 'h3',
            ]
        );
        
        $this->add_control(
            'banner_sub_title',
            [
                'label'       => esc_html__('Sub Title', 'fana'),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__('Enter your sub-title', 'fana'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'banner_description',
            [
                'label'       => esc_html__('Description', 'fana'),
                'type'        => Controls_Manager::TEXTAREA,
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
            'banner_label',
            [
                'label'   => esc_html__('Label', 'fana'),
                'type'    => Controls_Manager::TEXT,
            ]
        );

        $this->end_controls_section();
    }

    protected function render_item_image()
    {
        $settings = $this->get_settings_for_display(); ?>
        <div class="main-wrapp-img">
            <div class="banner-image">
                <?php echo  Elementor\Group_Control_Image_Size::get_attachment_image_html($settings); ?>
            </div>
        </div>
        <?php
    }

    protected function render_item_content()
    {
        $settings = $this->get_settings_for_display();
        extract($settings); ?>
        <div class="wrapper-content-banner">
            <div class="content-banner">
                <?php
                if (!empty($banner_subtitle) || !empty($banner_title)) : ?>
                    <<?php echo trim($banner_title_tag); ?> class="banner-tbay-title">
                        <?php if (!empty($banner_title)) : ?>
                        <span class="title"><?php echo trim($banner_title); ?></span>
                        <?php endif; ?>
                        <?php if (!empty($banner_sub_title)) : ?>
                        <span class="subtitle"><?php echo trim($banner_sub_title); ?></span>
                        <?php endif; ?>
                    </<?php echo trim($banner_title_tag); ?>>
                    <?php endif; ?>

                    <?php if (!empty($banner_description)) : ?>
                    <?php echo '<div class="banner-description">'. trim($banner_description) . '</div>'; ?>
                    <?php endif; ?>

                    <?php if (!empty($banner_label)) : ?>
                    <?php 
                        $label_css_classes = ( !empty( $label_css_classes ) ) ? $label_css_classes : '';
                        echo '<div class="banner-label '. esc_attr($label_css_classes) .'"><span>'. trim($banner_label) . '</span></div>'; 
                    ?>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }
}
$widgets_manager->register(new Fana_Elementor_Banner());