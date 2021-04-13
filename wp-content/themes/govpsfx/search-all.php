<?php

	$search_get = $_GET["s"];
	$post_type = $_GET["post_type"];

	$args = [
		's' => $search_get,
	];

	$the_query = new WP_Query($args);

?>
<div class="page bg-wrap">
	<div class="case">
		<div class="page__head">
			<?php include 'parts/breadcrumbs.php'; ?>
		</div>
		<div class="page__body">
			<div class="page__title h1">
				<h1><?php esc_html_e('Поиск по сайту', 'govpsfx') ?></h1>
			</div>
			<link rel="stylesheet" href="<?= TEMP() ?>_/blocks/search-list/search-list.css?ver=1617394691974">
			<div class="search-list">
				<div class="search-list__list">
				<?php if ($the_query->have_posts()) : ?>
				<?php while ( $the_query->have_posts() ) : $the_query->the_post();
					// $post = $

					
					get_template_part('parts/search-item');

				endwhile; ?>
				
				</div>
				<div class="search-list__controls row">
					<?= posts_nav_link(' '); ?>
				</div>
				<?php else : ?>
				<div class="search-list__false h4"><?php esc_html_e('Ничего не найдено', 'govpsfx') ?></div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="page__bg-37 bg"><img src="<?= TEMP() ?>_/uploads/scheme-search-1.png" alt=""></div>
	<div class="page__bg-38 bg"><img src="<?= TEMP() ?>_/uploads/scheme-search-2.png" alt=""></div>
</div>