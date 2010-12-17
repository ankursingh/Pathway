<?
/*************************************************************************
   Type         :   Script
   File         :   php
   Date         :   December 16, 2008
   Author       :   Surinder Jangira
   Environment  :   PHP, Apache, MySQL
   Revisions    :
   Project      :   Pathcom Website
   File Name    :   reward_pins_report.php
   Purpose      :   This page deals with the display of the details related
   					to Search Keywords.
*************************************************************************/
require_once("./includes/include_files.php");
include_once "./classes/pathway_class.inc";

$obj = new pathway_class;
$obj1 = new pathway_class;

if (!isset($_REQUEST['search_column']))
	$_REQUEST['search_column']="";

if (!isset($_REQUEST['search_criteria']))
	$_REQUEST['search_criteria']="";

if (!isset($_REQUEST['search_value']))
	$_REQUEST['search_value']="";

if (!isset($_REQUEST['start']))
	$_REQUEST['start']=0;

if ($_REQUEST['start']<0)
	$_REQUEST['start']=0;

$limit=100;

if (!isset($_REQUEST['submit1']))
	$_REQUEST['submit1']="";
	
if ($_REQUEST['submit1']=='View All Subscribers') {?>
	<SCRIPT language="javascript">
	   window.location.href="reward_pins_report.php?condition=<?echo $_REQUEST['condition']?>";
	</SCRIPT>
<?}

if ($_REQUEST['condition']!='Modify' && $_REQUEST['condition']!='Delete' && $_REQUEST['condition']!='View')
	$_REQUEST['condition']="View";

if (!isset($search_condition))
	$search_condition="";

if ($_REQUEST['search_value']!="")
{
	if ($_REQUEST['search_criteria']=='e')
		$search_condition = " and ".$_REQUEST['search_column']." =  '".strtoupper($_REQUEST['search_value'])."'";
	if ($_REQUEST['search_criteria']=='s')
		$search_condition = " and upper(".$_REQUEST['search_column'].") like '".strtoupper($_REQUEST['search_value'])."%'";
	if ($_REQUEST['search_criteria']=='c')
		$search_condition = " and upper(".$_REQUEST['search_column'].") like '%".strtoupper($_REQUEST['search_value'])."%'";
	if ($_REQUEST['search_criteria']=='d')
		$search_condition = " and upper(".$_REQUEST['search_column'].") like '%".strtoupper($_REQUEST['search_value'])."'";
//echo $search_condition;exit;
}

if ($_REQUEST['submit1']=="Delete")
{
	$_REQUEST['start']=0;
	if(isset($_REQUEST['pno']))
	{
		// Delete selected records
		while (list($key, $val) = each($_REQUEST['pno']))
		{
			$query="SELECT * FROM tbl_bundle_subscribers WHERE account_number='$val'";
			$obj->query($query);
			if ($obj->num_rows() > 0) {
				$query="DELETE FROM tbl_bundle_subscribers WHERE account_number='$val'";
				//echo $query."<br>";
				$obj1->query($query);
			}
		}
	}
}
?>

<script language='javascript'>
function selAll()
{
	if (document.rewardsPins.sel.value=='Select All')
	{
		sel=true;
		selTag='UnSelect All';
	}
	else
	{
		sel=false;
		selTag='Select All';
	}

	for(j=5;j<document.rewardsPins.elements.length;j++)
	{
		if (document.rewardsPins.elements[j].type=='checkbox')
			document.rewardsPins.elements[j].checked=sel;
	}
	document.rewardsPins.sel.value=selTag;
	return true;
}

function search_valid()
{
	val1=document.rewardsPins.search_column[document.rewardsPins.search_column.selectedIndex].value;
	val2=document.rewardsPins.search_criteria[document.rewardsPins.search_criteria.selectedIndex].value;
	if (val1=='firstname')
		valastname='First Name';
	if (val1=='account_number')
		valastname='Account Number';
	if (val1=='email_id')
		valastname='Email-Id';
	if (val1=='')
	{
		alert("Select a search criteria to proceed");
		document.rewardsPins.search_column.focus();
		return false;
	}		
	if (val2=='')
	{
		alert("Select a search criteria to proceed");
		document.rewardsPins.search_criteria.focus();
		return false;
	}		
	if (!isEmpty(document.rewardsPins.search_value, valastname))
		return false;
}

function valid(a)
{
	chk=false;
	chkbox=-1;
	for(j=5;j<document.rewardsPins.elements.length;j++)
	{
		if (document.rewardsPins.elements[j].type=='checkbox')
		{
			if (chkbox==-1)
				chkbox=j;
			if (document.rewardsPins.elements[j].checked)
				chk=true;
		}
	}
	if(!chk)
	{
		alert("Select atleast one Subscriber");
		document.rewardsPins.elements[chkbox].focus();
		return chk;
	}
	return true;
}
</script>

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
	    	<td align="left" valign="top" bgcolor="#FFFFFF" class="pagetitle"><?echo $_REQUEST['condition']?> Reward Bonus PINs Records<br/>
	    		<img src="<?echo TITLE_SEPERATOR_IMAGE?>"/>
	    	</td>
	    </tr>
	    <tr>
	    	<td height="15" bgcolor="#FFFFFF"></td>
	    </tr>
	    <tr>
	    	<td align="left" valign="top" bgcolor="#FFFFFF" class="	text">
	    		<form name='rewardsPins' method='post' action='reward_pins_report.php'>
				<?
				if (!isset($act))
					$act="";
				if ($act!="")
					echo "<i>Subscriber's Details have been  $act</i><br><br>";
				?>
				<table border=0 width="100%" cellpadding="0" cellspacing="0" align="center">
				<tr>
					<td class="bodycontents" style="padding-left:5px;"><b>Search on : </b></td>
					<td class="bodycontents">
						<select name='search_column'>
						<?if ($_REQUEST['search_column']=='')
						{?>
							<option selected value=''></option>
						<?}
						else
						{?>
							<option value=''></option>
						<?}
						if ($_REQUEST['search_column']=='account_number')
						{?>
							<option selected value='account_number'>Account Number</option>
						<?}
						else
						{?>
							<option value='account_number'>Account Number</option>
						<?}
						
						if ($_REQUEST['search_column']=='firstname')
						{?>
							<option selected value='firstname'>First Name</option>
						<?}
						else
						{?>
							<option value='firstname'>First Name</option>
						<?}
					
						if ($_REQUEST['search_column']=='email_id')
						{?>
							<option selected value='email_id'>Email-Id</option>
						<?}
						else
						{?>
							<option value='email_id'>Email-Id</option>
						<?}?>
						</select>
					</td>
					<td>
						<select name='search_criteria'>
						<?if ($_REQUEST['search_criteria']=='')
						{?>
							<option selected value=''></option>
						<?}
						else
						{?>
							<option value=''></option>
						<?}
						if ($_REQUEST['search_criteria']=='e')
						{?>
							<option selected value='e'>Equals</option>
						<?}
						else
						{?>
							<option value='e'>Equals</option>
						<?}?>
						<?if ($_REQUEST['search_criteria']=='s')
						{?>
							<option selected value='s'>Starts with</option>
						<?}
						else
						{?>
							<option value='s'>Starts with</option>
						<?}?>
						<?if ($_REQUEST['search_criteria']=='c')
						{?>
							<option selected value='c'>Contains</option>
						<?}
						else
						{?>
							<option value='c'>Contains</option>
						<?}?>
						<?if ($_REQUEST['search_criteria']=='d')
						{?>
							<option selected value='d'>Ends With</option>
						<?}
						else
						{?>
							<option value='d'>Ends With</option>
						<?}?>
						</select>
						&nbsp;&nbsp;
						<input type="text" name='search_value' value="<?echo $_REQUEST['search_value'];?>">
						&nbsp;&nbsp;
						<input type="submit" name='submit1' value="Search" onClick="return search_valid();">
					</td>
				</tr>
				</table>
				
				<table width='100%' border="0" align="center">
				<tr>
				    <td><img src="<?echo TITLE_SEPERATOR_IMAGE?>"/></td>
				</tr>
				<tr>
				    <td height="5px"></td>
				</tr>
				<tr>
				    <td align='right' style="padding-right:20px;">
				        <input type="submit" name="submit1" value="View All Subscribers">
				    </td>
				</tr>
				<tr>
				    <td height="5px"></td>
				</tr>
				</table>
				
				<?
				if ($search_condition!="")
					$search_condition1=$search_condition;
				
				$query="SELECT * FROM tbl_bundle_subscribers WHERE 1=1 ";
				$query=$query.$search_condition1."  group by account_number order by firstname";
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
				if ($obj->num_rows()>0) {?>
										
				<table border=0 cellpadding=2 cellspacing=1 width="100%" align="center">
				<tr bgcolor="White" class="bodycontents">
				    <td>
				    	<?if ($_REQUEST['condition']=="View") {?>
							Click on the PIN Subscriber's Name to view the details.
				    	<?}
				    	else if ($_REQUEST['condition']=="Delete") {?>
							Select at least one checkbox to delete the record.
				    	<?}?>
					</td>
				</tr>
				</table>
				
				<table border=0 cellpadding=2 cellspacing=1 class="formRewards">
				<tr>
					<td width='10%' class="formHeadformRewards"><b>ID</b></td>
					<td width='15%' class="formHeadformRewards"><b>First Name</b></td>
					<td width='25%' class="formHeadformRewards"><b>Account Number</b></td>
					<td width='25%' class="formHeadformRewards"><b>Reward Start Date</b></td>
					<td width='50%' class="formHeadformRewards"><b>Reward End Date</b></td>
					<?if ($_REQUEST['condition']=="Delete")
					{?>
					<td class="formHeadformRewards"><b>Delete</b></td>
					<?}?>
				</tr>
					<?
					//for($i=0,$j=0;$obj->next_record() && $j<$limit;$i++) {
					
					//****************************************************************************
					// Iterate through the result set
					//****************************************************************************
					while($obj->next_record()) {
						//if ($i<$_REQUEST['start'])
							//continue;
				
						$reward_id=$obj->f('id');
						$firstName=trim($obj->f('firstname'));
						$accountNumber=trim($obj->f('account_number'));
						$emailID=trim($obj->f('email_id'));
				        
				        $classNormal="class='formNormalformRewards'";
			            $classNormalLeft="class='formNormalformRewards'";
				            
				        $query2="SELECT min(mailing_date) AS reward_start_date, max(mailing_date) AS reward_end_date FROM tbl_bundle_subscribers WHERE email_id LIKE '$emailID' AND firstname LIKE '$firstName' AND account_number='$accountNumber'";
				        $obj1->query($query2);
				        if ($obj1->num_rows() > 0){
				        	$obj1->next_record();
				        	$reward_start_date=$obj1->f('reward_start_date');
				        	$yy1=substr($reward_start_date,0,4);
							$mm1=substr($reward_start_date,5,2);
							$dd1=substr($reward_start_date,8,2);					
							$reward_start_date=date("M jS, Y", mktime(0,0,0,$mm1,$dd1,$yy1) );
							
				        	$reward_end_date=$obj1->f('reward_end_date');
				        	$yy2=substr($reward_end_date,0,4);
							$mm2=substr($reward_end_date,5,2);
							$dd2=substr($reward_end_date,8,2);
					
							$reward_end_date=date("M jS, Y", mktime(0,0,0,$mm2,$dd2,$yy2) );				        	
				        }?>
					<tr>
						<?if ($_REQUEST['condition']=="View")
						{?>
				            <td class='formNormalformRewards'><div align="center"><a href='reward_pins_report_view.php?account_id=<?echo $accountNumber?>&condition=<?echo $_REQUEST['condition'];?>&start=<?echo $_REQUEST['start']?>&condition=<?echo $_REQUEST['condition']?>&search_column=<?echo $_REQUEST['search_column']?>&search_criteria=<?echo $_REQUEST['search_criteria']?>&search_value=<?echo $_REQUEST['search_value']?>'><?echo htmlentities($reward_id);?></a></div></td>
						<?}
						else
						{
							echo "<td class='formNormalformRewards'><div align='center'>".htmlentities($reward_id)."</div></td>";
						}
						
						if ($_REQUEST['condition']=="View") {?>
							<td class='formNormalformRewards'><a href='reward_pins_report_view.php?account_id=<?echo $accountNumber?>&condition=<?echo $_REQUEST['condition'];?>&start=<?echo $_REQUEST['start']?>&condition=<?echo $_REQUEST['condition']?>&search_column=<?echo $_REQUEST['search_column']?>&search_criteria=<?echo $_REQUEST['search_criteria']?>&search_value=<?echo $_REQUEST['search_value']?>'><?echo $firstName;?></a></td>
						<?
						}
						else 
							echo "<td class='formNormalformRewards'>$firstName</td>";
						?>
						<td class='formNormalformRewards'><?echo htmlentities($accountNumber)?></td>
						<td class='formNormalformRewards'><?echo $reward_start_date?></td>
						<td class='formNormalformRewards'><?echo $reward_end_date?></td>
						<?if ($_REQUEST['condition']=='Delete')
						{?>
							<td class='formNormalformRewards'><div align="center"><input type='checkbox' name='pno[]' value='<?echo $accountNumber;?>'></div></td>
						<?}?>
						
					</tr>
						<?//$j++;
					}?>
				</table>
				
				<?
					// Risticted only limited records per page
					$prev=$_REQUEST['start']-$limit;
					if ($prev<1)
						$prev=0;
					$next=$_REQUEST['start']+$limit;
					if ($next>=$tot)
						$next=0;
				
					echo "<table width='100%' cellspacing='0' cellpadding='0' border=0 align=left><tr>";
					if ($_REQUEST['start']>0)
						echo"<td align='left'><a href='reward_pins_report.php?start=$prev&condition=".$_REQUEST['condition']."&search_column=".$_REQUEST['search_column']."&search_criteria=".$_REQUEST['search_criteria']."&search_value=".$_REQUEST['search_value']."'><b>Previous</b></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
					else
						echo"<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
					$start=$_REQUEST['start']+$limit;
					if ($tot>$start)
						echo"<td align='right'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='reward_pins_report.php?start=$start&condition=".$_REQUEST['condition']."&search_column=".$_REQUEST['search_column']."&search_criteria=".$_REQUEST['search_criteria']."&search_value=".$_REQUEST['search_value']."'><b>Next</b></a></td></tr></table>";
					else
						echo"<td align='right'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></table>";
					echo"</center><br><br>";
				
					if ($_REQUEST['condition']=='Delete')
					{?>
						<table align="center" width='100%' border=0>
						<tr>
							<td align="right">
							 <input type="button" name="sel" value="Select All" onClick="return selAll();">
							</td>
						</tr>
						<tr>
							<td align="right">
				                <table width='100%' align="center">
				                <tr>
								    <td><img src="<?echo TITLE_SEPERATOR_IMAGE?>"/></td>
								</tr>
				                </table>
				            </td>
						</tr>
						<tr>
							<td align="right">
				    			<center><input type="submit" name="submit1" value="Delete" onClick="return valid(this);"></center>
							</td>
						</tr>
						</table>
					<?}
					
				}
				else
					echo "<center><hr><i>No Records</i></center><hr>";
				?>
				
				<br>
				<input type="hidden" name="condition" value="<?echo $_REQUEST['condition'];?>">
				<input type="hidden" name="start" value="<?echo $_REQUEST['start'];?>">
				
				</form>
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