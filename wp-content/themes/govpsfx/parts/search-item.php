<div class="search-list__item">
	<?php if (is_array($post)) {
		$post = (object)$post;
		$link = get_permalink($post->id);
	} else {
		$link = get_permalink($post->ID);
	} ?>
	<div class="search-list__name"><?= $post->post_title ?></div>
	<div class="search-list__text"><?= wph_cut_by_words(300, strip_tags($post->post_content)); ?></div>
	<div class="search-list__link link"><a href="<?= $link ?>" target="_blank"><?php esc_html_e('ПОДРОБНЕЕ', 'govpsfx') ?> →</a></div>
</div>