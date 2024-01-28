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
                      <font color="#1A62B0"><b>Configuration >> </b></font>
                      <font color="#008000"><b>Gestion des utilisateurs</b></font></td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td width="100%">   
<?php
if(isset ($_GET["mode"])){$qrymode=$_GET["mode"];}else{$qrymode=NULL;}
if(isset ($_GET["frmid"])){$qryid=$_GET["frmid"];}else{$qryid=NULL;}
if(isset ($_GET["frmidxid"])){$qryidxid=$_GET["frmidxid"];} else{$qryidxid="";}
if(isset($_GET["vall"])){$vale=$_GET["vall"];}
 




//  verif privilege 
if ($_SESSION['ADMINPROFIL']!="AD")
{

  $AdminMessage="Accès non autorisé <br>( vous n'avez pas de privilèges pour cette rubrique )";
}
  else
{


  switch ($qrymode)
  {
    case "":Previewdb();break;

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
 alert ('Libellé manquant !');
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
{$DBO =new mysqli("localhost", "dcstecgr_artcomu", "artcom2015artcom","dcstecgr_webdbfr");

if ($DBO -> connect_errno) {
    echo "Failed to connect to MySQL: " . $DBO -> connect_error;
    exit();
}
mysqli_select_db($DBO,'dcstecgr_webdbfr');
  extract($GLOBALS);

?>
<table border="0" width="100%" bgcolor="#A4BCDD" cellpadding="2" cellspacing="1">
       
         <?php 
                            
  $strSQL="SELECT * from users ;";
    $RSA1=mysqli_query($DBO,$strSQL)or die(mysqli_error());
	?>
         <tr>
           <td width="20%" bgcolor="#C6D6E8" height="20"><font color="#800000"><B>Username</B></font></td>
           <td width="10%" bgcolor="#C6D6E8"><font color="#800000"><b>password</b></font></td>
  <td width="10%" bgcolor="#C6D6E8"><font color="#800000"><b>reelName</b></font></td>
		   <td width="7%" bgcolor="#C6D6E8"><font color="#800000"><b>logged</b></font></td>
		   <td width="13%" bgcolor="#C6D6E8"><font color="#800000"><b>Profil</b></font></td>
		   <td width="13%" bgcolor="#C6D6E8"><font color="#800000"><b>Action</b></font></td>
          </tr>
          <?php while(($res=mysqli_fetch_array($RSA1)))
    {
?>
              <tr bgcolor="#EEF2F9">
                <td> <?php    echo $res["username"];?></td>
                <td> <?php     echo $res["password"];?></td>
                <td> <?php     echo $res["reelName"];?></td>
				 <td> <?php     echo $res["Logged"];?></td>
				  <td> <?php     echo $res["PROFIL"];?></td>
            

                <td>
                <a href="AdminDBADMusers.php?mode=edit&frmid=<?php       echo $res["ID"];?>"><IMG border="0" SRC="images/bt_modif.gif" alt="Modifier"></a>
               <a href="javascript:confirmDelete('AdminDBADMusers.php?mode=sup&frmid=<?php       echo $res["ID"];?>')"><IMG border="0" SRC="images/bt_supp.gif" alt="Supprimer"></a>
                </td>
              </tr>
              
         <?php    
 }
            $RSA1=NULL;
			$res=NULL;
			?>
         <tr bgcolor="#C6D6E8">
  <td colspan="5">&nbsp;</td>
         <td><a href="AdminDBADMusers.php?mode=add"><IMG border="0" SRC="images/bt_add.gif" alt="Ajouter"></a></td>
         </tr>
         <?php   } ?>
</table>


<?php function edit()
{$DBO =new mysqli("localhost", "dcstecgr_artcomu", "artcom2015artcom","dcstecgr_webdbfr");

    if ($DBO -> connect_errno) {
        echo "Failed to connect to MySQL: " . $DBO -> connect_error;
        exit();
    }
    mysqli_select_db($DBO,'dcstecgr_webdbfr');
  extract($GLOBALS);
 
//'''''''''''''''''''''''''
// MASK EDIT DB RECORDS
//'''''''''''''''''''''''''
  $strSQL="SELECT * from users Where ID=".$qryid.";";
  $RSA=mysqli_query($DBO,$strSQL);
  //echo $qryid;
  $dataRSA=mysqli_fetch_array($RSA);
?>
                <form method="GET" action="AdminDBADMusers.php" name="theform" onSubmit="return validatetheform()">   
      <table border="0" width="100%" bgcolor="#A4BCDD" cellspacing="1">
                    <tr>
                      <td width="30%" bgcolor="#C6D6E8"><b><font color="#800000">username</font></b></td>
                      <td width="70%" bgcolor="#FFFFFF"><input type="text" maxlength="50" name="username" size="30" value="<?php echo $dataRSA["username"]; ?>"></td>
                    </tr>
 <tr>
                      <td width="30%" bgcolor="#C6D6E8"><b><font color="#800000">password</font></b></td>
                      <td width="70%" bgcolor="#FFFFFF"><input type="text" maxlength="50" name="password" size="30" value="<?php echo $dataRSA["password"]; ?>"></td>
                    </tr>
 <tr>
                      <td width="30%" bgcolor="#C6D6E8"><b><font color="#800000">reelName</font></b></td>
                      <td width="70%" bgcolor="#FFFFFF"><input type="text" maxlength="50" name="reelName" size="30" value="<?php echo $dataRSA["reelName"]; ?>"></td>
                    </tr>
 <tr>
                      <td width="30%" bgcolor="#C6D6E8"><b><font color="#800000">Logged</font></b></td>
                      <td width="70%" bgcolor="#FFFFFF"><input type="text" maxlength="50" name="Logged" size="30" value="<?php echo $dataRSA["Logged"]; ?>"></td>
                    </tr>
					 <tr>
                      <td width="30%" bgcolor="#C6D6E8"><b><font color="#800000">PROFIL</font></b></td>
                      <td width="70%" bgcolor="#FFFFFF"><input type="text" maxlength="50" name="PROFIL" size="30" value="<?php echo $dataRSA["PROFIL"]; ?>"></td>
                    </tr>
                    <tr>
                      <td bgcolor="#C6D6E8" colspan="5">
                 <input type="image" border="0" class="noborders"  SRC="images/bt_validate.gif" alt="Valider" id=image1 name=image1>&nbsp;
                       <a href="AdminDBADMusers.php"><IMG border="0" SRC="images/bt_cancel.gif" alt="Annuler"></a>
                      </td>
                    </tr>
                  </table>
                  <input type=hidden name="mode" value="update">
				  <input type=hidden name="frmid" value="<?php   echo $qryid ; ?>"> 
				  
                  
        </form> 
<?php   
}
 function add()
{
  extract($GLOBALS); 
//'''''''''''''''''''''''''
// MASK ADD NEW DB RECORDS
//'''''''''''''''''''''''''
?>
        <form method="GET" action="AdminDBADMusers.php" name="theform" onSubmit="return validatetheform()">   
      <table border="0" width="100%" bgcolor="#A4BCDD" cellspacing="1">
                    <tr>
                      <td width="30%" bgcolor="#C6D6E8"><b><font color="#800000">username</font></b></td>
                      <td width="70%" bgcolor="#FFFFFF"><input type="text" maxlength="50" name="username" size="30" value=""></td>
                    </tr>
 <tr>
                      <td width="30%" bgcolor="#C6D6E8"><b><font color="#800000">password</font></b></td>
                      <td width="70%" bgcolor="#FFFFFF"><input type="text" maxlength="50" name="password" size="30" value=""></td>
                    </tr>
 <tr>
                      <td width="30%" bgcolor="#C6D6E8"><b><font color="#800000">reelName</font></b></td>
                      <td width="70%" bgcolor="#FFFFFF"><input type="text" maxlength="50" name="reelName" size="30" value=""></td>
                    </tr>
 <tr>
                      <td width="30%" bgcolor="#C6D6E8"><b><font color="#800000">Logged</font></b></td>
                      <td width="70%" bgcolor="#FFFFFF"><input type="text" maxlength="50" name="Logged" size="30" value=""></td>
                    </tr>
					 <tr>
                      <td width="30%" bgcolor="#C6D6E8"><b><font color="#800000">PROFIL</font></b></td>
                      <td width="70%" bgcolor="#FFFFFF"><input type="text" maxlength="50" name="PROFIL" size="30" value=""></td>
                    </tr>
                    <tr>
                      <td bgcolor="#C6D6E8" colspan="5">
                 <input type="image" border="0" class="noborders"  SRC="images/bt_validate.gif" alt="Valider" id=image1 name=image1>&nbsp;
                       <a href="AdminDBADMusers.php"><IMG border="0" SRC="images/bt_cancel.gif" alt="Annuler"></a>
                      </td>
                    </tr>
                  </table>
                  <input type=hidden name="mode" value="addnew">
                  
        </form> 
<?php
 } 

 
function update()
{$DBO =new mysqli("localhost", "dcstecgr_artcomu", "artcom2015artcom","dcstecgr_webdbfr");

    if ($DBO -> connect_errno) {
        echo "Failed to connect to MySQL: " . $DBO -> connect_error;
        exit();
    }
    mysqli_select_db($DBO,'dcstecgr_webdbfr');
  extract($GLOBALS);
  $strSQL="UPDATE users SET username='".$_GET["username"]."',
                                    password ='".$_GET["password"]."',
                                    reelName='".$_GET["reelName"]."',
                                    Logged='".$_GET["Logged"]."',
                                    PROFIL='".$_GET["PROFIL"]."' Where ID=".$qryid.";";
         
 
  $RSA=mysqli_query($DBO,$strSQL);
  $RSA=NULL;
 
  echo "<html><script language=\"javascript\">location.href='AdminDBADMusers.php?frmidxid=".$qryidxid."'</script></html>";
  
}

function addnew()
{$DBO =new mysqli("localhost", "dcstecgr_artcomu", "artcom2015artcom","dcstecgr_webdbfr");

    if ($DBO -> connect_errno) {
        echo "Failed to connect to MySQL: " . $DBO -> connect_error;
        exit();
    }
    mysqli_select_db($DBO,'dcstecgr_webdbfr');
  extract($GLOBALS);

  	
$strSQL="INSERT INTO users (username,password, reelName,Logged,PROFIL) VALUES ('".$_GET["username"]."','".$_GET["password"]."','".$_GET["reelName"]."','".$_GET["Logged"]."','".$_GET["PROFIL"]."');";
 								
 $RSA=mysqli_query($DBO,$strSQL);

   $RSA=NULL;
 
  echo "<html><script language=\"javascript\">location.href='AdminDBADMusers.php'</script></html>";
} 

function sup()
{$DBO =new mysqli("localhost", "dcstecgr_artcomu", "artcom2015artcom","dcstecgr_webdbfr");

    if ($DBO -> connect_errno) {
        echo "Failed to connect to MySQL: " . $DBO -> connect_error;
        exit();
    }
    mysqli_select_db($DBO,'dcstecgr_webdbfr');
  extract($GLOBALS);

 
    
	$strSQL="DELETE from users Where ID=".$qryid.";";
    $RSA=mysqli_query($DBO,$strSQL);
    $RSA=Null;
    //header("Location: AdminDBADMusers.php?frmidxid=".$qryidxid);
 echo "<html><script language=\"javascript\">location.href='AdminDBADMusers.php'</script></html>";
} 

?>
<!-- end content -->

<!-- Win Foot -->
</td>
              </tr>
            </table>
        </TD>
	
	</TR>

	
</TABLE>
  </center>
</div>
    </td>
  </tr>
</table>
<!-- End Win Foot -->
<?php admfoot();?>


