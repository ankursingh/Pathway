<script>
    function validate(){
        check = true;
        var name = document.getElementById('service_name');
        if(name.value.length == 0){
            alert('Please enter category name');
            check = false;
        }
        return check;
    }
</script>
<table width="95%" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td align="left" valign="top"><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td align="left" valign="top"><img src="/images/innertab/tab_bg_01.gif" alt=""/></td>
                    <td align="left" valign="top" background="/images/innertab/tab_bg_02.gif" style="padding-top:5px" class="bodycontents"><b><? echo SEARCH_RESULTS_PATHWAY_COMMUNICATIONS ?></b></td>
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
            <table width="95%" border="0" cellpadding="0" cellspacing="0" color="#000000">
                <form id="form_edit" method="post" action="" onsubmit="javascript:return validate();">
                    <?php
                    if($action == edit){
                    ?><input type="hidden" name ="id" value="<?php echo $id;?>"> <?php
                    }
                    ?>

                    <tr>
                        <td height="15" bgcolor="#FFFFFF"></td>
                    </tr>
                    <tr>
                        <td align="left" valign="top" bgcolor="#FFFFFF" class="text"></td>
                    </tr>
                    <tr>
                        <td>
                            <table border=0 cellpadding=2 cellspacing=1 class="compare">
                                
                                <tr>
                                    <td align="left" valign="top" bgcolor="#FFFFFF" class="text" colspan="2">
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top" bgcolor="#FFFFFF" class="text">
                                        Category name
                                    </td>
                                    <td align="left" valign="top" bgcolor="#FFFFFF" class="text">
                                        <input type="text" maxlength="70" name="category_name" id="service_name">
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top" bgcolor="#FFFFFF" class="text">
                                        Active
                                    </td>
                                    <td align="left" valign="top" bgcolor="#FFFFFF" class="text">
                                        &nbsp; <input type="radio" checked value="1" name="active"> &nbsp; Yes
                                        &nbsp;<input type="radio" value="0" name="active">&nbsp; No
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top" bgcolor="#FFFFFF" class="text">
                                        &nbsp;
                                    </td>
                                    <td align="left" valign="top" bgcolor="#FFFFFF" class="text">
                                        <input type="submit" value="<?php echo $action; ?>" title="Edit Category data" name="submit">&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a onclick="javascript:history.go(-1);" title="cancel" href ="javascript:void(0)">Cancel</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top" bgcolor="#FFFFFF" class="text">&nbsp;</td>
                                    <td align="left" valign="top" bgcolor="#FFFFFF" class="text">&nbsp;</td>
                                </tr>
                            </table>
                </form>
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
