<tr data-name="<?php the_field('search_enru'); ?>" data-deposit-min="<?= the_field('brokers_minimum_deposit'); ?>" data-leverage="<?= the_field('brokers_Leverage'); ?>" data-spread-min="<?= the_field('brokers_minimum_spread'); ?>" data-terminal="<?= broker_trading_terminal($broker->ID, 'brokers_trading_terminal'); ?>">
	<td>
		<a href="<?= the_field('brokers_open_account', $broker->ID); ?>" class="t-img" target="_blank"><img src="<?= get_the_post_thumbnail_url($broker->ID, 'brokers_thumb'); ?>" alt="<?php the_title(); ?>"></a>
	</td>
	<td><?= the_field('brokers_based'); ?></td>
	<td><?= the_field('brokers_regulator'); ?></td>
	<td>$<?= the_field('brokers_minimum_deposit'); ?></td>
	<td><?php esc_html_e('до', 'govpsfx') ?> 1:<?= the_field('brokers_Leverage'); ?></td>
	<td><?= the_field('brokers_minimum_lot'); ?></td>
	<td><?php esc_html_e('от', 'govpsfx') ?> <?= the_field('brokers_minimum_spread'); ?> <?php esc_html_e('пп', 'govpsfx') ?></td>
	<td><?= broker_trading_terminal($broker->ID, 'brokers_trading_terminal'); ?></td>
	<td>
		<div class="t-grp btn-grp">
			<?php $brokers_rebate = get_field('brokers_rebate_link', $broker->ID); ?>
			<a href="<?= $brokers_rebate[0] ? get_the_permalink($brokers_rebate[0]) : null ?>" target="_blank" class="t-link link"><?php esc_html_e('Расчет рибейта', 'govpsfx') ?></a>
			<a class="t-open btn --lg --b-white --radius" href="<?= the_field('brokers_open_account', $broker->ID); ?>" target="_blank"><?php esc_html_e('открыть счёт', 'govpsfx') ?></a>
		</div>
	</td>
</tr>