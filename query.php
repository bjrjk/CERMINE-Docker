<?php

function deldir($dir) {
	$dh = opendir($dir);
	while ($file = readdir($dh)) {
		if ($file != "." && $file != "..") {
			$fullpath = $dir . "/" . $file;
			if (!is_dir($fullpath)) {
				unlink($fullpath);
			} else {
				deldir($fullpath);
			}
		}
	}
	closedir($dh);
	return rmdir($dir);
}

$tmpFileName = $_GET['id'];
$tmpFileDir = 'upload/' . $tmpFileName;
$tmpFilePath = $tmpFileDir . '/' . $tmpFileName . '.pdf';
$tmpResultPath = $tmpFileDir . '/' . $tmpFileName . '.cermxml';

$result = file_get_contents($tmpResultPath);
if($result === false)
	echo 'Error';
else
	echo $result;

if(isset($_GET['del']))
	deldir($tmpFileDir);

?>