<?
/* * ***********************************************************************
  Type         :   Script
  File         :   php
  Date         :   December 15, 2008
  Author       :   Surinder Jangira
  Environment  :   PHP, Apache, MySQL
  Revisions    :
  Project      :   Pathcom Website
  File Name    :   add_keywords.php
  Purpose      :   This page deals with Adding Search Keywords.
 * *********************************************************************** */

require_once("./includes/include_files.php");
include_once "./classes/pathway_class.inc";

$obj = new pathway_class;
$obj1 = new pathway_class;
extract($_GET);
if($action == 'delete'){
    $row_query = $obj->query("SELECT service_id FROM services_attribute WHERE id='$id' LIMIT 1");
    $data = mysql_fetch_array($row_query);
    $service_id = $data['service_id'];
    $sql = "DELETE services_attribute.* FROM services_attribute WHERE id='$id'";
    if($obj->query($sql)){
        header("location: attribute_service.php?id=$service_id");
    }else{
        "Can not delete data";
    }

}
if (isset($order)) {
    if ($order == 'up') {
        $sql = "SELECT * FROM services_attribute WHERE service_id='$service_id' ORDER by services_attribute.order DESC";
        $data = $obj->query($sql);
        $i = 0;
        $j = false;
        while ($row = mysql_fetch_array($data)) {
            $attributes_data[$i] = $row;
            if ($j) {
                $down_row = $row;
                $j = false;
            }
            if ($row['id'] == $up_id) {
                $up_row = $row;
                $j = true;
            }
            $i++;
        }
        $check = true;
        if (!empty($down_row)) {
            $sql_query = "UPDATE services_attribute as SA SET SA.order='$down_row[order]' WHERE SA.id='$up_row[id]' ";
            if (!$obj->query($sql_query)) {
                $check = false;
            }
            $down_query = "UPDATE services_attribute as SA SET SA.order='$up_row[order]' WHERE SA.id='$down_row[id]' ";
            if (!$obj->query($down_query)) {
                $check = false;
            }
        }
    }
    if ($order == 'down') {
        $sql = "SELECT * FROM services_attribute WHERE service_id='$service_id' ORDER by services_attribute.order ASC";
        $data = $obj->query($sql);
        $i = 0;
        $j = false;
        while ($row = mysql_fetch_array($data)) {
            $attributes_data[$i] = $row;
            if ($j) {
                $down_row = $row;
                $j = false;
            }
            if ($row['id'] == $down_id) {
                $up_row = $row;
                $j = true;
            }
            $i++;
        }
        $check = true;
        if (!empty($down_row)) {
            $sql_query = "UPDATE services_attribute as SA SET SA.order='$down_row[order]' WHERE SA.id='$up_row[id]' ";
            if (!$obj->query($sql_query)) {
                $check = false;
            }
            $down_query = "UPDATE services_attribute as SA SET SA.order='$up_row[order]' WHERE SA.id='$down_row[id]' ";
            if (!$obj->query($down_query)) {
                $check = false;
            }
        }
    }
    header("location: attribute_service.php?id=$service_id");
}

if (isset($_POST['submit'])) {
    extract($_POST);
    if ($submit == "edit") {

        $sql = "UPDATE services_attribute SET name='$attribute_name',status='$attribute_status',image_flag='$image_flag',is_active = '$active'  WHERE id = '$id'";
        $check = $obj->query($sql);
        if ($check) {
            $service_data = $obj->query("SELECT service_id FROM services_attribute WHERE id='$id'");
            $data= mysql_fetch_array($service_data);
            header("location: attribute_service.php?id=$data[service_id]");
        } else {
            echo "data can not be saved right now";
        }
    }
    if ($submit == "add") {

        $service_data = $obj->query("SELECT * FROM service WHERE id='$service_id' LIMIT 1");
        $data = mysql_fetch_array($service_data);
        $attr_data = $obj->query("SELECT services_attribute.order FROM services_attribute WHERE service_id='$service_id' ORDER by services_attribute.order DESC");
        $att_data = mysql_fetch_array($attr_data);
        $order_number = $att_data['order']+1;
        
         $sql = "INSERT into services_attribute (category_id,service_id,name,status,image_flag,services_attribute.order,is_active) VALUES('$data[category_id]','$service_id','$attribute_name','$attribute_status','$image_flag','$order_number','$active')";
          $check = $obj->query($sql);
          if ($check) {
          header("location: attribute_service.php?id=$service_id");
          } else {
          echo "data can not be saved right now";
          }
    }
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>

        <?php
        require_once('./includes/meta.php');
        require_once('./includes/javascript.php');
        ?>
        <link type="text/css" rel="stylesheet" media="screen,projection" href="/css/tables.css"/>
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
        <script language="JavaScript" type="text/javascript" src="/jsfiles/calendar3.js"></script>
    </head>
    <BODY>

        <table width="100%" border="0" cellpadding="0" cellspacing="0" >
            <tr>
                <td align="center" valign="top">
                    <table width="845" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                            <td align="left" valign="top"><?php require_once('./header/keyheader_admin.php'); ?></td>
                        </tr>
                        <tr>
                            <td align="center" valign="top" background="/images/header/main_bg.gif" style="background-repeat:repeat-y">
                                <? require("./includes/banner_admin.php") ?></td>
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
                                                    <td align="left" valign="top"><?php require_once('./middle/attribute_modify_middle.php'); ?></td>
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