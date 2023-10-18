<?php

if (! defined('ABSPATH') || function_exists('Fana_Elementor_Testimonials')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

/**
 * Elementor tabs widget.
 *
 * Elementor widget that displays vertical or horizontal tabs with different
 * pieces of content.
 *
 * @since 1.0.0
 */
class Fana_Elementor_Testimonials extends Fana_Elementor_Carousel_Base
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
        return 'tbay-testimonials';
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
        return esc_html__('Fana Testimonials', 'fana');
    }

    public function get_script_depends()
    {
        return [ 'fana-custom-slick', 'slick' ];
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
        return 'eicon-testimonial';
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
        $this->register_controls_heading();

        $this->start_controls_section(
            'section_general',
            [
                'label' => esc_html__('General', 'fana'),
            ]
        );
 
        $this->add_control(
            'layout_type',
            [
                'label'     => esc_html__('Layout Type', 'fana'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'grid',
                'options'   => [
                    'grid'      => esc_html__('Grid', 'fana'),
                    'carousel'  => esc_html__('Carousel', 'fana'),
                ],
            ]
        );

        $this->add_control(
            'layout_style',
            [
                'label'     => esc_html__('Layout Style', 'fana'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'style1',
                'options'   => [
                    'style1'    => esc_html__('Style 1', 'fana'),
                    'style2'    => esc_html__('Style 2', 'fana'),
                    'style3'    => esc_html__('Style 3', 'fana'),
                ],
            ]
        );

        $repeater = $this->register_testimonials_repeater();

        $this->add_control(
            'testimonials',
            [
                'label' => esc_html__('Testimonials Items', 'fana'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => $this->register_set_testimonial_default(),
                'testimonials_field' => '{{{ testimonials_image }}}',
            ]
        ); 

        $this->end_controls_section();

        $this->style_testimonials();

        $this->add_control_responsive();
        $this->add_control_carousel(['layout_type' => 'carousel']);
    }

    protected function style_testimonials()
    {
        $this->start_controls_section(
            'section_style_testimonials',
            [
                'label' => esc_html__('Style Testimonials', 'fana'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_control(
            'heading_style_testimonials_description',
            [
                'label' => esc_html__('Description', 'fana'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'testimonials_description_typography',
                'selector' => '{{WRAPPER}} .excerpt',
            ]
        ); 

        $this->add_control(
            'testimonials_description_color',
            [
                'label' => esc_html__('Color', 'fana'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .excerpt' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'testimonials_description_margin',
            [
                'label' => esc_html__('Margin', 'fana'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .excerpt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'heading_style_testimonials_subtitle',
            [
                'label' => esc_html__('Sub Title', 'fana'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'testimonials_subtitle_typography',
                'selector' => '{{WRAPPER}} .subtitle',
            ]
        ); 

        $this->add_control(
            'testimonials_subtitle_color',
            [
                'label' => esc_html__('Color', 'fana'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .subtitle' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'testimonials_subtitle_margin',
            [
                'label' => esc_html__('Margin', 'fana'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'heading_style_testimonials_name',
            [
                'label' => esc_html__('Name', 'fana'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'testimonials_name_typography',
                'selector' => '{{WRAPPER}} .name',
            ]
        ); 

        $this->add_control(
            'testimonials_name_color',
            [
                'label' => esc_html__('Color', 'fana'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .name' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'testimonials_name_margin',
            [
                'label' => esc_html__('Margin', 'fana'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

                
        $this->add_control(
            'heading_style_testimonials_subname',
            [
                'label' => esc_html__('Sub Name', 'fana'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'testimonials_subname_typography',
                'selector' => '{{WRAPPER}} .sub-name',
            ]
        ); 

        $this->add_control(
            'testimonials_subname_color',
            [
                'label' => esc_html__('Color', 'fana'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .sub-name' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'testimonials_subname_margin',
            [
                'label' => esc_html__('Margin', 'fana'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .sub-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
                

        $this->end_controls_section();
    }

    private function register_testimonials_repeater()
    {
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'testimonial_image',
            [
                'label' => esc_html__('Choose Image: Avatar', 'fana'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        
        $repeater->add_control(
            'title_excerpt',
            [
                'label' => esc_html__('Excerpt', 'fana'),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $repeater->add_control(
            'testimonial_excerpt',
            [
                'label' => esc_html__('Description', 'fana'),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );
        $repeater->add_control(
            'testimonial_subtitle',
            [
                'label' => esc_html__('Sub-title', 'fana'),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );
        
        $repeater->add_control(
            'testimonial_name',
            [
                'label' => esc_html__('Name', 'fana'),
                'type' => Controls_Manager::TEXT,
            ]
        );
        $repeater->add_control(
            'testimonial_sub_name',
            [
                'label' => esc_html__('Sub Name', 'fana'),
                'type' => Controls_Manager::TEXT,
            ]
        );

        return $repeater;
    }

    private function register_set_testimonial_default()
    {
        $defaults = [
            [
                
                'testimonial_image' => [
                    'url' => Elementor\Utils::get_placeholder_image_src(),
                ],
                
                'testimonial_name' => esc_html__('Name 1', 'fana'),
                'testimonial_sub_name' => esc_html__('Sub name 1', 'fana'),
                'testimonial_excerpt' => esc_html__('Lorem ipsum dolor sit amet, in mel unum delicatissimi conclusionemque', 'fana'),
                'testimonial_subtitle' => esc_html__('This is text sub-title', 'fana'),
            ],
            [
                'testimonial_image' => [
                    'url' => Elementor\Utils::get_placeholder_image_src(),
                ],
                
                'testimonial_name' => esc_html__('Name 2', 'fana'),
                'testimonial_sub_name' => esc_html__('Sub name 2', 'fana'),
                'testimonial_excerpt' => esc_html__('Lorem ipsum dolor sit amet, in mel unum delicatissimi conclusionemque', 'fana'),
                'testimonial_subtitle' => esc_html__('This is text sub-title', 'fana'),
            ],
            [
                'testimonial_image' => [
                    'url' => Elementor\Utils::get_placeholder_image_src(),
                ],
                
                'testimonial_name' => esc_html__('Name 3', 'fana'),
                'testimonial_sub_name' => esc_html__('Sub name 3', 'fana'),
                'testimonial_excerpt' => esc_html__('Lorem ipsum dolor sit amet, in mel unum delicatissimi conclusionemque', 'fana'),
                'testimonial_subtitle' => esc_html__('This is text sub-title', 'fana'),
            ],
            [
                'testimonial_image' => [
                    'url' => Elementor\Utils::get_placeholder_image_src(),
                ],
                
                'testimonial_name' => esc_html__('Name 4', 'fana'),
                'testimonial_sub_name' => esc_html__('Sub name 4', 'fana'),
                'testimonial_excerpt' => 'Lorem ipsum dolor sit amet, in mel unum delicatissimi conclusionemque',
                'testimonial_subtitle' => esc_html__('This is text sub-title', 'fana'),
            ],
        ];

        return $defaults;
    }

    protected function render_item_style1($item)
    {
        ?> 
        <div class="testimonials-body style1"> 
                <div class="testimonial-meta">
                    <div class="testimonials-info-wrapper d-flex">
                        <div class="testimonial-img flex-shrink-0">
                            <?php echo $this->get_widget_field_img($item['testimonial_image']); ?>
                        </div>

                        <div class="testimonial-right flex-grow-1">
                            <div class="testimonial-rating"></div>
                            <?php $this->render_item_excerpt($item); ?>
                            <?php $this->render_item_subtitle($item); ?>

                            <div class="testimonials-info">
                                <?php  
                                    $this->render_item_name($item); 
                                    $this->render_item_sub_name($item);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <?php
                ?>
                <?php
            ?>
        </div>
        <?php
    }
    

    protected function render_item_style2($item)
    {
        ?> 
        <div class="testimonials-body style2"> 
            <div class="testimonial-meta">
                <div class="testimonials-info-wrapper">
                    <?php $this->render_item_excerpt($item); ?>

                    <div class="testimonial-rating"></div>

                    <div class="d-flex justify-content-center flex-testimonials">
                        <div class="testimonials-info">
                            <?php echo $this->get_widget_field_img($item['testimonial_image']); ?>
                        </div>
                        <div class="testimonials-name-sub">
                            <?php  
                                $this->render_item_name($item); 
                                $this->render_item_sub_name($item);
                            ?>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <?php
    }

    protected function render_item_style3($item)
    {
        ?> 
        <div class="testimonials-body style3"> 
            <div class="testimonial-meta">
                <div class="testimonials-info-wrapper">
                    <div class="testimonials-info d-flex">
                        <div class="flex-shrink-0">
                            <?php echo $this->get_widget_field_img($item['testimonial_image']); ?>
                        </div>
                        <div class="testimonials-info-right flex-grow-1 ms-3">
                            <?php  
                                $this->render_item_name($item); 
                                $this->render_item_sub_name($item);
                            ?>
                        </div>
                    </div>

                    <div class="testimonial-rating"></div>
                </div>
                <?php $this->render_item_excerpt($item); ?>
            </div>
        </div>
        <?php
    }
    

    private function render_item_name($item)
    {
        $testimonial_name  = $item['testimonial_name'];
        if (isset($testimonial_name) && !empty($testimonial_name)) {
            ?>
                <span class="name"><?php echo trim($testimonial_name); ?></span>
            <?php
        }
    }
    private function render_item_sub_name($item)
    {
        $testimonial_sub_name  = $item['testimonial_sub_name'];

        if (isset($testimonial_sub_name) && !empty($testimonial_sub_name)) {
            ?>
                <span class="sub-name"><?php echo trim($testimonial_sub_name) ?></span>
            <?php
        }
    }
    private function render_item_excerpt($item)
    {
        $testimonial_excerpt  = $item['testimonial_excerpt'];

        if ( isset($testimonial_excerpt) && !empty($testimonial_excerpt) ) {
            ?>  
                <div class="excerpt"><?php echo trim($testimonial_excerpt) ?></div>
            <?php
        }
    }

    private function render_item_subtitle($item)
    {
        $testimonial_subtitle  = $item['testimonial_subtitle'];

        if ( isset($testimonial_subtitle) && !empty($testimonial_subtitle) ) {
            ?>  
                <div class="subtitle"><?php echo trim($testimonial_subtitle) ?></div>
            <?php
        }
    }
}
$widgets_manager->register(new Fana_Elementor_Testimonials());
