<?php
	get_header();

	include 'parts/intro.php';
	include 'parts/server.php';
	include 'parts/how.php';

	if (!isPSI()) :
		
		include 'parts/ping.php';
		include 'parts/price.php';
		include 'parts/return.php';
		include 'parts/combo.php';
		include 'parts/reviews.php';
		include 'parts/popular.php';
		include 'parts/we.php';
		include 'parts/rate.php';

	endif;

	get_footer();
?>