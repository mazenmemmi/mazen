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
                      <td width="5%"><img border="0" src="images/icon_content.gif">
                      </td>
                      <td width="95%" valign="bottom" class="titles">
                      <font color="#1A62B0"><b>Contenu >> </b></font>
                      <font color="#008000"><b>News</b></font></td>
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

$TableName="articles";
$TableKey="artid";
$OrderBy="artdate DESC";
$Criteria="artid,artTitle,artsender,artsenderemail,artdate,arttype";
$ViewFields="artid,artTitle,artsender,artsenderemail,artdate,arttype";

// related table (integrity) ( 2 table ) for delete
$RTableName1="";
$RTableKey1="";
$RTableName2="";
$RTableKey2="";

//  verif privilege 
if ($_SESSION['ADMINPROFIL']!="AD")
{

  $AdminMessage ="Acc�s non autoris� <br>( vous n'avez pas de privil�ges pour cette rubrique )";
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
if (document.theform.frmarttitle.value=='')
 {
 alert (' Champ [ Titre ] vide !');
 document.theform.frmarttitle.focus();
 return false;
 }
  
 if (document.theform.frmartshort.value=='')
  {
 alert (' Champ [ Chapeau ] vide !');
 document.theform.frmartshort.focus();
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


<? function Previewdb()
{$DBO =new mysqli("localhost", "dcstecgr_artcomu", "artcom2015artcom","dcstecgr_webdbfr");

if ($DBO -> connect_errno) {
 echo "Failed to connect to MySQL: " . $DBO -> connect_error;
 exit();
}
mysqli_select_db($DBO,'dcstecgr_webdbfr');
  extract($GLOBALS);
?>
<? 
  $strSQL="SELECT ".$ViewFields." from ".$TableName." ORDER BY ".$orderby.";";
  $RSA->Open ($strSQL , $DBO , $adOpenStatic , $adLockReadOnly);
?>
<table border="0" width="100%" bgcolor="#A4BCDD" cellpadding="2" cellspacing="1">
           <tr>
              <td width="35%" bgcolor="#C6D6E8"><font color="#800000"><b>Titre</b></font></td>
              <td width="5%" bgcolor="#C6D6E8"><font color="#800000"><b>Chapeau</b></font></td>
              <td width="5%" bgcolor="#C6D6E8"><font color="#800000"><b>Article</b></font></td>
              <td width="10%" bgcolor="#C6D6E8"><font color="#800000"><b>Date</b></font></td>
              <td width="5%" bgcolor="#C6D6E8"><font color="#800000"><b>Type</b></font></td>
              <td width="10%" bgcolor="#C6D6E8"><font color="#800000"><b>Auteur</b></font></td>
              <td width="10%" bgcolor="#C6D6E8"><font color="#800000"><b>Email Auteur</b></font></td>
              <td width="20%" bgcolor="#C6D6E8"><font color="#800000"><b>Action</b></font></td>
            </tr>
          <?   while(!$RSA->EOF)
  {
?>
              <tr  bgcolor="#EEF2F9">
              <td><?     echo $RSA["arttitle"];?></td>
              <td align="center"> <b>[HTML]</b></td>
              <td align="center"> <b>[HTML]</b></td>
              <td><?     echo $RSA["artdate"];?></td>
              <td><?     echo $RSA["arttype"];?></td>
              <td><?     echo $RSA["artsender"];?></td>
              <td><?     echo $RSA["artsenderemail"];?></td>
              <td>
                <a href="<?     echo thisscript();?>?mode=edit&frmid=<?     echo $RSA[$TableKey];?>"><IMG border="0" SRC="images/bt_modif.gif" alt="Modifier"></a>
                <a href="javascript:confirmDelete('<?     echo thisscript();?>?mode=sup&frmid=<?     echo $RSA[$TableKey];?>')"><IMG border="0" SRC="images/bt_supp.gif" alt="Supprimer"></a>
                </td>
              </tr>
              <?     $RSA->MoveNext;?>
         <?   } ?>
         <?   $RSA->close;?>
         <tr bgcolor="#C6D6E8">
         <td colspan="7">&nbsp;</td>
         <td><a href="<?   echo thisscript();?>?mode=add"><IMG border="0" SRC="images/bt_add.gif" alt="Ajouter"></a></td>
         </tr>
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
        <form method="POST" action="<?   echo thisscript();?>" name="theform" onsubmit="return validatetheform()">   
                  <table border="0" width="100%" bgcolor="#A4BCDD" cellspacing="1">
                    <tr>
                      <td width="20%" bgcolor="#C6D6E8"><b><font color="#800000">Titre</b></font></td>
                      <td width="80%" bgcolor="#FFFFFF"><input type="text" maxlength="255" name="frmarttitle" size="30" value="<?   echo $RSA["arttitle"];?>"></td>
                    </tr>
                    <tr>
                      <td width="20%" bgcolor="#C6D6E8"><b><font color="#800000">Date</b></font></td>
                      <td width="80%" bgcolor="#FFFFFF"><input type="text" maxlength="10" name="frmartdate" size="30" value="<?   echo $RSA["artdate"];?>"></td>
                    </tr>
                    <tr>
                      <td width="20%" bgcolor="#C6D6E8"><b><font color="#800000">Type</b></font></td>
                      <td width="80%" bgcolor="#FFFFFF">
               <select name="frmarttype" size=1 class="SELECTCLASS">
              <?   if ($RSA["arttype"]=="HOME")
  {
?>
              <option selected value="HOME">Accueil</option>
              <option value="ARCHIVED">Archiv�</option>
              <option value="HIDDEN">Cach�</option>
              <?   }
    else
  if ($RSA["arttype"]=="ARCHIVED")
  {
?>
              <option value="HOME">Accueil</option>
              <option selected value="ARCHIVED">Archiv�</option>
              <option value="HIDDEN">Cach�</option>
              <?   }
    else
  {
?>
              <option value="HOME">Accueil</option>
              <option value="ARCHIVED">Archiv�</option>
              <option selected value="HIDDEN">Cach�</option>
              <?   } ?>
              </select>
                      </td>
                    </tr>
                    <tr>
                      <td width="20%" bgcolor="#C6D6E8"><b><font color="#800000">Auteur</b></font></td>
                      <td width="80%" bgcolor="#FFFFFF"><input type="text" maxlength="50" name="frmartsender" size="30" value="<?   echo $RSA["artsender"];?>"></td>
                    </tr>
                    <tr>
                      <td width="20%" bgcolor="#C6D6E8"><b><font color="#800000">Email de l'Auteur</b></font></td>
                      <td width="80%" bgcolor="#FFFFFF"><input type="text" maxlength="50" name="frmartsenderemail" size="30" value="<?   echo $RSA["artsenderemail"];?>"></td>
                    </tr>
                    <tr>
                      <td bgcolor="#C6D6E8" valign=top><font color="#800000"><b>Chapeau</b></font></td>
                      <td bgcolor="#FFFFFF"><textarea rows=5 name="frmartshort" cols=70><?   echo $RSA["artshort"];?></textarea></td>
                    </tr>       
                    <tr>
                      <td bgcolor="#C6D6E8" valign="top"><font color="#800000"><b>Contenu de l'article</b></font></td>
                      <td bgcolor="#FFFFFF">
                       <? 
                       //  if ((strpos(GetUserAgent(,"IE"),<>0&$WYSIWYGMode=true) ? strpos(GetUserAgent(,"IE"),<>0&$WYSIWYGMode=true)+1 : 0))
                       if (strpos(GetUserAgent(), 'MSIE') !== false && $WYSIWYGMode === true)
                       {

    $id=$DHTMLEditMirror; $style="VISIBILITY: hidden ; POSITION: absolute" ; $rows="1" ; $cols="20"; $RSA_article=$RSA["article"];?></textarea>
                        <?     DreamEdit();?>
                        <?   }
    else
  {
?>
                        <textarea name = "content" rows="20" cols="70"><?     echo $RSA["article"];?></textarea>
                        <input type="hidden" name="WYSIWYGMode" value="off">
                        <?   } ?> 
                      </td>
                    </tr>
                    <tr>
                      <td bgcolor="#C6D6E8">&nbsp;</td>
                      <td bgcolor="#C6D6E8">
                      <input type="image" border="0" class="noborders"  SRC="images/bt_validate.gif" alt="Valider" id=image1 name=image1>&nbsp;
                       <a href="<?   echo thisscript();?>"><IMG border="0" SRC="images/bt_cancel.gif" alt="Annuler"></a>
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
        <form method="POST" action="<?   echo thisscript();?>" name="theform" onsubmit="return validatetheform()">   
                  <table border="0" width="100%" bgcolor="#A4BCDD" cellspacing="1">
                    <tr>
                      <td width="20%" bgcolor="#C6D6E8"><b><font color="#800000">Titre</b></font></td>
                      <td width="80%" bgcolor="#FFFFFF"><input type="text" maxlength="255" name="frmarttitle" size="30" value=""></td>
                    </tr>
                    <tr>
                      <td width="20%" bgcolor="#C6D6E8"><b><font color="#800000">Date</b></font></td>
                      <td width="80%" bgcolor="#FFFFFF"><input type="text" maxlength="10" name="frmartdate" size="30" value="<?   echo time()();?>"></td>
                    </tr>
                    <tr>
                      <td width="20%" bgcolor="#C6D6E8"><b><font color="#800000">Type</b></font></td>
                      <td width="80%" bgcolor="#FFFFFF">
              <select name="frmarttype" size=1 class="SELECTCLASS">
              <option selected value="HOME">Accueil</option>
              <option value="ARCHIVED">Archiv�</option>
              <option  value="HIDDEN">Cach�</option>
              </select>
                      </td>
                    </tr>
                    <tr>
                      <td width="20%" bgcolor="#C6D6E8"><b><font color="#800000">Auteur</b></font></td>
                      <td width="80%" bgcolor="#FFFFFF"><input type="text" maxlength="50" name="frmartsender" size="30" value=""></td>
                    </tr>
                    <tr>
                      <td width="20%" bgcolor="#C6D6E8"><b><font color="#800000">Email de l'Auteur</b></font></td>
                      <td width="80%" bgcolor="#FFFFFF"><input type="text" maxlength="50" name="frmartsenderemail" size="30" value=""></td>
                    </tr>
                    <tr>
                      <td bgcolor="#C6D6E8" valign=top><font color="#800000"><b>Chapeau</b></font></td>
                      <td bgcolor="#FFFFFF"><textarea rows=5 name="frmartshort" cols=70></textarea></td>
                    </tr>       
                    <tr>
                      <td bgcolor="#C6D6E8" valign="top"><font color="#800000"><b>Contenu de l'article</b></font></td>
                      <td bgcolor="#FFFFFF">
                       <?   
                       //if ((strpos(GetUserAgent(,"IE"),<>0&$WYSIWYGMode=true) ? strpos(GetUserAgent(,"IE"),<>0&$WYSIWYGMode=true)+1 : 0))
                       if (strpos(GetUserAgent(), 'MSIE') !== false && $WYSIWYGMode === true)
                       {

    $id=$DHTMLEditMirror ; $style="VISIBILITY: hidden ; POSITION: absolute" ; $rows="1" ; $cols="20" ;?></textarea>;

<?
    $rows="20" ; $cols="70"; ?> </textarea>
    <?
    $name="WYSIWYGMode" ; $value="off";
?> 
                      </td>
                    </tr>
                    <tr>
                      <td bgcolor="#C6D6E8">&nbsp;</td>
                      <td bgcolor="#C6D6E8">
                      <input type="image" alt="Valider" border="0" class="noborders"  SRC="images/bt_validate.gif">&nbsp;
                       <a href="<?     echo thisscript();?>"><IMG border="0" SRC="images/bt_cancel.gif" alt="Annuler"></a>
                      </td>
                    </tr>
                  </table>
                  <input type=hidden name="mode" value="addnew">
        </form> 
<?   } 
  function update()
  {$DBO =new mysqli("localhost", "dcstecgr_artcomu", "artcom2015artcom","dcstecgr_webdbfr");

if ($DBO -> connect_errno) {
 echo "Failed to connect to MySQL: " . $DBO -> connect_error;
 exit();
}
mysqli_select_db($DBO,'dcstecgr_webdbfr');
    extract($GLOBALS);



    update();
// update rec

    $strSQL="SELECT * from ".$TableName." Where ".$TableKey."=".$qryid.";";
    $RSA->Open($strSql ,    $DBO ,   $adOpenStatic ,   $adLockOptimistic);

    $RSA["arttitle"]=$_POST["frmarttitle"];
    $RSA["artdate"]=$_POST["frmartdate"];
    $RSA["arttype"]=$_POST["frmarttype"];
    $RSA["artsender"]=$_POST["frmartsender"];
    $RSA["artsenderemail"]=$_POST["frmartsenderemail"];
    $RSA["artshort"]=$_POST["frmartshort"];
    $RSA["article"]=$_POST["content"];

    $RSA->Update();

    $RSA->close;
    print "<html><script language=\"javascript\">location.href='".thisscript("'</script></html>");
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
    $RSA->Open($strSql  ,  $DBO ,   $adOpenStatic  ,  $adLockOptimistic);
    $RSA->addnew;

    $RSA["arttitle"]=$_POST["frmarttitle"];
    $RSA["artdate"]=$_POST["frmartdate"];
    $RSA["arttype"]=$_POST["frmarttype"];
    $RSA["artsender"]=$_POST["frmartsender"];
    $RSA["artsenderemail"]=$_POST["frmartsenderemail"];
    $RSA["artshort"]=$_POST["frmartshort"];
    $RSA["article"]=$_POST["content"];

    $RSA->Update();

    $RSA->close;
    print "<html><script language=\"javascript\">location.href='".thisscript("'</script></html>");
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
      $RSA->Open($strSql  ,    $DBO   ,   $adOpenStatic ,     $adLockReadOnly);
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
      $RSA->Open($strSql   ,   $DBO    ,  $adOpenStatic     , $adLockReadOnly);
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
      $RSA->Open($strSql   ,   $DBO  ,    $adOpenStatic  ,    $adLockOptimistic);
      $RSA->delete;
      $RSA->close;
      header("Location: ".thisscript());
    }
      else
    {

      $AdminMessage ="Impossible de supprimer cette ligne car elle comprend des enregistrements connexes.";
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
		<TD BGCOLOR="<?   echo $tempRoundedColor;?>"> 
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
<?   admfoot();

  return $function_ret;
} 
?>