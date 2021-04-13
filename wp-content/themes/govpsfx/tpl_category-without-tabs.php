<?php
/*
Template Name: Категории без вкладок

*/
get_header(); ?>

<div class="page bg-wrap">
	<div class="case">
		<div class="page__head">
			<?php include 'parts/breadcrumbs.php' ?>
		</div>
		<div class="page__body">
			<div class="page__wrap row">
				<div class="page__sidebar">
					<div class="page__sticky">
						<div class="page__nav">
							<?php 
								$rrr = get_ancestors( get_the_ID(), 'page' );
								$p_id = (isset($rrr[0]) ? $rrr[0] : get_the_ID());
							?>
							<?php if ($p_id) { ?>
								<ul>
									<?php foreach(children_pages($p_id) as $page) : ?>
									<li class="<?= $page->ID == get_the_ID() ? 'current-menu-item' : null ?>">
										<a href="<?= the_permalink($page->ID); ?>" target="_blank"><?= $page->post_title; ?></a>
									</li>
									<?php endforeach; ?>
								</ul>
							<?php } ?>
						</div>
					</div>
				</div>
				<div class="page__section">
					<div class="page__text t1 --custom-tables"><?= the_content() ?></div>
					<div class="share --left">
						<?php include 'parts/share.php'; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="combo-offer overflow-disable --inner">
		<div class="case --sm">
			<link rel="stylesheet" href="<?= TEMP() ?>_/blocks/combo-offer/combo-offer.css?ver=1617096435343">
			<div class="combo-offer__title h4"><?php the_field('комбо_заголовок', 18712); ?></div>
			<div class="combo-offer__desc t1"><?php the_field('комбо_подзаголовок', 18712); ?></div>
			<div class="combo-offer__slider swiper-container --has-pagination">
				<link rel="stylesheet" href="<?= TEMP() ?>_/blocks/bonuses/bonuses.css?ver=1617096435344">
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
								<?php include 'parts/share.php' ?>
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
		</div>
		<div class="combo-offer__bg-1 bg"><img src="<?= TEMP() ?>_/uploads/scheme-combo-offer-1.png" alt=""></div>
		<div class="combo-offer__bg-2 bg"><img src="<?= TEMP() ?>_/uploads/scheme-combo-offer-2.png" alt=""></div>
	</div>
	<?php $following_articles = read_following_article($post->post_parent, get_the_ID()); ?>
	<?php if(isset($following_articles)) : ?>
	<div class="case">
	<div class="page__next-wrap">
		<a class="page__next btn --xlg --more --b-yellow --h-icon-yellow --radius" href="<?= $following_articles['href'] ?>" target="_blank">
			<div class="btn__text">
				<div class="btn__title"><?php esc_html_e('Читайте следующую статью:', 'govpsfx') ?></div>
				<div class="btn__desc"><?= $following_articles['title'] ?></div>
			</div>
			<div class="btn__icon">
				<svg width="13" height="9" viewBox="0 0 13 9" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd" clip-rule="evenodd" d="M8.22113 9L7.0899 7.95652L9.09841 6.08696L10.2527 5.17391L10.2296 5.1087L7.99026 5.23913H0L0 3.76087H7.99026L10.2296 3.8913L10.2527 3.82609L9.09841 2.91304L7.0899 1.04348L8.22113 0L13 4.5L8.22113 9Z" fill="#FFB800"></path>
				</svg>
			</div>
		</a>
	</div>
	</div>
	<?php endif; ?>
	<div class="page__bg-39 bg"><img src="<?= TEMP() ?>_/uploads/scheme-cat-1.png" alt=""></div>
	<div class="page__bg-40 bg"><img src="<?= TEMP() ?>_/uploads/scheme-cat-2.png" alt=""></div>
</div>

<?php get_footer(); ?>