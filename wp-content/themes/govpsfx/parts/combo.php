<link rel="stylesheet" href="<?= TEMP() ?>_/blocks/combo/combo.css?ver=1616599710167">
<div class="combo">
	<div class="case">
		<div class="combo__title h2 tac">
			<h2><?php the_field('комбо_заголовок'); ?></h2>
		</div>
		<div class="combo__subtitle tac"><?php the_field('комбо_подзаголовок'); ?></div>
		<div class="combo__slider swiper-container --has-pagination">
			<div class="combo__list swiper-wrapper">
				<?php 
					$btn  = get_field('комбо_кнопка'); 
					$link = get_field('комбо_ссылка');
				?>
				<?php $loop = new WP_Query( array( 'post_type' => 'bonuses', 'posts_per_page' => 0 ) ); ?> 
				<?php while ( $loop->have_posts() ) : $loop->the_post(); ?> 
				<div class="combo__item row swiper-slide">
					<div class="combo__img-wrap bg-wrap">
						<div class="combo__img bg"><?php echo get_the_post_thumbnail(); ?></div>
					</div>
					<div class="combo__content">
						<div class="combo__text t1"><?php the_field('bonus_small_information'); ?></div>
						<div class="combo__grp btn-grp">
							<a class="combo__btn btn --lg --b-white --radius" href="<?= get_permalink(); ?>" target="_blank"><?=$btn ?></a>
							<div class="combo__link link"><a href="/bonuses/" target="_blank"><?= $link ?></a></div>
						</div>
					</div>
				</div>
				<?php endwhile; ?>
				<?php wp_reset_query();?>
			</div>
			<div class="combo__pagination swiper-pagination"></div>
			<div class="combo__arrows arrows">
				<div class="combo__arrow swiper-button-prev btn arrow --bg-yellow --radius --prev">
					<svg width="23" height="17" viewBox="0 0 23 17" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M14.5451 17L12.5437 15.029L16.0972 11.4976L18.1394 9.77295L18.0986 9.64976L14.1366 9.89614H0L0 7.10386H14.1366L18.0986 7.35024L18.1394 7.22705L16.0972 5.50242L12.5437 1.97101L14.5451 0L23 8.5L14.5451 17Z" fill="#0F1011"/>
					</svg>
				</div>
				<div class="combo__arrow swiper-button-next btn arrow --bg-yellow --radius --next">
					<svg width="23" height="17" viewBox="0 0 23 17" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M14.5451 17L12.5437 15.029L16.0972 11.4976L18.1394 9.77295L18.0986 9.64976L14.1366 9.89614H0L0 7.10386H14.1366L18.0986 7.35024L18.1394 7.22705L16.0972 5.50242L12.5437 1.97101L14.5451 0L23 8.5L14.5451 17Z" fill="#0F1011"/>
					</svg>
				</div>
			</div>
		</div>
	</div>
</div>
<script>document.addEventListener('DOMContentLoaded', ()=>{
	var priceList = new Swiper('.combo__slider', {
		slidesPerView: 1,
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},
		autoplay: {
			delay: 2500,
			disableOnInteraction: false,
		},
		pagination: {
			el: '.swiper-pagination',
			clickable: true,
		},
	}); 
	});
</script>