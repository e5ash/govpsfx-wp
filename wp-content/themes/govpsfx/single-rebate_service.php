<?php get_header(); ?>

<div class="page bg-wrap">
	<div class="case">
		<div class="page__head">
			<?php include 'parts/breadcrumbs.php'; ?>
		</div>
		<div class="page__body --sm">
			<link rel="stylesheet" href="<?= TEMP() ?>_/blocks/rebate/rebate.css?ver=1617354582258">
			<div class="rebate">
				<div class="case">
					<div class="rebate__text t1">
						<?php the_content(); ?>
					</div>
				</div>
				<link rel="stylesheet" href="<?= TEMP() ?>_/components/incdec/incdec.css?ver=1617354582259">
				<script src="<?= TEMP() ?>_/components/incdec/incdec.js?ver=1617354582259"></script>
			</div>
			<script src="<?= TEMP() ?>_/blocks/rebate/rebate.js?ver=1617354582259"></script>
			<?php if ($articles = get_field('rebate_articles', get_the_ID())) : ?>
			<link rel="stylesheet" href="<?= TEMP() ?>_/blocks/need-help/need-help.css?ver=1617354582259">
			<div class="need-help">
				<div class="need-help__title h5"><?php esc_html_e('Остались вопросы?', 'govpsfx') ?></div>
				<div class="need-help__list">
					<div class="need-help__item">
						<div class="need-help__name t1"><?php esc_html_e('Почитайте наши статьи:', 'govpsfx') ?></div>
						<div class="need-help__btns row">
							<?php foreach ($articles as $article) : ?>
							<a class="need-help__btn btn --lg --b-yellow --radius" href="<?= the_permalink($article->ID); ?>" target="_blank"><?= $article->post_title; ?>  →</a>
							<?php endforeach; ?>
						</div>
					</div>
					<div class="need-help__item">
						<div class="need-help__name t1 --mb"><?php esc_html_e('или', 'govpsfx') ?></div>
						<div class="need-help__btns row"><a class="need-help__btn btn --lg --b-yellow --radius" href="javascript:;" data-src="#modal-feedback" data-popup=""><?php esc_html_e('напишите нам, поможем', 'govpsfx') ?></a>
						</div>
					</div>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</div>
	<div class="page__bg-31 bg"><img src="<?= TEMP() ?>_/uploads/scheme-rebate-1.png" alt=""></div>
	<div class="page__bg-32 bg"><img src="<?= TEMP() ?>_/uploads/scheme-rebate-2.png" alt=""></div>
	<div class="page__bg-33 bg"><img src="<?= TEMP() ?>_/uploads/scheme-rebate-3.png" alt=""></div>
</div>

<?php get_footer(); ?>