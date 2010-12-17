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
	   window.location.href="news_select.php?condition=<?echo $_REQUEST['condition']?>";
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
			$query="SELECT * FROM tbl_news_article WHERE news_article_id='$val'";
			$obj->query($query);
			if ($obj->num_rows() > 0) {
				$query="DELETE FROM tbl_news_article WHERE news_article_id='$val'";
				$obj1->query($query);
			}
		}
	}
}

?>

<SCRIPT language="javascript">
function showArticle(article_id)
{
	mw='articles_view.php?article_id='+article_id;
	mywin=window.open(mw,'a','scrollbars=1,HEIGHT=326,WIDTH=756');
	mywin.focus();
	return false;
}

function selAll()
{
	if (document.select_news.sel.value=='Select All')
	{
		sel=true;
		selTag='UnSelect All';
	}
	else
	{
		sel=false;
		selTag='Select All';
	}

	for(j=5;j<document.select_news.elements.length;j++)
	{
		if (document.select_news.elements[j].type=='checkbox')
			document.select_news.elements[j].checked=sel;
	}
	document.select_news.sel.value=selTag;
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
	val1=document.select_news.search_column[document.select_news.search_column.selectedIndex].value;
	val2=document.select_news.search_criteria[document.select_news.search_criteria.selectedIndex].value;
	if (val1=='news_article_title')
		valastname='News Title';
	if (val1=='news_article_desc')
		valastname='News Description';
	if (val1=='')
	{
		alert("Select a search criteria to proceed");
		document.select_news.search_column.focus();
		return false;
	}		
	if (val2=='')
	{
		alert("Select a search criteria to proceed");
		document.select_news.search_criteria.focus();
		return false;
	}		
	if (!isEmpty(document.select_news.search_value, valastname))
		return false;
}

function valid(a)
{
	chk=false;
	chkbox=-1;
	for(j=5;j<document.select_news.elements.length;j++)
	{
		if (document.select_news.elements[j].type=='checkbox')
		{
			if (chkbox==-1)
				chkbox=j;
			if (document.select_news.elements[j].checked)
				chk=true;
		}
	}
	if(!chk)
	{
		alert("Select atleast one Article ID");
		document.select_news.elements[chkbox].focus();
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
	    	<td align="left" valign="top" bgcolor="#FFFFFF" class="pagetitle"><?echo $_REQUEST['condition']?> News Articles<br/>
	    		<img src="<?echo TITLE_SEPERATOR_IMAGE?>"/>
	    	</td>
	    </tr>
	    <tr>
	    	<td height="15" bgcolor="#FFFFFF"></td>
	    </tr>
	    <tr>
	    	<td align="left" valign="top" bgcolor="#FFFFFF" class="text">
	    		<FORM name="select_news" method="POST" action="news_select.php">
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
							<?	if ($_REQUEST['search_column']=='') {?>
				    				<option selected value=''></option>
				    		<?	}
				    			else {?>
				    				<option value=''></option>
				    		<?	}
				    			if ($_REQUEST['search_column']=='news_article_title') {?>
				    				<option selected value='news_article_title'>News Title</option>
				    		<?	}
				    			else {?>
				    				<option value='news_article_title'>News Title</option>
				    		<?	}
				    			if ($_REQUEST['search_column']=='news_article_desc') {?>
				    				<option selected value='news_article_desc'>News Description</option>
				    		<?	}
				    			else {?>
				    				<option value='news_article_desc'>News Description</option>
				    		<?	}?>
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
				
				$query="SELECT * FROM tbl_news_article WHERE 1=1 ";
				$query=$query.$search_condition1." order by news_article_id DESC";
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
						Click on the Article Title that has to be <?echo $caption;?>
					</td>
				</tr>
				</table>
				
				<table border=0 cellpadding=2 cellspacing=1 class="compare">
				<tr class="bodycontents">
					<td width='10%' class="compareHead"><b>Article ID</b></td>
					<td width='35%' class="compareHead"><b>News Article Title</b></td>
					<td width='50%' class="compareHead"><b>News Article Description</b></td>
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
				
						$articleID=$obj->f('news_article_id');
						$newsArticleTitle=trim($obj->f('news_article_title'));
						$newsArticleDesc=trim($obj->f('news_article_desc'));
						if ($newsArticleDesc!="") {
				            $articleArr = explode(" ", $newsArticleDesc);
				            $newsArticleDesc="";
				            
				            for ($i=0;$i <15; $i++) {
				                $newsArticleDesc .= $articleArr[$i]." ";
				            }
				            if (sizeof($articleArr) > 15 )
				                $newsArticleDesc.=" more...";
						}
				        
				        $activeflag = $obj->f('news_article_flag');
				        if ($activeflag=="I") {
				            $bgcolor = "red";
				            $classNormal = "align=center";
				            $classNormalLeft = "style='padding-left:5px;'";
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
						<?echo "<td $classNormal><a href='modify_news.php?article_id=$articleID&condition=Modify'>".htmlentities($articleID)."</a></td>";			
						echo "<td $classNormalLeft><a href='modify_news.php?article_id=$articleID&condition=Modify'>".$newsArticleTitle."</a></td>";
						?>
						<td <?echo $classNormalLeft?>><?echo htmlentities($newsArticleDesc)?></td>
						<td <?echo $classNormal?>><?echo $status?></td>
						<td <?echo $classNormal?>><input type='checkbox' name='pno[]' value='<?echo $articleID;?>'></td>
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
						echo"<td align='left'><a href='news_select.php?start=$prev&condition=".$_REQUEST['condition']."&search_column=".$_REQUEST['search_column']."&search_criteria=".$_REQUEST['search_criteria']."&search_value=".$_REQUEST['search_value']."'><b>Previous</b></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
					else
						echo"<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
					$start=$_REQUEST['start']+$limit;
					if ($tot>$start)
						echo"<td align='right'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='news_select.php?start=$start&condition=".$_REQUEST['condition']."&search_column=".$_REQUEST['search_column']."&search_criteria=".$_REQUEST['search_criteria']."&search_value=".$_REQUEST['search_value']."'><b>Next</b></a></td></tr></table>";
					else
						echo"<td align='right'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></table>";
					echo"</center><br>";
				
					if ($_REQUEST['condition']=='Delete')
					{?><br><br>
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