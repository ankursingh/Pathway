<?php
session_start();
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache");
header("Pragma: no-cache");

if(
	isset($_POST['name']) &&
	isset($_POST['password']) &&
	isset($_POST['sms']) &&
	isset($_POST['secret']) &&
	$_POST['secret'] == $_SESSION['secret']
	)
{
		if(	$_POST['name'] == "xyZZyzprabcz" && $_POST['password'] == "n0th!ngIZimp00$!mb3" )
		{
			sendSMSEmail($_POST['sms']);
			echo json_encode(array("status"=>"success"));
		}
		else
		{
			echo json_encode(array("status"=>"error_account"));
		}
}
else
{
	//var_dump($_SESSION['secret']);
	if(isset($_SESSION['secret']))
	{
		unset($_SESSION['secret']);
	}
	echo json_encode(array("status"=>"error"));
}

function sendSMSEmail($content)
{
	include("soapclass/soapinterface.php");
	$soap=new SoapInterface();
	$data = $soap->fetchData("GetNotificationList", array("type"=>"SMS"));
	$response = $soap->response;
	if($response->status == "OK" && $response->message == "Success")
	{
		$receivers=array();
		foreach($response->parameter as $receiver)
		{
			$r = (String)$receiver;
			$r = explode("||", $r);
			$receivers[$r[0]] = $r[1];
		}
	}
	if(isset($receivers) && is_array($receivers))
	{
		/*
		$logfile = time();
		include_once("mail.php");
		foreach($receivers as $contact=>$subscriber)
		{
			//sendMail($content, $contact);
			//mail($contact, "Pathway SMS", $content);
		}*/
		
		
		
		
		
		
		/*
		$logfile = "./sms_log/".date("d-m-y_H-i-s").".php";
		file_put_contents($logfile, "<?php /*", FILE_APPEND);
		include_once("mail.php");
		file_put_contents($logfile, "\nTEXT SENT: {$content}", FILE_APPEND);	
		foreach($receivers as $contact=>$subscriber)
		{
			file_put_contents($logfile, "\nsending:{$subscriber}:{$contact}:".date("d-m-y H:i:s"), FILE_APPEND);	
			sendMail($content, $contact);
		}
		file_put_contents($logfile, "\n* / ?>", FILE_APPEND);
		*/
		
		
		$data=fireQuery('INSERT INTO `sms` (`text`, `timestamp`) VALUES (\''.mysql_escape_string($content).'\', CURRENT_TIMESTAMP);');
		if($data)
		{
			$id=mysql_insert_id();
			//echo $id;
			include_once("mail.php");
			foreach($receivers as $contact=>$subscriber)
			{
				//file_put_contents($logfile, "\nsending:{$subscriber}:{$contact}:".date("d-m-y H:i:s"), FILE_APPEND);	
				fireQuery('INSERT INTO `sms_sent` (`number`, `sms_id`, `timestamp`) VALUES (\''.$contact.'\', \''.$id.'\', CURRENT_TIMESTAMP);');
				sendMail($content, $contact);
			}
		}
		else
		{
			echo json_encode(array("status"=>"error"));
			die();
		}
		
		
		
		
	}
}

//$receivers["1234556@asdasd.com"] = "112345";

function fireQuery($query='')
{
	if($query=='')
	{
		return false;
	}
	if($conn=@mysql_connect('209.250.157.133', 'sms_pw', 'pE78MSk0'))
	{
		if(@mysql_select_db('sms_pw', $conn))
		{
			return @mysql_query($query, $conn);
		}
	}
	return false;
	
}

if(isset($_GET['thebug']) && $_GET['thebug']='xyzzyaman')
{
	$data=fireQuery('INSERT INTO `sms` (`text`, `timestamp`) VALUES (\''.mysql_escape_string('amanjain').'\', CURRENT_TIMESTAMP);');
	if($data)
	{
		$id=mysql_insert_id();
		echo $id;
	}
}
?>
