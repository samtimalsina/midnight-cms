<?php include("inc/settings.php");
if(!isset($_SESSION["is_logged_in"])){
	header ('location: '.BASE_URL.'login');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Midnight CMS v2.0</title>
<link rel="shortcut icon" type="image/x-icon" href="<?php echo WEB_URL;?>favicon.jpg" />
<link type="text/css" rel="stylesheet" href="<?php echo BASE_URL;?>styles/screen.css" media="screen, projection"/>
<link type="text/css" rel="stylesheet" href="<?php echo BASE_URL;?>styles/print.css" media="print"/>
<!--[if IE]><link type="text/css" rel="stylesheet" href="styles/ie.css" media="screen, projection"/><![endif]-->
<link type="text/css" rel="stylesheet" href="<?php echo BASE_URL;?>styles/style.css" />
<script language="javascript" src="<?php echo BASE_URL;?>scripts/validate.js"></script>
<script language="javascript" src="<?php echo BASE_URL;?>scripts/jquery-1.6.2.min.js"></script>

</head>

<body>

<div class="container">
	<div id="header" class="span-24 last">
    </div>
    <?php include("left.php");?>
    <div id="main" class="span-18 last">
    	<div class="span-18 last prepend-top" id="functions">
        	<p>
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
            </p>
        </div>
        <?php
			if (isset($_GET['edit_id'])){
				$edit_id=$_GET['edit_id'];
				$edit=mysql_fetch_array(mysql_query("SELECT * FROM widgets WHERE id = $edit_id"));
			}
			if (isset($_POST['add'])){
				$formname=$_POST['formname'];
				$column_names = "";
				$values = "";
  				foreach ($_POST as $key => $value) {
					if ($key!='add' && $key!='edit' && $key!='formname'){
						$column_names.=", $key";
						$values.=", '$value'";
					}
  				}
				$query=mysql_query("insert into $formname (id $column_names) values ('' ".$values.")") or die(mysql_error());
		?>
        <div class="span-18 last" id="message">
        	<p class="message">Widget has been successfully updated</p>
        </div>
        <?php }
			if(isset($_GET['delete_id'])){
				$delete_id=$_GET['delete_id'];
				$widget_name=$_GET['widget'];
				$query=mysql_query("DELETE FROM $widget_name WHERE id=$delete_id");
				?>			
                <div class="span-18 last" id="message">
                    <p class="message">Widget has been successfully Deleted</p>
                </div>	
		<?php }?>
        
    	<div class="span-18 last prepend-top" id="widget_heading">
        	<h2><a href="<?php echo BASE_URL."widgets/".$_GET['widget'];?>"><?php echo space($_GET['widget']);?></a> > <?php echo space($_GET['function']);?></h2>            
            	<?php 
					$function=mysql_fetch_array(mysql_query("SELECT id, name, type FROM functions WHERE name='".space($_GET['function'])."'"));
					echo $_GET['function'];exit;
					$function_id=$function['id'];
					$function_name=$function['name'];
					
					//Check if the FUNCTION IS FORM
					if ($function['type']=='form'){
						//START RENDERING FORM
						$form=mysql_fetch_array(mysql_query("SELECT * FROM forms WHERE function_id=$function_id"));
						$form_id=$form['id'];
					?>
					<p><?php echo $form['instruction'];?></p>
					<form name="<?php echo $form['form_name'];?>" method="post" >
                    	<input type="hidden" name="formname" value="<?php echo $form['form_name'];?>" />
						<?php
							$query=mysql_query("SELECT label, type, name, instruction FROM form_elements WHERE form_id=$form_id");
							$i=1;
							while($form_elements=mysql_fetch_array($query)){?>
                            <span class="span-18 last" id="element<?php echo $i;?>">
							<label for="<?php echo $form_elements['name'];?>"><?php echo $form_elements['label'];?></label>
							<?php
								switch($form_elements['type']){
									case "text": case "password": case "file":?>
									<input type="<?php echo $form_elements['type'];?>" name="<?php echo $form_elements['name'];?>" <?php if($form_elements['type']=="file") echo "class='normal'";?> value="<?php if(isset($edit)) echo $edit[$form_elements['name']];?>"/>
									<?php break;
									case "textarea":?>
									<textarea name="<?php echo $form_elements['name'];?>"><?php if(isset($edit)) echo $edit[$form_elements['name']];?></textarea>
									<?php break;
									case "select":?>
                                    <select name="<?php echo $form_elements['name'];?>">
                                    	<option>common</option>
                                    </select>
                                    <?php break;
								}?>
							<span class="bubble" id="bubble"><p><?php echo $form_elements['instruction'];?></p></span>
                            </span>
							<?php $i++;}?>
						<p><input type="submit" value="<?php echo $form['submit_value'];?>" name="<?php echo $form['submit_type'];?>" class="button"/></p>
					</form>
                    <?php //END OF RENDERING FORM ?>	
                <?php } //END OF Check if the FUNCTION IS FORM
				
					//CHECK IF THE FUNCTION IS TABLE
					else if($function['type']=='table'){						
						$table=mysql_fetch_array(mysql_query("SELECT * FROM tables WHERE function_id=$function_id"));
						$table_id=$table['id'];
						$table_name=$table['table'];
				?>
                	<h3><?php echo $table['title'];?></h3>
                    <p><?php echo $table['description'];?></p>
                    
                    <table style="border:2px solid #E5ECF9;">
                    	<tr>
                        	<th>S.N.</th>
						<?php
                    	$query=mysql_query("SELECT * FROM table_elements WHERE table_id=$table_id");
						$i=1;
						$arr=array();
						while($table_elements=mysql_fetch_array($query)){
						?>
                        	<th>
                            	<?php
                                echo $table_elements['title'];
								$arr[$i]=$table_elements['row_name'];
								$i++;
								?>
                            </th>
                        <?php }?>
                        	<th>Actions</th>
                        </tr>
                        
                        <?php
						$query=mysql_query("SELECT * FROM $table_name");
						$sn=1;
						while($data=mysql_fetch_array($query)){?>                        
                        <tr>
                        	<td><?php echo $sn;?></td>
                        <?php
                        for($j=1; $j<$i; $j++){
						?>                        
                        	<td><?php echo $data[$arr[$j]];?></td>                        
                        <?php }?>
                        	<td>
                            	<?php if($table['delete']=="yes"){?>
                                <a href="<?php echo BASE_URL."widgets/".$widget_name."/".cut($function_name)."/delete/".$data['id']; ?>" class="icons delete" title="delete">&nbsp;</a>
                                <?php }?>
                                <?php if($table['edit']=='yes'){
									$edit=mysql_fetch_array(mysql_query("SELECT name FROM functions WHERE id=".$table['edit_function_id']));
									$edit_function=$edit['name'];
									?>
                                <a href="<?php echo BASE_URL."widgets/".$widget_name."/".cut($edit_function)."/edit/".$data['id'];?>" class="icons edit" title="edit">&nbsp;</a>
                                <?php }?>
                            </td>
                        </tr>
                        <?php $sn++;}?>
                        
                        
                    </table>
                    <?php } //END OF CHECK IF THE FUNCTION IS TABLE?>
       		</div>
        </div>       
        
        </div>
    </div>
</div>

</body>
</html>