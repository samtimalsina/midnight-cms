<?php
	include("includes/header.php");
	include("includes/left.php");
?>
    <div id="main" class="span-18 last prepend-top">
    
        <?php
            $username = $_SESSION['username'];
        	$query=mysql_query("SELECT
                                            widgets.`name`,
                                            widgets.id,
                                            widgets.description,
                                            widgets.logo,
                                            widgets.type
                                        FROM
                                            widgets
                                        INNER JOIN adminwidget_tbl ON widgets.`name` = adminwidget_tbl.widgetname
                                        WHERE
                                            adminwidget_tbl.username = '$username' AND
                                            adminwidget_tbl.tools = 'yes' AND widgets.type='common'");
			$i=1;
			while($widget=mysql_fetch_array($query)){
		?>
    	<span class="widget <?php if($i%5==0) echo 'last';?>">
        	<span style="background:url(<?php echo WEB_URL; ?>images/widgets/<?php echo $widget['logo'];?>) top;" class="widget_icon big">&nbsp;</span>
            <h1><a href="<?php echo BASE_URL; ?>widgets/<?php echo cut($widget['name']);?>"><?php echo $widget['name'];?></a></h1>
            <h2><?php echo $widget['description'];?></h2>
        </span>
        <?php $i++;} ?>
        
    </div>
<?php
	include("includes/footer.php");
?>