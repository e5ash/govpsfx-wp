<link rel="stylesheet" href="<?= TEMP() ?>_/blocks/reviews/reviews.css?ver=1616599710167">
<div class="reviews tac bg-wrap">
	<div class="case">
		<div class="reviews__title h2">
			<h2><?php the_field('отзывы_заголовок'); ?></h2>
		</div>
		<div class="reviews__slider swiper-container --has-pagination">
			<div class="reviews__list swiper-wrapper">
				<?php $loop = new WP_Query( array(
				 'post_type' => 'testimonial', 
				 'posts_per_page' => 0, 
				 'testimonial_category' => 'main' ) ); ?> 
				<?php while ( $loop->have_posts() ) : $loop->the_post(); ?> 
				<div class="reviews__item swiper-slide">
					<div class="reviews__img-wrap bg-wrap">
						<div class="reviews__img bg"><?php echo get_the_post_thumbnail(); ?></div>
					</div>
					<div class="reviews__text"><?php the_content(); ?></div>
					<div class="reviews__name"><?php the_title(); ?></div>
				</div>
				<?php endwhile; ?>
				<?php wp_reset_query();?>
			</div>
			<div class="reviews__pagination swiper-pagination"></div>
			<div class="reviews__arrows arrows">
				<div class="reviews__arrow swiper-button-prev btn arrow --bg-yellow --radius --prev">
					<svg width="23" height="17" viewBox="0 0 23 17" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M14.5451 17L12.5437 15.029L16.0972 11.4976L18.1394 9.77295L18.0986 9.64976L14.1366 9.89614H0L0 7.10386H14.1366L18.0986 7.35024L18.1394 7.22705L16.0972 5.50242L12.5437 1.97101L14.5451 0L23 8.5L14.5451 17Z" fill="#0F1011"/>
					</svg>
				</div>
				<div class="reviews__arrow swiper-button-next btn arrow --bg-yellow --radius --next">
					<svg width="23" height="17" viewBox="0 0 23 17" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M14.5451 17L12.5437 15.029L16.0972 11.4976L18.1394 9.77295L18.0986 9.64976L14.1366 9.89614H0L0 7.10386H14.1366L18.0986 7.35024L18.1394 7.22705L16.0972 5.50242L12.5437 1.97101L14.5451 0L23 8.5L14.5451 17Z" fill="#0F1011"/>
					</svg>
				</div>
			</div>
		</div>
	</div>
	<div class="reviews__scheme-1 bg"><img src="<?= TEMP() ?>_/uploads/scheme-8.png" alt=""></div>
	<div class="reviews__scheme-2 bg"><img src="<?= TEMP() ?>_/uploads/scheme-9.png" alt=""></div>
</div>
<script>document.addEventListener('DOMContentLoaded', ()=>{
	var priceList = new Swiper('.reviews__slider', {
		slidesPerView: 1,
		spaceBetween: 126,
		loop: true,
		loopAdditionalSlides: 5,
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},
		pagination: {
			el: '.swiper-pagination',
			clickable: true,
		},
	}); 
	});
</script>