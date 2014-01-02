<?php
	include("includes/header.php");
	include("includes/left.php");
    include("conf/require-functions.php");
    
    $widget_name = space($_GET['widget']);
    validUserCheck("adminwidget_tbl", $widget_name);
    
    
 ?>
    <div id="main" class="span-18 last">
    	<div class="span-18 last prepend-top" id="functions">
        	<p>
            <?php
				$widget=mysql_fetch_array(mysql_query("SELECT * FROM widgets WHERE name='".space($_GET['widget'])."'"));
				$widget_id=$widget['id'];
				$widget_logo=$widget['logo'];
				$widget_name=$widget['name'];
				$widget_description=$widget['description'];
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
        <?php
			if (isset($_GET['edit_id'])){
				$edit_id=$_GET['edit_id'];
				$form_name=space($_GET['function']);
				$table=mysql_fetch_array(mysql_query("SELECT form_name FROM forms WHERE title='$form_name'"));
				$table_name=$table['form_name'];
				//echo $form_name;exit;
				//echo "SELECT * FROM $table_name WHERE id = $edit_id";
				$edit=mysql_fetch_array(mysql_query("SELECT * FROM $table_name WHERE id = $edit_id"));
				//print_r($edit);exit;
			}
            
            if(isset($_POST['add']) || isset($_POST['edit'])){
                //foreach($_POST as $key => $value){
//                    formValidation($key,$value);
//                }
                $error = "";
                $error = formValidation($_POST);
                if($error==""){
                    if (isset($_POST['add'])){                
        				$formname=$_POST['formname'];
        				if(mysql_num_rows(mysql_query("SELECT table_name FROM information_schema.tables WHERE table_schema = '".DATABASE_NAME."' AND table_name = '$formname'"))==0){
        					mysql_query("CREATE TABLE $formname (id INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(id))") or die(mysql_error());
        					//echo "table $formname created!"; exit;
        				}
        				$column_names = "";
        				$values = "";
						$menu_id=0;
						$album_id=0;
						foreach ($_POST as $key => $input_arr) {
							$_POST[$key] = addslashes($input_arr);
						}
          				foreach ($_POST as $key => $value) {
        					if ($key!='add' && $key!='edit' && $key!='formname'){
        						//check if key exists, if not create the column
        						$form_id=mysql_fetch_array(mysql_query("SELECT id FROM forms WHERE form_name='$formname'"));
        						$column_attr=mysql_fetch_array(mysql_query("SELECT table_element_type FROM form_elements WHERE form_id=".$form_id['id']." AND name='$key'"));
        						//echo $form_id['id']; exit;
        						//echo $key; exit;
        						//echo $column_attr['table_element_type']; exit;
								if($key=="menuId") $menu_id=$value;
								if($key=="albumId") $album_id=$value;
        						add_column_if_not_exist($formname, $key, $column_attr['table_element_type']);
        						$column_names.=", $key";
        						$values.=", '$value'";
        					}
          				}
						//echo $album_id;exit;
        				foreach($_FILES as $key => $value){
        					//check if key exists, if not create the column
        					$form_id=mysql_fetch_array(mysql_query("SELECT id FROM forms WHERE form_name='$formname'"));
        					$column_attr=mysql_fetch_array(mysql_query("SELECT table_element_type FROM form_elements WHERE form_id=".$form_id['id']." AND name='$key'"));
        					//echo $form_id['id']; exit;
        					//echo $key; exit;
        					//echo $column_attr['table_element_type']; exit;
							if($album_id!=0) {
								$album_name=mysql_fetch_array(mysql_query("SELECT albumName FROM albums WHERE id=$album_id"));								
								$albumName=getAlbum($album_name['albumName']);
							}
							if($menu_id!=0) {$album_name=mysql_fetch_array(mysql_query("SELECT menuName FROM menu_categories WHERE id=$menu_id"));								
								$albumName=getAlbum($album_name['menuName']);
							}
							//echo $album_name['albumName'];exit;
        					add_column_if_not_exist($formname, $key, $column_attr['table_element_type']);
        					$filename = basename($_FILES[$key]['name']);
        					$filename = str_replace(' ', '_', $filename);
							//echo $albumName;exit;
        					if($menu_id!=0 || $album_id!=0) $filePath="../images/".$formname."/".$albumName;
							else $filePath="../images/".$formname;
        					if(!file_exists($filePath)){
        						mkdir($filePath);
        					}
       						move_uploaded_file($_FILES[$key]['tmp_name'], $filePath."/".$filename);
        					$column_names.=", $key";
        					$values.=", '$filename'";			
        				}
        				//check if table exists, else create the table
        				$addQuery=mysql_query("insert into $formname (id $column_names) values ('' ".$values.")") or die(mysql_error());
                        
                        if($formname == 'widgets'){
                            $getUsername = mysql_query("SELECT * FROM `login_table`");
                            $w_name = ($_POST['name']);
                        
                            while($row=mysql_fetch_array($getUsername)){
                                $usernames = $row['username'];
                                mysql_query("INSERT INTO `adminwidget_tbl` (`id` ,`username` ,`widgetname` ,`tools`) VALUES ('' , '$usernames', '$w_name', 'yes')");
                            }
                        }
        		?>
                <div class="span-18 last" id="message">
                	<p class="message">
                    	<?php
        					$message=mysql_fetch_array(mysql_query("SELECT success_message from forms WHERE form_name='$formname'"));
        					echo $message['success_message']." <b>added</b>";
                            //echo "this is check";
        				?>
                    </p>
                </div>
        <?php }
		
		if (isset($_POST['edit'])){
				$formname=$_POST['formname'];
				$column_names = "";
				$values = "";
				$menu_id=0;
				$album_id=0;
				foreach ($_POST as $key => $input_arr) {
							$_POST[$key] = addslashes($input_arr);
						}

  				foreach ($_POST as $key => $value) {
					if ($key!='add' && $key!='edit' && $key!='formname'){
						//check if key exists, if not create the row						
						if ($value!="")	mysql_query("UPDATE $formname SET $key='$value' WHERE id=".$_GET['edit_id']);
						if ($value=="<-Choose One->") mysql_query("UPDATE $formname SET $key='' WHERE id=".$_GET['edit_id']);
						if($key=="menuId") $menu_id=$value;
						if($key=="albumId") $album_id=$value;
						//echo "UPDATE $formname SET $key='$value' WHERE id=".$_GET['edit_id']."</br>";
						//echo $key."-> $value</br>";
					}
  				}				
				
				$edit=mysql_fetch_array(mysql_query("SELECT * FROM $table_name WHERE id = $edit_id"));
				//echo "insert into $formname (id $column_names) values ('' ".$values.")";exit;
				//check if table exists, else create the table
				
		?>
        <div class="span-18 last" id="message">
        	<p class="message">
            	<?php
					$message=mysql_fetch_array(mysql_query("SELECT success_message from forms WHERE form_name='$formname'"));
					echo $message['success_message']." <b>Edited</b>";
				?>
            </p>
        </div>
        <?php }
                    
                }
                

            }
            //formValidation($_POST);    
			
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
					$form_name=space($_GET['function']);
					$form=mysql_fetch_array(mysql_query("SELECT * FROM forms WHERE title='$form_name'"));
					$form_id=$form['id'];
					?>
					<p><?php echo $form['instruction'];?></p>
                    <p>Fields marked <span style="color:#F00">*</span> are compulsory</p>
					<form id="<?php echo $form['form_name'];?>" name="<?php echo $form['form_name'];?>" method="post" enctype="multipart/form-data" onsubmit="return validateform('<?php echo $form['form_name'];?>')">
                    	<input type="hidden" name="formname" value="<?php echo $form['form_name'];?>" id="form_name" />
						<?php
							$query=mysql_query("SELECT label, type, name, instruction, compulsory, row_name, options, validation, error_message, is_editable FROM form_elements WHERE form_id=$form_id");
							$i=1;
							while($form_elements=mysql_fetch_array($query)){?>
                            <span class="span-18 last" id="element<?php echo $i;?>">
							<label for="<?php echo $form_elements['name'];?>"><?php echo $form_elements['label']; if ($form_elements['compulsory']=='yes') echo "<span style='color:#F00'>*</span>";?></label>
							<?php
								switch($form_elements['type']){
									case "text": case "password":?>
									<input type="<?php echo $form_elements['type'];?>" name="<?php echo $form_elements['name'];?>" id="<?php echo $form_elements['name'];?>" value="<?php if(isset($edit)) echo $edit[$form_elements['name']];?>" <?php if ($form_elements['compulsory']=='yes'){?>onblur="validate('<?php echo $form_elements['name'];?>', '<?php echo $form_elements['validation'];?>');"<?php }?> <?php if($form_elements['is_editable']=="no" && isset($edit)) echo "disabled='disabled'";?> />                                    
									<?php break;
									case "file":?>
                                    
									<input type="<?php echo $form_elements['type'];?>" name="<?php echo $form_elements['name'];?>" id="<?php echo $form_elements['name'];?>" class='normal button' value="<?php if(isset($edit)) echo $edit[$form_elements['name']];?>" <?php if(!isset($edit)){ if ($form_elements['compulsory']=='yes'){?>onblur="validate('<?php echo $form_elements['name'];?>', '<?php echo $form_elements['validation'];?>');"<?php }}?> />
                                    <?php if(isset($edit)){?>
                                        <span class="form_img">                                    
                                            <img src="<?php echo WEB_URL."images/".$form['form_name']."/".$edit[$form_elements['name']]; ?>"/>
                                            <?php
                                                $file_path = WEB_URL."images/".$form['form_name']."/".$edit[$form_elements['name']];
                                                //echo $file_path."<br>";
                                                $image = @getimagesize($file_path);
                                                
                                                if($image != ""){
                                                    echo "<input type='hidden' id='hidden_value' value='file_exists' name='file_check' />";
                                                }
                                                else{
                                                    echo "<input type='hidden' id='hidden_value' value='file_not_exists' name='file_check' />";
                                                }
                                           
                                            ?>    
                                        </span>
                                    <?php }?>
                                    
                                    
                                    <?php break;
									case "textarea":?>
									<textarea name="<?php echo $form_elements['name'];?>" id="<?php echo $form_elements['name'];?>"  <?php if ($form_elements['compulsory']=='yes'){?>onblur="validate('<?php echo $form_elements['name'];?>', '<?php echo $form_elements['validation'];?>');" <?php } ?>><?php if(isset($edit)) echo $edit[$form_elements['name']];?></textarea>
									<?php break;
									case "richtext":?>
									<textarea name="<?php echo $form_elements['name'];?>" class="richtext" id="<?php echo $form_elements['name'];?>"  <?php if ($form_elements['compulsory']=='yes'){?> <?php } ?>><?php if(isset($edit)) echo $edit[$form_elements['name']];?></textarea>
                                    <script type="text/javascript">
    	                                bkLib.onDomLoaded(function() {
											new nicEditor({iconsPath : '<?php echo BASE_URL;?>nicEditorIcons.gif'}).panelInstance('<?php echo $form_elements['name'];?>');
									   });
									</script>
									<?php break;
									case "select":?>
                                    <select name="<?php echo $form_elements['name'];?>"  id="<?php echo $form_elements['name'];?>">
                                    	<?php
										if($form_elements['row_name']!="" && $form_elements['row_name']!=NULL){
											$table_row=getParts($form_elements['row_name'], 0);
											
											$query2=mysql_query("SELECT id, ".$table_row[1]." FROM ".$table_row[0]);?>
                                            	<option value="">&nbsp;</option>
                                            <?php
											while($option=mysql_fetch_array($query2)){?>
												<option value="<?php echo $option['id'];?>"
												<?php 
                                                	if(isset($edit)){
														  if ($edit[$form_elements['name']]==$option['id']) echo " selected='selected'";
													}
												?>>
												<?php echo $option[$table_row[1]];?></option>
											<?php }
										}
										else if($form_elements['options']!="" && $form_elements['options']!=NULL){
											$options=getParts($form_elements['options'], 1);
											for($i=0; $i<sizeof($options); $i++){?>
												<option value="<?php echo $options[$i]; ?>"><?php echo $options[$i]; ?></option>
											<?php }
										}
										?>
                                    </select>
                                    <?php break;
									case "date":?>
										<input type="text" name="<?php echo $form_elements['name'];?>" value="<?php echo date("Y-m-d"); ?>"  id="<?php echo $form_elements['name'];?>"/>
                                        <?php
										break;
								}?>     
                                                
							<span class="bubble" id="bubble_<?php echo $form_elements['name'];?>"  ><p><?php echo $form_elements['instruction'];?></p></span>
                            <span class="errorbubble hide" id="errorbubble_<?php echo $form_elements['name'];?>"><p><?php echo $form_elements['error_message'];?></p></span>
                            </span>
							<?php $i++;}?>
						<p><input type="submit" value="<?php if(isset($edit)){echo "Edit";} else echo $form['submit_value'];?>" name="<?php if(isset($_GET['edit_id'])) echo "edit"; else echo "add";?>" class="button" id="submit_button"/></p>
					</form>
                    <span id="errorwarn"></span>
                    <?php //END OF RENDERING FORM ?>	
                <?php  //END OF Check if the FUNCTION IS FORM
				
					//CHECK IF THE FUNCTION IS TABLE?>
					
       		</div>
        </div>       
        
        
    


<?php
    if(isset($error)){
        if($error!=""){
            $error = explode(",",$error);
            foreach($error as $errors){
                //trim($errors);
                changeBubble($errors);
            }
        }        
    }
    function changeBubble($errors){
        ?>
        <script type="text/javascript">
	       var bubble = "<?php echo $errors; ?>";
           var toHide =  "bubble_"+bubble;
           var toShow = "errorbubble_"+bubble;
           var element = document.getElementById(toHide);
           if(bubble!=""){
               document.getElementById(toHide).style.display = 'none';
               document.getElementById(toShow).style.display = 'block';
           }

        </script>
        <?php
    }
?>
<?php
	include("includes/footer.php");
?>