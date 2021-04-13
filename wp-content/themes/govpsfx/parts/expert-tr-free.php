<tr>
	<td>
		<div class="t-name"><a href="<?= get_permalink(); ?>" target="_blank"><?php the_title(); ?></a></div>
	</td>
	<td>
		<?php $profit = get_field('advisers_total_profit'); ?>
		<div class="t-status <?php if($profit>0.0001) { echo "--up"; } else if($profit==0) { echo "--zero"; }else { echo "--down"; }?>">
		<p><?= $profit ?> %</p>
		</div>
	</td>
	<td>
		<div class="t-stat-wrap">
		<canvas class="t-stat" data-percent="<?= get_field('advisers_total_profit_percent') ?>%" data-arr="[<?= get_field('advisers_dynamic') ?>]"></canvas>
		</div>
	</td>
	<td>$<?php the_field('advisers_min_deposit'); ?></td>
	<td>
		<?php
			$stars = get_the_terms(get_the_ID(), 'advisers_rating')[0]->name;
			$starsHasFloat = substr($stars, 0, 2) == '.5' ? true : false;
		?>
		<div class="t-stars">
		<?php echo $stars ? $stars : 0; 
		for($i = 1; $i <= 5; $i++) : ?>
				<svg width="21" height="19" viewBox="0 0 21 19" fill="none" xmlns="http://www.w3.org/2000/svg" class="advisors__table-body-star advisors__table-body-star-0">
				<path d="M10.7327 15.3074L10.5 15.1851L10.2673 15.3074L4.99232 18.0807L5.99976 12.2069L6.04419 11.9478L5.85596 11.7643L1.58839 7.60444L7.48603 6.74746L7.74616 6.70966L7.8625 6.47394L10.5 1.12978L13.1375 6.47394L13.2538 6.70966L13.514 6.74746L19.4116 7.60444L15.144 11.7643L14.9558 11.9478L15.0002 12.2069L16.0077 18.0807L10.7327 15.3074Z" stroke="#FFB800"/>
				<?php if ($stars >= $i) : ?>
					<path fill-rule="evenodd" clip-rule="evenodd" d="M10.5 15.75L4.32825 18.9947L5.50695 12.1223L0.513907 7.25532L7.41413 6.25266L10.5 0L13.5859 6.25266L20.4861 7.25532L15.493 12.1223L16.6717 18.9947L10.5 15.75Z" fill="#FFB800"/>
				<?php endif; ?>
				<?php if (count(explode('.', $stars)) > 1) : ?>
					<?php if ((int)$stars + 1 == $i) : ?>
						<path d="M10.7327 15.3074L10.5 15.1851L10.2673 15.3074L4.99232 18.0807L5.99976 12.2069L6.04419 11.9478L5.85596 11.7643L1.58839 7.60444L7.48603 6.74746L7.74616 6.70966L7.8625 6.47394L10.5 1.12978L13.1375 6.47394L13.2538 6.70966L13.514 6.74746L19.4116 7.60444L15.144 11.7643L14.9558 11.9478L15.0002 12.2069L16.0077 18.0807L10.7327 15.3074Z" fill="url(#paint0_linear)" stroke="#FFB800"/>
						<defs>
							<linearGradient id="paint0_linear" x1="10.5002" y1="12.4315" x2="10.4785" y2="12.4315" gradientUnits="userSpaceOnUse">
								<stop stop-color="#101011"/>
								<stop offset="1" stop-color="#FFB800"/>
							</linearGradient>
						</defs>
					<?php endif; ?>
				<?php endif; ?>
				</svg>
			<?php endfor; ?>
		</div>
	</td>
	<td>
		<a class="t-btn btn --lg --b-white --radius" href="<?= get_permalink(); ?>" target="_blank"><?php esc_html_e('Получить советник', 'govpsfx') ?></a>
	</td>
</tr>