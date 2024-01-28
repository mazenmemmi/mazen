
<?php
include ("common/settings.php");
include("common/tools.php");
if ($rmysrub=="")
{

  $sqllink="SELECT Links.catID, Links.rubID, Links.Link ";
  $sqllink=$sqllink."FROM m_rubrique INNER JOIN (m_categorie INNER JOIN Links ON m_categorie.catID = Links.catID) ON (m_categorie.catID = m_rubrique.catID) AND (m_rubrique.rubID = Links.rubID) ";
  $sqllink=$sqllink."WHERE (((Links.catID)=".$rmycat.") AND ((Links.rubID)=".$rmyrub."));";

  //$RSlink->Open$sqllink  $mydbobj
$RSlink=mysqli_query($mydbobj,$sqllink);
 while( $data = mysqli_fetch_assoc($RSlink))
  {

    header("Location: ".$data["link"]);
  } 

// close  & kill link rs
  //$RSlink->close;
$data=null;
  $RSlink=null;

}
  else
{
  $sqllink="SELECT Links.catID, Links.rubID, Links.srubID, Links.Link ";
  $sqllink=$sqllink."FROM (m_rubrique INNER JOIN (m_categorie INNER JOIN Links ON m_categorie.catID = Links.catID) ON (m_categorie.catID = m_rubrique.catID) AND (m_rubrique.rubID = Links.rubID)) INNER JOIN m_sousrubrique ON (m_rubrique.rubID = m_sousrubrique.rubID) AND (Links.srubID = m_sousrubrique.srubID) ";
  $sqllink=$sqllink."WHERE (((Links.catID)=".$rmycat.") AND ((Links.rubID)=".$rmyrub.") AND ((Links.srubID)=".$rmysrub."));";

  //$RSlink->Open$sqllink  $mydbobj
$RSlink=mysqli_query($sqllink);

  while( $data = mysqli_fetch_assoc($RSlink))
  {
    
    header("Location: ".$data["link"]);
  } 


// close  & kill link rs
  $data=NULL;
  $RSlink=NULL;

} 



?>

