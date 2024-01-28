
	
<!--
// LICENSE INFORMATION
// DREAMEDIT HTML WYSIWYG Editor  v1.0
// COPYRIGHT 2002-2003 ICARE MULTIMEDIA
// Developper : SGHAIER Mahmoud 
//-->
// TODO : Multiple Editor Mode : to set this try to make EDITAPI Model
//        Object oriented method
//        DHTMLEDIT and DHTMLEditMirror must be binded (EditJs.htm idea)!
//        Background image mode 
//        Color palette and : input color from the html
//        Classify Color as default named and extra named in the default palette
//        Style Editor mode that support class
//        cell edit can use multiple cell and or colums and rows using the power full dom textrange,selection object
//        linkcms linkfile mode  into link
//        flash and embed support 
//        may enhance the link support on ActivEdit
//        multilanguage support (contextual menu multilanguage use ie5.5)
//        edit hr properties / edit image properties 
////////////////////////////////////
//     global var and arrays    //
////////////////////////////////////

var HTMLMode=false; // the default HTMLmode ( false ): design    HTMLmode ( true ): HTML  

// context menu arrays
var GeneralContextMenu = new Array();
var TableContextMenu = new Array();
var ContextMenu = new Array();
// Context menu separator
var MENU_SEPARATOR = ""; 
// Table params arrays
var mytableparams = new Array();
// convert pt size to html font size
var DefaultHtmlFontSize;
switch (DefaultFontSize)
{
	case "8pt" : DefaultHtmlFontSize = 1;
	case "10pt" : DefaultHtmlFontSize = 2;
	case "12pt" : DefaultHtmlFontSize = 3;
	case "14pt" : DefaultHtmlFontSize = 4;
	case "18pt" : DefaultHtmlFontSize = 5;
	case "24pt" : DefaultHtmlFontSize = 6;
	case "36pt" : DefaultHtmlFontSize = 7;
	default : DefaultHtmlFontSize = 2;
}


// define activeX table default params  
var tableparamobj=new ActiveXObject("DEInsertTableParam.DEInsertTableParam");

////////////////////////////
//initialization function //
////////////////////////////
function initialize(DHTMLED)
{
 // Create new document 
DHTMLED.NewDocument();
DHTMLED.ShowBorders = false;
DHTMLED.ShowDetails =false;
//DHTMLSafe.BaseURL= BaseURL;
DHTMLEditonLoad(DHTMLED);
}	

//////////////////////
// DHTMLEdit Onload///
//////////////////////

function DHTMLEditonLoad(DHTMLED)
{

// Build ParagraphStyle
if ( document.all.ParagraphStyle.options.length == 0) { // if ParagraphStyle is not defined : define it
var Sel = document.all.ParagraphStyle;
var MirrorContent;
var f=new ActiveXObject("DEGetBlockFmtNamesParam.DEGetBlockFmtNamesParam");
DHTMLED.ExecCommand(DECMD_GETBLOCKFMTNAMES,OLECMDEXECOPT_DODEFAULT,f);
		vbarr = new VBArray(f.Names);
		arr = vbarr.toArray();
		for (var i=0;i<arr.length;i++) 
		{
			sOption = document.createElement("OPTION");
			Sel.options.add(sOption);
			sOption.text=arr[i];
			sOption.value=arr[i];
                }
 }
// my table Default Parameters
  mytableparams["ROWS"]=3;
  mytableparams["COLS"]=3;
  mytableparams["ALIGN"]="";
  mytableparams["WIDTH"]=100 ; // if -1 the table has no width attribute
  mytableparams["WIDTHmode"]="%";
  mytableparams["BORDER"]=1;
  mytableparams["CELLPADDING"]=1;
  mytableparams["CELLSPACING"]=2;
  mytableparams["BORDERCOLOR"]="";
  mytableparams["BGCOLOR"]="";
  mytableparams["STYLE"]="";
  mytableparams["CLASS"]="";

// Initialize the context menu arrays.

  GeneralContextMenu[0] = new ContextMenuItem("Couper", DECMD_CUT);
  GeneralContextMenu[1] = new ContextMenuItem("Copier", DECMD_COPY);
  GeneralContextMenu[2] = new ContextMenuItem("Coller", DECMD_PASTE);
  GeneralContextMenu[3] = new ContextMenuItem("Sélectionner tout", DECMD_SELECTALL);
  TableContextMenu[0] = new ContextMenuItem(MENU_SEPARATOR, 0);
  TableContextMenu[1] = new ContextMenuItem("Propriétés du tableau", 'EDIT_TABLE');
  TableContextMenu[2] = new ContextMenuItem("Propriétés de la cellule", 'EDIT_CELL'); 
  TableContextMenu[3] = new ContextMenuItem(MENU_SEPARATOR, 0);
  TableContextMenu[4] = new ContextMenuItem("Insérer une ligne", DECMD_INSERTROW);
  TableContextMenu[5] = new ContextMenuItem("Supprimer les lignes", DECMD_DELETEROWS);
  TableContextMenu[6] = new ContextMenuItem(MENU_SEPARATOR, 0);
  TableContextMenu[7] = new ContextMenuItem("Insérer une colonne", DECMD_INSERTCOL);
  TableContextMenu[8] = new ContextMenuItem("Supprimer les colonnes", DECMD_DELETECOLS);
  TableContextMenu[9] = new ContextMenuItem(MENU_SEPARATOR, 0);
  TableContextMenu[10] = new ContextMenuItem("Insérer une cellule", DECMD_INSERTCELL);
  TableContextMenu[11] = new ContextMenuItem("Supprimer les cellules", DECMD_DELETECELLS);
  TableContextMenu[12] = new ContextMenuItem(MENU_SEPARATOR, 0);
  TableContextMenu[13] = new ContextMenuItem("Fusionner les cellules", DECMD_MERGECELLS);
  TableContextMenu[14] = new ContextMenuItem("Fractionner les cellules", DECMD_SPLITCELL);
 	
 // get the text area content
  MirrorContent=document.all.DHTMLEditMirror;
        // apply the default style and params to the document
	if(MirrorContent.value.length)
        {DHTMLED.DocumentHTML="<HTML dir="+defaultDir +"><HEAD><link href=\""+BaseURL+WebVirtualPath+"/styles.css\" rel=\"stylesheet\" type=\"text/css\"></HEAD>"+MirrorContent.value+"</HTML>";}
        else
        {DHTMLED.DocumentHTML="<HTML dir="+defaultDir +"><HEAD><link href=\""+BaseURL+WebVirtualPath+"/styles.css\" rel=\"stylesheet\" type=\"text/css\"></HEAD></HTML>";}
        DHTMLEdit_DisplayChanged(DHTMLED);	
        DHTMLED.focus();
         // DHTMLED.DocumentHTML="<HTML dir="+defaultDir +"><HEAD><link href=\""+BaseURL+WebVirtualPath+"/styles.css\" rel=\"stylesheet\" type=\"text/css\"></HEAD><STYLE type=\"text/css\"> BODY { FONT-FAMILY: "+DefaultFont+"; FONT-SIZE:"+ DefaultFontSize +"; MARGIN-LEFT: 5px; MARGIN-TOP: 5px} TD { FONT-SIZE:"+ DefaultFontSize+";  }</STYLE> </HTML>";

}

// function to build table params for the inserttable command 
function collectmytableatribs(mytableparamsarray)
{ 
var tbinfo="";
 if (mytableparamsarray["ALIGN"]!= "" ) {tbinfo=" align="+mytableparamsarray["ALIGN"];}
 if (mytableparamsarray["WIDTH"] !=-1) {tbinfo+=" width="+mytableparamsarray["WIDTH"]+mytableparamsarray["WIDTHmode"];}
 
tbinfo+=" border="+mytableparamsarray["BORDER"];
tbinfo+=" cellpadding="+mytableparamsarray["CELLPADDING"];
tbinfo+=" cellspacing="+mytableparamsarray["CELLSPACING"];
 if (mytableparamsarray["BORDERCOLOR"]!= "" ) {tbinfo+=" bordercolor=\""+mytableparamsarray["BORDERCOLOR"]+"\"";}
 if (mytableparamsarray["BGCOLOR"]!= "" ) {tbinfo+=" bgcolor=\""+mytableparamsarray["BGCOLOR"]+"\"";}
 if (mytableparamsarray["STYLE"]!= "" ) {tbinfo+=" style=\""+mytableparamsarray["STYLE"]+"\"";}
 if (mytableparamsarray["CLASS"]!= "" ) {tbinfo+=" class=\""+mytableparamsarray["CLASS"]+"\"";}
//alert (tbinfo);
return tbinfo;
}

// funcion to set graphic icon state
function SetBtState (MyElement,NewState) 
{
         switch(NewState)
         {
			case 'disabled':
				MyElement.style.borderColor = 'buttonface buttonface buttonface buttonface';			
				MyElement.children(0).style.filter ='alpha(opacity=40) gray';	
				MyElement.style.backgroundColor = 'buttonface';
				break;
			case 'checked':
				MyElement.style.borderColor = 'buttonshadow buttonhighlight buttonhighlight buttonshadow';			
				MyElement.style.backgroundColor = 'whitesmoke';		
				MyElement.children(0).style.filter ='';	
				break;
			case 'unchecked':
			        MyElement.style.borderColor = 'buttonface buttonface buttonface buttonface';			
				MyElement.style.backgroundColor = 'buttonface';
				MyElement.children(0).style.filter ='';
				break;
	}	
}

// Constructor for custom object that represents an item on the context menu
function ContextMenuItem(string, cmdId) {
  this.string = string;
  this.cmdId = cmdId;
}


///////////////////////////////////
//   global Events Listener       //
///////////////////////////////////
	
      // i have used style instead of  ClassName : its too slow on my machine
function BtOver(Bt)
{
      // if the image button is disabled quit this handler
      if (Bt.children(0).style.filter == 'alpha(opacity=40) gray'  ) { return ;} 
      Bt.style.borderColor = 'buttonhighlight buttonshadow buttonshadow buttonhighlight';
      document.all.MessageZone.innerText = Bt.children(0).alt;
      
}

function BtOut(Bt)
{
	// if it's latched then keep it down
	if (Bt.style.backgroundColor == 'whitesmoke' ) 
	{  Bt.style.borderColor = 'buttonshadow buttonhighlight buttonhighlight buttonshadow'; }
	else
	{  Bt.style.borderColor = 'buttonface buttonface buttonface buttonface'; }
	document.all.MessageZone.innerText = ' ';
}

function BtDown(Bt)
{
	// if the image button is disabled quit this handler
        if (Bt.children(0).style.filter == 'alpha(opacity=40) gray'  ) { return ;} 
	{Bt.style.borderColor = 'buttonshadow buttonhighlight buttonhighlight buttonshadow';}
	document.all.MessageZone.innerText = Bt.children(0).alt;
}

function BtUp(Bt)
{
	// if the image button is disabled quit this handler
        if (Bt.children(0).style.filter == 'alpha(opacity=40) gray'  ) { return ;} 
	{Bt.style.borderColor = 'buttonhighlight buttonshadow buttonshadow buttonhighlight';}
	document.all.MessageZone.innerText = Bt.children(0).alt;
}

function Btclick (MyElement,BtType,DHTMLED)
{
 // opacity button should not work
 if (MyElement.children(0).style.filter == 'alpha(opacity=40) gray'  ) { return ;} 
 
 if (BtType==null)
   {
      var command= eval(MyElement.id);
      DHTMLED.ExecCommand(command,OLECMDEXECOPT_DODEFAULT);
      DHTMLED.focus();
    } 
  else
    {
      eval(BtType+'(DHTMLED)');
    } 
}


// DisplayChanged handler. Very time-critical routine; this is called
// every time a character is typed. QueryStatus those toolbar buttons that need
// to be in synch with the current state of the document and update.
function DHTMLEdit_DisplayChanged(DHTMLED) 
{
// monitor  the showborder and showdetails
// borders
if (DHTMLED.ShowBorders)
{ SetBtState(document.all.SHOWBORDERS, 'checked'); }
else
{ SetBtState(document.all.SHOWBORDERS, 'unchecked'); }
// details
if (DHTMLED.ShowDetails)
{ SetBtState(document.all.SHOWDETAILS, 'checked'); }
else
{ SetBtState(document.all.SHOWDETAILS, 'unchecked'); }  

// inisialize Vars
  var i, state, bt,command;
  var ParagraphStyleSelection,MyParagraphStyle;
  var FontSelection,MyFontName,CreateNewFont;
  var SizeSelection,MyFontSize;
  // get a collection of all Icons
  bt=document.all.item("Icons");
 
// if HTMLMode

if (HTMLMode)
 { 
 SetBtState(document.all.HTMLMODE, 'checked'); 
 SetBtState(document.all.DESIGNMODE, 'unchecked')
 // only new find cut copy paste should work 
 for (i=0; i< 4; i++) 
  {
    // evaluate the command var
    command = eval(bt[i].parentElement.id);
    // get the state of DhtmledIcons
    state = DHTMLED.QueryStatus(command);
    if (state == DECMDF_DISABLED || state == DECMDF_NOTSUPPORTED) 
    {
      SetBtState(bt[i].parentElement, 'disabled');
    } else if (state == DECMDF_ENABLED  || state == DECMDF_NINCHED) {
      SetBtState(bt[i].parentElement, 'unchecked');
    } else { // DECMDF_LATCHED
      SetBtState(bt[i].parentElement, 'checked');
    }
  }
  // disable the other buttons
  for (i=4; i< bt.length; i++) 
  { SetBtState(bt[i].parentElement, 'disabled'); }
  // Disable font formatting
  document.all.ParagraphStyle.disabled = true;
  document.all.FontName.disabled = true;
  document.all.FontSize.disabled = true;
 }
else
{ 
 SetBtState(document.all.HTMLMODE, 'unchecked'); 
 SetBtState(document.all.DESIGNMODE, 'checked')

//  if design Mode
 
  for (i=0; i< bt.length; i++) 
  {
    // evaluate the command var
    command = eval(bt[i].parentElement.id);
    // get the state of DhtmledIcons
    state = DHTMLED.QueryStatus(command);
    if (state == DECMDF_DISABLED || state == DECMDF_NOTSUPPORTED) 
    {
      SetBtState(bt[i].parentElement, 'disabled');
    } else if (state == DECMDF_ENABLED  || state == DECMDF_NINCHED) {
      SetBtState(bt[i].parentElement, 'unchecked');
    } else { // DECMDF_LATCHED
      SetBtState(bt[i].parentElement, 'checked');
    }
  } 


// monitor the paragraph Style and state
  state = DHTMLED.QueryStatus(DECMD_SETBLOCKFMT);
  ParagraphStyleSelection = document.all.ParagraphStyle;
  if (state == DECMDF_DISABLED || state == DECMDF_NOTSUPPORTED) 
  {ParagraphStyleSelection.disabled = true;} 
  else 
  { 
    ParagraphStyleSelection.disabled = false;
    MyParagraphStyle = DHTMLED.ExecCommand(DECMD_GETBLOCKFMT, OLECMDEXECOPT_DODEFAULT); 
    // if a null or "" no paragraph Style ( the selection is may have multiple paragraph Style )
   if ( MyParagraphStyle != null && MyParagraphStyle != ""  )	
   {
    for(i=0;i<ParagraphStyleSelection.options.length;i++) 
	{
	  if(ParagraphStyleSelection.options[i].text==MyParagraphStyle&&!ParagraphStyleSelection.options[i].selected)
	  ParagraphStyleSelection.options[i].selected=true;
	}
    }
    else
    { ParagraphStyleSelection.selectedIndex=-1 }
  }
 
// monitor the Font Name and state
  FontSelection = document.all.FontName;
  state = DHTMLED.QueryStatus(DECMD_SETFONTNAME);
  if (state == DECMDF_DISABLED || state == DECMDF_NOTSUPPORTED) 
  {FontSelection.disabled = true;} 
  else 
  { 
     FontSelection.disabled = false; 
     MyFontName = DHTMLED.ExecCommand(DECMD_GETFONTNAME, OLECMDEXECOPT_DODEFAULT) ;
      // if a null or "" no fontName ( the selection is may have multiple font list )
      if ( MyFontName != null && MyFontName != ""  )	
        {	
	// if the font is defined as defaut DefautlFont Var ?
	if ( MyFontName != DefaultFont )
	 { CreateNewFont=true;
	   for(i=0;i<FontSelection.options.length;i++) 
	     {
	     // if the MyFontName Match The FontName List ? 
	     if(FontSelection.options[i].text==MyFontName)
	       {
                // If it's not already selected ?
                if(!FontSelection.options[i].selected)
		{    
                  FontSelection.options[i].selected=true;
                  CreateNewFont=false;
                }
                CreateNewFont=false;
 	       }
	     }
	    // Create new font if it is not on the list
	    if(CreateNewFont) 
	     {
		var MyOption = document.createElement("OPTION");
		FontSelection.options.add(MyOption,0);
		MyOption.text = MyFontName;
		MyOption.value = MyFontName;
		MyOption.selected=true;
	     }
	  }   
	   else
	  { 
	   for(i=0;i<FontSelection.options.length;i++) 
	     {
	     // if the MyFontName Match The DefaultFont ( the position is not specified because of CreateNewFont )
	     if(FontSelection.options[i].text=="(Police par défaut)")
	       { // If it's not already selected ?
                if(!FontSelection.options[i].selected)
		{ FontSelection.options[i].selected=true; }           
	       }
	      } 
	  }
	 }
	 else
	 {FontSelection.selectedIndex=-1} 
  }
   
  // monitor the Font Size
  state = DHTMLED.QueryStatus(DECMD_SETFONTSIZE);
  SizeSelection = document.all.FontSize;
  if (state == DECMDF_DISABLED || state == DECMDF_NOTSUPPORTED) 
  {SizeSelection.disabled = true;} 
  else 
  { 
    SizeSelection.disabled = false;
    MyFontSize = DHTMLED.ExecCommand(DECMD_GETFONTSIZE, OLECMDEXECOPT_DODEFAULT); 
    // if the font is defined as defaut DefautlFont Var ?
    if ( MyFontSize != DefaultHtmlFontSize ) 
    { 
     // if a null or "" no Font Size ( the selection is may have multiple Font Size )
     if ( MyFontSize != null && MyFontSize != ""  )	
     {
      for(i=0;i<SizeSelection.options.length;i++) 
 	 {
 	   if(SizeSelection.options[i].value==MyFontSize&&!SizeSelection.options[i].selected)
 	   {SizeSelection.options[i].selected=true};
 	 }
      }
      else
      { SizeSelection.selectedIndex=-1 }
    }
  else
    { if (!SizeSelection.options[0].selected) {SizeSelection.options[0].selected=true}  }
  }
} 
 
  // end DisplayChanged handler
}


// Show ContextMenu event handler
function DHTMLEdit_ShowContextMenu(DHTMLED)
{
  var menuStrings = new Array();
  var menuStates = new Array();
  var state;
  var i
  var idx = 0;

  // Rebuild the context menu.
  ContextMenu.length = 0;

  // Always show general menu
  for (i=0; i<GeneralContextMenu.length; i++) {
    ContextMenu[idx++] = GeneralContextMenu[i];
  }

  // Is the selection inside a table? Add table menu if so
  if (DHTMLED.QueryStatus(DECMD_INSERTROW) != DECMDF_DISABLED) {
    for (i=0; i<TableContextMenu.length; i++) {
      ContextMenu[idx++] = TableContextMenu[i];
    }
  }
  // Set up the actual arrays that get passed to SetContextMenu
  for (i=0; i<ContextMenu.length; i++) 
    {
    menuStrings[i] = ContextMenu[i].string;
    if (menuStrings[i] != MENU_SEPARATOR) 
      {
    	  
    	  if (typeof(ContextMenu[i].cmdId)!="string") 
    	  { state = DHTMLED.QueryStatus(ContextMenu[i].cmdId);}
    	  else
    	  { 
    	    // my specific command string and their monitoring command	
    	    switch (ContextMenu[i].cmdId)
    	    { case "EDIT_TABLE" :  state = DHTMLED.QueryStatus(DECMD_INSERTROW);
    	      case "EDIT_CELL" :  state = DHTMLED.QueryStatus(DECMD_INSERTROW);
    	    }
    	  }
      } else 
      {state = DECMDF_ENABLED;}
    
    if (state == DECMDF_DISABLED || state == DECMDF_NOTSUPPORTED) {
      menuStates[i] = OLE_TRISTATE_GRAY;
    } else if (state == DECMDF_ENABLED || state == DECMDF_NINCHED) {
      menuStates[i] = OLE_TRISTATE_UNCHECKED;
    } else { // DECMDF_LATCHED
      menuStates[i] = OLE_TRISTATE_CHECKED;
    }
  }

  // Set the context menu
  DHTMLED.SetContextMenu(menuStrings, menuStates);
}


// Context Menu action event handler
function DHTMLEdit_ContextMenuAction(itemIndex,DHTMLED) 
{
   // my specific command string 
    if (typeof(ContextMenu[itemIndex].cmdId) == "string") {
    eval(ContextMenu[itemIndex].cmdId+'(DHTMLED)');
  } else {
    DHTMLED.ExecCommand(ContextMenu[itemIndex].cmdId, OLECMDEXECOPT_DODEFAULT);
  }
}

// Document complete event handler
function DHTMLEdit_DocumentComplete(DHTMLED) 
{
	 // get it 
          var im=DHTMLED.DOM.images;   
          //alert (im.length);
          for(i=0; i<im.length ;i++) 
           {
           im[i].src = BaseURL+WebVirtualPath+im[i].src;
           }
	// if document complete fired
	DHTMLED.focus();
} 
 

///////////////////////////////////////
// Personalized DhtmlEdit Commands
///////////////////////////////////////

// Editing mode
function SetHTMLMode(DHTMLED,bool)
{
 // if it's already in the same state the go out don't do anything
 if ( HTMLMode == bool ) { return; }
 MirrorContent=document.all.DHTMLEditMirror;
 DHTMLED.DOM.selection.empty();
 
 if (HTMLMode)
  {
  // Design Mode 	
  // restore the font and size for design mode
  DHTMLED.DOM.body.style.fontFamily = DefaultFont;
  DHTMLED.DOM.body.style.fontSize = DefaultFontSize;
  MirrorContent.value=DHTMLED.DOM.body.createTextRange().text;
  DHTMLED.DOM.body.innerHTML = MirrorContent.value;	

  HTMLMode = false;

  }
  else 
  { // Html mode 
     var re=/((<br>)+)/ig; // test this one
    
     // set the font and size for html mode
     DHTMLED.DOM.body.style.fontFamily = "Courier New";
     DHTMLED.DOM.body.style.fontSize = "10pt";	
     MirrorContent.value=DHTMLED.DOM.body.innerHTML;
     DHTMLED.DOM.body.innerHTML = "";
     DHTMLED.DOM.body.createTextRange().text = MirrorContent.value.replace(re, "$1\n"); // test this two
     HTMLMode = true;
     }
   DHTMLED.focus();
}

// New 

function FILE_NEW(DHTMLED) 
{
 if (DHTMLED.DOM.body.innerHTML !="") 
    {
    if (confirm("êtes-vous sûr de vouloir effacer toute la page ?")) 
    {   document.all.DHTMLEditMirror.value ="";
    	// disable HTMLMODE
    	HTMLMode = false;
    	initialize(DHTMLED);}
    else
    {return ;}
   } 
   DHTMLED.focus();
}  


//// SHOW DETAILS / SHOW BORDERS

function SHOW_DETAILS(DHTMLED) 
{
  DHTMLED.ShowDetails = !DHTMLED.ShowDetails;
  DHTMLED.focus();
}

function SHOW_BORDERS(DHTMLED) 
{
  DHTMLED.ShowBorders = !DHTMLED.ShowBorders;
  DHTMLED.focus();
}



//// INSTABLE INSANCHOR INSLINK INSCMS INSIMAGE INSHR INSSPCAR

function INSERT_TABLE(DHTMLED) 

{
  var pVar = tableparamobj;
  var arr = null;
  var temparg = mytableparams;
  var cellwidth // cell defaultwidth
  
  arr = showModalDialog( "dreamedit/instable.htm",temparg,"dialogWidth: 385px ; dialogHeight: 360px;status:no");
  if (arr != null) 
   {
  
    // reInitialize table object
     
    	tableparamobj.NumRows=arr["ROWS"];
        tableparamobj.NumCols=arr["COLS"];   
        tableparamobj.TableAttrs=collectmytableatribs(arr);
        tableparamobj.Caption="";
        
        // generating cell width atribute by dividing  table width / columns
        arr["WIDTH"]=parseInt(arr["WIDTH"]);
        arr["COLS"]=parseInt(arr["COLS"]);
        if (arr["WIDTH"]> 1 && arr["COLS"]> 1 &&  arr["WIDTH"] > arr["COLS"] )
        { 
        	cellwidth = parseInt(arr["WIDTH"]/arr["COLS"]);
        	tableparamobj.CellAttrs="width=\""+cellwidth+arr["WIDTHmode"]+"\"";
           	}
        else
        {tableparamobj.CellAttrs="";}
        DHTMLED.ExecCommand(DECMD_INSERTTABLE,OLECMDEXECOPT_DODEFAULT, pVar);  

        DHTMLED.focus();
    }
   else
    {return ;}
}

function INSERT_ANCHOR(DHTMLED)
{
     var Selection = DHTMLED.DOM.selection;
     var SelectionRange,SelectionElement
     var fBreak=false;
     var LinkType;
     var arr = null;
     
     var LinkAttribs = new Array()
     // init array
     LinkAttribs["NAME"]="";
       
     // detrminate the type of selection 
     switch (Selection.type)
     {
	case "Control" : 
	  // commonParentElement()  method is for Control only to get the top of control collection  
     	  SelectionElement = Selection.createRange().commonParentElement(); 
       	  // get the body range the convert Control Range to text range so we can use pastehtml()
          SelectionRange  = DHTMLED.DOM.body.createTextRange(); 
          SelectionRange.moveToElementText(SelectionElement);
     	  SelectionRange.select();
     	  break;   
	case "Text" : 
	  SelectionRange = Selection.createRange(); 
	   // just in case if the user select partial Text contained in <a> tag
	   SelectionElement = SelectionRange.parentElement();
	   if (SelectionElement.tagName == 'A')
	     {SelectionRange.moveToElementText(SelectionRange.parentElement());
	     SelectionRange.select();}
	  break;   
	case "None" : 
	  // expand the range "none" selection to the element <a>
	  SelectionRange = Selection.createRange();
	  SelectionRange.moveToElementText(SelectionRange.parentElement());
	  SelectionRange.select();
	  break;   
     }
       
       if (DHTMLED.QueryStatus(DECMD_UNLINK) == DECMDF_DISABLED || DHTMLED.QueryStatus(DECMD_UNLINK) == DECMDF_NOTSUPPORTED) // new link
        { 
         LinkType = "new";
        }
        else // there's a link <A> tag  // get the first one in the range 
        {  
          // get it
          var coll=DHTMLED.DOM.all.tags("A");   
          for(i=0;i<coll.length&&!fBreak;i++) 
           {
           trLink=DHTMLED.DOM.body.createTextRange();
	   trLink.moveToElementText(coll[i]);
	     if (SelectionRange.inRange(trLink)) 
	         { 
	         trLink.select();
	         LinkType = "link";
	         fBreak=true;	
	         SelectionElement = coll[i];
            	 LinkAttribs["NAME"]=coll[i].name; 
	 	 }
           }
          
          if (!fBreak) // there's a link but it's not contained // unlink it
          {
          DHTMLED.ExecCommand(DECMD_UNLINK);
          LinkType = "new";
          }
        }
       // show dialog 
       var arr = showModalDialog( "dreamedit/insanchor.htm",LinkAttribs,"dialogWidth: 290px ; dialogHeight: 120px;status:no" );
       if ( arr != null) 
        {
        if (LinkType=="new") // make new ancchor linktype=new
          { 
         	if (arr["NAME"]) // if a name given from the dialog
         	{ SelectionRange.pasteHTML ('<a name=\"'+arr["NAME"]+'\">'+SelectionRange.htmlText+'</a>');
         	}
        
          }	
        else // update existing anchor   linktype=link
          {
          if  (arr["NAME"]) {SelectionElement.setAttribute("NAME", arr["NAME"],0); }
          else { if (SelectionElement.getAttribute("HREF")) // if href remove only the attribute
                 {SelectionElement.removeAttribute("NAME", 0); } 
                 else {DHTMLED.ExecCommand(DECMD_UNLINK);} // else remove the tag
                 }
          }
        }
       DHTMLED.focus();
}

function INSERT_LINK(DHTMLED)
{
     var Selection = DHTMLED.DOM.selection;
     var SelectionRange,SelectionElement;
     var fBreak=false;
     var LinkType;
     var arr = null;
     
     var LinkAttribs = new Array() ;
     // init array
     LinkAttribs["HREF"]="";
     LinkAttribs["TARGET"]="";
     LinkAttribs["TITLE"]="";
     LinkAttribs["STYLE"]="";
     LinkAttribs["CLASS"]="";
     LinkAttribs["ANCHORS"] = new Array() ;
     
     // collect anchors in the document    
     var coll=DHTMLED.DOM.anchors;   
     if (typeof(coll)=='object')
       {
       for(i=0;i<coll.length;i++) 
           { LinkAttribs["ANCHORS"][i] = coll[i].name ;}
        }     
        else { LinkAttribs["ANCHORS"] = null ;} // no anchors
     
     // detrminate the type of selection 
     switch (Selection.type)
     {
	case "Control" : 
	  // commonParentElement()  method is for Control only to get the top of control collection  
     	  SelectionElement = Selection.createRange().commonParentElement(); 
       	  // get the body range the convert Control Range to text range so we can use pastehtml()
          SelectionRange  = DHTMLED.DOM.body.createTextRange(); 
          SelectionRange.moveToElementText(SelectionElement);
     	  SelectionRange.select();
     	  break;   
	case "Text" : 
	  SelectionRange = Selection.createRange(); 
	   // just in case if the user select partial Text contained in <a> tag
	   SelectionElement = SelectionRange.parentElement();
	   if (SelectionElement.tagName == 'A')
	     {SelectionRange.moveToElementText(SelectionRange.parentElement());
	     SelectionRange.select();}
	  break;   
	case "None" : 
	  // expand the range "none" selection to the element <a>
	  SelectionRange = Selection.createRange();
	  SelectionRange.moveToElementText(SelectionRange.parentElement());
	  SelectionRange.select();
	  break;   
     }
       
       if (DHTMLED.QueryStatus(DECMD_UNLINK) == DECMDF_DISABLED || DHTMLED.QueryStatus(DECMD_UNLINK) == DECMDF_NOTSUPPORTED) // new link
        {   LinkType = "new"; }
        else // there's a link <A> tag  // get the first one in the range 
        {  
          // get it
          var coll=DHTMLED.DOM.all.tags("A");   
          for(i=0;i<coll.length&&!fBreak;i++) 
           {
           trLink=DHTMLED.DOM.body.createTextRange();
	   trLink.moveToElementText(coll[i]);
	     if (SelectionRange.inRange(trLink)) 
	         { 
	         trLink.select();
	         LinkType = "link";
	         fBreak=true;	
	         SelectionElement = coll[i];	
            	 LinkAttribs["HREF"]=coll[i].href;
                 LinkAttribs["TARGET"]=coll[i].target;
                 LinkAttribs["TITLE"]=coll[i].title;
                 LinkAttribs["STYLE"]=coll[i].style.cssText;
                 LinkAttribs["CLASS"]=coll[i].className;
	 	 }
           }
          
          if (!fBreak) // there's a link but it's not contained // unlink it
          {
          DHTMLED.ExecCommand(DECMD_UNLINK);
          LinkType = "new";
          }
        }
       // show dialog 
       var arr = showModalDialog( "dreamedit/inslink.htm",LinkAttribs,"dialogWidth: 385px ; dialogHeight: 340px;status:no" );
       
       if ( arr != null) 
        {
        if (LinkType=="new") // make new link linktype=new
          { 
         	var txtHTML="";
         	if (arr["HREF"]) // if a href given from the dialog
         	{
         		txtHTML="<A href=\""+arr["HREF"]+"\" ";
			if(arr["TARGET"])
				txtHTML+="target=\""+arr["TARGET"]+"\" ";
			if(arr["STYLE"])
				txtHTML+="style=\""+arr["STYLE"]+"\" ";
			if(arr["CLASS"])
				txtHTML+="class=\""+arr["CLASS"]+"\" ";
			if(arr["TITLE"])
				txtHTML+="title=\""+arr["TITLE"]+"\" ";
			txtHTML+=">"+SelectionRange.htmlText+"</a>";
			SelectionRange.pasteHTML(txtHTML);
         	}
        
          }	
        else // update existing link   linktype=link
          {
          if  (arr["HREF"]) {SelectionElement.setAttribute("HREF", arr["HREF"],0); }
          else { if (SelectionElement.getAttribute("NAME")) // if name remove only the attribute
                 {SelectionElement.removeAttribute("HREF", 0); } 
                 else {DHTMLED.ExecCommand(DECMD_UNLINK); // else remove the tag and exit the handler
                 return ; } 
                 }
           // target      
          if  (arr["TARGET"]) {SelectionElement.setAttribute("TARGET", arr["TARGET"],0); }
          else { if (SelectionElement.getAttribute("TARGET")) {SelectionElement.removeAttribute("TARGET", 0); } }
          
          // title      
          if  (arr["TITLE"]) {SelectionElement.setAttribute("TITLE", arr["TITLE"],0); }
          else { if (SelectionElement.getAttribute("TITLE")) {SelectionElement.removeAttribute("TITLE", 0); } }
          
          // style
          if  (arr["STYLE"]) {SelectionElement.style.cssText = arr["STYLE"]; }
          else { if (SelectionElement.style.cssText) {SelectionElement.style.cssText ="" ; } } 
          
          // class
          if  (arr["CLASS"]) {SelectionElement.className =  arr["CLASS"]; }
          else { if (SelectionElement.className) { SelectionElement.className ="" } }   
          }
        }
       DHTMLED.focus();
}

function INSERT_IMAGE(DHTMLED)
{
	
// init
var Selection = DHTMLED.DOM.selection;
var SelectionRange = Selection.createRange();
var SelectionElement;

     
// pass baseurl to the dilaog     
var ImArr = new Array();
ImArr["BASEURL"] = BaseURL;

// the image path to passed to the browser
var IMAGEVPATH = WebVirtualPath+ImageVirtualPath ;
var mFile = "dreamedit/insimage.asp?imagevpath="+IMAGEVPATH ;

var arr = showModalDialog( mFile,ImArr,"dialogWidth: 622px ; dialogHeight: 542px;status:no") ;

// use selection range to paste it
if (arr != null)  {
  if (Selection.type == "Control")  
  {
  // commonParentElement()  method is for Control only to get the top of control collection  
   var SelectionElement = Selection.createRange().commonParentElement(); 
    // get the body range the convert Control Range to text range so we can use pastehtml()
   SelectionRange  = DHTMLED.DOM.body.createTextRange(); 
   SelectionRange.moveToElementText(SelectionElement);
   SelectionRange.select();
   SelectionRange.pasteHTML("<img src=\""+arr["SRC"]+"\" BORDER=\""+arr["BORDER"]+"\">");
  } else 
  {
	SelectionRange.pasteHTML("<img src=\""+arr["SRC"]+"\" BORDER=\""+arr["BORDER"]+"\">");
  }
}
  DHTMLED.focus();
}

function INSERT_HR(DHTMLED)
{
// init
var Selection = DHTMLED.DOM.selection;
var SelectionRange = Selection.createRange();
var SelectionElement;

// use selection range to paste it
  if (Selection.type == "Control")  
  {
  // commonParentElement()  method is for Control only to get the top of control collection  
  var SelectionElement = Selection.createRange().commonParentElement(); 
    // get the body range the convert Control Range to text range so we can use pastehtml()
   SelectionRange  = DHTMLED.DOM.body.createTextRange(); 
   SelectionRange.moveToElementText(SelectionElement);
   SelectionRange.select();
   SelectionRange.pasteHTML('<hr size=1 noshade>');
  } else 
  {
	SelectionRange.pasteHTML('<hr size=1 noshade>');
  }

  DHTMLED.focus();
}

function INSERT_SPCHAR(DHTMLED)
{
// init
var Selection = DHTMLED.DOM.selection;
var SelectionRange = Selection.createRange();
var SelectionElement;
var arr = showModalDialog( "dreamedit/inscar.htm","","dialogWidth: 386px ; dialogHeight: 420px;status:no" );

// use selection range to paste it
if (arr != null)  {
  if (Selection.type == "Control")  
  {
  // commonParentElement()  method is for Control only to get the top of control collection  
   var SelectionElement = Selection.createRange().commonParentElement(); 
    // get the body range the convert Control Range to text range so we can use pastehtml()
   SelectionRange  = DHTMLED.DOM.body.createTextRange(); 
   SelectionRange.moveToElementText(SelectionElement);
   SelectionRange.select();
   SelectionRange.pasteHTML(arr);
  } else 
  {
	SelectionRange.pasteHTML(arr);
  }
}
  DHTMLED.focus();
}

//// HELP
function SHOW_HELP(DHTMLED)
{
//alert ('I will SHOW THE HELP !');
}

////   FONTSTYLE   FONTNAME  FONTSIZE 


function ParagraphStyle_onchange(DHTMLED,sValue) 
{
  DHTMLED.ExecCommand(DECMD_SETBLOCKFMT , OLECMDEXECOPT_DODEFAULT , sValue);
  DHTMLED.focus();
}

function FontName_onchange(DHTMLED,fValue) 
{ 
 if (fValue=='') {fValue=DefaultFont}; // Set the DefaultFont
 DHTMLED.ExecCommand(DECMD_SETFONTNAME, OLECMDEXECOPT_DODEFAULT, fValue);
 DHTMLED.focus();
}

function FontSize_onchange(DHTMLED,SValue) {
  if (SValue=='') {SValue=DefaultHtmlFontSize}; // set Default Size
  DHTMLED.ExecCommand(DECMD_SETFONTSIZE, OLECMDEXECOPT_DODEFAULT,SValue);
  DHTMLED.focus();
}

//// SETFORECOLOR SETBACKCOLOR   

function SET_FORECOLOR(DHTMLED) {
  var arr = showModalDialog( "dreamedit/selcolor.htm","","dialogWidth: 340px ; dialogHeight: 330px; status:no" );
  if (arr != null) 
  {
    if (arr=='Auto') arr='';
    DHTMLED.ExecCommand(DECMD_SETFORECOLOR,OLECMDEXECOPT_DODEFAULT, arr);
  }
  DHTMLED.focus();
}

function SET_BACKCOLOR(DHTMLED) {
  var arr = showModalDialog( "dreamedit/selcolor.htm","","dialogWidth: 340px ; dialogHeight: 330px;status:no" );

  if (arr != null) 
  {
   if (arr=='Auto') arr='';
    DHTMLED.ExecCommand(DECMD_SETBACKCOLOR,OLECMDEXECOPT_DODEFAULT, arr);
  }
  DHTMLED.focus();
}

//// EDITTABLE EDITCELL   

//////// EDIT TABLE ///////////////
function EDIT_TABLE(DHTMLED)
{
var TableGetAttribute = new Array(); 
var DefaultAttribute = mytableparams; // get my default attribute
var arr = null;

// search the table tag in the current range
var Selection = DHTMLED.DOM.selection.createRange().parentElement();
		while(Selection.tagName!="TABLE" && Selection.tagName!="HTML") 
		{  Selection = Selection.parentElement; }
		// if no TABLE found or error in html code then return 
                   if ( Selection.tagName == "HTML"  )
                    { alert ( 'Ce n\'est pas un tableau ! '); // this will not happen anyway ( the bt will be disabled )
                      DHTMLED.focus();
                      return; } 
                
// collect attributes from the table tag
// width and width mode
if (Selection.getAttribute("WIDTH")) 
{ TableGetAttribute["WIDTH"]=parseInt(Selection.getAttribute("WIDTH"));} 
else {TableGetAttribute["WIDTH"]=-1;}
if (Selection.getAttribute("WIDTH").indexOf('%') != -1) 
{TableGetAttribute["WIDTHmode"]="%";} 
else  {TableGetAttribute["WIDTHmode"]="";}

// height and height mode
if (Selection.getAttribute("HEIGHT")) 
{TableGetAttribute["HEIGHT"]=parseInt(Selection.getAttribute("HEIGHT"));} 
else {TableGetAttribute["HEIGHT"]=-1;}
if (Selection.getAttribute("HEIGHT").indexOf('%') != -1) 
{TableGetAttribute["HEIGHTmode"]="%";} 
else {TableGetAttribute["HEIGHTmode"]="";}

// --- Border,  cellpadding and cellspacing is obligatory if not found will be added 
if (Selection.getAttribute("BORDER")) {TableGetAttribute["BORDER"]=parseInt(Selection.getAttribute("BORDER"));} else {TableGetAttribute["BORDER"]=DefaultAttribute["BORDER"];}
if (Selection.getAttribute("CELLPADDING")) {TableGetAttribute["CELLPADDING"]=parseInt(Selection.getAttribute("CELLPADDING"));} else { TableGetAttribute["CELLPADDING"]=DefaultAttribute["CELLPADDING"];}
if (Selection.getAttribute("CELLSPACING")) {TableGetAttribute["CELLSPACING"]=parseInt(Selection.getAttribute("CELLSPACING"));} else { TableGetAttribute["CELLSPACING"]=DefaultAttribute["CELLSPACING"];}
// ----

TableGetAttribute["ALIGN"]=Selection.getAttribute("ALIGN");
TableGetAttribute["BORDERCOLOR"]=Selection.getAttribute("BORDERCOLOR");
TableGetAttribute["BGCOLOR"]=Selection.getAttribute("BGCOLOR");
TableGetAttribute["STYLE"]=Selection.style.cssText; // finally cssText give persisted representation of the style rule
TableGetAttribute["CLASS"]=Selection.className;

arr = showModalDialog( "dreamedit/edittable.htm",TableGetAttribute,"dialogWidth: 385px ; dialogHeight: 320px;status:no");

// reinitialize the TABLE tag  
if (arr != null) 
   {
    // width 
    if (arr["WIDTH"]==-1) // if no width attribute
       { if (Selection.getAttribute("WIDTH")) {Selection.removeAttribute("WIDTH", 0); }}
    else { Selection.setAttribute("WIDTH", arr["WIDTH"]+arr["WIDTHmode"],0); }   
    // height
    if (arr["HEIGHT"]==-1) // if no height attribute
       { if (Selection.getAttribute("HEIGHT")) {Selection.removeAttribute("HEIGHT", 0); }}
    else { Selection.setAttribute("HEIGHT", arr["HEIGHT"]+arr["HEIGHTmode"],0); }      
  
    // Border,  cellpadding and cellspacing
     Selection.setAttribute("BORDER", arr["BORDER"],0);   
     Selection.setAttribute("CELLPADDING", arr["CELLPADDING"],0);   
     Selection.setAttribute("CELLSPACING", arr["CELLSPACING"],0);   
    // align
     if  (arr["ALIGN"]) {Selection.setAttribute("ALIGN", arr["ALIGN"],0); }
       else { if (Selection.getAttribute("ALIGN")) {Selection.removeAttribute("ALIGN", 0); } }
    // bordercolor
     if  (arr["BORDERCOLOR"]) {Selection.setAttribute("BORDERCOLOR", arr["BORDERCOLOR"],0); }
       else { if (Selection.getAttribute("BORDERCOLOR")) {Selection.removeAttribute("BORDERCOLOR", 0); } }
    // bgcolor
     if  (arr["BGCOLOR"]) {Selection.setAttribute("BGCOLOR", arr["BGCOLOR"],0); }
       else { if (Selection.getAttribute("BGCOLOR")) {Selection.removeAttribute("BGCOLOR", 0); } }        
    // style
     if  (arr["STYLE"]) {Selection.style.cssText = arr["STYLE"]; }
        else { if (Selection.style.cssText) {Selection.style.cssText ="" ; } } 
    // class
    if  (arr["CLASS"]) {Selection.className =  arr["CLASS"]; }
       else { if (Selection.className) { Selection.className ="" } }        
    }
   else
    {return ;}
// end table editor
DHTMLED.focus();
}

////////// EDIT CELL ////////////////
function EDIT_CELL(DHTMLED)
{
var TdGetAttribute = new Array(); 
var arr = null;
var rng = DHTMLED.DOM.selection.createRange();

// move the insertion point to the begining if multiple td 
// and enclose the selection to first td in the range to avoid conflicts

rng.collapse();
rng.moveToElementText(rng.parentElement());
rng.select();

// search the td tag in the current range
var Selection = rng.parentElement();

    	while( Selection.tagName!="TD" && Selection.tagName!="HTML" ) 
		  {  Selection = Selection.parentElement ; }
    
              // if no td found or error in html code then return rq : th not supported
                   if ( Selection.tagName == "HTML"  )
                    { alert ( 'Ce n\'est pas une cellule ! '); 
                      DHTMLED.focus();
                      return; } 
             
// collect attributes from the td tag
// width and width mode

if (Selection.getAttribute("WIDTH")) 
{ TdGetAttribute["WIDTH"]=parseInt(Selection.getAttribute("WIDTH"));} 
else {TdGetAttribute["WIDTH"]=-1;}
if (Selection.getAttribute("WIDTH").indexOf('%') != -1) 
{TdGetAttribute["WIDTHmode"]="%";} 
else  {TdGetAttribute["WIDTHmode"]="";}

// height and height mode
if (Selection.getAttribute("HEIGHT")) 
{TdGetAttribute["HEIGHT"]=parseInt(Selection.getAttribute("HEIGHT"));} 
else {TdGetAttribute["HEIGHT"]=-1;}
if (Selection.getAttribute("HEIGHT").indexOf('%') != -1) 
{TdGetAttribute["HEIGHTmode"]="%";} 
else {TdGetAttribute["HEIGHTmode"]="";}

// --- colspan , rowspan ,align, valign
if (Selection.getAttribute("COLSPAN")) {TdGetAttribute["COLSPAN"]=parseInt(Selection.getAttribute("COLSPAN"));} 
if (Selection.getAttribute("ROWSPAN")) {TdGetAttribute["ROWSPAN"]=parseInt(Selection.getAttribute("ROWSPAN"));} 


TdGetAttribute["ALIGN"]=Selection.getAttribute("ALIGN"); 
TdGetAttribute["VALIGN"]=Selection.getAttribute("VALIGN"); 
// nowrap 
if (Selection.noWrap) {TdGetAttribute["NOWRAP"]=true}
 else {TdGetAttribute["NOWRAP"]=false}

TdGetAttribute["BORDERCOLOR"]=Selection.getAttribute("BORDERCOLOR");
TdGetAttribute["BGCOLOR"]=Selection.getAttribute("BGCOLOR");
TdGetAttribute["STYLE"]=Selection.style.cssText; // finally cssText give persisted representation of the style rule
TdGetAttribute["CLASS"]=Selection.className;
arr = showModalDialog( "dreamedit/editcell.htm",TdGetAttribute,"dialogWidth: 395px ; dialogHeight: 325px; status:no");

// reinitialize the TD tag  
if (arr != null) 
   {
    // width 
    if (arr["WIDTH"]==-1) // if no width attribute
       { if (Selection.getAttribute("WIDTH")) {Selection.removeAttribute("WIDTH", 0); }}
    else { Selection.setAttribute("WIDTH", arr["WIDTH"]+arr["WIDTHmode"],0); }   
    // height
    if (arr["HEIGHT"]==-1) // if no height attribute
       { if (Selection.getAttribute("HEIGHT")) {Selection.removeAttribute("HEIGHT", 0); }}
    else { Selection.setAttribute("HEIGHT", arr["HEIGHT"]+arr["HEIGHTmode"],0); }      
  
    // --- colspan , rowspan ,align, valign
     // colspan
     if  (arr["COLSPAN"] || arr["COLSPAN"] > 1) {Selection.setAttribute("COLSPAN", arr["COLSPAN"],0); }
       else { Selection.removeAttribute("COLSPAN", 0); }
     // rowspan
        if  (arr["ROWSPAN"] || arr["ROWSPAN"] > 1) {Selection.setAttribute("ROWSPAN", arr["ROWSPAN"],0); }
       else { Selection.removeAttribute("ROWSPAN", 0); } 
 
     // align
     if  (arr["ALIGN"]) {Selection.setAttribute("ALIGN", arr["ALIGN"],0); }
      else { if (Selection.getAttribute("ALIGN")) {Selection.removeAttribute("ALIGN", 0); } } 

     // valign
     Selection.setAttribute("VALIGN", arr["VALIGN"],0);
     if  (arr["VALIGN"]) {Selection.setAttribute("VALIGN", arr["VALIGN"],0); }
     else { if (Selection.getAttribute("VALIGN")) {Selection.removeAttribute("VALIGN", 0); } } 
     
     // noWrap
     if (arr["NOWRAP"]) {Selection.noWrap=true;}
     else{Selection.noWrap=false;}
    
    // bordercolor
     if  (arr["BORDERCOLOR"]) {Selection.setAttribute("BORDERCOLOR", arr["BORDERCOLOR"],0); }
       else { if (Selection.getAttribute("BORDERCOLOR")) {Selection.removeAttribute("BORDERCOLOR", 0); } }
    // bgcolor
     if  (arr["BGCOLOR"]) {Selection.setAttribute("BGCOLOR", arr["BGCOLOR"],0); }
       else { if (Selection.getAttribute("BGCOLOR")) {Selection.removeAttribute("BGCOLOR", 0); } }        
    // style
     if  (arr["STYLE"]) {Selection.style.cssText = arr["STYLE"]; }
        else { if (Selection.style.cssText) {Selection.style.cssText ="" ; } } 
    // class
    if  (arr["CLASS"]) {Selection.className =  arr["CLASS"]; }
       else { if (Selection.className) { Selection.className ="" } }        
    }
   else
    {return ;}
 
 // end cellule editor
DHTMLED.focus();
}


///// SHOW CREDIT
function SHOW_CREDIT(DHTMLED)
{ 
	showModalDialog( "dreamedit/about.htm","","dialogWidth: 385px ; dialogHeight: 460px;status:no");
	DHTMLED.focus();
}

/////////////////////////////////
// Ending
////////////////////////////////
//-->