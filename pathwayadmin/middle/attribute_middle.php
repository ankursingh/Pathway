<?php

function break_status($message) {
    $status;
    $i = 0;
}
?>
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
                    <td bgcolor="#FFFFFF"> Attribute For Service</td>
                </tr>
                <tr>
                    <td bgcolor="#FFFFFF" font-size="11" align="right" ><a href="attribute_modify.php?action=add&service_id=<?php echo $id; ?>">Add New Attribute</a></td>
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
                                <td width='25%' class="compareHead"><b>Attribute Name</b></td>
                                <td width='35%' class="compareHead"><b>Status</b></td>
                                <td width='10%' class="compareHead"><b>Order</b></td>
                                <td width='20%' class="compareHead" colspan="2"><b>Action</b></td>
                            </tr><?php
if (isset($id)) {
    $sql_query = "SELECT * FROM services_attribute WHERE service_id='$id' ORDER by services_attribute.order ASC";
} else {
    header('location: service.php');
}

$attributes = $obj->query($sql_query);
$i = 1;
$total = mysql_num_rows($attributes);
while ($row = mysql_fetch_array($attributes)) {
?>
                            <tr bgcolor="white">
                                <td align="center">
                                    <?php echo $i; ?>
                                </td>
                                <td style="padding-left: 5px">
                                    <?php echo $row['name']; ?>
                                </td>
                                <td style="padding-left: 5px" width='35%'>
                                    <?php //echo break_message($row['status']);
                                    echo $row['status']; ?>
                                </td>
                                <td style="padding-left: 5px" valign="top" nowrap>
                                    <?php if($i!=1){ ?>
                                   <a href="attribute_modify.php?order=up&service_id=<?php echo $id; ?>&up_id=<?php echo $row['id'] ?>">up</a>
                                    <?php }else{
                                         echo "&nbsp;&nbsp;&nbsp;";
                                    }
                                    if($i != $total){
                                    ?>
                                    &nbsp;&nbsp;&nbsp;&nbsp;<a href="attribute_modify.php?order=down&service_id=<?php echo $id; ?>&down_id=<?php echo $row['id']; ?>">down</a>&nbsp;&nbsp;
                                    <?php }else{
                                        echo "&nbsp;&nbsp;&nbsp;";
                                    }?>
                                </td>
                                <td style="padding-left: 5px"align="center">
                                    <a href="attribute_modify.php?action=edit&id=<?php echo $row['id']; ?>">Edit</a>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="attribute_modify.php?action=delete&id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this attribute');">Delete</a>
                                    &nbsp;&nbsp;
                                </td>
                            </tr>
                            <?php
                                    $i++;
                                } ?>


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
