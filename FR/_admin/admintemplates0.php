<?php
  session_start();
function admmenu()
{
  extract($GLOBALS);
?>
<!--

******************************************************

ADMIN MENU 

******************************************************

-->
<table border="0" width="100%" cellspacing="3" cellpadding="3">
  <tr>
    <td width="33%" valign="top">
<div align="center">
  <center>
<TABLE BORDER=0 CELLPADDING=0 CELLSPACING=0>
	<TR>
		<TD COLSPAN=2 ROWSPAN=2>
			<IMG SRC="images/wcorner1.gif" width=10 height=10 ALT=""></TD>
		<TD BGCOLOR=#1E5CA8 width="100%">
			<IMG SRC="images/spacer.gif" WIDTH=225 HEIGHT=1 ALT=""></TD>
		<TD COLSPAN=2 ROWSPAN=2>
			<IMG SRC="images/wcorner2.gif" width=10 height=10 ALT=""></TD>
	</TR>
	<TR>
		<TD BGCOLOR=#D2DEEE width="100%">
			<IMG SRC="images/spacer.gif" WIDTH=225 HEIGHT=9 ALT=""></TD>
	</TR>
	<TR>
		<TD BGCOLOR=#1E5CA8>
			<IMG SRC="images/spacer.gif" WIDTH=1 HEIGHT=20 ALT=""></TD>
		<TD BGCOLOR=#D2DEEE>
            <IMG SRC="images/spacer.gif" WIDTH=9 HEIGHT=284 ALT=""></TD>
		<TD BGCOLOR=#D2DEEE valign="top" width="100%">
            <table border="0" width="100%" bgcolor="#A4BCDD" cellspacing="1">
              <tr>
                <td width="100%" bgcolor="#D2DEEE">
                  <table border="0" width="100%" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="18%"><img border="0" src="images/icon_screen.gif">
                      </td>
                      <td width="82%" valign="bottom"><b><font face="Arial" color="#1A62B0" size="2">L’arborescence</font></b></td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td width="100%" bgcolor="#FFFFFF" height="18"><img border="0" src="images/pucevert.gif">&nbsp;<a href="AdminDBADMsections.php">Sections</a></td>
              </tr>
              <tr>
                <td width="100%" bgcolor="#FFFFFF" height="18"><img border="0" src="images/pucevert.gif">&nbsp;<a href="AdminDBADMrubs.php">Rubriques</a></td>
              </tr>
              <tr>
                <td width="100%" bgcolor="#FFFFFF" height="18"><img border="0" src="images/pucevert.gif">&nbsp;<a href="AdminDBADMsubrubs.php">Sous-rubriques</a></td>
              </tr>
              <tr>
                <td width="100%" bgcolor="#FFFFFF" height="18"><img border="0" src="images/pucevert.gif">&nbsp;<a href="AdminDBADMmh.php">Menu haut</a></td>
              </tr>
              <tr>
                <td width="100%" bgcolor="#D2DEEE">
                  <table border="0" width="100%" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="19%"><img border="0" src="images/icon_content.gif" width="39" height="37">
                      </td>
                      <td width="81%" valign="bottom"><b><font face="Arial" color="#1A62B0" size="2">Contenu</font></b></td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td width="100%" bgcolor="#FFFFFF" height="18"><img border="0" src="images/pucevert.gif" >&nbsp;<a href="Adminhome.php">Page d'accueil</a></td>
              </tr>
              <tr>
                <td width="100%" bgcolor="#FFFFFF" height="12"><img border="0" src="images/pucevert.gif" >&nbsp;<a href="AdminDBADMdocu.php">Documents</a></td>
              </tr>
              <tr>
                <td width="100%" bgcolor="#FFFFFF" height="18"><img border="0" src="images/pucevert.gif" >&nbsp;<a href="AdminDBADMdocumh.php">Documents du menu haut</a></td>
              </tr>
              <tr>
                <td width="100%" bgcolor="#FFFFFF" height="18"><img border="0" src="images/pucevert.gif" width="14" height="14">&nbsp;<a href="AdminDBADMdocuanx.php">Documents annexes</a></td>
              </tr>
              <tr>
                <td width="100%" bgcolor="#FFFFFF" height="18"><img border="0" src="images/pucevert.gif" width="14" height="14">&nbsp;<a href="AdminDBADMlink.php">Liens</a></td>
              </tr>
              <tr>
                <td width="100%" bgcolor="#FFFFFF" height="18"><img border="0" src="images/pucevert.gif" width="14" height="14">&nbsp;<a href="AdminDBADMlinkmh.php">Liens du menu haut</a></td>
              </tr>
              <tr>
                <td width="100%" bgcolor="#FFFFFF" height="18"><img border="0" src="images/pucevert.gif" width="14" height="14">&nbsp;<a href="AdminDBADMnews.php">News</a></td>
              </tr>
            </table>
        </TD>
		<TD BGCOLOR=#D2DEEE>
			<IMG SRC="images/spacer.gif" WIDTH=9 HEIGHT=29 ALT=""></TD>
		<TD BGCOLOR=#1E5CA8>
			<IMG SRC="images/spacer.gif" WIDTH=1 HEIGHT=20 ALT=""></TD>
	</TR>
	<TR>
		<TD COLSPAN=2 ROWSPAN=2>
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
    <td width="33%" valign="top">
<div align="center">
  <center>
<TABLE width=100% BORDER=0 CELLPADDING=0 CELLSPACING=0>
	<TR>
		<TD COLSPAN=2 ROWSPAN=2>
			<IMG SRC="images/wcorner1.gif" width=10 height=10 ALT=""></TD>
		<TD BGCOLOR=#1E5CA8 width="100%">
			<IMG SRC="images/spacer.gif" WIDTH=225 HEIGHT=1 ALT=""></TD>
		<TD COLSPAN=2 ROWSPAN=2>
			<IMG SRC="images/wcorner2.gif" width=10 height=10 ALT=""></TD>
	</TR>
	<TR>
		<TD BGCOLOR=#D2DEEE width="100%">
			<IMG SRC="images/spacer.gif" WIDTH=225 HEIGHT=9 ALT=""></TD>
	</TR>
	<TR>
		<TD BGCOLOR=#1E5CA8>
			<IMG SRC="images/spacer.gif" WIDTH=1 HEIGHT=20 ALT=""></TD>
		<TD BGCOLOR=#D2DEEE>
            <IMG SRC="images/spacer.gif" WIDTH=9 HEIGHT=284 ALT=""></TD>
		<TD BGCOLOR=#D2DEEE valign="top" width="100%">
            <table border="0" width="100%" bgcolor="#A4BCDD" cellspacing="1">
              <tr>
                <td width="100%" bgcolor="#D2DEEE">
                  <table border="0" width="100%" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="20%"><img border="0" src="images/icon_feedback.gif" width="40" height="39">
                      </td>
                      <td width="80%" valign="bottom"><b><font face="Arial" color="#1A62B0" size="2">FeedBack</font></b></td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td width="100%" bgcolor="#FFFFFF"><img border="0" src="images/pucevert.gif" width="14" height="14">&nbsp;<a href="AdminDBVcontact.php">Etats des contacts</a></td>
              </tr>
              <tr>
                <td width="100%" bgcolor="#FFFFFF"><img border="0" src="images/pucevert.gif" width="14" height="14">&nbsp;<a href="AdminDBVml.php">Abonnés à la mailinglist</a></td>
              </tr>
              <tr>
                <td width="100%" bgcolor="#FFFFFF"><img border="0" src="images/pucevert.gif" width="14" height="14">&nbsp;<a href="AdminMassmailer.php">Envoi de messages groupés</a></td>
              </tr>
              <tr>
                <td width="100%" bgcolor="#D2DEEE">
                  <table border="0" width="100%" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="19%"><img border="0" src="images/icon_ressources.gif" width="38" height="35">
                      </td>
                      <td width="81%" valign="bottom"><b><font face="Arial" color="#1A62B0" size="2">Ressources</font></b></td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td width="100%" bgcolor="#FFFFFF"><img border="0" src="images/pucevert.gif" width="14" height="14">&nbsp;<a href="AdminDBADMrescat.php">Catégories de ressources</a></td>
              </tr>
              <tr>
                <td width="100%" bgcolor="#FFFFFF"><img border="0" src="images/pucevert.gif" width="14" height="14">&nbsp;<a href="AdminDBADMres.php">Ressources</a></td>
              </tr>
              <tr>
                <td width="100%" bgcolor="#D2DEEE">
                  <table border="0" width="100%" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="18%"><img border="0" src="images/icon_banners.gif" width="37" height="37">
                      </td>
                      <td width="82%" valign="bottom"><b><font face="Arial" color="#1A62B0" size="2">Bannières</font></b></td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td width="100%" bgcolor="#FFFFFF"><img border="0" src="images/pucevert.gif" width="14" height="14">&nbsp;<a href="AdminDBADMbh.php">Bannières horizontale</a></td>
              </tr>
              <tr>
                <td width="100%" bgcolor="#FFFFFF"><img border="0" src="images/pucevert.gif" width="14" height="14">&nbsp;<a href="AdminDBADMbv.php">Bannières verticale</a></td>
              </tr>
            </table>
        </TD>
		<TD BGCOLOR=#D2DEEE>
			<IMG SRC="images/spacer.gif" WIDTH=9 HEIGHT=29 ALT=""></TD>
		<TD BGCOLOR=#1E5CA8>
			<IMG SRC="images/spacer.gif" WIDTH=1 HEIGHT=20 ALT=""></TD>
	</TR>
	<TR>
		<TD COLSPAN=2 ROWSPAN=2>
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
    <td width="34%" valign="top">
<div align="center">
  <center>
<TABLE width=100% BORDER=0 CELLPADDING=0 CELLSPACING=0>
	<TR>
		<TD COLSPAN=2 ROWSPAN=2>
			<IMG SRC="images/wcorner1.gif" width=10 height=10 ALT=""></TD>
		<TD BGCOLOR=#1E5CA8 width="100%">
			<IMG SRC="images/spacer.gif" WIDTH=225 HEIGHT=1 ALT=""></TD>
		<TD COLSPAN=2 ROWSPAN=2>
			<IMG SRC="images/wcorner2.gif" width=10 height=10 ALT=""></TD>
	</TR>
	<TR>
		<TD BGCOLOR=#D2DEEE width="100%">
			<IMG SRC="images/spacer.gif" WIDTH=225 HEIGHT=9 ALT=""></TD>
	</TR>
	<TR>
		<TD BGCOLOR=#1E5CA8>
			<IMG SRC="images/spacer.gif" WIDTH=1 HEIGHT=20 ALT=""></TD>
		<TD BGCOLOR=#D2DEEE>
            <IMG SRC="images/spacer.gif" WIDTH=9 HEIGHT=284 ALT=""></TD>
		<TD BGCOLOR=#D2DEEE valign="top" width="100%">
            <table border="0" width="100%" bgcolor="#A4BCDD" cellspacing="1">
              <tr>
                <td width="100%" bgcolor="#D2DEEE">
                  <table border="0" width="100%" cellspacing="0" cellpadding="0" height="41">
                    <tr>
                      <td width="18%" height="41"><img border="0" src="images/icon_config.gif" width="37" height="40">
                      </td>
                      <td width="82%" height="41" valign="bottom"><b><font face="Arial" color="#1A62B0" size="2">Configuration</font></b></td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td width="100%" bgcolor="#FFFFFF"><img border="0" src="images/pucevert.gif" width="14" height="14">&nbsp;<a href="Admincomfiginc.php">Modifier la configuration</a></td>
              </tr>
              <tr>
                <td width="100%" bgcolor="#FFFFFF"><img border="0" src="images/pucevert.gif" width="14" height="14">&nbsp;<a href="#">Gestion des Utilisateurs</a></td>
              </tr>
              <tr>
                <td width="100%" bgcolor="#FFFFFF"><img border="0" src="images/pucevert.gif" width="14" height="14">&nbsp;<a href="Admincomfigcss.php">Modifier la feuille de style</a></td>
              </tr>
              <tr>
                <td width="100%" bgcolor="#D2DEEE">
                  <table border="0" width="100%" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="18%">
                      <img border="0" src="images/icon_histo.gif" width="36" height="37">
                      </td>
                      <td width="82%" valign="bottom"><b><font face="Arial" color="#1A62B0" size="2">Sondage</font></b></td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td width="100%" bgcolor="#FFFFFF"><img border="0" src="images/pucevert.gif" width="14" height="14">&nbsp;<a href="AdminDBADMqu.php">Questions</a></td>
              </tr>
              <tr>
                <td width="100%" bgcolor="#FFFFFF"><img border="0" src="images/pucevert.gif" width="14" height="14">&nbsp;<a href="AdminDBADMvt.php">Options&nbsp;</a></td>
              </tr>
              <tr>
                <td width="100%" bgcolor="#D2DEEE">
                  <table border="0" width="100%" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="18%"><img border="0" src="images/icon_forum.gif" width="35" height="33">
                      </td>
                      <td width="82%" valign="bottom"><b><font face="Arial" color="#1A62B0" size="2">Forum</font></b></td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td width="100%" bgcolor="#FFFFFF"><img border="0" src="images/pucevert.gif" width="14" height="14">&nbsp;<a href="#">Administration du forum</a></td>
              </tr>
            </table>
        </TD>
		<TD BGCOLOR=#D2DEEE>
			<IMG SRC="images/spacer.gif" WIDTH=9 HEIGHT=29 ALT=""></TD>
		<TD BGCOLOR=#1E5CA8>
			<IMG SRC="images/spacer.gif" WIDTH=1 HEIGHT=20 ALT=""></TD>
	</TR>
	<TR>
		<TD COLSPAN=2 ROWSPAN=2>
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
<?php 
} 
 function admhead()
{
  extract($GLOBALS);
?>
<!--

******************************************************

ADMIN HEADER 

******************************************************

-->
<HTML>
<HEAD>
<TITLE>Administration</TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<link href="adminstyles.css" rel="stylesheet" type="text/css">
<SCRIPT language="JavaScript" src="../common/tools.js"></script>
</HEAD>
<BODY BGCOLOR=#5C9DCC LEFTMARGIN=0 TOPMARGIN=0 MARGINWIDTH=0 MARGINHEIGHT=0>

<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td width="100%" height="83" background="images/topbck.gif">
      <table border="0" width="100%" cellspacing="0" cellpadding="0">
        <tr>
          <td width="50%"><img border="0" src="images/logo_de.gif" width="368" height="80"></td>
          <td width="50%">
            <table border="0" width="100%" cellspacing="1">
              <tr>
                <td width="100%" align="right">
                  <font color="#FFFFFF"><b><?php   echo $AppDeName;?></b> <?php   echo $AppEngine;?> v<?php   echo $AppVersion;?>&nbsp;</font></td>
              </tr>
              <tr>
                <td width="100%" align="right"><?php   echo $AppClientHTML;?></td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td width="100%" bgcolor="#000000" height="1"><img border="0" src="images/spacer.gif" width="1" height="1"></td>
  </tr>
  <tr>
    <td width="100%" height="15" bgcolor="#D2DEEE">
     <?php
  switch ($_SESSION['ADMINPROFIL'])
  {
    case "AD":  $profil="Administrateur"; break;
    case "AU":$profil="Auteur";break;
	case "VL":$profil="Validateur"; break;
    case "GU":$profil="Invité"; break;
  } 
?>
     <table border="0" width="100%">
        <tr>
          <td width="3%"><img border="0" src="images/iconuser.gif" width="18" height="20"></td>
          <td width="63%">&nbsp;<b><font color="#800000">Connecté</font></b> : <?php   echo $_SESSION['ADMINUSERNAME'];?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <b><font color="#800000">Profil</font></b> : <?php   echo $profil;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#800000"><b>Accès le</b></font> : <?php   echo $_SESSION['ADMINACESS'];?>  </td>
          <td width="34%" align="right">
            <?php   if ($thisscript!="adminmenu.php")
  {
?>
            <a href="adminmenu.php"><img border="0" src="images/iconmenu.gif"></a>&nbsp;
            <?php   } ?>
            <a href="#"><img border="0" src="images/iconaide.gif"></a>&nbsp;
            <a href="login.php"><img border="0" src="images/iconlogout.gif"></a>
            </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td width="100%" bgcolor="#000000" height="2"><img border="0" src="images/spacer.gif" width="1" height="1"></td>
  </tr>
</table>
<?php   
} function admfoot()
{
  extract($GLOBALS);
?>
<? 
// Close DBO
  $DBO=null;

?>
<!--

***************************

ADMIN FOOTER 

***************************

-->
<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td width="100%" bgcolor="#000000" height="1"><img border="0" src="images/spacer.gif" width="1" height="1"></td>
  </tr>
  <tr>
    <td bgcolor="#D2DEEE" align="right"><?   echo $AppCopyHTML;?></td>
  </tr>
  <tr>
    <td  bgcolor="#000000"><img border="0" src="images/spacer.gif" width="1" height="1"></td>
  </tr>
  <tr>
    <td  height="15"></td>
  </tr>
</table>
</BODY>
</HTML>
<?php
  }
 ?>
