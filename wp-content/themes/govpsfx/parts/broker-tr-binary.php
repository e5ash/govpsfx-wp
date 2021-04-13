<tr data-name="<?php the_field('search_enru'); ?>">
	<td>
		<a href="<?= the_field('brokers_open_account', $broker->ID); ?>" class="t-img" target="_blank"><img src="<?= get_the_post_thumbnail_url($broker->ID, 'brokers_thumb'); ?>" alt="<?php the_title(); ?>"></a>
	</td>
	<td><?= the_field('brokers_based'); ?></td>
	<td><?= the_field('brokers_regulator'); ?></td>
	<td>$<?= the_field('brokers_minimum_deposit'); ?></td>
	<td><?= the_field('brokers_rate', $broker_b->ID); ?> USD</td>
	<td><?= the_field('brokers_income', $broker_b->ID); ?> %</td>
	<td>
		<div class="t-grp btn-grp">
			<a class="t-open btn --lg --b-white --radius" href="<?= the_field('brokers_open_account', $broker->ID); ?>" target="_blank"><?php esc_html_e('открыть счёт', 'govpsfx') ?></a>
			<a class="t-link link" href="<?= the_permalink(5614); ?>" target="_blank"><?php esc_html_e('Основы торговли', 'govpsfx') ?></a>
	</td>
</tr>