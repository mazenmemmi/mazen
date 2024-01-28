<?php
include("../common/configinc.inc");
header('Content-Type: text/html;charset=UTF-8 '); //'
ob_start();
/*$DBO  = mysqli("localhost", "dcstecgr_artcomu", "artcom2015artcom","dcstecgr_webdbfr");
if ($DBO-> connect_errno) {
 echo "Failed to connect to MySQL: " . $DBO -> connect_error;
 exit();
}*/
$DBO =new mysqli("localhost", "dcstecgr_artcomu", "artcom2015artcom","dcstecgr_webdbfr");

if ($DBO -> connect_errno) {
 echo "Failed to connect to MySQL: " . $DBO -> connect_error;
 exit();
}
mysqli_select_db($DBO,'dcstecgr_webdbfr');
/* 2021 session_start();*/
 // Option $explicit;
 header("Cache-control: public, max-age=10");
 header("Pragma:no-cache");
header("Expires: " . gmdate("D, d M Y H:i:s", time() + (0*60)) . " GMT");

//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%

//  Author: 	Sghaier Mahmoud www:www.icare.com.tn @:technique.icare@planet.tn
//  Purpose: DREAM EDIT (back-end) ADMIN SETTINGS v 1.2 ASP
//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
//  parametres

// [unsupported] session.timeout=90// admin session time out in minute;
// DB
// OPEN DB
// $DBO is of type "ADODB.Connection"
//******************************
//*******************************
/*
$dbstring="Data Source=".$DOCUMENT_ROOT."../".$DbPath.$Dbname.";Provider=Microsoft.Jet.OLEDB.4.0;";
$a2p_connstr=$dbstring;
$a2p_uid=strstr($a2p_connstr,'uid');
$a2p_uid=substr($d,strpos($d,'=')+1,strpos($d,';')-strpos($d,'=')-1);
$a2p_pwd=strstr($a2p_connstr,'pwd');
$a2p_pwd=substr($d,strpos($d,'=')+1,strpos($d,';')-strpos($d,'=')-1);
$a2p_database=strstr($a2p_connstr,'dsn');
$a2p_database=substr($d,strpos($d,'=')+1,strpos($d,';')-strpos($d,'=')-1);*/
//**************************************************
/*$DBO=mysql_connect("localhost",$a2p_uid,$a2p_pwd);
mysql_select_db($a2p_database,$DBO);
*/

//**************************************************
// uplader config
$wexRoot= $DeWebVirtualPath.$DeImageVirtualPath;
$wexRootPath=$wexRoot;//$wexRootPath=RealizePath($wexRoot);

// RS
// PREPARE RS
// $RSA is of type "ADODB.Recordset"
// $RSB is of type "ADODB.Recordset"
// $RSC is of type "ADODB.Recordset"

// DB constants (DON'T MODIFY THIS)
//---- CursorTypeEnum Values ----
$adOpenForwardOnly=0;
$adOpenKeyset=1;
$adOpenDynamic=2;
$adOpenStatic=3;

//---- LockTypeEnum Values ----
$adLockReadOnly=1;
$adLockPessimistic=2;
$adLockOptimistic=3;
$adLockBatchOptimistic=4;
$reco="";
$recoo="";
$recooo="";
//$chma="Document";
//-- Temp Style for rounded win (WILL BE REPLACED)
//if ((strpos($GetUserAgent,"IE") ? strpos($GetUserAgent,"IE")+1 : 0)!=0)
 //{

  //$tempRoundedColor="#1E5CA8";
//}
 // else
//{

  //$tempRoundedColor="#5c9dcc";
//} 

?>


