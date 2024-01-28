<?php
 /* session_start();
  session_register("ADMINPROFIL_session");
  session_register("ADMINUSERNAME_session");
  session_register("ADMINACESS_session");
  session_register("ADMINUSERLOGGED_session");
  session_register("ADMINUSERID_session");
*/
include ("adminsettings.php");
include ("../common/tools.php");
include ("admintemplates.php");
include ("adminsecurity.php");
include ("dreamedit/dreameditor.php");
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
                      <td width="5%"><img border="0" src="images/icon_content.gif">
                      </td>
                      <td width="95%" valign="bottom" class="titles">
                      <font color="#1A62B0"><b>Contenu >> </b></font>
                      <font color="#008000"><b>Slider header</b></font></td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td width="100%">
<!-- End Win Head -->    

<!-- content -->     
<?php 
/*$qrymode=${"mode"};
$qryid=${"frmid"};*/
/*if(isset ($_GET["mode"])){$qrymode=$_GET["mode"];}else{$qrymode=NULL;}
if(isset ($_GET["frmid"])){$qryid=$_GET["frmid"];}else{$qryid=NULL;}
if(isset ($_GET["typ"])){$typ=$_GET["typ"];}else{$typ=NULL;}

*/
if(isset($_POST["mode"])){$qrymode=$_POST["mode"];
}else{ 
	if(isset($_GET["mode"])){$qrymode=$_GET["mode"];
	}else{$qrymode=NULL;}}
if(isset($_POST["frmid"])){$qryid=$_POST["frmid"];
}
else{if(isset($_GET["frmid"])){$qryid=$_GET["frmid"];}else{$qryid=NULL;}}
if(isset($_POST["typ"])){$typ=$_POST["typ"];
}
else{if(isset($_GET["typ"])){$typ=$_GET["typ"];}else{$typ=NULL;}}
$TableName="documents";
$TableKey="docID";
$OrderBy="docorder";
$Criteria="type='DIRECT'";
$ViewFields="docID,doctitle";

// related table (integrity) ( 2 table ) for delete
$RTableName1="";
$RTableKey1="";
$RTableName2="";
$RTableKey2="";

//  verif privilege 
if ($_SESSION['ADMINPROFIL']!="AD")
{

  $AdminMessage="Accès non autorisé <br>( vous n'avez pas de privilèges pour cette rubrique )";
}
  else
{


  switch ($qrymode)
  {
   
    case "":Previewdb();break;
    case "view":
      $view;
      break;
    case "edit":
      edit();
      break;
    case "add":
      add();
      break;
    case "sup":
      sup();

      break;
    case "update":
      update();
      break;
    case "addnew":
      addnew();
      break;
  } 

} 


?>
<SCRIPT LANGUAGE="javascript">
function validatetheform()
{ 
 if (document.theform.frmdoctitle.value=='')
  {
 alert ('Titre manquant !');
 document.theform.frmdoctitle.focus();
 return false;
  }
 
if (typeof(document.theform.WYSIWYGMode)!='undefined') { return true; }
          
          // design mode
          SetHTMLMode(document.DHTMLEdit,false)
          // adjust images path  
          var im=document.DHTMLEdit.DOM.images;   
          var WEBROOT=BaseURL+WebVirtualPath
          for(i=0; i<im.length ;i++) 
           {
           var isource = im[i].src;
           isource = isource.substr(WEBROOT.length,isource.length);
           im[i].src = isource;     
           }
           MirrorContent=document.all.DHTMLEditMirror;
           MirrorContent.value=document.DHTMLEdit.DOM.body.createTextRange().htmlText;

 return true;          
}  
</SCRIPT>
<?php 
function Previewdb()
{$DBO =new mysqli("localhost", "dcstecgr_artcomu", "artcom2015artcom","dcstecgr_webdbfr");

    if ($DBO -> connect_errno) {
        echo "Failed to connect to MySQL: " . $DBO -> connect_error;
        exit();
    }
    mysqli_select_db($DBO,'dcstecgr_webdbfr');
  extract($GLOBALS);
?>
<?php

  $strSQL="SELECT * from vbanner WHERE bannerorder=1;";
 // $RSA->Open$strSQL  $DBO  $adOpenStatic  $adLockReadOnly;
  $RSA=mysqli_query($DBO,$strSQL);

?>
<table border="0" width="100%" bgcolor="#A4BCDD" cellpadding="2" cellspacing="1">
           <tr>
           <td width="10%" bgcolor="#C6D6E8" height="20"><font color="#800000"><b>Code</b></font></td>
      <td width="10%" bgcolor="#C6D6E8" height="20"><font color="#800000"><b>Image</b></font></td>
           <td width="40%" bgcolor="#C6D6E8" height="20"><font color="#800000"><b>Action</b></font></td>
          </tr>
          <?php   while($dataRSA=mysqli_fetch_array($RSA))//(!$RSA->EOF)
  {
?>
              <tr bgcolor="#EEF2F9">
                <td> <b><?php     echo $dataRSA["id"];?></b></td>
                <td> <?php     echo $dataRSA["bannerimage"];?></td>
                
                <td>
                <a href="AdminDBADMslider.php?mode=edit&frmid=<?php     echo $dataRSA["id"];?>"><IMG border="0" SRC="images/bt_modif.gif" alt="Modifier"></a>
                <a href="javascript:confirmDelete('AdminDBADMslider.php?mode=sup&frmid=<?php     echo $dataRSA["id"];?>')"><IMG border="0" SRC="images/bt_supp.gif" alt="Supprimer"></a>
                </td>
              </tr>
              <?php     //$RSA->MoveNext;?>
         <?php   } ?>
         <?php   $RSA=NULL;$dataRSA=NULL?>
         <tr bgcolor="#C6D6E8">
         <td colspan="2">&nbsp;</td>
         <td><a href="AdminDBADMslider.php?mode=add&typ=1"><IMG border="0" SRC="images/bt_add.gif" alt="Ajouter"></a></td>
         </tr>
	
</table>
 <table border="0" width="100%" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="5%"><img border="0" src="images/icon_content.gif">
                      </td>
                     
                      <font color="#1A62B0"><b>Contenu >> </b></font>
                      <font color="#008000"><b>Slider home</b></font></td>
                    </tr>
                  </table>
				  
				  
				  
				



<?php

$strSQL=" SELECT * from vbanner WHERE bannerorder=2;";
 // $RSA->Open$strSQL  $DBO  $adOpenStatic  $adLockReadOnly;
  $RSA=mysqli_query($DBO,$strSQL);

?>
<table border="0" width="100%" bgcolor="#A4BCDD" cellpadding="2" cellspacing="1">
           <tr>
           <td width="10%" bgcolor="#C6D6E8" height="20"><font color="#800000"><b>Code</b></font></td>
      <td width="10%" bgcolor="#C6D6E8" height="20"><font color="#800000"><b>Image</b></font></td>
           <td width="40%" bgcolor="#C6D6E8" height="20"><font color="#800000"><b>Action</b></font></td>
          </tr>
          <?php   while($dataRSA=mysqli_fetch_array($RSA))//(!$RSA->EOF)
  {
?>
              <tr bgcolor="#EEF2F9">
                <td> <b><?php     echo $dataRSA["id"];?></b></td>
                <td> <?php     echo $dataRSA["bannerimage"];?></td>
                
                <td>
                <a href="AdminDBADMslider.php?mode=edit&frmid=<?php     echo $dataRSA["id"];?>"><IMG border="0" SRC="images/bt_modif.gif" alt="Modifier"></a>
                <a href="javascript:confirmDelete('AdminDBADMslider.php?mode=sup&frmid=<?php     echo $dataRSA["id"];?>')"><IMG border="0" SRC="images/bt_supp.gif" alt="Supprimer"></a>
                </td>
              </tr>
              <?php     //$RSA->MoveNext;?>
         <?php   } ?>
         <?php   $RSA=NULL;$dataRSA=NULL?>
         <tr bgcolor="#C6D6E8">
         <td colspan="2">&nbsp;</td>
         <td><a href="AdminDBADMslider.php?mode=add&typ=2"><IMG border="0" SRC="images/bt_add.gif" alt="Ajouter"></a></td>
         </tr>
	
</table>
 <table border="0" width="100%" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="5%"><img border="0" src="images/icon_content.gif">
                      </td>
                     
                      <font color="#1A62B0"><b>Contenu >> </b></font>
                      <font color="#008000"><b>Slider center</b></font></td>
                    </tr>
                  </table>
				  
				  
				<?php
$strSQL="SELECT * from vbanner WHERE bannerorder=3;";
 // $RSA->Open$strSQL  $DBO  $adOpenStatic  $adLockReadOnly;
  $RSA=mysqli_query($DBO,$strSQL);

?>
<table border="0" width="100%" bgcolor="#A4BCDD" cellpadding="2" cellspacing="1">
           <tr>
           <td width="10%" bgcolor="#C6D6E8" height="20"><font color="#800000"><b>Code</b></font></td>
      <td width="10%" bgcolor="#C6D6E8" height="20"><font color="#800000"><b>Image</b></font></td>
           <td width="40%" bgcolor="#C6D6E8" height="20"><font color="#800000"><b>Action</b></font></td>
          </tr>
          <?php   while($dataRSA=mysqli_fetch_array($RSA))//(!$RSA->EOF)
  {
?>
              <tr bgcolor="#EEF2F9">
                <td> <b><?php     echo $dataRSA["id"];?></b></td>
                <td> <?php     echo $dataRSA["bannerimage"];?></td>
                
                <td>
                <a href="AdminDBADMslider.php?mode=edit&frmid=<?php     echo $dataRSA["id"];?>"><IMG border="0" SRC="images/bt_modif.gif" alt="Modifier"></a>
                <a href="javascript:confirmDelete('AdminDBADMslider.php?mode=sup&frmid=<?php     echo $dataRSA["id"];?>')"><IMG border="0" SRC="images/bt_supp.gif" alt="Supprimer"></a>
                </td>
              </tr>
              <?php     //$RSA->MoveNext;?>
         <?php   } ?>
         <?php   $RSA=NULL;$dataRSA=NULL?>
         <tr bgcolor="#C6D6E8">
         <td colspan="2">&nbsp;</td>
         <td><a href="AdminDBADMslider.php?mode=add&typ=3"><IMG border="0" SRC="images/bt_add.gif" alt="Ajouter"></a></td>
         </tr>
	
</table>
 
				    
				  
								
				  
<?php //  return $function_ret;
} ?>

<?php function edit()
{$DBO =new mysqli("localhost", "dcstecgr_artcomu", "artcom2015artcom","dcstecgr_webdbfr");

    if ($DBO -> connect_errno) {
        echo "Failed to connect to MySQL: " . $DBO -> connect_error;
        exit();
    }
    mysqli_select_db($DBO,'dcstecgr_webdbfr');
  extract($GLOBALS);
?> 
<?php 
//'''''''''''''''''''''''''
// MASK EDIT DB RECORDS
//'''''''''''''''''''''''''
  $strSQL="SELECT * from vbanner Where id=".$qryid.";";
  //$RSA->Open$strSql  $DBO  $adOpenStatic  $adLockReadOnly;
  $RSA=mysqli_query($DBO,$strSQL);
  $dataRSA=mysqli_fetch_array($RSA);
?>
         <form method="POST" action="AdminDBADMslider.php" name="theform" onSubmit="return validatetheform()" enctype="multipart/form-data"><input type="hidden" name="MAX_FILE_SIZE" value="100000000000" />      
                 <table border="0" width="100%" bgcolor="#A4BCDD" cellspacing="1">
                     <tr><td>Images</td><td><input type="file"  maxlength="4"  name="frmdocimage" size="30" value=""></td></tr> 
                  
                    <tr>
                      <td bgcolor="#C6D6E8">&nbsp;</td>
                      <td bgcolor="#C6D6E8">
                      <input type="image" alt="Valider" border="0" class="noborders"  SRC="images/bt_validate.gif">&nbsp;
                       <a href="AdminDBADMslider.php"><IMG border="0" SRC="images/bt_cancel.gif" alt="Annuler"></a>
                      </td>
                    </tr>
                  </table>
                  <input type=hidden name="mode" value="update">
				
                  <input type=hidden name="frmid" value="<?php   echo $dataRSA["id"];?>">
    </form> 
    <?php   $RSA=NULL;$dataRSA=NULL?>
<?php   //return $function_ret;
} ?>

<?php function add()
{
  extract($GLOBALS);
?>
               <form method="POST" action="AdminDBADMslider.php" name="theform" onSubmit="return validatetheform()" enctype="multipart/form-data"><input type="hidden" name="MAX_FILE_SIZE" value="100000000000" />      
                 <table border="0" width="100%" bgcolor="#A4BCDD" cellspacing="1">
                     <tr><td>Images</td><td><input type="file"  maxlength="4"  name="frmdocimage" size="30" value=""></td></tr> 
                  
                    <tr>
                      <td bgcolor="#C6D6E8">&nbsp;</td>
                      <td bgcolor="#C6D6E8">
                      <input type="image" alt="Valider" border="0" class="noborders"  SRC="images/bt_validate.gif">&nbsp;
                       <a href="AdminDBADMslider.php"><IMG border="0" SRC="images/bt_cancel.gif" alt="Annuler"></a>
                      </td>
                    </tr>
                  </table>
                  <input type=hidden name="mode" value="addnew">
				  <input type=hidden name="typ" value="<?php   echo $typ;?>">
				
				  
				  
        </form> 
<?php  // return $function_ret;
} 
  function  update()
    {$DBO =new mysqli("localhost", "dcstecgr_artcomu", "artcom2015artcom","dcstecgr_webdbfr");

        if ($DBO -> connect_errno) {
            echo "Failed to connect to MySQL: " . $DBO -> connect_error;
            exit();
        }
        mysqli_select_db($DBO,'dcstecgr_webdbfr');
  extract($GLOBALS);
    if(isset($_FILES['frmdocimage']))
{

unset($erreur);
$extensions_ok = array('png', 'gif', 'jpg', 'jpeg');
$taille_max = 10000000000;
$dest_dossier = '../images/';
if( !in_array( substr(strrchr($_FILES['frmdocimage']['name'], '.'), 1), $extensions_ok) )
{
$erreur = 'Veuillez s&eacute;lectionner un fichier de type png, gif ou jpg !';
}
elseif
(file_exists($_FILES['frmdocimage']['tmp_name'])and filesize($_FILES['frmdocimage']['tmp_name']) > $taille_max)
{
$erreur = 'Votre fichier doit faire moins de 5000Ko !';
}
if(!isset($erreur))
{
$dest_fichier = basename($_FILES['frmdocimage']['name']);
$dest_fichier = strtr($dest_fichier,'A?A???CEEEE??II??O??U?UU?à?â???çèéêë??îï???ô??ù?ûü??','AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
$dest_fichier = preg_replace('/([^.a-z0-1]+)/i', '_', $dest_fichier);
$poiuy=$_FILES['frmdocimage']['tmp_name'];

move_uploaded_file($poiuy,$dest_dossier.$dest_fichier);
$pro=$dest_dossier.$dest_fichier;
	




 	

$strSQL="UPDATE vbanner  SET bannerimage='".$pro."'
                                           Where id=".$qryid. ";";
	//echo $strSQL;

     $RSA=mysqli_query($DBO,$strSQL);
  
    $dataRSA=NULL;$RSA=NULL;
	echo "<html><script language=\"javascript\">location.href='AdminDBADMslider.php'</script></html>";
	
//Response.Redirect (thisscript) 
   // return $function_ret;

  
    }
}
} 

	

  

 function addnew()
{$DBO =new mysqli("localhost", "dcstecgr_artcomu", "artcom2015artcom","dcstecgr_webdbfr");

    if ($DBO -> connect_errno) {
        echo "Failed to connect to MySQL: " . $DBO -> connect_error;
        exit();
    }
    mysqli_select_db($DBO,'dcstecgr_webdbfr');
  extract($GLOBALS);
    if(isset($_FILES['frmdocimage']))
{ 

unset($erreur);
$extensions_ok = array('png', 'gif', 'jpg', 'jpeg');
$taille_max = 10000000000;
$dest_dossier = '../images/';
if( !in_array( substr(strrchr($_FILES['frmdocimage']['name'], '.'), 1), $extensions_ok) )
{
$erreur = 'Veuillez s&eacute;lectionner un fichier de type png, gif ou jpg !';
}
elseif
(file_exists($_FILES['frmdocimage']['tmp_name'])and filesize($_FILES['frmdocimage']['tmp_name']) > $taille_max)
{
$erreur = 'Votre fichier doit faire moins de 5000Ko !';
}
if(!isset($erreur))
{
$dest_fichier = basename($_FILES['frmdocimage']['name']);
$dest_fichier = strtr($dest_fichier,'A?A???CEEEE??II??O??U?UU?à?â???çèéêë??îï???ô??ù?ûü??','AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
$dest_fichier = preg_replace('/([^.a-z0-9]+)/i', '_', $dest_fichier);
$poiuy=$_FILES['frmdocimage']['tmp_name'];

move_uploaded_file($poiuy,$dest_dossier.$dest_fichier);
$pro=$dest_dossier.$dest_fichier;
	




 	  $strSQL="INSERT INTO  vbanner (bannerimage,bannerorder) 
                                 VALUES ('".$pro."','".$typ."');";	
								 
	//echo $strSQL;   
    $RSA=mysqli_query($DBO,$strSQL);
	
   /* $RSA["doctitle"]=$_POST["frmdoctitle"];
    $RSA["docbody"]=$_POST["content"];
    $RSA["type"]="DIRECT";*/

    $dataRSA=NULL;$RSA=NULL;
    echo "<html><script language=\"javascript\">location.href='AdminDBADMslider.php'</script></html>";



  
    }
}
} 
  function sup()
  {$DBO =new mysqli("localhost", "dcstecgr_artcomu", "artcom2015artcom","dcstecgr_webdbfr");

      if ($DBO -> connect_errno) {
          echo "Failed to connect to MySQL: " . $DBO -> connect_error;
          exit();
      }
      mysqli_select_db($DBO,'dcstecgr_webdbfr');
    extract($GLOBALS);

    $confdelete=true;
  



    if ($confdelete)
    {
 
       $strSQL="DELETE from vbanner Where id=".$qryid.";";
       $RSA=mysqli_query($DBO,$strSQL);
       $RSA=NULL;$dataRSA=NULL;
      echo "<html><script language=\"javascript\">location.href='AdminDBADMslider.php'</script></html>";
    }
    

  } 

?>
<!-- end content -->

<!-- Win Foot -->
</td>
              </tr>
            </table>
        </TD>
		<TD BGCOLOR=#D2DEEE>
			<IMG SRC="images/spacer.gif" WIDTH=9 HEIGHT=29 ALT=""></TD>
		<TD BGCOLOR="<?php   echo $tempRoundedColor;?>"> 
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
<?php   admfoot();?>