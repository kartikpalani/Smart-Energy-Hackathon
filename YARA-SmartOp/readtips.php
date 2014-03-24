<?php
session_start();
//opening the file
$handle = fopen('tips.txt', 'rb');
//checking if the offset is set already means the file has been read already
if (isset($_SESSION['offsettips'])) {
	$data = stream_get_contents($handle, -1, $_SESSION['offsettips']);// Second parameter is the size of text you will read on each request
	echo $data;
	echo "<br>";
	//seeking to end of the file
	fseek($handle, 0, SEEK_END);
	//setting the offset for next read
	$_SESSION['offsettips'] = ftell($handle);
} else {
	//if offset not set means file has not read so just set offset
	$data = stream_get_contents($handle, -1,-1);// Second parameter is the size of text you will read on each request
	//echo $data;
	fseek($handle, 0, SEEK_END);
	$_SESSION['offsettips'] = ftell($handle);
} 
exit();

?>