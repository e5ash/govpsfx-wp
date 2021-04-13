<?php 
/*
Template Name: Контакты
*/
get_header(); ?>

<div class="page bg-wrap">
	<div class="case">
		<div class="page__head">
			<?php include 'parts/breadcrumbs.php'; ?>
		</div>
		<div class="page__body">
			<link rel="stylesheet" href="<?= TEMP() ?>_/blocks/contacts/contacts.css?ver=1617394686758">
			<div class="page__contacts contacts row">
				<div class="contacts__col --md">
					<div class="contacts__list row">
						<div class="contacts__item">
							<div class="contacts__title h4"><?php esc_html_e('Поддержка 24/7', 'govpsfx') ?></div>
							<div class="contacts__wrap t1">
								<p><a href="mailto:<?php the_field('почта_поддержки', 'option'); ?>"><?php the_field('почта_поддержки', 'option'); ?></a></p>
								<p><a href="tel:<?=phone(get_field('телефон', 'option')) ?>"><?php the_field('телефон', 'option'); ?></a></p>
								<p><a class="jivo-show" href="javascript:jivo_api.open()"><?php esc_html_e('поддержка в чате', 'govpsfx') ?> →</a></p>
							</div>
						</div>
						<div class="contacts__item">
							<div class="contacts__title h4"><?php esc_html_e('Брокерам:', 'govpsfx') ?></div>
							<div class="contacts__wrap t1">
								<p><a href="mailto:<?php the_field('почта_для_брокеров', 'option'); ?>"><?php the_field('почта_для_брокеров', 'option'); ?></a></p>
							</div>
						</div>
						<div class="contacts__item">
							<div class="contacts__title h4"><?php esc_html_e('Реклама:', 'govpsfx') ?></div>
							<div class="contacts__wrap t1">
								<p><a href="mailto:<?php the_field('почта_для_рекламы', 'option'); ?>"><?php the_field('почта_для_рекламы', 'option'); ?></a></p>
							</div>
						</div>
					</div>
				</div>
				<div class="contacts__col --sm">
					<div class="contacts__socials socials">
						<div class="socials__list row">
							<?php include 'parts/socials.php'; ?>
						</div>
					</div>
				</div>
			</div>
			<link rel="stylesheet" href="<?= TEMP() ?>_/blocks/contact-us/contact-us.css?ver=1617394686759">
			<div class="contact-us">
				<div class="contact-us__wrap">
					<div class="contact-us__text t1">
						<?php the_content(); ?>
					</div>
					<a class="contact-us__write btn --lg --b-white --radius" href="javascript:;" data-src="#modal-feedback" data-popup=""><?php esc_html_e('написать нам', 'govpsfx') ?></a>
				</div>
			</div>
		</div>
	</div>
	<div class="page__bg-8 bg"><img src="<?= TEMP() ?>_/uploads/scheme-contacts-1.png" alt=""></div>
	<div class="page__bg-9 bg"><img src="<?= TEMP() ?>_/uploads/scheme-contacts-2.png" alt=""></div>
</div>

<?php get_footer(); ?>