<?php $p_id = get_the_ID();?>
<?php foreach(children_pages($p_id) as $page) : ?>
	<?php if (!children_pages($page->ID)) : ?>
	<ul class="a-gray">
	<?php endif; ?>
	
	<?php if (children_pages($page->ID)) : ?>
	<h2 class="instruct-1__hd instruct-1__hd-1"><?= $page->post_title; ?></h2>
	<ul class="a-gray">
	<?php foreach (children_pages($page->ID) as $ch_pages) : ?>
		<li>
			<a href="<?= the_permalink($ch_pages->ID); ?>" target="_blank" class="content__point">
				<?= $ch_pages->post_title; ?>
			</a>
		</li>
	<?php endforeach; ?>
	<?php else : ?>
		<li>
			<a href="<?= the_permalink($page->ID); ?>" target="_blank">
				<?= $page->post_title; ?>
			</a>
		</li>
	<?php endif; ?>
	</ul>
<?php endforeach; ?>