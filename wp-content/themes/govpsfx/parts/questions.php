<link rel="stylesheet" href="<?= TEMP() ?>_/blocks/questions/questions.css?ver=1616959379376">
<?php if ($questions = get_field('page_faq_list_free', 4617)) : ?>
<div class="questions --yellow">
	<div class="case">
		<div class="questions__title h1"><?php esc_html_e('Часто задаваемые вопросы по бесплатным серверам', 'govpsfx') ?></div>
		<div class="questions__list">
			<?php foreach($questions as $question) : ?>
			<div class="questions__item tog">
				<div class="questions__head h5 tog-head"><span><?= $question->post_title; ?></span></div>
				<div class="questions__body t1 tog-body"><?= $question->post_content ?></div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>
<?php endif; ?>
<?php if ($questions = get_field('page_faq_list_paid', 4617)) : ?>
<div class="questions --yellow">
	<div class="case">
		<div class="questions__title h1"><?php esc_html_e('Часто задаваемые вопросы по бесплатным серверам', 'govpsfx') ?></div>
		<div class="questions__list">
			<?php foreach($questions as $question) : ?>
			<div class="questions__item tog">
				<div class="questions__head h5 tog-head"><span><?= $question->post_title; ?></span></div>
				<div class="questions__body t1 tog-body"><?= $question->post_content ?></div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>
<?php endif; ?>