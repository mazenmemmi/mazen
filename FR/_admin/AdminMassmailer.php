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
<!--#include file="dreamedit/dreameditor.php"-->
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
                      <font color="#008000"><b>envoi de messages group�s</b></font></td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td width="100%">
<!-- End Win Head -->    

<!-- content -->     
<? 
//dim ,qryid,TableName,TableKey,OrderBy
//dim RtableName1,RTableKey1,RtableName2,RTableKey2
$qrymode=${"mode"};

//  verif privilege 
if ($_SESSION['ADMINPROFIL']!="AD")
{

  $AdminMessage="Acc�s non autoris� <br>( vous n'avez pas de privil�ges pour cette rubrique )";
}
  else
{


  switch ($qrymode)
  {
    case null:
      break;
    case "":
      edit();

      break;
    case "update":
      update();
      break;
  } 

} 


?>
<SCRIPT LANGUAGE="javascript">
function docvalidator()
{
       
	
}
</SCRIPT>
<? function edit()
{
  extract($GLOBALS);
?>
<? 
//strSQL ="SELECT * from documents where type='HOME'"
//RSA.Open strSQL,DBO,adOpenStatic,adLockReadOnly
?>
<form action="<?   echo thisscript();?>" method="post" name="theform" onsubmit="return docvalidator()">
   <table border="0" width="100%" bgcolor="#A4BCDD" cellpadding="2" cellspacing="1">
       <tr>
        <td width="100%" bgcolor="#C6D6E8"><b><font color="#800000">Envoyez le message �</b></font></td>
       </tr>
       <tr>
       <td width="100%" bgcolor="#C6D6E8"><b><font color="#800000">
          <select size="1" name="mailingtype" class="SELECTCLASS">
          <option>liste des contacts</option>
          <option>MailingList</option>
           </select> 
       </td>
       <tr>
        <td width="100%" bgcolor="#C6D6E8"><b><font color="#800000">Sujet</b></font></td>
       <tr>
        <tr>
        <td width="100%" bgcolor="#C6D6E8"><b><font color="#800000">
          <input type="text" maxlength="255" name="frmSubject" size="30" value="">
        </td>
        </tr>
       <tr>
        <td width="100%" bgcolor="#C6D6E8"><b><font color="#800000">Message</b></font></td>
       <tr>
        <tr>
        <td width="100%" bgcolor="#C6D6E8"><b><font color="#800000">
          <textarea name = "content" rows="20" cols="70"></textarea>
        </td>
        </tr>
         <tr>
            <td bgcolor="#C6D6E8" colspan="2">
               <input type="image" border="0" class="noborders"  SRC="images/bt_validate.gif" alt="Valider" id=image1 name=image1>&nbsp;
               <a href="javascript:history.back(0)"><IMG border="0" SRC="images/bt_cancel.gif" alt="Annuler"></a>
            </td>
          </tr>
    </table>
<input type="hidden" name="mode" value="update">
</form>
<?   return $function_ret;
} ?>


<? 
function update()
{
  extract($GLOBALS);

// update rec

//strSQL ="SELECT * from documents where type='HOME'"
//RSA.Open strSql,DBO,adOpenStatic,adLockOptimistic
?>
    <table border="0" width="100%" bgcolor="#A4BCDD" cellpadding="2" cellspacing="1">
     <tr><td width="100%" bgcolor="#C6D6E8"><b>
  <? 
//RSA("docbody") = Request.form("content")
  print "Le message a �t� envoy� !";

?>
  </td></tr></table>
  <? 

//RSA.Update
//RSA.close
//Response.write "<html><script language=""javascript"">location.href='"&thisscript&"'</script></html>"
//Response.Redirect ("adminmenu.asp") 
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


