<?php

/**
 * @author qualia
 * @copyright 2011
 */
 if($_POST['delete'] == 'confirm'){
 ?>
    <div>
        <center><form>
            <br /><br />
            <h3><font color="red">Are you sure you want to uninstall the plugin?</font></h3><br />
            <input type="button" value="Yes" style="height: 25px; width: 60px;" id="delete_yes" />
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input style="height: 25px; width: 60px;" type="button" value="No" id="delete_no" />
        </form></center>
    </div>
 <?php
 }
 
 if($_POST['delete'] == 'true'){
    include("../../../conf/dbConnect.php");
    include("../../../conf/functions.php");
    $tool_name = $_POST['tool_name'];
    $tool_path = "../../".cut($tool_name);
    if(file_exists($tool_path)){
        deleteDir($tool_path."/");
        mysql_query("DELETE FROM widgets WHERE name='$tool_name'") or die (mysql_error());
        
        $tbl_check = mysql_fetch_array(mysql_query("SELECT COUNT(widgetname) FROM admingeneraltool_tbl WHERE widgetname='$tool_name'")) or die (mysql_error());
        
        if($tbl_check[0]!= 0){
           echo $tbl_check[0]."<br>";
           mysql_query("DELETE FROM admingeneraltool_tbl WHERE widgetname='$tool_name'") or die (mysql_error());   
        }
         
        //$tbl_check = mysql_fetch_array(mysql_query("SELECT COUNT(username) FROM adminwidget_tbl WHERE username='$user'"));
//        if($tbl_check[0]!=0){
//           mysql_query("DELETE FROM adminwidget_tbl WHERE username='$user'") or die (mysql_error());
//        }
        
    }
    //echo $user;
    
//    mysql_query("DELETE FROM login_table WHERE username='$user'") or die (mysql_error());
//    
//    $tbl_check = mysql_fetch_array(mysql_query("SELECT COUNT(username) FROM admingeneraltool_tbl WHERE username='$user'")) or die (mysql_error());
//    
//    if($tbl_check[0]!= 0){
//       echo $tbl_check[0]."<br>";
//       mysql_query("DELETE FROM admingeneraltool_tbl WHERE username='$user'") or die (mysql_error());   
//    }
//     
//    $tbl_check = mysql_fetch_array(mysql_query("SELECT COUNT(username) FROM adminwidget_tbl WHERE username='$user'"));
//    if($tbl_check[0]!=0){
//       mysql_query("DELETE FROM adminwidget_tbl WHERE username='$user'") or die (mysql_error());
//    }
 } 

?>


<script type="text/javascript">
	$("#delete_no").click(function(){
	   $("#main_delete_alert").fadeOut('slow');
       $("#delete_alert").fadeOut('slow');   
	});
    
    $("#delete_yes").click(function(){
        //var username = '<?php //echo $_POST["user"]; ?>';
        var urls= '<?php echo $_POST["urls"]; ?>';
        var tool_name = '<?php echo $_POST["toolname"]; ?>';
        var id = '<?php echo $_POST["id"]; ?>';
       // alert(tool_name)
        
        //var hide_id = '';
        $.ajax({
            type: "POST",
            url: urls,
            data: "delete=true&tool_name="+tool_name,
            success: function(msg){
               //$("#main_delete_alert").html(msg);
               $("#main_delete_alert").fadeOut('slow');
               $("#delete_alert").fadeOut('slow');
               $("#id_"+id).fadeOut(1000);
            },
            beforeSend: function(){
                $("#main_delete_alert").html('<center><br><br><br><h3>Loding...</h3></center>');
            }
        })
    });
</script>