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
if(isset ($_GET["IDP"])){$proID=$_GET["IDP"]; }else {$proID=NULL;}//IDP
if(isset ($_GET["modview"])){$modview=$_GET["modview"]; }else {$modview=NULL;}
if(isset ($_GET["mar"])){$mar=$_GET["mar"]; }else {$mar=NULL;}
if(isset ($_GET["artid"])){$rmyartid=$_GET["artid"]; }else {$rmyartid=NULL;}

$nb_total=0;

function barre_navigation ($nb_total,
		$nb_affichage_par_page,
		$debut,
		$nb_liens_dans_la_barre) {

	$barre = '';

	// on recherche l'URL courante munie de ses paramètre auxquels on ajoute le paramètre 'debut' qui jouera le role du premier élément de notre LIMIT
	if ($_SERVER['QUERY_STRING'] == "") {
		$query = $_SERVER['PHP_SELF'].'?debut=';
	}
	else {
		$tableau = explode ("debut=", $_SERVER['QUERY_STRING']);
		$nb_element = count ($tableau);
		if ($nb_element == 1) {
			$query = $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'].'&debut=';
		}
		else {
			if ($tableau[0] == "") {
				$query = $_SERVER['PHP_SELF'].'?debut=';
			}
			else {
				$query = $_SERVER['PHP_SELF'].'?'.$tableau[0].'debut=';
			}
		}
	}

	// on calcul le numéro de la page active
	$page_active = floor(($debut/$nb_affichage_par_page)+1);
	// on calcul le nombre de pages total que va prendre notre affichage
	$nb_pages_total = ceil($nb_total/$nb_affichage_par_page);

	// on calcul le premier numero de la barre qui va s'afficher, ainsi que le dernier ($cpt_deb et $cpt_fin)
	// exemple : 2 3 4 5 6 7 8 9 10 11 << $cpt_deb = 2 et $cpt_fin = 11
	if ($nb_liens_dans_la_barre%2==0) {
		$cpt_deb1 = $page_active - ($nb_liens_dans_la_barre/2)+1;
		$cpt_fin1 = $page_active + ($nb_liens_dans_la_barre/2);
	}
	else {
		$cpt_deb1 = $page_active - floor(($nb_liens_dans_la_barre/2));
		$cpt_fin1 = $page_active + floor(($nb_liens_dans_la_barre/2));
	}

	if ($cpt_deb1 <= 1) {
		$cpt_deb = 1;
		$cpt_fin = $nb_liens_dans_la_barre;
	}
	elseif ($cpt_deb1>1 && $cpt_fin1<$nb_pages_total) {
		$cpt_deb = $cpt_deb1;
		$cpt_fin = $cpt_fin1;
	}
	else {
		$cpt_deb = ($nb_pages_total-$nb_liens_dans_la_barre)+1;
		$cpt_fin = $nb_pages_total;
	}

	if ($nb_pages_total <= $nb_liens_dans_la_barre) {
		$cpt_deb=1;
		$cpt_fin=$nb_pages_total;
	}

	// si le premier numéro qui s'affiche est différent de 1, on affiche << qui sera un lien vers la premiere page
	if ($cpt_deb != 1) {
		$cible = $query.(0);
		$lien = '<A HREF="'.$cible.'">&lt;&lt;</A>&nbsp;&nbsp;';
	}
	else {
		$lien='';
	}
	$barre .= $lien;

	// on affiche tous les liens de notre barre, tout en vérifiant de ne pas mettre de lien pour la page active
	for ($cpt = $cpt_deb; $cpt <= $cpt_fin; $cpt++) {
		if ($cpt == $page_active) {
			if ($cpt == $nb_pages_total) {
				$barre .= $cpt;
			}
			else {
				$barre .= $cpt.'&nbsp;-&nbsp;';
			}
		}
		else {
			if ($cpt == $cpt_fin) {
				$barre .= "<A HREF='".$query.(($cpt-1)*$nb_affichage_par_page);
				$barre .= "'>".$cpt."</A>";
			}
			else {

				$barre .= "<A HREF='".$query.(($cpt-1)*$nb_affichage_par_page);
				$barre .= "'>".$cpt."</A>&nbsp;-&nbsp;";
			}
		}
	}

	$fin = ($nb_total - ($nb_total % $nb_affichage_par_page));
	if (($nb_total % $nb_affichage_par_page) == 0) {
		$fin = $fin - $nb_affichage_par_page;
	}

		// si $cpt_fin ne vaut pas la dernière page de la barre de navigation, on affiche un >> qui sera un lien vers la dernière page de navigation
	if ($cpt_fin != $nb_pages_total) {
		$cible = $query.$fin;
		$lien = '&nbsp;&nbsp;<A HREF="'.$cible.'">&gt;&gt;</A>';
	}
	else {
		$lien='';
	}
	$barre .= $lien;

	return $barre;
}

echo '<div class="hera" style="width:100%;">';
//menu hera
/*echo '<a href="home.php" class="breadcrumb"  ><img src="img/home.png"></a><a href="directdoc.php?mcat='.$rmycat.'&mrub='.$rmyrub.'" class="breadcrumb"  >'.MENUVERN2($rmyrub).'</a>';//12-03-2013*/
echo '<a href="home.php" class="breadcrumb" ><img src="img/home.png"></a><a  href="#" class="breadcrumb"  >'.MENUVERN2($rmyrub).'</a>';//12-03-2013 : pour eviter affichage rubrique comme produit
if (MENUVERN3($rmysrub)!=NULL)
{
 echo '<a  class="breadcrumb" href="directdoc.php?mcat='.$rmycat.'&mrub='.$rmyrub.'&msrub='.$rmysrub.'" >'.MENUVERN3($rmysrub).'</a>';
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
	
			
        echo'<li><a href="directdoc.php?mcat='.$rmycat.'&mrub='.$rmyrub.'&msrub='.$dsq["srubID"].'">'.$dsq["srubLibelle"].'</a>';
		$red="select * from artproduit where srubID=".$dsq["srubID"]."  GROUP BY Marquepro ;";
           $Rre = mysqli_query($mydbobj,$red) or die('Erreur SQL !<br>'.$red.'<br>'.mysqli_error());
		echo'<ul>';
	           while($red1=mysqli_fetch_array($Rre))
                  {
	                echo '<li><a href="directdoc.php?mcat='.$rmycat.'&mrub='.$rmyrub.'&msrub='.$dsq["srubID"].'&mar='.$red1["Marquepro"].'">'.$red1["Marquepro"].'</a></li>';
	               }
              echo '</ul></li>';
			  
		  	
}$red=NULL;
			  $red1=NULL;
			  $Rre=NULL;
			 echo '</ul>';
echo'</div>';
$sqqql=NULL;
$dsql=NULL;
$dsq=NULL;









	
	
	
	echo'<style type="text/css">
	
	.page {
	text-align: center;
		
 padding:2px 00px;

	color:#fff;
	font-weight:bold;
	background-color:#f05f1e;">
	
	
	
}
</style>';


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
/**16-03-2013***<a href="angebot-anfordern" class="angebot">Angebot anfordern</a>
    <a href="downloads" class="downloads">Downloads</a>*/
echo"</td>";echo '<td width=80% valign="top" style="border:1PX;" >';
$nb_affichage_par_page = 6;
if ($rmysrub!=NULL)
{


$sqldoc="SELECT * FROM m_sousrubrique where rubID=".$rmyrub."  ORDER BY sruborder;";
$RSdoc = mysqli_query($mydbobj,$sqldoc) or die('Erreur SQL111 !<br>'.$sqldoc.'<br>'.mysqli_error());

echo '<table width="800"  class="tab" cellpadding="0" cellspacing="0">
<tr><form name="sddd"><td>Marques :</td><td><select style="width:190PX;" name="marq" onChange="location = this.options[this.selectedIndex].value;"><option  >------</option><option value=directdoc.php?mcat='.$rmycat.'&mrub='.$rmyrub.'&msrub='.$rmysrub.'>tout marque</option>';

$red="select * from artproduit where srubID=".$rmysrub."  GROUP BY Marquepro ;";
           $Rre = mysqli_query($mydbobj,$red) or die('Erreur SQL !<br>'.$red.'<br>'.mysqli_error());
		    while($red1=mysqli_fetch_array($Rre))
                  {
	               echo '<option value=directdoc.php?mcat='.$rmycat.'&mrub='.$rmyrub.'&msrub='.$rmysrub.'&mar='.$red1["Marquepro"].'>'.$red1["Marquepro"].'</option>';
	               }//

$red=NULL;
$red1=NULL;
 $Rre=NULL;
echo '</select></td><td>Models :</td><td><select style="width:190PX;" >';
   $red="select distinct Modelpro from artproduit where srubID=".$rmysrub." AND marquepro= '".$mar."' ;";
           $Rre = mysqli_query($mydbobj,$red) or die('Erreur SQL !<br>'.$red.'<br>'.mysqli_error());
while($red1=mysqli_fetch_array($Rre))
                  {echo'<option value="'.$red1["Modelpro"].'">'.$red1["Modelpro"].'</option>';
				  }
				  $red=NULL;
			  $red1=NULL;
			  $Rre=NULL;
echo'</select></td></form><td>';if($modview==NULL){echo '<a href="directdoc.php?mcat='.$rmycat.'&mrub='.$rmyrub.'&msrub='.$rmysrub.'&modview=1">Vue</a>'; }else{ echo'<a href="directdoc.php?mcat='.$rmycat.'&mrub='.$rmyrub.'&msrub='.$rmysrub.'">Vue</a>';} echo'</td></tr></table>';
}

if ($proID==NULL)
{
  if ($rmysrub==NULL)
  {
 
$Rsdoc=NULL;
$RSdoc=NULL;

  }
    else
  {  
    if ($mar ==NULL)
	{
if (!isset($_GET['debut']))
	$_GET['debut'] = 0;

	$sql="SELECT  count(*) FROM (m_rubrique INNER JOIN (m_categorie INNER JOIN artproduit ON m_categorie.catID = artproduit.catID) ON (m_categorie.catID = m_rubrique.catID) AND (m_rubrique.rubID = artproduit.rubID)) INNER JOIN m_sousrubrique ON (m_rubrique.rubID = m_sousrubrique.rubID) AND (artproduit.srubID = m_sousrubrique.srubID) WHERE (((artproduit.catID)=".$rmycat.") AND ((artproduit.rubID)=".$rmyrub.") AND ((artproduit.srubID)=".$rmysrub.") );";
   
$resultat = mysqli_query($mydbobj,$sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error());
$total = mysqli_fetch_array($resultat);
$_total=$total[0];

	$sqldoc="SELECT artproduit.IDpro,artproduit.Modelpro, artproduit.catID, artproduit.rubID, artproduit.srubID, artproduit.Nompro, artproduit.imagepro, artproduit.Marquepro, m_categorie.catlibelle, m_rubrique.rublibelle, m_sousrubrique.srubLibelle,m_sousrubrique.srubdesc FROM (m_rubrique INNER JOIN (m_categorie INNER JOIN artproduit ON m_categorie.catID = artproduit.catID) ON (m_categorie.catID = m_rubrique.catID) AND (m_rubrique.rubID = artproduit.rubID)) INNER JOIN m_sousrubrique ON (m_rubrique.rubID = m_sousrubrique.rubID) AND (artproduit.srubID = m_sousrubrique.srubID) WHERE (((artproduit.catID)=".$rmycat.") AND ((artproduit.rubID)=".$rmyrub.") AND ((artproduit.srubID)=".$rmysrub.") ) LIMIT ".$_GET['debut'].",".$nb_affichage_par_page.";";
   
   $RSdoc = mysqli_query($mydbobj,$sqldoc) or die('Erreur SQL !<br>'.$sqldoc.'<br>'.mysqli_error());
	echo  '<table cellpadding=0 cellspacing=10>';
	
	  echo'<tr>';
	  $con=1;
	while($datas=mysqli_fetch_assoc($RSdoc))
	{
$image=substr ($datas["imagepro"],3,strlen($datas["imagepro"]));
      
      if (mysqli_num_rows($RSdoc)==1)
      {
       echo'<td align="center" >'.$datas["Nompro"].'</td>';
      }
        else
      {
		  if ($modview==1)
		  {
			    
		echo '<tr><td valign="top" ><h3>'.$datas["Nompro"].'</h3><a href=directdoc.php?IDP='.$datas["IDpro"]."&mcat=".$rmycat."&mrub=".$rmyrub."&msrub=".$rmysrub.'><img src="'.$image.'" ></a><a href=directdoc.php?IDP='.$datas["IDpro"]."&mcat=".$rmycat."&mrub=".$rmyrub."&msrub=".$rmysrub.'><h3>'.$datas["Nompro"].'</h3></a><h6>'.$datas["Modelpro"].'</h6></td><td><a href="directdoc.php?IDP='.$datas["IDpro"]."&mcat=".$rmycat."&mrub=".$rmyrub."&msrub=".$rmysrub.'" class="butonde"><img src="images/detaill.png" /></a></td><tr>';
		  }else
		  {
	   if ($con<4)
	   
	  {
		echo '<td class="doctitlepro" valign="top" ><h3>'.$datas["Nompro"].'</h3><a href=directdoc.php?IDP='.$datas["IDpro"]."&mcat=".$rmycat."&mrub=".$rmyrub."&msrub=".$rmysrub.'><img src="'.$image.'" ></a><a href=directdoc.php?IDP='.$datas["IDpro"]."&mcat=".$rmycat."&mrub=".$rmyrub."&msrub=".$rmysrub.'><h3>'.$datas["Nompro"].'</h3></a><h6>'.$datas["Modelpro"].'</h6><a href="directdoc.php?IDP='.$datas["IDpro"]."&mcat=".$rmycat."&mrub=".$rmyrub."&msrub=".$rmysrub.'" class="butonde"><img src="images/detaill.png" /></a></td>';
        $con=$con+1;
	}
       	else 
	{
		echo '</tr><tr  ><td class="doctitlepro" valign="top"><h3>'.$datas["Nompro"].'</h3><a href=directdoc.php?IDP='.$datas["IDpro"]."&mcat=".$rmycat."&mrub=".$rmyrub."&msrub=".$rmysrub.'><img src="'.$image.'" /></a><a href=directdoc.php?IDP='.$datas["IDpro"]."&mcat=".$rmycat."&mrub=".$rmyrub."&msrub=".$rmysrub.'><h3>'.$datas["Nompro"].'</h3></a><h6>'.$datas["Modelpro"].'</h6><a href="directdoc.php?IDP='.$datas["IDpro"]."&mcat=".$rmycat."&mrub=".$rmyrub."&msrub=".$rmysrub.'" class="butonde"><img src="images/detaill.png" /></a></td>';
		$con=2;
	}
	
		  }
      }
	   
}
 if($_total>6){

 echo '<div class="page">'.barre_navigation($_total, $nb_affichage_par_page, $_GET['debut'], 3).'';
echo'</div>';
	}
     echo '<tr></table>';
     
    $RSdoc=NULL;
    $datas=NULL;  
	}
	else
	{
	if (!isset($_GET['debut']))
	$_GET['debut'] = 0;
	$sql="SELECT count(*) FROM (m_rubrique INNER JOIN (m_categorie INNER JOIN artproduit ON m_categorie.catID = artproduit.catID) ON (m_categorie.catID = m_rubrique.catID) AND (m_rubrique.rubID = artproduit.rubID)) INNER JOIN m_sousrubrique ON (m_rubrique.rubID = m_sousrubrique.rubID) AND (artproduit.srubID = m_sousrubrique.srubID) WHERE (((artproduit.catID)=".$rmycat.") AND ((artproduit.rubID)=".$rmyrub.") AND ((artproduit.srubID)=".$rmysrub.")  AND ((artproduit.Marquepro)='".$mar."'));";

$resultat = mysqli_query($mydbobj,$sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error());


$total = mysqli_fetch_array($resultat);
$b_total=$total[0];
 if($b_total>6){
 echo '<div class="page">'.barre_navigation($b_total, $nb_affichage_par_page, $_GET['debut'], 3).'';
echo'</div>';
	}
		
		 $sqldoc="SELECT artproduit.IDpro,artproduit.Modelpro, artproduit.catID, artproduit.rubID, artproduit.srubID, artproduit.Nompro, artproduit.imagepro, artproduit.Marquepro, m_categorie.catlibelle, m_rubrique.rublibelle, m_sousrubrique.srubLibelle,m_sousrubrique.srubdesc FROM (m_rubrique INNER JOIN (m_categorie INNER JOIN artproduit ON m_categorie.catID = artproduit.catID) ON (m_categorie.catID = m_rubrique.catID) AND (m_rubrique.rubID = artproduit.rubID)) INNER JOIN m_sousrubrique ON (m_rubrique.rubID = m_sousrubrique.rubID) AND (artproduit.srubID = m_sousrubrique.srubID) WHERE (((artproduit.catID)=".$rmycat.") AND ((artproduit.rubID)=".$rmyrub.") AND ((artproduit.srubID)=".$rmysrub.")  AND ((artproduit.Marquepro)='".$mar."'))LIMIT ".$_GET['debut'].",".$nb_affichage_par_page.";";
   $RSdoc = mysqli_query($mydbobj,$sqldoc) or die('Erreur SQL !<br>'.$sqldoc.'<br>'.mysqli_error());
	echo  '<table cellpadding=0 cellspacing=10>';
	
	  echo'<tr>';
	  $con=1;
	while($datas=mysqli_fetch_assoc($RSdoc))
	{
$image=substr ($datas["imagepro"],3,strlen($datas["imagepro"]));
      
      if (mysqli_num_rows($RSdoc)==1)
      {
       echo'<td align="center" >'.$datas["Nompro"].'</td>';
      }
        else
      {
		  if ($modview==1)
		  {
			    
		echo '<tr><td valign="top" ><h3>'.$datas["Nompro"].'</h3><a href=directdoc.php?IDP='.$datas["IDpro"]."&mcat=".$rmycat."&mrub=".$rmyrub."&msrub=".$rmysrub.'><img src="'.$image.'" ></a><a href=directdoc.php?IDP='.$datas["IDpro"]."&mcat=".$rmycat."&mrub=".$rmyrub."&msrub=".$rmysrub.'><h3>'.$datas["Nompro"].'</h3></a><h6>'.$datas["Modelpro"].'</h6></td><td><a href="directdoc.php?IDP='.$datas["IDpro"]."&mcat=".$rmycat."&mrub=".$rmyrub."&msrub=".$rmysrub.'" class="butonde"><img src="images/detaill.png" /></a></td><tr>';
		  }else
		  {
	   if ($con<4)
	   
	  {
		echo '<td class="doctitlepro" valign="top" ><h3>'.$datas["Nompro"].'</h3><a href=directdoc.php?IDP='.$datas["IDpro"]."&mcat=".$rmycat."&mrub=".$rmyrub."&msrub=".$rmysrub.'><img src="'.$image.'" ></a><a href=directdoc.php?IDP='.$datas["IDpro"]."&mcat=".$rmycat."&mrub=".$rmyrub."&msrub=".$rmysrub.'><h3>'.$datas["Nompro"].'</h3></a><h6>'.$datas["Modelpro"].'</h6><a href="directdoc.php?IDP='.$datas["IDpro"]."&mcat=".$rmycat."&mrub=".$rmyrub."&msrub=".$rmysrub.'" class="butonde"><img src="images/detaill.png" /></a></td>';
        $con=$con+1;
	}
       	else 
	{
		echo '</tr><tr  ><td class="doctitlepro" valign="top"><h3>'.$datas["Nompro"].'</h3><a href=directdoc.php?IDP='.$datas["IDpro"]."&mcat=".$rmycat."&mrub=".$rmyrub."&msrub=".$rmysrub.'><img src="'.$image.'" /></a><a href=directdoc.php?IDP='.$datas["IDpro"]."&mcat=".$rmycat."&mrub=".$rmyrub."&msrub=".$rmysrub.'><h3>'.$datas["Nompro"].'</h3></a><h6>'.$datas["Modelpro"].'</h6><a href="directdoc.php?IDP='.$datas["IDpro"]."&mcat=".$rmycat."&mrub=".$rmyrub."&msrub=".$rmysrub.'" class="butonde"><img src="images/detaill.png" /></a></td>';
		$con=2;
	}
	
		  }
      }
	   
}
     echo '<tr></table>';
     
    $RSdoc=NULL;
    $datas=NULL;
		
	}
  } 
}
  else
{
 if ($rmysrub==NULL)
  {
    $sqldoc="SELECT artproduit.IDpro,artproduit.Modelpro, artproduit.Nompro, artproduit.Refpro, m_categorie.catlibelle, m_rubrique.rublibelle ";
    $sqldoc=$sqldoc."FROM m_rubrique INNER JOIN (m_categorie INNER JOIN artproduit ON m_categorie.catID = artproduit.catID) ON (m_categorie.catID = m_rubrique.catID) AND (m_rubrique.rubID = artproduit.rubID) ";
    $sqldoc=$sqldoc."WHERE ((artproduit.IDpro)=".$proID.");";
  }
    else
  {
  	if (!isset($_GET['debut']))
	$_GET['debut'] = 0;
	
 $sql="SELECT count(*)FROM (m_rubrique INNER JOIN (m_categorie INNER JOIN artproduit ON m_categorie.catID = artproduit.catID) ON (m_categorie.catID = m_rubrique.catID) AND (m_rubrique.rubID = artproduit.rubID)) INNER JOIN m_sousrubrique ON (m_rubrique.rubID = m_sousrubrique.rubID) AND (artproduit.srubID = m_sousrubrique.srubID) ";
    $sql=$sql."WHERE (((artproduit.IDpro)=".$proID."))";
$resultat = mysqli_query($mydbobj,$sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error());


$total = mysqli_fetch_array($resultat);
$b_total=$total[0];
 if($b_total>3){
	 echo '<div class="page">'.barre_navigation($b_total, $nb_affichage_par_page, $_GET['debut'], 3).'';
echo'</div>';
	}
    $sqldoc="SELECT artproduit.IDpro,artproduit.Modelpro, artproduit.Nompro, artproduit.Refpro, artproduit.discriptionpro,artproduit.caratecpro, artproduit.Prixpro,artproduit.imagepro,artproduit.Marquepro, m_categorie.catlibelle, m_rubrique.rublibelle, m_sousrubrique.srubLibelle ";
    $sqldoc=$sqldoc."FROM (m_rubrique INNER JOIN (m_categorie INNER JOIN artproduit ON m_categorie.catID = artproduit.catID) ON (m_categorie.catID = m_rubrique.catID) AND (m_rubrique.rubID = artproduit.rubID)) INNER JOIN m_sousrubrique ON (m_rubrique.rubID = m_sousrubrique.rubID) AND (artproduit.srubID = m_sousrubrique.srubID) ";
    $sqldoc=$sqldoc."WHERE (((artproduit.IDpro)=".$proID."))";
  } 
$RSdoc = mysqli_query($mydbobj,$sqldoc) or die('Erreur SQL !<br>'.$sqldoc.'<br>'.mysqli_error());
	while($datas=mysqli_fetch_assoc($RSdoc))
   {
$image=substr ($datas["imagepro"],3,strlen($datas["imagepro"]));
//---------------------------------	
    
    echo '<table width="100%" border =0 cellpadding=3 cellspacing=3 class="prodetail">';
    echo '<tr>
	     <td colspan="2"><h3>'.$datas["Nompro"].'</h3></td></tr>';
		echo'<tr>
		<td width="280px" valign="top"><img src="'.$image.'"/></td>
		<td valign="top"><a href="directdoc.php?mcat='.$rmycat.'&mrub='.$rmyrub.'&msrub='.$rmysrub.'"class="btprodred"></a>
		     <br><h3>'.$datas["Nompro"].'</h3><h4> Marque : '.$datas["Marquepro"].'<br>Model  : '.$datas["Modelpro"].'<br>R&eacute;ferance  : '.$datas["Refpro"].'
             
             </h4></td></tr>';
		echo'<tr><td colspan="2" ><ul id="tabs">
    <li><a href="#" title="tab1">Discription</a></li>
    <li><a href="#" title="tab2">Caracteristique</a></li>

    <li><a href="#" title="tab3">T&eacute;l&eacute;chargement</a></li> 
	<!-- <li><a href="javascript:history.back()" title="tab4">Retour</a></li> -->  
</ul>

<div id="content"> 
    <div id="tab1">
        <p>'.$datas["discriptionpro"].'</p>
    </div>
    <div id="tab2">
      <p>'.$datas["caratecpro"].'</p>    
    </div>
    <div id="tab3">
        <p>'.$datas["Modelpro"].'</p>
    </div>
</div>
</td></tr>';
    echo '</table>';
  } 
  $RSdoc=NULL;
$datas=NULL;
}
if ($proID==NULL){
 if ($mar ==NULL){
 if($_total>6)
 echo '<div class="page">'.barre_navigation($_total, $nb_affichage_par_page, $_GET['debut'], 3).'';
echo'</div>';
}
else{
if($b_total>6)
 echo '<div class="page">'.barre_navigation($b_total, $nb_affichage_par_page, $_GET['debut'], 3).'';
echo'</div>';
}
}
echo "</td></tr></table>";
echo '

<script>
$(document).ready(function() {
	$("#content div").hide(); 
	$("#tabs li:first").attr("id","current"); 
	$("#content div:first").fadeIn(); 
    
    $("#tabs a").click(function(e) {
        e.preventDefault();        
        $("#content div").hide(); 
        $("#tabs li").attr("id",""); 
        $(this).parent().attr("id","current"); 
        $("#" + $(this).attr("title")).fadeIn(); 
    });
})();
</script>';
include ("common/footer.php");

?>
