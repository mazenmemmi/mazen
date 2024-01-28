<? // asp2php (vbscript) converted on Thu Dec 27 16:08:43 2012
 ?>
<!--- 
	Application: DREAM EDIT 1.0
	Name: instable.htm
	Function: Dialog for insering table
	Authors: SGHAIER MAHMOUD
	Company: ICARE
 --->
<HTML>
<HEAD>

<TITLE>Image</TITLE>

<STYLE TYPE="text/css">
 BODY   {margin-left:10; font-family: Tahoma; font-size:11; background:menu}
 TD     {font-family : Tahoma; font-size:11; }
 INPUT  {font-family : Tahoma; font-size:11; border: 1px inset}
 INPUT.rd  {background-color :menu ; font-family : Tahoma; font-size:11 ; border : 0}
 SELECT {font-family : Tahoma; font-size:11; border: 1px inset}
 BUTTON {width:5em ;font-family : Tahoma; font-size:11;}
</STYLE>
<SCRIPT LANGUAGE=JavaScript FOR=window EVENT=onload>
 // collect image inormation and update window
 // in  next version
 
 // get baseurl value
    baseurl.value = window.dialogArguments["BASEURL"];

 </SCRIPT>
 
<SCRIPT LANGUAGE=JavaScript>

function IsDigit()
{
  return ((event.keyCode >= 48) && (event.keyCode <= 57))
}


function updatecolor(mycolorfield)
{
  var myarr = showModalDialog( "selcolor.htm","","dialogWidth: 340px ; dialogHeight: 330px; status:no" );
  if (myarr != null) 
  {
    if (myarr=='Auto') myarr='';
    mycolorfield.value = myarr;
  }
}

</SCRIPT>

<SCRIPT LANGUAGE=JavaScript FOR=Ok EVENT=onclick>
  // collect table info to return value
  var arr = new Array();
  arr["BORDER"]=ImageBorder.value;
  if (ImageSrc.value !='')
  arr["SRC"]=ImageSrc.value;
  else
  var arr = null;
  

 // end update  
 // return values
  window.returnValue = arr;
  window.close();
  
</SCRIPT>

</HEAD>

<BODY>
<div style="position: absolute ; top: 0 ; right : 0;" >
<img border="0" src="icons/editorlogo_small.gif">
</div>
<fieldset ><legend> <b> Insérer une image</b> </legend>
 <DIV Align=center style ="MARGIN: 3px" > 
  <table width="555" border="0" cellspacing="1" cellpadding="0">
    <tr> 
      <td  width="305">
      <fieldset ><legend> <b>Navigation</b> </legend>
          <DIV Align=center style ="MARGIN: 5px" > 
          <iframe id=browserFrame width=305 height = "250" src="browser.asp?imagevpath=<? echo ${"imagevpath"};?>" SCROLLING=yes></IFRAME>
          </div>
      </fieldset>
      </td>

      <td  width="250">
      <fieldset ><legend> <b>Prévisualisation</b> </legend>
          <DIV Align=center style ="MARGIN: 5px" > 
          <iframe id=PreviewFrame width=250 height = "250" src="about:blank"></IFRAME>
          </div>
      </fieldset>
      </td>
     </tr>
    <tr>
      <td width=575 colspan="2">
        <fieldset ><legend> <b>Propriétés de l'image</b> </legend>
          <DIV Align=center style ="MARGIN: 5px" > 
          <table border="0" width="100%">
            <tr>
              <td>
                <div align="justify">
                  <table border="0" width="100%" cellspacing="0">
                    <tr>
                      <td width="22%"><b>Source de l'image&nbsp;</b></td>
                      <td width="44%"><INPUT type="text" name=ImageSrc size=32></td>
                      <td width="34%" align=right><BUTTON ID=UPLOAD style ="width :100" TYPE=button><b>  Télécharger  </b> </BUTTON></td>
                      <input type="hidden" name="baseurl" value="">
                    </tr>
                  </table>
                </div>
               <hr align="center">
              </td>
            </tr>
            <tr>
              <td>
        <div align="justify">
          <table border="0" width="100%" cellspacing="0">
            <tr>
              <td>Largeur :</td>
              <td><INPUT type="text" name=ImageWidth size=8 ONKEYPRESS="event.returnValue=IsDigit();"></td>
              <td>Espacement Horizontale :</td>
              <td><INPUT type="text" name=ImageHspace size=8 ONKEYPRESS="event.returnValue=IsDigit();"></td>
              <td>Épaisseur de bordure :</td>
              <td><INPUT type="text" name=ImageBorder size=8 value="0" ONKEYPRESS="event.returnValue=IsDigit();"></td>
            </tr>
            <tr>
              <td>Hauteur :</td>
              <td><INPUT type="text" name=ImageHeight size=8 ONKEYPRESS="event.returnValue=IsDigit();"></td>
              <td>Espacement Vertical :</td>
              <td><INPUT type="text" name=ImageVspace size=8 ONKEYPRESS="event.returnValue=IsDigit();"></td>
              <td>Alignement :</td>
              <td>
              <select size="1" name="ImageAlign">
              <option selected>Par défaut</option>
          		<option value="left">Gauche</option>
          		<option value="right">Droite</option>
          		<option value="textTop">Haut du texte</option>
          		<option value="absMiddle">Milieu absolu</option>
          		<option value="baseline">Ligne de base</option>
          		<option value="textTop">Bas absolu</option>
          		<option value="absMiddle">Bas</option>
          		<option value="baseline">Milieu</option>
          		<option value="top">Haut</option>
         		</select>
              </td>
            </tr>
          </table>
        </div>
              </td>
            </tr>
            <tr>
              <td> <hr align="center"></td>
            </tr>
            <tr>
              <td>
        <div align="justify">
          <table border="0" width="100%" cellspacing="0">
            <tr>
              <td>Texte de légende :</td>
              <td><INPUT type="text" name=ImageAlt size=16></td>
              <td>Style :</td>
              <td><input name="ImageStyle" size="16" ></td>
              <td>
                Classe :</td>
              <td><input name="ImageClass" size="16" >
              </td>
            </tr>
          </table>
        </div>
              </td>
            </tr>
          </table>
       </div>
      </fieldset>
    </td>
    </tr>
  </table>
  <div>
  </div>
  </div>
</fieldset>
<div align=right>
<br>
<BUTTON ID=Ok TYPE=submit>OK </BUTTON>&nbsp;&nbsp; <BUTTON ONCLICK="window.close();">Annuler</BUTTON>
</div>
</BODY>
</HTML>
