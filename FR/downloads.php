<?php
include("common/settings.php");
include("common/tools.php");
include("common/header.php");
include("common/menu.php");
echo '<img border="0" src="images/flash2.jpg">';
?>


  <link rel="stylesheet" href="down/reset.css" type="text/css" />
   <link rel="stylesheet" href="down/layout.css" type="text/css" />
    <link rel="stylesheet" href="down/fancydropdown-en.css" type="text/css"/>
	 <link rel="stylesheet" href="down/prettyPhoto.css" type="text/css"/>


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
    <a href="contact.php" class="rueckruf">Rückruf anfordern</a>
    
  </div>
</div>';
/*
<a href="angebot-anfordern" class="angebot">Angebot anfordern</a>
<a href="downloads" class="downloads">Downloads</a>
*/
echo"</td>";
echo '<td width=80% valign="top">';


 echo '<div id="subWrap">
    <div id="sub">
      

      <div id="boxMainContent1" class="hyphenate text" lang="en">
        <h1>Downloads</h1>
        <p>Pilote actuelle, le firmware et les manuels peuvent être trouvés ici.</p>
        <div id="boxDownloads">'; 
        
        $sqlrech="SELECT * FROM  `artproduit` ORDER BY  `artproduit`.`Marquepro`";
$resultat=mysqli_query($sqlrech);
while ($val1 = mysqli_fetch_array($resultat)) {
       
         echo'<ul><li><span class="toggle">'.$val1["Marquepro"].'</span><ul><li><span class="toggle">DTC1000</span><ul><li><span class="toggle">Driver</span><ul><li><a href="http://www.intraproc.com./downloads/Fargo/DTC1000/Driver/DTC1000_DRV_1.0.0.40.2.exe">DTC1000_DRV_1.0.0.40.2.exe</a></li></ul></li></ul></li></ul></li></ul>
      ';
}
 echo' </div>      
      </div>
  </div>
  </div>
 </script>
  <script type="text/javascript" src="js/jMenu.js"></script>
</div>
</td>

</table>

		</td>
	</tr>
</table>';

 
include("common/footer.php");
?>
