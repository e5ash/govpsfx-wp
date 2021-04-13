<?php 
/*
Template Name: Конкурс - участники
*/
get_header(); ?>

<div class="page bg-wrap">
	<div class="case">
		<div class="page__head">
			<?php include 'parts/breadcrumbs.php' ?>
		</div>
		<div class="page__body --sm">
			<div class="page__title h1"><?php the_title(); ?></div>
			<div class="page__text t1">
				<blockquote class="blockquote tog --show">
					<div class="blockquote__title tog-head"><?php esc_html_e('Участники розыгрыша', 'govpsfx') ?> </div>
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
	<div class="page__bg-7 bg"><img src="<?= TEMP() ?>_/uploads/scheme-bonuses-1.png" alt=""></div>
</div>

<?php get_footer(); ?>