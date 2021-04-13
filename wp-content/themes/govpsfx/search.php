<?php get_header();

	switch($post_type) :
		case 'glossary':
			get_template_part('search', 'glossary');
			break;
		default:
			get_template_part('search', 'all');
	endswitch;

get_footer();