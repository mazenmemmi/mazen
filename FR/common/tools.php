<?php


if(!function_exists('fChecktype'))
{
function fChecktype($ftype,$floc)
{
  extract($GLOBALS);

  if ($floc=="menu")
  {

/*  if ($ftype=="DOC")
    {

      $function_ret="doc.php";
    }
      else
    {
            
      $function_ret="link.php";
    } */
	switch ($ftype)
	{
		 case "DOC":  $function_ret="doc.php"; break;
		 case "Link": $function_ret="link.php";  break;
		 case "PRO": $function_ret="directdoc.php";  break;
	}

  }
    else
  {

    if ($ftype=="DOC")
    {

      $function_ret="qadoc.php";
    }
      else
    {

      $function_ret="qalink.php";
    } 

  } 

  

  return $function_ret;
} 
}
//''''''''''''''''''''''''''''''''''''''
// build menu srub
//''''''''''''''''''''''''''''''''''''''
//if(!function_exists('MakeMenuItem')){

//}
//'''''''''''''''''''''''''''''''''
// true = oui  false  = non
//'''''''''''''''''''''''''''''''''
if(!function_exists('BoolView')){
function BoolView($bool) {
  switch ($bool) {

    case true:
      $_retval="Oui";
      break;

    case false:
      $_retval="Non";
      break;
  }
  return $_retval;
}
}
//'''''''''''''''''''''''''''''''''
// user agent ( testing navigator )
//'''''''''''''''''''''''''''''''''
if(!function_exists('GetUserAgent')){
function GetUserAgent()
{
  extract($GLOBALS);

  $agent=strtolower($_SERVER["HTTP_USER_AGENT"]);

  if ((strpos($agent,"mozilla/4") ? strpos($agent,"mozilla/4")+1 : 0)!=0 && (strpos($agent,"msie") ? strpos($agent,"msie")+1 : 0)==0)
  {
    $function_ret="NS4X";
  } 
  if ((strpos($agent,"gecko") ? strpos($agent,"gecko")+1 : 0)!=0)
  {
    $function_ret="NS6X";
  } 
  if ((strpos($agent,"msie 4") ? strpos($agent,"msie 4")+1 : 0)!=0)
  {
    $function_ret="IE4X";
  } 
  if ((strpos($agent,"msie 5") ? strpos($agent,"msie 5")+1 : 0)!=0)
  {
    $function_ret="IE5X";
  } 
  if ((strpos($agent,"msie 5.5") ? strpos($agent,"msie 5.5")+1 : 0)!=0)
  {
    $function_ret="IE5.5X";
  } 
  if ((strpos($agent,"msie 6") ? strpos($agent,"msie 6")+1 : 0)!=0)
  {
    $function_ret="IE6X";
  } 

  return $function_ret;
} 

}

//''''''''''''''''''''''''''
// GET ACTUAL SCRIPT NAME
//''''''''''''''''''''''''''
if(!function_exists('ThisScript')){
function ThisScript()
{
  extract($GLOBALS);

// function to show the actual script name
  $MaxLevel=explode("/",$_SERVER["SCRIPT_NAME"]);
  $function_ret=($MaxLevel[count($MaxLevel)]);
  return $function_ret;
} 
}
//''''''''''''''''''''''''''
// view profil
//''''''''''''''''''''''''''
if(!function_exists('viewprofil')){
function viewprofil($profil)
{
  extract($GLOBALS);


  switch ($profil)
  {
    case "AD":
      $function_ret="Administrateur";
      break;
    case "AU":
      $function_ret="Auteur";
      break;
    case "VL":
      $function_ret="Validateur";
      break;
    case "GU":
      $function_ret="Invit�";

      break;
  } 
  return $function_ret;
} 
}

//''''''''''''''''''''''''''
// ADMIN MESSAGE
//''''''''''''''''''''''''''


//'''''''''''''''''''''''''''''''''''
// CRYPT/DECRYPT ROUTINES B64
//'''''''''''''''''''''''''''''''''''

//Constant used by the base64 encode/decode functions
$csBase64="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";

//Code to perform a base 64 encode

/*
function Base64_Encode($sInput) {
  $c=array();
  $w=array();
  $sInput=($sInput);
  for ($iPos=1; $iPos<=strlen($sInput); $iPos++) {
    Step(3); // WARNING: assuming Step is an external function
    $c[1]=ord(substr($sInput,$iPos-1,1));
    $c[2]=ord(substr($sInput,$iPos,1) + chr(0));
    $c[3]=ord(substr($sInput,$iPos + 1,1) + chr(0));
    $w[1]=(Int)[$c[1] / 4]; // WARNING: assuming Int is an external array
    $w[2]=($c[1] && 3) * 16 + (Int)[$c[2] / 16]; // WARNING: assuming Int is an external array
    if (strlen($sInput) >= $iPos + 1) {//******************1111111111111111
      $w[3]=($c[2] && 15) * 4 + (Int)[$c[3] / 64]; // WARNING: assuming Int is an external array
    }
    else {
      $w[3]=-1;
    }
    if (strlen($sInput) >= $iPos + 2) {
      $w[4]=$c[3] && 63;
    }
    else {
      $w[4]=-1;
    }
   // $sOutput+=MimeEncode[$w[1]] + MimeEncode[$w[2]] + MimeEncode[$w[3]] + MimeEncode[$w[4]]; // WARNING: assuming MimeEncode is an external array assuming MimeEncode is an external array assuming MimeEncode is an external array assuming MimeEncode is an external array
 $sOutput=$sOutput+MimeEncode($w[1])+MimeEncode($w[2])+MimeEncode($w[3])+MimeEncode($w[4]);

 }
  return $sOutput;
} 
*/

if(!function_exists('Base64_Encode')){
function Base64_Encode($sInput)
{
  //extract($GLOBALS);
  $c=array();
  $w=array();
  $sInput=($sInput);
  for ($iPos=1; $iPos<=strlen($sInput); $iPos++) 
  {
    Step(3); // WARNING: assuming Step is an external function
    $c[1]=ord(substr($sInput,$iPos-1,1));
    $c[2]=ord(substr($sInput,$iPos,1) + chr(0));
    $c[3]=ord(substr($sInput,$iPos + 1,1) + chr(0));
    $w[1]=Int($c[1] / 4); // WARNING: assuming Int is an external array
    $w[2]=($c[1] && 3) * 16 + Int($c[2] / 16); // WARNING: assuming Int is an external array
    if (strlen($sInput) >= $iPos + 1) 
	{
      $w[3]=($c[2] && 15) * 4 + Int($c[3] / 64); // WARNING: assuming Int is an external array
    }
    else
	{
      $w[3]=-1;
    }
    if (strlen($sInput) >= $iPos + 2) 
	{
      $w[4]=$c[3] && 63;
    }
    else 
	{
      $w[4]=-1;
    }
	$sOutput=$sOutput+MimeEncode($w[1])+MimeEncode($w[2])+MimeEncode($w[3])+MimeEncode($w[4]);

    //$sOutput+=MimeEncode[$w[1]] + MimeEncode[$w[2]] + MimeEncode[$w[3]] + MimeEncode[$w[4]]; // WARNING: assuming MimeEncode is an external array assuming MimeEncode is an external array assuming MimeEncode is an external array assuming MimeEncode is an external array
  }
  $function_ret=$sOutput;
  return $function_ret;
  //return $sOutput;

}
}
//Code to perform a base 64 decode
if(!function_exists('Base64_Decode')){
function Base64_Decode($sInput)
{
  extract($GLOBALS);

  $sInput=($sInput);
  for ($iPos=1; $iPos<=strlen($sInput); $iPos=$iPos+4)
  {    $w[1]=MimeDecode(substr($sInput,$iPos-1,1));
       $w[2]=MimeDecode(substr($sInput,$iPos+1-1,1));
       $w[3]=MimeDecode(substr($sInput,$iPos+2-1,1));
       $w[4]=MimeDecode(substr($sInput,$iPos+3-1,1));
    if($w[2]>=0)
    {

      $sOutput=$sOutput+chr((($w[1]*4+intval($w[2]/16)) & 255));
    } 

    if ($w[3]>=0)
    {

      $sOutput=$sOutput+chr((($w[2]*16+intval($w[3]/4)) & 255));
    } 

    if ($w[4]>=0)
    {

      $sOutput=$sOutput+chr((($w[3]*64+$w[4]) & 255));
    } 


  }

  $function_ret=$sOutput;
  return $function_ret;
} 
}
//Code to perform a MIME encode
if(!function_exists('MimeEncode')){
function MimeEncode($iInput)
{
  extract($GLOBALS);

  $iInput=intval($iInput);
  if ($iInput>=0)
  {

    $function_ret=substr($csBase64,$iInput+1-1,1);
  }
    else
  {

    $function_ret="";
  } 

  return $function_ret;
} 
}
//Code to perform a MIME decode
if(!function_exists('MimeDecode')){
function MimeDecode($sInput)
{
  extract($GLOBALS);

  $sInput=($sInput);
  if (strlen($sInput)==0)
  {

    $function_ret=-1;
  }
    else
  {

    $function_ret=(strpos($csBase64,$sInput) ? strpos($csBase64,$sInput)+1 : 0)-1;
  } 

  return $function_ret;
} 
}
//''''''''''''''''''''''''''''''''
// file management function
//'''''''''''''''''''''''''''''''''
//$re=new regexp();
// Formats given size in bytes,KB,MB and GB
if(!function_exists('FormatSize')){
function FormatSize($givenSize)
{
  extract($GLOBALS);

  if (($givenSize<1024))
  {

    $function_ret=$givenSize." o";
  }
    else
  if (($givenSize<1024*1024))
  {

    $function_ret=number_format($givenSize/1024,2)." Ko";
  }
    else
  if (($givenSize<1024*1024*1024))
  {

    $function_ret=number_format($givenSize/(1024*1024),2)." Mo";
  }
    else
  {

    $function_ret=number_format($givenSize/(1024*1024*1024),2)." Go";
  } 

  return $function_ret;
} 
}
// Adds given type of the slash to the end of the path if required
if(!function_exists('FixPath')){
function FixPath($path,$slash)
{
  extract($GLOBALS);

  if (substr($path,strlen($path)-(1))!=$slash)
  {

    $function_ret=$path.$slash;
  }
    else
  {

    $function_ret=$path;
  } 

  return $function_ret;
} 
}
// Converts the given path to physical path
if(!function_exists('RealizePath')){
function RealizePath($path)
{
  extract($GLOBALS);

  $fpath=str_replace("/","\\",$path);
  if (substr($fpath,0,1)=="\\")
  {
//Virtual path

    $function_ret=$DOCUMENT_ROOT.$fpath;
    if (0 /* not sure how to convert err.Number */ !=0)
    {
      $function_ret=$fpath; //Possibly network path
    } 
  }
    else
  {
//Physical Path
    $function_ret=$fpath;
  } 

  $function_ret=FixPath($RealizePath,"\\");
  return $function_ret;
} 
}
// Converts the given path to virtual path
if(!function_exists('VirtualPath')){
function VirtualPath($path)
{
  extract($GLOBALS);

  $webRoot=FixPath("../images"."/","\\");
  $fpath=FixPath($path,"\\");
  $function_ret="";
  if (substr($wexRoot,0,1)=="/")
  {

    $function_ret=FixPath($wexRoot,"/");
    $function_ret=$VirtualPath.substr($fpath,strlen($fpath)-(strlen($fpath)-strlen($wexRootPath)));
    $function_ret=str_replace("\\","/",$VirtualPath);
    $function_ret=FixPath($VirtualPath,"/");
  }
    else
  if (substr(strtolower($fpath),0,strlen($webRoot))==strtolower($webRoot))
  {

    $function_ret="/".substr($fpath,strlen($fpath)-(strlen($fpath)-strlen($webRoot)));
    $function_ret=str_replace("\\","/",$VirtualPath);
    $function_ret=FixPath($VirtualPath,"/");
  } 

  return $function_ret;
} 
}
// Checks against relative path syntax (. or .. injection)
if(!function_exists('SecurePath')){
function SecurePath($path)
{
  extract($GLOBALS);

  $fpath=str_replace("/","\\",$path);

  if ($fpath==".")
  {
    $fpath=".\\";
  } 

  $re["IgnoreCase"]=false;
  $re["Pattern"]="^\\.\\.$|^\\.\\.\\\\|\\\\\\.\\.\\\\|\\\\\\.\\.$";
  $re["Pattern"]=$re["Pattern"]."|^\\.\\\\|\\\\\\.\\\\|\\\\\\.$";

  //if ($re["Test"]==($fpath))  probleme de variabel $re
  //{
    $function_ret=true;
  //}
   // else
 // {
   // $function_ret=true;
  //} 
  return $function_ret;
}
}
//Maps the given path according to the root path
if(!function_exists('WexMapPath')){
function WexMapPath($path) {
  if (SecurePath($path)) {
    $_retval=FixPath($_SERVER["SCRIPT_NAME"].$path, "\\"); 
  }
  else {
    Error("Security Error", "Relative path syntax is forbidden for security reasons.", false);
  }
  return $_retval;
}
}
// Makes sure that given file name does not contain path info
if(!function_exists('SecureFileName')){
function SecureFileName($name)
{
  extract($GLOBALS);

  $function_ret=str_replace("/","?",$name);
  $function_ret=str_replace("\\","?",$SecureFileName);
  return $function_ret;
} 
}

//  FilterExtension Name of the file by hamma
if(!function_exists('FilterExtension')){
function FilterExtension($ext)
{

  extract($GLOBALS);

  $extarray=explode(";",$AllowedExt);
  $imagearray=explode(";",$ExtImage);
  $bBreak=false;
  for ($i=0; $i<=count($extarray); $i=$i+1)
  {
	  $minp=strtolower($extarray[$i]);
	  $mind=strtolower($ext);
	
    if (strcmp($minp,$mind)==0)
    {
      $bBreak=true;
      $function_ret=$imagearray[$i];
	  break;

    } 


  }

  if ($bBreak==false)
  {
    $function_ret=-1;
  } 
  return $function_ret;
} 
}





if(!function_exists('isflash')){
function isflash($prmsrc)
{
  extract($GLOBALS);

  $flashFileExt=strtolower(substr($prmsrc,strlen($prmsrc)-(3)));
  if ($flashFileExt=="swf")
  {
    $function_ret=true;
  }
    else
  {
    $function_ret=false;
  } 
  return $function_ret;
} 
}
/*****/
function DirSize($path , $recursive=TRUE){ 
$result = 0; 
if(!is_dir($path) || !is_readable($path)) 
return 0; 
$fd = dir($path); 
while($file = $fd->read()){ 
if(($file != ".") && ($file != "..")){ 
if(@is_dir("$path$file/")) 
$result += $recursive?DirSize("$path$file/"):0; 
else 
$result += filesize("$path$file"); 
} 
} 
$fd->close(); 
return $result; 
}  

function count_files($dirn)

 {

 		$num = 0;

 
 		$dir_handle = opendir($dirn);

 			while($entry = readdir($dir_handle))

		 		if(is_file($dirn.$entry))

 							$num++;

 		closedir($dir_handle);

 
 		return $num;

 } 
function count_doss($dirn)
 {

 		$num = 0;

 
 		$dir_handle = opendir($dirn);

 			while($entry = readdir($dir_handle))

		 		if(is_dir($dirn.$entry))

 							$num++;

 		closedir($dir_handle);

 
 		return $num;

 }


function MENUVERN1($var)
 {$mydbobj =new mysqli("localhost", "dcstecgr_artcomu", "artcom2015artcom","dcstecgr_webdbfr");

   if ($mydbobj -> connect_errno) {
     echo "Failed to connect to MySQL: " . $mydbobj -> connect_error;
     exit();
   }
   mysqli_select_db($mydbobj,'dcstecgr_webdbfr');
	$sql="SELECT * FROM m_categorie where catID=".$var.";"; 
	 $ds=mysqli_query($mydbobj,$sql);
	  $dse=mysqli_fetch_array($ds);
	 return $dse["catlibelle"];
 }
  function MENUVERN2($var)
 {
   $mydbobj =new mysqli("localhost", "dcstecgr_artcomu", "artcom2015artcom","dcstecgr_webdbfr");

   if ($mydbobj -> connect_errno) {
     echo "Failed to connect to MySQL: " . $mydbobj -> connect_error;
     exit();
   }
   mysqli_select_db($mydbobj,'dcstecgr_webdbfr');
	$sql="SELECT * FROM m_rubrique where rubID=".$var.";"; 
	 $ds=mysqli_query($mydbobj,$sql);
	  $dse=mysqli_fetch_array($ds);
	 return $dse["rublibelle"];
 }
   function MENUVERN3($var)
 {$mydbobj =new mysqli("localhost", "dcstecgr_artcomu", "artcom2015artcom","dcstecgr_webdbfr");

   if ($mydbobj -> connect_errno) {
     echo "Failed to connect to MySQL: " . $mydbobj -> connect_error;
     exit();
   }
   mysqli_select_db($mydbobj,'dcstecgr_webdbfr');
	 if ($var!=NULL)
	 {
	$sql="SELECT * FROM m_sousrubrique where srubID=".$var.";"; 
	 $ds=mysqli_query($mydbobj,$sql);
	  $dse=mysqli_fetch_array($ds);
	 return $dse["srubLibelle"];
	 }
	 
		 	 $dse=NULL;
 }
  function MENUVERN4($vart)
 {$mydbobj =new mysqli("localhost", "dcstecgr_artcomu", "artcom2015artcom","dcstecgr_webdbfr");

   if ($mydbobj -> connect_errno) {
     echo "Failed to connect to MySQL: " . $mydbobj -> connect_error;
     exit();
   }
   mysqli_select_db($mydbobj,'dcstecgr_webdbfr');
	 if ($vart!=NULL)
	 {
	$sql="SELECT * FROM documents where docID=".$vart.";"; 
	 $ds=mysqli_query($mydbobj,$sql);
	  $dse=mysqli_fetch_array($ds);
	 return $dse["doctitle"];	
	 }
	 
	 $dse=NULL;
 }
?> 
