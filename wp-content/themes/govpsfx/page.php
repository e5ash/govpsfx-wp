<?php
/**
 * The template for displaying all questions
 *
 * This is the template that displays all questions by default.
 * Please note that this is the WordPress construct of questions
 * and that other 'questions' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package govpsfx
 */

get_header();
?>

<div class="page bg-wrap">
	<div class="case">
		<div class="page__head">
			<?php include 'parts/breadcrumbs.php'; ?>
		</div>
		<div class="page__body --sm">
			<div class="page__text --mb-md t1">
				<link rel="stylesheet" href="<?= TEMP() ?>_/blocks/get-bonus/get-bonus.css?ver=1616959373836">
				<link rel="stylesheet" href="<?= TEMP() ?>_/blocks/get-free/get-free.css?ver=1616959373836">
				<?php 

				the_post(); the_content(); 
				include 'parts/sublinks.php';

				if( have_rows('видеозаписи') ){ ?>
					<link rel="stylesheet" href="<?= TEMP() ?>_/blocks/videos/videos.css?ver=1617004813167">
					<div class="videos">
					<div class="case">
					<div class="videos__list grid">
					<? while ( have_rows('видеозаписи') ) : the_row(); 
						if( get_row_layout() == 'блок' ){ ?>
							<div class="videos__item"><?php the_sub_field('код_iframe'); ?></div>
						<? } 
					endwhile; ?>
					</div>
					</div></div>
				<? } ?>
			</div>
		</div>
	</div>
	<div class="page__bg-30 bg"><img src="<?= TEMP() ?>_/uploads/scheme-page-2.png" alt=""></div>
</div>

	

<?php
get_footer();
