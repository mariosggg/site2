<?php
$style           = isset($style) ? $style : 'post-style-2';
$thumbsize       = isset($thumbnail_size_size) ? $thumbnail_size_size : 'medium';
$show_title      = fana_switcher_to_boolean($show_title); ;
$show_category   = fana_switcher_to_boolean($show_category);
$show_author     =  fana_switcher_to_boolean($show_author);
$show_date       =  fana_switcher_to_boolean($show_date);
$show_comments   =  fana_switcher_to_boolean($show_comments);
$show_comments_text   =  fana_switcher_to_boolean($show_comments_text);
$post_title_tag       = isset($post_title_tag) ? $post_title_tag : 'h3';
$show_excerpt    =  fana_switcher_to_boolean($show_excerpt);
$excerpt_length  = isset($excerpt_length) ? $excerpt_length : 15;
$show_read_more  =  fana_switcher_to_boolean($show_read_more);
$read_more_text  = isset($read_more_text) ? $read_more_text : esc_html__('Continue Reading', 'fana');


$text_domain               = esc_html__(' comments', 'fana');
if (get_comments_number() == 1) {
    $text_domain = esc_html__(' comment', 'fana');
}

?>
<article class="post item-post <?php echo esc_attr($style); ?>">   
    <?php
        if(has_post_thumbnail()) {
            ?>
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
            <?php
        }

    ?> 

    
    <div class="entry-header">
        <?php fana_post_meta(array(
            'date'          => $show_date,
            'author'        => $show_author,
            'author_img'    => 0,
            'comments'      => $show_comments,
            'comments_text' => $show_comments_text,
            'tags'          => 0,
            'cats'          => $show_category,
            'edit'          => 0,
        )); ?>
        
        <?php do_action('fana_blog_before_meta_list'); ?>
        
        <?php if ($show_title && get_the_title()) : ?>
            <<?php echo trim($post_title_tag); ?> class="entry-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </<?php echo trim($post_title_tag); ?>>
        <?php endif; ?>

        <?php if ($show_excerpt) : ?>
            <div class="entry-description"><?php echo fana_tbay_substring(get_the_excerpt(), $excerpt_length, '...'); ?></div>
        <?php endif; ?>

        <?php 
            if ($show_read_more) {
                fana_post_archive_the_read_more($read_more_text);
            } 
        ?>

        <?php do_action('fana_blog_after_meta_list'); ?>
    </div>
</article>
