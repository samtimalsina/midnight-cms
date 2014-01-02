<?php
if(file_exists("conf/settings.php")){
    include("conf/settings.php");
}
else if(file_exists("../conf/settings.php")){
    include("../conf/settings.php");
}
else if(file_exists("../../conf/settings.php")){
    include("../../conf/settings.php");
}
else if(file_exists("../../../conf/settings.php")){
    include("../../../conf/settings.php");
}
else if(file_exists("../../../../conf/settings.php")){
    include("../../../../conf/settings.php");
}
if(!isset($_SESSION["is_logged_in"])){
	header ('location: '.BASE_URL.'login');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Midnight CMS v2.0</title>
<link rel="shortcut icon" type="image/x-icon" href="<?php echo WEB_URL;?>favicon1.jpg" />
<link type="text/css" rel="stylesheet" href="<?php echo BASE_URL;?>styles/screen.css" media="screen, projection"/>
<link type="text/css" rel="stylesheet" href="<?php echo BASE_URL;?>styles/print.css" media="print"/>
<!--[if IE]><link type="text/css" rel="stylesheet" href="styles/ie.css" media="screen, projection"/><![endif]-->
<link type="text/css" rel="stylesheet" href="<?php echo BASE_URL;?>styles/style.css" />
<script language="javascript" src="<?php echo BASE_URL;?>scripts/validate.js"></script>
<script language="javascript" src="<?php echo BASE_URL;?>scripts/jquery-1.6.2.min.js"></script>
<script src="<?php echo BASE_URL;?>scripts/nicEdit.js" language="javascript"></script>
</head>
<body>
<div class="container">
	<div id="header" class="span-24 last">
    	<div class="span-24 last">
        	<span id="m_logo" class="span-12">
            	<h1>Midnight CMS v2.0</h1>
            </span>
            <span id="user_welcome" class="span-12 last">            	
				welcome <span class="username"><a href="#"><?php echo $_SESSION['username'];?></a></span>
            </span>
        </div>
    	<div id="options" class="span-24 last">
        	<span class="bar left"><a href="<?php echo BASE_URL;?>welcome">Home</a></span>
            <span class="bar right"><a href="<?php echo BASE_URL;?>logout">Logout</a></span>
        </div>    
    </div>