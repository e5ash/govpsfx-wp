<?php 
/*
Template Name: Конкурс - победители
*/
get_header(); ?>

<div class="page bg-wrap">
	<div class="case">
		<div class="page__head">
			<?php include 'parts/breadcrumbs.php' ?>
		</div>
		<div class="page__body --sm">
			<div class="page__title h1"><h1><?php the_title(); ?></h1></div>
			<div class="page__text t1">
				<div class="winners">
					<div class="winners__value">
						<div class="winners__value-title h4">Цена закрытия по терминалу:</div>
						<div class="winners__value-count h1"><?php the_field('terminal_closing_price'); ?></div>
					</div>
					<div class="winners__table">
					<?php the_content(); ?>
					</div>
				</div>
				<blockquote class="blockquote tog --show">
					<div class="blockquote__title tog-head"><?php esc_html_e('Участники розыгрыша', 'govpsfx') ?> <?php the_field('konkurs_number'); ?></div>
					<div class="blockquote__content tog-body">
						<?= do_shortcode(get_field('list_participants', get_the_ID())); ?>
					</div>
				</blockquote>
			</div>
			<?php $participateID = wp_get_post_parent_id(get_the_ID());  ?>
			<div class="page__btn-wrap btn-wrap"><a class="page__btn-more btn --lg --bg-yellow --radius" href="#modal-contest" data-popup=""><?php esc_html_e('участвовать в конкурсе', 'govpsfx') ?></a></div>
			<?php include 'parts/modal-participate.php'; ?>
		</div>
	</div>
	<div class="page__bg-36 bg"><img src="<?= TEMP() ?>_/uploads/scheme-winners-1.png" alt=""></div>
</div>


<?php get_footer(); ?>