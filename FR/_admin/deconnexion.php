<?php
session_start();
include ("adminsettings.php");
include "../common/tools.php";
$DBO =new mysqli("localhost", "dcstecgr_artcomu", "artcom2015artcom","dcstecgr_webdbfr");

if ($DBO -> connect_errno) {
    echo "Failed to connect to MySQL: " . $DBO -> connect_error;
    exit();
}
mysqli_select_db($DBO,'dcstecgr_webdbfr');
$strSQL="UPDATE users SET logged=0 where id =".$_SESSION['ADMINUSERID'].";";
$RSA = mysqli_query($DBO,$strSQL) or die('Erreur SQL !<br>'.$strSQL.'<br>'.mysqli_error());
$RSA=NULL;



	unset($_SESSION['ADMINUSERLOGGED']);
   unset( $_SESSION['ADMINUSERID']);
    unset($_SESSION['ADMINUSERNAME']);
   unset( $_SESSION['ADMINPROFIL']);
   unset( $_SESSION['ADMINACESS']); 
    unset($_SESSION);
unset($_COOKIE);
session_destroy(); 
echo "<html><script language=\"javascript\">location.href='login.php'</script></html>";
exit();

?>