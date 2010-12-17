<?
/*************************************************************************
   Type         :   Script
   File         :   php
   Date         :   July, 2009
   Author       :   Surinder Jangira
   Environment  :   PHP, Apache, MySQL
   Revisions    :
   Project      :   Pathway
   File Name    :   config.php
   Purpose      :   
*************************************************************************/
// base url for the directory
$rootDirectory = "/";
define("ROOT", $DOCUMENT_ROOT."$rootDirectory");
define("SITE_ROOT", "http://".$HTTP_HOST."$rootDirectory");
define("CLASS_PATH", ROOT."/classes");
define("IMAGE_ROOT", ROOT."/images");
define("IMAGE_PATH", SITE_ROOT."/images");
define("CSS_PATH", SITE_ROOT."/css");
define("INCLUDE_PATH", SITE_ROOT."/includes");

define("PATHWAY_SITE_URL", "http://www.pathcom.com");
define("SITE_URL", "http://www.pathcom.com");
define("SECURE_SITE_URL", "http://www.pathcom.com");

define("COMPANY_NAME", "Pathway Communications");
define("COMPANY_NAME_SHORT", "Pathway");

if (!isset($_SESSION['lang'])) {
	$lang = "en";
	$_SESSION['lang']=$lang;
}
else if (trim($_GET['lang'])!="" && ($_GET['lang']=="en" || $_GET['lang']=="fr") && isset($_SESSION['lang'])) {
	$_SESSION['lang']=$_GET['lang'];
}

/*
// Local Db Connectivity
define("SIGNUP_DB_HOST","");
define("SIGNUP_DB_NAME","");
define("SIGNUP_DB_USER","");
define("SIGNUP_DB_PASSWORD","");

// Dev Site Db Connectivity
define("SIGNUP_DB_HOST","");
define("SIGNUP_DB_NAME","");
define("SIGNUP_DB_USER","");
define("SIGNUP_DB_PASSWORD","");*/

// Live Site Db Connectivity
define("SIGNUP_DB_HOST","localhost");
define("SIGNUP_DB_NAME","pathway_admin");
define("SIGNUP_DB_USER","root");
define("SIGNUP_DB_PASSWORD","webonise6186");

define("PATHWAY_SITE_FTP_USER","");
define("PATHWAY_SITE_FTP_PASSWORD","");
define("PATHWAY_XML_FOLDER","");
?>
