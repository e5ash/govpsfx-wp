<?php
class Quotes
{
    const HOST = '46.235.34.9';
    const PORT = '443';
    const TIMEOUT = 5;
    const QUOTES = 'EURUSD';
    
    
    public function get()
    {
        $query = "QUOTES-". self::QUOTES;
        $ptr = @fsockopen(self::HOST,self::PORT,$errno,$errstr,self::TIMEOUT);
        if ($ptr) {
            if(fputs($ptr,"W$query\nQUIT\n")!=FALSE)
            while(!feof($ptr)) 
            {
               if(($line=fgets($ptr,128))=="end\r\n") break; 
               $ret .= $line;
            } 
            fclose($ptr);
        }
        $quotes = array();
        if ($ret!='!!!CAN\'T CONNECT!!!')
        {
            foreach(explode("\n",$ret) as $line)
            {		
                $q = $this->getOne($line);
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
    
    private function getOne($line)
    {
        $q = array();
        if (isset($line[0]) && ($line[0]=='u' || $line[0]=='d'))
        {
            $tmp = explode(' ',$line);					
            //$q['bid'] = $tmp[2];
            $q['bid'] = number_format($tmp[2], 3, '.', '');
            //$q['ask'] = $tmp[3]; 
            $q['ask'] = number_format($tmp[3], 3, '.', '');
            $q['arrow'] = $tmp[0];
            $q['pair'] = $tmp[1];
        }
        return $q;
    }
}
