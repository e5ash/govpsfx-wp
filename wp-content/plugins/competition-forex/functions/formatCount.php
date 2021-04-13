<?php

function formatCount($count)
{
    $n = 5;
    //$count = '200';
    $countNumber = strlen($count);
    $digits = array();
    $k = $countNumber-1;
    for ($i = 1; $i <= $n; $i++) {
        if ($k >= 0) {
            $digits[$i] = $count[$k];	     
            $k--;
        } else {
            $digits[$i] = 0;
        }
    }
    return $digits;
}
