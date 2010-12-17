var n=navigator.appName
var ns=(n=="Netscape")
var ie=(n=="Microsoft Internet Explorer")

if (navigator.userAgent.indexOf('Opera') != -1) {
	document.write('<link href="/css/pathway_style_Op.css" type=text/css rel=stylesheet>')
}

else if (ie)
{
	//alert(n);
	document.write('<link href="/css/pathway_style_IE.css" type=text/css rel=stylesheet>')
}
else if (ns)
{
	document.write('<link href="/css/pathway_style_NS.css" type=text/css rel=stylesheet>')
}
else 
{
	//alert(n);
	document.write('<link href="/css/pathway_style.css" type=text/css rel=stylesheet>')
}


function jPCGoLogin()
{
//window.open('https://userservices.pathcom.com/gateway.php?page=main.php','_blank');
window.open('https://userservices.pathcom.com/main.php','_blank');
MM_swapImgRestore();
}

function popupwindow(URL) {
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=312,height=100,left=350,top=350');");
}


function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}

function jPCFormChecker(implogin)
{
for (var i=0; i < document.implogin.Login.length; i++)
   {
  	 if (document.implogin.Login[i].checked)
      {
      var rad_val = document.implogin.Login[i].value;	  
      }		
   }
   if (implogin.imapuser.value == "")
  {
    alert("Please enter valid  Login Name.");
    implogin.imapuser.focus();
    return (false);
  }
  if (implogin.pass.value == "")
  {
    alert("Please enter a valid password.");
    implogin.pass.focus();
    return (false);
  }  
   if  (rad_val == "EasyMail")
      {	
	//	alert(rad_val)		
		var i;
		var cch='0';
		var atsings='0';

		for(i=0;i<implogin.imapuser.value.length;i++)
		{
			cch = implogin.imapuser.value.charAt(i);
			if ( cch=='@' )
			{
				atsings = '1';
			}
		}
		if ( atsings == '0' )
		{	
			implogin.imapuser.value = implogin.imapuser.value + "@pathcom.com";
		}
		else
		{
			cch = '0';
		}
			document.implogin.submit();
    		document.implogin.action="http://easymail.pathcom.com/horde/imp/redirect.php";
		return (true);
      }
	 else
	 {
 	//	alert(rad_val)		
  		implogin.username.value = implogin.imapuser.value;
  		implogin.password.value = implogin.pass.value;
	 	document.implogin.submit();
    	//document.implogin.action="https://userservices.pathcom.com/gateway.php?page=main.php";
    	document.implogin.action="https://userservices.pathcom.com/main.php";
		return (true);
	 }	 
}

function jPCClearEdgeFormChecker(implogin)
{
	if (implogin.imapuser.value == "")
  	{
    	alert("Please enter valid  Login Name.");
    	implogin.imapuser.focus();
    	return (false);
  	}
  	if (implogin.pass.value == "")
  	{
	    alert("Please enter a valid password.");
	    implogin.pass.focus();
	    return (false);
  	}  
   	
	implogin.txtIdentifiant.value = implogin.imapuser.value;
	implogin.txtMotDePasse.value = implogin.pass.value;
 	document.implogin.submit();
	document.implogin.action="https://selfcare.pathcom.com/GUI/SelfCareWebPortal/";
	return (true);
}

function jNPConnect()
{
    w = window.screen.availWidth; 
    h = window.screen.availHeight; 
    results_location = "http://rms.pathcom.com/gethelp.asp";                                        
    window.open(results_location,'','width='+w+',height='+h+',scrollbar=NO,directories=NO,location=NO,menubar=NO,scrollbars=yes,status=NO,toolbar=NO,resizable=NO,left=00,top=00,screenX=00,screenY=00');           
}
