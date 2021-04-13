<?php get_header(); ?>

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
							<div class="page__nav-title"><?php esc_html_e('Термины на эту же букву', 'govpsfx') ?></div>
							<div class="page__nav-list">
								<?php 
								$word = mb_substr(get_the_title(), 0, 1, "utf-8");
								//echo $word;
								$post_type = 'glossary';
								$numberposts = get_option('glossary_page_count');

								$glossarys = get_posts([
									'post_type' => $post_type,
									'numberposts' => $word ? -1 : $numberposts,
									'order' => 'ASC',
								]);

								if (!$word) :
								foreach ($glossarys as $glossary) :
							?>
							
								<a href="<?= the_permalink($glossary->ID); ?>" class="article__menu-item-link mb0" target="_blank"><?= $glossary->post_title; ?></a>
								<?php endforeach; ?>
							<?php else : ?>
								<?php if ($gsearch = glossary_search($glossarys, $word)) : ?>
								<?php foreach ($gsearch as $value) : ?>
									<?php
									$active_class = '';
									 if($value['id'] == get_the_ID()) {
									 	$active_class = '--selected';
									 } ?>
								<a href="<?= $value['href'] ?>" class="article__menu-item-link mb0 <?= $active_class ?>" target="_blank"><?= $value['post_title']; ?></a>
								<?php endforeach; ?>
								<?php else : ?>
									<div class="posts-not-found"><?php esc_html_e('Пока здесь нет терминов, но мы над этим работаем', 'govpsfx') ?></div>
								<?php endif; ?>
							<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
				<div class="page__section">
					<div class="page__text t1"><?php the_content(); ?></div>
				</div>
			</div>
		</div>
	</div>
	<div class="page__bg-47 bg"><img src="<?= TEMP() ?>_/uploads/scheme-glossary-1.png" alt=""></div>
</div>

<?php get_footer(); ?>