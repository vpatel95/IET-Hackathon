<?php

	require '../include/PathController.php';
	$pathObj = new PathController();

	$task = $_POST['task'];

	if($task == 'signup') {
		# code..
	}elseif ($task == 'login') {
		# code...
	} elseif ($task == 'updatePriority') {
		$pathObj->updatePath();
	} elseif ($task == '') {
		# code...
	} elseif ($task == '') {
		# code...
	}

?>