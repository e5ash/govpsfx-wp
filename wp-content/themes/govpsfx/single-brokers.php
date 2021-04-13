<?php get_header(); ?>

<div class="page bg-wrap">
	<div class="case">
		<div class="page__head">
			<?php include 'parts/breadcrumbs.php'; ?>
		</div>
		<div class="page__body --sm">
			<link rel="stylesheet" href="<?= TEMP() ?>_/blocks/broker/broker.css?ver=1616599705775">
			<div class="broker">
				<div class="broker__desc t1"><?= the_field('brokers_all_text', get_the_ID()); ?></div>
				<div class="broker__data data --upper --left --mob-line">
					<div class="data__list">
						<?php if (get_field('brokers_based', get_the_ID())) : ?>
							<div class="data__item">
								<div class="data__name"><?php _e('год основания', 'govpsfx'); ?></div>
								<div class="data__value"><?= the_field('brokers_based', get_the_ID()); ?> год</div>
							</div>
						<?php endif; ?>

						<?php if (get_field('brokers_site_url', get_the_ID())) : ?>
							<div class="data__item">
								<div class="data__name"><?php _e('адрес сайта', 'govpsfx'); ?></div>
								<div class="data__value"><?= the_field('brokers_site_url', get_the_ID()); ?></div>
							</div>
						<?php endif; ?>

						<?php if (get_field('brokers_regulator', get_the_ID())) : ?>
							<div class="data__item">
								<div class="data__name"><?php _e('регулятор', 'govpsfx'); ?></div>
								<div class="data__value"><?= the_field('brokers_regulator', get_the_ID()); ?></div>
							</div>
						<?php endif; ?>

						<?php if (get_field('brokers_country_registration', get_the_ID())) : ?>
							<div class="data__item">
								<div class="data__name"><?php _e('страна регистрации', 'govpsfx'); ?></div>
								<div class="data__value"><?= the_field('brokers_country_registration', get_the_ID()); ?></div>
							</div>
						<?php endif; ?>

						<?php if (get_field('brokers_minimum_deposit', get_the_ID())) : ?>
							<div class="data__item">
								<div class="data__name"><?php _e('минимальный депозит', 'govpsfx'); ?></div>
								<div class="data__value"><?= the_field('brokers_minimum_deposit', get_the_ID()); ?> USD</div>
							</div>
						<?php endif; ?>

						<?php if (get_field('brokers_deposit_currency', get_the_ID())) : ?>
							<div class="data__item">
								<div class="data__name"><?php _e('валюта депозита', 'govpsfx'); ?></div>
								<div class="data__value"><?= the_field('brokers_deposit_currency', get_the_ID()); ?></div>
							</div>
						<?php endif; ?>

						<?php if (get_field('brokers_commission_replenishment', get_the_ID()) != '') : ?>
							<div class="data__item">
								<div class="data__name"><?php _e('средняя комиссия на пополнение', 'govpsfx'); ?></div>
								<div class="data__value"><?= the_field('brokers_commission_replenishment', get_the_ID()); ?>%</div>
							</div>
						<?php endif; ?>

						<?php if (get_field('brokers_commission_withdrawal', get_the_ID()) != '') : ?>
							<div class="data__item">
								<div class="data__name"><?php _e('средняя комиссия на вывод', 'govpsfx'); ?></div>
								<div class="data__value"><?= the_field('brokers_commission_withdrawal', get_the_ID()); ?>%</div>
							</div>
						<?php endif; ?>

						<?php if (get_field('brokers_cryptocurrency', get_the_ID())) : ?>
							<div class="data__item">
								<div class="data__name"><?php _e('криптовалюта', 'govpsfx'); ?></div>
								<div class="data__value"><?= the_field('brokers_cryptocurrency', get_the_ID()); ?></div>
							</div>
						<?php endif; ?>

						<?php if (get_field('brokers_investment_service', get_the_ID())) : ?>
							<div class="data__item">
								<div class="data__name"><?php _e('инвестиционный сервис', 'govpsfx'); ?></div>
								<div class="data__value"><?= the_field('brokers_investment_service', get_the_ID())?></div>
							</div>
						<?php endif; ?>
					</div>
				</div>
				
				<div class="broker__methods methods">
					<div class="methods__list row">
						<?php if ($pay_icons = get_field('pay_sys_icons', get_the_iD())) : ?>
						<?php foreach($pay_icons as $ico) : ?>
						<div class="methods__item"><img src="<?= get_template_directory_uri(); ?>/img/<?= $ico; ?>.png" alt="<?= $ico; ?>"></div>
						<?php endforeach; ?>
						<?php else: ?>
						<div class="methods__item"><img src="<?= get_template_directory_uri(); ?>/img/methods.png" alt=""></div>
						<?php endif; ?>
					</div>
				</div>
				
				<div class="broker__text t1">
					<?php the_post(); the_content(); ?>
				</div>
			</div>
		</div>
	</div>
	
	<?php if (get_field('brokers_advantages_pluse', get_the_ID()) || get_field('brokers_advantages_minus', get_the_ID())) : ?>
	<link rel="stylesheet" href="<?= TEMP() ?>_/blocks/pm/pm.css?ver=1616599705776">
	<div class="broker__pm pm bg-wrap">
		<div class="case --sm">
			<div class="pm__title h4"><?php _e('ПРЕИМУЩЕСТВА И НЕДОСТАТКИ КОМПАНИИ', 'govpsfx'); ?></div>
			<div class="pm__list">
				<div class="pm__item">
					<div class="pm__icon">+</div>
					<div class="pm__text t1">
						<?= the_field('brokers_advantages_pluse', get_the_ID()); ?>
					</div>
				</div>
				<div class="pm__item">
					<div class="pm__icon">-</div>
					<div class="pm__text t1">
						<?= the_field('brokers_advantages_minus', get_the_ID()); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="pm__bg-1 bg"><img src="<?= TEMP() ?>_/uploads/scheme-pm-1.png" alt=""></div>
		<div class="pm__bg-2 bg"><img src="<?= TEMP() ?>_/uploads/scheme-pm-2.png" alt=""></div>
	</div>
	<?php endif; ?>

	<link rel="stylesheet" href="<?= TEMP() ?>_/blocks/conclusion/conclusion.css?ver=1616599705776">
	<div class="broker__conclusion conclusion">
		<div class="case --sm">
			<div class="conclusion__title h4"><?php _e('ЗАКЛЮЧЕНИЕ', 'govpsfx'); ?></div>
			<div class="conclusion__text t1"><?= the_field('broker_conclusion', get_the_ID()); ?></div>
		</div>
	</div>
	<div class="actions b-actions">
		<div class="case --sm">
			<div class="b-actions__list row">
				<a class="b-actions__item btn --lg --b-yellow --radius" href="<?= the_field('brokers_open_account', get_the_ID()); ?>" target="_blank"><?php _e('Открыть реальный счёт', 'govps'); ?></a>
				<div class="b-actions__item link">
					<a href="<?= the_field('brokers_demo_account', get_the_ID()); ?>" target="_blank"><?php _e('открыть демо-счет', 'govps'); ?> →</a>
				</div>
			</div>
			<div class="b-actions__share share --left">
				<?php include 'parts/share.php' ?>
			</div>
		</div>
	</div>
	<link rel="stylesheet" href="<?= TEMP() ?>_/blocks/logo-list/logo-list.css?ver=1616599705776">
	<div class="logo-list">
		<div class="case --sm">
			<div class="logo-list__title h4"><?php esc_html_e('Обзоры форекс брокеров', 'govpsfx') ?></div>
			<div class="logo-list__slider swiper-container">
				<?php

				$brokers = get_posts([
					'post_type' => 'brokers',
					'numberposts' => -1,
				]);

				?>
				<div class="logo-list__list swiper-wrapper">
					<?php foreach ($brokers as $broker) : ?>
						<?php if ($other_photo = get_field('brokers_other_photo', $broker->ID)) : ?>
						<a class="logo-list__item swiper-slide" href="<?= the_permalink($broker->ID);?>" target="_blank">
							<img src="<?= wp_get_attachment_image_url($other_photo, 'brokers_obzor_thumb'); ?>" alt="<?php the_title(); ?>" class="brokers__carousel-item-img">
						</a>
						<?php endif; ?>
					<?php endforeach; ?>
				</div>
				<div class="logo-list__controls row">
					<div class="logo-list__all link"><a href="/brokers/" alt="" target="_blank"><?php esc_html_e('перейти к форекс брокерам', 'govpsfx') ?> →</a></div>
					<div class="logo-list__arrows row">
						<div class="logo-list__arrow swiper-button-prev btn arrow --bg-yellow --radius --prev">
							<svg width="23" height="17" viewBox="0 0 23 17" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd" clip-rule="evenodd" d="M14.5451 17L12.5437 15.029L16.0972 11.4976L18.1394 9.77295L18.0986 9.64976L14.1366 9.89614H0L0 7.10386H14.1366L18.0986 7.35024L18.1394 7.22705L16.0972 5.50242L12.5437 1.97101L14.5451 0L23 8.5L14.5451 17Z" fill="#0F1011"/>
							</svg>
						</div>
						<div class="logo-list__arrow swiper-button-next btn arrow --bg-yellow --radius --next">
							<svg width="23" height="17" viewBox="0 0 23 17" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path fill-rule="evenodd" clip-rule="evenodd" d="M14.5451 17L12.5437 15.029L16.0972 11.4976L18.1394 9.77295L18.0986 9.64976L14.1366 9.89614H0L0 7.10386H14.1366L18.0986 7.35024L18.1394 7.22705L16.0972 5.50242L12.5437 1.97101L14.5451 0L23 8.5L14.5451 17Z" fill="#0F1011"/>
							</svg>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="<?= TEMP() ?>_/blocks/logo-list/logo-list.js?ver=1616599705776"></script>

	<link rel="stylesheet" href="<?= TEMP() ?>_/blocks/comments/comments.css?ver=1616599705776">
	<div class="comments">
		<div class="case --sm">
			<div class="comments__title h4"><?php esc_html_e('Оставьте свой комментарий', 'govpsfx') ?></div>
			<div class="comments__wrap"><?php comments_template('', true); ?></div>
		</div>
	</div>
	<script src="<?= TEMP() ?>_/blocks/comments/comments.js?ver=1616599705776"></script>

	<div class="page__bg-11 bg"><img src="<?= TEMP() ?>_/uploads/scheme-broker-1.png" alt=""></div>
	<div class="page__bg-12 bg"><img src="<?= TEMP() ?>_/uploads/scheme-broker-2.png" alt=""></div>
	<div class="page__bg-13 bg"><img src="<?= TEMP() ?>_/uploads/scheme-broker-3.png" alt=""></div>
	<div class="page__bg-14 bg"><img src="<?= TEMP() ?>_/uploads/scheme-broker-4.png" alt=""></div>
</div>

<?php get_footer(); ?>