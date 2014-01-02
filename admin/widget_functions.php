<?php				
	$widget=mysql_fetch_array(mysql_query("SELECT * FROM widgets WHERE name='".space($_GET['widget'])."'"));
	$widget_id=$widget['id'];
	$widget_logo=$widget['logo'];
	$widget_name=$widget['name'];
	$widget_description=$widget['description'];
	$query=mysql_query("SELECT * FROM forms WHERE widget_id=$widget_id");
	while($forms=mysql_fetch_array($query)){
?>
<a href="<?php echo BASE_URL."widgets/".cut($widget_name)."/forms/".cut($forms['title']);?>" class="functions form"><?php echo $forms['title'];?></a>
<?php }
	$query=mysql_query("SELECT * FROM tables WHERE widget_id=$widget_id");
	while($tables=mysql_fetch_array($query)){
?>
<a href="<?php echo BASE_URL."widgets/".cut($widget_name)."/views/".cut($tables['title']);?>" class="functions table"><?php echo $tables['title'];?></a>
<?php }?>