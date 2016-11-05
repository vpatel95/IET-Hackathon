<?php

	//echo "ved";
	include_once dirname(__FILE__) . '/include/PathController.php';
	$pathObj = new PathController();

	$task = $_POST['task'];

	if($task == 'signup') {
		# code..
	}elseif ($task == 'login') {
		# code...
	} elseif ($task == 'updatepriority') {
		$level = $_POST['level'];
		$path = $_POST['path'];
		$status = $_POST['status'];
		echo $pathObj->updatePath($level, $path, $status);
	} elseif ($task == '') {
		# code...
	} elseif ($task == '') {
		# code...
	}

?>