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
                      <td width="5%"><img border="0" src="images/icon_feedback.gif">
                      </td>
                      <td width="95%" valign="bottom" class="titles">
                      <font color="#1A62B0"><b>FeedBack >> </b></font>
                      <font color="#008000"><b>Abonn�s � la mailinglist</b></font></td>
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

$TableName="mailinglist";
$TableKey="id";
$OrderBy="thedate";

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
    case null :
      break;
    case "":
      Previewdb();
      break;
    case "view":
      $view;
//case "edit" edit
//case "add"  add
      break;
    case "sup":
      sup();

//case "update" update
      case "addnew":
      $addnew;
      break;
  } 

} 


?>
<SCRIPT LANGUAGE="javascript">
function validatetheform()
{ 

}  
</SCRIPT>
<? function Previewdb()
{
  extract($GLOBALS);
?>
<? 
  $strSQL="SELECT * from ".$TableName." ORDER BY ".$orderby.";";
  $RSA->Open($strSQL , $DBO  ,$adOpenStatic  ,$adLockReadOnly);
?>
<table border="0" width="100%" bgcolor="#A4BCDD" cellpadding="2" cellspacing="1">
         <tr>
           <td width="30%" bgcolor="#C6D6E8" height="20"><font color="#800000"><B>Nom et prenom</B></font></td>
           <td width="25%" bgcolor="#C6D6E8" height="20"><font color="#800000"><b>Email</b></font></td>
           <td width="25%" bgcolor="#C6D6E8" height="20"><font color="#800000"><b>Date/Heure</b></font></td>
           <td width="20%" bgcolor="#C6D6E8" height="20"><font color="#800000"><b>Action</b></font></td>
          </tr>
          <?   while(!$RSA->EOF)
  {
?>
              <tr bgcolor="#EEF2F9">
                <td><?     echo $RSA["name"];?></td>
                <td><font color="#800000"><b>@:</b></font><a href="mailto:<?     echo $RSA["email"];?>"><?     echo $RSA["email"];?></a></td>
                <td><?     echo $RSA["thedate"];?></td>
                <td>
                <a href="javascript:confirmDelete('<?     echo thisscript();?>?mode=sup&frmid=<?     echo $RSA[$TableKey];?>')"><IMG border="0" SRC="images/bt_supp.gif" alt="Supprimer"></a>
                </td>
              </tr>
              <?     $RSA->MoveNext;?>
         <?   } ?>
         <?   $RSA->close;?>
         
</table>
<?   return $function_ret;
} ?>


<? 
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
    $RSA->Open($strSql  ,  $DBO   , $adOpenStatic   , $adLockReadOnly);
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
    $RSA->Open($strSql ,   $DBO   , $adOpenStatic  ,  $adLockReadOnly);
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
    $RSA->Open($strSql  ,  $DBO ,   $adOpenStatic ,   $adLockOptimistic);
    $RSA->delete;
    $RSA->close;
    header("Location: ".thisscript());
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


