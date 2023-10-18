<?php
/**
 * Templates Name: Elementor
 * Widget: Canvas Menu
 */
extract( $settings );
?>
<div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
    <?php $this->render_canvas_menu(); ?>
</div>
    