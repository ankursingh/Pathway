<?
$contentFilePath = "./csv/dashboard_data.js";
	
if ($fd = fopen ($contentFilePath, "rb")) {
	$fsize = filesize($contentFilePath);
	$fname = basename ($contentFilePath);
	
	// Specify the required headers
	header("Pragma: ");
	header("Cache-Control: ");
	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=\"".$fname."\"");
	header("Content-length: $fsize");
	
	fpassthru($fd);
}
?>