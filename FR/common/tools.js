//////////////////////////////////////////////////////
// popup centered window (clone to remove from head)
//////////////////////////////////////////////////////
function PopUpWin(filename,cMyWidth,cMyHeight) {

iMyWidth = (window.screen.width/2) - (parseInt((cMyWidth/2)) + 10);
iMyHeight = (window.screen.height/2) - (parseInt((cMyHeight/2)) + 10);
//Open the window.
win2 = window.open(filename,null,"status=no,height="+cMyHeight+",width="+cMyWidth+",resizable=no,left=" + iMyWidth + ",top=" + iMyHeight + ",screenX=" + iMyWidth + ",screenY=" + iMyHeight + ",toolbar=no,menubar=no,scrollbars=yes,location=no,directories=no");
win2.focus();
}

//////////////////////////////////////////////////////
// is digit function
//////////////////////////////////////////////////////
function IsDigit()
{return ((event.keyCode >= 48) && (event.keyCode <= 57))}

//////////////////////////////////////////////////////
// admin rec delete confirmation
//////////////////////////////////////////////////////

function confirmDelete(url)
{
 conf=window.confirm("êtes vous sur de vouloir supprimer l'enregistrement ?");
 if (conf) 
 { location.href=url;} 
 else
 { return;  }
}

//////////////////////////////////////////////////////
// goidx ( go to key related selection )
//////////////////////////////////////////////////////
function goidx(idx,theLink)
{ 
var idxl = idx.length ;
if (idx=='-1' ) {return ;}
 if (idx.substr(0,1)=='+') 
 { document.location.href = theLink +'?ro=true&frmidxid='+idx.substr(1); }
 else
 { document.location.href = theLink +'?frmidxid='+idx ; }
}

//////////////////////////////////////////////////////
// goidx0 ( go to key0 related selection )
//////////////////////////////////////////////////////
function goidx0(idx,theLink)
{ 
if (idx==-1 ) {return ;}
document.location.href = theLink +'?frmidx0id='+idx 
}

//////////////////////////////////////////////////////
// goidxS ( go to keyS related selection ( srubs only )
//////////////////////////////////////////////////////
function goidxS(idx,theLink)
{ 
if (idx==-1 ) {return ;}
document.location.href = theLink +'?ro=true&frmidxSid='+idx 
}

//////////////////////////////////////////////////////
// file manager function
//////////////////////////////////////////////////////
	function Command(cmd, param) {
		var str;
		var someWin;
		switch (cmd) {
			case "NewFolder":
				str = prompt("Le nom du dossier a creer", "Nouveau_dossier");
				if(!str) return;
				else if (!CheckName(str)) {alert("Un nom de Répertoire ne peut contenir l\'un des caractères suivants: \\ / : * ? \" < > |"); return;}
				document.forms.formBuffer.parameter.value = str;
				break;
			case "Upload":
                                //someWin = openWin(cmd, "", 400, 400, true, false);
				//createPage(someWin,cmd,param);
                                var fullurlpath = 'upload.asp?folder='+param ;
                                someWin = openWin(cmd, fullurlpath , 350, 120, true, false);
				someWin.focus(); 
				someWin = null;
				return;
				break;
			case "DeleteFolder":
				if (!confirm('êtes vous sur de vouloir supprimer le répertoire "' + param + '" et son contenu ?')) return;
				document.forms.formBuffer.parameter.value = param;
				break;
			case "DeleteFile":
				if (!confirm('êtes vous sur de vouloir supprimer "' + param + '" ?')) return;
				document.forms.formBuffer.parameter.value = param;				
				break;
			case "RenameFile":
				str = prompt("Nouveau nom de fichier", param);
				if(!str) return;
				else if (!CheckName(str)) {alert("Un nom de fichier ne peut contenir l\'un des caractères suivants:: \\ / : * ? \" < > |"); return;}
				document.forms.formBuffer.parameter.value = param + "|" + str;
				break;
			case "RenameFolder":
				str = prompt("Nouveau nom de Répertoire", param);
				if(!str) return;
				else if (!CheckName(str)) {alert("Un nom de Répertoire ne peut contenir l\'un des caractères suivants: \\ / : * ? \" < > |"); return;}
				document.forms.formBuffer.parameter.value = param + "|" + str;
				break;
			case "NoWebAccess":
				alert("You don't have web access for this folder so\nweb browsing of files/folders will not be available!");
				return;
				break;
			default:
				document.forms.formBuffer.parameter.value = param;
		}
		document.forms.formBuffer.target = "";
		document.forms.formBuffer.command.value = cmd
		document.forms.formBuffer.submit();	
	}
	

	function openWin(winName, urlLoc, w, h, showStatus, isViewer) {
		l = (screen.availWidth - w)/2;
		t = (screen.availHeight - h)/2;
		features  = "toolbar=no";      // yes|no 
		features += ",location=no";    // yes|no 
		features += ",directories=no"; // yes|no 
		features += ",status=" + (showStatus?"yes":"no");  // yes|no 
		features += ",menubar=no";     // yes|no 
		features += ",scrollbars=" + (isViewer?"yes":"no");   // auto|yes|no 
		features += ",resizable=" + (isViewer?"yes":"no");   // yes|no 
		features += ",dependent";      // close the parent, close the popup, omit if you want otherwise 
		features += ",height=" + h;
		features += ",width=" + w;
		features += ",left=" + l;
		features += ",top=" + t;
		winName = winName.replace(/[^a-z]/gi,"_");
		return window.open(urlLoc,winName,features);
	} 
	
	function createPage (theWin, cmd, param){
		document.forms.formBuffer.target = theWin.name;
		document.forms.formBuffer.command.value = cmd;
		document.forms.formBuffer.parameter.value = param;
		document.forms.formBuffer.popup.value = "true";
		document.forms.formBuffer.submit();
		document.forms.formBuffer.popup.value = "false";
	}


	function CheckName(str) {
		var re;
		re = /[\\/:*?<>|]/gi;
		if (re.test(str)) return false;	
		else return true;
	}	


