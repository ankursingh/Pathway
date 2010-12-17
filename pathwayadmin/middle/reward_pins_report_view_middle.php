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

if (!isset($_REQUEST['submit1']))
	$_REQUEST['submit1']="";
	
if ($_REQUEST['condition']!='Modify' && $_REQUEST['condition']!='Delete' && $_REQUEST['condition']!='View')
	$_REQUEST['condition']="View";

if ($_REQUEST['submit1']=="Delete")
{
	$_REQUEST['start']=0;
	if(isset($_REQUEST['pno']))
	{
		// Delete selected records
		while (list($key, $val) = each($_REQUEST['pno']))
		{
			$query="SELECT * FROM tbl_bundle_subscribers WHERE reward_id='$val'";
			$obj->query($query);
			if ($obj->num_rows() > 0) {
				$query="DELETE FROM tbl_bundle_subscribers WHERE reward_id='$val'";
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
	if (document.keywords.sel.value=='Select All')
	{
		sel=true;
		selTag='UnSelect All';
	}
	else
	{
		sel=false;
		selTag='Select All';
	}

	for(j=5;j<document.keywords.elements.length;j++)
	{
		if (document.keywords.elements[j].type=='checkbox')
			document.keywords.elements[j].checked=sel;
	}
	document.keywords.sel.value=selTag;
	return true;
}

function deleteBlanks(entry)
{
	var len = entry.length ;
	var foundBlank = 1;
	while(foundBlank == 1 && len > 0) 
	{
		var indx = entry.indexOf(" ");
		if(indx == -1) 
			foundBlank = 0 ;
		else
			entry = entry.substring(0,indx) + entry.substring(indx+1,len);
		len = entry.length;
	}
	return entry;
}

function isEmpty(val,valastname)
{
	if (!deleteBlanks(val.value))
	{
		alert("Please enter the " + valastname);
		val.focus();
		return false;	
	}
	return true;
}

function valid(a)
{
	chk=false;
	chkbox=-1;
	for(j=5;j<document.keywords.elements.length;j++)
	{
		if (document.keywords.elements[j].type=='checkbox')
		{
			if (chkbox==-1)
				chkbox=j;
			if (document.keywords.elements[j].checked)
				chk=true;
		}
	}
	if(!chk)
	{
		alert("Select atleast one Reward ID");
		document.keywords.elements[chkbox].focus();
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
	    		<?
	    		$query="SELECT firstname, account_number, email_id FROM tbl_bundle_subscribers WHERE account_number='".$_REQUEST['account_id']."' order by mailing_date";
				//echo $query."<br>";
				$obj->query($query);
				if ($obj->num_rows()>0) {
					$obj->next_record();
					$firstName=trim($obj->f('firstname'));
					$accountNumber=trim($obj->f('account_number'));
					$emailID=trim($obj->f('email_id'));	
				}
				?>
	    		<table width="10%" border=0 cellpadding=2 cellspacing=1 class="rewardpins">
				<tr class="bodycontents">
					<td width='50%' class="compareHead"><b>First Name</b></td><td class="compareNormalLeft"><?echo $firstName?></td>
				</tr>
				<tr class="bodycontents">
					<td class="compareHead"><b>Email-Id</b></td><td class="compareNormalLeft"><?echo $emailID?></td>
				</tr>
				<tr class="bodycontents">
					<td class="compareHead"><b>Account Number</b></td><td class="compareNormalLeft"><?echo $accountNumber?></td>
				</tr>
				</table><bR>
				
	    		<form name='rewardsPins' method='post' action='reward_pins_report.php'>
				<?
				if (!isset($act))
					$act="";
				if ($act!="")
					echo "<i>Subscriber's Details have been  $act</i><br><br>";

				$query="SELECT * FROM tbl_bundle_subscribers WHERE account_number='".$_REQUEST['account_id']."' order by mailing_date";
				//echo $query."<br>";
				$obj->query($query);
				
				//****************************************************************************			
				// Retrieve and initialize the total count of rows from the database.
				//****************************************************************************
				$tot=$obj->num_rows();
				
				//****************************************************************************
				// If Recordset exists
				//****************************************************************************
				if ($obj->num_rows()>0)
				{?>
						
				<table border=0 cellpadding=2 cellspacing=1 class="compare">
				<tr class="bodycontents">
					<td width='5%' class="compareHead"><b>ID</b></td>
					<td width='20%' class="compareHead"><b>Pin Mailing Date</b></td>
					<td width='20%' class="compareHead"><b>Reward Pin Code</b></td>
					<td width='10%'  class="compareHead"><b>Pin Allocation Status</b></td>
					<?if ($_REQUEST['condition']=="Delete")
					{?>
					<td class="compareHead"><b>Delete</b></td>
					<?}?>
				</tr>
					<?
					
					//****************************************************************************
					// Iterate through the result set
					//****************************************************************************
					while($obj->next_record()) {
						//if ($i<$_REQUEST['start'])
							//continue;
				
						$reward_id=$obj->f('id');
				        $pinAllocateStatus = $obj->f('pin_allocate_status');
				        $rewardPinNumber = $obj->f('reward_pin_number');
				        if ($pinAllocateStatus=="N") {
				            $bgcolor = "red";
				            $classNormal = "class='rewardpinsNormal'";
				            $classNormalLeft = "class='rewardpinsNormalLeft'";
				            $status="PIN to be Allocated";
				        }
				        else {
				            $bgcolor = "white";
				            $status="PIN Allocated";
				            $classNormal="class='compareNormal'";
				            $classNormalLeft="class='compareNormalLeft'";
				        }
				        
				        $mailing_date=$obj->f('mailing_date');
			        	$yy1=substr($mailing_date,0,4);
						$mm1=substr($mailing_date,5,2);
						$dd1=substr($mailing_date,8,2);					
						$mailing_date=date("F jS, Y", mktime(0,0,0,$mm1,$dd1,$yy1) );
							
						?>
					<tr bgcolor="<?echo $bgcolor?>">
						<?if ($_REQUEST['condition']=="View" || $_REQUEST['condition']=="Modify")
						{?>
				            <td <?echo $classNormal?>><?echo htmlentities($reward_id);?></td>
						<?}
						else
						{
							echo "<td $classNormal>".htmlentities($reward_id)."</td>";
						}
						?>
						<td <?echo $classNormalLeft?>><?echo $mailing_date?></td>
						<td <?echo $classNormalLeft?>><?echo $rewardPinNumber?></td>
						<td <?echo $classNormalLeft?>><?echo $status?></td>
						<?if ($_REQUEST['condition']=='Delete')
						{?>
							<td <?echo $classNormal?>><input type='checkbox' name='pno[]' value='<?echo $reward_id;?>'></td>
						<?}?>
						
					</tr>
						<?//$j++;
					}?>
				</table>
				
				<?
				
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
				                    <td bgcolor="#e3e3e3" height="1px"></td>
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
				<center><b><a href='reward_pins_report.php?condition=<?echo $_REQUEST['condition'];?>&start=<?echo $start?>&condition=<?echo $_REQUEST['condition']?>&search_column=<?echo $_REQUEST['search_column']?>&search_criteria=<?echo $_REQUEST['search_criteria']?>&search_value=<?echo $_REQUEST['search_value']?>'>Back</b></center>
				<br>
				<input type="hidden" name="condition" value="<?echo $_REQUEST['condition'];?>">
				<input type="hidden" name="start" value="<?echo $_REQUEST['start'];?>">
				<input type="hidden" name="search_column" value="<?echo $_REQUEST['search_column'];?>">
				<input type="hidden" name="search_criteria" value="<?echo $_REQUEST['search_criteria'];?>">
				<input type="hidden" name="search_value" value="<?echo $_REQUEST['search_value'];?>">
				
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