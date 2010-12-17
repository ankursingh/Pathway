<?
/*************************************************************************
   Type         :   Script
   File         :   php
   Date         :   December 16, 2008
   Author       :   Surinder Jangira
   Environment  :   PHP, Apache, MySQL
   Revisions    :
   Project      :   Pathcom Website
   File Name    :   modify_keywords.php
   Purpose      :   This page deals with the display of the details related
   					to Search Keywords.
*************************************************************************/
require_once("./includes/include_files.php");
include_once "./classes/pathway_class.inc";

$obj = new pathway_class;
$obj1 = new pathway_class;

if ($_REQUEST['search_id']!="" && $_REQUEST['search_id']>0) {
	
    $query = "SELECT * FROM tbl_search WHERE search_id='".$_REQUEST['search_id']."'";
    //echo $query;
    $obj->query($query);
	if ($obj->num_rows()>0)
	{
        $obj->next_record();	    
    	$searchPageURL = trim($obj->f('search_page_url'));
		$searchTitle = trim($obj->f('search_title'));
		$searchTitleFrench = trim($obj->f('search_title_fr'));
		$searchKeyword = trim($obj->f('search_keyword'));
		$searchKeywordFrench = trim($obj->f('search_keyword_fr'));
		$searchDesc = trim($obj->f('search_description'));
		$searchDescFrench = trim($obj->f('search_description_fr'));
		$searchStatus = trim($obj->f('search_status'));
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
									    <table width="85%" border="0" cellpadding="0" cellspacing="0">
									    <tr>
									    	<td align="left" valign="top" bgcolor="#FFFFFF" class="pagetitle">View Search Keywords<br/>
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
													<td width="35%" height="25px" class="bodycontents" > <b>Search Page URL</b></td>
													<td height="25px">&nbsp;
														<input type="text" name="searchPageURL" value="<?php echo $searchPageURL?>" size="51" maxlength="255" readonly/>
													</td>
												</tr>
												
												<tr>
													<td width="35%" height="25px" class="bodycontents" > <b>Search Title (English)</b></td>
													<td height="25px">&nbsp;
														<input type="text" name="searchTitle" value="<?php echo $searchTitle?>" size="51" maxlength="255" readonly/>
													</td>
												</tr>
												
												<tr>
													<td width="35%" height="25px" class="bodycontents" > <b>Search Title (French)</b></td>
													<td height="25px">&nbsp;
														<input type="text" name="searchTitleFrench" value="<?php echo $searchTitleFrench?>" size="51" readonly maxlength="255"/>
													</td>
												</tr>
												
												<tr>
													<td width="35%" height="25px" class="bodycontents" > <b>Search Keywords (English)</b></td>
													<td height="25px">&nbsp;
														<TEXTAREA name="searchKeyword" cols="50" rows="6" readonly><?php echo $searchKeyword?></TEXTAREA>
													</td>
												</tr>
												  
												<tr>
													<td width="35%" height="25px" class="bodycontents" > <b>Search Keywords (French)</b></td>
													<td height="25px">&nbsp;
														<TEXTAREA name="searchKeywordFrench" cols="50" rows="6" readonly><?php echo $searchKeywordFrench?></TEXTAREA>
													</td>
												</tr>
												
												<tr>
													<td width="35%" height="25px" class="bodycontents" > <b>Search Description (English)</b></td>
													<td height="25px">&nbsp;
														<TEXTAREA name="searchDesc" cols="50" rows="6" readonly><?php echo $searchDesc?></TEXTAREA>
													</td>
												</tr>
												  
												<tr>
													<td width="35%" height="25px" class="bodycontents" > <b>Search Description (French)</b></td>
													<td height="25px">&nbsp;
														<TEXTAREA name="searchDescFrench" cols="50" rows="6" readonly><?php echo $searchDescFrench?></TEXTAREA>
													</td>
												</tr>
												  
												<tr>
													<td width="35%" height="25px" class="bodycontents" > <b>Search Keyword Status</b></td>
													<td height="25px" class="bodycontents">
														<?if ($searchStatus=="Y")
															$searchStatus= "Active";
														else if ($searchStatus=="N")
															$searchStatus= "Inactive";
														?>
														&nbsp;&nbsp;&nbsp;<input type="text" name="searchStatus" value="<?php echo $searchStatus?>" size="10" maxlength="255" readonly/>
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