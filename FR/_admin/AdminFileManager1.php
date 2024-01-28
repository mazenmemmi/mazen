<?php
 
include ("adminsettings.php");
include ("../common/tools.php");
include ("admintemplates.php");
include ("adminsecurity.php");
admhead();?>
<!-- Win Head -->
<table border="0" width="100%" cellspacing="3" cellpadding="3">
  <tr>
    <td width="100%" valign="top">
<div align="center">
  <center>
<TABLE width=100% BORDER=0 CELLPADDING=0 CELLSPACING=0>
	<TR>
		<TD COLSPAN=2 ROWSPAN=2 align="right">
			<IMG SRC="images/wcorner1.gif" width=10 height=10 ALT=""></TD>
		<TD BGCOLOR=#1E5CA8 width="100%">
			<IMG SRC="images/spacer.gif" WIDTH=225 HEIGHT=1 ALT=""></TD>
		<TD COLSPAN=2 ROWSPAN=2>
			<IMG SRC="images/wcorner2.gif" width=10 height=10 ALT=""></TD>
	</TR>
	<TR>
		<TD BGCOLOR=#D2DEEE width="100%">
			<IMG SRC="images/spacer.gif" WIDTH=10 HEIGHT=9 ALT=""></TD>
	</TR>
	<TR>
		<TD BGCOLOR="<?php echo $tempRoundedColor;?>">
			<IMG SRC="images/spacer.gif" WIDTH=1 HEIGHT=20 ALT=""></TD>
		<TD BGCOLOR=#D2DEEE>
			<IMG SRC="images/spacer.gif" WIDTH=9 HEIGHT=29 ALT=""></TD>
		<TD BGCOLOR=#D2DEEE width="100%" valign="top">
            <table border="0" width="100%" cellspacing="1">
              <tr>
                <td width="100%">
                  <table border="0" width="100%" cellspacing="0" cellpadding="0">
                    <tr>
                     <td width="5%"><img border="0" src="images/icon_ressources.gif" width="38" height="36">
                      </td>
                      <td width="95%" valign="bottom" class="titles">
                      <font color="#1A62B0"><b>Médias >> </b></font>
                      <font color="#008000"><b>Gestion des médias</b></font></td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
         <td width="100%">
<!-- End Win Head -->    

<!-- content -->     
<?php
$encoding=InitApp();
if (isset($_post["command"]))
{
switch ($_POST["command"])
{
 case "NewFile":CreateItem();break;
 case "NewFolder":CreateItem();break;
 case "DeleteFile":DeleteItem();break;
 case "DeleteFolder":DeleteItem();break;
 case "RenameFile":RenameItem();break;
 case "RenameFolder":RenameItem();break;
 case "OpenFolder": $targetPath=WexMapPath($_POST["folder"].$_POST["parameter"]);break;
 case "LevelUp": $targetPath=WexMapPath(dirname ($_POST["folder"]));break;
} 
}
Liste();
DestroyApp($encoding);


// Initializes some variables, creates instances of some objects and ensures security
function InitApp()
{
  extract($GLOBALS);
  $scriptName=$_SERVER["SCRIPT_NAME"];
  $encoding=-2; //System default encoding
  $otoo=isset ($_POST['folder']);
  echo "ok";
 
  echo $otoo;
  $targetPath=WexMapPath($otoo);
  return $encoding;
} 
// Writes file listing of the given folder
function Liste()
{
  extract($GLOBALS);
$objFolde=opendir("../images/");
  $objFolder=readdir($objFolde);
  if ($objFolder==0)
  {
    $wexMessage="Error opening folder !";
  } 
$targetPath="../www/fr/images/";
  $virtual=VirtualPath("../www/fr/images/");
  $folder=substr($targetPath,strlen($targetPath)-strlen($targetPath));
echo $folder;
?>
<form name=formGlobal action="noaction" onSubmit="return(false);">
<table cellspacing=1 cellpadding=1 border=0 width=100% bgcolor="#a4bcdd">
	<tr>
	  <td colspan="5">
	   <table cellspacing=0 cellpadding=0 border=0 width=100% bgcolor="#c6d6e8">
		<tr>
		 <td>
			<div style="font-size:8pt;">&nbsp;<img align=absmiddle border=0 src="./images/folder_open.png">&nbsp;<span class=boldText><?   echo $objFolder;?></span></div>
			<?php   if ($folder)
  {
?>
			<div style="font-size:8pt;">&nbsp;&nbsp;<?php     echo $folder /* don't know how to convert this filesystem method */ ;?></div>
			<?php   } 
			  if ($virtual!="")
  {
?>
				<div style="font-size:8pt;">&nbsp;&nbsp;(<?php    echo $virtual;?>)</div>
			<?php   }
    else
  {
?>
				<div style="font-size:8pt;">&nbsp;&nbsp;(<a href="javascript:Command('NoWebAccess');">no web access</a>)</div>
			<?php   } ?>
		</td>
		<td>
			<span class=boldText><?   echo glob($objFolder,GLOB_ONLYDIR);?></span> Sous-répertoire(s)<br>
			<span class=boldText><?   echo glob($objFolder);?></span> Fichier(s)
		</td>
		<td>
			Taille total: <span class=boldText><?   if (0 /* not sure how to convert err.Number */ !=0 || (!$calculateTotalSize))
  {
    echo "N/A";
  }
    else
  {
    echo FormatSize(filesize($objFolder));


  } ?></span>
		</td>
		<td colspan=2 align=right>
			<a href="javascript:Command('Refresh');"><img align=absmiddle border=0 width=21 height=20 src="./images/refresh.png" alt="Actualiser la liste"></a>&nbsp;
			<a href="javascript:Command('NewFolder');"><img align=absmiddle border=0 width=21 height=20 src="./images/create_folder.png" alt="Créer un nouveau dossier"></a>&nbsp;
			<a href="javascript:Command('Upload','<?php   echo rawurlencode(str_replace("\\","\\\\",$folder));?>');"><img align=absmiddle border=0 width=21 height=20 src="./images/upload.png" alt="Uploader dans le dossier en cours"></a>&nbsp;
		<tr><td colspan=5 bgcolor=white>
		<input name=wexMessage type=text class=formClass size="120" value="<?   echo htmlspecialchars($wexMessage);?>" readonly>
		 </td></tr>
	   </table>
		</td>
	</tr>
	<tr bgColor="#c6d6e8" height="20">
		<td>&nbsp;<span class=boldText><font color="#800000">Nom</font></span></td>
		<td >&nbsp;<span class=boldText><font color="#800000">Taille</font></span></td>
		<td>&nbsp;<span class=boldText><font color="#800000">Type</font></span></td>
		<td>&nbsp;<span class=boldText><font color="#800000">Modifié le</font></span></td>
		<td>&nbsp;</td>
	</tr>
<?php
  $rowType="darkRow";

  if (strlen($targetPath)>strlen($wexRootPath))
  {

?>
	<tr class=<?php     echo $rowType;?>><td>&nbsp;<a href="javascript:Command('LevelUp');" title="Répertoire précédant"><img align=absmiddle border=0 width=15 height=13 src="./images/folder_up.png"></a>&nbsp;<a href="javascript:Command('LevelUp');" title="Up One level">..</a></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
<?php 
    $rowType="lightRow";
  } 


  $listed=0;
  
   if ((intval(glob($objFolder,GLOB_ONLYDIR))+ intval(glob($objFolder)))==0)
  {

// Do nothing when error occurs
  }
    else
  {

    foreach (glob($objFolder,GLOB_ONLYDIR) as $item)
    {
      if ($showHiddenItems || !$item->Attributes && 2)
      {

        $listed=$listed+1;
?>
	<tr class=<?php         echo $rowType;?>>
		<td>&nbsp;<?php         echo GetIcon($item,true);?>&nbsp;<a href="javascript:Command('OpenFolder',&#34;<?php echo $item;?>&#34;);" title="Open Folder"><?php echo $item;?></a></td>
		<td>&nbsp;<?php         if ($calculateFolderSize)
        {
          print FormatSize($item);
        } ?></td><td>&nbsp;<?php         echo $item;?></td>
		<td nowrap>&nbsp;<?php         echo $item.DateLastModified;?></td>
		<td nowrap>
			<a href="javascript:Command('RenameFolder', &#34;<?php         echo $item->Name;?>&#34;);"><img align=absmiddle border=0 width=11 height=14 src="./images/rename.png" alt="Renommer le dossier"></a>
			<a href="javascript:Command('DeleteFolder', &#34;<?php         echo $item->Name;?>&#34;);"><img align=absmiddle border=0 width=14 height=14 src="./images/delete.png" alt="Supprimer le dossier"></a>
		</td>
	</tr>
<?php 
        if ($rowType=="darkRow")
        {
          $rowType="lightRow";
        }
          else
        {
          $rowType="darkRow";
        } 
      } 

    }

    foreach (glob($objFolder) as $item)
    {
      if ($showHiddenItems || !$item->Attributes && 2)
      {

        $listed=$listed+1;
?>
	<tr class=<?php         echo $rowType;?>>
		<td>&nbsp;<?php         echo GetIcon($item->Name,false);?>&nbsp;<a href="<?php         echo $virtual.$item->Name;?>" target="_blank" title="visualiser le fichier"><?php        echo $item->Name;?></a></td>
		<td>&nbsp;<?php         echo FormatSize($item->Size);?></td><td>&nbsp;<?php         echo $item->Type;?></td>
		<td nowrap>&nbsp;<?php         echo $item->DateLastModified;?></td>
		<td nowrap>
			<a href="javascript:Command('RenameFile', &#34;<?php echo $item->Name;?>&#34;);"><img align=absmiddle border=0 width=11 height=14 src="./images/rename.png" alt="Renommer"></a>
			<a href="javascript:Command('DeleteFile', &#34;<?php  echo $item->Name;?>&#34;);"><img align=absmiddle border=0 width=14 height=14 src="./images/delete.png" alt="Supprimer"></a>
		</td>
	</tr>
<?php 
        if ($rowType=="darkRow")
        {
          $rowType="lightRow";
        }
          else
        {
          $rowType="darkRow";
        } 
      } 

    }
  } 

?>
	<tr></tr>
    
</table>
</form>
<form method=post action="<?php   echo $scriptName;?>" name=formBuffer>
	<input type="hidden" name="command" value="">
	<input type="hidden" name="parameter" value="">
	<input type="hidden" name="virtual" value="<?php   echo $virtual;?>">
	<input type="hidden" name="folder" value="<?php   echo $folder;?>">
	<input type="hidden" name="popup" value="false">
</form>
<?php
  if ($wexMessage=="")
  {

    if ( intval((glob($objFolder,GLOB_ONLYDIR))+intval(glob($objFolder)))!=$listed)
    {

      $wexMessage="Listed ".$listed." of ".(intval(glob($objFolder,GLOB_ONLYDIR))+intval(glob($objFolder)))." item(s) , ".(intval(glob($objFolder,GLOB_ONLYDIR))+intval(glob($objFolder))-$listed)." item(s) are hidden...";
    }
      else
    {

      $wexMessage=(intval(glob($objFolder,GLOB_ONLYDIR))+ intval(glob($objFolder)))." élement(s) dans la liste...";
    } 

    echo "<script language=\"javascript\">document.forms.formGlobal.wexMessage.value='".$wexMessage."'</script>";
  } 


  $objFolder=null;

} 

// Writes the given error message
function Error($title,$message,$popup)
{
  extract($GLOBALS);

?>
<table cellpadding=0 cellspacing=0 border=0 align=center width=300>
	<tr class=titleRow>
		<td>&nbsp;<b>An error occured</b></td>
	</tr>
	<tr class=lightRow>
		<td>
			<table cellpadding=0 cellspacing=5 border=0>
				<tr>
					<td valign=top><img width=32 height=32 border=0 align=absmiddle src="./images/error.png"></td>
					<td><b><?php   echo $title;?>:</b><br><?php   echo $message;?></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr class=titleRow align=center>
		<td>
			<?php   if ($popup)
  {
?>
			<a href="javascript:this.close();">Close</a>
			<?php   }
    else
  {
?>
			<a href="javascript:history.back();">Back</a>
			<?php   } ?>
		</td>
	</tr>
</table>
<?php 

  DestroyApp();
  return $function_ret;
} 


// Returns the icon of the file
function GetIcon($fileName,$isFolder)
{
  extract($GLOBALS);


  if ($isFolder)
  {

    $function_ret="<a href=\"javascript:Command('FolderDetails', &#34;".$fileName."&#34;);\"><img align=absmiddle border=0 width=15 height=13 src=\"./images/folder.png\" alt=\"Folder - Click to learn details\"></a>";
  }
    else
  {


    $ext=basename($fileName) /* don't know how to convert this filesystem method */ ;
    $extresult=substr(pathinfo($ext, PATHINFO_FILENAME), 1);

    if ($extresult==-1)
    {

      $function_ret="<img align=absmiddle border=0 src=\"./images/file.png\">";
    }
      else
    {

      $function_ret="<img align=absmiddle border=0 src=\"dreamedit/".$extresult."\">";
    } 

  } 

 return $function_ret;
} 



// Creates a folder or a file
function CreateItem()
{
  extract($GLOBALS);

  $itemType=$_POST["command"];
  $itemName=SecureFileName($_POST["parameter"]);
  $itemPath=$targetPath.$itemName;



  switch ($itemType)
  {
    case "NewFolder":
      if (file_exists($itemPath)==false && file_exists($itemPath)==false)
      {

        $res1=mkdir($itemPath,0777);
        if ($res1==0)
        {

          $wexMessage="Impossible de créer le dossier \"".$itemName."\", une erreur est survenue ...";
        }
          else
        {

          $wexMessage="Dossier créé \"".$itemName."\"...";
        } 

      }
        else
      {

        $wexMessage="Impossible de créer le dossier \"".$itemName."\", un fichier ou dossier portant ce nom existe déjà ...";
      } 

      break;
    case "NewFile":
      if (file_exists($itemPath)==false && file_exists($itemPath)==false)
      {

        $res2=fopen($itemPath, "w");
        if ($res2==0)
        {

          $wexMessage="Unable to create the file \"".$itemName."\", une erreur est survenue ...";
        }
          else
        {

          $wexMessage="Created the file \"".$itemName."\"...";
        } 

      }
        else
      {

        $wexMessage="Unable to create the file \"".$itemName."\", there exists a file or a folder with the same name...";
      } 

      break;
  } 
  return $function_ret;
} 

// Deletes a folder or a file
function DeleteItem()
{
  extract($GLOBALS);

  $itemType=$_POST["command"];
  $itemName=SecureFileName($_POST["parameter"]);
  $itemPath=$targetPath.$itemName;



  switch ($itemType)
  {
    case "DeleteFolder":
      $res3=rmdir($itemPath,true); /* don't know how to convert this filesystem method */ 
      if ($res3==0)
      {

        $wexMessage="Impossible de supprimer le dossier \"".$itemName."\", une erreur est survenue ...";
      }
        else
      {

        $wexMessage="Dossier \"".$itemName."\" supprimé...";
      } 

      break;
    case "DeleteFile":
      $res4=unlink($itemPath);
      if ($res4==0)
      {

        $wexMessage="Impossible de supprimer le fichier \"".$itemName."\", une erreur est survenue ...";
      }
        else
      {

        $wexMessage="Fichier  \"".$itemName."\"supprimé...";
      } 

      break;
  } 
  return $function_ret;
} 

// Renames a folder or a file
function RenameItem()
{
  extract($GLOBALS);

  $itemType=$_POST["command"];
  $param=explode("|",$_POST["parameter"]);
  $itemName=SecureFileName($param[0]);
  $newName=SecureFileName($param[1]);
  $itemPath=$targetPath.$newName;



  switch ($itemType)
  {
    case "RenameFolder":
      if (file_exists($itemPath)==false && file_exists($itemPath)==false)
      {

        $itemPath=$targetPath.$itemName;
        $item=$itemPath;
        $res5=rename($item,$newName);
        if ($res5==0)
        {

          $wexMessage="Impossible de renommer le dossier \"".$itemName."\", une erreur est survenue ......";
        }
          else
        {

          $wexMessage="Dossier renommé \"".$itemName."\" vers \"".$newName."\"...";
        } 

      }
        else
      {

        $wexMessage="Impossible de renommer le dossier \"".$itemName."\",  un fichier ou dossier portant ce nom existe déjà \"".$newName."\"...";
      } 

      break;
    case "RenameFile":
      if (file_exists($itemPath)==false && file_exists($itemPath)==false)
      {

        $itemPath=$targetPath.$itemName;
        $item=$itemPath; 
       $res6=rename($item,$newName);
        if ($res6==0)
        {

          $wexMessage="Impossible de renommer le fichier \"".$itemName."\", une erreur est survenue ......";
        }
          else
        {

          $wexMessage="Fichier renommé  \"".$itemName."\" vers \"".$newName."\"...";
        } 

      }
        else
      {

        $wexMessage="Impossible de renommer le fichier \"".$itemName."\", un fichier ou dossier portant ce nom existe déjà \"".$newName."\"...";
      } 

      break;
  } 

  $item=null;

  return $function_ret;
} 



// Frees the objects and ends the application
function DestroyApp($encoding)
{
  extract($GLOBALS);

  if ($encoding==-1)
  {
    echo $codepage;
  } 
   $re=null;
} 
// ------------------------------------------------------------
?>
<!-- end content -->

<!-- Win Foot -->
</td>
              </tr>
            </table>
        </TD>
		<TD BGCOLOR=#D2DEEE>
			<IMG SRC="images/spacer.gif" WIDTH=9 HEIGHT=29 ALT=""></TD>
		<TD BGCOLOR="<?php echo $tempRoundedColor;?>"> 
			<IMG SRC="images/spacer.gif" WIDTH=1 HEIGHT=20 ALT=""></TD>
	</TR>
	<TR>
		<TD COLSPAN=2 ROWSPAN=2 align="right">
			<IMG SRC="images/wcorner4.gif" WIDTH=10 HEIGHT=11 ALT=""></TD>
		<TD BGCOLOR=#D2DEEE width="100%">
			<IMG SRC="images/spacer.gif" WIDTH=225 HEIGHT=10 ALT=""></TD>
		<TD COLSPAN=2 ROWSPAN=2>
			<IMG SRC="images/wcorner3.gif" WIDTH=10 HEIGHT=11 ALT=""></TD>
	</TR>
	<TR>
		<TD BGCOLOR=#1E5CA8 width="100%">
			<IMG SRC="images/spacer.gif" WIDTH=225 HEIGHT=1 ALT=""></TD>
	</TR>
</TABLE>
  </center>
</div>
    </td>
  </tr>
</table>
<!-- End Win Foot -->
<?php admfoot();?>


