<?
/**** Declare Variables ****/
if(!isset($_REQUEST['submit1'])) {
    $_REQUEST['submit1']=''; 
}
if (!isset($duplicate))
	$duplicate='';
if (!isset($cityName))
	$cityName='';
if (!isset($country_id))
	$country_id=0;
if (!isset($cityCode))
	$cityCode=0;
if (!isset($regularRates))
	$regularRates=0;
$cityName=trim($_REQUEST['cityName']);

$cityCode=trim($_REQUEST['cityCode']);

if ($_REQUEST['submit1']=='Submit')
{
	$query = "SELECT * FROM tbl_city_corp WHERE service_name='$cityName' AND country_id='".$_REQUEST['countryId']."'";
	
	$query=$query." AND city_id!='".$_REQUEST['cityId']."'";
	$obj->query($query);
	if ($obj->num_rows()>0)
	{
		$act="duplicate";
	}
	else
	{
		$query="INSERT INTO tbl_city_corp (service_name, city_name, country_id, rates) VALUES ('$cityName','$cityCode', '".$_REQUEST['countryId']."', '".$_REQUEST['regularRates']."')";
		//echo $query;exit;
		$obj->query($query);?>
		<SCRIPT language="javascript">
        	alert("Record Added Successfully");
        	window.parent.location.href="index.php";
    	</SCRIPT>
	<?
	}
}
$cityName=stripslashes($cityName);
?>

<SCRIPT language="javascript">
function change()
{
	if (document.city.condition.value!='Delete')
		document.city.submit();
	return true;
}

/*Function To Validate The Form*/
function validate()
{
	if (document.city.countryId[document.city.countryId.selectedIndex].value=="0") {
		alert("Please select a Country Name");
		return false;
	}
	
	if(!isEmpty(document.city.cityName,"City Name"))
		return false;
		
	if(!isEmpty(document.city.cityCode,"City Code"))
		return false;
	
	if(!isEmpty(document.city.regularRates,"Regular Rates"))
		return false;
		
	return true;
}

function setfocus()
{
document.city.elements[0].focus();
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
	    	<td align="left" valign="top" bgcolor="#FFFFFF" class="pagetitle">Add City Data<br/>
	    		<img src="<?echo TITLE_SEPERATOR_IMAGE?>"/>
	    	</td>
	    </tr>
	    <tr>
	    	<td height="15" bgcolor="#FFFFFF"></td>
	    </tr>
	    <tr>
	    	<td align="left" valign="top" bgcolor="#FFFFFF" class="text">
	    		<FORM name="city" method="POST" action="city.php">
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
						<?
						$query="SELECT * FROM tbl_country_corp ORDER BY country_name";
						$obj->query($query);
						?>
						<table border=0 cellpadding=2 cellspacing=1 class="signupConfirmOrder" align="center">
						 <tr class="bodycontents">
							<td width='20%' class="compareHead">* Country Name</td>
							<td width='10%' class="compareNormalLeft">
								<select name="countryId">
                        		<option value='0'>Select a Country </option>
		                        	<?for($i=0;$obj->next_record();$i++)
		                        	{
		                        		if ($obj->f('country_id')==$_REQUEST['countryId'])
		                        			echo "<option selected value=".$obj->f('country_id').">".htmlentities($obj->f('country_name'))."</option>";
		                        		else
		                        			echo "<option value=".$obj->f('country_id').">".htmlentities($obj->f('country_name'))."</option>";
		                        	}?>
                        	  	</select>
							</td>
						</tr>
						
                        <?if ($_REQUEST['condition']=='Modify')
                        {
                        	$query="SELECT * FROM tbl_city_corp where city_id='".$_REQUEST['cityId']."'";
                        	$obj->query($query);
                        	$obj->next_record();
                        	$cityName=$obj->f('service_name');
                        	$cityCode=$obj->f('city_name');
                        	$regularRates=$obj->f('rates');
                        
                        	$query="SELECT country_name, country_code FROM tbl_country WHERE country_id='".$_REQUEST['countryId']."'";
                        	$obj->query($query);
                        	$obj->next_record();
                        	$countryName=htmlentities($obj->f('country_name'));
                        	$countryCode=htmlentities($obj->f('country_code'));
                        }?>	
						<tr class="bodycontents">
							<td width='20%' class="compareHead">* City Name</td>
							<td width='10%' class="compareNormalLeft"><input type="text" name="cityName" value="<?echo $cityName;?>" maxlength="50"></td>
						</tr>
						<tr bgcolor="White">
							<td class="compareHead"><b>* City/Mobile Code</b></td>
							<td class="compareNormalLeft"><input type="text" name="cityCode" value="<?echo $cityCode;?>" maxlength="255"></td>
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
				<input type="hidden" name="country_id" value ="<?echo $_REQUEST['country_id']?>">
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