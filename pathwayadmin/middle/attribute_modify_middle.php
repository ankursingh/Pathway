<?php 
if($action == 'edit'){
    if($id != null){
        $attribute_data = $obj->query("SELECT * FROM services_attribute WHERE id='$id' LIMIT 1");
        $field_data = mysql_fetch_array($attribute_data);
        $attr_name = $field_data['name'];
        $status = $field_data['status'];
        $active = $field_data['is_active'];
        if($active == 1){
            $active_true = "checked";
        }else{
            $active_false = "checked";
        }

    }
}else{
    $active_true = "checked";
}

?>
<script>
    function validate(){
        check = true;
        var name = document.getElementById('service_name');
        var status = document.getElementById('attribute_status');
        if(name.value.length == 0){
            alert('Please enter attribute name');
            check = false;
        }
        else if(status.value.length == 0){
            alert('Please enter attribute status');
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
                <form id="service_edit" method="post" action="" onsubmit="javascript:return validate();">
                    <?php
                    
                    if($action == "edit"){

                    if($id != null){
                    ?>
                    <input type="hidden" name ="id" value ="<?php echo $id ?>">
                    
                    <?php }
                    else{
                        header("location: service_category.php");
                    }
                    }
                    if($action == "add"){
                        if(isset($service_id)){
                           ?> <input type="hidden" name ="service_id" value ="<?php echo $service_id ?>"><?php
                        }
                        else{
                            //echo "hello";
                            header('location: service_category.php');
                        }
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
                                    <td align="left" valign="top" bgcolor="#FFFFFF" class="text">
                                        Attribute name
                                    </td>
                                    <td align="left" valign="top" bgcolor="#FFFFFF" class="text">
                                        <input type="text" maxlength="70" name="attribute_name" id="service_name" value="<?php echo $attr_name; ?>">
                                    </td>
                                </tr>
                                 <tr>
                                    <td align="left" valign="top" bgcolor="#FFFFFF" class="text">
                                        Status
                                    </td>
                                    <td align="left" valign="top" bgcolor="#FFFFFF" class="text">
                                        <input type="text" maxlength="70" name="attribute_status" id="attribute_status" value="<?php echo $status; ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top" bgcolor="#FFFFFF" class="text">
                                        Image Flag
                                    </td>
                                    <td align="left" valign="top" bgcolor="#FFFFFF" class="text">
                                        <select name="image_flag" value="<?php echo $image_flag; ?>">
                                            <option  value ="3">Available</option>
                                            <option  value ="2">Upcoming</option>
                                            <option value ="1"> Not Clear </option>
                                            <option  value ="4">Not Available</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top" bgcolor="#FFFFFF" class="text">
                                        Active
                                    </td>
                                    <td align="left" valign="top" bgcolor="#FFFFFF" class="text">
                                        &nbsp; <input type="radio" <?php echo $active_true; ?>  value="1" name="active"> &nbsp; Yes
                                        &nbsp;<input type="radio" <?php echo $active_false; ?> value="0" name="active">&nbsp; No
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top" bgcolor="#FFFFFF" class="text">
                                        &nbsp;
                                    </td>
                                    <td align="left" valign="top" bgcolor="#FFFFFF" class="text">
                                        <input type="submit" value="<?php echo $action; ?>" title="Edit Attribute" name="submit">&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a onclick="javascript:history.go(-1);" title="cancel" href ="javascript:void(0)">Cancel</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top" bgcolor="#FFFFFF" class="text">&nbsp;</td>
                                    <td align="left" valign="top" bgcolor="#FFFFFF" class="text">&nbsp;</td>
                                </tr>
                            </table>
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#ffffff" align="left" valign="top">&nbsp;</td>
                </tr>
                <tr>
                    <td bgcolor="#ffffff" align="left" valign="top">&nbsp;</td>
                </tr>

            </table>
    </tr>

    <tr>
        <td background="/images/innertab/bg_05.gif" style="background-repeat: no-repeat;">&nbsp;</td>
    </tr>
</table>
