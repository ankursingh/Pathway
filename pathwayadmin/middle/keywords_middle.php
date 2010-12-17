<?
/*************************************************************************
   Type         :   Script
   File         :   php
   Date         :   December 16, 2008
   Author       :   Surinder Jangira
   Environment  :   PHP, Apache, MySQL
   Revisions    :
   Project      :   Pathcom Website
   File Name    :   keywords.php
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

$limit=50;

if (!isset($_REQUEST['submit1']))
	$_REQUEST['submit1']="";
	
if ($_REQUEST['submit1']=='View All Articles') {?>
	<SCRIPT language="javascript">
	   window.location.href="keywords.php?condition=<?echo $_REQUEST['condition']?>";
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
			$query="SELECT * FROM tbl_search WHERE search_id='$val'";
			$obj->query($query);
			if ($obj->num_rows() > 0) {
				$query="DELETE FROM tbl_search WHERE search_id='$val'";
				//echo $query."<br>";
				$obj1->query($query);
			}
		}
	}
}
?>

<script language='javascript'>
function showKeyword(search_id)
{
	mw='keywords_view.php?search_id='+search_id;
	mywin=window.open(mw,'a','scrollbars=1,HEIGHT=606,WIDTH=756');
	mywin.focus();
	return false;
}

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

function search_valid()
{
	val1=document.keywords.search_column[document.keywords.search_column.selectedIndex].value;
	val2=document.keywords.search_criteria[document.keywords.search_criteria.selectedIndex].value;
	if (val1=='search_title')
		valastname='Search Title';
	if (val1=='search_id')
		valastname='Search ID';
	if (val1=='search_keyword')
		valastname='Search Keyword';
	if (val1=='')
	{
		alert("Select a search criteria to proceed");
		document.keywords.search_column.focus();
		return false;
	}		
	if (val2=='')
	{
		alert("Select a search criteria to proceed");
		document.keywords.search_criteria.focus();
		return false;
	}		
	if (!isEmpty(document.keywords.search_value, valastname))
		return false;
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
		alert("Select atleast one Search ID");
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
	    	<td align="left" valign="top" bgcolor="#FFFFFF" class="pagetitle"><?echo $_REQUEST['condition']?> Search Keywords<br/>
	    		<img src="<?echo TITLE_SEPERATOR_IMAGE?>"/>
	    	</td>
	    </tr>
	    <tr>
	    	<td height="15" bgcolor="#FFFFFF"></td>
	    </tr>
	    <tr>
	    	<td align="left" valign="top" bgcolor="#FFFFFF" class="	text">
	    		<form name='keywords' method='post' action='keywords.php'>
				<?
				if (!isset($act))
					$act="";
				if ($act!="")
					echo "<i>Member's Details have been  $act</i><br><br>";
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
						if ($_REQUEST['search_column']=='search_id')
						{?>
							<option selected value='search_id'>Search ID</option>
						<?}
						else
						{?>
							<option value='search_id'>Search ID</option>
						<?}
						
						if ($_REQUEST['search_column']=='search_title')
						{?>
							<option selected value='search_title'>Search Page Title</option>
						<?}
						else
						{?>
							<option value='search_title'>Search Page Title</option>
						<?}
					
						if ($_REQUEST['search_column']=='search_keyword')
						{?>
							<option selected value='search_keyword'>Search Keyword</option>
						<?}
						else
						{?>
							<option value='search_keyword'>Search Keyword</option>
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
				        <input type="submit" name="submit1" value="View All Articles">
				    </td>
				</tr>
				<tr>
				    <td height="5px"></td>
				</tr>
				</table>
				
				<?
				if ($search_condition!="")
					$search_condition1=$search_condition;
				
				$query="SELECT * FROM tbl_search WHERE 1=1 ";
				$query=$query.$search_condition1." order by search_page_url";
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
					<td width='10%' class="compareHead"><b>Search ID</b></td>
					<td width='35%' class="compareHead"><b>Search Page URL</b></td>
					<td width='25%' class="compareHead"><b>Search Title</b></td>
					<td width='25%' class="compareHead"><b>Search Keywords</b></td>
					<td width='5%'  class="compareHead"><b>Status</b></td>
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
						//if ($i<$_REQUEST['start'])
							//continue;
				
						$search_id=$obj->f('search_id');
						$searchPageURL=trim($obj->f('search_page_url'));
						$searchTitle=trim($obj->f('search_title'));
						$searchKeyword=trim($obj->f('search_keyword'));
						if ($searchKeyword!="") {
				            $searchArr = explode(" ", $searchKeyword);
				            $searchKeyword="";
				            
				            for ($i=0;$i <5; $i++) {
				                $searchKeyword .= $searchArr[$i]." ";
				            }
				            if (sizeof($searchArr) > 5 )
				                $searchKeyword.=" more...";
						}
				        
				        $activeflag = $obj->f('search_status');
				        if ($activeflag=="N") {
				            $bgcolor = "red";
				            $classNormal = "align=center";
				            $classNormalLeft = "";
				            $status="Inactive";
				        }
				        else {
				            $bgcolor = "white";
				            $status="Active";
				            //$classNormal="class='compareNormal'";
				            //$classNormalLeft="class='compareNormalLeft'";
				            $classNormal="align=center";
				            $classNormalLeft="style='padding-left:5px;'";
				        }
				?>
					<tr bgcolor="<?echo $bgcolor?>">
						<?if ($_REQUEST['condition']=="View")
						{?>
				            <td <?echo $classNormal?>><a href='' onClick="javascript:return showKeyword(<?echo $search_id;?>);"><?echo htmlentities($search_id);?></a></td>
						<?}
						else if ($_REQUEST['condition']=="Modify")
						{
							echo "<td $classNormal><a href='modify_keywords.php?search_id=$search_id&condition=Modify'>".htmlentities($search_id)."</a></td>";
						}
						else
						{
							echo "<td $classNormal>".htmlentities($search_id)."</td>";
						}
						
						if ($_REQUEST['condition']=="View") {?>
							<td <?echo $classNormalLeft?>><a href='' onClick="javascript:return showKeyword(<?echo $search_id;?>);"><?echo $searchPageURL;?></a></td>
						<?
						}
						else if ($_REQUEST['condition']=="Modify")
							echo "<td $classNormalLeft><a href='modify_keywords.php?search_id=$search_id&condition=Modify'>".$searchPageURL."</a></td>";
						else 
							echo "<td $classNormalLeft>$searchPageURL</td>";
						?>
						<td <?echo $classNormalLeft?>><?echo htmlentities($searchTitle)?></td>
						<td <?echo $classNormalLeft?>><?echo htmlentities($searchKeyword)?></td>
						<td <?echo $classNormal?>><?echo $status?></td>
						<?if ($_REQUEST['condition']=='Delete')
						{?>
							<td <?echo $classNormal?>><input type='checkbox' name='pno[]' value='<?echo $search_id;?>'></td>
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
						echo"<td align='left'><a href='keywords.php?start=$prev&condition=".$_REQUEST['condition']."&search_column=".$_REQUEST['search_column']."&search_criteria=".$_REQUEST['search_criteria']."&search_value=".$_REQUEST['search_value']."'><b>Previous</b></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
					else
						echo"<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
					$start=$_REQUEST['start']+$limit;
					if ($tot>$start)
						echo"<td align='right'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='keywords.php?start=$start&condition=".$_REQUEST['condition']."&search_column=".$_REQUEST['search_column']."&search_criteria=".$_REQUEST['search_criteria']."&search_value=".$_REQUEST['search_value']."'><b>Next</b></a></td></tr></table>";
					else
						echo"<td align='right'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></table>";
					echo"<center>";
				
					if ($_REQUEST['condition']=='Delete')
					{?><br><br>
						<table align="left" width='100%' border=0>
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