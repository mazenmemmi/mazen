  </td> 
<!-- END CONTENT   
 </tr><tr ><td colspan="3"><hr color="#CCCCCC" width="75%" /></td></tr>--> 
 <tr>
  <td>
  <div id="foott" >
  <TABLE width="100%"   BORDER="0" CELLPADDING=0 CELLSPACING=0 >
  
  <TR valign="top" >
   <?php


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
				       echo '<TD style="color:#fff;"><a href="#">&nbsp;'.$datarub['rublibelle'].'&nbsp;</a> ';
			         		    $sqlsrub="SELECT m_sousrubrique.rubID, m_sousrubrique.srubID, m_sousrubrique.srubLibelle, m_sousrubrique.srubTYPE, m_sousrubrique.sruborder FROM (m_categorie INNER JOIN m_rubrique ON m_categorie.catID = m_rubrique.catID) INNER JOIN m_sousrubrique ON m_rubrique.rubID =m_sousrubrique.rubID WHERE (((m_sousrubrique.rubID)=".$myrub.")) ORDER BY sruborder ;";
    $srubcountersss=-1;
    $RSsousrubriquesss = mysqli_query($mydbobj,$sqlsrub) or die('Erreur SQL !<br>'.$sqlsrub.'<br>'.mysqli_error());
	echo  '<UL >';
	while($datarsrubsss = mysqli_fetch_array($RSsousrubriquesss))
    { 
      $srubcountersss++;
	  $mysrubsss=$datarsrubsss["srubID"];
      $mytypesss=$datarsrubsss["srubTYPE"];
	  $prpt=fchecktype($mytypesss,"menu")."?mcat=".$mycat."&mrub=".$myrub."&msrub=".$mysrubsss;
	 echo '<li><a href='.$prpt.'>'.$datarsrubsss["srubLibelle"].'</a></li>';
  
     } 
  echo'</ul></TD>';   		  
				     					
					}
					else
					{
						 echo '<TD><UL><LI><a href="#">&nbsp;'.$datarub['rublibelle'].'&nbsp</a></li></UL></TD>';
					}
	}
				
				else
				{
					echo '<TD><UL><li><a href='.fchecktype($mytype,"menu").'?mcat='.$mycat.'&mrub='.$myrub.'>&nbsp;'.$datarub['rublibelle'].'&nbsp;</a></li>';
echo'</ul></TD>';
				}

				}
			}
		?>
        
  </tr>
  </table>
  </div>
  <tr bgcolor="#D0D0D0"><td>&nbsp;</td></tr>
 <tr bgcolor="#D1D1D1"><td  align="center" color="white" >Adresse , 71 Av Alan Savary Bloc A32 cite Elkhadra 1003 Tunis Tunisie, TEL : +216 71 808 508, +216 98 32 70 40 <a style="color:#999;" href="mailto:artcom@artcom.com.tn">DCSTECGROUPE@DCSTECGROUPE.com.tn</a></td></tr>
           <tr bgcolor="#D1D1D1"><td colspan="3"  align="center"> <font color="#333333" size="1">� 1996 / <? echo strftime("%Y",time());?> - <b>DCSTECGROUPE</b></font></td></tr>
   </TABLE>
</div>
</body>
</html>
<?php 

$mydbobj=NULL;
$rmycat=NULL;
$rmyrub=NULL;
?>
