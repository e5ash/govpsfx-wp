<?php
class QuotesBitcoin 
{  
	public function get()
    {
		$content = file_get_contents('https://api.cryptonator.com/api/ticker/btc-usd');	
    	$content = json_decode($content, true);
		$price = $content['ticker']['price'];
		return number_format($price, 2, '.', '');
	}
}
