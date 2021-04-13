<a class="news__item bg-wrap --sm" href="<?= get_permalink(); ?>" target="_blank">
	<div class="news__logo"><?php $image = get_field('логотип', 'option'); if( !empty($image) ): ?><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" /><?php endif; ?></div>
	<div class="news__data">
		<div class="news__date"><?php the_time('j F Y'); ?></div>
		<div class="news__desc t1"><?php the_title(); ?></div>
		<div class="news__watch"><img src="<?= TEMP() ?>_/uploads/icons/eye.png" alt=""><var><?php if(function_exists('the_views')) { the_views(); } ?></var></div>
	</div>
	<div class="news__img bg"><?php echo get_the_post_thumbnail(); ?></div>
</a>