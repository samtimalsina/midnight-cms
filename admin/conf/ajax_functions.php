<?php
include("dbConnect.php");
/**
 * @author qualia
 * @copyright 2011
 */

 $value = $_REQUEST['value'];
 
 if($value == "yes_no"){
    $table_name = $_REQUEST['table_name'];
    $table_id = $_REQUEST['table_id'];
    if($table_name=='forms'){
        $check_visible = mysql_fetch_array(mysql_query("SELECT visible FROM `$table_name` WHERE id ='$table_id'")) or die ("error ".mysql_error()) ;
        if($check_visible[0]=="yes"){
            mysql_query("UPDATE `$table_name` SET visible='no' WHERE id='$table_id'");
            echo "no";}
        else{
            mysql_query("UPDATE `$table_name` SET visible='yes' WHERE id='$table_id'");
            echo "yes";
        }
    }
    else{
        
        $check = mysql_query("SELECT * FROM forms WHERE form_name='$table_name'") or die ("error");
        while($check2=mysql_fetch_array($check)){
            $form_ids=$check2['id'];
            $try = mysql_query("SELECT * FROM form_elements WHERE form_id='$form_ids' AND (options='no,yes' OR options='yes,no')") or die("error");
            while($trys=mysql_fetch_array($try)){
                $found_value=$trys['name'];
            }
        }
        $check_visible = mysql_fetch_array(mysql_query("SELECT $found_value FROM `$table_name` WHERE id ='$table_id'")) or die ("error ".mysql_error()) ;
        if($check_visible[0]=="yes"){
            mysql_query("UPDATE `$table_name` SET `$found_value`='no' WHERE id='$table_id'");
            echo "no";
        }
        else{
            mysql_query("UPDATE `$table_name` SET `$found_value`='yes' WHERE id='$table_id'");
            echo "yes";
        }    
    }
 }
 
 if($value=="delete"){
    ?>
    <div>
        <center><form>
            <br /><br />
            <h3><font color="red">Do you want to delete?</font></h3><br />
            <input type="button" value="Yes" style="height: 25px; width: 60px;" id="delete_yes" />
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input style="height: 25px; width: 60px;" type="button" value="No" id="delete_no" />
        </form></center>
    </div>
    
    <?php
 }
 
 if($value=="delete_yes"){
    $table_name = $_REQUEST['table_name'];
    $delete_id = $_REQUEST['delete_id'];
    
    mysql_query("DELETE FROM $table_name WHERE id=$delete_id") or die (mysql_error());
    unset($_REQUEST['table_name']);
    
 }
 
 if($value=="deleteuser_widgets"){
     
    
     $user = $_REQUEST['user'];
     
     $tbl_check = mysql_fetch_array(mysql_query("SELECT COUNT(username) FROM admingeneraltool_tbl WHERE username='$user'"));
     if($tbl_check[0]!= 0){
        echo $tbl_check[0]."<br>";
        mysql_query("DELETE FROM admingeneraltool_tbl WHERE username='$user'") or die (mysql_error());   
     }
     
     $tbl_check = mysql_fetch_array(mysql_query("SELECT COUNT(username) FROM adminwidget_tbl WHERE username='$user'"));
     if($tbl_check[0]!=0){
        mysql_query("DELETE FROM adminwidget_tbl WHERE username='$user'") or die (mysql_error());
     }
     unset($user);   
 }
    //$table_name = $_REQUEST['table_name'];
//    $delete_id = $_REQUEST['delete_id'];
//    $widget_id = $_REQUEST['widget_id'];
//    echo $delete_id;
//    //mysql_query("DELETE FROM $table_name WHERE id=$delete_id") or die (mysql_error());
//	unset($_REQUEST['table_name']);
// }

?>

<script type="text/javascript">
	$("#delete_no").click(function(){
	   $("#main_delete_alert").fadeOut('slow');
       $("#delete_alert").fadeOut('slow');   
	});
    
    $("#delete_yes").click(function(){
        var delete_id = '<?php echo $_REQUEST['delete_id']; ?>';
        var table_name = '<?php echo $_REQUEST['table_name'] ?>';
        var url = '<?php echo $_REQUEST['url'] ?>'
 
        $.ajax({
            type: "POST",
            url: url,
            data: "value=delete_yes&delete_id="+delete_id+"&table_name="+table_name,
            success: function(msg){
                $("#main_delete_alert").fadeOut('slow');
                $("#delete_alert").fadeOut('slow');
                $("#id_"+delete_id).fadeOut(1000);
            },
            beforeSend: function(){
                $("#main_delete_alert").html('<center><br><br><br><h3>Deleting...</h3></center>');
            }
        });
        
        
    })
</script>