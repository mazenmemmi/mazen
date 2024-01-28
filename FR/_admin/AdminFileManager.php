<?php
 
include ("adminsettings.php");
include ("../common/tools.php");
include ("admintemplates.php");
include ("adminsecurity.php");
admhead();
?>
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
                      <font color="#1A62B0"><b>M&eacute;dias >> </b></font>
                      <font color="#008000"><b>Gestion des m&eacute;dias</b></font></td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
         <td width="100%">
<!-- End Win Head -->    

<!-- content -->     
<?php
$dir_nom = '../images/'; // dossier listé (pour lister le répertoir courant : $dir_nom = '.'  --> ('point')
/*$encoding=InitApp();*/
if (isset($_POST["command"])!="")
{
	switch ($_POST["command"])
{
 case "NewFile":CreateItem();break;
 case "NewFolder":CreateItem();break;
 case "DeleteFile":DeleteItem();break;
 case "DeleteFolder":DeleteItem();break;
 case "RenameFile":RenameItem();break;
 case "RenameFolder":RenameItem();break;
 case "OpenFolder": $dir_nom=$_POST["folder"].$_POST["parameter"]."/";break;
 case "LevelUp": $dir_nom=dirname($_POST["folder"])."/";break;
} 
}

$dir = opendir($dir_nom) or die('Erreur de listage : le répertoire n\'existe pas'); // on ouvre le contenu du dossier courant
$fichier= array();
$dossier= array(); 
while($element = readdir($dir))
 {
	if($element != '.' && $element != '..') {
		if (!is_dir($dir_nom.'/'.$element)) {$fichier[] = $element;}
		else {$dossier[] = $element;}
	}
}
//$folder=$dir_nom
?>
<form name="formGlobal" onSubmit="return(false);">
<table cellspacing=1 cellpadding=1 border=0 width=100% bgcolor="#a4bcdd">
	<tr>
	  <td colspan="5">
	   <table cellspacing=0 cellpadding=0 border=0 width=100% bgcolor="#c6d6e8">
		<tr>
		 <td>
			<div style="font-size:8pt;">&nbsp;<img align=absmiddle border=0 src="./images/folder_open.png">&nbsp;<span class=boldText><?php   echo $dir_nom;?></span></div>
			<?php   ?>
			<div style="font-size:8pt;">&nbsp;&nbsp;<?php   echo $dir_nom;?></div
		></td>
		<td>
			<span class=boldText><?php   echo count(glob($dir_nom.'*', GLOB_ONLYDIR));  ?></span> Sous-r&eacute;pertoire(s)<br>
			<span class=boldText><?php   echo count_files($dir_nom); ?></span> Fichier(s)
		</td>
		<td>
			Taille total: <span class=boldText><?php    echo FormatSize(DirSize($dir_nom."/",true)); ?></span>
		</td>
		<td colspan=2 align=right>
			<a href="javascript:Command('Refresh');"><img align=absmiddle border=0 width=21 height=20 src="./images/refresh.png" alt="Actualiser la liste"></a>&nbsp;
			<a href="javascript:Command('NewFolder');"><img align=absmiddle border=0 width=21 height=20 src="./images/create_folder.png" alt="Créer un nouveau dossier"></a>&nbsp;
			<a href="javascript:Command('Upload','<?php  // upload?>');"><img align=absmiddle border=0 width=21 height=20 src="./images/upload.png" alt="Uploader dans le dossier en cours"></a>&nbsp;
		<tr><td colspan=5 bgcolor=white>
		<input name="wexMessage" type="text" class="formClass" size="120" value="<?php echo htmlspecialchars($listed);  ?>" readonly >
		 </td></tr>
	   </table>
		</td>
	</tr>
	<tr bgColor="#c6d6e8" height="20">
		<td>&nbsp;<span class=boldText><font color="#800000">Nom</font></span></td>
		<td >&nbsp;<span class=boldText><font color="#800000">Taille</font></span></td>
		<td>&nbsp;<span class=boldText><font color="#800000">Type</font></span></td>
		<td>&nbsp;<span class=boldText><font color="#800000">Modifi&eacute; le</font></span></td>
		<td>&nbsp;</td>
	</tr>
<?php
$rowType="darkRow";
 ?>
	<tr class=<?php echo $rowType;?>><td>&nbsp;<a href="javascript:Command('LevelUp');" title="Répertoire précédant"><img align=absmiddle border=0 width=15 height=13 src="./images/folder_up.png"></a>&nbsp;<a href="javascript:Command('LevelUp');" title="Up One level">..</a></td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
<?php 
   $rowType="lightRow";
$listed=0;
$wexMessage="";
closedir($dir);
if(!empty($dossier))
 {
	sort($dossier); // pour le tri croissant, rsort() pour le tri décroissant
 	foreach($dossier as $lien){

          $listed=$listed+1;
?>
	<tr class=<?php echo $rowType;?>>
		<td>&nbsp;<?php echo GetIcon($lien,true); //icon de imge  ?>&nbsp;<a href="javascript:Command('OpenFolder','<?php echo $lien;?>');" title="Open Folder"><?php echo $lien;// tiitre de dossier  ?></a></td>
		<td>&nbsp;<?php   echo FormatSize(filesize($dir_nom."/".$lien )); //taille de ficheir ?></td>
        <td>&nbsp;<?php echo filetype($dir_nom."/".$lien);?></td>
		<td nowrap>&nbsp;<?php  echo date ("F d Y H:i:s.",filemtime($dir_nom."/".$lien));?></td>
		<td nowrap>
			<a href="javascript:Command('RenameFolder','<?php echo $lien;?>');"><img align=absmiddle border=0 width=11 height=14 src="./images/rename.png" alt="Renommer le dossier"></a>
			<a href="javascript:Command('DeleteFolder','<?php echo $lien;?>');"><img align=absmiddle border=0 width=14 height=14 src="./images/delete.png" alt="Supprimer le dossier"></a>
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
    if(!empty($fichier)){
	sort($fichier);// pour le tri croissant, rsort() pour le tri décroissant
		foreach($fichier as $lien) {
			//echo "<a href=\"$dir_nom/$lien \">$lien</a>";
	      $listed=$listed+1;
?>
	<tr class=<?php  echo $rowType;?>>
	<td>&nbsp;<?php echo GetIcon($lien,false);?>&nbsp;<a href="<?php echo $dir_nom."/".$lien ;?>" target="_blank" title="visualiser le fichier"><?php echo $lien;?></a></td>
		<td>&nbsp;<?php echo FormatSize(filesize($dir_nom."/".$lien ));?></td><td>&nbsp;<?php echo filetype($dir_nom."/".$lien); ?></td>
		<td nowrap>&nbsp;<?php  echo  date ("F d Y H:i:s.",filemtime($dir_nom."/".$lien)); ?></td>
		<td nowrap>
			<a href="javascript:Command('RenameFile', &#34;<?php echo $lien;?>&#34;);"><img align=absmiddle border=0 width=11 height=14 src="./images/rename.png" alt="Renommer"></a>
			<a href="javascript:Command('DeleteFile', &#34;<?php echo $dir_nom.$lien;?>&#34;);"><img align=absmiddle border=0 width=14 height=14 src="./images/delete.png" alt="Supprimer"></a>
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

?>
	<tr></tr>
    
</table>
</form>
<form method="POST" action="AdminFileManager.php" name="formBuffer">

	<input type="hidden" name="command" value="">
	<input type="hidden" name="parameter" value="">
	<input type="hidden" name="virtual" value="<?php  // echo $virtual;?>">
	<input type="hidden" name="folder" value="<?php   echo $dir_nom.'/';?>">
	<input type="hidden" name="popup" value="false">
</form>
<?php

// pour input de messages
echo "<script>document.forms.formGlobal.wexMessage.value='".$listed."');</script>";
 // fonction pour le icon de fichier
function GetIcon($fileName,$isFolder)
{
  extract($GLOBALS);


  if ($isFolder)
  {

    $function_ret="<a href=\"javascript:Command('FolderDetails', &#34;".$fileName."&#34;);\"><img align=absmiddle border=0 width=15 height=13 src=\"./images/folder.png\" alt=\"Folder - Click to learn details\"></a>";
  }
    else
  {
      $xtt=strrchr($fileName,'.');
	 $ext=substr($xtt,1);
     $extresult=FilterExtension($xtt);
    //$ext=   basename($fileName); 
	//$extresult=    substr(pathinfo($ext, PATHINFO_FILENAME), 1);

    if ($extresult==-1)
    {

      $function_ret="<img align=absmiddle border=0 src='images/file.png'>";
    }
      else
    {

      $function_ret="<img align=absmiddle border=0 src=dreamedit/".$extresult.">";
    } 

  } 

 return $function_ret;
} 
// donction pour Nouveau dossier ou fichier
function CreateItem()
{
  extract($GLOBALS);
  $itemType=$_POST["command"];
  $itemName=$_POST["parameter"];
  $itemPath=$dir_nom.$itemName;
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
} 
//Supprime le fichier ouo dossier
function DeleteItem()
{
  extract($GLOBALS);

  $itemType=$_POST["command"];
  $itemName=$_POST["parameter"];
  $itemPath=$dir_nom.$itemName;

//echo $itemPath;

  switch ($itemType)
  {
    case "DeleteFolder":
      $res3=rmdir($itemPath); 
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
} 
// fonction renomme
function RenameItem()
{
  extract($GLOBALS);
  $itemType=$_POST["command"];
  $param=explode("|",$_POST["parameter"]);
  $itemName=$param[0];
  $newName=$param[1];
  $itemPath=$dir_nom.$newName; 
echo $param[0]."<br>";
echo $param[1]."<br>";
echo $itemPath."<br>";
/*
  switch ($itemType)
  {
    case "RenameFolder":
      if (file_exists($itemPath)==false && file_exists($itemPath)==false)
      {

        $itemPath=$Dir_nom.$itemName;
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

       $itemPath=$dir_nom.$itemName;
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

  $item=null;*/
} 
?>
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
<?php 
 $dir_nom="";

admfoot();?>


