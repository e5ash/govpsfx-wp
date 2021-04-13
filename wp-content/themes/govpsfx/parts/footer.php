<link rel="stylesheet" href="<?= TEMP() ?>_/blocks/footer/footer.css?ver=1616599710168">
<footer class="footer bg-wrap">
	<div class="case">
		<div class="footer__wrap row">
			<div class="footer__col">
				<div class="footer__list links --col --mb">
					<?php wp_nav_menu(['theme_location'  => 'footer']); ?>
				</div>
			</div>
			<div class="footer__col">
				<?php if (is_front_page()) { ?>
				<div class="footer__logo logo --lg"><?php $image = get_field('логотип', 'option'); if( !empty($image) ): ?><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" /><?php endif; ?></div>
				<?php } else { ?>
				<a class="footer__logo logo --lg" href="<?= get_home_url() ?>"><?php $image = get_field('логотип', 'option'); if( !empty($image) ): ?><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" /><?php endif; ?></a>
				<?php } ?>
				<div class="footer__title footer__form-title c-gray"><?php esc_html_e('Подписаться на рейтинг советников', 'govpsfx') ?></div>
				<form class="footer__form s-form" data-title="true" action="#" method="POST" id="footer-subscribe-form-1">
					<div class="s-form__wrap">
						<div class="s-form__list">
							<div class="s-form__item">
								<div class="s-form__input input --name">
									<div class="input__wrap"><input class="input__area" type="text" name="name" placeholder="<?= __('Введите имя', 'govps'); ?>"></div>
								</div>
							</div>
							<div class="s-form__item">
								<div class="s-form__input input --email">
									<div class="input__wrap"><input class="input__area" type="text" name="email" placeholder="<?= __('Введите почту', 'govps'); ?>"></div>
								</div>
							</div>
						</div>
						<button class="s-form__btn btn --h-icon-yellow">
							<svg width="21" height="14" viewBox="0 0 21 14" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M14.0003 13.668L12.0123 11.68L13.9163 9.776L15.2043 8.684L15.1763 8.572L12.7963 8.712H0.560328V5.744H12.7963L15.1763 5.884L15.2043 5.772L13.9163 4.68L12.0123 2.776L14.0003 0.787998L20.4403 7.228L14.0003 13.668Z" fill="#FFB800"></path>
							</svg>
						</button>
					</div>
					<div class="s-form__status">
						<div></div>
					</div>
					<div class="s-form__foot row">
						<div class="s-form__message"></div>
						<div class="s-form__count">
							<div class="s-form__count-current"></div>
							<div class="s-form__count-total"></div>
						</div>
					</div>
				</form>
				<div class="footer__socials --w2 socials">
					<div class="socials__title c-gray"><?php esc_html_e('Мы в соцсетях', 'govpsfx') ?></div>
					<div class="socials__list row">
						<?php include 'socials.php'; ?>
					</div>
				</div>
			</div>
			<div class="footer__col">
				<div class="footer__title c-gray"><?php esc_html_e('Поддержка 24/7', 'govpsfx') ?></div>
				<div class="footer__text t1">
					<p><a href="mailto:<?php the_field('почта_поддержки', 'option'); ?>"><?php the_field('почта_поддержки', 'option'); ?></a></p>
					<p><a href="tel:<?=phone(get_field('телефон', 'option')) ?>"><?php the_field('телефон', 'option'); ?></a></p>
					<p><a href="javascript:jivo_api.open()" class="openJivo"><?php esc_html_e('поддержка в чате', 'govpsfx') ?> →</a></p>
				</div>
				<div class="footer__title c-gray"><?php esc_html_e('Брокерам', 'govpsfx') ?></div>
				<div class="footer__email"><a href="mailto:<?php the_field('почта_для_брокеров', 'option'); ?>"><?php the_field('почта_для_брокеров', 'option'); ?></a></div>
				<div class="footer__title c-gray"><?php esc_html_e('Реклама', 'govpsfx') ?></div>
				<div class="footer__email"><a href="mailto:<?php the_field('почта_для_рекламы', 'option'); ?>"><?php the_field('почта_для_рекламы', 'option'); ?></a></div>
			</div>
		</div>
		<div class="footer__copy t1"><?php the_field('копирайт', 'option'); ?></div>
	</div>
	<div class="footer__scheme-1 bg"><img src="<?= TEMP() ?>_/uploads/scheme-15.png" alt=""></div>
	<div class="footer__scheme-2 bg"><img src="<?= TEMP() ?>_/uploads/scheme-16.png" alt=""></div>
	<div class="footer__scheme-3 bg"><img src="<?= TEMP() ?>_/uploads/scheme-17.png" alt=""></div>
</footer>
<div class="up btn --b-yellow --radius" id="up-btn">
	<div class="up__icon">
		<svg width="17" height="23" viewBox="0 0 17 23" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path fill-rule="evenodd" clip-rule="evenodd" d="M17 8.45493L15.029 10.4563L11.4976 6.90282L9.77295 4.86056L9.64976 4.90141L9.89614 8.86338V23H7.10386L7.10386 8.86338L7.35024 4.90141L7.22705 4.86056L5.50242 6.90282L1.97101 10.4563L0 8.45493L8.5 0L17 8.45493Z" fill="white"></path>
		</svg>
	</div>
	<div class="up__title"><?php esc_html_e('наверх', 'govpsfx') ?></div>
</div>