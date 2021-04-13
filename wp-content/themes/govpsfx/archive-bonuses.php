<?php get_header(); ?>

<div class="page bg-wrap">
	<div class="case">
		<div class="page__head">
			<?php include 'parts/breadcrumbs.php' ?>
		</div>
		<div class="page__body">
			<?php $idPage = 24863; ?>
			<div class="page__title h1"><h1><?= get_the_title($idPage) ?></h1></div>
			<div class="page__wrap row">
				<div class="page__sidebar">
					<div class="page__sticky">
						<div class="page__nav">
							<?php wp_nav_menu(['theme_location'  => 'sidebar']); ?>
						</div>
					</div>
				</div>
				<div class="page__section">
					<div class="page__text t1"><?= get_the_content(null, null, $idPage) ?></div>
					<link rel="stylesheet" href="<?= TEMP() ?>_/blocks/bonuses/bonuses.css?ver=1616959374871">
					<div class="page__bonuses bonuses">
						<div class="bonuses__list row">
							<?php $loop = new WP_Query( array( 'post_type' => 'bonuses', 'posts_per_page' => 0 ) ); ?> 
							<?php while ( $loop->have_posts() ) : $loop->the_post(); ?> 
							<div class="bonuses__item">
								<div class="bonuses__name h4"><?php the_title(); ?></div>
								<div class="bonuses__count"><?= the_field('bonus_cost', $bonus->ID); ?></div>
								<div class="bonuses__data">
									<ul>
										<li><?= the_field('bonus_param_1', $bonus->ID); ?></li>
										<li><?= the_field('bonus_param_2', $bonus->ID); ?></li>
									</ul>
								</div>
								<a class="bonuses__more btn --lg --bg-yellow --bb --radius" href="<?= the_permalink($bonus->ID); ?>" target="_blank"><?php esc_html_e('подробности', 'govpsfx') ?></a>
								<div class="bonuses__share share">
									<?php include 'parts/share.php' ?>
								</div>
							</div>
							<?php endwhile; ?>
							<?php wp_reset_query();?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="page__bg-7 bg"><img src="<?= TEMP() ?>_/uploads/scheme-bonuses-1.png" alt=""></div>
</div>

<?php get_footer(); ?>