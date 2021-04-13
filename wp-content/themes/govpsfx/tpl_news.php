<?php 
/*
Template Name: Аналитика и новости
*/
get_header(); ?>

<script>
var ajaxurl = '<?php echo site_url() ?>/wp-admin/admin-ajax.php';
</script>

<div class="page bg-wrap">
	<div class="case">
		<div class="page__head">
			<?php include 'parts/breadcrumbs.php'; ?>
		</div>
		<div class="page__body">
			<div class="page__text --mb-md t1">
				<?php the_content(); ?>
			</div>
			<link rel="stylesheet" href="<?= TEMP() ?>_/blocks/news/news.css?ver=1617096436500">
			<div class="news tabs">
				<?php 

				$categories = get_categories(array(
					'orderby' => 'name',
					'order' => 'ASC',
					'post_type' => 'post'
				
				
				
				));

				$category_array = [];
				foreach ($categories as $category) {
					$category_array[] = $category->term_id;
				}

				?>
				<div class="news__nav tabs-links">
					<a class="news__nav-item tabs-link --current" href="#news-all"><?php esc_html_e('все', 'govpsfx') ?></a>
					<?php foreach( $categories as $category ) : ?>
					<a class="news__nav-item tabs-link" href="#news-<?= $category->term_id; ?>"><?= $category->name; ?></a>
					<?php endforeach; ?>
				</div>
				<div class="news__tabs-list">
					<div class="news__tab tabs-item" id="news-all">
						<div class="news__list row">
							<?php 
							$i = 1; 
							$loop = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => 7 ) ); 
							while ( $loop->have_posts() ) : $loop->the_post();
							if ($i == 1) {

								get_template_part('parts/news-item-lg'); 

							} else {

								get_template_part('parts/news-item-sm');

							} $i++; endwhile;?>
						</div>
						<?php if (  $loop->max_num_pages > 1 ) : ?>
						<div class="news__loader" data-query='<?php echo serialize($loop->query_vars); ?>' data-page="<?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>" data-max="<?php echo $loop->max_num_pages; ?>"><img class="loader" src="<?=TEMP().'_/uploads/loader.png'?>" alt=""></div>
						<?php endif; wp_reset_query();?>
					</div>
					<div class="news__tab tabs-item" id="news-3">
						<div class="news__list row">
							<?php 
							$i = 1; 
							$loop = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => 7, 'tax_query' => array( array( 'taxonomy' => 'category', 'field'=> 'slug', 'terms'    => 'analitika-forex')))); 
							while ( $loop->have_posts() ) : $loop->the_post();
							if ($i == 1) {

								get_template_part('parts/news-item-lg'); 

							} else {

								get_template_part('parts/news-item-sm');

							} $i++; endwhile; ?>
						</div>
						<?php if (  $loop->max_num_pages > 1 ) : ?>
						<div class="news__loader" data-query='<?php echo serialize($loop->query_vars); ?>' data-page="<?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>" data-max="<?php echo $loop->max_num_pages; ?>"><img class="loader" src="<?=TEMP().'_/uploads/loader.png'?>" alt=""></div>
						<?php endif; wp_reset_query();?>
					</div>
					<div class="news__tab tabs-item" id="news-2">
						<div class="news__list row">
							<?php 
							$i = 1; 
							$loop = new WP_Query( array( 'post_type' => 'post', 'posts_per_page' => 7, 'tax_query' => array( array( 'taxonomy' => 'category', 'field'=> 'slug', 'terms'    => 'forex-kitchen')))); 
							while ( $loop->have_posts() ) : $loop->the_post();
							if ($i == 1) {

								get_template_part('parts/news-item-lg'); 

							} else {

								get_template_part('parts/news-item-sm');

							} $i++; endwhile; ?>
						</div>
						<?php if (  $loop->max_num_pages > 1 ) : ?>
						<div class="news__loader" data-query='<?php echo serialize($loop->query_vars); ?>' data-page="<?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>" data-max="<?php echo $loop->max_num_pages; ?>"><img class="loader" src="<?=TEMP().'_/uploads/loader.png'?>" alt=""></div>
						<?php endif; wp_reset_query();?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="page__bg-23 bg"><img src="<?= TEMP() ?>_/uploads/scheme-news-1.png" alt=""></div>
	<div class="page__bg-24 bg"><img src="<?= TEMP() ?>_/uploads/scheme-news-2.png" alt=""></div>
	<div class="page__bg-25 bg"><img src="<?= TEMP() ?>_/uploads/scheme-news-3.png" alt=""></div>
</div>

<script>
	jQuery(function($){
		$('.news__loader:not(.--rotate)').click(function(){
			var btn  = $(this),
					page = btn.attr('data-page'),
					max_pages = btn.attr('data-max');

			btn.addClass('--rotate');
			var data = {
				'action': 'loadmore',
				'query': btn.attr('data-query'),
				'page' : page
			};
			$.ajax({
				url:ajaxurl,
				data:data,
				type:'POST',
				success:function(data){
					if( data ) { 
						btn.parents('.news__tab').find('.news__list').append(data);
						page++;
						btn.attr('data-page', page);
						if (page == max_pages) btn.remove();
						setTimeout(()=>{
							btn.removeClass('--rotate');	
						}, 1050)
						
					} else {
						btn.remove();
					}
				}
			});
		});
	});
</script>	

<?php get_footer(); ?>