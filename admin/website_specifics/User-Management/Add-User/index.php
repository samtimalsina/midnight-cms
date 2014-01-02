<p>Add Users who can use the Midnight CMS. You can edit what widgets they can use later on.</p>
<p>
    Fields marked <span style="color:#F00">*</span> are compulsory
</p>

<div id="php_error">

<?php

    if(isset($_REQUEST['new_user']) && isset($_REQUEST['password'])){
        $new_user_name = $_REQUEST['new_user'];
        $password = $_REQUEST['password'];
        $level = $_REQUEST['select_level'];
        
        if (strlen($password)<5){
		    echo "<p class='error'>Password must be atleast 5 characters long.</p>";
        }
        else{
            $user_check = mysql_fetch_array(mysql_query("SELECT COUNT(username) FROM login_table WHERE username='$new_user_name'"));
            if($user_check[0] == 0){
                $hash_password = getPasswordHash(getPasswordSalt(), $password);
                mysql_query("INSERT INTO login_table VALUES ('','$new_user_name', '$hash_password', '$level')") or die ("error->".mysql_error());
                echo "<p class='info'>User added successfully</p>";   
            }
            else{
                echo "<p class='error'>Username is already used.</p>";
            }
                
        }
    }

?>

</div>
<div id="error_msg" class="error" style="display: none;"></div> 

<form method="post" action="" onsubmit="return addUserCheck();">

    <label for="new_user">UserName&nbsp;*</label>
    <input type="text" name="new_user" id="new_user" />
    
    <label for="password">Password&nbsp;*</label>
    <input type="password" name="password" id="password" />
    
    <label for="re_password">New Password&nbsp;*</label>
    <input type="password" name="re_password" id="re_password" />
    
    <label for="level">Level&nbsp;*</label>
    <select name="select_level">
        <option value="admin">Admin</option>
        <option value="sub-admin">Sub-Admin</option>
    </select>
    
    <p><input type="reset" value="Reset" class="button"/>
    <input type="submit" value="Add User" class="button"/></p>
    
    
    
</form>

 
    


<script type="text/javascript">
	function addUserCheck(){
	   if($("#new_user").val()=="" || $("#password").val()=="" || $("#re_password").val()=="" ){
	       $("#php_error").hide();
           $("#error_msg").show();
           $("#error_msg").html("Fill up all the fields before submitting.")
           return false;
	   }
       else if($("#password").val() != $("#re_password").val() ){
           $("#php_error").hide();
           $("#error_msg").show();
           $("#error_msg").html("Password do not match.")
           return false;
       }
	   else if($("#password").val().length < 5 ){
           $("#php_error").hide();
           $("#error_msg").show();
           $("#error_msg").html("Password must be atleast 5 characters long.")
           return false;
       }
       else{
           return true; 
       }
	   
	}
</script>

