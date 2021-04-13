<?php 
/*
Template Name: Блоки - ссылки
*/
get_header(); ?>

<div class="page bg-wrap">
	<div class="case">
		<div class="page__head">
			<?php include 'parts/breadcrumbs.php'; ?>
		</div>
		<div class="page__body --sm">
			<div class="page__text --mb-md t1">
				<?php the_content(); ?>
			</div>
			<link rel="stylesheet" href="<?= TEMP() ?>_/blocks/b-links/b-links.css?ver=1616959379647">
			<div class="b-links">
				<div class="case">
					<div class="b-links__list grid">
						<?php if( have_rows('блоки-ссылки') ){ while ( have_rows('блоки-ссылки') ) : the_row(); if( get_row_layout() == 'блоки' ){ ?>
						<a class="b-links__item" href="<?php the_sub_field('ссылка'); ?>" target="_blank">
							<div class="b-links__title h4"><span><?php the_sub_field('заголовок'); ?></span></div>
							<div class="b-links__desc"><?php the_sub_field('текст'); ?></div>
						</a>
						<?php } endwhile; }?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="page__bg-10 bg"><img src="<?= TEMP() ?>_/uploads/scheme-page-1.png" alt=""></div>
</div>

<?php get_footer(); ?>