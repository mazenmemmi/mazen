<?php 
function DreamEdit()
{
  extract($GLOBALS);
?>
<SCRIPT language="JavaScript" >
function errortrap(msg,url,line){
    alert('DREAMEDIT: '+msg);
    return true;
}
onerror=errortrap;
</script>

<style type="text/css">
SELECT.Options 
        { FONT-FAMILY:  Tahoma, Arial, Helvetica; 
          FONT-SIZE: 11px; 
          BACKGROUND-COLOR: buttonface;
          }     

.MainEditor   
        { 
          BORDER : outset 1px; 
          BACKGROUND-COLOR : buttonface; 
        }

.BtNormal 
        { 
          BACKGROUND-COLOR: buttonface; 
          BORDER : buttonface solid 1px; 
        }
.Message
        { 
	PADDING : 2px;
	BORDER:  inset 1px ; 
        FONT-FAMILY:  Tahoma, Arial, Helvetica; 
        FONT-SIZE: 11px; 
        }        
    
</style>
<?php 
// Pass asp vars to js
  echo "<SCRIPT language=javascript>";
  echo "var BaseURL='".$DeBaseURL."' ;"."\r\n";
  echo "var WebVirtualPath='".$DeWebVirtualPath."' ;"."\r\n";
  echo "var ImageVirtualPath='".$DeImageVirtualPath."' ;"."\r\n";
  echo "var defaultDir='".$DeDefaultDir."' ;"."\r\n";
  echo "var DefaultFont='".$DeDefaultFont."' ;"."\r\n";
  echo "var DefaultFontSize='".$DeDefaultFontSize."' ;"."\r\n";
  echo "</SCRIPT>";
?>
<SCRIPT language="javascript1.2" src="dhtmled.js"></script>
<SCRIPT language="JavaScript1.2" src="dreamedit.js"></script>
<SCRIPT LANGUAGE="JavaScript1.2" FOR="window" EVENT="onload">
<!-- onLoad body event -->
initialize(document.DHTMLEdit)
</script>
      <table class="MainEditor" border="0" cellpadding="0" cellspacing="0" width="780" onselectstart="window.event.returnValue=false;" ondragstart="window.event.returnValue=false;">
<tr>
    <td>
         <table border="0" cellpadding="0" cellspacing="1">
            <tr>
               <td width="9"><img border="0" src="dreamedit/icons/toolbar.gif" width="9" height="23"></td>
               <td width="23">
                  <div class="BtNormal" onclick="return Btclick (this,'FILE_NEW',document.DHTMLEdit)" onmousedown="BtDown(this);" onmouseout="BtOut(this);" onmouseover="BtOver(this);" onmouseup="BtUp(this);">
                    <img  class="BtNormal" alt="Nouveau document HTML" src="dreamedit/icons/new.gif" width="22" height="23">
                  </div> </td>
                <td width="23">
                  <div id="DECMD_FINDTEXT" class="BtNormal" onclick="return Btclick (this,null,document.DHTMLEdit)" onmousedown="BtDown(this);" onmouseout="BtOut(this);" onmouseover="BtOver(this);" onmouseup="BtUp(this);">
                    <img id="icons" alt="Rechercher" src="dreamedit/icons/find.gif" width="23" height="22">
                  </div></td>
                <td width="6"><img border="0" src="dreamedit/icons/space.gif" width="6" height="24"></td>
                <td width="23">
                  <div id="DECMD_CUT" class="BtNormal" onclick="return Btclick (this,null,document.DHTMLEdit)" onmousedown="BtDown(this);" onmouseout="BtOut(this);" onmouseover="BtOver(this);" onmouseup="BtUp(this);">
                    <img id="icons" alt="Couper  Ctrl+X" src="dreamedit/icons/cut.gif" width="23" height="22">
                  </div></td>
                <td width="23">
                  <div id="DECMD_COPY" class="BtNormal" onclick="return Btclick (this,null,document.DHTMLEdit)" onmousedown="BtDown(this);" onmouseout="BtOut(this);" onmouseover="BtOver(this);" onmouseup="BtUp(this);">
                    <img id="icons" alt="Copier  Ctrl+C" src="dreamedit/icons/copy.gif" width="23" height="22">
                  </div></td>
                <td width="23">
                  <div id="DECMD_PASTE" class="BtNormal" onclick="return Btclick (this,null,document.DHTMLEdit)" onmousedown="BtDown(this);" onmouseout="BtOut(this);" onmouseover="BtOver(this);" onmouseup="BtUp(this);">
                    <img id="icons" alt="Coller  Ctrl+V" src="dreamedit/icons/paste.gif" width="23" height="22">
                  </div></td>
                <td width="6"><img border="0" src="dreamedit/icons/space.gif" width="6" height="24"></td>
                <td width="23">
                  <div id="DECMD_UNDO" class="BtNormal" onclick="return Btclick (this,null,document.DHTMLEdit)" onmousedown="BtDown(this);" onmouseout="BtOut(this);" onmouseover="BtOver(this);" onmouseup="BtUp(this);">
                    <img id="icons" alt="Annuler  Ctrl+Z" src="dreamedit/icons/undo.gif" width="23" height="22">
                  </div></td>
                <td width="23">
                  <div id="DECMD_REDO" class="BtNormal" onclick="return Btclick (this,null,document.DHTMLEdit)" onmousedown="BtDown(this);" onmouseout="BtOut(this);" onmouseover="BtOver(this);" onmouseup="BtUp(this);">
                    <img id="icons" alt="Rétablir  Ctrl+Y" src="dreamedit/icons/redo.gif" width="23" height="22">
                  </div></td>
                <td width="6"><img border="0" src="dreamedit/icons/space.gif" width="6" height="24"></td>
                <td width="20">
                <div id="SHOWDETAILS" class="BtNormal" onclick="return Btclick (this,'SHOW_DETAILS',document.DHTMLEdit)" onmousedown="BtDown(this);" onmouseout="BtOut(this);" onmouseover="BtOver(this);" onmouseup="BtUp(this);">
                    <img alt="Afficher les détails"  src="dreamedit/icons/details.gif" width="20" height="20">
                  </div></td>
                <td width="20">
                  <div id="SHOWBORDERS" class="BtNormal" onclick="return Btclick (this,'SHOW_BORDERS',document.DHTMLEdit)" onmousedown="BtDown(this);" onmouseout="BtOut(this);" onmouseover="BtOver(this);" onmouseup="BtUp(this);">
                    <img  alt="Afficher les bordures" src="dreamedit/icons/borders.gif" width="20" height="20">
                </div></td>
                <td width="6"><img border="0" src="dreamedit/icons/space.gif" width="6" height="24"></td>
                <td width="23">
                  <div id="DECMD_INSERTTABLE" class="BtNormal" onclick="return Btclick (this,'INSERT_TABLE',document.DHTMLEdit)" onmousedown="BtDown(this);" onmouseout="BtOut(this);" onmouseover="BtOver(this);" onmouseup="BtUp(this);">
                  <img id="icons" alt="Insérer un tableau" src="dreamedit/icons/instable.gif" width="23" height="22">
                  </div></td>   
                <td width="23">
                  <div id="DECMD_HYPERLINK" class="BtNormal" onclick="return Btclick (this,'INSERT_ANCHOR',document.DHTMLEdit)" onmousedown="BtDown(this);" onmouseout="BtOut(this);" onmouseover="BtOver(this);" onmouseup="BtUp(this);">
                    <img id="icons" alt="Insérer un signet" src="dreamedit/icons/anchor.gif" width="22" height="23">
                  </div></td>
                <td width="23">
                  <div id="DECMD_HYPERLINK" class="BtNormal" onclick="return Btclick (this,'INSERT_LINK',document.DHTMLEdit)" onmousedown="BtDown(this);" onmouseout="BtOut(this);" onmouseover="BtOver(this);" onmouseup="BtUp(this);">
                    <img id="icons" alt="Insérer un lien hypertexte" src="dreamedit/icons/link.gif" width="22" height="23">
                  </div></td>
                  <td width="23">
                  <div id="DECMD_UNLINK" class="BtNormal" onclick="return Btclick (this,null,document.DHTMLEdit)" onmousedown="BtDown(this);" onmouseout="BtOut(this);" onmouseover="BtOver(this);" onmouseup="BtUp(this);">
                    <img id="icons" alt="Supprimer un lien hypertexte" src="dreamedit/icons/unlink.gif" width="22" height="23">
                  </div></td>
                <td width="23">
                  <div id="DECMD_IMAGE" class="BtNormal" onclick="return Btclick (this,'INSERT_IMAGE',document.DHTMLEdit)" onmousedown="BtDown(this);" onmouseout="BtOut(this);" onmouseover="BtOver(this);" onmouseup="BtUp(this);">
                    <img id="icons" alt="Insérer une image" src="dreamedit/icons/image.gif" width="23" height="22">
                  </div></td>
<td width="20">
<div id="DECMD_IMAGE" class="BtNormal" onclick="return Btclick (this,'INSERT_HR',document.DHTMLEdit)" onmousedown="BtDown(this);" onmouseout="BtOut(this);" onmouseover="BtOver(this);" onmouseup="BtUp(this);">
                    <img id="icons" alt="Insérer une ligne horizontale" src="dreamedit/icons/hr.gif" width="20" height="20"> </div> </td>
                  <td width="23">
                  <div id="DECMD_IMAGE" class="BtNormal" onclick="return Btclick (this,'INSERT_SPCHAR',document.DHTMLEdit)" onmousedown="BtDown(this);" onmouseout="BtOut(this);" onmouseover="BtOver(this);" onmouseup="BtUp(this);">
                    <img id="icons" alt="Insérer un caractère spécial" src="dreamedit/icons/specialchar.gif" width="22" height="23">
                  </div></td>  
                <td width="6"><img border="0" src="dreamedit/icons/space.gif" width="6" height="24"></td>
                <td width="24">
                <div id="HELP" class="BtNormal" onclick="return Btclick (this,'SHOW_HELP',document.DHTMLEdit)" onmousedown="BtDown(this);" onmouseout="BtOut(this);" onmouseover="BtOver(this);" onmouseup="BtUp(this);">
                    <img alt="Aide" src="dreamedit/icons/help.gif" width="20" height="20">
                </div></td>
              </tr>
            </table>
          </td>
        </tr>
        <tr> <td bgcolor="buttonshadow"><img border="0" src="dreamedit/icons/spacer.gif"  height="1"></td></tr>
        <tr> <td bgcolor="buttonhighlight"><img border="0" src="dreamedit/icons/spacer.gif"  height="1"></td> </tr>
        <tr>
          <td>
            <table border="0" cellpadding="0" cellspacing="1">
              <tr>
              <td width="9"> <img border="0" src="dreamedit/icons/toolbar.gif" width="9" height="23" ></td> 
              <td width="20">
           <div id="DECMD_FONT" class="BtNormal" onclick="return Btclick (this,null,document.DHTMLEdit)" onmousedown="BtDown(this);" onmouseout="BtOut(this);" onmouseover="BtOver(this);" onmouseup="BtUp(this);">
                <img id="icons" alt="Propriétés police" src="dreamedit/icons/font.gif" width="20" height="20">
                </div></td>
                <td width="6"><img border="0" src="dreamedit/icons/space.gif" width="6" height="24"></td>
                <td width="25">
                  <select id="ParagraphStyle" onchange="ParagraphStyle_onchange(document.DHTMLEdit , this[this.selectedIndex].value)" size="1" class="Options">
                  </select></td>                   
                <td width="25">
                  <select id="FontName" onchange="FontName_onchange(document.DHTMLEdit ,this[this.selectedIndex].value);" size="1" class="Options">
                    <option selected value="">(Police par défaut)</option>
                    <option value="Arial">Arial</option>
                    <option value="Arial Black">Arial Black</option>
                    <option value="Arial Narrow">Arial Narrow</option>
                    <option value="Comic Sans MS">Comic Sans MS</option>
                    <option value="Courier New">Courier New</option>
		    <option value="Georgia">Georgia</option>
                    <option value="MS Sans Serif">MS Sans Serif</option>
                    <option value="System">System</option>
                    <option value="Tahoma">Tahoma</option>
                    <option value="Times New Roman">Times New Roman</option>
                    <option value="Trebuchet MS">Trebuchet MS</option>   
                    <option value="Verdana">Verdana</option>
                    <option value="Wingdings">Wingdings</option>
                   </select></td>
                <td width="25">
                  <select id="FontSize" onchange="FontSize_onchange(document.DHTMLEdit,this[this.selectedIndex].value);" size="1" class="Options">
                    <option selected value="" >Normal</option>
                    <option value="1">1 (8 pts)</option>
                    <option value="2">2 (10 pts)</option>
                    <option value="3">3 (12 pts)</option>
                    <option value="4">4 (14 pts)</option>
                    <option value="5">5 (18 pts)</option>
                    <option value="6">6 (24 pts)</option>
                    <option value="7">7 (36 pts)</option>
                  </select></td>
                <td width="6"><img border="0" src="dreamedit/icons/space.gif" width="6" height="24"></td>
                <td width="23">
                <div id="DECMD_SETFORECOLOR" class="BtNormal" onclick="return Btclick (this,'SET_FORECOLOR',document.DHTMLEdit)" onmousedown="BtDown(this);" onmouseout="BtOut(this);" onmouseover="BtOver(this);" onmouseup="BtUp(this);">
                    <img id="icons" alt="Couleur du texte" src="dreamedit/icons/fgcolor.gif" width="23" height="22">
                </div></td>         
                <td width="23">
                <div id="DECMD_SETBACKCOLOR" class="BtNormal" onclick="return Btclick (this,'SET_BACKCOLOR',document.DHTMLEdit)" onmousedown="BtDown(this);" onmouseout="BtOut(this);" onmouseover="BtOver(this);" onmouseup="BtUp(this);">
                    <img id="icons" alt="Couleur d'arrière-plan" src="dreamedit/icons/bgcolor.gif" width="23" height="22">
                </div></td>           
                <td width="6"><img border="0" src="dreamedit/icons/space.gif" width="6" height="24"></td>
                <td width="23">
                  <div id="DECMD_BOLD" class="BtNormal" onclick="return Btclick (this,null,document.DHTMLEdit)" onmousedown="BtDown(this);" onmouseout="BtOut(this);" onmouseover="BtOver(this);" onmouseup="BtUp(this);">
                  <img id="icons" alt="Gras" src="dreamedit/icons/gras.gif" width="23" height="22">
                  </div></td>
                <td width="23">
                  <div id="DECMD_ITALIC" class="BtNormal" onclick="return Btclick (this,null,document.DHTMLEdit)" onmousedown="BtDown(this);" onmouseout="BtOut(this);" onmouseover="BtOver(this);" onmouseup="BtUp(this);">
                   <img id="icons" alt="Italique" src="dreamedit/icons/italic.gif" width="23" height="22">
                  </div></td>
                <td width="23">
                  <div id="DECMD_UNDERLINE" class="BtNormal" onclick="return Btclick (this,null,document.DHTMLEdit)" onmousedown="BtDown(this);" onmouseout="BtOut(this);" onmouseover="BtOver(this);" onmouseup="BtUp(this);">
                   <img id="icons" alt="Souligné" src="dreamedit/icons/souligne.gif" width="23" height="22">
                  </div></td>
              </tr>
            </table>
          </td>
        </tr>
        <tr> <td bgcolor="buttonshadow"><img border="0" src="dreamedit/icons/spacer.gif" width="1" height="1"></td></tr>
        <tr> <td bgcolor="buttonhighlight"><img border="0" src="dreamedit/icons/spacer.gif" width="1" height="1"></td> </tr>
        <tr>
          <td>
            <table border="0" cellpadding="0" cellspacing="1">
              <tr>
               <td width="9"> <img border="0" src="dreamedit/icons/toolbar.gif" width="9" height="23" ></td>
                <td width="23">
                  <div id="DECMD_INSERTROW" class="BtNormal" onclick="return Btclick (this,null,document.DHTMLEdit)" onmousedown="BtDown(this);" onmouseout="BtOut(this);" onmouseover="BtOver(this);" onmouseup="BtUp(this);">
                    <img id="icons" alt="Insérer une ligne" src="dreamedit/icons/insrow.gif" width="23" height="22">
                  </div></td>
                <td width="23">
<div id="DECMD_DELETEROWS" class="BtNormal" onclick="return Btclick (this,null,document.DHTMLEdit)" onmousedown="BtDown(this);" onmouseout="BtOut(this);" onmouseover="BtOver(this);" onmouseup="BtUp(this);">
                    <img id="icons" alt="Supprimer les lignes" src="dreamedit/icons/delrow.gif" width="23" height="22">
                  </div></td>
                <td width="23">
                  <div id="DECMD_INSERTCOL" class="BtNormal" onclick="return Btclick (this,null,document.DHTMLEdit)" onmousedown="BtDown(this);" onmouseout="BtOut(this);" onmouseover="BtOver(this);" onmouseup="BtUp(this);">
                    <img id="icons" alt="Insérer une colonne" src="dreamedit/icons/inscol.gif" width="23" height="22">
                  </div></td>
                <td width="23">
                  <div id="DECMD_DELETECOLS" class="BtNormal" onclick="return Btclick (this,null,document.DHTMLEdit)" onmousedown="BtDown(this);" onmouseout="BtOut(this);" onmouseover="BtOver(this);" onmouseup="BtUp(this);">
                    <img id="icons" alt="Supprimer les colonnes" src="dreamedit/icons/delcol.gif" width="23" height="22">
                  </div></td>
                  <td width="6"><img border="0" src="dreamedit/icons/space.gif" width="6" height="24"></td>
                <td width="23">
                  <div id="DECMD_INSERTCELL" class="BtNormal" onclick="return Btclick (this,null,document.DHTMLEdit)" onmousedown="BtDown(this);" onmouseout="BtOut(this);" onmouseover="BtOver(this);" onmouseup="BtUp(this);">
                    <img id="icons" alt="Insérer une cellule" src="dreamedit/icons/inscell.gif" width="23" height="22">
                  </div></td>
                <td width="23">
                  <div id="DECMD_DELETECELLS" class="BtNormal" onclick="return Btclick (this,null,document.DHTMLEdit)" onmousedown="BtDown(this);" onmouseout="BtOut(this);" onmouseover="BtOver(this);" onmouseup="BtUp(this);">
                    <img id="icons" alt="Supprimer les cellules" src="dreamedit/icons/delcell.gif" width="23" height="22">
                  </div></td>
                <td width="6"><img border="0" src="dreamedit/icons/space.gif" width="6" height="24"></td>
                <td width="23">
                  <div id="DECMD_MERGECELLS" class="BtNormal" onclick="return Btclick (this,null,document.DHTMLEdit)" onmousedown="BtDown(this);" onmouseout="BtOut(this);" onmouseover="BtOver(this);" onmouseup="BtUp(this);">
                    <img id="icons" alt="Fusionner les cellules" src="dreamedit/icons/mrgcell.gif" width="23" height="22">
                  </div></td>
                <td width="23">
                  <div id="DECMD_SPLITCELL" class="BtNormal" onclick="return Btclick (this,null,document.DHTMLEdit)" onmousedown="BtDown(this);" onmouseout="BtOut(this);" onmouseover="BtOver(this);" onmouseup="BtUp(this);">
                    <img id="icons" alt="Fractionner les cellules" src="dreamedit/icons/spltcell.gif" width="23" height="22">
                  </div></td>
                  <td width="6"><img border="0" src="dreamedit/icons/space.gif" width="6" height="24"></td>
                  <td width="23">
                  <div id="DECMD_INSERTROW" class="BtNormal" onclick="return Btclick (this,'EDIT_TABLE',document.DHTMLEdit)" onmousedown="BtDown(this);" onmouseout="BtOut(this);" onmouseover="BtOver(this);" onmouseup="BtUp(this);">
                    <img id="icons" alt="Propriétés du tableau" src="dreamedit/icons/edittable.gif" width="22" height="23">
                  </div></td>
                  <td width="23">
                  <div id="DECMD_INSERTROW" class="BtNormal" onclick="return Btclick (this,'EDIT_CELL',document.DHTMLEdit)" onmousedown="BtDown(this);" onmouseout="BtOut(this);" onmouseover="BtOver(this);" onmouseup="BtUp(this);">
                    <img id="icons" alt="Propriétés de la cellule" src="dreamedit/icons/editcell.gif" width="22" height="23">
                  </div></td>
                <!-- Space Tool BAR -->
                <td width="10"><img  src="dreamedit/icons/spacer.gif" width="10" height="20"></td>
                <td width="9"> <img border="0" src="dreamedit/icons/toolbar.gif" width="9" height="23"></td>
                <td width="23">
                  <div id="DECMD_JUSTIFYLEFT" class="BtNormal" onclick="return Btclick (this,null,document.DHTMLEdit)" onmousedown="BtDown(this);" onmouseout="BtOut(this);" onmouseover="BtOver(this);" onmouseup="BtUp(this);">
                    <img id="icons" alt="Aligner à gauche" src="dreamedit/icons/left.gif" width="23" height="22">
                  </div></td>
                <td width="23">
                  <div id="DECMD_JUSTIFYCENTER" class="BtNormal" onclick="return Btclick (this,null,document.DHTMLEdit)" onmousedown="BtDown(this);" onmouseout="BtOut(this);" onmouseover="BtOver(this);" onmouseup="BtUp(this);">
                    <img id="icons" alt="Centrer" src="dreamedit/icons/center.gif" width="23" height="22">
                  </div></td>
                <td width="23">
                  <div id="DECMD_JUSTIFYRIGHT" class="BtNormal" onclick="return Btclick (this,null,document.DHTMLEdit)" onmousedown="BtDown(this);" onmouseout="BtOut(this);" onmouseover="BtOver(this);" onmouseup="BtUp(this);">
                    <img id="icons" alt="Aligner à droite" src="dreamedit/icons/right.gif" width="23" height="22">
                  </div></td>
                <td width="6"><img border="0" src="dreamedit/icons/space.gif" width="6" height="24"></td>
                <td width="23">
                  <div id="DECMD_ORDERLIST" class="BtNormal" onclick="return Btclick (this,null,document.DHTMLEdit)" onmousedown="BtDown(this);" onmouseout="BtOut(this);" onmouseover="BtOver(this);" onmouseup="BtUp(this);">
                    <img id="icons" alt="Numérotation" src="dreamedit/icons/numlist.gif" width="23" height="22">
                  </div></td>
                <td width="23">
                  <div id="DECMD_UNORDERLIST" class="BtNormal" onclick="return Btclick (this,null,document.DHTMLEdit)" onmousedown="BtDown(this);" onmouseout="BtOut(this);" onmouseover="BtOver(this);" onmouseup="BtUp(this);">
                    <img id="icons" alt="Puces" src="dreamedit/icons/bullist.gif" width="23" height="22">
                  </div></td>
                <td width="23">
                  <div id="DECMD_OUTDENT" class="BtNormal" onclick="return Btclick (this,null,document.DHTMLEdit)" onmousedown="BtDown(this);" onmouseout="BtOut(this);" onmouseover="BtOver(this);" onmouseup="BtUp(this);">
                    <img id="icons" alt="Réduire le retrait" src="dreamedit/icons/deindent.gif" width="23" height="22">
                  </div></td>
                <td width="23">
                  <div id="DECMD_INDENT" class="BtNormal" onclick="return Btclick (this,null,document.DHTMLEdit)" onmousedown="BtDown(this);" onmouseout="BtOut(this);" onmouseover="BtOver(this);" onmouseup="BtUp(this);">
                    <img id="icons" alt="Augmenter le retrait" src="dreamedit/icons/inindent.gif" width="23" height="22">
                  </div></td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td>
            <object classid="clsid:2D360201-FFF5-11D1-8D03-00A0C959BC0A" id="DHTMLEdit"  viewastext="YES" width="780" height="300" >
              <param name="Scrollbars" value="1">
              <param name="ScrollbarAppearance" value="0">        
            </object>
          </td>
        </tr>
        <tr>
          <td>
            <table border="0" cellspacing="1" width="100%">
              <tr>
                <td width="55">
                 <div id="DESIGNMODE" class="BtNormal" onclick="SetHTMLMode(document.DHTMLEdit,false)" onmousedown="BtDown(this);" onmouseout="BtOut(this);" onmouseover="BtOver(this);" onmouseup="BtUp(this);">
                    <img  alt="Mode Design" src="dreamedit/icons/designmode.gif" width="55" height="16">
                 </div></td>
                <td width="5"><img border="0" src="dreamedit/icons/space.gif" height="16"></td>
                <td width="55">
                 <div id="HTMLMODE" class="BtNormal" onclick="SetHTMLMode(document.DHTMLEdit,true)" onmousedown="BtDown(this);" onmouseout="BtOut(this);" onmouseover="BtOver(this);" onmouseup="BtUp(this);">
                    <img  alt="Mode HTML" src="dreamedit/icons/htmlmode.gif" width="55" height="16">
                 </div></td>
                 <td width="5"><img border="0" src="dreamedit/icons/space.gif" height="16"></td>
                 <td id="MessageZone" class="Message" width="260" Height = 18 valign=middle NOWRAP>&nbsp;
                     </td>
                 <td  align="right">
                  <img border="0" src="dreamedit/icons/editorlogo.gif" alt="A propos de DREAM EDIT" onclick="SHOW_CREDIT(document.DHTMLEdit)" width="115" height="23" ></td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
<SCRIPT language="JavaScript1.2">initialize(document.DHTMLEdit);</SCRIPT>
<!-- Display Changed Event -->
<script LANGUAGE="javascript1.2" FOR="DHTMLEdit" EVENT="DisplayChanged">
 DHTMLEdit_DisplayChanged(document.DHTMLEdit);
</script>
<!-- Show ContextMenu Event -->
<script LANGUAGE="javascript1.2" FOR="DHTMLEdit" EVENT="ShowContextMenu">
 DHTMLEdit_ShowContextMenu(document.DHTMLEdit)
</script>
<!-- ContextMenu Action Event -->
<SCRIPT language="javascript1.2" FOR="DHTMLEdit" EVENT="ContextMenuAction(itemIndex)">
 DHTMLEdit_ContextMenuAction(itemIndex,document.DHTMLEdit);
</SCRIPT>
<!-- Document complete Event -->
<SCRIPT LANGUAGE=javascript FOR="DHTMLEdit" EVENT=DocumentComplete>
 DHTMLEdit_DocumentComplete(document.DHTMLEdit);
</SCRIPT>
<?php   
} ?>

