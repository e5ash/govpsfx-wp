<link rel="stylesheet" href="<?= TEMP() ?>_/blocks/combo-offer/combo-offer.css?ver=1616959373837">
<div class="combo-offer overflow-disable --inner">
	<div class="case --sm">
		<div class="combo-offer__title h4"><?php the_field('комбо_заголовок', 24863); ?></div>
		<div class="combo-offer__desc t1"><?php the_field('комбо_текст', 24863); ?></div>
		<div class="combo-offer__slider swiper-container --has-pagination">
			<link rel="stylesheet" href="<?= TEMP() ?>_/blocks/bonuses/bonuses.css?ver=1616959373837">
			<div class="bonuses__list swiper-wrapper">
				<?php $loop = new WP_Query( array( 'post_type' => 'bonuses', 'posts_per_page' => 0 ) ); ?> 
				<?php while ( $loop->have_posts() ) : $loop->the_post(); ?> 
				<div class="bonuses__item swiper-slide">
						<div class="bonuses__name h4"><?php the_title(); ?></div>
						<div class="bonuses__count"><?= the_field('bonus_cost', $bonus->ID); ?></div>
						<div class="bonuses__data">
							<ul>
								<li><?= the_field('bonus_param_1', $bonus->ID); ?></li>
								<li><?= the_field('bonus_param_2', $bonus->ID); ?></li>
							</ul>
						</div>
						<a class="bonuses__more btn --lg --bg-yellow --bb --radius" href="<?= the_permalink($bonus->ID); ?>" target="_blank"><?php esc_html_e('подробности', 'govpsfx') ?></a>
						<div class="bonuses__share share">
							<?php include 'share.php' ?>
						</div>
					</div>
				<?php endwhile; ?>
				<?php wp_reset_query();?>
			</div>
			<div class="combo-offer__pagination swiper-pagination"></div>
			<div class="combo-offer__arrows arrows">
				<div class="combo-offer__arrow swiper-button-prev btn arrow --bg-yellow --radius --prev">
					<svg width="23" height="17" viewBox="0 0 23 17" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M14.5451 17L12.5437 15.029L16.0972 11.4976L18.1394 9.77295L18.0986 9.64976L14.1366 9.89614H0L0 7.10386H14.1366L18.0986 7.35024L18.1394 7.22705L16.0972 5.50242L12.5437 1.97101L14.5451 0L23 8.5L14.5451 17Z" fill="#0F1011"/>
					</svg>
				</div>
				<div class="combo-offer__arrow swiper-button-next btn arrow --bg-yellow --radius --next">
					<svg width="23" height="17" viewBox="0 0 23 17" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M14.5451 17L12.5437 15.029L16.0972 11.4976L18.1394 9.77295L18.0986 9.64976L14.1366 9.89614H0L0 7.10386H14.1366L18.0986 7.35024L18.1394 7.22705L16.0972 5.50242L12.5437 1.97101L14.5451 0L23 8.5L14.5451 17Z" fill="#0F1011"/>
					</svg>
				</div>
			</div>
		</div>
	</div>
	<div class="combo-offer__bg-1 bg"><img src="<?= TEMP() ?>_/uploads/scheme-combo-offer-1.png" alt=""></div>
	<div class="combo-offer__bg-2 bg"><img src="<?= TEMP() ?>_/uploads/scheme-combo-offer-2.png" alt=""></div>
</div>
<script>document.addEventListener('DOMContentLoaded', ()=>{
	var comboList = new Swiper('.combo-offer__slider', {
		slidesPerView: 3,
		slidesPerGroup: 3,
		spaceBetween: 30,
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},
		pagination: {
			el: '.swiper-pagination',
			clickable: true,
		},
		breakpoints: {
			320: {
				slidesPerView: 1,
				slidesPerGroup: 1,
			}, 
			993: {
				slidesPerView: 2,
				slidesPerGroup: 2,
			},
			1100: {
				slidesPerView: 3,
				slidesPerGroup: 3,
			}
		}
	}); 
	});
</script>