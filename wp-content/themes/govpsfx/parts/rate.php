<link rel="stylesheet" href="<?= TEMP() ?>_/blocks/rate/rate.css?ver=1616599710168">
<div class="rate bg-wrap<?= $rateClasses ?>">
	<div class="case row">
		<div class="rate__wrap row">
			<div class="rate__content">
				<div class="rate__title h2">
					<h2><?php the_field('новости_заголовок', 2); ?></h2>
				</div>
				<div class="rate__text t1"><?php the_field('новости_текст', 2); ?></div>
				<form class="rate__form s-form" data-title="true" action="#" method="POST" id="footer-subscribe-form-1">
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
		<div class="rate__inner">
			<div class="rate__slider swiper-container">
				<div class="rate__list swiper-wrapper">
					<?php $loop = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => 20 ) ); ?> 
					<?php while ( $loop->have_posts() ) : $loop->the_post(); ?> 
					<a class="rate__item bg-wrap swiper-slide" href="<?= get_permalink(); ?>" target="_blank">
						<div class="rate__logo"><?php $image = get_field('логотип', 'option'); if( !empty($image) ): ?><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" /><?php endif; ?></div>
						<div class="rate__data">
							<div class="rate__date"><?php the_time('j F Y'); ?></div>
							<div class="rate__desc t1"><?php the_title(); ?></div>
							<div class="rate__watch"><img src="<?= TEMP() ?>_/uploads/icons/eye.png" alt=""><var><?php if(function_exists('the_views')) { the_views(); } ?></var></div>
						</div>
						<div class="rate__img bg"><?php echo get_the_post_thumbnail(); ?></div>
					</a>
					<?php endwhile; ?>
					<?php wp_reset_query();?>
				</div>
			</div>
			<div class="rate__controls">
				<div class="rate__more link --md"><a href="/analitika-i-novosti/" target="_blank"><?php the_field('новости_ссылка_-_текст', 2); ?></a></div>
				<div class="rate__arrows rate__arrows arrows">
					<div class="rate__arrow swiper-button-prev btn arrow --bg-yellow --radius --prev">
						<svg width="23" height="17" viewBox="0 0 23 17" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M14.5451 17L12.5437 15.029L16.0972 11.4976L18.1394 9.77295L18.0986 9.64976L14.1366 9.89614H0L0 7.10386H14.1366L18.0986 7.35024L18.1394 7.22705L16.0972 5.50242L12.5437 1.97101L14.5451 0L23 8.5L14.5451 17Z" fill="#0F1011"/>
						</svg>
					</div>
					<div class="rate__arrow swiper-button-next btn arrow --bg-yellow --radius --next">
						<svg width="23" height="17" viewBox="0 0 23 17" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M14.5451 17L12.5437 15.029L16.0972 11.4976L18.1394 9.77295L18.0986 9.64976L14.1366 9.89614H0L0 7.10386H14.1366L18.0986 7.35024L18.1394 7.22705L16.0972 5.50242L12.5437 1.97101L14.5451 0L23 8.5L14.5451 17Z" fill="#0F1011"/>
						</svg>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="rate__scheme-1 bg"><img src="<?= TEMP() ?>_/uploads/scheme-13.png" alt=""></div>
	<div class="rate__scheme-2 bg"><img src="<?= TEMP() ?>_/uploads/scheme-14.png" alt=""></div>
</div>
<script>document.addEventListener('DOMContentLoaded', ()=>{
	var priceList = new Swiper('.rate__slider', {
		spaceBetween: 20,
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},
		breakpoints: {
			320: {
				slidesPerView: 1,
			},
			768: {
				slidesPerView: 'auto',
			}
		}
	}); 
	});
</script>