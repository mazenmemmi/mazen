<?php
 // session_start();
$DBO =new mysqli("localhost", "dcstecgr_artcomu", "artcom2015artcom","dcstecgr_webdbfr");

if ($DBO -> connect_errno) {
    echo "Failed to connect to MySQL: " . $DBO -> connect_error;
    exit();
}
mysqli_select_db($DBO,'dcstecgr_webdbfr');
include("adminsettings.php");
include ("../common/tools.php");
?>
<HTML>
<head>
<title>::</title>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<link href="adminstyles.css" type="text/css" rel="stylesheet">
</head>
<BODY BGCOLOR=#FFFFFF LEFTMARGIN=2 TOPMARGIN=2 MARGINWIDTH=2 MARGINHEIGHT=2 scroll=yes>
<?php 

$ID=$_GET["id"];
/*
if ($ID=="")
{
  echo "<html><script language=\"javascript\">window.close()</script></html>";
} 
*/
$strsql="select * from contactlist where id=".$ID." ;";
$RSA =  mysqli_query($DBO,$strsql) or die('Erreur SQL !<br>'.$strsql.'<br>'.mysqli_error());
$dataRSA = mysqli_fetch_assoc($RSA);
//$RSA->Open$strSQL$DBO$adOpenStatic$adLockReadOnly;

?>
        <table width="450" bgcolor="#A4BCDD" cellspacing="1" align="center">
            <tr>
              <td vAlign="top" width="648" colSpan="2" bgcolor="#C6D6E8"><font color="#800000"><b>D�tails 
                du contact</b></font></td>
            </tr>
            <tr>
              <td vAlign="top" width="335" bgcolor="#EEF2F9"><font color="#800000">Nom et pr�nom :</font></td>
              <td width="313" bgcolor="#FFFFFF" vAlign="top"> <b><?php echo $dataRSA["nom"];?></b></td>
            </tr>
            <tr>
              <td width="335" bgcolor="#EEF2F9" vAlign="top"><font color="#800000">Soci�t� :</font></td>
              <td width="255" bgcolor="#FFFFFF" vAlign="top"> <b><?php echo $dataRSA["company"];?></b></td>
            </tr>
            <tr>
              <td width="335" bgcolor="#EEF2F9" vAlign="top"><font color="#800000">Fonction :</font></td>
              <td width="255" bgcolor="#FFFFFF" vAlign="top"><?php echo $dataRSA["fonction"];?></td>
            </tr>
            <tr>
              <td width="335" bgcolor="#EEF2F9" vAlign="top"><font color="#800000">Email :</font></td>
              <td width="255" bgcolor="#FFFFFF" vAlign="top"><?php echo $dataRSA["email"];?></td>
            </tr>
            <tr>
              <td vAlign="top" width="335" bgcolor="#EEF2F9"><font color="#800000">T�l. :</font></td>
              <td width="255" bgcolor="#FFFFFF" vAlign="top"><?php echo $dataRSA["tel"];?></td>
            </tr>
            <tr>
              <td width="335" bgcolor="#EEF2F9" vAlign="top"><font color="#800000">Fax :</font></td>
              <td width="255" bgcolor="#FFFFFF" vAlign="top"><?php echo $dataRSA["fax"];?></td>
            </tr>
            <tr>
              <td width="335" bgcolor="#EEF2F9" vAlign="top"><font color="#800000">Adresse :</font></td>
              <td width="255" bgcolor="#FFFFFF" vAlign="top"><?php echo $dataRSA["adresse"];?></td>
            </tr>
             <tr>
              <td width="335" bgcolor="#EEF2F9" vAlign="top"><font color="#800000">Pays :</font></td>
              <td width="255" bgcolor="#FFFFFF" vAlign="top"><?php echo $dataRSA["country"];?></td>
            </tr>
            <tr>
              <td width="335" bgcolor="#EEF2F9" vAlign="top"><font color="#800000">Suject du message :</font></td>
              <td width="234" bgcolor="#FFFFFF" vAlign="top"><b><?php echo $dataRSA["subject"];?><b></td>
            </tr>
            <tr>
              <td width="335" bgcolor="#EEF2F9" vAlign="top"><font color="#800000">Date / Heure :</font></td>
              <td width="234" bgcolor="#FFFFFF" vAlign="top"><b><?php echo $dataRSA["thedate"];?><b></td>
            </tr>
            <tr>
              <td colspan=2 bgcolor="#EEF2F9" vAlign="top"><font color="#800000"><b>Message :</b></font></td>
              
            </tr>
            <tr>
              <td colspan=2 bgcolor="#EEF2F9" vAlign="top"><?php echo $dataRSA["message"];?></font></td>
            </tr>
        </table>
        <p align=center><img src="images/bt_ok.gif" onClick="window.close()" style="cursor:hand"></p>
</BODY>               
</HTML>
<?php 
// kill rs
//$RSA->close;
$RSA=null;

// forget database connection
//$DBO->close;
//$DBO=null;

?>
