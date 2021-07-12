<?php
$allowedExts = array("pdf");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);

if ($_FILES["file"]["error"] > 0) {
	die("Error: " . $_FILES["file"]["error"] . '.');
}

if (($_FILES["file"]["type"] != "application/pdf") ||
	($_FILES["file"]["size"] > 128 * 1024 * 1024) || // Greater than 128MB
	!in_array($extension, $allowedExts)) 
{
	die("Error: Illegal File Suffix, MIME Type or Filesize.");
}

$tmpFileName = md5(uniqid(mt_rand(), true));
$tmpFileDir = 'upload/' . $tmpFileName;
$tmpFilePath = $tmpFileDir . '/' . $tmpFileName . '.pdf';
$tmpResultPath = $tmpFileDir . '/' . $tmpFileName . '.ceraxml';

mkdir($tmpFileDir);
move_uploaded_file($_FILES["file"]["tmp_name"], $tmpFilePath);

exec("sh Cermine/cermine.sh $tmpFileDir > /dev/null &");
exit($tmpFileName);

?>