<link rel="stylesheet" href="<?= TEMP() ?>_/blocks/popular/popular.css?ver=1616599710167">
<div class="popular">
	<div class="case">
		<div class="popular__title h2 tac">
			<h2><?php the_field('популярные_заголовок'); ?></h2>
		</div>
		<div class="popular__subtitle t1 tac">
			<?php the_field('популярные_текст'); ?>
		</div>
		<div class="popular__btn-wrap row">
			<a class="popular__btn btn --sm --bg-yellow --bb --radius" href="<?php the_field('популярные_кнопка_-_ссылка'); ?>" target="_blank"><?php the_field('популярные_кнопка_-_текст'); ?></a>
		</div>
		<?php include 'popular-slider.php'; ?>
	</div>
</div>
