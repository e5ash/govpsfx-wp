<?php
class QuotesGbpUsd
{  
    public function get()
    {
        $content = file_get_contents('https://wforex.ru/ajaxoutput/quotes');	
        $content = json_decode($content, true);
        $quotes = array();
        foreach ($content as $c) {
           $quotes[$c['symbol']] = $c;
        } 
        $bid = $quotes['GBPUSD']['bid'];	
        return number_format($bid, 4, '.', '');
    }
}
