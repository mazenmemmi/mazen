<?php
session_start();
  include("adminsettings.php");
  include("../common/tools.php");
$DBO =new mysqli("localhost", "dcstecgr_artcomu", "artcom2015artcom","dcstecgr_webdbfr");

if ($DBO -> connect_errno) {
    echo "Failed to connect to MySQL: " . $DBO -> connect_error;
    exit();
}
mysqli_select_db($DBO,'dcstecgr_webdbfr');
  if (isset($_SESSION['ADMINUSERLOGGED']))
{

  $strsql="UPDATE users SET logged=0 ,logoutDateTime=".time()." where id=".$_SESSION['ADMINUSERID']."  ;";
    $RSA = mysqli_query($DBO,$strsql);
} 
 
  

if ($_SERVER["REQUEST_METHOD"]=$_POST)
{
	
if (isset($_POST["_send"]))
{
  $username=trim(str_replace("'","''",$_POST["frmuser"]));
  $password=trim(str_replace("'","''",$_POST["frmmdp"]));
  $strsql="select * from users where username='".$username."' and password='".$password."' ;";
 $Rsdoc = mysqli_query($DBO,$strsql) or die('Erreur SQL !<br>'.$strsql.'<br>'.mysqli_error());
 
  if (mysqli_num_rows($Rsdoc)==1)
  {
	  
	$res=mysqli_fetch_array($Rsdoc);
   {
       $strsql2="UPDATE users SET logged=true ,loggedDateTime=NOW() where username='".$username."' and password='".$password."' ;";
     mysqli_query($DBO,$strsql2) ;//update echo "<br>1<br> ";;
	 $strsql3=$strsql;
	 $Rslog=mysqli_query($DBO,$strsql3) ;//refaire la selection
	 $reslog=mysqli_fetch_array($Rslog);
	$_SESSION['ADMINUSERLOGGED']=1;
    $_SESSION['ADMINUSERID']=$reslog["ID"];
    $_SESSION['ADMINUSERNAME']=$reslog["reelName"];
    $_SESSION['ADMINPROFIL']=$reslog["PROFIL"];
    $_SESSION['ADMINACESS']=$reslog["loggedDateTime"];
 //header("Location: "."adminmenu.php");
	echo "<html><script language=\"javascript\">location.href='adminmenu.php'</script></html>";
 // echo  $_SESSION['ADMINUSERID'];
  }
  }
    else
  {
    loginform("<font color=red>Utilisateur  / Mot de passe incorrect !</font>");
  } 

$Rsdoc=NULL;
$res=NULL;
$Rslog=NULL;
$reslog=NULL; 
}
}
  else
{

  loginform("Introduisez votre Login et Mot de passe");
}




























function loginform($themessage)
{
  extract($GLOBALS);
?>
<HTML>
<HEAD>
<TITLE>Administration</TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<link href="adminstyles.css" rel="stylesheet" type="text/css">
</HEAD>
<BODY BGCOLOR=#5C9DCC LEFTMARGIN=0 TOPMARGIN=0 MARGINWIDTH=0 MARGINHEIGHT=0>
<table border="0" width="100%" cellspacing="3" cellpadding="3">
  <tr>
    <td width="33%" valign="top">
    </td>
    <td width="33%" valign="top">
      <div align="center">
        <center>
<TABLE WIDTH=245 BORDER=0 CELLPADDING=0 CELLSPACING=0>
	<TR>
		<TD COLSPAN=2 ROWSPAN=2>
			<IMG SRC="images/wcorner1.gif" width=10 height=10 ALT=""></TD>
		<TD BGCOLOR=#1E5CA8>
			<IMG SRC="images/spacer.gif" WIDTH=225 HEIGHT=1 ALT=""></TD>
		<TD COLSPAN=2 ROWSPAN=2>
			<IMG SRC="images/wcorner2.gif" width=10 height=10 ALT=""></TD>
	</TR>
	<TR>
		<TD BGCOLOR=#D2DEEE>
			<IMG SRC="images/spacer.gif" WIDTH=225 HEIGHT=9 ALT=""></TD>
	</TR>
	<TR>
		<TD BGCOLOR=#1E5CA8>
			<IMG SRC="images/spacer.gif" WIDTH=1 HEIGHT=20 ALT=""></TD>
		<TD BGCOLOR=#D2DEEE>
			<IMG SRC="images/spacer.gif" WIDTH=9 HEIGHT=29 ALT=""></TD>
		<TD BGCOLOR=#D2DEEE>
            <table border="0" width="100%">
              <tr>
                <td width="100%">
                  <p align="center">
                  <img border="0" src="images/logo_de_l.gif" width="197" height="46">
                  </p>
                </td>
              </tr>
              <tr>
                <td width="100%">
                  <table border="0" width="100%" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="12%"><img border="0" src="images/icon_login.gif" width="20" height="21">
                      </td>
                      <td width="88%"><b><font face="Arial" size="3" color="#1A62B0">Login</font></b></td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td width="100%">
                <?php   //thisscript();?>
         <form method="POST" action="login.php?_send" id="form1" name="form1">
          <table border="0" cellSpacing="1" width="250" bgcolor="#D2DEEE">
            <tr>
              <td  width="100%" colspan="2"><?php   echo $themessage;?></td>
            </tr>
            <tr>
              <td  width="34%"><b>Login</b></td>
              <td  width="66%"><input name="frmuser" size="20"></td>
            </tr>
            <tr>
              <td  width="34%"><b>Password</b></td>
              <td  width="66%"><input name="frmmdp" size="20" type="password" value></td>
            </tr>
            <tr>
              <td width="34%">&nbsp;</td>
              <td  width="66%"><input class="noborders" border="0" type="image" src="images/bt_login.gif" id=image1 name=I1 alt="LOGIN" width="58" height="17"></td>
            </tr>
        </table>
        <input type="hidden" name="_send" value ="true">
         </Form> </td></tr></table>
        </TD>
		<TD BGCOLOR=#D2DEEE>
			<IMG SRC="images/spacer.gif" WIDTH=9 HEIGHT=29 ALT=""></TD>
		<TD BGCOLOR=#1E5CA8>
			<IMG SRC="images/spacer.gif" WIDTH=1 HEIGHT=20 ALT=""></TD>
	</TR>
	<TR>
		<TD COLSPAN=2 ROWSPAN=2>
			<IMG SRC="images/wcorner4.gif" WIDTH=10 HEIGHT=11 ALT=""></TD>
		<TD BGCOLOR=#D2DEEE>
			<IMG SRC="images/spacer.gif" WIDTH=225 HEIGHT=10 ALT=""></TD>
		<TD COLSPAN=2 ROWSPAN=2>
			<IMG SRC="images/wcorner3.gif" WIDTH=10 HEIGHT=11 ALT=""></TD>
	</TR>
	<TR>
		<TD BGCOLOR=#1E5CA8>
			<IMG SRC="images/spacer.gif" WIDTH=225 HEIGHT=1 ALT=""></TD>
	</TR>
</TABLE>
</center>
      </div>
    </td>
    <td width="34%" valign="top">
    </td>
  </tr>
</table>
</BODY>
</HTML>
<?php

} 
?>
