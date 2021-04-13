<?php
include 'FileBuffer.php';

function getQuotes()
{
	$content = file_get_contents('https://wforex.ru/ajaxoutput/quotes');	
	var_dump($content);
	die();
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
        $bid = number_format($quotes['GBPUSD']['bid'], 4, '.', '');    
        $ask = number_format($quotes['GBPUSD']['ask'], 4, '.', '');
        $direction = $quotes['GBPUSD']['DIRECTION'];   
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