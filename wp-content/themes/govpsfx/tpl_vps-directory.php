<?php 
/*
Template Name: VPS справочник
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
	</div>
	<div class="page__bg-20 bg"><img src="<?= TEMP() ?>_/uploads/scheme-edu-1.png" alt=""></div>
</div>

<?php get_footer(); ?>