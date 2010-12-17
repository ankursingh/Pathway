<?
if(!isset($_REQUEST['submit1'])) {
    $_REQUEST['submit1']=''; 
}
if (!isset($duplicate))
	$duplicate='n';

if ($_REQUEST['submit1'] == "Submit") {

    // Insert the Records in "users" table.
    $query = "SELECT * FROM tbl_search WHERE upper(trim(search_page_url)) like'".strtoupper(trim($_REQUEST['searchPageURL']))."'";
	$obj->query($query);
	if ($obj->num_rows()>0)
		$duplicate = 'y';
	else
	{
	    $query = "INSERT INTO tbl_search (search_page_url, search_title, search_title_fr, search_keyword, search_keyword_fr, search_description, search_description_fr, search_status) VALUES ('".strtolower(trim($_REQUEST['searchPageURL']))."', '".ucwords(addslashes(trim($_REQUEST['searchTitle'])))."', '".ucwords(addslashes(trim($_REQUEST['searchTitleFrench'])))."', '".ucwords(addslashes(trim($_REQUEST['searchKeyword'])))."', '".ucwords(addslashes(trim($_REQUEST['searchKeywordFrench'])))."', '".ucwords(addslashes(trim($_REQUEST['searchDesc'])))."', '".ucwords(addslashes(trim($_REQUEST['searchDescFrench'])))."', '".$_REQUEST['searchStatus']."')";
	    //echo $query;exit;
        $obj->query($query);?>
        <SCRIPT language="javascript">
            alert("Record Added Successfully");
            window.parent.location.href="index.php";
        </SCRIPT>
	<?}
}

if ($_REQUEST['condition']=='Modify')
	$submitname="Update";
else
	$submitname="Submit";
?>

<SCRIPT language="javascript">

/*Function To Validate The Form*/
function validate()
{
	if(!isEmpty(document.add_keywords.searchPageURL,"Search Page URL")) {
		return false;
	}

	if(!isEmpty(document.add_keywords.searchTitle,"Search Title (English)")) {
		return false;
	}

	if(!isEmpty(document.add_keywords.searchTitleFrench,"Search Title (French)")) {
		return false;
	}

	if(!isEmpty(document.add_keywords.searchKeyword,"Search Keywords (English)")) {
		return false;
	}

	if(!isEmpty(document.add_keywords.searchKeywordFrench,"Search Keywords (French)")) {
		return false;
	}

	if(!isEmpty(document.add_keywords.searchDesc,"Search Description (English)")) {
		return false;
	}

	if(!isEmpty(document.add_keywords.searchDescFrench,"Search Description (French)")) {
		return false;
	}
	
	//Status
	if (document.add_keywords.searchStatus[document.add_keywords.searchStatus.selectedIndex].value=="") {
	    alert("Select Search Keyword Status");
	    document.add_keywords.searchStatus.focus();
	    return false;
	}
	return true;
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
	    	<td align="left" valign="top" bgcolor="#FFFFFF" class="pagetitle">Add Search Keywords<br/>
	    		<img src="<?echo TITLE_SEPERATOR_IMAGE?>"/>
	    	</td>
	    </tr>
	    <tr>
	    	<td height="15" bgcolor="#FFFFFF"></td>
	    </tr>
	    <tr>
	    	<td align="left" valign="top" bgcolor="#FFFFFF" class="text">
	    		<FORM name="add_keywords" method="POST" action="add_keywords.php">
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
					<td width="35%" height="25px" class="bodycontents" ><font color="Red">*</font> <b>Search Page URL</b></td>
					<td height="25px">&nbsp;
						<input type="text" name="searchPageURL" value="<?php echo $searchPageURL?>" size="51" maxlength="255"/>
					</td>
				</tr>
				
				<tr>
					<td width="35%" height="25px" class="bodycontents" ><font color="Red">*</font> <b>Search Title (English)</b></td>
					<td height="25px">&nbsp;
						<input type="text" name="searchTitle" value="<?php echo $searchTitle?>" size="51" maxlength="255"/>
					</td>
				</tr>
				
				<tr>
					<td width="35%" height="25px" class="bodycontents" ><font color="Red">*</font> <b>Search Title (French)</b></td>
					<td height="25px">&nbsp;
						<input type="text" name="searchTitleFrench" value="<?php echo $searchTitleFrench?>" size="51" maxlength="255"/>
					</td>
				</tr>
				
				<tr>
					<td width="35%" height="25px" class="bodycontents" ><font color="Red">*</font> <b>Search Keywords (English)</b></td>
					<td height="25px">&nbsp;
						<TEXTAREA name="searchKeyword" cols="50" rows="6"><?php echo $searchKeyword?></TEXTAREA>
					</td>
				</tr>
				  
				<tr>
					<td width="35%" height="25px" class="bodycontents" ><font color="Red">*</font> <b>Search Keywords (French)</b></td>
					<td height="25px">&nbsp;
						<TEXTAREA name="searchKeywordFrench" cols="50" rows="6"><?php echo $searchKeywordFrench?></TEXTAREA>
					</td>
				</tr>
				
				<tr>
					<td width="35%" height="25px" class="bodycontents" ><font color="Red">*</font> <b>Search Description (English)</b></td>
					<td height="25px">&nbsp;
						<TEXTAREA name="searchDesc" cols="50" rows="6"><?php echo $searchDesc?></TEXTAREA>
					</td>
				</tr>
				  
				<tr>
					<td width="35%" height="25px" class="bodycontents" ><font color="Red">*</font> <b>Search Description (French)</b></td>
					<td height="25px">&nbsp;
						<TEXTAREA name="searchDescFrench" cols="50" rows="6"><?php echo $searchDescFrench?></TEXTAREA>
					</td>
				</tr>
				  
				<tr>
					<td width="35%" height="25px" class="bodycontents" ><font color="Red">*</font> <b>Search Keyword Status</b></td>
					<td height="25px">&nbsp;
						<select name="searchStatus">
							<?if ($_REQUEST['searchStatus']=="")
								echo "<option value='' selected></option>";
							else
								echo "<option value=''></option>";
					
							if ($searchStatus=="Y")
								echo "<option value='Y' selected>Active</option>";
							else 
								echo "<option value='Y'>Active</option>";
					
							if ($searchStatus=="N")
								echo "<option value='N' selected>Inactive</option>";
							else 
								echo "<option value='N'>Inactive</option>";
							?>
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
				  
				<input type="hidden" name="empty" value ="no">
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