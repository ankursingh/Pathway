<?
if (!isset($duplicate))
	$duplicate='n';
if ($_REQUEST['submit1'] == "Update") {

	$query = "SELECT * FROM tbl_news_article WHERE upper(trim(news_article_desc)) like'".strtoupper(trim($_REQUEST['news_article_desc']))."' AND news_article_id !='".$_REQUEST['article_id']."'";
	$obj->query($query);
	if ($obj->num_rows()>0)
		$duplicate = 'y';
	else
	{
		$expiry_date=trim($_REQUEST['news_expiry_date']);
		if ($expiry_date!="")
			$expiryDate = $expiry_date;
		else 
			$expiryDate = "";
			
	    $query = "UPDATE tbl_news_article SET news_article_title='".trim(ucwords($_REQUEST['news_article_title']))."', news_article_desc= '".trim($_REQUEST['news_article_desc'])."', news_article_source='".$_REQUEST['news_article_source']."', news_article_flag='".$_REQUEST['news_article_flag']."', expiry_date='$expiryDate', date_modified=now() WHERE news_article_id='".$_REQUEST['article_id']."'"; 
	    //echo $query;exit;
	    $obj->query($query);
	?>
	    <SCRIPT language="javascript">
		   alert("Record Modified Successfully");
	       window.location.href="news_select.php?condition=Modify";
		</SCRIPT>
<?	}
}

if ($_REQUEST['condition']=="Modify" && $_REQUEST['article_id']!="" && $_REQUEST['article_id']>0 && $duplicate!="y") {
	
    $query = "SELECT * FROM tbl_news_article WHERE news_article_id='".$_REQUEST['article_id']."'";
    //echo $query;
    $obj->query($query);
	if ($obj->num_rows()>0)
	{
        $obj->next_record();	    
    	$news_article_title=trim($obj->f('news_article_title'));
		$news_article_desc=trim($obj->f('news_article_desc'));
		$news_article_source=trim($obj->f('news_article_source'));
		$news_article_flag=trim($obj->f('news_article_flag'));
		$news_expiry_date=trim($obj->f('expiry_date'));
		if ($news_expiry_date=="0000-00-00 00:00:00")
			$news_expiry_date="";
    }
    else {?>
        <SCRIPT language="javascript">
           alert("Invalid Access");
	       window.parent.location.href="index.php";
	   </SCRIPT>
<?    }
}
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

		//cntfield.innerHTML = maxlimit - field.value.length;
		temp_field = stripHTML(field);
		cntfield.innerHTML = maxlimit - temp_field.length;
	}
}

function chkRemLength(field, cntfield, maxlimit) {
	
	//cntfield.innerHTML = maxlimit - field.value.length;
	temp_field = stripHTML(field);
	cntfield.innerHTML = maxlimit - temp_field.length;
}

/*Function To Validate The Form*/
function validate()
{
	frm = document.modify_news;
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

			// If News Article Source is not entered.		
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
	    	<td align="left" valign="top" bgcolor="#FFFFFF" class="pagetitle"><?echo $_REQUEST['condition']?> Search Keywords<br/>
	    		<img src="<?echo TITLE_SEPERATOR_IMAGE?>"/>
	    	</td>
	    </tr>
	    <tr>
	    	<td height="15" bgcolor="#FFFFFF"></td>
	    </tr>
	    <tr>
	    	<td align="left" valign="top" bgcolor="#FFFFFF" class="text">
	    		<FORM name="modify_news" method="POST" action="modify_news.php">
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
						<INPUT type="text" name="news_article_title" value="<?echo $news_article_title?>" size="43" maxlength="150">
					</td>
				</tr>
				
				<tr>
					<td width="35%" height="25px" class="bodycontents" ><font color="Red">*</font> <b>News Article Description</b></td>
					<td height="25px">&nbsp;
						<!--TEXTAREA name="news_article_desc" cols="40" rows="10" wrap="physical" onKeyDown="textCounter(document.modify_news.news_article_desc,document.getElementById('remChars'),350)" onKeyUp="textCounter(document.modify_news.news_article_desc,document.getElementById('remChars'),350)"><?echo $news_article_desc?></TEXTAREA-->
						<TEXTAREA name="news_article_desc" cols="40" rows="10" wrap="physical" onKeyUp="textCounter(document.modify_news.news_article_desc,document.getElementById('remChars'),350)"><?echo $news_article_desc?></TEXTAREA>
					</td>
				</tr>
				
				<tr>
					<td width="35%" height="25px" class="bodycontents" ></td>
					<td height="25px" class="bodycontents">&nbsp;
						<b><span id="remChars"></span></b> Characters Left
					</td>
				</tr>
				
				<tr>
					<td width="35%" height="25px" class="bodycontents" ><font color="Red">*</font> <b>News Article Source</b></td>
					<td height="25px">&nbsp;
						<INPUT type="text" name="news_article_source" value="<?echo $news_article_source?>" size="20" maxlength="50">
					</td>
				</tr>
				
				<tr>
					<td width="35%" height="25px" class="bodycontents" >&nbsp;&nbsp;<b>News Expiry Date</b></td>
					<td height="25px">&nbsp;
						<INPUT type="text" name="news_expiry_date" value="<?echo $news_expiry_date?>" size="20" maxlength="50">
						&nbsp;<a href="javascript:cal2.popup();"><img src="/images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the date" align="absmiddle"></a>
					</td>
				</tr>
				
				<tr>
					<td width="35%" height="25px" class="bodycontents" ><font color="Red">*</font> <b>News Article Flag</b></td>
					<td height="25px">&nbsp;
						<select name="news_article_flag">
	        				<?if ($news_article_flag== "") {?>
	        					<option value="" selected></option>
	        				<?}
	        				else {?>
	        					<option value=""></option>
	        				<?}
			                if ($news_article_flag=="A") {
			                  echo "<option selected value='A'>Active</option>";
			                }
			                else {
	    		                echo "<option value='A'>Active</option>";
			                }
			                if ($news_article_flag=="I") {
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
						<input type="submit" class="submitButton" name="submit1" value="<?echo $submitname?>"  onClick='return validate();'/>&nbsp;&nbsp;<input type="reset" class="submitButton" name="reset" value="Reset" onblur="chkRemLength(document.modify_news.news_article_desc,document.getElementById('remChars'),350);"/>
				  	</td>
			  	</tr>
			  	</table>  
				  <script language="JavaScript">
					var cal2 = new calendar3(document.forms['modify_news'].elements['news_expiry_date']);
					cal2.year_scroll = false;
					cal2.time_comp = true;
				</script>
				<input type="hidden" name="condition" value ="<?echo $_REQUEST['condition']?>">
				<input type="hidden" name="article_id" value ="<?echo $_REQUEST['article_id']?>">
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