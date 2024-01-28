<?php
include("common/settings.php");
include("common/tools.php");
include("common/header.php");
include("common/menu.php");
include ("slider2.php");
?>

<?php
echo '<table border=0  width="20%" cellpadding="0" cellspacing="0"><tr>';

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
echo"</td>";
echo '<td width=80% valign="top">';
?>



<td align="center" width="1" valign="top">

<img border="0" src="images/versep.gif" width="1" height="344"></td>
		<td valign="top">

<table border="0" width="100%" cellpadding="25">
	<tr>
		<td><font face="Arial" size="4" color="blue"><strong>Contactez DCSTECGROUPE</strong></font><hr color="blue" size="1">
		<p><b><font color="blue">Coordonn&eacute;s de DCSTECGROUPE</font></b></p>
<p><font color="blue">Adresse</font> : &nbsp;71 Av Alan Savary Bloc A32 cite Elkhadra 1003 Tunis Tunisie<br>
<font color="blue">T&eacute;l</font> :( +216) 71 808 508 </p>
<p><font color="blue">Mobile:</font>( +216) 98 32 70 40<br>
  <font color="blue">Fax</font> : (+216) 71 808 508<br>
  <font color="blue">Email</font> : <font color="#333333"><a href="mailto:DCSTECGROUPE@DCSTECGROUPE.com.tn">artcom@artcom.com.tn</a></font></p>
<hr color="blue" size="1">
		</td>
	</tr>
	<tr>
<td>

<script language="javascript">
function validateform()
{

if (document.ecriveznous.frmnom.value== '') 
{
alert ('Nom et pr�nom manquants !') ;
document.ecriveznous.frmnom.focus();
return false ; 
}

if (document.ecriveznous.frmemail.value== '' || document.ecriveznous.frmemail.value.indexOf('@', 0) == -1  || document.ecriveznous.frmemail.value.indexOf('.', 0) == -1) 
{
alert ('Verifiez votre email !') ;
document.ecriveznous.frmemail.focus();
return false ; 
}

if (document.ecriveznous.frmtel.value.length < 4 ) 
{
alert ('Verifiez votre N� de t�l�phone !') ;
document.ecriveznous.frmtel.focus();
return false ; 
}
if (document.ecriveznous.frmcountry.value == '-1' ) 
{
alert ('S�lectionnez le pays ') ;
document.ecriveznous.frmcountry.focus();
return false ; 
}


if (document.ecriveznous.frmsubject.value== '') 
{
alert ('Sp�cifiez le sujet de votre message SVP!') ;
document.ecriveznous.frmsubject.focus();
return false ; 
}

if (document.ecriveznous.frmmessage.value== '') 
{
alert ('Message / Requ�te manquant !') ;
document.ecriveznous.frmmessage.focus();
return false ; 
}


}
//-->
</script>


<br>
<table border="0" width="100%">
  <tr>
    <td width="100%">Merci de remplir les champs de ce formulaire&nbsp;</td>
  </tr>
  <tr>
    <td width="100%">
      <form method="POST" name="ecriveznous" action="contact.php" onSubmit="return validateform()">
        <input type="hidden" name="send" value="True">
        <table border="0" width="100%" cellpadding="1">
          <tr>
            <td valign="top" colspan="2">
              <font color="blue" size="1">* Champs requis&nbsp;<br><br></font> </td>
          </tr>
          <tr>
            <td valign="top"><font color="blue">&nbsp; Nom et prenom:</font></td>
            <td><input type="text" size="24" name="frmnom"><font color="blue"> *</font></td>
          </tr>
         
          <tr>
            <td valign="top"><font color="blue">&nbsp; Soci&eacute;&eacute;:</font></td>
            <td><input type="text" size="24" name="frmcompany"><font color="blue"> *</font></td>
          </tr>
          
          <tr>
            <td valign="top"><font color="blue">&nbsp; Fonction :</font></td>
            <td><input type="text" size="24" name="frmfonction"><font color="blue"> *</font></td>
          </tr>
          
          <tr>
            <td valign="top"><font color="blue">&nbsp; Email:</font></td>
            <td><input  type="text" size="24" name="frmemail"><font color="blue"> *</font></td>
          </tr>
          
          <tr>
            <td valign="top"><font color="blue">&nbsp; T&eacute;l&eacute;phone:</font></td>
            <td><input type="text" size="24" name="frmtel"><font color="blue">&nbsp;*</font></td>
          </tr>
          
          <tr>
            <td valign="top"><font color="blue">&nbsp; Fax:</font></td>
            <td><input  type="text" size="24" name="frmfax"></td>
          </tr>
          
          <tr>
            <td valign="top"><font color="blue">&nbsp; Adresse:</font></td>
            <td><font color="#000000"><textarea rows="2" name="frmadresse" cols="27"></textarea></font><font color="blue">&nbsp;</font></td>
          </tr>
          
          <tr>
            <td valign="top"><font color="blue">&nbsp; Pays:</font></td>
            <td>
           <select style="WIDTH: 150px; HEIGHT: 23px" size="1" name="frmcountry">
                    <option value="-1">-- Pays --</option>
                    <option>Afghanistan</option>
                    <option>Afrique du Sud</option>
                    <option>Albanie</option>
                    <option>Alg&eacute;rie</option>
                    <option>Allemagne</option>
                    <option>Andorre</option>
                    <option>Angola</option>
                    <option>Arabie Saoudite</option>
                    <option>Argentine</option>
                    <option>Arm&eacute;nie</option>
                    <option>Australie</option>
                    <option>Autriche</option>
                    <option>Azerba�djan</option>
                    <option>Bahamas</option>
                    <option>Bahrain</option>
                    <option>Bangladesh</option>
                    <option>Belarus</option>
                    <option>Belgique</option>
                    <option>Benin</option>
                    <option>Bolivie</option>
                    <option>Bosnie Herz&eacute;govine</option>
                    <option>Botswana</option>
                    <option>Br&eacute;sil</option>
                    <option>Brunei</option>
                    <option>Bulgarie</option>
                    <option>Burkina Faso</option>
                    <option>Burundi</option>
                    <option>Cambodge</option>
                    <option>Cameroun</option>
                    <option>Canada</option>
                    <option>Chili</option>
                    <option>Chine</option>
                    <option>Chypre</option>
                    <option>Colombie</option>
                    <option>Comores</option>
                    <option>Congo</option>
                    <option>Cor&eacute;e, DPR</option>
                    <option>Costa Rica</option>
                    <option>C�te D'Ivoire</option>
                    <option>Croatie</option>
                    <option>Cuba</option>
                    <option>Danemark</option>
                    <option>Djibouti</option>
                    <option>Egypte</option>
                    <option>Emirats Arabes Unis</option>
                    <option>Equateur</option>
                    <option>Eritrea</option>
                    <option>Espagne</option>
                    <option>Estonie</option>
                    <option>Ethiopie</option>
                    <option>Fiji</option>
                    <option>Finlande</option>
                    <option>France</option>
                    <option>Gabon</option>
                    <option>Gambie</option>
                    <option>G&eacute;orgie</option>
                    <option>Ghana</option>
                    <option>Gr&eacute;ce</option>
                    <option>Guatemala</option>
                    <option>Guin&eacute;e</option>
                    <option>Guin&eacute;e &eacute;quatoriale</option>
                    <option>Guin&eacute;e-Bissau</option>
                    <option>Haiti</option>
                    <option>Hollande</option>
                    <option>Honduras</option>
                    <option>Hongrie</option>
                    <option>Ile Maurice</option>
                    <option>Iles Cayman</option>
                    <option>Inde</option>
                    <option>Indon&eacute;sie</option>
                    <option>Irak</option>
                    <option>Iran</option>
                    <option>Irlande</option>
                    <option>Islande</option>
                    <option>Italie</option>
                    <option>Jama�que</option>
                    <option>Japon</option>
                    <option>Jordanie</option>
                    <option>Kazakhstan</option>
                    <option>Kenya</option>
                    <option>Kow&eacute;it</option>
                    <option>Liban</option>
                    <option>Liberia</option>
                    <option>Libye</option>
                    <option>Liechtenstein</option>
                    <option>Lithuanie</option>
                    <option>Luxembourg</option>
                    <option>Mac&eacute;doine</option>
                    <option>Madagascar</option>
                    <option>Malaisie</option>
                    <option>Malawi</option>
                    <option>Maldives</option>
                    <option>Mali</option>
                    <option>Malte</option>
                    <option>Maroc</option>
                    <option>Mauritanie</option>
                    <option>Mexique</option>
                    <option>Moldavie</option>
                    <option>Monaco</option>
                    <option>Mongolie</option>
                    <option>Mozambique</option>
                    <option>Namibie</option>
                    <option>Nepal</option>
                    <option>Nicaragua</option>
                    <option>Niger</option>
                    <option>Nigeria</option>
                    <option>Norv&eacute;ge</option>
                    <option>Nouvelle Zealand</option>
                    <option>Oman</option>
                    <option>Ouganda</option>
                    <option>Pakistan</option>
                    <option>Panama</option>
                    <option>Papua Nouvelle Guin&eacute;e</option>
                    <option>Paraguay</option>
                    <option>P&eacute;rou</option>
                    <option>Philippines</option>
                    <option>Pologne</option>
                    <option>Portugal</option>
                    <option>Puerto Rico</option>
                    <option>Qatar</option>
                    <option>R&eacute;publique centrafricaine</option>
                    <option>R&eacute;publique de Cor&eacute;e</option>
                    <option>R&eacute;publique Dominicaine</option>
                    <option>R&eacute;publique Tch&eacute;que</option>
                    <option>Romanie</option>
                    <option>Royaume Uni</option>
                    <option>Russie</option>
                    <option>Rwanda</option>
                    <option>Salvador</option>
                    <option>Samoa</option>
                    <option>San Marin</option>
                    <option>Sao Tome Principe</option>
                    <option>S&eacute;n&eacute;gal</option>
                    <option>Seychelles</option>
                    <option>Sierra Leone</option>
                    <option>Singapour</option>
                    <option>Slovaquie</option>
                    <option>Slov�nie</option>
                    <option>Somali&eacute;</option>
                    <option>Soudan</option>
                    <option>Sri Lanka</option>
                    <option>Su&eacute;de</option>
                    <option>Suisse</option>
                    <option>Syrie</option>
                    <option>Tadjikistan</option>
                    <option>Taiwan</option>
                    <option>Tanzanie</option>
                    <option>Tchad</option>
                    <option>Thailande</option>
                    <option>Togo</option>
                    <option>Tunisie</option>
                    <option>Turkmenistan</option>
                    <option>Turquie</option>
                    <option>Ukraine</option>
                    <option>Uruguay</option>
                    <option>USA</option>
                    <option>Uzbekistan</option>
                    <option>Venezuela</option>
                    <option>Vietnam</option>
                    <option>Yemen</option>
                    <option>Yugoslavie</option>
                    <option>Zambie</option>
                    <option>Zimbabwe</option>
        </select><font color="blue">&nbsp;*</font>
            </td>
          </tr>
          
          <tr>
            <td valign="top"><font color="blue">&nbsp;Sujet du contact:</font></td>
            <td><input  type="text" size="24" name="frmsubject">&nbsp;<font color="blue">*</font></font></td>
          </tr>
          
          <tr>
            <td valign="top"><font color="blue">&nbsp; Message / Requ�te:</font></td>
            <td><font color="#000000"><textarea rows="7" name="frmmessage" cols="27"></textarea>&nbsp;<font color="blue">*</font></font></td>
          </tr>
          
          <tr>
            <td valign="top"><font color="blue">&nbsp;</font></td>
            <td>
            
            <p>
        <input type="submit" value="Envoyez" name="send" style="background-color: blue ; color:white ; border: black 5px outset ">&nbsp;&nbsp;
       
            </td>
          </tr>
          <tr>
            <td colspan="2">
 </td>
          </tr>
        </table>
        <p>
        &nbsp;&nbsp; </p>
      </form>
    </td>
  </tr>
</table>

  


<?php 



if (isset($_POST["send"]))
{

// collect data
$nom     =$_POST["frmnom"];  
$company =$_POST["frmcompany"];  
$email   =$_POST["frmemail"];  
$tel     =$_POST["frmtel"];  
$fax     =$_POST["frmfax"];  
$adresse =$_POST["frmadresse"];  
$subject =$_POST["frmsubject"];  
$message =$_POST["frmmessage"];  

$country =$_POST["frmcountry"];  
$fonction=$_POST["frmfonction"];  

$thedate =time();  

///*************SQL***********************************

 // $sql="select * from contactlist where id=0";
 
  $sql = "INSERT INTO contactlist (nom,company,email,tel,fax,adresse,subject,message,country,fonction,thedate)
                           VALUES ('".$nom."','".$company."','".$email."','".$tel."','".$fax."','".$adresse."','".$subject.
						            "','".$message."','".$country."','".$fonction."', NOW() )";
  $rs=mysqli_query($sql);
  
  $sqltime= "Select CURRENT_TIMESTAMP();";
  $rstime=mysqli_query($sqltime);
  $datatime= mysqli_fetch_array($rstime);
  $thedate= $datatime[0];
   echo $thedate;

///********************Email************************************************************************************//
    $sender = $email ;
	$receiver = "artcom@artcom.com.tn";
	
	$client_ip = $_SERVER['REMOTE_ADDR'];//adresse ip de votre Client 
	
	$email_body = "nom: ".$nom."\n company: ".$company."\n email: ".$email."\n tel: ".$tel."\n fax: ".$fax."\n 
	               adresse: ".$adresse."\n subject: ".$subject."\n
				   message: ".$message."\n\n country: ".$country."\n fonction: ".$fonction."\n  Envoy� le: ".$thedate; //corp de email
				   
	$email_body_auto_reply = "Bienvenue ".$nom.", \nThis is the auto reply message. \n
	votre demande d'information est bien re�u \n
	Merci.\n
	 \n\nAdmin - http://www.artcom.com.tn/";  // email accuse de recpetion pour le client 
	
	$extra = "From: ".$sender."\r\n" . "Reply-To: ".$sender."\r\n" . "X-Mailer: PHP/" . phpversion();
	
	$extra_auto_reply = "From: ".$receiver."\r\n" . "Reply-To: ".$receiver."\r\n" . "X-Mailer: PHP/" . phpversion();
	$con_sujet ="contact site :".$subject;
	$autoreply = "Auto Reply - Re: ".$subject;
	
	mail( $sender, $autoreply, $email_body_auto_reply, $extra_auto_reply );	
	if (mail( $receiver, $con_sujet, $email_body, $extra ))
	{
	 echo "<br><Font color=#000000 size=2> <b>Votre message a �t� envoy� avec succ�s <br> Merci. </b></font><br><br>";
	}
	else
	{echo "<br><Font color=#000000 size=2> <b>Votre message n'a pas �t� envoy� Veuillez re�ssay� <br> Merci. </b></font><br><br>" ;
	}
///****************************************************************************************************************//

  
  $rs=NULL;
}
 
?>




</td>
	</tr>
</table>

		</td>
	</tr>
</table>
<?php
include("common/footer.php");
?>
