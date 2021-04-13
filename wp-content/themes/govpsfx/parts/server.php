<link rel="stylesheet" href="<?= TEMP() ?>_/blocks/server/server.css?ver=1616599710165">
<div class="server">
	<div class="case">
		<div class="server__title h2 tac">
			<h2><?php the_field('сервер_заголовок'); ?></h2>
		</div>
		<div class="server__wrap">
			<div class="server__list row">
				<div class="server__col">
					<?php if( have_rows('сервер_левая_колонка') ){ while ( have_rows('сервер_левая_колонка') ) : the_row(); if( get_row_layout() == 'блок' ){ ?>
					<div class="server__item">
						<div class="server__name"><?php the_sub_field('название'); ?></div>
						<div class="server__value h3"><?php the_sub_field('значение'); ?></div>
					</div>
					<?php } endwhile; }?>
				</div>
				<div class="server__col">
					<?php if( have_rows('сервер_правая_колонка') ){ while ( have_rows('сервер_правая_колонка') ) : the_row(); if( get_row_layout() == 'блок' ){ ?>
					<div class="server__item">
						<div class="server__name"><?php the_sub_field('название'); ?></div>
						<div class="server__value h3"><?php the_sub_field('значение'); ?></div>
					</div>
					<?php } endwhile; }?>
				</div>
			</div>
			<div class="server__img-wrap">
				<div class="server__img"><?php $image = get_field('сервер_изображение'); if( !empty($image) ): ?><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" /><?php endif; ?></div>
				<div class="server__ellipse"><img src="<?= TEMP() ?>_/uploads/server-ellipse.png" alt=""></div>
			</div>
		</div>
	</div>
</div>