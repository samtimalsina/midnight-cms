 <p>Create legends.</p>
 <div id="php_error">
 <?php
  function get_string_between($string, $start, $end){
    	$string = " ".$string;
    	$ini = strpos($string,$start);
    	if ($ini == 0) return "";
    	$ini += strlen($start);
    	$len = strpos($string,$end,$ini) - $ini;
    	return substr($string,$ini,$len);
  }
 
  function stringCheck($string){
    $check = "";
    $check = strrpos($string, "@");
    if($check == ""){
        $check = strpos($string, "{");
        if($check == ""){
            $check = strpos($string, "}");
            if($check==""){
                $check = strpos($string, " ");
                if($check==""){
                    return false;
                }else{
                    return true;
                }
            }else{
                return true;
            }
        }
        else{
            return true;
        }
    }
    else{
        return true;
    }
 }
  if(isset($_POST['submit_edit'])){
      $edit_id = $_POST['submit_edit'];
      $edit_query = mysql_fetch_array(mysql_query("SELECT * FROM `legends_tbl` WHERE id='$edit_id'"));
      $l_legend_name = $edit_query['legends_name'];
      $legend_name = get_string_between($l_legend_name,"{","}");
      $l_table_name = $edit_query['table_name'];
      $l_column_name = $edit_query['column_name'];
      $l_level = $edit_query['level'];
  }    
      
  if(isset($_POST['legend_name']) && isset($_POST['table_name'])){
      
      if(stringCheck($_POST['legend_name']) == true){
          echo "<p class='span-18 error last'>You cannot use 'whitespaces' or '{' or '}' in Legend name.</p>";  
      }  
      else if($_POST['legend_name']=="" || $_POST['table_name']=="" ){
          echo "<p class='span-18 error last'>Please all the Field before submitting.</p>";  
      }
      else{
          $legend_name = "{".$_POST['legend_name']."}";
          $table_name = $_POST['table_name'];
          $column_name = $_POST['column_name'];
          $access_level = $_POST['access_level'];
          if($_POST['submit_check'] == "Create"){
              $query1 = mysql_fetch_array(mysql_query("SELECT COUNT( id ) FROM `legends_tbl` WHERE legends_name = '$legend_name'")) or die ("Error-->".mysql_error());
                if($query1[0] == 0){
                    mysql_query("INSERT INTO `legends_tbl` (`id` ,`legends_name` ,`table_name` ,`column_name` ,`level`) VALUES ( NULL , '$legend_name', '$table_name', '$column_name', '$access_level')") or die ("Error-->".mysql_error());
                    echo "<p class='span-18 info last'>The Legend has been created successfully.</p>";
                }
                else{
                    echo "<p class='span-18 error last'>The Legend name already exists.</p>";
                }
            }   
            else if($_POST['submit_check'] == "Edit"){
                $legend_id = $_POST['legend_id'];
                if(mysql_query("UPDATE `legends_tbl` SET legends_name='$legend_name', table_name='$table_name', column_name='$column_name', level='$access_level' WHERE id='$legend_id'")){
                    echo "<p class='span-18 info last'>Legend has been edited successfully.</p>";
                }
                else{
                    echo "<p class='span-18 error last'>Error occured please try again.</p>";
                }
            }
            else{
                echo "<p class='span-18 error last'>Error occured please try again.</p>";
            }
      }
        
  }
 
 ?>
 </div>
 <div id="error_msgs" class="error" style="display: none;"></div>
 
 <form action="" method="post" onsubmit="return fieldCheck();">
 <strong>Legend Name:</strong><br />
    <input name="legend_name" type="text" id="legend_name" value="<?php if(isset($_POST['submit_edit'])){ echo $legend_name; } ?>" /><br />
 <strong>Table Name:</strong><br />
    <input type="text" name="table_name" id="table_name" value="<?php if(isset($_POST['submit_edit'])){ echo $l_table_name; } ?>" /><br />
 <strong>Column Name:</strong><br />
    <div id="show_column">
    <select id="column_name" name="column_name">
 <?php
  if(isset($_POST['submit_edit'])){
 ?>
    <option selected="selected" value="<?php echo $l_column_name; ?>"><?php echo $l_column_name; ?></option>
 <?php     
  }
  else{
 ?>
    <option selected="selected" value="0">Enter correct table name.</option>
    
 <?php
 }
 ?>
    </select>
    </div><span id="loading"></span>
 <br />
 <strong>Access Level:</strong><br />
    <select name="access_level">
        <option value="admin">Admin</option>
        <option value="sub-admin">Sub-Admin</option>
        <option value="both">Both</option>
    </select><br />
    <input type="hidden" value="<?php if(isset($edit_id)){ echo "Edit"; }else{ echo "Create";} ?>" name="submit_check" />
    <?php 
        if(isset($edit_id)){
            echo '<input type="hidden" value="'.$edit_id.'" name="legend_id" />';
        }
     ?>
 <input type="submit" value="<?php if(isset($edit_id)){ echo "Edit"; }else{ echo "Create";} ?>" class="button" />
 </form>
 <br />
 <span style="border: solid 1px silver; width: 50%; position: absolute;"></span><br />
 
<?php
    $query1 = mysql_query("SELECT * FROM `legends_tbl`")or die("Error-->".mysql_error());
 ?>
  <table>
 <tbody>
 <tr>
 <th>S.N.</th>
 <th>Legends Name</th>
 <th>Table Name</th>
 <th>Column Name</th>
 <th>Access Level</th>
 <th>Action</th>
 </tr>
 <?php
 $sn =1;
 while($legends_data=mysql_fetch_array($query1)){
 ?>
 <tr id="id_<?php echo $legends_data['id']; ?>">
 <td style="width:20px;"><?php echo $sn; ?></td>
 <td><?php echo $legends_data['legends_name']; ?></td>
 <td><?php echo $legends_data['table_name']; ?></td>
 <td><?php echo $legends_data['column_name']; ?></td>
 <td><?php echo $legends_data['level']; ?></td>
 <td>
    <a id="<?php echo $legends_data['id']; ?>" class="icons delete" title="delete" href="#">&nbsp;</a>
    <form name="" method="post" action="" class="icons edit">
        <input type="hidden" value="<?php echo $legends_data['id']; ?>" name="submit_edit" />
        <input name="" type="submit" value="" id="edit_bttn" />
        
    </form>
 </td>
 </tr>
 <?php
 $sn++;
 }
 
 ?>
 </tbody>
 </table>
 
 <div id="delete_alert" style="display: none; position: fixed; top: 0px;"></div>
 <div id="main_delete_alert" style="display: none; position: fixed; "></div>
 
 <script type="text/javascript">
    function hasWhiteSpace(s) {
      return s.indexOf(' ') >= 0;
    }
    function hasStrings(s) {
      return s.indexOf('{') >= 0;
    }
    function hasString(s) {
      return s.indexOf('}') >= 0;
    }
    function fieldCheck(){
        if($("#legend_name").val()=="" || $("#table_name").val()=="" ){
            $("#php_error").hide();
            $("#error_msgs").html("Fill up all the fields before submitting.");
            $("#error_msgs").show();
            return false;
        }
        if($("#column_name").val()==0){
            $("#php_error").hide();
            $("#error_msgs").html("Invalid Table Name");
            $("#error_msgs").show();
            return false;
        }
        if(hasWhiteSpace($("#legend_name").val()) == true || hasStrings($("#legend_name").val()) == true || hasString($("#legend_name").val()) == true ){
            $("#php_error").hide();
            $("#error_msgs").html("Lengend name should not contain 'white space' or '{' or '}'");
            $("#error_msgs").show();
            return false;
        }
        return true;
    }
    $("#table_name").keyup(function(){
        if($("#table_name").val()!=""){  
            var searchbox = $("#table_name").val();
            var dataString = 'searchword='+ searchbox;
            var urls= '<?php echo BASE_URL; ?>';
            $.ajax({
                type: "POST",
                url: urls+"website_specifics/Email-Management/Legends/functions.php",
                data: dataString,
                cache: false,
                success: function(html){
                    $("#loading").hide();
                    $("#show_column").html(html);
                },
                beforeSend: function(){
                    $("#loading").html("<font color='red'>loading...</font>").show();
                }
            });
        }
        else{
            $("#loading").html("<font color='red'>enter correct table name.</font>");
        }
    })
    
    $(".delete").click(function(){
        var width = $(window).width();
        var height = $(window).height();
       
        $("#delete_alert").width(width);
        $("#delete_alert").height(height);
       
        $("#delete_alert").css({
            "background-color":"white",
            "opacity": "0.5",
            "left": "0"
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
        var table_name = "legends_tbl";
        var table_id = $(this).attr('id');
        var urls= '<?php echo BASE_URL; ?>';
        var send_url = urls+"conf/ajax_functions.php";
        $.ajax({
            type: "POST",
            url: urls+"conf/ajax_functions.php",
            data: "value=delete&table_name="+table_name+"&delete_id="+table_id+"&url="+send_url,
            success: function(msg){
                $("#main_delete_alert").html(msg);
            },
            beforeSend: function(){
                $("#main_delete_alert").html('<center><br><br><br><h3>Loding...</h3></center>');
            }
         });
    })
	
</script>

<style type="text/css">
<!--
	#edit_bttn{
	   background-image: url('../../images/edit.gif');
       width: 20px;
       height: 20px;
	}
-->
</style> 
