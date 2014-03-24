<?php
session_start();
$filename = 'data.txt';
//opening the file
$handle = fopen($filename, 'rb');
//checking if the offset is set already means the file has been read already
if (isset($_SESSION['offset'])) {
	$data = stream_get_contents($handle, -1, $_SESSION['offset']);
	echo $data;
	//seeking to end of the file
	fseek($handle, 0, SEEK_END);
	
	//setting the offset for next read
	$_SESSION['offset'] = ftell($handle);
} else {
	//if offset not set means file has not read so just set offset
	$data = stream_get_contents($handle, -1,-1);// Second parameter is the size of text you will read on each request
    //echo $data;
    fseek($handle, 0, SEEK_END);
    $_SESSION['offset'] = ftell($handle);
} 
exit();

?>