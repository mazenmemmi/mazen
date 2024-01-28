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
                      <font color="#008000"><b>Documents annexes</b></font></td>
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
if(isset ($_GET["mode"])){$qrymode=$_GET["mode"];}else{$qrymode=NULL;}
if(isset ($_GET["frmid"])){$qryid=$_GET["frmid"];}else{$qryid=NULL;}
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

  $AdminMessage="Acc�s non autoris� <br>( vous n'avez pas de privil�ges pour cette rubrique )";
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
<?php function Previewdb()
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
<?php 
  $strSQL="SELECT ".$ViewFields." from ".$TableName." WHERE ".$Criteria." ORDER BY ".$OrderBy.";";
 // $RSA->Open$strSQL  $DBO  $adOpenStatic  $adLockReadOnly;
  $RSA=mysqli_query($DBO,$strSQL);

?>
<table border="0" width="100%" bgcolor="#A4BCDD" cellpadding="2" cellspacing="1">
           <tr>
           <td width="10%" bgcolor="#C6D6E8" height="20"><font color="#800000"><b>Code</b></font></td>
           <td width="30%" bgcolor="#C6D6E8" height="20"><font color="#800000"><B>Titre</B></font></td>
           <td width="10%" bgcolor="#C6D6E8" height="20"><font color="#800000"><b>Document</b></font></td>
           <td width="40%" bgcolor="#C6D6E8" height="20"><font color="#800000"><b>Action</b></font></td>
          </tr>
          <?php   while($dataRSA=mysqli_fetch_array($RSA))//(!$RSA->EOF)
  {
?>
              <tr bgcolor="#EEF2F9">
                <td> <b><?php     echo $dataRSA["docID"];?></b></td>
                <td> <?php     echo $dataRSA["doctitle"];?></td>
                <td align="center"> <b>[ HTML ]</b></td>
                <td>
                <a href="AdminDBADMdocuanx.php?mode=edit&frmid=<?php     echo $dataRSA[$TableKey];?>"><IMG border="0" SRC="images/bt_modif.gif" alt="Modifier"></a>
                <a href="javascript:confirmDelete('AdminDBADMdocuanx.php?mode=sup&frmid=<?php     echo $dataRSA[$TableKey];?>')"><IMG border="0" SRC="images/bt_supp.gif" alt="Supprimer"></a>
                </td>
              </tr>
              <?php     //$RSA->MoveNext;?>
         <?php   } ?>
         <?php   $RSA=NULL;$dataRSA=NULL?>
         <tr bgcolor="#C6D6E8">
         <td colspan="3">&nbsp;</td>
         <td><a href="AdminDBADMdocuanx.php?mode=add"><IMG border="0" SRC="images/bt_add.gif" alt="Ajouter"></a></td>
         </tr>
</table>
<?php //  return $function_ret;
} ?>

<?php function edit()
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
<?php 
//'''''''''''''''''''''''''
// MASK EDIT DB RECORDS
//'''''''''''''''''''''''''
  $strSQL="SELECT * from ".$TableName." Where ".$TableKey."=".$qryid.";";
  //$RSA->Open$strSql  $DBO  $adOpenStatic  $adLockReadOnly;
  $RSA=mysqli_query($DBO,$strSQL);
  $dataRSA=mysqli_fetch_array($RSA);
?>
        <form method="GET" action="AdminDBADMdocuanx.php" name="theform" onSubmit="return validatetheform()">   
                  <table border="0" width="100%" bgcolor="#A4BCDD" cellspacing="1">
                    <tr>
                      <td width="20%" bgcolor="#C6D6E8"><b><font color="#800000">Titre</font></b></td>
                      <td width="80%" bgcolor="#FFFFFF"><input type="text" maxlength="255" name="frmdoctitle" size="30" value="<?php   echo $dataRSA["doctitle"];?>"></td>
                    </tr>
                    <tr>
                      <td bgcolor="#C6D6E8" valign="top"><font color="#800000"><b>Contenu du document</b></font></td>
                      <td bgcolor="#FFFFFF">
                       <?php  // if ((strpos(GetUserAgent(,"IE"),<>0&$WYSIWYGMode=true) ? strpos(GetUserAgent(,"IE"),<>0&$WYSIWYGMode=true)+1 : 0))
  {?>

                        <?php   }
    //else
  {
?>  <textarea name = "content" rows="20" cols="70"><?php     echo $dataRSA["docbody"];?></textarea>
                        <input type="hidden" name="WYSIWYGMode" value="off">
                      
                        <?php   } ?> 
                      </td>
                    </tr>
                    <tr>
                      <td bgcolor="#C6D6E8">&nbsp;</td>
                      <td bgcolor="#C6D6E8">
                      <input type="image" border="0" class="noborders"  SRC="images/bt_validate.gif" alt="Valider" id=image1 name=image1>&nbsp;
                       <a href="AdminDBADMdocuanx.php"><IMG border="0" SRC="images/bt_cancel.gif" alt="Annuler"></a>
                      </td>
                    </tr>
                  </table>
                  <input type=hidden name="mode" value="update">
                  <input type=hidden name="frmid" value="<?php   echo $dataRSA[$TableKey];?>">
    </form> 
    <?php   $RSA=NULL;$dataRSA=NULL?>
<?php   //return $function_ret;
} ?>

<?php function add()
{
  extract($GLOBALS);
?> 
<?php 
//'''''''''''''''''''''''''
// MASK ADD NEW DB RECORDS
//'''''''''''''''''''''''''
?>
        <form method="GET" action="AdminDBADMdocuanx.php" name="theform" onSubmit="return validatetheform()">   
                  <table border="0" width="100%" bgcolor="#A4BCDD" cellspacing="1">
                    <tr>
                      <td width="20%" bgcolor="#C6D6E8"><b><font color="#800000">Titre</b></font></td>
                      <td width="80%" bgcolor="#FFFFFF"><input type="text" maxlength="255" name="frmdoctitle" size="30" value=""></td>
                    </tr>
                    <tr>
                      <td bgcolor="#C6D6E8" valign="top"><font color="#800000"><b>Contenu du document</b></font></td>
                      <td bgcolor="#FFFFFF">
                       <?php  // if ((strpos(GetUserAgent(,"IE"),<>0&$WYSIWYGMode=true) ? strpos(GetUserAgent(,"IE"),<>0&$WYSIWYGMode=true)+1 : 0))

?>                      <textarea name = "content" rows="20" cols="70"></textarea>
                        <input type="hidden" name="WYSIWYGMode" value="off">
                      </td>
                    </tr>
                    <tr>
                      <td bgcolor="#C6D6E8">&nbsp;</td>
                      <td bgcolor="#C6D6E8">
                      <input type="image" alt="Valider" border="0" class="noborders"  SRC="images/bt_validate.gif">&nbsp;
                       <a href="AdminDBADMdocuanx.php"><IMG border="0" SRC="images/bt_cancel.gif" alt="Annuler"></a>
                      </td>
                    </tr>
                  </table>
                  <input type=hidden name="mode" value="addnew">
        </form> 
<?php   } 
  function  update()
    {/*2021*/
        $DBO =new mysqli("localhost", "dcstecgr_artcomu", "artcom2015artcom","dcstecgr_webdbfr");

        if ($DBO -> connect_errno) {
            echo "Failed to connect to MySQL: " . $DBO -> connect_error;
            exit();
        }
        mysqli_select_db($DBO,'dcstecgr_webdbfr');
        /*2021*/
    extract($GLOBALS);

	// $strSQL="UPDATE ".$TableName."  SET doctitle='".$_GET["frmdoctitle"]."',docbody='".$_GET["content"]."'  Where ".$TableKey."=".$qryid. ";";
	// echo $strSQL;

    //  $RSA=mysqli_query($DBO, $strSQL);

    $frmdoctitle = isset($_GET["frmdoctitle"]) ? mysqli_real_escape_string($DBO, $_GET["frmdoctitle"]) : '';
    $content = isset($_GET["content"]) ? mysqli_real_escape_string($DBO, $_GET["content"]) : '';

    // Use a prepared statement for improved security
    $stmt = $DBO->prepare("UPDATE $TableName SET doctitle=?, docbody=? WHERE $TableKey = ?");
    
    // Bind parameters
    $stmt->bind_param("ssi", $frmdoctitle, $content, $qryid);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Update successful." + $stmt;
    } else {
        echo "Error during update: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
    
    // Redirect
    header("Location: AdminDBADMlink.php?frmidxid=" . $qryidxid);
    exit();
  
    $dataRSA=NULL;$RSA=NULL;
	echo "<html><script language=\"javascript\">location.href='AdminDBADMdocuanx.php'</script></html>";
	
//Response.Redirect (thisscript) 
   // return $function_ret;
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
   // $strSQL="SELECT top 1 * from ".$TableName." ;";
    $strSQL="INSERT INTO  ".$TableName."  (doctitle,docbody,type) 
                                 VALUES ('".$_GET["frmdoctitle"]."','".$_GET["content"]."','DIRECT');";	
								 
	//echo $strSQL;   
    $RSA=mysqli_query($DBO,$strSQL);
	
   /* $RSA["doctitle"]=$_POST["frmdoctitle"];
    $RSA["docbody"]=$_POST["content"];
    $RSA["type"]="DIRECT";*/

    $dataRSA=NULL;$RSA=NULL;
    echo "<html><script language=\"javascript\">location.href='AdminDBADMdocuanx.php'</script></html>";

//Response.Redirect (thisscript)
    
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
      $RSA=mysqli_query($DBO,$strSQL);
      if ( $dataRSA=mysqli_fetch_array($RSA))//(!$RSA->eof)
      {
         $confdelete=false;
      } 
      $RSA=NULL;$dataRSA=NULL;//$RSA->close;
     } 


    if ($RTableName2!="")
    {

// verify integrity 2
      $strSQL="SELECT * from ".$RTableName2." Where ".$RTableKey2."=".$qryid.";";
      $RSA=mysqli_query($DBO,$strSQL);//$RSA->Open$strSql      $DBO      $adOpenStatic      $adLockReadOnly;
      if ($dataRSA=mysqli_fetch_array($RSA))//(!$RSA->eof)
      {
        $confdelete=false;
      } 
        $RSA = NULL;$dataRSA=NULL;// //$RSA->close;
    } 


    if ($confdelete)
    {
 
       $strSQL="DELETE from ".$TableName." Where ".$TableKey."=".$qryid.";";
       $RSA=mysqli_query($DBO,$strSQL);
       $RSA=NULL;$dataRSA=NULL;
       header("Location: AdminDBADMdocuanx.php");
    }
      else
    {

      $AdminMessage=" Impossible de supprimer cette ligne car elle comprend des enregistrements connexes." + $strSQL;
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