<style type="text/css">
<!--
	#close_me{
        float: right;
        margin-right: 5px;
    }
	#close_me:hover{
	   cursor: pointer;
	}
-->
</style>
<?php
session_start();
//include("admin/conf/dbConnect.php");
 include("../../../conf/dbConnect.php");
 include("../../../conf/functions.php");
 
 
 
 
 if(isset($_POST["value"])){
    if($_POST['value'] == "call_email"){
        $email_id = $_POST['id'];
        $query2 = mysql_query("SELECT * FROM `email_body` WHERE id='$email_id'")or die("Error-->".mysql_error());
        echo '<form action="" method="post" onsubmit="">';
        while($show_email = mysql_fetch_array($query2)){
            echo "<textarea>".$show_email['email_body']."</textarea>";
        }
        echo '<br>';
        echo '&nbsp;&nbsp;&nbsp;&nbsp;';
        echo '<span id="update_email" class="update_emails">edit</span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="delete_email" class="delete_email">delete</span>';
        echo '<br>';
        echo '</form>';
    }
    else{
        echo "<div style='padding-left: 10px; border: solid 1px;'>";
        echo "<span id='close_me'>X</span><br>";
        $value = $_POST["value"];
        $xml_file = '../Manage-Template/template.xml';
        if($value == "view" && isset($_POST['id'])){
            $id = $_POST['id'];
            $query3 = mysql_query("SELECT * FROM email_body WHERE id='$id'");
            while($show_emails = mysql_fetch_array($query3)){
                if(file_exists($xml_file)){    
                    $pre_header = base64_decode(getXMLValues($xml_file,"template","mail_header"));
                    $pre_footer = base64_decode(getXMLValues($xml_file,"template","mail_footer"));
                    echo $pre_header;
                    echo "<br><br>";
                    echo base64_decode($show_emails['email_body']);
                    echo "<br><br>";
                    echo $pre_footer;
                }
                else{
                    echo base64_decode($show_emails['email_body']);
                }
            }
        }
        /*
        //$query1 = mysql_query("SELECT * FROM `email_body`")or die("Error-->".mysql_error());
//        echo "Choose Email Name:<br>";
//        echo "<select id='drp_down'>";
//        echo "<option value='0'>Select The email.</option>";
//        while($rows = mysql_fetch_array($query1)){            
//        ?>
//            <option value="<?php //echo $rows['id']; ?>"><?php echo $rows['email_name']; ?></option>
//        <?php
//        }    
//        echo "</select>";
        ?>
        <div id="edit_delete_email"></div>
        <?php

       */
        echo "</div>";    
    }
    
 }else{
    echo "error";
 }
 
 //if($_REQUEST['sdf'] == 'drp'){
//    echo "show the drop down here";
// }

?>

<script type="text/javascript">
    $("#update_email").click(function(){
        //alert($(this).attr('class'));
        alert('sdf')
    });
	$("#close_me").click(function(){
	   $("#template").fadeOut('slow');
       $("#show_template").fadeOut('slow');
	});
    
    $("#drp_down").change(function(){
        var urlss = "<?php print_r($_POST["url"]); ?>";
        var id_email = $(this).val();
        if(id_email == '0'){
            $("#edit_delete_email").fadeOut("slow");
            $("#edit_delete_email").html("");
        }
        else{
            $.ajax({
            type: "POST",
            url: urlss+"website_specifics/Email-Management/Create-Email/functions.php",
            data: "value=call_email&id="+$(this).val(),
            success: function(msg){
               $("#edit_delete_email").html(msg);
            },
            beforeSend: function(){
                $("#edit_delete_email").fadeIn('slow');
                $("#edit_delete_email").html("Loading");
            }
        });
        }
        //alert($(this).val())
    });
    
    
</script>

<style type="text/css">
<!--
	#update_email, #delete_email{
	   color: blue;
	}
    #update_email:hover, #delete_email:hover{
        color:red;
        cursor: pointer;
    }
-->
</style>