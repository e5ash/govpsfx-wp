<?php
include 'FileBuffer.php';

function getHttpPrice()
{
	$content = file_get_contents('https://api.cryptonator.com/api/ticker/btc-usd');	
    	$content = json_decode($content, true);
	$price = $content['ticker']['price'];
	return number_format($price, 2, '.', '');
}

function get_quotes()
{
    $fileBuffer = new FileBuffer();
    if ($fileBuffer->hasExpiryBuffer()) {
		$data = $fileBuffer->getFromBuffer();
		$oldPrice = $data['price'];
		$price = getHttpPrice();
		$arrow = ($price - $oldPrice > 0) ? 'up' : 'down';
		$fileBuffer->recordToBuffer([
			'price' => $price,
			'arrow' => $arrow
		]);
    } else {		
		$data = $fileBuffer->getFromBuffer();
		$price = $data['price'];
		$arrow = $data['arrow'];
    }
    return [
		'price' => $price,
		'arrow' => $arrow
	];
}


?>