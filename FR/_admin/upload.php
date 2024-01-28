<?
  session_start();
?>
<!--#include file="adminsettings.php"-->
<!--#include file="../common/tools.php"-->
<!-- #include file="plugins/WexGeneric.php" -->
<?
$DBO =new mysqli("localhost", "dcstecgr_artcomu", "artcom2015artcom","dcstecgr_webdbfr");

if ($DBO -> connect_errno) {
    echo "Failed to connect to MySQL: " . $DBO -> connect_error;
    exit();
}
mysqli_select_db($DBO,'dcstecgr_webdbfr');
$result=-1;

$fileTransfer = new pluginFileTransfer();
// $FSO is of type "Scripting.FileSystemObject"
if (($FSO ? 0 : 1)!=0)
{
  $Error ="File Transfer Plugin Error";
    $true;
} 
$targetPath=WexMapPath($_GET["folder"]);
//response.write (Request.QueryString("folder"))&"<br>"
//response.write targetPath
//response.end

$process=$_GET["process"];

?>
<html>
<style>
BODY
{
    MARGIN-TOP: 0px;
    FONT-SIZE: 10pt;
    MARGIN-LEFT: 0px;
    COLOR: #ffffff;
    FONT-FAMILY: Verdana, Tahoma, Arial
}
TD
{
    FONT-SIZE: 8pt;
    COLOR: #000000;
    FONT-FAMILY: Verdana, tahoma, Arial
}
FORM
{
    PADDING-RIGHT: 0px;
    PADDING-LEFT: 0px;
    PADDING-BOTTOM: 0px;
    MARGIN: 0px;
    PADDING-TOP: 0px
}
</style>

<SCRIPT Language ="JavaScript">
function checkupload() 
{
var fileTypes = new Array('.jpg','.jpeg','.gif','.png','.wmv','.wma','.swf');
// define file types array
var file = document.formBuffer.file.value;
file = file.toLowerCase();
var bool = false;
//  test
if (file == '') { alert('Parcourir le fichier � envoyer !') ; return false ; }

   for (i=0 ; i<fileTypes.length ; i++)  
     { if (file.indexOf(fileTypes[i]) != -1) { bool=true } }
   if (bool==false) 
     {
     alert("Vous ne pouvez envoyer que des fichiers de type: \n\n" + (fileTypes.join(" ")) + "\n\n");
     return false;
     }
     //var objADO_stream = new ActiveXObject("ADODB.Stream");
     //objADO_stream.LoadFromFile("e:\00.txt")
     //objADO_stream.open();
     //objADO_stream.Type = 1; // Binary data
     //objADO_stream.LoadFromFile(myfile);  
     //alert (objADO_stream.Size);
     
     return true
 } 
 
	function Upload() 
	
	{
	if (checkupload())
        { 
        document.forms.formBuffer.submit(); 
        elem = document.getElementById("PBAR");
        elem.style.display = '';
        elem.src =  elem.src ;
        }
        
	}

</script>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgcolor="#549FD4" >
<table cellSpacing="1" width="100%" bgColor="#a4bcdd" border="0">
    <tr>
      <td bgColor="#c6d6e8"><font color="#800000"><b>Envoi de fichiers vers le serveur</b></font></td>
    </tr>
    <tr>
      <td bgColor="#c6d6e8"><b>Upload vers</b> :<? echo basename($targetPath);?></td>
    </tr>
    <tr>
      <td bgColor="#c6d6e8">			
<? 
// Actual upload process
if ($process=="true")
{

  $fileTransfer->path=$targetPath;
  $result=$fileTransfer->Upload();
  switch ($result)
  {
    case 0:
      print $fileTransfer->uploadedFileName." a �t� envoy� avec succ�s<br>";
      print FormatSize($fileTransfer->uploadedFileSize)." (".$fileTransfer->uploadedFileSize." Octets) <br>";
      print "Content type: ".$fileTransfer->contentType;
      print "<script language=\"javascript\">opener.Command('Refresh');</script>";
      break;
    case 1:
      print "<font color=red>Pas de fichier envoy�</font>";
      break;
    case 2:
      print "<font color=red>Chemain non trouv�</font>";
      break;
    case 3:
      print "<font color=red>".$fileTransfer->uploadedFileName." ne peut pas �tre �crit - verifier les droits d'acc�s</font>";
      break;
  } 
?>
					<form name=formBuffer method=post action="<?   echo thisscript();?>?process=true">
						<input type=hidden name=command value="Upload">
						<input type=hidden name=folder value="<?   echo $_GET["folder"];?>">
					</form>
<? 
}
  else
{

?>
					<form enctype="multipart/form-data" name=formBuffer method=post action="<?php   echo thisscript();?>?process=true&folder=<?   echo rawurlencode($_GET["folder"]);?>">
						<input type=file name=file class=formClass>
					</form>
<?php 
} 

?>					
	<br>
	<img id = "PBAR" src="images/loading.gif"  style=" display : none ">	
	</td>
    </tr>
    <tr>
      <td bgColor="#c6d6e8">
       <?php if ($result==-1)
{
?>
       <a href="javascript:Upload();"><img border=0 alt="Valider" src="images/bt_validate.gif"></a>&nbsp;
       <?php } ?>
       <a href="javascript:this.close();"><img alt="Fermer" src="images/bt_ok.gif" border="0"></a></td>
    </tr>

</table>
</body>
</html>

<? 
$FSO=null;

$fileTransfer=null;

// Close DBO
$DBO->close;
$DBO=null;



?>
