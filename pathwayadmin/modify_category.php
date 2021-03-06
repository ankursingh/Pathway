<?php
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
extract($_GET);
$obj = new pathway_class;
$obj1 = new pathway_class;

if (isset($_POST['submit'])) {
    echo $submit;
    extract($_POST);
    if ($submit == "edit") {

        $sql = "UPDATE service_category SET name='$category_name', is_active = '$active'  WHERE id = '$id'";
        $check = $obj->query($sql);
        if ($check) {
            header('location: service_category.php');
        } else {
            echo "data can not be saved right now";
        }
    }
    if ($submit == 'add') {

        $sql = "INSERT into service_category (name,is_active) VALUES('$category_name','$active')";
        $check = $obj->query($sql);
        if ($check) {
            header('location: service_category.php');
        } else {
            echo "data can not be saved right now";
        }
    }
}
if ($action == 'delete') {
    if ($id != null) {
        
        $query = "DELETE  service.* ,service_category.*,services_attribute.* FROM service_category LEFT JOIN service ON service.category_id = $id LEFT JOIN services_attribute ON services_attribute.category_id = $id WHERE service_category.id = $id";

        $check = $obj->query($query);
        if ($check) {
            header('location: service_category.php');
        }else {
            echo "data can not be delete right now";
        }
    } else {
        header('location: service_category.php');
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
                                                    <td align="left" valign="top"><?php require_once('./middle/category_modify_middle.php'); ?></td>
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