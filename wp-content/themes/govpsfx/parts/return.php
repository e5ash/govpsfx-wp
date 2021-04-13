<link rel="stylesheet" href="<?= TEMP() ?>_/blocks/return/return.css?ver=1616599710166">
<div class="return<?= $returnClasses ?>">
	<div class="case">
		<div class="return__wrap row">
			<div class="return__data">
				<div class="return__title h4 c-yellow"><?php the_field('возврат_заголовок', 2); ?></div>
				<div class="return__price p row --md">
					<div class="p__name"><?php the_field('возврат_стоимость_-_описание', 2); ?></div>
					<div class="p__value"><?php the_field('возврат_стоимость_-_значение', 2); ?></div>
					<div class="p__currency"><?php the_field('возврат_стоимость_-_подпись', 2); ?></div>
				</div>
				<a class="return__btn btn --lg --b-yellow --radius" href="<?php the_field('возврат_кнопка_-_ссылка', 2); ?>" target="_blank"><?php the_field('возврат_кнопка_-_текст', 2); ?></a>
			</div>
			<div class="return__content">
				<div class="return__text t1"><?php the_field('возврат_текст', 2); ?></div>
			</div>
		</div>
	</div>
</div>