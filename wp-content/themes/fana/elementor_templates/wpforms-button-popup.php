<?php
/**
 * Templates Name: Elementor
 * Widget: WPForms Button Popup
 */
if ( empty($settings['button_title']) ) return;
?>
<div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
    <?php $this->render_item(); ?>
</div>