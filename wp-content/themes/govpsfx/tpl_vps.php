<?php 
/*
Template Name: VPS
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
							<?php wp_nav_menu(['theme_location'  => 'vps']); ?>
						</div>
						<a class="page__btn-get btn --lg --b-white --radius" href="https://my.govpsfx.com/registration" target="_blank"><?php esc_html_e('получить', 'govpsfx') ?> <br> <?php esc_html_e('бесплатный vps', 'govpsfx') ?></a>
						<div class="page__share share --left">
							<?php include 'parts/share.php'; ?>
						</div>
					</div>
				</div>
				<div class="page__section">
					<div class="page__text t1">
						<?php the_content(); ?>
					</div>
					<link rel="stylesheet" href="<?= TEMP() ?>_/blocks/get-free/get-free.css?ver=1616599708919">
					<div class="get-free__list --mt-m">
						<?php $i = 1; ?>
						<?php if( have_rows('шаги') ){ while ( have_rows('шаги') ) : the_row(); if( get_row_layout() == 'блок' ){ ?>
						<div class="get-free__item">
							<div class="get-free__count">#0<?= $i ?></div>
							<div class="get-free__text"><?php the_sub_field('текст'); ?></div>
						</div>
						<?php $i++; } endwhile; }?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include 'parts/combo-offer.php'; ?>
	<div class="page__bg-34 bg"><img src="<?= TEMP() ?>_/uploads/scheme-true-vps-1.png" alt=""></div>
	<div class="page__bg-35 bg"><img src="<?= TEMP() ?>_/uploads/scheme-true-vps-2.png" alt=""></div>
</div>

<?php get_footer(); ?>