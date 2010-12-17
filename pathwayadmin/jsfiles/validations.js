
//****************************************************************************
// Function to delete blank/white spaces Between Data Entered
//****************************************************************************
function deleteBlanks(entry)
{
	var len = entry.length ;
	var foundBlank = 1;
	while(foundBlank == 1 && len > 0) 
	{
		var indx = entry.indexOf(" ");
		if(indx == -1) 
			foundBlank = 0 ;
		else
			entry = entry.substring(0,indx) + entry.substring(indx+1,len);
		len = entry.length;
	}
	return entry;
}

//****************************************************************************
// Function To Check Entered Email Is Containing Any Special Characters or Not
//****************************************************************************
function emailCheck (emailStr) {
	femailStr= emailStr;
	emailStr = emailStr.value;
/* The following pattern is used to check if the entered e-mail address
   fits the user@domain format.  It also is used to separate the username
   from the domain. */
var emailPat=/^(.+)@(.+)$/
/* The following string represents the pattern for matching all special
   characters.  We don't want to allow special characters in the address. 
   These characters include ( ) < > @ , ; : \ " . [ ]    */
var specialChars="\\(\\)<>@,;:\\\\\\\"\'\.\\[\\]$&#?"
/* The following string represents the range of characters allowed in a 
   username or domainname.  It really states which chars aren't allowed. */
var validChars="\[^\\s" + specialChars + "\]"
/* The following pattern applies if the "user" is a quoted string (in
   which case, there are no rules about which characters are allowed
   and which aren't; anything goes).  E.g. "jiminy cricket"@disney.com
   is a legal e-mail address. */
var quotedUser="(\"[^\"]*\")"
/* The following pattern applies for domains that are IP addresses,
   rather than symbolic names.  E.g. joe@[123.124.233.4] is a legal
   e-mail address. NOTE: The square brackets are required. */
var ipDomainPat=/^\[(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})\]$/
/* The following string represents an atom (basically a series of
   non-special characters.) */
var atom=validChars + '+'
/* The following string represents one word in the typical username.
   For example, in john.doe@somewhere.com, john and doe are words.
   Basically, a word is either an atom or quoted string. */
var word="(" + atom + "|" + quotedUser + ")"
// The following pattern describes the structure of the user
var userPat=new RegExp("^" + word + "(\\." + word + ")*$")
/* The following pattern describes the structure of a normal symbolic
   domain, as opposed to ipDomainPat, shown above. */
var domainPat=new RegExp("^" + atom + "(\\." + atom +")*$")


/* Finally, let's start trying to figure out if the supplied address is
   valid. */

/* Begin with the coarse pattern to simply break up user@domain into
   different pieces that are easy to analyze. */
var matchArray=emailStr.match(emailPat)
if (matchArray==null) {
  /* Too many/few @'s or something; basically, this address doesn't
     even fit the general mould of a valid e-mail address. */
	alert("Email address seems incorrect (check @ and .'s)")
	femailStr.focus();
	return false
}
var user=matchArray[1]
var domain=matchArray[2]

// See if "user" is valid 
if (user.match(userPat)==null) {
    // user is not valid
    alert("The email address doesn't seem to be valid.")
	femailStr.focus();
    return false
}

/* if the e-mail address is at an IP address (as opposed to a symbolic
   host name) make sure the IP address is valid. */
var IPArray=domain.match(ipDomainPat)
if (IPArray!=null) {
    // this is an IP address
	  for (var i=1;i<=4;i++) {
	    if (IPArray[i]>255) {
	        alert("Destination IP address is invalid!")
		return false
	    }
    }
    return true
}

// Domain is symbolic name
var domainArray=domain.match(domainPat)
if (domainArray==null) {
	alert("The domain name doesn't seem to be valid.")
	femailStr.focus();
    return false
}

/* domain name seems valid, but now make sure that it ends in a
   three-letter word (like com, edu, gov) or a two-letter word,
   representing country (uk, nl), and that there's a hostname preceding 
   the domain or country. */

/* Now we need to break up the domain to get a count of how many atoms
   it consists of. */
var atomPat=new RegExp(atom,"g")
var domArr=domain.match(atomPat)
var len=domArr.length
if (domArr[domArr.length-1].length<2 || 
    domArr[domArr.length-1].length>3) {
   // the address must end in a two letter or three letter word.
   alert("The address must end in a three-letter domain, or two letter country.")
   return false
}

// Make sure there's a host name preceding the domain.
if (len<2) {
   var errStr="This address is missing a hostname!"
   alert(errStr)
	femailStr.focus();
   return false
}

// If we've gotten this far, everything's valid!
return true;
}
//  End -->

//****************************************************************************
// Function To Check Text box is empty or not
//****************************************************************************
function isEmpty(val,valName)
{
	if (!deleteBlanks(val.value))
	{
		alert(valName + " is required");
		val.focus();
		return false;	
	}
	return true;
}


//****************************************************************************
// Function To Check Entered Data is number or not
//****************************************************************************
function isNumber(val)
{
	count=0;
	str = val.toString();
	
	for (i=0;i<str.length;i++)
	{
		ch = str.substr(i, 1);
   	    if (ch<"0" || ch>"9")
			return false;
	}
    return true;
}


//****************************************************************************
// Function To Check Entered Email Is Valid or Not
//****************************************************************************
function isEmail(val)
{
	theString = val.value;
	if (isEmpty(val,"E-Mail address"))
	{
		var FirstAtTheRate = theString.indexOf("@");
		var LastAtTheRate = theString.lastIndexOf("@");
		var FirstPeriod = theString.indexOf(".");
		var LastPeriod = theString.lastIndexOf(".");

		if(FirstAtTheRate <= 0 || FirstPeriod <= 0 || LastAtTheRate == theString.length-1 ||	LastPeriod == theString.length-1 || FirstAtTheRate != LastAtTheRate || (LastPeriod - LastAtTheRate)<=1)
		{
			alert("Invalid E-Mail");
			val.focus();
			val.select();
			return false;	
		}
	}
	else
		return false;
	return true;
}

//****************************************************************************
// Function To Check Telephone Number Is Valid or Not
//****************************************************************************
function checktel(tel,valname)
{
	val1=tel;
	if (val1!="")
	{
		for (var i=0;i<val1.length;i++)
		{
			var val = val1.charAt(i);
			if ((val1.length<12 ) || (i!=7 && i!=3 && (val<"0" || val>"9") ) || ( (i==3 || i==7) && val!="-" ) || (val1.length>12) )
			{
				alert("Please enter the " + valname + " in the format 999-999-9999");
				tel.focus();
				tel.select();
				return false;
			}
		}
	}
	return true;
}

//****************************************************************************
// Function To Check Entered Date Is Valid or Not
//****************************************************************************
function isDate(sdd,smm,syy,valName)
{
	day=sdd[sdd.selectedIndex].value;
	month=smm[smm.selectedIndex].value;
	year=syy[syy.selectedIndex].value;

	errflag=0;
	if (day==0 || month==0 || year==0 || year=='')
		errflag=1;
	if (errflag==0)
	{
		switch(month)
		{
    	  case '2':
	 			leap=year%4;
 				if(leap>0 && day>28)
					errflag=1;
				else if (day>29)
					errflag=1;
				break;
		  case '4':case '6':case '9':case '11':
				if(day>30)
					errflag=1;
		}
	}
	if(errflag==1)
	{
		alert("Please enter valid date")
		smm.focus();
		return false;
	}
	return true;
}

function islte(day1,month1,year1,day2,month2,year2,valName1,valName2)
{
	dd1=day1[day1.selectedIndex].value;
	mm1=month1[month1.selectedIndex].value;
	yy1=year1[year1.selectedIndex].value;
	if (!isDate(day1,month1,year1,valName1))
		return false;

	dd2=day2;
	mm2=month2;
	yy2=year2;

	if(dd1<10)
		dd1="0"+dd1;
	if(mm1<10)
		mm1="0"+mm1;
	if(dd2<10)
		dd2="0"+dd2;
	if(mm2<10)
		mm2="0"+mm2;
	
	if((yy1+"-"+mm1+"-"+dd1) < (yy2+"-"+mm2+"-"+dd2))
	{
		alert(valName1 + " can only be on or after " + valName2)
		month1.focus();
		return false;
	}
	return true;
}

function isgte(day1,month1,year1,day2,month2,year2,valName1,valName2)
{
	dd1=day1[day1.selectedIndex].value;
	mm1=month1[month1.selectedIndex].value;
	yy1=year1[year1.selectedIndex].value;
	if (!isDate(day1,month1,year1,valName1))
		return false;

	dd2=day2[day2.selectedIndex].value;
	mm2=month2[month2.selectedIndex].value;
	yy2=year2[year2.selectedIndex].value;
	if (!isDate(day2,month2,year2,valName2))
		return false;
	
	if((yy1+"-"+mm1+"-"+dd1) > (yy2+"-"+mm2+"-"+dd2))
	{
		alert(valName1 + " can only be on or after " + valName2)
		month1.focus();
		return false;
	}
	return true;
}

function isTel(val1,val2,val3,valName)
{
	inv=0;
	v=val1.value+val2.value+val3.value;
	if (v!="")
	{
		if (v.length<10)
			inv=1;
		for (var i=0;i<v.length && inv==0;i++)
		{
			if ( v.charAt(i)<"0" || v.charAt(i)>"9")
				inv=1;
		}

		if (inv==1)
		{
			alert (valName + " is invalid")
			val1.focus();
			val1.select();
			return false;
		}
	}
	return true;
}

//****************************************************************************
// Function To Check Entered Date Is Valid or Not
//****************************************************************************
function isValidDate(day,month,year)
{
	errflag=0;
	if (day==0 || month==0 || year==0)
		errflag=1;
	if (errflag==0)
	{
		month=month.toString();
		switch(month)
		{
    	  case '2':
	 			leap=year%4;
 				if(leap>0 && day>28)
					errflag=1;
				else if (day>29)
					errflag=1;
				break;

		  case '4':case '6':case '9':case '11':

				if(day>30)
					errflag=1;
				break;

		  case '1':case '3':case '5':case '7':case '8':case '10':case '12':

				if(day>31)
					errflag=1;
				break;

		  default :
				errflag=1;
		}
	}
	if(errflag)
		return false;
	return true;
}

function isUrl(val)
{
	theString = val.value;
	if (isEmpty(val,"Url"))
	{
//		var FirstAtTheRate = theString.indexOf("http://www.");
		var StartsWith = theString.indexOf("http://");
		var Contains = theString.indexOf("//");
		var FirstAtTheRate = theString.indexOf("www.");
		var FirstPeriod = theString.indexOf(".");
		var LastPeriod = theString.lastIndexOf(".");
		var illegalChars= /[\(\)\<\>\,\;\#\$\@\^\*\[\]]/;
		var lengthip=val.value.length;
		var validaip="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ.-:/";
		var ipalpha=false;

	    for (var i = 0; i < lengthip; i++) 
		{
			if (validaip.indexOf(val.value.charAt(i)) != -1)
			{
				if (val.value.match(illegalChars)) 
				{
					ipalpha = false;
				}
				else
				 	ipalpha = true;
			}
			else 
				ipalpha =false; 
		}

		var j=0;
		for (i=0;i<val.value.length;i++)
		{
			if ((val.value.charAt(i)) == ".")
			{
				if ((val.value.charAt(i+1)) == ".")
					j=1;
			}
		}

		if(ipalpha && j==0)
		{
			if(Contains >= 0 || StartsWith == 0 || FirstAtTheRate == -1 || FirstPeriod <= 0 || LastPeriod<=1  || LastPeriod == theString.length-1 ||	val.value.charAt(FirstPeriod+1) == "." || val.value.charAt(LastPeriod-1) == "." || LastPeriod == FirstPeriod)
			{
				alert("Invalid Url");
				val.focus();
				val.select();
				return false;	
			}	
		}
		else
		{		
			alert("Invalid Url");
			val.focus();
			val.select();
			return false;	
		}
	}
	return true;
}

//****************************************************************************
// Function To Check the validity of the comma separate email-ids entered by the user
//****************************************************************************
function explodeArray(item,delimiter) {
  tempArray=new Array(1);
  var Count=0;
  var tempString=new String(item);

  while (tempString.indexOf(delimiter)>0) {
    tempArray[Count]=tempString.substr(0,tempString.indexOf(delimiter));
    tempString=tempString.substr(tempString.indexOf(delimiter)+1,tempString.length-tempString.indexOf(delimiter)+1); 
    Count=Count+1
  }

  tempArray[Count]=tempString;
  return tempArray;
}

//****************************************************************************
// Function Name: openHelpWindow
// Purpose      : Open a pop-up window displaying a help content 
// Processing   : Function is called on clicking the help icon.
// Parameter    : 
// Return Value : true/false
//****************************************************************************
function openHelpWindow(page) {
	mw = page;
    mywin=window.open(mw,'a','scrollbars=yes,dependent=yes,toolbar=no,resizable=yes,width=560,height=330, top=100, left=250');
    mywin.focus();
    return false;
}

//****************************************************************************
// Function Name: verifyIP
// Purpose      : Checks whether the entered IP Address is Valid
// Processing   : Function is called on validating the form.
// Parameter    : 
// Return Value : true/false
//****************************************************************************
function verifyIP (IPvalue) {
	errorString = "";
	theName = "IPaddress";

	var ipPattern = /^(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})$/;
	var ipArray = IPvalue.match(ipPattern); 

	if (IPvalue == "0.0.0.0") {
		//errorString = errorString + theName + ': '+IPvalue+' is a special IP address and cannot be used here.';
		errorString = IPvalue+' is a special IP address and cannot be used here.';
	}
	else if (IPvalue == "255.255.255.255") {
		//errorString = errorString + theName + ': '+IPvalue+' is a special IP address and cannot be used here.';
		errorString = IPvalue+' is a special IP address and cannot be used here.';
	}
	if (ipArray == null) {
		//errorString = errorString + theName + ': '+IPvalue+' is not a valid IP address.';
		errorString = IPvalue+' is not a valid IP Address.';
	}
	else {
		for (i = 0; i < 4; i++) {
			thisSegment = ipArray[i];
			if (thisSegment > 255) {
				//errorString = errorString + theName + ': '+IPvalue+' is not a valid IP address.';
				errorString = +IPvalue+' is not a valid IP Address.';
				i = 4;
			}
			if ((i == 0) && (thisSegment > 255)) {
				//errorString = errorString + theName + ': '+IPvalue+' is a special IP address and cannot be used here.';
				errorString = IPvalue+' is a special IP Address and cannot be used here.';
				i = 4;
      		}
   		}
	}

	extensionLength = 3;
	if (errorString == "") {
		//alert ("That is a valid IP address.");
		return true;
	}
	else {
		alert (errorString);
		document.switches.switch_ip_addr.focus();
		document.switches.switch_ip_addr.select();
		return false;
	}
}

function isAlphanumeric (s)

{   var i;
    var letterCnt=0;
    var digitCnt=0;

    // Search through string's characters one by one
    // until we find a non-alphanumeric character.
    // When we do, return false; if we don't, return true.

    for (i = 0; i < s.length; i++)
    {   
        // Check that current character is number or letter.
        var c = s.charAt(i);

        if (! (isLetter(c) || isDigit(c) ) ) {
            return false;
        }
        if (isLetter(c)) {
            letterCnt++;
        }
        if (isDigit(c)) {
            digitCnt++;
        }
    }
    if (!(letterCnt > 0 && digitCnt > 0))
        return false;

    // All characters are numbers or letters.
    return true;
}

function isLetter (c)
{   return ( ((c >= "a") && (c <= "z")) || ((c >= "A") && (c <= "Z")) )
}

function isDigit (c)
{   return ((c >= "0") && (c <= "9"))
}

function ssnExp1(data) {
    return /^\d{2}:\d{2}$/.test(data);
}