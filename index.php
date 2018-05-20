<?php	
	header("Content-type: text/html;charset=utf-8");
	date_default_timezone_set('Asia/Shanghai');
	$controller = isset($_GET['c']) ? $_GET['c'] : 'Home';
	$action = isset($_GET['a']) ? $_GET['a'] : 'index';
	session_start();
	include "./common/fuction.php";
	$className = "{$controller}Controller";
	$con = new $className();
	$con->$action();	