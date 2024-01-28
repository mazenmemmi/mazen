<!------------------------------------------------------------------->
<!--- Written by SGHAIER MAHMOUD							      --->
<!--- Server Side Directory Browser v 1.0 for Dream Edit 1.0      --->	
<!--- Features : File selecting and file filtering                --->
<!------------------- http://www.icare.com.tn.com ------------------->
<HTML>
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta http-equiv="Content-Language" content="fr">
<STYLE TYPE="text/css">
 BODY   {font-family: Tahoma; font-size:11; background:menu ; margin:0}
 TD     {font-family : Tahoma; font-size:11; }
 TD.Title
 {
	background-color: menu; 
	border-bottom: buttonshadow solid 1px; 
	border-left: buttonhighlight solid 1px; 
	border-right: buttonshadow solid 1px; 
	border-top:  buttonhighlight solid 1px;
	height: 20px;
 }
A:link
 {
    COLOR: #000000;
    TEXT-DECORATION: none
 }
A:visited
 {
    COLOR: #000000;
    TEXT-DECORATION: none
 }
A:active
 {
    COLOR: #000000;
    TEXT-DECORATION: none
 }
A:hover
 {
    TEXT-DECORATION: underline;
 }

</STYLE>
<SCRIPT LANGUAGE=JavaScript>
//
function IsDigit()
{
  return ((event.keyCode >= 48) && (event.keyCode <= 57))
}
function getfile(FileName,FileVPath)
{

//
var parentwindow = window.parent;
BaseURL = parentwindow.document.all.baseurl.value;
parentwindow.document.all.ImageSrc.value = BaseURL+FileVPath+FileName;
parentwindow.document.all.PreviewFrame.src = BaseURL+FileVPath+FileName;
// the preview document
}
</SCRIPT>

</HEAD>
<?php
$BrowsingWebRoot=${"imagevpath"};

$AllowedExt=".jpg;.jpeg;.gif;.png";
// respective icon image
$ExtImage="icons/jpgicon.gif;icons/jpgicon.gif;icons/gificon.gif;icons/pngicon.gif";

$PPath=$DOCUMENT_ROOT.$BrowsingWebRoot;

// $FSO is of type "Scripting.FileSystemObject"

if (!is_object($FSO))
{

  echo "ERROR : Object cannot be created";
  exit();

} 


print "<body>";

//--------------------------------------------------------
// switch on action value
//--------------------------------------------------------
switch (${"Action"})
{
  case "":
    BrowseDirectory($PPath);
    break;
  case "openfolder":
    BrowseDirectory($_GET["myfolder"]);
    break;
} 

//-------------------------------------------------------
// Functions
//-------------------------------------------------------
// Formats given size in octets,Ko,Mo and Go
function FormatSize($givenSize)
{
  extract($GLOBALS);

  if (($givenSize<1024))
  {

    $function_ret=$givenSize." Octets";
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

// Adds given type of the slash to the end of the path if required
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


// Converts the given path to virtual path
function ConvertToVirtualPath($path)
{
  extract($GLOBALS);

  $webRoot=FixPath($PPath,"\\");
  $fpath=FixPath($path,"\\");
  $function_ret="";
  $function_ret=FixPath($BrowsingWebRoot,"/");
  $function_ret=$ConvertToVirtualPath.substr($fpath,strlen($fpath)-(strlen($fpath)-strlen($webRoot)));
  $function_ret=str_replace("\\","/",$ConvertToVirtualPath);
  $function_ret=FixPath($ConvertToVirtualPath,"/");
  return $function_ret;
} 

//  FilterExtension Name of the file 
function FilterExtension($ext)
{
  extract($GLOBALS);

  $extarray=explode(";",$AllowedExt);
  $imagearray=explode(";",$ExtImage);
  $bBreak=false;
  for ($i=0; $i<=count($extarray); $i=$i+1)
  {
    if (strcmp(strtolower($extarray[$i]),strtolower(".".$ext))==0)
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
//--------------------------------------------------------
// Browsing Function
//--------------------------------------------------------
function BrowseDirectory($FolderToBrowse)
{
  extract($GLOBALS);

  // $FSO is of type "Scripting.FileSystemObject"
// if subfolder (path) is given browse it else browse the default directory

  $FO=$FolderToBrowse;// folderobject 
  $FLO=glob($FO);// fileo object
  $SFO=glob($FO,GLOB_ONLYDIR);// subfolders objet

?>
<table border="0" width="100%" cellspacing="0" cellpadding="0">

<tr>
  <td colspan=3 width=100% class=title> <b>Chemin :&nbsp; </b> <?php   echo ConvertToVirtualPath($FolderToBrowse);?> </td>
</tr>

<tr>
   <td align = right colspan=3 width=280 height=20 class=title> 
   <?php   if (!(strcmp(strtolower($FolderToBrowse),strtolower($PPath))==0))
  {
?>
   <a href="browser.php?imagevpath=<?php     echo $BrowsingWebRoot;?>&action=openfolder&myfolder=<?php     echo GetParentFolderName($FolderToBrowse) /* don't know how to convert this filesystem method */ ;?>"><img border="0" src="icons/parentfolder.gif"> </a>
   <?php   } ?>
   </td>
</tr>

<tr>
   <td width=75% class=Title><b>Nom </b></td>
   <td width=25% class=Title > <b>Taille</b> </td>
</tr>
<?php 
  foreach ($SFO as $folder)
  {
?>
      <tr>
      <td width=75%> <a href="browser.php?imagevpath=<?php     echo $BrowsingWebRoot;?>&action=openfolder&myfolder=<?php     echo path() /* don't know how to convert this filesystem method */ ;?>"><img border="0" src=icons/folder.gif> <?php     echo $folder;?></a> </td>
      <td width=25%> &nbsp </td>
      </tr>
      <?php 
  }

  $filecounter=0;
  foreach ($FLO as $file)
  {
    $FileExtensionImage=FilterExtension(GetExtensionName(path() /* don't know how to convert this filesystem method */ ) /* don't know how to convert this filesystem method */ );
    if ($FileExtensionImage!=-1)
    {

      $filecounter=$filecounter+1;
?>
      <tr>
      <td width=75%><a href="javascript:getfile('<?php  echo $file;?>','<?php  echo ConvertToVirtualPath($FolderToBrowse);?>')"><img border="0" src="<?php       echo $FileExtensionImage;?>"><?php       echo $file;?></a></td>
      <td width=70%> <?php echo FormatSize(filesize($file));?> </td>
      </tr>
      <?php     } 

  }
  $TotalObjects=count(+$filecounter)  ;
?>
    <tr >
    <td colspan=3 width=300 class=title> <?php   echo $TotalObjects." Objet(s)";?> </td>
   </tr>
   <?php 
// kill object
  $FSO=null;

  $FO=null;

  $FLO=null;

  $SFO=null;

} 
?>

</table>
</body>
</HTML>

