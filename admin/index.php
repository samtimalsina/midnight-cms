<?php
include("conf/settings.php");

if(isset($_GET['logout'])){
	if($_GET['logout']=='true'){
		unset($_SESSION["is_logged_in"]);
	}
}

if (isset($_POST['login'])){
	$message="Checking please wait";
	$username=$_POST['username'];
	$password=$_POST['password'];
    
    //$hash_password = getPasswordHash(getPasswordSalt(), $password);
    
	$sql="SELECT * FROM login_table WHERE username='$username'";
    
    $query=mysql_fetch_array(mysql_query($sql));
    
	//$query=mysql_query($sql);
	if(comparePassword($password, $query['password']) == 1){
		$_SESSION["is_logged_in"]="true";
        $_SESSION["username"] = $query['username'];
        $_SESSION["level"] = $query['level'];
		$message="success";
	}
	else{
	   $message="Wrong username or password";   
	} 
}
if(isset($_SESSION["is_logged_in"])){
	//echo BASE_URL;exit;
	header ('location: '.BASE_URL.'welcome');
    
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
<link rel="shortcut icon" type="image/x-icon" href="<?php echo WEB_URL;?>favicon1.jpg" />
<script type="text/javascript" src="scripts/scripts.js"></script>
<link href="styles/login.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="login">
    <h3>
		<?php
        	if(isset($_GET['logout']))
				echo "Thank you for using Midnight";
			else if(isset($_POST['login'])){
				echo $message;
            }
			else echo "Welcome";
		?>
    </h3>
    <form id="login_table" action="" method="post">           	
        <p><label for="username">Username: </label><input class="text" type="text" id="username" name="username" /></p>
        <p><label for="password">Password: </label><input class="text" type="password" id="password" name="password" /></p>
        <p><input type="submit" name="login" value="Login" class="button" /></p>
    </form>
    <script language="javascript">
		document.getElementById("username").focus();
	</script>
    <h3>Powered by <a href="http://qualia.com.np" target="_blank">MidNight CMS v2.0</a></h3>
</div>
</body>
</html>