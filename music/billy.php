<?php
  
/* -------INFO----------------------------------------------------------------------
 
      Flashy Billy v1.0
	  Sheep Productions (c) 2005
	  www.sheepfriends.com
	   
	  Description:
	  Flashy Billy is a small flash player for you website in order to play music.
      It reads out a server directory full of mp3 files 
      and plays them in random or normal order.

	  Instructions:
	  1. Upload mp3 files, this php file and the flash swf file in a seperate dir.
      2. Use html code to insert flash movie in webpage. See example.html
	   
	  Tip:
	  The title of a song is the filename without the extention ".mp3"
	  Use proper filenames of the mp3 files in order to get it working.
	  You could add numbers in front of the filenames to get a fixed playlist order.	

--------------CONFIG--------------------------------------------------------------*/
  
  // playmode 
  // 0 = alphabetically file list
  // 1 = shuffle file list
  $playmode = 1; 

  // force first file in shuffle
  // enter filename of the song you always wants to play first. 
  // eg. $firstfile='mysong.mp3';
  // leave blank for total shuffle eg. $firstfile='';
  $firstfile = '';
    
/* ------------CODE---------------------------------------------------------------*/ 

//start engine
go();																				 

/* -------------------------------------------------------------------------------*/

function go(){
  global $playmode,$firstfile,$PHP_SELF,$HTTP_HOST;
  
  $homedir = 'http://'.$HTTP_HOST.dirname($PHP_SELF).'/';
  $arr = geef_filenames_inmap('../'.dirname($PHP_SELF));
  
  if ($playmode==1){
	if (count($arr)>1)
	  shuffle($arr);
  
    // force first file
	if ($firstfile<>''){
	  for ($i=0;$i<count($arr);$i++){
	  	if ($arr[$i]==$firstfile){
		  $swapstr = $arr[0];
		  $arr[0] = $firstfile;
		  $arr[$i] = $swapstr;
		}
	  }
	}
  }		        
  
  print 'total='.count($arr).'&';
  for ($i=0; $i<count($arr); $i++){
    print'file'.$i.'='.$homedir.$arr[$i].'&';
    print'title'.$i.'='.substr($arr[$i],0,strlen($arr[$i])-4);
    if ($i < (count($arr)-1))
      print'&';
  }
}

/* -------------------------------------------------------------------------------*/

function geef_filenames_inmap($dir){
  $olddir=getcwd();
  if (file_exists($dir)){
    $dh = opendir($dir);
    chdir($dir);
    while ($file = readdir($dh)){
      if (($file != '.') && ($file != '..') && (!is_dir("$file"))){
        if (strstr($file,'.mp3')<>false)
	      $filearr[]=$file;
	  }
    }
    closedir($dh);
    chdir($olddir);

    if ($filearr<>'')
      sort ($filearr);
  }
  else
    p('Oops something went wrong, no such dir.');

  if ($filearr=='')
    return '';
  else
    return $filearr;
}

/* -------------------------------------------------------------------------------*/

function p($str){
  print $str."\n";
}

/* -------------------------------------------------------------------------------*/

?>