<?
/**** Declare Variables ****/
if(!isset($_REQUEST['submit1'])) {
    $_REQUEST['submit1']=''; 
}
if (!isset($duplicate))
	$duplicate='';
if (!isset($countryName))
	$countryName='';
if (!isset($countryId))
	$countryId=0;
if (!isset($countryCode))
	$countryCode=0;
if (!isset($regularRates))
	$regularRates=0;
if (!isset($preferredRates))
	$preferredRates=0;

$countryName=trim($_REQUEST['countryName']);
$countryCode=trim($_REQUEST['countryCode']);

if ($_REQUEST['submit1']=='Submit')
{
	$query = "SELECT * FROM tbl_country_corp WHERE country_name='$countryName' AND country_id!='".$_REQUEST['countryId']."'";
	//echo $query;exit;
	$obj->query($query);
	if ($obj->num_rows()>0)
	{
		$duplicate="duplicate";
	}
	else
	{
		if ($_REQUEST['condition']=='Add')
		{
			$query="INSERT INTO tbl_country_corp (country_code, country_name, rates, preferred_rates) VALUES ('$countryCode','$countryName', '".$_REQUEST['regularRates']."', '".$_REQUEST['preferredRates']."')";
			//echo $query;exit;
			$obj->query($query);?>
			<SCRIPT language="javascript">
            	alert("Record Added Successfully");
            	window.parent.location.href="index.php";
        	</SCRIPT>
		<?}

		if ($_REQUEST['condition']=='Modify')
		{
			$query="UPDATE tbl_country_corp SET country_code='$countryCode', country_name='$countryName', rates='".$_REQUEST['regularRates']."', preferred_rates='".$_REQUEST['preferredRates']."' WHERE country_id='".$_REQUEST['countryId']."'";
            //echo $query;exit;
			$obj->query($query);?>
			<SCRIPT language="javascript">
            	alert("Record Modified Successfully");
            	window.parent.location.href="index.php";
        	</SCRIPT>
		<?}
	}

	if ($_REQUEST['condition']=='Delete')
	{
		$query="DELETE FROM tbl_country_corp WHERE country_id='".$_REQUEST['countryId']."'";
		//echo $query;
		$obj->query($query);
		
		$query="DELETE FROM tbl_city WHERE country_id='".$_REQUEST['countryId']."'";
		//echo $query;exit;
		$obj->query($query);?>		
		<SCRIPT language="javascript">
	    	alert("Record Deleted Successfully");
	    	window.parent.location.href="index.php";
		</SCRIPT>
	<?}
}
$countryName=stripslashes(htmlentities($_REQUEST['countryName']));
?>

<SCRIPT language="javascript">
function so()
{	if(document.add_country.countryId[document.add_country.countryId.selectedIndex].value==0)
	{
		alert("Please select a Country");
		document.add_country.elements[0].focus();
		return false;
	}

	return true;
}

function change()
{
	if (document.add_country.condition.value!='Delete')
		document.add_country.submit();
	return true;
}
/*Function To Validate The Form*/
function validate()
{
	if (document.add_country.condition.value!='Add' && (!so()) )
		return false;

	if (document.add_country.condition.value=='Add' || document.add_country.condition.value=='Modify')
	{
		if(!isEmpty(document.add_country.countryName,"Country Name"))
			return false;
			
		if(!isEmpty(document.add_country.countryCode,"Country Code"))
			return false;
		
		if (!isNumber(document.add_country.countryCode.value))
    	{
    		alert("Please enter a numeric value for Country Code");
    		document.add_country.countryCode.focus();
    		document.add_country.countryCode.select();
    		return false;
    	}
				
		if(!isEmpty(document.add_country.regularRates,"Regular Rates"))
			return false;
	}
	return true;
}

function setfocus()
{
document.add_country.elements[0].focus();
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
	    	<td align="left" valign="top" bgcolor="#FFFFFF" class="pagetitle">Add Country Data<br/>
	    		<img src="<?echo TITLE_SEPERATOR_IMAGE?>"/>
	    	</td>
	    </tr>
	    <tr>
	    	<td height="15" bgcolor="#FFFFFF"></td>
	    </tr>
	    <tr>
	    	<td align="left" valign="top" bgcolor="#FFFFFF" class="text">
	    		<FORM name="add_country" method="POST" action="country.php">
				<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center">
				  <!-- Form Fields - Personal Data -->
				<tr>
					<td colspan="2" align="center" class="bodycontents"><div align="center">
					<?
						if ($duplicate=='duplicate')
							echo "<br><strong><span class=red>***</strong><i>An Entry already exists</i></font><br><br>";
						if($inv_photo&2) {
							echo "<span class=red>*** Error Occured Inserting Data.</span><br>";
						}?></div>
					</td>
				</tr>
				
				<tr>
					<td height="15px" colspan="2"></td>
				</tr>
				
				<tr>
					<td height="15px" colspan="2" class="bodycontents"><b>Items marked * are Mandatory</b></td>
				</tr>
				<tr>
					<td height="5px" colspan="2"></td>
				</tr>
				
				<tr>
					<td colspan="2">
						<table border=0 cellpadding=2 cellspacing=1 class="signupConfirmOrder" align="center">
						<tr class="bodycontents">
							<td width='20%' class="compareHead">* Country Name</td>
							<td width='10%' class="compareNormalLeft"><input type="text" name="countryName" value="<?echo $countryName;?>" maxlength="50"></td>
						</tr>
						<tr bgcolor="White">
							<td class="compareHead"><b>* Country Code</b></td>
							<td class="compareNormalLeft"><input type="text" name="countryCode" value="<?echo $countryCode;?>" maxlength="5"></td>
						</tr>
						
						<tr bgcolor="White">
							<td class="compareHead"><b>* Regular Rates</b></td>
							<td class="compareNormalLeft" colspan="4">
								<input type="text" name="regularRates" value="<?echo $regularRates;?>" maxlength="7">
							</td>
						</tr>
						</table>
					</td>
				</tr>
			  	</table>
			  	
				<br>
				<table border="0" cellspacing="0" cellpadding="0" width="100%" align="center" class="bodycontents">
				<tr>
					<td align="center">
						<input type="submit" name="submit1" class="submitButton" value="Submit" onClick='return validate();'/>&nbsp;&nbsp;<input type="reset" class="submitButton" name="reset" value="Reset"/>
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