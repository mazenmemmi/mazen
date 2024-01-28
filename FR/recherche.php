<?php
include("common/settings.php");
include("common/tools.php");
include("common/header.php");
include("common/menu.php");
echo '<img border="0" src="images/flash2.jpg">';
?>

<?php
echo '<table border=0  width="20%" cellpadding="0" cellspacing="0"><tr>';
echo'<link rel="stylesheet" href="css/lien.css" type="text/css" />';
echo '<tr><td valign="top">';
//-----------
//tableau menu vertical
echo '<div id="wrap">';

echo '<ul class="menu">';
//****Icon Contact******************//

//-----Partie Boutons Service-----------//
echo '
<div id="boxService">
  <span>Service</span>

  <div id="boxBeratung">
    <a href="#"><img src="images/TEST.jpg" width=180px height=148px alt="Wir beraten Sie gerne" /></a>
  </div>

  <div id="boxButtons">
    <a href="servicetech.php" class="werkstatt">Werkstatt</a>
    <a href="contact.php" class="rueckruf">R�ckruf anfordern</a>
    
  </div>
</div>';
/*
<a href="angebot-anfordern" class="angebot">Angebot anfordern</a>
<a href="downloads" class="downloads">Downloads</a>
*/

$j=0;
$rech=$_GET["q"]; 
if (($rech == "")||($rech == "%")) {
// Si aucun mot cl� n'a �t� saisi,
// le script demande � l'utilisateur
// de bien vouloir pr�ciser un mot cl�

	echo '<td width=300% valign="top"><tr>';
	echo "<p><center><h3>Veuillez entrer un mot cl� s'il vous pla�t!
	</center></h3></p></tr></td>";

}
else{
 echo '<td width=100% valign="top">';
 $array=explode(" ",$rech);
$sqlrech="SELECT distinct* FROM artproduit where Nompro LIKE '%$array[0]%'";
if(count($array)>1){

for($i=1;$i< count($array);$i++){

 $sqlrech=$sqlrech."OR Nompro LIKE '%$array[$i]%'";
 
 }
}

$resultat1=mysqli_query($mydbobj,$sqlrech);

while ($val = mysqli_fetch_array($resultat1)) {
	
$j=1;
    echo '<table border="0" cellpadding="5" cellspacing="0">';
echo '<tr>';
echo '<td>';
$image=substr ($val["imagepro"],3,strlen($val["imagepro"]));
echo '<div class="type"';
	echo' <li><a href=directdoc.php?IDP='.$val["IDpro"]."&mcat=".$val["catID"]."&mrub=".$val["rubID"]."&msrub=".$val["srubID"].'><img src="'.$image.'" border=0 height="40px" /></a></li>';
		echo'</td>';
		
		echo '</div>';
		echo '<td>';
 echo $val["Nompro"]; 
		echo'</td>';
			echo '<td>';
 //echo $val["discriptionpro"]; 
		echo'</td>';
	echo '</tr>';
echo '</table>'; 
   
	 

    // D�connexion
}
   
  // mysql_close();


echo'<style type="text/css">

a.type1 { color: blue; }
a.type1:hover { color: red;}
</style>';
echo'<style type="text/css">

a.type { 
color: blue; }
a.type:hover { 
color: red;}
img.type{
}
</style>';

 
/* 
$sqlrech="SELECT distinct * FROM m_sousrubrique where srubLibelle LIKE '%$array[0]%'";
if(count($array)>1){

for($i=1;$i< count($array);$i++){

 $sqlrech=$sqlrech."OR doctitle LIKE '%$array[$i]%'";
 
 }
}

 

$resultat2=mysql_query($sqlrech);
 if(count ($resultat2)!=0){
while ($val = mysql_fetch_array($resultat2)) { 
    echo '<table border="0" cellpadding="5" cellspacing="0" width="300%">';
echo '<tr>';
echo '<td>';
echo '<div class="type1"';
if($val["srubTYPE"]=="PRO")


$sqlcat="SELECT * from m_categorie ORDER BY catorder;";
   $RScategorie = mysql_query($sqlcat) or die('Erreur SQL !<br>'.$sqlcat.mysql_error());
   while($datarsc = mysql_fetch_assoc($RScategorie))
     {
	   	$mycat=$datarsc['catID'];
    	$rubsql="SELECT m_categorie.catID, m_rubrique.* ";
		$rubsql=$rubsql."FROM m_categorie INNER JOIN m_rubrique ON m_categorie.catID = m_rubrique.catID ";
		$rubsql=$rubsql."WHERE (((m_categorie.catID)=".$mycat." )) ORDER BY ruborder;";
    	$RSrubrique = mysql_query($rubsql) or die('Erreur SQL !<br>'.$rubsql.'<br>'.mysql_error());
  			$mycounter=-1;
	
			}

	  echo'<li><a href="directdoc.php?mcat='.$rmycat.'&mrub='.$rmyrub.'&msrub='.$val["srubID"].'">'.$val["srubLibelle"].'</a>';
	else
	   echo'<li><a href="doc.php?mcat='.$rmycat.'&mrub='.$rmyrub.'&msrub='.$val["srubID"].'">'.$val["srubLibelle"].'</a>';
		echo'</td>';
echo '</div>';
		
		
	echo '</tr>';
echo '</table>'; 
   
	 

    // D�connexion

   }
   }
  // mysql_close();
  */
$sqlrech="SELECT distinct * FROM documents where doctitle like'%$array[0]%'";
  if(count($array)>1){
  $sqlrech="SELECT distinct * FROM documents where doctitle like'%$array[0]%'";
for($i=1;$i< count($array);$i++){

 $sqlrech=$sqlrech."OR doctitle LIKE '%$array[$i]%'";
 
 }
}
 
$resultat3=mysqli_query($mydbobj,$sqlrech);
 
 
while ($val = mysqli_fetch_array($resultat3)) {
$j=1;
    echo '<table border="0" cellpadding="5" cellspacing="0" width="300%">';
echo '<tr>';
echo '<td>';
echo '<div class="type1"';
	echo' <li><a href=doc.php?mcat='.$val["catID"]."&mrub=".$val["rubID"]."&msrub=".$val["srubID"].' class="type1"> '.$val["doctitle"].'</a></li>';
	
		echo'</td>';
	
echo '</div>';
		
		
	echo '</tr>';
echo '</table>'; 
   
  	 

    // D�connexion

	
		


	
	
 
  }

  if($j==0){

  
  echo '<td width=300% valign="top"><tr>';
	echo "<p><center><h3>Aucune r�sultat correspond a votre recherche
	</center></h3></p></tr></td>";

  
  }
  }
?>



 


</td>
	</tr>


		</td>
	</tr>
</table>
<?php
include("common/footer.php");
?>
