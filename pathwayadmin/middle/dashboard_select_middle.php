<?
/*************************************************************************
   Type         :   Script
   File         :   php
   Date         :   August 07, 2009
   Author       :   Surinder Jangira
   Environment  :   PHP, Apache, MySQL
   Revisions    :
   Project      :   Pathcom Website
   File Name    :   dashboard_select.php
   Purpose      :   This page deals with the display of the details related
   					to Dashboard data.
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
	
if ($_REQUEST['submit1']=='View All Data') {?>
	<SCRIPT language="javascript">
	   window.location.href="dashboard_select.php?condition=<?echo $_REQUEST['condition']?>";
	</SCRIPT>
<?}

if ($_REQUEST['condition']!='Modify' && $_REQUEST['condition']!='Delete' && $_REQUEST['condition']!='View')
	$_REQUEST['condition']="View";

if (!isset($search_condition))
	$search_condition="";

if ($_REQUEST['dashboard_date']!="")
{
	$search_condition = " and date = '".$_REQUEST['dashboard_date']."'";
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
			$query="SELECT * FROM tbl_dashboard_data WHERE dash_id='$val'";
			$obj->query($query);
			if ($obj->num_rows() > 0) {
				$query="DELETE FROM tbl_dashboard_data WHERE dash_id='$val'";
				//echo $query."<br>";
				$obj1->query($query);
			}
		}
	}
}
?>

<script language='javascript'>
function showKeyword(dash_id)
{
	mw='keywords_view.php?dash_id='+dash_id;
	mywin=window.open(mw,'a','scrollbars=1,HEIGHT=606,WIDTH=756');
	mywin.focus();
	return false;
}

function selAll()
{
	if (document.dashboard.sel.value=='Select All')
	{
		sel=true;
		selTag='UnSelect All';
	}
	else
	{
		sel=false;
		selTag='Select All';
	}

	for(j=3;j<document.dashboard.elements.length;j++)
	{
		if (document.dashboard.elements[j].type=='checkbox')
			document.dashboard.elements[j].checked=sel;
	}
	document.dashboard.sel.value=selTag;
	return true;
}

function search_valid()
{
	if (!isEmpty(document.dashboard.dashboard_date, "Dashboard date"))
		return false;
}

function valid(a)
{
	chk=false;
	chkbox=-1;
	for(j=3;j<document.dashboard.elements.length;j++)
	{
		if (document.dashboard.elements[j].type=='checkbox')
		{
			if (chkbox==-1)
				chkbox=j;
			if (document.dashboard.elements[j].checked)
				chk=true;
		}
	}
	if(!chk)
	{
		alert("Select atleast one Dashboard data");
		document.dashboard.elements[chkbox].focus();
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
	    	<td align="left" valign="top" bgcolor="#FFFFFF" class="pagetitle">Manage Dashboard Data<br/>
	    		<img src="<?echo TITLE_SEPERATOR_IMAGE?>"/>
	    	</td>
	    </tr>
	    <tr>
	    	<td height="15" bgcolor="#FFFFFF"></td>
	    </tr>
	    <tr>
	    	<td align="left" valign="top" bgcolor="#FFFFFF" class="	text">
	    		<form name='dashboard' method='post' action='dashboard_select.php'>
				<?
				if (!isset($act))
					$act="";
				if ($act!="")
					echo "<i>Member's Details have been  $act</i><br><br>";
				?>
				<table border=0 width="100%" cellpadding="0" cellspacing="0" align="center">
				<tr>
					<td class="bodycontents" style="padding-left:5px;" width="20%"><b>Search by Date : </b></td>
					<td class="bodycontents">
						<INPUT type="text" name="dashboard_date" value="<?echo $_REQUEST['dashboard_date']?>" size="20" maxlength="50" readonly>
						&nbsp;<a href="javascript:cal2.popup();"><img src="/images/cal.gif" width="16" height="16" border="0" alt="Click Here to Pick up the date" align="absmiddle"></a>
						<script language="JavaScript">
							var cal2 = new calendar3(document.forms['dashboard'].elements['dashboard_date']);
							cal2.year_scroll = false;
							cal2.time_comp = false;
						</script>
					</td>
					<td width="50%" align="left">
						&nbsp;&nbsp;
						<input type="submit" name='submit1' value="Search" onClick="return search_valid();">&nbsp;&nbsp;<input type="submit" name="submit1" value="View All Data">
					</td>
				</tr>
				</table><br>

				
				<?
				if ($search_condition!="")
					$search_condition1=$search_condition;
				
				$query="SELECT * FROM tbl_dashboard_data WHERE 1=1 ";
				$query=$query.$search_condition1." order by date desc";
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
				{
					//****************************************************************************
					// Set the captopns based on the "condition".
					//****************************************************************************
					if ($_REQUEST['condition']=="Modify")
						$caption="modified";
					else if ($_REQUEST['condition']=="View")
						$caption="viewed";
					else if ($_REQUEST['condition']=="Delete")
						$caption="deleted";?>
						
				<table border=0 cellpadding=2 cellspacing=1 width="100%" align="center">
				<tr bgcolor="White" class="bodycontents">
				    <td>
						Click on the Search Page URL that has to be <?echo $caption;?>
					</td>
				</tr>
				</table>
				
				<table border=0 cellpadding=2 cellspacing=1 class="compare">
				<tr class="bodycontents">
					<td width='10%' class="compareHead"><b>Dashboard ID</b></td>
					<td width='60%' class="compareHead"><b>Dashboard Date</b></td>
					<td width='15%'  class="compareHead"><b>Status</b></td>
					<?if ($_REQUEST['condition']=="Delete")
					{?>
					<td class="compareHead"><b>Delete</b></td>
					<?}?>
				</tr>
					<?
					//for($i=0,$j=0;$obj->next_record() && $j<$limit;$i++) {
					
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
												        
				        $activeflag = $obj->f('dashboard_status');
				        if ($activeflag=="N") {
				            $bgcolor = "red";
				            $classNormal = "align=center";
				            $classNormalLeft = "";
				            $status="Inactive";
				        }
				        else {
				            $bgcolor = "white";
				            $status="Active";
				            $classNormal="class='compareNormal'";
				            $classNormalLeft="class='compareNormalLeft'";
				        }
				?>
					<tr bgcolor="<?echo $bgcolor?>">
						<?echo "<td $classNormal>".htmlentities($dash_id)."</td>";
						
						echo "<td $classNormalLeft><a href='modify_dashboard.php?dash_id=$dash_id&condition=Modify'>".$dashboardDate."</a></td>";
						?>
						<td <?echo $classNormal?>><?echo $status?></td>
						<?if ($_REQUEST['condition']=='Delete')
						{?>
							<td <?echo $classNormal?>><input type='checkbox' name='pno[]' value='<?echo $dash_id;?>'></td>
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
				
					echo "<table width='95%' cellspacing='0' cellpadding='0' border=0 align=left><tr>";
					if ($_REQUEST['start']>0)
						echo"<td align='left'><a href='dashboard_select.php?start=$prev&condition=".$_REQUEST['condition']."&dashboard_date=".$_REQUEST['dashboard_date']."'><b>Previous</b></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
					else
						echo"<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
					$start=$_REQUEST['start']+$limit;
					if ($tot>$start)
						echo"<td align='right'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='dashboard_select.php?start=$start&condition=".$_REQUEST['condition']."&dashboard_date=".$_REQUEST['dashboard_date']."'><b>Next</b></a></td></tr></table>";
					else
						echo"<td align='right'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></table>";
					echo"</center>";
				
					if ($_REQUEST['condition']=='Delete')
					{?><br><br>

						<table width='95%' cellspacing='0' cellpadding='0' border=0 align=left>
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