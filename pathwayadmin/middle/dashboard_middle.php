<?
if(!isset($_REQUEST['submit1'])) {
    $_REQUEST['submit1']=''; 
}
if (!isset($duplicate))
	$duplicate='n';

if ($_REQUEST['submit1'] == "Submit") {

    // Insert the Records in "users" table.
    $query = "SELECT * FROM tbl_dashboard_data WHERE date=now() AND dashboard_status='".$_REQUEST['dashboardStatus']."'";
	$obj->query($query);
	if ($obj->num_rows()>0)
		$duplicate = 'y';
	else
	{
	    $query = "INSERT INTO tbl_dashboard_data (inbound_calls_pos, inbound_calls_bko, inbound_calls_pinpad, inbound_calls_wtbs, inbound_calls_b_upgr, inbound_calls_arl, calls_abandoned_pos, calls_abandoned_bko, calls_abandoned_pinpad, calls_abandoned_wtbs, calls_abandoned_b_upgr, calls_abandoned_arl, asa_pos, asa_bko, asa_pinpad, asa_wtbs, asa_b_upgr, asa_arl, att_pos, att_bko, att_pinpad, att_wtbs, att_b_upgr, att_arl, sla_pos, sla_bko, sla_pinpad, sla_wtbs, sla_b_upgr, sla_arl, dashboard_status, date) VALUES ('".$_REQUEST['inboundCalls_POS']."', '".$_REQUEST['inboundCalls_BKO']."', '".$_REQUEST['inboundCalls_Pinpad']."', '".$_REQUEST['inboundCalls_WTBS']."', '".$_REQUEST['inboundCalls_B_UPGR']."', '".$_REQUEST['inboundCalls_ARL']."', '".$_REQUEST['callsAbandoned_POS']."', '".$_REQUEST['callsAbandoned_BKO']."', '".$_REQUEST['callsAbandoned_Pinpad']."', '".$_REQUEST['callsAbandoned_WTBS']."', '".$_REQUEST['callsAbandoned_B_UPGR']."', '".$_REQUEST['callsAbandoned_ARL']."', '".$_REQUEST['asa_POS']."', '".$_REQUEST['asa_BKO']."', '".$_REQUEST['asa_Pinpad']."', '".$_REQUEST['asa_WTBS']."', '".$_REQUEST['asa_B_UPGR']."', '".$_REQUEST['asa_ARL']."', '".$_REQUEST['att_POS']."', '".$_REQUEST['att_BKO']."', '".$_REQUEST['att_Pinpad']."', '".$_REQUEST['att_WTBS']."', '".$_REQUEST['att_B_UPGR']."', '".$_REQUEST['att_ARL']."', '".$_REQUEST['sla_POS']."', '".$_REQUEST['sla_BKO']."', '".$_REQUEST['sla_Pinpad']."', '".$_REQUEST['sla_WTBS']."', '".$_REQUEST['sla_B_UPGR']."', '".$_REQUEST['sla_ARL']."', '".$_REQUEST['dashboardStatus']."',  now() )";
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
	//In-bound Calls Received
	if(!isEmpty(document.add_dashboard.inboundCalls_POS,"In-bound Calls Received - POS")) {
		document.add_dashboard.inboundCalls_POS.focus();
		return false;
	}
	if (!isNumber(document.add_dashboard.inboundCalls_POS.value)) {
		alert("Please enter a Numeric value.");
		document.add_dashboard.inboundCalls_POS.focus();
		document.add_dashboard.inboundCalls_POS.select();
		return false;
	}
	if(!isEmpty(document.add_dashboard.inboundCalls_BKO,"In-bound Calls Received - BKO")) {
		document.add_dashboard.inboundCalls_BKO.focus();
		return false;
	}
	if (!isNumber(document.add_dashboard.inboundCalls_BKO.value)) {
		alert("Please enter a Numeric value.");
		document.add_dashboard.inboundCalls_BKO.focus();
		document.add_dashboard.inboundCalls_BKO.select();
		return false;
	}
	if(!isEmpty(document.add_dashboard.inboundCalls_Pinpad,"In-bound Calls Received - Pinpad")) {
		document.add_dashboard.inboundCalls_Pinpad.focus();
		return false;
	}
	if (!isNumber(document.add_dashboard.inboundCalls_Pinpad.value)) {
		alert("Please enter a Numeric value.");
		document.add_dashboard.inboundCalls_Pinpad.focus();
		document.add_dashboard.inboundCalls_Pinpad.select();
		return false;
	}
	if(!isEmpty(document.add_dashboard.inboundCalls_WTBS,"In-bound Calls Received - WTBS")) {
		document.add_dashboard.inboundCalls_WTBS.focus();
		return false;
	}
	if (!isNumber(document.add_dashboard.inboundCalls_WTBS.value)) {
		alert("Please enter a Numeric value.");
		document.add_dashboard.inboundCalls_WTBS.focus();
		document.add_dashboard.inboundCalls_WTBS.select();
		return false;
	}
	if(!isEmpty(document.add_dashboard.inboundCalls_B_UPGR,"In-bound Calls Received - B-UPGR")) {
		document.add_dashboard.inboundCalls_B_UPGR.focus();
		return false;
	}
	if (!isNumber(document.add_dashboard.inboundCalls_B_UPGR.value)) {
		alert("Please enter a Numeric value.");
		document.add_dashboard.inboundCalls_B_UPGR.focus();
		document.add_dashboard.inboundCalls_B_UPGR.select();
		return false;
	}
	if(!isEmpty(document.add_dashboard.inboundCalls_ARL,"In-bound Calls Received - ARL")) {
		document.add_dashboard.inboundCalls_ARL.focus();
		return false;
	}
	if (!isNumber(document.add_dashboard.inboundCalls_ARL.value)) {
		alert("Please enter a Numeric value.");
		document.add_dashboard.inboundCalls_ARL.focus();
		document.add_dashboard.inboundCalls_ARL.select();
		return false;
	}
	
	//Calls Abandoned
	if(!isEmpty(document.add_dashboard.callsAbandoned_POS,"Calls Abandoned - POS")) {
		document.add_dashboard.callsAbandoned_POS.focus();
		return false;
	}
	if (!isNumber(document.add_dashboard.callsAbandoned_POS.value)) {
		alert("Please enter a Numeric value.");
		document.add_dashboard.callsAbandoned_POS.focus();
		document.add_dashboard.callsAbandoned_POS.select();
		return false;
	}
	if(!isEmpty(document.add_dashboard.callsAbandoned_BKO,"Calls Abandoned - BKO")) {
		document.add_dashboard.callsAbandoned_BKO.focus();
		return false;
	}
	if (!isNumber(document.add_dashboard.callsAbandoned_BKO.value)) {
		alert("Please enter a Numeric value.");
		document.add_dashboard.callsAbandoned_BKO.focus();
		document.add_dashboard.callsAbandoned_BKO.select();
		return false;
	}
	if(!isEmpty(document.add_dashboard.callsAbandoned_Pinpad,"Calls Abandoned - Pinpad")) {
		document.add_dashboard.callsAbandoned_Pinpad.focus();
		return false;
	}
	if (!isNumber(document.add_dashboard.callsAbandoned_Pinpad.value)) {
		alert("Please enter a Numeric value.");
		document.add_dashboard.callsAbandoned_Pinpad.focus();
		document.add_dashboard.callsAbandoned_Pinpad.select();
		return false;
	}
	if(!isEmpty(document.add_dashboard.callsAbandoned_WTBS,"Calls Abandoned - WTBS")) {
		document.add_dashboard.callsAbandoned_WTBS.focus();
		return false;
	}
	if (!isNumber(document.add_dashboard.callsAbandoned_WTBS.value)) {
		alert("Please enter a Numeric value.");
		document.add_dashboard.callsAbandoned_WTBS.focus();
		document.add_dashboard.callsAbandoned_WTBS.select();
		return false;
	}
	if(!isEmpty(document.add_dashboard.callsAbandoned_B_UPGR,"Calls Abandoned - B-UPGR")) {
		document.add_dashboard.callsAbandoned_B_UPGR.focus();
		return false;
	}
	if (!isNumber(document.add_dashboard.callsAbandoned_B_UPGR.value)) {
		alert("Please enter a Numeric value.");
		document.add_dashboard.callsAbandoned_B_UPGR.focus();
		document.add_dashboard.callsAbandoned_B_UPGR.select();
		return false;
	}
	if(!isEmpty(document.add_dashboard.callsAbandoned_ARL,"Calls Abandoned - ARL")) {
		document.add_dashboard.callsAbandoned_ARL.focus();
		return false;
	}
	if (!isNumber(document.add_dashboard.callsAbandoned_ARL.value)) {
		alert("Please enter a Numeric value.");
		document.add_dashboard.callsAbandoned_ARL.focus();
		document.add_dashboard.callsAbandoned_ARL.select();
		return false;
	}
		
	//Average Speed to Answer (ASA)
	if(!isEmpty(document.add_dashboard.asa_POS,"Average Speed to Answer (ASA) - POS")) {
		document.add_dashboard.asa_POS.focus();
		return false;
	}
	if (!ssnExp1(document.add_dashboard.asa_POS.value)) {
		alert("Please enter the value in the format NN:NN");
		document.add_dashboard.asa_POS.focus();
		document.add_dashboard.asa_POS.select();
		return false;
	}
	if(!isEmpty(document.add_dashboard.asa_BKO,"Average Speed to Answer (ASA) - BKO")) {
		document.add_dashboard.asa_BKO.focus();
		return false;
	}
	if (!ssnExp1(document.add_dashboard.asa_BKO.value)) {
		alert("Please enter the value in the format NN:NN");
		document.add_dashboard.asa_BKO.focus();
		document.add_dashboard.asa_BKO.select();
		return false;
	}
	if(!isEmpty(document.add_dashboard.asa_Pinpad,"Average Speed to Answer (ASA) - Pinpad")) {
		document.add_dashboard.asa_Pinpad.focus();
		return false;
	}
	if (!ssnExp1(document.add_dashboard.asa_Pinpad.value)) {
		alert("Please enter the value in the format NN:NN");
		document.add_dashboard.asa_Pinpad.focus();
		document.add_dashboard.asa_Pinpad.select();
		return false;
	}
	if(!isEmpty(document.add_dashboard.asa_WTBS,"Average Speed to Answer (ASA) - WTBS")) {
		document.add_dashboard.asa_WTBS.focus();
		return false;
	}
	if (!ssnExp1(document.add_dashboard.asa_WTBS.value)) {
		alert("Please enter the value in the format NN:NN");
		document.add_dashboard.asa_WTBS.focus();
		document.add_dashboard.asa_WTBS.select();
		return false;
	}
	if(!isEmpty(document.add_dashboard.asa_B_UPGR,"Average Speed to Answer (ASA) - B-UPGR")) {
		document.add_dashboard.asa_B_UPGR.focus();
		return false;
	}
	if (!ssnExp1(document.add_dashboard.asa_B_UPGR.value)) {
		alert("Please enter the value in the format NN:NN");
		document.add_dashboard.asa_B_UPGR.focus();
		document.add_dashboard.asa_B_UPGR.select();
		return false;
	}
	if(!isEmpty(document.add_dashboard.asa_ARL,"Average Speed to Answer (ASA) - ARL")) {
		document.add_dashboard.asa_ARL.focus();
		return false;
	}
	if (!ssnExp1(document.add_dashboard.asa_ARL.value)) {
		alert("Please enter the value in the format NN:NN");
		document.add_dashboard.asa_ARL.focus();
		document.add_dashboard.asa_ARL.select();
		return false;
	}
	
	//In-bound Average Talk Time (ATT)
	if(!isEmpty(document.add_dashboard.att_POS,"In-bound Average Talk Time (ATT) - POS")) {
		document.add_dashboard.att_POS.focus();
		return false;
	}
	if (!ssnExp1(document.add_dashboard.att_POS.value)) {
		alert("Please enter the value in the format NN:NN");
		document.add_dashboard.att_POS.focus();
		document.add_dashboard.att_POS.select();
		return false;
	}
	if(!isEmpty(document.add_dashboard.att_BKO,"In-bound Average Talk Time (ATT) - BKO")) {
		document.add_dashboard.att_BKO.focus();
		return false;
	}
	if (!ssnExp1(document.add_dashboard.att_BKO.value)) {
		alert("Please enter the value in the format NN:NN");
		document.add_dashboard.att_BKO.focus();
		document.add_dashboard.att_BKO.select();
		return false;
	}
	if(!isEmpty(document.add_dashboard.att_Pinpad,"In-bound Average Talk Time (ATT) - Pinpad")) {
		document.add_dashboard.att_Pinpad.focus();
		return false;
	}
	if (!ssnExp1(document.add_dashboard.att_Pinpad.value)) {
		alert("Please enter the value in the format NN:NN");
		document.add_dashboard.att_Pinpad.focus();
		document.add_dashboard.att_Pinpad.select();
		return false;
	}
	if(!isEmpty(document.add_dashboard.att_WTBS,"In-bound Average Talk Time (ATT) - WTBS")) {
		document.add_dashboard.att_WTBS.focus();
		return false;
	}
	if (!ssnExp1(document.add_dashboard.att_WTBS.value)) {
		alert("Please enter the value in the format NN:NN");
		document.add_dashboard.att_WTBS.focus();
		document.add_dashboard.att_WTBS.select();
		return false;
	}
	if(!isEmpty(document.add_dashboard.att_B_UPGR,"In-bound Average Talk Time (ATT) - B-UPGR")) {
		document.add_dashboard.att_B_UPGR.focus();
		return false;
	}
	if (!ssnExp1(document.add_dashboard.att_B_UPGR.value)) {
		alert("Please enter the value in the format NN:NN");
		document.add_dashboard.att_B_UPGR.focus();
		document.add_dashboard.att_B_UPGR.select();
		return false;
	}
	if(!isEmpty(document.add_dashboard.att_ARL,"In-bound Average Talk Time (ATT) - ARL")) {
		document.add_dashboard.att_ARL.focus();
		return false;
	}
	if (!ssnExp1(document.add_dashboard.att_ARL.value)) {
		alert("Please enter the value in the format NN:NN");
		document.add_dashboard.att_ARL.focus();
		document.add_dashboard.att_ARL.select();
		return false;
	}
	
	//SLA
	if(!isEmpty(document.add_dashboard.sla_POS,"Service Level (SLA) - POS")) {
		document.add_dashboard.sla_POS.focus();
		return false;
	}
	if (!isNumber(document.add_dashboard.sla_POS.value)) {
		alert("Please enter a Numeric value.");
		document.add_dashboard.sla_POS.focus();
		document.add_dashboard.sla_POS.select();
		return false;
	}
	if(!isEmpty(document.add_dashboard.sla_BKO,"Service Level (SLA) - BKO")) {
		document.add_dashboard.sla_BKO.focus();
		return false;
	}
	if (!isNumber(document.add_dashboard.sla_BKO.value)) {
		alert("Please enter a Numeric value.");
		document.add_dashboard.sla_BKO.focus();
		document.add_dashboard.sla_BKO.select();
		return false;
	}
	if(!isEmpty(document.add_dashboard.sla_Pinpad,"Service Level (SLA) - Pinpad")) {
		document.add_dashboard.sla_Pinpad.focus();
		return false;
	}
	if (!isNumber(document.add_dashboard.sla_Pinpad.value)) {
		alert("Please enter a Numeric value.");
		document.add_dashboard.sla_Pinpad.focus();
		document.add_dashboard.sla_Pinpad.select();
		return false;
	}
	
	if(!isEmpty(document.add_dashboard.sla_WTBS,"Service Level (SLA) - WTBS")) {
		document.add_dashboard.sla_WTBS.focus();
		return false;
	}
	if (!isNumber(document.add_dashboard.sla_WTBS.value)) {
		alert("Please enter a Numeric value.");
		document.add_dashboard.sla_WTBS.focus();
		document.add_dashboard.sla_WTBS.select();
		return false;
	}
	
	if(!isEmpty(document.add_dashboard.sla_B_UPGR,"Service Level (SLA)  - B-UPGR")) {
		document.add_dashboard.sla_B_UPGR.focus();
		return false;
	}
	if (!isNumber(document.add_dashboard.sla_B_UPGR.value)) {
		alert("Please enter a Numeric value.");
		document.add_dashboard.sla_B_UPGR.focus();
		document.add_dashboard.sla_B_UPGR.select();
		return false;
	}
	
	if(!isEmpty(document.add_dashboard.sla_ARL,"Service Level (SLA) - ARL")) {
		document.add_dashboard.sla_ARL.focus();
		return false;
	}
	if (!isNumber(document.add_dashboard.sla_ARL.value)) {
		alert("Please enter a Numeric value.");
		document.add_dashboard.sla_ARL.focus();
		document.add_dashboard.sla_ARL.select();
		return false;
	}
	
	//Status
	if (document.add_dashboard.dashboardStatus[document.add_dashboard.dashboardStatus.selectedIndex].value=="") {
	    alert("Select Dashboard Status");
	    document.add_dashboard.dashboardStatus.focus();
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
	    	<td align="left" valign="top" bgcolor="#FFFFFF" class="pagetitle">Add Dashboard Data<br/>
	    		<img src="<?echo TITLE_SEPERATOR_IMAGE?>"/>
	    	</td>
	    </tr>
	    <tr>
	    	<td height="15" bgcolor="#FFFFFF"></td>
	    </tr>
	    <tr>
	    	<td align="left" valign="top" bgcolor="#FFFFFF" class="text">
	    		<FORM name="add_dashboard" method="POST" action="dashboard.php">
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
					<td height="15px" colspan="2" class="bodycontents"><b>All Items are Mandatory</b></td>
				</tr>
				
				<tr>
					<td height="15px" colspan="2"></td>
				</tr>
				
				<tr>
					<td colspan="2">
						<table border=0 cellpadding=2 cellspacing=1 class="compare">
						<tr class="bodycontents">
							<td width='40%' class="compareHead">Dashboard Details</td>
							<td width='10%' class="compareHead"><b>POS</b></td>
							<td width='10%' class="compareHead"><b>BKO</b></td>
							<td width='10%' class="compareHead"><b>Pinpad</b></td>
							<td width='10%'  class="compareHead"><b>WTBS</b></td>
							<td width='10%'  class="compareHead"><b>B-Upgr</b></td>
							<td width='10%'  class="compareHead"><b>ARL</b></td>
						</tr>
						<tr bgcolor="White">
							<td class="compareNormalLeft"><b>In-bound Calls Received</b></td>
							<td class="compareNormal"><input type="text" name="inboundCalls_POS" value="<?echo $inboundCalls_POS?>" size="3" maxlength="3"></td>
							<td class="compareNormal"><input type="text" name="inboundCalls_BKO" value="<?echo $inboundCalls_BKO?>" size="3" maxlength="3"></td>
							<td class="compareNormal"><input type="text" name="inboundCalls_Pinpad" value="<?echo $inboundCalls_Pinpad?>" size="3" maxlength="3"></td>
							<td class="compareNormal"><input type="text" name="inboundCalls_WTBS" value="<?echo $inboundCalls_WTBS?>" size="3" maxlength="3"></td>
							<td class="compareNormal"><input type="text" name="inboundCalls_B_UPGR" value="<?echo $inboundCalls_B_UPGR?>" size="3" maxlength="3"></td>
							<td class="compareNormal"><input type="text" name="inboundCalls_ARL" value="<?echo $inboundCalls_ARL?>" size="3" maxlength="3"></td>
						</tr>
						<tr bgcolor="White">
							<td class="compareNormalLeft"><b>Calls Abandoned</b></td>
							<td class="compareNormal"><input type="text" name="callsAbandoned_POS" value="<?echo $callsAbandoned_POS?>" size="3" maxlength="3"></td>
							<td class="compareNormal"><input type="text" name="callsAbandoned_BKO" value="<?echo $callsAbandoned_BKO?>" size="3" maxlength="3"></td>
							<td class="compareNormal"><input type="text" name="callsAbandoned_Pinpad" value="<?echo $callsAbandoned_Pinpad?>" size="3" maxlength="3"></td>
							<td class="compareNormal"><input type="text" name="callsAbandoned_WTBS" value="<?echo $callsAbandoned_WTBS?>" size="3" maxlength="3"></td>
							<td class="compareNormal"><input type="text" name="callsAbandoned_B_UPGR" value="<?echo $callsAbandoned_B_UPGR?>" size="3" maxlength="3"></td>
							<td class="compareNormal"><input type="text" name="callsAbandoned_ARL" value="<?echo $callsAbandoned_ARL?>" size="3" maxlength="3"></td>
						</tr>
						<tr bgcolor="White">
							<td class="compareNormalLeft"><b>Average Speed to Answer (ASA)</b></td>
							<td class="compareNormal"><input type="text" name="asa_POS" value="<?echo $asa_POS?>" size="3"></td>
							<td class="compareNormal"><input type="text" name="asa_BKO" value="<?echo $asa_BKO?>" size="3"></td>
							<td class="compareNormal"><input type="text" name="asa_Pinpad" value="<?echo $asa_Pinpad?>" size="3"></td>
							<td class="compareNormal"><input type="text" name="asa_WTBS" value="<?echo $asa_WTBS?>" size="3"></td>
							<td class="compareNormal"><input type="text" name="asa_B_UPGR" value="<?echo $asa_B_UPGR?>" size="3"></td>
							<td class="compareNormal"><input type="text" name="asa_ARL" value="<?echo $asa_ARL?>" size="3"></td>
						</tr>
						<tr bgcolor="White">
							<td class="compareNormalLeft"><b>In-bound Average Talk Time (ATT)</b></td>
							<td class="compareNormal"><input type="text" name="att_POS" value="<?echo $att_POS?>" size="3"></td>
							<td class="compareNormal"><input type="text" name="att_BKO" value="<?echo $att_BKO?>" size="3"></td>
							<td class="compareNormal"><input type="text" name="att_Pinpad" value="<?echo $att_Pinpad?>" size="3"></td>
							<td class="compareNormal"><input type="text" name="att_WTBS" value="<?echo $att_WTBS?>" size="3"></td>
							<td class="compareNormal"><input type="text" name="att_B_UPGR" value="<?echo $att_B_UPGR?>" size="3"></td>
							<td class="compareNormal"><input type="text" name="att_ARL" value="<?echo $att_ARL?>" size="3"></td>
						</tr>
						<tr bgcolor="White">
							<td class="compareNormalLeft"><b>Service Level (SLA)</b></td>
							<td class="compareNormal"><input type="text" name="sla_POS" value="<?echo $sla_POS?>" size="3"> %</td>
							<td class="compareNormal"><input type="text" name="sla_BKO" value="<?echo $sla_BKO?>" size="3"> %</td>
							<td class="compareNormal"><input type="text" name="sla_Pinpad" value="<?echo $sla_Pinpad?>" size="3"> %</td>
							<td class="compareNormal"><input type="text" name="sla_WTBS" value="<?echo $sla_WTBS?>" size="3"> %</td>
							<td class="compareNormal"><input type="text" name="sla_B_UPGR" value="<?echo $sla_B_UPGR?>" size="3"> %</td>
							<td class="compareNormal"><input type="text" name="sla_ARL" value="<?echo $sla_ARL?>" size="3"> %</td>
						</tr>
						<tr bgcolor="White">
							<td class="compareNormalLeft"><b>Dashboard Status</b></td>
							<td class="compareNormalLeft" colspan="6">
								<select name="dashboardStatus">
									<?if ($dashboardStatus=="")
										echo "<option value='' selected></option>";
									else
										echo "<option value=''></option>";
							
									if ($dashboardStatus=="Y")
										echo "<option value='Y' selected>Active</option>";
									else 
										echo "<option value='Y'>Active</option>";
							
									if ($dashboardStatus=="N")
										echo "<option value='N' selected>Inactive</option>";
									else 
										echo "<option value='N'>Inactive</option>";
									?>
								</select>
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