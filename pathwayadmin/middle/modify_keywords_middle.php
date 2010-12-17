<?
if (!isset($duplicate))
	$duplicate='n';
if ($_REQUEST['submit1'] == "Update") {

	$query = "SELECT * FROM tbl_search WHERE upper(trim(search_page_url)) like'".strtoupper(trim($_REQUEST['searchPageURL']))."' AND search_id !='".$_REQUEST['search_id']."'";
	$obj->query($query);
	if ($obj->num_rows()>0)
		$duplicate = 'y';
	else
	{
	    $query = "UPDATE tbl_search SET search_page_url='".trim(strtolower($_REQUEST['searchPageURL']))."', search_title='".trim(ucwords($_REQUEST['searchTitle']))."', search_title_fr='".trim(ucwords($_REQUEST['searchTitle']))."', search_keyword='".trim(ucwords($_REQUEST['searchKeyword']))."', search_keyword_fr='".trim(ucwords($_REQUEST['searchKeywordFrench']))."', search_description= '".trim($_REQUEST['searchDesc'])."', search_description_fr= '".trim($_REQUEST['searchDescFrench'])."', search_status='".$_REQUEST['searchStatus']."' WHERE search_id='".$_REQUEST['search_id']."'"; 
	    $obj->query($query);
	?>
	    <SCRIPT language="javascript">
		   alert("Record Modified Successfully");
	       window.location.href="keywords.php?condition=Modify";
		</SCRIPT>
<?	}
}

if ($_REQUEST['condition']=="Modify" && $_REQUEST['search_id']!="" && $_REQUEST['search_id']>0 && $duplicate!="y") {
	
    $query = "SELECT * FROM tbl_search WHERE search_id='".$_REQUEST['search_id']."'";
    //echo $query;
    $obj->query($query);
	if ($obj->num_rows()>0)
	{
        $obj->next_record();	    
    	$searchPageURL = trim($obj->f('search_page_url'));
		$searchTitle = trim($obj->f('search_title'));
		$searchTitleFrench = trim($obj->f('search_title_fr'));
		$searchKeyword = trim($obj->f('search_keyword'));
		$searchKeywordFrench = trim($obj->f('search_keyword_fr'));
		$searchDesc = trim($obj->f('search_description'));
		$searchDescFrench = trim($obj->f('search_description_fr'));
		$searchStatus = trim($obj->f('search_status'));
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
	    	<td align="left" valign="top" bgcolor="#FFFFFF" class="pagetitle"><?echo $_REQUEST['condition']?> Search Keywords<br/>
	    		<img src="<?echo TITLE_SEPERATOR_IMAGE?>"/>
	    	</td>
	    </tr>
	    <tr>
	    	<td height="15" bgcolor="#FFFFFF"></td>
	    </tr>
	    <tr>
	    	<td align="left" valign="top" bgcolor="#FFFFFF" class="text">
	    		<FORM name="add_keywords" method="POST" action="modify_keywords.php">
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
							<?if ($searchStatus=="")
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
						<input type="submit" class="submitButton" name="submit1" value="<?echo $submitname?>"  onClick='return validate();'/>&nbsp;&nbsp;<input type="reset" class="submitButton" name="reset" value="Reset"/>
				  	</td>
			  	</tr>
			  	</table>  
				  
				<input type="hidden" name="condition" value ="<?echo $_REQUEST['condition']?>">
				<input type="hidden" name="search_id" value ="<?echo $_REQUEST['search_id']?>">
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