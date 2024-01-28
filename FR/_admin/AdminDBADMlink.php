<?php
include ('adminsettings.php');
include ('../common/tools.php');
include ('admintemplates.php');
include ('adminsecurity.php');
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
                      <font color="#008000"><b>Liens</b></font></td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td width="100%">
<!-- End Win Head -->    

<!-- content -->     
<?php 
if(isset($_POST["mode"])){$qrymode=$_POST["mode"];
}else{ 
	if(isset($_GET["mode"])){$qrymode=$_GET["mode"];
	}else{$qrymode=NULL;}}
if(isset($_POST["frmid"])){$qryid=$_POST["frmid"];
}else{if(isset($_GET["frmid"])){$qryid=$_GET["frmid"];}else{$qryid=NULL;}}
if(isset($_GET["frmidxid"])){$qryidxid=$_GET["frmidxid"];}else{$qryidxid=NULL;}
if(isset($_GET["frmidx0id"])){$qryidx0id=$_GET["frmidx0id"];}else{$qryidx0id=NULL;}
if(isset($_GET["frmidxSid"])){$qryidxSid=$_GET["frmidxSid"];}else{$qryidxSid=NULL;}
if(isset($_GET["ro"])){$qryro=$_GET["ro"];}else{$qryro=NULL;}
//Pour l'ajout
if(isset($_GET["vall"])){$vale=$_GET["vall"];}

$TableName="links";
$TableKey="linkid";
$OrderBy="";
$ViewFields="*";

// Index Table ( Relation Table )
$ITableName="m_rubrique";
$ITableKey="rubID";
$ITableTitle="rublibelle";
$IOrderBy="ruborder";
$ICriteria="And rubTYPE='LINK'";

// Related Index Table 
$ITableName0="m_categorie";
$ITableKey0="catID";
$ITableTitle0="catlibelle";
$IOrderBy0="catorder";

// related table (integrity) ( 2 table ) for delete
$RTableName1="";
$RTableKey1="";
$RTableName2="";
$RTableKey2="";

// get idx0 from idx
if ($qryidxid!=NULL)
{

  $strSQL="SELECT * from ".$ITableName." where ".$ITableKey."=".$qryidxid." ;";
   $RSA=NULL;
} 


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
      break;
    case "edit":
      edit();
      break;
    case "add":
      add();
      break;
    case "sup":
      sup();

      break;
    case "update":
      update();
      break;
    case "addnew":
      addnew();
      break;
  } 

} 


?>
<SCRIPT LANGUAGE="javascript">
function validatetheform()
{ 
 if (document.theform.frmlink.value=='')
  {
 alert ('lien manquant !');
 document.theform.frmlink.focus();
 return false;
  }
 
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
         <tr>
         <td bgcolor="#C6D6E8" colspan="4">
         <form name="Sfrom">
         <table  cellpadding="2" cellspacing="1"  width="100%" border="0">
          <tr><td width="10%">
               <font color="#800000"><b>S�lectionnez la section:</b></font><br>
               <select name="frmidxid" size="5" class="SELECTCLASS" onChange="goidx0(this.options[selectedIndex].value,'AdminDBADMlink.php')">
                            <?php   if ($qryidx0id=="-1" || $qryidx0id=="")
  {
// if catid empty ?>
                            <option selected value="-1">[ S�lection ]</option>
                            <?php   }
    else
  {
?>
                            <option value="-1">[ S�lection ]</option>
                            <?php   } ?>
                            <?php 
  $strSQL="SELECT * from ".$ITableName0." ORDER BY ".$IOrderBy0." ;";
  //$RSA->Open$strSQL  $DBO  $adOpenStatic  $adLockReadOnly;
  $RSA=mysqli_query($DBO,$strSQL);
  while($dats=mysqli_fetch_array($RSA))
  {
?>
                            <option value="<?php     echo $dats[$ITableKey0];?>" <?php     if ($qryidx0id==($dats[$ITableKey0]))
    {
      echo "selected";
    } ?>><?php    echo $dats[$ITableTitle0];?></option>
                            <?php     
  } 
  $RSA=NULL;
  $dats=NULL;
?>   
                 </select>              
         </td>
         <?php   if (!($qryidx0id=="-1" || $qryidx0id==""))
  {
// if index0 selected ( foreing key ) ?> 
         <td width="90%">
               <font color="#800000"><b>S�lectionnez la rubrique:</b></font><br>
               <select name="frmidxid" size="5" class="SELECTCLASS" onChange="goidx(this.options[selectedIndex].value,'AdminDBADMlink.php')">
                            <?php     if ($qryidxid=="-1" || $qryidxid=="")
    {
// if catid empty ?>
                            <option selected value="-1">[ S�lection ]</option>
                            <?php     }
      else
    {
?>
                            <option value="-1">[ S�lection ]</option>
                            <?php     } ?>
                            <?php 
    $strSQL="SELECT * from ".$ITableName." WHERE  ".$ITableKey0."=".$qryidx0id." ".$ICriteria." ORDER BY ".$IOrderBy." ;";
     $RSA=mysqli_query($DBO,$strSQL)or die('Erreur SQL1 !<br>'.$strSQL.'<br>'.mysqli_error());
  while($dats=mysqli_fetch_array($RSA))
 
    {
?>
                            <option value="<?php       echo $dats[$ITableKey];?>" <?php       if ($qryidxid==($dats[$ITableKey]))
      {
        echo "selected";
      } ?>><?php       echo $dats[$ITableTitle];?></option>
                            <?php       
    } 
    $RSA=NULL;
	$dats=NULL;
?>   
                 </select>         
         </td>
         <?php   } ?> 
          </tr>
         </table>
         </form>    
         </td>
        </tr>
         <?php   if (!($qryidxid=="-1" || $qryidxid==""))
  {
// if index selected  ?>  
         <?php 
    $strSQL="SELECT ".$ViewFields." from ".$TableName." WHERE ".$ITableKey."=".$qryidxid."  ;";
   // $RSA->Open$strSQL    $DBO    $adOpenStatic    $adLockReadOnly;
  $RSA=mysqli_query($DBO,$strSQL);
  while($dats=mysqli_fetch_array($RSA))
?>
         <tr>
           <td width="50%" bgcolor="#C6D6E8" height="20"><font color="#800000"><B>Lien</B></font></td>
           <td width="50%" bgcolor="#C6D6E8" height="20"><font color="#800000"><b>Action</b></font></td>
          </tr>
          <?php   while($dats=mysqli_fetch_array($RSA))
    {
?>
              <tr bgcolor="#EEF2F9">
                <td> <?php       echo $dats["Link"];?></td>
                 <td>
                <a href="AdminDBADMlink.php?mode=edit&frmid=<?php       echo $dats[$TableKey];?>&frmidxid=<?php       echo $qryidxid;?>"><IMG border="0" SRC="images/bt_modif.gif" alt="Modifier"></a>
                <a href="javascript:confirmDelete('AdminDBADMlink.php?mode=sup&frmid=<?php       echo $dats[$TableKey];?>&frmidxid=<?php       echo $qryidxid;?>')"><IMG border="0" SRC="images/bt_supp.gif" alt="Supprimer"></a>
                </td>
              </tr>
     
         <?php     } ?>
         <?php     if (mysqli_num_rows($RSA)>1)
    {
?>
         <tr bgcolor="#C6D6E8">
         <td colspan="1">&nbsp;</td>
         <td><a href="AdminDBADMlink.php?mode=add&frmidxid=<?php       echo $qryidxid;?>"><IMG border="0" SRC="images/bt_add.gif" alt="Ajouter"></a></td>
         </tr>
         <?php     } ?>
         <?php     $RSA=NULL;$dats=NULL;?>
         <?php   } ?>
</table>

<?php 
$function_ret=0;
return $function_ret;
  } ?>

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
//'''''''''''''''''''''''''
// MASK EDIT DB RECORDS
//'''''''''''''''''''''''''
  $strSQL="SELECT * from ".$TableName." Where ".$TableKey."=".$qryid.";";
  $RSA=mysqli_query($DBO,$strSQL);
?>
        <form method="POST" action="<?php   echo AdminDBADMlink.php;?>?frmidxid=<?php   echo $qryidxid;?>" name="theform" onSubmit="return validatetheform()">   
                  <table border="0" width="100%" bgcolor="#A4BCDD" cellspacing="1">
                    <tr>
                      <td width="20%" bgcolor="#C6D6E8"><b><font color="#800000">Lien</font></b></td>
                      <td width="80%" bgcolor="#FFFFFF"><input type="text" maxlength="255" name="frmlink" size="30" value="<?php   echo $RSA["link"];?>"></td>
                    </tr>
                    <tr>
                      <td bgcolor="#C6D6E8">&nbsp;</td>
                      <td bgcolor="#C6D6E8">
                      <input type="image" border="0" class="noborders"  SRC="images/bt_validate.gif" alt="Valider" id=image1 name=image1>&nbsp;
                       <a href="<?php   echo AdminDBADMlink.php;?>?frmidxid=<?php   echo $qryidxid;?>"><IMG border="0" SRC="images/bt_cancel.gif" alt="Annuler"></a>
                      </td>
                    </tr>
                  </table>
                  <input type=hidden name="mode" value="update">
                  <input type=hidden name="frmid" value="<?php   echo $RSA[$TableKey];?>">
    </form> 
    <?php   $RSA=NULL;?>
<?php  
} ?>

<?php function add()
{
  extract($GLOBALS);
?> 
<?php 
//'''''''''''''''''''''''''
// MASK ADD NEW DB RECORDS
//'''''''''''''''''''''''''
?>
    <form method="POST" action="<?php   echo AdminDBADMlink.php;?>?frmidxid=<?php   echo $qryidxid;?>" name="theform" onSubmit="return validatetheform()">   
      <table border="0" width="100%" bgcolor="#A4BCDD" cellspacing="1">
                     <tr>
                      <td width="20%" bgcolor="#C6D6E8"><b><font color="#800000">Lien</font></b></td>
                      <td width="80%" bgcolor="#FFFFFF"><input type="text" maxlength="255" name="frmlink" size="30" value=""></td>
                    </tr>
                      <tr>
                      <td bgcolor="#C6D6E8">&nbsp;</td>
                      <td bgcolor="#C6D6E8">
                      <input type="image" border="0" class="noborders"  SRC="images/bt_validate.gif" alt="Valider" id=image1 name=image1>&nbsp;
                       <a href="<?php   echo AdminDBADMlink.php;?>?frmidxid=<?php   echo $qryidxid;?>"><IMG border="0" SRC="images/bt_cancel.gif" alt="Annuler"></a>
                      </td>
                    </tr>
                  </table>
                  <input type=hidden name="mode" value="addnew">
        </form> 
<?php   return $function_ret;
} ?>


<?php 
function update()
{$DBO =new mysqli("localhost", "dcstecgr_artcomu", "artcom2015artcom","dcstecgr_webdbfr");

    if ($DBO -> connect_errno) {
        echo "Failed to connect to MySQL: " . $DBO -> connect_error;
        exit();
    }
    mysqli_select_db($DBO,'dcstecgr_webdbfr');
  extract($GLOBALS);

// update rec

  $strSQL="SELECT * from ".$TableName." Where ".$TableKey."=".$qryid.";";
  $RSA=mysqli_query($DBO,$strSQL);

  $RSA["link"]=$_POST["frmlink"];

  $RSA=NULL;

 /* print "<html><script language=\"javascript\">location.href='".thisscript(."?frmidxid=".$qryidxid."'</script></html>");*/
//Response.Redirect (thisscript) 
  
} 

function addnew()
{$DBO =new mysqli("localhost", "dcstecgr_artcomu", "artcom2015artcom","dcstecgr_webdbfr");

    if ($DBO -> connect_errno) {
        echo "Failed to connect to MySQL: " . $DBO -> connect_error;
        exit();
    }
    mysqli_select_db($DBO,'dcstecgr_webdbfr');
  extract($GLOBALS);

// addnew rec
  $strSQL="SELECT top 1 * from ".$TableName." ;";
  $RSA=mysqli_query($DBO,$strSQL);
  
  $RSA->addnew;

  $RSA["link"]=$_POST["frmlink"];

  $RSA[$ITableKey]=$qryidxid;
  $RSA[$ITableKey0]=$qryidx0id;

  $RSA->Update();

  $RSA->close;
  /*print "<html><script language=\"javascript\">location.href='".thisscript(."?frmidxid=".$qryidxid."'</script></html>");*/
//Response.Redirect (thisscript)
  return $function_ret;
} 

function sup()
{$DBO =new mysqli("localhost", "dcstecgr_artcomu", "artcom2015artcom","dcstecgr_webdbfr");

    if ($DBO -> connect_errno) {
        echo "Failed to connect to MySQL: " . $DBO -> connect_error;
        exit();
    }
    mysqli_select_db($DBO,'dcstecgr_webdbfr');
  extract($GLOBALS);

  $confdelete=true;
// verify integrity 1
  if ($RTableName1!="")
  {

    $strSQL="SELECT * from ".$RTableName1." Where ".$RTableKey1."=".$qryid.";";
  //  $RSA->Open$strSql    $DBO    $adOpenStatic    $adLockReadOnly;
  $RSA=mysqli_query($DBO,$strSQL);
    if (!$RSA->eof)
    {
      $confdelete=false;
    } 
    $RSA=NULL;
	
  } 


  if ($RTableName2!="")
  {

// verify integrity 2
    $strSQL="SELECT * from ".$RTableName2." Where ".$RTableKey2."=".$qryid.";";
  //  $RSA->Open$strSql    $DBO    $adOpenStatic    $adLockReadOnly;
  $RSA=mysqli_query($DBO,$strSQL);
    if (!$RSA->eof)
    {
      $confdelete=false;
    } 
    $RSA=NULL;
  } 


  if ($confdelete)
  {

// del
    $strSQL="SELECT * from ".$TableName." Where ".$TableKey."=".$qryid.";";
   // $RSA->Open$strSql    $DBO    $adOpenStatic    $adLockOptimistic;
    $RSA=mysqli_query($DBO,$strSQL);
	$RSA->delete;
    $RSA=NULL;
   // header("Location: ".thisscript(."?frmidxid=".$qryidxid));
  }
    else
  {

    $AdminMessage="Impossible de supprimer cette ligne car elle comprend des enregistrements connexes.";
  } 


  return $function_ret;
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


