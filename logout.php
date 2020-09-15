<?php
session_start();
 require_once "library/adodb5/adodb.inc.php" ;
 require_once('config/config.php');
 require_once('function/function.php');
/*
if (isset($_SESSION['SESS_USERNAME'])) {
	logout($_SESSION['SESS_USERNAME'],$_SESSION['SESS_PASSWORD']);
	logUser("logout");
}
$_SESSION = array();
if (isset($_COOKIE[session_name()])) {
   $params = session_get_cookie_params();
    setcookie(session_name(), '', 1,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
*/
		if (isset($_GET['msg']) && $_GET['msg']=='auto'){

			logActivity("LOGOUT","AUTO LOGOUT");
			session_destroy();
			header("location: login");


		} else {

				logActivity("LOGOUT","MANUAL LOGOUT");
				session_destroy();
				header("location: login");


			}





?>