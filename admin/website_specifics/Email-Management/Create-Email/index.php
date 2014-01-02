 <script src="<?php echo BASE_URL;?>website_specifics/Email-Management/Scripts/nicEdit.js" language="javascript"></script>
 <p>Create the body of your email.</p>
 <div id="php_error">
 <?php
  if(isset($_POST['submit_edit'])){
    $edit_id = $_POST['submit_edit'];
    $edit_query = mysql_fetch_array(mysql_query("SELECT * FROM `email_body` WHERE id='$edit_id'"))or die("Error=>".mysql_error());
    $edit_emailname = $edit_query['email_name'];
    $edit_emailbody = $edit_query['email_body'];
    $email_address = $edit_query['email_address'];
  }
  if(isset($_POST['email_name']) && isset($_POST['email_body'])){
    $email_name = $_POST['email_name'];
    $email_body = base64_encode($_POST['email_body']);
    $email_addr = $_POST['email_address'];
    if($email_name == "" || $email_body == ""){
        echo "<p class='span-18 error last'>Error occured please try again.</p>";
    }
    else{
        if($_POST['submit_check'] == "Create"){
            $query1 = mysql_fetch_array(mysql_query("SELECT COUNT( id ) FROM `email_body` WHERE email_name = '$email_name'")) or die ("Error-->".mysql_error());
            if($query1[0] == 0){
                 mysql_query("INSERT INTO `email_body` (`id` ,`email_name` ,`email_body` ,`email_address`) VALUES ( NULL , '$email_name', '$email_body', '$email_addr')") or die ("Error-->".mysql_error());
                echo "<p class='span-18 info last'>The email has been created successfully.</p>";
            }
            else{
                echo "<p class='span-18 error last'>The email already exists.</p>";
            }
        }
        else if($_POST['submit_check'] == "Edit"){
            $edit_email_id = $_POST['email_id'];
            if(mysql_query("UPDATE `email_body` SET email_name='$email_name', email_body='$email_body', email_address='$email_addr' WHERE id='$edit_email_id'")){
                echo "<p class='span-18 info last'>The email has been edited successfully.</p>";
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
 <form method="post" action="" onsubmit="return fieldCheck();">
 <strong>Email Name:</strong><br />
    <input type="text" name="email_name" value="<?php if(isset($edit_id)){ echo $edit_emailname; } ?>" id="email_name"/><br />
 <strong>Email Body:</strong><br />
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <textarea name="email_body" id="main_email_body" class="headerss"><?php if(isset($edit_id)){ echo base64_decode($edit_emailbody); } ?></textarea>
    <script type="text/javascript">
        bkLib.onDomLoaded(function() {
    	   new nicEditor({iconsPath : '<?php echo BASE_URL;?>website_specifics/Email-Management/Images/nicEditorIcons.gif'}).panelInstance( 'main_email_body');
    });
 </script>
 <?php
    $user_level = $_SESSION['level'];
    $query100 = mysql_query("SELECT `email` FROM email WHERE (access='both' OR access='$user_level')") or die("Error-->".mysql_error);    
 ?>
 <strong>Email:</strong><br />
    <select id="email_address" name="email_address">
    <option value="0">Select Default email address.</option>
 <?php
    while($email_addr=mysql_fetch_array($query100)){
 ?>
        <option value="<?php echo $email_addr['email']; ?>" <?php if(isset($email_address)){ if($email_address==$email_addr['email']){?> selected="selected" <?php } }  ?> ><?php echo $email_addr['email']; ?></option>
 <?php
 }
 ?>
    </select><br />
 <input type="hidden" value="<?php if(isset($edit_id)){ echo "Edit"; }else{ echo "Create";} ?>" name="submit_check" />
 <?php 
    if(isset($edit_id)){
        echo '<input type="hidden" value="'.$edit_id.'" name="email_id" />';
    }
 ?>
 <input type="submit" value="<?php if(isset($edit_id)){ echo "Edit"; }else{ echo "Create";} ?>" class="button" />   
 </form>
 <br />
 <?php
    $query1 = mysql_query("SELECT * FROM `email_body`")or die("Error-->".mysql_error());
 ?>
 <span style="border: solid 1px silver; width: 50%; position: absolute;"></span><br />
 <table>
 <tbody>
 <tr>
 <th>S.N.</th>
 <th>Email Name</th>
 <th>Email Body</th>
 <th>Email Address</th>
 <th>Actions</th>
 </tr>
 <?php
 $sn =1;
 while($email_values=mysql_fetch_array($query1)){
 ?>
    <tr id="id_<?php echo $email_values['id']; ?>">
    <td style="width:20px;"><?php echo $sn; ?></td>
    <td><?php echo $email_values['email_name']; ?></td>
    <td><?php echo base64_decode($email_values['email_body']); ?></td>
    <td><?php echo $email_values['email_address']; ?></td>
    <td style="width:100px;">
        <a id="<?php echo $email_values['id']; ?>" class="icons delete" title="delete" href="#">&nbsp;</a>
        <a id="<?php echo $email_values['id']; ?>" class="icons edit view_email" title="edit" >V</a>
        <form name="" method="post" action="" class="icons edit">
            <input name="" type="submit" value="" id="edit_bttn" />
            <input type="hidden" value="<?php echo $email_values['id']; ?>" name="submit_edit" />
        </form>
        <!--
<a href="<?php //echo BASE_URL."tools/Email-Management/Create-Email/edit/ss".$email_values['id'];?>" class="icons edit" title="edit">&nbsp;</a>
-->
        
        
    </td>
    </tr>
 <?php  
 $sn++; 
 }
 
 ?>
 </tbody>
 </table>
 
 
 <!--
<span id="edit_email">view/edit/delete email</span>
-->
 <div id="delete_alert" style="display: none; position: fixed; top: 0px;"></div>
 <div id="main_delete_alert" style="display: none; position: fixed; "></div>
 
 <div id="template"></div>
 <div id="show_template"></div>
 
<style type="text/css">
<!--
	#edit_bttn{
	   background-image: url('../../images/edit.gif');
       width: 20px;
       height: 20px;
	}
-->
</style> 

<script type="text/javascript">
	function fieldCheck(){
	   if($("#email_name").val()=="" || $("#main_email_body").val()==""){
	       $("#php_error").hide();
           $("#error_msgs").html("");
           $("#error_msgs").html("Fill up all the fields before submitting.");
           $("#error_msgs").show();
	       return false;
	   }
       if($("#email_address").val() == "0"){
           $("#php_error").hide();
           $("#error_msgs").html("");
           $("#error_msgs").html("Please Select the email address.");
           $("#error_msgs").show();
	       return false;       
       }
       return true;
	}
    
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
        var table_name = "email_body";
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

    
    $(".view_email").click(function(){
        var urls= '<?php echo BASE_URL; ?>';
        var width = $(window).width();
        var height = $(window).height();
        var id = $(this).attr('id');
        
        $.ajax({
            type: "POST",
            url: urls+"website_specifics/Email-Management/Create-Email/functions.php",
            data: "url="+urls+"&value=view&id="+id,
            success: function(msg){
                $("#template").width(width);
                $("#template").height(height);
                $("#template").css({
                    "background-color":"black",
                    "border":"solid 1px",
                    "opacity": "0.5",
                    "position": "fixed",
                    "top": "0",
                    "left": "0"
                })
                $("#show_template").css({
                    "top":height/17,
                    "left":width/4,
                    "width":"700",
                    "background-color":"white",
                    "border":"solid 1px",
                    "position": "fixed", 
                })
                $("#template").fadeIn('slow');
                $("#show_template").fadeIn('slow');
                $("#show_template").html(msg)
            },
            beforeSend: function(){
                $("#show_template").show();
                $("#show_template").html("loading....");
            }
        })
    })
</script>

<style type="text/css">
<!--
	#edit_email{
	   color: blue;
	}
    #edit_email:hover{
        color:red;
        cursor: pointer;
    }
-->
</style>