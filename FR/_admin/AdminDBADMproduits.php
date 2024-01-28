<?php
  //session_start();
  include ("adminsettings.php");
  include ("../common/tools.php");
  include ("admintemplates.php");
  include ("adminsecurity.php");
  include ("dreamedit/dreameditor.php");

 admhead();?>
 <script>
    function AChg(){
        document.getElementById("testdiv" ).innerHTML=document.getElementById("content").value;
    }
    
    
    </script>
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
                      <font color="#008000"><b>Produits</b></font></td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td width="100%">
<!-- End Win Head -->    

<!-- content -->     
<?php
$DBO =new mysqli("localhost", "dcstecgr_artcomu", "artcom2015artcom","dcstecgr_webdbfr");

if ($DBO -> connect_errno) {
    echo "Failed to connect to MySQL: " . $DBO -> connect_error;
    exit();
}
mysqli_select_db($DBO,'dcstecgr_webdbfr');

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


$TableName="artproduit";
$TableKey="IDpro";
$OrderBy="docorder";
$ViewFields="IDpro,Nompro,srubID,Marquepro,Modelpro,Fabripro,
Refpro,Prixpro,brochurepro,caratecpro,imagepro,discriptionpro ";//$ViewFields="IDpro";//26-02-2013

// Index Table ( Relation Table )

$ITableName="m_rubrique";
$ITableKey="rubID";
$ITableTitle="rublibelle";
$IOrderBy="ruborder";
$ICriteria="And ( rubTYPE='PRO'  or rubopen=-1 ) ";

// Srub Relation if rubopen
$ITableNameS="m_sousrubrique";
$ITableKeyS="srubID";
$ITableTitleS="srubLibelle";
$IOrderByS="sruborder";
$ICriteriaS="And (srubTYPE='PRO')";

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


// get idx from idxS
if ($qryidxSid!=NULL)
{
  $strSQL="SELECT * from ".$ITableNameS." where ".$ITableKeyS."=".$qryidxSid." ;";
  $RSA=mysqli_query($DBO,$strSQL);
  $dataRSA=mysqli_fetch_array($RSA);
  $qryidxid=($dataRSA[$ITableKey]);
  $RSA=NULL;
  $dataRSA=NULL;
} 



// get idx0 from idx

if ($qryidxid!="")
{
 $strSQL="SELECT  * from ".$ITableName." where ".$ITableKey."=".    $qryidxid." ;";
  $RSA=mysqli_query($DBO,$strSQL);
  $dataRSA=mysqli_fetch_array($RSA);
  $qryidx0id=($dataRSA[$ITableKey0]);
  $RSA=NULL;
  $dataRSA=NULL;

} 



//  verif privilege 
if ($_SESSION['ADMINPROFIL']!="AD")
{

  $AdminMessage="Accès non autorisé <br>( vous n'avez pas de privilèges pour cette rubrique )";
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
 if (document.theform.frmdoctitle.value=='')
  {
 alert ('Titre manquant !');
 document.theform.frmdoctitle.focus();
 return false;
  }
 
if ( document.theform.frmdocorder.value != '' )
{ 
  if ( isNaN(parseInt(document.theform.frmdocorder.value,10))) 
   { alert ('Ordre manquant ou invalide') ; document.theform.frmdocorder.focus() ; 
    return false ; 
   }
  document.theform.frmdocorder.value=parseInt(document.theform.frmdocorder.value,10);
}
else
{ document.theform.frmdocorder.value='0'; }


if (typeof(document.theform.WYSIWYGMode)!='undefined') { return true; }
          
          // design mode
          SetHTMLMode(document.DHTMLEdit,false)
          // adjust images path  
          var im=document.DHTMLEdit.DOM.images;   
          var WEBROOT=BaseURL+WebVirtualPath
          for(i=0; i<im.length ;i++) 
           {
           var isource = im[i].src;
           isource = isource.substr(WEBROOT.length,isource.length);
           im[i].src = isource;     
           }
           MirrorContent=document.all.DHTMLEditMirror;
           MirrorContent.value=document.DHTMLEdit.DOM.body.createTextRange().htmlText;

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
         <td bgcolor="#C6D6E8" colspan="11">
         <form name="Sfrom">
         <table  cellpadding="2" cellspacing="1"  border="0">
       <tr>
		 <td>
        <font color="#800000"><b>Sélectionnez la section:</b></font><br>
               <select name="frmidxid" size="5" class="SELECTCLASS" onChange="goidx0(this.options[selectedIndex].value,'AdminDBADMproduits.php')">
               
                            <?php if ($qryidx0id=="-1" || $qryidx0id=="")
  {
// if catid empty ?>
                            <option selected value="-1">[ Sélection ]</option>
                            <?php   }
    else
  {
?>
                            <option value="-1">[ Sélection ]</option>
                            <?php   } ?>
                            <?php 
  $strSQL="SELECT * from ".$ITableName0." ORDER BY ".$IOrderBy0." ;";
  $RSA= mysqli_query($DBO,$strSQL);
  while($dataRSA=mysqli_fetch_array($RSA))
  {
?>
                            <option value="<?php     echo $dataRSA[$ITableKey0];?>" <?php     if ($qryidx0id==($dataRSA[$ITableKey0]))
    {
      echo "selected";
    } ?>><?php     echo $dataRSA[$ITableTitle0];?></option>
                            <?php    // $RSA->Movenext;
  } 
  $RSA=NULL;
  $dataRSA=NULL;
?>   
                 </select>              
         </td>
         <?php   if (!($qryidx0id=="-1" || $qryidx0id==""))
  {
?> 
         <td>
               <font color="#800000"><b>Sélectionnez la rubrique:</b></font><br>
               <select name="frmidxid" size="5" class="SELECTCLASS" onChange="goidx(this.options[selectedIndex].value,'AdminDBADMproduits.php')">
                            <?php     if ($qryidxid=="-1" || $qryidxid=="")
    {
// if catid empty ?>
                            <option selected value="-1">[ Sélection ]</option>
                            <?php     }
      else
    {
?>
                            <option value="-1">[ Sélection ]</option>
                            <?php     } ?>
                            <?php 
    $strSQL="SELECT * from ".$ITableName." WHERE  ".$ITableKey0."=".$qryidx0id." ".$ICriteria." ORDER BY ".$IOrderBy." ;";
    $RSA=mysqli_query($DBO,$strSQL)or die('Erreur SQL1 !<br>'.$strSQL.'<br>'.mysqli_error());;
	while($dataRSA2=mysqli_fetch_array($RSA))
    {
?>
                            <option value="<?php       if ($dataRSA2["rubopen"])
      {
        echo "+";
      } ?><?php       echo $dataRSA2[$ITableKey];?>" <?php       if ($qryidxid==($dataRSA2[$ITableKey]))
      {
        echo "selected";
      } ?>><?php       if ($dataRSA2["rubopen"])
      {
        echo "+";
      } ?><?php       echo $dataRSA2[$ITableTitle];?></option>
                            <?php      // $RSA->Movenext;
    } 
    $RSA=NULL;
	$dataRSA2=NULL;
?>   
                 </select>         
         </td>
         <?php   } ?> 
         <?php   if ($qryro=="true")
  {
?>
		 <td ><font color="#800000"><b>Sélectionnez la sous-rubrique</b></font><br>
	     <select name="frmidxid" size="5" class="SELECTCLASS" onChange="goidxS(this.options[selectedIndex].value,'AdminDBADMproduits.php')">
		 <option selected value="-1">[Sélection ]</option>           
        <?php 
    $strSQL="SELECT * from ".$ITableNameS." WHERE ".$ITableKey."=".$qryidxid." ".$ICriteriaS." ORDER BY ".$IOrderByS." ;";
    $RSA=mysqli_query($DBO,$strSQL)or die('Erreur SQL2 !<br>'.$strSQL.'<br>'.mysqli_error());
	while($dataRSA3=mysqli_fetch_array($RSA))
    {
?>
             <option value="<?php       echo $dataRSA3[$ITableKeyS];?>" <?php       if ($qryidxSid==($dataRSA3[$ITableKeyS]))
      {
        echo "selected";
      } ?>><?php       echo $dataRSA3[$ITableTitleS];?></option>
             <?php       
    } 
    $RSA=NULL;
	$dataRSA3=NULL;
?>
        </select>  
		 </td>
        <?php   } ?>
          </tr>
         </table>
         </form>    
         </td>
        </tr>
            <?php   if ((($qryidxid!="-1" && $qryidxid!="" && $qryro!="true") || ($qryidxSid!="-1" && $qryidxSid!="" && $qryro=="true")))
  {
?> 
         <?php 
    if ($qryro=="true")
    {

      $strSQL="SELECT ".$ViewFields." from ".$TableName." WHERE ".$ITableKeyS."=".$qryidxSid.";";
    }
      else
    {

      $strSQL="SELECT ".$ViewFields." from ".$TableName." WHERE ".$ITableKey."=".$qryidxid." ORDER BY ".$OrderBy." ;";
    } 


    $RSA=mysqli_query($DBO,$strSQL)or die('Erreur SQL3 !<br>'.$strSQL.'<br>'.mysqli_error());;
	
?>
         <tr>
           <td width="10%" bgcolor="#C6D6E8" height="20"><b><font color="#800000">Produits</font></b></td>
           <td width="10%" bgcolor="#C6D6E8" height="20"><font color="#800000"><b>Marque</b></font></td>
           <td width="10%" bgcolor="#C6D6E8" height="20"><font color="#800000"><b>Model</b></font></td>
           <td width="10%" bgcolor="#C6D6E8" height="20"><b><font color="#800000">Fabriquant</font></b></td>
           <td width="10%" bgcolor="#C6D6E8" height="20"><font color="#800000"><b>Réference</b></font></td>
           <td width="5%" bgcolor="#C6D6E8" height="20"><font color="#800000"><b>Prix</b></font></td>
           <td width="10%" bgcolor="#C6D6E8" height="20"><font color="#800000"><b>Brochure</b></font></td>
           <td width="5%" bgcolor="#C6D6E8" height="20"><font color="#800000"><b>Caractéristique</b></font></td>
           <td width="5%" bgcolor="#C6D6E8" height="20"><font color="#800000"><b>Images</b></font></td>
           <td width="5%" bgcolor="#C6D6E8" height="20"><font color="#800000"><b>Discription</b></font></td>
           <td width="20%" bgcolor="#C6D6E8" height="20"><font color="#800000"><b>Action</b></font></td>
          </tr>
          
   <?php while($dataRSA4=mysqli_fetch_array($RSA))  //  while(!$RSA->EOF)
    {
?>
              <tr bgcolor="#EEF2F9">
                <td> <?php       echo $dataRSA4["Nompro"];?></td>
                <td> <?php       echo $dataRSA4["Marquepro"];?></td>
                <td> <?php       echo $dataRSA4["Modelpro"];?></td>
                <td> <?php       echo $dataRSA4["Fabripro"];?></td>
                <td> <?php       echo $dataRSA4["Refpro"];?></td>
                <td> <?php       echo $dataRSA4["Prixpro"];?></td>
                <td align="center"> <b>[BROCHURE]</b></td>
                <td> <?php       echo $dataRSA4["caratecpro"];?></td>
          
                <td align="center"> <b>[IMAGE]</b></td>
                <td> <?php       echo $dataRSA4["discriptionpro"];?></td>
                <td>
  <?php       if ($qryro=="true")
      {
?> 
				<a href="AdminDBADMproduits.php?mode=edit&frmid=<?php         echo $dataRSA4[$TableKey];?>&ro=true&frmidxSid=<?php         echo $qryidxSid;?>"><IMG border="0" SRC="images/bt_modif.gif" alt="Modifier"></a>
                <a href="javascript:confirmDelete('AdminDBADMproduits.php?mode=sup&frmid=<?php         echo $dataRSA4[$TableKey];?>&ro=true&frmidxSid=<?php         echo $qryidxSid;?>')"><IMG border="0" SRC="images/bt_supp.gif" alt="Supprimer"></a>
			    <?php       }
        else
      {
?>
                <a href="AdminDBADMproduits.php?mode=edit&frmid=<?php         echo $dataRSA4[$TableKey];?>&frmidxid=<?php         echo $qryidxid;?>"><IMG border="0" SRC="images/bt_modif.gif" alt="Modifier"></a>
                <a href="javascript:confirmDelete('AdminDBADMproduits.php?mode=sup&frmid=<?php         echo $dataRSA4[$TableKey];?>&frmidxid=<?php         echo $qryidxid;?>')"><IMG border="0" SRC="images/bt_supp.gif" alt="Supprimer"></a>
                <?php       } ?>
                </td>
              </tr>
              <?php     //  $RSA->MoveNext;?>
         <?php     } ?>
         <?php     $RSA=NULL;
		           $dataRSA4=NULL;?>
         <tr bgcolor="#C6D6E8">
         <td colspan="10">&nbsp;</td>
         <td>
         <?php     if ($qryro=="true")
    {
?> 
				<a href="AdminDBADMproduits.php?mode=add&ro=true&frmidxSid=<?php       echo $qryidxSid;?>"><IMG border="0" SRC="images/bt_add.gif" alt="Ajouter"></a>
		<?php     }
      else
    {
?>
                <a href="AdminDBADMproduits.php?mode=add&frmidxid=<?php       echo $qryidxid;?>"><IMG border="0" SRC="images/bt_add.gif" alt="Ajouter"></a>
        <?php     } ?>
         </td>
         </tr>
         <?php   } ?>
</table>
<?php 
} 
function edit()
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
  $dataRSA5=mysqli_fetch_array($RSA);
?>
        <?php   if ($qryro=="true")
  {
?> 
			   <form method="POST" action="AdminDBADMproduits.php?ro=true&frmidxSid=<?php     echo $qryidxSid;?>" name="theform" onsubmit="return validatetheform()" enctype="multipart/form-data"><input type="hidden" name="MAX_FILE_SIZE" value="1000000000000" />       
		<?php   }
    else
  {
?>
               <form method="POST" action="AdminDBADMproduits.php?frmidxid=<?php     echo $qryidxid;?>" name="theform" onSubmit="return validatetheform()" enctype="multipart/form-data"><input type="hidden" name="MAX_FILE_SIZE" value="1000000000000" />    
        <?php   } ?>
        
        
                  <table border="0" width="100%" bgcolor="#A4BCDD" cellspacing="1">
                    <tr>
                      <td width="20%" bgcolor="#C6D6E8"><b><font color="#800000">Produits</font></b></td>
                      <td width="80%" bgcolor="#FFFFFF"><input name="frmNompro" type="text" id="frmNompro" value="<?php   echo $dataRSA5["Nompro"];?>" size="30" maxlength="255"></td>
                    </tr>
                    <tr>
                      <td bgcolor="#C6D6E8"><b><font color="#800000">Marque</font></b></td>
                      <td bgcolor="#FFFFFF"><input  name="frmMarquepro" type="text" id="frmMarquepro" value="<?php echo $dataRSA5["Marquepro"];?>" size="30"  maxlength="255"></td>
                    </tr>
                    <tr>
                      <td bgcolor="#C6D6E8"><font color="#800000"><b>Model</b></font></td>
                      <td bgcolor="#FFFFFF"><input name="frmModelpro" type="text" id="frmModelpro" value="<?php   echo $dataRSA5["Modelpro"];?>" size="30" maxlength="255" /></td>
                    </tr>
                    <tr>
                      <td bgcolor="#C6D6E8"><b><font color="#800000">Fabriquant</font></b></td>
                      <td bgcolor="#FFFFFF"><input name="frmFabripro" type="text" id="frmFabripro" value="<?php   echo $dataRSA5["Fabripro"];?>" size="30" maxlength="255" /></td>
                    </tr>
                    <tr>
                      <td bgcolor="#C6D6E8"><font color="#800000"><b>Réference</b></font></td>
                      <td bgcolor="#FFFFFF"><input name="frmRefpro" type="text" id="frmRefpro" value="<?php   echo $dataRSA5["Refpro"];?>" size="30" maxlength="255" /></td>
                    </tr>
                    <tr>
                      <td bgcolor="#C6D6E8"><font color="#800000"><b>Prix</b></font></td>
                      <td bgcolor="#FFFFFF"><input  name="frmPrixpro" type="text" id="frmPrixpro" onkeypress="event.returnValue=IsDigit();" value="<?php echo $dataRSA5["Prixpro"];?>" size="30" maxlength="4" /></td>
                    </tr>
                    <tr>
                      <td bgcolor="#C6D6E8"><font color="#800000"><b>Brochure </b></font></td>
                      <td bgcolor="#FFFFFF"><input type="file" name="frmbrochurepro"  value="<?php   echo $dataRSA5["brochurepro"];?>"></td>
                    </tr>
                    <tr>
                      <td bgcolor="#C6D6E8" valign="top"><font color="#800000"><b>Caracteristique</b></font></td>
                      <td bgcolor="#FFFFFF">
                        <textarea name="frmcaratecpro" rows="20" cols="70" id="frmcaratecpro"><?php     echo $dataRSA5["caratecpro"];?></textarea>
                        <input type="hidden" name="WYSIWYGMode" value="off">
                        
                        </td>
                    </tr>
                    <tr>
                      <td bgcolor="#C6D6E8"><font color="#800000"><b>Image</b></font></td>
                      <td bgcolor="#C6D6E8"><input type="file" name="frmimagepro"  value="<?php   echo $dataRSA5["imagepro"];?>" /></td>
                    </tr>
                    <tr>
                      <td bgcolor="#C6D6E8"><font color="#800000"><b>Discription</b></font></td>
                      <td bgcolor="#C6D6E8"><textarea name="frmdiscriptionpro" rows="20" cols="70"><?php     echo $dataRSA5["discriptionpro"];?>
                      </textarea></td>
                    </tr>
                    <tr>
                      <td bgcolor="#C6D6E8">&nbsp;</td>
                      <td bgcolor="#C6D6E8">
                      <input type="image" border="0" class="noborders"  SRC="images/bt_validate.gif" alt="Valider" id=image1 name=image1>&nbsp;
                      <?php   if ($qryro=="true")
  {
?> 
			              <a href="AdminDBADMproduits.php?ro=true&frmidxSid=<?php     echo $qryidxSid;?>"><IMG border="0" SRC="images/bt_cancel.gif" alt="Annuler"></a>
		              <?php   }
    else
  {
?>
                          <a href="AdminDBADMproduits.php?frmidxid=<?php     echo $qryidxid;?>"><IMG border="0" SRC="images/bt_cancel.gif" alt="Annuler"></a>
                      <?php   } ?>
                      </td>
                    </tr>
                  </table>
                  <input type=hidden name="mode" value="update">
                  <input type=hidden name="frmid" value="<?php   echo $dataRSA5[$TableKey];?>">
    </form> 
    <?php   $RSA=NULL;
	        $dataRSA5=NULL?>
<?php  
} 
 function add()
{
  extract($GLOBALS);
if ($qryro=="true")
  {
?> 
			   <form method="POST" action="AdminDBADMproduits.php?ro=true&frmidxSid=<?php     echo $qryidxSid;?>" name="theform" onsubmit="return validatetheform()" enctype="multipart/form-data"><input type="hidden" name="MAX_FILE_SIZE" value="1000000000000" />      
		<?php   }
    else
  {
?>
               <form method="POST" action="AdminDBADMproduits.php?frmidxid=<?php     echo $qryidxid;?>" name="theform" onSubmit="return validatetheform()" enctype="multipart/form-data"><input type="hidden" name="MAX_FILE_SIZE" value="100000000000" />       
        <?php   } ?>
      <table border="0" width="100%" bgcolor="#A4BCDD" cellspacing="1">
                    <tr>
                      <td width="20%" bgcolor="#C6D6E8"><b><font color="#800000"> Produits </font></b></td>
                      <td width="80%" bgcolor="#FFFFFF"><input type="text" maxlength="255" name="frmdoctitle" size="30" value=""></td>
                    </tr>
                    <tr>
                      <td bgcolor="#C6D6E8"><font color="#800000"><b>Marque</b></font></td>
                      <td bgcolor="#FFFFFF"><input type="text"  maxlength="255"  name="frmdocmarque" size="30" value=""></td>
                    </tr>
                    <tr>
                      <td bgcolor="#C6D6E8"><font color="#800000"><b>Model</b></font></td>
                      <td bgcolor="#FFFFFF"><input type="text"  maxlength="255"  name="frmdocmodel" size="30" value=""></td>
                    </tr>
                    <tr>
                      <td bgcolor="#C6D6E8"><font color="#800000"><b>Fabriquant</b></font></td>
                      <td bgcolor="#FFFFFF"><input type="text"  maxlength="255"  name="frmdocfab" size="30" value=""></td>
                    </tr>
                    <tr>
                      <td bgcolor="#C6D6E8"><font color="#800000"><b>Réference</b></font></td>
                      <td bgcolor="#FFFFFF"><input type="text"  maxlength="255"  name="frmdocref" size="30" value=""></td>
                    </tr>
                    <tr>
                      <td bgcolor="#C6D6E8"><font color="#800000"><b>Prix</b></font></td>
                      <td bgcolor="#FFFFFF"><input type="text" maxlength="255"  name="frmdocprix" size="30" value=""></td>
                    </tr><tr>
                      <td bgcolor="#C6D6E8"><font color="#800000"><b>Brochure </b></font></td>
                      <td bgcolor="#FFFFFF"><input type="text"  maxlength="255"  name="frmdobro" size="30" value=""></td>
                    </tr>
                    <tr>
                      <td bgcolor="#C6D6E8"><font color="#800000"><b>Caracteristique</b></font></td>
                      <td bgcolor="#FFFFFF">  <textarea name="frmdocara" rows="20" cols="70"></textarea></td>
                    </tr>
                     <tr>
                      <td bgcolor="#C6D6E8"><font color="#800000"><b>Images</b></font></td>
                      <td bgcolor="#FFFFFF"><input type="file"  maxlength="4"  name="frmdocimage" size="30" value=""></td>
                    </tr>
                    <tr>
                      <td bgcolor="#C6D6E8" valign="top"><font color="#800000"><b>Discription</b></font></td>
                      <td bgcolor="#FFFFFF">
                 
					   <textarea name = "content" rows="20" cols="70"></textarea>
                        <input type="hidden" name="WYSIWYGMode" value="off">

                      </td>
                    </tr>
                    <tr>
                      <td bgcolor="#C6D6E8">&nbsp;</td>
                      <td bgcolor="#C6D6E8">
                      <input type="image" border="0" class="noborders"  SRC="images/bt_validate.gif" alt="Valider" id=image1 name=image1>&nbsp;
<?php     if ($qryro=="true")
    {
?> 
			              <a href="AdminDBADMproduits.php?ro=true&frmidxSid=<?php       echo $qryidxSid;?>"><IMG border="0" SRC="images/bt_cancel.gif" alt="Annuler"></a>
		              <?php     }
      else
    {
?>
                          <a href="AdminDBADMproduits.php?frmidxid=<?php       echo $qryidxid;?>"><IMG border="0" SRC="images/bt_cancel.gif" alt="Annuler"></a>
                      <?php     } ?>
                      </td>
                    </tr>
                  </table>
                  <input type=hidden name="mode" value="addnew">
                  <input type="hidden" name="vall" value="<?php echo $qryidxid;  ?>">
        </form> 
<?php   } 
function update()
{$DBO =new mysqli("localhost", "dcstecgr_artcomu", "artcom2015artcom","dcstecgr_webdbfr");

    if ($DBO -> connect_errno) {
        echo "Failed to connect to MySQL: " . $DBO -> connect_error;
        exit();
    }
    mysqli_select_db($DBO,'dcstecgr_webdbfr');
  extract($GLOBALS);
  if(isset($_FILES['frmimagepro']))
  { 
    echo "SVP insert  l'image de ce document";
    unset($erreur);
    $extensions_ok = array('png', 'gif', 'jpg', 'jpeg');
    $taille_max = 1000000000000;
    $dest_dossier = '../images/';
    if( !in_array( substr(strrchr($_FILES['frmimagepro']['name'], '.'), 1), $extensions_ok) )
     {
     $erreur = 'Veuillez s&eacute;lectionner un fichier de type png, gif ou jpg !';
     }
     elseif(file_exists($_FILES['frmimagepro']['tmp_name'])and filesize($_FILES['frmimagepro']['tmp_name']) > $taille_max)
    {
     $erreur = 'Votre fichier doit faire moins de 5000Ko !';
    }
  if(!isset($erreur))
  {
   $dest_fichier = basename($_FILES['frmimagepro']['name']);
   $dest_fichier = strtr($dest_fichier,'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',               'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
   $dest_fichier = preg_replace('/([^.a-z0-1]+)/i', '_', $dest_fichier);
   $poiuy=$_FILES['frmimagepro']['tmp_name'];

   move_uploaded_file($poiuy,$dest_dossier.$dest_fichier);
   $pro=$dest_dossier.$dest_fichier;
   echo $pro;
   

   $strSQL="UPDATE ".$TableName." SET Nompro      ='".$_POST["frmNompro"]."' ,
                                      Marquepro   ='". $_POST["frmMarquepro"]."', 
									  Modelpro    ='".$_POST["frmModelpro"]."' ,
									  Fabripro    ='".$_POST["frmFabripro"]."' ,
									  Refpro      ='".$_POST["frmRefpro"]."' ,
                                      Prixpro     ='".$_POST["frmPrixpro"]."' ,
                                      brochurepro ='".$pro/*$_POST["frmbrochurepro"]*/."' ,
                                      caratecpro  ='".$_POST["frmcaratecpro"]."' ,
                                      imagepro    ='".$pro."' ,
                                      discriptionpro='".$_POST["frmdiscriptionpro"]."' 
									
									  Where  " .$TableKey."=".$qryid. ";";// docimage='".$pro."' 

   $RSA=mysqli_query($DBO,$strSQL)or die('Erreur SQL !<br>'.$strSQL.'<br>'.mysqli_error());
   if ($qryro=="true")
   {
     echo "<html><script language=\"javascript\">location.href='AdminDBADMproduits.php?ro=true&frmidxSid=".$qryidxSid."'</script></html>";
   }
     else
   {

     echo "<html><script language=\"javascript\">location.href='AdminDBADMproduits.php?frmidxid=".$qryidxid."'</script></html>";
   } 
   $RSA=NULL;
  
  
}
}
  
  
}

  function addnew()
  {
    extract($GLOBALS);
    if(isset($_FILES['frmdocimage']))
{ 
 
unset($erreur);
$extensions_ok = array('png', 'gif', 'jpg', 'jpeg');
$taille_max = 10000000000;
$dest_dossier = '../images/';
if( !in_array( substr(strrchr($_FILES['frmdocimage']['name'], '.'), 1), $extensions_ok) )
{
$erreur = 'Veuillez s&eacute;lectionner un fichier de type png, gif ou jpg !';
}
elseif
(file_exists($_FILES['frmdocimage']['tmp_name'])and filesize($_FILES['frmdocimage']['tmp_name']) > $taille_max)
{
$erreur = 'Votre fichier doit faire moins de 5000Ko !';
}
if(!isset($erreur))
{
$dest_fichier = basename($_FILES['frmdocimage']['name']);
$dest_fichier = strtr($dest_fichier,'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ','AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
$dest_fichier = preg_replace('/([^.a-z0-1]+)/i', '_', $dest_fichier);
$poiuy=$_FILES['frmdocimage']['tmp_name'];

move_uploaded_file($poiuy,$dest_dossier.$dest_fichier);
$pro=$dest_dossier.$dest_fichier;
	if ($qryro=="true")
	{
   $strSQL="INSERT INTO  ".$TableName."(".$ITableKey.",".$ITableKey0.",Nompro,".$ITableKeyS.",Marquepro,Modelpro,Fabripro,Refpro,Prixpro,brochurepro,caratecpro,imagepro,discriptionpro) VALUES (".$qryidxid.",".$qryidx0id.",'".$_POST["frmdocmarque"]."',".$qryidxSid.",'".$_POST["frmdocmarque"]."','".$_POST["frmdocmodel"]."','".$_POST["frmdocfab"]."','".$_POST["frmdocref"]."','".$_POST["frmdocprix"]."','".$_POST["frmdobro"]."','".$_POST["frmdocara"]."','".$pro."','".$_POST["content"]."');";	
	$RSA=mysqli_query($strSQL)or die('Erreur SQL !<br>'.$strSQL.'<br>'.mysqli_error());
      echo "<html><script language=\"javascript\">location.href='AdminDBADMproduits.php?ro=true&frmidxSid=".$qryidxSid."'</script></html>";
    }







      else
    {
		$strSQL="INSERT INTO  ".$TableName."  (doctitle,docorder,docbody,docimage,".$ITableKey.",".$ITableKey0.",".$ITableKeyS.") VALUES ('".$_POST["frmdoctitle"]."',".$_POST["frmdocorder"].",'".$_POST["content"]."','".$pro."',".$qryidxid.",".$qryidx0id.",'NULL');";	
	echo $strSQL;									 
	
	$RSA=mysqli_query($strSQL)or die('Erreur SQL !<br>'.$strSQL.'<br>'.mysqli_error());

      echo "<html><script language=\"javascript\">location.href='AdminDBADMproduits.php?frmidxid=".$qryidxid."'</script></html>";
   
   }}
}
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
    if ($RTableName1!="")
    {
      $strSQL="SELECT * from ".$RTableName1." Where ".$RTableKey1."=".$qryid.";";
	  $RSA=mysqli_query($DBO,$strSQL);
 
      if ($dataRSA=mysqli_fetch_array($RSA))
      {
        $confdelete=false;
      } 
      $RSA=NULL;
	  $dataRSA=NULL;
    } 


    if ($RTableName2!="")
    {
 
// verify integrity 2
      $strSQL="SELECT * from ".$RTableName2." Where ".$RTableKey2."=".$qryid.";";
	  $RSA=mysqli_query($DBO,$strSQL);
      if (  $RSA=mysqli_query($strSQL))
      {
        $confdelete=false;
      } 
       $RSA=NULL;
	   $dataRSA=NULL;
    } 


    if ($confdelete)
    {

// del
      $strSQL="DELETE from ".$TableName." Where ".$TableKey."=".$qryid.";";
	 echo $strSQL;
	  $RSA=mysqli_query($DBO,$strSQL);
     
	  $RSA=NULL;
      if ($qryro=="true")
      {
echo  "ok";
header("Location:AdminDBADMproduits.php?ro=true&frmidxSid=".$qryidxSid);
		 /*echo '<html><script language=\"javascript\">location.href="AdminDBADMproduits.php?ro=true&frmidxSid='.$qryidxSid.'</script></html>';*/
      }
        else
      {
echo  "ok2";
    
		 echo '<html><script language=\"javascript\">location.href="AdminDBADMproduits.php?ro=true&frmidxSid='.$qryidxSid.'</script></html>';
      } 



    }
      else
    {

      $AdminMessage="Impossible de supprimer cette ligne car elle comprend des enregistrements connexes.";
    } 


  } 
  /*function sup()
  {
    extract($GLOBALS);

    $confdelete=true;
// verify integrity 1
    if ($RTableName1!="")
    {

      $strSQL="SELECT * from ".$RTableName1." Where ".$RTableKey1."=".$qryid.";";
      $RSA->Open$strSql      $DBO      $adOpenStatic      $adLockReadOnly;
      if (!$RSA->eof)
      {
        $confdelete=false;
      } 
      $RSA->close;
    } 


    if ($RTableName2!="")
    {

// verify integrity 2
      $strSQL="SELECT * from ".$RTableName2." Where ".$RTableKey2."=".$qryid.";";
      $RSA->Open$strSql      $DBO      $adOpenStatic      $adLockReadOnly;
      if (!$RSA->eof)
      {
        $confdelete=false;
      } 
      $RSA->close;
    } 


    if ($confdelete)
    {

// del
      $strSQL="SELECT * from ".$TableName." Where ".$TableKey."=".$qryid.";";
      $RSA->Open$strSql      $DBO      $adOpenStatic      $adLockOptimistic;
      $RSA->delete;
      $RSA->close;
      if ($qryro=="true")
      {

        header("Location: ".thisscript(."?ro=true&frmidxSid=".$qryidxSid));
      }
        else
      {

        header("Location: ".thisscript(."?frmidxid=".$qryidxid));
      } 



    }
      else
    {

      $AdminMessage"Impossible de supprimer cette ligne car elle comprend des enregistrements connexes."
    } 


    return $function_ret;
  } 
*/
?>
<!-- end content -->

<!-- Win Foot -->
</td>
              </tr>
            </table>
        </TD>
		<TD BGCOLOR=#D2DEEE>
			<IMG SRC="images/spacer.gif" WIDTH=9 HEIGHT=29 ALT=""></TD>
		<TD BGCOLOR="<?php   echo $tempRoundedColor;?>"> 
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
<?php   admfoot();?>


