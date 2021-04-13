<link rel="stylesheet" href="<?= TEMP() ?>_/blocks/price/price.css?ver=1616599710166">
<div class="price bg-wrap">
	<div class="case">
		<div class="price__title h2 tac">
			<h2><?php the_field('стоимость_заголовок'); ?></h2>
		</div>
		<div class="price__subtitle tac"><?php the_field('стоимость_подзаголовок'); ?></div>
		<div class="price__slider swiper-container --has-pagination">
			<div class="price__list swiper-wrapper">
				<?php $loop = new WP_Query( array( 'post_type' => 'vps', 'posts_per_page' => 0 ) ); ?> 
				<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
				<?= get_template_part('parts/price-item'); ?>
				<?php endwhile; ?>
				<?php wp_reset_query();?>
			</div>
			<div class="price__pagination swiper-pagination"></div>
			<div class="price__arrows arrows">
				<div class="price__arrow swiper-button-prev btn arrow --bg-yellow --radius --prev">
					<svg width="23" height="17" viewBox="0 0 23 17" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M14.5451 17L12.5437 15.029L16.0972 11.4976L18.1394 9.77295L18.0986 9.64976L14.1366 9.89614H0L0 7.10386H14.1366L18.0986 7.35024L18.1394 7.22705L16.0972 5.50242L12.5437 1.97101L14.5451 0L23 8.5L14.5451 17Z" fill="#0F1011"/>
					</svg>
				</div>
				<div class="price__arrow swiper-button-next btn arrow --bg-yellow --radius --next">
					<svg width="23" height="17" viewBox="0 0 23 17" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M14.5451 17L12.5437 15.029L16.0972 11.4976L18.1394 9.77295L18.0986 9.64976L14.1366 9.89614H0L0 7.10386H14.1366L18.0986 7.35024L18.1394 7.22705L16.0972 5.50242L12.5437 1.97101L14.5451 0L23 8.5L14.5451 17Z" fill="#0F1011"/>
					</svg>
				</div>
			</div>
		</div>
	</div>
	<div class="price__scheme-1 bg"><img src="<?= TEMP() ?>_/uploads/scheme-7.png" alt=""></div>
</div>
<script src="<?= TEMP() ?>_/blocks/price/price.js?ver=1616599710166"></script>