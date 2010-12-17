<?
/*************************************************************************
   Type         :   Script
   File         :   php
   Date         :   May 28, 2009
   Author       :   Surinder Jangira
   Environment  :   PHP, Apache, MySQL
   Revisions    :
   Project      :   Pathcom Website
   File Name    :   articles_view.php
   Purpose      :   This page deals with the display of the details related
   					to Articles.
*************************************************************************/
require_once("./includes/include_files.php");
include_once "./classes/pathway_class.inc";

$obj = new pathway_class;
$obj1 = new pathway_class;

if ($_REQUEST['article_id']!="" && $_REQUEST['article_id']>0) {
	
    $query = "SELECT * FROM tbl_news_article WHERE news_article_id='".$_REQUEST['article_id']."'";
    //echo $query;
    $obj->query($query);
	if ($obj->num_rows()>0)
	{
        $obj->next_record();	    
		$news_article_title = trim($obj->f('news_article_title'));
		$news_article_desc = trim($obj->f('news_article_desc'));
		$news_article_source = trim($obj->f('news_article_source'));
		$articleStatus = trim($obj->f('news_article_flag'));
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
	//require_once('../includes/analytics_script.php'); 	
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
									    	<td align="left" valign="top" bgcolor="#FFFFFF" class="pagetitle">View News Articles<br/>
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
												<tr>
													<td width="35%" height="25px" class="bodycontents" > <b>News Article Title</b></td>
													<td height="25px">&nbsp;
														<INPUT type="text" name="news_article_title" value="<?echo $news_article_title?>" size="40" maxlength="150" readonly>
													</td>
												</tr>
												
												<tr>
													<td width="35%" height="25px" class="bodycontents" > <b>News Article Description</b></td>
													<td height="25px">&nbsp;
														<TEXTAREA name="news_article_desc" cols="40" rows="10" readonly><?echo $news_article_desc?></TEXTAREA>
													</td>
												</tr>
												
												<tr>
													<td width="35%" height="25px" class="bodycontents" > <b>News Article Source</b></td>
													<td height="25px">&nbsp;
														<INPUT type="text" name="news_article_source" value="<?echo $news_article_source?>" size="20" maxlength="50" readonly>
													</td>
												</tr>
												
												<tr>
													<td width="35%" height="25px" class="bodycontents" > <b>News Article Flag</b></td>
													<td height="25px" class="bodycontents">
														<?if ($articleStatus=="A")
															$articleStatus= "Active";
														else if ($articleStatus=="I")
															$articleStatus= "Inactive";
														?>
														&nbsp;&nbsp;&nbsp;<input type="text" name="articleStatus" value="<?php echo $articleStatus?>" size="10" maxlength="255" readonly/>
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