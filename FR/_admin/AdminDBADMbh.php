<?
  session_start();
 /* 2021 session_register("ADMINPROFIL_session");
  session_register("ADMINUSERNAME_session");
  session_register("ADMINACESS_session");
  session_register("ADMINUSERLOGGED_session");
  session_register("ADMINUSERID_session");*/
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
                      <td width="5%"><img border="0" src="images/icon_banners.gif">
                      </td>
                      <td width="95%" valign="bottom" class="titles">
                      <font color="#1A62B0"><b>Banni�res >> </b></font>
                      <font color="#008000"><b>banni�res horizontale</b></font></td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td width="100%">
<!-- End Win Head -->    

<!-- content --> 

<? 
// Pass asp vars to js
print "<SCRIPT language=javascript>";
print "var BaseURL='".$DeBaseURL."' ;"."\r\n";
print "var WebVirtualPath='".$DeWebVirtualPath."' ;"."\r\n";
print "var ImageVirtualPath='".$DeImageVirtualPath."' ;"."\r\n";
print "</SCRIPT>";
?>

    
<? 
$qrymode=${"mode"};
$qryid=${"frmid"};

$TableName="hbanner";
$TableKey="id";
$OrderBy="";

// related table (integrity) ( 2 table ) for delete
$RTableName1="";
$RTableKey1="";
$RTableName2="";
$RTableKey2="";

//  verif privilege 
if ($_SESSION['ADMINPROFIL']!="AD")
{

  $AdminMessage= "Accés non autorisé <br>( vous n'avez pas de priviléges pour cette rubrique )";
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
 if (document.theform.frmbannerimage.value=='')
  {
 alert ('Champ [ Image ] vide !');
 document.theform.frmbannerimage.focus();
 return false;
 }
   
  
return true;
}  

/*---------------------------- IMAGE BROWSER --------------*/
function browser()
{
// pass baseurl to the dilaog  ( from dreameditconfig )   
var ImArr = new Array();
ImArr["BASEURL"] = BaseURL;
// the image path to passed to the browser
var IMAGEVPATH = WebVirtualPath+ImageVirtualPath ;
var mFile = "dreamedit/insimage.asp?imagevpath="+IMAGEVPATH ;
var arr = showModalDialog( mFile,ImArr,"dialogWidth: 622px ; dialogHeight: 542px;status:no") ;

// paste it
if (arr != null)  {
var WEBROOT=BaseURL+WebVirtualPath
// convert virtual to relative path
var isource = arr["SRC"];
isource = isource.substr(WEBROOT.length,isource.length);
document.theform.frmbannerimage.value=isource
 }

}

/*---------------------------- IMAGE BROWSER --------------*/

</SCRIPT>
<? function Previewdb()
{/*2021*/
    $DBO =new mysqli("localhost", "dcstecgr_artcomu", "artcom2015artcom","dcstecgr_webdbfr");

if ($DBO -> connect_errno) {
 echo "Failed to connect to MySQL: " . $DBO -> connect_error;
 exit();
}
mysqli_select_db($DBO,'dcstecgr_webdbfr');
/*2021*/
  extract($GLOBALS);
?>
<? 
  $strSQL="SELECT * from ".$TableName."  ;";
  $RSA->Open ($strSQL,  $DBO , $adOpenStatic , $adLockReadOnly);
?>
<table border="0" width="100%" bgcolor="#A4BCDD" cellpadding="2" cellspacing="1">
         <tr>
              <td width="20%" bgcolor="#C6D6E8"><font color="#800000"><b>Images</b></font></td>
              <td width="20%" bgcolor="#C6D6E8"><font color="#800000"><b>Liens</b></font></td>
              <td width="20%" bgcolor="#C6D6E8"><font color="#800000"><b>Texte</b></font></td>
              <td width="10%" bgcolor="#C6D6E8"><font color="#800000"><b>Nelle Fen�tre</b></font></td>
              <td width="30%" bgcolor="#C6D6E8"><font color="#800000"><b>Action</b></font></td>
            </tr>

          <?   while(!$RSA->EOF)
  {
?>
              <tr bgcolor="#EEF2F9">
               <td><?     echo $RSA["bannerimage"];?></td>
               <td> <?     echo $RSA["bannerlink"];?></td>
               <td><?     echo $RSA["bannertext"];?></td>
               <td><?     echo BoolView($RSA["newwindow"]);?></td>
                <td>
                <a href="<?     echo thisscript();?>?mode=edit&frmid=<?     echo $RSA[$TableKey];?>"><IMG border="0" SRC="images/bt_modif.gif" alt="Modifier"></a>
                <a href="javascript:confirmDelete('<?     echo thisscript();?>?mode=sup&frmid=<?     echo $RSA[$TableKey];?>')"><IMG border="0" SRC="images/bt_supp.gif" alt="Supprimer"></a>
                </td>
              </tr>
              <?     $RSA->MoveNext;?>
         <?   } ?>
         <?   $RSA->close;?>
         <tr bgcolor="#C6D6E8">
         <td colspan="4">&nbsp;</td>
         <td><a href="<?   echo thisscript();?>?mode=add"><IMG border="0" SRC="images/bt_add.gif" alt="Ajouter"></a></td>
         </tr>
</table>
<?   return $function_ret;
} ?>

<? function edit()
{/*2021*/
    $DBO =new mysqli("localhost", "dcstecgr_artcomu", "artcom2015artcom","dcstecgr_webdbfr");

if ($DBO -> connect_errno) {
 echo "Failed to connect to MySQL: " . $DBO -> connect_error;
 exit();
}
mysqli_select_db($DBO,'dcstecgr_webdbfr');
/*2021*/
  extract($GLOBALS);
?> 
<? 
//'''''''''''''''''''''''''
// MASK EDIT DB RECORDS
//'''''''''''''''''''''''''
  $strSQL="SELECT * from ".$TableName." Where ".$TableKey."=".$qryid.";";
  $RSA->Open ($strSql , $DBO , $adOpenStatic , $adLockReadOnly);
?>
        <form method="POST" action="<?   echo thisscript();?>" name="theform" onsubmit="return validatetheform()">   
                  <table border="0" width="100%" bgcolor="#A4BCDD" cellspacing="1">
                    <tr>
                      <td width="30%" bgcolor="#C6D6E8"><b><font color="#800000">Image</b></font></td>
                      <td width="70%" bgcolor="#FFFFFF"><input type="text" maxlength="50" name="frmbannerimage" size="30" value="<?   echo $RSA["bannerimage"];?>">
                      <?   
                      // if ((strpos(GetUserAgent(,"IE"),<>0&$WYSIWYGMode=true) ? strpos(GetUserAgent(,"IE"),<>0&$WYSIWYGMode=true)+1 : 0))
                           {if ((strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false && $WYSIWYGMode === true)) 
  



    $align="bottom" ; $onclick ="browser()" ; 
?>
                      </td>
                    </tr>
                    <tr>
                      <td width="30%" bgcolor="#C6D6E8"><b><font color="#800000">Lien</b></font></td>
                      <td width="70%" bgcolor="#FFFFFF"><input type="text" maxlength="50" name="frmbannerlink" size="30" value="<?     echo $RSA["bannerlink"];?>"></td>
                    </tr>
                    <tr>
                      <td width="30%" bgcolor="#C6D6E8"><b><font color="#800000">Infobulles (texte)</b></font></td>
                      <td width="70%" bgcolor="#FFFFFF"><input type="text" maxlength="50" name="frmbannertext" size="30" value="<?     echo $RSA["bannertext"];?>"></td>
                    </tr>
                    <tr>
                      <td width="30%" bgcolor="#C6D6E8"><b><font color="#800000">Ouvrir une nouvelle fen�tre ?</b></font></td>
                      <td width="70%" bgcolor="#FFFFFF">
                      <?     if ($RSA["newwindow"]==true)
    {
?>
                      <input class="noborders" type="checkbox" name="frmnewwindow" checked value="true">
                      <?     }
      else
    {
?>
                      <input class="noborders" type="checkbox" name="frmnewwindow" value="true">
                      <?     } ?>
                      </td>
                    </tr>
                    
                    <tr>
                      <td bgcolor="#C6D6E8" colspan="2">
                      <input type="image" border="0" class="noborders"  SRC="images/bt_validate.gif" alt="Valider" id=image1 name=image1>&nbsp;
                       <a href="<?     echo thisscript();?>"><IMG border="0" SRC="images/bt_cancel.gif" alt="Annuler"></a>
                      </td>
                    </tr>
                  </table>
                  <input type=hidden name="mode" value="update">
                  <input type=hidden name="frmid" value="<?     echo $RSA[$TableKey];?>">
    </form> 
    <?     $RSA->close;?>
<?   } 

  function extract () // here changed name 
  {
    extract($GLOBALS);

  


// MASK ADD NEW DB RECORDS
//'''''''''''''''''''''''''
?>
        <form method="POST" action="<?     echo thisscript();?>" name="theform" onsubmit="return validatetheform()">   
                  <table border="0" width="100%" bgcolor="#A4BCDD" cellspacing="1">
                    <tr>
                      <td width="30%" bgcolor="#C6D6E8"><b><font color="#800000">Image</b></font></td>
                      <td width="70%" bgcolor="#FFFFFF"><input type="text" maxlength="50" name="frmbannerimage" size="30" value="">
                      <?    
                      // if ((strpos(GetUserAgent(,"IE"),<>0&$WYSIWYGMode=true) ? strpos(GetUserAgent(,"IE"),<>0&$WYSIWYGMode=true)+1 : 0))
                      if ((strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false) && ($WYSIWYGMode === true)) 

                      {

      $align="bottom"  ; $onclick="browser()";
?>
                      </td>
                    </tr>
                    <tr>
                      <td width="30%" bgcolor="#C6D6E8"><b><font color="#800000">Lien</b></font></td>
                      <td width="70%" bgcolor="#FFFFFF"><input type="text" maxlength="50" name="frmbannerlink" size="30" value=""></td>
                    </tr>
                    <tr>
                      <td width="30%" bgcolor="#C6D6E8"><b><font color="#800000">Infobulles (texte)</b></font></td>
                      <td width="70%" bgcolor="#FFFFFF"><input type="text" maxlength="50" name="frmbannertext" size="30" value=""></td>
                    </tr>
                    <tr>
                      <td width="30%" bgcolor="#C6D6E8"><b><font color="#800000">Ouvrir une nouvelle fen�tre ?</b></font></td>
                      <td width="70%" bgcolor="#FFFFFF">
                       <input class="noborders" type="checkbox" name="frmnewwindow" value="true">
                      </td>
                    </tr>
                    
                    <tr>
                      <td bgcolor="#C6D6E8" colspan="2">
                      <input type="image" alt="Valider" border="0" class="noborders"  SRC="images/bt_validate.gif">&nbsp;
                       <a href="<?       echo thisscript();?>"><IMG border="0" SRC="images/bt_cancel.gif" alt="Annuler"></a>
                      </td>
                    </tr>
                  </table>
                  <input type=hidden name="mode" value="addnew">
        </form> 
<?     } 
    function extract() // changed name 
    {
      extract($GLOBALS);



      update();
// update rec

      $strSQL="SELECT * from ".$TableName." Where ".$TableKey."=".$qryid.";";
      $RSA->Open ($strSql  ,    $DBO ,     $adOpenStatic   ,   $adLockOptimistic);

      $RSA["bannerimage"]=$_POST["frmbannerimage"];
      $RSA["bannerlink"]=$_POST["frmbannerlink"];
      $RSA["bannertext"]=$_POST["frmbannertext"];
      $RSA["newwindow"]=$cbool[$_POST["frmnewwindow"]];

      $RSA->Update();

      $RSA->close;
      print "<html><script language=\"javascript\">location.href='".thisscript("'</script></html>");
//Response.Redirect (thisscript) 
      return $function_ret;
    } 

    function addnew()
    {/*2021*/
        $DBO =new mysqli("localhost", "dcstecgr_artcomu", "artcom2015artcom","dcstecgr_webdbfr");

if ($DBO -> connect_errno) {
 echo "Failed to connect to MySQL: " . $DBO -> connect_error;
 exit();
}
mysqli_select_db($DBO,'dcstecgr_webdbfr');
/*2021*/
      extract($GLOBALS);

// addnew rec
      $strSQL="SELECT top 1 * from ".$TableName." ;";
      $RSA->Open ($strSql   ,   $DBO  ,    $adOpenStatic ,     $adLockOptimistic);
      $RSA->addnew;

      $RSA["bannerimage"]=$_POST["frmbannerimage"];
      $RSA["bannerlink"]=$_POST["frmbannerlink"];
      $RSA["bannertext"]=$_POST["frmbannertext"];
      $RSA["newwindow"]=$cbool[$_POST["frmnewwindow"]];

      $RSA->Update();

      $RSA->close;
      print "<html><script language=\"javascript\">location.href='".thisscript("'</script></html>");
//Response.Redirect (thisscript)
      return $function_ret;
    } 

    function sup()
    {/*2021*/
        $DBO =new mysqli("localhost", "dcstecgr_artcomu", "artcom2015artcom","dcstecgr_webdbfr");

if ($DBO -> connect_errno) {
 echo "Failed to connect to MySQL: " . $DBO -> connect_error;
 exit();
}
mysqli_select_db($DBO,'dcstecgr_webdbfr');
/*2021*/
      extract($GLOBALS);

      $confdelete=true;

      if ($RTableName1!="")
      {

// verify integrity 1
        $strSQL="SELECT * from ".$RTableName1." Where ".$RTableKey1."=".$qryid.";";
        $RSA->Open ($strSql    ,    $DBO       , $adOpenStatic     ,   $adLockReadOnly);
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
        $RSA->Open ($strSql    ,    $DBO   ,     $adOpenStatic    ,    $adLockReadOnly);
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
        $RSA->Open ($strSql   ,     $DBO    ,    $adOpenStatic    ,    $adLockOptimistic);
        $RSA->delete;
        $RSA->close;
        header("Location: ".thisscript());
      }
        else
      {

        $AdminMessage = "Impossible de supprimer cette ligne car elle comprend des enregistrements connexes." ;
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
		<TD BGCOLOR="<?     echo $tempRoundedColor;?>"> 
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
		<td BGCOLOR=#1E5CA8 width="100%">
			<IMG SRC="images/spacer.gif" WIDTH=225 HEIGHT=1 ALT=""></TD>
	</TR>
</TABLE>
  </center>
</div>
    </td>
  </tr>
</table>
<!-- End Win Foot -->
<?     admfoot();

    return $function_ret;
  }  
   return $function_ret;
} 
?>
