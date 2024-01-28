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
                      <font color="#008000"><b>Documents du menu haut</b></font></td>
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

$TableName="documents";
$TableKey="docid";
$OrderBy="docorder";
$ViewFields="docid,doctitle,docorder";


// Index Table ( Relation Table )
$ITableName="acces_rapide";
$ITableKey="arid";
$ITableKeyC="docarid";
$ITableTitle="arlibelle";
$IOrderBy="arorder";
$ICriteria="artype='DOC'";

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
 if (document.theform.frmdoctitle.value=='')
  {
 alert ('Titre manquant !');
 document.theform.frmdoctitle.focus();
 return false;
  }
 
if ( document.theform.frmdocorder.value != '' )
{ 
  if ( isNaN(parseInt(document.theform.frmdocorder.value,10))) 
   { alert ('Ordre manquant ou invalide') ; document.theform.frmdocorder.focus() ; 
    return false ; 
   }
  document.theform.frmdocorder.value=parseInt(document.theform.frmdocorder.value,10);
}
else
{ document.theform.frmdocorder.value='0'; }


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

<table border="0" width="100%" bgcolor="#A4BCDD" cellpadding="2" cellspacing="1">
         <tr>
               <td width="40%" bgcolor="#C6D6E8" colspan="6">
               <font color="#800000"><b>S�lectionnez une rubrique:</b></font><br>
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
  $strSQL="SELECT * from ".$ITableName." WHERE ".$ICriteria." ORDER BY ".$IOrderBy." ;";
  $RSA->Open ($strSQL ,  $DBO , $adOpenStatic , $adLockReadOnly);
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
    $strSQL="SELECT ".$ViewFields." from ".$TableName." WHERE ".$ITableKeyC."=".$qryidxid."  ORDER BY ".$orderby." ;";
    $RSA->Open($strSQL  ,  $DBO  ,  $adOpenStatic  ,  $adLockReadOnly);
?>
         <tr>
           <td width="30%" bgcolor="#C6D6E8" height="20"><font color="#800000"><B>Titre</B></font></td>
           <td width="10%" bgcolor="#C6D6E8" height="20"><font color="#800000"><b>Document</b></font></td>
           <td width="10%" bgcolor="#C6D6E8" height="20"><font color="#800000"><b>Ordre</b></font></td>
           <td width="40%" bgcolor="#C6D6E8" height="20"><font color="#800000"><b>Action</b></font></td>
          </tr>
          <?     while(!$RSA->EOF)
    {
?>
              <tr bgcolor="#EEF2F9">
                <td> <?       echo $RSA["doctitle"];?></td>
                <td align="center"> <b>[ HTML ]</b></td>
                <td> <?       echo $RSA["docorder"];?></td>
                <td>
                <a href="<?       echo thisscript();?>?mode=edit&frmid=<?       echo $RSA[$TableKey];?>&frmidxid=<?       echo $qryidxid;?>"><IMG border="0" SRC="images/bt_modif.gif" alt="Modifier"></a>
                <a href="javascript:confirmDelete('<?       echo thisscript();?>?mode=sup&frmid=<?       echo $RSA[$TableKey];?>&frmidxid=<?       echo $qryidxid;?>')"><IMG border="0" SRC="images/bt_supp.gif" alt="Supprimer"></a>
                </td>
              </tr>
              <?       $RSA->MoveNext;?>
         <?     } ?>
         <?     $RSA->close;?>
         <tr bgcolor="#C6D6E8">
         <td >&nbsp;</td>
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
  $RSA->Open($strSql , $DBO,  $adOpenStatic , $adLockReadOnly);
?>
        <form method="POST" action="<?   echo thisscript();?>?frmidxid=<?   echo $qryidxid;?>" name="theform" onsubmit="return validatetheform()">   
                  <table border="0" width="100%" bgcolor="#A4BCDD" cellspacing="1">
                    <tr>
                      <td width="20%" bgcolor="#C6D6E8"><b><font color="#800000">Titre</b></font></td>
                      <td width="80%" bgcolor="#FFFFFF"><input type="text" maxlength="255" name="frmdoctitle" size="30" value="<?   echo $RSA["doctitle"];?>"></td>
                    </tr>
                    <tr>
                      <td bgcolor="#C6D6E8"><font color="#800000"><b>Ordre</b></font></td>
                      <td bgcolor="#FFFFFF"><input type="text" onkeypress="event.returnValue=IsDigit();" maxlength="4" onkeypress="event.returnValue=IsDigit();" name="frmdocorder" size="30" value="<?   echo $RSA["docorder"];?>"></td>
                    </tr>
                    <tr>
                      <td bgcolor="#C6D6E8" valign="top"><font color="#800000"><b>Contenu du document</b></font></td>
                      <td bgcolor="#FFFFFF">
                       <?  
                       // if ((strpos(GetUserAgent(,"IE"),<>0&$WYSIWYGMode=true) ? strpos(GetUserAgent(,"IE"),<>0&$WYSIWYGMode=true)+1 : 0))
                       if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false && $WYSIWYGMode === true)
                       {

    $id=$DHTMLEditMirror ; $style="VISIBILITY: hidden ; POSITION: absolute" ;$rows="1" ;$cols="20" ; $body=$RSA["docbody"];// body changed ?></textarea> 
                        <?     DreamEdit();?>
                        <?   }
    else
  {
?>
                        <textarea name = "content" rows="20" cols="70"><?     echo $RSA["docbody"];?></textarea>
                        <input type="hidden" name="WYSIWYGMode" value="off">
                        <?   } ?> 
                      </td>
                    </tr>
                    <tr>
                      <td bgcolor="#C6D6E8">&nbsp;</td>
                      <td bgcolor="#C6D6E8">
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
                      <td width="20%" bgcolor="#C6D6E8"><b><font color="#800000">Titre</b></font></td>
                      <td width="80%" bgcolor="#FFFFFF"><input type="text" maxlength="255" name="frmdoctitle" size="30" value=""></td>
                    </tr>
                    <tr>
                      <td bgcolor="#C6D6E8"><font color="#800000"><b>Ordre</b></font></td>
                      <td bgcolor="#FFFFFF"><input type="text" onkeypress="event.returnValue=IsDigit();" maxlength="4" onkeypress="event.returnValue=IsDigit();" name="frmdocorder" size="30" value=""></td>
                    </tr>
                    <tr>
                      <td bgcolor="#C6D6E8" valign="top"><font color="#800000"><b>Contenu du document</b></font></td>
                      <td bgcolor="#FFFFFF">
                       <?  
                       // if ((strpos(GetUserAgent(,"IE"),<>0&$WYSIWYGMode=true) ? strpos(GetUserAgent(,"IE"),<>0&$WYSIWYGMode=true)+1 : 0))
                       if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false && $WYSIWYGMode === true)
                       {

    $id=$DHTMLEditMirror ; $style="VISIBILITY: hidden ; POSITION: absolute" ;$rows="1" ; $cols="20" ;?> </textarea>;


    $rows="20"$cols="70"></$textarea>;
    $name="WYSIWYGMode"$value="off">;
?> 
                      </td>
                    </tr>
                    <tr>
                      <td bgcolor="#C6D6E8">&nbsp;</td>
                      <td bgcolor="#C6D6E8">
                      <input type="image" border="0" class="noborders"  SRC="images/bt_validate.gif" alt="Valider" id=image1 name=image1>&nbsp;
                       <a href="<?     echo thisscript();?>?frmidxid=<?     echo $qryidxid;?>"><IMG border="0" SRC="images/bt_cancel.gif" alt="Annuler"></a>
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
    $RSA->Open ($strSql  ,  $DBO  ,  $adOpenStatic  ,  $adLockOptimistic);

    $RSA["doctitle"]=$_POST["frmdoctitle"];
    $RSA["docorder"]=$_POST["frmdocorder"];
    $RSA["docbody"]=$_POST["content"];


    $RSA->Update();

    $RSA->close;
    print "<html><script language=\"javascript\">location.href='".thisscript("?frmidxid=".$qryidxid."'</script></html>");
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
    $RSA->Open($strSql ,   $DBO  ,  $adOpenStatic   , $adLockOptimistic);
    $RSA->addnew;

    $RSA["doctitle"]=$_POST["frmdoctitle"];
    $RSA["docorder"]=$_POST["frmdocorder"];
    $RSA["docbody"]=$_POST["content"];
    $RSA[$ITableKeyC]=$qryidxid;

    $RSA->Update();

    $RSA->close;
    print "<html><script language=\"javascript\">location.href='".thisscript("?frmidxid=".$qryidxid."'</script></html>");
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
// verify integrity 1
    if ($RTableName1!="")
    {

      $strSQL="SELECT * from ".$RTableName1." Where ".$RTableKey1."=".$qryid.";";
      $RSA->Open($strSql   ,   $DBO  ,    $adOpenStatic ,     $adLockReadOnly);
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
      $RSA->Open($strSql ,     $DBO  ,    $adOpenStatic   ,   $adLockReadOnly);
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
      $RSA->Open($strSql  ,    $DBO    ,  $adOpenStatic   ,   $adLockOptimistic);
      $RSA->delete;
      $RSA->close;
      header("Location: ".thisscript("?frmidxid=".$qryidxid));
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
