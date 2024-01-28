<table width="990" border="0" cellspacing="0" cellpadding="0"  bgcolor="#314150">
<tr ><td>
<span class="preload2"></span>
<div id="ddmenu"
 <link rel="stylesheet" type="text/css" href="./css/styles_menu.css.css">
<script src="./css/stuHover.js" type="text/javascript"></script>
<span class="preload1"></span>
<span class="preload2"></span>
<ul id="nav">


 <!--[if lt IE 7]>
<style type="text/css">
div {
width:expression(document.body.clientWidth >= 1000? "1000px": "auto" );
}
</style>
<![endif]-->

 
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
					
					//<li class="top"><a href="#" id="services" class="top_link"><span class="down">&nbsp;'.$datarub['rublibelle'].'&nbsp;<img src="images/menuitemsep.gif" border=0 height="40px" style="position:absolute;" /></span></a>
					
				       echo ' <li class="top"><a href="#" id="services" class="top_link">&nbsp;'.$datarub['rublibelle'].'&nbsp;</a> ';
					   echo '<ul class="sub">';
					   
					  
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

						echo '<li><a href="#">&nbsp;'.$datarub['rublibelle'].'&nbsp;</a></li>';
					}
							}
				
				else
				{
					//echo '<li><a href='.fchecktype($mytype,"menu").'?mcat='.$mycat.'&mrub='.$myrub.'>&nbsp;'.$datarub['rublibelle'].'&nbsp;</a></li>';

					
					//echo'<li class="top"><a href="'.fchecktype($mytype,"menu").'?mcat='.$mycat.'&mrub='.$myrub.'" id="services" class="top_link">&nbsp;'.$datarub['rublibelle'].'&nbsp;<span class="down"></span></a> ';
				echo ' <li class="top"><a href=""'.fchecktype($mytype,"menu").'?mcat='.$mycat.'&mrub='.$myrub.'"" id="services" class="top_link">&nbsp;'.$datarub['rublibelle'].'&nbsp;</a> ';
				}

				}
			}
		?>
         </ul>
		 </div>
</td></tr>

      <tr><td bgcolor="#FE6601" height="5"></td></tr>
           </table>
