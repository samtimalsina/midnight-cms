<?php
ob_start();
session_start();

include('dbConnect.php');
define("DATABASE_NAME", $db->database_name);
define("ADMIN_FOLDER", '/admin/'); //The name of the admin folder.
define ("LOCAL_FOLDER", "/midnight-cms"); //Change this if in a folder like /midnight-cms
	define("HOST_NAME",LOCAL_FOLDER.ADMIN_FOLDER);
	define("ABSOLUTE_HTTPS_PATH","https://".$_SERVER['HTTP_HOST'].LOCAL_FOLDER.ADMIN_FOLDER);
	define("ABSOLUTE_HTTP_PATH","http://".$_SERVER['HTTP_HOST'].LOCAL_FOLDER.ADMIN_FOLDER);
	define("BASE_URL","http://".$_SERVER['HTTP_HOST'].LOCAL_FOLDER.ADMIN_FOLDER);
	define("WEB_URL","http://".$_SERVER['HTTP_HOST'].LOCAL_FOLDER.ADMIN_FOLDER);
	define("BLANK_URL","");

include('functions.php');
?>