<?php
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
                      <td width="5%"><img border="0" src="images/icon_config.gif">
                      </td>
                      <td width="95%" valign="bottom" class="titles">
                      <font color="#1A62B0"><b>Configuration >> </b></font>
                      <font color="#008000"><b>Modifier la configuration</b></font></td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td width="100%">
<!-- End Win Head -->    

<!-- content -->     

<?php 

//$qrymode=${"mode"};
if(isset($_POST["mode"])){$qrymode=$_POST["mode"];}else{if(isset($_GET["mode"])){$qrymode=$_GET["mode"];}else{$qrymode=NULL;}}

$file="../common/configinc.inc";

//  verif privilege 
if ($_SESSION['ADMINPROFIL']!="AD")
{

  $AdminMessage="Accès non autorisé <br>( vous n'avez pas de privilèges pour cette rubrique )";
}
  else
{


  switch ($qrymode)
  {
    case "": edit();break;
	case "update":update(); break;
  } 

} 


?>
<SCRIPT LANGUAGE="javascript">
function docvalidator()
{
       
	
}
</SCRIPT>
<?php function edit()
{
  extract($GLOBALS);
?>
<?php 
  $filemode=1;
  // $fso is of type "Scripting.FileSystemObject"
  $ts=fopen($file,"r");
  //$filecontent=fgets($ts,65535);;
   

?>
<form action="Admincomfiginc.php" method="post" name="theform" onSubmit="return docvalidator()">
   <table border="0" width="100%" bgcolor="#A4BCDD" cellpadding="2" cellspacing="1">
       
       <tr>
        <td width="100%" bgcolor="#C6D6E8"><b><font color="#800000">Fichier de configuration</font></b></td>
       </tr> 
       <tr>
        <td width="100%" bgcolor="#C6D6E8">   
          <textarea name = "content" rows="20" cols="80"><?php  
		  while (($filecontent = fgets($ts, 65535)) !== false) 
        { echo $filecontent;  }  fclose($ts);?></textarea>  
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
<?php 
}  
function update()
{
  extract($GLOBALS);


  $filemode=2;
  // $fso is of type "Scripting.FileSystemObject"

  $ts=fopen($file,"w+");
  if (($ts)==0)
  {

?>
    <table border="0" width="100%" bgcolor="#A4BCDD" cellpadding="2" cellspacing="1">
     <tr><td width="100%" bgcolor="#C6D6E8">
  <?php 
    echo "<font color=red>Accés non autorisé ( Readonly )</font>";
?>
  </td></tr></table>
  <?php 
  }
    else
  {

    fputs($ts,$_POST["content"]);
    fclose($ts);
    header("Location: adminmenu.php");
  } 



 //return $function_ret;
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


