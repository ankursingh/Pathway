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
if (!isset($_REQUEST['rss_feed_url'])) {
	$_REQUEST['rss_feed_url']="";
}
if (!isset($_REQUEST['rss_feed_source'])) {
	$_REQUEST['rss_feed_source']="";
}
if (!isset($_REQUEST['rss_feed_status'])) {
	$rss_feed_status="I";
}
if (!isset($_REQUEST['id'])) {
	$_REQUEST['id']="0";
}
 
//****************************************************************************
// Remove white spaces from the values
//****************************************************************************
$rss_feed_url=trim($_REQUEST['rss_feed_url']);

//****************************************************************************
// If the "Submit" button is clicked, do the following.
//****************************************************************************
if ($_REQUEST['submit1']=='Submit') {
	
	//****************************************************************************
	// Execute the query 
	//****************************************************************************
	$query = "SELECT * FROM tbl_rss_feed WHERE rss_feed_url = '".$_REQUEST['rss_feed_url']."'" ." AND id!='".$_REQUEST['id']."'";
	//echo $query;exit;
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
    		
    		$query="INSERT INTO tbl_rss_feed (id, rss_feed_url, rss_feed_source, rss_feed_status, date)" .
            " VALUES ('', '".$_REQUEST['rss_feed_url']."', '".$_REQUEST['rss_feed_source']."', '".$_REQUEST['rss_feed_status']."', now())";
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

$rss_feed_url=stripslashes(htmlentities($_REQUEST['rss_feed_url']));
?>

<SCRIPT language="javascript">

/*Function To Validate The Form*/
function validate()
{
	frm = document.rssfeed;
    try {
    	var retVal = false;
        while(1) {
        	
			// If RSS Feed Title is not entered.		
			if(!isEmpty(frm.rss_feed_url, "RSS Feed URL")) {
				break;
			}

			// If RSS Feed Source is not entered.		
			if(!isEmpty(frm.rss_feed_source, "RSS Feed Source")) {
				break;
			}

			// If RSS Feed Flag is not selected.
        	if (frm.rss_feed_status[frm.rss_feed_status.selectedIndex].value == "") {
        		alert("Select RSS Feed Status");
        		frm.rss_feed_status.focus();
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
	    	<td align="left" valign="top" bgcolor="#FFFFFF" class="pagetitle">Add RSS Feeds<br/>
	    		<img src="<?echo TITLE_SEPERATOR_IMAGE?>"/>
	    	</td>
	    </tr>
	    <tr>
	    	<td height="15" bgcolor="#FFFFFF"></td>
	    </tr>
	    <tr>
	    	<td align="left" valign="top" bgcolor="#FFFFFF" class="text">
	    		<FORM name="rssfeed" method="POST" action="rssfeed.php">
				<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center">
				  <!-- Form Fields - Personal Data -->
				<tr>
					<td colspan="2" align="center" class="bodycontents"><div align="center">
					<?
						if ($act=='duplicate')
							echo "<br><strong><span class=red>***</strong><i>An Entry already exists</i></font><br><br>";
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
					<td width="35%" height="25px" class="bodycontents" ><font color="Red">*</font> <b>RSS Feed URL</b></td>
					<td height="25px">&nbsp;
						<INPUT type="text" name="rss_feed_url" value="<?echo $_REQUEST['rss_feed_url']?>" size="50" maxlength="255">
					</td>
				</tr>
				
				<tr>
					<td width="35%" height="25px" class="bodycontents" ><font color="Red">*</font> <b>RSS Feed Source</b></td>
					<td height="25px">&nbsp;
						<INPUT type="text" name="rss_feed_source" value="<?echo $_REQUEST['rss_feed_source']?>" size="40" maxlength="50">
					</td>
				</tr>
				
				<tr>
					<td width="35%" height="25px" class="bodycontents" ><font color="Red">*</font> <b>RSS Feed Status</b></td>
					<td height="25px">&nbsp;
						<select name="rss_feed_status">
	        				<?if ($_REQUEST['rss_feed_status']== "") {?>
	        					<option value="" selected></option>
	        				<?}
	        				else {?>
	        					<option value=""></option>
	        				<?}
			                if ($_REQUEST['rss_feed_status']=="A") {
			                  echo "<option selected value='A'>Active</option>";
			                }
			                else {
	    		                echo "<option value='A'>Active</option>";
			                }
			                if ($_REQUEST['rss_feed_status']=="I") {
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