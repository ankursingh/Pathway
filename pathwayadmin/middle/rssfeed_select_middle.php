<?
/*************************************************************************
   Type         :   Script
   File         :   php
   Date         :   December 16, 2008
   Author       :   Surinder Jangira
   Environment  :   PHP, Apache, MySQL
   Revisions    :
   Project      :   Pathcom Website
   File Name    :   news_select.php
   Purpose      :   This page deals with the display of the details related
   					to Search Keywords.
*************************************************************************/
require_once("./includes/include_files.php");
include_once "./classes/pathway_class.inc";

$obj = new pathway_class;
$obj1 = new pathway_class;


//****************************************************************************
// Redirect to "index" page, if no condition is specified.
//**************************************************************************** 
if (!isset($_REQUEST['condition'])) {?>
    <SCRIPT language="javascript">
	   window.location.href="index.php";
	</SCRIPT>
<?}

//****************************************************************************
// Declare Variables 
//****************************************************************************
if (!isset($_REQUEST['start']))
	$_REQUEST['start']=0;

if ($_REQUEST['start']<0)
	$_REQUEST['start']=0;

$limit=50;

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
			$query="SELECT * FROM tbl_rss_feed WHERE id='$val'";
			$obj->query($query);
			if ($obj->num_rows() > 0) {
				$query="DELETE FROM tbl_rss_feed WHERE id='$val'";
				$obj1->query($query);
			}
		}
	}
}

?>

<SCRIPT language="javascript">
function selAll()
{
	if (document.select_rssfeeds.sel.value=='Select All')
	{
		sel=true;
		selTag='UnSelect All';
	}
	else
	{
		sel=false;
		selTag='Select All';
	}

	for(j=0;j<document.select_rssfeeds.elements.length;j++)
	{
		if (document.select_rssfeeds.elements[j].type=='checkbox')
			document.select_rssfeeds.elements[j].checked=sel;
	}
	document.select_rssfeeds.sel.value=selTag;
	return true;
}

function valid(a)
{
	chk=false;
	chkbox=-1;
	for(j=0;j<document.select_rssfeeds.elements.length;j++)
	{
		if (document.select_rssfeeds.elements[j].type=='checkbox')
		{
			if (chkbox==-1)
				chkbox=j;
			if (document.select_rssfeeds.elements[j].checked)
				chk=true;
		}
	}
	if(!chk)
	{
		alert("Select atleast one RSS Feed ID");
		document.select_rssfeeds.elements[chkbox].focus();
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
	    	<td align="left" valign="top" bgcolor="#FFFFFF" class="pagetitle"><?echo $_REQUEST['condition']?> RSS Feeds<br/>
	    		<img src="<?echo TITLE_SEPERATOR_IMAGE?>"/>
	    	</td>
	    </tr>
	    <tr>
	    	<td height="15" bgcolor="#FFFFFF"></td>
	    </tr>
	    <tr>
	    	<td align="left" valign="top" bgcolor="#FFFFFF" class="text">
	    		<FORM name="select_rssfeeds" method="POST" action="rssfeed_select.php">
				<?
				if (!isset($act))
					$act="";
				if ($act!="")
					echo "<i>Member's Details have been  $act</i><br><br>";
				
				$query="SELECT * FROM tbl_rss_feed ORDER BY id DESC";
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
						Click on the RSS Feed URL that has to be <?echo $caption;?>
					</td>
				</tr>
				</table>
				
				<table border=0 cellpadding=2 cellspacing=1 class="compare">
				<tr class="bodycontents">
					<td width='5%' class="compareHead"><b>Feed ID</b></td>
					<td width='85%' class="compareHead"><b>RSS Feed URL</b></td>
					<td width='5%'  class="compareHead"><b>Status</b></td>
					<td class="compareHead"><b>Delete</b></td>
				</tr>
					<?
					//for($i=0,$j=0;$obj->next_record() && $j<$limit;$i++) {
					
					//****************************************************************************
					// Iterate through the result set
					//****************************************************************************
					while($obj->next_record()) {
						//if ($i<$_REQUEST['start'])
							//continue;
				
						$feedID=$obj->f('id');
						$rssFeedURL=trim($obj->f('rss_feed_url'));
				        $rssFeedStatus = $obj->f('rss_feed_status');
				        $rssFeedSource = $obj->f('rss_feed_source');
				        if ($rssFeedStatus=="I") {
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
						<?echo "<td $classNormal><a href='modify_rssfeed.php?feed_id=$feedID&condition=Modify'>".htmlentities($feedID)."</a></td>";
						echo "<td $classNormalLeft><a href='modify_rssfeed.php?feed_id=$feedID&condition=Modify'>".$rssFeedURL."</a><p><b>Source: </b>$rssFeedSource</p></td>";?>
						<td <?echo $classNormalLeft?>><?echo $status?></td>
						<td <?echo $classNormal?>><input type='checkbox' name='pno[]' value='<?echo $feedID;?>'></td>
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
				
					echo "<table width='96%' cellspacing='0' cellpadding='0' border=0 align=left><tr>";
					if ($_REQUEST['start']>0)
						echo"<td align='left'><a href='news_select.php?start=$prev&condition=".$_REQUEST['condition']."'><b>Previous</b></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
					else
						echo"<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
					$start=$_REQUEST['start']+$limit;
					if ($tot>$start)
						echo"<td align='right'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='news_select.php?start=$start&condition=".$_REQUEST['condition']."'><b>Next</b></a></td></tr></table>";
					else
						echo"<td align='right'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></table>";
					echo"</center><br>";
				
					if ($_REQUEST['condition']=='Delete')
					{?>
						<table align="left" width='96%' border=0>
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
				<input type="hidden" name="condition" value="<?echo $_REQUEST['condition'];?>">
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