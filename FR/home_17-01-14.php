<?php
include("common/settings.php");
include("common/tools.php");
include ("common/header.php");
include ("common/menu.php");

echo'<table border="0">';
echo'<tr>';
echo '<td>';
include ("slider.php");
echo '</td>';

echo '<td>';
echo '</td>';

echo '<td>';

echo'<style type="text/css">

#boxservice1 {
float: left;
width: 194px;
height: 230px;
margin: 0;
padding: 0;
background: url(images/serviceBox.gif) no-repeat;
}
#boxberatung1 {
float: left;
margin: 0 0 0 7px;
padding: 0;

}

#boxbuttons1 {
float: left;
margin: 0 0 0 7px;
padding: 0;
}
#boxservice1 span {
display: block;
font-size: 1.0em;
line-height: 1.4em;
font-weight: bold;
text-align: center;
color: #fff;
height: 20px;
width: 200px;
margin: 0 0 10px;
padding: 11px 0 0;
border-bottom: none;
}

#boxbuttons1 a {
float: left;
margin: 0;
padding: 0;
height: 90px;
width: 90px;
}
a:visited.rueckruf {
display: block;
text-indent: -9999px;
width: 50px;
height: 90px;
margin: 0 0 px;
background: url(images/iconMap.png) no-repeat -270px 0;
}
</style>';


echo '
<div id="boxService1">
  <span>Service</span>

  <div id="boxBeratung1">
    <a href="#"><img src="images/TEST.jpg" width=180px height=100px alt="Wir beraten Sie gerne" /></a>
  </div>

  <div id="boxButtons1">
    <a href="servicetech.php" class="werkstatt">Werkstatt</a>
    <a href="contact.php" class="rueckruf">Rückruf anfordern</a>
    
  </div>
</div>';
echo '</td>';
echo '</table>';




$sqldoc="SELECT documents.docbody, documents.type from documents WHERE type = 'HOME' ;";
$Rsdoc = mysqli_query($sqldoc);

while($data = mysqli_fetch_assoc($Rsdoc))
    { 
           echo '<table border="0" align="center">
                 <tr>
                  <td>'.$data['docbody'].'</td>

                  </tr>
               </table>';
    }
$data=NULL;
$Rsdoc=NULL;
include('common/footer.php');
?>
