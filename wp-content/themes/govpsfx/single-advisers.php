<?php get_header(); ?>

<div class="page bg-wrap">
	<div class="case">
		<div class="page__head">
			<?php include 'parts/breadcrumbs.php'; ?>
		</div>
		<div class="page__body">
			<div class="page__wrap row">
				<div class="page__sidebar">
					<div class="page__sticky">
						<?php if (get_field('advisers_statistica', get_the_ID())) : ?>
						<div class="page__widget"><?= the_field('advisers_statistica', get_the_ID()); ?></div>
						<?php endif; ?>

						<?php if (get_field('advisers_price')) : ?>
						<div class="page__price">
							<div class="page__price-title"><?php esc_html_e('Стоимость', 'govpsfx') ?>:</div>
							<div class="page__price-value"><var>$<?= get_field('advisers_price') ?>/</var><?php esc_html_e('одна лицензия', 'govpsfx') ?></div>
						</div>
						<?php endif; ?>

						<div class="page__btns">
							<a class="page__btn btn --lg --bg-yellow --bb --radius" href="javascript:;" data-src="#modal-get-free" data-popup=""><?php esc_html_e('Получить советник бесплатно', 'govpsfx') ?></a>
							<?php if (get_field('advisers_price')) : ?>
							<a class="page__btn btn --lg --b-white --radius" href="https://my.govpsfx.com/registration" data-src="#modal-buy" data-popup=""><?php esc_html_e('Купить советник', 'govpsfx') ?></a>
							<?php endif; ?>
						</div>

						<div class="page__desc"><?php the_field('форекс_советники_текст_в_советники', 24810); ?></div>
						<div class="page__link-get link"><a href="https://my.govpsfx.com/registration" target="_blank"><?php esc_html_e('Получить бесплатный VPS', 'govpsfx') ?> →</a></div>
					</div>
				</div>
				<div class="page__section">
					<link rel="stylesheet" href="<?= TEMP() ?>_/blocks/expert/expert.css?ver=1616599708918">
					<div class="expert">
						<div class="expert__desc t1">
							<?php the_field('adviser_small_description2'); ?>
						</div>
						<div class="expert__props props row">
							<div class="props__list">
								<?php if ($trading_terminal = get_field('adviser_trading_terminal', get_the_ID())) : ?>
								<div class="props__item">
									<div class="props__name"><?php esc_html_e('Торговый терминал', 'govpsfx') ?></div>
									<div class="props__value"><?= $trading_terminal ?></div>
								</div>
								<?php endif; ?>
								
								<?php if ($traded_pairs = get_field('advisers_traded_pairs', get_the_ID())) : ?>
								<div class="props__item">
									<div class="props__name"><?php esc_html_e('Торгуемые пары', 'govpsfx') ?></div>
									<div class="props__value"><?= $traded_pairs ?></div>
								</div>
								<?php endif; ?>
								
								<?php if ($time_frame = get_field('advisers_time_frame', get_the_ID())) : ?>
								<div class="props__item">
									<div class="props__name"><?php esc_html_e('Time-frame', 'govpsfx') ?></div>
									<div class="props__value"><?= $time_frame ?></div>
								</div>
								<?php endif; ?>
								
								<?php if ($credit_shoulder = get_field('advisers_credit_shoulder', get_the_ID())) : ?>
								<div class="props__item">
									<div class="props__name"><?php esc_html_e('Кредитное плечо', 'govpsfx') ?></div>
									<div class="props__value"><?php esc_html_e('от', 'govpsfx') ?> 1:<?= $credit_shoulder ?></div>
								</div>
								<?php endif; ?>
								
								<?php if ($recomended_brokers = get_field('advisers_recommended_brokers', get_the_ID())) : ?>
								<div class="props__item">
									<div class="props__name"><?php esc_html_e('Рекомендуемые брокеры', 'govpsfx') ?></div>
									<div class="props__value">
										<?php $data_brokers = [];
										foreach ($recomended_brokers as $r_value) {
											$data_brokers[] = '<a target="_blank" href="' . get_permalink($r_value->ID) . '">' . get_field('brokers_name', $r_value->ID) . '</a>';
										}
										echo implode(', ', $data_brokers); 
										?>
										
									</div>
								</div>
								<?php endif; ?>
								
								<?php if ($recommended_deposite = get_field('advisers_recommended_deposite', get_the_ID())) : ?>
								<div class="props__item">
									<div class="props__name"><?php esc_html_e('Рекомендуемый депозит', 'govpsfx') ?></div>
									<div class="props__value"><?= $recommended_deposite ?></div>
								</div>
								<?php endif; ?>
								
								<?php if ($recommended_vps = get_field('advisers_recommended_vps', get_the_ID())) : ?>
								<div class="props__item">
									<div class="props__name"><?php esc_html_e('Рекомендуемый VPS', 'govpsfx') ?></div>
									<div class="props__value"><?= $recommended_vps ?></div>
								</div>
								<?php endif; ?>
							</div>
							<div class="props__img"><?php echo get_the_post_thumbnail(); ?></div>
						</div>
						<div class="expert__text t1"><?php the_content(); ?></div>
					</div>
					<link rel="stylesheet" href="<?= TEMP() ?>_/blocks/get-free/get-free.css?ver=1616599708919">
					<div class="get-free">
						<div class="get-free__title h1"><?php the_field('получить_бесплатно_заголовок', 24810); ?></div>
						<div class="get-free__list">
							<?php $i = 1; ?>
							<?php if( have_rows('получить_бесплатно_список', 24810) ){ while ( have_rows('получить_бесплатно_список', 24810) ) : the_row(); if( get_row_layout() == 'блок' ){ ?>
							<div class="get-free__item">
								<div class="get-free__count">#<?= $i ?></div>
								<div class="get-free__text"><?php the_sub_field('текст'); ?></div>
							</div>
							<?php $i++; } endwhile; }?>
						</div>
					</div>
					<div class="page__actions b-actions">
						<div class="b-actions__list row">
							<div class="b-actions__item btn --lg --b-yellow --radius" data-src="#modal-get-free" data-popup=""><?php esc_html_e('Получить советник бесплатно', 'govpsfx') ?></div>

							<?php if (get_field('advisers_price')) : ?>
							<div class="b-actions__item link --md"><a href="javascript:;" data-src="#modal-buy" data-popup=""><?php esc_html_e('Купить советник', 'govpsfx') ?></a></div>
							<?php endif; ?>
						</div>
						<div class="b-actions__share share --left">
							<?php include 'parts/share.php'; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="page__bg-1 bg"><img src="<?= TEMP() ?>_/uploads/scheme-advisors-1.png" alt=""></div>
	<div class="page__bg-2 bg"><img src="<?= TEMP() ?>_/uploads/scheme-advisors-2.png" alt=""></div>
	<div class="page__bg-3 bg"><img src="<?= TEMP() ?>_/uploads/scheme-advisors-3.png" alt=""></div>
	<div class="page__bg-4 bg"><img src="<?= TEMP() ?>_/uploads/scheme-brokers-1.png" alt=""></div>
	<link rel="stylesheet" href="<?= TEMP() ?>_/blocks/popular/popular.css?ver=1616599708919">
	<div class="popular --pb0">
		<div class="case">
			<div class="popular__head">
				<div class="popular__title h1"><?php esc_html_e('Похожие советники', 'govpsfx') ?></div>
				<div class="popular__all link --md"><a href="/experts-forex/"><?php esc_html_e('Перейти', 'govpsfx') ?> →</a></div>
			</div>
			<?php include 'parts/popular-slider.php'; ?>
		</div>
	</div>
</div>

<?php get_footer(); ?>