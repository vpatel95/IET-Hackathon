<?php

	include_once dirname(__FILE__) . '/include/LoginController.php';
	include_once dirname(__FILE__) . '/include/LevelController.php';
	include_once dirname(__FILE__) . '/include/PathController.php';
	$loginObj = new LoginController();
	$levelObj = new LevelController();
	$pathObj = new PathController();

	$task = $_POST['task'];

	if($task == 'signup') {
		$username = $_POST['username'];
		$password = $_POST['password'];
		echo $loginObj->signup($username, $password);
	}
	if ($task == 'login') {
		$username = $_POST['username'];
		$password = $_POST['password'];
		echo $loginObj->login($username, $password);
	}
	if ($task == 'updatepriority') {
		$level = $_POST['level'];
		$path = $_POST['path'];
		$status = $_POST['status'];
		echo $pathObj->updatePath($level, $path, $status);
	}
	if ($task == 'getlevel') {
		$username = $_POST['username'];
		return $levelObj->getLevel($username);
	}
	if ($task = 'updateserver') {
		$level = $_POST['level'];
		$path = @$_POST['path'];
		$priority = @$_POST['priority'];
		$pathObj->updateOfflinePath($level, $path, $priority);
	}
	if ($task == 'levelupdate') {
		$level = $_POST['level'];
		$username = $_POST['username'];
		echo $levelObj->updateLevel($username, $level);
	}

?>