<?php get_header(); ?>

<div class="page bg-wrap">
	<div class="case">
		<div class="page__head">
			<?php include 'parts/breadcrumbs.php'; ?>
		</div>
		<div class="page__body --sm">
			<div class="page__text --mb-sm t1">
				<?php the_content(); ?>
			</div>
		</div>
	</div>
	<div class="bg-wrap">
		<link rel="stylesheet" href="<?= TEMP() ?>_/blocks/get-bonus/get-bonus.css?ver=1616959373836">
		<div class="get-bonus">
			<div class="case --sm">
				<div class="get-bonus__title h4"><?php _e('Получить бонус', 'govps'); ?></div>
				<?= do_shortcode('[contact-form-7 id="25038" title="Получить бонус"]')  ?>
			</div>
		</div>
		<?php include 'parts/combo-offer.php'; ?>
		<div class="page__next-wrap">
			<a class="page__next btn --xlg --more --b-yellow --h-icon-yellow --radius" href="<?php the_field('комбо_кнопка_-_ссылка', 24863); ?>" target="_blank">
				<div class="btn__text">
					<div class="btn__title"><?php esc_html_e('Читайте следующую статью:', 'govpsfx') ?></div>
					<div class="btn__desc"><?php the_field('комбо_кнопка_-_заголовок', 24863); ?></div>
				</div>
				<div class="btn__icon">
					<svg width="13" height="9" viewBox="0 0 13 9" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M8.22113 9L7.0899 7.95652L9.09841 6.08696L10.2527 5.17391L10.2296 5.1087L7.99026 5.23913H0L0 3.76087H7.99026L10.2296 3.8913L10.2527 3.82609L9.09841 2.91304L7.0899 1.04348L8.22113 0L13 4.5L8.22113 9Z" fill="#FFB800"></path>
					</svg>
				</div>
			</a>
		</div>
		<div class="page__bg-18 bg"><img src="<?= TEMP() ?>_/uploads/scheme-18.png" alt=""></div>
		<div class="page__bg-19 bg"><img src="<?= TEMP() ?>_/uploads/scheme-19.png" alt=""></div>
	</div>
	<div class="page__bg-15 bg"><img src="<?= TEMP() ?>_/uploads/scheme-bonus-1.png" alt=""></div>
	<div class="page__bg-16 bg"><img src="<?= TEMP() ?>_/uploads/scheme-bonus-2.png" alt=""></div>
	<div class="page__bg-17 bg"><img src="<?= TEMP() ?>_/uploads/scheme-bonus-3.png" alt=""></div>
</div>

<?php get_footer(); ?>