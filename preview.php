<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$rootDir = "case";
if (!file_exists($rootDir)) {
	mkdir($rootDir);
}

if (!isset($_POST['file'])) 
{
	echo "Waiting to run...";
	return;
}
$file = $_POST['file']; 
$fullPathFile = $rootDir . DIRECTORY_SEPARATOR . $file; 

if (isset($_POST["source"]) && $_POST["source"] != "") {
	file_put_contents($fullPathFile, $_POST["source"]);
}



if (file_exists($fullPathFile)) {
	echo "<pre>Runing " . $file . "</pre>";
	$start = microtime(true);
	include($fullPathFile);
	$time_elapsed_secs = (microtime(true) - $start) * 1000;
	echo "<pre>Finisehd in " . number_format($time_elapsed_secs, 2) . "s</pre>";
}
else
{
	echo "Waiting to run...";
}


