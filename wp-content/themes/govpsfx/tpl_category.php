<?php 
/*
Template Name: Категории
*/
get_header(); ?>

<div class="page bg-wrap">
	<div class="case">
		<div class="page__head">
			<?php include 'parts/breadcrumbs.php'; ?>
		</div>
		<div class="page__body --sm">
			<div class="page__text --mb-md t1">
				<?php the_post(); the_content(); include 'parts/sublinks.php'; ?>
			</div>

			<?php include 'parts/questions.php'; ?>
		</div>
	</div>
	<div class="page__bg-20 bg"><img src="<?= TEMP() ?>_/uploads/scheme-edu-1.png" alt=""></div>
</div>

	

<?php
get_footer();
