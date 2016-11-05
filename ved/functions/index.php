<?php

	require '../include/PathController.php';
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
		$pathObj->updatePath($level, $path, $status);
	} elseif ($task == '') {
		# code...
	} elseif ($task == '') {
		# code...
	}

?>