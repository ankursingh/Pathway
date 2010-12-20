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
extract($_GET);
$obj = new pathway_class;
$obj1 = new pathway_class;
if (isset($order)) {
    $in_loop = 0;
    if ($order == up) {
        $sql_query = "SELECT * FROM service WHERE category_id = '$category_id' ORDER by service.order DESC";
        $in_loop = 1;
    }
    if ($order == down) {
        $sql_query = "SELECT * FROM service WHERE category_id = '$category_id' ORDER by service.order ASC";
        $in_loop = 1;
    }
    if ($in_loop) {
        $service_data = $obj->query($sql_query);
        $next = false;
        while ($row = mysql_fetch_array($service_data)) {

            if ($next == true) {
                $second_data = $row;
                $next = false;
            }
            if ($row['id'] == $id) {
                $first_data = $row;
                $next = true;
            }
        }
        if (!empty($second_data)) {
            $first_query = "UPDATE service SET service.order = '$second_data[order]' WHERE id='$first_data[id]'";
            $obj->query($first_query);
            $second_query = "UPDATE service SET service.order = '$first_data[order]' WHERE id='$second_data[id]'";
            $obj->query($second_query);
        }
    }
    header("location: service.php?category_id=$category_id");
}

function checkTypeAndUploadFile($file) {
    $acceptable_file_type = array('image/jpeg', 'image/gif', 'image/png', 'image/bmp');
    if (!in_array($file['type'], $acceptable_file_type)) {
        return true;
    }

    $ext = 1;
    $name = checkAvailibilityElseRenameFile($file['name'], $ext);
    $filename = 'images/service_images/' . $name;
    if (move_uploaded_file($file['tmp_name'], $filename)) {
        return $name;
    } else {
        return false;
    }
}

function checkAvailibilityElseRenameFile($filename, $ext) {
    $filenam = 'images/service_images/' . $filename;
    //echo $filenam;
    if (file_exists($filenam)) {
        $file_name = explode(".", $filename);
        //echo $filename;
        $array_length = count($file_name);

        $newname = $file_name[$array_length - 2];

        $checkUnderScore = explode("_", $newname);

        $newname_length = count($checkUnderScore);

        $addition = "_" . $ext;

        if (($newname_length == 1) || ((preg_match("/['0-9']/", $checkUnderScore[($newname_length - 1)])) == 0)) {
            $extension = $file_name[$array_length - 1];
            //$newname = $file_name[$array_length - 2] . $addition . "." . $file_name[($array_length - 1)];
            $file_name[$array_length-1] = $addition;
            $file_name[$array_length] = ".";
            $file_name[$array_length+1] = $extension;
            $newname = implode("", $file_name);
            //print_r($data);
            echo "hello";

        } else {
             $extension = $file_name[$array_length - 1];
            //$newname = $checkUnderScore[($newname_length - 2)] . $addition . "." . $file_name[($array_length - 1)];
            /*$file_name[$array_length-1] = $addition;
            $file_name[$array_length] = ".";
            $file_name[$array_length+1] = $extension;
            $newname = implode("", $file_name);
           echo "!hello"; */
             $extension = $file_name[$array_length-1];
             $checkUnderScore[$newname_length-1]= $addition;
             $checkUnderScore[$newname_length] = ".";
             $checkUnderScore[$newname_length+1] = $file_name[$array_length-1];
             $newname = implode("",$checkUnderScore);
            //echo $newname;
        }
        
        $ext++;
        $newname = checkAvailibilityElseRenameFile($newname, $ext);

        return $newname;
    } else {
        return $filename;
    }
}

if (isset($_POST['submit'])) {
    //echo $submit;
    extract($_POST);
    extract($_FILES);
    if ($submit == "edit") {
        $error = 0;
        if ($service_name == null) {
            $error = 1;
        }
        if ($error == 0) {
            $sql = "UPDATE service SET name='$service_name',category_id ='$category_id',is_active = '$active'  WHERE id = '$id'";
            $check = $obj->query($sql);
            if ($image != null) {
                $image_status = checkTypeAndUploadFile($image);
                $sql = "UPDATE service SET image='$image_status' WHERE id='$id'";
                $obj->query($sql);
            }

            if ($check) {
                header("location: service.php?category_id=$category_id");
            } else {
                echo "data can not be saved right now";
            }
        }
    }
    if ($submit == 'add') {

        $error = 0;
        if ($service_name == null) {
            $error = 1;
        }
        if ($image['name'] == null) {
            $error = 2;
        }
        if ($error == 0) {
            $image_status = checkTypeAndUploadFile($image);

            if ($image_status) {
                $order_query = $obj->query("SELECT * FROM service WHERE category_id ='$category_id' ORDER by service.order DESC");
                $last_order_number = mysql_fetch_array($order_query);
                $order = $last_order_number['order'] + 1;
                $sql = "INSERT into service (category_id,service.order,name,image,is_active) VALUES('$category_id','$order','$service_name','$image_status','$active')";
                $check = $obj->query($sql);
                if ($check) {
                    header("location: service.php?category_id=$category_id");
                } else {
                    echo "data can not be saved right now";
                }
            } else {
                echo "Image can not be uploaded";
            }
        } else {
            $action = 'add';
        }
    }
}
if ($action == 'delete') {
    if ($id != null) {
        $query = "DELETE  service.* ,services_attribute.* FROM service  LEFT JOIN services_attribute ON services_attribute.service_id = $id WHERE service.id = $id";

        $check = $obj->query($query);
        if ($check) {
            header('location: service_category.php');
        } else {
            echo "data can not be delete right now";
        }
    } else {
        header('location: service.php');
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
                                                    <td align="left" valign="top"><?php require_once('./middle/service_modify_middle.php'); ?></td>
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
