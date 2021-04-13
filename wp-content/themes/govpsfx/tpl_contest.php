<?php 
/*
Template Name: Конкурс
*/
get_header(); ?>

<div class="page bg-wrap">
	<div class="case">
		<div class="page__head">
			<?php include 'parts/breadcrumbs.php'; ?>
		</div>
		<div class="page__body">
			<div class="page__wrap row">
				<div class="page__sidebar">
					<div class="page__sticky">
						<div class="page__nav">
							<?php wp_nav_menu(['theme_location'  => 'contest']); ?>
						</div>
						<div class="page__grp grp">
							<?php $link = get_field('raffle_winners_last_draw'); ?>
							<a class="grp__btn btn --lg --b-yellow --radius" href="" data-src="#modal-contest" data-popup=""><?php esc_html_e('участвовать в конкурсе', 'govpsfx') ?></a>
							<div class="grp__link link --white"><a href="<?= get_permalink($link->ID)?>" target="_blank"><?= $link->post_title ?></a></div>

							<?php $link = get_field('raffle_contest_rules'); ?>
							<div class="grp__link link"><a href="<?= get_permalink($link->ID)?>" target="_blank"><?php esc_html_e('Правила участия в конкурсе', 'govpsfx') ?></a></div>
						</div>
					</div>
				</div>
				<div class="page__section">
					<div class="page__title h1"><h1><?= the_field('raffle_name', get_the_ID()); ?><br><?= the_field('raffle_prize', get_the_ID()); ?></h1></div>
					<link rel="stylesheet" href="<?= TEMP() ?>_/blocks/contest/contest.css?ver=1617096443247">
					<div class="contest">
						<div class="contest__title h5"><?php the_content(); ?></div>
						<div id="timer" style="display: none;"></div>
						<div class="contest__wrap bg-wrap">
							<div class="contest__currency"><?= the_field('raffle_currency', get_the_ID()); ?></div>
							<div class="contest__values row">
								<?php /* echo do_shortcode(get_field('raffle_rating', get_the_ID())); */ ?>
								<div class="contest__value --bold">0.0000</div>
								<div class="contest__icon">
									<svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd" clip-rule="evenodd" d="M40 20C40 31.0457 31.0457 40 20 40C8.9543 40 0 31.0457 0 20C0 8.9543 8.9543 0 20 0C31.0457 0 40 8.9543 40 20ZM14.3396 21.8002L11.8114 24.1632L20.0014 31.818L28.1914 24.1632L25.6632 21.8002L23.2418 24.0634L21.8531 25.5943L21.7106 25.561L21.8887 22.7321L21.8887 8.18799H18.1141V22.7321L18.2922 25.561L18.1498 25.5943L16.761 24.0634L14.3396 21.8002Z" fill="#E40017"/>
									</svg>
								</div>
								<div class="contest__value">0.0000</div>
							</div>
							<div class="contest__subtitle h5"><?php esc_html_e('Для участия в конкурсе осталось времени', 'govpsfx') ?>:</div>
							<div class="contest__list row timer">
								<div class="timer__item">
									<div class="timer__round">
										<div class="timer__circle">
											<div class="timer__circle-wrap">
												<div class="timer__value" id="count_hour">0</div>
												<div class="timer__icon">
													<svg class="loader" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" width="127" height="127">
														<circle cx="100" cy="100" r="96" fill="none" opacity="0.4" stroke="color" stroke-width="8"></circle>
														<circle cx="100" cy="100" r="96" id="unic_1" fill="none" transform="rotate(270,100,100)" stroke="rgb(255,184,0)" stroke-width="12" stroke-dasharray="600" stroke-dashoffset="0" style="stroke-linecap: round;"></circle>
													</svg>
												</div>
											</div>
										</div>
									</div>
									<div class="timer__title"><?php esc_html_e('часы', 'govpsfx') ?></div>
								</div>
								<div class="timer__item">
									<div class="timer__round">
										<div class="timer__circle">
											<div class="timer__circle-wrap">
												<div class="timer__value" id="count_min">0</div>
												<div class="timer__icon">
													<svg class="loader" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" width="127" height="127">
														<circle cx="100" cy="100" r="96" fill="none" opacity="0.4" stroke="color" stroke-width="8"></circle>
														<circle cx="100" cy="100" r="96" id="unic_2" fill="none" transform="rotate(270,100,100)" stroke="rgb(255,184,0)" stroke-width="12" stroke-dasharray="600" stroke-dashoffset="0" style="stroke-linecap: round;"></circle>
													</svg>
												</div>
											</div>
										</div>
									</div>
									<div class="timer__title"><?php esc_html_e('минуты', 'govpsfx') ?></div>
								</div>
								<div class="timer__item">
									<div class="timer__round">
										<div class="timer__circle">
											<div class="timer__circle-wrap">
												<div class="timer__value" id="count_sec">0</div>
												<div class="timer__icon">
													<svg class="loader" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" width="127" height="127">
														<circle cx="100" cy="100" r="96" fill="none" opacity="0.4" stroke="color" stroke-width="8"></circle>
														<circle cx="100" cy="100" r="96" id="unic_3" fill="none" transform="rotate(270,100,100)" stroke="rgb(255,184,0)" stroke-width="12" stroke-dasharray="600" stroke-dashoffset="0" style="stroke-linecap: round;"></circle>
													</svg>
												</div>
											</div>
										</div>
									</div>
									<div class="timer__title"><?php esc_html_e('секунды', 'govpsfx') ?></div>
								</div>
							</div>
							<div class="contest__count"><?= do_shortcode(get_field('raffle_participants', get_the_ID())); ?></div>
							<div class="contest__link link"><a href="<?= the_permalink(get_field('raffle_participants_winners_page', get_the_ID())); ?>" target="_blank"><?php esc_html_e('список участников', 'govpsfx') ?> →</a></div>
							<a class="contest__btn btn --lg --bg-yellow --bb --radius" href="javascript:;" data-src="#modal-contest" data-popup=""><?php esc_html_e('участвовать в конкурсе', 'govpsfx') ?></a>
							<div class="contest__share share">
								<?php include 'parts/share.php'; ?>
							</div>
							<div class="contest__bg-1 bg"><img src="https://govpsfx.com/wp-content/themes/govps/img/contest__block-1__scheme-1.png" alt=""></div>
							<div class="contest__bg-2 bg"><img src="https://govpsfx.com/wp-content/themes/govps/img/contest__block-1__scheme-2.png" alt=""></div>
							<div class="contest__bg-3 bg"><img src="https://govpsfx.com/wp-content/themes/govps/img/contest__block-1__scheme-3.png" alt=""></div>
						</div>
						<div class="contest__text t1">
							<?php the_field('text_before'); ?>
						</div>
					</div>
					<script src="<?= TEMP() ?>_/blocks/contest/contest.js?ver=1617096443247"></script>
					<link rel="stylesheet" href="<?= TEMP() ?>_/blocks/winners/winners.css?ver=1617096443247">
					<div class="winners">
						<div class="winners__title h5"><?php esc_html_e('Победители прошлых конкурсов', 'govpsfx') ?></div>
						<div class="winners__sliders">
							<div class="winners__content">
								<div class="winners__content-icon">
									<svg width="68" height="51" viewBox="0 0 68 51" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd" clip-rule="evenodd" d="M12.7937 51C8.31038 51 5.05733 49.8369 3.03439 47.5105C1.01145 45.1842 0 42.2912 0 38.8316V35.4316C0 32.2105 0.437385 28.9597 1.31217 25.6789C2.18695 22.3982 3.36243 19.207 4.83862 16.1053C6.31482 13.0035 8.0917 10.0807 10.1693 7.33684C12.2469 4.59297 14.4885 2.14738 16.8942 0H31C27.5009 3.69826 24.5485 7.33682 22.1429 10.9158C19.7372 14.4948 17.933 18.4912 16.7302 22.9053C19.9012 23.6211 22.1975 25.0824 23.619 27.2895C25.0406 29.4965 25.7513 32.0316 25.7513 34.8947V38.8316C25.7513 42.2912 24.7399 45.1842 22.7169 47.5105C20.694 49.8369 17.3863 51 12.7937 51ZM49.7937 51C45.3104 51 42.0573 49.8369 40.0344 47.5105C38.0115 45.1842 37 42.2912 37 38.8316V35.4316C37 32.2105 37.4374 28.9597 38.3122 25.6789C39.187 22.3982 40.3624 19.207 41.8386 16.1053C43.3148 13.0035 45.0917 10.0807 47.1693 7.33684C49.2469 4.59297 51.4885 2.14738 53.8942 0H68C64.5009 3.69826 61.5485 7.33682 59.1429 10.9158C56.7372 14.4948 54.933 18.4912 53.7302 22.9053C56.9012 23.6211 59.1975 25.0824 60.619 27.2895C62.0406 29.4965 62.7513 32.0316 62.7513 34.8947V38.8316C62.7513 42.2912 61.7399 45.1842 59.7169 47.5105C57.694 49.8369 54.3863 51 49.7937 51Z" fill="#FFB800"/>
									</svg>
								</div>
								<?php $raffle_winners = get_field('raffle_winners', get_the_ID());?>
								<div class="winners__content-wrap swiper-container">
									<div class="winners__content-list swiper-wrapper">
										<?php foreach($raffle_winners as $raffle_winner) : ?>
										<div class="winners__text swiper-slide"><?= $raffle_winner->post_content; ?></div>
										<?php endforeach; ?>
									</div>
								</div>
							</div>
							<div class="winners__persons swiper-container">
								<div class="winners__persons-list swiper-wrapper">
									<?php foreach($raffle_winners as $raffle_winner) : ?>
									<div class="winners__persona swiper-slide">
										<?php $rev_fields = get_post_meta($raffle_winner->ID); ?>
										<div class="winners__persona-img"><img src="<?= get_the_post_thumbnail_url( $raffle_winner->ID, 'rev_thumb' ); ?>" alt="<?= $raffle_winner->post_title; ?>"></div>
										<div class="winners__persona-text">
											<div class="winners__persona-name"><?= $raffle_winner->post_title; ?></div>
											<div class="winners__persona-desc"><?= $rev_fields['_cite'][0]; ?></div>
										</div>
									</div>
									<?php endforeach; ?>
								</div>
								<div class="winners__arrows">
									<div class="winners__arrow swiper-button-prev btn arrow --bg-yellow --radius --prev">
										<svg width="23" height="17" viewBox="0 0 23 17" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path fill-rule="evenodd" clip-rule="evenodd" d="M14.5451 17L12.5437 15.029L16.0972 11.4976L18.1394 9.77295L18.0986 9.64976L14.1366 9.89614H0L0 7.10386H14.1366L18.0986 7.35024L18.1394 7.22705L16.0972 5.50242L12.5437 1.97101L14.5451 0L23 8.5L14.5451 17Z" fill="#0F1011"/>
										</svg>
									</div>
									<div class="winners__arrow swiper-button-next btn arrow --bg-yellow --radius --next">
										<svg width="23" height="17" viewBox="0 0 23 17" fill="none" xmlns="http://www.w3.org/2000/svg">
											<path fill-rule="evenodd" clip-rule="evenodd" d="M14.5451 17L12.5437 15.029L16.0972 11.4976L18.1394 9.77295L18.0986 9.64976L14.1366 9.89614H0L0 7.10386H14.1366L18.0986 7.35024L18.1394 7.22705L16.0972 5.50242L12.5437 1.97101L14.5451 0L23 8.5L14.5451 17Z" fill="#0F1011"/>
										</svg>
									</div>
								</div>
							</div>
						</div>
					</div>
					<script src="<?= TEMP() ?>_/blocks/winners/winners.js?ver=1617096443247"></script>
					<?php $participateID = get_the_ID();  ?>
					<?php include 'parts/modal-participate.php'; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="page__bg-27 bg"><img src="<?= TEMP() ?>_/uploads/scheme-contest-1.png" alt=""></div>
	<div class="page__bg-28 bg"><img src="<?= TEMP() ?>_/uploads/scheme-contest-2.png" alt=""></div>
	<div class="page__bg-29 bg"><img src="<?= TEMP() ?>_/uploads/scheme-contest-3.png" alt=""></div>
</div>
<?php

	$time_left = get_field('rafle_time_left', get_the_ID());
	$time_left_arr = explode('/', $time_left);

	$day = $time_left_arr[0];
	$month = $time_left_arr[1];
	$year = $time_left_arr[2];

?>
<script src="<?= get_template_directory_uri(); ?>/libs/countdown/js/jquery.plugin.min.js"></script>
<script src="<?= get_template_directory_uri(); ?>/libs/countdown/js/jquery.countdown.min.js"></script>
<script>
	console.log(new Date(<?= $year; ?>, <?= $month-1; ?>, <?= $day; ?>,23));
	jQuery('#timer').countdown({
		until: new Date(<?= $year; ?>, <?= $month-1; ?>, <?= $day; ?>,23), 
		format: 'DHMS',
		onTick: raffleTimer
	});

	function raffleTimer(periods) {

		var days = periods[3],
			days_minut = 1440,
			hours_s = (days * 24) + periods[4];

		var seconds = (periods[6] / 60) * 600,
			minutes = (periods[5] / 60) * 600,
			hours = (hours_s / 60) * 600;


		jQuery('#unic_3').attr('stroke-dashoffset', seconds);
		jQuery('#unic_2').attr('stroke-dashoffset', minutes);
		jQuery('#unic_1').attr('stroke-dashoffset', hours);

		jQuery('#count_sec').text(periods[6]);
		jQuery('#count_min').text(periods[5]);
		jQuery('#count_hour').text(hours_s);
	}
</script>

<?php get_footer(); ?>