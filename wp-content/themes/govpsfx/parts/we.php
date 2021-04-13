<link rel="stylesheet" href="<?= TEMP() ?>_/blocks/we/we.css?ver=1616599710168">
<div class="we bg-wrap">
	<div class="case">
		<div class="we__wrap row">
			<div class="we__list">
				<?php $i = 1; if( have_rows('о_нас_список') ){ while ( have_rows('о_нас_список') ) : the_row(); if( get_row_layout() == 'блок' ){ ?>
				<div class="we__item">
					<div class="we__count">0<?= $i ?></div>
					<div class="we__value t1"><?php the_sub_field('текст'); ?></div>
					<div class="we__scheme"><img src="<?= TEMP() ?>_/uploads/scheme-we-<?= $i ?>.png" alt=""></div>
				</div>
				<?php $i++; } endwhile; }?>
			</div>
			<div class="we__content">
				<div class="we__title h2">
					<h2><?php the_field('о_нас_заголовок'); ?></h2>
				</div>
				<div class="we__text"><?php the_field('о_нас_текст'); ?></div>
				<a class="we__btn btn --lg --b-white --radius" href="#modal-feedback" data-popup=""><?php the_field('о_нас_кнопка_-_текст'); ?></a>
			</div>
		</div>
	</div>
	<div class="we__scheme-1 bg"><img src="<?= TEMP() ?>_/uploads/scheme-10.png" alt=""></div>
	<div class="we__scheme-2 bg"><img src="<?= TEMP() ?>_/uploads/scheme-11.png" alt=""></div>
	<div class="we__scheme-3 bg"><img src="<?= TEMP() ?>_/uploads/scheme-12.png" alt=""></div>
</div>