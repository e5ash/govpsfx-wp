<link rel="stylesheet" href="<?= TEMP() ?>_/blocks/how/how.css?ver=1616599710165">
<div class="how">
	<div class="case">
		<div class="how__title h2 tac">
			<h2><?php the_field('инструкция_заголовок'); ?></h2>
		</div>
		<div class="how__subtitle tac"><?php the_field('инструкция_подзаголовок'); ?></div>
		<div class="how__list row">
			<?php $i = 1; ?>
			<?php if( have_rows('инструкция_список') ){ while ( have_rows('инструкция_список') ) : the_row(); if( get_row_layout() == 'блок' ){ ?>
			<div class="how__item">
				<div class="how__item-wrap">
					<div class="how__count num-1 c-yellow">#0<?= $i ?></div>
					<div class="how__text t2"><?php the_sub_field('текст'); ?></div>
				</div>
			</div>
			<?php $i++; } endwhile; }?>
		</div>
		<div class="how__btn-wrap btn-wrap">
			<a class="how__btn btn --sm --bg-yellow --bb --radius" href="<?php the_field('инструкция_кнопка_-_ссылка'); ?>" target="_blank"><?php the_field('инструкция_кнопка_-_текст'); ?></a>
		</div>
	</div>
	<div class="how__scheme-1 bg"><img src="<?= TEMP() ?>_/uploads/scheme-5.png" alt=""></div>
</div>