<?php 
/*
Template Name: Тарифы
*/
get_header(); ?>

<div class="page bg-wrap">
	<div class="case">
		<div class="page__head">
			<?php include 'parts/breadcrumbs.php'; ?>
		</div>
		<div class="page__body --sm">
			<div class="page__text --mb-sm t1">
				<?php the_content(); ?>
			</div>
			<link rel="stylesheet" href="<?= TEMP() ?>_/blocks/price/price.css?ver=1616959380790">
			<div class="price__slider swiper-container --has-pagination --lg">
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
			<script src="<?= TEMP() ?>_/blocks/price/price.js?ver=1616959380790"></script>
				
			<?php 
			$returnClasses = ' --lg --sm-pb'; 
			include 'parts/return.php'; ?>

			<link rel="stylesheet" href="<?= TEMP() ?>_/blocks/test/test.css?ver=1616959380791">
			<div class="test bg-wrap">
				<div class="case">
					<div class="test__wrap row">
						<div class="test__content">
							<div class="test__title h5"><?php the_field('тест-драйв_заголовок'); ?></div>
							<div class="test__text t1"><?php the_field('тест-драйв_текст'); ?></div>
							<a class="test__btn btn --sm --bg-yellow --bb --radius" href="<?php the_field('тест-драйв_кнопка_-_ссылка'); ?>" target="_blank"><?php the_field('тест-драйв_кнопка_-_текст'); ?></a>
						</div>
						<div class="test__img-wrap">
							<div class="test__img"><?php $image = get_field('тест-драйв_изображение'); if( !empty($image) ): ?><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" /><?php endif; ?></div>
						</div>
					</div>
				</div>
				<div class="test__bg-1 bg"><img src="<?= TEMP() ?>_/uploads/scheme-test-1.png" alt=""></div>
				<div class="test__bg-2 bg"><img src="<?= TEMP() ?>_/uploads/scheme-test-2.png" alt=""></div>
			</div>
			<div class="page__text t1"><?php the_field('контент_страницы'); ?></div>
			<link rel="stylesheet" href="<?= TEMP() ?>_/blocks/questions/questions.css?ver=1616959380791">
			<div class="questions">
				<div class="case">
					<div class="questions__list">
						<?php if( have_rows('вопросы') ){ while ( have_rows('вопросы') ) : the_row(); if( get_row_layout() == 'блок' ){ ?>
						<div class="questions__item tog">
							<div class="questions__head h5 tog-head"><span><?php the_sub_field('заголовок'); ?></span></div>
							<div class="questions__body t1 tog-body"><?php the_sub_field('контент'); ?></div>
						</div>
						<?php } endwhile; }?>
					</div>
				</div>
			</div>
			<?php include 'parts/need-help.php'; ?>
		</div>
	</div>
	<div class="page__bg-4 bg"><img src="<?= TEMP() ?>_/uploads/scheme-brokers-1.png" alt=""></div>
	<div class="page__bg-5 bg"><img src="<?= TEMP() ?>_/uploads/scheme-brokers-2.png" alt=""></div>
	<div class="page__bg-6 bg"><img src="<?= TEMP() ?>_/uploads/scheme-brokers-3.png" alt=""></div>
</div>

<?php get_footer(); ?>