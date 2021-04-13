<link rel="stylesheet" href="<?= TEMP() ?>_/blocks/ping/ping.css?ver=1616599710166">
<div class="ping bg-wrap">
	<div class="case">
		<div class="ping__title h2 tac">
			<h2><?php the_field('ping_заголовок'); ?></h2>
		</div>
		<div class="ping__select select --md --b-yellow" data-placeholder="<?php esc_html_e('Выберите брокера', 'govpsfx') ?>">
			<select name="ping">
				<?php $loop = new WP_Query( array( 'post_type' => 'brokers', 'posts_per_page' => -1, 'brokers_category' => 'forex_brokers' ) ); ?> 
				<?php while ( $loop->have_posts() ) : $loop->the_post(); ?> 
					<option value="<?php the_field('brokers_name'); ?>" data-ping-1="<?php the_field('ping_free_vps'); ?>" data-ping-2="<?php the_field('ping_tarif_classic'); ?>" data-ping-3="<?php the_field('ping_tarif_start_nl'); ?>"><?php the_field('brokers_name'); ?></option>
				<?php endwhile; ?>
				<?php wp_reset_query();?>
			</select>
		</div>
		<div class="ping__wrap">
			<div class="ping__table">
				<table>
					<tr>
						<td><?php the_field('ping_категория_1'); ?></td>
						<td><var id="ping-value-1"></var></td>
					</tr>
					<tr>
						<td><?php the_field('ping_категория_2'); ?></td>
						<td><var id="ping-value-2"></var></td>
					</tr>
					<tr>
						<td><?php the_field('ping_категория_3'); ?></td>
						<td><var id="ping-value-3"></var></td>
					</tr>
				</table>
			</div>
			<div class="ping__load"><?php esc_html_e('Загрузка', 'govpsfx') ?> . . .</div>
		</div>
	</div>
	<div class="ping__scheme-1 bg"><img src="<?= TEMP() ?>_/uploads/scheme-6.png" alt=""></div>
</div>
<script src="<?= TEMP() ?>_/blocks/ping/ping.js"></script>