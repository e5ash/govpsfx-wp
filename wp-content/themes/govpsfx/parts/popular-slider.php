<div class="popular__slider swiper-container --has-pagination">
	<div class="popular__list swiper-wrapper">
		<?php $btnText = get_field('популярные_итем_кнопка_-_текст', 2); $linkText = get_field('популярные_итем_-_ссылка_-_текст', 2); ?>

		<?php $loop = new WP_Query( array( 'post_type' => 'advisers', 'posts_per_page' => 3, 'advisers_category' => 'author_advisers', 'meta_key' => 'advisers_total_profit', 'orderby'			=> 'meta_value_num', ) ); ?>
		<?php while ( $loop->have_posts() ) : $loop->the_post(); ?> 
		<?php get_template_part('parts/popular-item'); ?>
		<?php endwhile; ?>

		<?php $loop = new WP_Query( array( 'post_type' => 'advisers', 'posts_per_page' => 3, 'advisers_category' => 'free_advisers', 'meta_key' => 'advisers_total_profit', 'orderby'			=> 'meta_value_num', ) ); ?>
		<?php while ( $loop->have_posts() ) : $loop->the_post(); ?> 
		<?php get_template_part('parts/popular-item'); ?>
		<?php endwhile; ?>
		<?php wp_reset_query();?>
	</div>
	<div class="popular__pagination swiper-pagination"></div>
	<div class="popular__arrows arrows">
		<div class="popular__arrow swiper-button-prev btn arrow --bg-yellow --radius --prev">
			<svg width="23" height="17" viewBox="0 0 23 17" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path fill-rule="evenodd" clip-rule="evenodd" d="M14.5451 17L12.5437 15.029L16.0972 11.4976L18.1394 9.77295L18.0986 9.64976L14.1366 9.89614H0L0 7.10386H14.1366L18.0986 7.35024L18.1394 7.22705L16.0972 5.50242L12.5437 1.97101L14.5451 0L23 8.5L14.5451 17Z" fill="#0F1011"/>
			</svg>
		</div>
		<div class="popular__arrow swiper-button-next btn arrow --bg-yellow --radius --next">
			<svg width="23" height="17" viewBox="0 0 23 17" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path fill-rule="evenodd" clip-rule="evenodd" d="M14.5451 17L12.5437 15.029L16.0972 11.4976L18.1394 9.77295L18.0986 9.64976L14.1366 9.89614H0L0 7.10386H14.1366L18.0986 7.35024L18.1394 7.22705L16.0972 5.50242L12.5437 1.97101L14.5451 0L23 8.5L14.5451 17Z" fill="#0F1011"/>
			</svg>
		</div>
	</div>
</div>
<script>
	document.addEventListener('DOMContentLoaded', ()=>{
	var priceList = new Swiper('.popular__slider', {
		slidesPerView: 2,
		slidesPerGroup: 2,
		spaceBetween: 30,
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},
		pagination: {
			el: '.swiper-pagination',
			type: 'bullets',
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
			}
		}
	}); 
	});
</script>