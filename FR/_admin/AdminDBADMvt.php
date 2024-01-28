<?
  session_start();
  session_register("ADMINPROFIL_session");
  session_register("ADMINUSERNAME_session");
  session_register("ADMINACESS_session");
  session_register("ADMINUSERLOGGED_session");
  session_register("ADMINUSERID_session");
?>
<!--#include file="adminsettings.php"-->
<!--#include file="../common/tools.php"-->
<!--#include file="admintemplates.php"-->
<!--#include file="adminsecurity.php"-->
<? admhead();?>
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
                      <td width="5%"><img border="0" src="images/icon_histo.gif" width="38" height="36">
                      </td>
                      <td width="95%" valign="bottom" class="titles">
                      <font color="#1A62B0"><b>Sondage >> </b></font>
                      <font color="#008000"><b>Options</b></font></td>
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

$TableName="[option]";
$TableKey="oid";
$OrderBy="";

// Index Table ( Relation Table )
$ITableName="question";
$ITableKey="qid";
$ITableTitle="qquestion";
$IOrderBy="qdate DESC";

// related table (integrity) ( 2 table ) for delete
$RTableName1="";
$RTableKey1="";
$RTableName2="";
$RTableKey2="";

//  verif privilege 
if ($_SESSION['ADMINPROFIL']!="AD")
{

  $AdminMessage="Acc�s non autoris� <br>( vous n'avez pas de privil�ges pour cette rubrique )";
}
  else
{


  switch ($qrymode)
  {
    case"" :
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
 if (document.theform.frmooption.value=='')
  {
 alert ('option manquante !');
 document.theform.frmooption.focus();
 return false;
  }

  return true;

}  
</SCRIPT>
<? function Previewdb()
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
               <td width="40%" bgcolor="#C6D6E8" colspan="6">
               <font color="#800000"><b>S�lectionnez la question:</b></font><br>
               <form name="Sfrom">
               <select name="frmidxid" size="5" class="SELECTCLASS" onchange="goidx(this.options[selectedIndex].value,'<?   echo thisscript();?>')">
                            <?   if ($qryidxid=="-1" || $qryidxid=="")
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
  $strSQL="SELECT * from ".$ITableName." ORDER BY ".$IOrderBy." ;";
  $RSA->Open($strSQL,  $DBO , $adOpenStatic,  $adLockReadOnly);
  while(!$RSA->EOF)
  {
?>
                            <option value="<?     echo $RSA[$ITableKey];?>" <?     if ($qryidxid==($RSA[$ITableKey]))
    {
      print "selected";
    } ?>><?     echo $RSA[$ITableTitle];?></option>
                            <?     $RSA->Movenext;
  } 
  $RSA->close;
?>   
                 </select>   
                 </form>             
         </td></tr>
         <?   if (!($qryidxid=="-1" || $qryidxid==""))
  {
// if index selected  ?>  
         <? 
    $strSQL="SELECT * from ".$TableName." WHERE ".$ITableKey."=".$qryidxid." ;";
    $RSA->Open($strSQL   , $DBO ,   $adOpenStatic  ,  $adLockReadOnly);
?>
         <tr>
           <td width="50%" bgcolor="#C6D6E8" height="20"><font color="#800000"><B>Options</B></font></td>
           <td width="50%" bgcolor="#C6D6E8" height="20"><font color="#800000"><b>Action</b></font></td>
          </tr>
          <?     while(!$RSA->EOF)
    {
?>
              <tr bgcolor="#EEF2F9">
                <td> <?       echo $RSA["ooption"];?></td>
                <td>
                <a href="<?       echo thisscript();?>?mode=edit&frmid=<?       echo $RSA[$TableKey];?>&frmidxid=<?       echo $qryidxid;?>"><IMG border="0" SRC="images/bt_modif.gif" alt="Modifier"></a>
                <a href="javascript:confirmDelete('<?       echo thisscript();?>?mode=sup&frmid=<?       echo $RSA[$TableKey];?>&frmidxid=<?       echo $qryidxid;?>')"><IMG border="0" SRC="images/bt_supp.gif" alt="Supprimer"></a>
                </td>
              </tr>
              <?       $RSA->MoveNext;?>
         <?     } ?>
         <?     $RSA->close;?>
         <tr bgcolor="#C6D6E8">
         <td colspan="1">&nbsp;</td>
         <td><a href="<?     echo thisscript();?>?mode=add&frmidxid=<?     echo $qryidxid;?>"><IMG border="0" SRC="images/bt_add.gif" alt="Ajouter"></a></td>
         </tr>
         <?   } ?>
</table>
<?   return $function_ret;
} ?>

<? function edit()
{$DBO =new mysqli("localhost", "dcstecgr_artcomu", "artcom2015artcom","dcstecgr_webdbfr");

    if ($DBO -> connect_errno) {
        echo "Failed to connect to MySQL: " . $DBO -> connect_error;
        exit();
    }
    mysqli_select_db($DBO,'dcstecgr_webdbfr');
  extract($GLOBALS);
?> 
<? 
//'''''''''''''''''''''''''
// MASK EDIT DB RECORDS
//'''''''''''''''''''''''''
  $strSQL="SELECT * from ".$TableName." Where ".$TableKey."=".$qryid.";";
  $RSA->Open($strSql , $DBO , $adOpenStatic , $adLockReadOnly);
?>
        <form method="POST" action="<?   echo thisscript();?>?frmidxid=<?   echo $qryidxid;?>" name="theform" onsubmit="return validatetheform()">   
                  <table border="0" width="100%" bgcolor="#A4BCDD" cellspacing="1">
                    <tr>
                      <td width="30%" bgcolor="#C6D6E8"><b><font color="#800000">Option</b></font></td>
                      <td width="70%" bgcolor="#FFFFFF"><input type="text" maxlength="255" name="frmooption" size="30" value="<?   echo $RSA["ooption"];?>"></td>
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
    <form method="POST" action="<?   echo thisscript();?>?frmidxid=<?   echo $qryidxid;?>" name="theform" onsubmit="return validatetheform()">   
      <table border="0" width="100%" bgcolor="#A4BCDD" cellspacing="1">
                    <tr>
                      <td width="30%" bgcolor="#C6D6E8"><b><font color="#800000">Option</b></font></td>
                      <td width="70%" bgcolor="#FFFFFF"><input type="text" maxlength="255" name="frmooption" size="30" value=""></td>
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
{$DBO =new mysqli("localhost", "dcstecgr_artcomu", "artcom2015artcom","dcstecgr_webdbfr");

    if ($DBO -> connect_errno) {
        echo "Failed to connect to MySQL: " . $DBO -> connect_error;
        exit();
    }
    mysqli_select_db($DBO,'dcstecgr_webdbfr');
  extract($GLOBALS);

// update rec

  $strSQL="SELECT * from ".$TableName." Where ".$TableKey."=".$qryid.";";
  $RSA->Open($strSql , $DBO , $adOpenStatic , $adLockOptimistic);

  $RSA["ooption"]=$_POST["frmooption"];


  $RSA->Update;
  $RSA->close;
  print "<html><script language=\"javascript\">location.href='".thisscript()."?frmidxid=".$qryidxid."'</script></html>";
//Response.Redirect (thisscript) 
  return $function_ret;
} 

function addnew()
{$DBO =new mysqli("localhost", "dcstecgr_artcomu", "artcom2015artcom","dcstecgr_webdbfr");

    if ($DBO -> connect_errno) {
        echo "Failed to connect to MySQL: " . $DBO -> connect_error;
        exit();
    }
    mysqli_select_db($DBO,'dcstecgr_webdbfr');
  extract($GLOBALS);

// addnew rec
  $strSQL="SELECT top 1 * from ".$TableName." ;";
  $RSA->Open($strSql , $DBO , $adOpenStatic,  $adLockOptimistic);
  $RSA->addnew;

  $RSA["ooption"]=$_POST["frmooption"];

  $RSA[$ITableKey]=$qryidxid;

  $RSA->Update();

  $RSA->close;
  print "<html><script language=\"javascript\">location.href='".thisscript()."?frmidxid=".$qryidxid."'</script></html>";
//Response.Redirect (thisscript)
  return $function_ret;
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

  if ($RTableName1!="")
  {

// verify integrity 1
    $strSQL="SELECT * from ".$RTableName1." Where ".$RTableKey1."=".$qryid.";";
    $RSA->Open($strSql   , $DBO  ,  $adOpenStatic ,   $adLockReadOnly);
    if (!$RSA->eof)
    {
      $confdelete=false;
    } 
    $RSA->close;
  } 


  if ($RTableName2!="")
  {

// verify integrity 2
    $strSQL="SELECT * from ".$RTableName2." Where ".$RTableKey2."=".$qryid.";";
    $RSA->Open($strSql   , $DBO  ,  $adOpenStatic ,   $adLockReadOnly);
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
    $RSA->Open($strSql  ,  $DBO   , $adOpenStatic  ,  $adLockOptimistic);
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


