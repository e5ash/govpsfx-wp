<div class="price__item swiper-slide">
	<div class="price__desc"><?php esc_html_e('Тариф:', 'govpsfx') ?></div>
	<div class="price__name h4 c-yellow"><?php the_title(); ?></div>
	<div class="price__wrap p row">
		<div class="p__name"><?php esc_html_e('начиная от:', 'govpsfx') ?></div>
		<div class="p__value"><?php the_field('tarif_price'); ?></div>
		<div class="p__currency"><?php esc_html_e('USD/МЕСЯЦ', 'govpsfx') ?></div>
	</div>
	<div class="price__data data">
		<div class="data__list">
			<div class="data__item">
				<div class="data__name"><?php esc_html_e('Процессор', 'govpsfx') ?></div>
				<div class="data__value"><?php the_field('tarif_cpu'); ?></div>
			</div>
			<div class="data__item">
				<div class="data__name"><?php esc_html_e('Опер. память', 'govpsfx') ?></div>
				<div class="data__value"><?php the_field('tarif_memory'); ?></div>
			</div>
			<div class="data__item">
				<div class="data__name"><?php esc_html_e('обьем диска', 'govpsfx') ?></div>
				<div class="data__value"><?php the_field('tarif_disk_space'); ?></div>
			</div>
			<div class="data__item">
				<div class="data__name"><?php esc_html_e('ОС', 'govpsfx') ?></div>
				<div class="data__value"><?php the_field('tarif_oc'); ?></div>
			</div>
			<div class="data__item">
				<div class="data__name"><?php esc_html_e('Кол-во терминалов', 'govpsfx') ?></div>
				<div class="data__value"><?php the_field('tarif_number_terminals'); ?></div>
			</div>
			<div class="data__item">
				<div class="data__name"><?php esc_html_e('Трафик', 'govpsfx') ?></div>
				<div class="data__value"><?php the_field('tarif_number_traffic'); ?></div>
			</div>
			<div class="data__item">
				<div class="data__name"><?php esc_html_e('Локация серверов', 'govpsfx') ?></div>
				<div class="data__value"><?php the_field('server_location'); ?></div>
			</div>
		</div>
	</div>
	<a class="price__btn btn --sm --bg-yellow --bb --radius" href="https://my.govpsfx.com/registration" target="_blank"><?php esc_html_e('арендовать', 'govpsfx') ?></a>
</div>