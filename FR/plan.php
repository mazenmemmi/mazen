<?php
include("common/settings.php");
include("common/Tools.php");
include ("common/header.php");
include ("common/menu.php");
echo'<img border="0" src="images/flash2.jpg">';

//------------------------------------------------------------
// Plan builder v 1.0 
//-----------------------------------------------------------
//Response.write ("<img border=0 src=""images/treeseparator.gif"">&nbsp;<a href=""home.asp""><b>Accueil</b></a>")
//Response.write ("&nbsp;<img border=0 src=""images/treeseparator.gif"">&nbsp;Plan du site")
//Response.write ("<br><img border=0 src=""images/middle_separator.gif""><br><br>")

$Dbplan=$mydbobj;
$sql="SELECT * from m_categorie ORDER BY catorder;";

$RsCAT=mysqli_query($mydbobj,$sql);
$Rscount=mysqli_num_rows($RsCAT);
if (!($Rscount==0))

{

  
?>
<table border="0" width="780" height="200">
	<tr>
		<td align="center" width="119" valign="top">

<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td>
		<p dir="rtl" align="left">
		<img border="0" src="images/decorplan.jpg" width="130" height="241"><br>
		<font size="1" color="#333333"><br>
		<br>
&nbsp;</font></td>
	</tr>
</table>

		</td>
		<td align="center" width="1" valign="top">

<img border="0" src="images/versep.gif" width="1" height="344"></td>
		<td valign="top">

<table border="0" width="100%" cellpadding="2">
	<tr><td><font face="Arial" size="4" color="#FF6600">Plan du site</font><hr color="#FF6600" size="1"></td></tr>
	<tr>
		<td>
<table border="0" width="100%" cellspacing="0">
<?php
  while($dataRsCAT=mysqli_fetch_array($RsCAT))//(!($RsCAT==0))
  {
?>
        
		<tr><td>
		
		<font color=red><b><?php $dataRsCAT["catlibelle"] ?></b></font>
		</td></tr>   
		<tr><td width="100%"> </td></tr>
   <?php 
    $mycat=$dataRsCAT["catID"];
    $sql="SELECT m_categorie.catID, m_rubrique.* ";
    $sql=$sql."FROM m_categorie INNER JOIN m_rubrique ON m_categorie.catID = m_rubrique.catID ";
    $sql=$sql."WHERE (((m_categorie.catID)=".$mycat." )) ORDER BY ruborder;";

   // echo $sql;
    $RSrub=mysqli_query($mydbobj,$sql);
    $Rsrcount=mysqli_num_rows($RSrub);
	
    if (($Rsrcount!=0))
    {

      while(($dataRSRUB=mysqli_fetch_array($RSrub)))
      {


        $myrub=$dataRSRUB["rubID"];
        $mytype=$dataRSRUB["rubTYPE"];
// is there a sub rub ?
        if($dataRSRUB["rubopen"]==-1)
        { 
        
            echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;<font color=#333333><b>".$dataRSRUB["rublibelle"]."</b></font></td></tr>";//corrigé LS 2013
             
// Select srub
          $sql="SELECT m_sousrubrique.rubID, m_sousrubrique.srubID, m_sousrubrique.srubLibelle, m_sousrubrique.srubTYPE, m_sousrubrique.sruborder ";
          $sql=$sql."FROM (m_categorie INNER JOIN m_rubrique ON m_categorie.catID = m_rubrique.catID) INNER JOIN m_sousrubrique ON m_rubrique.rubID = m_sousrubrique.rubID ";
          $sql=$sql."WHERE (((m_sousrubrique.rubID)=".$myrub.")) ORDER BY sruborder ;";
//echo $sql;
          $rs=mysqli_query($mydbobj,$sql);
		   
          $Rssrcount=mysqli_num_rows($rs);
          if (($Rssrcount!=0))
          {
            while(($dataRsSRUB=mysqli_fetch_array($rs)))
            {

              $mysrub=$dataRsSRUB["srubID"];
              $mytype=$dataRsSRUB["srubTYPE"];
					  				 
              echo "<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
              echo "<a href=\"".fChecktype($mytype,"menu")."?mcat=".$mycat."&mrub=".$myrub."&msrub=".$mysrub."&dev=true\"> ";
              echo $dataRsSRUB["srubLibelle"]."&nbsp; </td> </tr>";
             // $RSSRUB=mysql_fetch_array($RSSRUB_query);
              
            } 
          } 

         $rs=NULL;
		 $dataRsSRUB=NULL;

        }
          else
        {
          echo "<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;<b>";
          echo "<a href=\"".fChecktype($mytype,"menu")."?mcat=".$mycat."&mrub=".$myrub."\" >";
          echo $dataRSRUB["rublibelle"]."</a></b></td></tr>";
		  
// line horizontale
      // echo "<br><img border=0 src='images/separmenu.gif' ></td></tr>";
        } 

        //$RSRUB=mysql_fetch_array($RSRUB_query);

      } 

    } 
    
   // $RSCAT=mysql_fetch_array($RSCAT_query);

  } 
} 

// kill Rs srub
$RSSRUB=null;

// kill rs rub 
$RSRUB=null;

// close & kill cat rs

$RSCAT=null;


?>
<!-- HERE PUT YOUR OUN TEXT-->

<!-- END OUWN TEXT -->
</table>


</td>
	</tr>
</table>

		</td>
	</tr>
</table>
<?php
// close & kill database 
//Dbplan.Close
$Dbplan=null;
include ("common/footer.php");
?>