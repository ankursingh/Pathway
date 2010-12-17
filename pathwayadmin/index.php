<?require_once("./includes/include_files.php");
include_once "./classes/pathway_class.inc";
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>

<?php 
	require_once('./includes/meta.php'); 
	require_once('./includes/javascript.php'); 
?>
</head>
<BODY>

<table width="100%" border="0" cellpadding="0" cellspacing="0" >
<tr>
	<td align="center" valign="top">
		<table width="845" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
			<td align="left" valign="top"><?php require_once('./header/keyheader_admin.php');?></td>
		</tr>
		<tr>
			<td align="center" valign="top" background="./images/header/main_bg.gif" style="background-repeat:repeat-y">
		      	<?require("./includes/banner_admin.php")?>
			</td>
          </tr>
		<tr>
		  <td align="center" valign="top" background="/images/header/inner_main_bg.gif" style="background-repeat:repeat-y; padding-left:20px">
          		<table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                    <td width="25%" align="left" valign="top" style="padding-left:17px">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                        <td align="left" valign="top"><?php require_once('./menu/admin_rightmenu.php'); ?></td>
                        </tr>
                        </table>
                    </td>
                    <td width="75%" align="left" valign="top" style="padding-top:3">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                        <td align="left" valign="top"><?php require_once('./middle/index_middle.php'); ?></td>
                        </tr>
                        </table>
                    </td>
                    </tr>
                </table>
       		  <br>
	      </td>
		  </tr>
		<tr>
			<td align="left" valign="top"><?php require_once('./footer/footer_admin.php'); ?></td>
		</tr>
		</table>
    </td>
</tr>
</table>
</body>
</html>