
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
                        <span font-size="14px">Services</span>
                    </td>
                </tr>
                <tr>
                    <td height="15" bgcolor="#FFFFFF"></td>
                </tr>
                <tr>
                    <td align ="right" valign="top" bgcolor="#FFFFFF" padding-right="100px">

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
                        <table border=2 cellpadding=2 cellspacing=2 class="compare">
                            <?php
                            $category_data = $obj->query("SELECT * FROM service_category WHERE service_category.is_active = '1'");
                            while ($row = mysql_fetch_array($category_data)) {
                            ?>
                                <tr class="bodycontents">
                                    <td class="compareHead" colspan="3"><b><?php echo $row['name']; ?></b></td>
                                    <td class="compareHead" colspan="2"><b> Status</b></td>
                                </tr> <?php
                                $service_data = $obj1->query("SELECT * FROM service WHERE service.is_active = '1' AND service.category_id = $row[id] ORDER by service.order ASC");
                                while ($service = mysql_fetch_array($service_data)) {
                            ?>
                                    <tr bgcolor="white">
                                        <td colspan="3" valign="top" style="padding-left: 5px">
                                            <img src="/images/service_images/<?php echo $service['image']; ?>" height="30px" width="30px">&nbsp;&nbsp;&nbsp;&nbsp;
                                        <strong> <?php echo $service['name']; ?></strong>
                                        </td>
                                        <td colspan="2"style=" padding-left: 5px">
                                                
                                        </td>
                                    </tr>
                            <?php
                                    $attribute_data = $obj2->query("SELECT * FROM services_attribute WHERE services_attribute.is_active = 1 AND services_attribute.service_id = '$service[id]' ORDER by services_attribute.order ASC");
                                    $i = 0;
                                    while ($row1 = mysql_fetch_array($attribute_data)) {
                                        
                            ?><tr bgcolor="white">
                                            <td align ="left" colspan="3" style="padding-left: 5px" align="middle">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $row1['name']; ?>&nbsp;&nbsp;&nbsp;</td>
                                            <td align="left" colspan="2" style="padding-left: 5px">
                                            <img src="/images/service_images/<?php echo $row1['image_flag'] . ".png" ?>" height="16px" width="16px">
                                            &nbsp;&nbsp;&nbsp; <?php echo $row1['status']; ?></td>
                                        </tr>
                            <?php
                            $i++;
                                    }
                                   
                                }
                            }
                            ?>
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
