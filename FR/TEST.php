<?php
include("common/settings.php");
include("common/tools.php");
include ("common/header.php");
include ("common/menu.php");
echo'<img border="0" src="images/flash2.jpg">';
if(isset ($_GET["mcat"])){$rmycat=$_GET["mcat"];}
if(isset ($_GET["mrub"])){$rmyrub=$_GET["mrub"];}else {$rmyrub=NULL;}
if(isset ($_GET["msrub"])){$rmysrub=$_GET["msrub"];}else{$rmysrub=NULL; }
if(isset ($_GET["docID"])){$rmydocid=$_GET["docID"];}else {$rmydocid=NULL;}
if(isset ($_GET["dev"])){$rmydev=$_GET["dev"];}
if(isset ($_GET["Modvi"])){$modvi=$_GET["Modvi"];}else {$modvi=NULL;}
if(isset ($_GET["dev"])){$rmydev=true;}else{$rmydev=false;} 
if(isset ($_GET["arid"])){$rmyarid=$_GET["arid"]; }
if(isset ($_GET["IDP"])){$proID=$_GET["IDP"]; }else {$proID=NULL;}//IDP
if(isset ($_GET["artid"])){$rmyartid=$_GET["artid"]; }else {$rmyartid=NULL;}
echo '<div class="hera" style="width:100%;">';
//menu hera
echo '<a href="home.php" class="breadcrumb"  ><img src="img/home.png"></a><a href="directdoc.php?mcat='.$rmycat.'&mrub='.$rmyrub.'" class="breadcrumb"  >'.MENUVERN2($rmyrub).'</a>';
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
echo '<div id="menu">';
$sqqql="SELECT * FROM m_sousrubrique where rubID=".$rmyrub."; ";
$dsql=mysqli_query($mydbobj,$sqqql);

while ($dsq=mysqli_fetch_array($dsql))
{
        echo'<dl><dt><a href="#">'.$dsq["srubLibelle"].'</a></dt>';
		$red="select * from artproduit where srubID=".$dsq["srubID"]."  GROUP BY Marquepro ;";
           $Rre = mysqli_query($mydbobj,$red) or die('Erreur SQL !<br>'.$red.'<br>'.mysqli_error());
		if ($dsq["srubID"]==$rmysrub)
		  { 
		     echo '<dd id="open"><ul>';
		  }else
		  {
			  echo '<dd><ul>';
			  }
	           while($red1=mysqli_fetch_array($Rre))
                  {
	                echo'<li><a href="/">'.$red1["Marquepro"].'</a></li>';
	               }
              echo '</ul></dd>';
			  
		  
 echo '</dl>';	
}$red=NULL;
			  $red1=NULL;
			  $Rre=NULL;
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
    <a href="erkstatt" class="werkstatt">Werkstatt</a>
    <a href="contact.php" class="rueckruf">Rückruf anfordern</a>
    <a href="angebot-anfordern" class="angebot">Angebot anfordern</a>
    <a href="downloads" class="downloads">Downloads</a>
  </div>
</div>';


echo '<table width="100%"><tr>';
echo '<td><a href="#"><img src="images/face.png" width="50" height="50" /></a></td>&nbsp;<td>
<a href="#"><img src="images/google.png" width="50" height="50" /></a></td>';
echo  '</tr></table>';
echo"</td>";
$sqldoc="SELECT * FROM m_sousrubrique where rubID=".$rmyrub."  ORDER BY sruborder;";
$RSdoc = mysqli_query($mydbobj,$sqldoc) or die('Erreur SQL111 !<br>'.$sqldoc.'<br>'.mysqli_error());
echo '<td width=80% valign="top" style="border:1PX;" >';
echo '<table width="800"  class="tab" cellpadding="0" cellspacing="0">
<tr><form>
<td>Marques :</td><td><select style="width:190PX;" name="marq">';
$red="select * from artproduit where srubID=".$rmysrub."  GROUP BY Marquepro ;";
$Rre = mysqli_query($mydbobj,$red) or die('Erreur SQL !<br>'.$red.'<br>'.mysqli_error());
        	    while($red1=mysqli_fetch_array($Rre))
                  {
	               echo '<option value='.$red1["Marquepro"].'>'.$red1["Marquepro"].'</option>';
	               }

$red=NULL;
$red1=NULL;
$Rre=NULL;
echo '</select></td><td>Models :</td><td><select style="width:190PX;">';
   $red="select * from artproduit where srubID=".$rmysrub."  GROUP BY Modelpro ;";
           $Rre = mysqli_query($mydbobj,$red) or die('Erreur SQL !<br>'.$red.'<br>'.mysqli_error());
while($red1=mysqli_fetch_array($Rre))
                  {echo'<option>'.$red1["Modelpro"].'</option>';
				  }
				  $red=NULL;
			  $red1=NULL;
			  $Rre=NULL;
echo'</select></td></form>';
if ($modvi==NULL)
{
echo '<td><a href=directdoc.php?mcat='.$rmycat.'&mrub='.$rmyrub.'&msrub='.$rmysrub.'&Modvi=1>vue</a></td></tr></table>';}
else {echo '<td><a href=directdoc.php?mcat='.$rmycat.'&mrub='.$rmyrub.'&msrub='.$rmysrub.'>vue</a></td></tr></table>';
	}
if ($proID==NULL)
{
  if ($rmysrub==NULL)
  {


   $sqldoc="SELECT * FROM m_sousrubrique where rubID=".$rmyrub." ORDER BY sruborder;";
	$RSdoc = mysqli_query($mydbobj,$sqldoc) or die('Erreur SQL111 !<br>'.$sqldoc.'<br>'.mysqli_error());
	  echo  '<table  cellpadding=0 cellspacing=10>';
	  echo '<tr>';
	  $con=1;
	while($datas=mysqli_fetch_assoc($RSdoc))
	{  
	     $image=substr ($datas["srubimg"],3,strlen($datas["srubimg"]));
         if ($con<4)
	     {
              echo '<td class="doctitle" valign="top"><h3>'.$datas["srubLibelle"].'</h3><a href=directdoc.php?mcat='.$rmycat.'&mrub='.$datas["rubID"].'&msrub='.$datas["srubID"].'><img src="'.$image.'"/></a><h3><a href=directdoc.php?mcat='.$rmycat.'&mrub='.$datas["rubID"].'&msrub='.$datas["srubID"].'>'.$datas['srubLibelle'].'</a></h3><h6>'.$datas["srubdesc"].'</h6><a href="#" class="butonde"><img src="images/detaill.jpg" /></a></td>';
		  $con=$con+1;
	     }
          else
	     {
	          echo '</tr><tr><td class="doctitle" valign="top" ><h3>'.$datas["srubLibelle"].'</h3><a href=directdoc.php?mcat='.$rmycat.'&mrub='.$datas["rubID"].'&msrub='.$datas["srubID"].'><img src="'.$image.'" /></a><a href=directdoc.php?mcat='.$rmycat.'&mrub='.$datas["rubID"].'&msrub='.$datas["srubID"].'><h3>'.$datas['srubLibelle'].'</h3></a><h6>'.$datas["srubdesc"].'</h6><a href="#" class="butonde"><img src="images/detaill.jpg" /></a></td>';
	 $con=2;
	}
} 

      
     echo '</tr></table>';
$Rsdoc=NULL;
$RSdoc=NULL;

  }
    else
  { 
 
    $sqldoc="SELECT artproduit.IDpro,artproduit.Modelpro, artproduit.catID, artproduit.rubID, artproduit.srubID, artproduit.Nompro, artproduit.imagepro, artproduit.Marquepro, m_categorie.catlibelle, m_rubrique.rublibelle, m_sousrubrique.srubLibelle,m_sousrubrique.srubdesc FROM (m_rubrique INNER JOIN (m_categorie INNER JOIN artproduit ON m_categorie.catID = artproduit.catID) ON (m_categorie.catID = m_rubrique.catID) AND (m_rubrique.rubID = artproduit.rubID)) INNER JOIN m_sousrubrique ON (m_rubrique.rubID = m_sousrubrique.rubID) AND (artproduit.srubID = m_sousrubrique.srubID) WHERE (((artproduit.catID)=".$rmycat.") AND ((artproduit.rubID)=".$rmyrub.") AND ((artproduit.srubID)=".$rmysrub."));";
	
   $RSdoc = mysqli_query($mydbobj,$sqldoc) or die('Erreur SQL !<br>'.$sqldoc.'<br>'.mysqli_error());
   if ($modvi==1)
   {
    echo  '<table cellpadding=0 cellspacing=10 border="1">';
	echo'<tr>';
	 $con=1;
	 	echo '<div class="content"><div class="demo"><div id="paginationdemo" class="demo">';
	 while($datas=mysqli_fetch_assoc($RSdoc))
	  {
          $image=substr ($datas["imagepro"],3,strlen($datas["imagepro"]));
          if (mysqli_num_rows($RSdoc)==1)
          {
              echo'<td align="center" >'.$datas["Nompro"].'</td>';
          }
          else
          {
	
	 //class="doctitle"
	   
	 
		echo '<tr><td width=700% valign="top" ><h3>'.$datas["Nompro"].'</h3><a href=directdoc.php?IDP='.$datas["IDpro"]."&mcat=".$rmycat."&mrub=".$rmyrub."&msrub=".$rmysrub.'><img src="'.$image.'" ></a><a href=directdoc.php?IDP='.$datas["IDpro"]."&mcat=".$rmycat."&mrub=".$rmyrub."&msrub=".$rmysrub.'><h3>'.$datas["Nompro"].'</h3></a><h6>'.$datas["Modelpro"].'</h6></td><td  WIDTH=100 align=rigth><a href="directdoc.php?IDP='.$datas["IDpro"]."&mcat=".$rmycat."&mrub=".$rmyrub."&msrub=".$rmysrub.'"><img src="images/detaill.jpg" /></a></td></tr>';
       
	
	
	}}
	
     echo '<tr></table>';
   }
   else
   {
	   echo  '<table cellpadding=0 cellspacing=10>';
	echo'<tr>';
	 $con=1;
	 	echo '<div class="content"><div class="demo"><div id="paginationdemo" class="demo">';
	 while($datas=mysqli_fetch_assoc($RSdoc))
	  {
          $image=substr ($datas["imagepro"],3,strlen($datas["imagepro"]));
          if (mysqli_num_rows($RSdoc)==1)
          {
              echo'<td align="center" >'.$datas["Nompro"].'</td>';
          }
          else
          {
	
	  if ($con<4)
	   
	  {
		echo '<td class="doctitle" valign="top" ><h3>'.$datas["Nompro"].'</h3><a href=directdoc.php?IDP='.$datas["IDpro"]."&mcat=".$rmycat."&mrub=".$rmyrub."&msrub=".$rmysrub.'><img src="'.$image.'" ></a><a href=directdoc.php?IDP='.$datas["IDpro"]."&mcat=".$rmycat."&mrub=".$rmyrub."&msrub=".$rmysrub.'><h3>'.$datas["Nompro"].'</h3></a><h6>'.$datas["Modelpro"].'</h6><a href="directdoc.php?IDP='.$datas["IDpro"]."&mcat=".$rmycat."&mrub=".$rmyrub."&msrub=".$rmysrub.'" class="butonde"><img src="images/detaill.jpg" /></a></td>';
        $con=$con+1;
	}
	else 
	{
		echo '</tr><tr  ><td class="doctitle" valign="top"><h3>'.$datas["Nompro"].'</h3><a href=directdoc.php?IDP='.$datas["IDpro"]."&mcat=".$rmycat."&mrub=".$rmyrub."&msrub=".$rmysrub.'><img src="'.$image.'" /></a><a href=directdoc.php?IDP='.$datas["IDpro"]."&mcat=".$rmycat."&mrub=".$rmyrub."&msrub=".$rmysrub.'><h3>'.$datas["Nompro"].'</h3></a><h6>'.$datas["Modelpro"].'</h6><a href="directdoc.php?IDP='.$datas["IDpro"]."&mcat=".$rmycat."&mrub=".$rmyrub."&msrub=".$rmysrub.'" class="butonde"><img src="images/detaill.jpg" /></a></td>';
		$con=2;
	}
	
	}}
	
     echo '<tr></table>';
   }
    $RSdoc=NULL;
    $datas=NULL;   
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
		<td valign="top"><h3>'.$datas["Nompro"].'</h3><h4> Marque : '.$datas["Marquepro"].'<br>Model  : '.$datas["Modelpro"].'<br>R&eacute;ferance  : '.$datas["Refpro"].'<br>Prix : '.$datas["Prixpro"].'</h4></tr>';
		echo'<tr><td colspan="2" ><ul id="tabs">
    <li><a href="#" title="tab1">Discription</a></li>
    <li><a href="#" title="tab2">Caracteristique</a></li>

    <li><a href="#" title="tab3">T&eacute;l&eacute;chargement</a></li>   
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

echo "</td></tr></table>";
echo '<script src="js/pro.js"></script>

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