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
                      <td width="5%"><img border="0" src="images/icon_screen.gif" width="38" height="36">
                      </td>
                      <td width="95%" valign="bottom" class="titles">
                      <font color="#1A62B0"><b>L�arborescence >> </b></font>
                      <font color="#008000"><b>rubriques</b></font></td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td width="100%">   
<?php
if(isset ($_GET["mode"])){$qrymode=$_GET["mode"];}else{$qrymode=NULL;}
if(isset ($_GET["frmid"])){$qryid=$_GET["frmid"];}else{$qryid=NULL;}
if(isset ($_GET["frmidxid"])){$qryidxid=$_GET["frmidxid"];} else{$qryidxid=NULL;}

$TableName="m_rubrique";
$TableKey="rubid";
$OrderBy="ruborder";

// Index Table ( Relation Table )
$ITableName="m_categorie";
$ITableKey="catid";
$ITableTitle="catlibelle";
$IOrderBy="catorder";
// related table (integrity) ( 2 table ) for delete
$RTableName1="documents";
$RTableKey1="rubid";
$RTableName2="links";
$RTableKey2="rubid";
$RTableName3="m_sousrubrique";
$RTableKey3="rubid";

//  verif privilege 
if ($_SESSION['ADMINPROFIL']!="AD")
{

  $AdminMessage="Acc�s non autoris� <br>( vous n'avez pas de privil�ges pour cette rubrique )";
}
  else
{


  switch ($qrymode)
  {
    case "":Previewdb();break;
    case "view":$view;break;
    case "edit":edit();break;
    case "add":add(); break;
    case "sup":sup(); break;
    case "update":update();break;
    case "addnew":addnew();break;
  } 

} 


?>
<SCRIPT LANGUAGE="javascript">
function validatetheform()
{ 
 if (document.theform.frmrublibelle.value=='')
  {
 alert ('Libell� manquant !');
 document.theform.frmrublibelle.focus();
 return false;
  }
   
 if ( isNaN(parseInt(document.theform.frmruborder.value,10))) 
{ alert ('Ordre manquant ou invalide') ; document.theform.frmruborder.focus() ; 
 return false ; 
}

  document.theform.frmruborder.value=parseInt(document.theform.frmruborder.value,10);
  return true;

}  
</SCRIPT>
<?php function Previewdb()
{
  extract($GLOBALS);
  if ($SubRubActive)
  {
    $srubcolspan=5;
  }
    else
  {
    $srubcolspan=4;
	//"
  } ?>

<table border="0" width="100%" bgcolor="#A4BCDD" cellpadding="2" cellspacing="1">
         <tr>
               <td width="40%" bgcolor="#C6D6E8" colspan="6">
               <font color="#800000"><b>S�lectionnez la section:</b></font><br>
               <form name="Sfrom">
               <select name="frmidxid" size="5" class="SELECTCLASS" onChange="goidx(this.options[selectedIndex].value,'<?php  echo thisscript();?>')">
                            <?php   if ($qryidxid=="-1" || $qryidxid=="")
  {
// if catid empty ?>
                            <option selected value="-1">[ S�lection ]</option>
                            <?php   }
    else
  {
?>
                            <option value="-1">[ S�lection ]</option>
                            <?php   } 
                            
  $strSQL="SELECT * from ".$ITableName." ORDER BY ".$IOrderBy." ;";
  $RSA=mysqli_query($DBO,$strSQL);
  while (($resul=mysqli_fetch_array($RSA)))
  {
?>
                            <option value="<?php     echo $resul[$ITableKey];?>" <?php     if ($qryidxid==($resul[$ITableKey]))
    {
      echo "selected";
    } ?>><?php     echo $resul[$ITableTitle];?></option>
	
	
	<?php   
  } 
  $RSA=Null;
  $resul=Null;
?>   
                 </select>   
                 </form>             
         </td></tr>
         <?php   if (!($qryidxid=="-1" || $qryidxid==""))
  {
// if index selected  ?>  
         <?php 
    $strSQL="SELECT * from ".$TableName." WHERE ".$ITableKey."=".$qryidxid." ORDER BY ".$orderby." ;";
    $RSA=mysqli_query($DBO,$strSQL);
	?>
         <tr>
           <td width="20%" bgcolor="#C6D6E8" height="20"><font color="#800000"><B>Libell�</B></font></td>
           <td width="10%" bgcolor="#C6D6E8"><font color="#800000"><b>Ordre</b></font></td>
          <?php     if ($SubRubActive)
    {
?>
		   <td width="7%" bgcolor="#C6D6E8"><font color="#800000"><b>Type</b></font></td>
		   <td width="13%" bgcolor="#C6D6E8"><font color="#800000"><b>Sous-rubrique?</b></font></td>
           <?php    }
      else
    {
?>
		   <td width="20%" bgcolor="#C6D6E8"><font color="#800000"><b>Type</b></font></td>
		   <?php     } ?>
		   <td width="20%" bgcolor="#C6D6E8"><font color="#800000"><b>Description</b></font></td>
           <td width="30%" bgcolor="#C6D6E8"><font color="#800000"><b>Action</b></font></td>
          </tr>
          <?php     while($resll=mysqli_fetch_array($RSA))
    {
?>
              <tr bgcolor="#EEF2F9">
                <td> <?php       echo $resll["rublibelle"];?></td>
                <td> <?php       echo $resll["ruborder"];?></td>
                <td> <?php       echo $resll["rubtype"];?></td>
                <?       if ($SubRubActive)
      {
?>
				<td> <font color="#800000"><?         echo boolview($resll["rubopen"]);?></font></td>
				<?       } ?>
                <td> <?       echo $resll["rubdesc"];?></td>
                <td>
                <a href="<?php       echo thisscript();?>?mode=edit&frmid=<?php       echo $resll[$TableKey];?>&frmidxid=<?php      echo $qryidxid;?>"><IMG border="0" SRC="images/bt_modif.gif" alt="Modifier"></a>
                <a href="javascript:confirmDelete('<?php       echo thisscript();?>?mode=sup&frmid=<?php       echo $RSA[$TableKey];?>&frmidxid=<?php       echo $qryidxid;?>')"><IMG border="0" SRC="images/bt_supp.gif" alt="Supprimer"></a>
                </td>
              </tr>
              
         <?php     }
            $RSA=NULL;
			?>
         <tr bgcolor="#C6D6E8">
         <td colspan="<?php     echo $srubcolspan;?>">&nbsp;</td>
         <td><a href="<?php     echo thisscript();?>?mode=add&frmidxid=<?php     echo $qryidxid;?>"><IMG border="0" SRC="images/bt_add.gif" alt="Ajouter"></a></td>
         </tr>
         <?php   } ?>
</table>
<?php   
} ?>

<?php function edit()
{
  extract($GLOBALS);
 
//'''''''''''''''''''''''''
// MASK EDIT DB RECORDS
//'''''''''''''''''''''''''
  $strSQL="SELECT * from ".$TableName." Where ".$TableKey."=".$qryid.";";
  $RSA=mysqli_query($DBO,$strSql);
?>
        <form method="POST" action="<?php   echo thisscript();?>?frmidxid=<?php   echo $qryidxid;?>" name="theform" onSubmit="return validatetheform()">   
                  <table border="0" width="100%" bgcolor="#A4BCDD" cellspacing="1">
                    <tr>
                      <td width="30%" bgcolor="#C6D6E8"><b><font color="#800000">Libell�</b></font></td>
                      <td width="70%" bgcolor="#FFFFFF"><input type="text" maxlength="50" name="frmrublibelle" size="30" value="<?   echo $RSA["rublibelle"];?>"></td>
                    </tr>
                    <tr>
                      <td bgcolor="#C6D6E8"><font color="#800000"><b>Ordre</b></font></td>
                      <td bgcolor="#FFFFFF"><input type="text" onkeypress="event.returnValue=IsDigit();" maxlength="4" onkeypress="event.returnValue=IsDigit();" name="frmruborder" size="30" value="<?   echo $RSA["ruborder"];?>"></td>
                    </tr>
                    <tr>
                      <td bgcolor="#C6D6E8"><font color="#800000"><b>Type</b></font></td>
                      <td bgcolor="#FFFFFF">
                      <select name="frmrubtype" size=1 class="SELECTCLASS">
                        <?php   if ($RSA["rubtype"]=="DOC")
  {
?>
                        <option selected value="DOC">Document</option>
                        <option value="LINK">Lien</option>
                        <?php   }
    else
  {
?>
                        <option value="DOC">Document</option>
                        <option selected value="LINK">Lien</option>
                        <?php   } ?>
                      </select>
                      </td>
                    </tr>
                    <?php   if ($SubRubActive)
  {
?>
					<tr>
                      <td bgcolor="#C6D6E8"><font color="#800000"><b>Ouvrir sous-rubriques?</b></font></td>
                      <td bgcolor="#FFFFFF">
					    <?php     if ($RSA["rubopen"])
    {
?>
                       <input type="radio" class="noborders" value="-1" checked name="frmrubopen">Oui 
					   <input type="radio" class="noborders" value="0"  name="frmrubopen">Non
                        <?php     }
      else
    {
?>
                       <input type="radio" class="noborders" value="-1" name="frmrubopen">Oui 
					   <input type="radio" class="noborders" value="0"  checked name="frmrubopen">Non
                        <?php     } ?>
					  </td>
                    </tr>
					<?php   }
    else
  {
?>
					 <input type="hidden" value="0"  name="frmrubopen">
					<?php   } ?>
                    <tr>
                      <td bgcolor="#C6D6E8"><font color="#800000"><b>Description</b></font></td>
                      <td bgcolor="#FFFFFF"><textarea rows=3 name="frmrubdesc" cols=30><?   echo $RSA["rubdesc"];?></textarea></td>
                    </tr>
                    <tr>
                      <td bgcolor="#C6D6E8" colspan="2">
                      <input type="image" border="0" class="noborders"  SRC="images/bt_validate.gif" alt="Valider" id=image1 name=image1>&nbsp;
                       <a href="<?php   echo thisscript();?>?frmidxid=<?php   echo $qryidxid;?>"><IMG border="0" SRC="images/bt_cancel.gif" alt="Annuler"></a>
                      </td>
                    </tr>
                  </table>
                  <input type=hidden name="mode" value="update">
                  <input type=hidden name="frmid" value="<?php   echo $RSA[$TableKey];?>">
    </form> 
    <?php   $RSA->close;?>
<?php   return $function_ret;
}
 function add()
{
  extract($GLOBALS); 
//'''''''''''''''''''''''''
// MASK ADD NEW DB RECORDS
//'''''''''''''''''''''''''
?>
        <form method="POST" action="<?php   echo thisscript();?>?frmidxid=<?php   echo $qryidxid;?>" name="theform" onSubmit="return validatetheform()">   
      <table border="0" width="100%" bgcolor="#A4BCDD" cellspacing="1">
                    <tr>
                      <td width="30%" bgcolor="#C6D6E8"><b><font color="#800000">Libell�</b></font></td>
                      <td width="70%" bgcolor="#FFFFFF"><input type="text" maxlength="50" name="frmrublibelle" size="30" value=""></td>
                    </tr>
                    <tr>
                      <td bgcolor="#C6D6E8"><font color="#800000"><b>Ordre</b></font></td>
                      <td bgcolor="#FFFFFF"><input type="text" onkeypress="event.returnValue=IsDigit();" maxlength="4" onkeypress="event.returnValue=IsDigit();" name="frmruborder" size="30" value=""></td>
                    </tr>
                    <tr>
                      <td bgcolor="#C6D6E8"><font color="#800000"><b>Type</b></font></td>
                      <td bgcolor="#FFFFFF">
                      <select name="frmrubtype" size=1 class="SELECTCLASS">
                        <option selected value="DOC">Document</option>
                        <option value="LINK">Lien</option>
                      </select>
                      </td>
                    </tr>
                    <?php   if ($SubRubActive)
  {
?>
					<tr>
                      <td bgcolor="#C6D6E8"><font color="#800000"><b>Ouvrir sous-rubriques?</b></font></td>
                      <td bgcolor="#FFFFFF">
                       <input type="radio" class="noborders" value="-1" name="frmrubopen">Oui 
					   <input type="radio" class="noborders" value="0"  checked name="frmrubopen">Non
					  </td>
                    </tr>
					<?php   }
    else
  {
?>
					 <input type="hidden" value="0"  name="frmrubopen">
					<?php   } ?>
                    <tr>
                      <td bgcolor="#C6D6E8"><font color="#800000"><b>Description</b></font></td>
                      <td bgcolor="#FFFFFF"><textarea rows=3 name="frmrubdesc" cols=30></textarea></td>
                    </tr>
                    <tr>
                      <td bgcolor="#C6D6E8" colspan="2">
                      <input type="image" border="0" class="noborders"  SRC="images/bt_validate.gif" alt="Valider" id=image1 name=image1>&nbsp;
                       <a href="<?php   echo thisscript();?>?frmidxid=<?php   echo $qryidxid;?>"><IMG border="0" SRC="images/bt_cancel.gif" alt="Annuler"></a>
                      </td>
                    </tr>
                  </table>
                  <input type=hidden name="mode" value="addnew">
        </form> 
<?php
   return $function_ret;
} 

 
function update()
{
  extract($GLOBALS);

// update rec

  $strSQL="SELECT * from ".$TableName." Where ".$TableKey."=".$qryid.";";
  $RSA=mysqli_query($DBO,$strSql);
  $RSA["rublibelle"]=$_POST["frmrublibelle"];
  $RSA["ruborder"]=$_POST["frmruborder"];
  $RSA["rubtype"]=$_POST["frmrubtype"];
  $RSA["rubopen"]=$_POST["frmrubopen"];
  $RSA["rubdesc"]=$_POST["frmrubdesc"];

 // $RSAUpdate;
  $RSA=NULL;
  $vbbbv='?frmidxid=';
  $chai=thisscript($vbbbv.$qryidxid);
  echo 	'<html><script language="javascript">location.href='.$chai.'</script></html>';

  return $function_ret;
} 

function addnew()
{
  extract($GLOBALS);

// addnew rec
  $strSQL="SELECT top 1 * from ".$TableName." ;";
  $RSA=mysqli_query($DBO,$strSql);
  /****  insertion***/
  $RSA["rublibelle"]=$_POST["frmrublibelle"];
  $RSA["ruborder"]=$_POST["frmruborder"];
  $RSA["rubtype"]=$_POST["frmrubtype"];
  $RSA["rubopen"]=$_POST["frmrubopen"];
  $RSA["rubdesc"]=$_POST["frmrubdesc"];
  $RSA[$ITableKey]=$qryidxid;

  //$RSA->Update();

  $RSA=NULL;
  $vrttt="?frmidxid=";
  $vtrerer=thisscript($vrttt.$qryidxid);
  echo "<html><script language=\"javascript\">location.href='".$vtrerer."'</script></html>";
//Response.Redirect (thisscript)
  return $function_ret;
} 

function sup()
{
  extract($GLOBALS);

  $confdelete=true;
// verify integrity 1
  $strSQL="SELECT * from ".$RTableName1." Where ".$RTableKey1."=".$qryid.";";
  $RSA=mysqli_query($DBO,$strSql);
  if (!$RSA->eof)
  {
    $confdelete=false;
  } 
  $RSA=NULL;

  if ($RTableName2!="")
  {

// verify integrity 2
    $strSQL="SELECT * from ".$RTableName2." Where ".$RTableKey2."=".$qryid.";";
    $RSA=mysqli_query($DBO,$strSql);
    if (!$RSA->eof)
    {
      $confdelete=false;
    } 
    $RSA=NULL;
  } 


  if ($RTableName3!="")
  {

// verify integrity 3
    $strSQL="SELECT * from ".$RTableName3." Where ".$RTableKey3."=".$qryid.";";
    $RSA=mysqli_query($DBO,$strSql );
    if (!$RSA->eof)
    {
      $confdelete=false;
    } 
    $RSA=NULL;
  } 



  if ($confdelete)
  {

// del
    $strSQL="SELECT * from ".$TableName." Where ".$TableKey."=".$qryid.";";
    $RSA=mysqli_query($DBO,$strSql);
    //$RSA->delete;
    $RSA=Null;
	$jjjjjjj="?frmidxid=";
	$jjjjjk=thisscript($jjjjjjj.$qryidxid);
    header("Location: ".$jjjjjk);
  }
    else
  {

    $AdminMessage="Impossible de supprimer cette ligne car elle comprend des enregistrements connexes.";
  } 


  return $function_ret;
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


