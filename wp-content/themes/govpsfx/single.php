<?php
/**
* The template for displaying all single posts
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
*
* @package govpsfx
*/

get_header();
?>

<div class="page bg-wrap">
	<div class="case">
		<div class="page__head">
			<?php include 'parts/breadcrumbs.php'; ?>
		</div>
		<div class="page__body">
			<div class="page__wrap row">
				<div class="page__section">
					<div class="page__text t1"><?php the_content(); ?></div>
					<div class="share --left">
						<?php include 'parts/share.php'; ?>
					</div>
				</div>
				<div class="page__sidebar">
					<div class="page__info b-info">
						<div class="b-info__list">
							<div class="b-info__item">
								<div class="b-info__title"><?php esc_html_e('Курсы валют', 'govpsfx') ?></div>
								<div class="b-info__inner b-currency">
									<div class="b-currency__list row">
										<?php if( have_rows('курсы_валют', 14191) ){ while ( have_rows('курсы_валют', 14191) ) : the_row(); if( get_row_layout() == 'блок' ){ ?>
										<div class="b-currency__item">
											<div class="b-currency__icon"><?php $image = get_sub_field('иконка'); if( !empty($image) ): ?><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" /><?php endif; ?></div>
											<div class="b-currency__value"><?php the_sub_field('значение'); ?><?php the_sub_field('префикс'); ?></div>
										</div>
										<?php } endwhile; }?>
									</div>
								</div>
							</div>
							<div class="b-info__item">
								<div class="b-info__title"><?php esc_html_e('Мы в соц. сетях', 'govpsfx') ?></div>
								<div class="b-info__inner b-socials">
									<div class="b-socials__list row">
										<?php if( have_rows('соц_сети', 'option') ){ while ( have_rows('соц_сети', 'option') ) : the_row(); if( get_row_layout() == 'блок' ){ ?>
										<a class="b-socials__item" href="<?php the_sub_field('ссылка'); ?>" target="_blank"><img src="<?php the_sub_field('иконка'); ?>" alt="<?php the_sub_field('название'); ?>" target="_blank"></a>
										<?php } endwhile; }?>
									</div>
								</div>
							</div>
							<div class="b-info__item">
								<div class="b-info__title"><?php esc_html_e('Подписаться на новости', 'govpsfx') ?>:</div>
								<div class="b-info__inner">
									<form class="b-info__inner b-sub --no-counts s-form" action="#" method="POST" id="sidebar-subscribe-form">
										<div class="s-form__wrap">
											<div class="s-form__list">
												<div class="s-form__item" data-title="<?= __('Имя', 'govps'); ?>">
													<div class="s-form__input input --name">
														<div class="input__wrap"><input class="input__area" type="text" name="name" placeholder="<?= __('Введите имя', 'govps'); ?>"></div>
													</div>
												</div>
												<div class="s-form__item" data-title="<?= __('Почта', 'govps'); ?>">
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
								</div>
							</div>
							<div class="b-info__item">
								<div class="b-info__inner b-favorit row">
									<div class="b-favorit__icon"><img src="<?= get_template_directory_uri(); ?>/img/icon-fv.png" alt=""></div>
									<div class="b-favorit__link"><a href="javascript:;" data-src="#modal-favorit" data-popup=""><?php esc_html_e('Добавить сайт в закладки', 'govpsfx') ?></a></div>
									<div class="modal --xs" id="modal-favorit">
										<div class="modal__close popup-btn-close">
											<svg xmlns="http://www.w3.org/2000/svg" version="1" viewBox="0 0 24 24">
												<path d="M13 12l5-5-1-1-5 5-5-5-1 1 5 5-5 5 1 1 5-5 5 5 1-1z"></path>
											</svg>
										</div>
										<div class="modal__wrap">
											<div class="modal__title"><?php esc_html_e('Добавление в закладки', 'govpsfx') ?></div>
											<div class="modal__text"><?php esc_html_e('Нажмите "CTRL + D" для добавления страницы в закладки', 'govpsfx') ?></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="page__bg-46 bg"><img src="<?= TEMP() ?>_/uploads/scheme-news-item-1.png" alt=""></div>
</div>

<?php $rateClasses = ' --pt0'; include 'parts/rate.php'; ?>

<?php
get_footer();
