<?
//****************************************************************************
// Redirect to "index" page, if no condition is specified.
//**************************************************************************** 
if (!isset($_REQUEST['condition'])) {?>
    <SCRIPT language="javascript">
	   window.location.href="index.php";
	</SCRIPT>
<?}

//****************************************************************************
// Declare Variables 
//****************************************************************************
if (!isset($_REQUEST['submit1'])) {
	$submit1='';
}
if (!isset($_REQUEST['act'])) {
	$_REQUEST['act']='';
}
if (!isset($_REQUEST['news_cat_id'])) {
	$_REQUEST['news_cat_id']="0";
}
if (!isset($_REQUEST['news_article_title'])) {
	$_REQUEST['news_article_title']="";
}
if (!isset($_REQUEST['news_article_desc'])) {
	$_REQUEST['news_article_desc']="";
}
if (!isset($_REQUEST['news_article_source'])) {
	$_REQUEST['news_article_source']="";
}
if (!isset($_REQUEST['news_article_flag'])) {
	$news_article_flag="I";
}
if (!isset($_REQUEST['news_article_id'])) {
	$_REQUEST['news_article_id']="0";
}
 
//****************************************************************************
// Remove white spaces from the values
//****************************************************************************
$news_article_title=trim($_REQUEST['news_article_title']);
$news_article_desc=trim($_REQUEST['news_article_desc']);
$news_article_source=trim($_REQUEST['news_article_source']);

//****************************************************************************
// If the "Submit" button is clicked, do the following.
//****************************************************************************
if ($_REQUEST['submit1']=='Submit') {
	
	//****************************************************************************
	// Execute the query 
	//****************************************************************************
	//$query = "SELECT * FROM news_article WHERE news_article_title = '".$_REQUEST['news_article_title']."'" ." AND news_article_id!='".$_REQUEST['news_article_id']."'";
	$query = "SELECT * FROM tbl_news_article WHERE news_article_desc = '".$_REQUEST['news_article_desc']."'" ." AND news_article_id!='".$_REQUEST['news_article_id']."'";
	//echo $query;
	$obj->query($query);

	//****************************************************************************	
	// If the record already exists, set the value as "duplicate" 
	//****************************************************************************
	if ($obj->num_rows() > 0) {
		$act="duplicate";
	}
    else {
    	
    	//****************************************************************************
    	// If the condition is "Add", insert the record in the database.
    	//****************************************************************************
    	if ($_REQUEST['condition']=='Add') {
    		$expiry_date=trim($_REQUEST['news_expiry_date']);
    		if ($expiry_date!="")
    			$expiryDate = $expiry_date;
			else 
    			$expiryDate = "";

    		$query="INSERT INTO tbl_news_article (news_article_id, news_article_title, news_article_desc, news_article_source, news_article_flag, expiry_date, date)" .
            " VALUES ('', '".$_REQUEST['news_article_title']."', '".$_REQUEST['news_article_desc']."', '".$_REQUEST['news_article_source']."', '".$_REQUEST['news_article_flag']."', '$expiryDate', now())";
			$obj->query($query);
			
			//****************************************************************************
			// Redirect the page to the Admin home page.
			//****************************************************************************
			?>
		    <SCRIPT language="javascript">
		       alert("Record Added Successfully");
	           window.location.href="index.php";
	        </SCRIPT>
		<?}
	}
}

$news_article_title=stripslashes(htmlentities($_REQUEST['news_article_title']));
$news_article_desc=stripslashes(htmlentities($_REQUEST['news_article_desc']));
$news_article_source=stripslashes(htmlentities($_REQUEST['news_article_source']));
?>

<SCRIPT language="javascript">

function stripHTML(field){
	var newString= field.value;
	
	var re= /<\S[^><]*>/g
	for (i=0; i<newString.length; i++)
		newString=field.value.replace(re, "")

	return newString;
}

function textCounter(field,cntfield,maxlimit) {
	
	if (field.value.length > maxlimit) { // if too long...trim it!
		//field.value = field.value.substring(0, maxlimit);
		temp_field = stripHTML(field);
		cntfield.innerHTML = maxlimit - temp_field.length;
	}
	else { // otherwise, update 'characters left' counter

		temp_field = stripHTML(field);
		cntfield.innerHTML = maxlimit - temp_field.length;
		
	}
	//temp_field = stripHTML(field);
	//alert(temp_field);
}

/*Function To Validate The Form*/
function validate()
{
	frm = document.add_news;
    try {
    	var retVal = false;
        while(1) {
        	
			// If News Article Title is not entered.		
			if(!isEmpty(frm.news_article_title, "News Article Title")) {
				break;
			}

			// If News Article Desc is not entered.		
			if(!isEmpty(frm.news_article_desc, "News Article Description")) {
				break;
			}
			
			// If News Article Desc is not entered.		
			if(!isEmpty(frm.news_article_source, "News Article Source")) {
				break;
			}

			// If News Article Flag is not selected.
        	if (frm.news_article_flag[frm.news_article_flag.selectedIndex].value == "") {
        		alert("Select News Article Flag");
        		frm.news_article_flag.focus();
        		break;
        	}

            retVal = true;
            break;
		}
    }
	catch(e) {
    	retVal = false;
	}
    return retVal;
}
</SCRIPT>

<table width="95%" border="0" cellpadding="0" cellspacing="0">
<tr>
	<td align="left" valign="top"><table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="left" valign="top"><img src="/images/innertab/tab_bg_01.gif" alt=""/></td>
        <td align="left" valign="top" background="/images/innertab/tab_bg_02.gif" style="padding-top:5px" class="bodycontents"><b><?echo SEARCH_RESULTS_PATHWAY_COMMUNICATIONS?></b></td>
        <td align="right" valign="top"><img src="/images/innertab/tab_bg_03.gif" alt="" /></td>
      </tr>
    </table></td>
</tr>
<tr>
	<td background="/images/innertab/bg_03.gif" style="background-repeat:no-repeat; padding-left:10px">&nbsp;</td>
</tr>
<tr>
	<td background="/images/innertab/bg_04.gif" style="background-repeat:repeat-y; padding-left:12px">
	<!--page content here/-->
	    <table width="95%" border="0" cellpadding="0" cellspacing="0">
	    <tr>
	    	<td align="left" valign="top" bgcolor="#FFFFFF" class="pagetitle">Add News Articles<br/>
	    		<img src="<?echo TITLE_SEPERATOR_IMAGE?>"/>
	    	</td>
	    </tr>
	    <tr>
	    	<td height="15" bgcolor="#FFFFFF"></td>
	    </tr>
	    <tr>
	    	<td align="left" valign="top" bgcolor="#FFFFFF" class="text">
	    		<FORM name="add_news" method="POST" action="news.php">
				<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center">
				  <!-- Form Fields - Personal Data -->
				<tr>
					<td colspan="2" align="center" class="bodycontents"><div align="center">
					<?
						if ($duplicate=='y')
							echo "<br><strong><span class=red>***</strong><i>An Entry already exists</i></font><br><br>";
						if($inv_photo&2) {
							echo "<span class=red>*** Error Occured Inserting Data.</span><br>";
						}  
					?></div>
					</td>
				</tr>
				    
				<tr>
					<td height="15px" colspan="2" class="bodycontents"><b>Items marked * are Mandatory</b></td>
				</tr>
				
				<tr>
					<td height="15px" colspan="2"></td>
				</tr>
				
				<tr>
					<td width="35%" height="25px" class="bodycontents" ><font color="Red">*</font> <b>News Article Title</b></td>
					<td height="25px">&nbsp;
						<INPUT type="text" name="news_article_title" value="<?echo $_REQUEST['news_article_title']?>" size="50" maxlength="150">
					</td>
				</tr>
				
				<tr>
					<td width="35%" height="25px" class="bodycontents" ><font color="Red">*</font> <b>News Article Description</b></td>
					<td height="25px">&nbsp;
						<!--TEXTAREA name="news_article_desc" cols="40" rows="10" wrap="physical" onChange="textCounter(document.add_news.news_article_desc,document.getElementById('remChars'),400)" onKeyUp="textCounter(document.add_news.news_article_desc,document.getElementById('remChars'),400)"><?echo $_REQUEST['news_article_desc']?></TEXTAREA-->
						<TEXTAREA name="news_article_desc" cols="40" rows="10" wrap="physical" onKeyUp="textCounter(document.add_news.news_article_desc,document.getElementById('remChars'),350)"><?echo $_REQUEST['news_article_desc']?></TEXTAREA>
					</td>
				</tr>
				
				<tr>
					<td width="35%" height="25px" class="bodycontents" ></td>
					<td height="25px" class="bodycontents">&nbsp;
						<b><span id="remChars">350</span></b> Characters Left
					</td>
				</tr>
				
				<tr>
					<td width="35%" height="25px" class="bodycontents" ><font color="Red">*</font> <b>News Article Source</b></td>
					<td height="25px">&nbsp;
						<INPUT type="text" name="news_article_source" value="<?echo $_REQUEST['news_article_source']?>" size="20" maxlength="50">
					</td>
				</tr>
				
				<tr>
					<td width="35%" height="25px" class="bodycontents" >&nbsp;&nbsp;<b>News Expiry Date</b></td>
					<td height="25px">&nbsp;
						<INPUT type="text" name="news_expiry_date" value="<?echo $_REQUEST['news_expiry_date']?>" size="20" maxlength="50">
						&nbsp;<a href="javascript:cal2.popup();"><img src="/images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the date" align="absmiddle"></a>
					</td>
				</tr>
				
				<tr>
					<td width="35%" height="25px" class="bodycontents" ><font color="Red">*</font> <b>News Article Flag</b></td>
					<td height="25px">&nbsp;
						<select name="news_article_flag">
	        				<?if ($_REQUEST['news_article_flag']== "") {?>
	        					<option value="" selected></option>
	        				<?}
	        				else {?>
	        					<option value=""></option>
	        				<?}
			                if ($_REQUEST['news_article_flag']=="A") {
			                  echo "<option selected value='A'>Active</option>";
			                }
			                else {
	    		                echo "<option value='A'>Active</option>";
			                }
			                if ($_REQUEST['news_article_flag']=="I") {
			                  echo "<option selected value='I'>Inactive</option>";
			                }
			                else {
	    		                echo "<option value='I'>Inactive</option>";
			                }?>
	        			</select>
					</td>
				</tr>
			  	</table>
				<br>
				<table border="0" cellspacing="0" cellpadding="0" width="100%" align="center" class="bodycontents">
				<tr>
					<td align="center">
						<input type="submit" name="submit1" class="submitButton" value="<?echo $submitname?>"  onClick='return validate();'/>&nbsp;&nbsp;<input type="reset" class="submitButton" name="reset" value="Reset"/>
				  	</td>
			  	</tr>
			  	</table>  
				<script language="JavaScript">
					var cal2 = new calendar3(document.forms['add_news'].elements['news_expiry_date']);
					cal2.year_scroll = false;
					cal2.time_comp = true;
				</script>
				  
				<input type="hidden" name="condition" value ="<?echo $_REQUEST['condition']?>">
				</FORM>
	    	</td>
	    </tr>
		<tr>
			<td align="left" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td background="/images/innertab/bg_05.gif" style="background-repeat:no-repeat">&nbsp</td>
</tr>        
</table>