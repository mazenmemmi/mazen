<?php
include("common/settings.php");
include("common/tools.php");
include ("common/header.php");
include ("common/menu.php");
include ("slider2.php");
if(isset ($_GET["mcat"])){$rmycat=$_GET["mcat"];}
if(isset ($_GET["mrub"])){$rmyrub=$_GET["mrub"];}else {$rmyrub=NULL;}
if(isset ($_GET["msrub"])){$rmysrub=$_GET["msrub"];}else{$rmysrub=NULL; }
if(isset ($_GET["docID"])){$rmydocid=$_GET["docID"];}else {$rmydocid=NULL;}
if(isset ($_GET["dev"])){$rmydev=$_GET["dev"];}
if(isset ($_GET["dev"])){$rmydev=true;}else{$rmydev=false;} 
if(isset ($_GET["arid"])){$rmyarid=$_GET["arid"]; }
if(isset ($_GET["artid"])){$rmyartid=$_GET["artid"]; }else {$rmyartid=NULL;}
echo '<div class="hera" style="width:100%;">';
//menu hera
echo '<a href="home.php" class="breadcrumb"  ><img src="img/home.png"></a><a href="doc.php?mcat='.$rmycat.'&mrub='.$rmyrub.'" class="breadcrumb"  >'.MENUVERN2($rmyrub).'</a>';
if (MENUVERN3($rmysrub)!=NULL)
{
 echo '<a  class="breadcrumb" href="doc.php?mcat='.$rmycat.'&mrub='.$rmyrub.'&msrub='.$rmysrub.'" >'.MENUVERN3($rmysrub).'</a>';
 	
 }
  
 if (MENUVERN4($rmydocid)!=NULL)

{
 echo '<a  class="breadcrumb" href="#" >'. MENUVERN4($rmydocid).'</a><br>';

 }
echo"</div>";
echo '<table border=0  width="100%" cellpadding="0" cellspacing="0"><tr>';
echo '<tr><td valign="top">';
//-----------
//tableau menu vertical
echo '<div id="wrap">';
$sqqql="SELECT * FROM m_sousrubrique where rubID=".$rmyrub."; ";
$dsql=mysqli_query($mydbobj,$sqqql);
echo '<ul class="menu">';
while ($dsq=mysqli_fetch_array($dsql))
{
	//mise à jour 13-03-2013
    echo'<li><a href="doc.php?mcat='.$rmycat.'&mrub='.$rmyrub.'&msrub='.$dsq["srubID"].'">'.$dsq["srubLibelle"].'</a>';
	$red="select * from documents where srubID=".$dsq["srubID"]."  GROUP BY docorder ;";
    $Rre = mysqli_query($mydbobj,$red) or die('Erreur SQL !<br>'.$red.'<br>'.mysqli_error());
	echo'<ul>';
	while($red1=mysqli_fetch_array($Rre))
    {//mise à jour 23-03-2013
	  echo '<li><a href="doc.php?docID='.$red1["docID"].'&mcat='.$rmycat.'&mrub='.$rmyrub.'&msrub='.$dsq["srubID"].'">'.$red1["doctitle"].'</a></li>';
	}
    echo '</ul></li>';		  	
}
$red=NULL;
$red1=NULL;
$Rre=NULL;
	echo '</ul';
echo'</div>';
$sqqql=NULL;
$dsql=NULL;
$dsq=NULL;

//---------
echo '<br>
<div id="boxService">
  <span>Service</span>

  <div id="boxBeratung">
    <a href="#"><img src="images/TEST.jpg" width=180px height=148px alt="Wir beraten Sie gerne" /></a>
  </div>

  <div id="boxButtons">
    <a href="servicetech.php" class="werkstatt">Werkstatt</a>
    <a href="contact.php" class="rueckruf">Rückruf anfordern</a>   
  </div>
</div>';
/*16-03-2013****<a href="angebot-anfordern" class="angebot">Angebot anfordern</a>
    <a href="downloads" class="downloads">Downloads</a>*/
echo"</td>";
echo '<td width=90% valign="top">';



if ($rmydocid==NULL)
{
  if ($rmysrub==NULL)
  {
/*
   $sqldoc="SELECT documents.docID, documents.catID, documents.rubID, documents.doctitle, documents.docbody, documents.docimage, m_categorie.catlibelle,m_rubrique.rublibelle,m_rubrique.rubdesc FROM m_rubrique INNER JOIN (m_categorie INNER JOIN documents ON m_categorie.catID = documents.catID) ON (m_categorie.catID = m_rubrique.catID) AND (m_rubrique.rubID = documents.rubID) WHERE ((documents.catID=$rmycat) AND (documents.rubID=$rmyrub)) ORDER BY docorder ;";
	
	$RSdoc = mysql_query($sqldoc) or die('Erreur SQL111 !<br>'.$sqldoc.'<br>'.mysql_error());
	 echo  '<table  width="100%" cellpadding=0 cellspacing=10>';
	  echo '<tr>';
	  $con=1;
	while($datas=mysql_fetch_assoc($RSdoc))
	{
     
$image=substr ($datas["docimage"],3,strlen($datas["docimage"]));
      if (mysql_num_rows($RSdoc)==1) //=1
      {
        echo '<td >'.$datas["docbody"].'</td></tr>';

      }
      else // >1
      {
    if ($con<=4)
	{
          echo '<td class="doctitle" width="140" height="150"  valign="bottom"  align="center" style="background:url('.$image.') no-repeat; background-size:cover;"><a href=doc.php?docID='.$datas["docID"].'&mcat='.$rmycat.'&mrub='.$rmyrub.'>'.$datas['doctitle'].'</a></td>';
		  $con=$con+1;
	}//echo '<br><hr color="#FF6600" size="1"></td></tr>'; 
    else
	{
	 echo '</tr><tr><td class="doctitle" width="140" height="150" valign="bottom"  align="center" style="background:url('.$image.') no-repeat; background-size:cover;"><a href=doc.php?docID='.$datas["docID"].'&mcat='.$rmycat.'&mrub='.$rmyrub.'>'.$datas['doctitle'].'</a></td>';	//<br>
	 $con=1;
	}
	 } 

      
    } echo '</tr></table>';
$Rsdoc=NULL;
$RSdoc=NULL;*/
//Mise à jour le 13-03-2013//modifie le samedi 21-03-2013 (affichage sous_rubrique uniquement)
    $sqldoc="SELECT  * FROM m_sousrubrique where rubID=".$rmyrub." ORDER BY sruborder;";
   /*$sqldoc="SELECT documents.docID, documents.catID, documents.rubID, documents.srubID, documents.doctitle, documents.docimage, documents.docbody, m_categorie.catlibelle, m_rubrique.rublibelle, m_sousrubrique.srubLibelle ";
    $sqldoc=$sqldoc."FROM (m_rubrique INNER JOIN (m_categorie INNER JOIN documents ON m_categorie.catID = documents.catID) ON (m_categorie.catID = m_rubrique.catID) AND (m_rubrique.rubID = documents.rubID)) INNER JOIN m_sousrubrique ON (m_rubrique.rubID = m_sousrubrique.rubID) AND (documents.srubID = m_sousrubrique.srubID) ";
    $sqldoc=$sqldoc."WHERE documents.catID=".$rmycat." AND documents.rubID=".$rmyrub." ORDER BY sruborder ;";*/
	 
	 
	$RSdoc = mysqli_query($sqldoc) or die('Erreur SQL111 !<br>'.$sqldoc.'<br>'.mysqli_error());
	 echo  '<table  cellpadding=0 cellspacing=10>';
	 echo '<tr>';
	 
    $con=1;
	while($datas=mysqli_fetch_assoc($RSdoc))
	{  
	  $image=substr ($datas["srubimg"],3,strlen($datas["srubimg"]));
      if ($con<=3)//4 Panneau par ligne
	  {
          echo '<td class="doctitle"   valign="bottom"  align="center" style="background:url('.$image.') no-repeat; "><a href=doc.php?mcat='.$rmycat.'&mrub='.$datas["rubID"].'&msrub='.$datas["srubID"].'>'.$datas['srubLibelle'].'</a></td>';
		  $con=$con+1;
	  }//echo '<br><hr color="#FF6600" size="1"></td></tr>'; 
      else //5ème panneaux et plus
	  {
	     echo '</tr><tr><td class="doctitle" valign="bottom"  align="center" style="background:url('.$image.') no-repeat;"><a href=doc.php?mcat='.$rmycat.'&mrub='.$datas["rubID"].'&msrub='.$datas["srubID"].'>'.$datas['srubLibelle'].'</a></td>';		//<br>
	     $con=2;
	  }
	 } 

      
     echo '</tr></table>';
     $Rsdoc=NULL;
     $RSdoc=NULL;

  }
    else
  { 
    $sqldoc="SELECT documents.docID, documents.catID, documents.rubID, documents.srubID, documents.doctitle, documents.docimage, documents.docbody, m_categorie.catlibelle, m_rubrique.rublibelle, m_sousrubrique.srubLibelle,m_sousrubrique.srubdesc ";
    $sqldoc=$sqldoc."FROM (m_rubrique INNER JOIN (m_categorie INNER JOIN documents ON m_categorie.catID = documents.catID) ON (m_categorie.catID = m_rubrique.catID) AND (m_rubrique.rubID = documents.rubID)) INNER JOIN m_sousrubrique ON (m_rubrique.rubID = m_sousrubrique.rubID) AND (documents.srubID = m_sousrubrique.srubID) ";
    $sqldoc=$sqldoc."WHERE (((documents.catID)=".$rmycat.") AND ((documents.rubID)=".$rmyrub.") AND ((documents.srubID)=".$rmysrub.")) ORDER BY docorder ;";
   $RSdoc = mysqli_query($mydbobj,$sqldoc) or die('Erreur SQL !<br>'.$sqldoc.'<br>'.mysqli_error());
	echo  '<table   cellpadding=0 cellspacing=10>';
	  echo'<tr>';
	  $con=1;
	while($datas=mysqli_fetch_assoc($RSdoc))
	{
      $image=substr ($datas["docimage"],3,strlen($datas["docimage"]));
      
      if (mysqli_num_rows($RSdoc)==1)
      {
       echo'<td >'.$datas["docbody"].'</td>';
      
      }
        else
      {
	    if ($con<=4)
	    {
		  echo '<td class="doctitle"  valign="bottom"  align="center" ><a href=doc.php?docID='.$datas["docID"]."&mcat=".$rmycat."&mrub=".$rmyrub."&msrub=".$rmysrub.'>'.$datas["doctitle"].'</a></td>';
	      $con=$con+1;
	   }
	  else 
	  {
		echo '</tr><tr  ><td class="doctitle" valign="bottom"  align="center" ><a href=doc.php?docID='.$datas["docID"]."&mcat=".$rmycat."&mrub=".$rmyrub."&msrub=".$rmysrub.'>'.$datas["doctitle"].'</a></td>';//<br>
		$con=1;
		
	   }
      } 
}
     echo '<tr></table>';
     
    $RSdoc=NULL;
    $datas=NULL;   
  } 
}
  else
{
 if ($rmysrub==NULL)
  {
    $sqldoc="SELECT documents.docID, documents.doctitle, documents.docbody, m_categorie.catlibelle, m_rubrique.rublibelle ";
    $sqldoc=$sqldoc."FROM m_rubrique INNER JOIN (m_categorie INNER JOIN documents ON m_categorie.catID = documents.catID) ON (m_categorie.catID = m_rubrique.catID) AND (m_rubrique.rubID = documents.rubID) ";
    $sqldoc=$sqldoc."WHERE ((documents.docID)=".$rmydocid.") ORDER BY docorder;";
  }
    else
  {
    $sqldoc="SELECT documents.docID, documents.doctitle, documents.docbody, documents.docimage, m_categorie.catlibelle, m_rubrique.rublibelle, m_sousrubrique.srubLibelle ";
    $sqldoc=$sqldoc."FROM (m_rubrique INNER JOIN (m_categorie INNER JOIN documents ON m_categorie.catID = documents.catID) ON (m_categorie.catID = m_rubrique.catID) AND (m_rubrique.rubID = documents.rubID)) INNER JOIN m_sousrubrique ON (m_rubrique.rubID = m_sousrubrique.rubID) AND (documents.srubID = m_sousrubrique.srubID) ";
    $sqldoc=$sqldoc."WHERE (((documents.docID)=".$rmydocid.")) ORDER BY docorder;";
  } 
//$RSdoc = mysqli_query($sqldoc) or die('Erreur SQL !<br>'.$sqldoc.'<br>'.mysqli_error());
$DBO =new mysqli("localhost", "dcstecgr_artcomu", "artcom2015artcom","dcstecgr_webdbfr");

$RSdoc = $DBO->query($sqldoc) or die('Erreur SQL !<br>' . $sqldoc . '<br>' . $DBO->error);

	while($datas=mysqli_fetch_assoc($RSdoc))
   {

    if ($rmysrub==NULL)
    {

      if ($datas["action"]=="showdoc")
      {

//response.write ("&nbsp;<img border=0 src=""images/treeseparator.gif"">&nbsp;"&RSdoc.fields ("catlibelle")& "&nbsp;<img border=0 src=""images/treeseparator.gif"">&nbsp;" & RSdoc.fields ("rublibelle") )
      }
        else
      {

//response.write ("&nbsp;<img border=0 src=""images/treeseparator.gif"">&nbsp;"&RSdoc.fields ("catlibelle")& "&nbsp;<img border=0 src=""images/treeseparator.gif"">&nbsp;" & "<a  href=""doc.asp?mcat="&rmycat&"&mrub="&rmyrub&"""><b>"&RSdoc.fields ("rublibelle")& " </b></a>")
      } 


    }
      else
    {

// if a requested doc from < searsh engine>
      /*if ($datas["action"]=="showdoc")
      {

//response.write ("&nbsp;<img border=0 src=""images/treeseparator.gif"">&nbsp;"&RSdoc.fields ("catlibelle")& "&nbsp;<img border=0 src=""images/treeseparator.gif"">&nbsp;" &RSdoc.fields ("rublibelle")& "&nbsp;<img border=0 src=""images/treeseparator.gif"">&nbsp;" & RSdoc.fields ("srublibelle")& "")
      }
        else
      {

//response.write ("&nbsp;<img border=0 src=""images/treeseparator.gif"">&nbsp;"&RSdoc.fields ("catlibelle")& "&nbsp;<img border=0 src=""images/treeseparator.gif"">&nbsp;" &RSdoc.fields ("rublibelle")& "&nbsp;<img border=0 src=""images/treeseparator.gif"">&nbsp;" & "<a  href=""doc.asp?mcat="&rmycat&"&mrub="&rmyrub&"&msrub="&rmysrub&"""><b>"&RSdoc.fields ("srublibelle")& " </b></a>")
      } */

    } 


//Response.write ("<br><img border=0 src=""images/middle_separator.gif""><br>")
//---------------------------------	
    
    echo '<table width="100%" border = 0 cellpadding=0 cellspacing=0 >';
//Response.Write ("<tr><td class=""doctitre""><br>"&RSdoc.fields ("doctitle") &"</td></tr>")
    echo '<tr ><td><br>'.$datas["docbody"].'</td></tr>';
    echo '</table>';
  } 
  $RSdoc=NULL;
$datas=NULL;
} 

echo "</td></tr></table>";
include ("common/footer.php");

?>
