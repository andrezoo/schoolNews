<?php

if(isset($_FILES)){

	require '../../service/get_ip.php';

	$ip = md5($ipaddress);

	$uploaddir = '../css/img/upload/moderation/'.$ip;

	$result = array();

	if(!is_dir($uploaddir)) mkdir($uploaddir, 0777, true);

	$files = $_FILES;
	$done_files = array();

	foreach( $files as $file ){

		$file_name = md5($file['name']).'.'.explode(".", $file['name'])[count(explode(".", $file['name'])) - 1];

		if(!file_exists("$uploaddir/$file_name")) {

		$result[] = $file_name; if( move_uploaded_file( $file['tmp_name'], "$uploaddir/$file_name" ) ) $done_files[] = realpath( "$uploaddir/$file_name" );

		}

	}

	$data = $done_files ? array('files' => $done_files ) : array('error' => 'Ошибка загрузки файлов.');

	echo($result[0]);

}

?>
