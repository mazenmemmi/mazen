<?php
  session_start();
  session_register("ADMINPROFIL_session");
  session_register("ADMINUSERNAME_session");
  session_register("ADMINACESS_session");
  session_register("ADMINUSERLOGGED_session");
  session_register("ADMINUSERID_session");

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
		<TD BGCOLOR="<? echo $tempRoundedColor;?>">
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
                      <font color="#008000"><b>Sous-rubriques</b></font></td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td width="100%">
<!-- End Win Head -->    

<!-- content -->     
<? 

$qrymode=${"mode"};
$qryid=${"frmid"};
$qryidxid=${"frmidxid"};
$qryidx0id=${"frmidx0id"};

$TableName="m_sousrubrique";
$TableKey="srubid";
$OrderBy="sruborder";
$ViewFields=" * ";

// Index Table ( Relation Table )
$ITableName="m_rubrique";
$ITableKey="rubid";
$ITableTitle="rublibelle";
$IOrderBy="ruborder";
$ICriteria="And rubtype='DOC' AND rubopen = -1";

// Related to Index Table ( Relation Table )
$ITableName0="m_categorie";
$ITableKey0="catid";
$ITableTitle0="catlibelle";
$IOrderBy0="catorder";

// related table (integrity) ( 2 table ) for delete
$RTableName1="documents";
$RTableKey1="srubid";
$RTableName2="links";
$RTableKey2="srubid";

// get idx0 from idx
if ($qryidxid!="")
{

  $strSQL="SELECT top 1 * from ".$ITableName." where ".$ITableKey."='".$qryidxid." ';";
  $RSA->Open($strSQL,  $DBO , $adOpenStatic , $adLockReadOnly);
  $qryidx0id=($RSA[$ITableKey0]);
  $RSA->Close();
} 



//  verif privilege 
if ($_SESSION['ADMINPROFIL']!="AD")
{

  $AdminMessage="Accés non autorisé <br>( vous n'avez pas de priviléges pour cette rubrique )";
}
  else
{


  switch ($qrymode)
  {
    case "":
      break;
    case "":
      Previewdb();
      break;
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
<? function Previewdb()
{
  extract($GLOBALS);
?>

<table border="0" width="100%" bgcolor="#A4BCDD" cellpadding="2" cellspacing="1">
         <tr>
         <td bgcolor="#C6D6E8" colspan="5">
         <form name="Sfrom">
         <table  cellpadding="2" cellspacing="1"  width="100%" border="0">
          <tr><td width="10%">
               <font color="#800000"><b>S�lectionnez la section:</b></font><br>
               <select name="frmidx0id" size="5" class="SELECTCLASS" onChange="goidx0(this.options[selectedIndex].value,'<?   echo thisscript();?>')">
                            <?   if ($qryidx0id=="-1" || $qryidx0id=="")
  {
// if catid empty ?>
                            <option selected value="-1">[ S�lection ]</option>
                            <?   }
    else
  {
?>
                            <option value="-1">[ S�lection ]</option>
                            <?   } ?>
                            <? 
  $strSQL="SELECT * from ".$ITableName0." ORDER BY ".$IOrderBy0." ;";
  $RSA->Open($strSQL , $DBO , $adOpenStatic , $adLockReadOnly);
  while(!$RSA->EOF)
  {
?>
                            <option value="<?     echo $RSA[$ITableKey0];?>" <?     if ($qryidx0id==($RSA[$ITableKey0]))
    {
      print "selected";
    } ?>><?     echo $RSA[$ITableTitle0];?></option>
                            <?     $RSA->Movenext;
  } 
  $RSA->close;
?>   
                 </select> 
                 </td>
                  <?   if ((!($qryidx0id=="-1" || $qryidx0id=="")))
  {
?>
                  <? // if index0 selected ( foreing key )   ?>
		         <td width="90%"><font color="#800000"><b>S�lectionnez la rubrique:</b></font><br>
	             <select name="frmidxid" size="5" class="SELECTCLASS" onChange="goidx(this.options[selectedIndex].value,'<?     thisscript();?>')">
                   <?     if ($qryidxid=="-1" || $qryidxid=="")
    {
?>
		             <option selected value="-1">[S�lection]</option>           
		           <?     }
      else
    {
?> 
		             <option value="-1">[S�lection]</option>
		           <?     } ?> 
		          <? 
    $strsql="SELECT * from ".$ITableName." WHERE ".$ITableKey0."=".$qryidx0id." ".$ICriteria." ORDER BY ".$IOrderBy." ;";
    $RSA->Open($strSQL ,   $DBO  ,  $adOpenStatic  ,  $adLockReadOnly);
    if (($RSA->recordcount!=0))
    {

      while(!$RSA->EOF)
      {
?>
                          <option value="<?         echo $RSA[$ITableKey];?>" <?         if ($qryidxid==($RSA[$ITableKey]))
        {
          print "selected";
        } ?>><?         echo $RSA[$ITableTitle];?></option>
                          <?         $RSA->Movenext;
      } 
    }
      else
    {

      print "<option value=\"-1\" >--Pas de rubriques ouvrable--</option>";
    } 

    $RSA->close;
?>                              
                 </select>         
                 </td>
                 <?   } ?> 
             </tr>
        </table>
       </form>    
         </td></tr>       
         <?   if (!($qryidxid=="-1" || $qryidxid==""))
  {
// if index selected  ?>  
         <? 
    $strSQL="SELECT * from ".$TableName." WHERE ".$ITableKey."=".$qryidxid." ORDER BY ".$orderby." ;";
    $RSA->Open($strSQL   , $DBO  ,  $adOpenStatic,    $adLockReadOnly);
?>
         <tr>
           <td width="20%" bgcolor="#C6D6E8" height="20"><font color="#800000"><B>Libell�</B></font></td>
           <td width="10%" bgcolor="#C6D6E8" height="20"><font color="#800000"><b>Ordre</b></font></td>
           <td width="20%" bgcolor="#C6D6E8" height="20"><font color="#800000"><b>Type</b></font></td>
           <td width="20%" bgcolor="#C6D6E8" height="20"><font color="#800000"><b>Description</b></font></td>
           <td width="30%" bgcolor="#C6D6E8" height="20"><font color="#800000"><b>Action</b></font></td>
          </tr>
          <?     while(!$RSA->EOF)
    {
?>
              <tr bgcolor="#EEF2F9">
                <td> <?       echo $RSA["srublibelle"];?></td>
                <td> <?       echo $RSA["sruborder"];?></td>
                <td> <?       echo $RSA["srubtype"];?></td>
                <td> <?       echo $RSA["srubdesc"];?></td>
                <td>
                <a href="<?       echo thisscript();?>?mode=edit&frmid=<?       echo $RSA[$TableKey];?>&frmidxid=<?       echo $qryidxid;?>"><IMG border="0" SRC="images/bt_modif.gif" alt="Modifier"></a>
                <a href="javascript:confirmDelete('<?       echo thisscript();?>?mode=sup&frmid=<?       echo $RSA[$TableKey];?>&frmidxid=<?       echo $qryidxid;?>')"><IMG border="0" SRC="images/bt_supp.gif" alt="Supprimer"></a>
                </td>
              </tr>
              <?       $RSA->MoveNext;?>
         <?     } ?>
         <?     $RSA->close;?>
         <tr bgcolor="#C6D6E8">
         <td colspan="4">&nbsp;</td>
         <td><a href="<?     echo thisscript();?>?mode=add&frmidxid=<?     echo $qryidxid;?>"><IMG border="0" SRC="images/bt_add.gif" alt="Ajouter"></a></td>
         </tr>
         <?   } ?>
</table>
<?   return $function_ret;
} ?>

<? function edit()
{
  extract($GLOBALS);
?> 
<? 
//'''''''''''''''''''''''''
// MASK EDIT DB RECORDS
//'''''''''''''''''''''''''
  $strSQL="SELECT * from ".$TableName." Where ".$TableKey."=".$qryid.";";
  $RSA->Open($strSql,  $DBO , $adOpenStatic , $adLockReadOnly);
?>
        <form method="POST" action="<?   echo thisscript();?>?frmidxid=<?   echo $qryidxid;?>" name="theform" onSubmit="return validatetheform()">   
                  <table border="0" width="100%" bgcolor="#A4BCDD" cellspacing="1">
                    <tr>
                      <td width="30%" bgcolor="#C6D6E8"><b><font color="#800000">Libell�</b></font></td>
                      <td width="70%" bgcolor="#FFFFFF"><input type="text" maxlength="50" name="frmsrublibelle" size="30" value="<?   echo $RSA["srublibelle"];?>"></td>
                    </tr>
                    <tr>
                      <td bgcolor="#C6D6E8"><font color="#800000"><b>Ordre</b></font></td>
                      <td bgcolor="#FFFFFF"><input type="text" onkeypress="event.returnValue=IsDigit();" maxlength="4" onkeypress="event.returnValue=IsDigit();" name="frmsruborder" size="30" value="<?   echo $RSA["sruborder"];?>"></td>
                    </tr>
                    <tr>
                      <td bgcolor="#C6D6E8"><font color="#800000"><b>Type</b></font></td>
                      <td bgcolor="#FFFFFF">
                      <select name="frmsrubtype" size=1 class="SELECTCLASS">
                        <?   if ($RSA["srubtype"]=="DOC")
  {
?>
                        <option selected value="DOC">Document</option>
                        <option value="LINK">Lien</option>
                        <?   }
    else
  {
?>
                        <option value="DOC">Document</option>
                        <option selected value="LINK">Lien</option>
                        <?   } ?>
                      </select>
                      </td>
                    </tr>
                    <tr>
                      <td bgcolor="#C6D6E8"><font color="#800000"><b>Description</b></font></td>
                      <td bgcolor="#FFFFFF"><textarea rows=3 name="frmsrubdesc" cols=30><?   echo $RSA["srubdesc"];?></textarea></td>
                    </tr>
                    <tr>
                      <td bgcolor="#C6D6E8" colspan="2">
                      <input type="image" border="0" class="noborders"  SRC="images/bt_validate.gif" alt="Valider" id=image1 name=image1>&nbsp;
                       <a href="<?   echo thisscript();?>?frmidxid=<?   echo $qryidxid;?>"><IMG border="0" SRC="images/bt_cancel.gif" alt="Annuler"></a>
                      </td>
                    </tr>
                  </table>
                  <input type=hidden name="mode" value="update">
                  <input type=hidden name="frmid" value="<?   echo $RSA[$TableKey];?>">
    </form> 
    <?   $RSA->close;?>
<?   return $function_ret;
} ?>

<? function add()
{
  extract($GLOBALS);
?> 
<? 
//'''''''''''''''''''''''''
// MASK ADD NEW DB RECORDS
//'''''''''''''''''''''''''
?>
        <form method="POST" action="<?   echo thisscript();?>?frmidxid=<?   echo $qryidxid;?>" name="theform" onSubmit="return validatetheform()">   
      <table border="0" width="100%" bgcolor="#A4BCDD" cellspacing="1">
                    <tr>
                      <td width="30%" bgcolor="#C6D6E8"><b><font color="#800000">Libell�</b></font></td>
                      <td width="70%" bgcolor="#FFFFFF"><input type="text" maxlength="50" name="frmsrublibelle" size="30" value=""></td>
                    </tr>
                    <tr>
                      <td bgcolor="#C6D6E8"><font color="#800000"><b>Ordre</b></font></td>
                      <td bgcolor="#FFFFFF"><input type="text" onkeypress="event.returnValue=IsDigit();" maxlength="4" onkeypress="event.returnValue=IsDigit();" name="frmsruborder" size="30" value=""></td>
                    </tr>
                    <tr>
                      <td bgcolor="#C6D6E8"><font color="#800000"><b>Type</b></font></td>
                      <td bgcolor="#FFFFFF">
                      <select name="frmsrubtype" size=1 class="SELECTCLASS">
                        <option selected value="DOC">Document</option>
                        <option value="LINK">Lien</option>
                      </select>
                      </td>
                    </tr>
                    <tr>
                      <td bgcolor="#C6D6E8"><font color="#800000"><b>Description</b></font></td>
                      <td bgcolor="#FFFFFF"><textarea rows=3 name="frmsrubdesc" cols=30></textarea></td>
                    </tr>
                    <tr>
                      <td bgcolor="#C6D6E8" colspan="2">
                      <input type="image" border="0" class="noborders"  SRC="images/bt_validate.gif" alt="Valider" id=image1 name=image1>&nbsp;
                       <a href="<?   echo thisscript();?>?frmidxid=<?   echo $qryidxid;?>"><IMG border="0" SRC="images/bt_cancel.gif" alt="Annuler"></a>
                      </td>
                    </tr>
                  </table>
                  <input type=hidden name="mode" value="addnew">
        </form> 
<?   return $function_ret;
} ?>


<? 
function update()
{
  extract($GLOBALS);

// update rec

  $strSQL="SELECT * from ".$TableName." Where ".$TableKey."=".$qryid.";";
  $RSA->Open($strSql , $DBO , $adOpenStatic , $adLockOptimistic);

  $RSA["srublibelle"]=$_POST["frmsrublibelle"];
  $RSA["sruborder"]=$_POST["frmsruborder"];
  $RSA["srubtype"]=$_POST["frmsrubtype"];
  $RSA["srubdesc"]=$_POST["frmsrubdesc"];

  $RSA->Update;
  $RSA->close;
  print "<html><script language=\"javascript\">location.href='".thisscript()."?frmidxid=".$qryidxid."'</script></html>";
//Response.Redirect (thisscript) 
  return $function_ret;
} 

function addnew()
{
  extract($GLOBALS);

// addnew rec
  $strSQL="SELECT top 1 * from ".$TableName." ;";
  $RSA->Open($strSql , $DBO , $adOpenStatic , $adLockOptimistic);
  $RSA->addnew;

  $RSA["srublibelle"]=$_POST["frmsrublibelle"];
  $RSA["sruborder"]=$_POST["frmsruborder"];
  $RSA["srubtype"]=$_POST["frmsrubtype"];
  $RSA["srubdesc"]=$_POST["frmsrubdesc"];
  $RSA[$ITableKey]=$qryidxid;

  $RSA->Update();

  $RSA->close;
  print "<html><script language=\"javascript\">location.href='".thisscript()."?frmidxid=".$qryidxid."'</script></html>";
//Response.Redirect (thisscript)
  return $function_ret;
} 

function sup()
{
  extract($GLOBALS);

  $confdelete=true;
// verify integrity 1
  $strSQL="SELECT * from ".$RTableName1." Where ".$RTableKey1."=".$qryid.";";
  $RSA->Open($strSql , $DBO,  $adOpenStatic,  $adLockReadOnly);
  if (!$RSA->eof)
  {
    $confdelete=false;
  } 
  $RSA->close;

  if ($RTableName2!="")
  {

// verify integrity 2
    $strSQL="SELECT * from ".$RTableName2." Where ".$RTableKey2."=".$qryid.";";
    $RSA->Open($strSql  ,  $DBO  ,  $adOpenStatic  ,  $adLockReadOnly);
    if (!$RSA->eof)
    {
      $confdelete=false;
    } 
    $RSA->close;
  } 


  if ($confdelete)
  {

// del
    $strSQL="SELECT * from ".$TableName." Where ".$TableKey."=".$qryid.";";
    $RSA->Open($strSql   , $DBO ,   $adOpenStatic  ,  $adLockOptimistic);
    $RSA->delete;
    $RSA->close;
    header("Location: ".thisscript()."?frmidxid=".$qryidxid);
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
		<TD BGCOLOR="<? echo $tempRoundedColor;?>"> 
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
<? admfoot();?>


