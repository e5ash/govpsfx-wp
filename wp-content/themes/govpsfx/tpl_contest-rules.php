<?php 
/*
Template Name: Конкурс - правила
*/
get_header(); ?>

<div class="page bg-wrap">
	<div class="case">
		<div class="page__head">
			<?php include 'parts/breadcrumbs.php'; ?>
		</div>
		<div class="page__body --sm">
			<div class="page__text --mb-md t1">
				<link rel="stylesheet" href="<?= TEMP() ?>_/blocks/get-bonus/get-bonus.css?ver=1616959373836">
				<link rel="stylesheet" href="<?= TEMP() ?>_/blocks/get-free/get-free.css?ver=1616959373836">
				<?php 

				the_post(); the_content(); 
				include 'parts/sublinks.php'; ?>
			</div>
		</div>
		<?php $participateID = wp_get_post_parent_id(get_the_ID());  ?>
		<div class="page__btn-wrap btn-wrap"><a class="page__btn-more btn --lg --bg-yellow --radius" href="#modal-contest" data-popup=""><?php esc_html_e('участвовать в конкурсе', 'govpsfx') ?></a></div>
		<?php include 'parts/modal-participate.php'; ?>
	</div>
	<div class="page__bg-43 bg"><img src="<?= TEMP() ?>_/uploads/scheme-rules-1.png" alt=""></div>
	<div class="page__bg-44 bg"><img src="<?= TEMP() ?>_/uploads/scheme-rules-2.png" alt=""></div>
	<div class="page__bg-45 bg"><img src="<?= TEMP() ?>_/uploads/scheme-rules-3.png" alt=""></div>
</div>

<?php get_footer(); ?>