<?php
function validUserCheck($tbl_name, $widget_name){
	$username = $_SESSION['username'];
    //echo $tbl_name;
	$query = mysql_fetch_array(mysql_query("SELECT COUNT( username ) FROM `$tbl_name` WHERE username = '$username' AND widgetname = '$widget_name' AND tools = 'yes'"))or die("error-->".mysql_error());	
	if($query[0]!=1){
		header('Location: '.BASE_URL.'error');
		exit;
	}
}
?>