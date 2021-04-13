<?php
require_once('mq.php');
function get_quotes()
{
    $T_QUOTES = 'USDRUR,EURUSD';
    // query quotes and parse result
    $query = "QUOTES-".$T_QUOTES;
    $qRes = MQ_Query_quotes_clct($query);
    $quotes = array();
    if ($qRes!='!!!CAN\'T CONNECT!!!')
    {
        foreach(explode("\n",$qRes) as $line)
        {
            $q = get_quotes_one($line);
            if (!empty($q)) {
                $pair = $q['pair'];
                $quotes[$pair]['bid'] = $q['bid'];
                $quotes[$pair]['ask'] = $q['ask'];
                $quotes[$pair]['arrow'] = $q['arrow'];
            }
        }
    }
    return $quotes;
}

function get_quotes_one($line)
{
    $q = array();
    if (isset($line[0]) && ($line[0]=='u' || $line[0]=='d'))
    {
        $tmp = explode(' ',$line);					
        //$q['bid'] = $tmp[2];
 	$q['bid'] = number_format($tmp[2], 5, '.', '');
        //$q['ask'] = $tmp[3]; 
	$q['ask'] = number_format($tmp[3], 5, '.', '');
        $q['arrow'] = $tmp[0];
        $q['pair'] = $tmp[1];
    }
    return $q;
}
?>