<?php
$path_link = pathinfo($_SERVER["PHP_SELF"]); // global variable declaration
if (strlen($path_link['dirname'])==1)
	$module=$path_link['dirname']."home";
else 
	$module=$path_link['dirname'];?>
	
<style>
.innerTable {  background-color: #eff1f9; }
</style>

<!-- header table/--><style type="text/css">
<!--
body {
	background-color: #8a9dae;
	margin-left: 0px;
	margin-top: 45px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style>

<table width="854" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
    <td align="left" valign="top"><img src="/images/header/header_01.gif" /></td>
    <td align="left" valign="top"><img src="/images/header/header_02.gif" /></td>
    <td align="left" valign="top"><img src="/images/header/header_03.gif" /></td>
    <td align="left" valign="top"><img src="/images/header/header_04.gif" /></td>
    <td align="left" valign="top"><img src="/images/header/header_05.gif" /></td>
    <td class="boxbg" align="center" width="190">
        <form action="" name="tip_Form" id="tip_Form" onsubmit="search_form(tip_Form); return false">           
          <table border="0" cellpadding="0" cellspacing="0">
            <tr>
            <td>
            	<!--img src="/images/header/search_top.gif"--></td>
            </tr>
            <tr>
            	<td>
                    <!--table border="0" cellpadding="0" cellspacing="0"><tr>
                    <td align="left" valign="middle"><img src="../images/header/search.gif"></td>
                    <td valign="middle" >
                        <input name="d2" type="text" class="searchbox" onblur="search_form(tip_Form); return false" onclick="this.value=''" value="Search...." maxlength="12" />   
                        <input type="hidden" name="module" value="<?echo $module;?>"/>                                 
                    </td></tr>
                    </table-->
                    <input type="hidden" name="module" value="<?echo $module;?>"/>
            	</td>
        	</tr>
            <tr>
            <td colspan="2"><!--img src="/images/header/search_bottom.gif"--></td>
            </tr>
          </table>
	</td></form>  
    <td align="right" valign="middle"><img src="/images/header/header_07.gif"/></td>
</tr>
<tr>
	<td colspan="8" align="left" valign="top" background="/images/header/main_bg.gif" style="background-repeat:repeat-y">
    	<table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
        	<td width="28" align="left" valign="top"><img src="/images/header/menu_left_corner.gif"/></td>
        	<td width="854" align="left" valign="top" background="/images/header/menu_bg.gif" style="background-repeat:repeat-x">
	        	
			</td>
			<td align="right" valign="top"><img src="/images/header/menu_roght_corner.gif"/></td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td colspan="8" align="left" valign="top" background="/images/header/main_bg.gif" style="background-repeat:repeat-y"></td>
</tr>
</table>