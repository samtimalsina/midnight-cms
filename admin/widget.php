<?php
	include("includes/header.php");
	include("conf/require-functions.php");
	$widget_name = space($_GET['widget']);
    validUserCheck("adminwidget_tbl", $widget_name);
	include("includes/left.php"); 
?>
    <div id="main" class="span-18 last">    	
		<?php				
            $widget=mysql_fetch_array(mysql_query("SELECT * FROM widgets WHERE name='".space($_GET['widget'])."'"));
            $widget_id=$widget['id'];
            $widget_logo=$widget['logo'];
            $widget_name=$widget['name'];
            $widget_description=$widget['description'];
        ?>        
    	<div class="span-18 last prepend-top" id="widget_heading">
        	<span style="background:url(<?php echo WEB_URL;?>images/widgets/<?php echo $widget_logo;?>) top; margin-right:10px;" class="widget_icon big main">&nbsp;</span><h1><?php echo $widget_name;?></h1>
            <p><?php echo $widget_description;?></p>
            <div class="span-18 last">        	
        </div>
        <div class="span-18 last prepend-top" id="functions">
        	<p>
				<?php
                $query=mysql_query("SELECT * FROM forms WHERE widget_id=$widget_id AND visible='yes'");
                    while($forms=mysql_fetch_array($query)){
                ?>
                <a href="<?php echo BASE_URL."widgets/".cut($widget_name)."/forms/".cut($forms['title']);?>" class="functions form"><?php echo $forms['title'];?></a>
                <?php }
                    $query=mysql_query("SELECT * FROM tables WHERE widget_id=$widget_id AND visible='yes'");
                    while($tables=mysql_fetch_array($query)){
                ?>
                <a href="<?php echo BASE_URL."widgets/".cut($widget_name)."/views/".cut($tables['title']);?>" class="functions table"><?php echo $tables['title'];?></a>
                <?php }?>
            </p>
        </div>        
        
    </div>
    </div>
<?php
	include("includes/footer.php");
?>