<link rel="stylesheet" href="<?= TEMP() ?>_/blocks/need-help/need-help.css?ver=1616599707192">
<div class="need-help">
	<div class="need-help__title h5"><?php the_field('подсказка_заголовок', $needHelpId); ?></div>
	<div class="need-help__list">
		<?php if( have_rows('подсказка_блоки', $needHelpId) ){ while ( have_rows('подсказка_блоки', $needHelpId) ) : the_row(); if( get_row_layout() == 'блок' ){ ?>
		<div class="need-help__item">
			<div class="need-help__name t1"><?php the_sub_field('подзаголовок'); ?></div>
			<div class="need-help__btns row">
				<?php if( have_rows('ссылки') ){ while ( have_rows('ссылки') ) : the_row(); if( get_row_layout() == 'блок' ){ ?>
				<a class="need-help__btn btn --lg --b-yellow --radius" href="<?php the_sub_field('ссылка'); ?>" <?php if(get_sub_field('попап')) {echo ' data-popup=""';} else { echo ' target="_blank"'; } ?>><?php the_sub_field('название'); ?></a>
				<?php } endwhile; }?>
			</div>
		</div>
		<?php } endwhile; }?>
	</div>
</div>