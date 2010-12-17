<?
/*************************************************************************
   Type         :   Script
   File         :   php
   Date         :   December 16, 2008
   Author       :   Surinder Jangira
   Environment  :   PHP, Apache, MySQL
   Revisions    :
   Project      :   Pathcom Website
   File Name    :   general_setup.php
   Purpose      :   This page deals with the display of the details related
   					to Search Keywords.
*************************************************************************/
require_once("./includes/include_files.php");
include_once "./classes/pathway_class.inc";

$obj = new pathway_class;
$obj1 = new pathway_class;
$obj2 = new pathway_class;

$details = '<?xml version="1.0" encoding="ISO-8859-1" ?>
				<rss version="2.0">
					<channel>
						<title>Pathway Communications RSS Feed</title>
						<link>http://www.pathcom.com</link>';
$log_file_path="./news/";

function generateXML ($XML_Content, $log_file_path) {
	
	$retVal=false;
	
	$logfilename="rss.xml";
	$dest = $log_file_path.$logfilename;
	if (!file_exists($dest)) {
		if ($pfp=fopen($dest,'w')) {
			fwrite($pfp,$XML_Content);
			fclose($pfp);
			$retVal=true;
		}
	}
	else if (file_exists($dest) && is_writeable($dest)) {
		if ($pfp=fopen($dest,'w')) {
			fwrite($pfp,$XML_Content);
			fclose($pfp);
			$retVal=true;
		}
	}
	//echo $retVal;exit;	
	shell_exec("curl -T ./news/rss.xml -u ".PATHWAY_SITE_FTP_USER.":".PATHWAY_SITE_FTP_PASSWORD." ".PATHWAY_XML_FOLDER);

	return $retVal;
}

//****************************************************************************
// Declare Variables 
//****************************************************************************

if (!isset($_REQUEST['start']))
	$_REQUEST['start']=0;

if ($_REQUEST['start']<0)
	$_REQUEST['start']=0;
if (!isset($duplicate))
$duplicate='n';
	
$limit=500;

if (!isset($_REQUEST['submit1']))
	$_REQUEST['submit1']="";
	
if ($_REQUEST['submit1']=="Set Default Article")
{
	$_REQUEST['start']=0;
		
	$query="SELECT * FROM tbl_general_setup WHERE article_position='".$_REQUEST['columnType']."'";
	$obj->query($query);
	if ($obj->num_rows() > 0) {

		$obj->next_record();
		
		$setUpID = $obj->f('id');
		
		if ($_REQUEST['articleMode']=="F") {
			
			$query1 = "SELECT * FROM tbl_general_setup WHERE news_article_id='".trim($_REQUEST['article_ID'])."' AND news_article_id > 0 AND article_position!='".$_REQUEST['columnType']."'";
			$obj2->query($query1);
			$numRows = $obj2->num_rows();
			if ($numRows == 1) {
				$duplicate='y';
			}
			else 
				$duplicate='n';
			
			//else {
			if ($duplicate==='n') {
				
				$query="UPDATE tbl_general_setup SET article_state='".$_REQUEST['articleMode']."', news_article_id='".$_REQUEST['article_ID']."', article_position='".$_REQUEST['columnType']."', source_type='".$_REQUEST['LHS_DataSource']."' WHERE id='$setUpID'";
				$obj1->query($query);
				
				//Retrieve the Fixed article from the DB and consider it as a first ITEM in the XML file.
				$query="SELECT * FROM tbl_news_article WHERE news_article_id='".$_REQUEST['article_ID']."'";
				$obj->query($query);
				if ($obj->num_rows() > 0) {
				
					$obj->next_record();
					$articleID = $obj->f('news_article_id');
					$articleTitle = addslashes($obj->f('news_article_title'));
					$articleDesc = addslashes($obj->f('news_article_desc'));
					
					$articleURL=SITE_URL."/company/news_articles.php?id=".$articleID;
				
					$items .= '
				    	<item>
							 <title>'.$articleTitle.'</title>
							 <link>'.$articleURL.'</link>
							 <description><![CDATA['.stripslashes($articleDesc).']]></description>
						 </item>';	
				}
				
				//Get all the active articles ID, excluding the fixed article ID
				$query="SELECT * FROM tbl_news_article WHERE news_article_id!='".$_REQUEST['article_ID']."' ORDER BY news_article_id";
				$obj->query($query);
				if ($obj->num_rows() > 0) {
				
					while ($obj->next_record()) {
						$arrArticleID[] = $obj->f('news_article_id');
					}
				}
				
				//Shuffle the Articles to be displayed at Random
				if (is_array($arrArticleID))
					shuffle($arrArticleID);
				
				//Generate XML article nodes
				foreach ($arrArticleID as $key=>$val) {
				    
				    $query1="SELECT * FROM tbl_news_article WHERE (expiry_date='0000-00-00 00:00:00' OR expiry_date > now() ) AND news_article_flag='A' AND news_article_id='".$val."'";
				    $obj1->query($query1);
				    if ($obj1->num_rows() > 0) {
				    
				    	$obj1->next_record();
				    	
				    	$articleURL=SITE_URL."/company/news_articles.php?id=".$obj1->f('news_article_id');
				    	
				    	//Insert a dynamic link in the <link> node. eg. http://www.pathcom.com/articles/getAtricle.php?id=3				    	
					    $items .= '
					    	<item>
								 <title>'.addslashes($obj1->f("news_article_title")).'</title>
								 <link>'.$articleURL.'</link>
								 <description><![CDATA['.stripslashes($obj1->f("news_article_desc")).']]></description>
							 </item>';
				    }
				}
				$items .= '</channel>
						 </rss>';
						
				//Generate a XML file.
				$XML_Content = $details.$items;
				$result = generateXML($XML_Content, $log_file_path);
				
				//On successful generation, update "tbl_rss_feed" to list Pathway's XML file in the list.
				if ($result) {
					
					$query="SELECT * FROM `tbl_rss_feed` WHERE rss_feed_source='Pathway Communications'";
					$obj->query($query);
					if ($obj->num_rows() > 0) {
					
						$obj->next_record();
						$rssId = $obj->f('id');	
						
						//Update tbl_rss_feed
						$query="UPDATE tbl_rss_feed SET date=now() WHERE id='$rssId'";
						$obj->query($query);
						
						//Update tbl_general_setup
						$query="UPDATE tbl_general_setup SET news_feed_id='$rssId' WHERE id='$setUpID'";
						$obj->query($query);
					}
					else {
						
						//Location of Patwhay's RSS file.
						$rss_feed_url = SITE_URL."/news/rss.xml";
						
						//INSERT a record in tbl_rss_feed
						$query="INSERT INTO tbl_rss_feed (id, rss_feed_url, rss_feed_source, rss_feed_status, date) VALUES ('', '$rss_feed_url', 'Pathway Communications', 'A', now())";
	            		$obj->query($query);
	            		
	            		$rssFeedId = mysql_insert_id();
	            		
	            		//Update tbl_general_setup
						$query="UPDATE tbl_general_setup SET news_feed_id='$rssFeedId' WHERE id='$setUpID'";
						$obj->query($query);
					}
				}
				//exit;			
			}
		}
		else if ($_REQUEST['articleMode']=="R") {
			
			$query="UPDATE tbl_general_setup SET article_state='".$_REQUEST['articleMode']."', news_article_id='0', article_position='".$_REQUEST['columnType']."', source_type='".$_REQUEST['LHS_DataSource']."' WHERE id='$setUpID'";
			$obj1->query($query);
			
			/******** Create a XML file ********/
			$query="SELECT * FROM tbl_news_article WHERE (expiry_date='0000-00-00 00:00:00' OR expiry_date > now() ) AND news_article_flag='A'";
			$obj->query($query);
			$numOfArticles=$obj->num_rows();
			if ($numOfArticles > 0) {
	
				//Get all the active articles ID
				while ($obj->next_record()) {
					$arrArticleID[] = $obj->f('news_article_id');
				}
				
				//Shuffle the Articles to be displayed at Random
				if (is_array($arrArticleID))
					shuffle($arrArticleID);
				
				//Generate XML article nodes
				$items = '';
				foreach ($arrArticleID as $key=>$val) {
				    
				    $query1="SELECT * FROM tbl_news_article WHERE (expiry_date='0000-00-00 00:00:00' OR expiry_date > now() ) AND news_article_flag='A' AND news_article_id='".$val."'";
				    $obj1->query($query1);
				    if ($obj1->num_rows() > 0) {
				    
				    	$obj1->next_record();
				    	$articleURL=SITE_URL."/company/news_articles.php?id=".$obj1->f('news_article_id');
				    	
				    	//Insert a dynamic link in the <link> node. eg. http://www.pathcom.com/articles/getAtricle.php?id=3				    	
					    $items .= '
					    	<item>
								 <title>'.addslashes($obj1->f("news_article_title")).'</title>
								 <link>'.$articleURL.'</link>
								 <description><![CDATA['.addslashes($obj1->f("news_article_desc")).']]></description>
							 </item>';
				    }
				}
				
				$items .= '</channel>
					 </rss>';	
			}
			
			//Generate a XML file.
			$XML_Content = $details.$items;
			$result = generateXML($XML_Content, $log_file_path);
			
			//On successful generation, update "tbl_rss_feed" to list Pathway's XML file in the list.
			if ($result) {
				
				$query="SELECT * FROM `tbl_rss_feed` WHERE rss_feed_source='Pathway Communications'";
				$obj->query($query);
				if ($obj->num_rows() > 0) {
				
					$obj->next_record();
					$rssId = $obj->f('id');	
					
					//Update tbl_rss_feed
					$query="UPDATE tbl_rss_feed SET date=now() WHERE id='$rssId'";
					$obj->query($query);
					
					//Update tbl_general_setup
					$query="UPDATE tbl_general_setup SET news_feed_id='$rssId' WHERE id='$lastInsertId'";
					$obj->query($query);
				}
				else {
					
					//Location of Patwhay's RSS file.
					$rss_feed_url = SITE_URL."/news/rss.xml";
					
					//INSERT a record in tbl_rss_feed
					$query="INSERT INTO tbl_rss_feed (id, rss_feed_url, rss_feed_source, rss_feed_status, date) VALUES ('', '$rss_feed_url', 'Pathway Communications', 'A', now())";
            		$obj->query($query);
            		
            		$rssFeedId = mysql_insert_id();
            		
            		//Update tbl_general_setup
					$query="UPDATE tbl_general_setup SET news_feed_id='$rssFeedId' WHERE id='$lastInsertId'";
					$obj->query($query);
				}
			}
		}
	}
	else {
		
		$query1 = "SELECT * FROM tbl_general_setup WHERE news_article_id='".trim($_REQUEST['article_ID'])."' AND news_article_id > 0 AND article_position!='".$_REQUEST['columnType']."'";
		$obj2->query($query1);
		$numRows = $obj2->num_rows();
		if ($numRows == 1) {
			$duplicate='y';
		}
		else 
			$duplicate='n';
		
		//else {
		if ($duplicate==='n') {
		
			$query="INSERT INTO tbl_general_setup (id, news_article_id, article_state, article_position, source_type) VALUES('', '".$_REQUEST['article_ID']."', '".$_REQUEST['articleMode']."', '".$_REQUEST['columnType']."', '".$_REQUEST['LHS_DataSource']."')";
			$obj1->query($query);
			
			$lastInsertId = mysql_insert_id();
			
			if ($_REQUEST['articleMode']=="F") {
				
				$items = '';
	
				//Retrieve the Fixed article from the DB and consider it as a first ITEM in the XML file.
				$query="SELECT * FROM tbl_news_article WHERE news_article_id='".$_REQUEST['article_ID']."'";
				$obj->query($query);
				if ($obj->num_rows() > 0) {
				
					$obj->next_record();
					$articleID = $obj->f('news_article_id');
					$articleTitle = addslashes($obj->f('news_article_title'));
					$articleDesc = addslashes($obj->f('news_article_desc'));
					
					$articleURL=SITE_URL."/company/news_articles.php?id=".$articleID;
					
					$items .= '
				    	<item>
							 <title>'.$articleTitle.'</title>
							 <link>'.$articleURL.'</link>
							 <description><![CDATA['.$articleDesc.']]></description>
						 </item>';	
				}
				
				//Get all the active articles ID, excluding the fixed article ID
				$query="SELECT * FROM tbl_news_article WHERE news_article_id!='".$_REQUEST['article_ID']."' ORDER BY news_article_id";
				$obj->query($query);
				if ($obj->num_rows() > 0) {
				
					while ($obj->next_record()) {
						$arrArticleID[] = $obj->f('news_article_id');
					}
				}
				
				//Shuffle the Articles to be displayed at Random
				if (is_array($arrArticleID))
					shuffle($arrArticleID);
				
				//Generate XML article nodes
				foreach ($arrArticleID as $key=>$val) {
				    
				    $query1="SELECT * FROM tbl_news_article WHERE (expiry_date='0000-00-00 00:00:00' OR expiry_date > now() ) AND news_article_flag='A' AND news_article_id='".$val."'";
				    $obj1->query($query1);
				    if ($obj1->num_rows() > 0) {
				    
				    	$obj1->next_record();
				    	
				    	$articleURL=SITE_URL."/company/news_articles.php?id=".$obj1->f('news_article_id');
				    	
				    	//Insert a dynamic link in the <link> node. eg. http://www.pathcom.com/articles/getAtricle.php?id=3				    	
					    $items .= '
					    	<item>
								 <title>'.addslashes($obj1->f("news_article_title")).'</title>
								 <link>'.$articleURL.'</link>
								 <description><![CDATA['.addslashes($obj1->f("news_article_desc")).']]></description>
							 </item>';
				    }
				}
				$items .= '</channel>
						 </rss>';
	
				//Generate a XML file.
				$XML_Content = $details.$items;
				$result = generateXML($XML_Content, $log_file_path);
				
				//On successful generation, update "tbl_rss_feed" to list Pathway's XML file in the list.
				if ($result) {
					
					$query="SELECT * FROM `tbl_rss_feed` WHERE rss_feed_source='Pathway Communications'";
					$obj->query($query);
					if ($obj->num_rows() > 0) {
					
						$obj->next_record();
						$rssId = $obj->f('id');	
						
						//Update tbl_rss_feed
						$query="UPDATE tbl_rss_feed SET date=now() WHERE id='$rssId'";
						$obj->query($query);
						
						//Update tbl_general_setup
						$query="UPDATE tbl_general_setup SET news_feed_id='$rssId' WHERE id='$lastInsertId'";
						$obj->query($query);
					}
					else {
						
						//Location of Patwhay's RSS file.
						$rss_feed_url = SITE_URL."/news/rss.xml";
						
						//INSERT a record in tbl_rss_feed
						$query="INSERT INTO tbl_rss_feed (id, rss_feed_url, rss_feed_source, rss_feed_status, date) VALUES ('', '$rss_feed_url', 'Pathway Communications', 'A', now())";
	            		$obj->query($query);
	            		
	            		$rssFeedId = mysql_insert_id();
	            		
	            		//Update tbl_general_setup
						$query="UPDATE tbl_general_setup SET news_feed_id='$rssFeedId' WHERE id='$lastInsertId'";
						$obj->query($query);
					}
				}
			}
			else if ($_REQUEST['articleMode']=="R") {
				
				/******** Create a XML file ********/
				$query="SELECT * FROM tbl_news_article WHERE (expiry_date='0000-00-00 00:00:00' OR expiry_date > now() ) AND news_article_flag='A'";
				$obj->query($query);
				$numOfArticles=$obj->num_rows();
				if ($numOfArticles > 0) {
		
					//Get all the active articles ID
					while ($obj->next_record()) {
						$arrArticleID[] = $obj->f('news_article_id');
					}
					
					//Shuffle the Articles to be displayed at Random
					if (is_array($arrArticleID))
						shuffle($arrArticleID);
					
					//Generate XML article nodes
					$items = '';
					foreach ($arrArticleID as $key=>$val) {
					    
					    $query1="SELECT * FROM tbl_news_article WHERE (expiry_date='0000-00-00 00:00:00' OR expiry_date > now() ) AND news_article_flag='A' AND news_article_id='".$val."'";
					    $obj1->query($query1);
					    if ($obj1->num_rows() > 0) {
					    
					    	$obj1->next_record();
					    	$articleURL=SITE_URL."/company/news_articles.php?id=".$obj1->f('news_article_id');
					    	
					    	//Insert a dynamic link in the <link> node. eg. http://www.pathcom.com/articles/getAtricle.php?id=3				    	
						    $items .= '
						    	<item>
									 <title>'.addslashes($obj1->f("news_article_title")).'</title>
									 <link>'.$articleURL.'</link>
									 <description><![CDATA['.addslashes($obj1->f("news_article_desc")).']]></description>
								 </item>';
					    }
					}
					
					$items .= '</channel>
						 </rss>';	
				}
				
				//Generate a XML file.
				$XML_Content = $details.$items;
				$result = generateXML($XML_Content, $log_file_path);
				
				//On successful generation, update "tbl_rss_feed" to list Pathway's XML file in the list.
				if ($result) {
					
					$query="SELECT * FROM `tbl_rss_feed` WHERE rss_feed_source='Pathway Communications'";
					$obj->query($query);
					if ($obj->num_rows() > 0) {
					
						$obj->next_record();
						$rssId = $obj->f('id');	
						
						//Update tbl_rss_feed
						$query="UPDATE tbl_rss_feed SET date=now() WHERE id='$rssId'";
						$obj->query($query);
						
						//Update tbl_general_setup
						$query="UPDATE tbl_general_setup SET news_feed_id='$rssId' WHERE id='$lastInsertId'";
						$obj->query($query);
					}
					else {
						
						//Location of Patwhay's RSS file.
						$rss_feed_url = SITE_URL."/news/rss.xml";
						
						//INSERT a record in tbl_rss_feed
						$query="INSERT INTO tbl_rss_feed (id, rss_feed_url, rss_feed_source, rss_feed_status, date) VALUES ('', '$rss_feed_url', 'Pathway Communications', 'A', now())";
	            		$obj->query($query);
	            		
	            		$rssFeedId = mysql_insert_id();
	            		
	            		//Update tbl_general_setup
						$query="UPDATE tbl_general_setup SET news_feed_id='$rssFeedId' WHERE id='$lastInsertId'";
						$obj->query($query);
					}
				}
				/***********************************/
			}
		}
	}
	//exit;
	if ($duplicate!='y') {?>
	<script language="javascript">
		alert("Record sucessfully modified.");
		window.parent.location.href="index.php";
	</script>
<?	}
}

if ($_REQUEST['submit1']=="Set Default RSS Feed")
{
	$_REQUEST['start']=0;
		
	$query="SELECT * FROM tbl_general_setup WHERE article_position='".$_REQUEST['columnType']."'";
	$obj->query($query);
	if ($obj->num_rows() > 0) {

		$obj->next_record();
		
		$setUpID = $obj->f('id');
		
		//$query="UPDATE tbl_general_setup SET rss_feed_id='".$_REQUEST['feedID']."'";
		$query="UPDATE tbl_general_setup SET article_state='R', news_article_id='0', news_feed_id='".$_REQUEST['feedID']."', article_position='".$_REQUEST['columnType']."', source_type='".$_REQUEST['LHS_DataSource']."' WHERE id='$setUpID'";
		$obj1->query($query);
	}
	else {
		
		$query="INSERT INTO tbl_general_setup VALUES('', 0, '".$_REQUEST['feedID']."', 'R', '".$_REQUEST['columnType']."', '".$_REQUEST['LHS_DataSource']."')";
		$obj1->query($query);
	}?>
	<script language="javascript">
		alert("Record sucessfully modified.");
	</script>
<?}
?>

<SCRIPT language="javascript">

function validateNewsArt(a)
{
	chk1=false;
	chkbox1=-1;
	
	if (!document.general_setup.articleMode[0].checked && !document.general_setup.articleMode[1].checked) {
		alert("Select any one Display Option");
        document.general_setup.articleMode[0].focus();
        return false;
	}
	
	if (document.general_setup.articleMode[0].checked) {
		
		for(j=6;j<document.general_setup.elements.length;j++)
		{
			if (document.general_setup.elements[j].type=='radio' && document.general_setup.elements[j].name=='article_ID')
			{
				if (chkbox1==-1)
					chkbox1=j;
				if (document.general_setup.elements[j].checked)
					chk1=true;
			}
		}
		if(!chk1)
		{
			alert("Please select an Article");
			document.general_setup.elements[chkbox1].focus();
			return chk1;
		}
	}
	return true;
}

function SelectColumnType()
{
	<?if (isset($_REQUEST['columnType']) && $_REQUEST['columnType']!="") {?>
		document.getElementById("feedType").style.display="block";
		SelectFeedType();
	<?}?>
}

function SelectFeedType()
{
	if (document.general_setup.LHS_DataSource[0].checked) {
		document.getElementById("L_RSS").style.display="block";
		document.getElementById("L_PNA").style.display="none";
	}
	else if (document.general_setup.LHS_DataSource[1].checked) {
		document.getElementById("L_PNA").style.display="block";
		document.getElementById("L_RSS").style.display="none";
	}
}

function showFeed(feed_id)
{
	mw='rssfeed_view.php?feed_id='+feed_id;
	mywin=window.open(mw,'a','scrollbars=1,HEIGHT=600,WIDTH=756');
	mywin.focus();
	return false;
}

function validateRSS(a)
{
	chk=false;
	chkbox=-1;
	
	for(j=4;j<document.general_setup.elements.length;j++)
	{
		if (document.general_setup.elements[j].type=='radio' && document.general_setup.elements[j].name=='feedID')
		{
			if (chkbox==-1)
				chkbox=j;
			if (document.general_setup.elements[j].checked)
				chk=true;
		}
	}
	
	if(!chk)
	{
		alert("Please select a RSS Feed");
		document.general_setup.elements[chkbox].focus();
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
	    	<td align="left" valign="top" bgcolor="#FFFFFF" class="pagetitle">General Setup<br/>
	    		<img src="<?echo TITLE_SEPERATOR_IMAGE?>"/>
	    	</td>
	    </tr>
	    <tr>
	    	<td height="15" bgcolor="#FFFFFF"></td>
	    </tr>
	    <tr>
	    	<td align="left" valign="top" bgcolor="#FFFFFF" class="text">
	    		<FORM name="general_setup" method="POST" action="general_setup.php">
	    		
	    		<?
	    		if ($duplicate=='y')
					echo "<br><strong><span class=red>***</strong><i>An Entry already exists</i></font><br><br>";
							
	    		if ($_REQUEST['columnType']=="L")
	    			$sel1="checked";
    			else 
    				$sel1="";
	    		if ($_REQUEST['columnType']=="R")
	    			$sel2="checked";
    			else 
    				$sel2="";
	    		?>
	    		
	    		
				<table border="0" cellpadding="0" cellspacing="0" width="50%" class="bodycontents">
		    	<tr>
		    		<td width="30%"><b>Column Type:</b></td>
		    		<td width="5px;"></td>
		    		<td width="10px;"><input type="radio" name="columnType" value="L" <?echo $sel1?> onclick="javascript:SelectColumnType();document.general_setup.submit();"></td>
		    		<td width="20px;" class="bodycontents"><b>Left</b></td>
		    		<td width="5px;"></td>
		    		<td width="10px;"><input type="radio" name="columnType" value="R" <?echo $sel2?> onclick="javascript:SelectColumnType();document.general_setup.submit();"></td>
		    		<td class="bodycontents"><b>Right</b></td>
	    		</tr>
	    		</table>
	    		
	    		<div id="feedType" style="display:none;">
		    		<br>
		    		<?
	    			$query = "SELECT * FROM `tbl_general_setup` WHERE article_position='".$_REQUEST['columnType']."'";
	    			if ($obj->query($query) > 0) {
	    				$obj->next_record();
	    				$sourceType = $obj->f('source_type');
	    				if ($sourceType=="RSS")
	    					$sel4="checked";
    					else 
	    					$sel4="";
	    				if ($sourceType=="PNA")
	    					$sel5="checked";
    					else 
	    					$sel5="";
	    			}
		    		?>
					<table border="0" cellpadding="0" cellspacing="0" width="50%" class="bodycontents">
			    	<tr>
			    		<td width="30%"><b>Feed Type:</b></td>
			    		<td width="5px;"></td>
			    		<td width="10px;"><input type="radio" name="LHS_DataSource" value="RSS" <?echo $sel4?> onclick="javascript:SelectFeedType();"></td>
			    		<td width="20px;" class="bodycontents"><b>RSS</b></td>
			    		<td width="5px;"></td>
			    		<td width="10px;"><input type="radio" name="LHS_DataSource" value="PNA" <?echo $sel5?> onclick="javascript:SelectFeedType();"></td>
			    		<td class="bodycontents"><b>News Articles</b></td>
		    		</tr>
		    		</table>
	    		</div>
	    		
	    		<div id="L_RSS" style="display:none;">
	    			<br>
	    			<?
					//
					$query1 = "SELECT * FROM `tbl_general_setup` WHERE article_position='".$_REQUEST['columnType']."' AND source_type='RSS'";
					$obj1->query($query1);
					if ($obj1->num_rows() > 0) {
						$obj1->next_record();
						$rss_feed_id = $obj1->f('news_feed_id');
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
				    			<center><input type="submit" name="submit1" value="Set Default RSS Feed" onClick="return validateRSS(this);">&nbsp;&nbsp;<input type="reset" value="Reset" name="reset"></center>
							</td>
						</tr>
						</table>
					<?}
					else
						echo "<center><hr><i>No Records</i></center><hr>";
					?>
	    		</div>
	    		
				<div id="L_PNA" style="display:none;">
					<?$query1 = "SELECT * FROM tbl_general_setup WHERE article_position='".$_REQUEST['columnType']."' AND source_type='PNA'";
					//echo "<br>".$query1;
					$obj1->query($query1);
					if ($obj1->num_rows() > 0) {
						$obj1->next_record();
						$newsArticleID = $obj1->f('news_article_id');
						$newsArticleMode = $obj1->f('article_state');
						$newsArticleSource = $obj1->f('source_type');
						
						if ($newsArticleMode=="F")
							$sel1="checked";
						else 
							$sel1="";
							
						if ($newsArticleMode=="R")
							$sel2="checked";
						else 
							$sel2="";
					}?>
					<br>
					<table border=0 width="55%" cellpadding="0" cellspacing="0" align="left">
					<tr>
						<td class="bodycontents" style="padding-left:5px;"><b>Article Display Mode:</b></td>
						<td class="bodycontents">
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
					    	<tr>
					    		<td><input type="radio" name="articleMode" value="F" <?echo $sel1?>></td>
					    		<td class="bodycontents"><b>Fixed</b></td>
					    		<td class="bodycontents" width="5px;"></td>
					    		<td><input type="radio" name="articleMode" value="R" <?echo $sel2?>></td>
					    		<td class="bodycontents"><b>Random</b></td>
				    		</tr>
				    		</table>
						</td>
					</tr>
					</table>
					<br><br>
					<table width='100%' border="0" align="center">
					<tr>
					    <td colspan="2"><img src="<?echo TITLE_SEPERATOR_IMAGE?>"/></td>
					</tr>
					<tr>
					    <td colspan="2" height="5px"></td>
					</tr>
					</table>
				
					<?
					
					$query="SELECT * FROM tbl_news_article WHERE 1=1 AND (expiry_date='0000-00-00 00:00:00' OR expiry_date > now() ) AND news_article_flag='A' ";
					$query=$query." order by news_article_id DESC";
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
							Choose an Article that needs to be displayed as a default Article.
						</td>
					</tr>
					</table>
					
					<div class="scroll">
						<table border=0 cellpadding=2 cellspacing=1 class="genSetup">
						<tr class="bodycontents">
							<td width='10%' class="genSetupHead"><b>Article ID</b></td>
							<td width='35%' class="genSetupHead"><b>News Article Title</b></td>
							<td width='50%' class="genSetupHead"><b>News Article Description</b></td>
							<td width='5%'  class="genSetupHead"><b>Set Default</b></td>
						</tr>
							<?
							//for($i=0,$j=0;$obj->next_record() && $j<$limit;$i++) {
							
							//****************************************************************************
							// Iterate through the result set
							//****************************************************************************
							while($obj->next_record()) {
						
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
								
								if ($newsArticleID==$articleID)
									$sel3="checked";
								else 
									$sel3="";
								?>
							<tr bgcolor="white">
								<?echo "<td class='genSetupNormal'>".htmlentities($articleID)."</td>";
								echo "<td class='genSetupNormalLeft'>$newsArticleTitle</td>";?>
								<td class='genSetupNormalLeft'><?echo htmlentities($newsArticleDesc)?></td>
								<td class='genSetupNormal'><input type='radio' name='article_ID' value='<?echo $articleID;?>' <?echo $sel3?>></td>
							</tr>
						<?}?>
						</table>
						</div>
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
							echo"<td align='left'><a href='general_setup.php?start=$prev'><b>Previous</b></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
						else
							echo"<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
						$start=$_REQUEST['start']+$limit;
						if ($tot>$start)
							echo"<td align='right'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='general_setup.php?start=$start'><b>Next</b></a></td></tr></table>";
						else
							echo"<td align='right'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></table>";
						echo"</center><br>";?>
					
						<br>
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
				    			<center><input type="submit" name="submit1" value="Set Default Article" onClick="return validateNewsArt(this);">&nbsp;&nbsp;<input type="reset" value="Reset" name="reset"></center>
							</td>
						</tr>
						</table>
				</div>
				<?}
				else {
					echo "<center><hr><i>No Records</i></center><hr>";
				}
				
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