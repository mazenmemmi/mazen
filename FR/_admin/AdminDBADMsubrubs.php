<?php
include ('adminsettings.php');
include ('../common/tools.php');
include ('admintemplates.php');
include ('adminsecurity.php');
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
		<TD BGCOLOR=""><!--?php echo $tempRoundedColor;?-->
			<IMG SRC="images/spacer.gif" WIDTH=1 HEIGHT=20 ALT=""></TD>
		<TD BGCOLOR=#D2DEEE>
			<IMG SRC="images/spacer.gif" WIDTH=9 HEIGHT=29 ALT=""></TD>
		<TD BGCOLOR=#D2DEEE width="100%" valign="top">
            <table border="0" width="100%" cellspacing="1">
              <tr>
                <td width="100%">
                  <table border="0" width="100%" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="5%"><img border="0" src="images/icon_screen.gif" width="38" height="36">
                      </td>
                      <td width="95%" valign="bottom" class="titles">
                      <font color="#1A62B0"><b>L'arborescence >> </b></font>
                      <font color="#008000"><b>Sous-rubriques</b></font></td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td width="100%">
<!-- End Win Head -->    

<!-- content -->     
<?php
$DBO =new mysqli("localhost", "dcstecgr_artcomu", "artcom2015artcom","dcstecgr_webdbfr");
if ($DBO -> connect_errno) {
    echo "Failed to connect to MySQL: " . $DBO -> connect_error;
    exit();
}
mysqli_select_db($DBO,'dcstecgr_webdbfr');
if(isset($_POST["mode"])){$qrymode=$_POST["mode"];
}else{ 
	if(isset($_GET["mode"])){$qrymode=$_GET["mode"];
	}else{$qrymode=NULL;}}
if(isset($_POST["frmid"])){$qryid=$_POST["frmid"];
}else{if(isset($_GET["frmid"])){$qryid=$_GET["frmid"];}else{$qryid=NULL;}}
if(isset($_GET["frmidxid"])){$qryidxid=$_GET["frmidxid"];}else{$qryidxid=NULL;}
if(isset($_GET["frmidx0id"])){$qryidx0id=$_GET["frmidx0id"];}else{$qryidx0id=NULL;}
if(isset($_GET["frmidxSid"])){$qryidxSid=$_GET["frmidxSid"];}else{$qryidxSid=NULL;}
if(isset($_GET["ro"])){$qryro=$_GET["ro"];}else{$qryro=NULL;}
//Pour l'ajout
if(isset($_GET["vall"])){$vale=$_GET["vall"];}


$TableName="m_sousrubrique";
$TableKey="srubID";
$OrderBy="sruborder";
$ViewFields=" * ";

// Index Table ( Relation Table )
$ITableName="m_rubrique";
$ITableKey="rubID";
$ITableTitle="rublibelle";
$IOrderBy="ruborder";
$ICriteria="And rubTYPE='DOC' AND rubopen = -1";//-1 //2013

// Related to Index Table ( Relation Table )
$ITableName0="m_categorie";
$ITableKey0="catID";
$ITableTitle0="catlibelle";
$IOrderBy0="catorder";

// related table (integrity) ( 2 table ) for delete
$RTableName1="documents";
$RTableKey1="srubID";
$RTableName2="links";
$RTableKey2="srubID";

// get idx0 from idx
// if ($qryidxid==NULL)
// {
//   $strSQL="SELECT * from ".$ITableName." where ".$ITableKey."=".$qryidxid." ;";
//   $RSA=mysqli_query($DBO,$strSQL);
//   //echo "1";//2013
//  // echo $qryidxid;//2013
//     $qryidx0id=($RSA[$ITableKey0]);
//        $RSA=NULL;
// } 

if ($qryidxid !== NULL) {
  $strSQL = "SELECT * FROM $ITableName WHERE $ITableKey = ?";
  $stmt = mysqli_prepare($DBO, $strSQL);

  
      mysqli_stmt_bind_param($stmt, "i", $qryidxid);
      mysqli_stmt_execute($stmt);
      $RSA = mysqli_stmt_get_result($stmt);

      if ($row = mysqli_fetch_assoc($RSA)) {
          $qryidx0id = $row[$ITableKey0];
      }

      mysqli_stmt_close($stmt);
 
}



//  verif privilege 
if ($_SESSION['ADMINPROFIL']!="AD")
{
  $AdminMessage="Acces non autorise <br>( vous n'avez pas de privileges pour cette rubrique )";
}
  else
{


  switch ($qrymode)
  { 
    case "":Previewdb(); break;
    case "view": $view;break;
    case "edit": edit();break;
    case "add":add();break;
    case "sup":sup();break;
    case "update":update();break;
    case "addnew":addnew();break;
  } 

} 
?>

<SCRIPT LANGUAGE="javascript">
function validatetheform()
{ 
 if (document.theform.frmsrublibelle.value=='')
  {
 alert ('Libellé manquant !');
 document.theform.frmsrublibelle.focus();
 return false;
  }
 
 if ( isNaN(parseInt(document.theform.frmsruborder.value,10))) 
{ alert ('Ordre manquant ou invalide') ; document.theform.frmsruborder.focus() ; 
 return false ; 
}

  document.theform.frmsruborder.value=parseInt(document.theform.frmsruborder.value,10);
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

<table border="0" width="100%" bgcolor="#A4BCDD" cellpadding="2" cellspacing="1">
         <tr>
         <td bgcolor="#C6D6E8" colspan="5">
         <form name="Sfrom">
         <table  cellpadding="2" cellspacing="1"  width="100%" border="0">
          <tr><td width="10%">
               <font color="#800000"><b>Sélectionnez la section:</b></font><br>
               <select name="frmidx0id" size="5" class="SELECTCLASS" onChange="goidx0(this.options[selectedIndex].value,'AdminDBADMsubrubs.php')">
                            <?php  if ($qryidx0id=="-1" || $qryidx0id=="")
                                   {
                                   // if catid empty ?>
                                    <option selected value="-1">[ Sélection ]</option>
                            <?php   }
                                   else
                                     {
                              ?>
                                    <option value="-1">[ Sélection ]</option>
                            <?php   } ?>
                            <?php 
        $strSQL="SELECT * from ".$ITableName0." ORDER BY ".$IOrderBy0." ;";
        //   echo "2";//2013
		//echo $strSQL;//2013
		$RSA=mysqli_query($DBO,$strSQL);
        while($rees=mysqli_fetch_array($RSA))
       {
   ?>
               <option value="<?php     echo $rees[$ITableKey0];?>"
         <?php     if ($qryidx0id=($rees[$ITableKey0]))
                   {
                      echo "selected";
                    } ?>>
		   <?php     echo $rees[$ITableTitle0];?></option>
 <?php   } 
  $RSA=NULL;
  $rees=NULL;
?>   
                 </select> 
                 </td>
                  <?php   if ((!($qryidx0id=="-1" || $qryidx0id==NULL)))
  {
?>
                  <?php // if index0 selected ( foreing key )   ?>
		         <td width="90%"><font color="#800000"><b>Sélectionnez la rubrique:</b></font><br>
	             <select name="frmidxid" size="5" class="SELECTCLASS" onChange="goidx(this.options[selectedIndex].value,'AdminDBADMsubrubs.php')">
                   <?php     if ($qryidxid=="-1" || $qryidxid=="")
                            {
                     ?>
		                        <option selected value="-1">[Sélection]</option>           
		           <?php     }
                             else
                             {
                     ?> 
		                         <option value="-1">[Sélection]</option>
		           <?php     } ?> 
		          <?php 
    $strsql="SELECT * from ".$ITableName." WHERE ".$ITableKey0."=".$qryidx0id." ".$ICriteria." ORDER BY ".$IOrderBy." ;";
     $strSQL1=$strsql;//2013
	$RSA=mysqli_query($DBO,$strsql);
	$RSAcount=mysqli_num_rows($RSA);//$RSA->RecordCount;
//	echo $RSAcount;
	if (($RSAcount!=0))
    {

      while(($dataRSA=mysqli_fetch_array($RSA)))
      {
?>
                          <option value="<?php        echo $dataRSA[$ITableKey];?>" <?php    if ($qryidxid==($dataRSA[$ITableKey]))
        {
          echo "selected";
        }  ?>><?php    echo $dataRSA[$ITableTitle];?></option>
                          <?php         //$RSA->Movenext;
      } 
    }
      else
    {

      echo "<option value=\"-1\" >--Pas de rubriques ouvrable--</option>";
    } 

    $RSA=NULL;
	$dataRSA=NULL;
?>                              
                 </select>         
                 </td>
                 <?php   } ?> 
             </tr>
        </table>
       </form>    
</td></tr>       
         <?php  if (!($qryidxid=="-1" || $qryidxid==""))
          {
           // if index selected  ?>  
         <?php 
    $strSQL="SELECT * from ".$TableName." WHERE ".$ITableKey."=".$qryidxid." ORDER BY ".$OrderBy." ;";
	//echo $strSQL1;//2013
    $RSA=mysqli_query($DBO,$strSQL)or die(mysqli_error());
	
?>
         <tr>
           <td width="20%" bgcolor="#C6D6E8" height="20"><font color="#800000"><B>Libell�</B></font></td>
           <td width="10%" bgcolor="#C6D6E8" height="20"><font color="#800000"><b>Ordre</b></font></td>
           <td width="20%" bgcolor="#C6D6E8" height="20"><font color="#800000"><b>Type</b></font></td>
           <td width="20%" bgcolor="#C6D6E8" height="20"><font color="#800000"><b>Description</b></font></td>
           <td width="30%" bgcolor="#C6D6E8" height="20"><font color="#800000"><b>Action</b></font></td>
          </tr>
          <?php     while(($dataRSA=mysqli_fetch_array($RSA)))
          {
          ?>
              <tr bgcolor="#EEF2F9">
                <td> <?php       echo $dataRSA["srubLibelle"] ;?></td>
                <td> <?php       echo $dataRSA["sruborder"];?></td>
                <td> <?php       echo $dataRSA["srubTYPE"];?></td>
                <td> <?php       echo $dataRSA["srubdesc"];?></td>
                <td>
                <a href="AdminDBADMsubrubs.php?mode=edit&frmid=<?php       echo $dataRSA[$TableKey];?>&frmidxid=<?php       echo $qryidxid;?>"><IMG border="0" SRC="images/bt_modif.gif" alt="Modifier"></a>
                <a href="javascript:confirmDelete('AdminDBADMsubrubs.php?mode=sup&frmid=<?php       echo $dataRSA[$TableKey];?>&frmidxid=<?php       echo $qryidxid;?>')"><IMG border="0" SRC="images/bt_supp.gif" alt="Supprimer"></a>
                </td>
              </tr>
          <?php    
		  } 
              $RSA=NULL;$dataRSA=NULL;
	     ;?>
         <tr bgcolor="#C6D6E8">
         <td colspan="4">&nbsp;</td>
         <td><a href="AdminDBADMsubrubs.php?mode=add&frmidxid=<?php     echo $qryidxid;?>"><IMG border="0" SRC="images/bt_add.gif" alt="Ajouter"></a></td>
         </tr>
         <?php   } 
		?>
</table>
<?php   
} 
function edit()
{$DBO =new mysqli("localhost", "dcstecgr_artcomu", "artcom2015artcom","dcstecgr_webdbfr");

    if ($DBO -> connect_errno) {
        echo "Failed to connect to MySQL: " . $DBO -> connect_error;
        exit();
    }
    mysqli_select_db($DBO,'dcstecgr_webdbfr');
  extract($GLOBALS);

//'''''''''''''''''''''''''
// MASK EDIT DB RECORDS
//'''''''''''''''''''''''''
  $strSQL="SELECT * from ".$TableName." Where ".$TableKey."=".$qryid.";";
  $RSA=mysqli_query($DBO,$strSQL);
  $dataRSA=mysqli_fetch_array($RSA);
  ?>
  
<form method="GET" action="AdminDBADMsubrubs.php?frmidxid=<?php   echo $qryidxid;?>" name="theform" onSubmit="return validatetheform()" enctype="multipart/form-data"><input type="hidden" name="MAX_FILE_SIZE" value="100000000000" />       
                  <table border="0" width="100%" bgcolor="#A4BCDD" cellspacing="1">
                    <tr>
                      <td width="30%" bgcolor="#C6D6E8"><b><font color="#800000">Libell�</font></b></td>
                      <td width="70%" bgcolor="#FFFFFF"><input type="text" maxlength="50" name="frmsrublibelle" size="30" value=" <?php   echo $dataRSA["srubLibelle"];?> "></td>
                    </tr>
                    <tr>
                      <td bgcolor="#C6D6E8"><font color="#800000"><b>Ordre</b></font></td>
                      <td bgcolor="#FFFFFF"><input type="text" maxlength="4" onkeypress="event.returnValue=IsDigit();" name="frmsruborder" size="30" value="<?php echo $dataRSA["sruborder"];?>"/></td>
                    </tr>
                    <tr>
                      <td bgcolor="#C6D6E8"><font color="#800000"><b>Type</b></font></td>
                      <td bgcolor="#FFFFFF">
                      <select name="frmsrubtype" size=1 class="SELECTCLASS">
                        <?php   if ($dataRSA["srubTYPE"]=="DOC")
  {
 ?>
   <option selected value="DOC">Document</option>
   <option value="PRO">Produits</option>
                        <option value="LINK">Lien</option>
                        <?php   }
    else
  {
?>
                        <option value="DOC">Document</option>
                          <option value="PRO">Produits</option>
                        <option selected value="LINK">Lien</option>
                        <?php   } ?>
                      </select>
                      </td>
                    </tr>
             <!-- <tr><td>Images</td><td><input type="file" name="frmimge"  value="<?php   echo $dataRSA["srubimg"];?>"></td></tr>        -->
                    <tr>
                      <td bgcolor="#C6D6E8"><font color="#800000"><b>Description</b></font></td>
                      <td bgcolor="#FFFFFF"><textarea rows=3 name="frmsrubdesc" cols=30><?php   echo $dataRSA["srubdesc"];?></textarea></td>
                    </tr>
                    <tr>
                      <td bgcolor="#C6D6E8" colspan="2">
                      <input type="image" border="0" class="noborders"  SRC="images/bt_validate.gif" alt="Valider" id=image1 name=image1>&nbsp;
                       <a href="AdminDBADMsubrubs.php?frmidxid=<?php   echo $qryidxid;?>"><IMG border="0" SRC="images/bt_cancel.gif" alt="Annuler"></a>
                      </td>
                    </tr>
                  </table>
                  <input type=hidden name="mode" value="update">
                  <input type=hidden name="frmid" value="<?php   echo $dataRSA[$TableKey];?>">
    </form> 
    <?php   $RSA=NULL;$dataRSA=NULL;
   //return $function_ret;
} 
 function add()
{
  extract($GLOBALS);
?>
        <form method="GET" action="AdminDBADMsubrubs.php?frmidxid=<?php   echo $qryidxid;?>" name="theform" onSubmit="return validatetheform()" enctype="multipart/form-data"><input type="hidden" name="MAX_FILE_SIZE" value="100000000000" />      
      <table border="0" width="100%" bgcolor="#A4BCDD" cellspacing="1">
                    <tr>
                      <td width="30%" bgcolor="#C6D6E8"><b><font color="#800000">Libell�</font></b></td>
                      <td width="70%" bgcolor="#FFFFFF"><input type="text" maxlength="50" name="frmsrublibelle" size="30" value=""></td>
                    </tr>
                    <tr>
                      <td bgcolor="#C6D6E8"><font color="#800000"><b>Ordre</b></font></td>
                      <td bgcolor="#FFFFFF"><input type="text"  maxlength="4" onkeypress="event.returnValue=IsDigit();" name="frmsruborder" size="30" value=""/></td>
                    </tr>
                    <tr>
                      <td bgcolor="#C6D6E8"><font color="#800000"><b>Type</b></font></td>
                      <td bgcolor="#FFFFFF">
                      <select name="frmsrubtype" size=1 class="SELECTCLASS">
                        <option selected value="DOC">Document</option>
                        <option value="PRO">Produits</option>
                        <option value="LINK">Lien</option>
                      </select>
                      </td>
                    </tr>
                     <tr><td>Images</td><td><input type="file" name="frajoutmimge"  /></td></tr> 

                    <tr>
                      <td bgcolor="#C6D6E8"><font color="#800000"><b>Description</b></font></td>
                      <td bgcolor="#FFFFFF"><textarea rows=3 name="frmsrubdesc" cols=30></textarea></td>
                    </tr>
                    <tr>
                      <td bgcolor="#C6D6E8" colspan="2">
                      <input type="image" border="0" class="noborders"  SRC="images/bt_validate.gif" alt="Valider" id=image1 name=image1>&nbsp;
                       <a href="AdminDBADMsubrubs.php?frmidxid=<?php   echo $qryidxid;?>"><IMG border="0" SRC="images/bt_cancel.gif" alt="Annuler"></a>
                      </td>
                    </tr>
                  </table>
                  <input type=hidden name="mode" value="addnew">
                  <input type="hidden" name="vall" value="<?php echo $qryidxid;  ?>">
        </form> 
<?php  // return $function_ret;
} 
function update()
{ 
  $DBO =new mysqli("localhost", "dcstecgr_artcomu", "artcom2015artcom","dcstecgr_webdbfr");

  if ($DBO -> connect_errno) {
    echo "Failed to connect to MySQL: " . $DBO -> connect_error;
    exit();
}
mysqli_select_db($DBO,'dcstecgr_webdbfr');

    if ($DBO -> connect_errno) {
        echo "Failed to connect to MySQL: " . $DBO -> connect_error;
        exit();
    }
    mysqli_select_db($DBO,'dcstecgr_webdbfr');
 /////////if(isset($_FILES['frmimge']))
 ////////{ 
   echo "ok";
   echo "SVP insert  l'image de ce document";
   /////echo "<br>".$qryid = $_GET["frmimge"];
   unset($erreur);
   $extensions_ok = array('png', 'gif', 'jpg', 'jpeg');
   $taille_max = 1000000000000;
   $dest_dossier = '../images/';
   /*if( !in_array( substr(strrchr($_FILES['frmimge']['name'], '.'), 1), $extensions_ok) )
   {
    $erreur = 'Veuillez s&eacute;lectionner un fichier de type png, gif ou jpg !';
   }
   elseif (file_exists($_FILES['frmimge']['tmp_name'])and filesize($_FILES['frmimge']['tmp_name']) > $taille_max)
   {
    $erreur = 'Votre fichier doit faire moins de 5000Ko !';
   }*/
   if(!isset($erreur))
   {
   /* $dest_fichier = basename($_FILES['frmimge']['name']);
    $dest_fichier = strtr($dest_fichier,'����������������������������������������������������','AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
    $dest_fichier = preg_replace('/([^.a-z0-1]+)/i', '_', $dest_fichier);
    $poiuy=$_FILES['frmimge']['tmp_name'];
    move_uploaded_file($poiuy,$dest_dossier.$dest_fichier);
    $pro=$dest_dossier.$dest_fichier;
    echo $pro;*/
  // $strSQL="UPDATE ".$TableName." SET srubLibelle='".$_POST["frmsrublibelle"]."',sruborder =".$_POST["frmsruborder"].",srubTYPE='".$_POST["frmsrubtype"]."',srubimg='".$pro.",srubdesc='".$_POST["frmsrubdesc"]."' Where ".$TableKey."=".$qryid. ";";
    //echo $strSQL;
    $TableName="m_sousrubrique";
    $TableKey="srubID";
    // herre 
    $strSQL = "UPDATE $TableName SET srubLibelle =?, sruborder =?, srubTYPE =?, srubdesc =? WHERE $TableKey =? ";

$stmt = mysqli_prepare($DBO, $strSQL);


if ($stmt) {
  $stmt->bind_param("ssssi", $_GET["frmsrublibelle"],
  $_GET["frmsruborder"],
  $_GET["frmsrubtype"],
  $_GET["frmsrubdesc"],
  $_GET["frmid"]);
   /* mysqli_stmt_bind_param($stmt, 'ssssi',
    $_GET["frmsrublibelle"],
    $_GET["frmsruborder"],
    $_GET["frmsrubtype"],
    $_GET["frmsrubdesc"],
    $_GET["frmid"]
    );*/
    mysqli_stmt_execute($stmt);
    // Check for successful update
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        // Update successful
      
    } else {
        //   "Update failed";
       
    }

    mysqli_stmt_close($stmt);
 
} else {
    // Error in preparing the statement
    // Handle the error as needed
}
    extract($GLOBALS);

  
    //$RSA=mysqli_query($DBO,$strSQL);
    $RSA=NULL;
  
    //$RSA=NULL;
    echo "<html><script language=\"javascript\">location.href='AdminDBADMsubrubs.php?frmidxid=".$qryidxid."'</script></html>";
   }
 ////// // }
}
function addnew()
{$DBO =new mysqli("localhost", "dcstecgr_artcomu", "artcom2015artcom","dcstecgr_webdbfr");

    if ($DBO -> connect_errno) {
        echo "Failed to connect to MySQL: " . $DBO -> connect_error;
        exit();
    }
    mysqli_select_db($DBO,'dcstecgr_webdbfr');
  extract($GLOBALS);
  /*if(isset($_FILES['frajoutmimge']))
 { 
   echo "ok";
   echo "SVP insert  l'image de ce document";
   echo "<br>".$qryid;
   unset($erreur);
   $extensions_ok = array('png', 'gif', 'jpg', 'jpeg');
   $taille_max = 1000000000000;
   $dest_dossier = '../images/';
   if( !in_array( substr(strrchr($_FILES['frajoutmimge']['name'], '.'), 1), $extensions_ok) )
   {
    $erreur = 'Veuillez s&eacute;lectionner un fichier de type png, gif ou jpg !';
   }
   elseif (file_exists($_FILES['frajoutmimge']['tmp_name'])and filesize($_FILES['frajoutmimge']['tmp_name']) > $taille_max)
   {
    $erreur = 'Votre fichier doit faire moins de 5000Ko !';
   }
   if(!isset($erreur))
   {
    $dest_fichier = basename($_FILES['frajoutmimge']['name']);
    $dest_fichier = strtr($dest_fichier,'����������������������������������������������������','AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
    $dest_fichier = preg_replace('/([^.a-z0-1]+)/i', '_', $dest_fichier);
    $poiuy=$_FILES['frajoutmimge']['tmp_name'];
    move_uploaded_file($poiuy,$dest_dossier.$dest_fichier);
    $pro=$dest_dossier.$dest_fichier;
	*/
    $strSQL="INSERT INTO  ".$TableName."  (srublibelle,sruborder,srubtype,srubdesc,".$ITableKey.")VALUES ('".$_GET["frmsrublibelle"]."',".$_GET["frmsruborder"].",'".$_GET["frmsrubtype"]."','".$_GET["frmsrubdesc"]. "',".$vale.");";		
    //echo $strSQL;
    $RSA=mysqli_query($DBO,$strSQL);
    $RSA=NULL;
    echo "<html><script language=\"javascript\">location.href='AdminDBADMsubrubs.php?frmidxid=".$vale."'</script></html>";
   //}
  }

function sup()
{
  $DBO =new mysqli("localhost", "dcstecgr_artcomu", "artcom2015artcom","dcstecgr_webdbfr");

    if ($DBO -> connect_errno) {
        echo "Failed to connect to MySQL: " . $DBO -> connect_error;
        exit();
    }
    mysqli_select_db($DBO,'dcstecgr_webdbfr');
  extract($GLOBALS);

  $confdelete=true;
// verify integrity 1
  $strSQL="SELECT * from ".$RTableName1." Where ".$RTableKey1."=".$qryid.";";
  $RSA=mysqli_query($DBO,$strSQL);
  
  if ($dataRSA=mysqli_fetch_array($RSA))//(!$RSA->eof)
  {
    $confdelete=false;
  } 
  $RSA=NULL;

  if ($RTableName2!="")
  {

// verify integrity 2
    $strSQL="SELECT * from ".$RTableName2." Where ".$RTableKey2."=".$qryid.";";
    $RSA=mysqli_query($DBO,$strSQL);
	if ($dataRSA=mysqli_fetch_array($RSA))//(!$RSA->eof)
    {
      $confdelete=0;
    } 
    $RSA=NULL;
  } 


  if ($confdelete)
  {

// del
  //  $strSQL="SELECT * from ".$TableName." Where ".$TableKey."=".$qryid.";";
	$strSQL="DELETE from ".$TableName." Where ".$TableKey."=".$qryid.";";
    $RSA=mysqli_query($DBO,$strSQL);
    //$RSA->delete;
    $RSA=NULL;
	/*$plki="?frmidxid=";
	$poer="AdminDBADMsubrubs.php".$plki.$qryidxid;*/
    header("Location: AdminDBADMsubrubs.php?frmidxid=".$qryidxid);
  }
    else
  {

    $AdminMessage="Impossible de supprimer cette ligne car elle comprend des enregistrements connexes.";
  } 


  //return $function_ret;
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
		<TD BGCOLOR=""> <!--?php echo $tempRoundedColor;?-->
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
<?php 

admfoot();

?>