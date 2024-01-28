<?php
$rubsql="SELECT m_categorie.catID, m_rubrique.*FROM m_categorie INNER JOIN m_rubrique ON m_categorie.catID = m_rubrique.catID WHERE (((m_rubrique.rubopen)=-1 )) ORDER BY ruborder; ";
$mycounter=-1;
$RSrubrique = mysql_query($rubsql) or die('Erreur SQL !<br>'.$rubsql.'<br>'.mysql_error()); 
{
 while($datarub = mysql_fetch_assoc($RSrubrique)) 
  {
    $mycounter++; 
    $myrub=$datarub['rubid'];  
    $mycat=$datarub['m_categorie.catid'];
    echo 'DQM_sub_xy'.$mycounter.' =0,13 <br>';
    echo 'DQM_sub_menu_width'.$mycounter.' = 180';
    $sqlsrub="SELECT m_sousrubrique.rubID, m_sousrubrique.srubID, m_sousrubrique.srubLibelle, m_sousrubrique.srubTYPE, m_sousrubrique.sruborder ";
   $sqlsrub=$sqlsrub."FROM (m_categorie INNER JOIN m_rubrique ON m_categorie.catID = m_rubrique.catID) INNER JOIN m_sousrubrique ON m_rubrique.rubID =m_sousrubrique.rubID ";  //sqlsrub
    $sqlsrub=$sqlsrub."WHERE (((m_sousrubrique.rubID)=".$myrub.")) ORDER BY sruborder ;";
    $srubcounter=-1;
    $RSsousrubrique = mysql_query($sqlsrub) or die('Erreur SQL !<br>'.$sqlsrub.'<br>'.mysql_error()); 
	while($datarsrub = mysql_fetch_array($RSsousrubrique)) 
    { 
      $srubcounter++;
	  $mysrub=$datarsrub["srubID"];
      $mytype=$datarsrub["srubTYPE"];
	  $prpt=fchecktype($mytype,"menu")."?mcat=".$mycat."&mrub=".$myrub."&msrub=".$mysrub;
	  echo '<li><a href="#">DQM_subdesc'.$mycounter.'_'.$srubcounter.'="'.$RSsousrubrique["srublibelle"].'"</a></li>';
	  echo '<li><a href="#">DQM_icon_index'.$mycounter.'_'.$srubcounter.'"</a></li>';
     if (!$prpt)
     {

       echo '<li><a href="#">DQM_url'.$mycounter.'_'.$srubcounter.'="'.$prpt.'"</a></li>';
     } 
  
       } 
   }
}
?>