<?
/*************************************************************************
   Type         :   Script
   File         :   php
   Date         :   December 16, 2008
   Author       :   Surinder Jangira
   Environment  :   PHP, Apache, MySQL
   Revisions    :
   Project      :   Pathcom Website
   File Name    :   generate_dash_data.php
   Purpose      :   This page deals with the display of the details related
   					to Search Keywords.
*************************************************************************/
require_once("./includes/include_files.php");
include_once "./classes/pathway_class.inc";

$obj = new pathway_class;
$obj1 = new pathway_class;


//****************************************************************************
// Declare Variables 
//****************************************************************************

if (!isset($_REQUEST['start']))
	$_REQUEST['start']=0;

if ($_REQUEST['start']<0)
	$_REQUEST['start']=0;

$limit=500;

if (!isset($_REQUEST['submit1']))
	$_REQUEST['submit1']="";
	
$log_file_path="./csv/";

function generateDashFile ($CSV_Content, $log_file_path, $logfilename) {
	
	$retVal=false;
	
	//$logfilename="dashboard_data.txt";
	$dest = $log_file_path.$logfilename;
	if (!file_exists($dest)) {
		if ($pfp=fopen($dest,'w')) {
			fwrite($pfp,$CSV_Content);
			fclose($pfp);
			$retVal=true;
		}
	}
	else if (file_exists($dest) && is_writeable($dest)) {
		if ($pfp=fopen($dest,'w')) {
			fwrite($pfp,$CSV_Content);
			fclose($pfp);
			$retVal=true;
		}
	}
	return $retVal;
}

if ($_REQUEST['submit1']=="Generate Report File")
{
	$_REQUEST['start']=0;
		
	$query="SELECT * FROM tbl_dashboard_data WHERE dash_id='".$_REQUEST['dash_id']."'";
	$obj->query($query);
	if ($obj->num_rows() > 0) {
		
        $obj->next_record();	    
    	
        $inboundCalls_POS = $obj->f('inbound_calls_pos');
        $inboundCalls_BKO = $obj->f('inbound_calls_bko');
        $inboundCalls_Pinpad = $obj->f('inbound_calls_pinpad');
        $inboundCalls_WTBS = $obj->f('inbound_calls_wtbs');
        $inboundCalls_B_UPGR = $obj->f('inbound_calls_b_upgr');
        $inboundCalls_ARL = $obj->f('inbound_calls_arl');
        
        $callsAbandoned_POS = $obj->f('calls_abandoned_pos');
        $callsAbandoned_BKO = $obj->f('calls_abandoned_bko');
        $callsAbandoned_Pinpad = $obj->f('calls_abandoned_pinpad');
        $callsAbandoned_WTBS = $obj->f('calls_abandoned_wtbs');
        $callsAbandoned_B_UPGR = $obj->f('calls_abandoned_b_upgr');
        $callsAbandoned_ARL = $obj->f('calls_abandoned_arl');
        
        $asa_POS = $obj->f('asa_pos');
        $asa_BKO = $obj->f('asa_bko');
        $asa_Pinpad = $obj->f('asa_pinpad');
        $asa_WTBS = $obj->f('asa_wtbs');
        $asa_B_UPGR = $obj->f('asa_b_upgr');
        $asa_ARL = $obj->f('asa_arl');
        
        $att_POS = $obj->f('att_pos');
        $att_BKO = $obj->f('att_bko');
        $att_Pinpad = $obj->f('att_pinpad');
        $att_WTBS = $obj->f('att_wtbs');
        $att_B_UPGR = $obj->f('att_b_upgr');
        $att_ARL = $obj->f('att_arl');
        
        $sla_POS = $obj->f('sla_pos');
        $sla_BKO = $obj->f('sla_bko');
        $sla_Pinpad = $obj->f('sla_pinpad');
        $sla_WTBS = $obj->f('sla_wtbs');
        $sla_B_UPGR = $obj->f('sla_b_upgr');
        $sla_ARL = $obj->f('sla_arl');
        
        $dashboardDate = $obj->f('date');
        $yy1=substr($dashboardDate,0,4);
		$mm1=substr($dashboardDate,5,2);
		$dd=substr($dashboardDate,8,2);

		$dashboardDate=date( "M jS, Y", mktime(0,0,0,$mm1,$dd,$yy1) );
		$dashboardFileDate="$yy1$mm1$dd";
        $dashboardStatus = $obj->f('dashboard_status');

        
        /*
        $dashboardDate="Date\t$dashboardDate\t\t\t\t\t\n";
        $In_bound_Calls = "In-bound Calls Received\t$inboundCalls_POS\t$inboundCalls_BKO\t$inboundCalls_Pinpad\t$inboundCalls_WTBS\t$inboundCalls_B_UPGR\t$inboundCalls_ARL\n";
        $Calls_Abandoned ="Calls Abandoned\t$callsAbandoned_POS\t$callsAbandoned_BKO\t$callsAbandoned_Pinpad\t$callsAbandoned_WTBS\t$callsAbandoned_B_UPGR\t$callsAbandoned_ARL\n";
        $ASA ="Average Speed to Answer (ASA)\t$asa_POS\t$asa_BKO\t$asa_Pinpad\t$asa_WTBS\t$asa_B_UPGR\t$asa_ARL\n";
        $ATT ="In-bound Average Talk Time (ATT)\t$att_POS\t$att_BKO\t$att_Pinpad\t$att_WTBS\t$att_B_UPGR\t$att_ARL\n";
        $SLA ="Service Level (SLA)\t$sla_POS\t$sla_BKO\t$sla_Pinpad\t\t\t\n";
        
        $fileContent = $dashboardDate.$In_bound_Calls.$Calls_Abandoned.$ASA.$ATT.$SLA;
        
        */
        
        //$logfilename = "dashboard_data_$dashboardFileDate.js";
        $logfilename = "dashboard_data.js";
        
        $fileContent = "/**************************************************************/\n/*** Please save this file as \"dashboard_data.js\" and copy the same to the \"\jsfiles\\\" folder. ***/\n/*************************************************************/\n var messages = new Array();\n messages[0]='$dashboardDate';\n messages[1]='$inboundCalls_POS';\n messages[2]='$inboundCalls_BKO';\n messages[3]='$inboundCalls_Pinpad';\n messages[4]='$inboundCalls_WTBS';\n messages[5]='$inboundCalls_B_UPGR';\n messages[6]='$inboundCalls_ARL';\n messages[7]='$callsAbandoned_POS';\n messages[8]='$callsAbandoned_BKO';\n messages[9]='$callsAbandoned_Pinpad';\n messages[10]='$callsAbandoned_WTBS';\n messages[11]='$callsAbandoned_B_UPGR';\n messages[12]='$callsAbandoned_ARL';\n messages[13]='$asa_POS';\n messages[14]='$asa_BKO';\n messages[15]='$asa_Pinpad';\n messages[16]='$asa_WTBS';\n messages[17]='$asa_B_UPGR';\n messages[18]='$asa_ARL';\n messages[19]='$att_POS';\n messages[20]='$att_BKO';\n messages[21]='$att_Pinpad';\n messages[22]='$att_WTBS';\n messages[23]='$att_B_UPGR';\n messages[24]='$att_ARL';\n messages[25]='$sla_POS';\n messages[26]='$sla_BKO';\n messages[27]='$sla_Pinpad';\n messages[28]='$sla_WTBS';\n messages[29]='$sla_B_UPGR';\n messages[30]='$sla_ARL';\n";
        
        $result = generateDashFile ($fileContent, $log_file_path, $logfilename);
     
        if ($result) {?>
        	<script language="javascript">
        	alert("Dashboard File Generated Successfully!");
        	var fname="view_dashboard_data.php";
        	window.open(fname,'a',"toolbar=no,status=no,menubar=no,scrollbars=yes,left=50,top=100,width=750,height=450") 
        	</script>
        <?
        }
	}
}
?>

<SCRIPT language="javascript">
function valid(a)
{
	chk=false;
	chkbox=-1;
	
	for(j=0;j<document.generate_dash_data.elements.length;j++)
	{
		if (document.generate_dash_data.elements[j].type=='radio')
		{
			if (chkbox==-1)
				chkbox=j;
			if (document.generate_dash_data.elements[j].checked)
				chk=true;
		}
	}
	if(!chk)
	{
		alert("Please select a Dashboard ID");
		document.generate_dash_data.elements[chkbox].focus();
		return chk;
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
	    	<td align="left" valign="top" bgcolor="#FFFFFF" class="pagetitle">Generate Dashboard Data<br/>
	    		<img src="<?echo TITLE_SEPERATOR_IMAGE?>"/>
	    	</td>
	    </tr>
	    <tr>
	    	<td height="15" bgcolor="#FFFFFF"></td>
	    </tr>
	    <tr>
	    	<td align="left" valign="top" bgcolor="#FFFFFF" class="text">
	    		<FORM name="generate_dash_data" method="POST" action="generate_dash_data.php">
				
	    		<?
				//
				$query="SELECT * FROM `tbl_dashboard_data` WHERE dashboard_status='Y' ORDER BY date DESC";
				//echo $query."<br>";
				$obj->query($query);
				
				//****************************************************************************			
				// Retrieve and initialize the total count of rows from the database.
				//****************************************************************************
				$tot=$obj->num_rows();
				
				//****************************************************************************
				// Reset the value of Start if "Search" button is clicked. 
				//****************************************************************************
				if ($_REQUEST['submit1']=='Search')	
					$_REQUEST['start']=0;
					
				//****************************************************************************
				// Join and Execute Query
				//****************************************************************************
				$query= $query." Limit ".$_REQUEST['start'].", $limit";
				$obj->query($query);
				
				//****************************************************************************
				// If Recordset exists
				//****************************************************************************
				if ($obj->num_rows()>0)
				{?>
						
				<table border=0 cellpadding=2 cellspacing=1 width="100%" align="center">
				<tr bgcolor="White" class="bodycontents">
				    <td>
						Choose an Dashboard Datathat needs to be generated.
					</td>
				</tr>
				</table>
				
				<table border=0 cellpadding=2 cellspacing=1 class="compare">
				<tr class="bodycontents">
					<td width='5%' class="compareHead"><b>Dashboard ID</b></td>
					<td width='65%' class="compareHead"><b>Dashboard Date</b></td>
					<td width='5%'  class="compareHead"><b>Select</b></td>
				</tr>
					<?
					//****************************************************************************
					// Iterate through the result set
					//****************************************************************************
					while($obj->next_record()) {
				
						$dash_id=$obj->f('dash_id');
						$dashboardDate = $obj->f('date');
						$yy1=substr($dashboardDate,0,4);
						$mm1=substr($dashboardDate,5,2);
						$dd=substr($dashboardDate,8,2);
			
						$dashboardDate=date( "M jS, Y", mktime(0,0,0,$mm1,$dd,$yy1) );
						?>
					<tr bgcolor="white">
						<?echo "<td class='compareNormal'>$dash_id</td>";
						echo "<td class='compareNormalLeft'>$dashboardDate</td>";?>
						<td class='compareNormal'><input type='radio' name='dash_id' value='<?echo $dash_id;?>' <?echo $sel3?>></td>
					</tr>
				<?}?>
				</table>
				<?
					// Risticted only limited records per page
					$prev=$_REQUEST['start']-$limit;
					if ($prev<1)
						$prev=0;
					$next=$_REQUEST['start']+$limit;
					if ($next>=$tot)
						$next=0;
				
					echo "<table width='96%' cellspacing='0' cellpadding='0' border=0 align=left><tr>";
					if ($_REQUEST['start']>0)
						echo"<td align='left'><a href='generate_dash_data.php?start=$prev'><b>Previous</b></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
					else
						echo"<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
					$start=$_REQUEST['start']+$limit;
					if ($tot>$start)
						echo"<td align='right'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='generate_dash_data.php?start=$start'><b>Next</b></a></td></tr></table>";
					else
						echo"<td align='right'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></table>";
					echo"</center><br>";?>
				<br>

					<table width='95%' cellspacing='0' cellpadding='0' border=0 align=left>
					<tr>
						<td align="right">
			                <table width='100%' align="center">
			                <tr>
			                    <td bgcolor="#e3e3e3" height="1px"></td>
			                </tr>
			                </table>
			            </td>
					</tr>
					<tr>
						<td align="right">
			    			<center><input type="submit" name="submit1" value="Generate Report File" onClick="return valid(this);">&nbsp;&nbsp;<input type="reset" value="Reset" name="reset"></center>
						</td>
					</tr>
					</table>
				<?}
				else
					echo "<center><hr><i>No Records</i></center><hr>";
				?>
				<input type="hidden" name="start" value="<?echo $_REQUEST['start'];?>">
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