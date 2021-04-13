<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package govpsfx
 */

get_header();
?>

<link rel="stylesheet" href="<?= TEMP() ?>_/blocks/page404/page404.css?ver=1617394681381">
<div class="page404 bg-wrap">
	<div class="case">
		<div class="page404__wrap">
			<div class="page404__title c-yellow"><?php esc_html_e('404', 'govpsfx') ?></div>
			<div class="page404__desc h4"><?php esc_html_e('Такой страницы не существует', 'govpsfx') ?></div>
			<a class="page404__btn btn --bg-yellow --sm --bb --radius" href="<?= site_url() ?>"><?php esc_html_e('На главную', 'govpsfx') ?> →</a>
			<div class="page404__dots"><img src="<?= TEMP() ?>_/uploads/dots.png" alt=""></div>
		</div>
	</div>
	<div class="page404__bg bg"><img src="<?= TEMP() ?>_/uploads/scheme-404.png" alt=""></div>
</div>

<?php
get_footer();
