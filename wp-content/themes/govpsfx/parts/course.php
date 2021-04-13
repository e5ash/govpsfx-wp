<link rel="stylesheet" href="<?= TEMP() ?>_/blocks/course/course.css?ver=1617394683039">
<div class="course">
	<div class="case">
		<? /*
		<div class="course__nav">
			<div class="course__nav-list achore-link row">
				<a class="course__nav-item" href="#btn_anchor_1">ГРАФИЧЕСКИЕ СТРАТЕГИИ FOREX</a>
				<a class="course__nav-item" href="#btn_anchor_2">ТРЕНДОВЫЕ СТРАТЕГИИ FOREX</a>
				<a class="course__nav-item" href="#btn_anchor_3">СКАЛЬПИНГ СТРАТЕГИИ FOREX</a>
				<a class="course__nav-item" href="#btn_anchor_4">ВНУТРИДНЕВНЫЕ СТРАТЕГИИ FOREX</a>
				<a class="course__nav-item" href="#btn_anchor_5">ПРОСТЫЕ СТРАТЕГИИ FOREX</a>
				<a class="course__nav-item" href="#btn_anchor_6">СТРАТЕГИИ РАЗГОНА ДЕПОЗИТА НА FOREX</a>
				<a class="course__nav-item" href="#btn_anchor_7">СТРАТЕГИИ FOREX НА ДНЕВНЫХ ГРАФИКАХ</a>
				<a class="course__nav-item" href="#btn_anchor_8">ДОЛГОСРОЧНЫЕ СТРАТЕГИИ FOREX</a>
			</div>
		</div>
		*/ ?>
		<div class="course__list">
			<?php $p_id = get_the_ID();?>
			<?php foreach(children_pages($p_id) as $page) : ?>
			<div class="course__item tog">
				<div class="course__head h4 tog-head">
					<div class="course__head-name"><?= $page->post_title; ?></div>
					<div class="course__head-icon"><img src="<?= TEMP() ?>_/uploads/icons/chevron-yellow.svg" alt=""></div>
				</div>
				<div class="course__body tog-body">
					<div class="course__body-list">
						<?php foreach (children_pages($page->ID) as $ch_pages) : ?>
							<a class="course__body-item" href="<?= the_permalink($ch_pages->ID); ?>" target="_blank"><?= $ch_pages->post_title; ?></a>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>