<?php	
	//+------------------------------------------------------------------+
//|                                      MetaTrader API Web-services |
//|                                       quotes.php - version 1.0.1 |
//|                 Copyright © 1999-2008, MetaQuotes Software Corp. |
//|                                        http://www.metaquotes.net |
//+------------------------------------------------------------------+

define('T_HOST_clct_quotes','46.235.34.9');  // MetaTrader Server Address
define('T_PORT_clct_quotes',443);                   // MetaTrader Server Port
define('T_TIMEOUT_clct_quotes',5);                  // MetaTrader Server Connection Timeout, in sec

define('T_CACHEDIR_clct_quotes',dirname('wp-content/plugins/'.plugin_basename(__FILE__)).'/cache/'); 

define('T_CACHETIME_clct_quotes',5);               // cache expiration time, in sec

define('T_CLEAR_DELNUMBER_clct_quotes',15);        // limit of deleted files, after which process of cache clearing should be stopped

$MQ_CLEAR_STARTTIME = 0; // time
$MQ_CLEAR_NUMBER = 0;    // deleted files counter

//+------------------------------------------------------------------+
//| Cached Request to MetaTrader Server (web-services API)           |
//+------------------------------------------------------------------+
function MQ_Query_quotes_clct($query,$cacheDir=T_CACHEDIR_clct_quotes,$cacheTime=T_CACHETIME_clct_quotes,$cacheDirPrefix='')
  {
   $ret = '';
   $fName = $cacheDir.$cacheDirPrefix.crc32($query); // cache file name

//--- Is there a cache? Has its time not expired yet?
   if(file_exists($fName) && (time()-filemtime($fName))<$cacheTime) 
     {
      $ret = file_get_contents($fName);
     }
   else
     {
      $ptr=@fsockopen(T_HOST_clct_quotes,T_PORT_clct_quotes,$errno,$errstr,T_TIMEOUT_clct_quotes); 
      if($ptr)
        {
//--- If having connected, request and collect the result
         if(fputs($ptr,"W$query\nQUIT\n")!=FALSE)
           while(!feof($ptr)) 
             {
              if(($line=fgets($ptr,128))=="end\r\n") break; 
              $ret .= $line;
             } 
         fclose($ptr);
         if ($cacheTime>0)
           {
//--- If there is a prefix (login, for example), create a nonpresent directory for storing the cache
            if ($cacheDirPrefix!='' && !file_exists($cacheDir.$cacheDirPrefix))
              {
               foreach(explode('/',$cacheDirPrefix) as $tmp)
                 {
                  if ($tmp=='' || $tmp[0]=='.') continue;
                  $cacheDir .= $tmp.'/';
                  if (!file_exists($cacheDir)) @mkdir($cacheDir);
                 }
              }
//--- save result into cache
            $fp=@fopen($fName,'w');
            if($fp) { fputs($fp,$ret); fclose($fp); }
           }
        }
      else
        {
//--- if connection fails, show the old cache (if there is one) or return with the error 
          if(file_exists($fName))
            {
             touch($fName);
             $ret = file_get_contents($fName);
            }
          else
            {
             $ret = '!!!CAN\'T CONNECT!!!';
            }
        }
     }
//--- clear cache every 3 sec (for such frequency of calls)
   if(!file_exists(T_CACHEDIR_clct_quotes.'.clearCache') || (time()-filemtime(T_CACHEDIR_clct_quotes.'.clearCache'))>=3)
     {
      ignore_user_abort(true);
      touch(T_CACHEDIR_clct_quotes.'.clearCache');

      global $MQ_CLEAR_STARTTIME;
      $MQ_CLEAR_STARTTIME = time();
      MQ_ClearCache_quotes_clct(realpath(T_CACHEDIR_clct_quotes));

      ignore_user_abort(false);
     }
   return $ret;
  }

//+------------------------------------------------------------------+
//| Clear cache                                                      |
//+------------------------------------------------------------------+
function MQ_ClearCache_quotes_clct($dirName)
  {
   if(empty($dirName) || ($list=glob($dirName.'/*'))===false || empty($list)) return;
//---
   global $MQ_CLEAR_NUMBER,$MQ_CLEAR_STARTTIME;
   $size = sizeof($list);
   foreach($list as $fileName)
     {
      $baseName = basename($fileName);
      if ($baseName[0]=='.') continue;
      if (is_dir($fileName))
        {
//--- go through all cache directories recursively
         MQ_ClearCache__quotes_clct($fileName);
         if ($MQ_CLEAR_NUMBER>=T_CLEAR_DELNUMBER_clct_quotes) return; // by recursion check condition for function exit 
        }
      elseif(($MQ_CLEAR_STARTTIME-filemtime($fileName))>T_CACHETIME_clct_quotes)
        {
//--- if the file time is expired, delete it and, if the limit of deleted files has been exceeded, exit
         @unlink($fileName);
         if (++$MQ_CLEAR_NUMBER>=T_CLEAR_DELNUMBER_clct_quotes) return;
         --$size;
        }
     }
//--- delete empty directory
   $tmp = realpath(T_CACHEDIR_clct_quotes);
   if (!empty($tmp) && $size<=0 && strlen($dirName)>strlen($tmp) && $dirName!=$tmp) @rmdir($dirName);
  }