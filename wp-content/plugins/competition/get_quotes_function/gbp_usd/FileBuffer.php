<?php
class FileBuffer
{
	public $fName;
	public $cacheTime = 5;
	
	public function __construct()
	{
		$dir = __DIR__;
		$this->fName = $dir . '/cache/gbp_usd';

	}
	
	public function getFromBuffer()
	{
		$data = file_get_contents($this->fName);
		return json_decode($data, true);
	}
	public function recordToBuffer($data)
	{
		$fp=fopen($this->fName,'w');
		if($fp) { fputs($fp,json_encode($data)); fclose($fp); }
	}
	
	public function hasExpiryBuffer()
	{
		return (!(file_exists($this->fName) && (time()-filemtime($this->fName))<$this->cacheTime));				
	}
}

 
 