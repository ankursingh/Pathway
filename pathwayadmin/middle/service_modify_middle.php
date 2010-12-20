<?php
if ($action == 'edit') {
    $data = $obj->query("SELECT * FROM service WHERE id = '$id' LIMIT 1");
    $row = mysql_fetch_array($data);
    $category_id = $row['category_id'];
    $service_name = $row['name'];
    $active = $row['is_active'];
    $image = $row['image'];
} else {
    $category_id = "";
    $service_name = "";
    $active = "";
}
?>
<script>
    function validate(){
        check = true;
        var name = document.getElementById('service_name');
        if(name.value.length == 0){
            alert('Please enter service name');
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
                <form id="service_edit" enctype="multipart/form-data" method="post" action="" onsubmit ="javascript:return validate();">
                    <?php if ($action == 'edit') {
                    ?><input type = "hidden" name="id" value="<?php echo $id; ?>"><?php
                    }
                    ?><tr>
                        <td height="15" bgcolor="#FFFFFF"></td>
                    </tr>
                    <tr>
                        <td align="left" valign="top" bgcolor="#FFFFFF" class="text"></td>
                    </tr>
                    <?php
                    if (isset($error)) {
                        if ($error != 0) {
                    ?><tr>
                                <td align="left" valign="top" bgcolor="#FFFFFF" class="text">
                            <?php
                            if ($error == 1) {
                                echo "Please Fill Your name";
                            }
                            if ($error == 2) {
                                echo "Please attach relevant image";
                            }
                            ?></td>
                    </tr>
                    <?php
                        }
                    } ?>
                    <tr>
                        <td>
                            <table border=0 cellpadding=2 cellspacing=1 class="compare">
                                <tr>
                                    <td align="left" valign="top" bgcolor="#FFFFFF" class="text">
                                        Category:
                                    </td>
                                    <td align="left" valign="top" bgcolor="#FFFFFF" class="text" font-color="red">
                                        <select name="category_id" value="<?php echo $category_id; ?>">
                                            <?php
                                            $category_query = "SELECT * FROM service_category";
                                            $selectdata = $obj->query($category_query);
                                            while ($row = mysql_fetch_array($selectdata)) {
                                            ?> <option  value ="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                            <?php }
                                            ?>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td align="left" valign="top" bgcolor="#FFFFFF" class="text">
                                        Service name
                                    </td>
                                    <td align="left" valign="top" bgcolor="#FFFFFF" class="text">
                                        <input type="text" maxlength="70" name="service_name" id="service_name" value="<?php echo $service_name; ?>" >
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" valign="top" bgcolor="#FFFFFF" class="text">
                                        Image
                                    </td>
                                    <td align="left" valign="top" bgcolor="#FFFFFF" class="text">
                                        <input type="file" name="image" id="service_image">
                                    </td>
                                </tr>

                                <?php if ($action == 'edit') {
 ?>

<?php } ?>

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
                                                    <input type="submit" value="<?php echo $action; ?>" title="Add Service data" name="submit">&nbsp;&nbsp;&nbsp;&nbsp;
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
                    <td bgcolor="#ffffff" align="left" valign="top">&nbsp;</td>
                </tr>

                <tr>
                    <td bgcolor="#ffffff" align="left" valign="top" >&nbsp;</td>
                </tr>

            </table>

        </td>
    </tr>
    <tr>
        <td background="/images/innertab/bg_05.gif" style="background-repeat: no-repeat;">&nbsp;</td>
    </tr>
</table>