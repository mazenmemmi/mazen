
<?php
ob_start();
include("configinc.inc");
header('Content-Type: text/html; charset=ISO-8859-1');
$mydbobj =new mysqli("localhost", "dcstecgr_artcomu", "artcom2015artcom","dcstecgr_webdbfr"); 

    if ($mydbobj -> connect_errno) {
        echo "Failed to connect to MySQL: " . $mydbobj -> connect_error;
        exit();
    }
mysqli_select_db($mydbobj,'dcstecgr_webdbfr');

if(isset ($_GET["dev"])){$rmydev=$_GET["dev"];}
if(isset ($_GET["dev"])){$rmydev=true;}else{$rmydev=false;} 
if(isset ($_GET["arid"])){$rmyarid=$_GET["arid"]; }
if(isset ($_GET["artid"])){$rmyartid=$_GET["artid"]; }else {$rmyartid=NULL;}

?>



