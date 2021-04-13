<div class="news__item --lg">
	<a class="news__img-wrap bg-wrap" href="<?= get_permalink(); ?>" target="_blank">
		<div class="news__img bg"><?php echo get_the_post_thumbnail(); ?></div>
		<div class="news__logo"><?php $image = get_field('логотип', 'option'); if( !empty($image) ): ?><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" /><?php endif; ?></div>
		<div class="news__watch"><img src="<?= TEMP() ?>_/uploads/icons/eye.png" alt=""><var>7</var></div>
	</a>
	<div class="news__data">
		<div class="news__date"><?php the_time('j F Y'); ?></div>
		<div class="news__title h4"><?php the_title(); ?></div>
		<div class="news__text t1"><?= wph_cut_by_words(150, strip_tags(get_the_content())); ?></div>
	</div>
</div>