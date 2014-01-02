<?php
	include("includes/header.php");
	include("includes/left.php");
    include("conf/require-functions.php");
    
?>
    <div id="main" class="span-18 last">
    	<div class="span-18 last prepend-top">
			<p class="error">You Do not have permission to access this page.</p>
            <?php
				$IP = $_SERVER['REMOTE_ADDR'];
				logLocation($IP);
			?>
            <p>If you have accidentlally reached this page, you can ignore this message. However, your IP Address has been logged.</p>
        </div>
    </div>
<?php
	include("includes/footer.php");
?>
