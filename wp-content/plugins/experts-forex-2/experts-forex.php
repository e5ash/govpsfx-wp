<?php
/*
 * Plugin Name: Парсер форекс советников
 * Author URI: https://github.com/e5ash
 * Version: 1.0.0
 */

// $posts = get_posts([
// 	'post_type' => 'advisers',
// 	'posts_per_page' => 1000
// ]);

// foreach ($posts as $post) {
// 	update_field('advisers_dynamic', null, $id);
// }
function updateExpertsForex(){


	require_once 'simple_html_dom.php';


	// get code page
	function curl_get($url, $referer = 'https://google.com') {
		$ch = curl_init();
		$CURL_OPTIONS = array(
			CURLOPT_URL => $url,
			CURLOPT_HEADER => false,
			CURLOPT_USERAGENT => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.90 Safari/537.36',
			CURLOPT_REFERER => $referer,
			CURLOPT_RETURNTRANSFER => true,
		);
		curl_setopt_array($ch, $CURL_OPTIONS);
		$data = curl_exec($ch);
		curl_close($ch);

		return $data;
	}

	$intPattern = '/[^\d.-]/';

	$posts = get_posts([
		'post_type' => 'advisers',
		'posts_per_page' => 1000
	]);

	foreach ($posts as $post) {
		$id = $post->ID;

		$link = get_field('advisers_myfxbook_ссылка', $id);

		// Проверка ссылки на соответствие 
		if ($link && $link != '*' && $link != '#') {
			// Преобразование ссылки типа "//domain.ru" к ссылке с протоколом
			if (substr($link, 0, 2) == '//') {
				$link = 'https:'.$link;
			}


			$html = new simple_html_dom();
			$html->load(curl_get($link));

			// Парсинг общая доходность
			$gainTotalElement = $html->find('#infoStats .table-scrollable-borderless table', 0);
			$gainTotal;
			if ($gainTotalElement) {
				$gainTotalElement = $gainTotalElement->children(0);
				if ($gainTotalElement) {
					$gainTotalElement = $gainTotalElement->children(0);
					if ($gainTotalElement) {
						$gainTotalElement = $gainTotalElement->children(1);
						if ($gainTotalElement) {
							$gainTotalText = $gainTotalElement->innertext;
							if ($gainTotalText) {
								$gainTotal = preg_replace($intPattern, '', $gainTotalText);
								update_field('advisers_total_profit', $gainTotal, $id);
							}
						}
					}
				}
			}

			// Парсинг %
			$gainMonthlyElement = $html->find('#infoStats .table-scrollable-borderless table', 1);
			if ($gainMonthlyElement) {
				$gainMonthlyElement = $gainMonthlyElement->children(0);
				if ($gainMonthlyElement) {
					$gainMonthlyElement = $gainMonthlyElement->children(1);
					if ($gainMonthlyElement) {
						$gainMonthlyElement = $gainMonthlyElement->children(1);
						if ($gainMonthlyElement) {
							$gainMonthlyText = $gainMonthlyElement->innertext;
							if ($gainMonthlyText) {
								$gainMonthly = preg_replace($intPattern, '', $gainMonthlyText);
								update_field('advisers_total_profit_percent', $gainMonthly, $id);
							}
						}
					}
				}
			}
			
			// Работа с динамикой
			if ($gainTotal) {
				$dynamic = get_field('advisers_dynamic', $id);
				if ($dynamic) {
					$openPrice = explode(', ', $dynamic);
					if (count($openPrice) > 29) {
						unset($openPrice[0]);	
					}
					array_push($openPrice, $gainTotal);
				} else {
					$openPrice = array();
					$openPrice[0] = $gainTotal;
				}
				update_field('advisers_dynamic', implode(', ', $openPrice), $id);
			}

			$html->clear();
			unset($html);
		}
		

	}

}

add_action('update_experts_forex_hook', 'updateExpertsForex');
wp_schedule_event('2021-03-26 04:30:00', 'daily', 'update_experts_forex_hook');