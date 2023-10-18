<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage Fana
 * @since Fana 1.0
 */
/*

*Template Name: 404 Page
*/
get_header();
$image = fana_tbay_get_config('img_404');
if (isset($image['url']) && !empty($image['url'])) {
    $image = $image['url'];
} else {
    $image = FANA_IMAGES . '/img-404.jpg';
}
?>

<section id="main-container" class="container inner page-404">
	<div id="main-content" class="main-page">
		<div class="row">

			<div class="col-md-3"></div>
			<div class="col-md-6">
				<div class="fana-img-404">
					<img src="<?php echo esc_url($image); ?>" alt="<?php esc_attr_e('Img 404', 'fana'); ?>">
				</div>

				<section class="error-404">
					<h1 class="title-404"><?php esc_html_e('Page Not Found', 'fana') ?></h1>

					<div class="fana-content-404">
						<p class="sub-title"><?php esc_html_e( 'We’re very sorry but the page you are looking for doesn’t exist or has been moved.', 'fana') ?>
						</p>
						<a href="<?php echo esc_url(home_url( '/' )) ?>" class="back"><?php esc_html_e('home page', 'fana'); ?></a>
					</div>
				</section><!-- .error-404 -->
			</div>
			<div class="col-md-3"></div>
		</div>
	</div>
</section>

<?php get_footer(); ?>