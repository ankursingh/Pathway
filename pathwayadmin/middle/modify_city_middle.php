<?
/**** Declare Variables ****/
if(!isset($_REQUEST['submit1'])) {
    $_REQUEST['submit1']=''; 
}
if (!isset($_REQUEST['countryId']))
	$_REQUEST['countryId']="";

if ($_REQUEST['submit1']=='Delete')
{
	if(isset($_REQUEST['pno']))
	{
		while (list($key, $val) = each($_REQUEST['pno']))
		{
			$query="DELETE FROM tbl_city_corp WHERE city_id=$val";
			//echo "$query<br>";
			$obj->query($query);
		}?>
		<script language="javascript">
		  alert("Selected Record(s) Deleted Succesfully!");
		</script>
<?	}
}
else if ($_REQUEST['submit1']=='Modify')
{
	if(isset($_REQUEST['mno']))
	{
		while (list($key, $val) = each($_REQUEST['mno']))
		{
		    $cityName = addslashes($_REQUEST['cityName_'.$val]);
		    $city_Code = addslashes($_REQUEST['cityCode_'.$val]);
		    $regularRates = addslashes($_REQUEST['regularRates_'.$val]);
		    
			$query="UPDATE tbl_city_corp SET service_name='$cityName', city_name='$city_Code', rates='$regularRates' WHERE city_id=$val";
			//echo "$query<br>";//exit;
			$obj->query($query);
		}?>
		<script language="javascript">
		  alert("Selected Record(s) Modified Succesfully!");
		</script>
	<?}
}
?>

<SCRIPT language="javascript">
function change()
{
	document.modify_city.submit();
	return true;
}

function so()
{	if(document.modify_city.countryId[document.modify_city.countryId.selectedIndex].value==0)
	{
		alert("Please select a Country");
		document.modify_city.elements[0].focus();
		return false;
	}
	return true;
}

function selAll()
{
	if (document.modify_city.sel.value=='Select All')
	{
		sel=true;
		selTag='UnSelect All';
	}
	else
	{
		sel=false;
		selTag='Select All';
	}

	for(j=1;j<document.modify_city.elements.length-2;j++)
		document.modify_city.elements[j].checked=sel;
	document.modify_city.sel.value=selTag;
	return true;
}


function valid()
{
	if (!so())
		return false;

	<?if ($_REQUEST['condition']=='Delete') {?>	
    	chk=false;
    	for(j=1;document.modify_city.elements[j].name=='pno[]';j++)
    	{
    		if (document.modify_city.elements[j].checked)
    			chk=true;
    	}
	<?}
	else {?>
    	chk=false;

    	for(j=1;j<document.modify_city.elements.length;j++)
    	{
    		if (document.modify_city.elements[j].name=='mno[]' && document.modify_city.elements[j].checked) {
    		 
    		    if(!isEmpty(document.modify_city.elements[j-3],"City Name"))
                    return false;
			
                if(!isEmpty(document.modify_city.elements[j-2],"City/Mobile Code"))
                    return false;
                
                if(!isEmpty(document.modify_city.elements[j-1],"Regular Rates"))
                    return false;
    			chk=true;
    		}
    	}
	<?}?>
	
	if(!chk)
	{
		alert("Select atleast one City");
		document.forms[0].elements[0].focus();
		return chk;
	}
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
	    	<td align="left" valign="top" bgcolor="#FFFFFF" class="pagetitle"><?echo $_REQUEST['condition']?> City Data<br/>
	    		<img src="<?echo TITLE_SEPERATOR_IMAGE?>"/>
	    	</td>
	    </tr>
	    <tr>
	    	<td height="15" bgcolor="#FFFFFF"></td>
	    </tr>
	    <tr>
	    	<td align="left" valign="top" bgcolor="#FFFFFF" class="text">
	    		<FORM name="modify_city" method="POST" action="modify_city.php">
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
				
				<?
				$query="SELECT distinct(tbl_country_corp.country_id), tbl_country_corp.country_name FROM tbl_country_corp, tbl_city_corp WHERE tbl_country_corp.country_id=tbl_city_corp.country_id ORDER BY tbl_country_corp.country_name";
				$obj->query($query);
				if ($obj->affected_rows() > 0)
				{
				
					if ($_REQUEST['condition']=="Modify")
						$cap="modified";
					else if ($_REQUEST['condition']=="Delete")
						$cap="deleted";
					else if ($_REQUEST['condition']=="View")
						$cap="viewed";
					else 
						$cap="viewed";?>
				<tr>
					<td colspan="2">
						<table border=0 cellpadding=2 cellspacing=1 class="signupConfirmOrder" align="center">
						<tr class="bodycontents">
							<td class="compareHead"><div align="left">Select a Country Name</div></td>
						</tr>
						<tr class="bodycontents">
							<td width='10%' class="compareNormalLeft">
								<select name="countryId" onChange="change()">
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
						</table>
						<?if (isset($_REQUEST['countryId']) && $_REQUEST['countryId']!='')
                        {?>
							<br />
							<table border=0 cellpadding=2 cellspacing=1 align="center" width="550px;">
							<tr class="bodycontents">
								<td bgcolor="White">Select a City Name to be <?echo $cap?></td>
							</tr>
							</table>
						<?//}
						
							$query="SELECT * FROM tbl_city_corp WHERE country_id='".$_REQUEST['countryId']."' ORDER BY city_name";
							//echo $query;
	                        $obj->query($query);
	                        if ($obj->num_rows()>0)
	                        {?>
								<table border=0 cellpadding=2 cellspacing=1 class="CityTable" align="center">
								<tr class="bodycontents">
									<td width='30%' class="compareHead">City Name</td>
									<td width='50%' class="compareHead">City/Mobile Code</td>
									<td width='10%' class="compareHead">Regular Rates</td>
									<?if ($_REQUEST['condition']=='Delete') {?>
									<td width='10%' class="compareHead">Delete</td>
									<?}
		                			else if ($_REQUEST['condition']=='Modify') {?>
									<td width='10%' class="compareHead">Modify</td>
									<?}?>
								</tr>
								<?while ($obj->next_record()) {
									
									$cityId=$obj->f('city_id');
		            				$cityName=htmlentities($obj->f('service_name'));
		            				$cityCode=htmlentities($obj->f('city_name'));
		            				$regularRates=htmlentities($obj->f('rates'));?>
								<tr bgcolor="White">
									<td class="compareNormalLeft">
										<?if ($_REQUEST['condition']=='Modify') {?>
											<input type="text" name="cityName_<?echo $cityId?>" value="<?echo $cityName;?>" maxlength="50" size="35">
										<?}
										else
											echo $cityName;?>
									</td>
									<td class="compareNormalLeft">
										<?if ($_REQUEST['condition']=='Modify') {?>
											<input type="text" name="cityCode_<?echo $cityId?>" value="<?echo $cityCode;?>" maxlength="255" size="35">
										<?}
										else
											echo $cityCode;?>
									</td>
									<td class="compareNormal">
										<?if ($_REQUEST['condition']=='Modify') {?>
											<input type="text" name="regularRates_<?echo $cityId?>" value="<?echo $regularRates;?>" maxlength="7" size="5">
										<?}
										else
											echo number_format($regularRates,1)."&cent;";?>
									</td>
									<td class="compareNormal">
										<?if ($_REQUEST['condition']=='Delete') {?>
											<input type='checkbox' name='pno[]' value='<?echo $cityId;?>'>
										<?}
										else if ($_REQUEST['condition']=='Modify') {?>
											<input type='checkbox' name='mno[]' value='<?echo $cityId;?>'>
										<?}?>
									</td>
								</tr>
								<?}?>
								</table>
							<?}
							if ($_REQUEST['condition']!='View') {?>	
			            		<br>	
			                    <table align="center" width='550' border=0>
			                    <tr>
			                    	<td align="right">
			                        	<input type="button" name="sel" value="Select All" onClick="return selAll();" class="submit">
			                    	</td>
			                    </tr>
			                    <tr>
			                    	<td align="right">
			                        	<table align="center" class="bodycontents" cellspacing="0" cellpadding="0" width="100%">
			                        	<tr>
			                        		<td height="2px" bgcolor="#325c85"></td>
			                        	</tr>
			                        	<tr>
			                        	   	<td height="10px"></td>
			                        	</tr>
			                        	</table>
			                    	</td>
			                    </tr>
			                    <tr>
			                    	<td align="right">
			                    		<center>
										<?if ($_REQUEST['condition']=='Delete')
											$buttName = "Delete";
										else if ($_REQUEST['condition']=='Modify')
											$buttName = "Modify";?>
			                        	<input type="submit" name="submit1" value="<?echo $buttName?>" onClick="return valid();" class="submit">
			                        	</center>
			                    	</td>
			                    </tr>
			                    </table>
							<?	}
						}?>
					</td>
				</tr>
				</table>
				<?}?>
				
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