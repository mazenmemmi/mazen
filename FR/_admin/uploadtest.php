
<?php
if(isset($_GET["dist"])){$dist=$_GET["dist"];
}
if(isset($_GET["file"])){$file=$_GET["file"];
}

 switch ($file)
  { 
    case "false":Previewdb(); break;
    case "true":upload();break;
  } 

function Previewdb()
{
  extract($GLOBALS);

?>
   <form method="POST" action="uploadtest.php?file=true&dist=<?php echo $dist;?>" name="theform" onSubmit="return validatetheform()" enctype="multipart/form-data"><input type="hidden" name="MAX_FILE_SIZE" value="100000000000" />      
      <table border="0" width="100%" bgcolor="#A4BCDD" cellspacing="2">
                    
                    <tr><td>Upload vers:</td><td><?php echo $dist;?></td></tr>
                 
                     <tr><td>Fichier</td><td><input type="file"  maxlength="4"  name="fileupload" size="30" value=""></td></tr>
                 
				
				
                     
                 <tr>
                      <td bgcolor="#C6D6E8" colspan="2">
                      <input type="image" border="0" class="noborders"  SRC="images/bt_validate.gif" alt="Valider" id=image1 name=image1>&nbsp;
                       <a href="#" onClick="window.close()"><IMG border="0" SRC="images/bt_cancel.gif" alt="Annuler"></a>
                      </td>
                    </tr>
                  </table>

        </form> 

<?php
}





function upload()
{

  extract($GLOBALS);
    if(isset($_FILES['fileupload']))
{ 

unset($erreur);
//$extensions_ok = array('png', 'gif', 'jpg', 'jpeg','doc','pdf');
$taille_max = 10000000000;
//$dest_dossier = '../images/subrub';
/*if( !in_array( substr(strrchr($_FILES['fileupload']['name'], '.'), 1), $extensions_ok) )
{
$erreur = 'Veuillez s&eacute;lectionner un fichier de type png, gif ou jpg !';
}*/
$dest_fichier = basename($_FILES['fileupload']['name']);
$filename = $dist.$dest_fichier;
echo file_exists($filename);
if (file_exists($filename)){
$erreur= "Une fichier de meme nom existe dans :".$dist;
    }
elseif
(file_exists($_FILES['fileupload']['tmp_name'])and filesize($_FILES['fileupload']['tmp_name']) > $taille_max)
{
$erreur = 'Votre fichier doit faire moins de 5000Ko !';
}
if(!isset($erreur))
{
$dest_fichier = basename($_FILES['fileupload']['name']);
$dest_fichier = strtr($dest_fichier,'A?A???CEEEE??II??O??U?UU?à?â???çèéêë??îï???ô??ù?ûü??','AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
$dest_fichier = preg_replace('/([^.a-z0-1]+)/i', '_', $dest_fichier);
$poiuy=$_FILES['fileupload']['tmp_name'];

move_uploaded_file($poiuy,$dist.$dest_fichier);
$pro=$dist.$dest_fichier;

  //echo "<html><script language=\"javascript\">location.href='AdminDBADMsubrubs.php?frmidxid=".$qryidxid."'</script></html>";

    }
	if(isset($erreur))
	echo $erreur;
	
}
} 
?>
