<?
/*************************************************************************
   Type         :   Script
   File         :   php
   Date         :   December 16, 2008
   Author       :   Surinder Jangira
   Environment  :   PHP, Apache, MySQL
   Revisions    :
   Project      :   Pathcom Website
   File Name    :   rss_general_setup.php
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
	
if ($_REQUEST['submit1']=="Set Default RSS Feed")
{
	$_REQUEST['start']=0;
		
	$query="SELECT * FROM tbl_rss_general_setup";
	$obj->query($query);
	if ($obj->num_rows() > 0) {

		$query="UPDATE tbl_rss_general_setup SET rss_feed_id='".$_REQUEST['feedID']."'";
		$obj1->query($query);
	}
	else {
		
		$query="INSERT INTO tbl_rss_general_setup VALUES('', '".$_REQUEST['feedID']."')";
		$obj1->query($query);
	}?>
	<script language="javascript">
		alert("Record sucessfully modified.");
	</script>
<?}

?>

<SCRIPT language="javascript">
function showFeed(feed_id)
{
	mw='rssfeed_view.php?feed_id='+feed_id;
	mywin=window.open(mw,'a','scrollbars=1,HEIGHT=600,WIDTH=756');
	mywin.focus();
	return false;
}

function valid(a)
{
	chk=false;
	chkbox=-1;
	
	for(j=0;j<document.rss_general_setup.elements.length;j++)
	{
		if (document.rss_general_setup.elements[j].type=='radio')
		{
			if (chkbox==-1)
				chkbox=j;
			if (document.rss_general_setup.elements[j].checked)
				chk=true;
		}
	}
	if(!chk)
	{
		alert("Please select a RSS Feed");
		document.rss_general_setup.elements[chkbox].focus();
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
	    	<td align="left" valign="top" bgcolor="#FFFFFF" class="pagetitle">RSS General Setup<br/>
	    		<img src="<?echo TITLE_SEPERATOR_IMAGE?>"/>
	    	</td>
	    </tr>
	    <tr>
	    	<td height="15" bgcolor="#FFFFFF"></td>
	    </tr>
	    <tr>
	    	<td align="left" valign="top" bgcolor="#FFFFFF" class="text">
	    		<FORM name="rss_general_setup" method="POST" action="rss_general_setup.php">
				
	    		<?
				//
				$query1 = "SELECT * FROM `tbl_rss_general_setup`";
				$obj1->query($query1);
				if ($obj1->num_rows() > 0) {
					$obj1->next_record();
					$rss_feed_id = $obj1->f('rss_feed_id');
				}
				
				$query="SELECT * FROM `tbl_rss_feed` WHERE rss_feed_status='A' ORDER BY id DESC";
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
						Choose an RSS Feed that needs to be displayed as a default Feed.
					</td>
				</tr>
				</table>
				
				<table border=0 cellpadding=2 cellspacing=1 class="compare">
				<tr class="bodycontents">
					<td width='5%' class="compareHead"><b>Feed ID</b></td>
					<td width='65%' class="compareHead"><b>RSS Feed URL</b></td>
					<td width='25%' class="compareHead"><b>View RSS Feed</b></td>
					<td width='5%'  class="compareHead"><b>Status</b></td>
				</tr>
					<?
					//****************************************************************************
					// Iterate through the result set
					//****************************************************************************
					while($obj->next_record()) {
				
						$feedID=$obj->f('id');
						$rssFeedURL=trim($obj->f('rss_feed_url'));
				        $rssFeedStatus = $obj->f('rss_feed_status');
				        
						if ($rss_feed_id==$feedID)
							$sel3="checked";
						else 
							$sel3="";
						?>
					<tr bgcolor="white">
						<?echo "<td class='compareNormal'>$feedID</td>";
						echo "<td class='compareNormalLeft'>$rssFeedURL</td>";
						echo "<td class='compareNormal'><a href='' onClick='javascript:return showFeed($feedID);'><b>View</b></a></td>";?>
						<td class='compareNormal'><input type='radio' name='feedID' value='<?echo $feedID;?>' <?echo $sel3?>></td>
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
						echo"<td align='left'><a href='rss_general_setup.php?start=$prev'><b>Previous</b></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
					else
						echo"<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
					$start=$_REQUEST['start']+$limit;
					if ($tot>$start)
						echo"<td align='right'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='rss_general_setup.php?start=$start'><b>Next</b></a></td></tr></table>";
					else
						echo"<td align='right'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></table>";
					echo"</center><br>";?>
				
					<table align="left" width='96%' border=0>
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
			    			<center><input type="submit" name="submit1" value="Set Default RSS Feed" onClick="return valid(this);">&nbsp;&nbsp;<input type="reset" value="Reset" name="reset"></center>
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