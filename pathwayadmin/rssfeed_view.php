<?
/*************************************************************************
   Type         :   Script
   File         :   php
   Date         :   June 02, 2009
   Author       :   Surinder Jangira
   Environment  :   PHP, Apache, MySQL
   Revisions    :
   Project      :   Pathcom Website
   File Name    :   rssfeed_view.php
   Purpose      :   This page deals with the display of the details related
   					to RSS FEEDs.
*************************************************************************/
require_once("./includes/include_files.php");
include_once "./classes/pathway_class.inc";
require_once "./includes/rss_fetch.inc";

$obj = new pathway_class;

if ($_REQUEST['feed_id']!="" && $_REQUEST['feed_id']>0) {
	
    $query = "SELECT * FROM tbl_rss_feed WHERE id='".$_REQUEST['feed_id']."'";
    $obj->query($query);
	if ($obj->num_rows()>0)
	{
        $obj->next_record();	    
    	$rss_feed_url = trim($obj->f('rss_feed_url'));
    }
    else {?>
        <SCRIPT language="javascript">
           alert("Invalid Access");
	       window.close();
	   </SCRIPT>
<?    }
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>

<?php 
	require_once('./includes/meta.php'); 
	require_once('./includes/javascript.php'); 
	//require_once('./includes/analytics_script.php'); 	
?>
<style type="text/css">
.fix {font-family: verdana, arial, helvetica; font-size: 11px; color: #626278;}
.text
{	
	font : normal 11px Verdana, Arial, Helvetica, sans-serif;
	color: #5D5D5D;	
}
input{
	font : bold 10px Verdana, Arial, Helvetica, sans-serif;
	background-color: #ffffff;	
	border: 1px solid #4076A6;
}
textarea{
	font : bold 10px Verdana, Arial, Helvetica, sans-serif;
	background-color: #ffffff;	
	border: 1px solid #4076A6;
}
select
{
	font : bold 10px Verdana, Arial, Helvetica, sans-serif;
	background-color: #ffffff;	
	border: 1px solid #4076A6;
}
.submitButton
{
	font : bold 10px Verdana, Arial, Helvetica, sans-serif;
	background-color: aqua;	
	border: 1px solid #4076A6;
}
</style>
</head>
<BODY>

<table width="100%" border="0" cellpadding="0" cellspacing="0" >
<tr>
	<td align="center" valign="top">
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
			<td align="center" valign="top" background="/images/header/inner_main_bg.gif" style="background-repeat:repeat-y; padding-left:20px">
          		<table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="75%" align="left" valign="top" style="padding-top:3">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                	        <td align="left" valign="top">
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
									    <table width="80%" border="0" cellpadding="0" cellspacing="0">
									    <tr>
									    	<td align="left" valign="top" bgcolor="#FFFFFF" class="pagetitle">View RSS Feeds<br/>
									    		<img src="<?echo TITLE_SEPERATOR_IMAGE?>"/>
									    	</td>
									    </tr>
									    <tr>
									    	<td height="15" bgcolor="#FFFFFF"></td>
									    </tr>
									    <tr>
									    	<td align="left" valign="top" bgcolor="#FFFFFF" class="text">
												<table border="0" width="100%" cellpadding="0" cellspacing="0" align="center">
												  <!-- Form Fields - Personal Data -->
												  <?
													$rss = fetch_rss($rss_feed_url);
												  ?>
												<tr>
													<td width="10%" height="25px" class="bodycontents" > <b>Site:</b></td>
													<td height="25px" class="bodycontents">&nbsp;
														<?echo $rss->channel['title']?>
													</td>
												</tr>
												
												<tr>
													<td colspan="2" class="bodycontents" style="padding-left:20px;" >
														<?
														$items = $rss->items;
													
														foreach ($items as $item )
														{
														 $title = $item[title];
														 $url   = $item[link];
														 $description = $item['description'];
														 echo "<li><a href='$url' target='_blank'>$title</a><br />$description</li>";
														}?>
													</td>
												</tr>
											  	</table>
									    	</td>
									    </tr>
										<tr>
											<td valign="top" bgcolor="#FFFFFF" align="center">&nbsp;<a href="javascript:window.close();">Close Window</a></td>
										</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td background="/images/innertab/bg_05.gif" style="background-repeat:no-repeat">&nbsp</td>
								</tr>        
								</table>
                	        </td>
                        </tr>
                        </table>
                    </td>
                </tr>
                </table>
			</td>
		</tr>
		</table>
    </td>
</tr>
</table>
</body>
</html>