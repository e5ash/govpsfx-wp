<?php
include 'FileBuffer.php';

function getQuotes()
{
	//$content = file_get_contents('https://wforex.ru/ajaxoutput/quotes');	
	$ch = curl_init(); 
	  // GET запрос указывается в строке URL 
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	  
	curl_setopt($ch, CURLOPT_URL, 'https://wforex.ru/ajaxoutput/quotes'); 
	curl_setopt($ch, CURLOPT_HEADER, false); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30); 
	$content = curl_exec($ch); 
  	curl_close($ch);	
    	$content = json_decode($content, true);
        $quotes = array();
        foreach ($content as $c) {
           $quotes[$c['symbol']] = $c;
        }      
	return $quotes;
}

function get_quotes()
{
    $fileBuffer = new FileBuffer();
    if ($fileBuffer->hasExpiryBuffer()) {
        $quotes = getQuotes();
        $bid = number_format($quotes['EURUSD']['bid'], 4, '.', '');    
        $ask = number_format($quotes['EURUSD']['ask'], 4, '.', '');
        $direction = $quotes['EURUSD']['DIRECTION'];   
        $arrow = ($direction == 1) ? 'up' : 'down';
        $fileBuffer->recordToBuffer([
            'bid' =>   $bid,
            'ask' =>   $ask,
            'arrow' => $arrow
        ]);
    } else {
        $quotes = $fileBuffer->getFromBuffer();
        $bid = $quotes['bid'];    
        $ask = $quotes['ask'];
        $arrow = $quotes['arrow'];
    }       
    return [
        'bid'   => $bid,
        'ask'   => $ask,
        'arrow' => $arrow
    ];
}


?>