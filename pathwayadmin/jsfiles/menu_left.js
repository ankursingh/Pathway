function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

// Menu roll up & roll down function
function Rolling(thediv, span1, span2)
	{
		if (document.getElementById(thediv).style.display == "none")
		{
			if (span1 != null && span1 != "")
			{
				document.getElementById(span2).style.display = "block";
				document.getElementById(span1).style.display = "none";
			}
			document.getElementById(thediv).style.display = "block";
		}
		else
		{
			if (span1 != null && span1 != "")
			{
				document.getElementById(span1).style.display = "block";
				document.getElementById(span2).style.display = "none";
			}
			document.getElementById(thediv).style.display = "none";
		}
		
		return false;
	}


function Rolling1(event, thediv, span1, span2, arrow1)
	{
		if ((event.which == "9") || (event.keyCode == "9"))
		{
		document.getElementById(thediv).blur();
		//document.getElementById(thediv.concat("_link_id2")).focus();
		//alert("You pressed the TAB key");
		} 
		else
		{
			if (document.getElementById(thediv).style.display == "none")
			{
				if (span1 != null && span1 != "")
				{
					document.getElementById(span2).style.display = "block";
					document.getElementById(span1).style.display = "none";
				}
				document.getElementById(thediv).style.display = "block";
				document.getElementById(thediv.concat("_link_id1")).focus();
				document.getElementById(arrow1).src='/images/menu/arrow02.gif';
				//alert("IF");
			}
			else
			{
				if (span1 != null && span1 != "")
				{
					document.getElementById(span1).style.display = "block";
					document.getElementById(span2).style.display = "none";
				}
				document.getElementById(thediv).style.display = "none";
				document.getElementById(thediv.concat("_link_id2")).focus();
				document.getElementById(arrow1).src='/images/menu/arrow01.gif';
				//alert("ELSE");
			}
			return false;
		}
	}

function Rolling2(event, thediv, span1, span2)
	{
		if ((event.which == "9") || (event.keyCode == "9"))
		{
		document.getElementById(thediv).blur();
		//document.getElementById(thediv.concat("_link_id2")).focus();
		//alert("You pressed the TAB key");
		} 
		else
		{
			if (document.getElementById(thediv).style.display == "none")
			{
				if (span1 != null && span1 != "")
				{
					document.getElementById(span2).style.display = "block";
					document.getElementById(span1).style.display = "none";
				}
				document.getElementById(thediv).style.display = "block";
				document.getElementById(thediv.concat("_link_id1")).focus();
			}
			else
			{
				if (span1 != null && span1 != "")
				{
					document.getElementById(span1).style.display = "block";
					document.getElementById(span2).style.display = "none";
				}
				document.getElementById(thediv).style.display = "none";
				document.getElementById(thediv.concat("_link_id2")).focus();
			}
			return false;
		}
	}
