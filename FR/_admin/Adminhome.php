<?php
  /*session_start();
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
                      <font color="#008000"><b>Page d'accueil</b></font></td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td width="100%">
<!-- End Win Head -->    

<!-- content -->     
<?php 
//dim ,qryid,TableName,TableKey,OrderBy
//dim RtableName1,RTableKey1,RtableName2,RTableKey2
//$qrymode=${"mode"};
if(isset ($_GET["mode"])){$qrymode=$_GET["mode"];}else{$qrymode=NULL;}

//  verif privilege 
if ($_SESSION['ADMINPROFIL']!="AD")
{

  $AdminMessage="Acc�s non autoris� <br>( vous n'avez pas de privil�ges pour cette rubrique )";
}
  else
{


  switch ($qrymode)
  {
    
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
	
}
</SCRIPT>
<?php function edit()
{$DBO =new mysqli("localhost", "dcstecgr_artcomu", "artcom2015artcom","dcstecgr_webdbfr");

    if ($DBO -> connect_errno) {
        echo "Failed to connect to MySQL: " . $DBO -> connect_error;
        exit();
    }
    mysqli_select_db($DBO,'dcstecgr_webdbfr');
  extract($GLOBALS);
?>
<?php 
  $strSQL="SELECT * from documents where type='HOME'";
  //$RSA->Open$strSQL  $DBO  $adOpenStatic  $adLockReadOnly;
  $RSA=mysqli_query($DBO,$strSQL);
  $dataRSA=mysqli_fetch_array($RSA);
?>
<form action=Adminhome.php method="get" name="theform" onSubmit="return docvalidator()">
   <table border="0" width="100%" bgcolor="#A4BCDD" cellpadding="2" cellspacing="1">
       <tr>
          <td bgcolor="#C6D6E8" height="20">
               <?php   
  {
?>
               <textarea name = "content" rows="20" cols="70"><?php     echo $dataRSA["docbody"];?></textarea>
               <input type="hidden" name="WYSIWYGMode" value="off">
               <?php   } ?> 
               <?php   $RSA=NULL; $dataRSA=NULL;?>
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
<?php  // return $function_ret;
} ?>


<?php 
function update()
{
    $DBO = new mysqli("localhost", "dcstecgr_artcomu", "artcom2015artcom", "dcstecgr_webdbfr");

    if ($DBO->connect_errno) {
        echo "Failed to connect to MySQL: " . $DBO->connect_error;
        exit();
    }
    mysqli_select_db($DBO, 'dcstecgr_webdbfr');
    extract($GLOBALS);

    // update rec
    $strSQL = "UPDATE documents SET docbody=? WHERE type='HOME'";

    // Utilisation d'une requête préparée
    $stmt = $DBO->prepare($strSQL);
    $stmt->bind_param("s", $_GET["content"]);

    // Exécution de la requête préparée
    $stmt->execute();

    // Fermeture de la requête préparée
    $stmt->close();

    // Redirection vers adminmenu.php après la mise à jour
    header("Location: adminmenu.php");
}
?>

// function update()
// {$DBO =new mysqli("localhost", "dcstecgr_artcomu", "artcom2015artcom","dcstecgr_webdbfr");

//     if ($DBO -> connect_errno) {
//         echo "Failed to connect to MySQL: " . $DBO -> connect_error;
//         exit();
//     }
//     mysqli_select_db($DBO,'dcstecgr_webdbfr');
//   extract($GLOBALS);

// // update rec

//   //$strSQL="SELECT * from documents where type='HOME'";
//   $strSQL="UPDATE documents SET docbody='".$_GET["content"]."' where type='HOME';"; //addslashes: evite ajoute des slashes pour les apostrophes qui g�ne lors de l'update.
//  //echo $strSQL;

//   $RSA=mysqli_query($DBO, $strSQL);
//   $RSA=NULL;
//    header("Location: adminmenu.php");
// } 



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


