<?php if( have_rows('соц_сети', 'option') ){ while ( have_rows('соц_сети', 'option') ) : the_row(); if( get_row_layout() == 'блок' ){ ?>
<a class="socials__item" href="<?php the_sub_field('ссылка'); ?>" target="_blank">
	<div class="socials__icon"><?php the_sub_field('svg'); ?></div>
	<div class="socials__name"><?php the_sub_field('название'); ?></div>
</a>
<?php } endwhile; }?>