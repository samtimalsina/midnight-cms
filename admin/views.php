<?php
	include("includes/header.php");
	include("includes/left.php");
    include("conf/require-functions.php");
	include("conf/search.php");
    $widget_name = space($_GET['widget']);
    validUserCheck("adminwidget_tbl", $widget_name);
	$max_records=10;	
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
				$formsQuery=mysql_query("SELECT * FROM forms WHERE widget_id=$widget_id AND visible='yes'");
				while($forms=mysql_fetch_array($formsQuery)){
    				//echo "------------->".space($_GET['widget']);
			?>
            
            <a href="<?php echo BASE_URL."widgets/".cut($widget_name)."/forms/".cut($forms['title']);?>" class="functions form"><?php echo $forms['title'];?></a>
            <?php }
				$tablesQuery=mysql_query("SELECT * FROM tables WHERE widget_id=$widget_id AND visible='yes'");
				while($tables=mysql_fetch_array($tablesQuery)){					
			?>
            <a href="<?php echo BASE_URL."widgets/".cut($widget_name)."/views/".cut($tables['title']);?>" class="functions table"><?php echo $tables['title'];?></a>
            <?php }?>
            </p>
        </div>       
        
        <?php 
			if(isset($_GET['delete_id'])){
				$delete_id=$_GET['delete_id'];
				$widget_name=$_GET['widget'];
				$table_name=$_GET['table_name'];
				//echo $table_name;exit;
				mysql_query("DELETE FROM $table_name WHERE id=$delete_id");
				unset($_GET['table_name']);
				?>
                
                <div class="span-18 last" id="message">
                    <p class="message">The item has been deleted...</p>
                </div>	
		<?php }?>
        
    	<div class="span-18 last prepend-top" id="widget_heading">
        	<h2><a href="<?php echo BASE_URL."widgets/".$_GET['widget'];?>"><?php echo space($_GET['widget']);?></a> > <?php echo space($_GET['function']);?></h2>
            	<?php
				$table_title=space($_GET['function']);
            	$table=mysql_fetch_array(mysql_query("SELECT * FROM tables WHERE title='$table_title'"));
				$need_search=$table['need_search'];
				$table_id=$table['id'];
				$table_name=$table['table_name'];
				?>                	
                    <p class="info hide"><?php echo $table['description'];?></p>
                    <div id="error_msg" class="error" style="display: none;"></div>
                    <?php
					if($need_search=='yes'){ ?>
                    <div class="span-18 last prepend-bottom" id="search_bar">
                    	<form style="margin-left:10px;" method="post" action="" onsubmit="return fieldCheck();">
                        	<input type="text" name="search_txt" id="search_txt" style="width:200px;" value="<?php if(isset($_POST['search'])) echo $_POST['search_txt'];?>"/> In:                             
                            <select name="filter" id="filter">                            	
                            	<?php
									$option_query=mysql_query("SELECT title, row_name FROM table_elements WHERE table_id = $table_id AND is_searchable='yes'") or die(mysql_query);
									while($options=mysql_fetch_array($option_query)){
								?>
                            	<option value="<?php echo $options['row_name'];?>" <?php if(isset($_POST['filter']) && $_POST['filter']==$options['row_name']) echo " selected='selected' "; ?>><?php echo $options['title'];?></option>
                                <?php } ?>
                            </select>
                            <input type="submit" class="button" value="Search" name="search"/>
                        </form>
                    </div>
                    <?php }?>
                    
                    <table style="border:2px solid #eee;">
                    	<tr style="text-transform:capitalize">
                        	<th>S.N.</th>
						<?php
                    	$query=mysql_query("SELECT * FROM table_elements WHERE table_id=$table_id");
						$i=1;
						$arr=array();
						$link=array();
						$connected=array();
						$isComplex=array();
						while($table_elements=mysql_fetch_array($query)){
						?>
                        	<th>
                            	<?php
                                echo $table_elements['title'];
								$arr[$i]=$table_elements['row_name'];
								if(isComplex($table_elements['row_name'])){
									$isComplex[$i]="true";
								}
								else {$isComplex[$i]="false";}
								if ($table_elements['view_more_link']!="" && $table_elements['view_more_link']!=NULL){									
									$link_more=mysql_fetch_array(mysql_query("SELECT title FROM tables WHERE id=".$table_elements['view_more_link']));
									$link[$i]=cut($link_more['title']);
									$connected[$i]=$table_elements['connected'];
								}								
								else
									$link[$i]="0";
								$i++;
								?>
                            </th>
                        <?php } ?>
                        	<th>Actions</th>
                        </tr>
                        
                        <?php
						//$limit=5;
						if(isset($_GET['page'])) $page=$_GET['page']; else $page=1;
						$limit ='LIMIT ' .(($page-1)*$max_records).','.($max_records);
						$is_linked=false;
						if (isset($_GET['table_name'])){
							$foreign_id=mysql_fetch_array(mysql_query("SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE (TABLE_SCHEMA = '".DATABASE_NAME."') AND (TABLE_NAME = '$table_name') AND (COLUMN_KEY = 'MUL')"));
							$foreign_id_name=$foreign_id['COLUMN_NAME'];
							$foreign_id_id=$_GET['table_name'];
							//echo "<p class='info'>SELECT * FROM $table_name WHERE $foreign_id_name=$foreign_id_id</p>";
							$query2=mysql_query("SELECT * FROM $table_name WHERE $foreign_id_name=$foreign_id_id $limit");
							$is_linked=true;
						}
						else{
							//echo "<p class='info'>SELECT * FROM $table_name</p>";
							if (isset($_POST['search'])){
								$query2 = search_perform($table_name, $_POST['filter'], $_POST['search_txt']);								
							}
							else{
								$query2=mysql_query("SELECT * FROM $table_name $limit");
							}
						}
						$sn=1;	
                        					
						while($data=mysql_fetch_array($query2)){?>    
                                            
                        <tr id="id_<?php echo $data['id']; ?>">
                        	<td style="width:20px;"><?php echo $sn;?></td>
                        <?php
                        for($j=1; $j<$i; $j++){
						?>                        
                        	<td>
                            	<?php
                            	if($isComplex[$j]=="true"){
									$parts=getParts($arr[$j],0);
									$newTable=$parts[0];
									$newRow=$parts[1];
									$newId=$parts[2];
									$newResult=mysql_fetch_array(mysql_query("SELECT $newRow FROM $newTable WHERE id=".$data[$newId]." LIMIT 1"));									
									echo $newResult[$newRow];
								}
								else{
									if ($data[$arr[$j]]=="0"){
											$data[$arr[$j]]="view";
										}									
									else if ($link[$j]!="0"){
										if ($connected[$j]=='yes')
											echo "<a href='$link[$j]=".cut($data['id'])."'>"."view"."</a>";
										else
											echo "<a href='$link[$j]'>"."view"."</a>";
									}									
									else{
										$eyecandy=eyecandy($data[$arr[$j]]);										
										switch ($eyecandy){
											case "image":
												$alId=0;
												$mId=0;
												$album_menu_id=0;
												$album_query=mysql_query("SELECT * FROM $table_name") or die(mysql_error);
												while($album=mysql_fetch_field($album_query)){
													if ($album->name=="albumId") $alId=1;
													if($album->name=="menuId") $mId=1;
												}		
												if($alId=="1" || $mId=="1") {
													$album_menu_id=1;
													if($alId=="1"){
														$album_query=mysql_query("SELECT $table_name.albumId, albums.albumName FROM $table_name, albums WHERE $table_name.image='".$data[$arr[$j]]."' AND albums.id=$table_name.albumId") or die(mysql_error);
														$album=mysql_fetch_array($album_query);
														$albumName=getAlbum($album['albumName']);
													}
													if($mId=="1") {
														$album_query=mysql_query("SELECT $table_name.menuId, menu_categories.menuName FROM $table_name, menu_categories WHERE $table_name.image='".$data[$arr[$j]]."' AND menu_categories.id=$table_name.menuId") or die(mysql_error);
														$album=mysql_fetch_array($album_query);
														$albumName=getAlbum($album['menuName']);
													}
												}
												if($album_menu_id!=0){													
													if(url_exists(WEB_URL."images/$table_name/$albumName/".$data[$arr[$j]])){ ?>
                                            			<a href="javascript:void(0);" class="screenshot" rel="<?php echo WEB_URL."images/$table_name/$albumName/".$data[$arr[$j]];?>" title="Filename: <?php echo $data[$arr[$j]];?>"><img src="<?php echo BASE_URL;?>images/image.gif" /></a>
	                                            <?php 	} else { ?>
		                               					<img src="<?php echo BASE_URL;?>images/broken_image.gif" />
											<?php		}
												}
												else{
													if(url_exists(WEB_URL."images/$table_name/".$data[$arr[$j]])){?>
                                            		<a href="javascript:void(0);" class="screenshot" rel="<?php echo WEB_URL."images/$table_name/".$data[$arr[$j]];?>" title="Filename: <?php echo $data[$arr[$j]];?>"><img src="<?php echo BASE_URL;?>images/image.gif" /></a>
                                            <?php } else { ?>
                               					<img src="<?php echo BASE_URL;?>images/broken_image.gif" />
                                            <?php }
												}
												break;
            
                                            case "email":                                                
                                                echo "<a href='mailto:".$data[$arr[$j]]."'>".$data[$arr[$j]]."</a>";
                                                break;
                                                
                                            case "document":
                                                $doc_type = (substr(strrchr($data[$arr[$j]],'.'),1)).".gif";
                                                if(url_exists(WEB_URL."images/$table_name/".$data[$arr[$j]])){?>
                                                    <a href="<?php echo WEB_URL."images/$table_name/".$data[$arr[$j]]; ?>" ><img src="<?php echo BASE_URL;?>images/<?php echo $doc_type; ?>" /></a> 
                                                <?php } else { ?>
                                                    <img src="<?php echo BASE_URL;?>images/<?php echo "broken_".$doc_type;?>" />
                                                <?php }    
                                            break;
                                                
                                            case "url":
                                                $www_check = "/^(www|wap).([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i";
                                                if((bool)preg_match($www_check, $data[$arr[$j]]) == true){
                                                    $addhttp = "http://";
                                                    $data[$arr[$j]] =  $addhttp . $data[$arr[$j]];
                                                }
                                                echo "<a href='".$data[$arr[$j]]."' target='_blank'>".$data[$arr[$j]]."</a>";
                                                break;    
                                               
                                            case "long_text":
                                                echo "<div class='demo-show'>";
                                                //echo "<h3>Title </h3>";
                                                for($k=0; $k<10; $k++){
                                                    $longword = explode(" ",$data[$arr[$j]]);
                                                    echo $longword[$k]." ";
                                                }
                                                echo "...";
                                                echo "<br><span class='read_more'><font color='green'>Read More</font></span>";
                                                //echo "<div>".$data[$arr[$j]]."</div>";
                                                echo "</div>";
                                                
                                                echo "<div class='demo-hide'>".$data[$arr[$j]];
                                                echo "<br><span class='read_less'><font color='green'>Less</font></span>";
                                                echo "</div>";
                                                

                                                break;
                                                
                                            case "yes_no":
                                                echo "<a href='#' class='yes_no' id='".$data['id']."' >".$data[$arr[$j]]."</a>";
                                            break;    
                                                
											default:
												echo $data[$arr[$j]];
												break;
										}										
									}
								}
								?>
                            </td>                        
                        <?php }?>
                        	<td style="width:50px;">
                            	<?php if($table['delete_yn']=="yes"){?>
                                
                                
                                <?php // echo BASE_URL."widgets/".cut($widget_name)."/".$_GET['function']."/".cut($table_name)."/delete=".$data['id']; 
                                $delete_url = BASE_URL."widgets/".cut($widget_name)."/".$_GET['function']."/".cut($table_name)."/delete=".$data['id'];
                                //echo $widget_name."<br>".$data['id']."<br>".$table_name;
                                
                                ?>
                                <a href="#" id="<?php echo $data['id']; ?>" class="icons delete" title="delete">&nbsp;</a>
                                <?php }?>
                                <?php if($table['edit_yn']=='yes'){
									$edit=mysql_fetch_array(mysql_query("SELECT title FROM forms WHERE id=".$table['edit_function_id']));
									$edit_function=$edit['title'];
									?>
                                <a href="<?php echo BASE_URL."widgets/".cut($widget_name)."/".cut($edit_function)."/edit/".$data['id'];?>" class="icons edit" title="edit">&nbsp;</a>                               
                                <?php }?>
                            </td>
                        </tr>
                        <?php $sn++;}?>
                    </table>
                    <span class="span-18 last" id="pagination">
                    <?php
						if ($is_linked==true){
							$num_rows=mysql_num_rows(mysql_query("SELECT id FROM $table_name WHERE 1 AND $foreign_id_name=$foreign_id_id"));
						}
						else{
							$num_rows=mysql_num_rows(mysql_query("SELECT id FROM $table_name WHERE 1"));
						}
						for($i=1; $i<=($num_rows/$max_records+1); $i++){
                        	if($i==$page){?>
                            	<a href="javascript:void(0);" class="active"><?php echo $i;?></a>
                            <?php } else {?>
								<a href="<?php echo BASE_URL."widgets/".cut($widget_name)."/views/".$_GET['function'];?>&page=<?php echo $i;?>"><?php echo $i;?></a>
						<?php }}
					?>
                    </span>
       		</div>
        </div>       
        
        



<div id="delete_alert" style="display: none; position: fixed; top: 0px;"></div>
<div id="main_delete_alert" style="display: none; position: fixed; "></div>
<!--
<div id="main_delete_alert" style="display: none; position: fixed; ">
    <center><form>
        <br /><br />
        <h3><font color="red">Do you want to delete?</font></h3><br />
        <input type="button" value="Yes" style="height: 25px; width: 60px;" id="delete_yes" />
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input style="height: 25px; width: 60px;" type="button" value="No" id="delete_no" />
    </form></center>
</div>
-->


<script type="text/javascript">

    $(".delete").click(function(){
        var width = $(window).width();
        var height = $(window).height();
       
        $("#delete_alert").width(width);
        $("#delete_alert").height(height);
       
        $("#delete_alert").css({
            "background-color":"white",
            "opacity": "0.5"
        });
        $("#delete_alert").fadeIn('slow');
        $("#main_delete_alert").css({
            "top":height/4,
            "left":width/3,
            "background-color":"white",
            "border":"solid 1px" 
        });
        $("#main_delete_alert").width(width/4);
        $("#main_delete_alert").height(height/3);
        $("#main_delete_alert").fadeIn('slow');
        
        var urls= '<?php echo BASE_URL; ?>'
        var delete_id = $(this).attr('id');
        var table_name = '<?php echo $table_name; ?>';
        
        
        $.ajax({
            type: "POST",
            url: urls+"conf/ajax_functions.php",
            data: "value=delete&delete_id="+delete_id+"&table_name="+table_name+"&url="+urls+"conf/ajax_functions.php",
            success: function(msg){
                $("#main_delete_alert").html(msg);
            },
            beforeSend: function(){
                $("#main_delete_alert").html('<center><br><br><br><h3>Loding...</h3></center>');
            }
         });    
    })

</script>

<script type="text/javascript">

    
    $(".yes_no").click(function(){
        var table_name = '<?php echo $table_name; ?>';
        var table_id = $(this).attr('id');
        urls= '<?php echo BASE_URL; ?>';
         $.ajax({
            type: "POST",
            url: urls+"conf/ajax_functions.php",
            data: "value=yes_no&table_name="+table_name+"&table_id="+table_id,
            success: function(msg){
                $("#"+table_id).html(msg);
            },
            beforeSend: function(){
                $("#"+table_id).html('loding..');
            }
         });
    })
</script>

<script type="text/javascript">
	function fieldCheck(){
	   if($("#search_txt").val()==""){
	       //$("#php_error").hide();
           $("#error_msg").show();
           $("#error_msg").html("The Search Paramater is missing. Please check and try again.")
           return false;
	   }
       else{
           return true; 
       }
	}
</script>
<?php
	include("includes/footer.php");
?>