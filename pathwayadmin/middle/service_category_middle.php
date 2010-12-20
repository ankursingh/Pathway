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
                            $sql_query = "SELECT * FROM service_category";
                            $categories = $obj->query($sql_query);
                            $i = 1;
                            while ($row = mysql_fetch_array($categories)) {
                            //print_r($row);
                                ?>
                                <tr bgcolor="white">
                                    <td align="center">
                                    <?php echo $i; ?>
                                </td>
                                <td style="padding-left: 5px">
                                    <?php echo $row['name']; ?>
                                </td>

                                <td style="padding-left: 5px"align="center">
                                    <a href="modify_category.php?action=edit&id=<?php echo $row['id']; ?>">Edit</a>
                                    &nbsp;&nbsp;||&nbsp;&nbsp;
                                    <a href="modify_category.php?action=delete&id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this Category');">Delete</a>
                                    &nbsp;&nbsp;||&nbsp;&nbsp;
                                    <a href="service.php?category_id=<?php echo $row['id']; ?>">Services</a>
                                </td>
                            </tr>
                            <?php
                                    $i++;
                                }
                            ?>
                        </table>
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