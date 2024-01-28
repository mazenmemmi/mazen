
<table width="100%" border="0" cellspacing="0" cellpadding="0"  bgcolor="#314150">
<tr ><td bgcolor= white><ul class="menuB">
 <!-- <li><img src="images/bckmenu.gif" border=0 height="40px" /></li> -->
<?php

/* code settings2021*/

/* code settings2021*/
$mydbobj =new mysqli("localhost", "dcstecgr_artcomu", "artcom2015artcom","dcstecgr_webdbfr");

if ($mydbobj -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mydbobj -> connect_error;
    exit();
}
mysqli_select_db($mydbobj,'dcstecgr_webdbfr');
   $sqlcat="SELECT * from m_categorie ORDER BY catorder;";
   $RScategorie = mysqli_query($mydbobj,$sqlcat) or die('Erreur SQL !<br>'.$sqlcat.mysqli_error());
   while($datarsc = mysqli_fetch_assoc($RScategorie))
     {
	   	$mycat=$datarsc['catID'];
    	$rubsql="SELECT m_categorie.catID, m_rubrique.* ";
		$rubsql=$rubsql."FROM m_categorie INNER JOIN m_rubrique ON m_categorie.catID = m_rubrique.catID ";
		$rubsql=$rubsql."WHERE (((m_categorie.catID)=".$mycat." )) ORDER BY ruborder;";
    	$RSrubrique = mysqli_query($mydbobj,$rubsql) or die('Erreur SQL !<br>'.$rubsql.'<br>'.mysqli_error());
  			$mycounter=-1;
		    while($datarub = mysqli_fetch_array($RSrubrique))
			{
				$myrub= $datarub['rubID'];
				$mytype=$datarub['rubTYPE'];
				if($datarub['rubopen']==-1) 
				{
					$mycounter=$mycounter+1;
					$sqlsrub="SELECT count(rubid) as tot FROM m_sousrubrique where rubid=".$myrub." ; ";
					$RSsousrubrique = mysqli_query($mydbobj,$sqlsrub) or die('Erreur SQL !<br>'.$sqlsrub.'<br>'.mysqli_error());
					$datasrub = mysqli_fetch_array($RSsousrubrique);
					$tot=$datasrub['tot'];
					if ($tot!=0)
					{
				       echo ' <li><a href="#">&nbsp;'.$datarub['rublibelle'].'&nbsp;<img src="images/menuitemsep.gif" border=0 height="40px" style="position:absolute;" /></a> ';
					   echo '<ul>';
    $sqlsrub="SELECT m_sousrubrique.rubID, m_sousrubrique.srubID, m_sousrubrique.srubLibelle, m_sousrubrique.srubTYPE, m_sousrubrique.sruborder FROM (m_categorie INNER JOIN m_rubrique ON m_categorie.catID = m_rubrique.catID) INNER JOIN m_sousrubrique ON m_rubrique.rubID =m_sousrubrique.rubID WHERE (((m_sousrubrique.rubID)=".$myrub.")) ORDER BY sruborder ;";
    $srubcountersss=-1;
    $RSsousrubriquesss = mysqli_query($mydbobj,$sqlsrub) or die('Erreur SQL !<br>'.$sqlsrub.'<br>'.mysqli_error());
	while($datarsrubsss = mysqli_fetch_array($RSsousrubriquesss))
    { 
      $srubcountersss++;
	  $mysrubsss=$datarsrubsss["srubID"];
      $mytypesss=$datarsrubsss["srubTYPE"];
	  $prpt=fchecktype($mytypesss,"menu")."?mcat=".$mycat."&mrub=".$myrub."&msrub=".$mysrubsss;
	 echo '<li><a href='.$prpt.'>'.$datarsrubsss["srubLibelle"].'</a></li><br>';
  
       } 
				   echo'</ul>';   		   
					echo' </li>';
					   
				     					
					}
					else
					{

						echo '<li><a href="#">&nbsp;'.$datarub['rublibelle'].'&nbsp;<img src="images/menuitemsep.gif" border=0 height="40px" style="position:absolute;" /></a></li>';
					}
							}
				
				else
				{
					echo '<li><a href='.fchecktype($mytype,"menu").'?mcat='.$mycat.'&mrub='.$myrub.'>&nbsp;'.$datarub['rublibelle'].'&nbsp;<img src="images/menuitemsep.gif" border=0 height="40px" style="position:absolute;" /></a></li>';

				}

				}
			}
		?>
		
         </ul>
</td>
<td class="searchpos">
    <div id="white">
        <form method="get" action="recherche.php" method="get" id="search">
            <input name="q" type="text" size="50" placeholder="Recherche..." />
        </form>
    </div>
</td>

</tr>


      <tr><td bgcolor="#FE6601" height="100%"></td></tr>
           </table>
