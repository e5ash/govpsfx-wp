<link rel="stylesheet" href="<?= TEMP() ?>_/blocks/intro/intro.css?ver=1616599710164">
<div class="intro bg-wrap">
	<div class="case">
		<div class="intro__wrap">
			<div class="intro__content">
				<div class="intro__title h1">
					<h1><?php the_field('интро_заголовок'); ?></h1>
				</div>
				<div class="intro__text t1"><?php the_field('интро_текст'); ?></div>
				<div class="intro__grp btn-grp">
					<a class="intro__btn btn --lg --bg-yellow --bb --radius" href="<?php the_field('интро_кнопка_-_ссылка'); ?>" target="_blank"><?php the_field('интро_кнопка_-_текст'); ?></a>
					<a class="intro__link link" href="<?php the_field('интро_ссылка_-_ссылка'); ?>" target="_blank"><?php the_field('интро_ссылка_-_текст'); ?></a>
				</div>
			</div>
			<div class="intro__img-wrap">
				<div class="intro__img"><?php $image = get_field('интро_изображение'); if( !empty($image) ): ?><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" /><?php endif; ?></div>
				<div class="intro__ellipse"><img src="<?= TEMP() ?>_/uploads/intro-ellipse.png" alt=""></div>
			</div>
		</div>
	</div>
	<div class="intro__scheme-1 bg"><img src="<?= TEMP() ?>_/uploads/scheme-3.png" alt=""></div>
	<div class="intro__scheme-2 bg"><img src="<?= TEMP() ?>_/uploads/scheme-4.png" alt=""></div>
</div>