<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package govpsfx
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php if (!isPSI()) : ?>
	<?php wp_head(); ?>
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-N888T4Z');</script>
	<!-- End Google Tag Manager -->
	<?php endif; ?>
</head>

<body>
<?php wp_body_open(); ?>
<div class="wrap <?php if (is_front_page()) echo '--main' ?>">
	<link rel="stylesheet" href="<?= get_template_directory_uri(); ?>/style.css">
	<link rel="stylesheet" href="<?= TEMP() ?>_/sys/css/style.css?ver=1616599710164">
	<script src="<?= TEMP() ?>_/sys/js/common.js?ver=1616599710164"></script>
	<link rel="stylesheet" href="<?= TEMP() ?>_/blocks/header/header.css?ver=1616599710164"/>
	<header class="header">
		<div class="header__panel panel">
			<div class="case">
				<div class="panel__wrap row">
					<?php if (is_front_page()) { ?>
					<div class="panel__logo logo --lg"><?php $image = get_field('логотип', 'option'); if( !empty($image) ): ?><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" /><?php endif; ?></div>
					<?php } else { ?>
					<a class="panel__logo logo --lg" href="<?= get_home_url() ?>"><?php $image = get_field('логотип', 'option'); if( !empty($image) ): ?><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" /><?php endif; ?></a>
					<?php } ?>
					<div class="panel__contact p-contact">
						<div class="p-contact__title c-gray"><?php esc_html_e('Поддержка 24/7', 'govpsfx') ?></div>
						<div class="p-contact__list row">
							<div class="p-contact__item"><a href="mailto:<?php the_field('почта_поддержки', 'option'); ?>"><?php the_field('почта_поддержки', 'option'); ?></a> </div>
							<div class="p-contact__item"><a href="tel:<?=phone(get_field('телефон', 'option')) ?>">+7 (812) 425-38-90</a></div>
						</div>
					</div>
					<div class="panel__links links --line">
						<?php wp_nav_menu(['theme_location'  => 'auth']); ?>
					</div>
					<a class="panel__lang btn --b-white --radius" href="<?= langLink() ?>"><?php the_field('lang_locale', 'option'); ?></a>
					<div class="panel__search btn toggle-search --h-icon-yellow">
						<svg width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M10.7989 20.2395C13.1012 20.2395 15.1943 19.4233 16.8268 18.0419L24.1524 25.3674C24.3198 25.5349 24.5291 25.6186 24.7594 25.6186C24.9896 25.6186 25.1989 25.5349 25.3664 25.3674C25.7012 25.0326 25.7012 24.4884 25.3664 24.1535L18.0408 16.8279C19.4012 15.1954 20.2384 13.0814 20.2384 10.8C20.2384 5.58838 16.0105 1.36047 10.7989 1.36047C5.60821 1.36047 1.35938 5.60931 1.35938 10.8C1.35938 16.0116 5.60821 20.2395 10.7989 20.2395ZM10.7989 3.07675C15.0687 3.07675 18.5222 6.55117 18.5222 10.8C18.5222 15.0698 15.0687 18.5233 10.7989 18.5233C6.52914 18.5233 3.07565 15.0488 3.07565 10.8C3.07565 6.55117 6.55007 3.07675 10.7989 3.07675Z" fill="white"></path>
						</svg>
					</div>
				</div>
			</div>
		</div>
		<div class="header__nav-wrap">
			<div class="case row">
				<div class="header__ham ham btn --bg-yellow toggle-nav">
					<div class="ham__icon">
						<div></div>
						<div></div>
						<div></div>
					</div>
					<div class="ham__title"><?php esc_html_e('меню', 'govpsfx') ?></div>
				</div>
				<div class="header__nav links">
					<?php wp_nav_menu(['theme_location'  => 'panel']); ?>
				</div>
			</div>
		</div>
		<nav class="header__drop nav bg-wrap">
			<div class="nav__head row">
				<div class="nav__close btn toggle-nav">
					<div class="nav__close-icon">
						<svg width="53" height="53" viewBox="0 0 53 53" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M26.5 53C41.1355 53 53 41.1355 53 26.5C53 11.8645 41.1355 0 26.5 0C11.8645 0 0 11.8645 0 26.5C0 41.1355 11.8645 53 26.5 53Z" fill="#FFB800"></path>
							<path fill-rule="evenodd" clip-rule="evenodd" d="M16.5501 34.4002C15.8166 35.1336 15.8166 36.3227 16.5501 37.0562C17.2835 37.7896 18.4726 37.7896 19.206 37.0562L26.8031 29.4591L34.4002 37.0562C35.1336 37.7896 36.3227 37.7896 37.0562 37.0562C37.7896 36.3227 37.7896 35.1336 37.0562 34.4002L29.4591 26.8031L37.0562 19.206C37.7896 18.4726 37.7896 17.2835 37.0562 16.5501C36.3227 15.8166 35.1336 15.8166 34.4002 16.5501L26.8031 24.1472L19.206 16.5501C18.4726 15.8166 17.2835 15.8166 16.5501 16.5501C15.8166 17.2835 15.8166 18.4726 16.5501 19.206L24.1472 26.8031L16.5501 34.4002Z" fill="#2A2A2A"></path>
						</svg>
					</div>
					<div class="nav__close-title"><?php esc_html_e('Закрыть', 'govpsfx') ?></div>
				</div>
				<?php if (is_front_page()) { ?>
				<div class="nav__logo"><?php $image = get_field('логотип', 'option'); if( !empty($image) ): ?><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" /><?php endif; ?></div>
				<?php } else { ?>
				<a class="nav__logo" href="<?= get_home_url() ?>"><?php $image = get_field('логотип', 'option'); if( !empty($image) ): ?><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" /><?php endif; ?></a>
				<?php } ?>
			</div>
			<div class="nav__body row">
				<div class="nav__body-col">
					<div class="nav__list links --col --mb --arrow">
						<?php wp_nav_menu(['theme_location'  => 'nav-1']); ?>
					</div>
				</div>
				<div class="nav__body-col">
					<div class="nav__title c-gray"><?php esc_html_e('Обучающие курсы', 'govpsfx') ?></div>
					<div class="nav__list links --col --mb-sm">
						<?php wp_nav_menu(['theme_location'  => 'nav-2']); ?>
					</div>
					<div class="nav__title c-gray"><?php esc_html_e('Поддержка 24/7', 'govpsfx') ?></div>
					<div class="nav__email"><a href="mailto:<?php the_field('почта_поддержки', 'option'); ?>"><?php the_field('почта_поддержки', 'option'); ?></a></div>
					<div class="nav__phone"><a href="tel:<?=phone(get_field('телефон', 'option')) ?>"><?php the_field('телефон', 'option'); ?></a></div>
					<div class="nav__title c-gray"><?php esc_html_e('Остались вопросы?', 'govpsfx') ?></div>
					<div class="nav__list links --col --mb-sm">
						<?php wp_nav_menu(['theme_location'  => 'nav-3']); ?>
					</div>
				</div>
			</div>
			<div class="nav__foot row">
				<div class="nav__foot-col">
					<div class="nav__title c-gray"><?php esc_html_e('Хотите с нами работать?', 'govpsfx') ?></div>
					<div class="nav__write link --md"><a href="javascript:;" data-src="#modal-feedback" data-popup=""><?php esc_html_e('Пишите, ждём', 'govpsfx') ?> →</a></div>
				</div>
				<div class="nav__foot-col">
					<div class="nav__title c-gray"><?php esc_html_e('Мы в соцсетях', 'govpsfx') ?></div>
					<div class="nav__socials socials">
						<div class="socials__list row">
							<?php include 'parts/socials.php'; ?>
						</div>
					</div>
				</div>
			</div>
			<div class="nav__scheme-1 bg"><img src="<?= TEMP() ?>_/uploads/scheme-1.png" alt=""></div>
			<div class="nav__scheme-2 bg"><img src="<?= TEMP() ?>_/uploads/scheme-2.png" alt=""></div>
		</nav>
		<div class="header__search search">
			<div class="case row">
				<div class="search__close btn toggle-search">
					<svg width="53" height="53" viewBox="0 0 53 53" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M26.5 53C41.1355 53 53 41.1355 53 26.5C53 11.8645 41.1355 0 26.5 0C11.8645 0 0 11.8645 0 26.5C0 41.1355 11.8645 53 26.5 53Z" fill="#FFB800"></path>
						<path fill-rule="evenodd" clip-rule="evenodd" d="M16.5501 34.4002C15.8166 35.1336 15.8166 36.3227 16.5501 37.0562C17.2835 37.7896 18.4726 37.7896 19.206 37.0562L26.8031 29.4591L34.4002 37.0562C35.1336 37.7896 36.3227 37.7896 37.0562 37.0562C37.7896 36.3227 37.7896 35.1336 37.0562 34.4002L29.4591 26.8031L37.0562 19.206C37.7896 18.4726 37.7896 17.2835 37.0562 16.5501C36.3227 15.8166 35.1336 15.8166 34.4002 16.5501L26.8031 24.1472L19.206 16.5501C18.4726 15.8166 17.2835 15.8166 16.5501 16.5501C15.8166 17.2835 15.8166 18.4726 16.5501 19.206L24.1472 26.8031L16.5501 34.4002Z" fill="#2A2A2A"></path>
					</svg>
				</div>
				<form action="<?= site_url() ?>" method="GET" class="search__wrap input input --lg --b-yellow">
					<div class="input__wrap">
						<input class="input__area" type="text" name="s" placeholder="<?php esc_html_e('Напишите что ищите', 'govpsfx') ?>">
						<div class="input__icon">
							<svg width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M10.7989 20.2395C13.1012 20.2395 15.1943 19.4233 16.8268 18.0419L24.1524 25.3674C24.3198 25.5349 24.5291 25.6186 24.7594 25.6186C24.9896 25.6186 25.1989 25.5349 25.3664 25.3674C25.7012 25.0326 25.7012 24.4884 25.3664 24.1535L18.0408 16.8279C19.4012 15.1954 20.2384 13.0814 20.2384 10.8C20.2384 5.58838 16.0105 1.36047 10.7989 1.36047C5.60821 1.36047 1.35938 5.60931 1.35938 10.8C1.35938 16.0116 5.60821 20.2395 10.7989 20.2395ZM10.7989 3.07675C15.0687 3.07675 18.5222 6.55117 18.5222 10.8C18.5222 15.0698 15.0687 18.5233 10.7989 18.5233C6.52914 18.5233 3.07565 15.0488 3.07565 10.8C3.07565 6.55117 6.55007 3.07675 10.7989 3.07675Z" fill="#ffb800"></path>
							</svg>
						</div>
					</div>
				</form>
			</div>
		</div>
	</header>
	<script src="<?= TEMP() ?>_/blocks/header/header.js?ver=1616599710164"></script>
	<main class="main">
	<?php if (!isPSI() && !is_front_page()) : ?>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" integrity="sha512-H9jrZiiopUdsLpg94A333EfumgUBpO9MdbxStdeITo+KEIMaNfHNvwyjjDJb+ERPaRS6DpyRlKbvPUasNItRyw==" crossorigin="anonymous" />
		<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
	<?php endif; ?>