<?php

$text_domain =   esc_html__(' Comments', 'fana');
if (get_comments_number() == 1) {
    $text_domain = esc_html__(' Comment', 'fana');
}
$thumbsize                  = isset($thumbnail_size_size) ? $thumbnail_size_size : 'thumbnail';
$short_descriptions 		= fana_tbay_get_boolean_query_var('enable_short_descriptions');
$read_more 					= fana_tbay_get_boolean_query_var('enable_readmore');
if (get_comments_number() == 1) {
    $text_domain = esc_html__(' comment', 'fana');
}

?>
<div class="post item-post single-reladted">   
    <figure class="entry-thumb <?php echo(!has_post_thumbnail() ? 'no-thumb' : ''); ?>">
        <a href="<?php the_permalink(); ?>"  class="entry-image">
            <?php 
                if (fana_elementor_activated()) {
                    the_post_thumbnail($thumbsize);
                } else {
                    the_post_thumbnail();
                }
            ?>
        </a> 
    </figure>
    <div class="entry-header">

        <?php if (get_the_category_list()) {
            ?>
                <div class="entry-category"><?php fana_the_post_category_full() ?></div>
            <?php
        } ?>
        
        <ul class="entry-meta-list"> 
            <li class="entry-author">
                <i class="tb-icon tb-icon-profile"></i>
                <span><?php esc_html_e('By ', 'fana'); ?></span> <?php echo get_the_author_posts_link(); ?>
            </li>

            <?php if (comments_open()): ?>
                <li class="comments-link">
                <i class="tb-icon tb-icon-message"></i> 
                    <?php comments_popup_link(
                    '0' .'<span>'. $text_domain .'</span>',
                    '1' .'<span>'. $text_domain .'</span>',
                    '%' .'<span>'. $text_domain .'</span>'
                ); ?>
                </li>
            <?php endif; ?>

            <li class="entry-date"><i class="tb-icon tb-icon-clock"></i><?php echo fana_time_link(); ?></li>
            
        </ul>

        <?php if (get_the_title()) : ?>
            <h3 class="entry-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h3>
        <?php endif; ?>

        <?php if ($short_descriptions) : ?>
            <?php fana_post_archive_the_short_description(); ?>
        <?php endif; ?>

        <?php if ($read_more) : ?>
            <?php fana_post_archive_the_read_more(); ?>
        <?php endif; ?>

    </div>
</div>
