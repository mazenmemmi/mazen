<?php
  /*session_start();
  session_register("ADMINPROFIL_session");
  session_register("ADMINUSERNAME_session");
  session_register("ADMINACESS_session");
  session_register("ADMINUSERLOGGED_session");
  session_register("ADMINUSERID_session");
*/
 include("adminsettings.php");
 include("../common/tools.php");
 include("admintemplates.php");
 include("adminsecurity.php");
 
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
                      <td width="5%"><img border="0" src="images/icon_feedback.gif">
                      </td>
                      <td width="95%" valign="bottom" class="titles">
                      <font color="#1A62B0"><b>FeedBack >> </b></font>
                      <font color="#008000"><b>Etats des contacts</b></font></td>
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
// paging
$pagesize=10;

if(isset ($_GET["page"])){$mypage=intval($_GET["page"]);}else{$mypage=0;}//$mypage=intval(${"page"});
if ($mypage==0)
{
  $mypage=1;
} 

$TableName="contactlist";
$TableKey="id";
$OrderBy="thedate desc";

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
    
    case "":
      Previewdb();
      break;
    case "view":
      $view;
//case "edit" edit
//case "add"  add
      break;
    case "sup":
      sup();
      break;
    case "trt":
      trt();
      break;
  } 

} 


?>
<SCRIPT LANGUAGE="javascript">
function validatetheform()
{ 

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
<?php 
// paging
  //$RSA->PageSize=$pagesize;
  //$RSA->CursorLocation=3;

  $strSQL="SELECT * from ".$TableName." ORDER BY ".$OrderBy.";"; 
  $RSA = mysqli_query($DBO,$strSQL);
  //$dataRSA1 = mysql_fetch_assoc($RSA) ; 
//  $RSA->Open$strSQL  $DBO  $adOpenStatic  $adLockReadOnly;

// paging
  $pagecount=mysqli_num_fields($RSA);//$RSA->PageCount ;//mysqli_num_fields($RSA)
 $reccount=mysqli_num_rows($RSA);//$RSA->RecordCount;
 
// Just in case we have a bad request
  if ($mypage>$pagecount)
  {
    $mypage=$pagecount;
  } 
  if ($mypage<1)
  {
    $mypage=1;
  } 

// Set the page we want to display
  if (!$RSA)
  {
  
    //$RSA->AbsolutePage=$mypage;
  }
    else
  {

    $mypage=0;
  } 


?>
<table border="0" width="100%" bgcolor="#A4BCDD" cellpadding="2" cellspacing="1">
          <tr>
           <td colspan=8 height="25" align=right>
                    <font color="#800000">
                    <?php   print $reccount." Enregistrement(s)   &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;  Page: ";?>
                    <?php   if ($mypage>1)
  {
// paging ?>
                    <img  onmouseup="javascript:location.href='AdminDBVcontact.php?page=<?php     echo $mypage-1;?>'" src="images/bt_pgprev.gif"  align="absbottom" style="cursor:hand"> &nbsp;
                    <?php   }
    else
  {
?>
                    <img  src="images/bt_nopg.gif"  align="absbottom"> &nbsp;
                    <?php   } ?>
                    <?php   print $mypage."/".$pagecount;?>
                    <?php   if ($mypage==$pagecount)
  {
?>
                    <img   src="images/bt_nopg.gif"  align="absbottom"> &nbsp;&nbsp;&nbsp;
                    <?php   }
    else
  {
?>
                    <img  onmouseup="javascript:location.href='AdminDBVcontact.php?page=<?php     echo $mypage+1;?>'" src="images/bt_pgnext.gif" align="absbottom" style="cursor:hand"> &nbsp;&nbsp;&nbsp;
                    <?php   } ?>
                    </font>
          </td> 
         </tr>
          <tr>
           <td width="15%" bgcolor="#C6D6E8" height="20"><font color="#800000"><B>Nom et prenom </B></font></td>
           <td width="10%" bgcolor="#C6D6E8" height="20"><font color="#800000"><B>Entreprise</B></font></td>
           <td width="10%" bgcolor="#C6D6E8" height="20"><font color="#800000"><b>T�l.</b></font></td>
           <td width="10%" bgcolor="#C6D6E8" height="20"><font color="#800000"><b>Email</b></font></td>
           <td width="20%" bgcolor="#C6D6E8" height="20"><font color="#800000"><b>Sujet</b></font></td>
           <td width="10%" bgcolor="#C6D6E8" height="20"><font color="#800000"><b>Date/heure</b></font></td>
           <td width="5%" bgcolor="#C6D6E8" height="20"><font color="#800000"><b>Trait�?</b></font></td>
           <td width="20%" bgcolor="#C6D6E8" height="20"><font color="#800000"><b>Action</b></font></td>
          </tr>
         
          <?php //$dataRSA = mysql_fetch_assoc($RSA);// if (!$dataRSA = mysql_fetch_assoc($RSA))
      while(($dataRSA = mysqli_fetch_assoc($RSA)))
  {
	
?>
          <?php   //for ($counter=1; $counter<=$reccount; $counter=$counter+1) //  for ($counter=1; $counter<=$pagesize; $counter=$counter+1)
    {?>
              <tr bgcolor="#EEF2F9">
                <td><?php       echo $dataRSA["nom"];?></td>
                <td><?php       echo $dataRSA["company"];?></td>
                <td><?php       echo $dataRSA["tel"];?></td>
                <td><font color="#800000"><b>@:</b></font><a href="mailto:<?php       echo $dataRSA["email"];?>"><?php       echo $dataRSA["email"];?></a></td>
                <td><font color=blue><b><?php       echo $dataRSA["subject"];?></b></font></td>
                <td><font color=blue><?php       echo $dataRSA["thedate"];?></font></td>
                <td align="center">
                <?php       if ($dataRSA["trt"])
      {
?>
                   <a href="AdminDBVcontact.php?mode=trt&frmid=<?php         echo $dataRSA[$TableKey];?>"><img border = "0" src="images/bt_trt.gif"></a>
                 <?php       }
        else
      {
?>
                    <a href="AdminDBVcontact.php?mode=trt&frmid=<?php         echo $dataRSA[$TableKey];?>"><img border = "0" src="images/bt_notrt.gif"></a>
                 <?php       } ?>
                
                </td>
                <td>
                <a href="javascript:PopUpWin('winviewcnt.php?id=<?php  echo $dataRSA[$TableKey];?>',500,400)"><IMG border="0" SRC="images/bt_plus.gif" alt="D�tails"></a>
                <a href="javascript:confirmDelete('AdminDBVcontact.php?mode=sup&frmid=<?php       echo $dataRSA[$TableKey];?>')"><IMG border="0" SRC="images/bt_supp.gif" alt="Supprimer"></a>
                </td>
              </tr>
              <?php       //$dataRSA->MoveNext;?>
              <?php      // if ($rsa->EOF)
      {
       // break;
// paging  
      } ?>
         <?php 
    }?>
        <?php   } ?>  
       <?php  $RSA=NULL;// $RSA->close;?>
         
</table>
<?php   //return $function_ret;
} ?>


<?php 
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

	$RSA = mysqli_query($DBO,$strSQL) or die('Erreur SQL !<br>'.$strSQL.'<br>'.mysqli_error());
     while($dataRSA = mysqli_fetch_assoc($Rsdoc))
    { 
          $confdelete=false;//echo $dataRSA['docbody'];
    }
	$RSA=NULL;
  } 


  if ($RTableName2!="")
  {

// verify integrity 2
    $strSQL="SELECT * from ".$RTableName2." Where ".$RTableKey2."=".$qryid.";";
    $RSA = mysqli_query($DBO,$strSQL) or die('Erreur SQL !<br>'.$strSQL.'<br>'.mysqli_error());
     while($dataRSA = mysqli_fetch_assoc($Rsdoc))
    { 
          $confdelete=false;//echo $dataRSA['docbody'];
    }
	$RSA=NULL;
	$dataRSA=NULL;
  } 


  if ($confdelete)
  {

// del
   // $strSQL="SELECT * from ".$TableName." Where ".$TableKey."=".$qryid.";";
	 $strSQL="DELETE from ".$TableName." Where ".$TableKey."=".$qryid.";";
   // $RSA->Open$strSql    $DBO    $adOpenStatic    $adLockOptimistic;
    $RSA = mysqli_query($DBO,$strSQL) or die('Erreur SQL !<br>'.$strSQL.'<br>'.mysqli_error());

	$RSA=NULL;
    header("Location: AdminDBVcontact.php");
  }
    else
  {

    $AdminMessage="Impossible de supprimer cette ligne car elle comprend des enregistrements connexes.";
  } 


  return $function_ret;
} 



function trt()
{$DBO =new mysqli("localhost", "dcstecgr_artcomu", "artcom2015artcom","dcstecgr_webdbfr");

    if ($DBO -> connect_errno) {
        echo "Failed to connect to MySQL: " . $DBO -> connect_error;
        exit();
    }
    mysqli_select_db($DBO,'dcstecgr_webdbfr');
  extract($GLOBALS);

// update rec
 // $strSQL="SELECT * from ".$TableName." Where ".$TableKey."=".$qryid.";";
  $strSQL="UPDATE ".$TableName." SET trt = not(trt)  Where ".$TableKey."=".$qryid.";";
  $RSA = mysqli_query($DBO,$strSQL);
  //echo $strSQL;
 header("Location: AdminDBVcontact.php");
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


