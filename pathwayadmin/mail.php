<?php
function sendMail($textmessage = "", $to="")
{
	$subject = 		'Pathway Support';
	$from = 		'corp@pathcom.com';
	
	$mime_boundary=md5(time());
	$headers = "From: $from" . "\n";
	if(isset($cc) && $cc!="")
	{
		$headers .= "CC: $cc" . "\n";
	}
	$headers .= 'MIME-Version: 1.0'. "\n";
	$headers .= "Content-Type: multipart/mixed; boundary=\"".$mime_boundary."\"". "\n"; 
	 
	$msg = "--".$mime_boundary. "\n";
	$msg .= "Content-Type: text/plain; charset=iso-8859-1". "\n";
	$msg .= "Content-Transfer-Encoding: 7bit". "\n\n";
	$msg .= $textmessage . "\n\n";

	$msg .= "--".$mime_boundary."--". "\n\n";

	mail($to, $subject, $msg, $headers);
}
?>