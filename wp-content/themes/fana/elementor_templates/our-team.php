<?php
/**
 * Templates Name: Elementor
 * Widget: Our Team
 */

if (empty($settings['our_team']) || !is_array($settings['our_team'])) {
    return;
}
$this->settings_layout();

$this->add_render_attribute('item', 'class', ['item', $settings['layout_style']]);

?>

<div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
    <?php $this->render_element_heading(); ?>

    <div <?php echo $this->get_render_attribute_string('row'); ?>>
        <?php foreach ($settings['our_team'] as $item) : ?>
        
            <div <?php echo $this->get_render_attribute_string('item'); ?>>
                <?php 
                    if( $settings['layout_style'] === 'style1' ) {
                        $this->render_item_style1($item);
                    } else {
                        $this->render_item_style2($item);
                    }
                ?>
            </div>

        <?php endforeach; ?>
    </div>
</div>