<div class="popular__item swiper-slide">
	<div class="popular__name h4 c-yellow"><?php the_title(); ?></div>
	<div class="popular__content row">
		<div class="popular__img"><?php echo get_the_post_thumbnail(); ?></div>
		<div class="popular__data">
			<div class="popular__data-list">
				<div class="popular__data-item">
					<div class="popular__data-name c-gray"><?php esc_html_e('Общая доходность:', 'govpsfx') ?></div>
					<div class="popular__data-value"><?php the_field('advisers_total_profit'); ?> %</div>
				</div>
				<div class="popular__data-item">
					<div class="popular__data-name c-gray"><?php esc_html_e('Начальный депозит', 'govpsfx') ?></div>
					<div class="popular__data-value">$<?php the_field('advisers_initial_deposit'); ?></div>
				</div>
				<div class="popular__data-item">
					<div class="popular__data-name c-gray"><?php esc_html_e('Мониториг счёта', 'govpsfx') ?></div>
					<div class="popular__data-value">
						<a href="<?php the_field('advisers_monitoring_lnk'); ?>" target="_blank"><?php the_field('advisers_monitoring_account'); ?></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="popular__text"><?php the_field('adviser_small_description'); ?></div>
	<div class="popular__group">
		<a class="popular__btn btn --sm --bg-yellow --bb --radius" href="#modal-get-free" data-popup=""><?php esc_html_e('получить бесплатно', 'govpsfx') ?></a>
		<div class="popular__link link"><a href="<?= get_permalink() ?>" target="_blank"><?php esc_html_e('посмотреть стратегию', 'govpsfx') ?></a></div>
	</div>
</div>