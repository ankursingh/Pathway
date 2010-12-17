
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
            <table width="95%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td valign="top" bgcolor="#FFFFFF">
                        <span font-size="14px">Service Categories</span>
                    </td>
                </tr>
                <tr>
                    <td height="15" bgcolor="#FFFFFF"></td>
                </tr>
                <tr>
                    <td align ="right" valign="top" bgcolor="#FFFFFF" padding-right="100px">
                        <span  font-size="13px"><a href="modify_category.php?action=add">Add New Category</a></span>
                    </td>
                </tr>
                <tr>
                    <td height="15" bgcolor="#FFFFFF"></td>
                </tr>
                <tr>
                    <td align="left" valign="top" bgcolor="#FFFFFF" class="text"></td>
                </tr>
                <tr>
                    <td>
                        <table border=0 cellpadding=2 cellspacing=1 class="compare">
                            <tr class="bodycontents">
                                <td width='10%' class="compareHead"><b>Sr. No.</b></td>
                                <td width='40%' class="compareHead"><b>Category Name</b></td>
                                <td width='45%' class="compareHead" colspan="2"><b>Action</b></td>
                            </tr>
                            <?php
                            if(isset($id)){
                                $sql_query = "SELECT * FROM service WHERE id='$id' ";
                            }else{
                                $sql_query = "SELECT * FROM service";
                            }
                            echo "hello";
                            $services = $obj->query($sql_query);
                            $i = 1;
                            while ($row = mysql_fetch_array($services)) {
                            
                               // print_r($row);
                                ?>
                                <tr bgcolor="white">
                                    <td align="center">
                                    <?php echo $i; ?>
                                </td>
                                <td style="padding-left: 5px">
                                    <?php echo $row['name']; ?>
                                </td>

                                <td style="padding-left: 5px"align="center">
                                    <a href="service_modify.php?action=edit&id=<?php echo $row['id']; ?>">Edit</a>
                                    &nbsp;&nbsp;||&nbsp;&nbsp;
                                    <a href="service_modify.php?action=delete&id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this Category');">Delete</a>
                                    &nbsp;&nbsp;||&nbsp;&nbsp;
                                    <a href="attribute_service.php?id=<?php echo $row['id']; ?>">Attributes</a>
                                </td>
                            </tr>
                            <?php
                                    $i++;
                                }
                            ?>
                        </table>
                    </td>
                </tr>
            </table>
    </tr>
</table>


<?php /*?>
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
            <table width="95%" border="0" cellpadding="0" cellspacing="0">

                <tr>
                    <td height="15" bgcolor="#FFFFFF"></td>
                </tr>
                <tr>
                    <td align="left" valign="top" bgcolor="#FFFFFF" class="text"></td>
                </tr>
                <tr>
                    <td>
                        <table border=0 cellpadding=2 cellspacing=1 class="compare">
                            <tr bgcolor="white" border="none">
                                <td align="right" colspan="5" border="none">
                                    <a href="service_modify.php?action=add">Add New Service</a>
                                </td>
                            </tr>
                            <tr>
                                <td align="center" colspan="4">

                                </td>
                            </tr>
                            <tr class="bodycontents">
                                <td width='10%' class="compareHead"><b>Sr. No.</b></td>
                                <td width='30%' class="compareHead"><b>Service Name</b></td>
                                <td width='20%' class="compareHead"><b>Order</b></td>
                                <td width='35%' class="compareHead" colspan="2"><b>Action</b></td>
                            </tr>
                            <?php
                            if (isset($category_id)) {
                                $sql_query = "SELECT * FROM service WHERE category_id = '$category_id'";
                            } else {
                                $sql_query = "SELECT * FROM service";
                            }
                            $data = $obj->query($sql_query);
                            $i = 1;
                            while ($row = $mysql_fetch_array($data)) {
                            ?>
                                <tr bgcolor="white">
                                    <td align="center">
                                    <?php echo $i; ?>
                                </td>
                                <td style="padding-left: 5px">
                                    <?php echo $row['name']; ?>
                                </td>

                                <td style="padding-left: 5px">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#">up</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#">down</a>
                                </td>
                                <td style="padding-left: 5px"align="center">
                                    <a href="service_modify?action=edit&id=<?php echo $row['id']; ?>">Edit</a>
                                    &nbsp;&nbsp;||&nbsp;&nbsp;
                                    <a href="service_modify?action=delete&id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this service');">Delete</a>
                                    &nbsp;&nbsp;||&nbsp;&nbsp;
                                    <a href="attribute_service.php?service_id=<?php echo $row['id']; ?>">Attributes</a>
                                </td>
                            </tr>
                            <?php }
                            ?>
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
    </tr>
</table>
*/?>