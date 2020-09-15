<?php
//session_start();
if (!isset($_SESSION['USERNAME']) || !isset($_SESSION['STATUS_ACCOUNT']) || !isset($_SESSION['PASSWORD']))
{
	header("location: login");
	die();
}
?>